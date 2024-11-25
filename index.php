<?php
    # require('model/database.php');

    $action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);
    if (!$action) {
        $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
    }

    switch($action) {
        case "tops": 
            include 'views/catalog/tops.php';
            break;
        default:
            $pageContent = 'Views/Home/index.php'; // Set the page-specific content
            include "Views/Shared/_Layout.php";
    }

?>
