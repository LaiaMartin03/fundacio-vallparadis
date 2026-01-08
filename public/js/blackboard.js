// blackboard.js - Versión ultra minimalista
document.addEventListener('DOMContentLoaded', function() {
    // Elementos
    const canvas = document.getElementById('blackboardCanvas');
    const ctx = canvas.getContext('2d');
    const brushBtn = document.getElementById('brushBtn');
    const eraserBtn = document.getElementById('eraserBtn');
    const clearBtn = document.getElementById('clearBtn');
    
    // Estado
    let isDrawing = false;
    let currentTool = 'brush'; // 'brush' o 'eraser'
    const brushColor = '#000000';
    const brushSize = 5;
    const eraserSize = 20;
    
    // Inicializar canvas
    function initCanvas() {
        canvas.width = window.innerWidth;
        canvas.height = window.innerHeight;
        
        // Fondo blanco
        ctx.fillStyle = '#ffffff';
        ctx.fillRect(0, 0, canvas.width, canvas.height);
        
        // Configurar dibujo
        ctx.lineCap = 'round';
        ctx.lineJoin = 'round';
        ctx.strokeStyle = brushColor;
        ctx.lineWidth = brushSize;
    }
    
    // Redimensionar
    function resizeCanvas() {
        const currentImage = ctx.getImageData(0, 0, canvas.width, canvas.height);
        
        canvas.width = window.innerWidth;
        canvas.height = window.innerHeight;
        
        // Restaurar dibujo
        ctx.putImageData(currentImage, 0, 0);
    }
    
    // Eventos de dibujo
    function startDrawing(e) {
        isDrawing = true;
        ctx.beginPath();
        
        const x = e.clientX || e.touches[0].clientX;
        const y = e.clientY || e.touches[0].clientY;
        
        ctx.moveTo(x, y);
        draw(e);
    }
    
    function draw(e) {
        if (!isDrawing) return;
        
        const x = e.clientX || e.touches[0].clientX;
        const y = e.clientY || e.touches[0].clientY;
        
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
        
        // Event listeners
        brushBtn.addEventListener('click', () => setTool('brush'));
        eraserBtn.addEventListener('click', () => setTool('eraser'));
        clearBtn.addEventListener('click', clearCanvas);
        
        // Dibujo con mouse
        canvas.addEventListener('mousedown', startDrawing);
        canvas.addEventListener('mousemove', draw);
        canvas.addEventListener('mouseup', stopDrawing);
        canvas.addEventListener('mouseout', stopDrawing);
        
        // Dibujo táctil
        canvas.addEventListener('touchstart', function(e) {
            e.preventDefault();
            startDrawing(e);
        });
        canvas.addEventListener('touchmove', function(e) {
            e.preventDefault();
            draw(e);
        });
        canvas.addEventListener('touchend', stopDrawing);
        
        // Redimensionar ventana
        window.addEventListener('resize', resizeCanvas);
        
        // Atajos de teclado
        setupKeyboardShortcuts();
        
        // Tooltips
        brushBtn.title = 'Pincel (B)';
        eraserBtn.title = 'Borrador (E)';
        clearBtn.title = 'Borrar todo (Ctrl+Z)';
    }
    
    // Ejecutar
    init();
});