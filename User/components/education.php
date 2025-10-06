<?php include "./Backends/EducationSection.php" ?>

<section id="education" class="py-20 ">
  <div class="max-w-5xl mx-auto px-6">
    <h3 class="text-2xl sm:text-3xl font-bold mb-14 bg-gradient-to-r from-pink-500 via-purple-500 to-indigo-500 bg-clip-text text-transparent text-center tracking-tight">
      Education
    </h3>

    <div class="relative w-full max-w-3xl mx-auto overflow-hidden rounded-3xl shadow-2xl bg-white/70 dark:bg-gray-900/70 backdrop-blur-lg border border-gray-200 dark:border-gray-700">

      <div id="educationSlider" class="flex transition-transform duration-700 ease-in-out">
        <?php foreach ($education as $edu): ?>
          <div class="flex-shrink-0 w-full flex flex-col items-center p-8 text-center space-y-4">
            <div class="relative">
              <div class="absolute inset-0 rounded-full bg-gradient-to-tr from-pink-500 via-purple-500 to-indigo-500 animate-pulse blur-md opacity-30"></div>
              <img src="<?= htmlspecialchars($edu['image_path']) ?>" 
                   class="relative w-36 h-36 rounded-full border-4 border-white dark:border-gray-800 shadow-2xl object-cover" />
            </div>

            <h3 class="text-2xl font-semibold text-gray-800 dark:text-gray-100">
              <?= htmlspecialchars($edu['level']) ?>
            </h3>

            <p class="text-gray-600 dark:text-gray-400 text-sm italic">
              <?= htmlspecialchars($edu['school_name']) ?> • 
              <span class="font-medium"><?= htmlspecialchars($edu['start_year']) ?>–<?= htmlspecialchars($edu['end_year']) ?></span>
            </p>

            <p class="text-gray-700 dark:text-gray-300 text-base leading-relaxed max-w-md">
              <?= htmlspecialchars($edu['description']) ?>
            </p>
          </div>
        <?php endforeach; ?>
      </div>

      <button id="prevSlide" 
              class="absolute top-1/2 left-5 -translate-y-1/2 bg-white/80 dark:bg-gray-800/80 hover:bg-white dark:hover:bg-gray-700 text-gray-800 dark:text-gray-200 rounded-full p-3 shadow-lg backdrop-blur-md transition">
        &#10094;
      </button>
      <button id="nextSlide" 
              class="absolute top-1/2 right-5 -translate-y-1/2 bg-white/80 dark:bg-gray-800/80 hover:bg-white dark:hover:bg-gray-700 text-gray-800 dark:text-gray-200 rounded-full p-3 shadow-lg backdrop-blur-md transition">
        &#10095;
      </button>

      <div id="sliderDots" class="absolute bottom-5 left-1/2 -translate-x-1/2 flex space-x-3">
        <?php for ($i = 0; $i < count($education); $i++): ?>
          <span class="dot w-3 h-3 bg-gray-400 dark:bg-gray-600 rounded-full transition-all duration-300"></span>
        <?php endfor; ?>
      </div>

    </div>
  </div>
</section>
