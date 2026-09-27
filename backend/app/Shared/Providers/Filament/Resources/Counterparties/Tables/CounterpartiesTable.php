<?php

namespace App\Shared\Providers\Filament\Resources\Counterparties\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class CounterpartiesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('inn')->label('ИНН'),
                TextColumn::make('ogrn')->label('ОГРН'),
                TextColumn::make('short_name')->label('Краткое наименование'),
                TextColumn::make('status')->label('Статус'),
                TextColumn::make('registration_date')->label('Дата регистрации'),
                TextColumn::make('liquidation_date')->label('Дата ликвидации'),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
