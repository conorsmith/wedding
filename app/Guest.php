<?php

namespace ConorSmith\Wedding;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Guest extends Model
{
    protected $fillable = [
        'id',
        'first_name',
        'last_name',
        'email',
        'phone',
        'address',
        'receive_email',
    ];

    /** @var ?self */
    private $partner;

    /** @var bool */
    private $partnerIsSet = false;

    /** @var ?Invite */
    private $invite;

    public function getKeyType()
    {
        return 'string';
    }

    public function getPartner(): ?self
    {
        if ($this->partnerIsSet) {
            return $this->partner;
        }

        $rows = DB::select("SELECT * FROM relationships WHERE partner_a = ? OR partner_b = ?", [
            $this->id,
            $this->id,
        ]);

        if (count($rows) === 0) {
            return null;
        }

        $relationship = (array) $rows[0];

        if ($relationship['partner_a'] === $this->id) {
            $partnerId = $relationship['partner_b'];
        } else {
            $partnerId = $relationship['partner_a'];
        }

        $this->partner = self::find($partnerId);
        $this->partnerIsSet = true;

        return $this->partner;
    }

    public function hasPartner(): bool
    {
        return !is_null($this->getPartner());
    }

    public function getInvite(): Invite
    {
        if (!is_null($this->invite)) {
            return $this->invite;
        }

        $this->invite = Invite::where('guest_a', $this->id)
            ->orWhere('guest_b', $this->id)
            ->first();

        return $this->invite;
    }

    public function hasResponded(): bool
    {
        return !is_null($this->getInvite()->response);
    }
}
