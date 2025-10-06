<?php 
include "../Backends/Session.php";
include "../Backends/Intro/FetchIntroData.php" 
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

  <main class="flex-1 overflow-y-auto p-4 md:p-8 md:mr-20 pb-24 md:pb-8">

    <div class="mb-8">
      <h1 class="text-4xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-pink-500 via-purple-500 to-indigo-500">
        Portfolio Introduction
      </h1>
      <p class="text-gray-400 mt-2">Manage your personal introduction, profile image, CV, and professional titles here.</p>
    </div>

    <div class="bg-gray-800/80 backdrop-blur-md p-6 rounded-2xl shadow-2xl mb-8 border border-gray-700">
      <h2 class="text-2xl font-semibold mb-4 bg-clip-text text-transparent bg-gradient-to-r from-green-400 to-blue-500">
        Step 1: Personal Information
      </h2>
      <p class="text-gray-400 mb-4">Fill out your basic information and upload a profile image. This will appear on your portfolio homepage.</p>

      <form id="introForm" method="POST" action="<?= $formAction ?>" enctype="multipart/form-data" class="space-y-4">
        <div>
          <label class="block mb-1 font-semibold">Full Name</label>
          <input name="fullName" type="text" placeholder="Enter your full name"
            class="w-full rounded-xl p-3 bg-gray-700 border border-gray-600 text-white focus:outline-none focus:ring-2 focus:ring-indigo-400"
            value="<?= htmlspecialchars($intro['full_name'] ?? '') ?>">
        </div>

        <div>
          <label class="block mb-1 font-semibold">Brief Introduction</label>
          <textarea name="bio" rows="4" placeholder="Write a short bio about yourself"
            class="w-full rounded-xl p-3 bg-gray-700 border border-gray-600 text-white focus:outline-none focus:ring-2 focus:ring-indigo-400"><?= htmlspecialchars($intro['bio'] ?? '') ?></textarea>
        </div>

        <div>
          <label class="block mb-1 font-semibold">Profile Image</label>
          <input name="profileImage" type="file"
            class="w-full rounded-xl p-2 bg-gray-700 border border-gray-600 text-white">
          <?php if (!empty($intro['profile_image'])): ?>
          <div class="mt-2 flex items-center gap-4">
            <p class="text-sm text-gray-400">Current Image:</p>
            <img src="<?= htmlspecialchars($intro['profile_image']) ?>" alt="Profile Image" class="h-24 w-24 object-cover rounded-xl border border-gray-500">
          </div>
          <?php endif; ?>
        </div>

        <div>
          <label class="block mb-1 font-semibold">CV Link</label>
          <input name="cvLink" type="url" placeholder="https://example.com/cv.pdf"
            class="w-full rounded-xl p-3 bg-gray-700 border border-gray-600 text-white focus:outline-none focus:ring-2 focus:ring-indigo-400"
            value="<?= htmlspecialchars($intro['cv_link'] ?? '') ?>">
        </div>

        <button type="submit"
          class="mt-2 w-full sm:w-auto bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 text-white px-6 py-2 rounded-xl font-semibold hover:scale-105 transition-transform duration-300">
          Save Personal Info
        </button>
      </form>
    </div>

    <div class="bg-gray-800/80 backdrop-blur-md p-6 rounded-2xl shadow-2xl border border-gray-700 mb-8">
  <h2 class="text-2xl font-semibold mb-4 bg-clip-text text-transparent bg-gradient-to-r from-yellow-400 to-red-500">
    Step 2: Professional Titles
  </h2>
  <p class="text-gray-400 mb-4">Add your professional titles, e.g., "Web Developer", "UI/UX Designer". You can update or delete them later.</p>

  <!-- Add Title Form -->
  <form id="titleForm" method="POST" action="../Backends/Intro/TitleSubmission.php" class="flex flex-col sm:flex-row gap-2 mb-4">
    <input name="title" type="text" placeholder="Enter a new professional title"
      class="flex-1 rounded-xl p-3 bg-gray-700 border border-gray-600 text-white focus:outline-none focus:ring-2 focus:ring-green-400">
    <button type="submit" class="w-full sm:w-32 px-4 py-2 bg-green-600 rounded-xl font-semibold hover:bg-green-700 transition text-white">
      + Add
    </button>
  </form>

  <?php if (!empty($titles)): ?>
    <ul class="space-y-3">
      <?php foreach ($titles as $t): ?>
      <li class="flex flex-col sm:flex-row sm:items-center sm:justify-between bg-gray-700 p-3 rounded-xl gap-2 border border-gray-600">
        
        <!-- Title Display -->
        <span class="text-white font-medium break-words mb-2 sm:mb-0 flex-1">
          <?= htmlspecialchars($t['title']) ?>
        </span>

        <div class="flex flex-wrap sm:flex-nowrap gap-2 w-full sm:w-auto items-center">

          <!-- Update Form -->
          <form method="POST" action="../Backends/Intro/TitleUpdate.php" class="flex gap-2 flex-1 sm:flex-auto min-w-0">
            <input type="hidden" name="title_id" value="<?= $t['id'] ?>">
            <input type="text" name="title" value="<?= htmlspecialchars($t['title']) ?>"
                  class="flex-1 min-w-0 rounded-md p-2 bg-gray-600 border border-gray-500 text-white text-sm focus:outline-none focus:ring-2 focus:ring-blue-400"
                  placeholder="Edit title">
            <button type="submit" class="w-20 sm:w-24 py-2 bg-blue-600 text-white rounded-md text-sm hover:bg-blue-700 transition">
              Update
            </button>
          </form>

          <!-- Delete Form -->
          <form method="POST" action="../Backends/Intro/TitleDelete.php"
                onsubmit="return confirm('Are you sure you want to delete this title?');"
                class="flex-shrink-0 w-20 sm:w-24">
            <input type="hidden" name="title_id" value="<?= $t['id'] ?>">
            <button type="submit" class="w-full py-2 bg-red-600 text-white rounded-md text-sm hover:bg-red-700 transition">
              Delete
            </button>
          </form>

        </div>
      </li>
      <?php endforeach; ?>
    </ul>
    <?php else: ?>
    <p class="text-gray-400">No professional titles added yet.</p>
    <?php endif; ?>

</div>


  </main>

  <!-- Desktop Sidebar -->
  <?php include "../component/sidebar.html"; ?>

  <!-- Mobile Bottom Navigation -->
  <?php include "../component/mobile-nav.html"; ?>

</div>
</body>
</html>
