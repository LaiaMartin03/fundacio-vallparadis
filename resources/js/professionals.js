// Ocultar/mostrar sección
window.collapseProfesionals = () => {
    document.getElementById('section').classList.toggle('hidden');
}

// Manejar clics
document.addEventListener('click', (e) => {
    const target = e.target;
    
    // Formulario principal
    if (target.id === 'toggle-questionnaire-btn') {
        e.preventDefault();
        const form = document.getElementById('questionnaire');
        form.classList.toggle('hidden');
        target.textContent = form.classList.contains('hidden') ? 'Avaluar' : 'Cancel·lar';
    }
    
    // Followups
    if (target.id === 'seguiment-button') {
        e.preventDefault();
        const form = document.getElementById('seguiments');
        form.classList.toggle('hidden');
        target.textContent = form.classList.contains('hidden') ? 'Afegir seguiment' : 'Amagar';
    }
    
    // Evaluaciones individuales
    if (target.hasAttribute('data-form-id')) {
        e.preventDefault();
        const id = target.getAttribute('data-form-id');
        const detalles = document.getElementById('form-details-' + id);
        detalles.classList.toggle('hidden');
        target.textContent = detalles.classList.contains('hidden') ? 'Mostrar' : 'Amagar';
    }
});