<?php

namespace App\Shared\Providers\Filament\Resources\Counterparties\Tables;

use App\Contractors\Domain\Events\CounterpartyDataFetched;
use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Notifications\Notification;
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
                ActionGroup::make([
                    ViewAction::make(),
                    EditAction::make(),
                    Action::make('generate')
                        ->label('Сгенерировать PDF')
                        ->action(function ($record) {
                            if ($record->reports->count() === 0) {
                                $user = auth()->user();
                                // TODO создать новый слушатель и эвент, чтобы не нарушать бизнес логику
                                CounterpartyDataFetched::dispatch($record, $user);

                                Notification::make()
                                    ->title('Формирование отчетов запущенно')
                                    ->body('Готовый отчет появиться в соответствующем разделе')
                                    ->success()
                                    ->send();
                            } else {
                                Notification::make()
                                    ->title('Отчет уже сформирован')
                                    ->danger()
                                    ->send();
                            }
                        })
                        ->icon('heroicon-m-document-text'),
                ]),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
