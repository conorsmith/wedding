<?php
declare(strict_types=1);

namespace ConorSmith\Wedding\Infrastructure\Ui;

use ConorSmith\Wedding\Domain\Guest;
use ConorSmith\Wedding\Domain\GuestRepository;
use ConorSmith\Wedding\Domain\InviteRepository;

final class GuestTableRow
{
    public function __construct(Guest $guest, GuestRepository $guestRepo, InviteRepository $inviteRepo)
    {
        $partner = $guest->findPartner($guestRepo);
        $invite = $inviteRepo->findForGuest($guest);

        $this->id = $guest->getId();
        $this->first_name = $guest->getFirstName();
        $this->last_name = $guest->getLastName();
        $this->email = $guest->hasEmail();
        $this->phone = $guest->hasPhone();
        $this->address = $guest->hasAddress();
        $this->is_ready = $guest->isReady();
        $this->receive_email = $guest->receiveEmail();
        $this->receive_physical = $guest->receivePhysical();
        $this->is_invited = $guest->isInvited();
        $this->is_attending = $guest->isAttending();
        $this->partner = is_null($partner)
            ? null
            : (object) [
                'first_name' => $partner->getFirstName(),
                'last_name'  => $partner->getLastName(),
            ];
        $this->invite = (object) [
            'id'       => $invite->getId(),
            'sent'     => $invite->isSent(),
            'response' => is_null($invite->getResponse())
                ? null
                : (object) [
                    'attending' => $invite->getResponse()->isAttending(),
                ],
        ];
    }
}
