<?php

namespace App\Domain\DailyPicks;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use App\Base\Repository;

class DailyPicksRepository extends Repository
{
    protected $table = "daily_picks";

}
