<?php
include "../Backends/Session.php";
include "../Backends/About/FetchAboutData.php" 
?>

<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Portfolio Admin Panel</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="../Css/globalStyle.css">
</head>

<body class="bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900 text-white font-sans">

<div class="flex h-screen">

  <main id="main-content" class="flex-1 overflow-y-auto p-4 md:p-8 md:mr-20">

    <section id="about" class="space-y-6 max-w-6xl mx-auto px-6 py-16">

      <h2 class="flex items-center text-3xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-pink-500 via-purple-500 to-indigo-500">
        <i class="fas fa-address-card mr-2"></i> About Me
      </h2>

      <div class="bg-gray-800/80 backdrop-blur-md p-8 rounded-2xl shadow-2xl border border-gray-700 space-y-10">

        <!-- About Form -->
        <form method="POST" action="../Backends/About/AboutSubmission.php" class="space-y-6">
          <div>
            <label class="block mb-2 font-semibold">Detailed About Text</label>
            <textarea name="selfIntroduction" class="w-full text-justify rounded-xl p-4 bg-gray-700 border border-gray-600 text-white h-40 resize-none focus:outline-none focus:ring-2 focus:ring-indigo-400"><?= $about['selfIntroduction'] ?? '' ?></textarea>
          </div>

          <div>
            <label class="block mb-2 font-semibold">Years of Experience</label>
            <input type="number" name="years_experience" value="<?= $about['years_experience'] ?? 0 ?>" class="w-full rounded-xl p-3 bg-gray-700 border border-gray-600 text-white focus:outline-none focus:ring-2 focus:ring-indigo-400">
          </div>

          <button class="bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 text-white px-6 py-3 rounded-xl font-semibold hover:scale-105 transition-transform duration-300">
            Save About Me
          </button>
        </form>

        <!-- Add Skill Form -->
        <?php if ($about): ?>
        <div>
          <h3 class="text-2xl font-semibold flex items-center mb-4 bg-clip-text text-transparent bg-gradient-to-r from-green-400 to-blue-500">
            <i class="fas fa-layer-group mr-2"></i> Add Skill
          </h3>

          <form method="POST" action="../Backends/About/SkillSubmission.php" class="space-y-4">
            <input type="hidden" name="about_id" value="<?= $about['id'] ?>">

            <div>
              <label class="block mb-2 font-semibold">Skill</label>
              <input type="text" name="skill" class="w-full rounded-xl p-3 bg-gray-700 border border-gray-600 text-white focus:outline-none focus:ring-2 focus:ring-green-400" placeholder="e.g. ReactJS">
            </div>

            <div>
              <label class="block mb-2 font-semibold">Description</label>
              <textarea name="skillDescription" class="w-full rounded-xl p-3 bg-gray-700 border border-gray-600 text-white h-24 resize-none focus:outline-none focus:ring-2 focus:ring-green-400" placeholder="Describe your expertise..."></textarea>
            </div>

            <button class="bg-gradient-to-r from-green-500 to-teal-500 text-white px-6 py-2 rounded-xl font-semibold hover:scale-105 transition-transform duration-300">
              Add Skill
            </button>
          </form>
        </div>
        <?php endif; ?>


        <?php if (!empty($skills)): ?>
        <div>
          <h3 class="text-2xl font-semibold flex items-center mb-4 bg-clip-text text-transparent bg-gradient-to-r from-yellow-400 to-red-500">
            <i class="fas fa-tools mr-2"></i> Existing Skills
          </h3>

          <div class="space-y-4">
            <?php foreach ($skills as $skill): ?>
            <div class="bg-gray-700/90 p-6 rounded-2xl border border-gray-600 shadow-md">
              <form method="POST" action="../Backends/About/SkillUpdate.php" class="space-y-4">
                <input type="hidden" name="id" value="<?= $skill['id'] ?>">

                <div>
                  <label class="block mb-1 font-semibold">Skill</label>
                  <input type="text" name="skill" value="<?= htmlspecialchars($skill['skill']) ?>" class="w-full rounded-xl p-3 bg-gray-700 border border-gray-600 text-white focus:outline-none focus:ring-2 focus:ring-blue-400">
                </div>

                <div>
                  <label class="block mb-1 font-semibold">Description</label>
                  <textarea name="skillDescription" class="w-full rounded-xl p-3 bg-gray-700 border border-gray-600 text-white h-24 resize-none focus:outline-none focus:ring-2 focus:ring-blue-400"><?= htmlspecialchars($skill['skillDescription']) ?></textarea>
                </div>

                <div class="flex justify-between items-center">
                  <button class="bg-blue-500 text-white px-6 py-2 rounded-xl font-semibold hover:bg-blue-600 transition">
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

  <!-- Sidebar and Mobile Nav -->
  <?php include "../component/sidebar.html"; ?>
  <?php include "../component/mobile-nav.html"; ?>

</div>
</body>
</html>
