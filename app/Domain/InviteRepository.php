<?php
declare(strict_types=1);

namespace ConorSmith\Wedding\Domain;

interface InviteRepository
{
    public function findForGuest(Guest $guest): Invite;
}
