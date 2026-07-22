<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    protected $uploadPath = 'backend/categories';

    // Ab active + trashed dono ek sath layenge
    public function index()
    {
        $categories = Category::withTrashed()->latest()->get();
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title'             => 'required|string|max:255',
            'description'       => 'nullable|string',
            'shortdescription'  => 'nullable|string',
            'metatitle'         => 'nullable|string|max:255',
            'metadescription'   => 'nullable|string',
            'image'             => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'alt_image_text'    => 'nullable|string|max:255',
            'status'            => 'required|in:0,1',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $data = $validator->validated();

        if ($request->hasFile('image')) {
            $data['image'] = $this->uploadImage($request->file('image'));
        }

        Category::create($data);

        return redirect()->route('categories.index')
            ->with('toast_success', 'Category created successfully.');
    }

    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $validator = Validator::make($request->all(), [
            'title'             => 'required|string|max:255',
            'description'       => 'nullable|string',
            'shortdescription'  => 'nullable|string',
            'metatitle'         => 'nullable|string|max:255',
            'metadescription'   => 'nullable|string',
            'image'             => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'alt_image_text'    => 'nullable|string|max:255',
            'status'            => 'required|in:0,1',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $data = $validator->validated();

        if ($request->hasFile('image')) {
            $this->deleteImage($category->image);
            $data['image'] = $this->uploadImage($request->file('image'));
        }

        $category->update($data);

        return redirect()->route('categories.index')
            ->with('toast_success', 'Category updated successfully.');
    }

    // Soft delete
    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('categories.index')
            ->with('toast_success', 'Category moved to trash.');
    }

    // Restore
    public function restore($id)
    {
        $category = Category::onlyTrashed()->findOrFail($id);
        $category->restore();

        return redirect()->route('categories.index')
            ->with('toast_success', 'Category restored successfully.');
    }

    // Permanent delete
    public function forceDelete($id)
    {
        $category = Category::withTrashed()->findOrFail($id);

        $this->deleteImage($category->image);
        $category->forceDelete();

        return redirect()->route('categories.index')
            ->with('toast_success', 'Category permanently deleted.');
    }

    public function updateStatus(Request $request, Category $category)
    {
        $request->validate([
            'status' => 'required|in:0,1',
        ]);

        $category->status = $request->status;
        $category->save();

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

