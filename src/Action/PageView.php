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
            $header = $this->view->fetch("public/header.tpl");
            $body = $this->view->fetch("public/pages/{$page}.tpl");
            $footer = $this->view->fetch("public/footer.tpl");
            echo $header . $body . $footer;
        } catch (\Exception $e) {
            $this->view->assign('error', $e->getMessage());
            $this->view->display("500.tpl");
        }
        return $response;
    }
}
