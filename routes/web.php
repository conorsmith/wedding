<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('splash');
});

Route::get("/invite/{id}", GetInvite::class);

Route::post("/rsvp/{id}", PostRsvp::class);

Route::get("/rsvp", function () {
    return view('rsvp-code');
});

Route::get("/rsvp/{code}", function ($code) {

    $invite = \ConorSmith\Wedding\Invite::where('short_code', $code)->first();

    if (is_null($invite)) {
        abort(404);
    }

    if (!$invite->guestA->receive_physical) {
        if ($invite->isForOneGuest()) {
            abort(404);
        }

        if (!$invite->guestB->receive_physical) {
            abort(404);
        }
    }

    return redirect("/invite/{$invite->id}?key={$invite->access_key}");
});

Route::post("/rsvp", function (\Illuminate\Http\Request $request) {

    $code = $request->input("code");

    $invite = \ConorSmith\Wedding\Invite::where('short_code', $code)->first();

    if (is_null($invite)) {
        $request->session()->flash('error', "Invalid invite code");
        return redirect("/rsvp");
    }

    if (!$invite->guestA->receive_physical) {
        if ($invite->isForOneGuest()) {
            $request->session()->flash('error', "Invalid invite code");
            return redirect("/rsvp");
        }

        if (!$invite->guestB->receive_physical) {
            $request->session()->flash('error', "Invalid invite code");
            return redirect("/rsvp");
        }
    }

    return redirect("/invite/{$invite->id}?key={$invite->access_key}");
});

Route::middleware(['auth.basic'])->group(function () {

    Route::get("/new-splash", function () {
        return redirect("/preview-landing");
    });

    Route::get("/preview-landing", ShowLandingPage::class);

    Route::get('/preview-invite/{id?}', GetInvite::class);

    Route::get("/preview-email/{id}", function ($id) {
        return new \ConorSmith\Wedding\Mail\EmailInvite(
            \ConorSmith\Wedding\Invite::find($id)
        );
    });

    Route::get("/admin", function () {
        return view('admin.dashboard', [
            'totalGuests' => \ConorSmith\Wedding\Guest::all()->count(),
            'totalInvited' => \ConorSmith\Wedding\Guest::where('is_invited', true)->count(),
            'totalInvites' => \ConorSmith\Wedding\Invite::all()
                ->filter(function ($invite) {
                    return $invite->guestsAreInvited();
                })
                ->count(),
            'totalSent' => \ConorSmith\Wedding\Invite::where('sent', true)->count(),
            'totalResponses' => \ConorSmith\Wedding\Response::all()->count(),
            'totalAttending' => \ConorSmith\Wedding\Guest::where('is_attending', true)->count(),
        ]);
    });

    Route::get("/admin/guests", function () {
        return view('admin.guests.shortlist', [
            'guests'        => \ConorSmith\Wedding\Guest::orderBy('last_name')->get(),
        ]);
    });

    Route::get("/admin/invitees", function () {
        return view('admin.guests.invitees', [
            'guests' => \ConorSmith\Wedding\Guest::where('is_invited', true)->orderBy('last_name')->get(),
        ]);
    });

    Route::get("/admin/invites", ManageInvites::class);

    Route::get("/admin/guests/new", function () {
        return view('admin.guests.edit', [
            'edit' => false,
            'guest' => new \ConorSmith\Wedding\Guest,
            'partner' => null,
            'guests' => \ConorSmith\Wedding\Guest::all(),
        ]);
    });

    Route::post("/admin/guests/new", function (\Illuminate\Http\Request $request) {
        \ConorSmith\Wedding\Guest::create(array_merge($request->all(), [
            'id' => \Ramsey\Uuid\Uuid::uuid4(),
        ]));
        return redirect("/admin/guests");
    });

    Route::get("/admin/guests/{id}", function ($id) {
        $guest = \ConorSmith\Wedding\Guest::find($id);
        return view('admin.guests.edit', [
            'edit' => true,
            'guest' => $guest,
            'partner' => $guest->getPartner(),
            'guests' => \ConorSmith\Wedding\Guest::all(),
        ]);
    });

    Route::post("/admin/guests/{id}", PostEditGuest::class);

    Route::delete("/admin/guests/{id}", function ($id) {
        \ConorSmith\Wedding\Guest::find($id)->delete();
        return redirect("/admin/guests");
    });

    Route::post("/admin/guests/{id}/invite", function ($id) {
        $guestIds = [$id];
        $guest = \ConorSmith\Wedding\Guest::find($id);

        if ($guest->hasPartner()) {
            $guestIds[] = $guest->getPartner()->id;
        }

        DB::transaction(function () use ($guest) {

            $guest->is_invited = true;
            $guest->save();

            if ($guest->hasPartner()) {
                $partner = $guest->getPartner();

                $partner->is_invited = true;
                $partner->save();
            }

        });

        return new \Illuminate\Http\JsonResponse([
            'guests' => $guestIds,
        ]);
    });

    Route::post("/admin/guests/{id}/uninvite", function ($id) {
        $guestIds = [$id];
        $guest = \ConorSmith\Wedding\Guest::find($id);

        if ($guest->hasPartner()) {
            $guestIds[] = $guest->getPartner()->id;
        }

        DB::transaction(function () use ($guest) {

            $guest->is_invited = false;
            $guest->save();

            if ($guest->hasPartner()) {
                $partner = $guest->getPartner();

                $partner->is_invited = false;
                $partner->save();
            }

        });

        return new \Illuminate\Http\JsonResponse([
            'guests' => $guestIds,
        ]);
    });

    Route::post("/admin/guests/{id}/set-attending", function ($id) {
        $guest = \ConorSmith\Wedding\Guest::find($id);
        $guest->is_attending = true;
        $guest->save();

        return new \Illuminate\Http\JsonResponse([]);
    });

    Route::post("/admin/guests/{id}/set-not-attending", function ($id) {
        $guest = \ConorSmith\Wedding\Guest::find($id);
        $guest->is_attending = false;
        $guest->save();

        return new \Illuminate\Http\JsonResponse([]);
    });

    Route::post("/admin/invites/{id}/set-sent", function ($id) {
        $invite = \ConorSmith\Wedding\Invite::find($id);
        $invite->sent = true;
        $invite->save();

        return new \Illuminate\Http\JsonResponse([]);
    });

    Route::post("/admin/invites/{id}/set-not-sent", function ($id) {
        $invite = \ConorSmith\Wedding\Invite::find($id);
        $invite->sent = false;
        $invite->save();

        return new \Illuminate\Http\JsonResponse([]);
    });

    Route::post("/admin/invites/{id}/send", function ($id) {
        $invite = \ConorSmith\Wedding\Invite::find($id);

        if (is_null($invite)) {
            return new \Illuminate\Http\JsonResponse(["Invite {$id} does not exist"], 500);
        }

        if ($invite->sent) {
            return new \Illuminate\Http\JsonResponse(["Invite {$id} has already been sent"], 500);
        }

        if (!$invite->guestA->receive_email
            && ($invite->isForTwoGuests() && !$invite->guestB->receive_email)
        ) {
            return new \Illuminate\Http\JsonResponse(["Neither guest is set to receive an email invite"], 500);
        }

        Mail::to("conor@tercet.io")->send(
            new \ConorSmith\Wedding\Mail\EmailInvite(\ConorSmith\Wedding\Invite::find($id))
        );

        $failures = Mail::failures();

        if (count($failures) > 0) {
            return new \Illuminate\Http\JsonResponse($failures, 500);
        }

        $invite->sent = true;
        $invite->sent_at = \Carbon\Carbon::now("Europe/Dublin");
        $invite->save();

        $sentAtMarkup = $invite->sent_at->format("Y-m-d H:i");
        $sentAtMarkup = str_replace(" ", "&nbsp;", $sentAtMarkup);
        $sentAtMarkup = str_replace("-", "&#8209;", $sentAtMarkup);

        return new \Illuminate\Http\JsonResponse([
            'sentAt' => $sentAtMarkup,
        ]);
    });

    Route::get("/admin/invites/{id}/switch", function (\Illuminate\Http\Request $request, $id) {
        $invite = \ConorSmith\Wedding\Invite::find($id);
        $invite->update([
            'guest_a' => $invite->guest_b,
            'guest_b' => $invite->guest_a,
        ]);
        return redirect("/admin/guests/{$request->get('guest')}");
    });

});
