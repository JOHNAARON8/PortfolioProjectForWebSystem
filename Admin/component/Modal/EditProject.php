<!-- Edit Project Modal -->
<div id="editProjectModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-[var(--card-dark)] w-11/12 md:w-2/3 lg:w-1/2 p-6 rounded-xl shadow-lg relative">
        <button id="closeEditProjectModal" class="absolute top-3 right-3 text-white text-xl hover:text-red-500">&times;</button>
        <h3 class="text-xl font-semibold text-white mb-4">Edit Project</h3>
        <form id="editProjectForm" method="POST" enctype="multipart/form-data" action="../Backends/Projects/EditProjectData.php" class="space-y-4">
            <input type="hidden" name="id" id="editProjectId">

            <input type="text" name="title" id="editProjectTitle" placeholder="Project Title" 
                class="w-full p-2 rounded bg-gray-700 border border-gray-600 text-white" required>

            <input type="text" name="short_description" id="editProjectShortDesc" placeholder="Short Description" 
                class="w-full p-2 rounded bg-gray-700 border border-gray-600 text-white" required>

            <textarea name="full_description" id="editProjectFullDesc" placeholder="Full Description" rows="4"
                class="w-full p-2 rounded bg-gray-700 border border-gray-600 text-white" required></textarea>

            <input type="text" name="live_link" id="editProjectLiveLink" placeholder="Live Link" 
                class="w-full p-2 rounded bg-gray-700 border border-gray-600 text-white">

            <input type="text" name="tools" id="editProjectTools" placeholder="Tools (comma separated)" 
                class="w-full p-2 rounded bg-gray-700 border border-gray-600 text-white">

            <input type="file" name="cover_image" id="editProjectCoverImage" accept="image/*" 
                class="w-full p-2 rounded bg-gray-700 border border-gray-600 text-white">

            <button type="submit" class="bg-blue-500 hover:bg-blue-600 px-4 py-2 rounded text-white font-semibold w-full">
                <i class="fas fa-save mr-2"></i> Update Project
            </button>
        </form>
    </div>
</div>

<!-- JavaScript to handle modal -->
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
