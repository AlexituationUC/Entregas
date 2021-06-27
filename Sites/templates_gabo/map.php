<?php

    //require("../config/conexion.php");

    $latitude = "48.86926";
    $longitude = "62.3321";

?>

<!DOCTYPE html>
    <html>

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title> Mi Tienda Web </title>
        <!-- Bootstrap(CSS), Jquery (javascripts), etc... -->

        <!-- para que sea index.php pueda importarlo -->
        <link rel="stylesheet" href="styles/mystyles.css">
        <!-- para que una consulta.php pueda importarlo -->
        <link rel="stylesheet" href="../styles/mystyles.css">

        <!-- Mapbox -->
        <script src="https://api.mapbox.com/mapbox-gl-js/v2.3.1/mapbox-gl.js"></script>
        <link href="https://api.mapbox.com/mapbox-gl-js/v2.3.1/mapbox-gl.css" rel="stylesheet"/>
    </head>

    <body>

        <center> <div id='map' style='width: 400px; height: 300px;'></div>
            <script>
                mapboxgl.accessToken = 'pk.eyJ1IjoiZ2FiMC12aCIsImEiOiJja3FmbjBhaG4wczdkMm9udXFxYWtydHl2In0.dNR8LX-3sxjCx6h7xG8Mng';
                var map = new mapboxgl.Map({
                    container: 'map',
                    style: 'mapbox://styles/mapbox/streets-v11',
                    center: [<?php $longitude ?>, <?php $latitude ?>], //lng,lat
                    zoom: 11
                });
                var marker = new mapboxgl.Marker()
                .setLngLat([<?php $longitude ?>, <?php $latitude ?>])
                .setPopup(new mapboxgl.Popup().setHTML("<h1> Pop up </h1>"))
                .addTo(map);
                map.addControl(new mapboxgl.NavigationControl());
            </script>
        </center>

<?php include('../templates/footer.html'); ?>