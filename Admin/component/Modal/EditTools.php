<!-- EditToolModal.php -->
<div id="editToolModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
    <div class="bg-gray-800 p-6 rounded-xl w-full max-w-md relative">
        <button id="closeEditModal" class="absolute top-2 right-2 text-gray-400 hover:text-white">
            <i class="fas fa-times"></i>
        </button>
        <h3 class="text-lg font-semibold mb-4">Edit Tool</h3>
        <form id="editToolForm" method="POST" enctype="multipart/form-data" action="../Backends/Tools/UpdateTools.php" class="space-y-3">
            <input type="hidden" name="id" id="editToolId">

            <input type="text" name="name" id="editToolName" placeholder="Tool Name" 
                   class="w-full p-2 rounded bg-gray-700 border border-gray-600" required>

            <select name="category" id="editToolCategory" class="w-full p-2 rounded bg-gray-700 border border-gray-600" required>
                <option value="">Select Category</option>
                <option value="Frontend">Frontend</option>
                <option value="Backend">Backend</option>
                <option value="Databases">Databases</option>
                <option value="Tools & Others">Tools & Others</option>
            </select>

            <input type="number" name="proficiency" id="editToolProficiency" placeholder="Proficiency % (0-100)" min="0" max="100"
                   class="w-full p-2 rounded bg-gray-700 border border-gray-600" required>

            <input type="file" name="icon" accept="image/*" class="w-full p-2 rounded bg-gray-700 border border-gray-600">

            <button type="submit" class="bg-green-500 hover:bg-green-600 px-4 py-2 rounded text-white font-semibold w-full">
                <i class="fas fa-save mr-2"></i> Update Tool
            </button>
        </form>
    </div>
</div>
