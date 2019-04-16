<?php
declare(strict_types=1);

namespace ConorSmith\Wedding\Http\Controllers;

use ConorSmith\Wedding\Guest;
use ConorSmith\Wedding\Invite;
use ConorSmith\Wedding\Relationship;
use DB;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;
use Symfony\Component\HttpFoundation\Response;

final class PostEditGuest
{
    public function __invoke(Request $request, $id): Response
    {
        $guest = Guest::find($id);

        DB::transaction(function () use ($request, $guest) {

            $guest->update($request->all());
            $this->updateRelationship($request, $guest);
            $this->updateInvites($request, $guest);
        });

        return redirect("/admin/guests");
    }

    private function updateRelationship(Request $request, Guest $guest): void
    {
        if ($this->shouldCreateRelationship($request, $guest)
            || $this->shouldReplaceRelationship($request, $guest)
        ) {
            Relationship::create([
                'id'        => Uuid::uuid4(),
                'partner_a' => $guest->id,
                'partner_b' => $request->input('partner'),
            ]);
        }

        if ($this->shouldRemoveRelationship($request, $guest)
            || $this->shouldReplaceRelationship($request, $guest)
        ) {
            Relationship::where('partner_a', $guest->id)
                ->orWhere('partner_b', $guest->id)
                ->first()
                ->delete();
        }
    }

    private function updateInvites(Request $request, Guest $guest): void
    {
        if (!$guest->hasPartner()) {
            return;
        }

        $invite = $guest->getInvite();

        $invite->update([
            'note' => $request->input('invite_note') ?? "",
        ]);

        if ($this->shouldMergeInvites($request, $guest)) {
            $partnerInvite = Invite::where('guest_a', $guest->getPartner()->id)
                ->first();

            $invite->update([
                'guest_b' => $guest->getPartner()->id,
            ]);

            if ($partnerInvite->note) {
                $invite->update([
                    'note' => "{$invite->note}\n\nNOTE FOR PARTNER:\n{$partnerInvite->note}",
                ]);
            }

            $partnerInvite->delete();

        } elseif ($this->shouldSplitInvites($request, $guest)) {
            (new Invite([
                'id' => Uuid::uuid4(),
                'guest_a' => $invite->guest_b,
                'note' => $invite->note,
            ]))
                ->save();

            $invite->update([
                'guest_b' => null,
            ]);
        }
    }

    private function shouldCreateRelationship(Request $request, Guest $guest): bool
    {
        return Uuid::isValid($request->input('partner'))
            && !$guest->hasPartner();
    }

    private function shouldRemoveRelationship(Request $request, Guest $guest): bool
    {
        return !Uuid::isValid($request->input('partner'))
            && $guest->hasPartner();
    }

    private function shouldReplaceRelationship(Request $request, Guest $guest): bool
    {
        return Uuid::isValid($request->input('partner'))
            && $guest->hasPartner()
            && $guest->getPartner()->id !== $request->input('partner');
    }

    private function shouldMergeInvites(Request $request, Guest $guest): bool
    {
        return $request->input('invite_plus_partner') === "yes"
            && $guest->getInvite()->isForOneGuest();
    }

    private function shouldSplitInvites(Request $request, Guest $guest): bool
    {
        return $request->input('invite_plus_partner') === "no"
            && $guest->getInvite()->isForTwoGuests();
    }
}
