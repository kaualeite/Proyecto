<!DOCTYPE html>
<html >
    <head>
        <meta charset="UTF-8">
        <title>Registro Fan</title>
        <link href="cssF.css" rel="stylesheet" type="text/css"/>  
    </head>
    <body>
    <head>
    </head>
    <body>
        <h1><a class="navbar-brand" href="../../index.php">Fan</a></h1>
        <?php
        require_once '../../BBDD/registro.php';

        if (isset($_POST['registrar'])) {

            $usuario = $_POST['NombreUser'];

            if (existUser($usuario)) {
                ?>
                <p>Ya existe un usuario con ese nombre</p>
                <?php
            } else {
                $pass = $_POST['Contraseña'];
                $pass2 = $_POST['Conf'];

                if ($pass != $pass2) {
                    ?>
                    <p>Contraseñas no coinciden</p>
                    <?php
                } else {
                    $nom = $_POST['Nombre'];
                    $apellido = $_POST['Apellido'];
                    $mail = $_POST['Email'];
                    $telefono = $_POST['Telefono'];
                    $ciudad = $_POST['ciudad'];
                    $sexo = $_POST['Sexo'];
                    $nacimiento = $_POST['Necimiento'];

                    insertarFan($usuario, $pass, $nom, $apellido, $mail, $telefono, $ciudad, $sexo, $nacimiento, 'f');
                }
            }
        }
            ?>
            <form action="" method="POST">
                <div id="all">
                    <div id="nombre">Nombre Usuario</div>
                    <input type="text" name="NombreUser"/>
                    <div id="nombre">Nombre </div>
                    <input type="text" name="Nombre"/>
                    <div id="nombre">Apellido</div>
                    <input type="text" name="Apellido"/>
                    <div id="contrasena">Contraseña</div>
                    <input type="password" name="Contraseña"/>
                    <div id="contrasena">Confirmar contraseña</div>
                    <input type="password" name="Conf"/>
                    <div id="municipio">Ciudad</div>
                    <select name="ciudad">
                        <?php
                        $ciudad = selectCiudad();
                        while ($fila = mysqli_fetch_array($ciudad)) {
                            extract($fila);
                            echo "<option value='$idciudad'>$nomciudad</option>";
                        }
                        ?>
                    </select>
                    <div id="email">Email</div>
                    <input type="email" name="Email"/>
                    <div id="telefono">Telefono</div>
                    <input type="text" name="Telefono"/>
                    <div id="sexo" >Sexo</div>
                    <div id="subsexo">Hombre<input type="radio" name="Sexo" value="H"/> Mujer<input type="radio" name="Sexo" value="D"/></div>
                    <div id="nacimiento">Nacimiento</div>
                    <input type="text" name="Necimiento"/><br>
                    <input type="submit" name="registrar" value="registrar">
                </div>
            </form>
    </body>
</html>


</body>
</html>
