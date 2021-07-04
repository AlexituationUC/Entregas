<?php include('../templates_html/header.html'); ?>
<?php

if (is_null($id_usuario)) {
    $id_usuario = $_POST["id"];
    session_start();
    $_SESSION["id"] = $id_usuario;
    $_SESSION["is_log"] = TRUE;
} else {
    $_SESSION["id"] = $id_usuario;
    $_SESSION["is_log"] = TRUE;
}
require("../config/conexion.php"); // Recibira el id del user
$id = $_SESSION["id"];

?>

<body>

<!-- Info usuarios -->
<?php
// ASUMO mostrar todoas las direcciones si hay más de una por usuario
$query_info_usuario = "SELECT Info_Usuarios.nombre, Info_Usuarios.edad, Usuarios.rut, Direcciones.direccion
                       FROM Usuarios, Info_Usuarios, Direcciones, pide_a
                       WHERE Usuarios.rut = Info_Usuarios.rut AND Usuarios.id = pide_a.id_usuarios AND Direcciones.id = pide_a.id_direcciones
                       AND Usuarios.id = $id;";
$resultado_info_usuario = $db -> prepare($query_info_usuario);
$resultado_info_usuario -> execute();
$array_info_usuario = $resultado_info_usuario -> fetchAll();
?>
<table class="table table-dark table-hover">
    <tr>
        <th> Nombre </th> <th> Edad </th> <th> Rut </th> <th> Direccion </th>
    </tr>
    <?php
        foreach($array_info_usuario as $res){
            echo "<tr> <td> $res[0] </td> <td> $res[1] </td> <td> $res[2] </td> <td> $res[3] </td></tr>";
        }
    ?>
</table>

<!-- En caso de ser jefe de una unidad de despachos -->
<?php
// Ahora veremos si el usuario es un jefe
$query_es_jefe = "SELECT Unidades.id_jefe
FROM Unidades
WHERE Unidades.id_jefe = $id;";  // Podemos tener el problema de que $id_usuario es string
$resultado_es_jefe = $db2 -> prepare($query_es_jefe);
$resultado_es_jefe -> execute();
$array_es_jefe = $resultado_es_jefe -> fetchAll();
// Si el usuario es jefe
if(!empty($array_es_jefe)){
    // Solicitamos la dirección de la unidad
    $query_direccion = "SELECT direcciones.direccion 
    FROM direcciones, unidades
    WHERE unidades.id_direccion = direcciones.id AND unidades.id_jefe = $id;";
    $resultado_direccion = $db2 -> prepare($query_direccion);
    $resultado_direccion -> execute();
    $array_direccion = $resultado_direccion -> fetchAll();
    echo "La dirección de su unidad es $array_direccion[0]";

    // Solicitamos la información de los administrativos bajo el mando del usuario
    $query_admins = "SELECT personal.nombre 
    FROM personal, unidades, admins
    WHERE unidades.id = admins.id_unidad AND personal.id = admins.id
    AND unidades.id_jefe = $id;";
    $resultado_admins = $db2 -> prepare($query_admins);
    $resultado_admins -> execute();
    $array_admins = $resultado_admins -> fetchAll();
}
?>
<table class="table table-dark table-hover">
    <tr>
        <th> Administrativos de tu unidad </th>
    </tr>
    <?php
        foreach($array_admins as $res){
            echo "<tr> <td> $res[0] </td></tr>";
        }
    ?>
</table>

<h3> Para cambiar su clave ingrese su clave actual y luego la nueva </h3>
<?php
    // Código que se ejecutará al apretar el botón que definiremos más abajo
    if(isset($_POST["cambiar_clave"])){
        $clave_antigua = $_POST["clave_antigua"];
        $clave_nueva = $_POST["clave_nueva"];
        echo "[TEST], la clave antigua ingresada es $clave_antigua";
        // revisamos si la clave antigua corresponde a la de la base de datos
        // claves en Usuarios.clave
        $query = "SELECT Info_Usuarios.clave FROM Info_Usuarios WHERE Info_Usuarios.rut = '$rut' ;";
        $resultado_query = $db -> prepare($query);
        $resultado_query -> execute();
        $array_query = $resultado_query -> fetchAll();
        if(empty($array_query)){
            echo "[TEST] el usuario de rut $rut no tiene clave";
        } else {
            $clave_original = $array_query[0];
            echo "[TEST] la clave de $rut ERA $clave_original";
        }
        if($clave_original == $clave_antigua){
            // realizamos el cambio de clave
            echo "Debería cambiar la clave (decomentar query)";
            $query_cambio = "UPDATE Info_Usuarios
            SET Info_Usuarios.clave = $clave_nueva
            WHERE Info_Usuarios.rut = '$rut' ;"; // aquí evito cambiar toodas las claves de la DB
            //$resultado_query_cambio = $db -> prepare($query_cambio);
            //$resultado_query_cambio -> execute();
            //$array_query_cambio = $resultado_query_cambio -> fetchAll();  // inecesario de momento
            //// DECOMENTO CUANDO SEA SEGURO ////
        } else{
            echo "[TEST] clave incorrecta, ingresaste $clave_nueva y debías ingresar $clave_original";
        }
    }
?>
<!-- Botón para efectual el cambio de clave -->
<form method="post">
    clave actual: <input type="text" name="clave_antigua">
    clave nueva: <input type="text" name="clave_nueva">
    <input type="submit" name="cambiar_clave" value="cambiar clave">
</form>

<form align="center" action="cambio_password.php" method="post">
    <div class="form-floating">
        <?php echo "<input type='hidden' name='id' value=$id class='form-control'>" ?>
    </div>

    <button type="submit" class="btn btn-primary"> Cambiar contraseña </button>
</form>

</body>

<?php include('../templates_html/footer.html'); ?>