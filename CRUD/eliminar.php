<?php
require_once __DIR__ . '/../php/auth.php';
requerir_empleado();
requerir_post_csrf(); // eliminar ya no se hace con un simple enlace GET
require_once __DIR__ . '/conexion.php';

$codigo = (int) ($_POST['USUACODIGO'] ?? 0);

if ($codigo === usuario_actual()['codigo']) {
    aviso_y_redirigir('No puedes eliminar tu propia cuenta', 'index.php');
}

try {
    $stmt = $conexion->prepare('DELETE FROM usuario WHERE USUACODIGO = ?');
    $stmt->bind_param('i', $codigo);
    $stmt->execute();
} catch (mysqli_sql_exception $e) {
    // Código 1451: el usuario tiene ventas asociadas (clave foránea)
    $msg = $e->getCode() === 1451 ? 'No se puede eliminar: el usuario tiene ventas registradas' : 'No se pudo eliminar el usuario';
    aviso_y_redirigir($msg, 'index.php');
}

header('Location: index.php');
exit;
