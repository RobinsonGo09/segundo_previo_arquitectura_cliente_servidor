<?php
header('Content-Type: application/json');
header('Access-control-allow-origin: *');

$servidor = "localhost";
$usuario = "root";
$contrasena = "";
$baseDeDatos = "veterinaria";

try {
    $conexion = new PDO("mysql:host=$servidor;dbname=$baseDeDatos", $usuario, $contrasena);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT * FROM pacientes";
    $sentencia = $conexion->prepare($sql);
    $sentencia->execute();

    $resultados = $sentencia->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($resultados);

} catch (PDOException $e) {
    echo json_encode(["error" => "Error de conexión o consulta: " . $e->getMessage()]);
}
?>