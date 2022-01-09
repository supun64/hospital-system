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


        <!-- This is the button for showing the off canvas -->
        <?php
        $controller_arr = explode('/', filter_var(rtrim($_SERVER['REQUEST_URI'], '/'), FILTER_SANITIZE_URL));
        $page_arr = explode('?', $controller_arr[3]);
        $page = $page_arr[0];

        if ($page != "index") :
        ?>
            <button class="dashboard-search-health-id" type="button" data-bs-toggle="offcanvas" data-bs-target="#forget-id-canvas" aria-controls="#forget-id-canvas">
                <div class="dashboard-health-id-div">
                    <span>Search Health ID</span><img class="dashboard-health-id-icon" src="<?= URL_ROOT ?>/public/images/left-arrow.png" alt="" srcset="">
                </div>
            </button>

        <?php endif; ?>

        <!-- This is the code for the off canvas for search for health ID -->
        <div class="offcanvas offcanvas-end dashboard-offcanvas" data-bs-scroll="true" tabindex="-1" id="forget-id-canvas" aria-labelledby="offcanvasWithBothOptionsLabel">

            <!-- This is the button for showing the off canvas -->
            <button class="dashboard-search-health-id dashboard-search-health-id-post" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithBothOptions" aria-controls="offcanvasWithBothOptions">
                <div class="dashboard-health-id-div"><span style="transform: rotate(-90deg); width: 150px">Search Health ID</span><img class="dashboard-health-id-icon" src="<?= URL_ROOT ?>/public/images/left-arrow.png" alt="" srcset=""></div>
            </button>

            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasWithBothOptionsLabel">Search for health ID</h5>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close" id="forget-id-close-btn" onclick="my_func()"></button>
            </div>
            <?php
            $controller_arr = explode('/', filter_var(rtrim($_SERVER['REQUEST_URI'], '/'), FILTER_SANITIZE_URL));
            $page_arr = explode('?', $controller_arr[3]);
            $controller = "/" . $controller_arr[2] . "/" . $page_arr[0];
            ?>
            <form class="offcanvas-body" action="<?= URL_ROOT . $controller ?>" method="POST">

                <div class="dashboard-health-id-search-type col-md-12 covid-input">

                    <label for="dashboard-search-by" class="form-label-primary label-primary covid-input-label">Search Type</label>


                    <div class="dashboard-dropdown covid-input-field" style="position: relative;">

                        <select class="form-control dashboard-dropdown-btn covid-input-field" aria-labelledby=" dropdownMenuButton" name="forget-id-type" required> 
                            <option value="" selected disabled hidden>Choose type</option>
                            <option name="forget-id-type"><a class="dropdown-item">Contact Number</a></option>
                            <option name="forget-id-type"><a class="dropdown-item">Email</a></option>
                            <option name="forget-id-type"><a class="dropdown-item">NIC</a></option>
                        </select>

                        <div class="dashboard-dropdown-arrow"></div>


                    </div>

                </div>

                <div class="dashboard-health-id-search-input col-md-12 covid-input">
                    <label for="inputSearchValue" class="form-label-primary label-primary covid-input-label">Value</label>
                    <input type="text" class="form-control covid-input-field" id="inputSearchValue" name="forget-id-value" required>

                </div>

                <div>
                    <button type="submit" class="btn btn-outline-primary dashboard-health-id-search" id="forget-id-submit" name="forget-id-submit">Search</button>
                </div>

                <input type="text" value="<?php echo $_SERVER['REQUEST_URI']; ?>" hidden name="page">

                <script>
                    // if searched for forget id
                    <?php if (isset($data['forget_id_det'])) : ?>

                        const div = document.getElementById("forget-id-canvas");
                        div.classList.add("show"); //show canvas

                    <?php endif; ?>

                    function my_func() {
                        document.getElementById("forget-id-content").hidden = true; //hide content
                    }
                </script>
                <?php if (isset($data['forget_id_det'])) : ?>
                    <div class="covid-patient-detail" id="forget-id-content">

                        <table>
                            <?php foreach ($data['forget_id_det'] as $record) : ?>
                                <tr>
                                    <th class="covid-detail-title">
                                        Health ID
                                    </th>
                                    <th>
                                        :
                                    </th>


                                    <td class="covid-detail-data">
                                        <?php echo $record['health_id'] ?>
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
                                        <?php echo $record['name'] ?>
                                    </td>
                                </tr>

                                <tr>
                                    <th class="covid-detail-title">
                                        Date of Birth
                                    </th>
                                    <th>
                                        :
                                    </th>


                                    <td class="covid-detail-data">
                                        <?php echo $record['dob'] ?>
                                    </td>
                                </tr>

                            <?php endforeach; ?>
                        </table>
                    </div>
                <?php endif; ?>
            </form>
        </div>