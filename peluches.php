<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peluches</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="assets/css/peluches.css">
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
              </li>
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#tituloinf">Quienes somos</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="php/cerrar_sesion.php" id="cerrar">Cerrar sesión</a>
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

      <div id="titulo">
            <h1><p id="titulodesayuno">🧸Peluches🐈</p></h1>
      </div>


      <div class="card-group" id="productos">
        <div class="card">
          <img src="assets/images/peluches1.jpeg" class="card-img-top" alt="pocillo" style="height: 500px;">
          <div class="card-body">
            <h5 class="card-title">Oso de peluche</h5>
            <p class="card-text">Suave y adorable oso de peluche con un lazo de satén. Perfecto para abrazar y brindar consuelo, este osito es el compañero ideal para todas las edades.</p>
            <br><br>
            <a href="#" class="btn btn-primary">Ver el producto</a>
        </div>
        </div>
        <div class="card">
          <img src="assets/images/peluches2.jpeg" class="card-img-top" alt="caja" style="height: 500px;">
          <div class="card-body">
            <h5 class="card-title">Gato de peluche</h5>
            <p class="card-text">Encantador gato de peluche con un pelaje aterciopelado y detalles realistas. Este felino es perfecto para los amantes de los gatos y se convertirá en el amigo inseparable de cualquier niño.</p>
            <br>
            <a href="#" class="btn btn-primary">Ver el producto</a>
        </div>
        </div>
        <div class="card">
          <img src="assets/images/peluches3.jpg" class="card-img-top" alt="cadena" style="height: 500px;">
          <div class="card-body">
            <h5 class="card-title">Perro de peluche</h5>
            <p class="card-text">Tierno perro de peluche con orejas caídas y una expresión amigable. Hecho de materiales de alta calidad, este perrito es perfecto para abrazar y jugar, convirtiéndose en el mejor amigo de cualquier niño.</p>
            <br>
            <a href="#" class="btn btn-primary">Ver el producto</a>
        </div>
        </div>
      </div>
</body>
</html>