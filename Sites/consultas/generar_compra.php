<?php include('../templates_html/header.php'); ?>

<body>

<?php
  	require("../config/conexion.php");

  	$id_tienda = intval($_POST["id_tienda"]);
  	$id_producto = intval($_POST["id_producto"]);
    $id_usr = $id;
    $id_direccion = intval($_POST["id_direccion"]);

    $query_compra = "SELECT realizar_compra($id_usr, $id_producto, $id_tienda, $id_direccion);";
    $resultado_compra = $db -> prepare($query_compra);
    $resultado_compra -> execute();
    $compra = $resultado_compra -> fetchAll();
    echo $compra[0];

    if ($compra[0] == "Producto no disponible en esta tienda"){
        echo "<div class='row h-100 justify-content-center align-items-center'>
              <div class='col-10 col-md-8 col-lg-6'>
              <h3>Producto no disponible en esta tienda</h3>
              </div>
              </div>
              <br><br>";

    } elseif ($compra[0] == "Tienda no reparte a su comuna"){
        echo "<div class='row h-100 justify-content-center align-items-center'>
              <div class='col-10 col-md-8 col-lg-6'>
              <h3>Tienda no reparte a su comuna</h3>
              </div>
              </div>
              <br><br>";
    } else {
        echo "<div class='row h-100 justify-content-center align-items-center'>
              <div class='col-10 col-md-8 col-lg-6'>
              <h3>Felicidadez! Compra realizada de forma exitosa</h3>
              </div>
              </div>
              <br><br>";
    }

?>

<form align='center' action='show_tiendas.php' method='post'>
    <div class='form-floating'>
        <?php echo "<input type='hidden' name='id_tienda' value=$id_tienda class='form-control'>" ?>
    </div>
    <?php if (!empty($_POST)){echo "<div class='form-floating'>
                                        <input type='hidden' name='id' value=$id class='form-control'>
                                    </div>";} ?>

    <button type='submit' class='btn btn-primary'> Regresar a la tienda </button>
</form>

<?php include('../templates_html/footer.html'); ?>