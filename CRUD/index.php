<?php
require_once __DIR__ . '/../php/auth.php';
requerir_empleado();
require_once __DIR__ . '/conexion.php';

$buscar = trim($_GET['txtbuscar'] ?? '');
if ($buscar !== '') {
    $like = $buscar . '%';
    $stmt = $conexion->prepare('SELECT USUACODIGO, USUANOMBRE, USUAUSUARIO, USUA_CORREO, USUAROLFK FROM usuario WHERE USUACODIGO LIKE ? OR USUANOMBRE LIKE ? ORDER BY USUACODIGO ASC');
    $stmt->bind_param('ss', $like, $like);
    $stmt->execute();
    $usuarios = $stmt->get_result();
} else {
    $usuarios = $conexion->query('SELECT USUACODIGO, USUANOMBRE, USUAUSUARIO, USUA_CORREO, USUAROLFK FROM usuario ORDER BY USUACODIGO ASC');
}
$roles = [ROL_EMPLEADO => 'Empleado', ROL_CLIENTE => 'Cliente'];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <title>Tiendas Celeste · Usuarios</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <table border="10">
        <img src="logo.png" id="logon" alt="Tiendas Celeste">
        <div id="barrabuscar">
            <form method="GET">
                <input type="submit" value="Buscar">
                <input type="text" name="txtbuscar" id="cajabuscar" value="<?= e($buscar) ?>" placeholder="&#128270;Ingresa el código o nombre del usuario">
            </form>
        </div>
        <tr><th colspan="7"><h1>Gestión de usuarios</h1></th></tr>
        <tr>
            <th colspan="3"><a style="font-weight: normal; font-size: 20px;" href="#" onclick="abrirform(); return false;">Agregar</a></th>
            <th colspan="2"><a style="font-weight: normal; font-size: 14px;" href="pdf_report.php">Generar Reporte PDF</a></th>
            <th colspan="2"><a style="font-weight: normal; font-size: 14px;" href="../index.php">Volver a la tienda</a></th>
        </tr>
        <tr>
            <th>No</th>
            <th>Código</th>
            <th>Nombre</th>
            <th>Usuario</th>
            <th>Correo</th>
            <th>Rol</th>
            <th>Modificar/Eliminar</th>
        </tr>
        <?php $numerofila = 0; while ($u = $usuarios->fetch_assoc()): $numerofila++; ?>
        <tr>
            <td><?= $numerofila ?></td>
            <td><?= e($u['USUACODIGO']) ?></td>
            <td><?= e($u['USUANOMBRE']) ?></td>
            <td><?= e($u['USUAUSUARIO']) ?></td>
            <td><?= e($u['USUA_CORREO']) ?></td>
            <td><?= e($roles[(int) $u['USUAROLFK']] ?? '—') ?></td>
            <td style="width:26%">
                <a href="editar.php?USUACODIGO=<?= (int) $u['USUACODIGO'] ?>">Modificar</a>
                <form method="POST" action="eliminar.php" style="display:inline"
                      onsubmit="return confirm(<?= e(json_encode('¿Estás seguro de eliminar a ' . $u['USUANOMBRE'] . '?', JSON_UNESCAPED_UNICODE)) ?>)">
                    <?= csrf_field() ?>
                    <input type="hidden" name="USUACODIGO" value="<?= (int) $u['USUACODIGO'] ?>">
                    <input type="submit" value="Eliminar">
                </form>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>

    <script>
    function abrirform() { document.getElementById("formregistrar").style.display = "block"; }
    function cancelarform() { document.getElementById("formregistrar").style.display = "none"; }
    </script>

    <div class="caja_popup" id="formregistrar">
        <form action="agregar.php" class="contenedor_popup" method="POST">
            <?= csrf_field() ?>
            <table>
                <tr><th colspan="2">Usuario</th></tr>
                <tr><td>Nombre</td><td><input type="text" name="USUANOMBRE" required></td></tr>
                <tr><td>Usuario</td><td><input type="text" name="USUAUSUARIO" required></td></tr>
                <tr><td>Contraseña</td><td><input type="password" name="USUAPASSWORD" minlength="6" required></td></tr>
                <tr><td>Correo</td><td><input type="email" name="USUA_CORREO" required></td></tr>
                <tr><td>Rol</td><td>
                    <select name="USUAROLFK">
                        <?php foreach ($roles as $id => $nombre): ?>
                            <option value="<?= $id ?>" <?= $id === ROL_CLIENTE ? 'selected' : '' ?>><?= e($nombre) ?></option>
                        <?php endforeach; ?>
                    </select>
                </td></tr>
                <tr>
                    <td colspan="2">
                        <button type="button" onclick="cancelarform()">Cancelar</button>
                        <input type="submit" value="Registrar" onclick="return confirm('¿Deseas registrar a este usuario?');">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</body>
</html>
