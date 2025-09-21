<?php
include "../Backends/DatabaseConnection.php";

// Fetch counts for dashboard
$introCount = $conn->query("SELECT COUNT(*) AS count FROM introduction")->fetch_assoc()['count'];
$projectsCount = $conn->query("SELECT COUNT(*) AS count FROM projects")->fetch_assoc()['count'];
$educationCount = $conn->query("SELECT COUNT(*) AS count FROM education")->fetch_assoc()['count'];
$experienceCount = $conn->query("SELECT COUNT(*) AS count FROM experiences")->fetch_assoc()['count'];
$skillsCount = $conn->query("SELECT COUNT(*) AS count FROM skills")->fetch_assoc()['count'];
$toolsCount = $conn->query("SELECT COUNT(*) AS count FROM tools")->fetch_assoc()['count'];
?>

<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Portfolio Dashboard</title>
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
  <main class="flex-1 overflow-y-auto p-4 md:p-8 md:mr-20">
    <section class="py-12">
      <h1 class="text-3xl font-bold text-center mb-12 bg-gradient-to-r from-indigo-500 to-purple-500 bg-clip-text text-transparent">
        Portfolio Dashboard
      </h1>

      <!-- Dashboard Cards -->
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- Introduction -->
        <div class="bg-[var(--card-dark)] rounded-xl shadow p-6 flex flex-col items-center justify-center">
          <i class="fas fa-user text-4xl text-indigo-400 mb-2"></i>
          <h2 class="text-xl font-semibold mb-1">Introduction</h2>
          <p class="text-lg mb-2"><?= $introCount ?> Entry(s)</p>
          <a href="ManageIntroduction.php" class="text-blue-400 hover:underline text-sm">Manage</a>
        </div>

        <!-- Projects -->
        <div class="bg-[var(--card-dark)] rounded-xl shadow p-6 flex flex-col items-center justify-center">
          <i class="fas fa-diagram-project text-4xl text-green-400 mb-2"></i>
          <h2 class="text-xl font-semibold mb-1">Projects</h2>
          <p class="text-lg mb-2"><?= $projectsCount ?> Project(s)</p>
          <a href="ManageProjects.php" class="text-blue-400 hover:underline text-sm">Manage</a>
        </div>

        <!-- Education -->
        <div class="bg-[var(--card-dark)] rounded-xl shadow p-6 flex flex-col items-center justify-center">
          <i class="fas fa-graduation-cap text-4xl text-yellow-400 mb-2"></i>
          <h2 class="text-xl font-semibold mb-1">Education</h2>
          <p class="text-lg mb-2"><?= $educationCount ?> Entry(s)</p>
          <a href="ManageEducation.php" class="text-blue-400 hover:underline text-sm">Manage</a>
        </div>

        <!-- Experience -->
        <div class="bg-[var(--card-dark)] rounded-xl shadow p-6 flex flex-col items-center justify-center">
          <i class="fas fa-briefcase text-4xl text-red-400 mb-2"></i>
          <h2 class="text-xl font-semibold mb-1">Experience</h2>
          <p class="text-lg mb-2"><?= $experienceCount ?> Entry(s)</p>
          <a href="ManageExperience.php" class="text-blue-400 hover:underline text-sm">Manage</a>
        </div>

        <!-- Skills -->
        <div class="bg-[var(--card-dark)] rounded-xl shadow p-6 flex flex-col items-center justify-center">
          <i class="fas fa-code text-4xl text-purple-400 mb-2"></i>
          <h2 class="text-xl font-semibold mb-1">Skills</h2>
          <p class="text-lg mb-2"><?= $skillsCount ?> Skill(s)</p>
          <a href="ManageSkills.php" class="text-blue-400 hover:underline text-sm">Manage</a>
        </div>

        <!-- Tools -->
        <div class="bg-[var(--card-dark)] rounded-xl shadow p-6 flex flex-col items-center justify-center">
          <i class="fas fa-toolbox text-4xl text-pink-400 mb-2"></i>
          <h2 class="text-xl font-semibold mb-1">Tools</h2>
          <p class="text-lg mb-2"><?= $toolsCount ?> Tool(s)</p>
          <a href="ManageTools.php" class="text-blue-400 hover:underline text-sm">Manage</a>
        </div>
      </div>
    </section>
  </main>

  <!-- Sidebar and Mobile Nav -->
  <?php include "../component/sidebar.html"; ?>
  <?php include "../component/mobile-nav.html"; ?>

</div>
</body>
</html>
