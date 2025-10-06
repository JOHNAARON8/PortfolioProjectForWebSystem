<?php 
include "../Backends/Session.php";
include "../Backends/Projects/FetchProjectData.php"; 
?>

<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Manage Projects</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900 text-white font-sans">

<div class="flex h-screen">

<main class="flex-1 overflow-y-auto p-4 md:p-8 md:mr-20 pb-24 md:pb-8">

    <section id="project-management" class="py-20">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold mb-12 bg-gradient-to-r from-pink-500 via-purple-500 to-indigo-500 bg-clip-text text-transparent text-center">
                Manage Projects
            </h2>

            <!-- Add New Project Form -->
            <div class="bg-gray-800/80 backdrop-blur-md p-6 rounded-2xl shadow-2xl border border-gray-700 mb-10">
            <h3 class="text-2xl font-semibold mb-4 bg-clip-text text-transparent bg-gradient-to-r from-green-400 to-blue-500">
                Add New Project
            </h3>
            <form method="POST" enctype="multipart/form-data" action="../Backends/Projects/CreateProjectData.php" class="space-y-4">
                <input type="text" name="title" placeholder="Project Title" 
                class="w-full p-3 rounded-xl bg-gray-700 border border-gray-600 text-white focus:outline-none focus:ring-2 focus:ring-indigo-400" required>

                <input type="text" name="short_description" placeholder="Short Description" 
                class="w-full p-3 rounded-xl bg-gray-700 border border-gray-600 text-white focus:outline-none focus:ring-2 focus:ring-indigo-400" required>

                <textarea name="full_description" placeholder="Full Description" rows="4" 
                class="w-full p-3 rounded-xl bg-gray-700 border border-gray-600 text-white focus:outline-none focus:ring-2 focus:ring-indigo-400" required></textarea>

                <input type="text" name="live_link" placeholder="Live Project Link (optional)" 
                class="w-full p-3 rounded-xl bg-gray-700 border border-gray-600 text-white focus:outline-none focus:ring-2 focus:ring-indigo-400">

                <input type="file" name="cover_image" accept="image/*" 
                class="w-full p-2 rounded-xl bg-gray-700 border border-gray-600 text-white">

                <input type="text" name="tools" placeholder="Tools used (separate by comma)" 
                class="w-full p-3 rounded-xl bg-gray-700 border border-gray-600 text-white focus:outline-none focus:ring-2 focus:ring-indigo-400">

                <button type="submit" class="w-full sm:w-auto bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 text-white px-6 py-2 rounded-xl font-semibold hover:scale-105 transition-transform duration-300 flex items-center justify-center">
                    <i class="fas fa-plus mr-2"></i> Add Project
                </button>
            </form>
            </div>

            <!-- Existing Projects Table -->
            <div class="bg-gray-800/80 backdrop-blur-md p-6 rounded-2xl shadow-2xl border border-gray-700 overflow-x-auto">
            <h3 class="text-2xl font-semibold mb-4 bg-clip-text text-transparent bg-gradient-to-r from-yellow-400 to-red-500">
                Existing Projects
            </h3>
            <table class="min-w-full text-left border-collapse text-white">
                <thead>
                <tr class="border-b border-gray-600">
                    <th class="p-2">Title</th> 
                    <th class="p-2 hidden md:table-cell">Tools</th>
                    <th class="p-2">Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($projects as $proj): ?>
                <tr class="border-b border-gray-700 hover:bg-gray-700">
                    <td class="p-2"><?= htmlspecialchars($proj['title']) ?></td>
                    <td class="p-2 hidden md:table-cell">
                    <?php 
                    $toolsList = $projectTools[$proj['id']] ?? [];
                    echo htmlspecialchars(implode(', ', array_column($toolsList, 'tool_name')));
                    ?>
                    </td>
                    <td class="p-2 flex flex-wrap gap-2">
                        
                    <!-- View Button -->
                    <button class="bg-blue-500 hover:bg-blue-600 w-full sm:w-20 h-10 rounded-xl text-white text-sm flex items-center justify-center viewProjectBtn"
                            data-id="<?= $proj['id'] ?>"
                            data-title="<?= htmlspecialchars($proj['title']) ?>"
                            data-short="<?= htmlspecialchars($proj['short_description']) ?>"
                            data-full="<?= htmlspecialchars($proj['full_description']) ?>"
                            data-link="<?= htmlspecialchars($proj['live_link']) ?>"
                            data-tools="<?= htmlspecialchars(implode(',', array_column($toolsList, 'tool_name'))) ?>"
                            data-image="<?= htmlspecialchars($proj['cover_image']) ?>">
                        <i class="fas fa-eye mr-1"></i> View
                    </button>

                    <!-- Edit Button -->
                    <button class="bg-yellow-500 hover:bg-yellow-600 w-full sm:w-20 h-10 rounded-xl text-white text-sm flex items-center justify-center editProjectBtn"
                            data-id="<?= $proj['id'] ?>"
                            data-title="<?= htmlspecialchars($proj['title']) ?>"
                            data-short="<?= htmlspecialchars($proj['short_description']) ?>"
                            data-full="<?= htmlspecialchars($proj['full_description']) ?>"
                            data-link="<?= htmlspecialchars($proj['live_link']) ?>"
                            data-tools="<?= htmlspecialchars(implode(',', array_column($toolsList, 'tool_name'))) ?>">
                        <i class="fas fa-edit mr-1"></i> Edit
                    </button>

                    <!-- Delete Button -->
                    <form method="POST" action="../Backends/Projects/DeleteProjectData.php" onsubmit="return confirm('Are you sure?');" class="w-full sm:w-auto">
                        <input type="hidden" name="id" value="<?= $proj['id'] ?>">
                        <button type="submit" class="bg-red-600 hover:bg-red-700 w-full sm:w-20 h-10 rounded-xl text-white text-sm flex items-center justify-center">
                        <i class="fas fa-trash-alt mr-1"></i> Delete
                        </button>
                    </form>
                    </td>
                </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
            </div>
        </div>
    </section>

</main>

<!-- Sidebar, Navbar, and Modals -->
<?php include "../component/sidebar.html"; ?>
<?php include "../component/mobile-nav.html"; ?>
<?php include "../component/Modal/ViewProject.php"; ?>
<?php include "../component/Modal/EditProject.php"; ?>

</div>
</body>
</html>
