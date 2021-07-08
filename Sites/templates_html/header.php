<?php

if (!empty($_POST)) {
  $id = $_POST["id"];
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title> DCCompras </title>
    <!-- Bootstrap(CSS), Jquery (javascripts), etc... -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

    <!-- para que sea index.php pueda importarlo -->
    <link rel="stylesheet" href="styles/mystyles.css">
    <!-- para que una consulta.php pueda importarlo -->
    <link rel="stylesheet" href="../styles/mystyles.css">
    
</head>

<div class="bkg">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand">DCCompras</a>
    ooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooo
    <form class="d-flex" action="index_logged.php" method="post">
      <?php if (!empty($_POST)){echo "<input type='hidden' name='id' value=$id class='form-control'>";} ?>
      <button class="btn btn-primary" type="submit">Home</button>
    </form>
    <form class="d-flex" action="perfil.php" method="post">
      <?php if (!empty($_POST)){echo "<input type='hidden' name='id' value=$id class='form-control'>";} ?>
      <button class="btn btn-outline-primary" type="submit">Perfil</button>
    </form>
  </div>
</nav>

<br><br>