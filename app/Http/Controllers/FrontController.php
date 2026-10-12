<?php

namespace App\Http\Controllers;

use App\Models\AboutLogo;
use App\Models\JobApplication;
use App\Models\JobOpening;
use Illuminate\Http\Request;

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
        return view('front.contact');
    }

    public function events()
    {
        return view('front.events');
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
}
