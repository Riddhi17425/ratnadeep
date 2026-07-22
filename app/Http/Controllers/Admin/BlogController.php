<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    protected $frontUploadPath  = 'backend/blogs/front';
    protected $detailUploadPath = 'backend/blogs/detail';
    protected $ctaUploadPath    = 'backend/blogs/cta';

    // Ab active + trashed dono ek sath layenge
    public function index()
    {
        $blogs = Blog::withTrashed()->with('category')->latest()->get();
        return view('admin.blogs.index', compact('blogs'));
    }

    public function create()
    {
        return view('admin.blogs.create');
    }

    private function rules($blogId = null)
    {
        return [
            'category'             => 'required|string|max:255',
            'title'                => 'required|string|max:255',
            'url'                  => 'required|string|max:255|unique:blogs,url,' . $blogId,
            'date'                 => 'required|date',
            'short_description'    => 'required|string',
            'long_description'     => 'required|string',
            'conclusion'           => 'nullable|string',
            'front_image'          => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'front_image_alt'      => 'nullable|string|max:255',
            'detail_image'         => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'detail_image_alt'     => 'nullable|string|max:255',
            'cta_image'            => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'cta_image_alt'        => 'nullable|string|max:255',
            'cta_link_url'         => 'nullable|string|max:255',
            'schema_json'          => 'nullable|json',
            'meta_title'           => 'nullable|string|max:255',
            'meta_description'     => 'nullable|string',
            'status'               => 'required|in:draft,published',
            'faq_question'         => 'nullable|array',
            'faq_question.*'       => 'nullable|string|max:500',
            'faq_answer'           => 'nullable|array',
            'faq_answer.*'         => 'nullable|string',
        ];
    }

    private function prepareFaqs(Request $request)
    {
        $faqs = [];
        $questions = $request->input('faq_question', []);
        $answers   = $request->input('faq_answer', []);

        foreach ($questions as $i => $question) {
            if (!empty($question) && !empty($answers[$i])) {
                $faqs[] = [
                    'question' => $question,
                    'answer'   => $answers[$i],
                ];
            }
        }

        return $faqs;
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), $this->rules());

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $data = $validator->validated();

        $data['url'] = Str::slug($data['url']);
        $data['faqs'] = $this->prepareFaqs($request);

        if ($request->hasFile('front_image')) {
            $data['front_image'] = $this->uploadImage($request->file('front_image'), $this->frontUploadPath);
        }

        if ($request->hasFile('detail_image')) {
            $data['detail_image'] = $this->uploadImage($request->file('detail_image'), $this->detailUploadPath);
        }

        if ($request->hasFile('cta_image')) {
            $data['cta_image'] = $this->uploadImage($request->file('cta_image'), $this->ctaUploadPath);
        }

        unset($data['faq_question'], $data['faq_answer']);

        Blog::create($data);

        return redirect()->route('blogs.index')
            ->with('toast_success', 'Blog created successfully.');
    }

    public function edit(Blog $blog)
    {
        return view('admin.blogs.edit', compact('blog'));
    }

    public function update(Request $request, Blog $blog)
    {
        $validator = Validator::make($request->all(), $this->rules($blog->id));

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $data = $validator->validated();

        $data['url'] = Str::slug($data['url']);
        $data['faqs'] = $this->prepareFaqs($request);

        if ($request->hasFile('front_image')) {
            $this->deleteImage($blog->front_image);
            $data['front_image'] = $this->uploadImage($request->file('front_image'), $this->frontUploadPath);
        }

        if ($request->hasFile('detail_image')) {
            $this->deleteImage($blog->detail_image);
            $data['detail_image'] = $this->uploadImage($request->file('detail_image'), $this->detailUploadPath);
        }

        if ($request->hasFile('cta_image')) {
            $this->deleteImage($blog->cta_image);
            $data['cta_image'] = $this->uploadImage($request->file('cta_image'), $this->ctaUploadPath);
        }

        unset($data['faq_question'], $data['faq_answer']);

        $blog->update($data);

        return redirect()->route('blogs.index')
            ->with('toast_success', 'Blog updated successfully.');
    }

    // Soft delete
    public function destroy(Blog $blog)
    {
        $blog->delete();

        return redirect()->route('blogs.index')
            ->with('toast_success', 'Blog moved to trash.');
    }

    // Restore
    public function restore($id)
    {
        $blog = Blog::onlyTrashed()->findOrFail($id);
        $blog->restore();

        return redirect()->route('blogs.index')
            ->with('toast_success', 'Blog restored successfully.');
    }

    // Permanent delete
    public function forceDelete($id)
    {
        $blog = Blog::withTrashed()->findOrFail($id);

        $this->deleteImage($blog->front_image);
        $this->deleteImage($blog->detail_image);
        $this->deleteImage($blog->cta_image);

        $blog->forceDelete();

        return redirect()->route('blogs.index')
            ->with('toast_success', 'Blog permanently deleted.');
    }

    public function updateStatus(Request $request, Blog $blog)
    {
        $request->validate([
            'status' => 'required|in:draft,published',
        ]);

        $blog->status = $request->status;
        $blog->save();

        return response()->json(['success' => true]);
    }

    private function uploadImage($file, $uploadPath)
    {
        $destinationPath = public_path($uploadPath);

        if (!File::exists($destinationPath)) {
            File::makeDirectory($destinationPath, 0755, true);
        }

        $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
        $file->move($destinationPath, $fileName);

        return $uploadPath . '/' . $fileName;
    }

    private function deleteImage($imagePath)
    {
        if ($imagePath && File::exists(public_path($imagePath))) {
            File::delete(public_path($imagePath));
        }
    }
}