<?php
declare(strict_types=1);

namespace ConorSmith\Wedding\Http\Controllers;

use ConorSmith\Wedding\Domain\Guest;
use ConorSmith\Wedding\Domain\GuestRepository;
use ConorSmith\Wedding\Domain\InviteRepository;
use ConorSmith\Wedding\Infrastructure\Ui\GuestForm;
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
        $partner = $guest->findPartner($this->guestRepo);
        $allGuests = $this->guestRepo->allByFirstName();

        return view('admin.guests.edit', [
            'edit'    => true,
            'guest'   => new GuestForm($guest, $this->guestRepo, $this->inviteRepo),
            'partner' => $this->presentPartner($partner),
            'guests'  => $this->presentOtherGuests($allGuests),
        ]);
    }

    private function presentPartner(?Guest $partner)
    {
        if (is_null($partner)) {
            return null;
        }

        return (object) [
            'id'           => strval($partner->getId()),
            'first_name'   => $partner->getFirstName(),
            'last_name'    => $partner->getLastName(),
            'is_attending' => $partner->isAttending() ? "1" : "0",
        ];
    }

    private function presentOtherGuests(iterable $guests)
    {
        $viewModels = [];

        foreach ($guests as $guest) {
            $viewModels[] = (object) [
                'id'         => strval($guest->getId()),
                'first_name' => $guest->getFirstName(),
                'last_name'  => $guest->getLastName(),
            ];
        }

        return $viewModels;
    }
}
