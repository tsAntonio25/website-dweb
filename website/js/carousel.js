function nextSlide(type) {
    let container = document.getElementById(type);
    let cardWidth = container.querySelector(".car-card").offsetWidth + 50;
    container.scrollLeft += cardWidth;
}

function prevSlide(type) {
    let container = document.getElementById(type);
    let cardWidth = container.querySelector(".car-card").offsetWidth + 50;
    container.scrollLeft -= cardWidth;
}
