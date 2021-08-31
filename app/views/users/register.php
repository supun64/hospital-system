<?php  require APP_ROOT.'/views/includes/header.php';  ?>

<!-- <div style="background-image: linear-gradient(to bottom right,#324ca8,#9dcfe3) ; height:100% ;"> -->
    <div style="height: 100%;">
    <h1 style="text-align:center">Get Registered</h1>

    <form action="<?php echo URL_ROOT; ?>/users/register" method="POST" class="register-wrapper container">
   
    <div class="form-group col-md-6">
    <label for="hospital-id" class="col-form-label-sm">Hospital ID</label>
    <input type="text" readonly class="form-control form-control-sm" id="hospital-id" value="Hospital id">
    </div>

        <div class="form-group col-md-6">
            <label for="hospital-name" class="col-form-label-sm">Hospital Name</label>
            <input type="text" readonly class="form-control form-control-sm" id="hospital-name" value="Hospital name">
        </div>

        <div class="form-group col-md-6">
            <label for="district" class="col-form-label-sm">District</label>
            <input type="text" readonly class="form-control form-control-sm" id="district" value="District">
        </div>



  <div class="form-group col-md-6">
    <label for="contact-number" class="col-form-label-sm">Contact Number</label>
    <input type="text" readonly class="form-control form-control-sm" id="contact-number" value="Contact Number">
  </div>

  <div class="form-group col-md-6">
    <label for="email-address" class="col-form-label-sm">Email address</label>
    <input type="email" readonly class="form-control form-control-sm" id="email-address"  value="Enter email"> 
  </div>

    <br>
    <p>A verification code has been sent to the email adddress. Please Enter the verification code</p>

  <div class="form-group col-md-6">
    <label for="verification-code" class="col-form-label-sm">Verification Code</label>
    <input type="text" class="form-control form-control-sm" id="verification-code" >
  </div>

  <div class="form-group col-md-6">
    <label for="admin" class="col-form-label-sm">Admin User name</label>
    <input type="text" class="form-control form-control-sm" id="admin" placeholder="Enter username"> 
  </div>

  <div class="form-group col-md-6">
    <label for="password" class="col-form-label-sm">Password</label>
    <input type="password" class="form-control form-control-sm" id="password" placeholder="Password">
  </div>

  <div class="form-group col-md-6">
    <label for="confirm-password" class="col-form-label-sm">Confirm Password</label>
    <input type="password" class="form-control form-control-sm" id="confirm-password" placeholder="Confirm password">
  </div>
<br>
  <button type="submit" class="btn btn-outline-primary">Submit</button>

    </form>
</div>

