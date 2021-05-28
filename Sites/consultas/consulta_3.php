<?php include('../templates/header.html');   ?>

<body>

  <?php
  require("../config/conexion.php"); #Llama a conexión, crea el objeto PDO y obtiene la variable $db

  $producto = $_POST["producto"];

  if ($producto=="Comestible") {
    $query = "SELECT t.nombre
    FROM Comestibles as c, Productos as p, tienen as ti, Tiendas as t
    WHERE c.id = p.id AND p.id = ti.id_productos AND ti.id_tiendas = t.id;";
  }
  if ($producto == "Comestible Frescos") {
    $query = "SELECT t.nombre
    FROM Frescos as f, Comestibles as c, Productos as p, tienen as ti, Tiendas as t
    WHERE f.id = c.id AND c.id = p.id AND p.id = ti.id_productos AND ti.id_tiendas = t.id;";
  }
  if ($producto == "Comestible Conserva") {
    $query = "SELECT t.nombre
    FROM Conserva as cons, Comestibles as c, Productos as p, tienen as ti, Tiendas as t
    WHERE cons.id = c.id AND c.id = p.id AND p.id = ti.id_productos AND ti.id_tiendas = t.id;";
  }
  if ($producto == "Comestible Congelado") {
    $query = "SELECT t.nombre
    FROM Congelados as cong, Comestibles as c, Productos as p, tienen as ti, Tiendas as t
    WHERE cong.id = c.id AND c.id = p.id AND p.id = ti.id_productos AND ti.id_tiendas = t.id ;";
  }
  if ($producto == "No Comestible") {
    $query = "SELECT t.nombre
    FROM No_Comestibles as c, Productos as p, tienen as ti, Tiendas as t
    WHERE c.id = p.id AND p.id = ti.id_productos AND ti.id_tiendas = t.id;";
  }

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