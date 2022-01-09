<?php require_once APP_ROOT . "/views/pages/user_dashboard.php" ?>

<div class='sub-division'>

    <?php
    if (isset($_GET['not-user'])) { ?>
        <div class="alert alert-danger alert-dismissible fade show deo-manage-error-box" role="alert">
            <div class="deo-manage-error-text"> Wrong Health ID !!</div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php } ?>

    <section class="main-info">

        <main class="sub-division-main">

            <!-- covid-shrunk-search class should add after the search -->
            <div class="covid-search covid-shrunk-search death-covid-search-div" id="covid-main-search-engine">
                <div class="covid-title">
                    <img class="covid-logo" src="<?php echo URL_ROOT; ?>/public/images/death.png" alt="covid-19 covid">
                    <h1 class="text-primary">Deaths</h1>
                </div>

                <form class="form mb-3 covid-search-div death-covid-search-div" method="POST" action="<?php echo URL_ROOT; ?>/pages/covid_deaths">
                    <input type="text" class="covid-search-bar death-covid-search-bar form-control" id="covid-search-bar-input" placeholder="Enter Health ID here" name="death-search-bar-input" value="<?= isset($_POST['death-search-bar-input']) ? $_POST['death-search-bar-input'] : "" ?>" required>
                    <input type="submit" class="btn btn-primary" id="covid-search-btn" name="death-search" value="Search">

                    <input type="button" class="btn btn-primary death-add-new-btn" id="add-button" data-bs-toggle="modal" data-bs-target="#add-new-death" value="Add a Death +">
                    
                </form>
                
                

            </div>
            <?php if (isset($data["death"])) : ?>
                <!-- Add addmination-fade-in-pre-state to add the animation -->
                <div class="covid-search-result" id="covid-search-result-section">
                    <!-- This is what should display after search -->

                    <!-- This is the division to display if the search result available -->
                    <div class="covid-details">

                    <header class="death-report-title">Death report</header>

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
                        No death record found :(
                    </p>
                </div>

            <?php elseif (isset($data["hospital_id"])) : ?>
                <!-- This is the division to display if the search result not available -->
                <div class="covid-details covid-no-result-div covid-search-result">

                    <div class="covid-sad-face image-centered">
                        <img class="covid-sad-face-img" src="<?php echo URL_ROOT; ?>/public/images/sad-face.png" alt="">
                    </div>
                    <p class="covid-no-result-message">
                        <?php if (isset($data['error'])) {
                            echo $data['error'];
                        } ?>
                    </p>
                </div>
            <?php endif ?>

        </main>


        <!-- This is the UI modal for new death -->
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
                            <input type="text" class="form-control form-control-sm covid-input-field" id="inputHealthID" name="add-death-health-id" value="<?= isset($data["personal"]) ? $data['personal']['health_id'] : "" ?>" required>
                        </div>

                        <div class=" col-md-6 covid-input">
                            <label for="inputDate" class="form-label-primary covid-input-label">Deceased date</label>
                            <input type="date" class="form-control covid-input-field" id="inputDate" name="add-death-date" required>
                        </div>

                        <div class="col-md-8 covid-input">
                            <label for="inputHospital" class="form-label-primary covid-input-label">Hospital ID</label>
                            <input type="text" readonly class="form-control form-control-sm covid-input-field" id="inputHospital" name="add-death-hospital" value="<?= $_SESSION["hospital_id"] ?>" required>
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





</div>

<script src="<?= URL_ROOT ?>./public/script/admin.js"></script>
<script src="<?php echo URL_ROOT; ?>/public/script/test.js"></script>
<script src="<?php echo URL_ROOT; ?>/public/script/pcr.js"></script>
<?php require_once APP_ROOT . "/views/includes/footer.php" ?>