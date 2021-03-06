//for displaying the division for the particular option
var sub_division = document.querySelector('.sub-division');
var side_bar = document.querySelector('.dashboard-sidebar-container');

var toggle_button = document.querySelector('.dashboard-toggle-icon');

var user_credentials = document.querySelector(".dashboard-user-credentials");

//for minimizing the side banner
toggle_button.onclick = function(){
    let class_Name = side_bar.className;
    if(sub_division.className == 'sub-division'){
      sub_division.className = 'sub-division division-maximized';
      
    }else{
      sub_division.className = 'sub-division';
      
    }

    
    if (class_Name.includes("side-minimized")) {
        side_bar.className = "dashboard-sidebar-container";
        user_credentials.className = "dashboard-user-credentials";
    } else {
        side_bar.className = "dashboard-sidebar-container side-minimized";
        user_credentials.className = "dashboard-user-credentials dashboard-user-credentials-shrink";

    }
    
};

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

//email validation in settings info
function validate_password(){
    var old_password = document.querySelector('#old_password').value;
    var new_password = document.querySelector('#new_password').value;
    var confirmed_password = document.querySelector('#confirmed_password').value;
    var passw=  /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{8,15}$/;

    if(old_password==new_password && old_password != ""){
        document.querySelector('#same-password').classList.remove('invisible');
        return false;
    }
    else if(confirmed_password != new_password && new_password != ""){
        document.querySelector('#matching-passwords').classList.remove('invisible');
        return false;
    }else if(!passw.test(new_password)){
        document.querySelector('#wrong-confirmed-password').classList.remove('invisible');
        return false;
    }
    return true;

}