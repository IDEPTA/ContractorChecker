<?php

namespace App\Reports\Http\Builders\Filters;

use App\Shared\Http\Builders\QueryFilter;

class ReportFilter extends QueryFilter
{
    public function search_query(string $value): void
    {
        $this->builder->where(function ($query) use ($value) {
            $query->where('name', 'like', "%{$value}%")
                ->orWhere('description', 'like', "%{$value}%");
        });
    }

    public function status(string $value): void
    {
        $this->builder->where('status', $value);
    }
}
