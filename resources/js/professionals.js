window.collapseProfesionals = () => {
    const section = document.getElementById('section');
    section.classList.toggle('hidden');
}

document.addEventListener('click', function(e) {
    // Para el formulario principal
    if (e.target.matches('#toggle-questionnaire-btn')) {
        e.preventDefault();
        const questionnaire = document.getElementById('questionnaire');
        if (questionnaire) {
            questionnaire.classList.toggle('hidden');
            e.target.textContent = questionnaire.classList.contains('hidden') ? 'Avaluar' : 'Cancel·lar';
        }
    console.log('click detected');

    }
    console.log('click detected');
    // Para los botones de mostrar evaluación
    if (e.target.matches('[data-form-id]')) {
        e.preventDefault();
        const formId = e.target.getAttribute('data-form-id');
        const formRow = document.getElementById(`form-details-${formId}`);
        
        if (formRow) {
            // Ocultar todos los demás detalles de evaluación
            document.querySelectorAll('[id^="form-details-"]').forEach(row => {
                if (row.id !== `form-details-${formId}`) {
                    row.classList.add('hidden');
                }
            });
            
            // Mostrar/ocultar el actual
            formRow.classList.toggle('hidden');
            e.target.textContent = formRow.classList.contains('hidden') ? 'Mostrar' : 'Amagar';
        }
    }
});
