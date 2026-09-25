<?php

namespace App\Reports\Infrastructure\Models;

use App\Contractors\Infrastructure\Models\Counterparty;
use App\Shared\Infrastructure\Models\File;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

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
}
