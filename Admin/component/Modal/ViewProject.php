<!-- modal-view-project.php -->
<div id="projectModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black bg-opacity-50 p-4">
  <div class="bg-[var(--card-dark)] rounded-xl w-full max-w-full sm:max-w-lg md:max-w-xl lg:max-w-2xl relative flex flex-col max-h-[90vh] overflow-y-auto">
    
    <button id="closeModal" class="absolute top-3 right-3 text-white text-2xl font-bold">&times;</button>
    
    <div class="p-6 flex flex-col space-y-4">
      <h2 class="text-2xl font-bold text-[var(--text-light)]" id="modalTitle"></h2>
      <p class="text-gray-300 break-words" id="modalShort"></p>
      
      <p class="text-gray-300 break-words" id="modalFull"></p>
      
      <p class="text-gray-300 break-words" id="modalTools"></p>
      
      <p>
        <a href="#" target="_blank" class="text-blue-400 hover:underline break-words" id="modalLink">View Live Project</a>
      </p>
      
      <img src="" alt="Project Cover" class="w-full rounded-md object-cover" id="modalImage">
    </div>
  </div>
</div>

<script>
document.querySelectorAll('.viewProjectBtn').forEach(button => {
  button.addEventListener('click', () => {
    document.getElementById('modalTitle').textContent = button.dataset.title;
    document.getElementById('modalShort').textContent = button.dataset.short;
    document.getElementById('modalFull').textContent = button.dataset.full;
    document.getElementById('modalTools').textContent = 'Tools: ' + button.dataset.tools;
    document.getElementById('modalLink').href = button.dataset.link || '#';
    document.getElementById('modalImage').src = button.dataset.image || '';
    
    document.getElementById('projectModal').classList.remove('hidden');
    document.getElementById('projectModal').classList.add('flex');
  });
});

document.getElementById('closeModal').addEventListener('click', () => {
  document.getElementById('projectModal').classList.add('hidden');
  document.getElementById('projectModal').classList.remove('flex');
});
</script>
