<?php
declare(strict_types=1);

namespace ConorSmith\Wedding\Http\Controllers;

use ConorSmith\Wedding\Guest;

final class ShowNewGuestForm
{
    public function __invoke()
    {
        return view('admin.guests.edit', [
            'edit'    => false,
            'guest'   => new Guest,
            'partner' => null,
            'guests'  => Guest::all(),
        ]);
    }
}
