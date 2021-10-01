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

        $group->get('contact-us[/]', \App\Action\ContactUs::class)->setName('contact-us');
        $group->post('contact-us[/]', \App\Action\ContactUsSubmit::class)->setName('contact-us-submit');

        $group->get('strategies[/]', \App\Action\Strategies::class)->setName('strategies');

        $group->get('stake-calculator[/]', \App\Action\StakeCalculator::class)->setName('stake-calculator');
        $group->get('daily-picks[/]', \App\Action\DailyPicks::class)->setName('daily-picks');
        $group->get('picks-history[/]', \App\Action\PicksHistory::class)->setName('picks-history');


        //catch-all page
        $group->get('page/{page}', \App\Action\PageView::class)->setName('page');

    });
};
