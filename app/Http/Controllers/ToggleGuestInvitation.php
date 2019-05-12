<?php
declare(strict_types=1);

namespace ConorSmith\Wedding\Http\Controllers;

use ConorSmith\Wedding\Guest;
use DB;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

final class ToggleGuestInvitation
{
    public function __invoke(Request $request, string $id)
    {
        if (str_contains($request->route()->uri(), "uninvite")) {
            return $this->setUninvited($id);
        } else {
            return $this->setInvited($id);
        }
    }

    private function setInvited(string $id)
    {
        $guestIds = [$id];
        $guest = Guest::find($id);

        if ($guest->hasPartner()) {
            $guestIds[] = $guest->getPartner()->id;
        }

        DB::transaction(function () use ($guest) {

            $guest->is_invited = true;
            $guest->save();

            if ($guest->hasPartner()) {
                $partner = $guest->getPartner();

                $partner->is_invited = true;
                $partner->save();
            }

        });

        return new JsonResponse([
            'guests' => $guestIds,
        ]);
    }

    private function setUninvited(string $id)
    {
        $guestIds = [$id];
        $guest = Guest::find($id);

        if ($guest->hasPartner()) {
            $guestIds[] = $guest->getPartner()->id;
        }

        DB::transaction(function () use ($guest) {

            $guest->is_invited = false;
            $guest->save();

            if ($guest->hasPartner()) {
                $partner = $guest->getPartner();

                $partner->is_invited = false;
                $partner->save();
            }

        });

        return new JsonResponse([
            'guests' => $guestIds,
        ]);
    }
}
