<?php
if ($_SESSION['is_admin']) {
    require_once APP_ROOT . "/views/pages/admin_dashboard.php";
} else {
    require_once APP_ROOT . "/views/pages/user_dashboard.php";
}

?>
<div class='sub-division'>
    <!--put the content here-->

    <?php
    if (isset($_GET['first'])) { ?>
        <div class="alert alert-info" role="alert">
            🎉 Welcome to CoviDet !! Please change your temporary password
        </div>
    <?php } ?>

    <?php
    if (isset($_GET['error1'])) { ?>
        <div class="alert alert-danger alert-dismissible fade show deo-manage-error-box" role="alert">
            <div class="deo-manage-error-text"> An account with this email address already exists !!</div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php } ?>

    <?php
    if (isset($_GET['error2'])) { ?>
        <div class="alert alert-danger alert-dismissible fade show deo-manage-error-box" role="alert">
            <div class="deo-manage-error-text"> Your current password is incorrect !!</div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php } ?>

    <?php
    if (isset($_GET['success'])) { ?>
        <div class="alert alert-success alert-dismissible fade show deo-manage-error-box" role="alert">
            <div class="deo-manage-error-text"> Updated sccessfully</div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php } ?>

    <main class="sub-division-main">

        <div class="settings-heading data-heading">
            <h1>Settings</h1>
        </div>
        <div class="settings-body row">
            <div class="settings-navigation col-6 col-md-4">
                <div class="settings-info-link">
                    <a href="#settings-info-ul">
                        <!-- <i class='settings-arrow bx bx-right-arrow' style='color:black'  ></i> -->
                        <h5>Account Information</h5>
                    </a>
                </div>
                <div class="settings-password-link settings-link">
                    <a href="#settings-password-ul ">
                        <!-- <i class='settings-arrow bx bx-right-arrow' style='color:black'  ></i> -->
                        <h5>Password Information</h5>
                    </a>
                </div>
            </div>
            <div class="settings-info-password col-12 col-md-8">
                <div class="my-4">
                    <div class="settings-info">
                        <ul class="nav nav-tabs settings-sub-div-title-section mb-4" id="settings-info-ul" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link settings-sub-div-title active" id="home-tab">Account Information</a>
                            </li>
                        </ul>

                        <form action="<?= URL_ROOT; ?>/pages/settings" method="POST">

                            <div class="settings-info-element form-group">
                                <label for="fullname">Full Name</label>
                                <input type="text" class="form-control" id="fullname" required value="<?= isset($data['user_name']) ? $data['user_name'] : ""; ?>" name="users[name]" />
                            </div>
                            <div class=" settings-info-element form-row">
                                <div class="form-group ">
                                    <label for="email">Email Address</label>
                                    <input type="email" class="form-control" id="email" required value="<?= isset($data['user_email']) ? $data['user_email'] : ""; ?>" name="users[email]" />
                                </div>
                            </div>

                            <!-- Can't change hospital name -->
                            <div class="settings-info-element form-row">
                                <div class="form-group col-md-7">
                                    <label for="hospitalname">Hospital Name</label>
                                    <input type="text" class="form-control" id="hospitalname" value="<?= isset($data['hospital_name']) ? $data['hospital_name'] : ""; ?>" disabled="" />
                                </div>
                            </div>
                            <?php if (isset($data['error1'])) : ?>
                                <div class="row mb-4">
                                    <div class="alert alert-danger" role="alert">
                                        <?= $data["error1"] ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <button class='settings-info-element btn btn-primary' type="submit">Save Changes</button>
                    </div>
                    </form>

                </div>

                <!-- Info area -->

                <div class="settings-info">
                    <ul class="nav nav-tabs settings-sub-div-title-section mb-4" id="settings-password-ul" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active settings-sub-div-title" id="account-tab">Password Information</a>
                        </li>
                    </ul>
                    <form class='settings-password-form' action="<?= URL_ROOT; ?>/pages/settings" method="POST">
                        <!-- Can't change th user name -->
                        <div class="settings-info-element form-group">
                            <label for="username">User ID</label>
                            <input type="text" class="form-control" id="username" value="<?= isset($data['user_id']) ? $data['user_id'] : ""; ?>" disabled="" />
                        </div>
                        <hr class="my-4" />
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="settings-info-element form-group">
                                    <label for="inputPassword4">Old Password</label>
                                    <input type="password" class="form-control" id="old_password" name="passwords[old_password]" required minlength="8" />
                                </div>
                                <div class="settings-info-element form-group">
                                    <label for="inputPassword5">New Password</label>
                                    <input type="password" class="form-control" id="new_password" name="passwords[new_password]" required minlength="8" />
                                    <small id="same-password" class="form-text invisible">Your new password can not be same as your recent passwords.</small>
                                </div>
                                <div class="settings-info-element form-group">
                                    <label for="inputPassword6">Confirm Password</label>
                                    <input type="password" class="form-control" id="confirmed_password" name="passwords[confirm_password]" required minlength="8" />
                                    <small id="matching-passwords" class="form-text invisible">Make sure your passwords match.</small>
                                </div>
                                <small id="wrong-confirmed-password" class="form-text invisible">Make sure your password is upto standards.</small>
                            </div>
                            <div class="col-md-6">
                                <p class="settings-info-element mb-2">Password requirements</p>
                                <p class="settings-info-element small text-muted mb-2">
                                    To create a strong password, you have to meet all of the
                                    following requirements:
                                </p>
                                <ul class="settings-info-element small text-muted pl-4 mb-0">
                                    <li>Minimum 8 character.</li>
                                    <li>At least one special character.</li>
                                    <li>At least one capital character.</li>
                                    <li>At least one number.</li>
                                    <li>Can’t be the same as a previous password.</li>
                                </ul>
                            </div>
                        </div>
                        <?php if (isset($data['error2'])) : ?>
                            <div class="row mb-4">
                                <div class="alert alert-danger" role="alert">
                                    <?= $data["error2"] ?>
                                </div>
                            </div>
                        <?php endif; ?>
                        <div class="settings-info-element row mb-4">
                            <div class="col-md-6" style="padding-left: 0;">
                                <button type="submit" name='password-changed' class="btn btn-primary" onclick="return validate_password()">
                                    Update Password
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- Password Changing area -->
            </div>
        </div>
</div>
</main>
</div>
<script src="<?= URL_ROOT ?>./public/script/admin.js"></script>
<?php require_once APP_ROOT . "/views/includes/footer.php" ?>