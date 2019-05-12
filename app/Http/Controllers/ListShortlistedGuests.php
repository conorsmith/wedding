<?php
declare(strict_types=1);

namespace ConorSmith\Wedding\Http\Controllers;

use ConorSmith\Wedding\Guest;

final class ListShortlistedGuests
{
    public function __invoke()
    {
        return view('admin.guests.shortlist', [
            'guests' => Guest::orderBy('last_name')->get(),
        ]);
    }
}
