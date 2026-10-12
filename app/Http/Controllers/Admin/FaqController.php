<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class FaqController extends Controller
{
    private function pages(): array
    {
        return config('page_content.faq_pages');
    }

    // Active + trashed together, one page at a time
    public function index(Request $request)
    {
        $pages = $this->pages();
        $page = $request->query('page');
        $page = isset($pages[$page]) ? $page : array_key_first($pages);

        $faqs = Faq::withTrashed()->where('page', $page)->orderBy('sort_order')->orderBy('id')->get();

        return view('admin.faqs.index', compact('faqs', 'pages', 'page'));
    }

    public function create(Request $request)
    {
        $pages = $this->pages();
        $page = $request->query('page');
        $page = isset($pages[$page]) ? $page : array_key_first($pages);

        return view('admin.faqs.create', compact('pages', 'page'));
    }

    public function edit(Faq $faq)
    {
        return view('admin.faqs.edit', ['faq' => $faq, 'pages' => $this->pages()]);
    }

    private function rules(): array
    {
        return [
            'page'       => ['required', Rule::in(array_keys($this->pages()))],
            'question'   => 'required|string|max:255',
            'answer'     => 'required|string',
            'sort_order' => 'nullable|integer|min:0',
            'status'     => 'required|in:0,1',
        ];
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), $this->rules());

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $data = $validator->validated();
        $data['sort_order'] = $data['sort_order'] ?? 0;
        Faq::create($data);

        return redirect()->route('faqs.index', ['page' => $data['page']])->with('toast_success', 'FAQ created successfully.');
    }

    public function update(Request $request, Faq $faq)
    {
        $validator = Validator::make($request->all(), $this->rules());

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $data = $validator->validated();
        $data['sort_order'] = $data['sort_order'] ?? 0;
        $faq->update($data);

        return redirect()->route('faqs.index', ['page' => $data['page']])->with('toast_success', 'FAQ updated successfully.');
    }

    // Soft delete
    public function destroy(Faq $faq)
    {
        $faq->delete();

        return redirect()->route('faqs.index', ['page' => $faq->page])->with('toast_success', 'FAQ moved to trash.');
    }

    // Restore
    public function restore($id)
    {
        $faq = Faq::onlyTrashed()->findOrFail($id);
        $faq->restore();

        return redirect()->route('faqs.index', ['page' => $faq->page])->with('toast_success', 'FAQ restored successfully.');
    }

    // Permanent delete
    public function forceDelete($id)
    {
        $faq = Faq::withTrashed()->findOrFail($id);
        $faq->forceDelete();

        return redirect()->route('faqs.index', ['page' => $faq->page])->with('toast_success', 'FAQ permanently deleted.');
    }

    public function updateStatus(Request $request, Faq $faq)
    {
        $request->validate(['status' => 'required|in:0,1']);

        $faq->status = $request->status;
        $faq->save();

        return response()->json(['success' => true]);
    }
}
