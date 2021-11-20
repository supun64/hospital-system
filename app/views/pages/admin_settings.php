<?php require_once APP_ROOT."/views/pages/admin_dashboard.php"?>
<div class= 'sub-division'>
    <!--put the content here-->
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-12 col-lg-10 col-xl-8 mx-auto">
          <h2 class="h3 mb-4 page-title">Settings</h2>
          <div class="my-4">
            <!-- Info area -->
            <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
              <li class="nav-item">
                <a class="nav-link active" id="home-tab">Info</a>
              </li>
            </ul>
            <form>
              <hr class="my-4" />
              <div class="form-group">
                <label for="fullname">Full Name</label>
                <input
                  type="text"
                  class="form-control"
                  id="fullname"
                  value="A.B.C.Silva"
                  required=""
                />
              </div>
              <div class="form-row">
                <div class="form-group col-md-7">
                  <label for="email">Email Address</label>
                  <input
                    type="email"
                    class="form-control"
                    id="email"
                    value="abc@example.com"
                    required=""
                  />
                </div>
                <div class="form-group col-md-5">
                  <label for="nic">NIC</label>
                  <input
                    type="text"
                    class="form-control"
                    id="nic"
                    value="998060245v"
                    required=""
                  />
                </div>
              </div>
              <!-- Can't change hospital name -->
              <div class="form-row">
                <div class="form-group col-md-7">
                  <label for="hospitalname">Hospital Name</label>
                  <input
                    type="text"
                    class="form-control"
                    id="hospitalname"
                    value="Gampaha General Hospital"
                    disabled=""
                  />
                </div>
                <div class="form-group col-md-5">
                  <label for="role">Role</label>
                  <input
                    type="text"
                    class="form-control"
                    id="role"
                    value="Clerk"
                    required=""
                  />
                </div>
              </div>
              <div class="form-group">
                <label for="contact_number">Contact Number</label>
                <input
                  type="text"
                  class="form-control"
                  id="contact_number"
                  value="0701234567"
                  required=""
                />
              </div>
              <button type="submit" class="btn btn-dark">Save Changes</button>
            </form>

            <hr class="my-4" />

            <!-- Password Changing area -->
            <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
              <li class="nav-item">
                <a class="nav-link active" id="account-tab">Account</a>
              </li>
            </ul>
            <form>
              <!-- Can't change th user name -->
              <div class="form-group">
                <label for="username">User Name</label>
                <input
                  type="text"
                  class="form-control"
                  id="username"
                  value="gampaha123"
                  disabled=""
                />
              </div>
              <hr class="my-4" />
              <div class="row mb-4">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="inputPassword4">Old Password</label>
                    <input
                      type="password"
                      class="form-control"
                      id="inputPassword5"
                    />
                  </div>
                  <div class="form-group">
                    <label for="inputPassword5">New Password</label>
                    <input
                      type="password"
                      class="form-control"
                      id="inputPassword5"
                    />
                  </div>
                  <div class="form-group">
                    <label for="inputPassword6">Confirm Password</label>
                    <input
                      type="password"
                      class="form-control"
                      id="inputPassword6"
                    />
                  </div>
                </div>
                <div class="col-md-6">
                  <p class="mb-2">Password requirements</p>
                  <p class="small text-muted mb-2">
                    To create a new password, you have to meet all of the
                    following requirements:
                  </p>
                  <ul class="small text-muted pl-4 mb-0">
                    <li>Minimum 8 character</li>
                    <li>At least one special character</li>
                    <li>At least one number</li>
                    <li>Can’t be the same as a previous password</li>
                  </ul>
                </div>
              </div>
              <button type="submit" class="btn btn-dark">
                Update Password
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
</div>
</div>

<script src="<?=URL_ROOT?>./public/script/admin.js"></script>
<?php require_once APP_ROOT."/views/includes/footer.php"?>