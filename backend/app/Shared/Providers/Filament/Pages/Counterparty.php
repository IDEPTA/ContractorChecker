<?php

namespace App\Shared\Providers\Filament\Pages;

use App\Contractors\Application\Actions\FindCounterparty;
use App\Contractors\Domain\Events\CounterpartySelected;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;

class Counterparty extends Page implements HasForms
{
    use InteractsWithForms;

    protected string $view = 'filament.pages.counterparty';

    public ?array $data = [];

    /** @var CounterpartyDto[] */
    public array $counterparties = [];

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

    protected function getHeaderActions(): array
    {
        return [
            Action::make('find')
                ->label('Найти')
                ->icon(Heroicon::MagnifyingGlass)
                ->action(function () {
                    $this->validate();

                    $inn = $this->data['inn'];

                    // Application Action
                    $result = app(FindCounterparty::class)
                        ->handle($inn);
                    $this->counterparties = $result->items;
                }),
        ];
    }

    public function selectCounterparty(int $index): void
    {
        $counterparty = $this->counterparties[$index];

        CounterpartySelected::dispatch($counterparty);

        unset($this->counterparties[$index]);
        $this->counterparties = array_values($this->counterparties);

        Notification::make()
            ->title('Контрагент выбран')
            ->body('Контрагент отправлен на сохранение.')
            ->success()
            ->send();
    }
}
