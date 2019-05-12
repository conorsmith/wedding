<?php
declare(strict_types=1);

namespace ConorSmith\Wedding\Http\Controllers;

use ConorSmith\Wedding\Invite;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

final class ToggleInviteSent
{
    public function __invoke(Request $request, string $id)
    {
        if (str_contains($request->route()->uri(), "not-sent")) {
            return $this->setInviteNotSent($id);
        } else {
            return $this->setInviteSent($id);
        }
    }

    private function setInviteSent(string $id)
    {
        $invite = Invite::find($id);
        $invite->sent = true;
        $invite->save();

        return new JsonResponse([]);
    }

    private function setInviteNotSent(string $id)
    {
        $invite = Invite::find($id);
        $invite->sent = false;
        $invite->save();

        return new JsonResponse([]);
    }
}
