<?php

class CatalogController {
    public function index($id = null) {
        $pageContent = 'Views/Catalog/index.php'; // Set the page-specific content
        include "Views/Shared/_Layout.php";
    }

    public function tops($id = null) {
        $pageContent = 'Views/Catalog/tops.php'; // Set the page-specific content
        include "Views/Shared/_Layout.php";
    }
}
?>
