<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::with('category')->latest()->get();
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

        // url ko slug format me convert kar do
        $data['url'] = Str::slug($data['url']);

        $data['faqs'] = $this->prepareFaqs($request);

        if ($request->hasFile('front_image')) {
            $data['front_image'] = $request->file('front_image')->store('blogs/front', 'public');
        }

        if ($request->hasFile('detail_image')) {
            $data['detail_image'] = $request->file('detail_image')->store('blogs/detail', 'public');
        }

        if ($request->hasFile('cta_image')) {
            $data['cta_image'] = $request->file('cta_image')->store('blogs/cta', 'public');
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
            if ($blog->front_image) {
                Storage::disk('public')->delete($blog->front_image);
            }
            $data['front_image'] = $request->file('front_image')->store('blogs/front', 'public');
        }

        if ($request->hasFile('detail_image')) {
            if ($blog->detail_image) {
                Storage::disk('public')->delete($blog->detail_image);
            }
            $data['detail_image'] = $request->file('detail_image')->store('blogs/detail', 'public');
        }

        if ($request->hasFile('cta_image')) {
            if ($blog->cta_image) {
                Storage::disk('public')->delete($blog->cta_image);
            }
            $data['cta_image'] = $request->file('cta_image')->store('blogs/cta', 'public');
        }

        unset($data['faq_question'], $data['faq_answer']);

        $blog->update($data);

        return redirect()->route('blogs.index')
            ->with('toast_success', 'Blog updated successfully.');
    }

    public function destroy(Blog $blog)
    {
        if ($blog->front_image) {
            Storage::disk('public')->delete($blog->front_image);
        }
        if ($blog->detail_image) {
            Storage::disk('public')->delete($blog->detail_image);
        }
        if ($blog->cta_image) {
            Storage::disk('public')->delete($blog->cta_image);
        }

        $blog->delete();

        return redirect()->route('blogs.index')
            ->with('toast_success', 'Blog deleted successfully.');
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
}