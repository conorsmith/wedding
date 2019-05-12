<?php
declare(strict_types=1);

namespace ConorSmith\Wedding\Domain;

final class Response
{
    /** @var bool */
    private $isAttending;

    /** @var ?string */
    private $note;

    public function __construct(bool $isAttending, ?string $note)
    {
        $this->isAttending = $isAttending;
        $this->note = $note;
    }

    public function isAttending(): bool
    {
        return $this->isAttending;
    }

    public function getNote(): ?string
    {
        return $this->note;
    }
}
