<?php

class HomeController {
    public function index($id = null) {
        $pageContent = 'Views/Home/index.php'; // Set the page-specific content
        include "Views/Shared/_Layout.php";
    }

    public function about() {
        $pageContent = 'Views/Home/about.php'; // Set the page-specific content
        include "Views/Shared/_Layout.php";
    }
}
?>
