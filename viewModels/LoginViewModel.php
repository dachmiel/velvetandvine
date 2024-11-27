<?php
class LoginViewModel
{

    public $email = '';
    public $password = '';

    public $error = '';


    public function validate()
    {
        // Perform validation checks and set error messages if needed

        if (empty($this->email) || empty($this->password)) {
            $this->error = "Email and password are required!";
            return false;
        }

        return true; // returns true if no errors
    }
}
