<?php

namespace App\Contractors\Domain\Services;

use App\Contractors\Infrastructure\Ai\CounterpartyDescriptionAgent;
use App\Contractors\Infrastructure\Models\Counterparty;
use Laravel\Ai\Enums\Lab;

final class GenerateCounterpartyDescription
{
    public function handle(Counterparty $counterparty): string
    {
        $data = $counterparty->raw_data;
        $response = (new CounterpartyDescriptionAgent())->prompt(
            'Данные контрагента:' . PHP_EOL .
                json_encode(
                    $data,
                    JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT
                ),
            provider: Lab::Gemini,
            model: 'gemini-3.8-flash',
            timeout: 60,
        );

        return trim($response->text);
    }
}
