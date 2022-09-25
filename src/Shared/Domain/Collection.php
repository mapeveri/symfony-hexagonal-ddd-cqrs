<?php

declare(strict_types=1);

namespace App\Shared\Domain;

use ArrayIterator;
use Countable;
use IteratorAggregate;
use Closure;

abstract class Collection implements Countable, IteratorAggregate
{
    public function __construct(private array $items)
    {
        Assert::arrayOf($this->type(), $items);
    }

    abstract protected function type(): string;

    public function getIterator(): ArrayIterator
    {
        return new ArrayIterator($this->items());
    }

    public function count(): int
    {
        return count($this->items());
    }

    public function items(): array
    {
        return $this->items;
    }

    public function map(Closure $func): array
    {
        return array_map($func, $this->items);
    }

    public function reduce(Closure $func, mixed $initial): mixed
    {
        return array_reduce($this->items, $func, $initial);
    }

    public function first(): mixed
    {
        return reset($this->items);
    }

    public function addItem(mixed $item): void
    {
        Assert::instanceOf($this->type(), $item);
        $this->items[] = $item;
    }
}