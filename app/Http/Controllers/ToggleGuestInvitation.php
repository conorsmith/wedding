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
        $guestIds = [$id];
        $isInvited = $request->input('isInvited') === "1";
        $guest = Guest::find($id);

        if ($guest->hasPartner()) {
            $guestIds[] = $guest->getPartner()->id;
        }

        DB::transaction(function () use ($guest, $isInvited) {

            $guest->is_invited = $isInvited;
            $guest->save();

            if ($guest->hasPartner()) {
                $partner = $guest->getPartner();

                $partner->is_invited = $isInvited;
                $partner->save();
            }

        });

        return new JsonResponse([
            'guests' => $guestIds,
        ]);
    }
}
