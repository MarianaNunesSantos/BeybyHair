/* Carrosel de banners */
let slideIndex = 1;
let slideInterval;

// Inicia o carrossel automático quando a página carrega
document.addEventListener('DOMContentLoaded', function() {
    showSlides(slideIndex);
    startSlideShow();
});

function plusSlides(n) {
    resetSlideShow();
    showSlides(slideIndex += n);
}

function currentSlide(n) {
    resetSlideShow();
    showSlides(slideIndex = n);
}

function showSlides(n) { 
    let i;
    let slides = document.getElementsByClassName("div-img-carrosel-banner");
    let dots = document.getElementsByClassName("dot");
    
    if (n > slides.length) {slideIndex = 1}
    if (n < 1) {slideIndex = slides.length}
    
    // Esconde todos os slides e remove a classe active
    for (i = 0; i < slides.length; i++) {
        slides[i].classList.remove('active');
        slides[i].style.display = "none";
    }
    
    for (i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" active", "");
    }
    
    // Mostra o slide atual com fade
    slides[slideIndex-1].style.display = "block";
    setTimeout(() => {
        slides[slideIndex-1].classList.add('active');
    }, 10);
    
    dots[slideIndex-1].className += " active";
}

// Inicia o slide automático
function startSlideShow() {
    slideInterval = setInterval(() => {
        plusSlides(1);
    }, 5000); // Muda a cada 5 segundos
}

// Reseta o temporizador quando o usuário interage
function resetSlideShow() {
    clearInterval(slideInterval);
    startSlideShow();
}
