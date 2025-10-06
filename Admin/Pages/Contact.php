<?php 
include "../Backends/Session.php";
include "../Backends/Contact/FetchContactData.php"; 
?>

<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Manage Contact Info</title>
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
  <main class="flex-1 overflow-y-auto p-6 md:p-10 md:mr-20 mb-10">

    <section>
      <h1 class="text-3xl font-extrabold text-center mb-10 bg-gradient-to-r from-indigo-500 to-purple-500 bg-clip-text text-transparent">
        Manage Contact Information
      </h1>

      <div class="bg-[var(--card-dark)] p-8 rounded-2xl shadow-xl max-w-3xl mx-auto border border-gray-700 mb-10">
        <?php if ($contact && !isset($_GET['edit'])): ?>
          <div class="space-y-5">
            <div class="flex items-center gap-3">
              <i class="fas fa-envelope text-[var(--primary-color)] text-lg"></i>
              <p><strong>Email:</strong> <?= $contact['email'] ?></p>
            </div>
            <div class="flex items-center gap-3">
              <i class="fas fa-phone text-[var(--primary-color)] text-lg"></i>
              <p><strong>Phone:</strong> <?= $contact['phone'] ?></p>
            </div>
            <div class="flex items-center gap-3">
              <i class="fas fa-location-dot text-[var(--primary-color)] text-lg"></i>
              <p><strong>Location:</strong> <?= $contact['location'] ?></p>
            </div>
            <?php if ($contact['github_link']): ?>
              <div class="flex items-center gap-3">
                <i class="fab fa-github text-[var(--primary-color)] text-lg"></i>
                <a href="<?= $contact['github_link'] ?>" target="_blank" class="hover:underline">GitHub</a>
              </div>
            <?php endif; ?>
            <?php if ($contact['linkedin_link']): ?>
              <div class="flex items-center gap-3">
                <i class="fab fa-linkedin text-[var(--primary-color)] text-lg"></i>
                <a href="<?= $contact['linkedin_link'] ?>" target="_blank" class="hover:underline">LinkedIn</a>
              </div>
            <?php endif; ?>
            <?php if ($contact['facebook_link']): ?>
              <div class="flex items-center gap-3">
                <i class="fab fa-facebook text-[var(--primary-color)] text-lg"></i>
                <a href="<?= $contact['facebook_link'] ?>" target="_blank" class="hover:underline">Facebook</a>
              </div>
            <?php endif; ?>
          </div>

          <div class="mt-8 flex justify-center">
            <a href="?edit=1" 
               class="px-6 py-3 bg-blue-600 rounded-lg hover:bg-blue-500 transition flex items-center gap-2">
              <i class="fas fa-edit"></i> Edit Info
            </a>
          </div>

        <?php else: ?>

          <!-- Add or Edit Mode -->
          <form action="<?= $contact ? '../Backends/Contact/UpdateContactData.php' : '../Backends/Contact/AddContactData.php' ?>" 
                method="POST" 
                class="space-y-6">
            <?php if ($contact): ?>
              <input type="hidden" name="id" value="<?= $contact['id'] ?>">
            <?php endif; ?>

            <div class="grid md:grid-cols-2 gap-6">
              <div>
                <label class="block text-sm font-medium mb-2">Email</label>
                <input type="email" name="email" value="<?= $contact['email'] ?? '' ?>" required 
                       class="w-full p-3 rounded-lg bg-gray-800 border border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
              </div>
              <div>
                <label class="block text-sm font-medium mb-2">Phone</label>
                <input type="text" name="phone" value="<?= $contact['phone'] ?? '' ?>" required 
                       class="w-full p-3 rounded-lg bg-gray-800 border border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
              </div>
            </div>

            <div>
              <label class="block text-sm font-medium mb-2">Location</label>
              <input type="text" name="location" value="<?= $contact['location'] ?? '' ?>" required 
                     class="w-full p-3 rounded-lg bg-gray-800 border border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div class="grid md:grid-cols-3 gap-6">
              <div>
                <label class="block text-sm font-medium mb-2">GitHub</label>
                <input type="url" name="github_link" value="<?= $contact['github_link'] ?? '' ?>" 
                       class="w-full p-3 rounded-lg bg-gray-800 border border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
              </div>
              <div>
                <label class="block text-sm font-medium mb-2">LinkedIn</label>
                <input type="url" name="linkedin_link" value="<?= $contact['linkedin_link'] ?? '' ?>" 
                       class="w-full p-3 rounded-lg bg-gray-800 border border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
              </div>
              <div>
                <label class="block text-sm font-medium mb-2">Facebook</label>
                <input type="url" name="facebook_link" value="<?= $contact['facebook_link'] ?? '' ?>" 
                       class="w-full p-3 rounded-lg bg-gray-800 border border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
              </div>
            </div>

            <div class="flex justify-end gap-3 pt-4">
              <a href="Contact.php" 
                 class="px-5 py-3 bg-gray-600 rounded-lg hover:bg-gray-500 transition flex items-center gap-2">
                <i class="fas fa-times"></i> Cancel
              </a>
              <button type="submit" 
                      class="px-5 py-3 <?= $contact ? 'bg-blue-600' : 'bg-green-600' ?> rounded-lg hover:opacity-90 transition flex items-center gap-2">
                <i class="fas <?= $contact ? 'fa-save' : 'fa-plus' ?>"></i> 
                <?= $contact ? 'Update Info' : 'Save Info' ?>
              </button>
            </div>
          </form>
        <?php endif; ?>
      </div>
    </section>

  </main>

  <!-- Sidebar + Mobile Nav -->
  <?php include "../component/sidebar.html"; ?>
  <?php include "../component/mobile-nav.html"; ?>
</div>
</body>
</html>
