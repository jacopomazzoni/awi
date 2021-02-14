function overlayFade() {
    var overlay = document.getElementById("overlay");
    overlay.classList.toggle("m-fadeOut");
}

function everythingFade() {
    var overlay = document.getElementById("overlay");
    overlay.classList.toggle("m-fadeOut");
    overlay.classList.toggle("m-fadeIn");
}