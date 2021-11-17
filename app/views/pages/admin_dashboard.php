<?php require_once APP_ROOT."/views/includes/header.php"?>
<body>
    
<div class="dashboard-container">
    <div class="dashboard-sidebar-container admin">
      <div class="dashboard-banner">
          <span class="dashboard-toggle-icon"><i class='bx bx-menu'></i></span>
          <span class="dashboard-text">Dashboard</span>
      </div>
        <ul class="dashboard-side-bar">
            <li class="dashboard-list">
                <div class="dashboard-icon"><i class='bx bx-user-circle' style='color:#fff6f6'  ></i></div>
                <div class="dashboard-user-credentials">
                    <div class="hospital-name">HOSPITAL NAME</div>
                    <div class="user-name">USER NAME</div>
                </div>
            </li>
            <li class="dashboard-list" data-toggle="tooltip" data-placement="right" title="Home">
                <a href="<?= URL_ROOT ?>/pages/home" class="option">
                    <span class="dashboard-link-icon"><i class='bx bxs-home' ></i></span>
                    <span class="text">Home</span>
                </a>
            </li>
            <li class="dashboard-list" data-toggle="tooltip" data-placement="right" title="User Management">
                <a href="<?= URL_ROOT ?>/pages/user_management" class="option">
                    <span class="dashboard-link-icon"><i class='bx bxs-user-detail' ></i></span>
                    <span class="text">User Management</span>
                </a>
            </li>
            <li class="dashboard-list" data-toggle="tooltip" data-placement="right" title="Data Management">
                <a href="<?= URL_ROOT ?>/pages/data_management" class="option"  data-bs-toggle="modal" data-bs-target="#modalfordata">
                    <span class="dashboard-link-icon"><i class='bx bxs-data'  ></i></span>
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
                <a href="#" class="option">
                    <span class="dashboard-link-icon"><i class='bx bx-log-out-circle bx-flip-horizontal'  ></i></span>
                    <!--<span class="text">Log Out</span>-->
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
        Select the record type...
        <div class="dropdown">
                <a class="btn btn-outline-primary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                    Select the record type..
                </a>

                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                    <li><a class="dropdown-item" href="<?=URL_ROOT; ?>/pages/data_management?record_type=vaccinations">Vaccination</a></li>
                    <li><a class="dropdown-item" href="<?=URL_ROOT; ?>/pages/data_management?record_type=antigen_tests">Antigen</a></li>
                    <li><a class="dropdown-item" href="<?=URL_ROOT; ?>/pages/data_management?record_type=covid_deaths">COVID deaths</a></li>
                    <li><a class="dropdown-item" href="<?=URL_ROOT; ?>/pages/data_management?record_type=pcr_tests">PCR tests</a></li>
                </ul>
            </div>
      </div>
    </div>
  </div>
</div>

