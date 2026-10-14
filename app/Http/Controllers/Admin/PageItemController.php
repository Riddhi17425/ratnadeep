<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Concerns\ManagesFiles;
use App\Http\Controllers\Controller;
use App\Models\AboutLogo;
use App\Models\PageItem;
use App\Models\PageText;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

/**
 * Repeating blocks of the inner pages (cards, checklists, steps ...).
 * Which sections exist and which fields they use is defined in config/page_content.php.
 */
class PageItemController extends Controller
{
    use ManagesFiles;

    protected $uploadPath = 'backend/page-items';

    private function sections(): array
    {
        return config('page_content.sections');
    }

    private function sectionOrFail(?string $key): string
    {
        abort_unless($key && isset($this->sections()[$key]), 404);

        return $key;
    }

    private function initializeDefaults(string $section): void
    {
        if (PageItem::withTrashed()->where('section', $section)->exists()) {
            return;
        }

        $defaults = $this->sections()[$section]['defaults'] ?? [];

        if ($section === 'about.certifications') {
            $defaults = AboutLogo::where('status', 1)
                ->whereNull('deleted_at')
                ->orderBy('id')
                ->get(['title', 'image', 'alt_image_text'])
                ->map(fn ($logo) => [
                    'title' => $logo->title,
                    'image' => $logo->image,
                    'alt_image_text' => $logo->alt_image_text,
                ])
                ->all();
        }

        foreach ($defaults as $sortOrder => $item) {
            PageItem::create(array_merge($item, [
                'section' => $section,
                'sort_order' => $sortOrder,
                'status' => 1,
            ]));
        }
    }

    private function contentGroups(array $sections, array $textPages): array
    {
        $groups = [];

        foreach ($sections as $key => $section) {
            $groups[$section['page']]['sections'][$key] = $section;
        }

        foreach ($textPages as $key => $page) {
            $groups[$page['label']]['text_page'] = $key;
        }

        return $groups;
    }

    // Active + trashed together, one section at a time
    public function index(Request $request)
    {
        $sections = $this->sections();
        $textPages = config('page_texts');
        $contentGroups = $this->contentGroups($sections, $textPages);

        $selected = $request->query('section');
        $textPage = null;
        $textValues = [];

        if (is_string($selected) && str_starts_with($selected, 'text:')) {
            $page = substr($selected, 5);
            abort_unless(isset($textPages[$page]), 404);

            $textPage = $page;
            $section = $selected;
            $items = collect();
            $textValues = PageText::where('page', $page)->pluck('value', 'key')->all();
        } else {
            $section = isset($sections[$selected]) ? $selected : array_key_first($sections);
            $this->initializeDefaults($section);
            $items = PageItem::withTrashed()->where('section', $section)->orderBy('sort_order')->orderBy('id')->get();
        }

        return view('admin.page-items.index', compact(
            'items',
            'sections',
            'section',
            'textPages',
            'contentGroups',
            'textPage',
            'textValues'
        ));
    }

    public function create(Request $request)
    {
        $section = $this->sectionOrFail($request->query('section'));

        return view('admin.page-items.create', ['section' => $section, 'config' => $this->sections()[$section]]);
    }

    public function edit(PageItem $page_item)
    {
        $section = $this->sectionOrFail($page_item->section);

        return view('admin.page-items.edit', ['item' => $page_item, 'section' => $section, 'config' => $this->sections()[$section]]);
    }

    private function rules(string $section): array
    {
        $config = $this->sections()[$section];

        return [
            'section'        => ['required', Rule::in(array_keys($this->sections()))],
            'title'          => 'required|string|max:255',
            'description'    => $config['description'] ? 'nullable|string' : 'nullable',
            'phone'          => !empty($config['contact']) ? 'nullable|string|max:100' : 'nullable',
            'email'          => !empty($config['contact']) ? 'nullable|email|max:255' : 'nullable',
            'image'          => $config['image'] ? 'nullable|file|mimes:jpg,jpeg,png,webp,svg|max:2048' : 'nullable',
            'alt_image_text' => 'nullable|string|max:255',
            'sort_order'     => 'nullable|integer|min:0',
            'status'         => 'required|in:0,1',
        ];
    }

    private function cleanData(array $data, string $section): array
    {
        $config = $this->sections()[$section];

        if (!$config['description']) {
            unset($data['description']);
        }
        if (empty($config['contact'])) {
            unset($data['phone'], $data['email']);
        }
        unset($data['image']);
        $data['sort_order'] = $data['sort_order'] ?? 0;

        return $data;
    }

    public function store(Request $request)
    {
        $section = $this->sectionOrFail($request->input('section'));
        $data = $this->cleanData($request->validate($this->rules($section)), $section);

        if ($request->hasFile('image') && $this->sections()[$section]['image']) {
            $data['image'] = $this->uploadFile($request->file('image'), $this->uploadPath);
        }

        PageItem::create($data);

        return redirect()->route('page-items.index', ['section' => $section])
            ->with('toast_success', 'Item created successfully.');
    }

    public function update(Request $request, PageItem $page_item)
    {
        $section = $this->sectionOrFail($page_item->section);
        $request->merge(['section' => $section]);
        $data = $this->cleanData($request->validate($this->rules($section)), $section);

        if ($request->hasFile('image') && $this->sections()[$section]['image']) {
            $this->deleteFile($page_item->image);
            $data['image'] = $this->uploadFile($request->file('image'), $this->uploadPath);
        }

        $page_item->update($data);

        return redirect()->route('page-items.index', ['section' => $section])
            ->with('toast_success', 'Item updated successfully.');
    }

    // Soft delete
    public function destroy(PageItem $page_item)
    {
        $page_item->delete();

        return redirect()->route('page-items.index', ['section' => $page_item->section])
            ->with('toast_success', 'Item moved to trash.');
    }

    // Restore
    public function restore($id)
    {
        $item = PageItem::onlyTrashed()->findOrFail($id);
        $item->restore();

        return redirect()->route('page-items.index', ['section' => $item->section])
            ->with('toast_success', 'Item restored successfully.');
    }

    // Permanent delete
    public function forceDelete($id)
    {
        $item = PageItem::withTrashed()->findOrFail($id);
        $this->deleteFile($item->image);
        $item->forceDelete();

        return redirect()->route('page-items.index', ['section' => $item->section])
            ->with('toast_success', 'Item permanently deleted.');
    }

    public function updateStatus(Request $request, PageItem $page_item)
    {
        $request->validate(['status' => 'required|in:0,1']);

        $page_item->status = $request->status;
        $page_item->save();

        return response()->json(['success' => true]);
    }
}
