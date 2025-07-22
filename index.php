<?php
  // Inicia la sesión para poder usar variables de sesión
  session_start(); 
  // Si no hay usuario logueado, redirige al acceso
  if (!isset($_SESSION['fullname'])) {
    $_SESSION['msg'] = "Primero debes iniciar sesion";
    header('location: acceso.php');
  }
  // Si se solicita cerrar sesión, destruye la sesión y redirige al acceso
  if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['fullname']);
    header("location: acceso.php");
  }
?>

<!DOCTYPE html>
<html>
<head>
  <title>PHP Intermedio</title>
  <!-- Incluye el archivo de estilos CSS -->
  <link rel="stylesheet" type="text/css" href="estilos.css">
</head>
<body>

<div class="header">
  <h2>Inicio</h2>
</div>
<div class="content">
    <!-- Muestra mensaje de éxito si existe -->
    <?php if (isset($_SESSION['success'])) : ?>
      <div class="error success" >
        <h3>
          <?php 
            echo $_SESSION['success']; 
            unset($_SESSION['success']);
          ?>
        </h3>
      </div>
    <?php endif ?>

    <!-- Si el usuario está logueado, muestra el nombre y el iframe -->
    <?php  if (isset($_SESSION['fullname'])) : ?>
      <p>Bienvenido <strong><?php echo $_SESSION['fullname']; ?></strong></p>
      <!-- Video de YouTube embebido -->
      <iframe width="100%" height="300" src="https://www.youtube.com/embed/Og847HVwRSI" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
      <p> <a href="index.php?logout='1'" style="color: red;">Salir</a> </p>
    <?php endif ?>
</div>

</body>
</html>