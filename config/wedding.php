<?php

return [

    'capacity' => (
        ($tables = 100)
        + ($us = 2)
        + ($conorsParents = 2)
        + ($stephsParents = 2)
        + ($groomsmen = 3)
        + ($bridesmaids = 3)
        + ($conorsSister = 1)
        + ($stephsSisters = 3)
        + ($stephsNieces = 2)
    ),

    'rsvpDate' => new \Carbon\Carbon("2019-06-22 00:00:00", "Europe/Dublin"),

];
