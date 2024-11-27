<?php
include_once "base/baseController.php";  // Adjust the path as needed

class AccountController extends BaseController
{
    public function index($id = null)
    {
        $this->view('index');
    }

    public function register($id = null)
    {
        $this->view('register');
    }

    public function login($id = null)
    {
        $this->view('login');
    }
}
