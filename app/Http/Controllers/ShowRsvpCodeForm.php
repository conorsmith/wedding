<?php
declare(strict_types=1);

namespace ConorSmith\Wedding\Http\Controllers;

final class ShowRsvpCodeForm
{
    public function __invoke()
    {
        return view('rsvp-code');
    }
}
