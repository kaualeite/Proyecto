<?php

require_once 'bbdd.php';

function SelectIdusuario($usuario) {
    $con = conectar("db4969761_proyecto");
    $query = "select idusuario from usuario where nombre_usuario='$usuario';";
    $resultado = mysqli_query($con, $query);
    $fila = mysqli_fetch_array($resultado);
    extract($fila);
    desconectar($con);
    return $idusuario;
}

function VerificarVotoL($usuario, $idgrupo) {
    $con = conectar("db4969761_proyecto");
    $query = "select * from voto_concierto where idfan='$usuario' and idconcierto = '$idgrupo'";
    $resultado = mysqli_query($con, $query);
    desconectar($con);
    //vemos si devuelve algo
    $num_rows = mysqli_num_rows($resultado);
    //si devuelve
    if ($num_rows == 0) {
        return false;
    } else {
        return true;
    }
}

function VotarL($usuario, $idgrupo) {
    $con = conectar("db4969761_proyecto");
    $query = "INSERT INTO voto_concierto VALUES ('$usuario', '$idgrupo');";
    if (mysqli_query($con, $query)) {
        //si ha ido bien
    } else {
        //sino
        echo mysqli_error($con);
    }
    desconectar($con);
}

function BorrarVotoL($usuario, $idgrupo) {
    $con = conectar("db4969761_proyecto");
    $query = "delete from voto_concierto where idfan='$usuario' and idconcierto='$idgrupo'";
    if (mysqli_query($con, $query)) {
        //si ha ido bien
    } else {
        //sino
        echo mysqli_error($con);
    }
    desconectar($con);
}

function VerificarVotoG($usuario, $idgrupo) {
    $con = conectar("db4969761_proyecto");
    $query = "select * from voto_musico where idfan='$usuario' and idmusico = '$idgrupo'";
    $resultado = mysqli_query($con, $query);
    desconectar($con);
    //vemos si devuelve algo
    $num_rows = mysqli_num_rows($resultado);
    //si devuelve
    if ($num_rows == 0) {
        return false;
    } else {
        return true;
    }
}

function VotarG($usuario, $idgrupo) {
    $con = conectar("db4969761_proyecto");
    $query = "INSERT INTO voto_musico VALUES ('$usuario', '$idgrupo');";
    if (mysqli_query($con, $query)) {
        //si ha ido bien
    } else {
        //sino
        echo mysqli_error($con);
    }
    desconectar($con);
}

function BorrarVotoG($usuario, $idgrupo) {
    $con = conectar("db4969761_proyecto");
    $query = "delete from voto_musico where idfan='$usuario' and idmusico='$idgrupo'";
    if (mysqli_query($con, $query)) {
        //si ha ido bien
    } else {
        //sino
        echo mysqli_error($con);
    }
    desconectar($con);
}

function listMusicos2($posicion, $cantidad) {
    $con = conectar("db4969761_proyecto");
    $result = mysqli_query($con, "select idusuario, nombre_artistico, genero.nomestilo, componentes from usuario
inner join genero on genero.idgenero= usuario.genero
where perfil = 'm' limit $posicion, $cantidad;");
    desconectar($con);
    return $result;
}

function selectConciertoAbierto2($posicion, $cantidad) {
    $con = conectar("db4969761_proyecto");
    $select = "select concierto.idconcierto, concierto.nombre, concierto.dia, concierto.hora, genero.nomestilo ,concierto.pago from concierto 
        inner join genero on genero.idgenero= concierto.genero
        where concierto.estado='o'
        group by idconcierto
        limit $posicion, $cantidad;";
    $resultado = mysqli_query($con, $select);
    desconectar($con);
    return $resultado;
}