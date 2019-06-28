<?php
declare(strict_types=1);

namespace ConorSmith\Wedding\Http\Controllers;

use ConorSmith\Wedding\Guest;
use DB;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

final class ToggleGuestAftersInvitation
{
    public function __invoke(Request $request, string $id)
    {
        $guestIds = [$id];
        $isInvitedAfters = $request->input('isInvitedAfters') === "1";
        $guest = Guest::find($id);

        if ($guest->hasPartner()) {
            $guestIds[] = $guest->getPartner()->id;
        }

        DB::transaction(function () use ($guest, $isInvitedAfters) {

            $guest->is_invited_afters = $isInvitedAfters;
            $guest->save();

            if ($guest->hasPartner()) {
                $partner = $guest->getPartner();

                $partner->is_invited_afters = $isInvitedAfters;
                $partner->save();
            }

        });

        return new JsonResponse([
            'guests' => $guestIds,
        ]);
    }
}
