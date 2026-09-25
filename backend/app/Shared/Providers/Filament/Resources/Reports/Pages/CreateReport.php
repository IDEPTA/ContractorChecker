<?php

namespace App\Shared\Providers\Filament\Resources\Reports\Pages;

use App\Shared\Providers\Filament\Resources\Reports\ReportResource;
use Filament\Resources\Pages\CreateRecord;

class CreateReport extends CreateRecord
{
    protected static string $resource = ReportResource::class;
}
