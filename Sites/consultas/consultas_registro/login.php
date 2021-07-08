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
    <link rel="stylesheet" href="../../styles/mystyles.css">
    
</head>

<div class="bkg">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="../../index.php">Home</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarText">
    </div>
  </div>
</nav>
<br><br>

<?php

    // Nos conectamos a las bdds
    require("../../config/conexion.php");


    // Esta consulta nos da una tabla con los ruts y claves de los usuarios en la DB
    $query = "SELECT rut, clave FROM info_Usuarios;";
    $result = $db -> prepare($query);
    $result -> execute();

    $usuarios = $result -> fetchAll();

    // Si el rut y la contraseña ingresados corresponden a un usuario registrado el logeo
    // se realiza con exito
    foreach ($usuarios as $u){
        if ($u[0] == $_POST['rut'] and $u[1] == $_POST['clave']){
            $logeado = TRUE;
            break;
        } else {
            $logeado = FALSE;
        }
    }

?>


<body>
<div class="container h-100" >
        <h1 align="center">Log-in </h1>

        <br><br><br><br>

        <div class="row h-100 justify-content-center align-items-center">
            <div class="col-10 col-md-8 col-lg-6">

                <!-- Aqui se elige que mostrar en la pagina dependiendo de si
                     si se logro logear correctamente o no -->
                <h3 align="center"><?php
                if ($logeado){
                    echo "Log-in exitoso";
                    // Esto nos da el id del usuario que se acaba de logear
                    $rut_usr = $_POST['rut'];
                    $query = "SELECT id FROM Usuarios as u WHERE u.rut='$rut_usr';";
                    $result = $db -> prepare($query);
                    $result -> execute();
                    $tabla = $result -> fetchAll();
                    foreach ($tabla as $tab){
                      $id = $tab[0];
                    }
                    // define a donde redigira la pagina una vez presionado el boton
                    $ir = "../perfil.php";
                    $boton = "Ir a perfil";
                } else {
                    echo "Log-in fallido";
                    $id = 0; // esto da lo mismo
                    $ir = "../login.php";
                    $boton = "Volver";
                }
                ?></h3>

                <br>
                <form align="center" action="<?php echo $ir ?>" method="post">
                    <input type="hidden" name="id" value="<?php echo $id ?>">
                    <button type="submit" class="btn btn-primary"><?php echo $boton ?></button>
                </form>

            </div>
        </div>
    </div>
</body>

<?php include('../../templates_html/footer.html'); ?>