<?php 
// Incluye el archivo de servidor para manejar el acceso
include_once('servidor.php') 
?>
<!DOCTYPE html>
<html>
<head>
  <title>Acceso al Sistema</title>
  <!-- Incluye el archivo de estilos CSS -->
  <link rel="stylesheet" type="text/css" href="estilos.css">
</head>
<body>
 
  Al momento de probar el proyecto, ejecute y abra el webview en la opción New tab, luego borre este mensaje. 
  <!-- Instrucción para validar el acceso con usuarios creados -->

  <div class="header">
    <h2>Ingreso</h2>
  </div>
  <form method="post" action="acceso.php">
    <!-- Incluye el archivo de errores para mostrar mensajes -->
    <?php include('errores.php'); ?>
    <div class="input-group">
      <label>Usuario</label>
      <!-- Campo para el usuario -->
      <input type="text" name="username" >
    </div>
    <div class="input-group">
      <label>Contraseña</label>
      <!-- Campo para la contraseña -->
      <input type="password" name="password">
    </div>
    <div class="input-group">
      <!-- Botón para enviar el formulario de acceso -->
      <button type="submit" class="btn" name="login_user">Login</button>
    </div>
    <p>
      <!-- Enlace para ir al registro si no es miembro -->
      ¿No eres miembro? <a href="registro.php">Registrate</a>
    </p>
  </form>
</body>
</html>
