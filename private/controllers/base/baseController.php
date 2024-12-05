<?php
class BaseController
{
    protected $authenticated = false;
    protected $user = null;

    public function __construct()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $this->checkAuthentication();
    }

    // Check if the user is authenticated
    protected function CheckAuthentication()
    {
        if (isset($_SESSION["userid"])) {
            $this->authenticated = true;
            $this->user = $_SESSION["userid"];  // Store the user ID or other relevant session info
        }
    }
    /**
     * Check if the user is authenticated.
     *
     * @return bool
     */
    public function IsAdmin()
    {
        if ($_SESSION["user_type"] == "Admin") {
            return true;
        }
        return false;
    }
    /**
     * Check if the user is authenticated.
     *
     * @return bool
     */
    public function IsAuthenticated()
    {
        return $this->authenticated;
    }

    /**
     * Get the authenticated user (if available).
     *
     * @return mixed|null
     */
    public function GetAuthenticatedUser()
    {
        return $this->user;
    }


    public function View($Model)
    {
        // Ensure that the $model is an object
        if (!is_object($Model)) {
            // Optionally throw an exception or handle the error if $model is not an object
            throw new InvalidArgumentException('Expected an object, but received something else.');
        }

        // Get the controller name from the class name
        $controllerName = str_replace('Controller', '', get_class($this));  // e.g., "ProductController"

        // Infer the action name from the method where View() is called
        $action = debug_backtrace()[1]['function']; // This gets the calling function name

        // Construct the path to the view file
        $viewPath = __DIR__ . '/../../Views/' . $controllerName . '/' . $action . '.php';

        // Check if the view file exists
        if (!file_exists($viewPath)) {
            $viewPath = __DIR__ . '/../../Views/Error/HttpNotFound.php';
        }

        // Set the page content for the layout
        $pageContent = $viewPath;

        // Include the layout file
        include_once __DIR__ . '/../../Views/Shared/_Layout.php';
    }
}
