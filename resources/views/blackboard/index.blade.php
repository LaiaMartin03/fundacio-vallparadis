<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h2 class="text-lg font-semibold mb-4">Pissarra Digital</h2>
                    
                    <div class="mb-4 border-2 border-gray-300 rounded-lg overflow-hidden bg-white">
                        <canvas id="miCanvas" width="800" height="400" class="w-full"></canvas>
                    </div>
                    
                    <div class="flex flex-wrap gap-3 mb-6">
                        <button id="dibujarBtn" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition shadow">
                            Escriure
                        </button>
                        <button id="borrarBtn" class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition shadow">
                            Esborar
                        </button>
                        <button id="limpiarBtn" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition shadow">
                            Netegar
                        </button>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
    // JavaScript EN LÍNEA para evitar problemas de carga
    document.addEventListener('DOMContentLoaded', function() {
        
        // Elementos
        const canvas = document.getElementById('miCanvas');
        const dibujarBtn = document.getElementById('dibujarBtn');
        const borrarBtn = document.getElementById('borrarBtn');
        const limpiarBtn = document.getElementById('limpiarBtn');
        
        // Verificación estricta
        if (!canvas) {
            return;
        }
        if (!dibujarBtn || !borrarBtn || !limpiarBtn) {
            return;
        }
        
        
        // Contexto y variables
        const ctx = canvas.getContext('2d');
        let dibujando = false;
        let modo = 'dibujar';
        
        // Inicializar canvas
        function initCanvas() {
            
            // Tamaño real
            const rect = canvas.getBoundingClientRect();
            canvas.width = rect.width;
            canvas.height = rect.height;
            
            // Fondo blanco
            ctx.fillStyle = 'white';
            ctx.fillRect(0, 0, canvas.width, canvas.height);
            
            // Configuración del dibujo
            ctx.lineWidth = 3;
            ctx.lineCap = 'round';
            ctx.lineJoin = 'round';
            ctx.strokeStyle = 'black';
            
            // Estado inicial de botones
            dibujarBtn.classList.add('bg-green-600');
            dibujarBtn.classList.remove('bg-green-500');
            
        }
        
        // Obtener posición del ratón
        function getPosicion(e) {
            const rect = canvas.getBoundingClientRect();
            return {
                x: e.clientX - rect.left,
                y: e.clientY - rect.top
            };
        }
        
        // Cambiar modo
        function cambiarModo(nuevoModo) {
            modo = nuevoModo;
            
            if (modo === 'dibujar') {
                dibujarBtn.classList.add('bg-green-600');
                dibujarBtn.classList.remove('bg-green-500');
                borrarBtn.classList.add('bg-red-500');
                borrarBtn.classList.remove('bg-red-600');
                ctx.strokeStyle = 'black';
                ctx.lineWidth = 3;
            } else {
                dibujarBtn.classList.add('bg-green-500');
                dibujarBtn.classList.remove('bg-green-600');
                borrarBtn.classList.add('bg-red-600');
                borrarBtn.classList.remove('bg-red-500');
                ctx.strokeStyle = 'white';
                ctx.lineWidth = 20;
            }
        }
        
        // Limpiar todo
        function limpiarTodo() {
            ctx.fillStyle = 'white';
            ctx.fillRect(0, 0, canvas.width, canvas.height);
            
            ctx.lineWidth = 3;
            ctx.lineCap = 'round';
            ctx.lineJoin = 'round';
            ctx.strokeStyle = 'black';
            cambiarModo('dibujar');
        }
        
        function empezarDibujo(e) {
            e.preventDefault();
            dibujando = true;
            const pos = getPosicion(e);
            ctx.beginPath();
            ctx.moveTo(pos.x, pos.y);
        }
        
        function dibujar(e) {
            e.preventDefault();
            if (!dibujando) return;
            
            const pos = getPosicion(e);
            ctx.lineTo(pos.x, pos.y);
            ctx.stroke();
        }
        
        function pararDibujo() {
            dibujando = false;
            ctx.beginPath();
        }
        
        canvas.addEventListener('mousedown', empezarDibujo);
        canvas.addEventListener('mousemove', dibujar);
        canvas.addEventListener('mouseup', pararDibujo);
        canvas.addEventListener('mouseout', pararDibujo);
        
        dibujarBtn.addEventListener('click', () => cambiarModo('dibujar'));
        borrarBtn.addEventListener('click', () => cambiarModo('borrar'));
        limpiarBtn.addEventListener('click', limpiarTodo);
        
        initCanvas();
    });
    </script>
    @endpush
</x-app-layout>