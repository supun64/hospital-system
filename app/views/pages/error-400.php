<?php require_once APP_ROOT . "/views/includes/header.php" ?>
<div class="error-page bad-request">
    <div class="error-main">
        <p>OOPS!</p> 
    </div>
    <div class="error-msg">

        <pre>4 0 0 - B A D   R E Q U E S T</pre> 
    </div>
    <div class="error-desc">
        <p>There was a problem with your request.</p>
    </div>
    <div class="error-button">
    <a href="<?= URL_ROOT; ?>/pages/index" id="home-page" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">GO TO HOMEPAGE</a>
    </div>
</div>

<?php require_once APP_ROOT . "/views/includes/footer.php" ?>