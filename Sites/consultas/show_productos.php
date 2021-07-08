<?php include('../templates_html/header.php'); ?>

<body>

<?php

  	require("../config/conexion.php");
  	$product_id = $_POST["id_producto"];
  	$product_id = intval($product_id);

  	$query_comestible = "SELECT id FROM Comestibles";
	$resultado_comestible = $db -> prepare($query_comestible);
	$resultado_comestible -> execute();
	$id_comestible = $resultado_comestible -> fetchAll();
	$query_fresca = "SELECT id FROM Frescos";
	$resultado_fresco = $db -> prepare($query_fresca);
	$resultado_fresco -> execute();
	$id_fresco = $resultado_fresco -> fetchAll();
	$query_conserva = "SELECT id FROM Conserva";
	$resultado_conserva = $db -> prepare($query_conserva);
	$resultado_conserva -> execute();
	$id_conserva = $resultado_conserva -> fetchAll();
	$special_attributes = array();
	$array_comestible = array($product_id);
	foreach ($array_comestible as $turun) {
		echo "$turun";
	}
	echo in_array($array_comestible, $id_comestible);
  	if (in_array($product_id, $id_comestible)){
  		$special_attributes[] = "Fecha de expiración";
  		if (in_array($product_id, $id_conserva)) {
  			$query = "SELECT Productos.id, Productos.nombre, Productos.descripcion, Productos.precio, Comestibles.fecha_expiracion, Conservas.metodo
  						FROM Productos, Comestibles, Conserva
  						WHERE Productos.id = Comestibles.id
  						AND Productos.id = Conserva.id
  						AND Productos.id = $product_id;";
  			$special_attributes[] = "Método";
  		}
  		elseif (in_array($product_id, $id_fresco)) {
  			$query = "SELECT Productos.id, Productos.nombre, Productos.descripcion, Productos.precio, Comestibles.fecha_expiracion, Frescos.duracion
  					  FROM Productos, Comestibles, Frescos
  					  WHERE Productos.id = Comestibles.id 
  					  AND Productos.id = Frescos.id
  					  AND Productos.id = $product_id;";
  			$special_attributes[] = "Duración";
  		}
  		else {
  			$query = "SELECT Productos.id, Productos.nombre, Productos.descripcion, Productos.precio, Comestibles.fecha_expiracion, Congelados.peso
  					  FROM Productos, Comestibles, Congelados
  					  WHERE Productos.id = Comestibles.id
  					  AND Productos.id = Congelados.id
  					  AND Productos.id = $product_id;";
  			$special_attributes[] = "Peso";
  		}
  	}
  	else {
  		$query = "SELECT Productos.id, Productos.nombre, Productos.descripcion, Productos.precio, No_Comestibles.largo, No_Comestibles.ancho, No_Comestibles.alto, No_Comestibles.peso
  				  FROM Productos, No_Comestibles
  				  WHERE Productos.id = No_Comestibles.id AND Productos.id = $product_id;";
  		$special_attributes[] = "Largo";
  		$special_attributes[] = "Ancho";
  		$special_attributes[] = "Alto";
  		$special_attributes[] = "Peso";
  	}
  	$result = $db -> prepare($query);
  	$result -> execute();
  	$producto = $result -> fetchAll();

?>
 <table class="table table-dark table-hover">
        <tr>
            <th> ID </th>
      		<th> Nombre </th>
			<th> Descripción </th>
			<th> Precio </th>
		<?php
		foreach ($special_attributes as $attr ) {
			echo "<th> $attr </th>";
		}
		?>
    	</tr>
  
		<?php
			// echo $producto;
			foreach ($producto as $p) {
				if (count($special_attributes) == 2) {
					$display = "<tr><td>$p[0]</td><td>$p[1]</td><td>$p[2]</td><td>$p[3]</td><td>$p[4]</td><td>$p[5]</td>";
				} else {
					$display = "<tr><td>$p[0]</td><td>$p[1]</td><td>$p[2]</td><td>$p[3]</td><td>$p[4]</td><td>$p[5]</td><td>$p[6]</td><td>$p[7]</td></tr>";
				}
				echo $display;
		}
		?>
      
    </table>
<?php include('../templates_html/footer.html'); ?>