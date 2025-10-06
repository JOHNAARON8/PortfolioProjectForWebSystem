<!-- View Project Modal -->
<div id="projectModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black bg-opacity-50 p-4">
  <div class="bg-gray-800/90 backdrop-blur-md rounded-2xl w-full max-w-full sm:max-w-lg md:max-w-xl lg:max-w-2xl relative flex flex-col max-h-[90vh] overflow-y-auto shadow-2xl border border-gray-700">
    
    <button id="closeModal" class="absolute top-3 right-3 text-white text-3xl font-bold hover:text-red-500">&times;</button>
    
    <div class="p-6 flex flex-col space-y-4">
      <!-- Project Title -->
      <h2 class="text-3xl font-bold mb-2 text-center bg-clip-text text-transparent bg-gradient-to-r from-indigo-500 to-purple-500" id="modalTitle"></h2>
      
      <!-- Short Description -->
      <p class="text-gray-300 break-words font-medium text-justify" id="modalShort"></p>
      
      <!-- Full Description -->
      <p class="text-gray-300 break-words text-justify" id="modalFull"></p>
      
      <!-- Tools -->
      <p class="text-green-400 italic break-words" id="modalTools"></p>
      
      <!-- Live Link -->
      <p>
        <a href="#" target="_blank" class="text-blue-400 hover:underline break-words font-medium" id="modalLink">View Live Project</a>
      </p>
      
      <!-- Cover Image -->
      <img src="" alt="Project Cover" class="w-full rounded-xl object-cover border border-gray-600" id="modalImage">
    </div>
  </div>
</div>

<script>
const projectModal = document.getElementById('projectModal');
const closeModal = document.getElementById('closeModal');

document.querySelectorAll('.viewProjectBtn').forEach(button => {
  button.addEventListener('click', () => {
    document.getElementById('modalTitle').textContent = button.dataset.title;
    document.getElementById('modalShort').textContent = button.dataset.short;
    document.getElementById('modalFull').textContent = button.dataset.full;
    document.getElementById('modalTools').textContent = 'Tools: ' + button.dataset.tools;
    document.getElementById('modalLink').href = button.dataset.link || '#';
    document.getElementById('modalImage').src = button.dataset.image || '';
    
    projectModal.classList.remove('hidden');
    projectModal.classList.add('flex');
  });
});

closeModal.addEventListener('click', () => {
  projectModal.classList.add('hidden');
  projectModal.classList.remove('flex');
});

window.addEventListener('click', (e) => {
  if (e.target === projectModal) {
    projectModal.classList.add('hidden');
    projectModal.classList.remove('flex');
  }
});
</script>
