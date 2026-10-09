<?php

namespace App\Shared\Http\Builders;

use App\Shared\Http\Builders\QueryBuilders;

/**
 * Базовый класс для всех классов фильтрации
 */
abstract class QueryFilter extends QueryBuilders
{
    protected function fields(): array
    {
        $filters = $this->request->json('filter') ?? [];
        return array_filter($filters, function ($value) {
            return $value !== null;
        });
    }
}
