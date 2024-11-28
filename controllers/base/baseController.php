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
    protected function checkAuthentication()
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
    public function isAuthenticated()
    {
        return $this->authenticated;
    }

    /**
     * Get the authenticated user (if available).
     *
     * @return mixed|null
     */
    public function getAuthenticatedUser()
    {
        return $this->user;
    }

    /**
     * Render a view.
     *
     * @param string $action The name of the action to render
     * @param array $data Optional data to pass to the view
     */
    public function view($action, $data = [])
    {
        // Get the controller name from the class name
        $controllerName = str_replace('Controller', '', get_class($this));  // e.g. "catalogcontroller"

        // Construct the path to the view file
        $viewPath = 'Views/' . $controllerName . '/' . $action . '.php'; // e.g. 'Views/catalog/index.php'

        // Check if the view file exists
        if (!file_exists($viewPath)) {
            // If the view file doesn't exist, render a 404 error page
            $viewPath = 'Views/Error/404.php';
        }

        // Extract the data array to variables
        if (!empty($data)) {
            extract($data); // Converts the array keys to variables
        }

        // Set the page content for the layout
        $pageContent = $viewPath;

        // Include the layout file and pass the content inside the layout
        include "Views/Shared/_Layout.php"; // _Layout.php will include $pageContent
    }
}
