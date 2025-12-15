document.querySelectorAll(".outsider-button").forEach(button => {
    button.addEventListener("click", ev => {
        const div = ev.target.closest(".outsider-card");

        document.getElementById("fullname").textContent = div.dataset.fullname;
        document.getElementById("mail").textContent = div.dataset.email;
        document.getElementById("phone").textContent = div.dataset.phone;
        document.getElementById("task").textContent = div.dataset.task;
        document.getElementById("description").textContent = div.dataset.description;

        document.getElementById("outsider-info").classList.toggle("hidden");
    });
});