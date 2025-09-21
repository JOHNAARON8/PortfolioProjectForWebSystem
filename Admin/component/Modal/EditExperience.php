<?php
if (!isset($experience)) return;

$expId = $experience['id'];
$highlightSql = "SELECT * FROM experience_highlights WHERE experience_id = $expId";
$highlightResult = $conn->query($highlightSql);
$expHighlights = $highlightResult->fetch_all(MYSQLI_ASSOC);
?>

<div id="editModal<?= $experience['id'] ?>" 
     class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-start justify-center z-50 overflow-auto">

  <div class="bg-[var(--card-dark)] w-full max-w-lg p-6 rounded-xl shadow-lg mt-8 mb-8 max-h-[90vh] overflow-auto relative">

    <div class="flex justify-between items-center mb-4">
      <h3 class="font-semibold text-lg text-[var(--primary-color)]">Edit Experience</h3>
      <button onclick="closeEditModal(<?= $experience['id'] ?>)" 
              class="text-white text-xl font-bold hover:text-red-400">&times;</button>
    </div>

    <form method="POST" action="../Backends/Experience/UpdateExperience.php" class="space-y-4">
      <input type="hidden" name="id" value="<?= $experience['id'] ?>">

      <label class="text-sm text-gray-300">Year / Period</label>
      <input type="text" name="year_label" value="<?= htmlspecialchars($experience['year_label']) ?>" 
             class="w-full p-2 rounded bg-gray-700 border border-gray-600 text-white" required>

      <label class="text-sm text-gray-300">Category</label>
      <select name="category" class="w-full p-2 rounded bg-gray-700 border border-gray-600 text-white" required>
        <option value="">Select Category</option>
        <option value="Training & Certification" <?= $experience['category']==="Training & Certification"?'selected':'' ?>>Training & Certification</option>
        <option value="Freelance / Projects" <?= $experience['category']==="Freelance / Projects"?'selected':'' ?>>Freelance / Projects</option>
        <option value="Non-IT Field" <?= $experience['category']==="Non-IT Field"?'selected':'' ?>>Non-IT Field</option>
        <option value="Internship" <?= $experience['category']==="Internship"?'selected':'' ?>>Internship</option>
        <option value="Other" <?= $experience['category']==="Other"?'selected':'' ?>>Other</option>
      </select>

      <label class="text-sm text-gray-300">Title</label>
      <input type="text" name="title" value="<?= htmlspecialchars($experience['title']) ?>"
             class="w-full p-2 rounded bg-gray-700 border border-gray-600 text-white" required>

      <label class="text-sm text-gray-300">Organization / Context</label>
      <input type="text" name="organization" value="<?= htmlspecialchars($experience['organization']) ?>"
             class="w-full p-2 rounded bg-gray-700 border border-gray-600 text-white">

      <label class="text-sm text-gray-300">Badge</label>
      <select name="badge" class="w-full p-2 rounded bg-gray-700 border border-gray-600 text-white">
        <option value="">Select Badge</option>
        <option value="Certification" <?= $experience['badge']==="Certification"?'selected':'' ?>>Certification</option>
        <option value="Creative • IT" <?= $experience['badge']==="Creative • IT"?'selected':'' ?>>Creative • IT</option>
        <option value="Growth" <?= $experience['badge']==="Growth"?'selected':'' ?>>Growth</option>
        <option value="Leadership" <?= $experience['badge']==="Leadership"?'selected':'' ?>>Leadership</option>
        <option value="Other" <?= $experience['badge']==="Other"?'selected':'' ?>>Other</option>
      </select>

      <label class="text-sm text-gray-300">Highlights</label>
      <div id="editHighlightContainer<?= $experience['id'] ?>" class="space-y-2 max-h-60 overflow-auto p-2 border border-gray-600 rounded">
        <?php foreach ($expHighlights as $h): ?>
          <textarea name="highlights[]" rows="3"
                    class="w-full p-2 rounded bg-gray-700 border border-gray-600 text-white"><?= htmlspecialchars($h['highlight']) ?></textarea>
        <?php endforeach; ?>
      </div>
      <button type="button" onclick="addEditHighlight(<?= $experience['id'] ?>)"
              class="text-sm text-indigo-400 hover:text-indigo-200 mt-1">+ Add another highlight</button>

      <div class="flex justify-between mt-4">
        <button type="button" onclick="closeEditModal(<?= $experience['id'] ?>)"
                class="bg-gray-600 text-white px-4 py-2 rounded-md hover:bg-gray-500 transition">Back</button>

        <button type="submit"
                class="bg-[var(--primary-color)] text-white px-4 py-2 rounded-md hover:bg-[var(--secondary-color)] transition">
          Update Experience
        </button>
      </div>
    </form>
  </div>
</div>

<script>
  function addEditHighlight(id) {
    const container = document.getElementById('editHighlightContainer' + id);
    const textarea = document.createElement('textarea');
    textarea.name = 'highlights[]';
    textarea.rows = 3;
    textarea.placeholder = `New Highlight`;
    textarea.className = 'w-full p-2 rounded bg-gray-700 border border-gray-600 text-white';
    container.appendChild(textarea);
  }

  function closeEditModal(id) {
    document.getElementById('editModal' + id).classList.add('hidden');
  }
</script>
