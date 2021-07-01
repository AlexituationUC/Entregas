<!-- INCLUIR el header si es necesario -->
<!-- Falta sanitizar -->
<body>
<?php
require("../config/conexion.php");  // ASUMO ubicación de conexion.php para conectarme a la DB
// ASUMO también los nombres $db y $db2 para la base impar y par respectivamente
$idp = $_POST["id_producto"];  // ASUMO que se postea el id del producto con nombre "id_producto"
// echo de testeo
echo "[TEST] el id del producto es $idp";
?>
<?php
// determinamos el tipo de producto (no_comestibles, frescos, conserva o conjelados)
// chequeamos si es no_comestible
$query_tipo = "SELECT No_Comestibles.id
FROM Productos, No_Comestibles
WHERE Productos.id = No_Comestibles.id
AND No_Comestibles.id = $idp;";  // PODRÍA TENER PROBLEMAS SI $idp NO ES UN int Y SI UN string
$resultado_tipo = $db -> prepare($query_tipo);
$resultado_tipo -> execute();
$array_tipo = $resultado_tipo -> fetchAll();

// si hay algún no_comestible que encaje con $idp preparamos imediatamente la query que necesitamos
// para mostrar los datos en la página
if(!empty($array_tipo)){
    $tipo = "no_comestible";
    $query_info = "SELECT Productos.id, Productos.nombre, Productos.precio, Productos.descripcion,
    No_Comestibles.largo, No_Comestibles.ancho, No_Comestibles.alto, No_Comestibles.peso
    FROM Productos, No_Comestibles
    WHERE Productos.id = No_Comestibles.id AND Productos.id = $pid;";
    // exigo Productos.id = $pid y no No_Comestibles.id = $pid para poder rastrear errores
}

// repetimos lo anterior para todos los tipos posibles
// fresco
$query_tipo = "SELECT Frescos.id
FROM Productos, Frescos
WHERE Productos.id = Frescos.id
AND Frescos.id = $idp;"; 
$resultado_tipo = $db -> prepare($query_tipo);
$resultado_tipo -> execute();
$array_tipo = $resultado_tipo -> fetchAll();
if(!empty($array_tipo)){
    $tipo = "fresco";
    $query_info = "SELECT Productos.id, Productos.nombre, Productos.precio, Productos.descripcion,
    Comestibles.fecha_expiracion, Frescos.duracion
    FROM Productos, Comestibles, Frescos
    WHERE Productos.id = Comestibles.id AND Comestibles.id = Frescos.id AND Productos.id = $pid;";
}

// conserva
$query_tipo = "SELECT Conserva.id
FROM Productos, Conserva
WHERE Productos.id = Conserva.id
AND Conserva.id = $idp;"; 
$resultado_tipo = $db -> prepare($query_tipo);
$resultado_tipo -> execute();
$array_tipo = $resultado_tipo -> fetchAll();
if(!empty($array_tipo)){
    $tipo = "conserva";
    $query_info = "SELECT Productos.id, Productos.nombre, Productos.precio, Productos.descripcion,
    Comestibles.fecha_expiracion, Conserva.metodo
    FROM Productos, Comestibles, Conserva
    WHERE Productos.id = Comestibles.id AND Comestibles.id = Conserva.id AND Productos.id = $pid;";
}

// congelado
$query_tipo = "SELECT Congelados.id
FROM Productos, Congelados
WHERE Productos.id = Congelados.id
AND Congelados.id = $idp;"; 
$resultado_tipo = $db -> prepare($query_tipo);
$resultado_tipo -> execute();
$array_tipo = $resultado_tipo -> fetchAll();
if(!empty($array_tipo)){
    $tipo = "congelado";
    $query_info = "SELECT Productos.id, Productos.nombre, Productos.precio, Productos.descripcion,
    Comestibles.fecha_expiracion, Congelados.peso
    FROM Productos, Comestibles, Congelados
    WHERE Productos.id = Comestibles.id AND Comestibles.id = Congelados.id AND Productos.id = $pid;";
}

// hacemos la consulta final
$resultado_info = $db -> prepare($query_info);
$resultado_info -> execute();
$info = $resultado_info -> fetchAll();
?>

<table>
    <?php
    if($tipo == "no_comestible"){
        echo "<tr><th> id </th><th> nombre </th><th> precio </th><th> descripcion </th>
        <th> largo </th><th> ancho </th><th> alto </th><th> peso </th></tr>";
        echo "<tr><td> $info[0] </td><td> $info[1] </td><td> $info[2] </td><td> $info[3] </td>
        <td> $info[4] </td><td> $info[5] </td><td> $info[6] </td> <td> $info[7] </td></tr>";
    } elseif($tipo == "fresco"){
        echo "<tr><th> id </th><th> nombre </th><th> precio </th><th> descripcion </th>
        <th> fecha de expiración </th><th> duracion </th></tr>";
        echo "<tr><td> $info[0] </td><td> $info[1] </td><td> $info[2] </td><td> $info[3] </td>
        <td> $info[4] </td><td> $info[5] </td></tr>";
    } elseif($tipo == "conserva"){
        echo "<tr><th> id </th><th> nombre </th><th> precio </th><th> descripcion </th>
        <th> fecha de expiración </th><th> metodo de conserva </th></tr>";
        echo "<tr><td> $info[0] </td><td> $info[1] </td><td> $info[2] </td><td> $info[3] </td>
        <td> $info[4] </td><td> $info[5] </td></tr>";
    } elseif($tipo == "congelado"){
        echo "<tr><th> id </th><th> nombre </th><th> precio </th><th> descripcion </th>
        <th> fecha de expiración </th><th> peso </th></tr>";
        echo "<tr><td> $info[0] </td><td> $info[1] </td><td> $info[2] </td><td> $info[3] </td>
        <td> $info[4] </td><td> $info[5] </td></tr>";
    }
    ?>
</table>

<!-- quizá meter footer -->
</body>
