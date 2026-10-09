<?php

namespace App\Contractors\Domain\Repositories;

use App\Contractors\Http\Builders\Filters\CounterpartyFilter;
use App\Contractors\Http\Builders\Sorts\CounterpartySort;
use App\Contractors\Infrastructure\Models\Counterparty;
use Illuminate\Support\Collection;

interface CounterpartyRepositoryInterface
{
    public function get(
        ?CounterpartyFilter $filter = null,
        ?CounterpartySort $sort = null
    ): Collection;
    public function getById(string $id): ?Counterparty;
    public function delete(string $id): bool;
}
