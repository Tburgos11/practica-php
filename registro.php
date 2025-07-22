<?php 
// Incluye el archivo de servidor para manejar el registro
include('servidor.php') 
?>
<!DOCTYPE html>
<html>
<head>
  <title>Registro al Sistema</title>
  <!-- Incluye el archivo de estilos CSS -->
  <link rel="stylesheet" type="text/css" href="estilos.css">
</head>
<body>
  <div class="header">
    <h2>Registro</h2>
  </div>
  <!-- Instrucción para validar la revisión del registro -->
  
  <form method="post" action="registro.php">
    <!-- Incluye el archivo de errores para mostrar mensajes -->
    <?php include('errores.php'); ?>
    <div class="input-group">
      <label>Nombres</label>
      <!-- Campo para el nombre completo, mantiene el valor si hay error -->
      <input type="text" name="fullname" value="<?php echo $nombreCompleto; ?>">
    </div>
    <div class="input-group">
      <label>Usuario</label>
      <!-- Campo para el usuario, mantiene el valor si hay error -->
      <input type="text" name="username" value="<?php echo $usuario; ?>">
    </div>
    <div class="input-group">
      <label>Correo</label>
      <!-- Campo para el correo, mantiene el valor si hay error -->
      <input type="email" name="email" value="<?php echo $correo; ?>">
    </div>
    <div class="input-group">
      <label>Contraseña</label>
      <!-- Campo para la contraseña -->
      <input type="password" name="password_1">
    </div>
    <div class="input-group">
      <label>Confirme contraseña</label>
      <!-- Campo para confirmar la contraseña -->
      <input type="password" name="password_2">
    </div>
    <div class="input-group">
      <!-- Botón para enviar el formulario de registro -->
      <button type="submit" class="btn" name="reg_user">Registrarse</button>
    </div>
    <p>
      <!-- Enlace para ir al acceso si ya es miembro -->
      ¿Ya eres miembro? <a href="acceso.php">Accede</a>
    </p>
  </form>
</body>
</html>
