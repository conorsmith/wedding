<?php
declare(strict_types=1);

namespace ConorSmith\Wedding\Http\Controllers;

use ConorSmith\Wedding\Guest;
use DB;
use Illuminate\Http\Request;

final class DeleteGuest
{
    public function __invoke(Request $request, string $id)
    {
        $guest = Guest::find($id);

        if ($guest->hasPartner()) {
            $request->session()->flash('error', "You must remove this guest's partner before deleting them");
            return redirect("/admin/guests/{$id}");
        }

        DB::transaction(function () use ($guest) {
            $invite = $guest->getInvite();
            $invite->delete();
            $guest->delete();
        });

        return redirect("/admin/guests");
    }
}
