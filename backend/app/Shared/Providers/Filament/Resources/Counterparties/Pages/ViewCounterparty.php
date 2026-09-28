<?php

namespace App\Shared\Providers\Filament\Resources\Counterparties\Pages;

use App\Shared\Providers\Filament\Resources\Counterparties\CounterpartyResource;
use Filament\Actions\EditAction;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Pages\ViewRecord;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Enums\FontWeight;

class ViewCounterparty extends ViewRecord
{
    protected static string $resource = CounterpartyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }

    public function infolist(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Основная информация')
                    ->schema([
                        TextEntry::make('short_name')
                            ->label('Краткое наименование')
                            ->weight(FontWeight::Bold)
                            ->columnSpanFull(),

                        TextEntry::make('full_name')
                            ->label('Полное наименование')
                            ->columnSpanFull(),

                        TextEntry::make('inn')
                            ->label('ИНН')
                            ->copyable(),

                        TextEntry::make('ogrn')
                            ->label('ОГРН')
                            ->copyable(),

                        TextEntry::make('kpp')
                            ->label('КПП')
                            ->copyable(),
                    ])
                    ->columns(3),

                Section::make('Статус и регистрация')
                    ->schema([
                        TextEntry::make('status')
                            ->label('Статус')
                            ->badge()
                            ->formatStateUsing(fn(?string $state): string => match ($state) {
                                'ACTIVE' => 'Действует',
                                'LIQUIDATING' => 'Ликвидируется',
                                'LIQUIDATED' => 'Ликвидирован',
                                'REORGANIZING' => 'Реорганизация',
                                default => $state ?? 'Не указан',
                            })
                            ->color(fn(?string $state): string => match ($state) {
                                'ACTIVE' => 'success',
                                'LIQUIDATING', 'REORGANIZING' => 'warning',
                                'LIQUIDATED' => 'danger',
                                default => 'gray',
                            }),

                        TextEntry::make('registration_date')
                            ->label('Дата регистрации')
                            ->date('d.m.Y'),

                        TextEntry::make('liquidation_date')
                            ->label('Дата ликвидации')
                            ->date('d.m.Y')
                            ->placeholder('Не ликвидирована'),
                    ])
                    ->columns(3),

                Section::make('Адрес')
                    ->schema([
                        TextEntry::make('address')
                            ->label('Юридический адрес')
                            ->placeholder('Не указан')
                            ->columnSpanFull(),
                    ]),

                Section::make('Деятельность')
                    ->schema([
                        TextEntry::make('okved')
                            ->label('Основной ОКВЭД')
                            ->placeholder('Не указан'),

                        TextEntry::make('employees')
                            ->label('Количество сотрудников')
                            ->placeholder('Не указано'),
                    ])
                    ->columns(2),

                Section::make('Контакты')
                    ->schema([
                        TextEntry::make('phones')
                            ->label('Телефоны')
                            ->placeholder('Не указаны'),

                        TextEntry::make('emails')
                            ->label('Email')
                            ->placeholder('Не указаны'),

                        TextEntry::make('websites')
                            ->label('Сайты')
                            ->placeholder('Не указаны'),
                    ])
                    ->columns(3),

                Section::make('Руководители')
                    ->schema([
                        TextEntry::make('managers')
                            ->label('Руководители')
                            ->placeholder('Не указаны')
                            ->columnSpanFull(),
                    ]),

                Section::make('Учредители')
                    ->schema([
                        TextEntry::make('founders')
                            ->label('Учредители')
                            ->placeholder('Не указаны')
                            ->columnSpanFull(),
                    ]),
            ]);
    }
}
