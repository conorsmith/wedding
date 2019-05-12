<?php
declare(strict_types=1);

namespace ConorSmith\Wedding\Http\Controllers;

use ConorSmith\Wedding\Invite;
use Illuminate\Http\Request;

final class SubmitRsvpCode
{
    public function __invoke(Request $request)
    {
        $code = $request->input("code");

        $invite = Invite::where('short_code', $code)->first();

        if (is_null($invite)) {
            $request->session()->flash('error', "Invalid invite code");
            return redirect("/rsvp");
        }

        if (!$invite->guestA->receive_physical) {
            if ($invite->isForOneGuest()) {
                $request->session()->flash('error', "Invalid invite code");
                return redirect("/rsvp");
            }

            if (!$invite->guestB->receive_physical) {
                $request->session()->flash('error', "Invalid invite code");
                return redirect("/rsvp");
            }
        }

        return redirect("/invite/{$invite->id}?key={$invite->access_key}");
    }
}
