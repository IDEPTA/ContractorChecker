<?php

namespace App\Shared\Providers\Filament\Pages;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Pages\Page;
use Filament\Schemas\Schema;

class Counterparty extends Page implements HasForms
{
    use InteractsWithForms;

    protected string $view = 'filament.pages.counterparty';

    public ?array $data = [];

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
