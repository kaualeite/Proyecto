<?php

require_once 'bbdd.php';

function SelectAllUser($usuario) {
    $con = conectar("db4969761_proyecto");
    $query = "Select * from usuario where nombre_usuario='$usuario';";
    $resultado = mysqli_query($con, $query);
    desconectar($con);
    return $resultado;
}

function ModificarFan($idusuario, $nombreu, $nombre, $apellido, $nuevaP, $ciudad, $mail, $tel, $nacimiento, $sexo) {
    $con = conectar("db4969761_proyecto");
    $update = "update usuario set nombre_usuario = '$nombreu', password = '$nuevaP', nombre = '$nombre', apellidos = '$apellido', email = '$mail', telefono = '$tel', nacimiento = '$nacimiento', sexo = '$sexo' where idusuario = $idusuario";
    if (mysqli_query($con, $update)) {
        ?>
        <p>Modificado</p>
        <?php
    } else {
        echo mysqli_error($con);
    }
    desconectar($con);
}


function ModificarLocal($idusuario, $nombreu, $nombre, $apellido, $nuevaP, $ciudad, $mail, $tel, $nacimiento, $sexo, $aforo, $direc, $artistico) {
    $con = conectar("db4969761_proyecto");
    $update = "update usuario set nombre_usuario = '$nombreu', password = '$nuevaP', nombre = '$nombre', apellidos = '$apellido', email = '$mail', telefono = '$tel', nacimiento = '$nacimiento', nombre_artistico = '$artistico', sexo = '$sexo', direccion = '$direc', aforo = '$aforo' where idusuario = $idusuario";
    if (mysqli_query($con, $update)) {
        ?>
        <p>Modificado</p>
        <?php
    } else {
        echo mysqli_error($con);
    }
    desconectar($con);
}

function ModificarMusico($idusuario, $nombreu, $nombre, $apellido, $nuevaP, $genero, $componentes, $mail, $tel, $nacimiento, $sexo, $artistico){
    $con = conectar("db4969761_proyecto");
    $update = "update usuario set nombre_usuario = '$nombreu', password = '$nuevaP', nombre = '$nombre', apellidos = '$apellido', email = '$mail', telefono = '$tel', nacimiento = '$nacimiento', nombre_artistico = '$artistico', genero = '$genero', componentes = '$componentes', sexo = '$sexo' where idusuario = $idusuario";
    if (mysqli_query($con, $update)) {
        ?>
        <p>Modificado</p>
        <?php
    } else {
        echo mysqli_error($con);
    }
    desconectar($con);
}

//funcion para guardar el nombre de las imagenes
function imagen($usuario,$imagen){
    $con = conectar("db4969761_proyecto");           
    $update = "update usuario set imagen = '$imagen' where nombre_usuario = '$usuario';";
     if (mysqli_query($con, $update)){
        echo "";
    }else{
        echo mysqli_error($con);
    }
    desconectar($con);
}

function selectImagen($usuario) {
    $con = conectar("db4969761_proyecto");
    $query = "select imagen from usuario where nombre_usuario = '$usuario';";
    $resultado = mysqli_query($con, $query);
    desconectar($con);
    $fila = mysqli_fetch_array($resultado);
    extract($fila);
    //$_FILES['uploadedfile']['name']
    return $imagen;
}
