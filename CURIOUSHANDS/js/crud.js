const params = new URLSearchParams(window.location.search);
  if (params.get("registro") === "exitoso") {
    alert("✅ Registro exitoso. Ahora puedes iniciar sesión.");
  }