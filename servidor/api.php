<?php
/**
 * API REST para el proyecto "Mascota Feliz"
 */

// Cabeceras para permitir la comunicación y definir el tipo de contenido
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

// Parámetros de conexión a la Base de Datos
$servidor = "localhost";
$usuario = "root";
$contrasena = "";
$baseDeDatos = "veterinaria";

// Bloque para manejar la conexión y la consulta de forma segura
try {
    // 1. Crear la conexión usando PDO
    $conexion = new PDO("mysql:host=$servidor;dbname=$baseDeDatos", $usuario, $contrasena);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // 2. Preparar y ejecutar la consulta SQL
    $sql = "SELECT * FROM pacientes";
    $sentencia = $conexion->prepare($sql);
    $sentencia->execute();

    // 3. Obtener los resultados
    $resultados = $sentencia->fetchAll(PDO::FETCH_ASSOC);

    // 4. Devolver los resultados en formato JSON
    echo json_encode($resultados);

} catch (PDOException $e) {
    // En caso de error, se devuelve un mensaje de error en JSON
    echo json_encode(["error" => "Error de conexión o consulta: " . $e->getMessage()]);
}
?>