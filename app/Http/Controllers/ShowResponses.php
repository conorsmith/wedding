<?php
declare(strict_types=1);

namespace ConorSmith\Wedding\Http\Controllers;

use ConorSmith\Wedding\Response;

final class ShowResponses
{
    public function __invoke()
    {
        return view('admin.responses', [
            'responses' => Response::orderBy('created_at', 'desc')->get(),
        ]);
    }
}
