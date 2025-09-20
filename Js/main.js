async function loadComponents() {
  const mountPoints = document.querySelectorAll('[data-component]');
  const basePath = new URL('components/', window.location.href).toString();
  const fetches = Array.from(mountPoints).map(async (el) => {
    const name = el.getAttribute('data-component');
    if (!name) return;
    try {
      // Optional loading skeleton for sections
      
      const res = await fetch(basePath + name + '.html', { cache: 'no-cache' });
      if (!res.ok) throw new Error('HTTP '+res.status);
      const html = await res.text();
      el.outerHTML = html;
    } catch (err) {
      console.error('Component load failed:', name, err);
      el.outerHTML = '<div class="max-w-6xl mx-auto px-6 py-8 text-red-600 dark:text-red-400">Failed to load '+name+' component.</div>';
    }
  });
  await Promise.all(fetches);
}

document.addEventListener('DOMContentLoaded', async function () {
  await loadComponents();
  
  // Initialize feather icons
  if (window.feather && typeof feather.replace === 'function') {
    feather.replace();
  }
  // =========================
  //  Education Circular Carousel
  // =========================
  const orbitContainer = document.getElementById('orbitContainer');
  if (orbitContainer) {
    const slides = Array.from(orbitContainer.querySelectorAll('.slide'));
    const radius = 120; // distance from center
    const centerX = orbitContainer.offsetWidth / 2;
    const centerY = orbitContainer.offsetHeight / 2;
    const total = slides.length;

    // Place slides in circle initially
    slides.forEach((slide, i) => {
      const angle = (i / total) * 2 * Math.PI;
      slide.dataset.angle = angle;
      const x = centerX + radius * Math.cos(angle) - slide.offsetWidth / 2;
      const y = centerY + radius * Math.sin(angle) - slide.offsetHeight / 2;
      slide.style.transform = `translate(${x}px, ${y}px)`;
    });

    // Rotate orbit continuously
    function rotateOrbit() {
      slides.forEach((slide) => {
        let angle = parseFloat(slide.dataset.angle);
        angle += 0.01; // rotation speed
        slide.dataset.angle = angle;
        const x = centerX + radius * Math.cos(angle) - slide.offsetWidth / 2;
        const y = centerY + radius * Math.sin(angle) - slide.offsetHeight / 2;
        slide.style.transform = `translate(${x}px, ${y}px)`;
      });
      requestAnimationFrame(rotateOrbit);
    }

    rotateOrbit();
  }


  // Mobile menu functionality
  const menuBtn = document.getElementById('menuBtn');
  const mobileMenu = document.getElementById('mobileMenu');
  const closeMenu = document.getElementById('closeMenu');

  if (menuBtn && mobileMenu) {
    menuBtn.addEventListener('click', () => {
      mobileMenu.classList.remove('-translate-x-full');
    });
  }

  // Modal logic
  function openModalByKey(key) {
    const modal = document.querySelector(`[data-modal="${key}"]`);
    if (!modal) return;
    modal.classList.remove('hidden');
    document.body.classList.add('overflow-hidden');
    if (window.feather) feather.replace();
  }
  function closeModal(el) {
    el.classList.add('hidden');
    document.body.classList.remove('overflow-hidden');
  }
  document.addEventListener('click', (e) => {
    const btn = e.target.closest('[data-open-modal]');
    if (btn) {
      const key = btn.getAttribute('data-open-modal');
      openModalByKey(key);
    }
    const closeBtn = e.target.closest('[data-close]');
    if (closeBtn) {
      const modal = closeBtn.closest('[data-modal]');
      if (modal) closeModal(modal);
    }
    if (e.target.classList.contains('bg-black/50') && e.target.parentElement?.hasAttribute('data-modal')) {
      closeModal(e.target.parentElement);
    }
  });
  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') {
      document.querySelectorAll('[data-modal]').forEach((m) => m.classList.add('hidden'));
      document.body.classList.remove('overflow-hidden');
    }
  });

  if (closeMenu && mobileMenu) {
    closeMenu.addEventListener('click', () => {
      mobileMenu.classList.add('-translate-x-full');
    });
  }

  // Close mobile menu when clicking on links
  if (mobileMenu) {
    mobileMenu.addEventListener('click', (e) => {
      if (e.target.tagName === 'A') {
        mobileMenu.classList.add('-translate-x-full');
      }
    });
  }

 // ===========================
// Dark mode toggle with localStorage
// ===========================
function applyDarkMode(isDark) {
  if (isDark) {
    document.documentElement.classList.add('dark');
  } else {
    document.documentElement.classList.remove('dark');
  }

  // Update icons
  [darkToggle, darkToggleMobile].forEach(btn => {
    if (!btn || !window.feather) return;
    const icon = btn.querySelector('svg');
    if (!icon) return;
    icon.outerHTML = isDark ? feather.icons['sun'].toSvg() : feather.icons['moon'].toSvg();
  });
}

function toggleDarkMode(btn) {
  const isDark = !document.documentElement.classList.contains('dark');
  applyDarkMode(isDark);
  localStorage.setItem('darkMode', isDark ? 'true' : 'false');
}

// Get elements
const darkToggle = document.getElementById('darkToggle');
const darkToggleMobile = document.getElementById('darkToggleMobile');

// Load saved mode on page load
const savedMode = localStorage.getItem('darkMode');
applyDarkMode(savedMode === 'true');

// Attach event listeners
if (darkToggle) {
  darkToggle.addEventListener('click', function () {
    toggleDarkMode(this);
  });
}
if (darkToggleMobile) {
  darkToggleMobile.addEventListener('click', function () {
    toggleDarkMode(this);
  });
}


  // GSAP animations
  if (window.gsap) {
    if (typeof ScrollTrigger !== 'undefined') {
      gsap.registerPlugin(ScrollTrigger);
    }

    // Hero section animations
    gsap.from('h2', {
      y: 50,
      opacity: 0,
      duration: 1.2,
      ease: 'power3.out',
    });

    gsap.from('#typing', {
      opacity: 0,
      duration: 1,
      delay: 0.5,
    });

    gsap.from('section div p', {
      y: 30,
      opacity: 0,
      duration: 1,
      delay: 0.8,
      stagger: 0.2,
    });

    // Scroll animations
    gsap.utils.toArray('section').forEach((section) => {
      const targets = section.querySelectorAll('h3, .grid > div');
      if (!targets || targets.length === 0) return;
      gsap.from(targets, {
        scrollTrigger: {
          trigger: section,
          start: 'top 80%',
          end: 'bottom 20%',
          toggleActions: 'play none none reverse',
        },
        y: 50,
        opacity: 0,
        duration: 0.8,
        stagger: 0.1,
        ease: 'power2.out',
      });
    });
  }

  // Footer year
  const yearEl = document.getElementById('year');
  if (yearEl) {
    yearEl.textContent = new Date().getFullYear();
  }

  // Particles.js configuration
  if (typeof particlesJS === 'function') {
    particlesJS('particles-js', {
      particles: {
        number: {
          value: 80,
          density: { enable: true, value_area: 800 },
        },
        color: { value: '#6366f1' },
        shape: { type: 'circle', stroke: { width: 0, color: '#000000' } },
        opacity: { value: 0.3, random: false, anim: { enable: false } },
        size: { value: 3, random: true, anim: { enable: false } },
        line_linked: { enable: true, distance: 150, color: '#6366f1', opacity: 0.2, width: 1 },
        move: {
          enable: true,
          speed: 2,
          direction: 'none',
          random: false,
          straight: false,
          out_mode: 'out',
          bounce: false,
          attract: { enable: false },
        },
      },
      interactivity: {
        detect_on: 'canvas',
        events: {
          onhover: { enable: true, mode: 'grab' },
          onclick: { enable: true, mode: 'push' },
          resize: true,
        },
        modes: {
          grab: { distance: 140, line_linked: { opacity: 0.5 } },
          push: { particles_nb: 4 },
        },
      },
      retina_detect: true,
    });
  }

  // Typed.js effect
  if (window.Typed) {
    new Typed('#typing', {
      strings: ['Full-Stack Developer', 'Network Enthusiast', 'Creative Coder', 'AI Enthusiast', 'Problem Solver'],
      typeSpeed: 100,
      backSpeed: 60,
      backDelay: 2000,
      startDelay: 500,
      loop: true,
      showCursor: true,
      cursorChar: '|',
    });
  }

  // Smooth scrolling for anchor links
  document.querySelectorAll("a[href^='#']").forEach((anchor) => {
    anchor.addEventListener('click', function (e) {
      const href = this.getAttribute('href');
      if (!href) return;
      e.preventDefault();
      const target = document.querySelector(href);
      if (target) {
        target.scrollIntoView({ behavior: 'smooth', block: 'start' });
      }
    });
  });

});





