<?php
declare(strict_types=1);

namespace ConorSmith\Wedding\Infrastructure\Ui;

use ConorSmith\Wedding\Domain\Guest;

final class PartnerSelectOption
{
    public static function fromGuests(iterable $guests): iterable
    {
        $viewModels = [];

        foreach ($guests as $guest) {
            $viewModels[] = new self($guest);
        }

        return $viewModels;
    }

    public function __construct(Guest $guest)
    {
        $this->id = strval($guest->getId());
        $this->name = "{$guest->getFirstName()} {$guest->getLastName()}";
    }
}
