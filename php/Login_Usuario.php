<?php
session_start();
include 'conexion_be.php';
$USUA_CORREO = $_POST['USUA_CORREO'];
$USUAPASSWORD = $_POST['USUAPASSWORD'];

$validar_login = mysqli_query($conexion,"SELECT*FROM usuario WHERE USUA_CORREO='$USUA_CORREO' and USUAPASSWORD ='$USUAPASSWORD'");

if(mysqli_num_rows($validar_login)>0){
    $_SESSION ['usuario']=$USUA_CORREO;
header("location: ../index.php");
exit;
}else{
    echo'
    <script>
    alert("Usuario no existe, por favor verifique los datos introducidos");
    window.location="../index.php";
    </script>
    ';
    exit;

}
?>