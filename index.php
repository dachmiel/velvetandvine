<?php
// get the controller, action, and id from the query string
$controller = isset($_GET['controller']) ? $_GET['controller'] : 'home'; // default controller is 'home'
$action = isset($_GET['action']) ? $_GET['action'] : 'index'; // default action is 'index'
$id = isset($_GET['id']) ? $_GET['id'] : null; // default id is null

// map the controller and action to the appropriate file
$controllerFile = "controllers/{$controller}Controller.php"; // e.g. controllers/homeController.php
if (file_exists($controllerFile)) {
    include $controllerFile; // include the controller file
} else {
    die("Controller {$controller} not found.");
}

// create the controller object and call the action method
$controllerClass = ucfirst($controller) . "Controller"; // e.g. HomeController
if (class_exists($controllerClass)) {
    $controllerObject = new $controllerClass(); // create the controller object
    if (method_exists($controllerObject, $action)) {
        $controllerObject->$action($id); // call the action method, passing the id
    } else {
        die("Action {$action} not found in {$controllerClass}.");
    }
} else {
    die("Controller class {$controllerClass} not found.");
}

?>
