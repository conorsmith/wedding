<?php
declare(strict_types=1);

namespace ConorSmith\Wedding\Infrastructure\Ui;

final class EmptyGuestForm
{
    public function __construct()
    {
        $this->id = null;
        $this->first_name = "";
        $this->last_name = "";
        $this->email = null;
        $this->phone = null;
        $this->address = null;
        $this->is_ready = "0";
        $this->receive_email = "0";
        $this->receive_physical = "0";
        $this->is_attending = "0";
        $this->has_responded = "0";
        $this->invite = (object) [
            'id'                => null,
            'note'              => "",
            'is_for_one_guest'  => "1",
            'is_for_two_guests' => "0",
            'response'          => null,
        ];
        $this->partner = null;
    }
}
