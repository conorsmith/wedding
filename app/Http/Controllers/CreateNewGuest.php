<?php
declare(strict_types=1);

namespace ConorSmith\Wedding\Http\Controllers;

use ConorSmith\Wedding\Guest;
use ConorSmith\Wedding\Infrastructure\GuestFormHandler;
use ConorSmith\Wedding\Invite;
use DB;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;
use RandomLib\Factory;
use SecurityLib\Strength;

final class CreateNewGuest
{
    /** @var GuestFormHandler */
    private $guestFormHandler;

    public function __construct(GuestFormHandler $guestFormHandler)
    {
        $this->guestFormHandler = $guestFormHandler;
    }

    public function __invoke(Request $request)
    {
        $factory = new Factory;
        $generator = $factory->getGenerator(new Strength(Strength::MEDIUM));

        DB::transaction(function () use ($request, $generator) {
            $guest = new Guest(array_merge($request->except(['is_ready']), [
                'id'       => $guestId = strval(Uuid::uuid4()),
                'is_ready' => $request->input('is_ready') === "on",
            ]));

            $invite = new Invite([
                'id'         => Uuid::uuid4(),
                'guest_a'    => $guestId,
                'note'       => "",
                'access_key' => $generator->generateString(
                    256,
                    "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"
                ),
                'short_code' => $generator->generateString(
                    8,
                    "23456789ABCDEFGHJKLMNPQRSTUVWXYZ"
                ),
            ]);

            $guest->save();
            $invite->save();

            $this->guestFormHandler->saveRelatedGuestData($request, $guest);
        });

        return redirect("/admin/guests");
    }
}
