<?php
require __DIR__ . '/auth.php';
require __DIR__ . '/conexion_be.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../login.php');
    exit;
}

$nombre = trim($_POST['USUANOMBRE'] ?? '');
$correo = trim($_POST['USUA_CORREO'] ?? '');
$usuario = trim($_POST['USUAUSUARIO'] ?? '');
$password = $_POST['USUAPASSWORD'] ?? '';

if ($nombre === '' || $usuario === '' || !filter_var($correo, FILTER_VALIDATE_EMAIL)) {
    aviso_y_redirigir('Completa todos los campos con un correo válido', '../login.php');
}
if (strlen($password) < 6) {
    aviso_y_redirigir('La contraseña debe tener al menos 6 caracteres', '../login.php');
}

// El correo y el nombre de usuario no pueden repetirse
$stmt = $conexion->prepare('SELECT 1 FROM usuario WHERE USUA_CORREO = ?');
$stmt->bind_param('s', $correo);
$stmt->execute();
if ($stmt->get_result()->num_rows > 0) {
    aviso_y_redirigir('Este correo ya está registrado, intenta con otro diferente', '../login.php');
}

$stmt = $conexion->prepare('SELECT 1 FROM usuario WHERE USUAUSUARIO = ?');
$stmt->bind_param('s', $usuario);
$stmt->execute();
if ($stmt->get_result()->num_rows > 0) {
    aviso_y_redirigir('Este nombre de usuario ya está registrado, intenta con otro diferente', '../login.php');
}

// El código lo asigna la base de datos (AUTO_INCREMENT) y el rol por defecto es Cliente.
$hash = password_hash($password, PASSWORD_DEFAULT);
$rol = ROL_CLIENTE;
$stmt = $conexion->prepare('INSERT INTO usuario (USUANOMBRE, USUA_CORREO, USUAUSUARIO, USUAPASSWORD, USUAROLFK) VALUES (?, ?, ?, ?, ?)');
$stmt->bind_param('ssssi', $nombre, $correo, $usuario, $hash, $rol);

try {
    $stmt->execute();
} catch (mysqli_sql_exception $e) {
    error_log('Registro fallido: ' . $e->getMessage());
    aviso_y_redirigir('Inténtalo de nuevo, el usuario no fue almacenado', '../login.php');
}

aviso_y_redirigir('Usuario almacenado exitosamente, ya puedes iniciar sesión', '../login.php');
