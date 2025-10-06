<?php if (!isset($projects)) return; ?>

<?php foreach ($projects as $project): ?>
<div class="fixed inset-0 z-[100] hidden transition-opacity duration-300" data-modal="project-<?= $project['id'] ?>">
  
  <div class="absolute inset-0 backdrop-blur-sm transition-opacity duration-300"
       style="background-color: rgba(0, 0, 0, 0.6);" 
       data-close></div>

  <div class="absolute inset-x-4 sm:inset-x-auto sm:left-1/2 sm:-translate-x-1/2 top-8 sm:top-12 max-w-3xl mx-auto rounded-3xl shadow-2xl border overflow-hidden transition-all duration-300 transform scale-95"
       style="background-color: rgb(245, 245, 255); border-color: rgb(200, 200, 220);">
    
    <div class="relative px-6 py-4 border-b flex items-center justify-between"
         style="background-color: rgb(220, 200, 255); border-color: rgb(200, 180, 220);">
      <h5 class="text-xl font-bold truncate pr-4" style="color: rgb(50, 20, 80);">
        <?= htmlspecialchars($project['title']) ?>
      </h5>
      <button class="flex-shrink-0 p-2 rounded-full transition-colors duration-200 hover:brightness-110" data-close
              style="color: rgb(80, 50, 120);">
        <i data-feather="x" class="w-5 h-5"></i>
      </button>
    </div>
    
    <div class="p-6 space-y-6 max-h-[70vh] overflow-y-auto">
      
      <div class="relative aspect-[16/9] overflow-hidden rounded-2xl shadow-inner"
           style="background-color: rgb(230, 230, 255);">
        <img src="<?= htmlspecialchars($project['cover_image'] ?? 'assets/profile.png') ?>"
             alt="<?= htmlspecialchars($project['title']) ?>"
             class="w-full h-full object-cover transition-transform duration-300 hover:scale-105 rounded-2xl"
             onerror="this.src='assets/profile.png'">
        <div class="absolute inset-0 transition-opacity duration-300 opacity-0 hover:opacity-100"
             style="background: linear-gradient(to top, rgba(0,0,0,0.2), rgba(0,0,0,0)); border-radius: 1rem;"></div>
      </div>
      
      <div class="max-w-none">
        <p class="leading-relaxed text-base" style="color: rgb(40, 30, 70);">
          <?= htmlspecialchars($project['full_description']) ?>
        </p>
      </div>
      
      <div class="space-y-3">
        <h6 class="text-sm font-semibold uppercase tracking-wide"
            style="color: rgb(60, 30, 90);">
          Technologies Used
        </h6>
        <div class="flex flex-wrap gap-2">
          <?php foreach ($project['tools'] as $tool): ?>
            <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-medium transition-all duration-200 hover:shadow-md hover:scale-105"
                  style="background-color: rgb(220, 200, 255); color: rgb(70, 20, 100); border: 1px solid rgb(200, 180, 220);">
              <?= htmlspecialchars($tool) ?>
            </span>
          <?php endforeach; ?>
        </div>
      </div>
      
      <?php if (!empty($project['live_link'])): ?>
        <div class="pt-4 border-t" style="border-color: rgb(200, 180, 220);">
          <a href="<?= htmlspecialchars($project['live_link']) ?>" target="_blank"
             class="inline-flex items-center gap-2 px-6 py-3 text-sm font-semibold rounded-2xl transition-all duration-300 transform hover:scale-105 hover:brightness-110"
             style="background-color: rgb(180, 100, 255); color: rgb(255, 255, 255);">
            <i data-feather="external-link" class="w-4 h-4"></i>
            Visit Live Project
          </a>
        </div>
      <?php endif; ?>
      
    </div>
  </div>
</div>
<?php endforeach; ?>
