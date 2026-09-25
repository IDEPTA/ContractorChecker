<?php

namespace App\Reports\Listeners;

use App\Events\CounterpartyDataFetched;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class GenerateReportOnDataFetched
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
