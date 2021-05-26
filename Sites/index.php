<!--             Header            -->

<?php include('templates/header.html');   ?>

<body>

  <!--             Titulo Pagina y Subtitulo            -->

  <h1 align="center">Mi Tienda Web </h1>
  <p style="text-align:center;">Realice sus consultas aqui:</p>

  <br>

  <!--             Primera Consulta            -->

  <h3 align="center"> Nombres de las tiendas y las comunas a las que realizan despachos</h3>

  <form align="center" action="consultas/consulta_1.php" method="post">
    <input type="submit" value="Mostrar">
  </form>
  
  <br>
  <br>

  <!--             Segunda Consulta            -->

  <h3 align="center"> Mostrar jefes de las tiendas en la comuna:</h3>

  <form align="center" action="consultas/consulta_2.php" method="post">
    Comuna:
    <input type="text" name="nombre_comuna">
    <br/><br/>
    <input type="submit" value="Mostrar">
  </form>
  
  <br>
  <br>

  <!--             Tercera Consulta            -->

  <h3 align="center"> Mostrar las tiendas que venden este tipo de producto</h3>

  <form align="center" action="consultas/consulta_3_comestible.php" method="post">
    Tipo de producto:
    <br/><br/>
    <input type="submit" value="Comestible">
  </form>

  <form align="center" action="consultas/consulta_3_comestible_frescos.php" method="post">
    <br/><br/>
    <input type="submit" value="Fresco">
  </form>

  <form align="center" action="consultas/consulta_3_comestible_conserva.php" method="post">
    <br/><br/>
    <input type="submit" value="Conserva">
  </form>

  <form align="center" action="consultas/consulta_3_comestible_congelado.php" method="post">
    <br/><br/>
    <input type="submit" value="Congelado">
  </form>

  <form align="center" action="consultas/consulta_3_no_comestible.php" method="post">
    <br/><br/>
    <input type="submit" value="No Comestible">
  </form>

  <br>
  <br>

  <!--             Cuarta Consulta            -->


  <h3 align="center">Usuarios que compraron productos con esta descripcion</h3>
  <form align="center" action="consultas/consulta_4.php" method="post">
    Descripcion:
    <input type="text" name="descripcion_buscada">
    <br/><br/>
    <input type="submit" value="Mostrar">
  </form>
  
  <br>
  <br>

  <!--             Quinta Consulta            -->

<h3 align="center">Edad promedio de los trabajadores de la Comuna de:</h3>
  <form align="center" action="consultas/consulta_5.php" method="post">
    Comuna:
    <input type="text" name="comuna_buscada">
    <br/><br/>
    <input type="submit" value="Mostrar">
  </form>
    
  <br>
  <br>

  <!--             Sexta Consulta            -->

<h3 align="center">Tiendas con la venta de mayor cantidad de productos del tipo seleccionado</h3>
  <form align="center" action="consultas/consulta_6_comestible.php" method="post">
    Tipo de producto:
    <br/><br/>
    <input type="submit" value="Comestible">
  </form>

  <form align="center" action="consultas/consulta_6_comestible_frescos.php" method="post">
    <br/><br/>
    <input type="submit" value="Fresco">
  </form>

  <form align="center" action="consultas/consulta_6_comestible_conserva.php" method="post">
    <br/><br/>
    <input type="submit" value="Conserva">
  </form>

  <form align="center" action="consultas/consulta_6_comestible_congelado.php" method="post">
    <br/><br/>
    <input type="submit" value="Congelado">
  </form>

  <form align="center" action="consultas/consulta_6_no_comestible.php" method="post">
    <br/><br/>
    <input type="submit" value="No Comestible">
  </form>

  <br>
  <br>
  <br>
</body>
</html>
