<?php

    // Nos conectamos a las bdds
    require("../config/conexion.php");
    include('../templates/header.html');


    // Enviamos del post la informacion a la query con nuestro procedimiento almacenado que realizará
    // las verificaciones correspondientes
    $query = "SELECT verificar_registro('$_POST[nombre]', '$_POST[rut]', $_POST[edad], $_POST[direccion]);";
    $result = $db -> prepare($query);
    $result -> execute();


    // Si nos interesa acceder a los booleanos que retorna el procedimiento, debemos hacer fetch de los resultados
    $registrado = $result -> fetchAll();

    if ($registrado) {
        echo "Te haz registrado exitosamente";
    } else {
        echo "El registro ha fallado, intentalo otra vez";
    }


?>

<body>  
    <br>
<form action="../index.php" method="get">
    <input type="submit" value="Volver">
</form>
</body>
</html>