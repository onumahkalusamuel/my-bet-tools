<?php

namespace App\Action;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Smarty;
use App\Domain\DailyPicks\DailyPicksService;

class DailyPicks
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

        $games = $this->games->prepareGamesForDisplay($this->games->getGames());

        // fetch the page
        try {
            $this->view->assign('page', 'daily-picks');
            $this->view->assign('games', $games);
            $this->view->display("public/header.tpl");
            $this->view->display("public/daily-picks.tpl");
            $this->view->display("public/footer.tpl");
        } catch (\Exception $e) {
            $this->view->display("404.tpl");
        }
        return $response;
    }
}
