<?php

namespace App\Shared\Application\Services;

use App\Shared\Infrastructure\Models\File;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Database\Eloquent\Model;

class FileService
{
    public function __construct() {}

    public function createFromStoredPath(
        string $path,
        ?Model $model = null,
        ?int $createdBy = null,
        ?string $disk = null,
        ?array $metadata = [],
    ): File {
        $disk ??= config('filesystems.default', 'local');

        $file = new File([
            'disk' => $disk,
            'path' => $path,
            'original_name' => $metadata['original_name'],
            'mime' => $metadata['mime'],
            'size' => $metadata['size'],
            'hash' => $metadata['hash'],
            'model_type' => $model?->getMorphClass(),
            'model_id' => $model?->getKey(),
            'created_by' => $createdBy ?? Auth::id(),
        ]);

        $file->save();

        return $file;
    }
}
