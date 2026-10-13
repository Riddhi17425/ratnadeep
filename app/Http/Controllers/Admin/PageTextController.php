<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Concerns\ManagesFiles;
use App\Http\Controllers\Controller;
use App\Models\PageText;
use Illuminate\Http\Request;

/**
 * Headings, paragraphs, button labels and hero images of the inner pages.
 * Fields + Figma defaults are defined in config/page_texts.php.
 */
class PageTextController extends Controller
{
    use ManagesFiles;

    protected $uploadPath = 'backend/page-texts';

    private function pages(): array
    {
        return config('page_texts');
    }

    public function update(Request $request, string $page)
    {
        abort_unless(isset($this->pages()[$page]), 404);

        $fields = $this->pages()[$page]['fields'];
        $rules = [];

        foreach ($fields as $key => [$label, $type]) {
            $rules[$key] = $type === 'image'
                ? 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096'
                : 'nullable|string|max:5000';
        }

        $request->validate($rules);

        $current = PageText::where('page', $page)->pluck('value', 'key')->all();

        foreach ($fields as $key => [$label, $type, $default]) {
            if ($type === 'image') {
                if ($request->boolean('reset_' . $key)) {
                    $this->deleteFile($current[$key] ?? null);
                    PageText::where('page', $page)->where('key', $key)->delete();
                } elseif ($request->hasFile($key)) {
                    $this->deleteFile($current[$key] ?? null);
                    PageText::updateOrCreate(['page' => $page, 'key' => $key], [
                        'value' => $this->uploadFile($request->file($key), $this->uploadPath),
                    ]);
                }
                continue;
            }

            $value = $request->input($key);

            // Empty or unchanged-from-default fields are not stored, so the Figma default keeps applying.
            if ($value === null || trim($value) === '' || trim(str_replace("\r\n", "\n", $value)) === trim($default)) {
                PageText::where('page', $page)->where('key', $key)->delete();
                continue;
            }

            PageText::updateOrCreate(['page' => $page, 'key' => $key], ['value' => str_replace("\r\n", "\n", $value)]);
        }

        return redirect()->route('page-items.index', ['section' => 'text:' . $page])
            ->with('toast_success', 'Page content saved successfully.');
    }
}
