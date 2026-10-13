<?php

namespace App\Shared\Http\Builders;

use App\Shared\Http\Builders\QueryBuilders;

/**
 * Базовый класс для всех классов сортировки
 */
abstract class QuerySort extends QueryBuilders
{
    protected function fields(): array
    {
        return array_filter(
            array_map('trim', $this->request->json('sort') != null ? $this->request->json('sort') : [])
        );
    }
}
