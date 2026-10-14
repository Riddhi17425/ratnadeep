<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Concerns\ManagesFiles;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Industry;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
    use ManagesFiles;

    protected $uploadPath = 'backend/products';

    // Active + trashed together (same as the other modules)
    public function index()
    {
        $products = Product::withTrashed()->with('category')->orderBy('sort_order')->latest()->get();

        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        return view('admin.products.create', $this->formData());
    }

    public function edit(Product $product)
    {
        return view('admin.products.edit', $this->formData() + ['product' => $product]);
    }

    private function formData(): array
    {
        return [
            'categories' => Category::where('status', 1)->orderBy('title')->get(),
            'industries' => Industry::where('status', 1)->orderBy('title')->get(),
        ];
    }

    private function rules(?Product $product = null): array
    {
        $slugRule = Rule::unique('products', 'slug');
        if ($product) {
            $slugRule->ignore($product->id);
        }

        return [
            'category_id'      => 'required|exists:categories,id',
            'title'            => 'required|string|max:255',
            'slug'             => ['nullable', 'string', 'max:255', $slugRule],
            'type'             => 'nullable|string|max:255',
            'summary'          => 'nullable|string',
            'image'            => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'alt_image_text'   => 'nullable|string|max:255',
            'is_wide'          => 'nullable|in:0,1',
            'hero_text'        => 'nullable|string',
            'hero_image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            'overview_title'   => 'nullable|string|max:255',
            'overview_text'    => 'nullable|string',
            'overview_image'   => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            'datasheet'        => 'nullable|file|mimes:pdf|max:10240',
            'features'         => 'nullable|array',
            'features.*.title' => 'nullable|string|max:255',
            'features.*.text'  => 'nullable|string',
            'specs'            => 'nullable|array',
            'specs.*.parameter' => 'nullable|string|max:255',
            'specs.*.value'    => 'nullable|string|max:255',
            'specs.*.notes'    => 'nullable|string|max:255',
            'grades_text'      => 'nullable|string',
            'industry_ids'     => 'nullable|array',
            'industry_ids.*'   => 'exists:industries,id',
            'meta_title'       => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'sort_order'       => 'nullable|integer|min:0',
            'status'           => 'required|in:0,1',
        ];
    }

    private function normalizeSlug(Request $request): void
    {
        if ($request->filled('slug')) {
            $request->merge(['slug' => Str::slug($request->input('slug'))]);
        }
    }

    /** Turns the form fields into the JSON columns of the product. */
    private function payload(array $data): array
    {
        $paragraphs = preg_split('/\R{2,}/', trim($data['overview_text'] ?? ''));
        $paragraphs = array_values(array_filter(array_map('trim', $paragraphs)));

        $features = collect($data['features'] ?? [])
            ->filter(fn ($row) => filled($row['title'] ?? null) || filled($row['text'] ?? null))
            ->map(fn ($row) => ['title' => trim($row['title'] ?? ''), 'text' => trim($row['text'] ?? '')])
            ->values()->all();

        $specs = collect($data['specs'] ?? [])
            ->filter(fn ($row) => filled($row['parameter'] ?? null))
            ->map(fn ($row) => [
                'parameter' => trim($row['parameter']),
                'value'     => trim($row['value'] ?? ''),
                'notes'     => trim($row['notes'] ?? ''),
            ])
            ->values()->all();

        $grades = array_values(array_filter(array_map('trim', preg_split('/\R/', $data['grades_text'] ?? ''))));

        unset($data['overview_text'], $data['grades_text'], $data['image'], $data['hero_image'], $data['overview_image'], $data['datasheet']);

        // array_merge so the cleaned lists replace the raw form arrays
        return array_merge($data, [
            'overview' => $paragraphs ?: null,
            'features' => $features ?: null,
            'specs'    => $specs ?: null,
            'grades'   => $grades ?: null,
        ]);
    }

    private function saveFiles(Request $request, array $data, ?Product $product = null): array
    {
        foreach (['image', 'hero_image', 'overview_image', 'datasheet'] as $field) {
            if ($request->hasFile($field)) {
                if ($product) {
                    $this->deleteFile($product->{$field});
                }
                $data[$field] = $this->uploadFile($request->file($field), $this->uploadPath);
            }
        }

        return $data;
    }

    public function store(Request $request)
    {
        $this->normalizeSlug($request);
        $validator = Validator::make($request->all(), $this->rules());

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $data = $this->payload($validator->validated());
        $data['is_wide'] = (bool) ($data['is_wide'] ?? false);
        $data['sort_order'] = $data['sort_order'] ?? 0;
        $data['industry_ids'] = !empty($data['industry_ids']) ? array_map('intval', $data['industry_ids']) : null;
        $data = $this->saveFiles($request, $data);

        Product::create($data);

        return redirect()->route('products.index')->with('toast_success', 'Product created successfully.');
    }

    public function update(Request $request, Product $product)
    {
        $this->normalizeSlug($request);
        $validator = Validator::make($request->all(), $this->rules($product));

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $data = $this->payload($validator->validated());
        $data['is_wide'] = (bool) ($data['is_wide'] ?? false);
        $data['sort_order'] = $data['sort_order'] ?? 0;
        $data['industry_ids'] = !empty($data['industry_ids']) ? array_map('intval', $data['industry_ids']) : null;
        $data = $this->saveFiles($request, $data, $product);

        $product->update($data);

        return redirect()->route('products.index')->with('toast_success', 'Product updated successfully.');
    }

    // Soft delete
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.index')->with('toast_success', 'Product moved to trash.');
    }

    // Restore
    public function restore($id)
    {
        Product::onlyTrashed()->findOrFail($id)->restore();

        return redirect()->route('products.index')->with('toast_success', 'Product restored successfully.');
    }

    // Permanent delete
    public function forceDelete($id)
    {
        $product = Product::withTrashed()->findOrFail($id);

        foreach (['image', 'hero_image', 'overview_image', 'datasheet'] as $field) {
            $this->deleteFile($product->{$field});
        }
        $product->forceDelete();

        return redirect()->route('products.index')->with('toast_success', 'Product permanently deleted.');
    }

    public function updateStatus(Request $request, Product $product)
    {
        $request->validate(['status' => 'required|in:0,1']);

        $product->status = $request->status;
        $product->save();

        return response()->json(['success' => true]);
    }
}
