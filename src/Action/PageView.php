<?php

namespace App\Action;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Smarty;

class PageView
{
    private $view;

    public function __construct(Smarty $view)
    {
        $this->view = $view;
    }

    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response,
        $args
    ) {

        // the page name
        $page = $args['page'] ?? 'home';

        // fetch the page
        try {
            $this->view->assign('page', $page);
            $header = $this->view->display("public/header.tpl");
            $body = $this->view->display("public/pages/{$page}.tpl");
            $footer = $this->view->display("public/footer.tpl");
            echo $header . $body . $footer;
        } catch (\Exception $e) {
            $this->view->display("404.tpl");
        }
        return $response;
    }
}
