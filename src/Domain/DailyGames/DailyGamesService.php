<?php

namespace App\Domain\DailyGames;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use App\Helpers\ApiRequest;
use Psr\Container\ContainerInterface;

class DailyGamesService
{
    private $apiRequest;
    private $tempDir;

    public function __construct(ContainerInterface $container, ApiRequest $apiRequest)
    {
        $this->apiRequest = $apiRequest;
        $this->tempDir = $container->get('settings')['temp'];
    }

    public function getGames(
        ServerRequestInterface $request,
        ResponseInterface $response,
        $args
    ) {
        echo "<pre>";
        print_r($this->processGames());
        return $response;
    }

    public function processGames()
    {
        $output = [
            'outright' => [],
            'double_chance' => [],
        ];

        $g = json_decode(file_get_contents($this->tempDir . '/GetEventsInDailyBundleV3.json'), true);
        if ($g['R'] !== 'OK') return $output;
        $data = $g['D'];

        $groups = $data['G'];
        $events = $data['E'];

        if (!count($events)) return $output;

        shuffle($events);

        $refTime = time() + (6 * 3600);

        foreach ($events as $event) {

            if ($refTime >= strtotime($event['D'])) continue;
            if (empty($event['O']['S_1X2_1'])) continue;
            if (empty($event['O']['S_1X2_2'])) continue;

            $game = [];
            $game['id'] = $event['ID'];
            $game['code'] = $event['C'];
            $game['title'] = $event['N'];
            $game['date'] = explode(" ", $event['D'])[0];
            $game['time'] = explode(" ", $event['D'])[1];
            $game['group'] = $groups[$event['GID']]['N'];
            $game['choice'] = '';
            $game['odds'] = 0;
            $game['market'] = '';

            $o = $event['O'];
            // check for outrights
            if ($o['S_1X2_1'] > $o['S_1X2_2']) {
                if ($o['S_1X2_1'] / $o['S_1X2_2'] > 2.5 && $o['S_1X2_1'] / $o['S_1X2_2'] < 8) {
                    // first team to win
                    $game['choice'] = '2';
                    $game['odds'] = $o['S_1X2_2'];
                    $game['market'] = '1X2';
                    $output['outright'][] = $game;
                }
            } else {
                if ($o['S_1X2_2'] / $o['S_1X2_1'] > 2.5 && $o['S_1X2_2'] / $o['S_1X2_1'] < 8) {
                    // second team to win
                    $game['choice'] = '1';
                    $game['odds'] = $o['S_1X2_1'];
                    $game['market'] = '1X2';
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
                    $output['double_chance'][] = $game;
                }
            }
        }

        return $output;
    }
}
