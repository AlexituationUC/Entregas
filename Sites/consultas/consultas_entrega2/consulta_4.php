<?php include('../templates/header.html');   ?>

<body>
<?php
  #Llama a conexión, crea el objeto PDO y obtiene la variable $db
  require("../config/conexion.php");

  #Se obtiene el valor del input del usuario
  $descripcion_buscada = $_POST["descripcion_buscada"];

  #Se construye la consulta como un string
 	$query = "SELECT i.nombre
  FROM Productos as p, carritos as ca, Compras as c, Usuarios as u, info_Usuarios as i
  WHERE p.descripcion LIKE '%$descripcion_buscada%' AND p.id = ca.id_productos AND c.id = ca.id_compras
  AND c.id_usuario = u.id AND u.rut LIKE i.rut ;";

  #Se prepara y ejecuta la consulta. Se obtienen TODOS los resultados
	$result = $db -> prepare($query);
	$result -> execute();
	$usuarios = $result -> fetchAll();
  ?>

  <table>
    <tr>
      <th>Nombre</th>
    </tr>
  
      <?php
        foreach ($usuarios as $usuario) {
          echo "<tr><td>$usuario[0]</td></tr>";
      }
      ?>
      
  </table>

<?php include('../templates/footer.html'); ?>