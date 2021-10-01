<?php

namespace App\Domain\DailyPicks;

use App\Helpers\ApiRequest;
use App\Domain\DailyPicks\DailyPicksRepository;

class DailyPicksService
{
    private $apiRequest;
    private $repository;
    private $gamesUrl = "https://sports.bet9ja.com/desktop/feapi/PalimpsestAjax/GetEventsInDailyBundleV3?DISP=1000&DISPH=0&SPORTID=1";

    public function __construct(DailyPicksRepository $repository, ApiRequest $apiRequest)
    {
        $this->apiRequest = $apiRequest;
        $this->repository = $repository;
    }

    public function getGames($date = null)
    {
        if (empty($date) || !\Carbon\Carbon::hasFormat($date, 'Y-m-d')) {
            $date = date('Y-m-d');
        }

        if (empty($this->getGamesFromDb($date))) {
            $this->processNewGames();
        }

        return $this->getGamesFromDb($date);
    }

    public function picksHistoryDates()
    {
        return $this->repository->readAll([
            'select' => ['date'],
            'group_by' => ['date'],
            'order_by' => 'date',
            'order' => 'DESC'
        ]);
    }

    public function getGamesFromDb($date)
    {
        return $this->repository->readAll([
            'params' => [
                'where' => ['date' => $date]
            ]
        ]);
    }

    public function processNewGames(): void
    {
        $output = [
            'outright' => [],
            'double_chance' => [],
        ];

        $g = json_decode($this->apiRequest->getFullText($this->gamesUrl), true);

        if ($g['R'] !== 'OK') return;
        $data = $g['D'];

        $groups = $data['G'];
        $events = $data['E'];

        if (!count($events)) return;

        shuffle($events);

        $refTime = time() + (6 * 3600);
        // $refTime = time() + (6 * 360);

        foreach ($events as $event) {

            if ($refTime >= strtotime($event['D'])) continue;
            if (empty($event['O']['S_1X2_1'])) continue;
            if (empty($event['O']['S_1X2_2'])) continue;

            $game = [];
            $game['game_id'] = $event['ID'];
            $game['code'] = $event['C'];
            $game['title'] = $event['N'];
            $game['date'] = explode(" ", $event['D'])[0];
            $game['time'] = explode(" ", $event['D'])[1];
            $game['group'] = $groups[$event['GID']]['N'];
            $game['choice'] = '';
            $game['odds'] = 0;
            $game['market'] = '';
            $game['type'] = '';
            $game['acc_group'] = '';

            $o = $event['O'];
            // check for outrights
            if ($o['S_1X2_1'] > $o['S_1X2_2']) {
                if ($o['S_1X2_1'] / $o['S_1X2_2'] > 2.5 && $o['S_1X2_1'] / $o['S_1X2_2'] < 8) {
                    // first team to win
                    $game['choice'] = '2';
                    $game['odds'] = $o['S_1X2_2'];
                    $game['market'] = '1X2';
                    $game['type'] = 'outright';
                    $output['outright'][] = $game;
                }
            } else {
                if ($o['S_1X2_2'] / $o['S_1X2_1'] > 2.5 && $o['S_1X2_2'] / $o['S_1X2_1'] < 8) {
                    // second team to win
                    $game['choice'] = '1';
                    $game['odds'] = $o['S_1X2_1'];
                    $game['market'] = '1X2';
                    $game['type'] = 'outright';
                    $output['outright'][] = $game;
                }
            }

            // check for double chance
            if ($o['S_1X2_1'] >  $o['S_1X2_2']) {

                if (
                    $o['S_1X2_1'] / $o['S_1X2_2'] < 3
                    && $o['S_1X2_1'] / $o['S_1X2_2'] > 1.5
                    && !empty($o['S_DC_2X'])
                ) {
                    // first team to win or draw
                    $game['choice'] = '2X';
                    $game['odds'] = $o['S_DC_2X'];
                    $game['market'] = 'DC';
                    $game['type'] = 'double_chance';
                    $output['double_chance'][] = $game;
                }
            } else {
                if (
                    $o['S_1X2_2'] / $o['S_1X2_1'] < 2
                    && $o['S_1X2_2'] / $o['S_1X2_1'] > 1.5
                    && !empty($o['S_DC_1X'])
                ) {
                    // second team to win
                    $game['choice'] = '1X';
                    $game['odds'] = $o['S_DC_1X'];
                    $game['market'] = 'DC';
                    $game['type'] = 'double_chance';
                    $output['double_chance'][] = $game;
                }
            }
        }

        $acc = '';
        $acc_count = 0;

        if (!empty($output['outright'])) {
            shuffle($output['outright']);
            foreach ($output['outright'] as $key => $game) {
                if ($key % 3 === 0) {
                    $acc = uniqid($key);
                    $acc_count++;
                }
                if ($acc_count === 5) break;
                $game['acc_group'] = $acc;
                $this->repository->create(['data' => $game]);
            }
        }

        $acc_count = 0;
        if (!empty($output['double_chance'])) {
            shuffle($output['double_chance']);
            foreach ($output['double_chance'] as $key => $game) {
                if ($key % 3 === 0) {
                    $acc = uniqid($key);
                    $acc_count++;
                }
                if ($acc_count === 5) break;
                $game['acc_group'] = $acc;
                $this->repository->create(['data' => $game]);
            }
        }

        return;
    }

    public function prepareGamesForDisplay(array $games = []): array
    {
        $output = [];

        if (empty($games)) return $output;

        foreach ($games as $game) {
            $output[$game['type']][$game['acc_group']]['games'][] = $game;
            $output[$game['type']][$game['acc_group']]['date'] = $game['date'];
            if (empty($output[$game['type']][$game['acc_group']]['total_odds'])) {
                $output[$game['type']][$game['acc_group']]['total_odds'] = 1;
            }
            $output[$game['type']][$game['acc_group']]['total_odds'] *= $game['odds'];
        }

        return $output;
    }
}
