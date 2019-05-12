<?php
declare(strict_types=1);

namespace ConorSmith\Wedding\Http\Controllers;

use ConorSmith\Wedding\Guest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

final class ToggleGuestAttending
{
    public function __invoke(Request $request, string $id)
    {
        $isAttending = $request->input('isAttending') === "1";

        $guest = Guest::find($id);
        $guest->is_attending = $isAttending;
        $guest->save();

        return new JsonResponse([]);
    }
}
