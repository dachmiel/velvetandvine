<?php
include_once "base/baseController.php";  // Adjust the path as needed

class AccountController extends BaseController
{
    public function index($id = null)
    {
        $this->view('index');
    }

    public function register($model)
    {
        // the model should be populated with some data from the form if it is a post
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Handle POST request (form submission)

            // Capture form data
            $email = $_POST['email'] ?? null;
            $password = $_POST['password'] ?? null;
            $confirmPassword = $_POST['confirm_password'] ?? null;
            $firstName = $_POST['first_name'] ?? null;
            $lastName = $_POST['last_name'] ?? null;

            $error = false;

            // Perform validation (basic example)
            if (!$email || !$password || !$confirmPassword || !$firstName || !$lastName) {
                // Show an error message if any required field is missing
                $error = true;
            }

            // Check if the password and confirmPassword match
            if ($password !== $confirmPassword) {
                $error = true;
            }

            // Check if the email already exists
            include "models/db.php";
            $dbContext = getDatabaseConnection();

            // Prepared statement with PDO
            $statement = $dbContext->prepare("SELECT userid FROM application_users WHERE email = :email");
            $statement->bindParam(':email', $email, PDO::PARAM_STR);
            $statement->execute();

            $result = $statement->fetch(PDO::FETCH_ASSOC);

            if ($result) {
                // If email already exists, show an error
                $error = true;
            }

            if (!$error) {
                // Hash the password
                $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
                // Define user type (default to 'Customer')
                $userType = 'Customer'; // You can change this to 'Admin' or other roles if needed

                // Get the current date and time for created_date field
                $createdDate = date('Y-m-d H:i:s');

                // Insert new user into the database
                $statement = $dbContext->prepare("INSERT INTO application_users (email, password, firstname, lastname, createddate, usertype) VALUES (:email, :password, :first_name, :last_name, :created_date, :user_type)");
                $statement->bindParam(':email', $email, PDO::PARAM_STR);
                $statement->bindParam(':password', $hashedPassword, PDO::PARAM_STR);
                $statement->bindParam(':first_name', $firstName, PDO::PARAM_STR);
                $statement->bindParam(':last_name', $lastName, PDO::PARAM_STR);
                $statement->bindParam(':created_date', $createdDate, PDO::PARAM_STR);
                $statement->bindParam(':user_type', $userType, PDO::PARAM_STR);

                if ($statement->execute()) {
                    // Redirect to login after successful registration
                    header("Location: /velvetandvine/account/login");
                    exit;
                } else {
                    echo "Error registering user!";
                }
            }
        }
        // unsuccessful register, some error
        // return view with the model of captured input data
        // show errors
        $this->view('register', $model);

        // if (isset($_SESSION["email"])) {
        //     header("location: /velvetandvine");
        //     exit;
        // }
    }


    public function login($id = null)
    {
        $this->view('login');
    }
}
