<?php

function conectar($database) {
    $conexion = mysqli_connect("mysql119.srv-hostalia.com", "u4969761_java", "Stucom-2017", "db4969761_proyecto")or
            die("NO SE HA PODIDO CONECTAR A LA BASE DE DATOS!!!");

    return $conexion;
}

function desconectar($conexion) {
    mysqli_close($conexion);
}