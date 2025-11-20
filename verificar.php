<?php
session_start();

if (!isset($_SESSION['id_username'])) {
    header("Location: registroUser.php");
    exit();
}

$rolUser = $_SESSION["rol"] ?? 0;

if ($rolUser != 2) {  // 2 = viajero
    // No tiene permisos
    header("Location: login.php");
    exit();
}
// Usar operador ?? para evitar warnings si una sesión no existe
$nombreUser = $_SESSION["id_nombre"] ?? '';
$usernam = $_SESSION["id_username"] ?? '';
$IDUser = $_SESSION["id_cedulaUser"] ?? '';
$cod_v = $_SESSION["id_codViaje"] ?? null;

$direcc = $_SESSION["id_direccion"] ?? '';
$telf = $_SESSION["id_telefono"] ?? '';
$pass = $_SESSION["id_pass"] ?? '';
$idUsuario = $_SESSION["id"] ?? null;
?>
