<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ManufactureStage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ManufactureStageController extends Controller
{
    public function index()
    {
        $manufactureStages = ManufactureStage::latest()->get();
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
            $data['image'] = $request->file('image')->store('manufacture-stages', 'public');
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
            if ($manufacture_stage->image) {
                Storage::disk('public')->delete($manufacture_stage->image);
            }
            $data['image'] = $request->file('image')->store('manufacture-stages', 'public');
        }

        $manufacture_stage->update($data);

        return redirect()->route('manufacture-stages.index')
            ->with('toast_success', 'Manufacture Stage updated successfully.');
    }

    public function destroy(ManufactureStage $manufacture_stage)
    {
        if ($manufacture_stage->image) {
            Storage::disk('public')->delete($manufacture_stage->image);
        }
        $manufacture_stage->delete();

        return redirect()->route('manufacture-stages.index')
            ->with('toast_success', 'Manufacture Stage deleted successfully.');
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
}