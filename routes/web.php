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

Route::get("/invite/{id}", ViewInvite::class);
Route::post("/rsvp/{id}", SubmitRsvp::class);

Route::get("/rsvp", ShowRsvpCodeForm::class);
Route::post("/rsvp", SubmitRsvpCode::class);
Route::get("/rsvp/{code}", ViewInviteUsingRsvpCode::class);

Route::middleware(['auth.basic'])->group(function () {

    Route::get("/new-splash", function () {
        return redirect("/preview-landing");
    });

    Route::get("/preview-landing", ShowLandingPage::class);
    Route::get('/preview-invite/{id?}', ViewInvite::class);
    Route::get("/preview-email/{id}", ViewInviteEmail::class);

    Route::get("/admin", ShowDashboard::class);

    Route::get("/admin/guests", ListShortlistedGuests::class);
    Route::get("/admin/invitees", ListInvitedGuests::class);
    Route::get("/admin/invites", ManageInvites::class);

    Route::get("/admin/guests/new", ShowNewGuestForm::class);
    Route::post("/admin/guests/new", CreateNewGuest::class);

    Route::get("/admin/guests/{id}", ShowEditGuestForm::class);
    Route::post("/admin/guests/{id}", PostEditGuest::class);

    Route::delete("/admin/guests/{id}", DeleteGuest::class);

    Route::post("/admin/guests/{id}/invite", ToggleGuestInvitation::class);
    Route::post("/admin/guests/{id}/uninvite", ToggleGuestInvitation::class);

    Route::post("/admin/guests/{id}/set-attending", ToggleGuestAttending::class);
    Route::post("/admin/guests/{id}/set-not-attending", ToggleGuestAttending::class);

    Route::post("/admin/invites/{id}/set-sent", ToggleInviteSent::class);
    Route::post("/admin/invites/{id}/set-not-sent", ToggleInviteSent::class);

    Route::post("/admin/invites/{id}/send", SendInviteEmail::class);

    Route::get("/admin/invites/{id}/switch", SwitchPartnerOrder::class);

});
