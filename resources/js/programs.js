document.addEventListener("DOMContentLoaded", () => {
    const assignUsers = document.getElementById("assignUsers");
    const usersZone = document.getElementById("usersZone");
    const arrowButton = document.querySelectorAll(".arrowButton");

    const dragItems = document.querySelectorAll(".dragItem");
    const dropZone = document.getElementById("dropZone");
    const dropEffect = document.getElementById("dropEffect");

    const saveButton = document.getElementById("save-changes")

    let draggedItem = null;
    const cursosUsuarios = {};

    // Initialize: Add remove buttons to professionals already in drop zone
    const cursoId = dropZone ? dropZone.dataset.courseId : null;
    if (dropZone && cursoId) {
        const existingItems = dropZone.querySelectorAll('.dragItem');
        existingItems.forEach(item => {
            // Initialize cursosUsuarios with existing items
            const userId = item.dataset.id;
            if (!cursosUsuarios[cursoId]) cursosUsuarios[cursoId] = [];
            if (userId && !cursosUsuarios[cursoId].includes(userId)) {
                cursosUsuarios[cursoId].push(userId);
            }
            // Add remove button to existing items
            addRemoveButton(item, cursoId);
        });
    }

    // Function to attach drag event listeners to an item
    function attachDragListeners(item) {
        // Check if listeners are already attached
        if (item.dataset.dragListenersAttached === "true") {
            return;
        }
        
        item.addEventListener("dragstart", e => {
            draggedItem = item;
            e.dataTransfer.effectAllowed = "move";
            item.classList.add("opacity-50", "scale-95");
        });

        item.addEventListener("dragend", () => {
            draggedItem = null;
            item.classList.remove("opacity-50", "scale-95");
        });
        
        // Mark that listeners are attached
        item.dataset.dragListenersAttached = "true";
    }

    // --- Cuando empiezas a arrastrar ---
    // Only attach listeners to items that are draggable (not in drop zone)
    dragItems.forEach(item => {
        if (item.getAttribute("draggable") === "true") {
            attachDragListeners(item);
        }
    });

    // --- Cuando estás sobre el dropZone ---
    if (dropZone) {
        dropZone.addEventListener("dragover", e => {
            e.preventDefault();
            if (dropEffect) dropEffect.classList.remove("hidden");
        });

        dropZone.addEventListener("dragleave", () => {
            if (dropEffect) dropEffect.classList.add("hidden");
        });

        dropZone.addEventListener("drop", e => {
        e.preventDefault();

        if (draggedItem) {
            dropZone.appendChild(draggedItem);
            if (dropEffect) dropEffect.classList.add("hidden");
            draggedItem.setAttribute("draggable", "false");

            const userId = draggedItem.dataset.id;
            const cursoId = dropZone.dataset.courseId;

            if (!cursosUsuarios[cursoId]) cursosUsuarios[cursoId] = [];

            if (!cursosUsuarios[cursoId].includes(userId)) {
                cursosUsuarios[cursoId].push(userId);
            }

            // Add X button to remove professional
            addRemoveButton(draggedItem, cursoId);

            // Hide "no professionals" message if it exists
            const noProfessionals = document.getElementById("no-professionals");
            if (noProfessionals) {
                noProfessionals.classList.add("hidden");
            }
        }
        });
    }

    // Function to add remove button to a professional card
    function addRemoveButton(item, cursoId) {
        // Check if button already exists
        let removeBtn = item.querySelector('.remove-professional-btn');
        
        if (!removeBtn) {
            removeBtn = document.createElement('button');
            removeBtn.className = 'remove-professional-btn text-gray-300 hover:text-red-500 cursor-pointer absolute top-2 right-2 font-bold text-lg transition-colors';
            removeBtn.innerHTML = '×';
            removeBtn.setAttribute('aria-label', 'Remove professional');
            item.appendChild(removeBtn);

            // Add click handler to remove professional
            removeBtn.addEventListener('click', (e) => {
                e.stopPropagation();
                removeProfessional(item, cursoId);
            });
        }
    }

    // Function to filter professionals in the list
    function filterProfessionals() {
        const searchInput = document.getElementById("name");
        if (!searchInput || !usersZone) return;
        
        const scrollableContainer = usersZone.querySelector('.overflow-y-scroll');
        if (!scrollableContainer) return;
        
        const professionalItems = scrollableContainer.querySelectorAll('.dragItem');
        const searchTerm = searchInput.value.trim().toLowerCase();
        
        professionalItems.forEach(item => {
            const name = item.textContent.toLowerCase();
            if (name.includes(searchTerm)) {
                item.style.display = '';
            } else {
                item.style.display = 'none';
            }
        });
    }

    // Function to remove professional from drop zone and return to list
    function removeProfessional(item, cursoId) {
        const userId = item.dataset.id;
        const usersZone = document.getElementById("usersZone");
        
        // Remove from cursosUsuarios
        if (cursosUsuarios[cursoId]) {
            cursosUsuarios[cursoId] = cursosUsuarios[cursoId].filter(id => id !== userId);
        }

        // Remove the X button
        const removeBtn = item.querySelector('.remove-professional-btn');
        if (removeBtn) {
            removeBtn.remove();
        }

        // Make item draggable again
        item.setAttribute("draggable", "true");
        
        // Re-attach drag listeners since the item is now draggable again
        attachDragListeners(item);

        // Return to usersZone (the draggable list)
        if (usersZone) {
            const scrollableContainer = usersZone.querySelector('.overflow-y-scroll');
            if (scrollableContainer) {
                scrollableContainer.appendChild(item);
            } else {
                usersZone.appendChild(item);
            }
            // Re-apply search filter after item is returned
            setTimeout(filterProfessionals, 0);
        } else {
            // If usersZone is hidden, we need to find where to put it
            // For now, just remove it from dropZone
            item.remove();
        }

        // Show "no professionals" message if drop zone is empty
        if (dropZone) {
            const dropZoneItems = dropZone.querySelectorAll('.dragItem');
            const noProfessionals = document.getElementById("no-professionals");
            if (dropZoneItems.length === 0 && noProfessionals) {
                noProfessionals.classList.remove("hidden");
            }
        }
    }

    if (saveButton) {
        saveButton.addEventListener('click', async () => {
            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            const datosParaEnviar = {};
            
            Object.keys(cursosUsuarios).forEach(cursoId => {
                datosParaEnviar[cursoId] = cursosUsuarios[cursoId];
            });

            console.log('Datos a enviar:', datosParaEnviar);

            try {
                const res = await fetch('/save-drag-drops', {
                    method: 'POST',
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": token
                    },
                    body: JSON.stringify(datosParaEnviar)
                });

                if (!res.ok) {
                    const text = await res.text();
                    console.error('Error en el fetch:', text);
                    return;
                }

                const data = await res.json();
                console.log('Guardado exitoso:', data);
                saveButton.innerText = "Cambios guardados";
            } catch (err) {
                console.error('Error al guardar:', err);
            }
        });
    }

    if (assignUsers) {
        assignUsers.addEventListener("click", e => {
            usersZone.classList.toggle("hidden")
            arrowButton.forEach(arrow => {arrow.classList.toggle("rotate-180")})

            dropZone.classList.toggle("[border:1px_dashed_#F07405]")
            dropZone.classList.toggle("border-primary_color")
        });
    }

    // Search functionality for professionals list
    const searchInput = document.getElementById("name");
    if (searchInput && usersZone) {
        searchInput.addEventListener('input', filterProfessionals);
    }
});