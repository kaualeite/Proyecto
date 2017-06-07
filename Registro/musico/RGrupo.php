<!DOCTYPE html>
<html >
    <head>
        <meta charset="UTF-8">
        <title>Registro Grupo</title>
        <link href="cssG.css" rel="stylesheet" type="text/css"/>  
    </head>
    <body>
    <head>
    </head>
    <body>

        <h1><a class="navbar-brand" href="../../index.php">Grupo</a></h1>

        <?php
        require_once '../../BBDD/registro.php';
        require_once '../../BBDD/local.php';

        if (isset($_POST['registrar'])) {

            $usuario = $_POST['nombre'];

            if (existUser($usuario)) {
                ?>
                <p>Ya existe un usuario con ese nombre</p>
                <?php
            } else {
                $pass = $_POST['password'];
                $pass2 = $_POST['Conf'];

                if ($pass != $pass2) {
                    ?>
                    <p>Contraseñas no coinciden</p>
                    <?php
                } else {
                    $nom = $_POST['nom'];
                    $apellido = $_POST['ape'];
                    $mail = $_POST['mail'];
                    $telefono = $_POST['telefono'];
                    $sexo = $_POST['Sexo'];
                    $nacimiento = $_POST['Necimiento'];
                    $artistico = $_POST['artistico'];
                    $genero = $_POST['genero'];
                    $miembros = $_POST['miembros'];

                    insertarGrupo($usuario, $pass, $nom, $apellido, $mail, $telefono, $sexo, $nacimiento, $artistico, $genero, $miembros, 'm');
                }
            }
        } else {
            ?>
            <form action="" method="POST">
                <header></header>
                <div id="nom">Registro Grupo</div>
                <div id="pagina">

                    <div id="nombreus">Nombre Usuario</div>
                    <input type="text" name="nombre">
                    <div id="password">Contraseña</div>
                    <input type="password" name="password">
                    <div id="contrasena">Confirmar contraseña</div>
                    <input type="password" name="Conf"/>
                    <div id="nombre">Nombre</div>
                    <input type="text" name="nom">
                    <div id="ape">Apellido</div>
                    <input type="text" name="ape">
                    <div id="mail">Email</div>
                    <input type="email" name="mail">
                    <div id="telefono">Telefono</div>
                    <input type="text" name="telefono" max="9" min="9">
                    <div id="sexo" >Sexo</div>
                    <div id="subsexo">Hombre<input type="radio" name="Sexo" value="H"/>
                        Mujer<input type="radio" name="Sexo" value="D"/></div>
                    <div id="nacimiento">Nacimiento</div>
                    <input type="text" name="Necimiento"/><br>
                    <div id="nombre">Nombre artistico</div>
                    <input type="text" name="artistico">
                    <div id="genero">Genero</div>
                    <select name="genero">
                        <?php
                        $genero2 = selectGenero();
                        while ($fila = mysqli_fetch_array($genero2)) {
                            extract($fila);

                            echo "<option value='$idgenero'>$nomestilo</option>";
                        }
                        ?>
                    </select>
                    <div id="numero">Numero de Miembros</div>
                    <input type="number" name="miembros" min="1">
                    <div id="registro">
                        <input type="submit" name="registrar" value="registrar">
                    </div>
                </div>
            </form>
            <?php
        }
        ?>

    </body>
</html>


</body>
</html>
