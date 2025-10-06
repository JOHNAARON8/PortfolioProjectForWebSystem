
<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>John Aron Cadag</title>
  <meta name="description" content="Portfolio of John Aron Cadag: full-stack developer, Network Engeener.">

  <link rel="stylesheet" href="./css/style.css">

</head>

<?php 
include "./components/include/AllScriptLink.php"; 
?>

<script src="./Js/DarkRefresh.js"></script>

<body class="bg-pink-100 dark:bg-gray-900 text-gray-800 dark:text-gray-200 transition-colors duration-500">

  <div id="particles-js" class="fixed inset-0 -z-10"></div>

  <?php include "./components/navbar.php"; ?>
  <?php include "./components/mobile-menu.php"; ?>

  <main>
      <?php 
          include "./components/hero.php";
          include "./components/about.php";
          include "./components/experience.php";
          include "./components/education.php" ;
          include "./components/skills.php";
          include "./components/projects.php" ;
          include "./components/Certificate.php";
          include "./components/contact.php";
          include "./components/footer.php";
          include "./components/Modal/projectModal.php";
          include "./components/Modal/certificateModal.php"; 
      ?>
      
  </main>

  <script src="Js/TriggerModal.js" defer></script>
  <script src="Js/SkillsAnimation.js" defer></script>
  <script src="Js/ImagesSlider.js" defer></script>
  <script src="js/TypingEffect.js" defer></script>
  <script src="js/TriggerMobileMenu.js" defer></script>
  <script src="js/DarkToggle.js" defer></script>
  <script src="js/main.js" defer></script>
  <script src="js/Alert.js" defer></script>

</body>
</html>  