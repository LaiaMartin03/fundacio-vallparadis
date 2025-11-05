document.addEventListener("DOMContentLoaded", () => {
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
        });
    });

    // --- Cuando estás sobre el dropZone ---
    dropZone.addEventListener("dragover", e => {
        e.preventDefault(); // necesario
        dropEffect.classList.remove("hidden");
    });

    dropZone.addEventListener("dragleave", () => {
        dropZone.classList.add("hidden");
    });

    // --- Cuando sueltas ---
    dropZone.addEventListener("drop", e => {
        e.preventDefault();
        if (draggedItem) {
            dropZone.appendChild(draggedItem);
            dropZone.classList.remove("border-gray-300", "bg-gray-100", "opacity-50");
        }
    });
});