<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class BannerController extends Controller
{
    protected $uploadPath = 'backend/banners';

    // Ab active + trashed dono ek sath layenge
    public function index()
    {
        $banners = Banner::withTrashed()->with('category')->latest()->get();
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
            $data['image'] = $this->uploadImage($request->file('image'));
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
            $this->deleteImage($banner->image);
            $data['image'] = $this->uploadImage($request->file('image'));
        }

        $banner->update($data);

        return redirect()->route('banners.index')
            ->with('toast_success', 'Banner updated successfully.');
    }

    // Soft delete
    public function destroy(Banner $banner)
    {
        $banner->delete();

        return redirect()->route('banners.index')
            ->with('toast_success', 'Banner moved to trash.');
    }

    // Restore
    public function restore($id)
    {
        $banner = Banner::onlyTrashed()->findOrFail($id);
        $banner->restore();

        return redirect()->route('banners.index')
            ->with('toast_success', 'Banner restored successfully.');
    }

    // Permanent delete
    public function forceDelete($id)
    {
        $banner = Banner::withTrashed()->findOrFail($id);

        $this->deleteImage($banner->image);
        $banner->forceDelete();

        return redirect()->route('banners.index')
            ->with('toast_success', 'Banner permanently deleted.');
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