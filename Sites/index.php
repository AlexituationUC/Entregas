<!-- Aqui no use header.html, pues en el home te lleva a ../index.php (y eso no es lo que quiero hacer si ya estoy en index.php) -->

<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title> DCCompras </title> 

    <!-- Bootstrap(CSS), Jquery (javascripts), etc... -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

    <!-- importamos el style xd -->
    <link rel="stylesheet" href="styles/mystyles.css">
    
</head>

<div class="bkg">

<!-- Aqui se crea la navbar, no se preocupen, ya esta completa... a no ser que agregemos otra funcionalidad -->

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand">DCCompras</a>
  </div>
  <div class="navbar-collapse collapse order-3 dual-collapse2">
    <ul class="nav justify-content-end">
      <form class="d-flex" action="consultas/login.php" method="post">
        <button class="btn btn-primary" type="submit">Login</button>
      </form>
    </ul>
    o
    <ul class="nav justify-content-end">
      <form class="d-flex" action="consultas/registro.php" method="post">
        <button class="btn btn-outline-primary" type="submit">Registrarse</button>
      </form>
    </ul>
  </div>
</nav>

<br><br>

<body>

  <h1 align="center">DCCompras</h1>
  <h3 align="center">La mejor pagina de compras de todo atlantis</h3>
    
    <br><br>

    <div id="carouselExampleCaptions" class="carousel carousel-dark slide" data-bs-ride="carousel">
      <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
      </div>
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="https://i.imgur.com/rCMqSln.jpeg" class="d-block w-100" alt="...">
          <div class="carousel-caption d-none d-md-block">
            <h5>Multiples tiendas en un solo lugar</h5>
            <p>Para asegurarte que tenemos el producto que tu buscas</p>
          </div>
        </div>
        <div class="carousel-item">
          <img src="https://i.imgur.com/WEztS3D.jpeg" class="d-block w-100" alt="...">
          <div class="carousel-caption d-none d-md-block">
            <h5>Pago online</h5>
            <p>Accede a cualquier tienda desde la comodidad de tu casa</p>
          </div>
        </div>
        <div class="carousel-item">
          <img src="https://i.imgur.com/cbYjsu2.jpeg" class="d-block w-100" alt="...">
          <div class="carousel-caption d-none d-md-block">
            <h5>Despacho a multiples comunas</h5>
            <p>No importa donde vivas, tenemos una tienda para ti</p>
          </div>
        </div>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>

    <br><br><br>

    <h3 align="center">Ingresa a tu cuenta para empezar a comprar</h3>

    <div class="row h-100 justify-content-center align-items-center">
      <div class="col-10 col-md-8 col-lg-6"> 

        <br>

        <form align="center" action="consultas/login.php" method="post">
          <h5> Ya tienes cuenta </h5>
          <button type="submit" class="btn btn-primary">Log-in</button>
        </form>

        <br>
        <form align="center" action="consultas/registro.php" method="post">
        <h5> Crear cuenta </h5>
          <button type="submit" class="btn btn-primary">Registrarse</button>
        </form>

      </div>
    </div>

    <br><br><br>
  
  </div>

<!-- Aqui coloque el footer -->
<?php include('templates_html/footer.html'); ?>