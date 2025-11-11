document.addEventListener('DOMContentLoaded', function () {
    const container = document.getElementById('tab-container');
    const buttons = Array.from(document.querySelectorAll('.tab-button'));
    if (!container || !buttons.length) return;

    async function loadPartial(url, btn) {
        container.textContent = 'Carregant...';
        try {
            const res = await fetch(url, { credentials: 'same-origin', headers: { 'X-Requested-With': 'XMLHttpRequest' } });
            if (!res.ok) {
                container.textContent = 'Error carregant contingut';
                return;
            }
            container.innerHTML = await res.text();
            buttons.forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
        } catch (e) {
            container.textContent = 'Error';
            console.error(e);
        }
    }

    buttons.forEach(btn => {
        btn.addEventListener('click', () => {
            const url = btn.dataset.url;
            if (!url) return;
            loadPartial(url, btn);
        });
    });

    // carga inicial 
    const initial = buttons.find(b => b.classList.contains('active')) || buttons[0];
    if (initial) loadPartial(initial.dataset.url, initial);
});