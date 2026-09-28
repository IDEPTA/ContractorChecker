<?php

namespace App\Contractors\Application\Actions;

use App\Contractors\Application\DTO\CounterpartySearchDto;
use App\Contractors\Infrastructure\DaData\DaDataClient;
use Exception;
use Illuminate\Support\Facades\Log;

final class FindCounterparty
{
    public function __construct(private readonly DaDataClient $daDataClient) {}

    public function handle(string $inn): CounterpartySearchDto|Exception
    {
        try {
            $result = $this->daDataClient->find($inn);

            return CounterpartySearchDto::fromArray($result['suggestions']);
        } catch (Exception $e) {
            Log::error('Ошибка при поиске контрагента: ' . $e->getMessage());

            return new Exception('Ошибка при поиске контрагента: ' . $e->getMessage());
        }
    }
}
