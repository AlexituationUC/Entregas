<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title> Información Despachos </title>
    <!-- Bootstrap(CSS), Jquery (javascripts), etc... -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

    <!-- para que sea index.php pueda importarlo -->
    <link rel="stylesheet" href="styles/mystyles.css">
    <!-- para que una consulta.php pueda importarlo -->
    <link rel="stylesheet" href="../styles/mystyles.css">
    
</head>

<div class="bkg">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="../index.php">Home</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarText">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Info</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
<br><br>

<!-- Aqui esta la informacion mostrada en pantalla -->

<body>
    <div class="container h-100" >
        <h1 align="center">Registrar Usuario </h1>
        <div class="row h-100 justify-content-center align-items-center">
            <div class="col-10 col-md-8 col-lg-6">
                <h3 align="center">Ingrese sus datos</h3>

                <br>

                <form align="center" action='consultas_registro/registro.php' method='POST'>

                    <div class="form-floating">
                        <input type="text" name="nombre" class="form-control" placeholder="Nombre">
                        <label>Nombre</label>
                    </div>

                    <br>

                    <div class="form-floating">
                        <input type="text" name="rut" class="form-control" placeholder="Rut">
                        <label>Rut</label>
                    </div>

                    <br>

                    <div class="form-floating">
                        <input type="number" name="edad" class="form-control" placeholder="Edad">
                        <label>Edad</label>
                    </div>

                    <br>

                    <div class="form-floating">
                        <input type="text" name="direccion" class="form-control" placeholder="Direccion">
                        <label>Direccion</label>
                    </div>

                    <br>

                    <button type="submit" class="btn btn-primary">Registrar</button>
                </form>
            </div>
        </div>
    </div>

</body>

<?php include('../templates_html/footer.html'); ?>