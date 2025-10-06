<?php
include "../Backends/Session.php";
include "../Backends/Tools/FetchTools.php";
?>

<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tools & Skills</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="../Css/globalStyle.css">
</head>

<body class="bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900 text-white font-sans">

<div class="flex h-screen">

  <main class="flex-1 overflow-y-auto p-4 md:p-8 md:mr-20 pb-24 md:pb-8">

    <div class="mb-8">
      <h1 class="text-4xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-pink-500 via-purple-500 to-indigo-500">
        Tools & Skills
      </h1>
      <p class="text-gray-400 mt-2">Manage your tools, skills, and proficiency levels here.</p>
    </div>

    <!-- Add New Tool Form -->
    <div class="bg-gray-800/80 backdrop-blur-md p-6 rounded-2xl shadow-2xl mb-8 border border-gray-700 space-y-4">
      <h2 class="text-2xl font-semibold mb-4 bg-clip-text text-transparent bg-gradient-to-r from-green-400 to-blue-500">
        Add New Tool
      </h2>
      <form method="POST" enctype="multipart/form-data" action="../Backends/Tools/SubmitTools.php" class="space-y-3">
        <input type="text" name="name" placeholder="Tool Name (e.g. JavaScript)" 
               class="w-full p-3 rounded-xl bg-gray-700 border border-gray-600 text-white focus:outline-none focus:ring-2 focus:ring-indigo-400" required>

        <select name="category" class="w-full p-3 rounded-xl bg-gray-700 border border-gray-600 text-white focus:outline-none focus:ring-2 focus:ring-indigo-400" required>
            <option value="">Select Category</option>
            <option value="Frontend">Frontend</option>
            <option value="Backend">Backend</option>
            <option value="Databases">Databases</option>
            <option value="Tools & Others">Tools & Others</option>
        </select>

        <input type="number" name="proficiency" placeholder="Proficiency % (0-100)" min="0" max="100" 
               class="w-full p-3 rounded-xl bg-gray-700 border border-gray-600 text-white focus:outline-none focus:ring-2 focus:ring-indigo-400" required>

        <input type="file" name="icon" accept="image/*" class="w-full p-2 rounded-xl bg-gray-700 border border-gray-600 text-white">

        <button type="submit" class="w-full sm:w-auto bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 text-white px-6 py-2 rounded-xl font-semibold hover:scale-105 transition-transform duration-300">
          <i class="fas fa-plus mr-2"></i> Add Tool
        </button>
      </form>
    </div>

    <!-- Existing Tools Table -->
    <div class="bg-gray-800/80 backdrop-blur-md p-6 rounded-2xl shadow-2xl border border-gray-700 overflow-x-auto">
      <h2 class="text-2xl font-semibold mb-4 bg-clip-text text-transparent bg-gradient-to-r from-yellow-400 to-red-500">
        Existing Tools
      </h2>
      <table class="min-w-full text-left border-collapse">
        <thead>
          <tr class="border-b border-gray-600">
            <th class="p-2">Icon</th>
            <th class="p-2">Name</th>
            <th class="p-2">Category</th>
            <th class="p-2">Proficiency</th>
            <th class="p-2">Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($tools as $tool): ?>
          <tr class="border-b border-gray-700 hover:bg-gray-700">
            <td class="p-2">
              <?php if (!empty($tool['icon_path'])): ?>
              <img src="<?= htmlspecialchars($tool['icon_path']) ?>" class="w-8 h-8" alt="<?= htmlspecialchars($tool['name']) ?>">
              <?php else: ?>
              <i class="fas fa-cogs text-blue-400"></i>
              <?php endif; ?>
            </td>
            <td class="p-2"><?= htmlspecialchars($tool['name']) ?></td>
            <td class="p-2"><?= htmlspecialchars($tool['category']) ?></td>
            <td class="p-2">
              <div class="w-full bg-gray-700 h-2 rounded-full overflow-hidden">
                <div class="h-2 bg-blue-400" style="width: <?= $tool['proficiency_percentage'] ?>%;"></div>
              </div>
              <span class="text-xs text-gray-400"><?= $tool['proficiency_percentage'] ?>%</span>
            </td>
            <td class="p-2 flex flex-col md:flex-row gap-2">
              <button class="bg-yellow-500 hover:bg-yellow-600 w-28 h-10 rounded text-white text-sm flex items-center justify-center editToolBtn"
                      data-id="<?= $tool['id'] ?>"
                      data-name="<?= htmlspecialchars($tool['name']) ?>"
                      data-category="<?= $tool['category'] ?>"
                      data-proficiency="<?= $tool['proficiency_percentage'] ?>">
                  <i class="fas fa-edit mr-1"></i> Edit
              </button>

              <form method="POST" action="../Backends/Tools/DeleteTools.php" onsubmit="return confirm('Are you sure you want to delete this tool?');">
                  <input type="hidden" name="id" value="<?= $tool['id'] ?>">
                  <button type="submit" class="bg-red-600 hover:bg-red-700 w-28 h-10 rounded text-white text-sm flex items-center justify-center">
                  <i class="fas fa-trash-alt mr-1"></i> Delete
                  </button>
              </form>
            </td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>

  </main>

  <!-- Sidebar & Mobile Navigation -->
  <?php include "../component/sidebar.html"; ?>
  <?php include "../component/mobile-nav.html"; ?>
  <?php include "../component/Modal/EditTools.php"; ?>                        

</div>
<script src="../Js/HandleEditToolsModal.js"></script>
</body>
</html>
