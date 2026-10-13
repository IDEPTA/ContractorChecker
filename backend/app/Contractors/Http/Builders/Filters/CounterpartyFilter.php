<?php

namespace App\Contractors\Http\Builders\Filters;

use App\Shared\Http\Builders\QueryFilter;

class CounterpartyFilter extends QueryFilter
{
    public function search_query(string $value): void
    {
        $this->builder->where(function ($query) use ($value) {
            $query->where('inn', 'like', "%{$value}%")
                ->orWhere('ogrn', 'like', "%{$value}%")
                ->orWhere('kpp', 'like', "%{$value}%")
                ->orWhere('full_name', 'like', "%{$value}%")
                ->orWhere('short_name', 'like', "%{$value}%");
        });
    }

    public function status(string $value): void
    {
        $this->builder->where('status', $value);
    }

    public function registration_date(string $value): void
    {
        $this->builder->whereDate('registration_date', $value);
    }

    public function liquidation_date(string $value): void
    {
        $this->builder->whereDate('liquidation_date', $value);
    }

    public function okved_main_code(string $value): void
    {
        $this->builder->where('okved_main_code', 'like', "%{$value}%");
    }
}
