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

  // Dark mode toggle functionality
  function toggleDarkMode(btn) {
    document.documentElement.classList.toggle('dark');
    if (!window.feather) return;
    const icon = btn.querySelector('svg');
    if (document.documentElement.classList.contains('dark')) {
      icon.outerHTML = feather.icons['sun'].toSvg();
    } else {
      icon.outerHTML = feather.icons['moon'].toSvg();
    }
  }

  const darkToggle = document.getElementById('darkToggle');
  if (darkToggle) {
    darkToggle.addEventListener('click', function () {
      toggleDarkMode(this);
    });
  }

  const darkToggleMobile = document.getElementById('darkToggleMobile');
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

  // Form submission
  const form = document.querySelector('form');
  if (form) {
    form.addEventListener('submit', function (e) {
      e.preventDefault();

      const button = this.querySelector('button[type="submit"]');
      if (!button) return;
      const originalText = button.innerHTML;

      // Show loading state
      button.innerHTML = 'Sending... <i data-feather="loader" class="inline ml-2 w-4 h-4 animate-spin"></i>';
      button.disabled = true;

      // Simulate form submission (replace with actual submission logic)
      setTimeout(() => {
        button.innerHTML = 'Message Sent! <i data-feather\n          ="check" class="inline ml-2 w-4 h-4"></i>';
        button.className = button.className.replace('from-indigo-600 to-purple-600', 'from-green-600 to-green-700');

        // Reset form
        form.reset();

        // Reset button after 3 seconds
        setTimeout(() => {
          button.innerHTML = originalText;
          button.className = button.className.replace('from-green-600 to-green-700', 'from-indigo-600 to-purple-600');
          button.disabled = false;
          if (window.feather) feather.replace();
        }, 3000);

        if (window.feather) feather.replace();
      }, 2000);
    });
  }
});


