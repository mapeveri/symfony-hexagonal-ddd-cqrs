<?php

declare(strict_types=1);

namespace App\Shared\Domain\Criteria;

final class Criteria
{
    private Order $order;

    public function __construct(
        private Filters $filters,
        ?Order $order,
    ) {
        $this->order = null === $order ? Order::none() : $order;
    }

    public function hasFilters(): bool
    {
        return $this->filters->count() > 0;
    }

    public function hasOrder(): bool
    {
        return !$this->order->isNone();
    }

    public function plainFilters(): array
    {
        return $this->filters->filters();
    }

    public function filters(): Filters
    {
        return $this->filters;
    }

    public function order(): Order
    {
        return $this->order;
    }

    public function serialize(): string
    {
        return sprintf(
            '%s~~%s~~',
            $this->filters->serialize(),
            $this->order->serialize(),
        );
    }
}