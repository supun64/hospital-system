<?php require_once APP_ROOT . "/views/pages/user_dashboard.php" ?>

<div class='sub-division'>

    <?php $cur_hos = $_SESSION['hospital_id']; ?>
    <input type="text" id="cur-hos" hidden value="<?php echo $cur_hos ?>">

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
                    <img class="covid-logo" src="<?php echo URL_ROOT; ?>/public/images/pcr-logo.png" alt="covid-19 covid">
                    <h1 class="text-primary">PCR Tests</h1>
                </div>

                <form class="form mb-3 covid-search-div" method="POST" action="<?php echo URL_ROOT; ?>/pages/pcr">

                    <input type="text" class="covid-search-bar form-control" id="covid-search-bar-input" placeholder="Enter Health ID here" name="pcr-search-bar-input" required>

                    <input type="submit" class="btn btn-primary" id="covid-search-btn" name="pcr-search" value="Search">

                </form>

            </div>

            <!-- This is what should display after search -->
            <?php if (isset($data['personal']) && $data["personal"]) { ?>

                <!-- Add addmination-fade-in-pre-state to add the animation -->
                <div class="covid-search-result" id="covid-search-result-section">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add-new-pcr" id="add-new">Add new PCR +</button>

                    <!-- This is the division to display if the search result available -->




                    <div class="covid-details">

                        <div class="covid-patient-detail">
                            <table class="covid-detail-table" id="pcr-table">
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

                        <?php if (isset($data['pcr_tests'])) { ?>
                            <!-- These are the vaccination details -->

                            <div class="covid-previous-details">

                                <div class="covid-tr covid-top-tr">
                                    <div class="covid-th covid-td">PCR ID </div>
                                    <div class="covid-th covid-td">Hospital ID</div>
                                    <div class="covid-th covid-td">Date</div>
                                    <div class="covid-th covid-td">Status</div>
                                    <div class="covid-th covid-td">Conducted Place</div>
                                </div>


                                <?php
                                $pcr_tests = $data["pcr_tests"];
                                foreach ($pcr_tests as $pcr) :
                                ?>

                                    <div class="pcr-rw">
                                        <div class="covid-tr <?php if ($pcr === $pcr_tests[sizeof($pcr_tests) - 1]) echo 'covid-bottom-tr' ?>" data-bs-toggle="modal" data-bs-target="#pcr-result">
                                            <div class="covid-td">
                                                <?php echo $pcr["id"] ?>
                                            </div>

                                            <div class="covid-td">
                                                <?php echo $pcr["hospital_id"] ?>
                                            </div>

                                            <div class="covid-td">
                                                <?php echo $pcr["date"] ?>
                                            </div>

                                            <div class="covid-td">
                                                <?php echo $pcr["status"] ?>
                                            </div>

                                            <div class="covid-td">
                                                <?php echo $pcr["place"] == "undefined" ? "" : $pcr["place"]; ?>
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
                                    No PCR tests done yet! :(
                                </p>

                            </div>


                        <?php } ?>
                    </div>
                <?php } ?>

        </main>




</div>

<!-- This is the UI modal for add new vaccinated person -->
<div class="modal fade" id="add-new-pcr" tabindex="-1" aria-labelledby="vac-forum" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">

        <form class="modal-content" method="POST" action="<?php echo URL_ROOT; ?>/pages/pcr">
            <div class="modal-header covid-modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                <h5 class="modal-title covid-modal-title" id="vac-forum">PCR Test Forum</h5>

            </div>
            <div class="modal-body">

                <div class="col-md-8 covid-input">
                    <label for="inputHealthID" class="form-label-primary label-primary covid-input-label">Patient's Health ID</label>
                    <input type="text" readonly class="form-control form-control-sm" id="inputHealthID" name="add-patient-health-id" value="<?php echo $data['personal']['health_id'] ?>">
                </div>

                <div class="col-md-6 covid-input">
                    <label for="inputDate" class="form-label-primary covid-input-label">Tested Date</label>
                    <input type="date" value="<?php echo date('d-m-Y'); ?>" class="form-control covid-input-field" id="inputDate" name="add-patient-pcr-date" required>
                </div>

                <div class="col-md-8 covid-input">
                    <label for="inputHospital" class="form-label-primary covid-input-label">Conducted Hospital</label>
                    <input type="text" readonly class="form-control form-control-sm" id="inputHealthID" name="add-patient-hospital" value="<?php echo $data['hospital_id'] ?>">

                </div>

                <div class="col-md-8 covid-input">
                    <label for="inputPCRPlace" class="form-label-primary label-primary covid-input-label">Conducted Place</label>
                    <input type="text" class="form-control covid-input-field" id="inputPCRPlace" name="add-patient-pcr-place" placeholder="(Optional)">
                </div>


            </div>
            <div class="modal-footer covid-modal-footer">
                <button type="submit" class="btn btn-primary covid-submit-btn" name="add-patient-submit">Submit</button>
            </div>
        </form>
    </div>
</div>


<!-- This is the model for updating result of pcr -->
<div class="modal fade" id="pcr-result" tabindex="-1" aria-labelledby="vac-forum" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">

        <form class="modal-content" method="POST" action="<?php echo URL_ROOT; ?>/pages/pcr">

            <div class="modal-header test-toggle-modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body test-toggle-modal-body">

                <div class="col-md-8 covid-input">
                    <label for="togBtn" class="form-label label test-toggle-label">PCR Test result</label>
                    </label>

                    <!-- backend purposes only -->
                    <input type="text" name="final-id" id="hidden-id" hidden>
                    <input type="text" name="final-hid" id="hidden-hid" hidden>
                    <input type="text" name="final-htid" id="hidden-htid" hidden value="<?php echo $data['personal']['health_id'] ?>">
                    <input type="text" name="final-date" id="hidden-date" hidden>
                    <input type="text" name="final-place" id="hidden-place" hidden>
                    <input type="text" name="final-status" id="hidden-status" hidden>


                    <!-- This is the code to toggle button -->
                    <div class="form-control test-toggle-input">
                        <label class="switch">
                            <input type="checkbox" class="toggle-input" id="togBtn">
                            <div class="slider round">
                                <!--ADDED HTML -->
                                <span class="on toggle-font">Positive</span>
                                <span class="off toggle-font">Negative</span>
                                <!--END-->
                            </div>
                        </label>
                    </div>
                </div>
            </div>
            <div class="modal-footer test-toggle-footer">
                <button type="submit" class="btn btn-primary pcr-toggle-submit-btn" name="update-patient-submit" id="update-btn">Update</button>
            </div>
        </form>
    </div>
    </section>
</div>


<script>
    <?php if (isset($data['personal']) && ($data['personal']['is_alive'] == 0)) { ?>
        document.getElementById("add-new").disabled = true;
    <?php } ?>
</script>

<script src="<?= URL_ROOT ?>./public/script/admin.js"></script>
<script src="<?php echo URL_ROOT; ?>/public/script/test.js"></script>
<script src="<?php echo URL_ROOT; ?>/public/script/pcr.js"></script>

<?php require_once APP_ROOT . "/views/includes/footer.php" ?>

<!--email-->
<?php
if (isset($data['notification']) && isset($_GET['updated'])) {
    $data['notification']->send_email($data['email'], $data['subject'], $data['content']);
}
?>