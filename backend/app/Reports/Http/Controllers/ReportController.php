<?php

namespace App\Reports\Http\Controllers;

use App\Reports\Domain\Repositories\ReportRepositoryInterface;
use App\Reports\Http\Builders\Filters\ReportFilter;
use App\Reports\Http\Builders\Sorts\ReportSort;
use App\Shared\Http\Resources\ErrorResource;
use Exception;
use Illuminate\Http\JsonResponse;

class ReportController
{
    public function __construct(
        private readonly ReportRepositoryInterface $reportRepository
    ) {}

    /**
     * @param ReportFilter $filter
     * @param ReportSort $sort
     *
     * @return JsonResponse
     * @throws ErrorResource
     */
    public function get(
        ReportFilter $filter,
        ReportSort $sort
    ): JsonResponse|ErrorResource {
        try {
            $report = $this->reportRepository->get($filter, $sort);

            return response()->json($report);
        } catch (Exception $e) {
            return new ErrorResource($e);
        }
    }

    /**
     * @param string $id
     *
     * @return JsonResponse
     * @throws ErrorResource
     */
    public function getById(string $id): JsonResponse|ErrorResource
    {
        try {
            $report = $this->reportRepository->getById($id);

            return response()->json($report);
        } catch (Exception $e) {
            return new ErrorResource($e);
        }
    }

    /**
     * @param string $id
     *
     * @return JsonResponse
     * @throws ErrorResource
     */
    public function delete(string $id): JsonResponse|ErrorResource
    {
        try {
            $report = $this->reportRepository->delete($id);

            return response()->json(['success' => $report]);
        } catch (Exception $e) {
            return new ErrorResource($e);
        }
    }
}
