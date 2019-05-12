<?php
declare(strict_types=1);

namespace ConorSmith\Wedding\Infrastructure;

use ConorSmith\Wedding\Domain\Guest;
use ConorSmith\Wedding\Domain\Invite;
use ConorSmith\Wedding\Domain\InviteRepository;
use ConorSmith\Wedding\Domain\Response;
use DomainException;
use Ramsey\Uuid\Uuid;

final class InviteRepositoryEloquent implements InviteRepository
{
    public function findForGuest(Guest $guest): Invite
    {
        $model = \ConorSmith\Wedding\Invite::where('guest_a', $guest->getId())
            ->orWhere('guest_b', $guest->getId())
            ->first();

        if (is_null($model)) {
            throw new DomainException("Guest {$guest->getId()} is missing an invite.");
        }

        $response = is_null($model->response)
            ? null
            : new Response(
                boolval($model->response->attending),
                $model->response->note
            );

        return new Invite(
            Uuid::fromString($model->id),
            Uuid::fromString($model->guest_a),
            is_null($model->guest_b) ? null : Uuid::fromString($model->guest_b),
            $model->note,
            boolval($model->sent),
            $response
        );
    }
}
