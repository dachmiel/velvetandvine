<?php
include_once "base/baseController.php";

class ErrorController extends BaseController
{
    public function index($id = null)
    {
        $this->view("Views/error/index.php");
    }

    public function show404()
    {
        $this->view("views/error/404.php");
    }
}
