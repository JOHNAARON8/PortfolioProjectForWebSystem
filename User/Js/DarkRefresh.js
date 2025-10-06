
  (function() {
    try {
      const darkMode = localStorage.getItem('darkMode');
      if (darkMode === 'true') {
        document.documentElement.classList.add('dark');
      } else if (darkMode === 'false') {
        document.documentElement.classList.remove('dark');
      }
    } catch (e) {
      console.error('Failed to apply dark mode', e);
    }
  })();

