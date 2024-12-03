<?php
include_once "base/baseController.php";

class ErrorController extends BaseController
{

    public function Show404()
    {
        $this->view('404');
    }
}
