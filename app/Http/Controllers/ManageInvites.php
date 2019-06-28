<?php
declare(strict_types=1);

namespace ConorSmith\Wedding\Http\Controllers;

use ConorSmith\Wedding\Invite;
use Illuminate\Http\Request;

final class ManageInvites
{
    public function __invoke(Request $request)
    {
        if ($request->get("type") === "email") {
            return $this->manageEmailInvites($request);
        }

        if ($request->get("type") === "physical") {
            return $this->managePhysicalInvites($request);
        }

        abort(404);
    }

    private function managePhysicalInvites(Request $request)
    {
        $invites = Invite::all()
            ->filter(function ($invite) {
                return $invite->guestA->is_invited
                    && (
                        is_null($invite->guestB)
                        || $invite->guestB->is_invited
                    );
            })
            ->filter(function ($invite) {
                return $invite->guestA->receive_physical
                    || ($invite->isForTwoGuests() && $invite->guestB->receive_physical);
            })
            ->sort(function ($inviteA, $inviteB) {
                return strcasecmp($inviteA->guestA->last_name, $inviteB->guestA->last_name);
            });

        return view('admin.physicalInvites', [
            'invites' => $invites,
        ]);
    }

    private function manageEmailInvites(Request $request)
    {
        $invites = Invite::all()
            ->filter(function ($invite) {
                return ($invite->guestA->is_invited || $invite->guestA->is_invited_afters)
                    && (
                        is_null($invite->guestB)
                        || $invite->guestB->is_invited
                        || $invite->guestB->is_invited_afters
                    );
            })
            ->filter(function ($invite) {
                return $invite->guestA->receive_email
                    || ($invite->isForTwoGuests() && $invite->guestB->receive_email);
            })
            ->sort(function ($inviteA, $inviteB) {
                return strcasecmp($inviteA->guestA->last_name, $inviteB->guestA->last_name);
            });

        return view('admin.emailInvites', [
            'invites'        => $invites,
            'sendRealEmails' => getenv('SEND_REAL_EMAILS'),
        ]);
    }
}
