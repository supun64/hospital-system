<?php require_once APP_ROOT . "/views/pages/admin_dashboard.php" ?>
<div class="sub-division">
    <main class="sub-division-main">
        <div class="data-heading">
            <h1>Data Management</h1>
            <?= isset($_GET['record_type']) ? implode(' ', explode('_', strtoupper($_GET['record_type']))) : "Please select the record type.."; ?>
        </div>
        <div class="data-search-bar d-flex flex-row justify-content-between">
            <div class="dropdown">
                <a class="btn btn-outline-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                    Select the record type..
                </a>

                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                    <li><a class="dropdown-item" href="<?= URL_ROOT; ?>/pages/data_management?record_type=vaccinations">Vaccinations</a></li>
                    <li><a class="dropdown-item" href="<?= URL_ROOT; ?>/pages/data_management?record_type=antigen_tests">Antigen</a></li>
                    <li><a class="dropdown-item" href="<?= URL_ROOT; ?>/pages/data_management?record_type=pcr_tests">PCR Tests</a></li>
                    <li><a class="dropdown-item" href="<?= URL_ROOT; ?>/pages/data_management?record_type=covid_deaths">COVID Deaths</a></li>
                    <li><a class="dropdown-item" href="<?= URL_ROOT; ?>/pages/data_management?record_type=covid_patients">Covid Patients</a></li>
                </ul>
            </div>
            <form class="data-select-box">
                <div class="row row-cols-auto d-flex justify-content-end">
                    <div class="col"><input class="data-search-bar form-control" id='deo-search-bar' type="text" placeholder="Enter Health ID" required></div>
                </div>
            </form>
        </div>
        <div>
            <?php $counter = 1; ?>
            <?php if (isset($data['type']) && count($data) > 2) : ?>
                <table class="data-table table  table-hover table-responsive" id="deo-table">
                    <tbody>
                        <thead>
                            <?php foreach ($data['type'] as $column) : ?>
                                <td><?= $column ?></td>
                            <?php endforeach;
                            unset($data['type']); ?>
                            <td></td>
                            <td></td>
                        </thead>
                        <?php foreach ($data as $record) : ?>
                            <tr class="data-table-row">
                                <?php if (gettype($record) != "string") : ?>
                                    <?php foreach ($record as $key => $value) : ?>

                                        <?php if ($key === "hospital_id" || $key === "id" || $key === "admission_id" || $key === "date") : ?>
                                            <?php continue; ?>

                                        <?php else : ?>

                                            <td><?= $value ?></td>

                                        <?php endif; ?>
                                    <?php endforeach; ?>

                                    <td class="data-edit">
                                        <button class='btn btn-outline-info data-update-cus-btn' data-bs-toggle="modal" data-bs-target="#modalfor<?php echo $data[count($data) - 1] . $counter ?>">
                                            <i class='data-edit-button bx bxs-edit' style="color: black"></i>
                                        </button>
                                    </td>
                                    <td>
                                        <button class='btn btn-outline-info data-update-cus-btn' data-bs-toggle="modal" data-bs-target="#delmodalfor<?php echo $data[count($data) - 1] . $counter ?>">
                                            <i class='bx bxs-trash data-edit-button'  style="color: black"></i>
                                        </button>
                                    </td>
                            </tr>

                        <?php endif; ?>
                        <?php $counter++; ?>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else : ?>
                <?php if (!isset($data['type'])) : ?>
                    <div class="alert alert-danger" role="alert">
                        <h5>You haven't selected the record type yet.</h5>
                    </div>
                <?php elseif (count($data) < 3) : ?>
                    <div class="alert alert-danger" role="alert">
                        <h5>No records of <?= implode(' ', explode('_', $_GET['record_type'])) ?> were updated / inserted today.</h5>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </main>
</div>

<!--Modals -->
<?php $counter = 1; ?>
<?php if (count($data) >= 2) : ?>
    <?php foreach ($data as $record) : ?>
        <?php if (gettype($record) != "string") : ?>

            <!-- Modal for updating-->
            <?php if ($data[count($data) - 1] === 'antigen_tests' || $data[count($data) - 1] === 'pcr_tests') : ?>
                <div class="modal fade" id="modalfor<?php echo $data[count($data) - 1] . $counter ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Update</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">

                                <form method="post" action="<?= URL_ROOT; ?>/pages/data_management?record_type=<?= $data[count($data) - 1] ?>">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="floatingInput" placeholder="Health ID" name="newrecord[health_id]" value="<?= $record['health_id'] ?>" disabled>
                                        <label for="floatingInput">Health ID</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="floatingPassword" placeholder="Test status" name="newrecord[status]" value="<?= $record['status'] ?>">
                                        <label for="floatingPassword">Test Status</label>
                                    </div>

                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="floatingPassword" placeholder="Place" name="newrecord[place]" value="<?= $record['place'] ?>">
                                        <label for="floatingPassword">Place</label>
                                    </div>
                            </div>
                            <input type="hidden" name="newrecord[id]" value="<?= $record['id'] ?>">
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            <?php if ($data[count($data) - 1] === 'vaccinations') : ?>
                <div class="modal fade" id="modalfor<?php echo $data[count($data) - 1] . $counter ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Update</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">

                                <form method="post" action="<?= URL_ROOT; ?>/pages/data_management?record_type=<?= $data[count($data) - 1] ?>">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="floatingInput" placeholder="Health ID" name="newrecord[batch_num]" value="<?= $record['batch_num'] ?>">
                                        <label for="floatingInput">Batch Number</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="floatingInput" placeholder="Health ID" name="newrecord[health_id]" value="<?= $record['health_id'] ?>" disabled>
                                        <label for="floatingInput">Health ID</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="floatingPassword" placeholder="Dose" name="newrecord[dose]" value="<?= $record['dose'] ?>">
                                        <label for="floatingPassword">Dose</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="floatingPassword" placeholder="Name of Vaccine" name="newrecord[vaccine_name]" value="<?= $record['vaccine_name'] ?>">
                                        <label for="floatingPassword">Vaccine Name</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="floatingPassword" placeholder="Conducted Place" name="newrecord[vaccinated_place]" value="<?= $record['vaccinated_place'] ?>">
                                        <label for="floatingPassword">Conducted Place</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="textarea" class="form-control" id="floatingPassword" placeholder="Comments" name="newrecord[comments]" value="<?= $record['comments'] ?>" style="height: 100px">
                                        <label for="floatingPassword">Comments</label>
                                    </div>
                                    <input type="hidden" name="newrecord[id]" value="<?= $record['id'] ?>">
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            <?php if ($data[count($data) - 1] === 'covid_patients') : ?>
                <div class="modal fade" id="modalfor<?php echo $data[count($data) - 1] . $counter ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Update</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">

                                <form method="post" action="<?= URL_ROOT; ?>/pages/data_management?record_type=<?= $data[count($data) - 1] ?>">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="floatingInput" placeholder="Health ID" name="newrecord[health_id]" value="<?= $record['health_id'] ?>" readonly>
                                        <label for="floatingInput">Health ID</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="floatingPassword" placeholder="Dose" name="newrecord[admission_date]" value="<?= $record['admission_date'] ?>">
                                        <label for="floatingPassword">Admission Date</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="floatingPassword" placeholder="Name of Vaccine" name="newrecord[discharge_date]" value="<?= $record['discharge_date'] ?>">
                                        <label for="floatingPassword">Discharge Date</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="floatingPassword" placeholder="Conducted Place" name="newrecord[conditions]" value="<?= $record['conditions'] ?>">
                                        <label for="floatingPassword">Conditions</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="textarea" class="form-control" id="floatingPassword" placeholder="Comments" name="newrecord[status]" value="<?= $record['status'] ?>" style="height: 100px" readonly>
                                        <label for="floatingPassword">Status</label>
                                    </div>
                                    <input type="hidden" name="newrecord[admission_id]" value="<?= $record['admission_id'] ?>">
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save Changes</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            <?php if ($data[count($data) - 1] === 'covid_deaths') : ?>
                <div class="modal fade" id="modalfor<?php echo $data[count($data) - 1] . $counter ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Update</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">

                                <form method="post" action="<?= URL_ROOT; ?>/pages/data_management?record_type=<?= $data[count($data) - 1] ?>">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="floatingInput" placeholder="Health ID" name="newrecord[health_id]" value="<?= $record['health_id'] ?>" disabled>
                                        <label for="floatingInput">Health ID</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="floatingPassword" placeholder="Conducted Place" name="newrecord[place]" value="<?= $record['place'] ?>">
                                        <label for="floatingPassword">Place</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="textarea" class="form-control" id="floatingPassword" placeholder="Add a comment here..." name="newrecord[comments]" value="<?= $record['comments'] ?>" style="height: 100px">
                                        <label for="floatingPassword">Comments</label>
                                    </div>
                                    <input type="hidden" name="newrecord[id]" value="<?= $record['id'] ?>">
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save Changes</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            <!--Modal for deleting-->
            <div class="modal fade" id="delmodalfor<?php echo $data[count($data) - 1] . $counter ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Delete</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body container">
                            <div class="row">
                                <div class="col">
                                    <h3><i class='bx bxs-alarm-exclamation' style='color:#ff0a0a'></i></h3>
                                </div>
                                <div class="col-11">
                                    <h5>Are you sure you want to delete this record?</h5>
                                </div>
                            </div>
                            <form action="<?= URL_ROOT; ?>/pages/data_management?record_type=<?= $data[count($data) - 1] ?>" method='POST'>
                                <input type="hidden" name="id" value="<?= isset($record['id']) ? $record['id'] : $record['admission_id'] ?>">

                                <div class="modal-footer">
                                    <button type="submit" name='delete_submitted' class="btn btn-danger">Confirm</button>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        <?php endif; ?>
        <?php $counter++; ?>
    <?php endforeach; ?>
<?php endif; ?>

<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="<?= URL_ROOT ?>./public/script/admin.js"></script>
<?php require_once APP_ROOT . "/views/includes/footer.php" ?>