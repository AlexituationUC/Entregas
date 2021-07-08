<?php include('../templates_html/header.php'); ?>

<body>
<?php

    require("../config/conexion.php");

        $query = "SELECT Tiendas.nombre, Direcciones.direccion, Tiendas.id
                  FROM Tiendas, Direcciones
                  WHERE Tiendas.id_direccion = Direcciones.id;";
    
        $result = $db -> prepare($query);
        $result -> execute();
        $tiendas = $result -> fetchAll();
?>
    <div class="container h-100">
        <table class="table table-dark table-hover">
            <tr>
            <th> Nombre tienda </th>
            <th> Direccion </th>
            <th> Revisar tienda </th>
            </tr>
            <?php
                foreach ($tiendas as $t) {
                echo "<tr><td>$t[0]</td><td>$t[1]</td>";
                }
            ?>
            <td> 
                <form align="center" action="show_tiendas.php" method="post">
                    <div class="form-floating">
                        <?php echo "<input type='hidden' name='id' value=$id class='form-control'>" ?>
                        <?php echo "<input type='hidden' name='id_tienda' value=$t[2] class='form-control'>" ?>
                    </div>

    <table class="table table-dark table-hover">
        <tr>
        <th> Nombre tienda </th>
        <th> Direccion </th>
        <th> Revisar tienda </th>
        </tr>
        <?php
            foreach ($tiendas as $t) {
            echo "<tr><td>$t[0]</td><td>$t[1]</td><td>
                  <form align='center' action='show_tiendas.php' method='post'>
                  <div class='form-floating'>
                  <input type='hidden' name='id_tienda' value=$t[2] class='form-control'>
                  <input type='hidden' name='id' value=$id class='form-control'>
                  </div>
                  <button type='submit' class='btn btn-primary'> Ver Tienda </button>
                  </form>
                  </td></tr>";
            }
        ?>
    </table>

<?php include('../templates_html/footer.html'); ?>
<?php if (!empty($_POST)){echo "<div class='form-floating'>
    <input type='hidden' name='id' value=$id class='form-control'>
</div>";} ?>