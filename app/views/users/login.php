<?php  require APP_ROOT.'/views/includes/header.php';  ?>

<!-- These are the functions used -->

<!-- 
    show_form -> To show the form 
 -->
 <?php function show_form_signin($useremail,$password,$error)
{ ?>
    
    <form method="POST" action="<?php echo URL_ROOT; ?>/users/login?hospital-id=<?=$_GET["hospital-id"]?>">

        <!--changes the classname of form controls if an error occurs and the previous values are printed as email and password-->
        <div class="form-floating mb-2"> 
            <input type="email" class="form-control <?=!empty($error)?"is-invalid":""?>" id="floatingInput" value ="<?=$useremail?>" placeholder="name@exampl;4e.com" name="useremail" required>
            <label for="floatingInput">Email address</label>
        </div>
        <div class="form-floating mb-2">
            <input type="password" class="form-control <?=!empty($error)?"is-invalid":""?>" id="floatingPassword"  value ="<?=$password?>" placeholder="Password" name="password"required>
            <label for="floatingPassword">Password</label>
        </div>
        <small id="login-errors" class="form-text"> 
            <?=$error?>
        </small>

        <button class="w-100 btn btn-lg btn-outline-primary login-btn-signup" type="submit">Sign in</button>
        <p class="mt-5 mb-0 text-muted"> Squ4dOption &trade;</p>
    </form>

<?php } ?>

<!-- Mark up codes -->
<body class="text-center login-body">

    <main class="login-main">

        <!-- This display in exept small screens -->
        <div class="card login-card mb-0 container px-0 d-sm-block d-none" style="max-width: 540px;">
            <div class="row g-0">

                <div class="col-sm-6">
                    <div class="card-body">
                        <?php $error = isset($data['errors'])?$data['errors']:""?>
                        <?php $useremail = isset($data['user_email'])?$data['user_email']:""?>
                        <?php $password = isset($data['password'])?$data['password']:""?>
                        <?php show_form_signin($useremail,$password,$error) ?>
                    </div>
                </div>
                <div class="col-sm-6">
                    <img src="<?php echo URL_ROOT;?>/public/images/login_main.jpeg" class="img-fluid login-img-fluid" alt="Hospital image">           
                </div>
            </div>
        </div>

        <!-- This is what display in small screens -->

        <div class="container rounded p-3 d-block d-sm-none" style="background-color:white">
            <!-- To show the form in the division -->
            <?php show_form_signin($useremail,$password,$error); ?>
        </div>
    </main>


<!-- Optional JavaScript; choose one of the two! -->

<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>

<?php  require APP_ROOT.'/views/includes/footer.php';  ?>