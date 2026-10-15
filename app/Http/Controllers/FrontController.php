<?php

namespace App\Http\Controllers;

use App\Models\AboutLogo;
use App\Models\Career;
use App\Models\JobArea;
use App\Models\JobOpening;
use App\Models\Country;
use App\Models\PageItem;
use App\Models\Product;
use App\Models\UpcomingEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use App\Models\ContactInquiry;
use App\Models\WhatsappInquiry;
use Carbon\Carbon;

class FrontController extends Controller
{
    private function hasPageItems(string $section): bool
    {
        return PageItem::withTrashed()->where('section', $section)->exists();
    }

    public function about()
    {
        $certifications = getPageItems('about.certifications');
        if ($certifications->isEmpty() && !$this->hasPageItems('about.certifications')) {
            $certifications = AboutLogo::where('status', 1)->whereNull('deleted_at')->orderBy('id')->get();
        }
        $values = getPageItems('about.values');
        $strengths = getPageItems('about.strengths');
        $stages = getPageItems('about.stages');

        if ($values->isEmpty() && !$this->hasPageItems('about.values')) {
            $values = collect([
                ['title' => 'Manufacturing Excellence', 'description' => 'Every pipe and tube is manufactured through disciplined processes, advanced manufacturing infrastructure, and rigorous quality control to ensure consistent performance across industrial applications.'],
                ['title' => 'Customer Commitment', 'description' => 'We support customers with reliable pipe and tube manufacturing solutions, responsive communication, dependable delivery, and a clear understanding of project requirements.'],
                ['title' => 'Continuous Improvement', 'description' => 'We continuously strengthen our manufacturing capabilities, production technologies, and quality systems to meet evolving industry standards and customer expectations.'],
                ['title' => 'Integrity in Operations', 'description' => 'From raw material inspection to final dispatch, every pipe and tube is backed by complete material traceability, documented quality assurance, and transparent manufacturing practices.'],
            ])->map(fn ($item) => (object) $item);
        }

        if ($strengths->isEmpty() && !$this->hasPageItems('about.strengths')) {
            $strengths = collect([
                ['title' => 'Complete Material Traceability', 'description' => 'Every batch of raw material is fully documented and traceable from mill origin through all stages of production.', 'image' => 'frontend/assets/images/About/strength-1.png', 'alt_image_text' => 'Complete Material Traceability'],
                ['title' => 'End-to-End In-House Manufacturing', 'description' => 'Equipped with specialized cold drawing, pilgering, and finishing lines for total quality assurance.', 'image' => 'frontend/assets/images/About/strength-2.png', 'alt_image_text' => 'End-to-End In-House Manufacturing'],
                ['title' => 'Approved by Global Industries', 'description' => 'Recognized and certified by major international engineering consultants and certification bodies.', 'image' => 'frontend/assets/images/About/strength-3.png', 'alt_image_text' => 'Approved by Global Industries'],
                ['title' => '100% Inspection Before Dispatch', 'description' => 'Comprehensive hydro, eddy-current, and ultrasonic testing to verify defect-free tubing.', 'image' => 'frontend/assets/images/About/strength-4.png', 'alt_image_text' => '100% Inspection Before Dispatch'],
            ])->map(fn ($item) => (object) $item);
        }

        if ($stages->isEmpty() && !$this->hasPageItems('about.stages')) {
            $stages = collect([
                ['title' => 'Raw Material Inspection', 'description' => 'Every raw material batch is carefully inspected for chemical composition, mechanical properties, and dimensional accuracy before entering production, ensuring every pipe and tube begins with verified quality.'],
                ['title' => 'Pipe Forming & Rolling', 'description' => 'Seamless and welded pipes and tubes are formed through controlled rolling, piercing, and welding processes managed in-house to maintain tighter tolerances, consistent dimensions, and reliable mechanical performance.'],
                ['title' => 'Heat Treatment', 'description' => 'Heat treatment is carried out under controlled furnace conditions to achieve the required metallurgical structure, strength, and durability needed for demanding industrial and high-pressure applications.'],
                ['title' => 'In-House Testing & NDT', 'description' => 'Every product undergoes rigorous in-house inspection and non-destructive testing, including dimensional verification and material validation, to confirm compliance with applicable standards before moving to finishing.'],
                ['title' => 'Finishing & Marking', 'description' => 'Pipes and tubes are finished, marked, and documented with complete material traceability so every product can be identified, tracked, and supplied with the quality records required by global customers.'],
                ['title' => 'Final Inspection & Dispatch', 'description' => 'Before dispatch, every order passes through final inspection and packing checks to ensure products leave our facility ready for dependable performance in domestic and international project environments.'],
            ])->map(fn ($item) => (object) $item);
        }

        $stageData = $stages->map(fn ($stage) => [
            'title' => $stage->title,
            'text' => $stage->description,
        ])->values();

        return view('front.about', compact('certifications', 'values', 'strengths', 'stages', 'stageData'));
    }

    public function clients()
    {
        $clientLogos = getPageItems('clients.logos');

        if ($clientLogos->isEmpty() && !$this->hasPageItems('clients.logos')) {
            $clientLogos = collect([
                ['title' => 'SABIC', 'image' => 'frontend/assets/images/Clients/sabic.svg'],
                ['title' => 'Thyssenkrupp', 'image' => 'frontend/assets/images/Clients/thyssenkrupp.svg'],
                ['title' => 'Reliance Industries Limited', 'image' => 'frontend/assets/images/Clients/reliance.png'],
                ['title' => 'Técnicas Reunidas', 'image' => 'frontend/assets/images/Clients/tecnicas-reunidas.png'],
                ['title' => 'Linde', 'image' => 'frontend/assets/images/Clients/linde.png'],
                ['title' => 'Jacobs', 'image' => 'frontend/assets/images/Clients/jacobs.png'],
                ['title' => 'Saipem', 'image' => 'frontend/assets/images/Clients/saipem.png'],
                ['title' => 'NTPC', 'image' => 'frontend/assets/images/Clients/ntpc.svg'],
                ['title' => 'BHEL', 'image' => 'frontend/assets/images/Clients/bhel.png'],
                ['title' => 'Technip', 'image' => 'frontend/assets/images/Clients/technip.svg'],
                ['title' => 'Tecnimont', 'image' => 'frontend/assets/images/Clients/tecnimont.png'],
                ['title' => 'Engineers India Limited', 'image' => 'frontend/assets/images/Clients/eil.svg'],
                ['title' => 'Thermo Cables', 'image' => 'frontend/assets/images/Clients/thermocables.png'],
                ['title' => 'Valmet', 'image' => 'frontend/assets/images/Clients/valmet.png'],
                ['title' => 'Yaar', 'image' => 'frontend/assets/images/Clients/yaar.png'],
                ['title' => 'Petrofac', 'image' => 'frontend/assets/images/Clients/petrofac.png'],
            ])->map(fn ($item) => (object) $item);
        }

        $logoColumns = $clientLogos->count() > 2
            ? collect([$clientLogos->take(1)])
                ->concat($clientLogos->slice(1, -1)->chunk(2))
                ->push($clientLogos->slice(-1))
            : $clientLogos->chunk(2);

        return view('front.clients', compact('clientLogos', 'logoColumns'));
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
        $activeAreaNames = JobArea::where('status', 1)->pluck('name');
        $roles = JobOpening::where('status', 1)
            ->whereIn('area', $activeAreaNames)
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();

        $areas = JobArea::where('status', 1)
            ->whereIn('name', $roles->pluck('area')->unique())
            ->orderBy('sort_order')
            ->orderBy('name')
            ->pluck('name');

        $reasons = getPageItems('careers.reasons');
        $locations = getPageItems('careers.locations');

        return view('front.careers', compact('roles', 'areas', 'reasons', 'locations'));
    }

    public function applyForJob(Request $request)
    {
        $activeAreas = JobArea::where('status', 1)->pluck('name');
        $availablePositions = JobOpening::where('status', 1)
            ->whereIn('area', $activeAreas)
            ->pluck('title')
            ->push('General application')
            ->unique()
            ->all();

        $data = $request->validate([
            'full_name'  => ['required', 'string', 'max:255'],
            'email'      => ['required', 'string', 'email', 'max:255'],
            'phone'      => ['required', 'string', 'regex:/^[0-9]{7,15}$/'],
            'position'   => ['required', 'string', 'max:255', Rule::in($availablePositions)],
            'experience' => ['required', 'string', 'max:255'],
            'linkedin'   => ['nullable', 'string', 'max:255'],
            'resume'     => ['required', 'file', 'mimes:pdf,doc,docx', 'max:5120'],
        ], [
            'phone.regex'  => 'Please enter a phone number using 7 to 15 digits only.',
            'position.in'  => 'Please select an available position.',
            'resume.max'   => 'The resume may not be larger than 5 MB.',
            'resume.mimes' => 'Please attach your resume as a PDF or Word file.',
        ]);

        foreach (['full_name', 'email', 'phone', 'position', 'experience', 'linkedin'] as $field) {
            if (isset($data[$field])) {
                $data[$field] = trim($data[$field]);
            }
        }

        $resumePath = null;
        try {
            $resumePath = $request->file('resume')->store('resumes', 'local');
            if (!$resumePath) {
                throw new \RuntimeException('Resume could not be stored.');
            }

            $career = Career::create([
                'full_name' => $data['full_name'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'position' => $data['position'],
                'experience' => $data['experience'],
                'linkedin' => $data['linkedin'] ?: null,
                'resume' => $resumePath,
            ]);
        } catch (\Throwable $e) {
            if ($resumePath) {
                Storage::disk('local')->delete($resumePath);
            }

            Log::error('Career application database save failed.', [
                'error' => $e->getMessage(),
            ]);

            return redirect(route('careers') . '#apply')
                ->withInput()
                ->with('careers_error', 'Unable to submit your application. Please try again.');
        }

        $sheetData = [
            'full_name' => $career->full_name,
            'email' => $career->email,
            'phone' => $career->phone,
            'position' => $career->position,
            'experience' => $career->experience,
            'linkedin' => $career->linkedin ?? '',
            'resume' => $request->file('resume')->getClientOriginalName(),
        ];

        try {
            $response = Http::asJson()
                ->acceptJson()
                ->timeout(30)
                ->post(
                    'https://script.google.com/macros/s/AKfycbyUcCwn2GKMhUOKwdA3Zg9s4EgOobo-a7-sWlZKnDRG9Wu_R8vzQmeq9GIVO1KIHXt36Q/exec',
                    $sheetData
                );

            $sheetResult = $response->json();
            if (
                !$response->successful() ||
                !is_array($sheetResult) ||
                ($sheetResult['status'] ?? null) !== 'success'
            ) {
                Log::error('Google Sheets career application save was not confirmed.', [
                    'career_id' => $career->id,
                    'http_status' => $response->status(),
                    'response' => $response->body(),
                ]);

                return redirect(route('careers') . '#apply')
                    ->with('careers_error', 'Your application was saved, but spreadsheet storage could not be confirmed. Please contact HR rather than submitting again.');
            }
        } catch (\Throwable $e) {
            Log::error('Google Sheets career application request failed.', [
                'career_id' => $career->id,
                'error' => $e->getMessage(),
            ]);

            return redirect(route('careers') . '#apply')
                ->with('careers_error', 'Your application was saved, but spreadsheet storage could not be confirmed. Please contact HR rather than submitting again.');
        }

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

    public function submitWhatsAppInquiry(Request $request)
    {
        $data = $request->validate([
            'phone' => ['required', 'string', 'regex:/^\\+[1-9][0-9]{6,14}$/'],
            'message' => ['nullable', 'string', 'max:10000'],
        ]);

        $phone = trim($data['phone']);
        $message = trim($data['message'] ?? '');

        try {
            $inquiry = WhatsappInquiry::create([
                'phone' => $phone,
                'message' => $message ?: null,
            ]);
        } catch (\Throwable $e) {
            Log::error('WhatsApp inquiry database save failed.', [
                'error' => $e->getMessage(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Unable to submit your enquiry. Please try again.',
            ], 500);
        }

        try {
            $response = Http::asJson()
                ->acceptJson()
                ->timeout(30)
                ->post(
                    'https://script.google.com/macros/s/AKfycbyUcCwn2GKMhUOKwdA3Zg9s4EgOobo-a7-sWlZKnDRG9Wu_R8vzQmeq9GIVO1KIHXt36Q/exec',
                    [
                        'phone' => $phone,
                        'message' => $message,
                    ]
                );

            $sheetResult = $response->json();
            if (
                !$response->successful() ||
                !is_array($sheetResult) ||
                ($sheetResult['status'] ?? null) !== 'success'
            ) {
                Log::error('Google Sheets WhatsApp inquiry save was not confirmed.', [
                    'inquiry_id' => $inquiry->id,
                    'http_status' => $response->status(),
                    'response' => $response->body(),
                ]);

                return response()->json([
                    'success' => false,
                    'message' => 'Your enquiry was saved, but spreadsheet storage could not be confirmed. Please try again later.',
                ], 502);
            }
        } catch (\Throwable $e) {
            Log::error('Google Sheets WhatsApp inquiry request failed.', [
                'inquiry_id' => $inquiry->id,
                'error' => $e->getMessage(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Your enquiry was saved, but spreadsheet storage could not be confirmed. Please try again later.',
            ], 502);
        }

        return response()->json([
            'success' => true,
            'message' => 'Your enquiry has been submitted successfully.',
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
