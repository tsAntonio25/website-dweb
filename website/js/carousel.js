function nextSlide(type) {
    let container = document.getElementById(type);
    container.scrollLeft += 250;
}

function prevSlide(type) {
    let container = document.getElementById(type);
    container.scrollLeft -= 250;
}
