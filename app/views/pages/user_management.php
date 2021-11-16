<?php require_once APP_ROOT."/views/pages/admin_dashboard.php"?>


<div class= 'sub-division' style="padding: 5px;">

<!-- code snippet to show error message for existing username -->
<?php 
if(isset($_GET['duplicate'])){?>
    <div class="alert alert-danger alert-dismissible fade show deo-manage-error-box" role="alert" >
        <div class="deo-manage-error-text">Username already exist !!</div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php } ?>

        <div class="data-heading">

            <h1>User Management</h1>
        </div>
        <div class="data-search-bar d-flex flex-row justify-content-between">
        <!-- add new data entry operator-->
        <div class="col-md-1"> 
            <button type="button" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#deo-manage-nw-deo-form">
                &plus;Add new
            </button>           
        </div>
 
            <form class="data-select-box" action="<?php echo URL_ROOT; ?>/pages/user_management" method="POST">           
                <div class="input-group mb-3">
                    <input type="text" id="deo-search-bar" class="form-control" placeholder="Search" aria-label="DEO's username" aria-describedby="button-deo-serach">
                    <!-- <button class="btn btn-outline-primary" type="submit" id="button-deo-search">Search</button> -->
                </div>
            </form>
        </div>

<!-- DEO table -->
<table class="table table-hover" id="deo-table">
    <thead>
        <tr>
        <th scope="col">Emp. ID</th>
        <th scope="col">Username</th>
        <th scope="col">Email</th>
        <th scope="col"></th>
        </tr>
    </thead>
    <tbody>
        <!-- code snippet to loop through array and show users -->
    <?php foreach($data as $deo): ?> 
                <tr class="data-table-row">
                <form action="<?php echo URL_ROOT; ?>/pages/user_management" method="POST">
                    <th scope="row"><?php echo $deo['user_id'] ?></th>
                    <td><?php echo $deo['user_name'] ?></td>
                    <td><?php echo $deo['user_email'] ?></td>
                    
                    <td>
                    <button type="submit" class="deo-manage-rm-btn" name="rm_submit">
                    <span data-feather="user-x"></span>
                    </button>

                    <!-- TO-DO   onclick -> popup dialogue for confirmation -->
                    
                    </td>
                </form>
               
                </tr>
                <?php endforeach; ?>

    </tbody>
</table>

    <!-- this is the form for new DEO -->

<!-- Modal -->
<div class="modal fade" id="deo-manage-nw-deo-form" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Add New DEO</h5>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>

    <div class="modal-body">

        <form action="<?php echo URL_ROOT; ?>/pages/user_management" class="row g-3 requires-validation" novalidate method="POST">
        <div class="col-md-6">
            <label for="deo_fname" class="form-label">Username</label>
            <input type="text" class="form-control" name="deo_username" required>
            <div class="invalid-feedback">
            This Field can't be empty
            </div>
        </div>

        <div class="col-md-6">
            <label for="deo_mail" class="form-label">Email</label>
            <input type="text" class="form-control" name="deo_email" aria-describedby="inputGroupPrepend" required>
            <div class="invalid-feedback">
            This Field can't be empty
            </div>
        </div>

        <div class="col-md-6">
            <label for="password" class="form-label">Temporary Password</label>
            <input type="password" class="form-control" name="password" id="pwd" required >
            <div class="invalid-feedback">
            This Field can't be empty
            </div>
        </div>

        <div class="col-md-6">
            <label for="confirm_password" class="form-label">Confirm Password</label>
            <input type="password" class="form-control" name="confirm_password" id="cpwd" required >
            <div class="invalid-feedback">
            This Field can't be empty
            </div>
        </div>
        <div class="pwd-error-msg invisible"><p style="color: red;"> passwords do not match</p></div>
        </div>
        <div class="modal-footer">
        <button type="button" id="form-close" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" name="nw_deo_submit" onclick="return Validate()">Add DEO</button>
        </div>
        
        </form>
  </div>
</div>
</div>
</div>

<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script type="text/javascript">
    //live search bar
    $(document).ready(function(){
        $("#deo-search-bar").keyup(function(){
            search_table($(this).val());
        });

        function search_table(value){
            
            $('#deo-table tr').each(function(){
                var found = 0;
                $(this).each(function(){

                if($(this).text().toLocaleLowerCase().indexOf(value.toLocaleLowerCase())>=0){
                    found = 1;
                }
            });
            if(found ==1){
                $(this).show();
            }else{
                $(this).hide();
            }
         }); 
        }

    });


</script>



<script type="text/javascript">
    //scrypt to validate password matching in new deo forum 
    function Validate() {
        var password = document.getElementById("pwd").value;
        var confirmPassword = document.getElementById("cpwd").value;
        if (password != confirmPassword) {
            const msg = document.querySelector('.pwd-error-msg')
            msg.classList.remove('invisible')
            return false;
        }
        return true;
    }
</script>


<script>
    // scrypt to active feather icons
        feather.replace()
</script>


<script>
    //scrypt to validate filled/empty add new deo forum fields
        (function () {
    'use strict'
    const forms = document.querySelectorAll('.requires-validation')
    Array.from(forms)
    .forEach(function (form) {
        form.addEventListener('submit', function (event) {   
        if (!form.checkValidity()) {
            event.preventDefault()
            event.stopPropagation()
        }

        form.classList.add('was-validated')

        }, false)
    })
    })()
</script>

<?php require_once  APP_ROOT."/views/pages/script.php"?>
<?php require_once APP_ROOT."/views/includes/footer.php"?>