<?php

class ProductController{
    public function index() {
        $pageContent = 'Views/Product/index.php'; // Set the page-specific content
        include "Views/Shared/_Layout.php";
    }
}
?>
