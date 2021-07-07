<?php include('../templates_html/header.html'); ?>

<body>

<?php
  	require("../config/conexion.php");
    session_start();

  	$id_tienda = intval($_POST["id_tienda"]);
  	$id_producto = intval($_POST["id_producto"]);
    $id_usr = intval($_SESSION["id"]);
    $id_direccion = intval($_POST["id_direccion"]);

    $query_compra = "SELECT realizar_compra($id_usr, $id_producto, $id_tienda, $id_direccion);";
    $resultado_compra = $db -> prepare($query_compra);
    $resultado_compra -> execute();
    $compra = $resultado_compra -> fetchAll();

    if ($compra == "Producto no disponible en esta tienda"){
        echo "<h3>Producto no disponible en esta tienda</h3>
              <br><br>";

    } elseif ($compra == "Tienda no reparte a su comuna"){
        echo "<h3>Tienda no reparte a su comuna</h3>
              <br><br>";
    } else {
        echo "<h3>Felicidadez! Compra realizada de forma exitosa</h3>
              <br><br>";
    }

?>

<form align='center' action='show_tiendas.php' method='post'>
    <div class='form-floating'>
        <?php echo "<input type='hidden' name='id_tienda' value=$id_tienda class='form-control'>" ?>
    </div>

    <button type='submit' class='btn btn-primary'> Regresar a la tienda </button>
</form>

<?php include('../templates_html/footer.html'); ?>