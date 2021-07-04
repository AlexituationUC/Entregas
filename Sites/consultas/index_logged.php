<?php include('../templates_html/header.html'); ?>

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

    <h3 align="center">Revisa nuestras tiendas</h3>

    <div class="row h-100 justify-content-center align-items-center">
      <div class="col-10 col-md-8 col-lg-6"> 

        <br>

        <form align="center" action="index_tiendas.php" method="post">
          <button type="submit" class="btn btn-primary">Ir a tiendas</button>
        </form>

      </div>
    </div>

    <br><br><br>
  
  </div>

<!-- Aqui coloque el footer -->
<?php include('../templates_html/footer.html'); ?>