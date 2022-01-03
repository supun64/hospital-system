<?php require APP_ROOT . '/views/includes/header.php';  ?>

<body class="index-body align-items-center">
  <section class="index-main">
    <div class="container">
      <div class="index-row no-gutters">
        <div class="col-lg-6">
          <img src="<?php echo URL_ROOT; ?>/public/images/family1.jpeg" class="index-img img-fluid" alt="family">
        </div>
        <div class="col-lg-6 index-login-form text-center px-5 py-3">

          <div class="index-form-container">

            <h3 class="font-weight-bold py-3">
              COVID DETAILS HANDLING <br>SYSTEM
            </h3>

            <form action="<?php echo URL_ROOT; ?>/users/index" method="POST">
              <div class="form-row">
                <div class="form-group col-md-12 index-input-container">
                  <select id="Hospital" name='slct-hos' class="form-control form-select">
                    <option value="" disabled selected hidden>
                      Select your hospital
                    </option>
                    <?php foreach ($data as $hospital) : ?>

                      <option value="<?php echo $hospital['is_registered'] . "," . $hospital['hospital_id']; ?>"><?php echo $hospital['hospital_id'] . ". " . $hospital['name']; ?></option>
                    <?php endforeach; ?>
                  </select>



                </div>

              </div>
              <div class="form-row index-form-row">
                <div class="col-lg-6 index-btn-container">
                  <button id='reg_btn' name='register-submit' type="submit" class="index-btn1" disabled>
                    Register
                  </button>
                </div>
                <div class="col-lg-6 index-btn-container">
                  <button id='login_btn' name='login-submit' type="submit" class="index-btn1" disabled>
                    Login
                  </button>
                </div>
              </div>
            </form>



          </div>

          <p class="mt-5 mb-0 text-muted index-team-logo"> Squ4dOption &trade;</p>

        </div>
      </div>
    </div>
  </section>
</body>

<script src="<?= URL_ROOT ?>./public/script/index.js"></script>

<?php require_once APP_ROOT . "/views/includes/footer.php" ?>