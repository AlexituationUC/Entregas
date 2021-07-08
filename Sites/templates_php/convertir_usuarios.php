<?php

    // Obtenemos el personal de administracion de la base de datos del grupo par
    require("../config/conexion.php");
    $query = "SELECT p.rut as rut, p.nombre as nombre, p.edad as edad, d.direccion as direccion
              FROM Personal as p, Admins as a, Unidades as u, Direcciones as d
              WHERE p.id = a.id AND a.id_unidad = u.id AND u.id_direccion = d.id;";
    $result = $db2 -> prepare($query);
    $result -> execute();
    
    $personal = $result -> fetchAll();

    echo $personal;

    // Agregamos al personal como usuario a la base de datos del grupo impar
    foreach ($personal as $persona){
        // usamos el procesamiento almacenado para cada integrante del personal
        $query = "SELECT convertir_usuarios($persona[0], $persona[1], $persona[2], $persona[3]);";
        $result = $db -> prepare($query);
        $result -> execute();
        $result -> fetchAll();
        echo $persona[0];
    }

?>