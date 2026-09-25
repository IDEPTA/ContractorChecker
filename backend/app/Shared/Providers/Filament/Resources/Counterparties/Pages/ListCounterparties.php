<?php

namespace App\Shared\Providers\Filament\Resources\Counterparties\Pages;

use App\Shared\Providers\Filament\Resources\Counterparties\CounterpartyResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListCounterparties extends ListRecords
{
    protected static string $resource = CounterpartyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
