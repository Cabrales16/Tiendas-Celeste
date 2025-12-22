<?php 
include_once("conexion.php");
include_once("index.php");

$USUACODIGO = isset($_GET['USUACODIGO']) ? $_GET['USUACODIGO'] : null;

$querybuscar = mysqli_query($conexion, "SELECT * FROM usuario WHERE USUACODIGO='$USUACODIGO'");

while($mostrar = mysqli_fetch_array($querybuscar))
{   
    $USUACODIGO = $mostrar['USUACODIGO'];
    $USUANOMBRE = $mostrar['USUANOMBRE'];
    $USUAUSUARIO = $mostrar ['USUAUSUARIO'];
    $USUAPASSWORD = $mostrar['USUAPASSWORD'];
    $USUA_CORREO = $mostrar['USUA_CORREO'];
}
?>
<html>
<head>    
    <title>VaidrollTeam</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.cssUSUACODIGO">

<body>

<div class="caja_popup2" id="formmodificar">
    <form method="POST" class="contenedor_popup">
        <table>
            <tr><th colspan="2">Modificar usuario</th></tr>
            <tr> 
                <td>Código</td>
                <td><input type="number" name="txtUSUACODIGO" value="<?php echo $USUACODIGO; ?>" required></td>
            </tr>
            <tr> 
                <td>Nombre</td>
                <td><input type="text" name="txtUSUANOMBRE" value="<?php echo $USUANOMBRE; ?>" required></td>
            </tr>
            <tr> 
                <td>Nombre de Usuario</td>
                <td><input type="text" name="txtUSUAUSUARIO" value="<?php echo $USUAUSUARIO; ?>" required></td>
            </tr>
            <tr> 
                <td>Contraseña</td>
                <td><input type="password" name="txtUSUAPASSWORD" value="<?php echo $USUAPASSWORD; ?>" required></td>
            </tr>
            <tr> 
                <td>Correo</td>
                <td><input type="text" name="txtUSUA_CORREO" value="<?php echo $USUA_CORREO; ?>" required></td>
            </tr>
            <tr>
                <td colspan="2">
                    <a href="index.php">Cancelar</a>
                    <input type="submit" name="btnmodificar" value="Modificar" onClick="javascript: return confirm('¿Deseas modificar a este usuario?');">
                </td>
            </tr>
        </table>
    </form>
</div>
</body>
</html>

<?php
if (isset($_POST['btnmodificar'])) {    
    $USUACODIGO1 = $_POST['txtUSUACODIGO'];
    $USUANOMBRE1 = $_POST['txtUSUANOMBRE'];
    $USUAUSUARIO1 = $_POST['txtUSUAUSUARIO'];
    $USUAPASSWORD1 = $_POST['txtUSUAPASSWORD'];
    $USUA_CORREO1 = $_POST['txtUSUA_CORREO'];

    $querymodificar = mysqli_query($conexion, "UPDATE usuario SET USUACODIGO='$USUACODIGO1', USUANOMBRE='$USUANOMBRE1', USUAUSUARIO='$USUAUSUARIO1', USUAPASSWORD='$USUAPASSWORD1', USUA_CORREO='$USUA_CORREO1' WHERE USUACODIGO='$USUACODIGO1'");

    echo "<script>window.location= 'index.php' </script>";
}