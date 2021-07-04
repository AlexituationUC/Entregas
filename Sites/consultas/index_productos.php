<?php include('../templates_html/header.html'); ?>

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
  		$no_comestibles = $resultado_comestible -> fetchAll();
  		$vacio = array("", "", "", "");
  		$productos = array($vacio);
  	} else {
  		$producto = $_POST["producto"]
  		$query = "SELECT vendidos_por_tienda($id_tienda, $producto)";
  		$resultado = $db -> prepare();
  		$resultado -> execute();
  		$productos = $resultado -> fetchAll();
  		$query_comestible = "SELECT id FROM Comestibles";
		$resultado_comestible = $db -> prepare($query_comestible);
		$resultado_comestible -> execute();
		$id_comestible = $resultado_comestible -> fetchAll();
		$vacio = array("", "", "", "")
		$comestibles = array($vacio);
		$no_comestibles = array($vacio);
  	}
?>

 <table class="table table-dark table-hover">
        <tr>
            <th> ID </th>
      		<th> Nombre </th>
			<th> Descripción </th>
			<th> Precio </th>
		</tr>

	<?php
		foreach ($comestibles as $p) {
			echo "<tr><td>$p[0]</td><td>$p[1]</td><td>$p[2]</td><td>$p[3]</td></tr>";
		}
	?>
 </table>
 <table class="table table-dark table-hover">
        <tr>
            <th> ID </th>
      		<th> Nombre </th>
			<th> Descripción </th>
			<th> Precio </th>
		</tr>

	<?php
		foreach ($no_comestibles as $p) {
			echo "<tr><td>$p[0]</td><td>$p[1]</td><td>$p[2]</td><td>$p[3]</td></tr>";
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
		</tr>

	<?php
		foreach ($productos as $p) {
			$display = "<tr><td>$p[0]</td><td>$p[1]</td><td>$p[2]</td><td>$p[3]</td>";
			if ($p[0] == "") {
				$display += "<td> </td></tr>";
			} else {
				if (in_array($p[0], $id_comestible)) {
					$display += "<td>Comestible</td></tr>";
				} else {
					$display += "<td>No Comestible</td></tr>";
				}
			}
			echo $display;
		}
	?>
 </table>

<?php include('../templates_html/footer.html'); ?>