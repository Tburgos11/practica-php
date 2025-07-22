<?php
// Verifica si hay errores en el arreglo $errores
if (count($errores) > 0){
  // Abre un div con la clase 'error' para mostrar los mensajes
  echo "<div class='error'>";
  // Recorre cada error en el arreglo y lo muestra en un párrafo
  foreach ($errores as $error){
    echo "<p>$error</p>";
  }
  // Cierra el div de errores
  echo "</div>";
}
?>