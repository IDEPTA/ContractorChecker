<?php

namespace App\Reports\Application\Listeners;

use App\Contractors\Domain\Events\CounterpartyDataFetched;
use App\Reports\Application\Actions\GenerateReport;
use Illuminate\Contracts\Queue\ShouldQueue;

class GenerateReportOnDataFetched
//  implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct(
        private readonly GenerateReport $generateReport
    ) {}

    /**
     * Handle the event.
     */
    public function handle(CounterpartyDataFetched $event): void
    {
        $counterparty = $event->counterparty;
        $this->generateReport->handle($counterparty);
    }
}
