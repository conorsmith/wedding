<?php
declare(strict_types=1);

namespace ConorSmith\Wedding\Domain;

use Ramsey\Uuid\UuidInterface;

interface GuestRepository
{
    public function allByFirstName(): iterable;
    public function allByLastName(): iterable;
    public function allInvitedByLastName(): iterable;
    public function find(UuidInterface $id): ?Guest;
    public function save(Guest $guest): void;
}
