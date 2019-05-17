<?php
declare(strict_types=1);

namespace ConorSmith\Wedding\Infrastructure\Ui;

use ConorSmith\Wedding\Domain\Guest;
use ConorSmith\Wedding\Domain\GuestRepository;
use ConorSmith\Wedding\Domain\InviteRepository;

final class GuestForm
{
    public function __construct(Guest $guest, GuestRepository $guestRepo, InviteRepository $inviteRepo)
    {
        $invite = $inviteRepo->findForGuest($guest);
        $guestA = $invite->findGuestA($guestRepo);
        $guestB = $invite->findGuestB($guestRepo);
        $response = $invite->getResponse();

        $this->id = strval($guest->getId());
        $this->first_name = $guest->getFirstName();
        $this->last_name = $guest->getLastName();
        $this->email = $guest->getEmail();
        $this->phone = $guest->getPhone();
        $this->address = $guest->getAddress();
        $this->is_ready = $guest->isReady() ? "1" : "0";
        $this->receive_email = $guest->receiveEmail();
        $this->receive_physical = $guest->receivePhysical();
        $this->is_attending = $guest->isAttending() ? "1" : "0";
        $this->has_responded = $inviteRepo->findForGuest($guest)->hasResponse();
        $this->invite = (object) [
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
        ];
    }
}
