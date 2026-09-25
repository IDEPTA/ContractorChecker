<?php

namespace App\Shared\Domain\Events;

interface DomainEvent
{
    public function occurredOn(): \DateTimeImmutable;
}
