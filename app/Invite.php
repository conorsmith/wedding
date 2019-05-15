<?php

namespace ConorSmith\Wedding;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Invite extends Model
{
    protected $fillable = [
        'id',
        'guest_a',
        'guest_b',
        'note',
        'access_key',
        'short_code',
        'sent',
    ];

    public $incrementing = false;

    protected $keyType = "string";

    public function getSentAtAttribute($value)
    {
        if (is_null($value)) {
            return null;
        }

        return new Carbon($value, "Europe/Dublin");
    }

    public function isForOneGuest(): bool
    {
        return is_null($this->guest_b);
    }

    public function isForTwoGuests(): bool
    {
        return !is_null($this->guest_b);
    }

    public function guestsAreInvited(): bool
    {
        if (!$this->guestA->is_invited) {
            return false;
        }

        if ($this->isForOneGuest()) {
            return true;
        }

        return $this->guestB->is_invited;
    }

    public function guestA()
    {
        return $this->belongsTo(Guest::class, 'guest_a');
    }

    public function guestB()
    {
        return $this->belongsTo(Guest::class, 'guest_b');
    }

    public function response()
    {
        return $this->hasOne(Response::class, 'invite');
    }

    public function getEmailAddresses()
    {
        $emails = [];

        if ($this->guestA->receive_email) {
            $emails[] = $this->guestA->email;
        }

        if ($this->isForTwoGuests() && $this->guestB->receive_email) {
            $emails[] = $this->guestB->email;
        }

        return $emails;
    }

    public function displayEmailAddresses()
    {
        return implode(", ", $this->getEmailAddresses());
    }
}
