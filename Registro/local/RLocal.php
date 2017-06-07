<!DOCTYPE html>
<html >
    <head>
        <meta charset="UTF-8">
        <title>Registro Local</title>
        <link href="cssL.css" rel="stylesheet" type="text/css"/>  
    </head>

    <body>
        <h1><a class="navbar-brand" href="../../index.php">Local</a></h1>
        <?php
        require_once '../../BBDD/registro.php';

        if (isset($_POST['registrar'])) {

            $usuario = $_POST['NombreUsuario'];

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
                    $nombre = $_POST['Nombre'];
                    $apellido = $_POST['Apellido'];
                    $mail = $_POST['Email'];
                    $municipio = $_POST['ciudad'];
                    $sexo = $_POST['Sexo'];
                    $nacimiento = $_POST['Necimiento'];
                    $artistico = $_POST['NombreArtistico'];
                    $direccion = $_POST['direccion'];
                    $aforo = $_POST['aforo'];
                    $telefono = $_POST['Telefono'];

                    insertarLocal($usuario, $pass, $nombre, $apellido, $mail, $municipio, $telefono, $sexo, $nacimiento, $artistico, $direccion, $aforo, "l");
                }
            }
        } else {
            ?>
            <form action = "" method = "POST">
                <div id = "all">
                    <div id="usuario">Nombre Usuario</div>
                    <input type="text" name="NombreUsuario"/>
                    <div class="nombre">Nombre</div>
                    <input type="text" name="Nombre"/>
                    <div class="nombre">Apellido</div>
                    <input type="text" name="Apellido"/>
                    <div class="nombre">Nombre Artístico</div>
                    <input type="text" name="NombreArtistico"/>
                    <div id="contrasena">Contraseña</div>
                    <input type="password" name="Contraseña"/>
                    <div id="contrasena">Confirmar contraseña</div>
                    <input type="password" name="Conf"/>
                    <div id="email">Email</div>
                    <input type="email" name="Email"/>
                    <div id="telefono">Telefono</div>
                    <input type="text" name="Telefono"/>
                    <div id="nacimiento">Nacimiento</div>
                    <input type="text" name="Necimiento"/><br>
                    <div id="municipio">Ciudad</div><select name="ciudad">
                        <?php
                        $ciudad = selectCiudad();

                        while ($fila = mysqli_fetch_array($ciudad)) {
                            extract($fila);
                            echo "<option value='$idciudad'>$nomciudad</option>";
                        }
                        ?>
                    </select>
                    <div id = "aforo" >Aforo</div>
                    <input type = "number" name = "aforo"/>
                    <div id = "direccion">Direccion</div>
                    <input type = "text" name = "direccion"/>
                    <div id="sexo" >Sexo</div>
                    <div id="subsexo">
                        Hombre<input id="s" type="radio" name="Sexo" value="H"/>
                        Mujer<input id="s" type="radio" name="Sexo" value="D"/>
                    </div><br>
                    <input type="submit" name="registrar" value="registrar">
                </div>
            </form>
            <?php
        }
        ?>

    </body>
</html>


</body>
</html>
