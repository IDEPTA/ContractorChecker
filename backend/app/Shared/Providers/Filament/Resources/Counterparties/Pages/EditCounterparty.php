<?php

namespace App\Shared\Providers\Filament\Resources\Counterparties\Pages;

use App\Shared\Providers\Filament\Resources\Counterparties\CounterpartyResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditCounterparty extends EditRecord
{
    protected static string $resource = CounterpartyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
