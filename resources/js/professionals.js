window.collapseProfesionals = () => {
    const section = document.getElementById('section');
    section.classList.toggle('hidden');
}

document.addEventListener('click', function(e) {
    if (e.target.matches('button[onclick*="toggleQuestionnaire"]')) {
        e.preventDefault();
        const questionnaire = document.getElementById('questionnaire');
        if (questionnaire) {
            questionnaire.classList.toggle('hidden');
            e.target.textContent = questionnaire.classList.contains('hidden') ? 'Avaluar' : 'Cancel·lar';
        }
    }
});
