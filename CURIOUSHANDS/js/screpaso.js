// Obtén el formulario de respuesta
const formulario = document.querySelector('form');
formulario.addEventListener('submit', function (event) {
    event.preventDefault();

    // Obtén la respuesta seleccionada
    const respuesta = document.querySelector('input[name="respuesta"]:checked');

    if (respuesta) {
        // Respuesta correcta para la letra A
        if (respuesta.value === 'A') {
            alert("¡Correcto! Has acertado.");
        } else {
            alert("¡Incorrecto! La respuesta correcta es A.");
        }
    } else {
        alert("Por favor selecciona una respuesta.");
    }
});
