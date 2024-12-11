<!-- 
* File Name: profile.php
* Purpose: This file displays the user's profile information.
* It includes fields like email, first name, and last name, styled to match the login page.
* Version: 1.0
-->
<main>
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-6 mx-auto border shadow p-4">
                <h2>Welcome, <?= htmlspecialchars($user['firstname']) ?>!</h1></h2>
                <hr />

                <?php if (empty($user)) { ?>
                    <div class="alert alert-danger alert-dismissable fade show" role="alert">
                        <strong>User data could not be loaded!</strong>
                    </div>
                <?php } else { ?>
                    <div class="row mb-3">
                        <label class="col-sm-4 col-form-label"><strong>Email:</strong></label>
                        <div class="col-sm-8">
                            <p class="form-control-plaintext"><?= htmlspecialchars($user['email']) ?></p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-4 col-form-label"><strong>First Name:</strong></label>
                        <div class="col-sm-8">
                            <p class="form-control-plaintext"><?= htmlspecialchars($user['firstname']) ?></p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-4 col-form-label"><strong>Last Name:</strong></label>
                        <div class="col-sm-8">
                            <p class="form-control-plaintext"><?= htmlspecialchars($user['lastname']) ?></p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="offset-sm-4 col-sm-4 d-grid">
                            <a href="/velvetandvine/account/logout" class="btn submit-btn">Log Out</a>
                        </div>
                        <div class="col-sm-4 d-grid">
                            <a href="/velvetandvine/home" class="btn cancel-btn">Cancel</a>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</main>
