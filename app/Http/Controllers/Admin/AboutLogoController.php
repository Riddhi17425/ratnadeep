<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutLogo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class AboutLogoController extends Controller
{
    private const UPLOAD_PATH = 'backend/about-logos';

    public function index()
    {
        $aboutLogos = AboutLogo::withTrashed()->latest()->get();

        return view('admin.about-logos.index', compact('aboutLogos'));
    }

    public function create()
    {
        return view('admin.about-logos.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'alt_image_text' => 'nullable|string|max:255',
            'status' => 'required|in:0,1',
        ]);

        $data['image'] = $this->uploadImage($request);
        AboutLogo::create($data);

        return redirect()->route('about-logos.index')
            ->with('toast_success', 'About page logo created successfully.');
    }

    public function edit(AboutLogo $aboutLogo)
    {
        return view('admin.about-logos.edit', compact('aboutLogo'));
    }

    public function update(Request $request, AboutLogo $aboutLogo)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'alt_image_text' => 'nullable|string|max:255',
            'status' => 'required|in:0,1',
        ]);

        if ($request->hasFile('image')) {
            $this->deleteImage($aboutLogo->image);
            $data['image'] = $this->uploadImage($request);
        }

        $aboutLogo->update($data);

        return redirect()->route('about-logos.index')
            ->with('toast_success', 'About page logo updated successfully.');
    }

    public function destroy(AboutLogo $aboutLogo)
    {
        $aboutLogo->delete();

        return redirect()->route('about-logos.index')
            ->with('toast_success', 'About page logo moved to trash.');
    }

    public function restore($id)
    {
        AboutLogo::onlyTrashed()->findOrFail($id)->restore();

        return redirect()->route('about-logos.index')
            ->with('toast_success', 'About page logo restored successfully.');
    }

    public function forceDelete($id)
    {
        $aboutLogo = AboutLogo::withTrashed()->findOrFail($id);
        $this->deleteImage($aboutLogo->image);
        $aboutLogo->forceDelete();

        return redirect()->route('about-logos.index')
            ->with('toast_success', 'About page logo permanently deleted.');
    }

    private function uploadImage(Request $request): string
    {
        $destination = public_path(self::UPLOAD_PATH);

        if (!File::exists($destination)) {
            File::makeDirectory($destination, 0755, true);
        }

        $file = $request->file('image');
        $fileName = uniqid('', true) . '.' . $file->getClientOriginalExtension();
        $file->move($destination, $fileName);

        return self::UPLOAD_PATH . '/' . $fileName;
    }

    private function deleteImage(?string $imagePath): void
    {
        if ($imagePath && File::exists(public_path($imagePath))) {
            File::delete(public_path($imagePath));
        }
    }
}
