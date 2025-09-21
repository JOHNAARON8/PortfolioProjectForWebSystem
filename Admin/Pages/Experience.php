<?php include "../Backends/Experience/FetchExperienceData.php"; ?>

<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Portfolio Admin Panel - Experience</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    :root {
      --primary-color: rgb(70, 130, 180);
      --secondary-color: rgb(120, 50, 200);
      --accent-color: rgb(240, 50, 130);
      --bg-dark: rgb(15, 23, 42);
      --card-dark: rgb(30, 40, 60);
      --text-light: rgb(220, 220, 220);
    }
  </style>
</head>

<body class="bg-[var(--bg-dark)] text-[var(--text-light)] font-sans">

<div class="flex h-screen">
  <!-- Main Content -->
  <main id="main-content" class="flex-1 overflow-y-auto p-4 md:p-8 md:mr-20">
    <section class="space-y-6">
      <h2 class="flex items-center text-2xl font-bold text-[var(--primary-color)]">
        <i class="fas fa-briefcase mr-2"></i> Manage Experiences
      </h2>

      <!-- Add Experience Form -->
      <div class="bg-[var(--card-dark)] p-6 rounded-xl shadow-md space-y-4">
        <h3 class="font-semibold text-lg">Add New Experience</h3>
        <form method="POST" action="../Backends/Experience/CreateExperience.php" class="space-y-3" id="experienceForm">
          
          <input type="text" name="year_label" placeholder="Year or Period (e.g. 2022, Present)"
                 class="w-full p-2 rounded bg-gray-700 border border-gray-600 text-white" required>

          <!-- Category Dropdown -->
          <select name="category" class="w-full p-2 rounded bg-gray-700 border border-gray-600 text-white" required>
            <option value="">Select Category</option>
            <option value="Training & Certification">Training & Certification</option>
            <option value="Freelance / Projects">Freelance / Projects</option>
            <option value="Non-IT Field">Non-IT Field</option>
            <option value="Internship">Internship</option>
            <option value="Other">Other</option>
          </select>

          <input type="text" name="title" placeholder="Title (e.g. CSS NCII Training & Assessment)"
                 class="w-full p-2 rounded bg-gray-700 border border-gray-600 text-white" required>

          <input type="text" name="organization" placeholder="Organization / Context"
                 class="w-full p-2 rounded bg-gray-700 border border-gray-600 text-white">

          <!-- Badge Dropdown -->
          <select name="badge" class="w-full p-2 rounded bg-gray-700 border border-gray-600 text-white">
            <option value="">Select Badge</option>
            <option value="Certification">Certification</option>
            <option value="Creative • IT">Creative • IT</option>
            <option value="Growth">Growth</option>
            <option value="Leadership">Leadership</option>
            <option value="Other">Other</option>
          </select>

          <!-- Highlights (Dynamic) -->
          <div id="highlightContainer" class="space-y-2">
            <textarea name="highlights[]" rows="3" placeholder="Highlight #1"
                      class="w-full p-2 rounded bg-gray-700 border border-gray-600 text-white"></textarea>
          </div>
          <button type="button" id="addHighlight" class="text-sm text-indigo-400 hover:text-indigo-200">
            + Add another highlight
          </button>

          <button type="submit"
                  class="bg-[var(--primary-color)] text-white px-4 py-2 rounded-md hover:bg-[var(--secondary-color)] transition">
            <i class="fas fa-plus mr-2"></i> Save Experience
          </button>
        </form>
      </div>

      <!-- Existing Experiences -->
      <div class="bg-[var(--card-dark)] p-6 rounded-xl shadow-md space-y-4">
        <h3 class="font-semibold text-lg">Your Experiences</h3>
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

            <!-- Show Highlights -->
            <ul class="list-disc ml-6 mt-2 text-gray-300">
              <?php foreach ($highlights[$exp['id']] as $h): ?>
                <li><?= htmlspecialchars($h['highlight']) ?></li>
              <?php endforeach; ?>
            </ul>

            <!-- Include Modal -->
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

  <!-- Sidebar and Navbar -->
  <?php include "../component/sidebar.html"; ?>
  <?php include "../component/mobile-nav.html"; ?>
</div>

<script>
  // Attach event listeners to all edit buttons
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
