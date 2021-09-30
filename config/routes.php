<?php

use Slim\App;

return function (App $app) {
    (require __DIR__ . '/routes_public.php')($app);
    // (require __DIR__ . '/user.php')($app);
    (require __DIR__ . '/routes_admin.php')($app);
    (require __DIR__ . '/routes_api.php')($app);

    // catchall - for 404 - Not Found
    $app->map(['GET', 'POST', 'PUT', 'DELETE'], '{routes:.+}', function ($request, $response) {
        $view = $this->get(Smarty::class);
        $view->display("404.tpl");
        return $response;
    });
};
