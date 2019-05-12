<?php
declare(strict_types=1);

namespace ConorSmith\Wedding\Http\Controllers;

use ConorSmith\Wedding\Guest;

final class ShowEditGuestForm
{
    public function __invoke(string $id)
    {
        $guest = Guest::find($id);

        return view('admin.guests.edit', [
            'edit'    => true,
            'guest'   => $guest,
            'partner' => $guest->getPartner(),
            'guests'  => Guest::all(),
        ]);
    }
}
