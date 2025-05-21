function irALeccion(nivel) {
    localStorage.setItem('nivelActual', nivel);
    window.location.href = 'leccion.php';
}
window.onload = () => {
    const progreso = JSON.parse(localStorage.getItem('progreso')) || {};
    for (let i = 1; i <= 4; i++) {
        if (progreso[`nivel${i}`]) {
            document.getElementById(`estrella${i}`).classList.add('activa');
        }
    }
};