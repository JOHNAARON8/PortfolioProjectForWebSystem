const editModal = document.getElementById('editToolModal');
const closeModal = document.getElementById('closeEditModal');
const editForm = document.getElementById('editToolForm');

document.querySelectorAll('.editToolBtn').forEach(button => {
    button.addEventListener('click', () => {
        const id = button.dataset.id;
        const name = button.dataset.name;
        const category = button.dataset.category;
        const proficiency = button.dataset.proficiency;

        document.getElementById('editToolId').value = id;
        document.getElementById('editToolName').value = name;
        document.getElementById('editToolCategory').value = category;
        document.getElementById('editToolProficiency').value = proficiency;

        // Show modal
        editModal.classList.remove('hidden');
    });
});

closeModal.addEventListener('click', () => {
    editModal.classList.add('hidden');
});

// Close modal when clicking outside the modal content
window.addEventListener('click', (e) => {
    if (e.target === editModal) {
        editModal.classList.add('hidden');
    }
});