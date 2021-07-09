<?php include('../templates_html/header.php'); ?>

<body>

<?php
  	require("../config/conexion.php");

  	$tipo_consulta = $_POST["tipo_consulta"];
  	$id_tienda = intval($_POST["id_tienda"]);

	$query_comestible = "SELECT Productos.id, Productos.nombre, Productos.precio, Productos.descripcion
    FROM Productos, Comestibles, Tiendas, tienen
    WHERE Productos.id = Comestibles.id
    AND Tiendas.id = tienen.id_tiendas
    AND Productos.id = tienen.id_productos
    AND Tiendas.id = $id_tienda
    ORDER BY Productos.precio
    LIMIT 3";
	$resultado_comestible = $db -> prepare($query_comestible);
	$resultado_comestible -> execute();
	$comestibles = $resultado_comestible -> fetchAll();

	$query_no_comestible = "SELECT Productos.id, Productos.nombre, Productos.precio, Productos.descripcion
    FROM Productos, No_Comestibles, Tiendas, tienen
    WHERE Productos.id = No_Comestibles.id
    AND Tiendas.id = tienen.id_tiendas
    AND Productos.id = tienen.id_productos
    AND Tiendas.id = $id_tienda
    ORDER BY Productos.precio
    LIMIT 3;";
	$resultado_no_comestible = $db -> prepare($query_no_comestible);
	$resultado_no_comestible -> execute();
	$no_comestibles = $resultado_no_comestible -> fetchAll();

	$vacio = array("", "", "", "");
	$productos = array($vacio);

?>
<div class="container h-100">
	<table class="table table-dark table-hover">
			<tr>
				<th> ID </th>
				<th> Nombre </th>
				<th> Precio </th>
				<th> Descripción </th>
				<th> Ver producto </th>
			</tr>

		<?php
			foreach ($comestibles as $p) {
				if ($p[0] == "") {
					echo "<tr><td> $p[0] </td><td> $p[1] </td><td> $p[2] </td><td> $p[3] </td><td> </td></tr>";
				} else {
					echo "<tr><td> $p[0] </td><td> $p[1] </td><td> $p[2] </td><td> $p[3] </td><td>
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
		?>
	</table>
</div>

<div class="container h-100">
	<table class="table table-dark table-hover">
			<tr>
				<th> ID </th>
				<th> Nombre </th>
				<th> Precio </th>
				<th> Descripción </th>
				<th> Ver producto </th>
			</tr>

		<?php
			foreach ($no_comestibles as $p) {
				if ($p[0] == "") {
					echo "<tr><td>$p[0]</td><td>$p[1]</td><td>$p[2]</td><td>$p[3]</td><td> </td></tr>";
				} else {
					echo "<tr><td>$p[0]</td><td>$p[1]</td><td>$p[2]</td><td>$p[3]</td><td>
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
	?>
 </table>
 
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