<?php require APP_ROOT . '/views/includes/header.php';  ?>



<body>

    <section class="main-info">


        <!-- vaccine-shrunk-search class should add after the search -->
        <div class="vaccine-search vaccine-shrunk-search" id="vaccine-main-search-engine">
            <div class="vaccine-title">
                <img class="vaccine-logo" src="<?php echo URL_ROOT; ?>/public/images/pcr-logo.jpg" alt="covid-19 vaccine">
                <h1 class="text-primary">PCR Tests</h1>
            </div>

            <form class="form mb-3 vaccine-search-div" method="POST" action="<?php echo URL_ROOT; ?>/pages/vaccination">

                <input type="text" class="vaccine-search-bar form-control" id="vaccine-search-bar-input" placeholder="Enter health ID here" name="vaccine-search-bar-input" required>

                <input type="submit" class="btn btn-primary" id="vaccine-search-btn" name="vaccine-search" value="Search">

            </form>

        </div>

        <!-- This is what should display after search -->


        <!-- Add addmination-fade-in-pre-state to add the animation -->
        <div class="vaccine-search-result" id="vaccine-search-result-section">
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add-new-pcr">Add new PCR +</button>

            <!-- This is the division to display if the search result available -->




            <div class="vaccine-details">

                <div class="vaccine-patient-detail">
                    <table>
                        <tr>
                            <th class="vaccine-detail-title">
                                Health ID
                            </th>
                            <th>
                                :
                            </th>


                            <td class="vaccine-detail-data">

                            </td>
                        </tr>

                        <tr>
                            <th class="vaccine-detail-title">
                                Name
                            </th>
                            <th>
                                :
                            </th>


                            <td class="vaccine-detail-data">

                            </td>
                        </tr>

                        <tr>
                            <th class="vaccine-detail-title">
                                Age
                            </th>
                            <th>
                                :
                            </th>


                            <td class="vaccine-detail-data">

                            </td>
                        </tr>
                    </table>
                </div>


                <!-- These are the vaccination details -->

                <div class="vaccine-previous-details">

                    <div class="vaccine-tr vaccine-top-tr">
                        <div class="vaccine-th vaccine-td">PCR ID </div>
                        <div class="vaccine-th vaccine-td">Date</div>
                        <div class="vaccine-th vaccine-td">Hospital Id</div>
                        <div class="vaccine-th vaccine-td">Result</div>
                        <div class="vaccine-th vaccine-td">Comments</div>
                    </div>




                    <div class="vaccine-tr" data-bs-toggle="modal" data-bs-target="#pcr-result">
                        <div class="vaccine-td">
                            1
                        </div>

                        <div class="vaccine-td">Dummy</div>

                        <div class="vaccine-td">Dummy</div>

                        <div class="vaccine-td">Pending</div>

                        <div class="vaccine-td">Dummy</div>



                    </div>


                    <!-- TODO: add vaccine-bottom-tr class to the end of the table -->
                    <div class="vaccine-tr vaccine-bottom-tr" data-bs-toggle="modal" data-bs-target="#pcr-result">
                        <div class="vaccine-td">
                            1
                        </div>

                        <div class="vaccine-td">Dummy</div>

                        <div class="vaccine-td">Dummy</div>

                        <div class="vaccine-td">

                            pending



                        </div>

                        <div class="vaccine-td">Dummy</div>



                    </div>
                </div>








                <!-- This is the division to display if the search result not available -->
                <div class="vaccine-details vaccine-no-result-div hidden">

                    <div class="vaccine-sad-face image-centered">
                        <img class="vaccine-sad-face-img" src="<?php echo URL_ROOT; ?>/public/images/sad-face.png" alt="">
                    </div>
                    <p class="vaccine-no-result-message">
                        No search results found
                    </p>

                </div>


            </div>




        </div>

        <!-- This is the UI modal for add new vaccinated person -->
        <div class="modal fade" id="add-new-pcr" tabindex="-1" aria-labelledby="vac-forum" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">

                <form class="modal-content" method="POST" action="<?php echo URL_ROOT; ?>/pages/vaccination">
                    <div class="modal-header vaccine-modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                        <h5 class="modal-title vaccine-modal-title" id="vac-forum">PCR Test Forum</h5>

                    </div>
                    <div class="modal-body">

                        <div class="col-md-8 vaccine-input">
                            <label for="inputHealthID" class="form-label-primary label-primary vaccine-input-label">Patient's Health ID</label>
                            <input type="text" readonly class="form-control form-control-sm" id="inputHealthID" name="add-patient-health-id" value='Patient HI'>
                        </div>

                        <div class="col-md-6 vaccine-input">
                            <label for="inputDate" class="form-label-primary vaccine-input-label">Tested Date</label>
                            <input type="date" value="<?php echo date('d-m-Y'); ?>" class="form-control vaccine-input-field" id="inputDate" name="add-patient-pcr-date" required>
                        </div>

                        <div class="col-md-8 vaccine-input">
                            <label for="inputHospital" class="form-label-primary vaccine-input-label">Conducted Hospital</label>

                            <!-- THis is the code for drop down -->
                            <div class="select-box">
                                <div class="options-container">

                                    <!-- This is the code to add hospitals for the drop down list -->
                                    <?php $counter = 0; ?>
                                    <?php foreach ($data["hospitals"] as $hospital) : ?>

                                        <div class="option">
                                            <input type="radio" class="radio" id="inputOption<?php echo $counter; ?>" name="category" />
                                            <label for="inputOption<?php echo $counter; ?>"><?php echo $hospital["name"] . ' - ' . $hospital["hospital_id"]; ?></label>
                                        </div>

                                    <?php

                                        $counter++;

                                    endforeach; ?>



                                </div>

                                <div class="selected">

                                    <!-- This is the input that need to be grabed -->
                                    <input type="text" class="selected-text" placeholder="Choose" maxlength="0" name="add-patient-pcr-hospital" required>

                                </div>




                                <div class="search-box">
                                    <input type="text" placeholder="Start Typing..." />
                                </div>
                            </div>

                            <!-- End of drop down -->

                        </div>


                        <div class="col-md-8 vaccine-input">
                            <label for="inputVaccinePlace" class="form-label-primary label-primary vaccine-input-label">PCR Conducted Place</label>
                            <input type="text" class="form-control vaccine-input-field" id="inputVaccinePlace" name="add-patient-pcr-place" placeholder="(Optional)">
                        </div>


                        <div class="col-md-8 vaccine-input">
                            <label for="inputComments" class="form-label-primary label-primary vaccine-input-label"> <span class="vaccine-form-comment">Comments</span></label>
                            <textarea class="form-control vaccine-input-field vaccine-textarea" id="inputComments" rows="4" placeholder="(Optional)" name="add-pcr-comment"></textarea>
                        </div>

                    </div>
                    <div class="modal-footer vaccine-modal-footer">
                        <button type="submit" class="btn btn-primary vaccine-submit-btn" name="add-patient-submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>


        <!-- This is the model for updating result of pcr -->
        <div class="modal fade" id="pcr-result" tabindex="-1" aria-labelledby="vac-forum" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-md">

                <form class="modal-content" method="POST" action="<?php echo URL_ROOT; ?>/pages/vaccination">

                <div class="modal-header pcr-toggle-modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                    <div class="modal-body pcr-toggle-modal-body">

                        <div class="col-md-8 vaccine-input">
                            <label for="togBtn" class="form-label label pcr-toggle-label">PCR Test result</label>
                            </label>

                            <!-- This is the code to toggle button -->
                            <div class="form-control pcr-toggle-input">
                                <label class="switch">
                                    <input type="checkbox" class="toggle-input" id="togBtn">
                                    <div class="slider round">
                                        <!--ADDED HTML -->
                                        <span class="on toggle-font" >Possitive</span>
                                        <span class="off toggle-font">Negetive</span>
                                        <!--END-->
                                    </div>
                                </label>

                            </div>





                        </div>

                    </div>
                    <div class="modal-footer pcr-toggle-footer">
                        <button type="submit" class="btn btn-primary pcr-toggle-submit-btn" name="add-patient-submit">Update</button>
                    </div>
                </form>
            </div>
        </div>

    </section>


    <script src="<?php echo URL_ROOT; ?>/public/script/pcr.js"></script>

</body>