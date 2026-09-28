<?php

namespace App\Shared\Providers\Filament\Resources\Reports;

use App\Shared\Providers\Filament\Resources\Reports\Pages\CreateReport;
use App\Shared\Providers\Filament\Resources\Reports\Pages\EditReport;
use App\Shared\Providers\Filament\Resources\Reports\Pages\ListReports;
use App\Shared\Providers\Filament\Resources\Reports\Pages\ViewReport;
use App\Shared\Providers\Filament\Resources\Reports\Schemas\ReportForm;
use App\Shared\Providers\Filament\Resources\Reports\Schemas\ReportInfolist;
use App\Shared\Providers\Filament\Resources\Reports\Tables\ReportsTable;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use App\Reports\Infrastructure\Models\Report;

class ReportResource extends Resource
{
    protected static ?string $model = Report::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::DocumentText;

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $navigationLabel = 'Отчеты';

    protected static ?string $modelLabel = 'Отчеты';

    protected static ?string $pluralModelLabel = 'Отчеты';

    public static function form(Schema $schema): Schema
    {
        return ReportForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return ReportInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ReportsTable::configure($table);
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
            'index' => ListReports::route('/'),
            'create' => CreateReport::route('/create'),
            'view' => ViewReport::route('/{record}'),
            'edit' => EditReport::route('/{record}/edit'),
        ];
    }
}
