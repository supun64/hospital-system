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
                    <img class="covid-logo" src="<?php echo URL_ROOT; ?>/public/images/patient.png" alt="covid-19 covid">
                    <h1 class="text-primary">Patients</h1>
                </div>

                <form class="form mb-3 covid-search-div" method="POST" action="<?php echo URL_ROOT; ?>/pages/covid_patients">

                    <input type="text" class="covid-search-bar form-control" id="covid-search-bar-input" placeholder="Enter Health ID here" name="patient-search-bar-input" required>

                    <input type="submit" class="btn btn-primary" id="covid-search-btn" name="patient-search" value="Search">
                </form>
            </div>

            <!-- This is what should display after search -->
            <?php if (isset($data["personal"]) && $data['personal'] != []) { ?>

                <!-- Add admination-fade-in-pre-state to add the animation -->
                <div class="covid-search-result" id="covid-search-result-section">
                    <button class="btn btn-primary" id="patient-admission-button" data-bs-toggle="modal" data-bs-target="#add-new-patient">Patient Admission</button>
                    <button type="button" class="btn btn-primary" id="add-button" data-bs-toggle="modal" data-bs-target="#update-status">Update Status</button>

                    <!-- This is the division to display if the search result available -->
                    <div class="covid-details">

                        <div class="covid-patient-detail">
                            <table class="covid-detail-table" id="patient-table">
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
                                        Age
                                    </th>
                                    <th>
                                        :
                                    </th>

                                    <td class="covid-detail-data">
                                        <?php
                                        $birth_year = (int)explode(" - ", $data['personal']['dob'])[0];
                                        $curr_year = (int)date("Y");
                                        echo ($curr_year - $birth_year); ?>
                                    </td>
                                </tr>
                            </table>
                        </div>


                        <!-- <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                        Button with data-target
                    </button>

                    <div class="collapse" id="collapseExample">

                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.

                    </div> -->
                        <?php if ($data['patient_history']) { ?>

                            <div class="covid-previous-details">

                                <div class="covid-tr covid-top-tr">
                                    <div class="covid-th covid-td">Admission ID</div>
                                    <div class="covid-th covid-td">Hospital Name</div>
                                    <div class="covid-th covid-td">Admission Date</div>
                                    <div class="covid-th covid-td">Discharge Date</div>
                                    <div class="covid-th covid-td">Status</div>
                                    <div class="covid-th covid-td">Conditions</div>
                                </div>

                                <?php
                                $count = 0;
                                $patient_history = $data["patient_history"];
                                foreach ($patient_history as $admission) :
                                ?>
                                    <?php $count++; ?>
                                    <div class="patient-rw">
                                        <div class="covid-tr covid-no-select-tr <?php if ($admission === $patient_history[sizeof($patient_history) - 1]) echo 'covid-bottom-tr' ?>" data-bs-toggle="modal" data-bs-target="#patient-result">
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
                                                <?php echo $admission["status"] ?>
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

        </main>

        <!-- This is the UI modal for add new vaccinated person -->
        <div class="modal fade" id="add-new-patient" tabindex="-1" aria-labelledby="patient-form" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">

                <form class="modal-content" method="POST" action="<?php echo URL_ROOT; ?>/pages/covid_patients">
                    <div class="modal-header covid-modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                        <h5 class="modal-title covid-modal-title" id="patient-form">COVID 19 Patient Admission Form</h5>

                    </div>
                    <div class="modal-body">

                        <div class="col-md-8 covid-input">
                            <label for="inputHealthID" class="form-label-primary label-primary covid-input-label">Patient's Health ID</label>
                            <input type="text" readonly class="form-control form-control-sm covid-input-field" id="inputHealthID" name="add-patient-health-id" value="<?php echo $data['personal']['health_id'] ?>">
                        </div>

                        <div class="col-md-6 covid-input">
                            <label for="inputDate" class="form-label-primary covid-input-label">Admission Date</label>
                            <input type="date" value="<?php echo date('d-m-Y'); ?>" class="form-control covid-input-field" id="inputDate" name="add-patient-admission-date" required>
                        </div>

                        <div class="col-md-8 covid-input">
                            <label for="inputHospital" class="form-label-primary covid-input-label">Hospital ID</label>
                            <input type="text" readonly class="form-control form-control-sm covid-input-field" id="inputHospital" name="add-patient-hospital" value="<?= $_SESSION["hospital_id"] ?>">
                        </div>

                        <div class="col-md-8 covid-input">
                            <label for="inputCondition" class="form-label-primary label-primary covid-input-label">Conditions</label>
                            <input type="text" class="form-control covid-input-field covid-input-field" id="inputCondition" name="add-patient-conditions" placeholder="(Optional)">
                        </div>


                    </div>
                    <div class="modal-footer covid-modal-footer">
                        <button type="submit" class="btn btn-primary covid-submit-btn" name="add-patient-submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="update-status" tabindex="-1" role="dialog" aria-labelledby="update-form" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">

                <form class="modal-content" method="POST" action="<?php echo URL_ROOT; ?>/pages/covid_patients">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Update the status of the patient</h5>

                        <div class="modal-header test-toggle-modal-header">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                    </div>

                    <!-- backend purposes only -->
                    <input type="text" name="final-health-id" id="hidden-health-tid" hidden value="<?php echo $data['personal']['health_id'] ?>">
                    <input type="text" name="final-hospital-id" id="hidden-hospital-id" hidden>
                    <input type="text" name="final-discharge-date" id="hidden-discharge-date" hidden>
                    <input type="text" name="final-status" id="hidden-status" hidden>

                    <!-- This is the code to radio buttons -->
                    <div class="col-md-8 covid-input">
                        <div class="modal-body">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="default-radio" id="discharged" value="Discharged">
                                <label class="form-check-label" for="discharged">
                                    Discharged
                                </label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="default-radio" id="died" value="Died">
                                <label class=" form-check-label" for="died">
                                    Died
                                </label>
                            </div>

                            <h4 id="error" style="color:red"> </h4>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">Close</button>
                        <button type="submit" class="btn btn-primary" id="update" onclick="checkButton()" name="update-patient-submit">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>

<script>
    <?php if (($data['final_record']['status'] != "Admitted") || ($data['final_record']['hospital_id'] != $_SESSION["hospital_id"])) { ?>
        document.getElementById("add-button").disabled = true;
    <?php } ?>
    <?php if (($data['final_record']['status'] == "Admitted")) { ?>
        document.getElementById("patient-admission-button").disabled = true;
    <?php } ?>
    <?php if (($data['final_record']['status'] == "Died")) { ?>
        document.getElementById("patient-admission-button").disabled = true;
        document.getElementById("add-button").disabled = true;
    <?php } ?>
</script>

<script src="<?= URL_ROOT ?>./public/script/admin.js"></script>
<script src="<?php echo URL_ROOT; ?>/public/script/test.js"></script>
<script src="<?php echo URL_ROOT; ?>/public/script/covid_patients.js"></script>

<?php require_once APP_ROOT . "/views/includes/footer.php" ?>