<?php require_once APP_ROOT . "/views/pages/admin_dashboard.php" ?>

<div class='sub-division' style="padding: 5px; padding-right:10px;">
    <main class="sub-division-main">
        <!-- code snippet to show error message for existing email -->
        <?php
        if (isset($_GET['duplicate'])) { ?>
            <div class="alert alert-danger alert-dismissible fade show deo-manage-error-box" role="alert">
                <div class="deo-manage-error-text">User email already exist. Restart the process!!!</div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php } ?>

        <div class="data-heading">

            <h1>User Management</h1>
        </div>
        <div class="data-search-bar d-flex flex-row justify-content-between">
            <!-- add new data entry operator-->
            <div class="col-md-1">
                <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#deo-manage-nw-deo-form">
                    &plus;Add New
                </button>
            </div>

            <form class="data-select-box" action="<?php echo URL_ROOT; ?>/pages/user_management" method="POST">
                <div class="input-group mb-3">
                    <input type="text" id="deo-search-bar" class="form-control" placeholder="Search User ID" aria-label="DEO's username" aria-describedby="button-deo-serach">
                    <!-- <button class="btn btn-outline-primary" type="submit" id="button-deo-search">Search</button> -->
                </div>
            </form>
        </div>

        <!-- DEO table -->
        <table class="table table-hover data-table" id="deo-table">
            <thead>
                <tr>
                    <th scope="col">User ID</th>
                    <th scope="col">User Name</th>
                    <th scope="col">Email</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <!-- code snippet to loop through array and show users -->
                <?php foreach ($data['users'] as $deo) : ?>
                    <tr class="data-table-row">

                        <td><?php echo $deo['user_id'] ?></th>
                        <td><?php echo $deo['user_name'] ?></td>
                        <td><?php echo $deo['user_email'] ?></td>

                        <td>
                            <button class='btn btn-light data-update-cus-btn' data-bs-toggle="modal" data-bs-target="#delmodalfor<?= $deo['user_id'] ?>">
                                <i class='bx bxs-trash data-edit-button'></i>
                            </button>

                        </td>


                    </tr>
                <?php endforeach; ?>

            </tbody>
        </table>

        <!-- this is the form for new DEO -->
    </main>
</div>

<!-- Modal -->
<div class="modal fade" id="deo-manage-nw-deo-form" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add New User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">

                <form action="<?php echo URL_ROOT; ?>/pages/user_management" class="row g-3 requires-validation" novalidate method="POST">
                    <div class="col-md-6">
                        <label for="deo_fname" class="form-label">User Name</label>
                        <input type="text" class="form-control" name="deo_username" required>

                    </div>

                    <div class="col-md-6">
                        <label for="deo_mail" class="form-label">Email</label>
                        <input type="text" class="form-control" name="deo_email" aria-describedby="inputGroupPrepend" required>

                    </div>

                    <div class="col-md-6">
                        <label for="password" class="form-label">Temporary Password</label>
                        <input type="password" class="form-control" name="password" id="pwd" required minlength="8" onkeypress="valid_input()">


                    </div>


                    <div class="col-md-6">
                        <label for="confirm_password" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" name="confirm_password" id="cpwd" required minlength="8">
                        <!-- <div class="invalid-feedback">
                                This Field can't be empty
                            </div> -->
                    </div>
                    <div class="pwd-error-msg invisible">
                        <p style="color: red;">Make sure your passwords match.</p>
                    </div>
                    <div id="len-val-pwd" hidden>
                        <p style="color: red;">At least 8 characters required.</p>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="form-close" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" name="nw_deo_submit" onclick="return Validate()" id="deo_sub">Add User</button>
            </div>

            </form>
        </div>
    </div>
</div>

<?php foreach ($data['users'] as $deo) : ?>
    <!--Modal for deleting-->
    <div class="modal fade" id="delmodalfor<?= $deo['user_id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body container">
                    <div class="row">
                        <div class="col">
                            <h3><i class='bx bxs-alarm-exclamation' style='color:#ff0a0a'></i></h3>
                        </div>
                        <div class="col-11">
                            <h5>Are you sure you want to remove <?= $deo['user_name'] ?> ?</h5>
                        </div>
                    </div>
                    <form action="<?php echo URL_ROOT; ?>/pages/user_management" method='POST'>
                        <input type="hidden" name="deo_id_record" value="<?= $deo['user_id'] ?>">

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-danger" name="rm_submit">Confirm</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<script>
    function valid_input() {
        if (document.getElementById("pwd").value.length < 7) {
            document.getElementById("len-val-pwd").hidden = false;
        } else {
            document.getElementById("len-val-pwd").hidden = true;
        }
    }
</script>
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="<?php echo URL_ROOT; ?>/public/script/deo_man.js"></script>
<script>
    // scrypt to active feather icons
    feather.replace()
</script>

<script src="<?= URL_ROOT ?>./public/script/admin.js"></script>
<?php require_once APP_ROOT . "/views/includes/footer.php" ?>

<?php
if ($data['notification']) {
    $data['notification']->send_email($data['email'], $data['subject'], $data['content']);
}
?>