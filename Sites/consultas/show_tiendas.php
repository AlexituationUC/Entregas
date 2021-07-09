<?php

if (!empty($_POST)) {
  $id = $_POST["id"];
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title> DCCompras </title>
    <!-- Bootstrap(CSS), Jquery (javascripts), etc... -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

    <!-- para que sea index.php pueda importarlo -->
    <link rel="stylesheet" href="styles/mystyles.css">
    <!-- para que una consulta.php pueda importarlo -->
    <link rel="stylesheet" href="../styles/mystyles.css">

    <script src="https://api.mapbox.com/mapbox-gl-js/v2.3.1/mapbox-gl.js"></script>
    <link href="https://api.mapbox.com/mapbox-gl-js/v2.3.1/mapbox-gl.css" rel="stylesheet"/>
    
</head>

<div class="bkg">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand">DCCompras</a>
  </div>
  <div class="navbar-collapse collapse order-3 dual-collapse2">
    <ul class="nav justify-content-end">
      <form class="d-flex" action="index_logged.php" method="post">
        <?php if (!empty($_POST)){echo "<input type='hidden' name='id' value=$id class='form-control'>";} ?>
        <button class="btn btn-primary" type="submit">Home</button>
      </form>
    </ul>
    o
    <ul class="nav justify-content-end">
      <form class="d-flex" action="perfil.php" method="post">
        <?php if (!empty($_POST)){echo "<input type='hidden' name='id' value=$id class='form-control'>";} ?>
        <button class="btn btn-outline-primary" type="submit">Perfil</button>
      </form>
    </ul>
  </div>
</nav>
<br><br>

<body>

<?php 
    $id_tienda = $_POST["id_tienda"];
    $id_usr = $id;
?>

  <h1 align="center"> Consultas para tiendas </h1>

  <div class="container h-100" >

    <br>

    <h3 align="center"> Mostrar los 3 productos mas baratos por categoria </h3>

    <div class="row h-100 justify-content-center align-items-center">
      <div class="col-10 col-md-8 col-lg-6">

        <br>

        <form align="center" action="index_productos.php" method="post">
            <div class="form-floating">
                <?php echo "<input type='hidden' name='id_tienda' value=$t[2] class='form-control'>" ?>
            </div>
            <div class="form-floating">
                <?php echo "<input type='hidden' name='tipo_consulta' value='mas_baratos' class='form-control'>" ?>
            </div>
            <?php if (!empty($_POST)){echo "<div class='form-floating'>
                                              <input type='hidden' name='id' value=$id class='form-control'>
                                            </div>";} ?>

            <button type="submit" class="btn btn-primary"> Ver productos </button>
        </form> 

      </div>
    </div>

    <br><br><br>

    <h3 align="center"> Mostrar productos segun nombre </h3>

    <div class="row h-100 justify-content-center align-items-center">
      <div class="col-10 col-md-8 col-lg-6">

        <br>

        <form align="center" action="index_productos2.php" method="post">

          <div class="form-floating">
            <input type="text" name="producto" class="form-control" placeholder="Nombre contiene">
            <label>Nombre contiene</label>
          </div>
          <div class="form-floating">
            <?php echo "<input type='hidden' name='id_tienda' value=$t[2] class='form-control'>" ?>
          </div>
          <div class="form-floating">
              <?php echo "<input type='hidden' name='tipo_consulta' value='productos_por_nombre' class='form-control'>" ?>
          </div>
          <?php if (!empty($_POST)){echo "<div class='form-floating'>
                                            <input type='hidden' name='id' value=$id class='form-control'>
                                          </div>";} ?>

          <br>

          <button type="submit" class="btn btn-primary"> Ver productos </button>
        </form>

      </div>
    </div>

    <br><br><br>

    <h3 align="center"> Realizar compra segun id </h3>

    <?php
        require("../config/conexion.php");
        $result = $db -> prepare("SELECT Productos.id FROM Productos ORDER BY Productos.id;");
        $result -> execute();
        $productos = $result -> fetchAll();

        $query_direcciones = $db -> prepare("SELECT Direcciones.direccion, Direcciones.id 
                                             FROM Direcciones, Usuarios, pide_a
                                             WHERE Direcciones.id = pide_a.id_direcciones
                                             AND Usuarios.id = pide_a.id_usuarios
                                             AND Usuarios.id = $id_usr;");
        $query_direcciones -> execute();
        $direcciones_usr = $query_direcciones -> fetchAll();
    ?>

    <div class="row h-100 justify-content-center align-items-center">
      <div class="col-10 col-md-8 col-lg-6">

        <br>

        <form align="center" action="generar_compra.php" method="post">

          <div class="form-floating">
            <select class="form-select" name="id_producto">

              <?php
                foreach ($productos as $p) {
                  echo "<option value=$p[0]>$p[0]</option>";
                }
              ?>

            </select>
            <label> Seleccione el id del producto </label>
          </div>

          <div class="form-floating">
            <select class="form-select" name="id_direccion">

              <?php
                foreach ($direcciones_usr as $d) {
                  echo "<option value=$d[1]>$d[0]</option>";
                }
              ?>

            </select>
            <label> Seleccione La direccion asociada </label>
          </div>

          <div class="form-floating">
            <?php echo "<input type='hidden' name='id_tienda' value=$t[2] class='form-control'>" ?>
          </div>
          <?php if (!empty($_POST)){echo "<div class='form-floating'>
                                            <input type='hidden' name='id' value=$id class='form-control'>
                                          </div>";} ?>

          <br>

          <button type="submit" class="btn btn-primary"> Realizar compra </button>
        </form>

      </div>
    </div>

    <br><br><br>

    <form align="center" action="index_tiendas.php" method="post">
      <?php if (!empty($_POST)){echo "<div class='form-floating'>
                                          <input type='hidden' name='id' value=$id class='form-control'>
                                        </div>";} ?>
      <button type="submit" class="btn btn-primary"> Volver a lista de tiendas </button>
    </form>

    <br><br><br>

    <?php
        $query_map = $db -> prepare("SELECT Direcciones.latitude, Direcciones.longitude
                                             FROM Direcciones, Tiendas
                                             WHERE Direcciones.id = Tiendas.id_direccion
                                             AND Tiendas.id = $id_tienda;");
        $query_map -> execute();
        $direccion_map = $query_map -> fetchAll();
        foreach ($direccion_map as $map_dir){
          $latitude = $map_dir[0];
          $longitude = $map_dir[1];
        }
    ?>
    
    <center> <div id='map' style='width: 400px; height: 300px;'></div>
        <script>
            mapboxgl.accessToken = 'pk.eyJ1IjoiZ2FiMC12aCIsImEiOiJja3FmbjBhaG4wczdkMm9udXFxYWtydHl2In0.dNR8LX-3sxjCx6h7xG8Mng';
            var map = new mapboxgl.Map({
                container: 'map',
                style: 'mapbox://styles/mapbox/streets-v11',
                center: [<?php echo $longitude ?>, <?php echo $latitude ?>], //lng,lat
                zoom: 11
            });
            var marker = new mapboxgl.Marker()
            .setLngLat([<?php echo $longitude ?>, <?php echo $latitude ?>])
            .setPopup(new mapboxgl.Popup().setHTML("<h1> Pop up </h1>"))
            .addTo(map);
            map.addControl(new mapboxgl.NavigationControl());
        </script>
    </center>
    
    <br><br><br><br>
  
  </div>

</body>

<?php include('../templates_html/footer.html'); ?>