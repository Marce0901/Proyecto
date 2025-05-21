const nivel = localStorage.getItem('nivelActual') || 1;
const titulo = document.querySelector('h2 span');
const descripcion = document.querySelector('.descripcion-signo p');
const imagen = document.querySelector('.imagen-signo img');

const datos = {
    1: {
        nombre: "Saludo",
        desc: "Coloca la mano abierta cerca de la frente y muévela hacia afuera.",
        img: "multimedia/saludo.jpg"
    },
    2: {
        nombre: "Gracias",
        desc: "Lleva la mano desde la boca hacia adelante suavemente.",
        img: "multimedia/gracias.jpg"
    },
    3: {
        nombre: "Expresiones",
        desc: "Utiliza ambas manos para indicar emociones básicas.",
        img: "multimedia/expresiones.jpg"
    },
    4: {
        nombre: "Conversación",
        desc: "Conecta signos para formar oraciones completas.",
        img: "multimedia/conectar.jpg"
    },
    5: {
        nombre: "Prueba Final",
        desc: "Prepárate para demostrar todo lo que has aprendido.",
        img: "multimedia/examen.png"
    }
};

titulo.textContent = datos[nivel]?.nombre || "Desconocido";
descripcion.textContent = datos[nivel]?.desc || "Contenido no disponible.";
imagen.src = datos[nivel]?.img || "assets/default.png";

const progreso = JSON.parse(localStorage.getItem('progreso')) || {};
progreso[`nivel${nivel}`] = true;
localStorage.setItem('progreso', JSON.stringify(progreso));
