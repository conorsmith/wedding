<?php

namespace ConorSmith\Wedding;

use Illuminate\Database\Eloquent\Model;

class Invite extends Model
{
    protected $fillable = [
        'id',
        'guest_a',
        'guest_b',
        'note',
        'access_key',
        'sent',
    ];

    public function getKeyType()
    {
        return 'string';
    }

    public function isForOneGuest(): bool
    {
        return is_null($this->guest_b);
    }

    public function isForTwoGuests(): bool
    {
        return !is_null($this->guest_b);
    }

    public function guestA()
    {
        return $this->belongsTo(Guest::class, 'guest_a');
    }

    public function guestB()
    {
        return $this->belongsTo(Guest::class, 'guest_b');
    }
}
