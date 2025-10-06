<?php include "./Backends/AboutSection.php"; ?>

<section id="about" class="max-w-6xl mx-auto px-6 py-16">
  <div class="text-center mb-12">
    <h3 class="text-3xl font-bold mb-4 bg-gradient-to-r from-indigo-500 to-purple-500 bg-clip-text text-transparent">
      About Me
    </h3>
    <div class="w-20 h-1 bg-gradient-to-r from-indigo-500 to-purple-500 mx-auto rounded"></div>
  </div>

  <div class="grid md:grid-cols-2 gap-12 items-center">
    <div>
      <p class="text-lg leading-relaxed mb-8 text-justify italic">
        <?php echo nl2br(htmlspecialchars($selfIntroduction, ENT_QUOTES, 'UTF-8')); ?>
      </p>

      <div class="grid grid-cols-2 gap-6">
        <div class="text-center p-4 bg-white dark:bg-gray-800 rounded-lg shadow-lg">
          <div class="text-2xl font-bold text-indigo-600 mb-1">
            <?php echo $projectCount; ?>+
          </div>
          <div class="text-sm text-gray-600 dark:text-gray-400">Projects Completed</div>
        </div>
        <div class="text-center p-4 bg-white dark:bg-gray-800 rounded-lg shadow-lg">
          <div class="text-2xl font-bold text-purple-600 mb-1">
            <?php echo htmlspecialchars($yearsExperience, ENT_QUOTES, 'UTF-8'); ?>+
          </div>
          <div class="text-sm text-gray-600 dark:text-gray-400">Years Of Experience</div>
        </div>
      </div>
    </div>

    <div class="space-y-6">
      <?php foreach ($skills as $skill): ?>
        <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-lg">
          <div class="flex items-center mb-4">
            <i data-feather="check-circle" class="text-indigo-500 mr-3"></i>
            <h4 class="text-2xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500">
              <?php echo htmlspecialchars($skill['skill'], ENT_QUOTES, 'UTF-8'); ?>
            </h4>
          </div>
          <p class="text-gray-600 dark:text-gray-400 text-justify">
            <?php echo nl2br(htmlspecialchars($skill['skillDescription'], ENT_QUOTES, 'UTF-8')); ?>
          </p>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
