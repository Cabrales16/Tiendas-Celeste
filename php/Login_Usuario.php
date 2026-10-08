<?php
require __DIR__ . '/auth.php';
require __DIR__ . '/conexion_be.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../login.php');
    exit;
}

$correo = trim($_POST['USUA_CORREO'] ?? '');
$password = $_POST['USUAPASSWORD'] ?? '';

$stmt = $conexion->prepare('SELECT USUACODIGO, USUAPASSWORD, USUAROLFK FROM usuario WHERE USUA_CORREO = ?');
$stmt->bind_param('s', $correo);
$stmt->execute();
$usuario = $stmt->get_result()->fetch_assoc();

$valido = false;
if ($usuario && $correo !== '') {
    $guardada = $usuario['USUAPASSWORD'];
    if (password_verify($password, $guardada)) {
        $valido = true;
    } elseif (!str_starts_with($guardada, '$2') && hash_equals($guardada, $password)) {
        // Cuenta antigua con contraseña en texto plano: se acepta una vez y se migra a hash.
        $valido = true;
    }
    if ($valido && (!str_starts_with($guardada, '$2') || password_needs_rehash($guardada, PASSWORD_DEFAULT))) {
        $nuevo = password_hash($password, PASSWORD_DEFAULT);
        $upd = $conexion->prepare('UPDATE usuario SET USUAPASSWORD = ? WHERE USUACODIGO = ?');
        $upd->bind_param('si', $nuevo, $usuario['USUACODIGO']);
        $upd->execute();
    }
}

if ($valido) {
    session_regenerate_id(true); // evita fijación de sesión
    $_SESSION['usuario'] = $correo;
    $_SESSION['codigo'] = (int) $usuario['USUACODIGO'];
    $_SESSION['rol'] = (int) $usuario['USUAROLFK'];
    header('Location: ../index.php');
    exit;
}

aviso_y_redirigir('Usuario o contraseña incorrectos, por favor verifique los datos introducidos', '../login.php');
