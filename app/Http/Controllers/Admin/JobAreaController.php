<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JobArea;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class JobAreaController extends Controller
{
    public function index()
    {
        $jobAreas = JobArea::withTrashed()->orderBy('sort_order')->orderBy('name')->get();

        return view('admin.job-areas.index', compact('jobAreas'));
    }

    public function create()
    {
        return view('admin.job-areas.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', Rule::unique('job_areas', 'name')],
            'sort_order' => 'nullable|integer|min:0',
            'status' => 'required|in:0,1',
        ]);

        $data['sort_order'] = $data['sort_order'] ?? 0;
        JobArea::create($data);

        return redirect()->route('job-areas.index')->with('toast_success', 'Job area created successfully.');
    }

    public function edit(JobArea $jobArea)
    {
        return view('admin.job-areas.edit', compact('jobArea'));
    }

    public function update(Request $request, JobArea $jobArea)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', Rule::unique('job_areas', 'name')->ignore($jobArea->id)],
            'sort_order' => 'nullable|integer|min:0',
            'status' => 'required|in:0,1',
        ]);

        $data['sort_order'] = $data['sort_order'] ?? 0;
        $jobArea->update($data);

        return redirect()->route('job-areas.index')->with('toast_success', 'Job area updated successfully.');
    }

    public function destroy(JobArea $jobArea)
    {
        $jobArea->delete();

        return redirect()->route('job-areas.index')->with('toast_success', 'Job area moved to trash.');
    }

    public function restore($id)
    {
        JobArea::onlyTrashed()->findOrFail($id)->restore();

        return redirect()->route('job-areas.index')->with('toast_success', 'Job area restored successfully.');
    }

    public function forceDelete($id)
    {
        JobArea::withTrashed()->findOrFail($id)->forceDelete();

        return redirect()->route('job-areas.index')->with('toast_success', 'Job area permanently deleted.');
    }
}
