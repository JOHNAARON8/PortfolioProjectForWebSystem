document.addEventListener("DOMContentLoaded", () => {
    const el = document.getElementById("typing");
    if (!el) return;
  
    let titles;
    try {
      titles = JSON.parse(el.getAttribute("data-titles")) || [];
    } catch (e) {
      titles = [];
    }
    if (!Array.isArray(titles) || titles.length === 0) {
      titles = ["IT Student", "Web Developer"];
    }
  
    const TYPE_SPEED = 100;    
    const DELETE_SPEED = 50;   
    const PAUSE_AFTER = 1500;  
  
    let titleIndex = 0;
    let charIndex = 0;
    let isDeleting = false;
  
    function tick() {
      const current = titles[titleIndex];
      if (isDeleting) {
        charIndex = Math.max(0, charIndex - 1);
      } else {
        charIndex = Math.min(current.length, charIndex + 1);
      }
  
      el.textContent = current.substring(0, charIndex);
  
      let timeout = isDeleting ? DELETE_SPEED : TYPE_SPEED;
  
      if (!isDeleting && charIndex === current.length) {
        isDeleting = true;
        timeout = PAUSE_AFTER;
      } else if (isDeleting && charIndex === 0) {
        isDeleting = false;
        titleIndex = (titleIndex + 1) % titles.length;
        timeout = 400;
      }
  
      setTimeout(tick, timeout);
    }
  
    tick();
  });
  