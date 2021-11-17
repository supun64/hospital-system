
    //live search bar
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




//scrypt to validate password matching in new deo forum 
    function Validate() {
        var password = document.getElementById("pwd").value;
        var confirmPassword = document.getElementById("cpwd").value;
        if (password != confirmPassword) {
            const msg = document.querySelector('.pwd-error-msg')
            msg.classList.remove('invisible')
            return false;
        }
        return true;
    }




//scrypt to validate filled/empty add new deo forum fields
        (function () {
    'use strict'
    const forms = document.querySelectorAll('.requires-validation')
    Array.from(forms)
    .forEach(function (form) {
        form.addEventListener('submit', function (event) {   
        if (!form.checkValidity()) {
            event.preventDefault()
            event.stopPropagation()
        }

        form.classList.add('was-validated')

        }, false)
    })
    })()
