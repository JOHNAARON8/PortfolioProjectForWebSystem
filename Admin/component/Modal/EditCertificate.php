<div id="editCertModal" class="fixed inset-0 bg-black bg-opacity-60 flex items-center justify-center hidden z-50">
  <div class="bg-gradient-to-br from-indigo-600 to-purple-600 dark:from-gray-800 dark:to-gray-900 rounded-2xl w-full max-w-md p-6 relative shadow-2xl">
    <h3 class="text-2xl font-bold mb-6 text-white text-center">Edit Certification</h3>
    <form id="editCertForm" method="POST" action="../Backends/Certificate/UpdateCert.php" enctype="multipart/form-data" class="space-y-4">
      <input type="hidden" name="id" id="editCertId">

      <div>
        <label class="block text-white font-semibold mb-1">Certification Name</label>
        <input type="text" name="cert_name" id="editCertName" class="w-full border border-gray-300 rounded-md p-2 bg-white text-gray-900 focus:ring-2 focus:ring-indigo-400 focus:outline-none" required>
      </div>

      <div>
        <label class="block text-white font-semibold mb-1">Issuing Organization</label>
        <input type="text" name="issuing_organization" id="editIssuingOrg" class="w-full border border-gray-300 rounded-md p-2 bg-white text-gray-900 focus:ring-2 focus:ring-indigo-400 focus:outline-none" required>
      </div>

      <div>
        <label class="block text-white font-semibold mb-1">Issue Date</label>
        <input type="date" name="issue_date" id="editIssueDate" class="w-full border border-gray-300 rounded-md p-2 bg-white text-gray-900 focus:ring-2 focus:ring-indigo-400 focus:outline-none" required>
      </div>

      <div>
        <label class="block text-white font-semibold mb-1">Expiration Date (Optional)</label>
        <input type="date" name="expiration_date" id="editExpirationDate" class="w-full border border-gray-300 rounded-md p-2 bg-white text-gray-900 focus:ring-2 focus:ring-indigo-400 focus:outline-none">
      </div>

      <div>
        <label class="block text-white font-semibold mb-1">Certificate File (Optional - Upload to Replace)</label>
        <input type="file" name="certificate_file" class="w-full text-gray-900 bg-white rounded-md">
      </div>

      <div class="flex justify-end gap-3 mt-6">
        <button type="button" id="closeEditCertModal" class="px-5 py-2 rounded-lg bg-gray-300 text-gray-800 hover:bg-gray-400 transition">Cancel</button>
        <button type="submit" class="px-5 py-2 rounded-lg bg-gradient-to-r from-green-400 to-blue-500 text-white font-semibold hover:from-green-500 hover:to-blue-600 transition">Update</button>
      </div>
    </form>
  </div>
</div>


<script>
const editModal = document.getElementById('editCertModal');

document.querySelectorAll('.edit-cert-btn').forEach(btn => {
  btn.addEventListener('click', () => {
    const certId = btn.dataset.id;
    const card = btn.closest('div.bg-gray-800');
    const name = card.querySelector('h3').innerText;
    const org = card.querySelector('p.text-gray-400').innerText.split('•')[0].trim();
    const issue = card.querySelector('p.text-gray-400').innerText.split('•')[1].trim();
    const expEl = card.querySelector('p.text-red-400');
    const exp = expEl ? expEl.innerText.replace('Expires: ', '') : '';

    document.getElementById('editCertId').value = certId;
    document.getElementById('editCertName').value = name;
    document.getElementById('editIssuingOrg').value = org;
    document.getElementById('editIssueDate').value = issue;
    document.getElementById('editExpirationDate').value = exp;

    editModal.classList.remove('hidden'); 
  });
});

document.getElementById('closeEditCertModal').addEventListener('click', () => editModal.classList.add('hidden'));
</script>
