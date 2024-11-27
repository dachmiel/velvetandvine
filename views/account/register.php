<?php
$first_name = '';
$last_name = '';
$email = '';
$password = '';
$confirm_password = '';

$first_name_error = '';
$last_name_error = '';
$email_error = '';
$password_error = '';
$confirm_password_error = '';

$error = false;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if (empty($first_name)) {
        $first_name_error = "First name is required";
        $error = true;
    }
    if (empty($last_name)) {
        $last_name_error = "Last name is required";
        $error = true;
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $email_error = "Email format is not valid";
        $error = true;
    }
    if (strlen($password) < 6) {
        $password_error = "Password must have at least 6 characters";
        $error = true;
    }
    if ($confirm_password != $password) {
        $confirm_password_error = "Passwords do not match";
        $error = true;
    }
}
?>

<main>
    <div class="container py-4">
        <div class="row">
            <div class="col-lg-6 mx-auto border shadow p-4">
                <h2>Register</h2>
                <hr />
                <form method="POST">
                    <div class="row mb-3">
                        <label class="col-sm-4 col-form-label">First Name*</label>
                        <div class="col-sm-8">
                            <input class="form-control" name="first_name" value="<?= $first_name ?>">
                            <span class="text-danger"><?= $first_name_error ?></span>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-4 col-form-label">Last Name*</label>
                        <div class="col-sm-8">
                            <input class="form-control" name="last_name" value="<?= $last_name ?>">
                            <span class="text-danger"><?= $last_name_error ?></span>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-4 col-form-label">Email*</label>
                        <div class="col-sm-8">
                            <input class="form-control" name="email" value="<?= $email ?>">
                            <span class="text-danger"><?= $email_error ?></span>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-4 col-form-label">Password*</label>
                        <div class="col-sm-8">
                            <input class="form-control" type="password" name="password">
                            <span class="text-danger"><?= $password_error ?></span>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-4 col-form-label">Confirm Password*</label>
                        <div class="col-sm-8">
                            <input class="form-control" type="password" name="confirm_password">
                            <span class="text-danger"><?= $confirm_password_error ?></span>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="offset-sm-4 col-sm-4 d-grid">
                            <button type="submit" class="btn submit-btn">Register</button>
                        </div>
                        <div class="col-sm-4 d-grid">
                            <a href="/velvetandvine/home" class="btn cancel-btn">Cancel</a>
                        </div>
                    </div>


                </form>
            </div>
        </div>
    </div>
</main>
