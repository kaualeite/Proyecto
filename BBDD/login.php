<?php

require_once 'bbdd.php';

function validateUser($usuario, $pass) {
    $con = conectar("db4969761_proyecto");
    $query = "select * from usuario where nombre_usuario = '$usuario';";
    $resultado = mysqli_query($con, $query);
    $filas = mysqli_num_rows($resultado);
    desconectar($con);
    //comprobar si hay usser
    if ($filas > 0) {//si
        return true;
    } else {//no
        return false;
    }
}

function getTypeByName($usuario) {
    $con = conectar("db4969761_proyecto");
    $query = "select perfil from usuario where nombre_usuario = '$usuario';";
    $resultado = mysqli_query($con, $query);
    //extraemos el resultado
    $fila = mysqli_fetch_array($resultado);
    extract($fila);
    desconectar($con);
    //devolvemos consulta
    return $perfil;
}
