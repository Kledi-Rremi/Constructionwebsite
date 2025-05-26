/*=============== SHOW MENU ===============*/
const navMenu = document.getElementById('nav-menu'),
      navToggle = document.getElementById('nav-toggle'),
      navClose = document.getElementById('nav-close')

/*===== MENU SHOW =====*/
// Validate if constant exists                                          
if(navToggle){
    navToggle.addEventListener('click', () => {
        navMenu.classList.add('show-menu')
    })
}

/*===== MENU HIDDEN =====*/
// Validate if constant exists
if(navClose){
    navClose.addEventListener('click', () => {
        navMenu.classList.remove('show-menu')
    })
}

/*=============== REMOVE MENU MOBILE ===============*/
const navLink = document.querySelectorAll('.nav__link')

const linkAction = () => {
    const navMenu = document.getElementById('nav-menu')
    // When we click on each nav__link, we remove the show-menu class
    navMenu.classList.remove('show-menu')
}

navLink.forEach(n => n.addEventListener('click', linkAction))

/*=============== CHANGE BACKGROUND HEADER ===============*/
const bgHeader = () => {
    const header = document.getElementById('header')
    // When the scroll is greater than 50 viewport height, add the bg-header class to the header tag
    if(window.scrollY >= 50) header.classList.add('bg-header')
    else header.classList.remove('bg-header')
}
window.addEventListener('scroll', bgHeader)
bgHeader()
// ...existing code...

/*=============== SCROLL REVEAL ANIMATION ===============*/

/*=============== TESTIMONIALS SLIDER ===============*/
const cards = document.querySelectorAll('.testimonial-card');
const prevBtn = document.getElementById('testimonial-prev');
const nextBtn = document.getElementById('testimonial-next');
const arrows = document.querySelector('.testimonials__arrows');
let current = 0;

function showCard(index) {
  cards.forEach((card, i) => {
    card.classList.toggle('active', i === index);
  });
}

// Show only one card at start
showCard(current);

// Show/hide arrows on resize
function updateArrows() {
  if (arrows) {
    if (window.innerWidth <= 700) {
      arrows.style.display = 'flex';
    } else {
      arrows.style.display = 'none';
    }
  }
}
updateArrows();
window.addEventListener('resize', updateArrows);

// Arrow click events
if (prevBtn && nextBtn && cards.length > 0) {
  prevBtn.addEventListener('click', () => {
    current = (current - 1 + cards.length) % cards.length;
    showCard(current);
  });

  nextBtn.addEventListener('click', () => {
    current = (current + 1) % cards.length;
    showCard(current);
  });
}


/*=============== SWIPER SERVICES ===============*/
const swiper = new Swiper('.services__swiper', {
  direction: 'horizontal', // Use horizontal for typical service sliders
  loop: true,
  grabCursor: true,
  spaceBetween: 24,
  slidesPerView: 'auto',
  


  // Navigation arrows
  navigation: { 
    nextEl: '.swiper-button-next',
    prevEl: '.swiper-button-prev',
  },


});

/*=============== SWIPER PROJECTS ===============*/
const projectsSwiper = new Swiper('.projects__swiper', {
  slidesPerView: 1, // mobile default
  spaceBetween: 10,
  loop: true, // always loop!
  autoplay: {
    delay: 2200,
    disableOnInteraction: false,
    pauseOnMouseEnter: true,
  },
  breakpoints: {
    900: {
      slidesPerView: 4,
      spaceBetween: 20,
    }
  }
});
/*=============== SHOW SCROLL UP ===============*/ 
const scrollUp = () => {
    const scrollUp = document.getElementById('scroll-up');
    if (!scrollUp) return;
    // Use window.scrollY instead of this.scrollY
    window.scrollY >= 350
      ? scrollUp.classList.add('show-scroll')
      : scrollUp.classList.remove('show-scroll');
}

window.addEventListener('scroll', scrollUp);
scrollUp();



/*=============== SCROLL REVEAL ANIMATION ===============*/
const sr = ScrollReveal({
    origin: 'top',
    distance: '100px',
    duration: 2500,
    delay: 400,
    //reset: true // Animation repeat
});
sr.reveal(
  `.about__video-wrapper, .services__swiper, .services__data, .about__data,  .contact__form, .contact__image`,
  { origin: 'top', delay: 0 }
);
