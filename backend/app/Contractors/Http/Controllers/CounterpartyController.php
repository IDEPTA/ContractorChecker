<?php

namespace App\Contractors\Http\Controllers;

use App\Contractors\Domain\Repositories\CounterpartyRepositoryInterface;
use App\Contractors\Http\Builders\Filters\CounterpartyFilter;
use App\Contractors\Http\Builders\Sorts\CounterpartySort;
use App\Shared\Http\Resources\ErrorResource;
use Exception;
use Illuminate\Http\JsonResponse;

class CounterpartyController
{
    public function __construct(
        private readonly  CounterpartyRepositoryInterface $counterpartyRepository
    ) {}

    /**
     * @param CounterpartyFilter $filter
     * @param CounterpartySort $sort
     *
     * @return JsonResponse
     * @throws ErrorResource
     */
    public function get(
        CounterpartyFilter $filter,
        CounterpartySort $sort
    ): JsonResponse|ErrorResource {
        try {
            $counterparty = $this->counterpartyRepository->get($filter, $sort);

            return response()->json($counterparty);
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
            $counterparty = $this->counterpartyRepository->getById($id);

            return response()->json($counterparty);
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
            $deleted = $this->counterpartyRepository->delete($id);

            return response()->json(['deleted' => $deleted]);
        } catch (Exception $e) {
            return new ErrorResource($e);
        }
    }
}
