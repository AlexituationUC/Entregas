<?php include('../templates/header.html');   ?>

<body>

  <?php
  require("../config/conexion.php"); #Llama a conexión, crea el objeto PDO y obtiene la variable $db

  $query = "SELECT t.nombre
  FROM Congelados as cong AND Comestibles as c AND Productos as p AND tienen as ti AND Tiendas as t
  WHERE cong.id = c.id AND c.id = p.id AND p.id = ti.id_productos AND ti.id_tiendas = t.id ;";

  $result = $db -> prepare($query);
  $result -> execute();
  $tiendas = $result -> fetchAll(); #Obtiene todos los resultados de la consulta en forma de un arreglo
  ?>

  <table>
    <tr>
      <th>Nombre</th>
    </tr>
  <?php
  foreach ($tiendas as $tienda) {
    echo "<tr> <td>$tienda[0]</td> </tr>";
  }
  ?>
  </table>

<?php include('../templates/footer.html'); ?>