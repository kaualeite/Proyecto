<?php

require_once 'bbdd.php';

function selectConciertoAbierto() {
    $con = conectar("db4969761_proyecto");
    $select = "select concierto.idconcierto, concierto.nombre, concierto.dia, concierto.hora, genero.nomestilo ,concierto.pago from concierto 
        inner join genero on genero.idgenero= concierto.genero
        where concierto.estado='o'
        group by idconcierto;";
    $resultado = mysqli_query($con, $select);
    desconectar($con);
    return $resultado;
}

function VerificarPropuesta($idconcierto, $idgrupo) {
    $con = conectar("db4969761_proyecto");
    $query = "select * from propuesta where idconcierto='$idconcierto' and idgrupo = '$idgrupo';";
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

function totalC(){
    $con = conectar("db4969761_proyecto");
    $select = "select count(*) as cont from concierto where estado='o';";
    $resultado = mysqli_query($con, $select);
    $fila = mysqli_fetch_array($resultado);
    extract($fila);
    desconectar($con);
    return $cont;
}

function SelectConcierto() {
    $con = conectar("db4969761_proyecto");
    $query = "select idconcierto, nombre from concierto where estado ='O'";
    $resultado = mysqli_query($con, $query);
    desconectar($con);
    return $resultado;
}

function listConciertosM($genero) {
    $con = conectar("db4969761_proyecto");
    $select = "SELECT * FROM concierto where genero = $genero";
    $resultado = mysqli_query($con, $select);
    desconectar($con);
    return $resultado;
}

function Genero($idusuario){
    $con = conectar("db4969761_proyecto");
    $select = "select genero from usuario where idusuario = '$idusuario';";
    $resultado = mysqli_query($con, $select);
    $fila=  mysqli_fetch_array($resultado);
    desconectar($con);
    extract($fila);
    return $genero;
}

function Apuntarse($nombre, $usuario) {
    $con = conectar("db4969761_proyecto");
    $insert = "INSERT INTO db4969761_proyecto.propuesta (idconcierto, idgrupo, aceptado) VALUES ($nombre, (select idusuario from usuario where nombre_usuario ='$usuario'), 'P');";
    if (mysqli_query($con, $insert)) {
        //si ha ido bien
        ?>
        <p>Te has apuntado al concierto</p>
        <?php

    } else {
        //sino
        echo mysqli_error($con);
    }
    desconectar($con);
}

function Desapuntarse($idconcierto, $idusuario){
    $con = conectar("db4969761_proyecto");
    $delete = "DELETE FROM db4969761_proyecto.propuesta WHERE idconcierto='$idconcierto' and idgrupo='$idusuario';";
    if (mysqli_query($con, $delete)) {
        //si ha ido bien
        ?>
        <p>Te has desapuntado</p>
        <?php

    } else {
        //sino
        echo mysqli_error($con);
    }
    desconectar($con);
}