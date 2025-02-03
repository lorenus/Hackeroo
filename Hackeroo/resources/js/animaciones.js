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

    if (options && selector && customSelect) {
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

                console.log('Selector movido a la opción:', this.textContent);
            });
        });

        // Seleccionar la primera opción por defecto
        if (options.length > 0) {
            options[0].click();
            console.log('Primera opción seleccionada por defecto');
        }
    } else {
        console.log('Elementos del select personalizado no encontrados:', { options, selector, customSelect });
    }
});