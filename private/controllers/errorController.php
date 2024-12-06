<?php
/*
 * File Name: errorController.php
 * Purpose: This file handles errors by displaying a "404 Not Found" page. 
 * Version: 1.0
 */
include_once "base/baseController.php";

class ErrorController extends BaseController
{

    public function HttpNotFound()
    {
        $this->view('HttpNotFound');
    }
}
