<?php

namespace App\Shared\Traits;

use App\Shared\Http\Builders\QueryFilter;
use Illuminate\Database\Eloquent\Builder;

trait Filterable
{

    public function scopeFilter(Builder $builder, QueryFilter $filter)
    {
        $filter->apply($builder);
    }
}
