<?php

namespace App\Shared\Providers\Filament\Resources\Counterparties\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Support\Enums\FontWeight;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class CounterpartiesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('inn')
                    ->label('ИНН')
                    ->copyable()
                    ->copyMessage('ИНН скопирован')
                    ->fontFamily('mono')
                    ->weight(FontWeight::Medium)
                    ->sortable(),

                TextColumn::make('ogrn')
                    ->label('ОГРН')
                    ->copyable()
                    ->copyMessage('ОГРН скопирован')
                    ->fontFamily('mono')
                    ->weight(FontWeight::Medium)
                    ->sortable(),

                TextColumn::make('short_name')
                    ->label('Краткое наименование')
                    ->weight(FontWeight::Medium)
                    ->searchable()
                    ->sortable()
                    ->limit(40)
                    ->tooltip(fn($state) => $state),

                TextColumn::make('status')
                    ->label('Статус')
                    ->badge()
                    ->formatStateUsing(fn(string $state): string => match ($state) {
                        'ACTIVE' => 'Действует',
                        'LIQUIDATING' => 'Ликвидируется',
                        'LIQUIDATED' => 'Ликвидирован',
                        'REORGANIZING' => 'Реорганизация',
                        default => $state,
                    })
                    ->color(fn(string $state): string => match ($state) {
                        'ACTIVE' => 'success',
                        'LIQUIDATING', 'REORGANIZING' => 'warning',
                        'LIQUIDATED' => 'danger',
                        default => 'gray',
                    }),

                TextColumn::make('registration_date')
                    ->label('Дата регистрации')
                    ->date('d.m.Y')
                    ->icon('heroicon-m-calendar-days')
                    ->color('gray')
                    ->sortable(),

                TextColumn::make('liquidation_date')
                    ->label('Дата ликвидации')
                    ->date('d.m.Y')
                    ->icon('heroicon-m-calendar-days')
                    ->color('gray')
                    ->placeholder('—')
                    ->sortable(),
            ])
            ->filters([])
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
