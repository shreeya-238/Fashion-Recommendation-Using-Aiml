import { setupCounter } from "./counter.js";



document.addEventListener("DOMContentLoaded", function () {
    AOS.init({
        duration: 1000,  // Animation duration (in ms)
        once: true,      // Animation runs only once
        offset: 100      // Offset before triggering animation
    });
});
window.onload = function () {
    AOS.refresh();
};
console.log(AOS);


// Navbar scroll effect
window.addEventListener('scroll', () => {
    const navbar = document.querySelector('.navbar')
    if (window.scrollY > 50) {
      navbar.style.padding = '0.5rem 2rem'
      navbar.style.backgroundColor = 'rgba(139, 115, 85, 0.95) !important'
    } else {
      navbar.style.padding = '1rem 2rem'
      navbar.style.backgroundColor = 'var(--primary-color) !important'
    }
  })

  // Smooth scroll for navigation links
  document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
      e.preventDefault();
      
      const href = this.getAttribute('href');
      if (href === "#" || href === "" || href == null) return; // Prevent invalid selectors
  
      const target = document.querySelector(href);
      if (target) {
        window.scrollTo({
          top: target.offsetTop - 80,
          behavior: 'smooth'
        });
      }
    });
  });
  

const swiper = new Swiper('.fashion-swiper', {
  effect: 'fade', // Enables fade transition
  fadeEffect: {
      crossFade: true
  },
  loop: true,
  autoplay: {
      delay: 3000,
      disableOnInteraction: false
  },
 
});


