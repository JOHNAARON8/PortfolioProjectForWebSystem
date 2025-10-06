async function loadComponents() {
  const mountPoints = document.querySelectorAll('[data-component]');
  const basePath = new URL('components/', window.location.href).toString();

  const fetches = Array.from(mountPoints).map(async (el) => {
    const name = el.getAttribute('data-component');
    if (!name) return;
    try {
      const res = await fetch(basePath + name + '.html', { cache: 'no-cache' });
      if (!res.ok) throw new Error('HTTP ' + res.status);
      const html = await res.text();
      el.outerHTML = html;
    } catch (err) {
      console.error('Component load failed:', name, err);
      el.outerHTML = `<div class="max-w-6xl mx-auto px-6 py-8 text-red-600 dark:text-red-400">
        Failed to load ${name} component.
      </div>`;
    }
  });

  await Promise.all(fetches);
}

document.addEventListener('DOMContentLoaded', async function () {
  await loadComponents();

  if (window.feather && typeof feather.replace === 'function') {
    feather.replace();
  }


  if (typeof particlesJS === 'function') {
    particlesJS('particles-js', {
      particles: {
        number: { value: 80, density: { enable: true, value_area: 800 } },
        color: { value: '#6366f1' },
        shape: { type: 'circle' },
        opacity: { value: 0.3 },
        size: { value: 3, random: true },
        line_linked: { enable: true, distance: 150, color: '#6366f1', opacity: 0.2, width: 1 },
        move: { enable: true, speed: 2 }
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


});
