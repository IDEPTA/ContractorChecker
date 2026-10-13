<?php

namespace App\Contractors\Infrastructure\Repositories;

use App\Contractors\Domain\Repositories\CounterpartyRepositoryInterface;
use App\Contractors\Http\Builders\Filters\CounterpartyFilter;
use App\Contractors\Http\Builders\Sorts\CounterpartySort;
use App\Contractors\Infrastructure\Models\Counterparty;
use Illuminate\Support\Collection;

class CounterpartyRepository implements CounterpartyRepositoryInterface
{
    /**
     * @param CounterpartyFilter|null $filter
     * @param CounterpartySort|null $sort
     *
     * @return Collection
     */
    public function get(
        ?CounterpartyFilter $filter = null,
        ?CounterpartySort $sort = null
    ): Collection {
        $query = Counterparty::query()->with('reports');

        if ($filter !== null) {
            $query->filter($filter);
        }

        if ($sort !== null) {
            $query->sort($sort);
        }

        return $query->get();
    }

    /**
     * @param string $id
     *
     * @return Counterparty
     */
    public function getById(string $id): Counterparty|null
    {
        $contractor = Counterparty::findOrFail($id)
            ->with('reports')
            ->first();

        return $contractor;
    }

    /**
     * @param string $id
     *
     * @return bool
     */
    public function delete(string $id): bool
    {
        $contractor = Counterparty::find($id);

        if ($contractor) {
            $contractor->delete();
            return true;
        }

        return false;
    }
}
