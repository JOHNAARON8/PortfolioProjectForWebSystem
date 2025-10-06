document.addEventListener('DOMContentLoaded', () => {

  document.querySelectorAll('[data-open-modal]').forEach(btn => {
    btn.addEventListener('click', () => {
      const modalId = btn.getAttribute('data-open-modal');
      const modal = document.querySelector(`[data-modal="${modalId}"]`);
      if(modal) modal.classList.remove('hidden');
    });
  });

  document.querySelectorAll('[data-close]').forEach(el => {
    el.addEventListener('click', () => {
      el.closest('[data-modal]').classList.add('hidden');
    });
  });

  document.addEventListener('keydown', (e) => {
    if(e.key === "Escape") {
      document.querySelectorAll('[data-modal]').forEach(modal => modal.classList.add('hidden'));
    }
  });
});


// Trigger Certificate Modal
const certModal = document.getElementById('certModal');
const certTitle = document.getElementById('certTitle');
const certContent = document.getElementById('certContent');
const closeCertModal = document.getElementById('closeCertModal');

function openCertModal(title, file) {
  certTitle.textContent = title;
  certContent.innerHTML = '';

  const extension = file.split('.').pop().toLowerCase();
  if (['jpg','jpeg','png','gif','webp'].includes(extension)) {
    const img = document.createElement('img');
    img.src = file;
    img.alt = title;
    img.className = 'max-w-full max-h-[70vh] object-contain rounded';
    certContent.appendChild(img);
  } else if (extension === 'pdf') {
    const embed = document.createElement('embed');
    embed.src = file;
    embed.type = 'application/pdf';
    embed.className = 'w-full h-[70vh]';
    certContent.appendChild(embed);
  } else {
    certContent.textContent = 'Cannot preview this file type.';
  }

  certModal.classList.remove('hidden');
  certModal.classList.add('flex');
}

closeCertModal.addEventListener('click', () => {
  certModal.classList.add('hidden');
  certModal.classList.remove('flex');
  certContent.innerHTML = '';
});

certModal.addEventListener('click', (e) => {
  if (e.target === certModal) {
    certModal.classList.add('hidden');
    certModal.classList.remove('flex');
    certContent.innerHTML = '';
  }
});