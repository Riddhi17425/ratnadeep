<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Industry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class IndustryController extends Controller
{
    public function index()
    {
        $industries = Industry::latest()->get();
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
            $data['image'] = $request->file('image')->store('industries', 'public');
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
            if ($industry->image) {
                Storage::disk('public')->delete($industry->image);
            }
            $data['image'] = $request->file('image')->store('industries', 'public');
        }

        $industry->update($data);

        return redirect()->route('industries.index')
            ->with('toast_success', 'Industry updated successfully.');
    }

    public function destroy(Industry $industry)
    {
        if ($industry->image) {
            Storage::disk('public')->delete($industry->image);
        }
        $industry->delete();

        return redirect()->route('industries.index')
            ->with('toast_success', 'Industry deleted successfully.');
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
}