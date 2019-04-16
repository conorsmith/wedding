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

Route::middleware(['auth.basic'])->group(function () {

    Route::get("/new-splash", function () {
        return view('new-splash', [
            'style' => 3,
        ]);
    });

    Route::get('/preview-invite/{id?}', GetInvite::class);

    Route::get("/admin", function () {
        return redirect("/admin/guests");
    });

    Route::get("/admin/guests", function () {
        return view('admin.guests.list', [
            'guests' => \ConorSmith\Wedding\Guest::orderBy('last_name')->get(),
        ]);
    });

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

    Route::get("/admin/invites/{id}/switch", function (\Illuminate\Http\Request $request, $id) {
        $invite = \ConorSmith\Wedding\Invite::find($id);
        $invite->update([
            'guest_a' => $invite->guest_b,
            'guest_b' => $invite->guest_a,
        ]);
        return redirect("/admin/guests/{$request->get('guest')}");
    });

});
