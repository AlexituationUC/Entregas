<?php include('../templates/header.html');   ?>

<body>
<?php
  #Llama a conexión, crea el objeto PDO y obtiene la variable $db
  require("../config/conexion.php");

  $comuna_buscada = $_POST["nombre_comuna"];

  print($_POST);

 	$query = "SELECT i.nombre
   FROM Comunas as c, Direcciones as d, Tiendas as t, esta_en as e, contratos as co, Personal as p, info_Personal as i
   WHERE t.id_direccion = d.id AND d.id = e.id_direcciones AND c.id = r.id_comunas
   AND t.id = co.id_tiendas AND p.id = co.id_personal AND p.rut LIKE i.rut
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