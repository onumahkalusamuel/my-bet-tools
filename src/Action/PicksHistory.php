<?php

namespace App\Action;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Smarty;
use App\Domain\DailyPicks\DailyPicksService;

class PicksHistory
{
    private $view;
    private $games;

    public function __construct(Smarty $view, DailyPicksService $games)
    {
        $this->view = $view;
        $this->games = $games;
    }

    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response,
        $args
    ) {

        $date = $_GET['date'];
        if (empty($date)) {
            $dates = $this->games->picksHistoryDates();
        } else {
            $games = [];
            $games = $this->games->prepareGamesForDisplay($this->games->getGames($date));
        }

        // fetch the page
        try {
            $this->view->assign('page', 'picks-history');
            $this->view->assign('games', $games);
            $this->view->assign('dates', $dates);
            $header = $this->view->fetch("public/header.tpl");
            $body = $this->view->fetch("public/picks-history.tpl");
            $footer = $this->view->fetch("public/footer.tpl");
            echo $header . $body . $footer;
        } catch (\Exception $e) {
            $this->view->display("500.tpl");
        }
        return $response;
    }
}
