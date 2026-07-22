<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Certificate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class CertificateController extends Controller
{
    protected $uploadPath = 'backend/certificates';

    // Ab active + trashed dono ek sath layenge
    public function index()
    {
        $certificates = Certificate::withTrashed()->latest()->get();
        return view('admin.certificates.index', compact('certificates'));
    }

    public function create()
    {
        return view('admin.certificates.create');
    }

    private function rules()
    {
        return [
            'title'           => 'required|string|max:255',
            'image'           => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'alt_image_text'  => 'nullable|string|max:255',
            'status'          => 'required|in:0,1',
        ];
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), $this->rules());

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $data = $validator->validated();

        if ($request->hasFile('image')) {
            $data['image'] = $this->uploadImage($request->file('image'));
        }

        Certificate::create($data);

        return redirect()->route('certificates.index')
            ->with('toast_success', 'Certificate created successfully.');
    }

    public function edit(Certificate $certificate)
    {
        return view('admin.certificates.edit', compact('certificate'));
    }

    public function update(Request $request, Certificate $certificate)
    {
        $validator = Validator::make($request->all(), $this->rules());

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $data = $validator->validated();

        if ($request->hasFile('image')) {
            $this->deleteImage($certificate->image);
            $data['image'] = $this->uploadImage($request->file('image'));
        }

        $certificate->update($data);

        return redirect()->route('certificates.index')
            ->with('toast_success', 'Certificate updated successfully.');
    }

    // Soft delete
    public function destroy(Certificate $certificate)
    {
        $certificate->delete();

        return redirect()->route('certificates.index')
            ->with('toast_success', 'Certificate moved to trash.');
    }

    // Restore
    public function restore($id)
    {
        $certificate = Certificate::onlyTrashed()->findOrFail($id);
        $certificate->restore();

        return redirect()->route('certificates.index')
            ->with('toast_success', 'Certificate restored successfully.');
    }

    // Permanent delete
    public function forceDelete($id)
    {
        $certificate = Certificate::withTrashed()->findOrFail($id);

        $this->deleteImage($certificate->image);
        $certificate->forceDelete();

        return redirect()->route('certificates.index')
            ->with('toast_success', 'Certificate permanently deleted.');
    }

    public function updateStatus(Request $request, Certificate $certificate)
    {
        $request->validate([
            'status' => 'required|in:0,1',
        ]);

        $certificate->status = $request->status;
        $certificate->save();

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