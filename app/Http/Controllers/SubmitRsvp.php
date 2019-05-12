<?php
declare(strict_types=1);

namespace ConorSmith\Wedding\Http\Controllers;

use Auth;
use ConorSmith\Wedding\Invite;
use ConorSmith\Wedding\Response;
use DB;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Ramsey\Uuid\Uuid;

final class SubmitRsvp
{
    public function __invoke(Request $request, string $id)
    {
        if (!$this->authorized($request, $id)) {
            abort(404);
        }

        $validatedInput = $request->validate([
            'attending' => [
                "required",
                "string",
                Rule::in(["0", "1"])
            ],
            'note' => [
                "string",
                "nullable",
            ],
        ]);

        $existingResponse = Response::where('id', $id)->first();

        if (!is_null($existingResponse)) {
            abort(500);
        }


        DB::transaction(function () use ($id, $validatedInput) {

            Response::create([
                'id'        => Uuid::uuid4(),
                'invite'    => $id,
                'attending' => $validatedInput['attending'] === "1",
                'note'      => $validatedInput['note'],
            ]);

            if ($validatedInput['attending'] === "1") {
                $invite = Invite::find($id);

                $invite->guestA->is_attending = true;
                $invite->guestA->save();

                if ($invite->isForTwoGuests()) {
                    $invite->guestB->is_attending = true;
                    $invite->guestB->save();
                }
            }

        });

        return redirect("/invite/{$id}#responded");
    }

    private function authorized(Request $request, $id): bool
    {
        if (!is_null(Auth::user())) {
            return true;
        }

        $invite = Invite::find($id);

        return $invite->access_key === $request->get('key');
    }
}
