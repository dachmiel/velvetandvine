<?php
include_once "base/baseController.php";

class ErrorController extends BaseController
{
    public function Index($id = null)
    {
        $this->view("Views/error/index.php");
    }

    public function Show404()
    {
        $this->view("views/error/404.php");
    }
}
