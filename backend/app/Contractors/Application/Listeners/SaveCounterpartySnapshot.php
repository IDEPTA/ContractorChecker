<?php

namespace App\Contractors\Application\Listeners;

use App\Contractors\Domain\Events\CounterpartyDataFetched;
use App\Contractors\Domain\Events\CounterpartySelected;
use App\Contractors\Infrastructure\Models\Counterparty;
use Exception;
use Illuminate\Contracts\Queue\ShouldQueue;
use RuntimeException;

final class SaveCounterpartySnapshot
// implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct() {}

    public function handle(CounterpartySelected $event): void
    {
        try {
            $counterparty = Counterparty::create([
                'inn' => $event->counterparty->inn,
                'ogrn' => $event->counterparty->ogrn,
                'kpp' => $event->counterparty->kpp,
                'full_name' => $event->counterparty->fullName,
                'short_name' => $event->counterparty->shortName,
                'status' => $event->counterparty->status,
                'registration_date' => $event->counterparty->registrationDate,
                'liquidation_date' => $event->counterparty->liquidationDate,
                'address' => $event->counterparty->address,
                'okved_main_code' => $event->counterparty->okvedMainCode,
                'okved_main_name' => $event->counterparty->okvedMainName,
                'employees_count' => $event->counterparty->employeesCount,
                'founders' => $event->counterparty->founders,
                'managers' => $event->counterparty->managers,
                'okveds' => $event->counterparty->okveds,
                'phones' => $event->counterparty->phones,
                'emails' => $event->counterparty->emails,
                'websites' => $event->counterparty->websites,
            ]);

            CounterpartyDataFetched::dispatch($counterparty);
        } catch (Exception $e) {
            if ($e->getCode() === '23505') {
                throw new RuntimeException('Такой контрагент уже существует.', previous: $e);
            }

            throw $e;
        }
    }
}
