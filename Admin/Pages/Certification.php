<?php
include "../Backends/Certificate/FectData.php"
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Portfolio Dashboard - Certification</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="../Css/globalStyle.css">
</head>
<body class="bg-gray-900 text-white font-sans">

<div class="flex h-screen">

<main class="flex-1 overflow-y-auto p-4 md:p-8 md:mr-20 pb-24 md:pb-8">

    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl sm:text-3xl font-bold bg-gradient-to-r from-pink-500 via-purple-500 to-indigo-500 bg-clip-text text-transparent px-3 py-1 truncate">
            My Certifications
        </h1>

        <button 
            id="openAddCertModal" 
            class="bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition
                text-sm sm:text-base px-3 py-1"
        >
            Add Certification
        </button>

    </div>

    <div class="space-y-6">
        <?php foreach ($certifications as $cert): ?>
            <div class="bg-gray-800 p-6 rounded-lg shadow-md flex justify-between items-center">
                <div>
                    <h3 class="text-lg font-semibold text-white">
                        <?= htmlspecialchars($cert['cert_name']) ?>
                    </h3>
                    <p class="text-sm text-gray-400">
                        <?= htmlspecialchars($cert['issuing_organization']) ?> • <?= htmlspecialchars($cert['issue_date']) ?>
                    </p>
                    <?php if ($cert['expiration_date']): ?>
                        <p class="text-sm text-red-400">
                            Expires: <?= htmlspecialchars($cert['expiration_date']) ?>
                        </p>
                    <?php endif; ?>
                    <p class="text-xs mt-1 text-gray-500">
                        Status: <?= htmlspecialchars($cert['status']) ?>
                    </p>
                </div>

    
                <div class="flex gap-3">

                    <!-- Edit Button -->
                    <button 
                        class="bg-yellow-500 text-white w-10 h-10 flex items-center justify-center rounded-md hover:bg-yellow-600 transition edit-cert-btn" 
                        data-id="<?= $cert['id'] ?>"
                    >
                        <i class="fas fa-edit"></i>
                    </button>

                    <!-- Delete Button -->
                    <form 
                        method="POST" 
                        action="../Backends/Certificate/DeleteCert.php" 
                        onsubmit="return confirm('Are you sure you want to delete this certification?');"
                    >
                        <input type="hidden" name="id" value="<?= $cert['id'] ?>">
                        <button 
                            class="bg-red-600 text-white w-10 h-10 flex items-center justify-center rounded-md hover:bg-red-700 transition"
                        >
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</main>
</div>

<?php include "../component/sidebar.html"; ?>
<?php include "../component/mobile-nav.html"; ?>

<?php include "../component/Modal/AddCertificate.php"; ?>
<?php include "../component/Modal/EditCertificate.php"; ?>

</body>
</html>
