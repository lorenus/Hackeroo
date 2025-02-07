import '../css/style.css'; // Importa el archivo CSS

console.log('El archivo animaciones.js se está ejecutando');

document.addEventListener('DOMContentLoaded', function() {
    const toggler = document.querySelector('.navbar-toggler');
    const abrir = document.querySelector('.abrir');
    const cerrar = document.querySelector('.cerrar');

    if (toggler && abrir && cerrar) {
        toggler.addEventListener('click', function() {
            const isExpanded = toggler.getAttribute('aria-expanded') === 'false';
            abrir.style.display = isExpanded ? 'block' : 'none';
            cerrar.style.display = isExpanded ? 'none' : 'block';
        });
    }

    // Código para el select personalizado
        const options = document.querySelectorAll('.option');
        const selector = document.querySelector('.selector');
        const customSelect = document.querySelector('.custom-select');
        const rolInput = document.querySelector('input[name="rol"]'); // Campo oculto
    
        if (options && selector && customSelect && rolInput) {
            console.log('Elementos del select personalizado encontrados');
    
            options.forEach(option => {
                option.addEventListener('click', function() {
                    console.log('Opción clickeada:', this.textContent);
    
                    // Remover la clase 'selected' de todas las opciones
                    options.forEach(opt => opt.classList.remove('selected'));
    
                    // Añadir la clase 'selected' a la opción clickeada
                    this.classList.add('selected');
    
                    // Mover el selector a la posición de la opción seleccionada
                    const rect = this.getBoundingClientRect();
                    const selectRect = customSelect.getBoundingClientRect();
                    const left = rect.left - selectRect.left;
                    selector.style.transform = `translateX(${left}px)`;
                    selector.style.width = `${rect.width}px`;
    
                    // Actualizar el valor del campo oculto con el valor de la opción seleccionada
                    rolInput.value = this.textContent.toLowerCase(); // O puedes usar un atributo 'data-value' si lo prefieres
    
                    console.log('Selector movido a la opción:', this.textContent);
                });
            });
    
            // Seleccionar la primera opción por defecto y actualizar el valor del input
            if (options.length > 0) {
                options[0].click();
                console.log('Primera opción seleccionada por defecto');
            }
        } else {
            console.log('Elementos del select personalizado no encontrados:', { options, selector, customSelect });
        }


        //////////////////////////////////////MOSTRAR OCULTAR CREAR TAREAS PROFESOR
        // Mostrar campos según el tipo de tarea seleccionado
        document.getElementById('tipo').addEventListener('change', function() {
            var tipo = this.value;
            var numeroPreguntasContainer = document.getElementById('numero_preguntas_container');
            var archivoContainer = document.getElementById('archivo_container');
            var linkContainer = document.getElementById('link_container');
            var urlInput = document.getElementById('url');
            var archivoInput = document.getElementById('archivo');
        
            // Mostrar el campo para número de preguntas solo si es un test
            if (tipo === 'test') {
                numeroPreguntasContainer.style.display = 'block';
                archivoContainer.style.display = 'none';
                linkContainer.style.display = 'none';
                urlInput.removeAttribute('required');
                archivoInput.removeAttribute('required');
            } 
            // Mostrar el campo para archivo solo si es archivo
            else if (tipo === 'archivo') {
                numeroPreguntasContainer.style.display = 'none';
                archivoContainer.style.display = 'block';
                linkContainer.style.display = 'none';
                urlInput.removeAttribute('required');
                archivoInput.setAttribute('required', true);
            } 
            // Mostrar el campo para link solo si es link
            else if (tipo === 'link') {
                numeroPreguntasContainer.style.display = 'none';
                archivoContainer.style.display = 'none';
                linkContainer.style.display = 'block';
                urlInput.setAttribute('required', true);
                archivoInput.removeAttribute('required');
            }
        });

        ////////FILTRAR BUSQUEDA ALUMNOS
        function filterAlumnos() {
            const searchTerm = document.getElementById('search').value.toLowerCase(); 
            const rows = document.querySelectorAll('.alumno-row'); 
    
            rows.forEach(row => {
                const nombre = row.querySelector('td:nth-child(2)').textContent.toLowerCase(); 
                const apellidos = row.querySelector('td:nth-child(3)').textContent.toLowerCase();
    
              
                if (nombre.includes(searchTerm) || apellidos.includes(searchTerm)) {
                    row.style.display = ''; 
                } else {
                    row.style.display = 'none'; 
                }
            });
        }
});