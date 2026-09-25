<?php

namespace App\Notifications\Listeners;

use App\Events\ReportGenerated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NotifyUserOnReportGenerated
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
    public function handle(ReportGenerated $event): void
    {
        //
    }
}
