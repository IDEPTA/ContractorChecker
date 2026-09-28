<?php

namespace App\Contractors\Application\DTO;

use App\Contractors\Application\DTO\CounterpartyDto;

final readonly class CounterpartySearchDto
{
    /**
     * @param CounterpartyDto[] $items
     */
    public function __construct(
        public array $items,
    ) {}

    public static function fromArray(array $suggestions): self
    {
        $items = array_map(
            fn(array $suggestion) => CounterpartyDto::fromArray(
                $suggestion['data'] ?? []
            ),
            $suggestions
        );

        return new self($items);
    }
}
