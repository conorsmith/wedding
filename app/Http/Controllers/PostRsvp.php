<?php
declare(strict_types=1);

namespace ConorSmith\Wedding\Http\Controllers;

use Auth;
use ConorSmith\Wedding\Response;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Ramsey\Uuid\Uuid;

final class PostRsvp
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
            'dietary-requirements' => [
                "string",
                "nullable",
            ],
        ]);

        $existingResponse = Response::where('id', $id)->first();

        if (!is_null($existingResponse)) {
            abort(500);
        }

        Response::create([
            'id'        => Uuid::uuid4(),
            'invite'    => $id,
            'attending' => $validatedInput['attending'] === "1",
            'note'      => $validatedInput['note'],
        ]);

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
