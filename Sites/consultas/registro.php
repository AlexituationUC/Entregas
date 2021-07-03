<?php include('../templates_html/header.html'); ?>

<body>
    <div class="container h-100" >
        <h1 align="center">Registrar Usuario </h1>
        <div class="row h-100 justify-content-center align-items-center">
            <div class="col-10 col-md-8 col-lg-6">
                <h3 align="center">Ingrese sus datos</h3>

                <br>

                <form align="center" action='consultas_registro/registro.php' method='POST'>

                    <div class="form-floating">
                        <input type="text" name="nombre" class="form-control" placeholder="Nombre">
                        <label>Nombre</label>
                    </div>

                    <br>

                    <div class="form-floating">
                        <input type="text" name="rut" class="form-control" placeholder="Rut">
                        <label>Rut</label>
                    </div>

                    <br>

                    <div class="form-floating">
                        <input type="number" name="edad" class="form-control" placeholder="Edad">
                        <label>Edad</label>
                    </div>

                    <br>

                    <div class="form-floating">
                        <input type="text" name="direccion" class="form-control" placeholder="Direccion">
                        <label>Direccion</label>
                    </div>

                    <br>

                    <button type="submit" class="btn btn-primary">Registrar</button>
                </form>
            </div>
        </div>
    </div>

</body>

<?php include('../templates_html/footer.html'); ?>