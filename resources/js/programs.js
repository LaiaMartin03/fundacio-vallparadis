document.addEventListener("DOMContentLoaded", () => {
    const assignUsers = document.getElementById("assignUsers");
    const usersZone = document.getElementById("usersZone");
    const arrowButton = document.querySelectorAll(".arrowButton");

    const dragItems = document.querySelectorAll(".dragItem");
    const dropZone = document.getElementById("dropZone");
    const dropEffect = document.getElementById("dropEffect");

    const saveButton = document.getElementById("saveChanges")

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
        e.preventDefault();
        dropEffect.classList.remove("hidden");
    });

    dropZone.addEventListener("dragleave", () => {
        dropEffect.classList.add("hidden");
    });

    const cursosUsuarios = {};

    dropZone.addEventListener("drop", e => {
        e.preventDefault();

        if (draggedItem) {
            dropZone.appendChild(draggedItem);
            dropEffect.classList.add("hidden");
            draggedItem.setAttribute("draggable", "false");

            const userId = draggedItem.dataset.id;
            const cursoId = dropZone.dataset.courseId;

            if (!cursosUsuarios[cursoId]) cursosUsuarios[cursoId] = [];

            if (!cursosUsuarios[cursoId].includes(userId)) {
                cursosUsuarios[cursoId].push(userId);
            }

            document.getElementById("no-professionals").classList.add("hidden")
        }
    });

    document.getElementById('save-changes').addEventListener('click', async () => {
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
        } catch (err) {
            console.error('Error al guardar:', err);
        }
    });

    assignUsers.addEventListener("click", e => {
        usersZone.classList.toggle("hidden")
        arrowButton.forEach(arrow => {arrow.classList.toggle("rotate-180")})

        dropZone.classList.toggle("[border:1px_dashed_#F07405]")
        dropZone.classList.toggle("border-primary_color")
        document.getElementById("take-out").classList.toggle("hidden")
    });

    saveButton.addEventListener("click", () => {
        fetch('/save-drop', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ items: droppedItems })
        })
        .then(res => res.json())
        .then(data => {
            console.log(data);
            saveButton.innerText = "Cambios guardados"
        })
        .catch(err => console.error(err));

    });
});