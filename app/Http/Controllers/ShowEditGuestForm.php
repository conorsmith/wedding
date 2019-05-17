<?php
declare(strict_types=1);

namespace ConorSmith\Wedding\Http\Controllers;

use ConorSmith\Wedding\Domain\GuestRepository;
use ConorSmith\Wedding\Domain\InviteRepository;
use ConorSmith\Wedding\Infrastructure\Ui\GuestForm;
use ConorSmith\Wedding\Infrastructure\Ui\PartnerSelectOption;
use Ramsey\Uuid\Uuid;

final class ShowEditGuestForm
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

    public function __invoke(string $id)
    {
        $guest = $this->guestRepo->find(Uuid::fromString($id));
        $allGuests = $this->guestRepo->allByFirstName();

        return view('admin.guests.edit', [
            'edit'    => true,
            'guest'   => new GuestForm($guest, $this->guestRepo, $this->inviteRepo),
            'guests'  => PartnerSelectOption::fromGuests($allGuests),
        ]);
    }
}
