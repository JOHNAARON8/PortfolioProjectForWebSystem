document.addEventListener("DOMContentLoaded", () => {
    const progressBars = document.querySelectorAll("[data-progress]");
  
    const observer = new IntersectionObserver(
      (entries) => {
        entries.forEach((entry) => {
          if (entry.isIntersecting) {
            const bar = entry.target;
            const finalWidth = bar.getAttribute("data-progress");
            bar.style.width = finalWidth;
            observer.unobserve(bar); 
          }
        });
      },
      { threshold: 0.3 } 
    );
  
    progressBars.forEach((bar) => {
      observer.observe(bar);
    });
  });
  