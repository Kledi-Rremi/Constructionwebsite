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
    navMenu.classList.remove('show-menu')
}

navLink.forEach(n => n.addEventListener('click', linkAction))

/*=============== CHANGE BACKGROUND HEADER ===============*/
const bgHeader = () => {
    const header = document.getElementById('header')
    if(window.scrollY >= 50) header.classList.add('bg-header')
    else header.classList.remove('bg-header')
}
window.addEventListener('scroll', bgHeader)
bgHeader()

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

showCard(current);

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
  direction: 'horizontal',
  loop: true,
  grabCursor: true,
  spaceBetween: 24,
  slidesPerView: 'auto',
  navigation: { 
    nextEl: '.swiper-button-next',
    prevEl: '.swiper-button-prev',
  },
});

/*=============== SWIPER PROJECTS ===============*/
const projectsSwiper = new Swiper('.projects__swiper', {
  slidesPerView: 1,
  spaceBetween: 20,
  loop: true,
  autoplay: {
    delay: 2200,
    disableOnInteraction: false,
    pauseOnMouseEnter: true,
  },
  breakpoints: {
    768: {
      slidesPerView: 2,
      spaceBetween: 20,
    },
    1024: {
      slidesPerView: 3,
      spaceBetween: 20,
    },
    1280: {
      slidesPerView: 4,
      spaceBetween: 24,
    },
    1440: {
      slidesPerView: 4,      
      spaceBetween: 24,
    }
  }
});

/*=============== SCROLL UP ===============*/ 
const scrollUp = () => {
    const scrollUp = document.getElementById('scroll-up');
    if (!scrollUp) return;

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
});
sr.reveal(
  `.about__video-wrapper, .services__swiper, .services__data, .about__data,  .contact__form, .contact__image`,
  { origin: 'top', delay: 0 }
);
