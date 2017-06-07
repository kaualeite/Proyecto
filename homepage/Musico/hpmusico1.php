<?php
session_start();
ob_start();
require_once '../../BBDD/musico.php';
require_once '../../BBDD/local.php';
require_once '../../BBDD/fan.php';
?>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="../indextrycss.css" rel="stylesheet" type="text/css"/>
        <link href="../indexcss.css" rel="stylesheet" type="text/css"/>
        <title>JavaDHuttMusic: Grupo</title>
        <!--bootstrap-->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </head>

    <body>
        <?php
        if (isset($_SESSION["nombre_usuario"])) {
            $tipo = $_SESSION["perfil"];
            if ($tipo == "m") {
                $usuario = $_SESSION["nombre_usuario"];
                $idusu = SelectIdusuario($usuario);
                $generoU = Genero($idusu);
                ?>
                <nav id="top" class="navbar navbar-inverse">
                    <div class="container-fluid">
                        <div class="navbar-header">
                            <a class="navbar-brand" href="">JavaDHuttMusic</a>
                        </div>
                        <ul class="nav navbar-nav">
                            <ul class="dropdown-menu">
                            </ul>
                            <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Idioma <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Castellano</a></li>
                                    <li><a href="#">Inglés</a></li>
                                    <li><a href="#">Chino</a></li>
                                </ul>

                            <li><a href="../../Perfil/musico/modificarMusico.php">Editar perfil</a></li>
                            <li><a href="../loguot.php">Cerrar sesión</a></li>
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
                <div id="encabezado"><img id="img2" src="../../REDES/concert.jpg" alt=""/></div>

                <div class="container">
                    <div class="page-header">
                        <h1>Locales que ofrecen conciertos de mi genero</h1>      
                    </div>
                </div>

                <div class="container">
                    <div class="well"> 
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Idconcierto</th>
                                    <th>Nombre</th>
                                    <th>Estado</th>
                                    <th>Dia</th>
                                    <th>Hora</th>
                                    <th>Pago</th>
                                    <th>Idlocal</th>
                                    <th>Genero</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $result = listConciertosM($generoU);

                                while ($fila = mysqli_fetch_array($result)) {
                                    extract($fila);

                                    echo "<tr><td>$idconcierto</td> <td>$nombre</td> <td>$estado</td> <td>$dia</td> <td>$hora</td> <td>$pago</td> <td>$idlocal</td> <td>$genero</td></tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div></div>

                <div class="container">
                    <div class="page-header">
                        <h1>Locales que ofrecen conciertos</h1>
                    </div>

                </div>

            </div>
            <div class="container">
                <div class="well">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Nombre Concierto</th>
                                <th>Dia</th>
                                <th>Hora</th>
                                <th>Genero</th>
                                <th>Pago</th>
                                <th>Apuntarse</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $listConcierto = selectConciertoAbierto();

                            while ($fila = mysqli_fetch_array($listConcierto)) {
                                extract($fila);
                                ?>
                                <tr>
                                    <td><?php echo $nombre ?></td>
                                    <td><?php echo $dia ?></td>
                                    <td><?php echo $hora ?></td>
                                    <td><?php echo $nomestilo ?></td>
                                    <td><?php echo $pago ?></td>
                                    <td>
                                        <?php
                                        if (VerificarPropuesta($idconcierto, $idusu) == false) {
                                            ?>
                                            <form action="" method="POST">
                                                <input type="hidden" name="nombre" value="<?php echo "$idconcierto"; ?>">
                                                <input type="submit" name="apuntarse" value="apuntarse"/>
                                            </form>
                                            <?php
                                        } else {
                                            ?>
                                            <form action="" method="POST">
                                                <input type="hidden" name="nombre2" value="<?php echo "$idconcierto"; ?>">
                                                <input type="submit" name="desapuntarse" value="desapuntarse"/>
                                            </form>
                                            <?php
                                        }
                                        ?>
                                    </td>
                                </tr>
                                <?php
                            }
                            if (isset($_POST["apuntarse"])) {
                                header('Location: http://www.javadhuttmusic.com/homepage/Musico/hpmusico1.php');
                                $nombre = $_POST["nombre"];

                                Apuntarse($nombre, $usuario);
                                header('Location: http://www.javadhuttmusic.com/homepage/Musico/hpmusico1.php');
                            }
                            if(isset($_POST["desapuntarse"])){
                                header('Location: http://www.javadhuttmusic.com/homepage/Musico/hpmusico1.php');
                                $nombre2 = $_POST["nombre2"];
                                
                                Desapuntarse($nombre2, $idusu);
                                header('Location: http://www.javadhuttmusic.com/homepage/Musico/hpmusico1.php');
                            }
                            ?>
                        </tbody>
                    </table></div></div>

            <div id="banners">

                <a href="https://www.basinstreetrecords.com/"> <img class="ban" src="../../REDES/b1.jpg" alt=""/>   </a>
                <a href="https://www.vevo.com/"> <img class="ban" id="margin" src="../../REDES/b2.png" alt=""  />  </a>
                <a href="https://www.apple.com/itunes/music/">  <img id="b3" class="ban" src="../../REDES/b3.jpg" alt=""  />   </a>
            </div>
            <div id="footer" class="container">
                <div class="row">
                    <hr>
                    <div class="col-lg-12">
                        <div class="col-md-8">
                            <a class="contact"> Contacta:</a> <a>proyectodammail@gmail.com </a> | <a> 956 34 58 12 </a>    
                        </div>
                        <div class="col-md-4">
                            <p class="muted pull-right">© 2017 JavaDHuttMusic. copyright reserved </p>
                        </div>
                    </div>
                </div>
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
        var_dump($_SESSION);
    }
    ?>
</body>
</html>
<?php
ob_end_flush();
?>