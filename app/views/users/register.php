<?php  require APP_ROOT.'/views/includes/header.php';  ?>


<body style="background-image: linear-gradient(to right,#324ca8,#9dcfe3) ;"> 

<div class="register-container">
  
                                                    <!-- registration form -->
    <div class="register-wrapper">

        <h3 style="margin: 5px;">Registration Form</h3>
        <hr style="color: black;">
        
        <form action="<?php echo URL_ROOT; ?>/users/login" method="POST" name="register-form">

        <div class="row">   
            <div class="col-sm-4">
                <label for="hospital-id" class="col-form-label-sm">Hospital ID</label>
                <input type="text" readonly class="form-control form-control-sm" id="hospital-id" value="Hospital id">
            </div>
            <div class="col-sm-4">
                <label for="hospital-name" class="col-form-label-sm">Hospital Name</label>
                <input type="text" readonly class="form-control form-control-sm" id="hospital-name" value="Hospital name">
            </div>
        </div>


        <div class="row">
            <div class="col-sm-4">
                <label for="district" class="col-form-label-sm">District</label>
                <input type="text" readonly class="form-control form-control-sm" id="district" value="District">
            </div>
            <div class="col-sm-4">
                <label for="contact-number" class="col-form-label-sm">Contact Number</label>
                 <input type="text" readonly class="form-control form-control-sm" id="contact-number" value="Contact Number">
            </div>
            <div class="col-sm-4">
                <label for="email-address" class="col-form-label-sm">Email address</label>
                <input type="email" readonly class="form-control form-control-sm" id="email-address"  value="Enter email"> 
            </div>
        </div>

            <hr>

        <div class="row">
            <div class="col-sm-4">
                <label for="admin" class="col-form-label-sm">Admin User name</label>
                <input type="text" class="form-control form-control-sm" id="admin" placeholder="Enter username"> 
            </div>
        </div>


        <div class="row">
            <div class="col-sm-4">
                <label for="password" class="col-form-label-sm">Password</label>
                <input type="password" class="form-control form-control-sm" id="password" placeholder="Password">
            </div>
        </div>


        <div class="row">
            <div class="col-sm-4">
                <label for="confirm-password" class="col-form-label-sm">Confirm Password</label>
                <input type="password" class="form-control form-control-sm" id="confirm-password" placeholder="Confirm password">
            </div>
        </div>


        <br>
        <button type="submit" class="btn btn-outline-primary" id="register-submit">Submit</button>

        </form>

  
    </div>

                                                    <!-- vrification code -->

    <!-- <div class="verification-wrapper">

    <form action="<?php echo URL_ROOT; ?>/users/register" method="POST" name="verification-form">
        <div class="row">
            <img src="<?php echo URL_ROOT ;?>/public/images/email.png" alt="email" class="email-img">
        </div>

        <div class="row">
            <h6>A verification code has been sent to the email given. Please enter the verification code below</h5>
        </div>

        <div class="row">
            <div class="col-sm-5">
                <input type="text" class="form-control form-control-sm" id="verify-code" placeholder="Verification Code">
            </div>
        </div>

        <br>
        <div class="verification-btn-grp" style="padding-left:30%;">
            <button type="submit" class="btn btn-outline-primary" name="resend"  style="margin-right: 10px;">Resend</button>
            <button type="submit" class="btn btn-outline-primary" name="verify" style="margin-left: 10px;">Verify</button>
        </div>


    </form>

    </div> -->


</div>

<?php  require APP_ROOT.'/views/includes/footer.php';  ?>