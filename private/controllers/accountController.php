<?php
/*
 * File Name: accountController.php
 * Purpose: This file hanldes user account operations such as registration, login
 * and log out. 
 * Version: 1.0
 */ 
include_once "base/baseController.php";
include_once __DIR__ . '/../models/ApplicationUser.php';
include_once __DIR__ . '/../viewmodels/accountViewModels.php';
include_once __DIR__ . "/../models/db.php";



class AccountController extends BaseController
{
    public function Index($id = null)
    {
        $this->view('index');
    }
   
    public function Register()
    {

        // if user is logged in, redirect to default page
        if ($this->isAuthenticated()) {
            header("Location: /velvetandvine");
            exit;
        }
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


    public function Login($id = null)
    {
        // if user is logged in, redirect to default page
        if ($this->isAuthenticated()) {
            header("Location: /velvetandvine");
            exit;
        }
        $LoginViewModel = new LoginViewModel();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $LoginViewModel->email = $_POST['email'];
            $LoginViewModel->password = $_POST['password'];

            if ($LoginViewModel->validate()) {

                // connect to the DB
                $dbContext = getDatabaseConnection();

                // Read user from the database
                $statement = $dbContext->prepare("SELECT userid, email, password, usertype FROM application_users WHERE email = :email");

                $statement->bindParam(':email', $LoginViewModel->email, PDO::PARAM_STR);

                $statement->execute();

                // Fetch the user
                $user = $statement->fetch(PDO::FETCH_ASSOC);

                if ($user) {
                    $userID = $user['userid'];
                    $email = $user['email'];
                    $password = $user['password'];
                    $user_type = $user['usertype'];

                    if (password_verify($LoginViewModel->password, $password)) {
                        $_SESSION["userid"] = $userID;
                        $_SESSION["email"] = $email;
                        $_SESSION["user_type"] = $user_type;
                        header("Location: /velvetandvine");
                        exit;
                    }
                }

                $LoginViewModel->error = "Email or password invalid";
            }
        }
        // unsuccessful login
        // return view, passing in the viewmodel with the form data
        $this->view('login', ['model' => $LoginViewModel]);
    }

    //method to showcase user profile 
    public function Profile()
{
    // Ensure the user is authenticated
    if (!$this->isAuthenticated()) {
        header("Location: /velvetandvine/account/login");
        exit;
    }

    // Fetch user details from the database
    $userId = $_SESSION['userid'];
    $dbContext = getDatabaseConnection();

    $statement = $dbContext->prepare("SELECT email, firstname, lastname FROM application_users WHERE userid = :userid");
    $statement->bindParam(':userid', $userId, PDO::PARAM_INT);
    $statement->execute();

    $user = $statement->fetch(PDO::FETCH_ASSOC);

    // Check if user was found
    if (!$user) {
        echo "User not found!";
        exit;
    }

    // Pass user data to the view
    $this->view('profile', ['user' => $user]);
    
}
    public function LogOut()
    {

        session_start();

        $_SESSION = array();

        session_destroy();

        header("location: /velvetandvine");
    }


    public function UpdateProfile()
    {
        // Ensure the user is authenticated
        if (!$this->isAuthenticated()) {
            header("Location: /velvetandvine/account/login");
            exit;
        }

        $userID = $_SESSION['userid'];
        $dbContext = getDatabaseConnection();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Get the updated user data from the form
            $email = $_POST['email'];
            $firstname = $_POST['firstname'];
            $lastname = $_POST['lastname'];

            // Update the user's profile in the database
            $stmt = $dbContext->prepare("UPDATE application_users SET email = ?, firstname = ?, lastname = ? WHERE userid = ?");
            $stmt->execute([$email, $firstname, $lastname, $userID]);
           
            // Redirect back to the profile page
            header("Location: /velvetandvine/account/profile");
            exit;
        }

        // Fetch user data from the database
        $stmt = $dbContext->prepare("SELECT userid, email, firstname, lastname FROM application_users WHERE userid = ?");
        $stmt->execute([$userID]);
        $userData = $stmt->fetch(PDO::FETCH_ASSOC);

        // Check if user was found
        if (!$userData) {
            echo "User not found!";
            exit;
        }

        // Populate ApplicationUser object
        $user = new ApplicationUser();
        $user->userID = $userData['userid'];
        $user->first_name = $userData['firstname'];
        $user->last_name = $userData['lastname'];
        $user->email = $userData['email'];

        // Pass user data to the view
        $this->view('update_profile', ['user' => $user]);
    }


}
