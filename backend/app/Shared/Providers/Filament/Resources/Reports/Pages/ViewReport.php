<?php

namespace App\Shared\Providers\Filament\Resources\Reports\Pages;

use App\Shared\Providers\Filament\Resources\Reports\ReportResource;
use Filament\Actions\Action;
use Filament\Actions\EditAction;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Pages\ViewRecord;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Enums\FontWeight;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\HtmlString;

class ViewReport extends ViewRecord
{
    protected static string $resource = ReportResource::class;

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
                Section::make('Отчёт')
                    ->schema([
                        TextEntry::make('name')
                            ->label('Название')
                            ->weight(FontWeight::Bold)
                            ->columnSpanFull(),

                        TextEntry::make('description')
                            ->label('Описание')
                            ->placeholder('Не указано')
                            ->columnSpanFull(),

                        TextEntry::make('status')
                            ->label('Статус')
                            ->badge()
                            ->formatStateUsing(fn(?string $state): string => match ($state) {
                                'processing' => 'Обрабатывается',
                                'completed' => 'Готов',
                                'failed' => 'Ошибка',
                                default => $state ?? 'Не указан',
                            })
                            ->color(fn(?string $state): string => match ($state) {
                                'processing' => 'warning',
                                'completed' => 'success',
                                'failed' => 'danger',
                                default => 'gray',
                            }),
                    ])
                    ->columns(2),

                Section::make('Контрагент')
                    ->schema([
                        TextEntry::make('counterparty.short_name')
                            ->label('Наименование')
                            ->weight(FontWeight::Medium),

                        TextEntry::make('counterparty.inn')
                            ->label('ИНН')
                            ->copyable(),

                        TextEntry::make('counterparty.ogrn')
                            ->label('ОГРН')
                            ->copyable(),

                        TextEntry::make('counterparty.status')
                            ->label('Статус контрагента')
                            ->badge(),
                    ])
                    ->columns(2),

                Section::make('Файл')
                    ->schema([
                        TextEntry::make('file.original_name')
                            ->label('Файл')
                            ->weight(FontWeight::Medium)
                            ->placeholder('Файл отсутствует'),

                        TextEntry::make('file.size')
                            ->label('Размер')
                            ->formatStateUsing(
                                fn($state): string => $state
                                    ? number_format($state / 1024, 1, ',', ' ') . ' КБ'
                                    : '—'
                            ),

                        TextEntry::make('file.mime')
                            ->label('Тип')
                            ->placeholder('—'),

                        TextEntry::make('file.disk')
                            ->label('Хранилище')
                            ->placeholder('—'),

                        TextEntry::make('file.original_name')
                            ->hiddenLabel()
                            ->suffixActions([
                                Action::make('preview')
                                    ->label('Просмотр')
                                    ->icon('heroicon-o-eye')
                                    ->color('primary')
                                    ->modalHeading('Предпросмотр отчёта')
                                    ->modalWidth('7xl')
                                    ->modalSubmitAction(false)
                                    ->modalCancelActionLabel('Закрыть')
                                    ->modalContent(function ($record) {
                                        $url = route('reports.file.preview', $record);

                                        return new HtmlString(
                                            '<iframe
            src="' . e($url) . '"
            style="width: 100%; height: 75vh; border: 0;"
            title="Предпросмотр отчёта"
        ></iframe>'
                                        );
                                    }),

                                Action::make('download')
                                    ->label('Скачать')
                                    ->icon('heroicon-o-arrow-down-tray')
                                    ->color('gray')
                                    ->url(fn($record) => route(
                                        'reports.file.download',
                                        $record,
                                    ))
                                    ->openUrlInNewTab(false),
                            ])
                            ->columnSpanFull(),
                    ])
                    ->columns(2),

                Section::make('Служебная информация')
                    ->schema([
                        TextEntry::make('creator.name')
                            ->label('Создатель')
                            ->placeholder('—'),

                        TextEntry::make('created_at')
                            ->label('Создан')
                            ->dateTime('d.m.Y H:i'),

                        TextEntry::make('updated_at')
                            ->label('Обновлён')
                            ->dateTime('d.m.Y H:i'),
                    ])
                    ->columns(3),
            ]);
    }
}
