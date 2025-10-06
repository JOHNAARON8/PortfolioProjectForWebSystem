<?php include "./Backends/ExperienceSection.php" ?>

<section id="experience" class="scroll-mt-24 max-w-6xl mx-auto px-4 sm:px-6 py-12 md:py-16">
  <div class="text-center mb-10 md:mb-12">
    <h3 class="text-3xl sm:text-4xl font-extrabold mb-3 sm:mb-4 bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 bg-clip-text text-transparent">
      Experience
    </h3>
    <div class="w-24 sm:w-28 h-1 bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 mx-auto rounded-full"></div>
    <p class="mt-4 text-sm sm:text-base text-gray-700 dark:text-gray-300 max-w-2xl mx-auto">
      A timeline of my <span class="font-semibold text-indigo-600 dark:text-indigo-400">training</span>, <span class="font-semibold text-purple-600 dark:text-purple-400">hands-on experience</span>, and <span class="font-semibold text-pink-600 dark:text-pink-400">continuous learning</span> in IT and beyond.
    </p>
  </div>

  <div class="relative">
    <div class="hidden md:block absolute left-4 md:left-1/2 top-0 bottom-0 w-0.5 bg-gradient-to-b from-indigo-500 via-purple-500 to-pink-500 opacity-30"></div>

    <div class="space-y-10">
      <?php foreach ($experiences as $index => $exp): ?>
        <div class="flex flex-col md:grid md:grid-cols-2 md:gap-10 items-start">
          
          <div class="mb-2 md:mb-0 md:<?= $index % 2 == 0 ? 'text-right md:pr-12' : 'text-left md:pl-12 md:order-2' ?>">
            <div class="inline-flex items-center gap-2 text-xs sm:text-sm px-3 py-1 rounded-full font-medium
              <?php if ($exp['badge'] == 'Certification'): ?>
                bg-indigo-100 dark:bg-indigo-900/30 text-indigo-700 dark:text-indigo-300
              <?php elseif ($exp['badge'] == 'Creative • IT'): ?>
                bg-purple-100 dark:bg-purple-900/30 text-purple-700 dark:text-purple-300
              <?php else: ?>
                bg-pink-100 dark:bg-pink-900/30 text-pink-700 dark:text-pink-300
              <?php endif; ?>">
              <?= htmlspecialchars($exp['year_label']) ?> <span class="hidden sm:inline">•</span> <?= htmlspecialchars($exp['category']) ?>
            </div>
          </div>

          <!-- Content Box -->
          <div class="relative w-full md:<?= $index % 2 == 0 ? 'pl-0 md:pl-12' : 'order-1 pl-0 md:pl-12' ?>">
            <div class="hidden md:block absolute -left-2 top-2 w-4 h-4 rounded-full 
              <?php if ($exp['badge'] == 'Certification'): ?>
                bg-indigo-500 ring-4 ring-indigo-500/20
              <?php elseif ($exp['badge'] == 'Creative • IT'): ?>
                bg-purple-500 ring-4 ring-purple-500/20
              <?php else: ?>
                bg-pink-500 ring-4 ring-pink-500/20
              <?php endif; ?>">
            </div>

            <div class="p-5 sm:p-6 rounded-2xl border border-gray-200 dark:border-gray-700 bg-white/70 dark:bg-gray-800/60 backdrop-blur shadow-lg hover:shadow-xl transition-shadow duration-300">
              <div class="flex flex-col sm:flex-row sm:items-start justify-between gap-3 sm:gap-4">
                <div class="flex-1">
                  <h4 class="text-2xl font-bold  bg-clip-text text-transparent bg-gradient-to-r from-red-500 via-yellow-500 to-white-500">
                    <?= htmlspecialchars($exp['title']) ?>
                  </h4>
                  <p class="text-xs sm:text-sm text-gray-500 dark:text-gray-400">
                    <?= htmlspecialchars($exp['organization']) ?>
                  </p>
                </div>
                <span class="self-start sm:self-auto px-3 py-1 text-xs sm:text-sm rounded-full font-large
                  <?php if ($exp['badge'] == 'Certification'): ?>
                    bg-indigo-100 dark:bg-indigo-900/30 text-indigo-700 dark:text-indigo-300
                  <?php elseif ($exp['badge'] == 'Creative • IT'): ?>
                    bg-purple-100 dark:bg-purple-900/30 text-purple-700 dark:text-purple-300
                  <?php else: ?>
                    bg-pink-100 dark:bg-pink-900/30 text-pink-700 dark:text-pink-300
                  <?php endif; ?>">
                  <?= htmlspecialchars($exp['badge']) ?>
                </span>
              </div>

              <ul class="mt-4 space-y-3">
                <?php foreach ($exp['highlights'] as $h): ?>
                  <li class="flex items-start gap-3 p-3 sm:p-4 rounded-lg bg-indigo-50/40 dark:bg-gray-800/40 hover:bg-indigo-100/50 dark:hover:bg-gray-700/50 transition-colors duration-300 shadow-sm">
                    <i data-feather="check-circle" class="w-5 h-5 flex-shrink-0 mt-0.5 text-indigo-600 dark:text-indigo-400"></i>
                    <span class="text-sm sm:text-base text-gray-800 dark:text-gray-200 leading-relaxed">
                      <?= htmlspecialchars($h) ?>
                    </span>
                  </li>
                <?php endforeach; ?>
              </ul>

            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>

  <div class="text-center mt-12">
    <a href="#contact" class="inline-flex items-center px-7 sm:px-9 py-3 sm:py-3.5 text-sm sm:text-base font-semibold bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 text-white rounded-full shadow-lg hover:scale-105 hover:shadow-xl transition-transform duration-300">
      Work With Me
      <i data-feather="arrow-right" class="ml-2 w-4 h-4"></i>
    </a>
  </div>
</section>
