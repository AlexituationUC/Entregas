<?php include('../templates_html/header.html'); ?>
<body>
<?php
require("../config/conexion.php");  // ASUMO ubicación de conexion.php para conectarme a la DB
// ASUMO también los nombres $db y $db2 para la base impar y par respectivamente
$idu = $_SESSION["id"];
$idu = 100;  ///////////////// SACAR ESTO!
// echo de testeo
echo "<br> [TEST] el id del usuario es $idu";
?>
<?php
$query_historial = "SELECT Productos.nombre, Productos.precio, Tiendas.nombre, Productos.id, Tiendas.id
FROM Usuarios, Compras, Tiendas, Productos, carritos
WHERE Usuarios.id = Compras.id_usuario AND Tiendas.id = Compras.id_tienda AND Compras.id = carritos.id_compras
AND Productos.id = carritos.id_productos
AND Usuarios.rut = '$rut'
ORDER BY Compras.id DESC;";
$resultado_historial = $db -> prepare($query_historial);
$resultado_historial -> execute();
$array_historial = $resultado_historial -> fetchAll();
?>
<div class="container h-100">
    <h3> pincha el nombre de un producto para consultar su información </h3>
    <table class="table table-striped" align="center">
        <tr>
            <th> producto </th> <th> precio </th> <th> tienda </th>
        </tr>
        <?php
            foreach($array_historial as $res){
                echo "<tr> <td>$res[0]</td> <td> $res[1] </td> <td> $res[2] </td></tr>";
            }
        ?>
    </table>
</div>
<?php include('../templates_html/footer.html'); ?>