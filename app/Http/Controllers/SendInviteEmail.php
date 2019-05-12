<?php
declare(strict_types=1);

namespace ConorSmith\Wedding\Http\Controllers;

use Carbon\Carbon;
use ConorSmith\Wedding\Invite;
use ConorSmith\Wedding\Mail\EmailInvite;
use Illuminate\Http\JsonResponse;
use Mail;

final class SendInviteEmail
{
    public function __invoke(string $id)
    {
        $invite = Invite::find($id);

        if (is_null($invite)) {
            return new JsonResponse(["Invite {$id} does not exist"], 500);
        }

        if ($invite->sent) {
            return new JsonResponse(["Invite {$id} has already been sent"], 500);
        }

        if (!$invite->guestA->receive_email
            && ($invite->isForTwoGuests() && !$invite->guestB->receive_email)
        ) {
            return new JsonResponse(["Neither guest is set to receive an email invite"], 500);
        }

        Mail::to("conor@tercet.io")->send(
            new EmailInvite(
                Invite::find($id)
            )
        );

        $failures = Mail::failures();

        if (count($failures) > 0) {
            return new JsonResponse($failures, 500);
        }

        $invite->sent = true;
        $invite->sent_at = Carbon::now("Europe/Dublin");
        $invite->save();

        $sentAtMarkup = $invite->sent_at->format("Y-m-d H:i");
        $sentAtMarkup = str_replace(" ", "&nbsp;", $sentAtMarkup);
        $sentAtMarkup = str_replace("-", "&#8209;", $sentAtMarkup);

        return new JsonResponse([
            'sentAt' => $sentAtMarkup,
        ]);
    }
}
