<?php include('../templates/header.html');   ?>

<body>
<?php
  #Llama a conexión, crea el objeto PDO y obtiene la variable $db
  require("../config/conexion.php");

  #Se obtiene el valor del input del usuario
  $comuna_buscada = $_POST["comuna_buscada"];

  #Se construye la consulta como un string
 	$query = "SELECT AVG(i.edad)
  FROM Comunas as c, esta_en as e, Direcciones as d, Tiendas as t, contratos as co, Personal as p, info_personal as i
  WHERE c.id = e.id_comunas AND d.id = e.id_direcciones AND d.id = t.id_direccion
  AND t.id = co.id_tiendas AND p.id = co.id_personal AND p.rut = i.rut
  AND c.nombre LIKE '%$comuna_buscada%';";

  #Se prepara y ejecuta la consulta. Se obtienen TODOS los resultados
	$result = $db -> prepare($query);
	$result -> execute();
	$usuarios = $result -> fetchAll();
  ?>

  <table>
    <tr>
      <th>Promedio de las edades de los trabajadores</th>
    </tr>
  
      <?php
        foreach ($usuarios as $usuario) {
          echo "<tr><td>$usuario[0]</td></tr>";
      }
      ?>
      
  </table>

<?php include('../templates/footer.html'); ?>