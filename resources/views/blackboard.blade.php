<x-app-layout>
    <div class="p-6">
        <div class="ml-20 max-w-4xl mx-auto">
            <!-- Canvas -->
            <canvas id="blackboardCanvas" 
                    class="w-full h-128 bg-white border-2 border-gray-400 rounded-lg shadow-lg cursor-crosshair">
            </canvas>
            
            <!-- Controles -->
            <div class="mt-3 flex gap-2">
                <button id="brushBtn" class="px-3 py-1 bg-blue-500 text-black rounded text-sm">Pincel</button>
                <button id="eraserBtn" class="px-3 py-1 bg-gray-500 text-white rounded text-sm">Borrador</button>
                <button id="clearBtn" class="px-3 py-1 bg-red-500 text-white rounded text-sm">Limpiar</button>
            </div>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const canvas = document.getElementById('blackboardCanvas');
        const ctx = canvas.getContext('2d');
        const brushBtn = document.getElementById('brushBtn');
        const eraserBtn = document.getElementById('eraserBtn');
        const clearBtn = document.getElementById('clearBtn');
        
        // Estado
        let isDrawing = false;
        let currentTool = 'brush';
        const brushColor = '#000000';
        const brushSize = 5;
        const eraserSize = 20;
        
        // Inicializar canvas (tamaño fijo)
        function initCanvas() {
            canvas.width = canvas.offsetWidth;
            canvas.height = canvas.offsetHeight;
            
            // Fondo blanco
            ctx.fillStyle = '#ffffff';
            ctx.fillRect(0, 0, canvas.width, canvas.height);
            
            // Configurar dibujo
            ctx.lineCap = 'round';
            ctx.lineJoin = 'round';
            ctx.strokeStyle = brushColor;
            ctx.lineWidth = brushSize;
        }
        
        // Eventos de dibujo
        function startDrawing(e) {
            isDrawing = true;
            ctx.beginPath();
            
            const rect = canvas.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;
            
            ctx.moveTo(x, y);
            draw(e);
        }
        
        function draw(e) {
            if (!isDrawing) return;
            
            const rect = canvas.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;
            
            ctx.lineTo(x, y);
            ctx.stroke();
        }
        
        function stopDrawing() {
            isDrawing = false;
            ctx.beginPath();
        }
        
        // Cambiar herramienta
        function setTool(tool) {
            currentTool = tool;
            
            if (tool === 'brush') {
                ctx.globalCompositeOperation = 'source-over';
                ctx.strokeStyle = brushColor;
                ctx.lineWidth = brushSize;
                
                brushBtn.classList.add('active');
                eraserBtn.classList.remove('active');
            } else if (tool === 'eraser') {
                ctx.globalCompositeOperation = 'destination-out';
                ctx.strokeStyle = 'rgba(0,0,0,1)';
                ctx.lineWidth = eraserSize;
                
                eraserBtn.classList.add('active');
                brushBtn.classList.remove('active');
            }
        }
        
        // Limpiar canvas
        function clearCanvas() {
            if (confirm('¿Borrar todo el dibujo?')) {
                ctx.fillStyle = '#ffffff';
                ctx.fillRect(0, 0, canvas.width, canvas.height);
            }
        }
        
        // Atajos de teclado
        function setupKeyboardShortcuts() {
            document.addEventListener('keydown', function(e) {
                // B - Pincel
                if (e.key === 'b' || e.key === 'B') {
                    e.preventDefault();
                    setTool('brush');
                }
                
                // E - Borrador
                if (e.key === 'e' || e.key === 'E') {
                    e.preventDefault();
                    setTool('eraser');
                }
                
                // Ctrl+Z - Limpiar
                if (e.ctrlKey && e.key === 'z') {
                    e.preventDefault();
                    clearCanvas();
                }
                
                // Espacio - Cambiar herramienta
                if (e.key === ' ') {
                    e.preventDefault();
                    setTool(currentTool === 'brush' ? 'eraser' : 'brush');
                }
            });
        }
        
        // Inicializar
        function init() {
            initCanvas();
            
            // Event listeners para botones
            brushBtn.addEventListener('click', () => setTool('brush'));
            eraserBtn.addEventListener('click', () => setTool('eraser'));
            clearBtn.addEventListener('click', clearCanvas);
            
            // Dibujo con mouse
            canvas.addEventListener('mousedown', startDrawing);
            canvas.addEventListener('mousemove', draw);
            canvas.addEventListener('mouseup', stopDrawing);
            canvas.addEventListener('mouseout', stopDrawing);
            
            // Atajos de teclado
            setupKeyboardShortcuts();
        }
        
        // Ejecutar
        init();
        
        // Redimensionar si cambia el tamaño de la ventana
        window.addEventListener('resize', initCanvas);
    });
    </script>
    
</x-app-layout>