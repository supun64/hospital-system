<?php require APP_ROOT . '/views/includes/header.php';  ?>

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


        <!-- covid-shrunk-search class should add after the search -->
        <div class="covid-search covid-shrunk-search" id="covid-main-search-engine">
            <div class="covid-title">
                <img class="covid-logo" src="<?php echo URL_ROOT; ?>/public/images/patient.jpg" alt="covid-19 covid">
                <h1 class="text-primary">COVID 19 Patients</h1>
            </div>

            <form class="form mb-3 covid-search-div" method="POST" action="<?php echo URL_ROOT; ?>/pages/covid_patients">

                <input type="text" class="covid-search-bar form-control" id="covid-search-bar-input" placeholder="Enter health ID here" name="patient-search-bar-input" required>

                <input type="submit" class="btn btn-primary" id="covid-search-btn" name="patient-search" value="Search">

            </form>
            <button class="btn btn-primary" id="covid_death-add" data-bs-toggle="modal" data-bs-target="#add-new-patient">Add New Patient +</button>
        </div>

        <!-- This is what should display after search -->
        <?php if ($data["personal"]) { ?>

            <!-- Add admination-fade-in-pre-state to add the animation -->
            <div class="covid-search-result" id="covid-search-result-section">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#view-history">View History</button>

                <!-- This is the division to display if the search result available -->
                <div class="covid-details">

                    <div class="covid-patient-detail">
                        <table id="patient-table">
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
                                    Birth Day
                                </th>
                                <th>
                                    :
                                </th>

                                <td class="covid-detail-data">
                                    <?php echo $data['personal']['dob'] ?>
                                </td>
                            </tr>

                            <tr>
                                <th class="covid-detail-title">
                                    Gender
                                </th>
                                <th>
                                    :
                                </th>

                                <td class="covid-detail-data">
                                    <?php echo $data['personal']['gender'] ?>
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

                    <?php if ($data['patient_history']) { ?>

                        <div class="covid-previous-details">

                            <div class="covid-tr covid-top-tr">
                                <div class="covid-th covid-td">Admission ID</div>
                                <div class="covid-th covid-td">Hospital Name</div>
                                <div class="covid-th covid-td">Admission Date</div>
                                <div class="covid-th covid-td">Discharge Date</div>
                                <div class="covid-th covid-td">Conditions</div>
                            </div>


                            <?php
                            $patient_history = $data["patient_history"];
                            foreach ($patient_history as $admission) :
                            ?>

                                <div class="pcr-rw">
                                    <div class="covid-tr" data-bs-toggle="modal" data-bs-target="#patient-result">
                                        <div class="covid-td">
                                            <?php echo $admission["admission_id"] ?>
                                        </div>

                                        <div class="covid-td">
                                            <?php echo $admission["hospital_name"] ?>
                                        </div>

                                        <div class="covid-td">
                                            <?php echo $admission["admission_date"] ?>
                                        </div>

                                        <div class="covid-td">
                                            <?php echo $admission["discharge_date"] ?>
                                        </div>

                                        <div class="covid-td">
                                            <?php echo $admission["conditions"] ?>
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

            <!-- This is the UI modal for add new vaccinated person -->
            <div class="modal fade" id="add-new-patient" tabindex="-1" aria-labelledby="vac-forum" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">

                    <form class="modal-content" method="POST" action="<?php echo URL_ROOT; ?>/pages/covid_patients">
                        <div class="modal-header covid-modal-header">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                            <h5 class="modal-title covid-modal-title" id="vac-forum">COVID 19 Patient Admission Form</h5>

                        </div>
                        <div class="modal-body">

                            <div class="col-md-8 covid-input">
                                <label for="inputHealthID" class="form-label-primary label-primary covid-input-label">Patient's Health ID</label>
                                <input type="text" readonly class="form-control form-control-sm" id="inputHealthID" name="add-patient-health-id" value="<?php echo $data['personal']['health_id'] ?>">
                            </div>

                            <div class="col-md-6 covid-input">
                                <label for="inputDate" class="form-label-primary covid-input-label">Admission Date</label>
                                <input type="date" value="<?php echo date('d-m-Y'); ?>" class="form-control covid-input-field" id="inputDate" name="add-patient-admission-date" required>
                            </div>

                            <div class="col-md-8 covid-input">
                                <label for="inputHospital" class="form-label-primary covid-input-label">Hospital ID</label>
                                <input type="text" readonly class="form-control form-control-sm" id="inputHospital" name="add-patient-hospital" value="<?= $_SESSION["hospital_id"] ?>">
                            </div>

                            <div class="col-md-8 covid-input">
                                <label for="inputCondition" class="form-label-primary label-primary covid-input-label">Conditions</label>
                                <input type="text" class="form-control covid-input-field" id="inputCondition" name="add-patient-conditions" placeholder="(Optional)">
                            </div>


                        </div>
                        <div class="modal-footer covid-modal-footer">
                            <button type="submit" class="btn btn-primary covid-submit-btn" name="add-patient-submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>


            <!-- This is the model for updating details of the patient -->
            <div class="modal fade" id="patient-result" tabindex="-1" aria-labelledby="patient-form" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-md">

                    <form class="modal-content" method="POST" action="<?php echo URL_ROOT; ?>/pages/covid_patients">

                        <div class="modal-header test-toggle-modal-header">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body test-toggle-modal-body">

                            <div class="col-md-8 covid-input">
                                <label for="togBtn" class="form-label label test-toggle-label">Patient Status</label>
                                </label>

                                <!-- backend purposes only -->
                                <input type="text" name="final-id" id="hidden-id" hidden>
                                <input type="text" name="final-hospital-id" id="hidden-hospital-id" hidden>
                                <input type="text" name="final-health-id" id="hidden-health-id" hidden value="<?php echo $data['personal']['health_id'] ?>">
                                <input type="text" name="final-admission-date" id="hidden-admission-date" hidden>
                                <input type="text" name="final-conditions" id="hidden-conditions" hidden>
                                <input type="text" name="final-status" id="hidden-status" hidden>


                                <!-- This is the code to toggle button -->
                                <div class="form-control test-toggle-input">
                                    <label class="switch">
                                        <input type="checkbox" class="toggle-input" id="togBtn">
                                        <div class="slider round">
                                            <!--ADDED HTML -->
                                            <span class="on toggle-font">Discharged</span>
                                            <span class="off toggle-font">Died</span>
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
            </div>
    </section>


    <script src="<?php echo URL_ROOT; ?>/public/script/test.js"></script>
    <script src="<?php echo URL_ROOT; ?>/public/script/pcr.js"></script>

</body>


<?php

if (isset($_GET['updated']) && $data['notification'] != []) {
    ini_set('display_errors', 1);
    error_reporting(E_ALL);

    $from = "squ4doption@gmail.com";
    $to = $data['notification'][0];
    $subject = $data['notification'][1];
    $txt = $data['notification'][2];
    $headers = "From: " . $from;

    mail($to, $subject, $txt, $headers);
}

?>