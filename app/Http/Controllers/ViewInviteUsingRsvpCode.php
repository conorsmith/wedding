<?php
declare(strict_types=1);

namespace ConorSmith\Wedding\Http\Controllers;

use ConorSmith\Wedding\Invite;

final class ViewInviteUsingRsvpCode
{
    public function __invoke(string $code)
    {
        $invite = Invite::where('short_code', $code)->first();

        if (is_null($invite)) {
            abort(404);
        }

        if (!$invite->guestA->receive_physical) {
            if ($invite->isForOneGuest()) {
                abort(404);
            }

            if (!$invite->guestB->receive_physical) {
                abort(404);
            }
        }

        return redirect("/invite/{$invite->id}?key={$invite->access_key}");
    }
}
