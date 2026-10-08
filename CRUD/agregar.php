<?php
require_once __DIR__ . '/../php/auth.php';
requerir_empleado();
requerir_post_csrf();
require_once __DIR__ . '/conexion.php';

$nombre = trim($_POST['USUANOMBRE'] ?? '');
$usuario = trim($_POST['USUAUSUARIO'] ?? '');
$correo = trim($_POST['USUA_CORREO'] ?? '');
$password = $_POST['USUAPASSWORD'] ?? '';
$rol = (int) ($_POST['USUAROLFK'] ?? ROL_CLIENTE);

if ($nombre === '' || $usuario === '' || !filter_var($correo, FILTER_VALIDATE_EMAIL) || strlen($password) < 6 || !in_array($rol, [ROL_EMPLEADO, ROL_CLIENTE], true)) {
    aviso_y_redirigir('Datos inválidos: revisa el nombre, el correo y la contraseña (mínimo 6 caracteres)', 'index.php');
}

$hash = password_hash($password, PASSWORD_DEFAULT);
$stmt = $conexion->prepare('INSERT INTO usuario (USUANOMBRE, USUAUSUARIO, USUA_CORREO, USUAPASSWORD, USUAROLFK) VALUES (?, ?, ?, ?, ?)');
$stmt->bind_param('ssssi', $nombre, $usuario, $correo, $hash, $rol);

try {
    $stmt->execute();
} catch (mysqli_sql_exception $e) {
    error_log('No se pudo agregar el usuario: ' . $e->getMessage());
    aviso_y_redirigir('No se pudo registrar el usuario (¿correo o usuario repetido?)', 'index.php');
}

header('Location: index.php');
exit;
