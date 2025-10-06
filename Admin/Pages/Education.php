<?php 
include "../Backends/Session.php";
include "../Backends/Education/FetchEducationData.php"; 
?>

<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Education Management</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="../Css/globalStyle.css">
</head>

<body class="bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900 text-white font-sans">

<div class="flex h-screen">

<main class="flex-1 overflow-y-auto p-4 md:p-8 md:mr-20 pb-24 md:pb-8">

    <section id="education-management" class="py-20">
      <div class="max-w-4xl mx-auto px-6">
        <h2 class="text-3xl font-bold mb-12 bg-gradient-to-r from-pink-500 via-purple-500 to-indigo-500 bg-clip-text text-transparent text-center">
          Manage Education
        </h2>

        <!-- Add New Education -->
        <div class="bg-gray-800/80 backdrop-blur-md p-6 rounded-2xl shadow-2xl border border-gray-700 mb-10">
          <h3 class="text-2xl font-semibold mb-4 bg-clip-text text-transparent bg-gradient-to-r from-green-400 to-blue-500">
            Add New Education
          </h3>
          <form method="POST" enctype="multipart/form-data" action="../Backends/Education/CreateEducationData.php" class="space-y-4">
            <input type="text" name="level" placeholder="Education Level (e.g., College)" 
              class="w-full p-3 rounded-xl bg-gray-700 border border-gray-600 text-white focus:outline-none focus:ring-2 focus:ring-indigo-400" required>
            <input type="text" name="school_name" placeholder="School Name" 
              class="w-full p-3 rounded-xl bg-gray-700 border border-gray-600 text-white focus:outline-none focus:ring-2 focus:ring-indigo-400" required>
            <div class="flex flex-col md:flex-row gap-4">
              <input type="number" name="start_year" placeholder="Start Year (YYYY)" min="1900" max="2099" 
                class="w-full md:w-1/2 p-3 rounded-xl bg-gray-700 border border-gray-600 text-white focus:outline-none focus:ring-2 focus:ring-indigo-400" required>
              <input type="number" name="end_year" placeholder="End Year (YYYY or Current)" min="1900" max="2099" 
                class="w-full md:w-1/2 p-3 rounded-xl bg-gray-700 border border-gray-600 text-white focus:outline-none focus:ring-2 focus:ring-indigo-400" required>
            </div>
            <textarea name="description" placeholder="Description / Achievements" rows="4"
              class="w-full p-3 rounded-xl bg-gray-700 border border-gray-600 text-white focus:outline-none focus:ring-2 focus:ring-indigo-400" required></textarea>
            <input type="file" name="image" accept="image/*" 
              class="w-full p-2 rounded-xl bg-gray-700 border border-gray-600 text-white">
            <button type="submit" class="w-full sm:w-auto bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 text-white px-6 py-2 rounded-xl font-semibold hover:scale-105 transition-transform duration-300">
              <i class="fas fa-plus mr-2"></i> Add Education
            </button>
          </form>
        </div>

        <!-- Existing Education Records -->
        <div class="bg-gray-800/80 backdrop-blur-md p-6 rounded-2xl shadow-2xl border border-gray-700">
          <h3 class="text-2xl font-semibold mb-4 bg-clip-text text-transparent bg-gradient-to-r from-yellow-400 to-red-500">
            Existing Education
          </h3>
          <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse text-white">
              <thead>
                <tr class="border-b border-gray-600">
                  <th class="p-2">Level</th>
                  <th class="p-2">School</th>
                  <th class="p-2">Years</th>
                  <th class="p-2">Description</th>
                  <th class="p-2">Image</th>
                  <th class="p-2">Actions</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($educations as $edu): ?>
                <tr class="border-b border-gray-700 hover:bg-gray-700">
                  <td class="p-2"><?= htmlspecialchars($edu['level']) ?></td>
                  <td class="p-2"><?= htmlspecialchars($edu['school_name']) ?></td>
                  <td class="p-2"><?= htmlspecialchars($edu['start_year']) ?> - <?= htmlspecialchars($edu['end_year']) ?></td>
                  <td class="p-2">
                    <?php 
                      $words = explode(' ', $edu['description']); 
                      if (count($words) > 5) {
                          echo htmlspecialchars(implode(' ', array_slice($words, 0, 5))) . '...';
                      } else {
                          echo htmlspecialchars($edu['description']);
                      }
                    ?>
                  </td>
                  <td class="p-2">
                    <?php if (!empty($edu['image_path'])): ?>
                      <img src="<?= htmlspecialchars($edu['image_path']) ?>" class="w-16 h-16 rounded-xl border border-gray-600" alt="<?= htmlspecialchars($edu['level']) ?>">
                    <?php else: ?>
                      <i class="fas fa-school text-indigo-500 text-xl"></i>
                    <?php endif; ?>
                  </td>
                  <td class="p-2 flex flex-col md:flex-row gap-2">
                    <button class="bg-yellow-500 hover:bg-yellow-600 w-24 h-10 rounded-xl text-white text-sm flex items-center justify-center editEduBtn"
                            data-id="<?= $edu['id'] ?>"
                            data-level="<?= htmlspecialchars($edu['level']) ?>"
                            data-school="<?= htmlspecialchars($edu['school_name']) ?>"
                            data-start="<?= $edu['start_year'] ?>"
                            data-end="<?= $edu['end_year'] ?>"
                            data-description="<?= htmlspecialchars($edu['description']) ?>">
                      <i class="fas fa-edit mr-1"></i> Edit
                    </button>

                    <form method="POST" action="../Backends/Education/DeleteEducationData.php" onsubmit="return confirm('Are you sure you want to delete this education record?');">
                      <input type="hidden" name="id" value="<?= $edu['id'] ?>">
                      <button type="submit" class="bg-red-600 hover:bg-red-700 w-24 h-10 rounded-xl text-white text-sm flex items-center justify-center">
                        <i class="fas fa-trash-alt mr-1"></i> Delete
                      </button>
                    </form>
                  </td>
                </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>

      </div>
    </section>
  </main>

  <!-- Sidebar, Navbar, and Edit Modal -->
  <?php include "../component/sidebar.html"; ?>
  <?php include "../component/mobile-nav.html"; ?>
  <?php include "../component/Modal/EditEducation.php"; ?>

</div>
</body>
</html>
