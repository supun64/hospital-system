<?php require_once APP_ROOT."/views/includes/header.php"?>
<div class="container">
    <div class="sidebar-container">
      <div class="dashboard-banner">
          <span class="toggle-icon"><i class='bx bx-menu'></i></span>
          <span class="dashboard-text">Dashboard</span>
      </div>
        <ul class="side-bar">
            <li class="list">
                <div class="icon"><i class='bx bx-user-circle' style='color:#fff6f6'  ></i></div>
                <div class="user-credentials">
                    <div class="hospital-name">HOSPITAL NAME</div>
                    <div class="user-name">USER NAME</div>
                </div>
            </li>
            <li class="list">
                <a href="#" class="option">
                    <span class="link-icon"><i class='bx bxs-home' ></i></span>
                    <span class="text">Home</span>
                </a>
            </li>
            <li class="list">
                <a href="#" class="option">
                    <span class="link-icon"><img class="link-icon-img" src="<?= URL_ROOT?>/public/images/vaccine_white.png" alt="" srcset=""></span>
                    <span class="text">Vaccination</span>
                </a>
            </li>
            <li class="list">
                <a href="#" class="option">
                    <span class="link-icon"><img class="link-icon-img" src="<?= URL_ROOT?>/public/images/swab_white.png" alt="" srcset=""></span>
                    <span class="text">PCR Test</span>
                </a>
            </li>
            <li class="list">
                <a href="#" class="option">
                    <span class="link-icon"><img class="link-icon-img" src="<?= URL_ROOT?>/public/images/blood_white.png" alt="" srcset=""></span>
                    <span class="text">Antigen Test</span>
                </a>
            </li>
            <li class="list">
                <a href="#" class="option">
                    <span class="link-icon"><img class="link-icon-img" src="<?= URL_ROOT?>/public/images/facial-mask_white.png" alt="" srcset=""></span>
                    <span class="text">COVID Patient</span>
                </a>
            </li>
            <li class="list">
                <a href="#" class="option">
                    <span class="link-icon"><img class="link-icon-img" src="<?= URL_ROOT?>/public/images/death_white.png" alt="" srcset=""></span>
                    <span class="text">COVID Death</span>
                </a>
            </li>
            <li class="list">
                <a href="#" class="option">
                    <span class="link-icon"><i class='bx bx-cog'></i></span>
                    <span class="text">Settings</span>
                </a>
            </li>
            <li class="list">
                <a href="#" class="option">
                    <span class="link-icon"><i class='bx bx-log-out-circle bx-flip-horizontal'  ></i></span>
                    <span class="text">Log Out</span>
                </a>
            </li>
        </ul>
    </div>

</div>
<script>
    //for highlighting the selected bar
    var side_bar_options = document.querySelectorAll('.option');
    var link_icons = document.querySelectorAll('.link-icon-img');
    for (let i = 0; i < side_bar_options.length; i++) {
        side_bar_options[i].onclick = function(){
            for (let j = 0; j < side_bar_options.length; j++) {
                side_bar_options[j].className = "option";
            }
            for (let j = 0; j < link_icons.length; j++) {
                link_icons[j].className = "link-icon-img";
            }
            side_bar_options[i].className= "option active";
            link_icons[i - 1].className = "link-icon-img img-active";
        }

    }

    //for minimizing the side banner
    var side_bar = document.querySelector('.side-bar');
    var toggle_button = document.querySelector('.toggle-icon');

    toggle_button.onclick = function(){
    let class_Name = side_bar.className;
    if (class_Name.includes("minimized")) {
        side_bar.className = "side-bar";
    } else {
        side_bar.className = "side-bar minimized";
    }
    }


</script>
<?php require_once APP_ROOT."/views/includes/footer.php"?>
