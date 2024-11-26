<?php

class AccountController
{
    public function index($id = null)
    {
        $pageContent = 'Views/account/index.php'; // Set the page-specific content
        include "Views/Shared/_Layout.php";
    }

    public function register($id = null)
    {
        $pageContent = 'Views/account/register.php'; // Set the page-specific content
        include "Views/Shared/_Layout.php";
    }

    public function login($id = null)
    {
        $pageContent = 'Views/account/login.php'; // Set the page-specific content
        include "Views/Shared/_Layout.php";
    }
}
