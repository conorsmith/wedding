<?php
declare(strict_types=1);

namespace ConorSmith\Wedding\Domain;

use Ramsey\Uuid\UuidInterface;

final class Invite
{
    /** @var UuidInterface */
    private $id;

    /** @var UuidInterface */
    private $guestAId;

    /** @var ?UuidInterface */
    private $guestBId;

    /** @var string */
    private $note;

    /** @var bool */
    private $isSent;

    /** @var ?Response */
    private $response;

    public function __construct(
        UuidInterface $id,
        UuidInterface $guestAId,
        ?UuidInterface $guestBId,
        string $note,
        bool $isSent,
        ?Response $response
    ) {
        $this->id = $id;
        $this->guestAId = $guestAId;
        $this->guestBId = $guestBId;
        $this->note = $note;
        $this->isSent = $isSent;
        $this->response = $response;
    }

    public function getId(): UuidInterface
    {
        return $this->id;
    }

    public function getNote(): string
    {
        return $this->note;
    }

    public function isSent(): bool
    {
        return $this->isSent;
    }

    public function getResponse(): ?Response
    {
        return $this->response;
    }

    public function hasResponse(): bool
    {
        return !is_null($this->response);
    }

    public function isForOneGuest(): bool
    {
        return is_null($this->guestBId);
    }

    public function isForTwoGuests(): bool
    {
        return !is_null($this->guestBId);
    }

    public function findGuestA(GuestRepository $guestRepo): Guest
    {
        return $guestRepo->find($this->guestAId);
    }

    public function findGuestB(GuestRepository $guestRepo): ?Guest
    {
        return $guestRepo->find($this->guestBId);
    }
}
