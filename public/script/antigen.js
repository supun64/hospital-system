
    tog_btn = document.getElementById("antigen-togBtn");
    hdn_btn = document.getElementById("hidden-antigen-status");
    document.getElementById("hidden-antigen-status").value = "negative";
    hdn_btn = 
tog_btn.onclick= function(){
    if(tog_btn.checked){
        document.getElementById("hidden-antigen-status").value = "positive";
        
    }else{
        document.getElementById("hidden-antigen-status").value = "negative";
    }
    console.log(document.getElementById("hidden-antigen-status").value);
}


    //add event listeners to each row
document.querySelectorAll('.antigen-rw').forEach(item => {
  item.addEventListener('click', event => {
    children = item.childNodes;
    arr = children[1].innerText.split("\n");
   // console.log(arr);
   //backend purposes -> get values
     document.getElementById('hidden-antigen-id').value = arr[0];
     document.getElementById('hidden-antigen-hid').value = arr[1];
     document.getElementById('hidden-antigen-date').value = arr[2];
     document.getElementById('hidden-antigen-place').value = arr[4];

    //disable button for unauthorized hospitals
    document.getElementById('antigen-togBtn').disabled = false;  //enable continue button
    document.getElementById('antigen-update-btn').disabled = false;  //enable continue button
    if(document.getElementById('cur-hos').value != document.getElementById('hidden-antigen-hid').value){
     document.getElementById('antigen-togBtn').disabled = true;
     document.getElementById('antigen-update-btn').disabled = true;  //enable continue button
    }

    if(arr[3] != "pending"){
        document.getElementById('antigen-togBtn').disabled = true;
        document.getElementById('antigen-update-btn').disabled = true;  //enable continue button
    }

  });
});
