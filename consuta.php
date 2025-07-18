<?php
// Archivo: consulta.php

// Incluimos el archivo de configuración una sola vez.
// 'require_once' es ideal porque detendrá el script si el archivo no se encuentra.
require_once 'config.php';

// Establecemos un título para la página HTML.
echo "<h1>Tablas en la Base de Datos 'adidas_logistica'</h1>";

// Obtenemos la conexión llamando al método estático de nuestra clase.
$conexion = Conexion::conectar();

// Preparamos la consulta SQL para mostrar todas las tablas.
$sql = "SHOW TABLES";

// Ejecutamos la consulta en la base de datos.
$resultado = $conexion->query($sql);

// Verificamos si la consulta devolvió resultados.
if ($resultado->num_rows > 0) {
    
    // Si hay tablas, iniciamos una lista no ordenada en HTML.
    echo "<ul>";
    
    // Recorremos cada fila del resultado.
    // fetch_array() obtiene una fila como un array.
    while ($fila = $resultado->fetch_array()) {
        // Mostramos el nombre de la tabla (está en el primer índice del array, [0]).
        echo "<li>" . $fila[0] . "</li>";
    }
    
    // Cerramos la lista HTML.
    echo "</ul>";

} else {
    // Si no se encontraron tablas, mostramos un mensaje.
    echo "No se encontraron tablas en la base de datos.";
}

// Es una buena práctica cerrar la conexión cuando ya no la necesites.
$conexion->close();

?>