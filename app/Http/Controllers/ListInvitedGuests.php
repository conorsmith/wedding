<?php
declare(strict_types=1);

namespace ConorSmith\Wedding\Http\Controllers;

use ConorSmith\Wedding\Guest;

final class ListInvitedGuests
{
    public function __invoke()
    {
        return view('admin.guests.invitees', [
            'guests' => Guest::where('is_invited', true)->orderBy('last_name')->get(),
        ]);
    }
}
