<?php

declare(strict_types=1);

namespace App\Shared\Domain\Exceptions;

use BadMethodCallException;

final class ArrayIsImmutable extends BadMethodCallException
{

}
