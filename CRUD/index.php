<?php
include_once("conexion.php"); 
?>

<html>
<head>    
    <title>Gerardo Paredes</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <table border="10">
        <img src="../php/ASSETS/IMAGENES/LOGO EMPRESA1.1.PNG" id="logon">
        <div id="barrabuscar">
            <form method="POST">
                <input type="submit" value="Buscar" name="btnbuscar">
                <input type="text" name="txtbuscar" id="cajabuscar" placeholder="&#128270;Ingresa el codigo del usuario">
            </form>
        </div>
        <tr><th colspan="11"><h1>LISTEN DE ACUERDO A SU BASE DE DATOS</h1></tr>
        <tr>
            <th colspan="7"><a style="font-weight: normal; font-size: 20px;" onclick="abrirform()">Agregar</a></th>
            <th colspan="4">
                <a style="font-weight: normal; font-size: 14px;" href="pdf_report.php">Generar Reporte PDF</a>
            </th>
        </tr>
        <tr>
            <th>Codigo</th>
            <th>USUACODIGO</th>
            <th>USUANOMBRE</th>
            <th>USUAUSUARIO</th>
            <th>USUAPASSWORD</th>
            <th>USUA_CORREO</th>
            <th>Modificar/Eliminar</th>
        </tr>
        <?php 
        if (isset($_POST['btnbuscar'])) {
            $buscar = mysqli_real_escape_string($conexion, $_POST['txtbuscar']);
            $queryusuarios = mysqli_query($conexion, "SELECT USUACODIGO, USUANOMBRE, USUAUSUARIO, USUAPASSWORD, USUA_CORREO FROM usuario WHERE USUACODIGO LIKE '".$buscar."%'");
        } else {
            $queryusuarios = mysqli_query($conexion, "SELECT * FROM usuario ORDER BY USUACODIGO ASC");
        }
        
        $numerofila = 0;
        while ($mostrar = mysqli_fetch_array($queryusuarios)) {    
            $numerofila++;    
            echo "<tr>";
            echo "<td>".$numerofila."</td>";
            echo "<td>".$mostrar['USUACODIGO']."</td>";
            echo "<td>".$mostrar['USUANOMBRE']."</td>";
            echo "<td>".$mostrar['USUAUSUARIO']."</td>";    
            echo "<td>".$mostrar['USUAPASSWORD']."</td>";  
            echo "<td>".$mostrar['USUA_CORREO']."</td>";
            echo "<td style='width:26%'><a href=\"editar.php?USUACODIGO=".$mostrar['USUACODIGO']."\">Modificar</a> | <a href=\"eliminar.php?USUACODIGO=".$mostrar['USUACODIGO']."\" onClick=\"return confirm('¿Estás seguro de eliminar a ".$mostrar['USUANOMBRE']."?')\">Eliminar</a></td>";           
            echo "</tr>";
        }
        ?>
    </table>
    
    <script>
    function abrirform() {
        document.getElementById("formregistrar").style.display = "block";
    }

    function cancelarform() {
        document.getElementById("formregistrar").style.display = "none";
    }
    </script>
    
    <div class="caja_popup" id="formregistrar">
        <form action="agregar.php" class="contenedor_popup" method="POST">
            <table>
                <tr><th colspan="2">Usuario</th></tr>
                <tr> 
                    <td>Código</td>
                    <td><input type="number" name="USUACODIGO" required></td>
                </tr>
                <tr> 
                    <td>Nombre</td>
                    <td><input type="text" name="USUANOMBRE" required></td>
                </tr>
                <tr> 
                    <td>Usuario</td>
                    <td><input type="text" name="USUAUSUARIO" required></td>
                </tr>
                <tr> 
                    <td>Contraseña</td>
                    <td><input type="password" name="USUAPASSWORD" required></td>
                </tr>
                <tr> 
                    <td>Correo</td>
                    <td><input type="text" name="USUA_CORREO" required></td>
                </tr>
                <tr> 
                    <td colspan="2">
                        <button type="button" onclick="cancelarform()">Cancelar</button>
                        <input type="submit" name="btnregistrar" value="Registrar" onClick="javascript: return confirm('¿Deseas registrar a este usuario?');">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</body>
</html>