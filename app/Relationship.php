<?php

namespace ConorSmith\Wedding;

use Illuminate\Database\Eloquent\Model;

class Relationship extends Model
{
    protected $fillable = [
        'id',
        'partner_a',
        'partner_b',
    ];
}
