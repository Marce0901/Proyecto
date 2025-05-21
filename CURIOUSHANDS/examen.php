<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Examen - Curious Hands</title>
  <link rel="stylesheet" href="css/eslogin.css" />
</head>
<body>

  <main class="contenido-centro">
    <section class="quiz">
      <h2>Exámenes: ¡Pruébate!</h2>
      <p class="pregunta">¿A qué corresponde la siguiente imagen presentada?</p>
      <img src="" alt="Pregunta actual" id="quizImg">
      
      <div class="opciones" id="opcionesContainer">
        <!-- Botones de opciones se inyectan vía JS -->
      </div>

      <p id="feedback" class="feedback"></p>

      <div class="botones-quiz">
        <button id="btnSiguiente" style="display: none;">Siguiente</button>
        <button id="btnFinalizar" style="display: none;">Finalizar prueba</button>
      </div>
    </section>
  </main>

 <script>
const preguntas = [
  { img: 'multimedia/saludo.jpg', correcta: 'Saludo' },
  { img: 'multimedia/gracias.jpg', correcta: 'Gracias' },
  { img: 'multimedia/expresiones.jpg', correcta: 'Expresiones' },
  { img: 'multimedia/conectar.jpg', correcta: 'Conversación' }
];

let idx = 0;
let correctas = 0;

function cargarPregunta(i) {
  document.getElementById('feedback').textContent = '';
  document.getElementById('btnSiguiente').style.display = 'none';
  document.getElementById('btnFinalizar').style.display = 'none';
  document.getElementById('quizImg').src = preguntas[i].img;

  const contenedor = document.getElementById('opcionesContainer');
  contenedor.innerHTML = '';
  ['Saludo', 'Gracias', 'Expresiones', 'Conversación'].forEach(opc => {
    const btn = document.createElement('button');
    btn.textContent = opc;
    btn.className = 'opc';
    btn.onclick = () => comprobar(opc);
    contenedor.appendChild(btn);
  });
}

function comprobar(seleccion) {
  document.querySelectorAll('.opc').forEach(b => b.disabled = true);
  const correcta = preguntas[idx].correcta;
  const feedback = document.getElementById('feedback');

  if (seleccion === correcta) {
    feedback.textContent = '✔️ ¡Correcto!';
    feedback.className = 'feedback correcto';
    correctas++;
  } else {
    feedback.textContent = `❌ Incorrecto. La respuesta era: ${correcta}`;
    feedback.className = 'feedback incorrecto';
  }

  if (idx < preguntas.length - 1) {
    document.getElementById('btnSiguiente').style.display = 'inline-block';
  } else {
    document.getElementById('btnFinalizar').style.display = 'inline-block';
  }
}

document.getElementById('btnSiguiente').onclick = () => {
  idx++;
  cargarPregunta(idx);
};

document.getElementById('btnFinalizar').onclick = () => {
  alert(`¡Has finalizado! Aciertos: ${correctas} de ${preguntas.length}`);
  window.location.href = 'niveles.html';
};

cargarPregunta(idx);
</script>

</body>
</html>
