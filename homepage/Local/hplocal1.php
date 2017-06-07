<?php
//var_dump($_SESSION);
session_start();
//var_dump($_SESSION);
ob_start();
require_once '../../BBDD/local.php';
require_once '../../BBDD/concierto.php';
require_once '../../BBDD/fan.php';
?>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="../indextrycss.css" rel="stylesheet" type="text/css"/>
        <link href="../indexcss.css" rel="stylesheet" type="text/css"/>
        <title>JavaDHuttMusic: Local</title>


        <!--bootstrap-->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </head>

    <body>
        <?php
        if (isset($_SESSION["nombre_usuario"])) {
            $tipo = $_SESSION["perfil"];
            if ($tipo == "l") {
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

                            <li><a href="../../Perfil/local/modificarLocal.php">Editar perfil</a></li>
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
                        <h1>Crear conciertos</h1>    
                    </div>
                </div>

                <div class="container">
                    <div class="well">
                        <form action="" method="POST">
                            <div id="nombre">Nombre Concierto</div>
                            <input type="text" name="nombre"><br>
                            <div id="Dia">Dia</div>
                            <input type="date" value="" name="Data"/><br>
                            <div id="hora">Hora</div>
                            <input type="time" value= "" name="Hora"/><br>
                            <div id="pago">Pago</div>
                            <input type="number" name="Pago"/><br>
                            <div id="genero">Genero</div><select name="genero">

                                <?php
                                $genero2 = selectGenero();
                                while ($fila = mysqli_fetch_array($genero2)) {
                                    extract($fila);
                                    echo "<option value='$idgenero'>$nomestilo</option>";
                                }
                                ?>
                            </select><br>
                            <input type="submit" name="enviar" value="Registrar"/>
                        </form>

                        <?php
                        if (isset($_POST['enviar'])) {

                            $nombre = $_POST['nombre'];
                            $dia = $_POST['Data'];
                            $hora = $_POST['Hora'];
                            $pago = $_POST['Pago'];
                            $genero = $_POST['genero'];

                            insertConcierto($nombre, "O", $dia, $hora, $pago, $usuario, $genero);
                        }
                        ?>
                    </div>
                </div>


                <div class="container">
                    <div class="page-header">
                        <h1>Mis conciertos</h1>      
                    </div>

                </div>
                <div class="container">
                    <div class="well">
                        <?php
                        // Asignamos un grupo a un concierto
                        // idgrupa: Contiene el id del grupo asignado
                        // idconp:  Valor del concierto al que se asigna el grupo			

                        if ($_GET['ida'] == 'listgcp') {
                            $idgrup = $_GET['idgrupa'];
                            $idconcert = $_GET['idconp'];

                            asignamos_grupo_a_concierto($idgrup, $idconcert);
                        }

                        // Damos de baja un grupo musical asignado a un concierto
                        // idgrupp: Contiene el id del grupo a dar de baja
                        // idcona: Valor del concierto que tiene asignado el grupo que tenemos que dar de baja

                        if ($_GET['ida'] == 'listca') {
                            $idgrup = $_GET['idgrupp'];
                            $idconcert = $_GET['idcona'];

                            quitamos_grupo_de_concierto($idgrup, $idconcert);
                        }

                        // Listado de conciertos con grupo musical asignado
                        listamos_conciertos_con_grupo_asignado($idusu);

                        // Listado de conciertos pendientes de asignar un grupo musical
                        listamos_conciertos_pendientes_de_grupo($idusu);

                        // Listamos los grupos inscritos a un concierto pendiente de asignar	
                        // idconp: Contiene el id del concierto pendiente de asignar grupo				
                        if ($_GET['ida'] == 'listgcpa') {
                            $idconcert = $_GET['idconp'];
                            listamos_grupos_inscritos_en_concierto($idusu, $idconcert);
                        }
                        ?>
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