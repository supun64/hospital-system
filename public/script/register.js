//function to make changed by clicking verify button
function trigger() {

    document.getElementById('complete-btn').disabled = false;  //enable continue button
    let x = Math.floor((Math.random() * 100000) + 1);    // random number for verification code
    document.getElementById("ran-id1").value = x;
    document.getElementById("ran-id2").value = x;
    document.getElementById('verify-btn').innerText = 'Resend code';  //change inner text of the button  

    }


    //scrypt to validate password matching in new registration forum 
    function Validate() {
        var code = document.getElementById("admin-password").value;
        var act_code = document.getElementById("admin-confirm-password").value;
        var output = true;
        if (code != act_code) {
            const msg = document.querySelector('.pwd-error-msg')
            msg.classList.remove('invisible')
            event.stopPropagation()
            return false;
        }
        return true;
    }