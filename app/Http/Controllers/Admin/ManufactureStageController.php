<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ManufactureStage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class ManufactureStageController extends Controller
{
    protected $uploadPath = 'backend/manufacture-stages';

    // Ab active + trashed dono ek sath layenge
    public function index()
    {
        $manufactureStages = ManufactureStage::withTrashed()->latest()->get();
        return view('admin.manufacture-stages.index', compact('manufactureStages'));
    }

    public function create()
    {
        return view('admin.manufacture-stages.create');
    }

    private function rules()
    {
        return [
            'title'           => 'required|string|max:255',
            'subtitle'        => 'nullable|string|max:255',
            'description'     => 'nullable|string',
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

        ManufactureStage::create($data);

        return redirect()->route('manufacture-stages.index')
            ->with('toast_success', 'Manufacture Stage created successfully.');
    }

    public function edit(ManufactureStage $manufacture_stage)
    {
        return view('admin.manufacture-stages.edit', ['manufactureStage' => $manufacture_stage]);
    }

    public function update(Request $request, ManufactureStage $manufacture_stage)
    {
        $validator = Validator::make($request->all(), $this->rules());

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $data = $validator->validated();

        if ($request->hasFile('image')) {
            $this->deleteImage($manufacture_stage->image);
            $data['image'] = $this->uploadImage($request->file('image'));
        }

        $manufacture_stage->update($data);

        return redirect()->route('manufacture-stages.index')
            ->with('toast_success', 'Manufacture Stage updated successfully.');
    }

    // Soft delete
    public function destroy(ManufactureStage $manufacture_stage)
    {
        $manufacture_stage->delete();

        return redirect()->route('manufacture-stages.index')
            ->with('toast_success', 'Manufacture Stage moved to trash.');
    }

    // Restore
    public function restore($id)
    {
        $manufacture_stage = ManufactureStage::onlyTrashed()->findOrFail($id);
        $manufacture_stage->restore();

        return redirect()->route('manufacture-stages.index')
            ->with('toast_success', 'Manufacture Stage restored successfully.');
    }

    // Permanent delete
    public function forceDelete($id)
    {
        $manufacture_stage = ManufactureStage::withTrashed()->findOrFail($id);

        $this->deleteImage($manufacture_stage->image);
        $manufacture_stage->forceDelete();

        return redirect()->route('manufacture-stages.index')
            ->with('toast_success', 'Manufacture Stage permanently deleted.');
    }

    public function updateStatus(Request $request, ManufactureStage $manufacture_stage)
    {
        $request->validate([
            'status' => 'required|in:0,1',
        ]);

        $manufacture_stage->status = $request->status;
        $manufacture_stage->save();

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