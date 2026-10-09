<?php

namespace App\Reports\Domain\Repositories;

use App\Reports\Http\Builders\Filters\ReportFilter;
use App\Reports\Http\Builders\Sorts\ReportSort;
use App\Reports\Infrastructure\Models\Report;
use Illuminate\Support\Collection;

interface ReportRepositoryInterface
{
    public function get(
        ?ReportFilter $filter = null,
        ?ReportSort $sort = null
    ): Collection;
    public function getById(string $id): ?Report;
    public function delete(string $id): bool;
}
