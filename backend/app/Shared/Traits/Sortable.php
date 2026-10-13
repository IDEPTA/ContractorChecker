<?php

namespace App\Shared\Traits;

use App\Shared\Http\Builders\QuerySort;
use Illuminate\Database\Eloquent\Builder;

trait Sortable
{

    public function scopeSort(Builder $builder, QuerySort $sort)
    {
        $sort->apply($builder);
    }
}
