<?php include "../Backends/Education/FetchEducationData.php"; ?>

<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Education Management</title>
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

    <section id="education-management" class="py-20 bg-gradient-to-b from-gray-900 to-gray-800">
      <div class="max-w-4xl mx-auto px-6">
        <h2 class="text-3xl font-bold mb-12 bg-gradient-to-r from-indigo-500 to-purple-500 bg-clip-text text-transparent text-center">
          Manage Education
        </h2>

        <!-- For add new education data -->
        <div class="bg-[var(--card-dark)] p-6 rounded-xl shadow-md mb-10">
          <h3 class="text-lg font-semibold mb-4 text-[var(--text-light)]">Add New Education</h3>
          <form method="POST" enctype="multipart/form-data" action="../Backends/Education/CreateEducationData.php" class="space-y-4">
            <input type="text" name="level" placeholder="Education Level (e.g., College)" 
              class="w-full p-2 rounded bg-gray-700 border border-gray-600 text-[var(--text-light)]" required>
            <input type="text" name="school_name" placeholder="School Name" 
              class="w-full p-2 rounded bg-gray-700 border border-gray-600 text-[var(--text-light)]" required>
            <div class="flex flex-col md:flex-row gap-4">
              <input type="number" name="start_year" placeholder="Start Year (YYYY)" min="1900" max="2099" 
                class="w-full md:w-1/2 p-2 rounded bg-gray-700 border border-gray-600 text-[var(--text-light)]" required>
              <input type="number" name="end_year" placeholder="End Year (YYYY or Current)" min="1900" max="2099" 
                class="w-full md:w-1/2 p-2 rounded bg-gray-700 border border-gray-600 text-[var(--text-light)]" required>
            </div>
            <textarea name="description" placeholder="Description / Achievements" rows="4"
              class="w-full p-2 rounded bg-gray-700 border border-gray-600 text-[var(--text-light)]" required></textarea>
            <input type="file" name="image" accept="image/*" 
              class="w-full p-2 rounded bg-gray-700 border border-gray-600 text-[var(--text-light)]">
            <button type="submit" class="w-full md:w-auto bg-blue-500 hover:bg-blue-600 px-4 py-2 rounded text-white font-semibold">
              <i class="fas fa-plus mr-2"></i> Add Education
            </button>
          </form>
        </div>

        <!-- Existing Education Records -->
        <div class="bg-[var(--card-dark)] p-6 rounded-xl shadow-md">
          <h3 class="text-lg font-semibold mb-4 text-[var(--text-light)]">Existing Education</h3>
          <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse text-[var(--text-light)]">
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
                  <td class="p-2"><?= htmlspecialchars($edu['description']) ?></td>
                  <td class="p-2">
                    <?php if (!empty($edu['image_path'])): ?>
                      <img src="<?= htmlspecialchars($edu['image_path']) ?>" class="w-16 h-16 rounded-md" alt="<?= htmlspecialchars($edu['level']) ?>">
                    <?php else: ?>
                      <i class="fas fa-school text-indigo-500 text-xl"></i>
                    <?php endif; ?>
                  </td>
                  <td class="p-2 flex flex-col md:flex-row gap-2">
                    <!-- Edit Button -->
                    <button class="bg-yellow-500 hover:bg-yellow-600 w-24 h-10 rounded text-white text-sm flex items-center justify-center editEduBtn"
                            data-id="<?= $edu['id'] ?>"
                            data-level="<?= htmlspecialchars($edu['level']) ?>"
                            data-school="<?= htmlspecialchars($edu['school_name']) ?>"
                            data-start="<?= $edu['start_year'] ?>"
                            data-end="<?= $edu['end_year'] ?>"
                            data-description="<?= htmlspecialchars($edu['description']) ?>">
                      <i class="fas fa-edit mr-1"></i> Edit
                    </button>

                    <!-- Delete Button -->
                    <form method="POST" action="../Backends/Education/DeleteEducationData.php" onsubmit="return confirm('Are you sure you want to delete this education record?');">
                      <input type="hidden" name="id" value="<?= $edu['id'] ?>">
                      <button type="submit" class="bg-red-500 hover:bg-red-600 w-24 h-10 rounded text-white text-sm flex items-center justify-center">
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

  <!-- Sidebar, Navbar and the modal for edit education data -->
  <?php include "../component/sidebar.html"; ?>
  <?php include "../component/mobile-nav.html"; ?>
  <?php include "../component/Modal/EditEducation.php"; ?>

</div>
</body>
</html>
