<?php include('../templates_html/header.php'); ?>

<body>

<?php
  	require("../config/conexion.php");

  	$tipo_consulta = $_POST["tipo_consulta"];
  	$id_tienda = intval($_POST["id_tienda"]);
  	if ($tipo_consulta == "mas_baratos") {
  		$query_comestible = "SELECT tres_mas_baratos('comestible', $id_tienda);";
  		$resultado_comestible = $db -> prepare($query_comestible);
  		$resultado_comestible -> execute();
  		$comestibles = $resultado_comestible -> fetchAll();
  		$query_no_comestible = "SELECT tres_mas_baratos('no_comestible', $id_tienda);";
  		$resultado_no_comestible = $db -> prepare($query_no_comestible);
  		$resultado_no_comestible -> execute();
  		$no_comestibles = $resultado_no_comestible -> fetchAll();
  		$vacio = array("", "", "", "");
  		$productos = array($vacio);
  	} else {
  		$producto = $_POST["producto"];
  		$query = "SELECT vendidos_por_tienda($id_tienda, $producto)";
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
		echo $productos
  	}
?>

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

<?php include('../templates_html/footer.html'); ?>