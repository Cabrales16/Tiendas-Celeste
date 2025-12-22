<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión o registrarse</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet"><link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="assets/css/estilos.css">
</head>
<body>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
          <a class="navbar-brand" href="index.php"><img src="assets/images/logo.png" alt="logo" style="height: 50px;"></a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="login.php">Iniciar sesión</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#tituloinf">Quienes somos</a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Tienda
                </a>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="desayunos.php">Desayunos</a></li>
                  <li><a class="dropdown-item" href="peluches.php">Peluches</a></li>
                  <li><a class="dropdown-item" href="dulces.php">Dulces</a></li>
                  <li><a class="dropdown-item" href="accesorios.php">Accesorios</a></li>
                  <li><a class="dropdown-item" href="juguetes.php">Juguetes</a></li>
                  <li><a class="dropdown-item" href="maquillaje.php">Maquillaje</a></li>
                  <li><a class="dropdown-item" href="regalos.php">Regalos</a></li>
                </ul>
              </li>
            </ul>
          </div>
        </div>
      </nav>
        <main>

            <div class="contenedor__todo">
                <div class="caja__trasera">
                    <div class="caja__trasera-login">
                        <h3>¿Ya tienes una cuenta?</h3>
                        <p>Inicia sesión para entrar en la página</p>
                        <button id="btn__iniciar-sesion">Iniciar Sesión</button>
                    </div>
                    <div class="caja__trasera-register">
                        <h3>¿Aún no tienes una cuenta?</h3>
                        <p>Regístrate para que puedas iniciar sesión</p>
                        <button id="btn__registrarse">Regístrarse</button>
                    </div>
                </div>

                <!--Formulario de Login y registro-->
                <div class="contenedor__login-register">
                    <!--Login-->
                    <form action="php/Login_Usuario.php" method = "POST" class="formulario__login">
                        <h2>Iniciar Sesión</h2>
                        <input type="text" placeholder="Ingrese su correo electrónico" name="USUA_CORREO">
                        <input type="password" placeholder="Ingrese su contraseña" name="USUAPASSWORD">
                        <button>Entrar</button>
                    </form>

                    <!--Register-->
                    <form action="php/registro_usuario_be.php" method = "POST" class="formulario__register">
                        <h2>Regístrarse</h2>
                        <input type="number" placeholder="Ingrese su código" name="USUACODIGO">
                        <input type="text" placeholder="Ingrese su nombre de usuario" name="USUANOMBRE">
                        <input type="text" placeholder="Ingrese su correo electrónico" name="USUA_CORREO">
                        <input type="text" placeholder="Ingrese su apodo" name="USUAUSUARIO">
                        <input type="password" placeholder="Ingrese su contraseña" name="USUAPASSWORD">
                        <button>Regístrarse</button>
                    </form>
                </div>
            </div>

        </main>
        <script src="assets/js/script.js"></script>
</body>
</html>