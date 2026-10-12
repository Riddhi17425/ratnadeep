<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JobOpening;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class JobOpeningController extends Controller
{
    // Active + trashed together (same as the other modules)
    public function index()
    {
        $jobOpenings = JobOpening::withTrashed()->withCount('applications')->orderBy('sort_order')->latest()->get();

        return view('admin.job-openings.index', compact('jobOpenings'));
    }

    public function create()
    {
        return view('admin.job-openings.create', ['areas' => config('page_content.job_areas')]);
    }

    public function edit(JobOpening $job_opening)
    {
        return view('admin.job-openings.edit', [
            'jobOpening' => $job_opening,
            'areas'      => config('page_content.job_areas'),
        ]);
    }

    private function rules(): array
    {
        return [
            'title'         => 'required|string|max:255',
            'department'    => 'nullable|string|max:255',
            'area'          => 'required|string|max:100',
            'location'      => 'nullable|string|max:255',
            'experience'    => 'nullable|string|max:255',
            'qualification' => 'nullable|string|max:255',
            'sort_order'    => 'nullable|integer|min:0',
            'status'        => 'required|in:0,1',
        ];
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), $this->rules());

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $data = $validator->validated();
        $data['sort_order'] = $data['sort_order'] ?? 0;
        JobOpening::create($data);

        return redirect()->route('job-openings.index')->with('toast_success', 'Job opening created successfully.');
    }

    public function update(Request $request, JobOpening $job_opening)
    {
        $validator = Validator::make($request->all(), $this->rules());

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $data = $validator->validated();
        $data['sort_order'] = $data['sort_order'] ?? 0;
        $job_opening->update($data);

        return redirect()->route('job-openings.index')->with('toast_success', 'Job opening updated successfully.');
    }

    // Soft delete
    public function destroy(JobOpening $job_opening)
    {
        $job_opening->delete();

        return redirect()->route('job-openings.index')->with('toast_success', 'Job opening moved to trash.');
    }

    // Restore
    public function restore($id)
    {
        JobOpening::onlyTrashed()->findOrFail($id)->restore();

        return redirect()->route('job-openings.index')->with('toast_success', 'Job opening restored successfully.');
    }

    // Permanent delete
    public function forceDelete($id)
    {
        JobOpening::withTrashed()->findOrFail($id)->forceDelete();

        return redirect()->route('job-openings.index')->with('toast_success', 'Job opening permanently deleted.');
    }

    public function updateStatus(Request $request, JobOpening $job_opening)
    {
        $request->validate(['status' => 'required|in:0,1']);

        $job_opening->status = $request->status;
        $job_opening->save();

        return response()->json(['success' => true]);
    }
}
