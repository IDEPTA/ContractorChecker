<?php

namespace App\Contractors\Infrastructure\Models;

use App\Reports\Infrastructure\Models\Report;
use App\Shared\Traits\Filterable;
use App\Shared\Traits\Sortable;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Counterparty extends Model
{
    use HasUuids, Filterable, Sortable;

    protected $fillable = [
        'inn',
        'ogrn',
        'kpp',
        'full_name',
        'short_name',
        'status',
        'registration_date',
        'liquidation_date',
        'address',
        'okved_main_code',
        'okved_main_name',
        'employees_count',

        'founders',
        'managers',
        'okveds',
        'phones',
        'emails',
        'websites',
    ];

    protected $casts = [
        'registration_date' => 'datetime',
        'liquidation_date' => 'datetime',
        'employees_count' => 'integer',
        'founders' => 'array',
        'managers' => 'array',
        'okveds' => 'array',
        'phones' => 'array',
        'emails' => 'array',
        'websites' => 'array',
    ];

    public function reports()
    {
        return $this->hasMany(Report::class, 'counterparty_id');
    }
}
