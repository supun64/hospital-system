<script>
    //for displaying the division for the particular option
    var sub_division = document.querySelector('.sub-division');
    var side_bar = document.querySelector('.dashboard-sidebar-container');
    var toggle_button = document.querySelector('.dashboard-toggle-icon');

    //for minimizing the side banner
    toggle_button.onclick = function(){
        console.log("clicked");
        let class_Name = side_bar.className;
        if(sub_division.className == 'sub-division'){
          sub_division.className = 'sub-division division-maximized';
        }else{
          sub_division.className = 'sub-division';
        }

        
        if (class_Name.includes("side-minimized")) {
            side_bar.className = "dashboard-sidebar-container admin";
        } else {
            side_bar.className = "dashboard-sidebar-container admin side-minimized";
        }
        
    };


</script>

