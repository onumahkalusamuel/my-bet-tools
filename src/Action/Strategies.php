<?php

namespace App\Action;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Smarty;

class Strategies
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

        // fetch the page
        try {
            $this->view->assign('page', 'strategies');
            $header = $this->view->fetch("public/header.tpl");
            $body = $this->view->fetch("public/strategies.tpl");
            $footer = $this->view->fetch("public/footer.tpl");
            echo $header . $body . $footer;
        } catch (\Exception $e) {
            $this->view->assign('error', $e->getMessage());
            $this->view->display("500.tpl");
        }
        return $response;
    }
}
