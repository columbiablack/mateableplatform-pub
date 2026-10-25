<?php

/**
 * Copyright (c) 2026. Mateable LLC
 */

?>
<section class="">
    <div class="container mt-5" style="max-width:700px;">
        <div class="card shadow-sm">
            <div class="card-header">
                <h4 class="mb-0">Edit Profile</h4>
            </div>

            <div class="card-body">
                <form method="POST" action="/profile/update" enctype="multipart/form-data">

                    <!-- Profile Picture -->
                    <div class="mb-3 text-center">
                        <img src="/images/default-avatar.png"
                             class="rounded-circle mb-3"
                             width="120" height="120">

                        <input type="file" class="form-control" name="avatar">
                    </div>

                    <!-- Username -->
                    <div class="mb-3">
                        <label class="form-label">Username</label>
                        <input
                            type="text"
                            class="form-control"
                            name="username"
                            value="">
                    </div>

                    <!-- Email -->
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input
                            type="email"
                            class="form-control"
                            name="email"
                            value="">
                    </div>

                    <!-- Display Name -->
                    <div class="mb-3">
                        <label class="form-label">Display Name</label>
                        <input
                            type="text"
                            class="form-control"
                            name="display_name">
                    </div>

                    <!-- Bio -->
                    <div class="mb-3">
                        <label class="form-label">Bio</label>
                        <textarea
                            class="form-control"
                            name="bio"
                            rows="4"></textarea>
                    </div>

                    <!-- Password -->
                    <hr>

                    <h6>Change Password</h6>

                    <div class="mb-3">
                        <label class="form-label">Current Password</label>
                        <input
                            type="password"
                            class="form-control"
                            name="current_password">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">New Password</label>
                        <input
                            type="password"
                            class="form-control"
                            name="new_password">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Confirm Password</label>
                        <input
                            type="password"
                            class="form-control"
                            name="confirm_password">
                    </div>

                    <!-- Buttons -->
                    <div class="d-flex justify-content-between">
                        <a href="/profile" class="btn btn-secondary">
                            Cancel
                        </a>

                        <button type="submit" class="btn btn-primary">
                            Save Changes
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</section>
