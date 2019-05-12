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
        return view('admin.dashboard', [
            'totalGuests'    => Guest::all()->count(),
            'totalInvited'   => Guest::where('is_invited', true)->count(),
            'totalInvites'   => Invite::all()
                ->filter(function ($invite) {
                    return $invite->guestsAreInvited();
                })
                ->count(),
            'totalSent'      => Invite::where('sent', true)->count(),
            'totalResponses' => Response::all()->count(),
            'totalAttending' => Guest::where('is_attending', true)->count(),
        ]);
    }
}
