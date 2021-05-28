<?php include('../templates/header.html');   ?>

<body>

  <?php
  require("../config/conexion.php"); #Llama a conexión, crea el objeto PDO y obtiene la variable $db

  $producto = $_POST["producto"];

  if ($producto=="Comestible") {
    $query = "SELECT t.nombre, COUNT(c.id) as cantidad
    FROM Comestibles as c, Productos as p, carritos as ca, Compras as co, Tiendas as t
    WHERE c.id = p.id AND p.id = ca.id_productos AND ca.id_compras = co.id AND co.id_tienda = t.id
    GROUP BY t.nombre
    ORDER BY cantidad DESC;";
  }
  if ($producto == "Comestible Frescos") {
    $query = "SELECT t.nombre, COUNT(f.id) as cantidad
    FROM Frescos as f, Comestibles as c, Productos as p, carritos as ca, Compras as co, Tiendas as t
    WHERE f.id = c.id AND c.id = p.id AND p.id = ca.id_productos AND ca.id_compras = co.id AND co.id_tienda = t.id
    GROUP BY t.nombre
    ORDER BY cantidad DESC;";
  }
  if ($producto == "Comestible Conserva") {
    $query = "SELECT t.nombre, COUNT(cons.id) as cantidad
    FROM Conserva as cons, Comestibles as c, Productos as p, carritos as ca, Compras as co, Tiendas as t
    WHERE cons.id = c.id AND c.id = p.id AND p.id = ca.id_productos AND ca.id_compras = co.id AND co.id_tienda = t.id
    GROUP BY t.nombre
    ORDER BY cantidad DESC;";
  }
  if ($producto == "Comestible Congelado") {
    $query = "SELECT t.nombre, COUNT(cong.id) as cantidad
    FROM Congelados as cong, Comestibles as c, Productos as p, carritos as ca, Compras as co, Tiendas as t
    WHERE cong.id = c.id AND c.id = p.id AND p.id = ca.id_productos AND ca.id_compras = co.id AND co.id_tienda = t.id
    GROUP BY t.nombre
    ORDER BY cantidad DESC;";
  }
  if ($producto == "No Comestible") {
    $query = "SELECT t.nombre, COUNT(c.id) as cantidad
    FROM No_Comestibles as c, Productos as p, carritos as ca, Compras as co, Tiendas as t
    WHERE c.id = p.id AND p.id = ca.id_productos AND ca.id_compras = co.id AND co.id_tienda = t.id
    GROUP BY t.nombre
    ORDER BY cantidad DESC;";
  }

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