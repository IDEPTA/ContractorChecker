<?php

namespace App\Reports\Application\Listeners;

use App\Contractors\Domain\Events\CounterpartyDataFetched;
use Illuminate\Contracts\Queue\ShouldQueue;

class GenerateReportOnDataFetched implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(CounterpartyDataFetched $event): void
    {
        //
    }
}
