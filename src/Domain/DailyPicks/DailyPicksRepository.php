<?php

namespace App\Domain\DailyPicks;

use App\Base\Repository;

class DailyPicksRepository extends Repository
{
    protected $table = "daily_picks";
    protected $properties = [
        'id',
        'game_id',
        'type',
        'acc_group',
        'code',
        'title',
        'date',
        'time',
        'group',
        'choice',
        'odds',
        'market',
        'result',
        'status'
    ];
}
