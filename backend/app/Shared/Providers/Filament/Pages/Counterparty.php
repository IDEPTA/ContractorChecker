<?php

namespace App\Shared\Providers\Filament\Pages;

use BackedEnum;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Pages\Page;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;

class Counterparty extends Page implements HasForms
{
    use InteractsWithForms;

    protected string $view = 'filament.pages.counterparty';

    public ?array $data = [];

    protected static string|BackedEnum|null $navigationIcon = Heroicon::MagnifyingGlass;

    protected static ?string $navigationLabel = 'Проверка контрагента';

    protected static ?string $modelLabel = 'Проверка контрагента';

    protected static ?string $pluralModelLabel = 'Проверка контрагента';

    public function form(Schema  $schema): Schema
    {
        return $schema
            ->schema([
                TextInput::make('inn')
                    ->label('ИНН')
                    ->placeholder('Введите ИНН')
                    ->required(),
            ])
            ->statePath('data');
    }
}
