<?php
include_once "base/baseController.php";

class ErrorController extends BaseController
{

    public function HttpNotFound()
    {
        $this->view('HttpNotFound');
    }
}
