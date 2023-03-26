<?php

declare(strict_types=1);

namespace App\Shared\Domain\ValueObjects;

use App\Shared\Domain\Exceptions\ArrayIsImmutable;
use ArrayAccess;
use Countable;
use IteratorAggregate;
use SplFixedArray;

abstract class ImmutableArray extends SplFixedArray implements Countable, IteratorAggregate, ArrayAccess
{
    public function __construct(array $items)
    {
        parent::__construct(count($items));
        $i = 0;
        foreach($items as $item) {
            $this->guardType($item);
            parent::offsetSet($i++, $item);
        }
    }

    abstract protected function guardType($item);

    final public function count(): int
    {
        return parent::count();
    }

    final public function current()
    {
        return parent::current();
    }

    final public function key(): int
    {
        return parent::key();
    }

    final public function next(): void
    {
        parent::next();
    }

    final public function rewind(): void
    {
        parent::rewind();
    }

    final public function valid(): bool
    {
        return parent::valid();
    }

    final public function offsetExists(mixed $offset): mixed
    {
        return parent::offsetExists($offset);
    }

    final public function offsetGet(mixed $offset): mixed
    {
        return parent::offsetGet($offset);
    }

    final public function offsetSet(mixed $offset, mixed $value): void
    {
        throw new ArrayIsImmutable();
    }

    final public function offsetUnset(mixed $offset): void
    {
        throw new ArrayIsImmutable();
    }
}
