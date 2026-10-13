<?php

namespace App\Reports;

use App\Reports\Domain\Repositories\ReportRepositoryInterface;
use App\Reports\Infrastructure\Repositories\ReportRepository;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class ReportServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(
            ReportRepositoryInterface::class,
            ReportRepository::class,
        );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Route::middleware('api')
            ->prefix('api/reports')
            ->group(__DIR__ . '/Http/routes.php');
    }
}
