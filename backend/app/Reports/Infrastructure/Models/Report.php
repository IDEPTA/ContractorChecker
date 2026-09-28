<?php

namespace App\Reports\Infrastructure\Models;

use App\Contractors\Infrastructure\Models\Counterparty;
use App\Shared\Infrastructure\Models\File;
use App\Shared\Infrastructure\Models\User;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Report extends Model
{
    use HasUuids;

    protected $fillable = [
        'name',
        'description',
        'status',
        'created_by',
        'file_id',
        'counterparty_id',
    ];

    public function file()
    {
        return $this->belongsTo(File::class, 'file_id');
    }

    public function counterparty()
    {
        return $this->belongsTo(Counterparty::class, 'counterparty_id');
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
