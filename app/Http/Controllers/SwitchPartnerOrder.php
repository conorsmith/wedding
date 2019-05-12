<?php
declare(strict_types=1);

namespace ConorSmith\Wedding\Http\Controllers;

use ConorSmith\Wedding\Invite;
use Illuminate\Http\Request;

final class SwitchPartnerOrder
{
    public function __invoke(Request $request, string $id)
    {
        $invite = Invite::find($id);

        $invite->update([
            'guest_a' => $invite->guest_b,
            'guest_b' => $invite->guest_a,
        ]);

        return redirect("/admin/guests/{$request->get('guest')}");
    }
}
