<?php include "./Backends/ProjectSection.php" ?>

<section id="projects" class="scroll-mt-24 max-w-7xl mx-auto px-6 py-20">
  <div class="text-center mb-16">
    <h3 class="text-4xl font-bold mb-4 bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-500 bg-clip-text text-transparent font-poppins">
      Featured Projects
    </h3>
    <p class="text-gray-600 dark:text-gray-300 max-w-2xl mx-auto text-lg mb-6">
      A curated selection of my work. Each project showcasing my skills and talent through building a system, more project more experience and self growth.
    </p>
    <div class="w-24 h-1.5 bg-gradient-to-r from-indigo-500 to-purple-500 mx-auto rounded-full"></div>
  </div>

  <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8 ">
    <?php foreach ($projects as $index => $project): ?>
      <article class="group relative rounded-2xl overflow-hidden bg-gradient-to-br from-white to-gray-50 dark:from-gray-900 dark:to-gray-800 border-2 border-gray-200 dark:border-gray-700 shadow-lg hover:bg-gradient-to-r hover:from-pink-500 hover:to-purple-500 hover:text-white dark:hover:text-white transition-all duration-300 hover:-translate-y-2 flex flex-col h-full hover:border-red-400 dark:hover:border-pink-400">
        <div class="absolute mt-2 ml-2 z-10 w-10 h-10 rounded-full flex items-center justify-center bg-gradient-to-r from-indigo-500 to-purple-500 text-white font-bold text-sm shadow-lg ">
          <?= $index + 1 ?>
        </div>
        
        <div class="relative aspect-[16/10] bg-gray-100 dark:bg-gray-800 overflow-hidden">
          <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500 z-10"></div>
          <img src="<?= htmlspecialchars($project['cover_image'] ?? 'assets/profile.png') ?>" 
               alt="<?= htmlspecialchars($project['title']) ?>" 
               class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700"
               onerror="this.src='assets/default.jpg'">  
        </div>
        
        <div class="p-6 flex-1 flex flex-col">
          <h4 class="text-xl font-semibold text-gray-900 dark:text-white mb-3 font-poppins group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition-colors duration-300">
            <?= htmlspecialchars($project['title']) ?>
          </h4>
          <p class="text-gray-600 dark:text-gray-300 mb-4 flex-1 leading-relaxed text-justify">
            <?= htmlspecialchars($project['short_description']) ?>
          </p>
          
          <div class="mb-5">
            <p class="text-xs font-medium text-gray-500 dark:text-gray-400 mb-2">Technologies Used:</p>
            <div class="flex flex-wrap gap-2">
              <?php foreach ($project['tools'] as $tool): ?>
                <span class="px-3 py-1.5 rounded-full bg-indigo-50 dark:bg-indigo-900/30 text-indigo-600 dark:text-indigo-300 text-xs font-medium border border-indigo-100 dark:border-indigo-800/50">
                  <?= htmlspecialchars($tool) ?>
                </span>
              <?php endforeach; ?>
            </div>
          </div>
          
          <div class="mt-auto pt-4 border-t border-gray-100 dark:border-gray-700">
            <button data-open-modal="project-<?= $project['id'] ?>"
            class="w-full inline-flex items-center justify-center px-5 py-3 text-sm font-medium rounded-xl bg-gradient-to-r from-indigo-500 to-purple-500 text-white hover:bg-gradient-to-r hover:from-pink-500 hover:to-purple-500 hover:text-white dark:hover:text-white transition-all duration-300 shadow-md hover:shadow-lg transform group-hover:scale-[1.02] ">
              View Project
              <svg class="w-4 h-4 ml-2 transform group-hover:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
              </svg>
            </button>
          </div>
        </div>
      </article>
    <?php endforeach; ?>
  </div>

</section>