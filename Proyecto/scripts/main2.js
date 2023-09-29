
document.addEventListener('DOMContentLoaded' , () => {
    const elementosCarousel = document.querySelectorAll('.carousel');
    M.Carousel.init(elementosCarousel, {
        duration: 150,
        dist: -40,
        shift: -10,
        padding: 100,
        numVisible: 5,
        indicators: true
    });
});