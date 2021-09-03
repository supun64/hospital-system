//for highlighting the selected bar
let side_bar_options = document.querySelectorAll('.option');
let link_icons = document.querySelectorAll('.link-icon-img');
for (let i = 0; i < side_bar_options.length; i++) {
    side_bar_options[i].onclick = function(){
        for (let j = 0; j < side_bar_options.length; j++) {
             side_bar_options[j].className = "option";
        }
        for (let j = 0; j < link_icons.length; j++) {
             link_icons[j].className = "link-icon-img";
        }
        side_bar_options[i].className= "option active";
        link_icons[i - 1].className = "link-icon-img img-active";
    }

}

//for minimizing the side banner
let side_bar = document.querySelector('.side-bar');
let toggle_button = document.querySelector('.toggle-icon');

toggle_button.onclick = function(){
  let class_Name = side_bar.className;
  if (class_Name.includes("minimized")) {
    side_bar.className = "side-bar";
  } else {
    side_bar.className = "side-bar minimized";
  }
}
