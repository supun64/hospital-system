function formatDate() {
  var d = new Date(),
    month = "" + (d.getMonth() + 1),
    day = "" + d.getDate(),
    year = d.getFullYear();

  if (month.length < 2) month = "0" + month;
  if (day.length < 2) day = "0" + day;

  //console.log([year, month, day].join("-"));
  return [year, month, day].join("-");
}

function checkButton() {
  if (document.getElementById("discharged").checked) {
    document.getElementById("hidden-status").value = "Discharged";
    console.log(document.getElementById("hidden-status").value);
    document.getElementById("hidden-discharge-date").value = formatDate();
    console.log(document.getElementById("hidden-discharge-date").value);
  } else if (document.getElementById("died").checked) {
    document.getElementById("hidden-status").value = "Died";
    document.getElementById("hidden-discharge-date").value = formatDate();
  } else {
    document.getElementById("error").innerHTML =
      "You have not selected any option";
  }
}

// //add event listeners to each row
// document.querySelectorAll(".patient-rw").forEach((item) => {
//   item.addEventListener("click", (event) => {
//     children = item.childNodes;
//     arr = children[1].innerText.split("\n");
//     console.log(arr);
//     //backend purposes -> get values
//     document.getElementById("hidden-admission-id").value = arr[0];
//     document.getElementById("hidden-hospital-name").value = arr[1];
//     document.getElementById("hidden-admission-date").value = arr[2];
//     document.getElementById("hidden-conditions").value = arr[5];

//     //disable button for unauthorized hospitals
//     document.getElementsByName("default-radio").disabled = false; //enable continue button
//     document.getElementById("update").disabled = false; //enable continue button
//     if (
//       document.getElementById("cur-hos").value !=
//       document.getElementById("hidden-hospital-id").value
//     ) {
//       document.getElementsByName("default-radio").disabled = true;
//       document.getElementById("update").disabled = true; //enable continue button
//     }

//     if (arr[4] != "admitted") {
//       document.getElementsByName("default-radio").disabled = true;
//       document.getElementById("update").disabled = true; //enable continue button
//     }
//   });
// });
