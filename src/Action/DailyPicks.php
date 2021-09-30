<?php

namespace App\Action;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Smarty;
use App\Domain\DailyGames\DailyGamesService;

class DailyPicks
{
    private $view;
    private $games;

    public function __construct(Smarty $view, DailyGamesService $games)
    {
        $this->view = $view;
        $this->games = $games;
    }

    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response,
        $args
    ) {

        $games = $this->games->processGames();
	print_r($games);

        // fetch the page
        try {
            $this->view->assign('page', 'daily-picks');
            $this->view->assign('games', $games);
            $header = $this->view->fetch("public/header.tpl");
            $body = $this->view->fetch("public/daily-picks.tpl");
            $footer = $this->view->fetch("public/footer.tpl");
            echo $header . $body . $footer;
        } catch (\Exception $e) {
            $this->view->display("404.tpl");
        }
        return $response;
    }
}
