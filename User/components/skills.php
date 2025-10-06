<?php include "./Backends/SkillSection.php" ?>

<section id="skills" class="max-w-6xl mx-auto px-6 py-16">
  <div class="text-center mb-12">
    <h3 class="text-3xl font-bold mb-4 bg-gradient-to-r from-indigo-500 to-purple-500 bg-clip-text text-transparent">
      Skills & Technologies
    </h3>
    <div class="w-20 h-1 bg-gradient-to-r from-indigo-500 to-purple-500 mx-auto rounded"></div>
  </div>

  <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-8 mb-14">
    <?php foreach ($skills as $category => $items): ?>
      <div class="p-6 rounded-2xl border bg-white/80 dark:bg-gray-900/60 backdrop-blur shadow text-center">
        <h4 class="text-xl font-semibold mb-6 
          <?php if($category=='Frontend') echo 'text-indigo-600'; ?>
          <?php if($category=='Backend') echo 'text-purple-600'; ?>
          <?php if($category=='Databases') echo 'text-blue-600'; ?>
          <?php if($category=='Tools & Others') echo 'text-pink-600'; ?>
        ">
          <?= htmlspecialchars($category) ?>
        </h4>

        <ul class="space-y-5">
          <?php foreach ($items as $tool): ?>
            <li class="flex flex-col items-start text-left">
              <!-- Icon & Name -->
              <div class="flex items-center gap-3 mb-2">
                <div class="w-10 h-10 rounded-lg bg-white/80 dark:bg-gray-900/50 flex items-center justify-center overflow-hidden">
                  <?php if (!empty($tool['icon_path'])): ?>
                    <img src="<?= htmlspecialchars($tool['icon_path']) ?>" alt="<?= htmlspecialchars($tool['name']) ?>" class="max-w-full max-h-full object-contain">
                  <?php else: ?>
                    <div class="w-full h-full bg-gray-300 dark:bg-gray-700"></div>
                  <?php endif; ?>
                </div>
                <span class="text-gray-800 dark:text-gray-200 font-medium"><?= htmlspecialchars($tool['name']) ?></span>
              </div>

      
              <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2 overflow-hidden">
                <div 
                  class="h-2 rounded-full transition-all duration-1000 ease-out opacity-80
                    <?php if($category=='Frontend') echo 'bg-indigo-500'; ?>
                    <?php if($category=='Backend') echo 'bg-purple-500'; ?>
                    <?php if($category=='Databases') echo 'bg-blue-500'; ?>
                    <?php if($category=='Tools & Others') echo 'bg-pink-500'; ?>"
                  data-progress="<?= intval($tool['proficiency_percentage']) ?>%"
                  style="width: 0%">
                </div>
              </div>
              <span class="text-xs text-gray-500 dark:text-gray-400 mt-1"><?= intval($tool['proficiency_percentage']) ?>%</span>
            </li>
          <?php endforeach; ?>
        </ul>
      </div>
    <?php endforeach; ?>
  </div>
</section>
