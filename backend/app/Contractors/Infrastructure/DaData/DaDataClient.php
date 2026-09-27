<?php

namespace App\Contractors\Infrastructure\DaData;

use Illuminate\Support\Facades\Http;

class DaDataClient
{
    private string $token;

    public function __construct()
    {
        $this->token = env('DADATA_API_KEY');
    }

    public function find(string $inn): array
    {
        return Http::withHeaders([
            'Authorization' => 'Token ' . $this->token,
            'Accept' => 'application/json',
        ])
            ->post(
                'https://suggestions.dadata.ru/suggestions/api/4_1/rs/findById/party',
                ['query' => $inn],
            )
            ->json();
    }
}
