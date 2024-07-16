<?php

namespace App\Controllers\Frontend;

use App\Controllers\BaseController;
use App\Filters\TeamSession;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

class Manage extends BaseController
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
    public function disease(): string
    {
        $this->view->setData([
            "page" => "disease"
        ]);
        return $this->view->render("pages/panel/disease");
    }
    public function symptom(): string
    {
        $this->view->setData([
            "page" => "symptom"
        ]);
        return $this->view->render("pages/panel/symptom");
    }
    public function rule(): string
    {
        $this->view->setData([
            "page" => "rule"
        ]);
        return $this->view->render("pages/panel/rule");
    }
    public function implementasi(): string
    {
        $this->view->setData([
            "page" => "implementasi"
        ]);
        return $this->view->render("pages/panel/implementasi");
    }
}
