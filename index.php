<?php
session_start();

ini_set('display_errors', 1);
error_reporting(E_ALL);

// get the controller, action, and id from the query string
$controller = isset($_GET['controller']) ? $_GET['controller'] : 'catalog'; // default controller is 'catalog'
$action = isset($_GET['action']) ? $_GET['action'] : 'index'; // default action is 'index'
$id = isset($_GET['id']) ? $_GET['id'] : null; // default id is null

// map the controller and action to the appropriate file
$controllerFile = "private/controllers/{$controller}Controller.php"; // e.g. controllers/catalogController.php
if (file_exists($controllerFile)) {
    include $controllerFile; // include the controller file
} else {
    // If controller file doesn't exist, set a 404 error and load the error page
    http_response_code(404); // Set the HTTP response code to 404
    $pageContent = 'private/Views/Error/HttpNotFound.php';
    include "private/Views/Shared/_Layout.php";
    exit;
}

// create the controller object and call the action method
$controllerClass = ucfirst($controller) . "Controller"; // e.g. CatalogController
if (class_exists($controllerClass)) {
    $controllerObject = new $controllerClass(); // create the controller object
    if (method_exists($controllerObject, $action)) {
        $controllerObject->$action($id); // call the action method, passing the optional id
    } else {
        // If action doesn't exist, set a 404 error and load the error page
        http_response_code(404); // Set the HTTP response code to 404
        $pageContent = 'private/Views/Error/HttpNotFound.php';
        include "private/Views/Shared/_Layout.php";
        exit;
    }
} else {
    // If controller class doesn't exist, set a 404 error and load the error page
    http_response_code(404); // Set the HTTP response code to 404
    $pageContent = 'private/Views/Error/HttpNotFound.php';
    include "private/Views/Shared/_Layout.php";
    exit;
}
