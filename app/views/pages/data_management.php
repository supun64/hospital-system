<?php require_once APP_ROOT."/views/pages/admin_dashboard.php"?>
<div class="sub-division">
        <div class="data-heading">
            <h1>Data Management</h1>
        </div>
        <div class="data-search-bar d-flex flex-row justify-content-between">
            <form class="data-select-box">
                <div class="row row-cols-auto d-flex justify-content-start">
                    <div class="col">
                        <select class="form-select" aria-label=".form-select-sm example">
                            <option selected>Select the record type..</option>
                            <option value="1">Vaccination</option>
                            <option value="2">Antigen</option>
                            <option value="3">Patient details</option>
                            <option value="3">CoVID death</option>
                            <option value="3">PCR</option>
                        </select>
                    </div>
                </div>
            </form>
            <form class="data-select-box">
                <div class="row row-cols-auto d-flex justify-content-end">
                    <div class="col"><input class="form-control" type="text" placeholder="Enter record ID" required></div>
                    <div class="col"><input type="image" src="<?= URL_ROOT?>/public/images/search.png" alt="Submit" width=50%></div>
                </div>
            </form>
        </div>
        <div class="data-table">
            <table class="table table-striped table-hover table-responsive">
                <tbody>
                    <tr class= "data-table-row">
                        <th scope="row">1</th>
                        <td>Mark</td>
                        <td>Otto</td>
                        <td>@mdo</td>
                        <td  class = "data-edit">
                            <a href="#"><i class='bx bxs-edit' style="color: black"></i></a>
                        </td>
                        <td>
                            <form>
                                    <input type="hidden" name="id" value="get the id from the table">
                                    <input  class="data-delete" type="image" src="<?= URL_ROOT?>/public/images/trash.png" alt="Submit">
                            </form>
                        </td>
                    </tr>
                    <tr class= "data-table-row">
                        <th scope="row">2</th>
                        <td>Mark</td>
                        <td>Otto</td>
                        <td>@mdo</td>
                        <td  class = "data-edit">
                            <a href="#"><i class='bx bxs-edit' style="color: black"></i></a>
                        </td>
                        <td>
                            <form>
                                    <input type="hidden" name="id" value="get the id from the table">
                                    <input  class="data-delete" type="image" src="<?= URL_ROOT?>/public/images/trash.png" alt="Submit">
                            </form>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php require_once  APP_ROOT."/views/pages/script.php"?>

<?php require_once APP_ROOT."/views/includes/footer.php"?>