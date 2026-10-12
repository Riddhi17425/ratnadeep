<?php

namespace App\Http\Controllers\Admin\Concerns;

use Illuminate\Support\Facades\File;

/**
 * Same upload helpers the other admin controllers use (files go to public/backend/<folder>).
 * deleteFile() only ever removes files inside public/backend, so the theme assets that are
 * used as defaults (public/frontend/...) can never be deleted from the admin.
 */
trait ManagesFiles
{
    protected function uploadFile($file, string $folder): string
    {
        $destinationPath = public_path($folder);

        if (!File::exists($destinationPath)) {
            File::makeDirectory($destinationPath, 0755, true);
        }

        $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
        $file->move($destinationPath, $fileName);

        return $folder . '/' . $fileName;
    }

    protected function deleteFile(?string $path): void
    {
        if ($path && str_starts_with($path, 'backend/') && File::exists(public_path($path))) {
            File::delete(public_path($path));
        }
    }
}
