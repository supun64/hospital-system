<?php require_once APP_ROOT . "/views/includes/header.php" ?>

<body style="
background-image: url('<?php echo URL_ROOT; ?>/public/images/dashboard-background.jpg');
background-repeat: repeat;
background-attachment: fixed;">

    <div class="dashboard-container">
        <div class="dashboard-sidebar-container">
            <div class="dashboard-banner">
                <span class="dashboard-toggle-icon"><i class='bx bx-menu'></i></span>
                <span class="dashboard-text">Dashboard</span>
            </div>
            <ul class="dashboard-side-bar">
                <div class="dashboard-account-details">
                    <div class="dashboard-icon"><i class='bx bx-user-circle' style='color:#000000'></i></div>
                    <div class="dashboard-user-credentials">
                        <div class="hospital-name dashboard-credential-label" style="font-size: 13.5pt;"><?= strtoupper($_SESSION['hospitalname']) ?></div>
                        <div class="user-name dashboard-credential-label"><?= strtoupper($_SESSION['username']) ?></div>
                    </div>
                </div>
                <li class="dashboard-list" data-toggle="tooltip" data-placement="right" title="Home">
                    <a href="<?= URL_ROOT ?>/pages/index" class="option">
                        <span class="dashboard-link-icon"><i class='bx bxs-home'></i></span>
                        <span class="text">Home</span>
                    </a>
                </li>
                <li class="dashboard-list" data-toggle="tooltip" data-placement="right" title="Vaccination">
                    <a href="<?= URL_ROOT ?>/pages/vaccination" class="option">
                        <span class="dashboard-link-icon"><img class="dashboard-link-icon-img" src="<?= URL_ROOT ?>/public/images/vaccine_white.png" alt="" srcset=""></span>
                        <span class="text">Vaccination</span>
                    </a>
                </li>
                <li class="dashboard-list" data-toggle="tooltip" data-placement="right" title="PCR Test">
                    <a href="<?= URL_ROOT ?>/pages/pcr" class="option">
                        <span class="dashboard-link-icon"><img class="dashboard-link-icon-img" src="<?= URL_ROOT ?>/public/images/swab_white.png" alt="" srcset=""></span>
                        <span class="text">PCR Test</span>
                    </a>
                </li>
                <li class="dashboard-list" data-toggle="tooltip" data-placement="right" title="Antigen Test">
                    <a href="<?= URL_ROOT ?>/pages/antigen" class="option">
                        <span class="dashboard-link-icon"><img class="dashboard-link-icon-img" src="<?= URL_ROOT ?>/public/images/blood_white.png" alt="" srcset=""></span>
                        <span class="text">Antigen Test</span>
                    </a>
                </li>
                <li class="dashboard-list">
                    <a href="<?= URL_ROOT ?>/pages/covid_patients" class="option" data-toggle="tooltip" data-placement="right" title="COVID Patient">
                        <span class="dashboard-link-icon"><img class="dashboard-link-icon-img" src="<?= URL_ROOT ?>/public/images/facial-mask_white.png" alt="" srcset=""></span>
                        <span class="text">COVID Patient</span>
                    </a>
                </li>
                <li class="dashboard-list" data-toggle="tooltip" data-placement="right" title="COVID Death">
                    <a href="<?= URL_ROOT ?>/pages/covid_deaths" class="option">
                        <span class="dashboard-link-icon"><img class="dashboard-link-icon-img" src="<?= URL_ROOT ?>/public/images/death_white.png" alt="" srcset=""></span>
                        <span class="text">COVID Death</span>
                    </a>
                </li>

                <li class="dashboard-list" data-toggle="tooltip" data-placement="right" title="Settings">
                    <a href="<?= URL_ROOT ?>/pages/settings" class="option">
                        <span class="dashboard-link-icon"><i class='bx bx-cog'></i></span>
                        <span class="text">Settings</span>
                    </a>
                </li>

                <li class="dashboard-list" data-toggle="tooltip" data-placement="right" title="Log Out">
                    <a href="<?= URL_ROOT ?>/users/logout" class="option">
                        <span class="dashboard-link-icon"><i class='bx bx-log-out-circle bx-flip-horizontal'></i></span>
                        <span class="text">Log Out</span>
                    </a>
                </li>


            </ul>
        </div>