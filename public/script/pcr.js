// Dropdown menu ------------------------------------------------------

// This is the code need to create custom dropdown
const selected = document.querySelectorAll(".selected");
const selectedText = document.querySelectorAll(".selected-text");
const optionsContainer = document.querySelectorAll(".options-container");
const searchBox = document.querySelectorAll(".search-box input");

const optionsList = document.querySelectorAll(".option");

// Functions
function dropDownWithSearch(dropDownNum) {
  // This is the code to toggle the drop down for every selected
  selected[dropDownNum].addEventListener("click", function () {
    optionsContainer[dropDownNum].classList.toggle("active");

    searchBox[dropDownNum].value = "";
    filterList("");

    if (optionsContainer[dropDownNum].classList.contains("active")) {
      searchBox[dropDownNum].focus();
    }
  });

  // This is the code to get the selected value from the dropdown list
  optionsList.forEach((o) => {
    o.addEventListener("click", () => {
      selectedText[dropDownNum].value = o.querySelector("label").innerHTML;
      optionsContainer[dropDownNum].classList.remove("active");
    });
  });

  // This is the code to get the selected value from the dropdown list
  searchBox[dropDownNum].addEventListener("keyup", function (e) {
    filterList(e.target.value);
  });

  const filterList = (searchTerm) => {
    searchTerm = searchTerm.toLowerCase();
    optionsList.forEach((option) => {
      let label =
        option.firstElementChild.nextElementSibling.innerText.toLowerCase();
      if (label.indexOf(searchTerm) != -1) {
        option.style.display = "block";
      } else {
        option.style.display = "none";
      }
    });
  };
}

// Main loop for drop down
for (let i = 0; i < selected.length; i++) {
  dropDownWithSearch(i);
}