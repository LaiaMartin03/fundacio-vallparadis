// public/js/canvas.js - VERSIÓN CORREGIDA
document.addEventListener('DOMContentLoaded', function() {
    // Verificar que los elementos existen antes de inicializar
    const canvas = document.getElementById('miCanvas');
    const dibujarBtn = document.getElementById('dibujarBtn');
    const borrarBtn = document.getElementById('borrarBtn');
    const limpiarBtn = document.getElementById('limpiarBtn');
    
    // Solo inicializar si todos los elementos existen
    if (!canvas || !dibujarBtn || !borrarBtn || !limpiarBtn) {
        console.error('No se encontraron todos los elementos del canvas');
        return;
    }
    
    class SimpleCanvas {
        constructor() {
            this.canvas = canvas;
            this.ctx = this.canvas.getContext('2d');
            this.dibujando = false;
            this.modo = 'dibujar';
            
            this.init();
            this.setupEventListeners();
        }
        
        init() {
            // Configurar canvas para alta densidad de pantalla
            const dpr = window.devicePixelRatio || 1;
            const rect = this.canvas.getBoundingClientRect();
            
            this.canvas.width = rect.width * dpr;
            this.canvas.height = rect.height * dpr;
            
            this.ctx.scale(dpr, dpr);
            this.canvas.style.width = `${rect.width}px`;
            this.canvas.style.height = `${rect.height}px`;
            
            // Limpiar canvas con fondo blanco
            this.ctx.fillStyle = '#FFFFFF';
            this.ctx.fillRect(0, 0, this.canvas.width / dpr, this.canvas.height / dpr);
            
            // Configuración inicial del dibujo
            this.ctx.lineWidth = 3;
            this.ctx.lineCap = 'round';
            this.ctx.lineJoin = 'round';
            this.ctx.strokeStyle = '#000000';
            
            // Marcar botón de dibujar como activo
            dibujarBtn.classList.add('ring-2', 'ring-offset-2', 'ring-green-500');
        }
        
        setupEventListeners() {
            // Eventos del ratón
            this.canvas.addEventListener('mousedown', this.startDrawing.bind(this));
            this.canvas.addEventListener('mousemove', this.draw.bind(this));
            this.canvas.addEventListener('mouseup', this.stopDrawing.bind(this));
            this.canvas.addEventListener('mouseout', this.stopDrawing.bind(this));
            
            // Eventos para pantallas táctiles
            this.canvas.addEventListener('touchstart', this.handleTouchStart.bind(this));
            this.canvas.addEventListener('touchmove', this.handleTouchMove.bind(this));
            this.canvas.addEventListener('touchend', this.stopDrawing.bind(this));
            
            // Botones de control
            dibujarBtn.addEventListener('click', () => this.setModo('dibujar'));
            borrarBtn.addEventListener('click', () => this.setModo('borrar'));
            limpiarBtn.addEventListener('click', () => this.limpiarCanvas());
        }
        
        setModo(nuevoModo) {
            this.modo = nuevoModo;
            
            // Quitar estilos activos de todos los botones
            const botones = [dibujarBtn, borrarBtn];
            botones.forEach(btn => {
                btn.classList.remove('ring-2', 'ring-offset-2');
                btn.classList.remove('ring-green-500', 'ring-red-500');
            });
            
            // Aplicar estilo al botón activo
            if (this.modo === 'dibujar') {
                dibujarBtn.classList.add('ring-2', 'ring-offset-2', 'ring-green-500');
            } else {
                borrarBtn.classList.add('ring-2', 'ring-offset-2', 'ring-red-500');
            }
        }
        
        startDrawing(e) {
            e.preventDefault();
            this.dibujando = true;
            const pos = this.getPosicion(e);
            
            this.ctx.beginPath();
            this.ctx.moveTo(pos.x, pos.y);
        }
        
        draw(e) {
            e.preventDefault();
            if (!this.dibujando) return;
            
            const pos = this.getPosicion(e);
            
            if (this.modo === 'dibujar') {
                this.ctx.strokeStyle = '#000000';
                this.ctx.lineWidth = 3;
            } else {
                this.ctx.strokeStyle = '#FFFFFF';
                this.ctx.lineWidth = 20;
            }
            
            this.ctx.lineTo(pos.x, pos.y);
            this.ctx.stroke();
        }
        
        stopDrawing() {
            this.dibujando = false;
            this.ctx.beginPath();
        }
        
        handleTouchStart(e) {
            const touch = e.touches[0];
            const mouseEvent = new MouseEvent('mousedown', {
                clientX: touch.clientX,
                clientY: touch.clientY
            });
            this.startDrawing(mouseEvent);
        }
        
        handleTouchMove(e) {
            const touch = e.touches[0];
            const mouseEvent = new MouseEvent('mousemove', {
                clientX: touch.clientX,
                clientY: touch.clientY
            });
            this.draw(mouseEvent);
        }
        
        getPosicion(e) {
            const rect = this.canvas.getBoundingClientRect();
            const scaleX = this.canvas.width / rect.width;
            const scaleY = this.canvas.height / rect.height;
            
            return {
                x: (e.clientX - rect.left) * scaleX,
                y: (e.clientY - rect.top) * scaleY
            };
        }
        
        limpiarCanvas() {
            const dpr = window.devicePixelRatio || 1;
            const rect = this.canvas.getBoundingClientRect();
            
            this.ctx.fillStyle = '#FFFFFF';
            this.ctx.fillRect(0, 0, rect.width * dpr, rect.height * dpr);
            
            // Restaurar configuración
            this.ctx.lineWidth = 3;
            this.ctx.lineCap = 'round';
            this.ctx.lineJoin = 'round';
            this.ctx.strokeStyle = '#000000';
        }
    }
    
    // Inicializar el canvas
    new SimpleCanvas();
});