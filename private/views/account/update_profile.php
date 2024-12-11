<!-- 
* File Name: update_profile.php
* Purpose: This file displays allows the user to update their profile information. 
* Users can change their name, last name, and email. 
* Version: 1.0
-->

<main>
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-6 mx-auto border shadow p-4">
                <h2>Update Profile</h2>
                <hr />

                <form method="POST" action="/velvetandvine/account/updateprofile"> <!-- Correct form action -->
                    <div class="row mb-3">
                        <label class="col-sm-4 col-form-label"><strong>Email:</strong></label>
                        <div class="col-sm-8">
                            <input type="email" class="form-control" name="email" value="<?= htmlspecialchars($user->email ?? '') ?>" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-4 col-form-label"><strong>First Name:</strong></label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="firstname" value="<?= htmlspecialchars($user->first_name ?? '') ?>" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-4 col-form-label"><strong>Last Name:</strong></label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="lastname" value="<?= htmlspecialchars($user->last_name ?? '') ?>" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="offset-sm-4 col-sm-4 d-grid">
                            <button type="submit" class="btn submit-btn">Save Changes</button>
                        </div>
                    </div>
                </form>

                <div class="row mb-3">
                    <div class="offset-sm-4 col-sm-4 d-grid">
                        <a href="profile" class="btn cancel-btn">Back to Profile</a>
                    </div>
                </div>
            </div>
        </div>
    </div>