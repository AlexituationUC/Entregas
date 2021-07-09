<?php include('../templates_html/header.php'); ?>

<body>

<?php
  	require("../config/conexion.php");

  	$tipo_consulta = $_POST["tipo_consulta"];
  	$id_tienda = intval($_POST["id_tienda"]);
    $producto = $_POST["producto"];
    $query_comestibles = "SELECT Productos.id, Productos.nombre, Productos.descripcion, Productos.precio
                          FROM Productos, Tiendas, tienen, Comestibles
                          WHERE Productos.id = tienen.id_productos 
                          AND Productos.id = Comestibles.id
                          AND Tiendas.id = tienen.id_tiendas
                          AND LOWER(Productos.nombre) LIKE LOWER('%$producto%')
                          AND Tiendas.id = $id_tienda;";
    $resultado_comestibles = $db -> prepare($query_comestibles);
    $resultado_comestibles -> execute();
    $lista_comestibles = $resultado_comestibles -> fetchAll();
    
    $query_no_comestibles = "SELECT Productos.id, Productos.nombre, Productos.descripcion, Productos.precio
                             FROM Productos, Tiendas, tienen, No_Comestibles
                             WHERE Productos.id = tienen.id_productos 
                             AND Productos.id = No_Comestibles.id
                             AND Tiendas.id = tienen.id_tiendas
                             AND LOWER(Productos.nombre) LIKE LOWER('%$producto%')
                             AND Tiendas.id = $id_tienda;";
    $resultado_no_comestibles = $db -> prepare($query_no_comestibles);
    $resultado_no_comestibles -> execute();
    $lista_no_comestibles = $resultado_no_comestibles -> fetchAll();

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
            foreach ($lista_comestibles as $com) {
                echo "<tr><td>$com[0]</td><td>$com[1]</td><td>$com[2]</td><td>$com[3]</td><td>Comestible</td><td>
                      <form align='center' action='show_productos.php' method='post'>
                      <div class='form-floating'>
                      <input type='hidden' name='id_tienda' value=$id_tienda class='form-control'>
                      <input type='hidden' name='id_producto' value=$com[0] class='form-control'>
                      <input type='hidden' name='id' value=$id class='form-control'>
                      </div>
                      <button type='submit' class='btn btn-primary'> Ver Producto </button>
                      </form>
                      </td>";
            }
            foreach ($lista_no_comestibles as $no_com) {
                echo "<tr><td>$no_com[0]</td><td>$no_com[1]</td><td>$no_com[2]</td><td>$no_com[3]</td><td>No Comestible</td><td>
                      <form align='center' action='show_productos.php' method='post'>
                      <div class='form-floating'>
                      <input type='hidden' name='id_tienda' value=$id_tienda class='form-control'>
                      <input type='hidden' name='id_producto' value=$no_com[0] class='form-control'>
                      <input type='hidden' name='id' value=$id class='form-control'>
                      </div>
                      <button type='submit' class='btn btn-primary'> Ver Producto </button>
                      </form>
                      </td>";
            }
        ?>
        </tr>
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