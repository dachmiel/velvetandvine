<?php
include_once "base/baseController.php";
include_once 'models/ApplicationUser.php';
include_once 'viewmodels/RegisterViewModel.php';

class AccountController extends BaseController
{
    public function index($id = null)
    {
        $this->view('index');
    }

    public function register()
    {
        $user = new ApplicationUser();
        $RegisterViewModel = new RegisterViewModel();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $RegisterViewModel->first_name = $_POST['first_name'];
            $RegisterViewModel->last_name = $_POST['last_name'];
            $RegisterViewModel->email = $_POST['email'];
            $RegisterViewModel->password = $_POST['password'];
            $RegisterViewModel->confirm_password = $_POST['confirm_password'];

            if ($RegisterViewModel->validate()) {

                // connect to the DB
                include "models/db.php";
                $dbContext = getDatabaseConnection();

                // Prepared statement with PDO
                $statement = $dbContext->prepare("SELECT userid FROM application_users WHERE email = :email");
                $statement->bindParam(':email', $RegisterViewModel->email, PDO::PARAM_STR);
                $statement->execute();

                $result = $statement->fetch(PDO::FETCH_ASSOC);

                if ($result) {
                    $RegisterViewModel->email_error = "Email already exists.";
                    $RegisterViewModel->error = true;
                }

                if (!$RegisterViewModel->error) {
                    // Hash the password
                    $hashed_password = password_hash($RegisterViewModel->password, PASSWORD_BCRYPT);
                    // Define user type (default to 'Customer')
                    $user_type = 'Customer'; // You can change this to 'Admin' or other roles if needed

                    // Get the current date and time for created_date field
                    $created_date = date('Y-m-d H:i:s');

                    // Insert new user into the database
                    $statement = $dbContext->prepare("INSERT INTO application_users (email, password, firstname, lastname, createddate, usertype) VALUES (:email, :password, :first_name, :last_name, :created_date, :user_type)");
                    $statement->bindParam(':email', $RegisterViewModel->email, PDO::PARAM_STR);
                    $statement->bindParam(':password', $hashed_password, PDO::PARAM_STR);
                    $statement->bindParam(':first_name', $RegisterViewModel->first_name, PDO::PARAM_STR);
                    $statement->bindParam(':last_name', $RegisterViewModel->last_name, PDO::PARAM_STR);
                    $statement->bindParam(':created_date', $created_date, PDO::PARAM_STR);
                    $statement->bindParam(':user_type', $user_type, PDO::PARAM_STR);

                    if ($statement->execute()) {
                        // Redirect to login after successful registration
                        header("Location: /velvetandvine/account/login");
                        exit;
                    } else {
                        echo "Error registering user!";
                    }
                }
            }
        }
        // unsuccessful register
        // return view, passing in the viewmodel with the form data
        $this->view('register', ['model' => $RegisterViewModel]);
    }


    public function login($id = null)
    {
        $this->view('login');
    }
}
