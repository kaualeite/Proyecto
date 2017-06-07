<?php

session_start();

$_SESSION = array($_SESSION['idusuario'], $_SESSION['username'], $_SESSION['perfil']);

session_destroy();
header('Location: ../index.php');