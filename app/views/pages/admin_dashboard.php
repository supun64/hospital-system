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
                <a href="#" class="option">
                    <span class="dashboard-link-icon"><i class='bx bxs-home' ></i></span>
                    <span class="text">Home</span>
                </a>
            </li>
            <li class="dashboard-list" data-toggle="tooltip" data-placement="right" title="User Management">
                <a href="#" class="option">
                    <span class="dashboard-link-icon"><i class='bx bxs-user-detail' ></i></span>
                    <span class="text">User Management</span>
                </a>
            </li>
            <li class="dashboard-list" data-toggle="tooltip" data-placement="right" title="Data Management">
                <a href="#" class="option">
                    <span class="dashboard-link-icon"><i class='bx bxs-data'  ></i></span>
                    <span class="text">Data Management</span>
                </a>
            </li>
            
            <li class="dashboard-list admin-logout" data-toggle="tooltip" data-placement="right" title="Log Out">
                <a href="#" class="option">
                    <span class="dashboard-link-icon"><i class='bx bx-log-out-circle bx-flip-horizontal'  ></i></span>
                    <span class="text">Log Out</span>
                </a>
            </li>
            <li class="dashboard-list" data-toggle="tooltip" data-placement="right" title="Settings">
                <a href="#" class="option">
                    <span class="dashboard-link-icon"><i class='bx bx-cog'></i></span>
                    <!--<span class="text">Settings</span>-->
                </a>
            </li>
            
        </ul>
    </div>
    <div class="sub-division">

    </div>
</div>
<script>
    //for highlighting the selected bar
    var side_bar_options = document.querySelectorAll('.option');
    var link_icons = document.querySelectorAll('.dashboard-link-icon-img');
    for (let i = 0; i < side_bar_options.length; i++) {
        side_bar_options[i].onclick = function(){
            for (let j = 0; j < side_bar_options.length; j++) {
                side_bar_options[j].className = "option";
            }
            for (let j = 0; j < link_icons.length; j++) {
                link_icons[j].className = "dashboard-link-icon-img";
            }
            side_bar_options[i].className= "option active";
            link_icons[i - 1].className = "dashboard-link-icon-img dashboard-img-active";
        }

    }

    //for minimizing the side banner
    var side_bar = document.querySelector('.dashboard-sidebar-container');
    var division_bar = document.querySelector('.sub-division');
    var toggle_button = document.querySelector('.dashboard-toggle-icon');

    toggle_button.onclick = function(){
        let class_Name = side_bar.className;
        if (class_Name.includes("minimized")) {
            side_bar.className = "dashboard-sidebar-container admin";
            division_bar.className = "sub-division";
        } else {
            side_bar.className = "dashboard-sidebar-container admin side-minimized";
            division_bar.className = "sub-division division-maximized";
        }
    }


</script>
<?php require_once APP_ROOT."/views/includes/footer.php"?>
