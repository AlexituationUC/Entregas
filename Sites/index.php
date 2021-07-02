<!-- Aqui no use header.html, pues en el home te lleva a ../index.php (y eso no es lo que quiero hacer si ya estoy en index.php) -->

<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title> Información Despachos </title> 

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
    <a class="navbar-brand" href="index.php">Home</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarText">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Info</a>
        </li>
      </ul>
      <form class="d-flex" align="center" action="consultas/login.php" method="post">
        <button class="btn btn-outline-primary" type="submit"> Log-in </button>
      </form>
      <h3 align="center">o </h3>
      <form align="center" action="consultas/registro.php" method="post">
        <button type="submit" class="btn btn-primary"> Registrarse </button>
      </form>
    </div>
  </div>
</nav>
<br><br>

<body>
  <h1 align="center">Wena mates (Todo menos home te lleva a perfil.php) </h1>

  <div class="container h-100" >

    <br>

    <h3 align="center"> Asi se hace un form con input texto, also el boton </h3>

    <!-- Estos divs estan para que el boton este al centro de la textbox -->
    <div class="row h-100 justify-content-center align-items-center">
      <div class="col-10 col-md-8 col-lg-6"> 

        <br>

        <form align="center" action="consultas/perfil.php" method="post">

          <!-- El form floating es para que el texto se mueva del lugar cuando lo presionas, se ve bonito -->
          <!-- El nombre de lo que envias va en name="nombre" (duh) -->
          <!-- En la documentacion placeholder era igual a lo que va en label, en mi experiencia no es necesario, pero lo hago igual -->
          <div class="form-floating">
            <input type="text" name="comuna_elegida" class="form-control" placeholder="Comuna">
            <label>Comuna</label>
          </div>

          <br>

          <div class="form-floating">
            <input type="text" name="year_elegido" class="form-control" placeholder="Año de despacho">
            <label>Año de despacho</label>
          </div>

          <br>

          <!-- Aqui esta el boton xd -->
          <button type="submit" class="btn btn-primary">Buscar</button>
        </form>

      </div>
    </div>
    
    <br><br><br>

    <h3 align="center"> Asi se hace un dropdown, also el boton </h3>

    <!-- Una vez mas, esto es para centrar, usenlo pls -->
    <div class="row h-100 justify-content-center align-items-center">
      <div class="col-10 col-md-8 col-lg-6">

        <br>

        <!-- Aqui empieza el form -->
        <form align="center" action="consultas/perfil.php" method="post">

          <div class="form-floating">
            <select class="form-select" name="tipo_elegido">

              <!-- Aqui van las opciones, value es lo que envias (duh) -->
              <!-- Con php puedes hacer un loop para colocar varias opciones, -->
              <!-- ^ pero eso es usar este formato en lo que nos enseñaron en la entrega anterior -->
              <option value="opcion_1">opcion_1</option>
              <option value="opcion_2">opcion_2</option>

            </select>
            <label>Seleccione un tipo de vehiculo</label>
          </div>

          <br>

          <!-- Aqui hay mas forms de texto xd -->
          <div class="form-floating">
            <input type="text" name="edad_min_elegida" class="form-control" placeholder="Edad mínima repartidor">
            <label>Edad mínima repartidor</label>
          </div>

          <br>

          <div class="form-floating">
            <input type="text" name="edad_max_elegida" class="form-control" placeholder="Edad máxima repartidor">
            <label>Edad máxima repartidor</label>
          </div>

          <br>

          <button type="submit" class="btn btn-primary">Buscar</button>
        </form>

      </div>
    </div>

    <br><br><br>
    
    <h3 align="center"> Existen mas tipos de forms y weas en bootstrap, para eso investiguen por su cuenta </h3>
    <h3 align="center"> Revisen https://getbootstrap.com/docs/5.0/getting-started/introduction/ </h3>
    <h3 align="center"> A la derecha hay una parte de forms y una de components, por si quieren buscar </h3>

    <br><br><br><br>
  
  </div>

<!-- Aqui coloque el footer -->
<?php include('templates_html/footer.html'); ?>