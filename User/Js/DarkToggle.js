function applyDarkMode(isDark) {
  if (isDark) {
      document.documentElement.classList.add("dark");
  } else {
      document.documentElement.classList.remove("dark");
  }

  [window.darkToggle, window.darkToggleMobile].forEach((btn) => {
      if (!btn || !window.feather) return;
      const icon = btn.querySelector("svg");
      if (!icon) return;
      icon.outerHTML = isDark
          ? feather.icons["sun"].toSvg()
          : feather.icons["moon"].toSvg();
  });

  const heroImg = document.getElementById("heroImage");
  if (heroImg) {
      if (isDark) {
          heroImg.src = heroImg.dataset.darkImg;
      } else {
          heroImg.src = heroImg.dataset.lightImg;
      }
  }
}

function toggleDarkMode() {
  const isDark = !document.documentElement.classList.contains("dark");
  applyDarkMode(isDark);
  localStorage.setItem("darkMode", isDark ? "true" : "false");
}

document.addEventListener("DOMContentLoaded", () => {
  window.darkToggle = document.getElementById("darkToggle");
  window.darkToggleMobile = document.getElementById("darkToggleMobile");

  const savedMode = localStorage.getItem("darkMode");
  applyDarkMode(savedMode === "true");

  if (darkToggle) darkToggle.addEventListener("click", toggleDarkMode);
  if (darkToggleMobile) darkToggleMobile.addEventListener("click", toggleDarkMode);

  if (window.feather && typeof feather.replace === "function") {
      feather.replace();
  }
});
