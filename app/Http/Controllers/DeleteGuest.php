<?php
declare(strict_types=1);

namespace ConorSmith\Wedding\Http\Controllers;

use ConorSmith\Wedding\Guest;

final class DeleteGuest
{
    public function __invoke(string $id)
    {
        Guest::find($id)->delete();

        return redirect("/admin/guests");
    }
}
