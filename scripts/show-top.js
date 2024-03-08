topId = document.getElementById("show-top");

function showTop() {
    var y = window.scrollY;
    if (y > 300) {
        topId.className = "top show";
    } else {
        topId.className = "top hide";
    }
}

window.addEventListener("scroll", showTop);