// Obtener el contexto de los canvas
const ctxNivel = document.getElementById('graficoNivel').getContext('2d');
const ctxLeccion = document.getElementById('graficoLeccion').getContext('2d');

// Datos de ejemplo para el gráfico de progreso por nivel
const dataNivel = {
    labels: ['Nivel 1', 'Nivel 2', 'Nivel 3', 'Nivel 4', 'Exámenes'], // Niveles
    datasets: [{
        label: 'Progreso por Nivel',
        data: [85, 70, 90, 60, 50], // Porcentaje de progreso en cada nivel
        backgroundColor: ['#FFB6C1', '#FF7F50', '#FFD700', '#90EE90', '#CFE6DB'],
        borderColor: ['#FF6347', '#FF4500', '#FF8C00', '#32CD32', '#8B0000'],
        borderWidth: 1
    }]
};

// Crear el gráfico de progreso por nivel
new Chart(ctxNivel, {
    type: 'bar',
    data: dataNivel,
    options: {
        responsive: true,
        scales: {
            y: {
                beginAtZero: true,
                max: 100
            }
        }
    }
});

// Datos de ejemplo para el gráfico de progreso por lección
const dataLeccion = {
    labels: ['Lección 1', 'Lección 2', 'Lección 3', 'Lección 4', 'Lección 5'], // Lecciones
    datasets: [{
        label: 'Progreso por Lección',
        data: [90, 75, 80, 60, 50], // Porcentaje de progreso en cada lección
        backgroundColor: ['#D3E0D6', '#B0E0E6', '#FFB6C1', '#98FB98', '#FFD700'],
        borderColor: ['#00FA9A', '#7FFFD4', '#FF6347', '#32CD32', '#FF8C00'],
        borderWidth: 1
    }]
};

// Crear el gráfico de progreso por lección
new Chart(ctxLeccion, {
    type: 'bar',
    data: dataLeccion,
    options: {
        responsive: true,
        scales: {
            y: {
                beginAtZero: true,
                max: 100
            }
        }
    }
});
