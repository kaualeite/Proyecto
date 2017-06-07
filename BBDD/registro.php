<?php

require_once 'bbdd.php';

function insertarLocal($usuario, $pass, $nombre, $apellido, $mail, $municipio, $telefono, $sexo, $nacimiento, $artistico, $direccion, $aforo, $perfil){
    $con = conectar("db4969761_proyecto");
    $insert = "Insert into "
            . "usuario(nombre_usuario, password, nombre, apellidos, email, telefono, ciudad, sexo, nacimiento, nombre_artistico, direccion, aforo, perfil) values('$usuario', '$pass', '$nombre', '$apellido', '$mail', '$telefono', '$municipio', '$sexo', '$nacimiento', '$artistico', '$direccion', $aforo, '$perfil');";
    if (mysqli_query($con, $insert)) {
        //si ha ido bien
        echo "Usuario dado de alta";
    } else {
        //sino
        echo mysqli_error($con);
    }
    desconectar($con);
}

function insertarFan($name, $pass, $nom, $apellido, $mail, $telefono, $ciudad, $sexo, $nacimiento, $perfil) {
    $con = conectar("db4969761_proyecto");
    $insert = "Insert into "
            . "usuario(nombre_usuario, password, nombre, apellidos, email, telefono, ciudad, sexo, nacimiento, perfil) "
            . "values('$name', '$pass', '$nom', '$apellido', '$mail', '$telefono','$ciudad', '$sexo', '$nacimiento', '$perfil');";
    if (mysqli_query($con, $insert)) {
        //si ha ido bien
        echo "Usuario dado de alta";
    } else {
        //sino
        echo mysqli_error($con);
    }
    desconectar($con);
}

function insertarGrupo($name, $pass, $nom, $apellido, $mail, $telefono, $sexo, $nacimiento, $artistico, $genero, $miembros, $perfil) {
    $con = conectar("db4969761_proyecto");
    $insert = "Insert into "
            . "usuario(nombre_usuario, password, nombre, apellidos, email, telefono, sexo, nacimiento, nombre_artistico, genero, componentes, perfil) "
            . "values('$name', '$pass', '$nom', '$apellido', '$mail', '$telefono', '$sexo', '$nacimiento', '$artistico', '$genero', '$miembros', '$perfil');";
    if (mysqli_query($con, $insert)) {
        //si ha ido bien
        echo "Usuario dado de alta";
    } else {
        //sino
        echo mysqli_error($con);
    }
    desconectar($con);
}

function existUser($nombre){
    $con = conectar("db4969761_proyecto");
    $query = "select nombre_usuario from usuario where nombre_usuario = '$nombre';";
    $resultado = mysqli_query($con, $query);
    desconectar($con);
    //vemos si devuelve algo
    $num_rows = mysqli_num_rows($resultado);
    //si devuelve
    if($num_rows ==0){
        return false;
    }else{
        return true;
    }
}

function selectCiudad() {
    $con = conectar("db4969761_proyecto");
    $select = "select nomciudad, idciudad from ciudad";
    $resultado = mysqli_query($con, $select);
    desconectar($con);
    return $resultado;
}