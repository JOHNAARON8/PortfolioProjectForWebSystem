const slider = document.getElementById("educationSlider");
const dots = document.querySelectorAll("#sliderDots .dot");
const prevBtn = document.getElementById("prevSlide");
const nextBtn = document.getElementById("nextSlide");

let currentIndex = 0;
const totalSlides = slider.children.length;
let autoScroll;

function updateSlider(index) {
  slider.style.transform = `translateX(-${index * 100}%)`;
  dots.forEach((dot, i) => {
    dot.classList.toggle("bg-indigo-500", i === index);
    dot.classList.toggle("bg-gray-400", i !== index);
  });
  currentIndex = index;
}

function nextSlide() {
  let newIndex = (currentIndex + 1) % totalSlides;
  updateSlider(newIndex);
}

function prevSlide() {
  let newIndex = (currentIndex - 1 + totalSlides) % totalSlides;
  updateSlider(newIndex);
}

function startAutoScroll() {
  autoScroll = setInterval(nextSlide, 4000); 
}

function stopAutoScroll() {
  clearInterval(autoScroll);
}


updateSlider(0);
startAutoScroll();

nextBtn.addEventListener("click", () => {
  nextSlide();
  stopAutoScroll();
  startAutoScroll();
});

prevBtn.addEventListener("click", () => {
  prevSlide();
  stopAutoScroll();
  startAutoScroll();
});

dots.forEach((dot, i) => {
  dot.addEventListener("click", () => {
    updateSlider(i);
    stopAutoScroll();
    startAutoScroll();
  });
});