<?php
declare(strict_types=1);

namespace ConorSmith\Wedding\Http\Controllers;

use ConorSmith\Wedding\Invite;
use ConorSmith\Wedding\Mail\EmailInvite;

final class ViewInviteEmail
{
    public function __invoke(string $id)
    {
        return new EmailInvite(
            Invite::find($id)
        );
    }
}
