<?php include('../templates/header.html');   ?>

<body>

  <?php
  require("../config/conexion.php"); #Llama a conexión, crea el objeto PDO y obtiene la variable $db

  $query = "SELECT t.nombre, COUNT(c.id)
  FROM Congelados as cong AND Comestibles as c AND Productos as p AND carritos as ca AND Compras as co AND Tiendas as t
  WHERE cong.id = c.id AND c.id = p.id AND p.id = ca.id_productos AND ca.id_compras = co.id AND co.id_tienda = t.id
  GROUP BY t.nombre;";

  $result = $db -> prepare($query);
  $result -> execute();
  $tiendas = $result -> fetchAll(); #Obtiene todos los resultados de la consulta en forma de un arreglo
  ?>

  <table>
    <tr>
      <th>Nombre</th>
      <th>Cantidad Comestibles</th>
    </tr>
  <?php
  foreach ($tiendas as $tienda) {
    echo "<tr> <td>$tienda[0]</td> <td>$tienda[1]</td> </tr>";
  }
  ?>
  </table>

<?php include('../templates/footer.html'); ?>