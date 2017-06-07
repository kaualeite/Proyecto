<?php
session_start();
ob_start();
require_once '../../BBDD/fan.php';
require_once '../../BBDD/local.php';
require_once '../../BBDD/musico.php';
?>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="../indextrycss.css" rel="stylesheet" type="text/css"/>
        <link href="../indexcss.css" rel="stylesheet" type="text/css"/>
        <title>JavaDHuttMusic: Fan</title>

        <!--bootstrap-->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


    </head>

    <body>
        <?php
        if (isset($_SESSION["nombre_usuario"])) {
            $tipo = $_SESSION["perfil"];
            if ($tipo == "f") {
                $usuario = $_SESSION["nombre_usuario"];
                $idusu = SelectIdusuario($usuario);
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

                            <li><a href="../../Perfil/fan/modificarFan.php">Editar perfil</a></li>
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
                <?php
                $total = totalM();
                if (isset($_GET["contador"])) {
                    $contador = $_GET["contador"];
                } else {
                    $contador = 0;
                }
                ?>

                <div class="container">
                    <div class="page-header">
                        <h1>Votar grupos</h1>      
                    </div>

                </div>
                <div class="container">
                    <div class="well">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Genero</th>
                                    <th>Componntes</th>
                                    <th>Votar</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $result2 = listMusicos2($contador, 5);

                                while ($fila = mysqli_fetch_array($result2)) {
                                    extract($fila);
                                    ?>
                                    <tr>
                                        <td><?php echo $nombre_artistico ?></td>
                                        <td><?php echo $nomestilo ?></td>
                                        <td><?php echo $componentes ?></td>
                                        <td>
                                            <?php
                                            if (VerificarVotoG($idusu, $idusuario) == true) {
                                                ?>
                                                <form action="" method="POST">
                                                    <input type="hidden" name="idusuario" value="<?php echo "$idusuario"; ?>">
                                                    <a><input type="submit" name="borrarg" value="-1"/></a>
                                                    <span>+1</span>
                                                </form>
                                                <?php
                                            } else {
                                                ?>
                                                <form action="" method="POST">
                                                    <span>-1</span>
                                                    <input type="hidden" name="idusuario" value="<?php echo "$idusuario"; ?>">
                                                    <a><input type="submit" name="votarg" value="+1"/></a>
                                                </form>
                                                <?php
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                    <?php
                                }
                                if (isset($_POST["votarg"])) {
                                    header('Location: http://www.javadhuttmusic.com/homepage/fan/hpfan1.php');
                                    $idconcierto = $_POST["idusuario"];
                                    votarG($idusu, $idconcierto);
                                    header('Location: http://www.javadhuttmusic.com/homepage/fan/hpfan1.php');
                                }

                                if (isset($_POST["borrarg"])) {
                                    header('Location: http://www.javadhuttmusic.com/homepage/fan/hpfan1.php');
                                    $idconcierto = $_POST["idusuario"];
                                    BorrarVotoG($idusu, $idconcierto);
                                    header('Location: http://www.javadhuttmusic.com/homepage/fan/hpfan1.php');
                                }
                                ?>
                            </tbody>
                        </table>
                        <div id="superior2">
                            <?php
                            if (($contador > 0)) {
                                ?>
                                <a href="hpfan1.php?contador=<?php echo ($contador - 5) ?>">ANTERIOR</a>
                                <?php
                            }

                            //Mostrando mensajes de los resultados actuales
                            if (($contador + 5) <= $total) {
                                ?>
                                Mostrando de <?php echo ($contador + 1); ?> a <?php echo ($contador + 5); ?> de <?php echo $total; ?>
                                <?php
                            } else {
                                ?>
                                Mostrando de <?php echo ($contador + 1); ?> a <?php echo ($total); ?> de <?php echo ($total) ?>
                                <?php
                            }

                            //Mostrar siguiente
                            if (($contador + 5) < $total) {
                                ?>
                                <a href="hpfan1.php?contador=<?php echo ($contador + 5) ?>">SIGUIENTE</a>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>

                <?php
                $total2 = totalC();
                if (isset($_GET["contador2"])) {
                    $contador2 = $_GET["contador2"];
                } else {
                    $contador2 = 0;
                }
                ?>

                <div class="container">
                    <div class="page-header">
                        <h1>Votar Conciertos</h1>      
                    </div>

                </div>
                <div class="container">
                    <div class="well"><table class="table">
                            <thead>
                                <tr>
                                    <th>Nombre Concierto</th>
                                    <th>Dia</th>
                                    <th>Hora</th>
                                    <th>Genero</th>
                                    <th>Votar</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $listConcierto = selectConciertoAbierto2($contador, 5);

                                while ($fila = mysqli_fetch_array($listConcierto)) {
                                    extract($fila);
                                    ?>
                                    <tr>
                                        <td><?php echo $nombre ?></td>
                                        <td><?php echo $dia ?></td>
                                        <td><?php echo $hora ?></td>
                                        <td><?php echo $nomestilo ?></td>
                                        <td>
                                            <?php
                                            if (VerificarVotoL($idusu, $idconcierto) == true) {
                                                ?>
                                                <form action="" method="POST">
                                                    <input type="hidden" name="idconcierto" value="<?php echo "$idconcierto"; ?>">
                                                    <a><input type="submit" name="borrarl" value="-1"/></a>
                                                    <span>+1</span>
                                                </form>
                                                <?php
                                            } else {
                                                ?>
                                                <form action="" method="POST">
                                                    <span>-1</span>
                                                    <input type="hidden" name="idconcierto" value="<?php echo "$idconcierto"; ?>">
                                                    <a><input type="submit" name="votarl" value="+1"/></a>
                                                </form>
                                                <?php
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                    <?php
                                }
                                if (isset($_POST["votarl"])) {
                                    header('Location: http://www.javadhuttmusic.com/homepage/fan/hpfan1.php');
                                    $idconcierto = $_POST["idconcierto"];
                                    votarL($idusu, $idconcierto);
                                    header('Location: http://www.javadhuttmusic.com/homepage/fan/hpfan1.php');
                                }
                                if (isset($_POST["borrarl"])) {
                                    header('Location: http://www.javadhuttmusic.com/homepage/fan/hpfan1.php');
                                    $idconcierto = $_POST["idconcierto"];
                                    BorrarVotoL($idusu, $idconcierto);
                                    header('Location: http://www.javadhuttmusic.com/homepage/fan/hpfan1.php');
                                }
                                ?>
                            </tbody>
                        </table>
                        <div id="superior2">
                            <?php
                            if (($contador2 > 0)) {
                                ?>
                                <a href="hpfan1.php?contador2=<?php echo ($contador - 5) ?>">ANTERIOR</a>
                                <?php
                            }

                            //Mostrando mensajes de los resultados actuales
                            if (($contador2 + 5) <= $total2) {
                                ?>
                                Mostrando de <?php echo ($contador2 + 1); ?> a <?php echo ($contador2 + 5); ?> de <?php echo $total2; ?>
                                <?php
                            } else {
                                ?>
                                Mostrando de <?php echo ($contador2 + 1); ?> a <?php echo ($total2); ?> de <?php echo ($total2) ?>
                                <?php
                            }

                            //Mostrar siguiente
                            if (($contador2 + 5) < $total2) {
                                ?>
                                <a href="hpfan1.php?contador2=<?php echo ($contador2 + 5) ?>">SIGUIENTE</a>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>

                <div class="container">
                    <div class="page-header">
                        <h1>Proximos conciertos</h1>      
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
                                        <?php
                                    }
                                    ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div id="social">
                    <div class="container">
                        <div class="row centered">

                            <div class="col-lg-2">
                                <a href="https://www.facebook.com/Javadhuttmusic-336653820049396/?ref=aymt_homepage_panel"><i class="fa fa-facebook"></i></a>
                            </div>
                            <div class="col-lg-2">
                                <a href="https://twitter.com/JavaDHuttMusic"><i class="fa fa-twitter"></i></a>
                            </div>
                            <div class="col-lg-2">
                                <a href="https://www.instagram.com/proyectodammmail/"><i class="fa fa-instagram"></i></a>
                            </div>


                        </div>
                    </div>
                </div>

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