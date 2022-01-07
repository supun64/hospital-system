<?php  require APP_ROOT.'/views/includes/header.php';  ?>

<body style="background-image: url('<?php echo URL_ROOT; ?>/public/images/dashboard-background.jpg') ;"> 
<!-- code snippet to show error message for existing email -->
<?php 
if(isset($_GET['duplicate'])){?>
    <div class="alert alert-danger alert-dismissible fade show deo-manage-error-box" role="alert" >
        <div class="deo-manage-error-text">User email already exist !!</div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php } ?>

<!-- code snippet to show error message for verification fail -->
<?php 
if(isset($_GET['fail'])){?>
    <div class="alert alert-danger alert-dismissible fade show deo-manage-error-box" role="alert" >
        <div class="deo-manage-error-text">Verifycation failed. Restart the process !!</div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php } ?>

<div class="overlay"></div>


<div class="register-container">
  
                                                    <!-- registration form -->
    <div class="register-wrapper">

        <h3 style="margin: 5px;">Registration Form</h3>
        <hr style="color: black;">
        
        <iframe name="content" style="display:none;"></iframe>
        <form action="<?php echo URL_ROOT; ?>/users/register" method="POST" target="content">       
        <div class="row">   
            <div class="col-sm-4">
                <label for="hospital-id" class="col-form-label-sm">Hospital ID</label>
                <input type="text" readonly class="form-control form-control-sm" id="hospital-id" value="<?php echo $data['hospital_id']; ?>">
            </div>
            <div class="col-sm-4">
                <label for="hospital-name" class="col-form-label-sm">Hospital Name</label>
                <input type="text" readonly class="form-control form-control-sm" id="hospital-name" value="<?php echo $data['name']; ?>">
            </div>
        </div>


        <div class="row">
            <div class="col-sm-4">
                <label for="district" class="col-form-label-sm">District</label>
                <input type="text" readonly class="form-control form-control-sm" id="district" value="<?php echo $data['district']; ?>" >
            </div>
            <div class="col-sm-4">
                <label for="contact-number" class="col-form-label-sm">Contact Number</label>
                 <input type="text" readonly class="form-control form-control-sm" id="contact-number" value="<?php echo $data['contact_num']; ?>">
            </div>
            <div class="col-sm-4">
                <label for="email-address" class="col-form-label-sm">Email address</label>
                <input type="email" readonly class="form-control form-control-sm" id="email-address"  value="<?php echo $data['email']; ?>" name="email"> 
            </div>
        </div>
        
<br>
        <div class="row">
        <div class="col-sm-6"> 
                    <input type="text" name="ran-1" id="ran-id1" hidden>
                    <button type="submit" class="btn btn-outline-primary btn-md" data-bs-toggle="modal"  name="ver-submit" id="verify-btn" onclick="trigger()">
                     Verify Hospital
                    </button>
                    </form>
                    
                
            </div>
        </div>

            <hr>
<form action="<?php echo URL_ROOT; ?>/users/register" method="POST" name="register-form">

        <div class="row">
            <div class="col-sm-4">
                <label for="admin" class="col-form-label-sm">Admin User name</label>
                <input type="text" class="form-control form-control-sm" id="new-admin" placeholder="Enter username" required name="admin-name"> 
            </div>
            <div class="col-sm-4">
                <label for="admin-email" class="col-form-label-sm">Admin Email</label>
                <input type="text" class="form-control form-control-sm"  placeholder="Enter email" required name="admin-email"> 
            </div>

        </div>


        <div class="row">
            <div class="col-sm-4">
                <label for="admin-password" class="col-form-label-sm">Password</label>
                <input type="password" class="form-control form-control-sm" id="admin-password" placeholder="Password" required  minlength="8" name="admin-pwd">
            </div>
            <div class="col-sm-4">
                <label for="admin-confirm-password" class="col-form-label-sm">Confirm Password</label>
                <input type="password" class="form-control form-control-sm" id="admin-confirm-password" placeholder="Confirm password" required minlength="8">
            </div>

            <div class="col-sm-4">
            <label for="verify-code" id="ver-lbl" class="col-form-label-sm" >Verification Code</label>
            <input type="text" class="form-control form-control-sm" id="ver-code" name="verify-code" placeholder="Enter verification code" required > 
             </div>

        </div>

        <div class="pwd-error-msg invisible"><p style="color: red;"> Passwords do not match</p></div>

        <br>
        <input type="text" name="ran-2" id="ran-id2" hidden>
        <div class="col-md-1"> 
            <button type="submit" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" id="complete-btn" name="reg-submit" disabled onclick="return Validate()">
               Continue
            </button>           
        </div>
        <input type="text" readonly class="form-control form-control-sm" name="hos-id" value="<?php echo $data['hospital_id']; ?>" hidden>
        </form>

  
    </div>

 


</div>

<script src="<?php echo URL_ROOT;?>/public/script/register.js"></script>

<?php  require APP_ROOT.'/views/includes/footer.php';  ?>