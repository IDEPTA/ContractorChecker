<?php

namespace App\Shared\Infrastructure\Services;

use Illuminate\Support\Facades\Storage;
use RuntimeException;

class FileStorage
{
    public function put(
        string $path,
        ?string $contents = '',
        array $meta = [],
        ?string $disk = null
    ): string {
        $disk ??= config('filesystems.default', 'local');

        $uploaded = Storage::disk($disk)->put(
            $path,
            $contents,
            [
                'visibility' => 'private',
                'Metadata' => $meta
            ]
        );

        if ($uploaded === false) {
            throw new RuntimeException("Не удалось загрузить файл {$path} на диск {$disk}.");
        }

        return $path;
    }
}
