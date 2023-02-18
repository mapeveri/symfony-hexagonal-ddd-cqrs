<?php

declare(strict_types=1);

namespace App\Magazine\User\Application\Query\Find;

use App\Magazine\User\Domain\Services\UserFinder;
use App\Magazine\User\Domain\User;
use App\Magazine\User\Domain\ValueObjects\UserId;
use App\Shared\Domain\Bus\Query\QueryHandler;

final class UserFinderQueryHandler implements QueryHandler
{
    public function __construct(private UserFinder $finder)
    {
    }

    public function __invoke(UserFinderQuery $query): ?User
    {
        return $this->finder->__invoke(UserId::create($query->id()));
    }
}