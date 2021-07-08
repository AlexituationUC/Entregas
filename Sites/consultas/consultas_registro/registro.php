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
    <a class="navbar-brand">DCCompras</a>
    <form class="d-flex" action="../../index.php" method="post">
      <button class="btn btn-primary" type="submit">Home</button>
    </form>
  </div>
</nav>
<br><br>

<?php

    // Nos conectamos a las bdds
    require("../../config/conexion.php");


    // Se revisa el registro y se obtiene un booleano que indica si se logro o no
    $query = "SELECT verificar_registro('$_POST[nombre]', '$_POST[rut]', $_POST[edad], $_POST[direccion]);";
    $result = $db -> prepare($query);
    $result -> execute();

    $registrado = $result -> fetchAll();

?>


<body>
<div class="container h-100" >
        <h1 align="center">Registrar Usuario </h1>

        <br><br><br><br><br>

        <div class="row h-100 justify-content-center align-items-center">
            <div class="col-10 col-md-8 col-lg-6">

                <!-- Aqui se elige que mostrar en la pagina dependiendo de si
                     si se logro registrar correctamente o no -->
                <h3 align="center"><?php
                if ($registrado){
                    echo "Registro exitoso";
                    $rut_usr = $_POST['rut'];
                    // Esto nos da el id del usuario que se acaba de logear
                    $query = "SELECT id FROM Usuarios as u WHERE u.rut = '$rut_usr';";
                    $result = $db -> prepare($query);
                    $result -> execute();
                    $tabla = $result -> fetchAll();
                    foreach ($tabla as $tab){
                      $id = $tab[0];
                    }
                    // define a donde redigira la pagina una vez presionado el boton
                    $ir = "../../templates_php/pagina_usuario.php";
                    $boton = "Ir a perfil";
                } else {
                    echo "Registro fallido";
                    $id = 0; // esto da lo mismo
                    $ir = "../registro.php";
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