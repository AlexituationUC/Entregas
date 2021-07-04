<?php include('../templates_html/header.html'); ?>

<body>

<?php

  	require("../config/conexion.php");
  	$product_id = $_POST["product_id"];
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
  	$query = "SELECT Productos.id, Productos.nombre, Productos.descripcion, Productos.precio, ";
  	if (in_array($product_id, $id_comestible)){
  		$query += "Comestibles.fecha_expiracion, ";
  		$special_attributes[] = "Fecha de expiración";
  		if (in_array($product_id, $id_conserva)) {
  			$query += "Conservas.metodo
  						FROM Productos, Comestibles, Conserva
  						WHERE Productos.id = Comestibles.id AND Productos.id = Conserva.id;";
  			$special_attributes[] = "Método";
  		}
  		elseif (in_array($product_id, $id_fresco)) {
  			$query += "Frescos.duracion
  			FROM Productos, Comestibles, Frescos
  			WHERE Productos.id = Comestibles.id AND Productos.id = Frescos.id;";
  			$special_attributes[] = "Duración";
  		}
  		else {
  			$query += "Congelados.peso
  						FROM Productos, Comestibles, Congelados
<<<<<<< HEAD
=======
  						WHERE Productos.id = Comestibles.id AND Productos.id = Congelados.id";
>>>>>>> 6771f15bc53d47ee02bb06da5bc3b746514f4068
  			$special_attributes[] = "Peso";
  		}
  	}
  	else {
  		$query += "No_Comestibles.largo, No_Comestibles.ancho, No_Comestibles.alto, No_Comestibles.peso
  				FROM Productos, No_Comestibles
  				WHERE Productos.id = No_Comestibles.id;";
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
<<<<<<< HEAD
=======
		foreach ($special_attributes as $attr ) {
			<th> $attr; </th>
>>>>>>> 6771f15bc53d47ee02bb06da5bc3b746514f4068
		}
		?>
    	</tr>
  
		<?php
			// echo $producto;
			foreach ($producto as $p) {
				$display = "<tr><td>$p[0]</td><td>$p[1]</td><td>$p[2]</td><td>$p[3]</td>";
				for ($i=0; $i < count($special_attributes); $i++) { 
				 	$display += "<td>$p[$i + 3]</td>";
				 }
				 $display += "</tr>";
				 echo $display;
		}
		?>
      
    </table>
<?php include('../templates_html/footer.html'); ?>