<?php
// Archivo: config.php

/**
 * Clase para gestionar la conexión a la base de datos.
 * Proporciona un método estático para obtener el objeto de conexión.
 */
class Conexion {
    
    /**
     * Establece la conexión con la base de datos.
     * * @return mysqli|false El objeto de conexión mysqli en caso de éxito, o false si falla.
     */
    public static function conectar() {
        // --- PARÁMETROS DE CONEXIÓN ---
        // Estos datos los obtuvimos de tu captura de HeidiSQL.
        
        // El host de la base de datos. '127.0.0.1' o 'localhost' es común para desarrollo local.
        $host = "127.0.0.1"; 
        
        // El nombre de la base de datos que creaste.
        $db_name = "adidas_logistica"; 
        
        // El usuario de la base de datos. 'root' es el usuario por defecto en muchas instalaciones locales.
        $user = "root"; 
        
        // La contraseña del usuario. En tu caso, parece estar vacía.
        $password = ""; 
        
        // --- INTENTO DE CONEXIÓN ---
        try {
            // Creamos un nuevo objeto mysqli para la conexión.
            $conexion = new mysqli($host, $user, $password, $db_name);

            // Verificamos si hubo un error en la conexión.
            if ($conexion->connect_error) {
                // Si hay un error, detenemos la ejecución y mostramos el error.
                die("Error de conexión: " . $conexion->connect_error);
            }
            
            // Si la conexión es exitosa, la retornamos.
            return $conexion;

        } catch (Exception $e) {
            // Capturamos cualquier otra excepción y mostramos un mensaje de error.
            die("Error al conectar con la base de datos: " . $e->getMessage());
        }
    }
}
?>