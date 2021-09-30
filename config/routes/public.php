<?php

use Slim\App;
use Slim\Routing\RouteCollectorProxy;
// use App\Middleware\JsonResponseMiddleware;

return function (App $app) {

    $app->group('/', function (RouteCollectorProxy $group) {

        // page views
        $group->get('', \App\Action\PageView::class)->setName('home');

        $group->post('page/login[/]', \App\Action\LoginAction::class);

        $group->get('logout[/]', \App\Action\LogoutAction::class)->setName('logout');

        $group->get('ref/{referralUserName}[/]', \App\Action\AffiliatesAction::class)->setName('ref');

        $group->post('contact-us[/]', \App\Action\ContactUsAction::class)->setName('contact-us-form');

        $group->get('daily-picks[/]', \App\Action\DailyPicks::class)->setName('daily-picks');

        //catch-all page
        $group->get('page/{page}', \App\Action\PageView::class)->setName('page');

        // crons
        $group->get('crons/processgames', [\App\Domain\DailyGames\DailyGamesService::class, 'getGames'])->setName('page');
    });
};
