<?php

use Illuminate\Support\Facades\Storage;

if (! function_exists('storage_url')) {
    function storage_url(?string $path): string
    {
        if (! $path) {
            return '';
        }

        if (str_starts_with($path, 'http')) {
            return $path;
        }

        $disk = env('FILESYSTEM_DISK', 'public');

        if ($disk === 'public') {
            return asset('storage/'.$path);
        }

        return Storage::disk($disk)->url($path);
    }
}

if (! function_exists('storage_url_base')) {
    function storage_url_base(): string
    {
        $disk = env('FILESYSTEM_DISK', 'public');

        if ($disk === 'public') {
            return rtrim(asset('storage'), '/').'/';
        }

        $test = Storage::disk($disk)->url('.urlbase');

        return str_replace('.urlbase', '', $test);
    }
}
