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
        if (str_contains($request->route()->uri(), "not-attending")) {
            return $this->setIsNotAttending($id);
        } else {
            return $this->setIsAttending($id);
        }
    }

    private function setIsAttending(string $id)
    {
        $guest = Guest::find($id);
        $guest->is_attending = false;
        $guest->save();

        return new JsonResponse([]);
    }

    private function setIsNotAttending(string $id)
    {
        $guest = Guest::find($id);
        $guest->is_attending = false;
        $guest->save();

        return new JsonResponse([]);
    }
}
