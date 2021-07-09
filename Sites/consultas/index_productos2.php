<?php include('../templates_html/header.php'); ?>

<body>

<?php
  	require("../config/conexion.php");

  	$tipo_consulta = $_POST["tipo_consulta"];
  	$id_tienda = intval($_POST["id_tienda"]);
    $producto = $_POST["producto"];
    $query = "SELECT Productos.id, Productos.nombre, Productos.descripcion, Productos.precio
              FROM Productos, Tiendas, tienen
              WHERE Productos.id = tienen.id_productos 
              AND Tiendas.id = tienen.id_tiendas
              AND LOWER(Productos.nombre) LIKE LOWER('%$producto%')
              AND Tiendas.id = $id_tienda;";
    $resultado = $db -> prepare($query);
    $resultado -> execute();
    $productos = $resultado -> fetchAll();
    $query_comestible = "SELECT id FROM Comestibles";
    $resultado_comestible = $db -> prepare($query_comestible);
    $resultado_comestible -> execute();
    $id_comestible = $resultado_comestible -> fetchAll();
    $vacio = array("", "", "", "");
    $comestibles = array($vacio);
    $no_comestibles = array($vacio);

?>

<div class="container h-100">
    <table class="table table-dark table-hover">
            <tr>
                <th> ID </th>
                <th> Nombre </th>
                <th> Descripción </th>
                <th> Precio </th>
                <th> Tipo </th>
                <th> Ver producto </th>
            </tr>

        <?php
            foreach ($productos as $p) {
                if ($p[0] == "") {
                    $display = "<tr><td>$p[0]</td><td>$p[1]</td><td>$p[2]</td><td>$p[3]</td><td> </td><td> </td></tr>";
                } else {
                    if (in_array($p[0], $id_comestible)) {
                        $display = "<tr><td>$p[0]</td><td>$p[1]</td><td>$p[2]</td><td>$p[3]</td><td>Comestible</td><td>
                                    <form align='center' action='show_productos.php' method='post'>
                                    <div class='form-floating'>
                                    <input type='hidden' name='id_tienda' value=$id_tienda class='form-control'>
                                    <input type='hidden' name='id_producto' value=$p[0] class='form-control'>
                                    <input type='hidden' name='id' value=$id class='form-control'>
                                    </div>
                                    <button type='submit' class='btn btn-primary'> Ver Producto </button>
                                    </form>
                                    </td></tr>";
                    } else {
                        $display = "<tr><td>$p[0]</td><td>$p[1]</td><td>$p[2]</td><td>$p[3]</td><td>No Comestible</td><td>
                                    <form align='center' action='show_productos.php' method='post'>
                                    <div class='form-floating'>
                                    <input type='hidden' name='id_tienda' value=$id_tienda class='form-control'>
                                    <input type='hidden' name='id_producto' value=$p[0] class='form-control'>
                                    <input type='hidden' name='id' value=$id class='form-control'>
                                    </div>
                                    <button type='submit' class='btn btn-primary'> Ver Producto </button>
                                    </form>
                                    </td></tr>";
                    }
                }
                echo $display;
            }
        ?>
    </table>
</div>

<br><br><br>

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