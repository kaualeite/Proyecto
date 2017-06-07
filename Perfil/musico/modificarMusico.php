<?php
session_start();
require_once '../../BBDD/modificarP.php';
require_once '../../BBDD/registro.php';
require_once '../../BBDD/local.php';
?>

<html>
    <head>
        <meta charset="utf-8">
        <title>MODIFICAR</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="indextrycss.css" rel="stylesheet" type="text/css"/>


        <!--bootstrap-->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </head>
    <body>
        <?php
        if (isset($_SESSION["nombre_usuario"])) {
            $tipo = $_SESSION["perfil"];
            if ($tipo = "m") {
                $usuario = $_SESSION["nombre_usuario"];
                $imagen = selectImagen($usuario);
                ?>
                <nav id="top" class="navbar navbar-inverse">
                    <div class="container-fluid">
                        <div class="navbar-header">
                            <a class="navbar-brand" href="../../homepage/Musico/hpmusico1.php">JavaDHuttMusic</a>
                        </div>
                        <ul class="nav navbar-nav">
                            <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Idioma <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Castellano</a></li>
                                    <li><a href="#">Inglés</a></li>
                                    <li><a href="#">Chino</a></li>
                                </ul>
                            <li><a  href="../../homepage/loguot.php"><span>Cerrar sesión</span></a>
                            <li><a><?php echo $usuario ?></a></li>
                        </ul>
                        <ul>
                            <div id="follow">
                                <a href="https://twitter.com/JavaDHuttMusic"> <img class="fotos" src="../../REDES/twitter.png" alt=""/>   </a>
                                <a href=" https://plus.google.com/u/2/105799048551360404183"> <img class="fotos" src="../../REDES/google+.png" alt=""/>   </a>
                                <a href="  https://www.facebook.com/Javadhuttmusic-336653820049396/"> <img class="fotos" src="../../REDES/facebook.png" alt=""/>   </a>  
                                <a href="  https://www.instagram.com/javadhuttmusic/"> <img class="fotos" src="../../REDES/instagram.png" alt=""/>   </a> 
                            </div>
                        </ul>    
                    </div>
                </nav>

                <div id="caja1"><h1> <?php echo $usuario ?> </h1>
                    <div class="">
                        <img src="../../imagenuser/<?php echo $imagen ?>" class="img-circle" width="304" height="236"> 
                    </div>
                </div>

                <div id="caja2">
                    <?php
                    $datos = SelectAllUser($usuario);

                    $fila = mysqli_fetch_array($datos);

                    extract($fila);
                    ?>
                    <form  action="" method="post">
                        <fieldset >
                            <input type = "hidden" id = "name" name = "id" value="<?php echo $idusuario; ?>">
                            
                            <label for="name">Nombre de usuario:</label>
                            <input type="text" id="name" name="nombreu" value="<?php echo $nombre_usuario; ?>">

                            <label for="name">Nombre:</label>
                            <input type="text" id="name" name="nombre" value="<?php echo $nombre; ?>">

                            <label for="name">Apellido:</label>
                            <input type="text" id="name" name="apellido" value="<?php echo $apellidos; ?>">

                            <label for="name">Password nueva:</label>
                            <input type="password" id="name" name="nueva">

                            <label for="name">Confirmar Password:</label>
                            <input type="password" id="name" name="conf">
                            
                            <label for="name">Email:</label>
                            <input type="email" id="name" name="email" placeholder="XXXXX@XXXX.XXX" value="<?php echo $email; ?>">

                            <label for="mail">Telefono:</label>
                            <input type="text" id="mail" name="telefono" value="<?php echo $telefono; ?>">

                            <label for="mail">Género:</label>
                            <select name="genero" id="mail">
                                <?php
                                $genero2 = selectGenero();
                                while ($fila = mysqli_fetch_array($genero2)) {
                                    extract($fila);

                                    echo "<option value='$idgenero'>$nomestilo</option>";
                                }
                                ?>
                            </select>
                            
                            <label for="mail">Componentes:</label>
                            <input type="number" id="mail" name="componentes" value="<?php echo $componentes; ?>">
                            
                            <label for="name">Nombre artístico:</label>
                            <input type="text" id="name" name="nombreartistico" value="<?php echo $nombre_artistico; ?>">

                            <label for="name">Nacimiento:</label>
                            <input type="date" id="name" name="nacimiento" placeholder="AAAA-MM-DD" value="<?php echo $nacimiento; ?>">

                            <label>Sexo:</label>
                            <p>
                                <input type="radio"  value="D" name="sexo"><label for="Mujer" class="light">Mujer</label>
                                <input type="radio"  value="H" name="sexo"><label for="Hombre" class="light">Hombre</label>
                            </p>

                            <br>
                            <br>
                        </fieldset>
                        <input type = "submit" value = "Modificar" name = "Modificar">
                    </form>
                    <form enctype="multipart/form-data" action="" method="POST">
                        <input name="uploadedfile" type="file" />
                        <input type="submit"  name="foto" value="Subir archivo" />
                    </form>
                    <?php
                    if (isset($_POST['foto'])) {
                        $target_path = "../../imagenuser/";
                        $target_path = $target_path . basename($_FILES['uploadedfile']['name']);
                        if (move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path)) {
                            echo "El archivo " . basename($_FILES['uploadedfile']['name']) . " ha sido subido";
                            $imagen = $_FILES['uploadedfile']['name'];
                            imagen($usuario, $imagen);
                        } else {
                            echo "Ha ocurrido un error, intentelo otra vez!!";
                        }
                    }
                    ?>
                    <?php
                    if (isset($_POST["Modificar"])) {

                        $nuevaP = $_POST["nueva"];
                        $conf = $_POST["conf"];

                        if ($nuevaP == $conf) {
                            $idusuario = $_POST["id"];
                            $nombreu = $_POST["nombreu"];
                            $nombre = $_POST["nombre"];
                            $apellido = $_POST["apellido"];
                            $genero = $_POST["genero"];
                            $mail = $_POST["email"];
                            $tel = $_POST["telefono"];
                            $nacimiento = $_POST["fecha"];
                            $sexo = $_POST["sexo"];
                            $componentes = $_POST["componentes"];
                            $artistico = $_POST["nombreartistico"];

                            ModificarMusico($idusuario, $nombreu, $nombre, $apellido, $nuevaP, $genero, $componentes, $mail, $tel, $nacimiento, $sexo, $artistico);
                        } else {
                            ?>
                            <h1>La nueva contraseña no coincide con su confirmacion</h1>
                            <?php
                        }
                    }
                    ?>
                </div>
                <?php
            } else {
                ?>
                <p>El usuario usado no es del tipo que se necita para esta pagina</p>
                <?php
            }
        } else {
            ?>
            <p>No se ha iniciado sesion</p>
            <?php
        }
        ?>
    </body>
</html>
