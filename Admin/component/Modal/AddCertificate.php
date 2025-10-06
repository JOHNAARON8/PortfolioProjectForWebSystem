<div id="addCertModal" class="fixed inset-0 bg-black bg-opacity-60 flex items-center justify-center hidden z-50">
  <div class="bg-gradient-to-br from-indigo-600 to-purple-600 dark:from-gray-800 dark:to-gray-900 rounded-2xl w-full max-w-md p-6 relative shadow-2xl">
    <h3 class="text-2xl font-bold mb-6 text-white text-center">Add Certification</h3>
    <form id="addCertForm" method="POST" action="../Backends/Certificate/AddCer.php" enctype="multipart/form-data" class="space-y-4">

      <div>
        <label class="block text-white font-semibold mb-1">Certification Name</label>
        <input type="text" name="cert_name" class="w-full border border-gray-300 rounded-md p-2 bg-white text-gray-900 focus:ring-2 focus:ring-indigo-400 focus:outline-none" required>
      </div>

      <div>
        <label class="block text-white font-semibold mb-1">Issuing Organization</label>
        <input type="text" name="issuing_organization" class="w-full border border-gray-300 rounded-md p-2 bg-white text-gray-900 focus:ring-2 focus:ring-indigo-400 focus:outline-none" required>
      </div>

      <div>
        <label class="block text-white font-semibold mb-1">Issue Date</label>
        <input type="date" name="issue_date" class="w-full border border-gray-300 rounded-md p-2 bg-white text-gray-900 focus:ring-2 focus:ring-indigo-400 focus:outline-none" required>
      </div>

      <div>
        <label class="block text-white font-semibold mb-1">Expiration Date (Optional)</label>
        <input type="date" name="expiration_date" class="w-full border border-gray-300 rounded-md p-2 bg-white text-gray-900 focus:ring-2 focus:ring-indigo-400 focus:outline-none">
      </div>

      <div>
        <label class="block text-white font-semibold mb-1">Certificate File (Optional)</label>
        <input type="file" name="certificate_file" class="w-full text-gray-900 bg-white rounded-md">
      </div>

      <div class="flex justify-end gap-3 mt-6">
        <button type="button" id="closeAddCertModal" class="px-5 py-2 rounded-lg bg-gray-300 text-gray-800 hover:bg-gray-400 transition">Cancel</button>
        <button type="submit" class="px-5 py-2 rounded-lg bg-gradient-to-r from-green-400 to-blue-500 text-white font-semibold hover:from-green-500 hover:to-blue-600 transition">Add</button>
      </div>

    </form>
  </div>
</div>

<script>
  const modal = document.getElementById('addCertModal');
  document.getElementById('openAddCertModal').addEventListener('click', () => modal.classList.remove('hidden'));
  document.getElementById('closeAddCertModal').addEventListener('click', () => modal.classList.add('hidden'));
</script>
