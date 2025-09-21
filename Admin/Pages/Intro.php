<?php include "../Backends/Intro/FetchIntroData.php" ?>

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

  <!-- Main Content -->
  <main id="main-content" class="flex-1 overflow-y-auto p-6 md:p-10 md:mr-20">

    <!-- Page Header -->
    <div class="mb-8">
      <h1 class="text-3xl font-bold text-[var(--primary-color)]">Portfolio Introduction</h1>
      <p class="text-gray-400 mt-1">Manage your personal introduction, profile image, CV, and professional titles here.</p>
    </div>

    <!-- Introduction Form Card -->
    <div class="bg-[var(--card-dark)] p-6 rounded-xl shadow-md mb-8">
      <h2 class="text-xl font-semibold mb-4 text-[var(--accent-color)]">Step 1: Personal Information</h2>
      <p class="text-gray-400 mb-4">Fill out your basic information and upload a profile image. This will appear on your portfolio homepage.</p>

      <form id="introForm" method="POST" action="<?= $formAction ?>" enctype="multipart/form-data" class="space-y-4">
        <div>
          <label class="block mb-1 font-semibold">Full Name</label>
          <input name="fullName" type="text" placeholder="Enter your full name"
            class="w-full rounded-md p-2 bg-gray-700 border border-gray-600 text-white"
            value="<?= htmlspecialchars($intro['full_name'] ?? '') ?>">
        </div>

        <div>
          <label class="block mb-1 font-semibold">Brief Introduction</label>
          <textarea name="bio" rows="4" placeholder="Write a short bio about yourself"
            class="w-full rounded-md p-2 bg-gray-700 border border-gray-600 text-white"><?= htmlspecialchars($intro['bio'] ?? '') ?></textarea>
        </div>

        <div>
          <label class="block mb-1 font-semibold">Profile Image</label>
          <input name="profileImage" type="file"
            class="w-full rounded-md p-2 bg-gray-700 border border-gray-600 text-white">
          <?php if (!empty($intro['profile_image'])): ?>
          <div class="mt-2 flex items-center gap-4">
            <p class="text-sm  text-gray-400">Current Image:</p>
            <img src="<?= htmlspecialchars($intro['profile_image']) ?>" alt="Profile Image" class="h-24 rounded-md border border-gray-500">
          </div>
          <?php endif; ?>
        </div>

        <div>
          <label class="block mb-1 font-semibold">CV Link</label>
          <input name="cvLink" type="url" placeholder="https://example.com/cv.pdf"
            class="w-full rounded-md p-2 bg-gray-700 border border-gray-600 text-white"
            value="<?= htmlspecialchars($intro['cv_link'] ?? '') ?>">
        </div>

        <button type="submit"
          class="mt-2 bg-[var(--primary-color)] text-white px-4 py-2 rounded-md font-semibold hover:bg-[var(--secondary-color)] transition">
          Save Personal Info
        </button>
      </form>
    </div>

    <!-- Professional Titles Card -->
    <div class="bg-[var(--card-dark)] p-6 rounded-xl shadow-md mb-8">
      <h2 class="text-xl font-semibold mb-4 text-[var(--accent-color)]">Step 2: Professional Titles</h2>
      <p class="text-gray-400 mb-4">Add your professional titles, e.g., "Web Developer", "UI/UX Designer". You can update or delete them later.</p>

      <!-- Add Title Form -->
      <form id="titleForm" method="POST" action="../Backends/Intro/TitleSubmission.php" class="flex gap-2 mb-4">
        <input name="title" type="text" placeholder="Enter a new professional title"
          class="flex-1 rounded-md p-2 bg-gray-700 border border-gray-600 text-white">
        <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-md font-semibold hover:bg-green-700">
          + Add
        </button>
      </form>

      <!-- Existing Titles -->
      <?php if (!empty($titles)): ?>
      <ul class="space-y-3">
        <?php foreach ($titles as $t): ?>
        <li class="flex flex-col md:flex-row md:items-center md:justify-between bg-gray-800 p-3 rounded-md">
          <span class="text-white font-medium"><?= htmlspecialchars($t['title']) ?></span>

          <div class="mt-2 md:mt-0 flex gap-2">
            <!-- Update Form -->
            <form method="POST" action="../Backends/Intro/TitleUpdate.php" class="flex gap-1">
              <input type="hidden" name="title_id" value="<?= $t['id'] ?>">
              <input type="text" name="title" value="<?= htmlspecialchars($t['title']) ?>"
                     class="rounded-md p-1 bg-gray-700 border border-gray-500 text-white text-sm">
              <button type="submit" class="px-2 py-1 bg-blue-600 text-white rounded-md text-sm hover:bg-blue-700">
                Update
              </button>
            </form>

            <!-- Delete Form -->
            <form method="POST" action="../Backends/Intro/TitleDelete.php" class="inline"
                  onsubmit="return confirm('Are you sure you want to delete this title?');">
              <input type="hidden" name="title_id" value="<?= $t['id'] ?>">
              <button type="submit" class="px-2 py-1 bg-red-600 text-white rounded-md text-sm hover:bg-red-700">
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

  <!-- Include Desktop Sidebar -->
  <?php include "../component/sidebar.html"; ?>

  <!-- Include Mobile Bottom Navigation -->
  <?php include "../component/mobile-nav.html"; ?>

</div>
</body>
</html>
