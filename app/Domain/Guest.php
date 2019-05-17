<?php
declare(strict_types=1);

namespace ConorSmith\Wedding\Domain;

use Ramsey\Uuid\UuidInterface;

final class Guest
{
    /** @var UuidInterface */
    private $id;

    /** @var ?UuidInterface */
    private $partnerId;

    /** @var string */
    private $firstName;

    /** @var string */
    private $lastName;

    /** @var ?string */
    private $email;

    /** @var ?string */
    private $phone;

    /** @var ?string */
    private $address;

    /** @var bool */
    private $isReady;

    /** @var bool */
    private $receiveEmail;

    /** @var bool */
    private $receivePhysical;

    /** @var bool */
    private $isInvited;

    /** @var bool */
    private $isAttending;

    public function __construct(
        UuidInterface $id,
        ?UuidInterface $partnerId,
        string $firstName,
        string $lastName,
        ?string $email,
        ?string $phone,
        ?string $address,
        bool $isReady,
        bool $receiveEmail,
        bool $receivePhysical,
        bool $isInvited,
        bool $isAttending
    ) {
        $this->id = $id;
        $this->partnerId = $partnerId;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->phone = $phone;
        $this->address = $address;
        $this->isReady = $isReady;
        $this->receiveEmail = $receiveEmail;
        $this->receivePhysical = $receivePhysical;
        $this->isInvited = $isInvited;
        $this->isAttending = $isAttending;
    }

    public function getId(): UuidInterface
    {
        return $this->id;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function hasEmail(): bool
    {
        return !is_null($this->email);
    }

    public function hasPhone(): bool
    {
        return !is_null($this->phone);
    }

    public function hasAddress(): bool
    {
        return !is_null($this->address);
    }

    public function isReady(): bool
    {
        return $this->isReady;
    }

    public function receiveEmail(): bool
    {
        return $this->receiveEmail;
    }

    public function receivePhysical(): bool
    {
        return $this->receivePhysical;
    }

    public function isInvited(): bool
    {
        return $this->isInvited;
    }

    public function isAttending(): bool
    {
        return $this->isAttending;
    }

    public function setIsAttending(bool $isAttending): void
    {
        $this->isAttending = $isAttending;
    }

    public function findPartner(GuestRepository $guestRepo): ?self
    {
        if (is_null($this->partnerId)) {
            return null;
        }

        return $guestRepo->find($this->partnerId);
    }
}
