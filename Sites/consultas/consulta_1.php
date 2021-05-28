<?php include('../templates/header.html');   ?>

<body>

<?php
    #Llama a conexión, crea el objeto PDO y obtiene la variable $db
    require("../config/conexion.php");

    $query = "SELECT t.nombre, c.nombre
    FROM Tiendas as t, Comunas as c, reparten_a as r
    WHERE t.id=r.id_tiendas AND c.id=r.id_comunas
    ORDER BY t.nombre;";

	$result = $db -> prepare($query);
	$result -> execute();
	$tiendas = $result -> fetchAll();

?>

	<table>
    <tr>
      <th>Tienda</th>
      <th>Comuna</th>
    </tr>

    <?php
	foreach ($tiendas as $tienda) {
  		echo "<tr> <td>$tienda[0] </td> <td>$tienda[1] </td> </tr>";
	}
    ?>
	</table>

<?php include('../templates/footer.html'); ?>