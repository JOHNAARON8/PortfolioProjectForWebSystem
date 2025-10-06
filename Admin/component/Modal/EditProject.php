<!-- Edit Project Modal -->
<div id="editProjectModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-gray-800/90 backdrop-blur-md w-11/12 md:w-2/3 lg:w-1/2 p-6 rounded-2xl shadow-2xl border border-gray-700 relative">
        <button id="closeEditProjectModal" class="absolute top-3 right-3 text-white text-2xl hover:text-red-500">&times;</button>
        <h3 class="text-2xl font-bold mb-6 bg-clip-text text-transparent bg-gradient-to-r from-green-400 to-blue-500 text-center">
            Edit Project
        </h3>
        <form id="editProjectForm" method="POST" enctype="multipart/form-data" action="../Backends/Projects/EditProjectData.php" class="space-y-4">
            <input type="hidden" name="id" id="editProjectId">

            <input type="text" name="title" id="editProjectTitle" placeholder="Project Title" 
                class="w-full p-3 rounded-xl bg-gray-700 border border-gray-600 text-white focus:outline-none focus:ring-2 focus:ring-indigo-400" required>

            <input type="text" name="short_description" id="editProjectShortDesc" placeholder="Short Description" 
                class="w-full p-3 rounded-xl bg-gray-700 border border-gray-600 text-white focus:outline-none focus:ring-2 focus:ring-indigo-400" required>

            <textarea name="full_description" id="editProjectFullDesc" placeholder="Full Description" rows="4"
                class="w-full p-3 rounded-xl bg-gray-700 border border-gray-600 text-white focus:outline-none focus:ring-2 focus:ring-indigo-400" required></textarea>

            <input type="text" name="live_link" id="editProjectLiveLink" placeholder="Live Link" 
                class="w-full p-3 rounded-xl bg-gray-700 border border-gray-600 text-white focus:outline-none focus:ring-2 focus:ring-indigo-400">

            <input type="text" name="tools" id="editProjectTools" placeholder="Tools (comma separated)" 
                class="w-full p-3 rounded-xl bg-gray-700 border border-gray-600 text-white focus:outline-none focus:ring-2 focus:ring-indigo-400">

            <input type="file" name="cover_image" id="editProjectCoverImage" accept="image/*" 
                class="w-full p-2 rounded-xl bg-gray-700 border border-gray-600 text-white">

            <button type="submit" class="w-full bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 hover:scale-105 transition-transform duration-300 text-white px-6 py-3 rounded-xl font-semibold flex items-center justify-center">
                <i class="fas fa-save mr-2"></i> Update Project
            </button>
        </form>
    </div>
</div>

<script>
const editProjectModal = document.getElementById('editProjectModal');
const closeEditProjectModal = document.getElementById('closeEditProjectModal');

document.querySelectorAll('.editProjectBtn').forEach(button => {
    button.addEventListener('click', () => {
        const id = button.dataset.id;
        const title = button.dataset.title;
        const shortDesc = button.dataset.short;
        const fullDesc = button.dataset.full;
        const liveLink = button.dataset.link; 
        const tools = button.dataset.tools;

        document.getElementById('editProjectId').value = id;
        document.getElementById('editProjectTitle').value = title;
        document.getElementById('editProjectShortDesc').value = shortDesc;
        document.getElementById('editProjectFullDesc').value = fullDesc;
        document.getElementById('editProjectLiveLink').value = liveLink;
        document.getElementById('editProjectTools').value = tools;

        editProjectModal.classList.remove('hidden');
        editProjectModal.classList.add('flex');
    });
});

closeEditProjectModal.addEventListener('click', () => {
    editProjectModal.classList.add('hidden');
    editProjectModal.classList.remove('flex');
});

window.addEventListener('click', (e) => {
    if (e.target === editProjectModal) {
        editProjectModal.classList.add('hidden');
        editProjectModal.classList.remove('flex');
    }
});
</script>
