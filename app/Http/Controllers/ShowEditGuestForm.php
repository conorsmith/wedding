<?php
declare(strict_types=1);

namespace ConorSmith\Wedding\Http\Controllers;

use ConorSmith\Wedding\Domain\Guest;
use ConorSmith\Wedding\Domain\GuestRepository;
use ConorSmith\Wedding\Domain\InviteRepository;
use Ramsey\Uuid\Uuid;
use stdClass;

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
            'guest'   => $this->presentGuest($guest),
            'partner' => $this->presentPartner($partner),
            'guests'  => $this->presentOtherGuests($allGuests),
        ]);
    }

    private function presentGuest(Guest $guest)
    {
        $invite = $this->inviteRepo->findForGuest($guest);
        $guestA = $invite->findGuestA($this->guestRepo);
        $guestB = $invite->findGuestB($this->guestRepo);
        $response = $invite->getResponse();

        return (object) [
            'id'               => strval($guest->getId()),
            'first_name'       => $guest->getFirstName(),
            'last_name'        => $guest->getLastName(),
            'email'            => $guest->hasEmail(),
            'phone'            => $guest->hasPhone(),
            'address'          => $guest->hasAddress(),
            'receive_email'    => $guest->receiveEmail(),
            'receive_physical' => $guest->receivePhysical(),
            'is_attending'     => $guest->isAttending(),
            'has_responded'    => $this->inviteRepo->findForGuest($guest)->hasResponse(),
            'invite'           => (object) [
                'id'                => strval($invite->getId()),
                'note'              => $invite->getNote(),
                'is_for_one_guest'  => $invite->isForOneGuest(),
                'is_for_two_guests' => $invite->isForTwoGuests(),
                'guestA'            => (object) [
                    'first_name' => $guestA->getFirstName(),
                ],
                'guestB'            => is_null($guestB)
                    ? null
                    : (object) [
                        'first_name' => $guestB->getFirstName(),
                    ],
                'response'          => is_null($response)
                    ? null
                    : (object) [
                        'attending' => $response->isAttending(),
                        'note'      => $response->getNote(),
                    ],
            ],
        ];
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
            'is_attending' => $partner->isAttending(),
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
