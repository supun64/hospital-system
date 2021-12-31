<?php require_once APP_ROOT . "/views/pages/user_dashboard.php" ?>
<div class='sub-division'>

    <?php $cur_hos = $_SESSION['hospital_id']; ?>
    <input type="text" id="cur-hos" hidden value="<?php echo $cur_hos ?>">

    <body>
        <?php
        if (isset($_GET['not-user'])) { ?>
            <div class="alert alert-danger alert-dismissible fade show deo-manage-error-box" role="alert">
                <div class="deo-manage-error-text"> Wrong Health ID !!</div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php } ?>

        <?php
        if (isset($_GET['success'])) { ?>
            <div class="alert alert-success alert-dismissible fade show deo-manage-error-box" role="alert">
                <div class="deo-manage-error-text"> Record successfully added</div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php } ?>

        <section class="main-info">

            <main class="sub-division-main">


                <!-- covid-shrunk-search class should add after the search -->
                <div class="covid-search covid-shrunk-search" id="covid-main-search-engine">
                    <div class="covid-title">
                        <img class="covid-logo antigen-logo" src="<?php echo URL_ROOT; ?>/public/images/antigen-logo.png" alt="covid-19 covid" style="border-radius: 50%; ">
                        <h1 class="text-primary">Rapid Antigen Test</h1>
                    </div>

                    <form class="form mb-3 covid-search-div" method="POST" action="<?php echo URL_ROOT; ?>/pages/antigen">

                        <input type="text" class="covid-search-bar form-control" id="covid-search-bar-input" placeholder="Enter health ID here" name="antigen-search-bar-input" required>

                        <input type="submit" class="btn btn-primary" id="covid-search-btn" name="antigen-search" value="Search">

                    </form>

                </div>

                <!-- This is what should display after search -->
                <?php if ($data["personal"]) { ?>

                    <!-- Add addmination-fade-in-pre-state to add the animation -->
                    <div class="covid-search-result" id="covid-search-result-section">
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add-new-antigen">Add new Antigen +</button>

                        <!-- This is the division to display if the search result available -->




                        <div class="covid-details">

                            <div class="covid-patient-detail">
                                <table id="antigen-table">
                                    <tr>
                                        <th class="covid-detail-title">
                                            Health ID
                                        </th>
                                        <th>
                                            :
                                        </th>


                                        <td class="covid-detail-data">
                                            <?php echo $data['personal']['health_id'] ?>
                                        </td>
                                    </tr>

                                    <tr>
                                        <th class="covid-detail-title">
                                            Name
                                        </th>
                                        <th>
                                            :
                                        </th>


                                        <td class="covid-detail-data">
                                            <?php echo $data['personal']['name'] ?>
                                        </td>
                                    </tr>

                                    <tr>
                                        <th class="covid-detail-title">
                                            Age
                                        </th>
                                        <th>
                                            :
                                        </th>


                                        <td class="covid-detail-data">
                                            <?php echo $data['personal']['dob'] ?>
                                        </td>
                                    </tr>
                                </table>
                            </div>

                            <?php if ($data['antigen_tests']) { ?>
                                <!-- These are the vaccination details -->

                                <div class="covid-previous-details">

                                    <div class="covid-tr covid-top-tr">
                                        <div class="covid-th covid-td">Antigen ID </div>
                                        <div class="covid-th covid-td">Hospital Id</div>
                                        <div class="covid-th covid-td">Date</div>
                                        <div class="covid-th covid-td">Status</div>
                                        <div class="covid-th covid-td">Conducted Place</div>
                                    </div>


                                    <?php
                                    $antigen_tests = $data["antigen_tests"];
                                    foreach ($antigen_tests as $antigen) :
                                    ?>

                                        <div class="antigen-rw">
                                            <div class="covid-tr" data-bs-toggle="modal" data-bs-target="#antigen-result">
                                                <div class="covid-td">
                                                    <?php echo $antigen["id"] ?>
                                                </div>

                                                <div class="covid-td">
                                                    <?php echo $antigen["hospital_id"] ?>
                                                </div>

                                                <div class="covid-td">
                                                    <?php echo $antigen["date"] ?>
                                                </div>

                                                <div class="covid-td">
                                                    <?php echo $antigen["status"] ?>
                                                </div>

                                                <div class="covid-td">
                                                    <?php echo $antigen["place"] ?>
                                                </div>





                                            </div>
                                        </div>
                                    <?php endforeach; ?>

                                    <!-- TODO: add covid-bottom-tr class to the end of the table -->

                                </div>


                            <?php } else { ?>

                                <!-- This is the division to display if the search result not available -->
                                <div class="covid-details covid-no-result-div">

                                    <div class="covid-sad-face image-centered">
                                        <img class="covid-sad-face-img" src="<?php echo URL_ROOT; ?>/public/images/sad-face.png" alt="">
                                    </div>
                                    <p class="covid-no-result-message">
                                        No search results found
                                    </p>

                                </div>


                            <?php } ?>
                        </div>
                    <?php } ?>




                    </div>

            </main>

            <!-- This is the UI modal for add new vaccinated person -->
            <div class="modal fade" id="add-new-antigen" tabindex="-1" aria-labelledby="vac-forum" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">

                    <form class="modal-content" method="POST" action="<?php echo URL_ROOT; ?>/pages/antigen">
                        <div class="modal-header covid-modal-header">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                            <h5 class="modal-title covid-modal-title" id="antigen-forum">Antigen Test Forum</h5>

                        </div>
                        <div class="modal-body">

                            <div class="col-md-8 covid-input">
                                <label for="inputHealthID" class="form-label-primary label-primary covid-input-label">Patient's Health ID</label>
                                <input type="text" readonly class="form-control form-control-sm" id="inputHealthID" name="add-patient-health-id" value="<?php echo $data['personal']['health_id'] ?>">
                            </div>

                            <div class="col-md-6 covid-input">
                                <label for="inputDate" class="form-label-primary covid-input-label">Tested Date</label>
                                <input type="date" value="<?php echo date('d-m-Y'); ?>" class="form-control covid-input-field" id="inputDate" name="add-patient-antigen-date" required>
                            </div>

                            <div class="col-md-8 covid-input">
                                <label for="inputHospital" class="form-label-primary covid-input-label">Conducted Hospital</label>
                                <input type="text" readonly class="form-control form-control-sm" id="inputHealthID" name="add-patient-hospital" value="<?php echo $data['hospital_id'] ?>">

                            </div>

                            <div class="col-md-8 covid-input">
                                <label for="inputAntigenPlace" class="form-label-primary label-primary covid-input-label">Conducted Place</label>
                                <input type="text" class="form-control covid-input-field" id="inputAntigenPlace" name="add-patient-antigen-place" placeholder="(Optional)">
                            </div>


                            <div class="modal-header test-toggle-modal-header">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body test-toggle-modal-body">

                                <div class="col-md-8 covid-input">
                                    <label for="togBtn" class="form-label label test-toggle-label">Antigen Test result</label>
                                    </label>

                                    <!-- backend purposes only -->
                                    <input type="text" name="final-id" id="hidden-antigen-id" hidden>
                                    <input type="text" name="final-hid" id="hidden-antigen-hid" hidden>
                                    <input type="text" name="final-htid" id="hidden-antigen-htid" hidden value="<?php echo $data['personal']['health_id'] ?>">
                                    <input type="text" name="final-date" id="hidden-antigen-date" hidden>
                                    <input type="text" name="final-place" id="hidden-antigen-place" hidden>
                                    <input type="text" name="final-status" id="hidden-antigen-status" hidden>


                                    <!-- This is the code to toggle button -->
                                    <div class="form-control test-toggle-input">
                                        <label class="switch">
                                            <input type="checkbox" class="toggle-input" id="antigen-togBtn">
                                            <div class="slider round">
                                                <!--ADDED HTML -->
                                                <span class="on toggle-font">Positive</span>
                                                <span class="off toggle-font">Negative</span>
                                                <!--END-->
                                            </div>
                                        </label>


                                    </div>
                                    <div class="modal-footer covid-modal-footer">
                                        <button type="submit" class="btn btn-primary covid-submit-btn" name="add-patient-submit">Submit</button>
                                    </div>
                    </form>
                </div>
            </div>
        </section>
</div>

<script src="<?= URL_ROOT ?>./public/script/admin.js"></script>
<script src="<?php echo URL_ROOT; ?>/public/script/test.js"></script>
<script src="<?php echo URL_ROOT; ?>/public/script/antigen.js"></script>
<?php require_once APP_ROOT . "/views/includes/footer.php" ?>