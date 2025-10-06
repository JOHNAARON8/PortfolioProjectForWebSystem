<?php 
include "../Backends/Session.php";
include "../Backends/Auth/ChangePassword.php"
?>

<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Portfolio Dashboard</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="../Css/globalStyle.css">
</head>
<body class="bg-[var(--bg-dark)] text-[var(--text-light)] font-sans">

<div class="flex h-screen">
  <main class="flex-1 overflow-y-auto p-4 md:p-8 md:mr-20">
    <h1 class="text-2xl font-semibold mb-6">⚙️ Settings</h1>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
      <div class="bg-[var(--card-dark)] rounded-xl shadow p-6">
        <h2 class="text-xl font-semibold mb-4 flex items-center">
          <i class="fa-solid fa-user-gear mr-2 text-red-500"></i> Account Information
        </h2>

        <form action="" method="POST" enctype="multipart/form-data" class="space-y-4">
          <div>
            <label class="block mb-1 font-medium">User Name</label>
            <input type="text" name="userName" value="<?= htmlspecialchars($user['userName']) ?>" 
              class="w-full p-2 rounded-lg bg-gray-800 border border-gray-700 focus:border-red-500 focus:ring-1 focus:ring-red-500 outline-none">
          </div>

          <div>
            <label class="block mb-1 font-medium">Password (leave empty to keep current)</label>
            <input type="password" name="password" 
              class="w-full p-2 rounded-lg bg-gray-800 border border-gray-700 focus:border-red-500 focus:ring-1 focus:ring-red-500 outline-none">
          </div>

          <div>
            <label class="block mb-1 font-medium">Recovery Name</label>
            <input type="text" name="recoveryName" value="<?= htmlspecialchars($user['recoveryName']) ?>" 
              class="w-full p-2 rounded-lg bg-gray-800 border border-gray-700 focus:border-red-500 focus:ring-1 focus:ring-red-500 outline-none">
          </div>

          <button type="submit" class="px-4 py-2 bg-red-600 hover:bg-red-700 rounded-lg font-semibold transition">
            <i class="fa-solid fa-save mr-2"></i> Save Changes
          </button>
        </form>
      </div>
    </div>
  </main>

  <?php include "../component/sidebar.html"; ?>
  <?php include "../component/mobile-nav.html"; ?>
</div>
</body>


<?php if (isset($_SESSION['flash_message'])): ?>
      <script>
        Swal.fire({
          icon: '<?= $_SESSION['flash_type'] ?>', 
          title: '<?= $_SESSION['flash_message'] ?>',
          showConfirmButton: false,
          timer: 2000
        });
      </script>
      <?php unset($_SESSION['flash_message'], $_SESSION['flash_type']); ?>
<?php endif; ?>

</html>
