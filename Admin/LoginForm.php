<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Admin Login | John Aron Cadag Portfolio</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    :root {
      --primary-color: #7f00ff;
      --primary-color-dark: #5a00b3;
    }
  </style>
</head>
<body class="bg-gradient-to-br from-gray-900 via-gray-800 to-black flex items-center justify-center min-h-screen px-4">

  <div class="w-full max-w-md bg-gray-800/80 backdrop-blur-md rounded-3xl shadow-2xl p-8 sm:p-10 border border-gray-700 transition-all duration-300 hover:scale-[1.01]">
    
    <div class="text-center mb-8">
      <div class="flex items-center justify-center w-24 h-24 mx-auto rounded-full ring-4 ring-[var(--primary-color)] shadow-xl transition-transform duration-300 hover:scale-105">
        <img class="rounded-full " src="./Asset/profile.png" alt="Profile">
      </div>
      <h1 class="text-3xl sm:text-4xl font-bold text-white mt-4">Admin Login</h1>
      <p class="text-gray-400 text-sm sm:text-base mt-2">
        <?php
        session_start();
        if (!isset($_SESSION['attempts'])) $_SESSION['attempts'] = 0;
        if ($_SESSION['attempts'] < 3) {
            echo "Log in using your <span class='text-[var(--primary-color)] font-semibold'>Username</span> or <span class='text-[var(--primary-color)] font-semibold'>Recovery Name</span>.";
        } else {
            echo "Too many failed attempts. Use your <span class='text-[var(--primary-color)] font-semibold'>Recovery Name</span> to continue.";
        }
        ?>
      </p>
    </div>

    <?php
    if (isset($_SESSION['error'])) {
        echo '<div class="mb-4 p-3 rounded-lg bg-red-600/80 text-white text-sm text-center animate-pulse">'.$_SESSION['error'].'</div>';
        unset($_SESSION['error']);
    }
    ?>

    <?php if ($_SESSION['attempts'] < 3): ?>
    <form action="./Backends/Auth/AdminLogin.php" method="POST" class="space-y-6">
      <div>
        <label for="username" class="block text-gray-300 text-sm mb-2">Username or Recovery Name</label>
        <div class="relative">
          <i class="fas fa-user absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
          <input type="text" id="username" name="username" required
            placeholder="Enter Username or Recovery Name"
            class="w-full pl-12 pr-4 py-3 rounded-xl bg-gray-900 text-white border border-gray-600 focus:ring-2 focus:ring-[var(--primary-color)] focus:outline-none transition duration-300 placeholder-gray-500">
        </div>
      </div>

      <div>
        <label for="password" class="block text-gray-300 text-sm mb-2">Password</label>
        <div class="relative">
          <i class="fas fa-lock absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
          <input type="password" id="password" name="password" required
            placeholder="Enter Password"
            class="w-full pl-12 pr-4 py-3 rounded-xl bg-gray-900 text-white border border-gray-600 focus:ring-2 focus:ring-[var(--primary-color)] focus:outline-none transition duration-300 placeholder-gray-500">
        </div>
      </div>

      <button type="submit"
        class="w-full py-3 rounded-xl bg-gradient-to-r from-purple-600 via-indigo-600 to-pink-500 text-white font-semibold hover:scale-105 hover:brightness-110 shadow-lg transition duration-300">
        Login to Admin Panel
      </button>
    </form>
    <?php else: ?>
    
    <form action="./Backends/Auth/RecoveryLogin.php" method="POST" class="space-y-6">
      <div>
        <label for="recoveryName" class="block text-gray-300 text-sm mb-2">Recovery Name</label>
        <div class="relative">
          <i class="fas fa-key absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
          <input type="text" id="recoveryName" name="recoveryName" required
            placeholder="Enter Recovery Name"
            class="w-full pl-12 pr-4 py-3 rounded-xl bg-gray-900 text-white border border-gray-600 focus:ring-2 focus:ring-[var(--primary-color)] focus:outline-none transition duration-300 placeholder-gray-500">
        </div>
      </div>

      <button type="submit"
        class="w-full py-3 rounded-xl bg-gradient-to-r from-purple-600 via-indigo-600 to-pink-500 text-white font-semibold hover:scale-105 hover:brightness-110 shadow-lg transition duration-300">
        Login with Recovery Name
      </button>
    </form>
    <?php endif; ?>

    <p class="text-center text-gray-500 text-xs sm:text-sm mt-8">
      © 2025 John Aron Cadag Portfolio. All rights reserved.
    </p>
  </div>

</body>
</html>
