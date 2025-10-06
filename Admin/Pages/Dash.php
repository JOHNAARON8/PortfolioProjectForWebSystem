<?php
include "../Backends/Session.php";
include "../Backends/Dashboard/CountData.php";
include "../Backends/Dashboard/FitchProg.php";
?>

<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Portfolio Dashboard</title>

  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="../Css/globalStyle.css">
  <link rel="stylesheet" href="../Css/Dash.css">

</head>
<body class="bg-[var(--bg-dark)] text-[var(--text-light)] font-sans">

<div class="flex h-screen overflow-hidden">

  <main class="flex-1 overflow-y-auto p-6 md:p-10 md:mr-20">
    <section class="py-12">
      <h1 class="text-5xl font-extrabold text-center mb-14 gradient-text drop-shadow-lg">
        Portfolio Dashboard
      </h1>
      
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">

        <?php 
        $cards = [
          ['icon'=>'fas fa-user','title'=>'Introduction','count'=>$introCount,'link'=>'./Intro.php','color'=>'text-indigo-400'],
          ['icon'=>'fas fa-diagram-project','title'=>'Projects','count'=>$projectsCount,'link'=>'./Project.php','color'=>'text-green-400'],
          ['icon'=>'fas fa-graduation-cap','title'=>'Education','count'=>$educationCount,'link'=>'./Education.php','color'=>'text-yellow-400'],
          ['icon'=>'fas fa-briefcase','title'=>'Experience','count'=>$experienceCount,'link'=>'Experience.php','color'=>'text-red-400'],
          ['icon'=>'fas fa-code','title'=>'Skills','count'=>$skillsCount,'link'=>'About.php','color'=>'text-purple-400'],
          ['icon'=>'fas fa-toolbox','title'=>'Tools','count'=>$toolsCount,'link'=>'Tools.php','color'=>'text-pink-400'],
        ];

        foreach($cards as $card): ?>
        <div class="bg-gradient-to-br from-gray-800 to-gray-900 rounded-2xl shadow-2xl p-6 flex flex-col items-center justify-center card-hover hover:shadow-indigo-500/50">
          <i class="<?= $card['icon'] ?> text-5xl <?= $card['color'] ?> mb-3"></i>
          <h2 class="text-2xl font-semibold mb-1"><?= $card['title'] ?></h2>
          <p class="text-lg mb-3 font-medium text-gray-300"><?= $card['count'] ?> <?= $card['title']==='Projects'?'Project(s)':'Entry(s)' ?></p>
          <a href="<?= $card['link'] ?>" class="text-indigo-400 hover:text-indigo-300 font-semibold transition-colors duration-300">Manage</a>
        </div>
        <?php endforeach; ?>
      </div>

      <div class="mt-16 bg-gradient-to-tr from-gray-900 to-gray-800 rounded-2xl shadow-2xl p-6 mb-40">
        <h2 class="text-3xl font-bold mb-6 text-center gradient-text">Projects Created Over the Past Week</h2>
        <canvas id="projectsChart" class="w-full h-80 rounded-xl"></canvas>
      </div>
    </section>
  </main>
  

  <?php include "../component/sidebar.html"; ?>
  <?php include "../component/mobile-nav.html"; ?>
  
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  
  <?php include "../Js/php/DashProgressChart.php" ?>
  
          

</div>
</body>
</html>
