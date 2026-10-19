<?php

namespace App\Contractors\Domain\Events;

use App\Contractors\Application\DTO\CounterpartyDto;
use App\Shared\Infrastructure\Models\User;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CounterpartySelected
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(
        public readonly CounterpartyDto $counterparty,
        public readonly User $user,
    ) {}

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('channel-name'),
        ];
    }
}
