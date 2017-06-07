<?php

require_once 'bbdd.php';

function selectGenero() {
    $con = conectar("db4969761_proyecto");
    $select = "select idgenero, nomestilo from genero;";
    $resultado = mysqli_query($con, $select);
    desconectar($con);
    return $resultado;
}

function listMusicos() {
    $con = conectar("db4969761_proyecto");
    $result = mysqli_query($con, "select idusuario, nombre_artistico, genero.nomestilo, componentes from usuario
inner join genero on genero.idgenero= usuario.genero
where perfil = 'm';");
    desconectar($con);
    return $result;
}

function totalM(){
    $con = conectar("db4969761_proyecto");
    $select = "select count(*) as cont from usuario where perfil = 'm';";
    $resultado = mysqli_query($con, $select);
    $fila = mysqli_fetch_array($resultado);
    extract($fila);
    desconectar($con);
    return $cont;
}

function insertConcierto($nombre, $estado, $dia, $hora, $pago, $usuario, $genero) {
    $con = conectar("db4969761_proyecto");
    $insert = "Insert into concierto(idconcierto, nombre, estado, dia, hora, pago, idlocal, genero) 
             values(null, '$nombre', '$estado', '$dia', '$hora', $pago, (select idusuario from usuario where nombre_usuario ='$usuario'), '$genero')";
    if (mysqli_query($con, $insert)) {
        //si ha ido bien
        echo "Concierto dado de alta";
    } else {
        //sino
        echo mysqli_error($con);
    }
    desconectar($con);
}

function selectConciertoA($usuario) {
    $con = conectar("db4969761_proyecto");
    $select = "select concierto.nombre, concierto.dia, concierto.hora, concierto.pago, genero.nomestilo, count(*) as inscritos
from concierto
inner join usuario on concierto.idlocal=usuario.idusuario
inner join genero on concierto.genero=genero.idgenero
inner join propuesta on concierto.idconcierto=propuesta.idconcierto
where estado = 'O' and concierto.idlocal= (select idusuario from usuario where nombre_usuario ='$usuario')
group by propuesta.idconcierto
order by concierto.nombre";
    $resultado = mysqli_query($con, $select);
    desconectar($con);
    return $resultado;
}
