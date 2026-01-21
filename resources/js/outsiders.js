document.querySelectorAll(".outsider-button").forEach(button => {
    button.addEventListener("click", ev => {
        const div = ev.target.closest(".outsider-card");

        document.getElementById("fullname").textContent = div.dataset.fullname;
        document.getElementById("mail").textContent = div.dataset.email;
        document.getElementById("phone").textContent = div.dataset.phone;
        document.getElementById("task").textContent = div.dataset.task;
        document.getElementById("description").textContent = div.dataset.description;

        const editLink = document.getElementById("edit-link");
        editLink.href = `${editLink.dataset.base}?id=${div.dataset.id}`;

        const info = document.getElementById("outsider-info");
        if (info.classList.contains('hidden')) {
            info.classList.remove('hidden');
            info.classList.add('flex');
        } else {
            info.classList.add('hidden');
            info.classList.remove('flex');
        }
    });
});