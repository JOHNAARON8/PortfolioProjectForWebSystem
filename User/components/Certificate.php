<?php include "./Backends/CertificateSection.php" ?>

<section id="certifications" class="scroll-mt-24 max-w-7xl mx-auto px-6 py-20">
  <div class="text-center mb-16">
    <h3 class="text-4xl font-bold mb-4 bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-500 bg-clip-text text-transparent font-poppins">
      Certifications
    </h3>
    <p class="text-gray-600 dark:text-gray-300 max-w-2xl mx-auto text-lg mb-6">
      A showcase of my professional certifications and completed trainings. Each certificate reflects my growth, expertise, and dedication.
    </p>
    <div class="w-24 h-1.5 bg-gradient-to-r from-indigo-500 to-purple-500 mx-auto rounded-full"></div>
  </div>

  <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8">
    <?php foreach ($certifications as $index => $cert): ?>
      <article class="group relative rounded-2xl overflow-hidden bg-gradient-to-br from-white to-gray-50 dark:from-gray-900 dark:to-gray-800 border-2 border-gray-200 dark:border-gray-700 shadow-lg hover:bg-gradient-to-r hover:from-pink-500 hover:to-purple-500 hover:text-white dark:hover:text-white transition-all duration-300 hover:-translate-y-2 flex flex-col h-full hover:border-red-400 dark:hover:border-pink-400">
        <div class="absolute mt-2 ml-2 z-10 w-10 h-10 rounded-full flex items-center justify-center bg-gradient-to-r from-indigo-500 to-purple-500 text-white font-bold text-sm shadow-lg">
          <?= $index + 1 ?>
        </div>
        
        <div class="relative aspect-[16/10] bg-gray-100 dark:bg-gray-800 overflow-hidden flex items-center justify-center">
          <?php if(!empty($cert['certificate_file'])): ?>
            <img src="<?= htmlspecialchars($cert['certificate_file']) ?>" 
                 alt="<?= htmlspecialchars($cert['cert_name']) ?>" 
                 class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700"
                 onerror="this.src='assets/default.jpg'">
          <?php else: ?>
            <span class="text-gray-400 dark:text-gray-500 font-semibold text-lg">No Image</span>
          <?php endif; ?>
        </div>

        <div class="p-6 flex-1 flex flex-col">
          <h4 class="text-xl font-semibold text-gray-900 dark:text-white mb-2 font-poppins group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition-colors duration-300">
            <?= htmlspecialchars($cert['cert_name']) ?>
          </h4>
          <p class="text-gray-600 dark:text-gray-300 mb-2 text-sm">
            Issued by: <span class="font-medium"><?= htmlspecialchars($cert['issuing_organization']) ?></span>
          </p>
          <p class="text-gray-500 dark:text-gray-400 mb-4 text-sm">
            Issued: <?= htmlspecialchars(date('M Y', strtotime($cert['issue_date']))) ?>
            <?php if(!empty($cert['expiration_date'])): ?>
              • Expires: <?= htmlspecialchars(date('M Y', strtotime($cert['expiration_date']))) ?>
            <?php endif; ?>
          </p>
          <p class="text-xs font-medium mb-3">
            Status: 
            <span class="px-2 py-1 rounded-full 
              <?= $cert['status'] === 'Active' ? 'bg-green-100 text-green-800' : ($cert['status'] === 'Expired' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') ?>">
              <?= htmlspecialchars($cert['status']) ?>
            </span>
          </p>

          <?php if(!empty($cert['certificate_file'])): ?>
            <div class="mt-auto pt-4 border-t border-gray-100 dark:border-gray-700">
              <a href="javascript:void(0);" 
                onclick="openCertModal('<?= htmlspecialchars($cert['cert_name']) ?>', '<?= htmlspecialchars($cert['certificate_file']) ?>')"
                class="w-full inline-flex items-center justify-center px-5 py-3 text-sm font-medium rounded-xl bg-gradient-to-r from-indigo-500 to-purple-500 text-white hover:bg-gradient-to-r hover:from-pink-500 hover:to-purple-500 hover:text-white dark:hover:text-white transition-all duration-300 shadow-md hover:shadow-lg transform group-hover:scale-[1.02] ">
                  View Certificate
              </a>

            </div>
          <?php endif; ?>
        </div>
      </article>
    <?php endforeach; ?>
  </div>
</section>
