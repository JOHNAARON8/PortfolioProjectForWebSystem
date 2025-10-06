<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
session_unset();
session_destroy();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Logging Out...</title>
  <script src="https://cdn.tailwindcss.com"></script>

  <meta http-equiv="refresh" content="2;url=../../LoginForm.php">

  <style>
    .loader {
      border: 6px solid #f3f3f3;
      border-top: 6px solid #ef4444;
      border-radius: 50%;
      width: 60px;
      height: 60px;
      animation: spin 1s linear infinite;
    }

    @keyframes spin {
      0% { transform: rotate(0deg); }
      100% { transform: rotate(360deg); }
    }

    .fade-text {
      animation: fadeIn 1.2s ease-in-out infinite alternate;
    }

    @keyframes fadeIn {
      from { opacity: 0.3; }
      to { opacity: 1; }
    }
  </style>
</head>
<body class="bg-gray-900 flex items-center justify-center min-h-screen">

  <div class="text-center">
    <div class="loader mx-auto"></div>
    <p class="text-white text-lg mt-6 fade-text">Logging you out...</p>
  </div>

</body>
</html>
