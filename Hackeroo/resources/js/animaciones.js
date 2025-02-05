import "../css/style.css"; // Importa el archivo CSS

console.log("El archivo animaciones.js se está ejecutando");

document.addEventListener("DOMContentLoaded", function () {
    // Código para el navbar toggler (sin cambios)
    const toggler = document.querySelector(".navbar-toggler");
    const abrir = document.querySelector(".abrir");
    const cerrar = document.querySelector(".cerrar");

    if (toggler && abrir && cerrar) {
        toggler.addEventListener("click", function () {
            const isExpanded = toggler.getAttribute("aria-expanded") === "false";
            abrir.style.display = isExpanded ? "block" : "none";
            cerrar.style.display = isExpanded ? "none" : "block";
        });
    }

    // Código para el select personalizado (sin cambios)
    const options = document.querySelectorAll(".option");
    const selector = document.querySelector(".selector");
    const customSelect = document.querySelector(".custom-select");
    const rolInput = document.querySelector('input[name="rol"]'); // Campo oculto

    if (options && selector && customSelect && rolInput) {
        console.log("Elementos del select personalizado encontrados");

        options.forEach((option) => {
            option.addEventListener("click", function () {
                console.log("Opción clickeada:", this.textContent);

                // Remover la clase 'selected' de todas las opciones
                options.forEach((opt) => opt.classList.remove("selected"));

                // Añadir la clase 'selected' a la opción clickeada
                this.classList.add("selected");

                // Mover el selector a la posición de la opción seleccionada
                const rect = this.getBoundingClientRect();
                const selectRect = customSelect.getBoundingClientRect();
                const left = rect.left - selectRect.left;
                selector.style.transform = `translateX(${left}px)`;
                selector.style.width = `${rect.width}px`;

                // Actualizar el valor del campo oculto con el valor de la opción seleccionada
                rolInput.value = this.textContent.toLowerCase(); // O puedes usar un atributo 'data-value' si lo prefieres

                console.log("Selector movido a la opción:", this.textContent);
            });
        });

        // Seleccionar la primera opción por defecto y actualizar el valor del input
        if (options.length > 0) {
            options[0].click();
            console.log("Primera opción seleccionada por defecto");
        }
    } else {
        console.log("Elementos del select personalizado no encontrados:", {
            options,
            selector,
            customSelect,
        });
    }

    // Mostrar campos según el tipo de tarea seleccionado (CON CAMBIOS)
    const tipoSelect = document.getElementById('tipo');
    const numeroPreguntasContainer = document.getElementById('numero_preguntas_container');
    const archivoContainer = document.getElementById('archivo_container');
    const linkContainer = document.getElementById('link_container');
    const botonTexto = document.getElementById('boton_texto');

    if (tipoSelect && numeroPreguntasContainer && archivoContainer && linkContainer) { // Verifica que todos los elementos existan
        tipoSelect.addEventListener('change', function () {
            const tipo = this.value; 

            // Oculta todos los contenedores primero
            numeroPreguntasContainer.style.display = 'none';
            archivoContainer.style.display = 'none';
            linkContainer.style.display = 'none';

            // Luego muestra el contenedor correspondiente
            switch (tipo) {
                case 'test':
                    numeroPreguntasContainer.style.display = 'flex';
                    botonTexto.textContent = "Siguiente";
                    break;
                case 'archivo':
                    archivoContainer.style.display = 'block';
                    botonTexto.textContent = "Crear";
                    break;
                case 'link':
                    linkContainer.style.display = 'block';
                    botonTexto.textContent = "Crear";
                    break;
            }
        });

        // Disparar el evento 'change' al cargar la página (CON CAMBIOS)
        tipoSelect.dispatchEvent(new Event('change')); // Usa 'change' en lugar de 'input'
    } else {
        console.error("Elementos para mostrar/ocultar campos no encontrados:", {
            tipoSelect,
            numeroPreguntasContainer,
            archivoContainer,
            linkContainer
        });
    }
   
    // Asegurarse de que si no se ingresa número de preguntas, se asigne 5 (sin cambios)
    const form = document.querySelector('form');
    if (form) {
        form.addEventListener('submit', function (event) {
            var numeroPreguntas = document.getElementById('numero_preguntas');
            // Si no se ha introducido un valor, poner el valor por defecto (5)
            if (numeroPreguntas && numeroPreguntas.value === '') {
                numeroPreguntas.value = 5;
            }
        });
    }
});