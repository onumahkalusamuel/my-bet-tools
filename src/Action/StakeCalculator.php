<?php

namespace App\Action;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Smarty;

class StakeCalculator
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
            $this->view->assign('page', 'stake-calculator');
            $this->view->display("public/header.tpl");
            $this->view->display("public/stake-calculator.tpl");
            $this->view->display("public/footer.tpl");
        } catch (\Exception $e) {
            $this->view->display("404.tpl");
        }
        return $response;
    }
}
