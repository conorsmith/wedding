<?php
declare(strict_types=1);

namespace ConorSmith\Wedding\Http\Controllers;

use Carbon\Carbon;

final class ShowLandingPage
{
    public function __invoke()
    {
        $weddingDate = new Carbon("2019-08-18 15:00:00", "Europe/Dublin");
        $now = new Carbon();

        $interval = $weddingDate->diffAsCarbonInterval($now);

        $countdown = [
            'days'    => $weddingDate->diffInDays($now),
            'hours'   => $interval->hours,
            'minutes' => $interval->minutes,
            'seconds' => $interval->seconds,
        ];

        return view('landing', [
            'style'             => 3,
            'countdown'         => $countdown,
            'isCountdownActive' => $weddingDate->isFuture(),
            'rsvpDate'          => config("wedding.rsvpDate"),
        ]);
    }
}
