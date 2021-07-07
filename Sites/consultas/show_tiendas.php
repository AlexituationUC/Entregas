<?php include('../templates_html/header.html'); ?>

<body>

<?php 
    $id_tienda = $_POST["id_tienda"];
    $id_usr = $_SESSION["id"]
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

            <button type="submit" class="btn btn-primary"> Ver productos </button>
        </form> 

      </div>
    </div>

    <br><br><br>

    <h3 align="center"> Mostrar productos segun nombre </h3>

    <div class="row h-100 justify-content-center align-items-center">
      <div class="col-10 col-md-8 col-lg-6">

        <br>

        <form align="center" action="index_productos.php" method="post">

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

          <br>

          <button type="submit" class="btn btn-primary"> Ver productos </button>
        </form>

      </div>
    </div>

    <br><br><br>

    <h3 align="center"> Realizar compra segun id </h3>

    <?php
        require("../config/conexion.php");
        $result = $db -> prepare("SELECT Productos.id FROM Productos;");
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

          <br>

          <button type="submit" class="btn btn-primary"> Realizar compra </button>
        </form>

      </div>
    </div>

    <br><br><br>

    <form align="center" action="index_tiendas.php" method="post">
      <button type="submit" class="btn btn-primary"> Volver a lista de tiendas </button>
    </form>

    <br><br><br><br>
  
  </div>

</body>

<?php include('../templates_html/footer.html'); ?>