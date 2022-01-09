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
                <li class="dashboard-list" data-toggle="tooltip" data-placement="right" title="User Management">
                    <a href="<?= URL_ROOT ?>/pages/user_management" class="option">
                        <span class="dashboard-link-icon"><i class='bx bxs-user-detail'></i></span>
                        <span class="text">User Management</span>
                    </a>
                </li>
                <li class="dashboard-list" data-toggle="tooltip" data-placement="right" title="Data Management">
                    <a href="<?= URL_ROOT ?>/pages/data_management" class="option" data-bs-toggle="modal" data-bs-target="#modalfordata">
                        <span class="dashboard-link-icon"><i class='bx bxs-data'></i></span>
                        <span class="text">Data Management</span>
                    </a>
                </li>
                <li class="dashboard-list admin-settings" data-toggle="tooltip" data-placement="right" title="Settings">
                    <a href="<?= URL_ROOT ?>/pages/settings" class="option">
                        <span class="dashboard-link-icon"><i class='bx bx-cog'></i></span>
                        <span class="text">Settings</span>
                    </a>
                </li>
                <li class="dashboard-list" data-toggle="tooltip" data-placement="right" title="Log Out">
                    <a href="<?= URL_ROOT ?>/pages/logout" class="option">
                        <span class="dashboard-link-icon"><i class='bx bx-log-out-circle bx-flip-horizontal'></i></span>
                        <span class="text">Log Out</span>
                    </a>
                </li>
            </ul>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="modalfordata" data-bs-backdrop="static" tabindex="-1" aria-labelledby="dataModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="dataModalLabel">Data Management</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="data-modal-heading">
                            <h5>Select the preferred record type..</h5>
                        </div>
                        <div class="data-selection">
                            <nav class="data-select-ul nav flex-column">
                                <a class="data-select-li btn btn-outline-primary" href="<?= URL_ROOT; ?>/pages/data_management?record_type=vaccinations">Vaccinations</a>
                                <a class="data-select-li btn btn-outline-primary" href="<?= URL_ROOT; ?>/pages/data_management?record_type=pcr_tests">PCR Tests</a>
                                <a class="data-select-li btn btn-outline-primary" href="<?= URL_ROOT; ?>/pages/data_management?record_type=antigen_tests">Antigen Tests</a>
                                <a class="data-select-li btn btn-outline-primary" href="<?= URL_ROOT; ?>/pages/data_management?record_type=covid_patients">COVID Patients</a>
                                <a class="data-select-li btn btn-outline-primary" href="<?= URL_ROOT; ?>/pages/data_management?record_type=covid_deaths">COVID Deaths</a>
                            </nav>
                        </div>

                    </div>
                </div>
            </div>
        </div>