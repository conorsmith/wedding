<?php
declare(strict_types=1);

namespace ConorSmith\Wedding\Http\Controllers;

use ConorSmith\Wedding\Guest;
use ConorSmith\Wedding\Infrastructure\GuestFormHandler;
use DB;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

final class PostEditGuest
{
    /** @var GuestFormHandler */
    private $guestFormHandler;

    public function __construct(GuestFormHandler $guestFormHandler)
    {
        $this->guestFormHandler = $guestFormHandler;
    }

    public function __invoke(Request $request, $id): Response
    {
        $guest = Guest::find($id);

        if ($this->tryingToSplitInvitesThatHaveBeenSent($request, $guest)) {
            $request->session()->flash('error', "You cannot split a joint invite that has been sent!");
            return redirect("/admin/guests/{$id}");
        }

        DB::transaction(function () use ($request, $guest) {
            $guest->update($request->all());
            $this->guestFormHandler->saveRelatedGuestData($request, $guest);
        });

        return redirect("/admin/guests/{$id}");
    }

    private function tryingToSplitInvitesThatHaveBeenSent(Request $request, Guest $guest): bool
    {
        return $this->shouldSplitInvites($request, $guest)
            && $guest->getInvite()->sent === true;
    }

    private function shouldSplitInvites(Request $request, Guest $guest): bool
    {
        return $request->input('invite_plus_partner') === "no"
            && $guest->getInvite()->isForTwoGuests();
    }
}
