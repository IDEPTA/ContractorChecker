<?php

use App\Contractors\ContractorServiceProvider;
use App\Reports\ReportServiceProvider;

return [
    ContractorServiceProvider::class,
    ReportServiceProvider::class,
    App\Shared\Providers\AppServiceProvider::class,
    App\Shared\Providers\Filament\AdminPanelProvider::class,
];
