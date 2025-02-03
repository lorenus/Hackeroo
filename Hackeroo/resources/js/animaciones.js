import '../css/style.css'; // Importa el archivo CSS

console.log('El archivo animaciones.js se está ejecutando');

document.addEventListener('DOMContentLoaded', function() {
    // Código para el navbar (sin cambios)
    const toggler = document.querySelector('.navbar-toggler');
    const abrir = document.querySelector('.abrir');
    const cerrar = document.querySelector('.cerrar');

    toggler.addEventListener('click', function() {
        const isExpanded = toggler.getAttribute('aria-expanded') === 'true';

        if (isExpanded) {
            abrir.style.display = 'none';
            cerrar.style.display = 'block';
        } else {
            abrir.style.display = 'block';
            cerrar.style.display = 'none';
        }
    });

    // Código para el select personalizado
    const options = document.querySelectorAll('.option');
    const selector = document.querySelector('.selector');
    const customSelect = document.querySelector('.custom-select');

    options.forEach(option => {
        option.addEventListener('click', function() {
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
        });
    });

    // Seleccionar la primera opción por defecto
    if (options.length > 0) {
        options[0].click();
    }
});