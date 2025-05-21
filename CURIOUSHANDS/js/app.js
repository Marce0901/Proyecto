
// Registro
document.getElementById('formRegistro')?.addEventListener('submit', (e) => {
  e.preventDefault();
  const inputs = e.target.querySelectorAll('input');

  const nuevoUsuario = {
    nombre: inputs[0].value.trim(),
    correo: inputs[1].value.trim(),
    username: inputs[2].value.trim(),
    password: inputs[3].value.trim(),
    telefono: inputs[4].value.trim(),
  };

  if (Object.values(nuevoUsuario).some(val => val === "")) {
    alert("Por favor, completa todos los campos.");
    return;
  }

  if (!/\S+@\S+\.\S+/.test(nuevoUsuario.correo)) {
    alert("Correo electrónico no válido.");
    return;
  }

  if (obtenerUsuario(nuevoUsuario.username)) {
    alert('Usuario ya registrado.');
    return;
  }

  crearUsuario(nuevoUsuario);
  alert('Registro exitoso. ¡Ahora puedes iniciar sesión!');
  window.location.href = 'login.php';
});

// Login
document.getElementById('formLogin')?.addEventListener('submit', (e) => {
  e.preventDefault();

  const inputs = e.target.querySelectorAll('input');
  const username = inputs[0].value.trim();
  const password = inputs[1].value.trim();

  const usuario = obtenerUsuario(username);

  if (usuario && usuario.password === password) {
    localStorage.setItem('usuarioActivo', JSON.stringify(usuario));
    window.location.href = 'niveles.php';
  } else {
    alert('Usuario o contraseña incorrectos.');
  }
});

// Cerrar sesión 
function cerrarSesion() {
  localStorage.removeItem('usuarioActivo');
  window.location.href = 'index.php';
}

// Mostrar usuario en niveles
window.onload = () => {
  if (location.pathname.includes('niveles.php')) {
    const usuarioActivo = JSON.parse(localStorage.getItem('usuarioActivo'));
    if (!usuarioActivo) {
      window.location.href = 'login.php';
    } else {
      document.querySelector('.perfil strong').innerText = `👤 ${usuarioActivo.username}`;
    }
  }
  function resetProgreso() {
  localStorage.removeItem('progreso');
  alert("Tu progreso ha sido borrado.");
  window.location.reload();
}
};
