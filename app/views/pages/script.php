<script>
    //for displaying the division for the particular option
    var sub_division = document.querySelector('.sub-division');
    var side_bar = document.querySelector('.dashboard-sidebar-container');
    var toggle_button = document.querySelector('.dashboard-toggle-icon');
    //var data_table= document.querySelector('#data-table');
    var data_table_rows= document.querySelectorAll('.data-table-row');
    var data_edit_buttons = document.querySelectorAll('.data-edit-button');

    //for minimizing the side banner
    toggle_button.onclick = function(){
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
</script>

