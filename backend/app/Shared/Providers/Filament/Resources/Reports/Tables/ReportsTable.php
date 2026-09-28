<?php

namespace App\Shared\Providers\Filament\Resources\Reports\Tables;

use App\Shared\Providers\Filament\Resources\Counterparties\CounterpartyResource;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Support\Enums\FontWeight;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ReportsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Название')
                    ->weight(FontWeight::Medium)
                    ->searchable()
                    ->sortable(),

                TextColumn::make('description')
                    ->label('Описание')
                    ->limit(60)
                    ->tooltip(fn($state) => $state)
                    ->color('gray'),

                TextColumn::make('status')
                    ->label('Статус')
                    ->badge()
                    ->formatStateUsing(fn(string $state): string => match ($state) {
                        'processing' => 'Обрабатывается',
                        'completed' => 'Готов',
                        'failed' => 'Ошибка',
                        default => $state,
                    })
                    ->color(fn(string $state): string => match ($state) {
                        'processing' => 'warning',
                        'completed' => 'success',
                        'failed' => 'danger',
                        default => 'gray',
                    })
                    ->icon(fn(string $state): string => match ($state) {
                        'processing' => 'heroicon-m-arrow-path',
                        'completed' => 'heroicon-m-check-circle',
                        'failed' => 'heroicon-m-x-circle',
                        default => 'heroicon-m-question-mark-circle',
                    }),

                TextColumn::make('creator.name')
                    ->label('Создатель')
                    ->icon('heroicon-m-user')
                    ->color('gray')
                    ->weight(FontWeight::Medium),

                TextColumn::make('counterparty.short_name')
                    ->label('Контрагент')
                    ->url(fn($record) => CounterpartyResource::getUrl(
                        'view',
                        ['record' => $record->counterparty_id],
                    ))
                    ->color('primary')
                    ->weight(FontWeight::Medium)
                    ->icon('heroicon-m-building-office-2')
                    ->tooltip('Открыть контрагента'),
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
