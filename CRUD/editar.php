<?php
require_once __DIR__ . '/../php/auth.php';
requerir_empleado();
require_once __DIR__ . '/conexion.php';

$codigo = (int) ($_GET['USUACODIGO'] ?? $_POST['USUACODIGO'] ?? 0);

// ---- Guardar cambios ----
if (isset($_POST['btnmodificar'])) {
    requerir_post_csrf();
    $nombre = trim($_POST['txtUSUANOMBRE'] ?? '');
    $usuario = trim($_POST['txtUSUAUSUARIO'] ?? '');
    $correo = trim($_POST['txtUSUA_CORREO'] ?? '');
    $password = $_POST['txtUSUAPASSWORD'] ?? '';
    $rol = (int) ($_POST['txtUSUAROLFK'] ?? ROL_CLIENTE);

    if ($nombre === '' || $usuario === '' || !filter_var($correo, FILTER_VALIDATE_EMAIL) || !in_array($rol, [ROL_EMPLEADO, ROL_CLIENTE], true) || ($password !== '' && strlen($password) < 6)) {
        aviso_y_redirigir('Datos inválidos: revisa los campos', 'editar.php?USUACODIGO=' . $codigo);
    }
    if ($codigo === (usuario_actual()['codigo'] ?? 0) && $rol !== ROL_EMPLEADO) {
        aviso_y_redirigir('No puedes quitarte tu propio rol de empleado', 'editar.php?USUACODIGO=' . $codigo);
    }

    try {
        if ($password !== '') { // solo se cambia la contraseña si se escribe una nueva
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $conexion->prepare('UPDATE usuario SET USUANOMBRE=?, USUAUSUARIO=?, USUA_CORREO=?, USUAROLFK=?, USUAPASSWORD=? WHERE USUACODIGO=?');
            $stmt->bind_param('sssisi', $nombre, $usuario, $correo, $rol, $hash, $codigo);
        } else {
            $stmt = $conexion->prepare('UPDATE usuario SET USUANOMBRE=?, USUAUSUARIO=?, USUA_CORREO=?, USUAROLFK=? WHERE USUACODIGO=?');
            $stmt->bind_param('sssii', $nombre, $usuario, $correo, $rol, $codigo);
        }
        $stmt->execute();
    } catch (mysqli_sql_exception $e) {
        error_log('No se pudo modificar el usuario: ' . $e->getMessage());
        aviso_y_redirigir('No se pudo modificar (¿correo o usuario repetido?)', 'editar.php?USUACODIGO=' . $codigo);
    }
    header('Location: index.php');
    exit;
}

// ---- Mostrar formulario ----
$stmt = $conexion->prepare('SELECT USUACODIGO, USUANOMBRE, USUAUSUARIO, USUA_CORREO, USUAROLFK FROM usuario WHERE USUACODIGO = ?');
$stmt->bind_param('i', $codigo);
$stmt->execute();
$u = $stmt->get_result()->fetch_assoc();
if (!$u) {
    aviso_y_redirigir('El usuario no existe', 'index.php');
}
$roles = [ROL_EMPLEADO => 'Empleado', ROL_CLIENTE => 'Cliente'];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <title>Tiendas Celeste · Modificar usuario</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="caja_popup2" id="formmodificar">
    <form method="POST" class="contenedor_popup">
        <?= csrf_field() ?>
        <input type="hidden" name="USUACODIGO" value="<?= (int) $u['USUACODIGO'] ?>">
        <table>
            <tr><th colspan="2">Modificar usuario #<?= (int) $u['USUACODIGO'] ?></th></tr>
            <tr><td>Nombre</td><td><input type="text" name="txtUSUANOMBRE" value="<?= e($u['USUANOMBRE']) ?>" required></td></tr>
            <tr><td>Nombre de Usuario</td><td><input type="text" name="txtUSUAUSUARIO" value="<?= e($u['USUAUSUARIO']) ?>" required></td></tr>
            <tr><td>Nueva contraseña</td><td><input type="password" name="txtUSUAPASSWORD" minlength="6" placeholder="(dejar vacío para no cambiarla)"></td></tr>
            <tr><td>Correo</td><td><input type="email" name="txtUSUA_CORREO" value="<?= e($u['USUA_CORREO']) ?>" required></td></tr>
            <tr><td>Rol</td><td>
                <select name="txtUSUAROLFK">
                    <?php foreach ($roles as $id => $nombre): ?>
                        <option value="<?= $id ?>" <?= (int) $u['USUAROLFK'] === $id ? 'selected' : '' ?>><?= e($nombre) ?></option>
                    <?php endforeach; ?>
                </select>
            </td></tr>
            <tr>
                <td colspan="2">
                    <a href="index.php">Cancelar</a>
                    <input type="submit" name="btnmodificar" value="Modificar" onclick="return confirm('¿Deseas modificar a este usuario?');">
                </td>
            </tr>
        </table>
    </form>
</div>
</body>
</html>
