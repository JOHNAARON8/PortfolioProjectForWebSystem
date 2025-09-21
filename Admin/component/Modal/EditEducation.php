<!-- Edit Education Modal -->
<div id="editEducationModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="bg-[var(--card-dark)] w-full max-w-lg p-6 rounded-xl relative shadow-lg">
        <button id="closeEditEducationModal" class="absolute top-3 right-3 text-white text-lg font-bold hover:text-red-500">
            &times;
        </button>
        <h3 class="text-xl font-semibold mb-4 text-[var(--text-light)]">Edit Education</h3>
        <form id="editEducationForm" method="POST" enctype="multipart/form-data" action="../Backends/Education/UpdateEducationData.php" class="space-y-4">
            <input type="hidden" name="id" id="editEduId">

            <input type="text" name="level" id="editEduLevel" placeholder="Education Level" 
                class="w-full p-2 rounded bg-gray-700 border border-gray-600 text-[var(--text-light)]" required>

            <input type="text" name="school_name" id="editEduSchool" placeholder="School Name" 
                class="w-full p-2 rounded bg-gray-700 border border-gray-600 text-[var(--text-light)]" required>

            <div class="flex flex-col md:flex-row gap-4">
                <input type="number" name="start_year" id="editEduStart" placeholder="Start Year" min="1900" max="2099"
                    class="w-full md:w-1/2 p-2 rounded bg-gray-700 border border-gray-600 text-[var(--text-light)]" required>
                <input type="number" name="end_year" id="editEduEnd" placeholder="End Year" min="1900" max="2099"
                    class="w-full md:w-1/2 p-2 rounded bg-gray-700 border border-gray-600 text-[var(--text-light)]" required>
            </div>

            <textarea name="description" id="editEduDescription" placeholder="Description / Achievements" rows="4"
                class="w-full p-2 rounded bg-gray-700 border border-gray-600 text-[var(--text-light)]" required></textarea>

            <input type="file" name="image" id="editEduImage" accept="image/*" 
                class="w-full p-2 rounded bg-gray-700 border border-gray-600 text-[var(--text-light)]">

            <button type="submit" class="w-full md:w-auto bg-blue-500 hover:bg-blue-600 px-4 py-2 rounded text-white font-semibold">
                <i class="fas fa-save mr-2"></i> Update Education
            </button>
        </form>
    </div>
</div>

<script>
    const editEducationModal = document.getElementById('editEducationModal');
    const closeEditEducationModal = document.getElementById('closeEditEducationModal');
    const editEducationForm = document.getElementById('editEducationForm');

    document.querySelectorAll('.editEduBtn').forEach(button => {
        button.addEventListener('click', () => {
            const id = button.dataset.id;
            const level = button.dataset.level;
            const school = button.dataset.school;
            const start = button.dataset.start;
            const end = button.dataset.end;
            const description = button.dataset.description;

            document.getElementById('editEduId').value = id;
            document.getElementById('editEduLevel').value = level;
            document.getElementById('editEduSchool').value = school;
            document.getElementById('editEduStart').value = start;
            document.getElementById('editEduEnd').value = end;
            document.getElementById('editEduDescription').value = description;

            editEducationModal.classList.remove('hidden');
        });
    });

    closeEditEducationModal.addEventListener('click', () => {
        editEducationModal.classList.add('hidden');
    });

    window.addEventListener('click', (e) => {
        if (e.target === editEducationModal) {
            editEducationModal.classList.add('hidden');
        }
    });
</script>
