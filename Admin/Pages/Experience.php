<?php
include "../Backends/Session.php"; 
include "../Backends/Experience/FetchExperienceData.php"; 
?>

<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Portfolio Admin Panel - Experience</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="../Css/globalStyle.css">

</head>

<body class="bg-[var(--bg-dark)] text-[var(--text-light)] font-sans">

<div class="flex h-screen">

<main class="flex-1 overflow-y-auto p-4 md:p-8 md:mr-20 pb-24 md:pb-8">

    <section class="space-y-6">

      <h2 class="flex items-center text-3xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-indigo-400 via-purple-500 to-pink-500">
        <i class="fas fa-briefcase mr-2"></i> Manage Experiences
      </h2>

      <!-- Add Experience Form -->
      <div class="bg-gray-800/80 backdrop-blur-md p-8 rounded-2xl shadow-2xl border border-gray-700 space-y-6">
        <h3 class="font-semibold text-xl bg-clip-text text-transparent bg-gradient-to-r from-green-400 to-blue-500">Add New Experience</h3>

        <form method="POST" action="../Backends/Experience/CreateExperience.php" class="space-y-4" id="experienceForm">

          <input type="text" name="year_label" placeholder="Year or Period (e.g. 2022, Present)"
                 class="w-full p-3 rounded-xl bg-gray-700 border border-gray-600 text-white focus:outline-none focus:ring-2 focus:ring-indigo-400" required>

          <select name="category" class="w-full p-3 rounded-xl bg-gray-700 border border-gray-600 text-white focus:outline-none focus:ring-2 focus:ring-indigo-400" required>
            <option value="">Select Category</option>
            <option value="Training & Certification">Training & Certification</option>
            <option value="Freelance / Projects">Freelance / Projects</option>
            <option value="Non-IT Field">Non-IT Field</option>
            <option value="Internship">Internship</option>
            <option value="Other">Other</option>
          </select>

          <input type="text" name="title" placeholder="Title (e.g. CSS NCII Training & Assessment)"
                 class="w-full p-3 rounded-xl bg-gray-700 border border-gray-600 text-white focus:outline-none focus:ring-2 focus:ring-indigo-400" required>

          <input type="text" name="organization" placeholder="Organization / Context"
                 class="w-full p-3 rounded-xl bg-gray-700 border border-gray-600 text-white focus:outline-none focus:ring-2 focus:ring-indigo-400">

          <select name="badge" class="w-full p-3 rounded-xl bg-gray-700 border border-gray-600 text-white focus:outline-none focus:ring-2 focus:ring-indigo-400">
            <option value="">Select Badge</option>
            <option value="Certification">Certification</option>
            <option value="Creative • IT">Creative • IT</option>
            <option value="Growth">Growth</option>
            <option value="Leadership">Leadership</option>
            <option value="Other">Other</option>
          </select>

          <div id="highlightContainer" class="space-y-2">
            <textarea name="highlights[]" rows="3" placeholder="Highlight #1"
                      class="w-full p-3 rounded-xl bg-gray-700 border border-gray-600 text-white focus:outline-none focus:ring-2 focus:ring-indigo-400"></textarea>
          </div>
          <button type="button" id="addHighlight" class="text-sm text-indigo-400 hover:text-indigo-200 transition">
            + Add another highlight
          </button>

          <button type="submit" class="bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 text-white px-6 py-3 rounded-xl font-semibold hover:scale-105 transition-transform duration-300">
            <i class="fas fa-plus mr-2"></i> Save Experience
          </button>
        </form>
      </div>

      <!-- Existing Experiences -->
      <div class="bg-[var(--card-dark)] p-6 rounded-xl shadow-md space-y-4">
        <h3 class="font-semibold text-xl bg-clip-text text-transparent bg-gradient-to-r from-yellow-400 to-red-500">Your Experiences</h3>

        <?php foreach ($experiences as $exp): ?>
          <div class="border-b border-gray-700 pb-3 mb-3">
            <div class="flex justify-between items-center">
              <div>
                <p class="font-semibold"><?= htmlspecialchars($exp['title']) ?></p>
                <p class="text-gray-400 text-sm">
                  <?= htmlspecialchars($exp['organization']) ?> • <?= htmlspecialchars($exp['year_label']) ?>
                </p>
                <p class="text-sm text-[var(--accent-color)]"><?= htmlspecialchars($exp['badge']) ?></p>
              </div>
              <div class="flex gap-2">
                
                <!-- Delete Button -->
                <form method="POST" action="../Backends/Experience/DeleteExperience.php" 
                        onsubmit="return confirm('Are you sure you want to delete this experience?');">
                    <input type="hidden" name="id" value="<?= $exp['id'] ?>">
                    <button class="bg-red-600 text-white w-10 h-10 flex items-center justify-center rounded-md">
                    <i class="fas fa-trash"></i>
                    </button>
                </form>

                <!-- Edit Button -->
                <button class="bg-yellow-500 text-white w-10 h-10 flex items-center justify-center rounded-md edit-btn" 
                        data-id="<?= $exp['id'] ?>">
                    <i class="fas fa-edit"></i>
                </button>
                </div>

            </div>

            <ul class="list-disc ml-6 mt-2 text-gray-300">
              <?php foreach ($highlights[$exp['id']] as $h): ?>
                <li><?= htmlspecialchars($h['highlight']) ?></li>
              <?php endforeach; ?>
            </ul>

            <?php 
            $experience = $exp; 
            $experienceHighlights = $highlights[$exp['id']];
            include "../component/Modal/EditExperience.php"; 
            ?>
          </div>
        <?php endforeach; ?>
      </div>
    </section>
  </main>

  <?php include "../component/sidebar.html"; ?>
  <?php include "../component/mobile-nav.html"; ?>
</div>

<script>
  document.querySelectorAll('.edit-btn').forEach(btn => {
    btn.addEventListener('click', () => {
      const id = btn.dataset.id;
      document.getElementById('editModal' + id).classList.remove('hidden');
    });
  });

  const addBtn = document.getElementById('addHighlight');
        const container = document.getElementById('highlightContainer');
        let count = 1;

        addBtn.addEventListener('click', () => {
          count++;
          const textarea = document.createElement('textarea');
          textarea.name = 'highlights[]';
          textarea.rows = 3;
          textarea.placeholder = `Highlight #${count}`;
          textarea.className = 'w-full p-2 rounded bg-gray-700 border border-gray-600 text-white';
          container.appendChild(textarea);
        });
</script>

</body>
</html>
