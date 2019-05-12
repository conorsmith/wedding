<?php
declare(strict_types=1);

namespace ConorSmith\Wedding\Http\Controllers;

use Auth;
use ConorSmith\Wedding\Invite;
use ConorSmith\Wedding\Response;
use Illuminate\Http\Request;

final class ViewInvite
{
    public function __invoke(Request $request, $id = null)
    {
        if (!$this->authorized($request, $id)) {
            abort(404);
        }

        return view('invite', [
            'invite'   => Invite::find($id),
            'response' => Response::where('invite', $id)->first(),
            'style'    => $request->get('style', "3"),
        ]);
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
