<?php

declare(strict_types=1);

namespace App\Magazine\Domain\Post;

use App\Magazine\Shared\Domain\DomainError;

final class PostNotExist extends DomainError
{
    private int $id;

    public function __construct(int $id)
    {
        $this->id = $id;

        parent::__construct();
    }

    public function errorCode(): string
    {
        return 'post_not_exist';
    }

    protected function errorMessage(): string
    {
        return sprintf('The post <%s> does not exist', $this->id);
    }
}
