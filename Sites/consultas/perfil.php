<?php 

include('../templates_html/header.php');
require("../config/conexion.php");

?>

<body>

<!-- Info usuarios -->
<?php
// ASUMO mostrar todas las direcciones si hay más de una por usuario
$query_info_usuario = "SELECT Info_Usuarios.nombre, Info_Usuarios.edad, Usuarios.rut, Direcciones.direccion
                       FROM Usuarios, Info_Usuarios, Direcciones, pide_a
                       WHERE Usuarios.rut = Info_Usuarios.rut AND Usuarios.id = pide_a.id_usuarios AND Direcciones.id = pide_a.id_direcciones
                       AND Usuarios.id = $id;";
$resultado_info_usuario = $db -> prepare($query_info_usuario);
$resultado_info_usuario -> execute();
$array_info_usuario = $resultado_info_usuario -> fetchAll();
?>
<div class="container h-100">
    <table class="table table-dark table-hover">
        <tr>
            <th> Nombre </th> <th> Edad </th> <th> Rut </th> <th> Direccion </th>
        </tr>
        <?php
            foreach($array_info_usuario as $res){
                $rut = $res[2];
                echo "<tr> <td> $res[0] </td> <td> $res[1] </td> <td> $res[2] </td> <td> $res[3] </td></tr>";
            }
        ?>
    </table>
</div>
<!-- En caso de ser jefe de una unidad de despachos -->
<?php
// obtendremos el rut a partir del id
$query_rut = "SELECT rut FROM usuarios WHERE id = $id;";
$res_rut = $db -> prepare($query_rut);
$res_rut -> execute();
$array_rut = $res_rut -> fetchAll();
$rut = $array_rut[0][0];
echo "el rut del jefe es = $rut, array rut -> $array_rut";


// Ahora veremos si el usuario es un jefe
$query_es_jefe = "SELECT Unidades.id_jefe
FROM Personal, Unidades
WHERE Personal.id = Unidades.id_jefe AND Personal.rut = $rut;"; // Podemos tener el problema de que $id_usuario es string
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
    
    <?php
        if (is_array($array_admins) || is_object($array_admins)){
            echo " <tr> <th> Administrativos de tu unidad </th> </tr>";
            foreach($array_admins as $res){
                echo "<tr> <td> $res[0] </td></tr>";
            }
        }
    ?>
</table>

<?php
    // Código que se ejecutará al apretar el botón que definiremos más abajo
    if(isset($_POST["cambiar_clave"])){
        $rut = $_POST['rut'];
        //$id = $_POST['id'];
        $clave_antigua = $_POST["clave_antigua"];
        $clave_nueva = $_POST["clave_nueva"];
        echo "$clave_antigua<br>";
        echo "$clave_nueva<br>";
        // revisamos si la clave antigua corresponde a la de la base de datos
        // claves en Usuarios.clave
        $query = "SELECT Info_Usuarios.clave FROM Info_Usuarios WHERE Info_Usuarios.rut = '$rut' ;";
        $resultado_query = $db -> prepare($query);
        $resultado_query -> execute();
        $array_array_query = $resultado_query -> fetchAll();
        if(empty($array_array_query)){
            echo "<h3>El usuario de rut $rut no tiene clave</h3><br>";
            $clave_original = "";
        } else {
            $array_query = $array_array_query[0];
            $clave_original = $array_query[0];
        }
        if($clave_original == $clave_antigua){
            // realizamos el cambio de clave
            echo "<h3>Clave actualizada de manera exitosa</h3><br>";
            $query_cambio = "UPDATE info_usuarios SET clave = '$clave_nueva' WHERE rut = '$rut';";
            $resultado_query_cambio = $db -> prepare($query_cambio);
            $resultado_query_cambio -> execute();
        } else{
            echo "<h3>Clave incorrecta, recuerda ingresar tu clave anterior primero</h3><br>";
        }
    }
?>
<!-- Botón para efectual el cambio de clave -->
<div class="row h-100 justify-content-center align-items-center">
    <h3 align="center"> Para cambiar su clave ingrese su clave actual y luego la nueva </h3>
    <div class="col-10 col-md-8 col-lg-6"> 
        <form align="center" method="post">
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">Clave actual</span>
                <input type="text" class="form-control" placeholder="Clave actual" aria-label="Clave actual" aria-describedby="basic-addon1" name="clave_antigua">
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">Clave nueva</span>
                <input type="text" class="form-control" placeholder="Clave nueva" aria-label="Clave nueva" aria-describedby="basic-addon1" name="clave_nueva">
            </div>
            <?php // vamos a postear el rut y el id del usuario
                echo "
                    <input type='hidden' id='id_rut_hideden' name='rut' value='$rut'>";
                    //<input type="hidden" id="id_usser_hideden" name="id_usuario" value="$_POST['id']">
                
            ?>
            <?php if (!empty($_POST)){echo "<input type='hidden' name='id' value=$id class='form-control'>";} ?>
            <input class="btn btn-primary" type="submit" value="cambiar clave" name="cambiar_clave">
        </form>

        <br><br><br>

        <form align="center" action="historial_compras.php" method="post">
            <?php if (!empty($_POST)){echo "<input type='hidden' name='id' value=$id class='form-control'>";} ?>
            <button type="submit" class="btn btn-primary"> Ver historial de compras </button>
        </form>
    </div>
</div>

</body>

<?php include('../templates_html/footer.html'); ?>