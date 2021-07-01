<?php include('./templates/header.html');   ?>
    <body>
        <div class='main'>
            <h1 class='title'>Registrar Usuario </h1>
            <div class='container'>
                <h3>Ingrese sus datos</h3>

                <form  action='./registro.php' method='POST'>
                    <div class='form-element'>
                        <label for='name'>Nombre</label>
                        <input type='text' name='nombre' />
                    </div>


                    <div class='form-element'>
                        <label for='total'>Rut</label>
                        <input type='text' name='rut' />
                    </div>
                    

                    <div class='form-element'>
                        <label for='hp'>Edad</label>
                        <input type='number' name='edad' />
                    </div>
                    

                    <div class='form-element'>
                        <label for='hp'>Dirección</label>
                        <input type='text' name='direccion' />
                    </div>


                    <input class='btn' type='submit' value='Registrar'>
                </form>
            </div>
        </div>
        <footer>
            <p>
                Registro
            </p>
        </footer>

    </body>
</html>