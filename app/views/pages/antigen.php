<?php require APP_ROOT . '/views/includes/header.php';  ?>



<body>

    <section class="main-info">


        <!-- covid-shrunk-search class should add after the search -->
        <div class="covid-search covid-shrunk-search" id="covid-main-search-engine">
            <div class="covid-title">
                <img class="covid-logo" src="<?php echo URL_ROOT; ?>/public/images/antigen-logo.png" alt="covid-19 covid">
                <h1 class="text-primary">Rapid Antigen Tests</h1>
            </div>

            <form class="form mb-3 covid-search-div" method="POST" action="<?php echo URL_ROOT; ?>/pages/vaccination">

                <input type="text" class="covid-search-bar form-control" id="covid-search-bar-input" placeholder="Enter health ID here" name="covid-search-bar-input" required>

                <input type="submit" class="btn btn-primary" id="covid-search-btn" name="covid-search" value="Search">

            </form>

        </div>

        <!-- This is what should display after search -->


        <!-- Add addmination-fade-in-pre-state to add the animation -->
        <div class="covid-search-result" id="covid-search-result-section">
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add-new-antigen">Add new Antigen +</button>

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

                            </td>
                        </tr>
                    </table>
                </div>


                <!-- These are the vaccination details -->

                <div class="covid-previous-details">

                    <div class="covid-tr covid-top-tr">
                        <div class="covid-th covid-td">Antigen ID </div>
                        <div class="covid-th covid-td">Date</div>
                        <div class="covid-th covid-td">Hospital Id</div>
                        <div class="covid-th covid-td">Result</div>
                        <div class="covid-th covid-td">Comments</div>
                    </div>




                    <div class="covid-tr" data-bs-toggle="modal" data-bs-target="#antigen-result">
                        <div class="covid-td">
                            1
                        </div>

                        <div class="covid-td">Dummy</div>

                        <div class="covid-td">Dummy</div>

                        <div class="covid-td">Pending</div>

                        <div class="covid-td">Dummy</div>



                    </div>


                    <!-- TODO: add covid-bottom-tr class to the end of the table -->
                    <div class="covid-tr covid-bottom-tr" data-bs-toggle="modal" data-bs-target="#antigen-result">
                        <div class="covid-td">
                            1
                        </div>

                        <div class="covid-td">Dummy</div>

                        <div class="covid-td">Dummy</div>

                        <div class="covid-td">

                            pending



                        </div>

                        <div class="covid-td">Dummy</div>



                    </div>
                </div>








                <!-- This is the division to display if the search result not available -->
                <div class="covid-details covid-no-result-div hidden">

                    <div class="covid-sad-face image-centered">
                        <img class="covid-sad-face-img" src="<?php echo URL_ROOT; ?>/public/images/sad-face.png" alt="">
                    </div>
                    <p class="covid-no-result-message">
                        No search results found
                    </p>

                </div>


            </div>




        </div>

        <!-- This is the UI modal for add new vaccinated person -->
        <div class="modal fade" id="add-new-antigen" tabindex="-1" aria-labelledby="vac-forum" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">

                <form class="modal-content" method="POST" action="<?php echo URL_ROOT; ?>/pages/vaccination">
                    <div class="modal-header covid-modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                        <h5 class="modal-title covid-modal-title" id="vac-forum">Antigen Test Forum</h5>

                    </div>
                    <div class="modal-body">

                        <div class="col-md-8 covid-input">
                            <label for="inputHealthID" class="form-label-primary label-primary covid-input-label">Patient's Health ID</label>
                            <input type="text" readonly class="form-control form-control-sm" id="inputHealthID" name="add-patient-health-id" value='Patient HI'>
                        </div>

                        <div class="col-md-6 covid-input">
                            <label for="inputDate" class="form-label-primary covid-input-label">Tested Date</label>
                            <input type="date" value="<?php echo date('d-m-Y'); ?>" class="form-control covid-input-field" id="inputDate" name="add-patient-antigen-date" required>
                        </div>

                        <div class="col-md-8 covid-input">
                            <label for="inputHospital" class="form-label-primary covid-input-label">Conducted Hospital</label>

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
                                    <input type="text" class="selected-text" placeholder="Choose" maxlength="0" name="add-patient-antigen-hospital" required>

                                </div>




                                <div class="search-box">
                                    <input type="text" placeholder="Start Typing..." />
                                </div>
                            </div>

                            <!-- End of drop down -->

                        </div>


                        <div class="col-md-8 covid-input">
                            <label for="inputAntigenPlace" class="form-label-primary label-primary covid-input-label">Conducted Place</label>
                            <input type="text" class="form-control covid-input-field" id="inputAntigenPlace" name="add-patient-antigen-place" placeholder="(Optional)">
                        </div>


                        <div class="col-md-8 covid-input">
                            <label for="inputComments" class="form-label-primary label-primary covid-input-label"> <span class="covid-form-comment">Comments</span></label>
                            <textarea class="form-control covid-input-field covid-textarea" id="inputComments" rows="4" placeholder="(Optional)" name="add-antigen-comment"></textarea>
                        </div>

                    </div>
                    <div class="modal-footer covid-modal-footer">
                        <button type="submit" class="btn btn-primary covid-submit-btn" name="add-patient-submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>


        <!-- This is the model for updating result of antigen -->
        <div class="modal fade" id="antigen-result" tabindex="-1" aria-labelledby="vac-forum" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-md">

                <form class="modal-content" method="POST" action="<?php echo URL_ROOT; ?>/pages/vaccination">

                <div class="modal-header test-toggle-modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                    <div class="modal-body test-toggle-modal-body">

                        <div class="col-md-8 covid-input">
                            <label for="togBtn" class="form-label label test-toggle-label">Antigen Test result</label>
                            </label>

                            <!-- This is the code to toggle button -->
                            <div class="form-control test-toggle-input">
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
                    <div class="modal-footer test-toggle-footer">
                        <button type="submit" class="btn btn-primary test-toggle-submit-btn" name="add-patient-submit">Update</button>
                    </div>
                </form>
            </div>
        </div>

    </section>


    <script src="<?php echo URL_ROOT; ?>/public/script/test.js"></script>

</body>