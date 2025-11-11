// Cierra cualquier modal al hacer clic en el overlay o en [data-close-modal]
document.addEventListener('click', (e) => {
  const modal = e.target.closest('[role="dialog"]');
  
  if (!modal) return;

  // Clic en el overlay (fondo negro)
  if (e.target === modal) {
    const content = modal.querySelector('.relative');
    if (content) content.classList.add('hidden');
  }
  
  // Clic en el botón X
  if (e.target.matches('[data-close-modal]')) {
    const content = modal.querySelector('.relative');
    if (content) content.classList.add('hidden');
  }
});

// Opcional: cerrar con ESC
document.addEventListener('keydown', (e) => {
  if (e.key === 'Escape') {
    document.querySelectorAll('[role="dialog"] .relative:not(.hidden)').forEach(modal => {
      modal.classList.add('hidden');
    });
  }
});