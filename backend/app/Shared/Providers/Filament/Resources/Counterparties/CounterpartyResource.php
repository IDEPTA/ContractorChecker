<?php

namespace App\Shared\Providers\Filament\Resources\Counterparties;

use App\Contractors\Infrastructure\Models\Counterparty;
use App\Shared\Providers\Filament\Resources\Counterparties\Pages\CreateCounterparty;
use App\Shared\Providers\Filament\Resources\Counterparties\Pages\EditCounterparty;
use App\Shared\Providers\Filament\Resources\Counterparties\Pages\ListCounterparties;
use App\Shared\Providers\Filament\Resources\Counterparties\Pages\ViewCounterparty;
use App\Shared\Providers\Filament\Resources\Counterparties\Schemas\CounterpartyForm;
use App\Shared\Providers\Filament\Resources\Counterparties\Schemas\CounterpartyInfolist;
use App\Shared\Providers\Filament\Resources\Counterparties\Tables\CounterpartiesTable;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class CounterpartyResource extends Resource
{
    protected static ?string $model = Counterparty::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::ChartBar;

    protected static ?string $recordTitleAttribute = 'inn';

    protected static ?string $navigationLabel = 'Снапшоты контрагентов';

    protected static ?string $modelLabel = 'Снапшоты контрагентов';

    protected static ?string $pluralModelLabel = 'Снапшоты контрагентов';

    public static function form(Schema $schema): Schema
    {
        return CounterpartyForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return CounterpartyInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CounterpartiesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListCounterparties::route('/'),
            'create' => CreateCounterparty::route('/create'),
            'view' => ViewCounterparty::route('/{record}'),
            'edit' => EditCounterparty::route('/{record}/edit'),
        ];
    }
}
