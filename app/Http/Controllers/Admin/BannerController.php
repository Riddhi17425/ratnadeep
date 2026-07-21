<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class BannerController extends Controller
{
    public function index()
    {
        $banners = Banner::with('category')->latest()->get();
        return view('admin.banners.index', compact('banners'));
    }

    public function create()
    {
        $categories = Category::where('status', 1)->get();
        return view('admin.banners.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category_id'     => 'required|exists:categories,id',
            'title'           => 'required|string|max:255',
            'shortnote'       => 'nullable|string|max:255',
            'description'     => 'nullable|string',
            'image'           => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'alt_image_text'  => 'nullable|string|max:255',
            'status'          => 'required|in:0,1',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $data = $validator->validated();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('banners', 'public');
        }

        Banner::create($data);

        return redirect()->route('banners.index')
            ->with('toast_success', 'Banner created successfully.');
    }

    public function edit(Banner $banner)
    {
        $categories = Category::where('status', 1)->get();
        return view('admin.banners.edit', compact('banner', 'categories'));
    }

    public function update(Request $request, Banner $banner)
    {
        $validator = Validator::make($request->all(), [
            'category_id'     => 'required|exists:categories,id',
            'title'           => 'required|string|max:255',
            'shortnote'       => 'nullable|string|max:255',
            'description'     => 'nullable|string',
            'image'           => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'alt_image_text'  => 'nullable|string|max:255',
            'status'          => 'required|in:0,1',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $data = $validator->validated();

        if ($request->hasFile('image')) {
            if ($banner->image) {
                Storage::disk('public')->delete($banner->image);
            }
            $data['image'] = $request->file('image')->store('banners', 'public');
        }

        $banner->update($data);

        return redirect()->route('banners.index')
            ->with('toast_success', 'Banner updated successfully.');
    }

    public function destroy(Banner $banner)
    {
        if ($banner->image) {
            Storage::disk('public')->delete($banner->image);
        }
        $banner->delete();

        return redirect()->route('banners.index')
            ->with('toast_success', 'Banner deleted successfully.');
    }

    public function updateStatus(Request $request, Banner $banner)
    {
        $request->validate([
            'status' => 'required|in:0,1',
        ]);

        $banner->status = $request->status;
        $banner->save();

        return response()->json(['success' => true]);
    }
}