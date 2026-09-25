<?php

namespace App\Shared\Providers\Filament\Resources\Counterparties\Pages;

use App\Shared\Providers\Filament\Resources\Counterparties\CounterpartyResource;
use Filament\Resources\Pages\CreateRecord;

class CreateCounterparty extends CreateRecord
{
    protected static string $resource = CounterpartyResource::class;
}
