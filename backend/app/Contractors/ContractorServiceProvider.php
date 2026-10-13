<?php

namespace App\Contractors;

use App\Contractors\Domain\Repositories\CounterpartyRepositoryInterface;
use App\Contractors\Infrastructure\Repositories\CounterpartyRepository;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class ContractorServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(
            CounterpartyRepositoryInterface::class,
            CounterpartyRepository::class,
        );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Route::middleware('api')
            ->prefix('api/contractors')
            ->group(__DIR__ . '/Http/routes.php');
    }
}
