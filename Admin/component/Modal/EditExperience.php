<?php
if (!isset($experience)) return;

$expId = $experience['id'];
$highlightSql = "SELECT * FROM experience_highlights WHERE experience_id = $expId";
$highlightResult = $conn->query($highlightSql);
$expHighlights = $highlightResult->fetch_all(MYSQLI_ASSOC);
?>

<div id="editModal<?= $experience['id'] ?>" 
     class="hidden fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm flex items-center justify-center z-50 overflow-auto p-4">

  <div class="bg-gray-800/90 backdrop-blur-md w-full max-w-lg p-6 rounded-2xl shadow-2xl 
              max-h-[calc(100vh-4rem)] overflow-auto relative border border-gray-700
              pb-20"> 

    <div class="flex justify-between items-center mb-4">
      <h3 class="font-bold text-xl bg-clip-text text-transparent bg-gradient-to-r from-indigo-400 via-purple-500 to-pink-500">Edit Experience</h3>
      <button onclick="closeEditModal(<?= $experience['id'] ?>)" 
              class="text-white text-2xl font-bold hover:text-red-400 transition">&times;</button>
    </div>

    <form method="POST" action="../Backends/Experience/UpdateExperience.php" class="space-y-4">
      <input type="hidden" name="id" value="<?= $experience['id'] ?>">

      <label class="text-sm text-gray-300">Year / Period</label>
      <input type="text" name="year_label" value="<?= htmlspecialchars($experience['year_label']) ?>" 
             class="w-full p-3 rounded-xl bg-gray-700 border border-gray-600 text-white focus:outline-none focus:ring-2 focus:ring-indigo-400" required>

      <label class="text-sm text-gray-300">Category</label>
      <select name="category" class="w-full p-3 rounded-xl bg-gray-700 border border-gray-600 text-white focus:outline-none focus:ring-2 focus:ring-indigo-400" required>
        <option value="">Select Category</option>
        <option value="Training & Certification" <?= $experience['category']==="Training & Certification"?'selected':'' ?>>Training & Certification</option>
        <option value="Freelance / Projects" <?= $experience['category']==="Freelance / Projects"?'selected':'' ?>>Freelance / Projects</option>
        <option value="Non-IT Field" <?= $experience['category']==="Non-IT Field"?'selected':'' ?>>Non-IT Field</option>
        <option value="Internship" <?= $experience['category']==="Internship"?'selected':'' ?>>Internship</option>
        <option value="Other" <?= $experience['category']==="Other"?'selected':'' ?>>Other</option>
      </select>


      <label class="text-sm text-gray-300">Title</label>
      <input type="text" name="title" value="<?= htmlspecialchars($experience['title']) ?>"
             class="w-full p-3 rounded-xl bg-gray-700 border border-gray-600 text-white focus:outline-none focus:ring-2 focus:ring-indigo-400" required>

      <label class="text-sm text-gray-300">Organization / Context</label>
      <input type="text" name="organization" value="<?= htmlspecialchars($experience['organization']) ?>"
             class="w-full p-3 rounded-xl bg-gray-700 border border-gray-600 text-white focus:outline-none focus:ring-2 focus:ring-indigo-400">

      <label class="text-sm text-gray-300">Badge</label>
      <select name="badge" class="w-full p-3 rounded-xl bg-gray-700 border border-gray-600 text-white focus:outline-none focus:ring-2 focus:ring-indigo-400">
        <option value="">Select Badge</option>
        <option value="Certification" <?= $experience['badge']==="Certification"?'selected':'' ?>>Certification</option>
        <option value="Creative • IT" <?= $experience['badge']==="Creative • IT"?'selected':'' ?>>Creative • IT</option>
        <option value="Growth" <?= $experience['badge']==="Growth"?'selected':'' ?>>Growth</option>
        <option value="Leadership" <?= $experience['badge']==="Leadership"?'selected':'' ?>>Leadership</option>
        <option value="Other" <?= $experience['badge']==="Other"?'selected':'' ?>>Other</option>
      </select>

      <label class="text-sm text-gray-300">Highlights</label>
      <div id="editHighlightContainer<?= $experience['id'] ?>" class="space-y-2 max-h-60 overflow-auto p-2 border border-gray-600 rounded-xl">
        <?php foreach ($expHighlights as $h): ?>
          <textarea name="highlights[]" rows="3"
                    class="w-full p-3 rounded-xl bg-gray-700 border border-gray-600 text-white focus:outline-none focus:ring-2 focus:ring-indigo-400"><?= htmlspecialchars($h['highlight']) ?></textarea>
        <?php endforeach; ?>
      </div>
      <button type="button" onclick="addEditHighlight(<?= $experience['id'] ?>)"
              class="text-sm text-indigo-400 hover:text-indigo-200 mt-1 transition">+ Add another highlight</button>

      <div class="flex justify-between mt-6">
        <button type="button" onclick="closeEditModal(<?= $experience['id'] ?>)"
                class="bg-gray-600 text-white px-5 py-2 rounded-xl hover:bg-gray-500 transition">Back</button>

        <button type="submit"
                class="bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 text-white px-5 py-2 rounded-xl hover:scale-105 transition-transform duration-300">
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
    textarea.className = 'w-full p-3 rounded-xl bg-gray-700 border border-gray-600 text-white focus:outline-none focus:ring-2 focus:ring-indigo-400';
    container.appendChild(textarea);
  }

  function closeEditModal(id) {
    document.getElementById('editModal' + id).classList.add('hidden');
  }
</script>
