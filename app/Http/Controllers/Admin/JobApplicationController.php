<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JobApplication;
use Illuminate\Support\Facades\Storage;

/**
 * Applications submitted from the Careers page. Resumes are private (storage/app/private),
 * so they can only be downloaded from here.
 */
class JobApplicationController extends Controller
{
    public function index()
    {
        $applications = JobApplication::withTrashed()->latest()->get();

        return view('admin.job-applications.index', compact('applications'));
    }

    public function show(JobApplication $job_application)
    {
        if (!$job_application->is_read) {
            $job_application->update(['is_read' => 1]);
        }

        return view('admin.job-applications.show', ['application' => $job_application]);
    }

    public function download(JobApplication $job_application)
    {
        abort_unless(Storage::disk('local')->exists($job_application->resume), 404);

        return Storage::disk('local')->download($job_application->resume);
    }

    // Soft delete
    public function destroy(JobApplication $job_application)
    {
        $job_application->delete();

        return redirect()->route('job-applications.index')->with('toast_success', 'Application moved to trash.');
    }

    // Restore
    public function restore($id)
    {
        JobApplication::onlyTrashed()->findOrFail($id)->restore();

        return redirect()->route('job-applications.index')->with('toast_success', 'Application restored successfully.');
    }

    // Permanent delete (also removes the resume file)
    public function forceDelete($id)
    {
        $application = JobApplication::withTrashed()->findOrFail($id);

        if ($application->resume) {
            Storage::disk('local')->delete($application->resume);
        }
        $application->forceDelete();

        return redirect()->route('job-applications.index')->with('toast_success', 'Application permanently deleted.');
    }
}
