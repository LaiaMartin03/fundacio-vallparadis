document.addEventListener("DOMContentLoaded", () => {
    const assignUsers = document.getElementById("assignUsers");
    const usersZone = document.getElementById("usersZone");
    const arrowButton = document.querySelectorAll(".arrowButton");

    const dragItems = document.querySelectorAll(".dragItem");
    const dropZone = document.getElementById("dropZone");
    const dropEffect = document.getElementById("dropEffect");

    let draggedItem = null;

    // --- Cuando empiezas a arrastrar ---
    dragItems.forEach(item => {
        item.addEventListener("dragstart", e => {
            draggedItem = item;
            e.dataTransfer.effectAllowed = "move";
            item.classList.add("opacity-50", "scale-95");
        });

        item.addEventListener("dragend", () => {
            draggedItem = null;
            item.classList.remove("opacity-50", "scale-95");
            item.setAttribute("draggable", "false");
        });
    });

    // --- Cuando estás sobre el dropZone ---
    dropZone.addEventListener("dragover", e => {
        e.preventDefault();
        dropEffect.classList.remove("hidden");
    });

    dropZone.addEventListener("dragleave", () => {
        dropEffect.classList.add("hidden");
    });

    // --- Cuando sueltas ---
    dropZone.addEventListener("drop", e => {
        e.preventDefault();
        if (draggedItem) {
            dropZone.appendChild(draggedItem);
            dropEffect.classList.add("hidden");
        }
    });

    assignUsers.addEventListener("click", e => {
        usersZone.classList.toggle("hidden")
        arrowButton.forEach(arrow => {arrow.classList.toggle("rotate-180")})

        dropZone.classList.toggle("[border:1px_dashed_#F07405]")
        dropZone.classList.toggle("border-primary_color")
    });
});