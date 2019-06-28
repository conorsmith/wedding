<?php
declare(strict_types=1);

namespace ConorSmith\Wedding\Http\Controllers;

use ConorSmith\Wedding\Domain\GuestRepository;
use ConorSmith\Wedding\Domain\InviteRepository;
use ConorSmith\Wedding\Infrastructure\Ui\GuestTableRow;

final class ListAftersGuests
{
    /** @var GuestRepository */
    private $guestRepo;

    /** @var InviteRepository */
    private $inviteRepo;

    public function __construct(GuestRepository $guestRepo, InviteRepository $inviteRepo)
    {
        $this->guestRepo = $guestRepo;
        $this->inviteRepo = $inviteRepo;
    }

    public function __invoke()
    {
        $guests = $this->guestRepo->allInvitedToAftersByLastName();

        $viewModels = [];

        foreach ($guests as $guest) {
            $viewModels[] = new GuestTableRow($guest, $this->guestRepo, $this->inviteRepo);
        }

        return view('admin.guests.afters', [
            'guests' => $viewModels,
        ]);
    }
}
