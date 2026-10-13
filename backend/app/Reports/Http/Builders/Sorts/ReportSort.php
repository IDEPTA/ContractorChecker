<?php

namespace App\Reports\Http\Builders\Sorts;

use App\Shared\Http\Builders\QuerySort;

class ReportSort extends QuerySort
{
    public function created_at(string $value): void
    {
        $this->builder->orderBy('created_at', $value);
    }

    public function name(string $value): void
    {
        $this->builder->orderBy('name', $value);
    }

    public function status(string $value): void
    {
        $this->builder->orderBy('status', $value);
    }
}
