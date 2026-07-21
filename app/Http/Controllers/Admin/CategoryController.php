<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::latest()->get();
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
            $data['image'] = $request->file('image')->store('categories', 'public');
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
            if ($category->image) {
                Storage::disk('public')->delete($category->image);
            }
            $data['image'] = $request->file('image')->store('categories', 'public');
        }

        $category->update($data);

        return redirect()->route('categories.index')
            ->with('toast_success', 'Category updated successfully.');
    }

    public function destroy(Category $category)
    {
        if ($category->image) {
            Storage::disk('public')->delete($category->image);
        }
        $category->delete();

        return redirect()->route('categories.index')
            ->with('toast_success', 'Category deleted successfully.');
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
}