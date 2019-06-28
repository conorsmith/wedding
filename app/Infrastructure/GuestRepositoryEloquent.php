<?php
declare(strict_types=1);

namespace ConorSmith\Wedding\Infrastructure;

use ConorSmith\Wedding\Domain\Guest;
use ConorSmith\Wedding\Domain\GuestRepository;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

final class GuestRepositoryEloquent implements GuestRepository
{

    public function allByFirstName(): iterable
    {
        $models = \ConorSmith\Wedding\Guest::orderBy('first_name')->get();

        return $models
            ->map(function (\ConorSmith\Wedding\Guest $model) {
                return $this->reconstitute($model);
            })
            ->toArray();
    }

    public function allByLastName(): iterable
    {
        $models = \ConorSmith\Wedding\Guest::orderBy('last_name')->get();

        return $models
            ->map(function (\ConorSmith\Wedding\Guest $model) {
                return $this->reconstitute($model);
            })
            ->toArray();
    }

    public function allInvitedByLastName(): iterable
    {
        $models = \ConorSmith\Wedding\Guest::where('is_invited', true)
            ->orderBy('last_name')
            ->get();

        return $models
            ->map(function (\ConorSmith\Wedding\Guest $model) {
                return $this->reconstitute($model);
            })
            ->toArray();
    }

    public function find(UuidInterface $id): ?Guest
    {
        $model = \ConorSmith\Wedding\Guest::find($id);

        if (is_null($model)) {
            return null;
        }

        return $this->reconstitute($model);
    }

    public function save(Guest $guest): void
    {
        $model = \ConorSmith\Wedding\Guest::find($guest->getId());

        $model->fill([
            'is_attending' => $guest->isAttending(),
        ]);

        $model->save();
    }

    private function reconstitute(\ConorSmith\Wedding\Guest $model): Guest
    {
        return new Guest(
            Uuid::fromString($model->id),
            $model->getPartner() ? Uuid::fromString($model->getPartner()->id) : null,
            $model->first_name,
            $model->last_name,
            $model->email,
            $model->phone,
            $model->address,
            boolval($model->is_ready),
            boolval($model->receive_email),
            boolval($model->receive_physical),
            boolval($model->is_invited),
            boolval($model->is_invited_afters),
            boolval($model->is_attending)
        );
    }
}
