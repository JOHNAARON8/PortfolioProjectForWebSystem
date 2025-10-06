document.addEventListener("DOMContentLoaded", () => {
  const menuBtn = document.getElementById("menuBtn");
  const mobileMenu = document.getElementById("mobileMenu");
  const closeMenu = document.getElementById("closeMenu");
  const desktopNav = document.getElementById("desktopNav"); 

  function checkScreen() {
    if (window.innerWidth <= 1100) {
      if (desktopNav) desktopNav.style.display = "none";
      if (menuBtn) menuBtn.style.display = "block";
    } else {
      if (desktopNav) desktopNav.style.display = "flex";
      if (menuBtn) menuBtn.style.display = "none";
      if (mobileMenu) {
        mobileMenu.classList.remove("translate-x-0");
        mobileMenu.classList.add("-translate-x-full");
      }
    }
  }

  checkScreen();
  window.addEventListener("resize", checkScreen);


  if (menuBtn && mobileMenu) {
    menuBtn.addEventListener("click", () => {
      mobileMenu.classList.remove("-translate-x-full");
      mobileMenu.classList.add("translate-x-0");
    });
  }

  if (closeMenu && mobileMenu) {
    closeMenu.addEventListener("click", () => {
      mobileMenu.classList.remove("translate-x-0");
      mobileMenu.classList.add("-translate-x-full");
    });
  }

  if (mobileMenu) {
    mobileMenu.addEventListener("click", (e) => {
      if (e.target.tagName === "A") {
        mobileMenu.classList.remove("translate-x-0");
        mobileMenu.classList.add("-translate-x-full");
      }
    });
  }

  document.addEventListener("click", (e) => {
    if (
      mobileMenu &&
      !mobileMenu.classList.contains("-translate-x-full") &&
      !mobileMenu.contains(e.target) &&
      !menuBtn.contains(e.target)
    ) {
      mobileMenu.classList.remove("translate-x-0");
      mobileMenu.classList.add("-translate-x-full");
    }
  });

  if (window.feather && typeof feather.replace === "function") {
    feather.replace();
  }
});
