// Détection du scroll pour masquer la navbar et afficher les nav-links en carte flottante
let lastScrollTop = 0;
const navLinksFloating = document.querySelector('.nav-links-floating');
const navbar = document.querySelector('header nav');
const scrollThreshold = 100; // Afficher après 100px de scroll

window.addEventListener('scroll', function() {
  const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
  
  // Fonctionne uniquement sur tablette et desktop (>= 768px)
  if (window.innerWidth >= 768) {
    if (scrollTop > scrollThreshold) {
      // Masquer la navbar
      navbar.classList.add('navbar-scrolled');
      // Afficher les nav-links en carte flottante
      navLinksFloating.classList.add('scrolled');
    } else {
      // Afficher la navbar normale
      navbar.classList.remove('navbar-scrolled');
      // Retirer le style de carte flottante
      navLinksFloating.classList.remove('scrolled');
    }
  } else {
    // Sur mobile, garder l'état normal
    navbar.classList.remove('navbar-scrolled');
    navLinksFloating.classList.remove('scrolled');
  }
  
  lastScrollTop = scrollTop;
});

// Gérer le redimensionnement de la fenêtre
window.addEventListener('resize', function() {
  if (window.innerWidth < 768) {
    navbar.classList.remove('navbar-scrolled');
    navLinksFloating.classList.remove('scrolled');
  }
});


function initScrollReveal() {
  const prefersReduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  if (prefersReduced) return;

  const observer = new IntersectionObserver(
    (entries, obs) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.classList.add('is-visible');
          obs.unobserve(entry.target);
        }
      });
    },
    { root: null, rootMargin: '0px', threshold: 0.15 }
  );

  document.querySelectorAll('.reveal').forEach(el => observer.observe(el));
}

window.addEventListener('DOMContentLoaded', initScrollReveal);