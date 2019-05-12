<?php
declare(strict_types=1);

namespace ConorSmith\Wedding\Http\Controllers;

use ConorSmith\Wedding\Domain\GuestRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;

final class ToggleGuestAttending
{
    /** @var GuestRepository */
    private $guestRepo;

    public function __construct(GuestRepository $guestRepo)
    {
        $this->guestRepo = $guestRepo;
    }

    public function __invoke(Request $request, string $id)
    {
        $id = Uuid::fromString($id);
        $isAttending = $request->input('isAttending') === "1";

        $guest = $this->guestRepo->find($id);

        $guest->setIsAttending($isAttending);

        $this->guestRepo->save($guest);

        return new JsonResponse([]);
    }
}
