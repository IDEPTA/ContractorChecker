<?php

namespace App\Reports\Infrastructure\Repositories;

use App\Reports\Domain\Repositories\ReportRepositoryInterface;
use App\Reports\Http\Builders\Filters\ReportFilter;
use App\Reports\Http\Builders\Sorts\ReportSort;
use App\Reports\Infrastructure\Models\Report;
use Illuminate\Support\Collection;

class ReportRepository implements ReportRepositoryInterface
{
    public function get(
        ?ReportFilter $filter = null,
        ?ReportSort $sort = null
    ): Collection {
        $query = Report::query()->with('file', 'counterparty', 'creator');

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
     * @return Report|null
     */
    public function getById(string $id): Report|null
    {
        $report = Report::findOrFail($id)
            ->with(['file', 'counterparty', 'creator'])
            ->first();

        return $report;
    }

    /**
     * @param string $id
     *
     * @return bool
     */
    public function delete(string $id): bool
    {
        $report = Report::find($id);

        if ($report) {
            $report->delete();

            return true;
        }

        return false;
    }
}
