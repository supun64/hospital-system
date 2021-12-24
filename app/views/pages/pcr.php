<?php require APP_ROOT . '/views/includes/header.php';  ?>

<?php $cur_hos = $_SESSION['hospital_id'];?>
<input type="text" id="cur-hos" hidden value="<?php echo $cur_hos?>">

<body>
<?php 
if(isset($_GET['not-user'])){?>
    <div class="alert alert-danger alert-dismissible fade show deo-manage-error-box" role="alert" >
        <div class="deo-manage-error-text"> Wrong Health ID !!</div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php } ?>

<?php 
if(isset($_GET['success'])){?>
    <div class="alert alert-success alert-dismissible fade show deo-manage-error-box" role="alert" >
        <div class="deo-manage-error-text"> Record successfully added</div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php } ?>

    <section class="main-info">


        <!-- covid-shrunk-search class should add after the search -->
        <div class="covid-search covid-shrunk-search" id="covid-main-search-engine">
            <div class="covid-title">
                <img class="covid-logo" src="<?php echo URL_ROOT; ?>/public/images/pcr-logo.jpg" alt="covid-19 covid">
                <h1 class="text-primary">PCR Tests</h1>
            </div>

            <form class="form mb-3 covid-search-div" method="POST" action="<?php echo URL_ROOT; ?>/pages/pcr">

                <input type="text" class="covid-search-bar form-control" id="covid-search-bar-input" placeholder="Enter health ID here" name="pcr-search-bar-input" required>

                <input type="submit" class="btn btn-primary" id="covid-search-btn" name="pcr-search" value="Search">

            </form>

        </div>

        <!-- This is what should display after search -->
        <?php if ($data["personal"]) { ?> 

        <!-- Add addmination-fade-in-pre-state to add the animation -->
        <div class="covid-search-result" id="covid-search-result-section">
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add-new-pcr">Add new PCR +</button>

            <!-- This is the division to display if the search result available -->




            <div class="covid-details">

                <div class="covid-patient-detail">
                    <table id="pcr-table">
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

            <?php if($data['pcr_tests']){?>
                <!-- These are the vaccination details -->

                <div class="covid-previous-details">

                    <div class="covid-tr covid-top-tr">
                        <div class="covid-th covid-td">PCR ID </div>
                        <div class="covid-th covid-td">Hospital Id</div>
                        <div class="covid-th covid-td">Date</div>
                        <div class="covid-th covid-td">Status</div>
                        <div class="covid-th covid-td">Conducted Place</div>
                    </div>

             
                <?php
                $pcr_tests = $data["pcr_tests"];
                foreach ($pcr_tests as $pcr) :
                ?>

                <div class="pcr-rw">
                    <div class="covid-tr" data-bs-toggle="modal" data-bs-target="#pcr-result">
                        <div class="covid-td" >
                        <?php echo $pcr["id"] ?>
                        </div>

                        <div class="covid-td">
                        <?php echo $pcr["hospital_id"] ?>
                        </div>

                        <div class="covid-td">
                        <?php echo $pcr["date"] ?>
                        </div>

                        <div class="covid-td" >
                        <?php echo $pcr["status"] ?>
                        </div>

                        <div class="covid-td" >
                        <?php echo $pcr["place"] ?>
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
                            <input type="text" readonly class="form-control form-control-sm" id="inputHealthID" name="add-patient-health-id" value="<?php echo $data['personal']['health_id']?>">
                        </div>

                        <div class="col-md-6 covid-input">
                            <label for="inputDate" class="form-label-primary covid-input-label">Tested Date</label>
                            <input type="date" value="<?php echo date('d-m-Y'); ?>" class="form-control covid-input-field" id="inputDate" name="add-patient-pcr-date" required>
                        </div>

                        <div class="col-md-8 covid-input">
                            <label for="inputHospital" class="form-label-primary covid-input-label">Conducted Hospital</label>
                            <input type="text" readonly class="form-control form-control-sm" id="inputHealthID" name="add-patient-hospital" value="<?php echo $data['hospital_id']?>">                           

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
                                        <span class="on toggle-font" >Possitive</span>
                                        <span class="off toggle-font">Negetive</span>
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

<script>
    tog_btn = document.getElementById("togBtn");
    hdn_btn = document.getElementById("hidden-status");
    document.getElementById("hidden-status").value = "negative";
    hdn_btn = 
tog_btn.onclick= function(){
    if(tog_btn.checked){
        document.getElementById("hidden-status").value = "positive";
        
    }else{
        document.getElementById("hidden-status").value = "negative";
    }
    console.log(document.getElementById("hidden-status").value);
}

</script>

<script>
    //add event listeners to each row
document.querySelectorAll('.pcr-rw').forEach(item => {
  item.addEventListener('click', event => {
    children = item.childNodes;
    arr = children[1].innerText.split("\n");
   // console.log(arr);
   //backend purposes -> get values
     document.getElementById('hidden-id').value = arr[0];
     document.getElementById('hidden-hid').value = arr[1];
     document.getElementById('hidden-date').value = arr[2];
     document.getElementById('hidden-place').value = arr[4];

    //disable button for unauthorized hospitals
    document.getElementById('togBtn').disabled = false;  //enable continue button
    document.getElementById('update-btn').disabled = false;  //enable continue button
    if(document.getElementById('cur-hos').value != document.getElementById('hidden-hid').value){
     document.getElementById('togBtn').disabled = true;
     document.getElementById('update-btn').disabled = true;  //enable continue button
    }

    if(arr[3] != "pending"){
        document.getElementById('togBtn').disabled = true;
        document.getElementById('update-btn').disabled = true;  //enable continue button
    }

  });
});
</script>



    <script src="<?php echo URL_ROOT; ?>/public/script/test.js"></script>

</body>