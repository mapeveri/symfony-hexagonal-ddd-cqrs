<?php

declare(strict_types=1);

namespace App\Magazine\Application\Post\Find;

use App\Magazine\Domain\Entity\Post;
use App\Magazine\Domain\Bus\Query\Response;

final class PostFinderResponse implements Response
{
    private Post $post;

    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    public function data(): array
    {
        return [
            'id' => $this->post->id(),
            'title' => $this->post->title(),
            'content' => $this->post->content(),
            'user' => $this->post->user()->id(),
            'hidden' => $this->post->hidden(),
            'created' => $this->post->created(),
        ];
    }
}
