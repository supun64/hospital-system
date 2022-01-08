<?php require_once APP_ROOT . "/views/pages/user_dashboard.php" ?>
<div class='sub-division'>





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
            <div class="covid-search" id="covid-main-search-engine">
                <div class="covid-title">
                    <img class="covid-logo" src="<?php echo URL_ROOT; ?>/public/images/vaccine-logo.png" alt="covid-19 vaccine">
                    <h1 class="text-primary">Vaccination</h1>
                </div>

                
                <form class="form mb-3 covid-search-div" method="POST" action="<?php echo URL_ROOT; ?>/pages/vaccination">

                    <input type="text" class="covid-search-bar form-control" id="covid-search-bar-input" placeholder="Enter health ID here" name="vaccine-search-bar-input" required>

                    <input type="submit" class="btn btn-primary" id="covid-search-btn" name="vaccine-search" value="Search">

                </form>

            </div>

            <!-- This is what should display after search -->
            <?php if ($data["personal"]) { ?>
                <!-- Add animation-fade-in-pre-state to add the animation -->
                <div class="covid-search-result animation-fade-in-pre-state" id="covid-search-result-section">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add-new-vaccination" id="add-new">Add new vaccination +</button>

                    <!-- This is the division to display if the search result available -->
                    <div class="covid-details">

                        <div class="covid-patient-detail">
                            <table>
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

                        <?php
                        $last_dose = 0;
                        if ($data['vaccinations']) { ?>
                            <!-- These are the vaccination details -->

                            <div class="covid-previous-details">

                                <div class="covid-tr covid-top-tr">
                                    <div class="covid-th covid-td">Vaccine ID </div>
                                    <div class="covid-th covid-td">Batch Number </div>
                                    <div class="covid-th covid-td">Vaccine Name</div>
                                    <div class="covid-th covid-td">Hospital Id</div>
                                    <div class="covid-th covid-td">Date of Vaccination</div>
                                    <div class="covid-th covid-td">Dose</div>
                                    <div class="covid-th covid-td">Place of Vaccination</div>
                                    <div class="covid-th covid-td">Comments</div>
                                </div>


                                <?php

                                $vaccinations = $data["vaccinations"];

                                foreach ($vaccinations as $vaccine) :
                                ?>


                                    <div class="covid-tr <?php if ($vaccine === $vaccinations[sizeof($vaccinations) - 1]) echo 'covid-bottom-tr' ?>">
                                        <div class="covid-td">
                                            <?php echo $vaccine["id"] ?>
                                        </div>

                                        <div class="covid-td">
                                            <?php echo $vaccine["batch_num"] ?>
                                        </div>

                                        <div class="covid-td"><?php echo $vaccine["vaccine_name"] ?></div>

                                        <div class="covid-td"><?php echo $vaccine["hospital_id"] ?></div>

                                        <div class="covid-td"><?php echo $vaccine["date"] ?></div>

                                        <div class="covid-td"><?php echo $vaccine["dose"] ?></div>

                                        <div class="covid-td"><?php echo $vaccine["vaccinated_place"] ?></div>

                                        <div class="covid-td"><?php echo $vaccine["comments"] ?></div>

                                    </div>
                                    <?php $last_dose = $vaccine["dose"];    ?>
                                <?php endforeach; ?>




                            </div>

                            <!-- <div class="covid-last-btn">

                        <button class="btn btn-primary covid-btn-new" data-bs-toggle="modal" data-bs-target="#add-new-vac">Add new vaccination +</button>

                    </div> -->





                        <?php } else { ?>


                            <!-- This is the division to display if the search result not available -->
                            <div class="covid-details covid-no-result-div">

                                <div class="covid-sad-face image-centered">
                                    <img class="covid-sad-face-img" src="<?php echo URL_ROOT; ?>/public/images/sad-face.png" alt="">
                                </div>
                                <p class="covid-no-result-message">
                                    No vaccination history found! :(
                                </p>

                            </div>


                        <?php } ?>
                    </div>
                <?php } ?>



                </div>
        </main>

        <!-- This is the UI modal for add new vaccinated person -->
        <div class="modal fade" id="add-new-vaccination" tabindex="-1" aria-labelledby="vac-forum" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">

                <form class="modal-content" method="POST" action="<?php echo URL_ROOT; ?>/pages/vaccination">
                    <div class="modal-header covid-modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                        <h5 class="modal-title covid-modal-title" id="vac-forum">Vaccination Forum</h5>

                    </div>
                    <div class="modal-body">

                        <div class="col-md-8 covid-input">
                            <label for="inputHealthID" class="form-label-primary label-primary covid-input-label">Patient's Health ID</label>
                            <!-- <input type="number" class="form-control covid-input-field" id="inputHealthID" name="add-patient-health-id" min="1" required> -->
                            <input type="text" readonly class="form-control form-control-sm" id="inputHealthID" name="add-patient-health-id" value="<?php echo $data['personal']['health_id']; ?>">
                        </div>

                        <div class="col-md-8 covid-input">
                            <label for="inputBatchNum" class="form-label-primary label-primary covid-input-label">Batch Number</label>
                            <input type="text" class="form-control form-control-sm" id="inputBatchNum" name="add-patient-batch-num" required>
                        </div>


                        <div class="col-md-8 covid-input">
                            <label for="inputVaccineName" class="form-label-primary label-primary covid-input-label">Vaccination Name</label>
                            <input type="text" class="form-control covid-input-field" id="inputVaccineName" name="add-patient-vaccination-name" required>
                        </div>

                        <div class="col-md-6 covid-input">
                            <label for="inputDate" class="form-label-primary covid-input-label">Vaccinated Date</label>
                            <input type="date" value="<?php echo date('d-m-Y'); ?>" class="form-control covid-input-field" id="inputDate" name="add-patient-vaccinated-date" required>
                        </div>

                        <div class="col-md-8 covid-input">
                            <label for="inputHospital" class="form-label-primary covid-input-label">Conducted Hospital</label>
                            <input type="text" readonly class="form-control form-control-sm" id="inputHealthID" name="add-patient-hospital" value="<?php echo $data['hospital_id']; ?>">

                        </div>


                        <div class="col-md-8 covid-input">
                            <label for="inputVaccinePlace" class="form-label-primary label-primary covid-input-label">Vaccinated Place</label>
                            <input type="text" class="form-control covid-input-field" id="inputVaccinePlace" name="add-patient-vaccinated-place" placeholder="(Optional)">
                        </div>

                        <div class="col-md-3 covid-input">
                            <label for="inputDose" class="form-label-primary covid-input-label">Dosage</label>

                            <input type="text" readonly class="form-control form-control-sm" id="inputDose" name="add-patient-dose" value="<?php echo $last_dose + 1 ?>">
                        </div>

                        <div class="col-md-8 covid-input">
                            <label for="inputComments" class="form-label-primary label-primary covid-input-label"> <span class="covid-form-comment">Comments</span></label>
                            <textarea class="form-control covid-input-field covid-textarea" id="inputComments" rows="4" placeholder="(Optional)" name="add-patient-comment"></textarea>
                        </div>

                    </div>
                    <div class="modal-footer covid-modal-footer">
                        <button type="submit" class="btn btn-primary covid-submit-btn" name="add-patient-submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>

<script>
    <?php if (($data['personal']['is_alive'] == 0)) { ?>
        document.getElementById("add-new").disabled = true;
    <?php } ?>
</script>

<script>
        // Search Transition-------------------------------------------------------------

        // This is the variables used for search transisions
        const vaccineMainSearchEngine = document.querySelector("#covid-main-search-engine");
        const vaccineSearchResult = document.querySelector("#covid-search-result-section");

        const vaccineSearchBtn = document.querySelector("#covid-search-btn");
        const vaccineSearchBar = document.querySelector("#covid-search-bar-input");

        // Event listner for search btn click

        console.log(count);

        <?php if ($data['loaded']) { ?>

        
            vaccineSearchBtn.addEventListener("click", function() {
                if (vaccineSearchBar.value.length != 0) {
                    // Transition for search engine
                    if (!vaccineMainSearchEngine.classList.contains("covid-shrunk-search")) {
                        vaccineMainSearchEngine.classList.add("covid-shrunk-search");
                    }

                    // fade in animation for the search results
                    if (vaccineSearchResult.classList.contains("animation-fade-in-pre-state")) {
                        vaccineSearchResult.classList.remove("animation-fade-in-pre-state");
                    }

                    if (!vaccineSearchResult.classList.contains("animation-fade-in")) {
                        vaccineSearchResult.classList.add("animation-fade-in");
                    }

                    
                }
            });

        <?php } ?>
        
    </script>

<script src="<?php echo URL_ROOT; ?>/public/script/vaccine.js"></script>
<script src="<?= URL_ROOT ?>./public/script/admin.js"></script>
<?php require_once APP_ROOT . "/views/includes/footer.php" ?>