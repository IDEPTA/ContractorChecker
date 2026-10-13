<?php

namespace App\Contractors\Application\Actions;

use App\Contractors\Application\DTO\CounterpartySearchDto;
use App\Contractors\Infrastructure\DaData\DaDataClient;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;

final class FindCounterparty
{
    public function __construct(private readonly DaDataClient $daDataClient) {}

    public function handle(string $inn): CounterpartySearchDto|Exception
    {
        try {
            if (Redis::exists($inn)) {
                $cachedResult = Redis::get($inn);

                return CounterpartySearchDto::fromArray(json_decode($cachedResult, true));
            } else {
                $result = $this->daDataClient->find($inn);
                Redis::set($inn, json_encode($result['suggestions']), 86400);

                return CounterpartySearchDto::fromArray($result['suggestions']);
            }
        } catch (Exception $e) {
            Log::error('Ошибка при поиске контрагента: ' . $e->getMessage());

            return new Exception('Ошибка при поиске контрагента: ' . $e->getMessage());
        }
    }
}
