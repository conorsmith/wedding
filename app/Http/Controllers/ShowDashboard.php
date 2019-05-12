<?php
declare(strict_types=1);

namespace ConorSmith\Wedding\Http\Controllers;

use ConorSmith\Wedding\Guest;
use ConorSmith\Wedding\Invite;
use ConorSmith\Wedding\Response;

final class ShowDashboard
{
    public function __invoke()
    {
        $invites = Invite::all();

        return view('admin.dashboard', [
            'totalGuests'    => Guest::all()->count(),
            'totalInvited'   => Guest::where('is_invited', true)->count(),
            'totalAttending' => Guest::where('is_attending', true)->count(),
            'totalInvites'   => $invites
                ->filter(function ($invite) {
                    return $invite->guestsAreInvited();
                })
                ->count(),
            'totalEmailInvites' => $invites
                ->filter(function (Invite $invite) {
                    return $invite->guestsAreInvited()
                        && (
                            $invite->guestA->receive_email
                            || ($invite->isForTwoGuests() && $invite->guestB->receive_email)
                        );
                })
                ->count(),
            'totalPhysicalInvites' => $invites
                ->filter(function (Invite $invite) {
                    return $invite->guestsAreInvited()
                        && (
                            $invite->guestA->receive_physical
                            || ($invite->isForTwoGuests() && $invite->guestB->receive_physical)
                        );
                })
                ->count(),
            'totalSent'      => Invite::where('sent', true)->count(),
            'totalResponses' => Response::all()->count(),
        ]);
    }
}
