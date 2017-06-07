<?php
session_start();
ob_start();
require_once 'BBDD/musico.php';
?>
<html>
    <head>
        <title>JavaDHuttMusic: Home</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="homepage/indexcss.css" rel="stylesheet" type="text/css"/>
        <link href="homepage/indextrycss.css" rel="stylesheet" type="text/css"/>

        <!--bootstrap-->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    </head>
    <body>
        <nav id="top" class="navbar navbar-inverse">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="#">JavaDHuttMusic</a>
                </div>
                <ul class="nav navbar-nav">

                    <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Registrarse <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="Registro/fan/RFan.php">Fan</a></li>
                            <li><a href="Registro/musico/RGrupo.php">Musico</a></li>
                            <li><a href="Registro/local/RLocal.php">Local</a></li>
                        </ul>



                    <li class="dropdown"><a class="dropdown-toggle" class="entrar1" data-toggle="dropdown" href="#">Entrar <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <form class="form-inline" method="post" class="entrar" action="">
                                <div class="entrar" class="form-group">
                                    <label for="text" class="entrar" >Usuario:</label>
                                    <input type="text"  class="entrar" class="form-control" id="email" placeholder="Usuario" name="nombreu">
                                </div>
                                <div class="entrar" class="form-group">
                                    <label for="pwd" class="entrar" >ContraseÃ±a:</label>
                                    <input type="password" class="entrar" class="form-control" id="pwd" placeholder="* * * * * * * * * * * * *" name="password">
                                </div>
                                <article>.</article>
                                <div class="entrar" class="form-group">
                                    <button type="submit" class="entrar" class="btn btn-default" name="entrar" value="entrar">Entrar</button>
                                </div>
                            </form>
                        </ul>

                        <?php
                        require_once './BBDD/login.php';

                        if (isset($_POST['entrar'])) {
                            $usuario = $_POST['nombreu'];
                            $pass = $_POST['password'];
                            if (validateUser($usuario, $pass) == TRUE) {

                                $_SESSION["nombre_usuario"] = $usuario;
                                echo $usuario;
                                $tipo = getTypeByName($_SESSION["nombre_usuario"]);

                                $_SESSION["perfil"] = $tipo;
                                var_dump($_SESSION);
                                if ($tipo == "f") {
                                    header('Location: http://www.javadhuttmusic.com/homepage/Fan/hpfan1.php');
                                } elseif ($tipo == "l") {
                                    header('Location: http://www.javadhuttmusic.com/homepage/local/hplocal1.php');
                                } elseif ($tipo == "m") {
                                    header('Location: http://www.javadhuttmusic.com/homepage/musico/hpmusico1.php');
                                } else {
                                    ?>
                                    <p>... a ver si recordamos las cosas, algo esta mal</p>
                                    <?php
                                }
                            } else {
                                echo "error";
                            }
                        }
                        ?>

                    <li class="dropdown">

                </ul>
                <ul>
                    <div id="follow">
                        <a href="https://twitter.com/JavaDHuttMusic"> <img class="fotos" src="REDES/twitter.png" alt=""/>   </a>
                        <a href=" https://plus.google.com/u/2/105799048551360404183"> <img class="fotos" src="REDES/google+.png" alt=""/>   </a>
                        <a href="  https://www.facebook.com/Javadhuttmusic-336653820049396/"> <img class="fotos" src="REDES/facebook.png" alt=""/>   </a>  
                        <a href="  https://www.instagram.com/javadhuttmusic/"> <img class="fotos" src="REDES/instagram.png" alt=""/>   </a> 
                    </div>
                </ul>    
            </div>
        </nav>

        <div id="encabezado"><img id="img2" src="REDES/concert.jpg" alt=""/></div>
        <div id="superior1">

            <!--bootstrap-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-6 col-sm-offset-3">
                        <div id="buscar"> 
                            <div class="input-group stylish-input-group">
                                <input type="text" class="form-control"  placeholder="Search" >
                                <span class="input-group-addon">
                                    <button type="submit">
                                        <span class="glyphicon glyphicon-search"></span>
                                    </button>  
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br><br>

        <div id="superior2">
            <div class="jumbotron text-center">
                <h1>Proximos conciertos</h1>

                <div class="container">
                    <div class="well"><table class="table">
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
                                </tr>
                                <?php
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>


        <div id="banners">
            <a href="https://www.basinstreetrecords.com/"> <img class="ban" src="REDES/b1.jpg" alt=""/>   </a>
            <a href="https://www.vevo.com/"> <img class="ban" id="margin" src="REDES/b2.png" alt=""  />  </a>
            <a href="https://www.apple.com/itunes/music/">  <img id="b3" class="ban" src="REDES/b3.jpg" alt=""  />   </a>
        </div>

        <div id="footer" class="container">
            <div class="row">
                <hr>
                <div class="col-lg-12">
                    <div class="col-md-8">
                        <a class="contact"> Contacta:</a> <a>proyectodammail@gmail.com </a> | <a> 956 34 58 12 </a>    
                    </div>
                    <div class="col-md-4">
                        <p class="muted pull-right">Â© 2017 JavaDHuttMusic. copyright reserved </p>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>

<?php
ob_end_flush();
?>