<?php

namespace App\Http\Controllers;

use App\Models\AboutLogo;
use App\Models\JobApplication;
use App\Models\JobOpening;
use App\Models\Country;
use App\Models\Product;
use App\Models\UpcomingEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Models\ContactInquiry;
use Carbon\Carbon;

class FrontController extends Controller
{
    public function about()
    {
        $aboutLogos = AboutLogo::where('status', 1)->whereNull('deleted_at')->orderBy('id')->get();

        return view('front.about', compact('aboutLogos'));
    }

    public function clients()
    {
        return view('front.clients');
    }

    public function contact()
    {
        $countries = Country::orderBy('name')->get();
        $products = Product::orderBy('title')->get();

        return view('front.contact', compact('countries', 'products'));
    }

    public function events()
    {
        $events = UpcomingEvent::where('status', 1)
            ->orderByDesc('date_from')
            ->orderBy('id')
            ->get();

        return view('front.events', compact('events'));
    }

    public function careers()
    {
        $roles = JobOpening::where('status', 1)->orderBy('sort_order')->orderBy('id')->get();

        // Filter tabs: the configured areas first (only those in use), then any custom ones.
        $used = $roles->pluck('area')->unique()->values();
        $areas = collect(config('page_content.job_areas'))->filter(fn ($area) => $used->contains($area))
            ->merge($used->diff(config('page_content.job_areas')))->values();

        $reasons = getPageItems('careers.reasons');
        $locations = getPageItems('careers.locations');

        return view('front.careers', compact('roles', 'areas', 'reasons', 'locations'));
    }

    public function applyForJob(Request $request)
    {
        $data = $request->validate([
            'full_name'  => 'required|string|max:255',
            'email'      => 'required|email|max:255',
            'phone'      => 'required|string|max:50',
            'position'   => 'required|string|max:255',
            'experience' => 'required|string|max:255',
            'linkedin'   => 'nullable|string|max:255',
            'resume'     => 'required|file|mimes:pdf,doc,docx|max:5120',
        ], [
            'resume.max'   => 'The resume may not be larger than 5 MB.',
            'resume.mimes' => 'Please attach your resume as a PDF or Word file.',
        ]);

        // Stored privately (storage/app/private/resumes); only the admin can download it.
        $data['resume'] = $request->file('resume')->store('resumes', 'local');
        $data['job_opening_id'] = JobOpening::where('title', $data['position'])->value('id');

        JobApplication::create($data);

        return redirect(route('careers') . '#apply')
            ->with('careers_success', 'Thank you! Your application has been submitted. Our HR team will get in touch with you.');
    }

    public function packagingShipping()
    {
        return view('front.packaging-shipping', [
            'options'  => getPageItems('packaging.options'),
            'approach' => getPageItems('packaging.approach'),
            'exports'  => getPageItems('packaging.exports'),
            'modes'    => getPageItems('packaging.modes'),
            'faqs'     => getFaqs('packaging'),
        ]);
    }

    public function inspectionQualityTesting()
    {
        return view('front.inspection-quality-testing', [
            'approach'       => getPageItems('inspection.approach'),
            'destructive'    => getPageItems('inspection.destructive'),
            'nonDestructive' => getPageItems('inspection.non_destructive'),
            'reasons'        => getPageItems('inspection.reasons'),
            'faqs'           => getFaqs('inspection'),
        ]);
    }

    public function applications()
    {
        return view('front.applications', [
            'applications' => getPageItems('applications.items'),
            'reasons'      => getPageItems('applications.reasons'),
            'faqs'         => getFaqs('applications'),
        ]);
    }

    public function submitContactInquiry(Request $request)
    {
        // 1. Server-side validation
        $validator = Validator::make(
            $request->all(),
            [
                'name' => [
                    'required',
                    'string',
                    'max:255',
                    function ($attribute, $value, $fail) {
                        if (trim($value) === '') {
                            $fail('Full name is required.');
                        }

                        if (preg_match('/https?:\/\/|www\./i', $value)) {
                            $fail('URLs are not allowed in the full name.');
                        }
                    },
                ],

                'email' => [
                    'required',
                    'string',
                    'email',
                    'max:255',
                ],

                'phone' => [
                    'required',
                    'string',
                    'max:50',
                    'regex:/^\+?[0-9\s().-]+$/',
                    'regex:/[0-9]/',
                ],

                'company' => [
                    'required',
                    'string',
                    'max:255',
                ],

                'country' => [
                    'required',
                    'string',
                    'max:255',
                ],

                'city' => [
                    'required_if:inquiry_type,page',
                    'nullable',
                    'string',
                    'max:255',
                ],

                'product' => [
                    'nullable',
                    'string',
                    'max:255',
                ],

                'requirement_details' => [
                    'nullable',
                    'string',
                    'max:10000',
                ],

                'inquiry_type' => [
                    'nullable',
                    'string',
                    'in:page,popup',
                ],
            ],
            [
                'name.required' => 'Full name is required.',
                'name.max' => 'Full name must not exceed 255 characters.',

                'email.required' => 'Email is required.',
                'email.email' => 'Please enter a valid email address.',
                'email.max' => 'Email must not exceed 255 characters.',

                'phone.required' => 'Phone number is required.',
                'phone.max' => 'Phone number must not exceed 50 characters.',
                'phone.regex' => 'Please enter a valid phone number.',

                'company.required' => 'Company name is required.',
                'company.max' => 'Company name must not exceed 255 characters.',

                'country.required' => 'Country is required.',
                'country.max' => 'Country must not exceed 255 characters.',

                'city.required_if' => 'City is required.',

                'product.max' => 'Product must not exceed 255 characters.',

                'requirement_details.max' =>
                    'Requirement details must not exceed 10000 characters.',

                'inquiry_type.in' => 'Invalid inquiry type.',
            ]
        );

        if ($validator->fails())
        {
            if ($request->ajax() || $request->expectsJson())
            {
                return response()->json([
                    'success' => false,
                    'message' => 'Please correct the errors and try again.',
                    'errors' => $validator->errors(),
                ], 422);
            }

            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // 2. Normalize input
        $data = $validator->validated();

        $data['name'] = trim($data['name']);
        $data['email'] = trim($data['email']);
        $data['phone'] = trim($data['phone']);
        $data['company'] = isset($data['company'])
            ? trim($data['company'])
            : null;
        $data['country'] = trim($data['country']);
        $data['city'] = isset($data['city'])
            ? trim($data['city'])
            : null;
        $data['product'] = isset($data['product'])
            ? trim($data['product'])
            : null;
        $data['requirement_details'] = isset($data['requirement_details'])
            ? trim($data['requirement_details'])
            : null;

        $inquiryType = $data['inquiry_type'] ?? 'Contact form';

        // Preserve the original product value for Google Sheets.
        $productForSheet = $data['product'] ?? '';

        // Store NULL in the database when product is "Other".
        $productForDb = ($productForSheet === 'Other')
            ? null
            : ($productForSheet !== '' ? $productForSheet : null);

        // 3. Save the enquiry in your database
        try
        {
            $inquiry = ContactInquiry::create([
                'name' => $data['name'],
                'company' => $data['company'] ?: null,
                'email' => $data['email'],
                'phone' => $data['phone'],
                'country' => $data['country'],
                'city' => $data['city'] ?: null,
                'product' => $productForDb,
                'requirement_details' =>
                    $data['requirement_details'] ?: null,
                'inquiry_type' => $inquiryType,
            ]);
        } 
        catch (\Throwable $e)
        {
            Log::error('Contact inquiry database save failed.', [
                'error' => $e->getMessage(),
            ]);

            if ($request->ajax() || $request->expectsJson())
            {
                return response()->json([
                    'success' => false,
                    'message' => 'Unable to submit your enquiry. Please try again.',
                ], 500);
            }

            return redirect()->back()
                ->withInput()
                ->with('error', 'Unable to submit your enquiry. Please try again.');
        }

        // 4. Send the enquiry to Google Sheets
        $sheetsData = [
            'inquiry_type' => $inquiryType,
            'name' => $inquiry->name,
            'company' => $inquiry->company ?? '',
            'email' => $inquiry->email,
            'phone' => $inquiry->phone,
            'country' => $inquiry->country,
            'city' => $inquiry->city ?? '',
            'product' => $productForSheet,
            'requirement_details' => $inquiry->requirement_details ?? '',
        ];

        $sheetSaved = false;

        try
        {
            $response = Http::asJson()
                ->acceptJson()
                ->timeout(30)
                ->post(
                    'https://script.google.com/macros/s/AKfycbyUcCwn2GKMhUOKwdA3Zg9s4EgOobo-a7-sWlZKnDRG9Wu_R8vzQmeq9GIVO1KIHXt36Q/exec',
                    $sheetsData
                );

            $sheetResult = $response->json();

            if (
                $response->successful() &&
                is_array($sheetResult) &&
                ($sheetResult['status'] ?? null) === 'success'
            ) 
            {
                $sheetSaved = true;
            }
            else
            {
                Log::error('Google Sheets save was not confirmed.', [
                    'inquiry_id' => $inquiry->id,
                    'http_status' => $response->status(),
                    'response' => $response->body(),
                ]);
            }
        } 
        catch (\Throwable $e)
        {
            Log::error('Google Sheets request failed.', [
                'inquiry_id' => $inquiry->id,
                'error' => $e->getMessage(),
            ]);
        }

        // 5. Return the response only after checking the Sheets result.

        if (!$sheetSaved)
        {
            if ($request->ajax() || $request->expectsJson())
            {
                return response()->json([
                    'success' => false,
                    'message' => 'Your enquiry was received, but spreadsheet storage could not be confirmed. Please contact us if you need confirmation.',
                ], 502);
            }

            return redirect()->back()
                ->withInput()
                ->with('error', 'Your enquiry was received, but spreadsheet storage could not be confirmed. Please contact us if you need confirmation.');
        }

        if ($request->ajax() || $request->expectsJson())
        {
            return response()->json([
                'success' => true,
                'message' => 'Your enquiry has been submitted successfully.',
            ]);
        }

        return redirect()->route('thankyou')
            ->with('success', 'Your message has been sent successfully.');
    }
}
