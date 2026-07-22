<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Industry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class IndustryController extends Controller
{
    protected $uploadPath = 'backend/industries';

    // Ab active + trashed dono ek sath layenge
    public function index()
    {
        $industries = Industry::withTrashed()->latest()->get();
        return view('admin.industries.index', compact('industries'));
    }

    public function create()
    {
        return view('admin.industries.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title'           => 'required|string|max:255',
            'image'           => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'alt_image_text'  => 'nullable|string|max:255',
            'status'          => 'required|in:0,1',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $data = $validator->validated();

        if ($request->hasFile('image')) {
            $data['image'] = $this->uploadImage($request->file('image'));
        }

        Industry::create($data);

        return redirect()->route('industries.index')
            ->with('toast_success', 'Industry created successfully.');
    }

    public function edit(Industry $industry)
    {
        return view('admin.industries.edit', compact('industry'));
    }

    public function update(Request $request, Industry $industry)
    {
        $validator = Validator::make($request->all(), [
            'title'           => 'required|string|max:255',
            'image'           => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'alt_image_text'  => 'nullable|string|max:255',
            'status'          => 'required|in:0,1',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $data = $validator->validated();

        if ($request->hasFile('image')) {
            $this->deleteImage($industry->image);
            $data['image'] = $this->uploadImage($request->file('image'));
        }

        $industry->update($data);

        return redirect()->route('industries.index')
            ->with('toast_success', 'Industry updated successfully.');
    }

    // Soft delete
    public function destroy(Industry $industry)
    {
        $industry->delete();

        return redirect()->route('industries.index')
            ->with('toast_success', 'Industry moved to trash.');
    }

    // Restore
    public function restore($id)
    {
        $industry = Industry::onlyTrashed()->findOrFail($id);
        $industry->restore();

        return redirect()->route('industries.index')
            ->with('toast_success', 'Industry restored successfully.');
    }

    // Permanent delete
    public function forceDelete($id)
    {
        $industry = Industry::withTrashed()->findOrFail($id);

        $this->deleteImage($industry->image);
        $industry->forceDelete();

        return redirect()->route('industries.index')
            ->with('toast_success', 'Industry permanently deleted.');
    }

    public function updateStatus(Request $request, Industry $industry)
    {
        $request->validate([
            'status' => 'required|in:0,1',
        ]);

        $industry->status = $request->status;
        $industry->save();

        return response()->json(['success' => true]);
    }

    private function uploadImage($file)
    {
        $destinationPath = public_path($this->uploadPath);

        if (!File::exists($destinationPath)) {
            File::makeDirectory($destinationPath, 0755, true);
        }

        $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
        $file->move($destinationPath, $fileName);

        return $this->uploadPath . '/' . $fileName;
    }

    private function deleteImage($imagePath)
    {
        if ($imagePath && File::exists(public_path($imagePath))) {
            File::delete(public_path($imagePath));
        }
    }
}