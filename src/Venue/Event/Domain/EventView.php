<?php

declare(strict_types=1);

namespace App\Venue\Event\Domain;

use App\Shared\Domain\DatetimeUtils;
use App\Shared\Domain\Projection\IsProjection;
use App\Venue\Event\Domain\ValueObjects\EventViewId;
use DateTime;

final class EventView implements IsProjection
{
    private const NAME = 'venue-events-view';

    public function __construct(
        private EventViewId $id,
        private string $title,
        private string $content,
        private string $location,
        private DateTime $startAt,
        private DateTime $endAt,
        private array $comments,
    ) {
    }

    public static function createFromArray(array $data): self
    {
        return new self(
            EventViewId::create($data['id']),
            $data['title'],
            $data['content'],
            $data['location'],
            $data['startAt'],
            $data['endAt'],
            $data['comments']
        );
    }

    public function id(): EventViewId
    {
        return $this->id;
    }

    public function title(): string
    {
        return $this->title;
    }

    public function content(): string
    {
        return $this->content;
    }

    public function location(): string
    {
        return $this->location;
    }

    public function startAt(): DateTime
    {
        return $this->startAt;
    }

    public function endAt(): DateTime
    {
        return $this->endAt;
    }

    public function comments(): array
    {
        return $this->comments;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id()->value(),
            'title' => $this->title(),
            'content' => $this->content(),
            'location' => $this->location(),
            'comments' => $this->comments(),
            'startAt' => $this->startAt()->format(DatetimeUtils::DATETIME_FORMAT),
            'endAt' => $this->endAt()->format(DatetimeUtils::DATETIME_FORMAT),
        ];
    }

    public static function projectionName(): string
    {
        return self::NAME;
    }
}
