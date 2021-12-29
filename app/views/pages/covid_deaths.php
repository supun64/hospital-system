<?php require APP_ROOT . '/views/includes/header.php';  ?>

<body>
    <section class="main-info">

        <!-- covid-shrunk-search class should add after the search -->
        <div class="covid-search covid-shrunk-search" id="covid-main-search-engine">
            <div class="covid-title">
                <img class="covid-logo" src="<?php echo URL_ROOT; ?>/public/images/death.jpg" alt="covid-19 covid">
                <h1 class="text-primary">Deaths</h1>
            </div>

            <form class="form mb-3 covid-search-div" method="POST" action="<?php echo URL_ROOT; ?>/pages/covid_deaths">
                <input type="text" class="covid-search-bar form-control" id="covid-search-bar-input" placeholder="Enter health ID here" name="death-search-bar-input" value="<?= isset($_POST['death-search-bar-input'])?$_POST['death-search-bar-input']:""?>"required>
                <input type="submit" class="btn btn-primary" id="covid-search-btn" name="death-search" value="Search">
            </form>

            <button class="btn btn-primary" id = "covid_death-add" data-bs-toggle="modal" data-bs-target="#add-new-death">Add a Death +</button>

        </div>
        <?php if (isset($data["death"])) : ?>
        <!-- Add addmination-fade-in-pre-state to add the animation -->
        <div class="covid-search-result" id="covid-search-result-section">
            <!-- This is what should display after search -->
            
                <!-- This is the division to display if the search result available -->
                <div class="covid-details">

                    <div class="covid-patient-detail">
                        <table id="death-table">
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
                                    Date of Birth
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
                                    Deceased Date
                                </th>
                                <th>
                                    :
                                </th>

                                <td class="covid-detail-data">
                                    <?php echo $data['death']['date'] ?>
                                </td>
                            </tr>

                            <tr>
                                <th class="covid-detail-title">
                                    Place Died
                                </th>
                                <th>
                                    :
                                </th>

                                <td class="covid-detail-data">
                                    <?php echo $data['death']['place'] ?>
                                </td>
                            </tr>

                            <tr>
                                <th class="covid-detail-title">
                                    Comments
                                </th>
                                <th>
                                    :
                                </th>

                                <td class="covid-detail-data">
                                    <?php echo $data['death']['comments'] ?>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
                <?php

            elseif (isset($data["personal"])) : ?>

                    <!-- This is the division to display if the search result not available -->
                    <div class="covid-details covid-no-result-div covid-search-result">

                        <div class="covid-sad-face image-centered">
                            <img class="covid-sad-face-img" src="<?php echo URL_ROOT; ?>/public/images/sad-face.png" alt="">
                        </div>
                        <p class="covid-no-result-message">
                            No search results found
                        </p>

                    </div>
                </div>
            </div>
                <?php elseif (isset($data["hospital_id"])) : ?>
                    <!-- This is the division to display if the search result not available -->
                    <div class="covid-details covid-no-result-div covid-search-result">

                        <div class="covid-sad-face image-centered">
                            <img class="covid-sad-face-img" src="<?php echo URL_ROOT; ?>/public/images/sad-face.png" alt="">
                        </div>
                        <p class="covid-no-result-message">
                            <?= isset($data['error'])?$data['error']:"Wrong Health ID";?>
                        </p>

                    </div>
                </div>
            </div>
                <?php endif ?>
        

        <!-- This is the UI modal for add new vaccinated person -->
        <div class="modal fade" id="add-new-death" tabindex="-1" aria-labelledby="death-form" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">

                <form class="modal-content" method="POST" action="<?php echo URL_ROOT; ?>/pages/covid_deaths">
                    <div class="modal-header covid-modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                        <h5 class="modal-title covid-modal-title" id="death-form">Death Detail Form</h5>

                    </div>
                    <div class="modal-body">

                        <div class="col-md-8 covid-input">
                            <label for="inputHealthID" class="form-label-primary label-primary covid-input-label">Health ID</label>
                            <input type="text"  class="form-control form-control-sm" id="inputHealthID" name="add-death-health-id" value="<?= isset($data["personal"]) ? $data['personal']['health_id'] : "" ?>">
                        </div>

                        <div class=" col-md-6 covid-input">
                            <label for="inputDate" class="form-label-primary covid-input-label">Deceased date</label>
                            <input type="date" class="form-control covid-input-field" id="inputDate" name="add-death-date" required>
                        </div>

                        <div class="col-md-8 covid-input">
                            <label for="inputHospital" class="form-label-primary covid-input-label">Hospital ID</label>
                            <input type="text"  readonly class="form-control form-control-sm" id="inputHospital" name="add-death-hospital" value="<?= $_SESSION["hospital_id"] ?>">
                        </div>

                        <div class="col-md-8 covid-input">
                            <label for="inputDeathPlace" class="form-label-primary label-primary covid-input-label">Place</label>
                            <input type="text" class="form-control covid-input-field" id="inputDeathPlace" name="add-death-place" placeholder="(Optional)">
                        </div>

                        <div class="col-md-8 covid-input">
                            <label for="inputDeathPlace" class="form-label-primary label-primary covid-input-label">Comments</label>
                            <input type="text" class="form-control covid-input-field" id="inputComments" name="add-death-comments" placeholder="(Optional)">
                        </div>


                    </div>
                    <div class="modal-footer covid-modal-footer">
                        <button type="submit" class="btn btn-primary covid-submit-btn" name="add-death-submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>

    </section>


    <script src="<?php echo URL_ROOT; ?>/public/script/test.js"></script>
    <script src="<?php echo URL_ROOT; ?>/public/script/pcr.js"></script>

</body>