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
        $isSent = $request->input('isSent') === "1";

        $invite = Invite::find($id);
        $invite->sent = $isSent;
        $invite->save();

        return new JsonResponse([]);
    }
}
