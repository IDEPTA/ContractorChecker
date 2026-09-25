<?php

namespace App\Shared\Providers\Filament\Resources\Counterparties\Pages;

use App\Shared\Providers\Filament\Resources\Counterparties\CounterpartyResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewCounterparty extends ViewRecord
{
    protected static string $resource = CounterpartyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
