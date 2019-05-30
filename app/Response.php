<?php

namespace ConorSmith\Wedding;

use Illuminate\Database\Eloquent\Model;

class Response extends Model
{
    protected $fillable = [
        'id',
        'invite',
        'attending',
        'note',
    ];

    public function getKeyType()
    {
        return 'string';
    }

    public function invite()
    {
        return $this->belongsTo(Invite::class, 'invite');
    }

    public function linkedInvite()
    {
        return $this->belongsTo(Invite::class, 'invite');
    }
}
