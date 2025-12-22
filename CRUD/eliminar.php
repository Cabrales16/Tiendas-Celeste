
<?php
include_once("conexion.php");
 
$USUACODIGO = $_GET['USUACODIGO'];
 
mysqli_query($conexion, "DELETE FROM usuario WHERE USUACODIGO=$USUACODIGO");
 
header("Location:index.php");

?>