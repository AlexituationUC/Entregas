<?php include('../templates/header.html');   ?>

<body>
<?php
  #Llama a conexión, crea el objeto PDO y obtiene la variable $db
  require("../config/conexion.php");

  $comuna_buscada = $_POST["nombre_comuna"];

  print($_POST)

 	$query = "
   SELECT i.nombre
   FROM Comunas as c AND Direcciones as d AND Tiendas as t AND esta_en as e
   AND constratos as co AND Personal as p AND info_Personal as i
   WHERE t.id_direccion = d.id AND d.id = e.id_direcciones AND c.id = r.id_comunas
   AND t.id = co.id_tiendas AND p.id = co.id_personal AND p.rut = i.rut;
   AND c.nombre LIKE '%$comuna_buscada%' AND p.ocupacion LIKE '%jefe%' ;
   ";

	$result = $db -> prepare($query);
	$result -> execute();
	$jefes = $result -> fetchAll();
  ?>

	<table>
    <tr>
      <th>Tienda</th>
      <th>Nombre Jefes</th>
    </tr>
  <?php
	foreach ($jefes as $jefe) {
  		echo "<tr><td>$jefe[0]</td><td>";
	}
  ?>
	</table>

<?php include('../templates/footer.html'); ?>