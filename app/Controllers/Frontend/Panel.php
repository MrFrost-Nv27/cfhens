<?php

namespace App\Controllers\Frontend;

use App\Controllers\BaseController;
use App\Filters\TeamSession;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

class Panel extends BaseController
{
    public function initController(
        RequestInterface $request,
        ResponseInterface $response,
        LoggerInterface $logger, ) {
        parent::initController($request, $response, $logger);
        $this->view->setData([
            // "user" => TeamSession::user()
        ]);
    }
    public function index(): string
    {
        $this->view->setData([
            "page" => "dashboard"
        ]);
        return $this->view->render("pages/panel/index");
    }
    public function customer(): string
    {
        $this->view->setData([
            "page" => "customer"
        ]);
        return $this->view->render("pages/panel/customer");
    }
    public function service(): string
    {
        $this->view->setData([
            "page" => "service"
        ]);
        return $this->view->render("pages/panel/service");
    }
    public function order(): string
    {
        $this->view->setData([
            "page" => "order"
        ]);
        return $this->view->render("pages/panel/order");
    }
    public function transaction(): string
    {
        $this->view->setData([
            "page" => "transaction"
        ]);
        return $this->view->render("pages/panel/transaction");
    }
    public function report(): string
    {
        $this->view->setData([
            "page" => "report"
        ]);
        return $this->view->render("pages/panel/report");
    }
    public function user(): string
    {
        $this->view->setData([
            "page" => "user"
        ]);
        return $this->view->render("pages/panel/user");
    }
    public function repair(): string
    {
        $this->view->setData([
            "page" => "repair"
        ]);
        return $this->view->render("pages/panel/repair");
    }
}
