<?php

namespace App\Shared\Infrastructure\Models;

use App\Shared\Infrastructure\Models\User;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class File extends Model
{
    use HasUuids;

    protected $fillable = [
        'disk',
        'path',
        'original_name',
        'mime',
        'size',
        'hash',
        'model_type',
        'model_id',
        'created_by',
    ];

    protected $casts = [
        'size' => 'float',
    ];

    public function model(): MorphTo
    {
        return $this->morphTo();
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function getDisplayName(): string
    {
        return $this->original_name ?? $this->path ?? (string) $this->getKey();
    }
}
