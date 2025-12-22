<?php
 session_start();
 if(!isset($_SESSION['usuario'])){
  echo '
  <script>
  alert("Por favor debes iniciar sesion");
  window.location = "login.php";
  </script>
  ';
  //header("location: index.php");
  session_destroy(); 
  die();
  
 }

 //session_destroy(); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tiendas Celeste</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<link rel="stylesheet" href="assets/css/index.css">
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


      <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img src="assets/images/accesorios.jpg" class="d-block w-100" alt="accesorios">
          </div>
          <div class="carousel-item">
            <img src="assets/images/dulces.jpg" class="d-block w-100" alt="dulces">
          </div>
          <div class="carousel-item">
            <img src="assets/images/maquillaje.jpeg" class="d-block w-100" alt="maquillaje">
          </div>
          <div class="carousel-item">
            <img src="assets/images/peluches.jpeg" class="d-block w-100" alt="dulces">
          </div>
          <div class="carousel-item">
            <img src="assets/images/regalos.jpeg" class="d-block w-100" alt="regalos">
          </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>

      <div id="ofertastodo">
        <div id="ofertas">
            <h1>Ofertas</h1>
          </div>
    
    
          <div class="card-group" id="prodofertas">
            <div class="card">
              <img src="assets/images/posilloregalo.jpeg" class="card-img-top" alt="pocillo" style="height: 500px;">
              <div class="card-body">
                <h5 class="card-title">Pocillo de regalo</h5>
                <p class="card-text">El posillo de regalo es un encantador conjunto de sorpresas cuidadosamente seleccionadas. Puede incluir dulces, bolsos, desayunos sorpresa y otros artículos especiales. Es el regalo perfecto para celebrar ocasiones especiales o simplemente para alegrar el día de alguien.</p>
                <a href="#" class="btn btn-primary">Ver el producto</a>
            </div>
            </div>
            <div class="card">
              <img src="assets/images/cajadedulces.jpeg" class="card-img-top" alt="caja" style="height: 500px;">
              <div class="card-body">
                <h5 class="card-title">Caja de dulces</h5>
                <p class="card-text">La caja de dulces es un comestible compuesto de azúcar, con un sabor dulce muy agradable al paladar. Puede contener una variedad de delicias como chocolates, galletas, tartas o pasteles. Es ideal para regalar o disfrutar en ocasiones especiales.</p>
                <a href="#" class="btn btn-primary">Ver el producto</a>
            </div>
            </div>
            <div class="card">
              <img src="assets/images/cadena.jpeg" class="card-img-top" alt="cadena" style="height: 500px;">
              <div class="card-body">
                <h5 class="card-title">Cadena de corazón</h5>
                <p class="card-text">Una elegante y delicada cadena con un colgante en forma de corazón. Perfecta para expresar amor y cariño, ideal para regalar en ocasiones especiales o para añadir un toque romántico a tu estilo diario.</p>
                <br>
                <a href="#" class="btn btn-primary">Ver el producto</a>
            </div>
            </div>
          </div>
      </div>

      <div id="footer">
            <h1><p id="tituloinf">Quienes somos</p></h1>
            <ul id="lista">
                <li><em>Obsequios como caídos del cielo</em></li>
                <br>
                <li><a href="https://www.facebook.com/ObsequiosCeleste/" target="_blank" rel="noopener noreferrer"><img src="assets/images/facebook.png" alt="" style="height: 50px;"></a>     
                    <a href="https://www.tiktok.com/@obsequiosceleste" target="_blank" rel="noopener noreferrer"><img src="assets/images/tiktok.png" alt="" style="height: 50px;"></a>     
                    <a href="https://www.instagram.com/obsequiosceleste?igsh=MTQweG43aHo3bXRkNg==" target="_blank" rel="noopener noreferrer"><img src="assets/images/instagram.png" alt="" style="height: 50px;"></a>     @ObsequiosCeleste</li>
                <br>
                <li><img src="assets/images/whatsapp.png" alt="" style="height: 50px;">     3232459309</li>
                <br>
                <li>Centro comercial punto 72</li>
            </ul>
      </div>
</body>
</html>