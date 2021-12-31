tog_btn = document.getElementById("togBtn");
hdn_btn = document.getElementById("hidden-status");
document.getElementById("hidden-status").value = "negative";
hdn_btn = tog_btn.onclick = function () {
  if (tog_btn.checked) {
    document.getElementById("hidden-status").value = "positive";
  } else {
    document.getElementById("hidden-status").value = "negative";
  }
  //console.log(document.getElementById("hidden-status").value);
};

//add event listeners to each row
document.querySelectorAll(".pcr-rw").forEach((item) => {
  item.addEventListener("click", (event) => {
    children = item.childNodes;
    arr = children[1].innerText.split("\n");
    //console.log(arr);
    //backend purposes -> get values
    document.getElementById("hidden-id").value = arr[0];
    document.getElementById("hidden-hid").value = arr[1];
    document.getElementById("hidden-date").value = arr[2];
    document.getElementById("hidden-place").value = arr[4];

    //disable button for unauthorized hospitals
    document.getElementById("togBtn").disabled = false; //enable continue button
    document.getElementById("update-btn").disabled = false; //enable continue button
    if (
      document.getElementById("cur-hos").value !=
      document.getElementById("hidden-hid").value
    ) {
      document.getElementById("togBtn").disabled = true;
      document.getElementById("update-btn").disabled = true; //enable continue button
    }

    if (arr[3] != "pending") {
      document.getElementById("togBtn").disabled = true;
      document.getElementById("update-btn").disabled = true; //enable continue button
    }
  });
});
