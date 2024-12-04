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


class RegisterViewModel
{
    public $first_name = '';
    public $last_name = '';
    public $email = '';
    public $password = '';
    public $confirm_password = '';

    public $first_name_error = '';
    public $last_name_error = '';
    public $email_error = '';
    public $password_error = '';
    public $confirm_password_error = '';

    public $error = false;

    public function Validate()
    {
        // Perform validation checks and set error messages if needed

        if (empty($this->first_name)) {
            $this->first_name_error = "First name is required";
            $this->error = true;
        }
        if (empty($this->last_name)) {
            $this->last_name_error = "Last name is required";
            $this->error = true;
        }
        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $this->email_error = "Email format is not valid";
            $this->error = true;
        }
        if (strlen($this->password) < 6) {
            $this->password_error = "Password must have at least 6 characters";
            $this->error = true;
        }
        if ($this->confirm_password !== $this->password) {
            $this->confirm_password_error = "Passwords do not match";
            $this->error = true;
        }

        return !$this->error; // returns true if no errors
    }
}
