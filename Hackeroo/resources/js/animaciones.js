import '../css/style.css'; // Importa el archivo CSS

document.addEventListener('DOMContentLoaded', function() {
    const toggler = document.querySelector('.navbar-toggler');
    const abrir = document.querySelector('.abrir');
    const cerrar = document.querySelector('.cerrar');

    toggler.addEventListener('click', function() {
        // Verificar el estado del menú (abierto o cerrado)
        const isExpanded = toggler.getAttribute('aria-expanded') === 'true';

        if (isExpanded) {
            // Si el menú está abierto, muestra la "X" y oculta la hamburguesa
            abrir.style.display = 'none';
            cerrar.style.display = 'block';
        } else {
            // Si el menú está cerrado, muestra la hamburguesa y oculta la "X"
            abrir.style.display = 'block';
            cerrar.style.display = 'none';
        }
    });
});