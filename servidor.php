<?php

// Inicia la sesión para poder usar variables de sesión
session_start();

// Inicializa la variable usuario como cadena vacía
$usuario = "";
// Inicializa la variable correo como cadena vacía
$correo    = "";
// Inicializa la variable nombreCompleto como cadena vacía
$nombreCompleto = "";
// Crea un arreglo para almacenar mensajes de error
$errores = array(); 
// Define el nombre del archivo donde se guardan los usuarios
$archivo = "usuarios.csv";

// Verifica si se ha enviado el formulario de registro
if (isset($_POST['reg_user'])) {
  // Obtiene el nombre completo del formulario
  $nombreCompleto =  $_POST['fullname'];
  // Obtiene el nombre de usuario del formulario
  $usuario = $_POST['username'];
  // Obtiene el correo electrónico del formulario
  $correo = $_POST['email'];
  // Obtiene la primera contraseña del formulario
  $clave_1 = $_POST['password_1'];
  // Obtiene la segunda contraseña del formulario
  $clave_2 = $_POST['password_2'];
  // Variable para saber si el usuario puede registrarse
  $existe = true;

  // Verifica si el usuario está vacío
  if (empty($usuario)) { 
    array_push($errores, "Usuario es requerido");   
    $existe = false; 
  }
  // Verifica si el correo está vacío
  if (empty($correo)) { 
    array_push($errores, "Email es requerido");   
    $existe = false;
  }
  // Verifica si la contraseña está vacía
  if (empty($clave_1)) { 
    array_push($errores, "Contraseña es requerida"); 
    $existe = false;
  }
  // Verifica si las contraseñas coinciden
  if ($clave_1 != $clave_2) {
    array_push($errores, "Las contraseñas no son las mismas"); 
    $existe = false;
  }

  // Verifica si el archivo de usuarios existe
  if(file_exists($archivo)){
    // Lee todas las líneas del archivo
    $recurso = file($archivo);
    // Recorre cada línea del archivo
    foreach($recurso as $linea){
      // Separa los datos de la línea por comas
      $arreglo = explode(",", $linea);
      // Verifica si el usuario ya existe
      if ($arreglo[2] == $usuario){
        array_push($errores, "El usuario ya existe");
        $existe = false;
      }
      // Verifica si el correo ya existe
      if ($arreglo[1] == $correo){
        array_push($errores, "El correo ya existe");
        $existe = false;
      }
    }
  } else{
    // Si el archivo no existe, agrega un error
    array_push($errores, "Archivo no encontrado.");
  }

  // Si no hay errores, registra el usuario
  if ($existe) {
    // Cifra la contraseña usando md5
    $claveCifrada = md5($clave_1);
    // Prepara la línea a guardar en el archivo
    $linea = "$nombreCompleto,$correo,$usuario,$claveCifrada\n";
    // Guarda la línea en el archivo de usuarios
    file_put_contents($archivo, $linea, FILE_APPEND) or die("ERROR: No se puede escribir datos.");
    // Guarda el nombre completo en la sesión
    $_SESSION['fullname'] = $nombreCompleto;
    // Mensaje de éxito en la sesión
    $_SESSION['success'] = "Has iniciado sesión";
    // Redirige al usuario a la página principal
    header('location: index.php');
  }
}

// Verifica si se ha enviado el formulario de inicio de sesión
if (isset($_POST['login_user'])) {
  // Obtiene el usuario del formulario
  $usuario = $_POST['username'];
  // Obtiene la contraseña del formulario
  $clave = $_POST['password'];

  // Verifica si el usuario está vacío
  if (empty($usuario)) {
    array_push($errores, "Usuario es requerido");
  }
  // Verifica si la contraseña está vacía
  if (empty($clave)) {
    array_push($errores, "Contrasena es requerida");
  }

  // Verifica si el archivo de usuarios existe
  if(file_exists($archivo)){
    // Inicializa la variable para saber si el usuario existe
    $existe = false;
    // Lee todas las líneas del archivo
    $recurso = file($archivo);
    // Recorre cada línea del archivo
    foreach($recurso as $linea){
      // Separa los datos de la línea por comas
      $arreglo = explode(",", $linea);
      // Verifica si el usuario y la contraseña coinciden
      if ($arreglo[2] == $usuario and trim($arreglo[3])==md5($clave)){
        $existe=true;
        // Guarda el nombre completo del usuario
        $nombreCompleto = $arreglo[0];
      }
    }
    // Si el usuario existe, inicia sesión
    if ($existe){
      // Guarda el nombre completo en la sesión
      $_SESSION['fullname'] = $nombreCompleto;
      // Mensaje de éxito en la sesión
      $_SESSION['success'] = "Has iniciado sesión";
      // Redirige al usuario a la página principal
      header('location: index.php');
    }else{
      // Si los datos son incorrectos, agrega un error
      array_push($errores, "Datos incorrectos.");
      // Registra los intentos fallidos en un archivo: usuario, clave, fecha, hora
      $linea = "$usuario,$clave,".date("d/m/Y").",".date("H:i:s")."\n";
      file_put_contents("incorrectos.txt", $linea, FILE_APPEND) or die("ERROR");
    }
  } else{
    // Si el archivo no existe, agrega un error
    array_push($errores, "ERROR: Archivo no encontrado.");
  }
}
?>