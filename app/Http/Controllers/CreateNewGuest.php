<?php
declare(strict_types=1);

namespace ConorSmith\Wedding\Http\Controllers;

use ConorSmith\Wedding\Guest;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;

final class CreateNewGuest
{
    public function __invoke(Request $request)
    {
        Guest::create(array_merge($request->all(), [
            'id' => Uuid::uuid4(),
        ]));

        return redirect("/admin/guests");
    }
}
