<?php include "../Backends/About/FetchAboutData.php" ?>

<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Portfolio Admin Panel</title>
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

        <main id="main-content" class="flex-1 overflow-y-auto p-4 md:p-8 md:mr-20">
            
          <section id="about" class="space-y-6 max-w-6xl mx-auto px-6 py-16">
            <h2 class="flex items-center text-2xl font-bold text-[var(--primary-color)]">
              <i class="fas fa-address-card mr-2"></i> About Me
            </h2>

            <div class="bg-[var(--card-dark)] p-6 rounded-xl shadow-md space-y-8">

              <!-- About Form -->
              <form method="POST" action="../Backends/About/AboutSubmission.php">
                <div>
                  <label class="block mb-2 font-semibold">Detailed About Text</label>
                  <textarea name="selfIntroduction" class="w-full rounded-md p-3 bg-gray-700 border border-gray-600 text-white h-40 resize-none"><?= $about['selfIntroduction'] ?? '' ?></textarea>
                </div>

                <div class="mt-4">
                  <label class="block mb-2 font-semibold">Years of Experience</label>
                  <input type="number" name="years_experience" value="<?= $about['years_experience'] ?? 0 ?>" class="w-full rounded-md p-2 bg-gray-700 border border-gray-600 text-white">
                </div>

                <div class="mt-6">
                  <button class="bg-[var(--primary-color)] text-white px-6 py-2 rounded-md font-semibold hover:bg-[var(--secondary-color)] transition">
                    Save About Me
                  </button>
                </div>
              </form>

              <!-- Skills Form -->
              <?php if ($about): ?>
              <div class="mt-10">
                <h3 class="text-lg font-bold text-[var(--primary-color)] flex items-center mb-4">
                  <i class="fas fa-layer-group mr-2"></i> Add Skill
                </h3>
                <form method="POST" action="../Backends/About/SkillSubmission.php">
                  <input type="hidden" name="about_id" value="<?= $about['id'] ?>">
                  <div class="mb-4">
                    <label class="block mb-2 font-semibold">Skill</label>
                    <input type="text" name="skill" class="w-full rounded-md p-2 bg-gray-700 border border-gray-600 text-white" placeholder="e.g. ReactJS">
                  </div>
                  <div class="mb-4">
                    <label class="block mb-2 font-semibold">Description</label>
                    <textarea name="skillDescription" class="w-full rounded-md p-2 bg-gray-700 border border-gray-600 text-white h-24 resize-none" placeholder="Describe your expertise..."></textarea>
                  </div>
                  <button class="bg-[var(--primary-color)] text-white px-6 py-2 rounded-md font-semibold hover:bg-[var(--secondary-color)] transition">
                    Add Skill
                  </button>
                </form>
              </div>
              <?php endif; ?>

              <!-- Show & Edit Skills -->
              <?php if (!empty($skills)): ?>
              <div class="mt-10">
                <h3 class="text-lg font-bold text-[var(--primary-color)] flex items-center mb-4">
                  <i class="fas fa-tools mr-2"></i> Existing Skills
                </h3>
                <div class="space-y-4">
                  <?php foreach ($skills as $skill): ?>
                  <div class="bg-gray-800 p-4 rounded-lg">
                    <form method="POST" action="../Backends/About/SkillUpdate.php" class="space-y-3">
                      <input type="hidden" name="id" value="<?= $skill['id'] ?>">
                      <div>
                        <label class="block mb-1 font-semibold">Skill</label>
                        <input type="text" name="skill" value="<?= htmlspecialchars($skill['skill']) ?>" class="w-full rounded-md p-2 bg-gray-700 border border-gray-600 text-white">
                      </div>
                      <div>
                        <label class="block mb-1 font-semibold">Description</label>
                        <textarea name="skillDescription" class="w-full rounded-md p-2 bg-gray-700 border border-gray-600 text-white h-24 resize-none"><?= htmlspecialchars($skill['skillDescription']) ?></textarea>
                      </div>
                      <div class="flex justify-between items-center">
                        <button class="bg-blue-500 text-white px-4 py-2 rounded-md font-semibold hover:bg-blue-600 transition">
                          Update
                        </button>
                        <a href="../Backends/About/SkillDelete.php?id=<?= $skill['id'] ?>" class="text-red-500 font-bold hover:underline" onclick="return confirm('Are you sure you want to delete this skill?')">
                          Delete
                        </a>
                      </div>
                    </form>
                  </div>
                  <?php endforeach; ?>
                </div>
              </div>
              <?php endif; ?>

            </div>
          </section>

        </main>

    <!-- sidebar and mobile nav -->
    <?php include "../component/sidebar.html"; ?>
    <?php include "../component/mobile-nav.html"; ?>

    </div>
</body>
</html>
