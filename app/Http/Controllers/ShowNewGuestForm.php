<?php
declare(strict_types=1);

namespace ConorSmith\Wedding\Http\Controllers;

use ConorSmith\Wedding\Domain\GuestRepository;
use ConorSmith\Wedding\Domain\InviteRepository;
use ConorSmith\Wedding\Infrastructure\Ui\EmptyGuestForm;
use ConorSmith\Wedding\Infrastructure\Ui\PartnerSelectOption;

final class ShowNewGuestForm
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
        return view('admin.guests.edit', [
            'edit'    => false,
            'guest'   => new EmptyGuestForm,
            'guests'  => PartnerSelectOption::fromGuests(
                $this->guestRepo->allByFirstName()
            ),
        ]);
    }
}
