<?php
include 'conexion_be.php';
$USUACODIGO = $_POST['USUACODIGO'];
$USUANOMBRE = $_POST['USUANOMBRE'];
$USUA_CORREO = $_POST ['USUA_CORREO'];
$USUAUSUARIO = $_POST['USUAUSUARIO'];
$USUAPASSWORD = $_POST['USUAPASSWORD'];

$query="INSERT INTO usuario(USUACODIGO,USUANOMBRE,USUA_CORREO,USUAUSUARIO,USUAPASSWORD)
VALUES( '$USUACODIGO','$USUANOMBRE', '$USUA_CORREO', '$USUAUSUARIO', '$USUAPASSWORD')";
//verificar que el correo no se repita
$verificar_correo = mysqli_query($conexion,"SELECT*FROM usuario WHERE USUA_CORREO='$USUA_CORREO'");
if(mysqli_num_rows($verificar_correo) > 0){
    echo'
    <script>
    alert("Este correo ya esta registrado, intenta con otro diferente");
    window.location = "../index.php";
    </script>
    ';
    exit();
}
//verificar que el nombre de ususario no se repita
$verificar_nombre = mysqli_query($conexion,"SELECT*FROM usuario WHERE  USUAUSUARIO='$USUAUSUARIO'");
if(mysqli_num_rows($verificar_nombre) > 0){
    echo'
    <script>
    alert("Este nombre ya esta registrado, intenta con otro diferente");
    window.location = "../index.php";
    </script>
    ';
    exit();
}
$ejecutar = mysqli_query($conexion, $query);

if($ejecutar){
    echo '
    <script>
        alert("Usuario almasenado exitosamente");
        window.location ="../index.php"
    
        </script>
    ';
    }

    else{'
        <script>
        alert("intentelelo denuevo usuario no almasenado");
        window.location ="../index.php";
        </script>
    ';
    }
    mysqli_close($conexion);
     ?>