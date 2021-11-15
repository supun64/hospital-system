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
                            HOSPITAL DATA MANAGEMENT SYSTEM
                        </h3>
                        <h2></h2>
                        <form>
                            <div class="form-row">
                                <div class="form-group col-md-12 index-input-container">
                                    <select id="Hospital" class="form-control form-select">
                                        <option value="" disabled selected hidden>
                                            Select your hospital
                                        </option>
                                        <option>Colombo National Hospital</option>
                                        <option>Gampaha Base Hospital</option>
                                        <option>Anuradhapura General Hospital</option>
                                        <option>Kalutara Base Hospital</option>
                                        <option>Karapitiya Teaching Hospital</option>
                                        <option>Kandy National Hospital</option>
                                        <option>Batticaloa Teaching Hospital</option>
                                        <option>Jaffna Teaching Hospital</option>
                                        <option>Ragama Teaching Hospital</option>
                                    </select>
                                </div>

                            </div>
                            <div class="form-row">
                                <div class="col-lg-6 index-btn-container">
                                    <button type="submit" class="index-btn1">
                                        Register
                                    </button>
                                </div>
                                <div class="col-lg-6 index-btn-container">
                                    <button type="submit" class="index-btn1">
                                        Login
                                    </button>
                                </div>
                            </div>
                        </form>

                    </div>

                </div>
            </div>
        </div>
    </section>
</body>



<!-- <div class="select-box">
                  <div class="options-container">
                    <div class="option">
                      <input
                        type="radio"
                        class="radio"
                        id="National_h"
                        name="category"
                      />
                      <label for="National_h">Colombo National Hospital</label>
                    </div>

                    <div class="option">
                      <input
                        type="radio"
                        class="radio"
                        id="Gampaha_bh"
                        name="category"
                      />
                      <label for="Gampaha_bh">Gampaha Base Hospital</label>
                    </div>

                    <div class="option">
                      <input
                        type="radio"
                        class="radio"
                        id="Anuradhapura_gh"
                        name="category"
                      />
                      <label for="Anuradhapura_gh"
                        >Anuradhapura General Hospital</label
                      >
                    </div>

                    <div class="option">
                      <input
                        type="radio"
                        class="radio"
                        id="Kalutara_Bh"
                        name="category"
                      />
                      <label for="Kalutara_Bh">Kalutara Base Hospital</label>
                    </div>

                    <div class="option">
                      <input
                        type="radio"
                        class="radio"
                        id="Karapitiya_th"
                        name="category"
                      />
                      <label for="Karapitiya_th"
                        >Karapitiya Teaching Hospital
                      </label>
                    </div>

                    
                    <div class="option">
                      <input
                        type="radio"
                        class="radio"
                        id=" Jaffna_th"
                        name="category"
                      />
                      <label for=" Jaffna_th">Jaffna Teaching Hospital</label>
                    </div>
                  </div>

                  <div class="selected">Select your Hospital</div>

                  <div class="search-box">
                    <input type="text" placeholder="Type here..." />
                  </div>
                </div> -->