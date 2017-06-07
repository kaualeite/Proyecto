<?php

require_once 'bbdd.php';

//Asignamos un grupo a un concierto
function asignamos_grupo_a_concierto($idgrup, $idconcert) {
    //En la tabla propuestas con el campo aceptado=A (Aceptado)
    $con = conectar("db4969761_proyecto");
    $query = "UPDATE propuesta SET aceptado='A' where idconcierto=$idconcert and idgrupo=$idgrup";
    $resultado = mysqli_query($con, $query);

    //Indicamos que el concierto ya esta cerrado (es decir, ya tiene asignado un grupo) mediante el campo estado=C (Cerrado)
    $query = "UPDATE concierto SET estado='C' where idconcierto=$idconcert";
    $resultado = mysqli_query($con, $query);
    desconectar($con);
}

//Ponemos en pendiente un grupo en un concierto en la tabla propuestas con el campo aceptado=P
function quitamos_grupo_de_concierto($idgrup, $idconcert) {
    //En la tabla propuestas con el campo aceptado=P (Pendiente)
    $con = conectar("db4969761_proyecto");
    $query = "UPDATE propuesta SET aceptado='P' where idconcierto=$idconcert and idgrupo=$idgrup";
    $resultado = mysqli_query($con, $query);

    //Indicamos que el concierto vuelve ha estar abierto (es decir, se puede volver asignar un grupo) mediante el campo estado=A (abierto)
    $query = "UPDATE concierto SET estado='O' where idconcierto=$idconcert";
    $resultado = mysqli_query($con, $query);
    desconectar($con);
}

function listamos_conciertos_con_grupo_asignado($idlocal) {
    $con = conectar("db4969761_proyecto");
    $query = "SELECT
		concierto.idlocal,concierto.nombre,concierto.dia,concierto.hora,genero.nomestilo,concierto.estado,
		concierto.pago,usuario.nombre_artistico,usuario.idusuario,grupmusical.nombre_artistico as gmusical,
		concierto.idconcierto,propuesta.aceptado, grupmusical.idusuario as idgmusical
		FROM concierto
		INNER JOIN usuario ON usuario.idusuario = concierto.idlocal
		INNER JOIN genero ON concierto.genero = genero.idgenero
		INNER JOIN propuesta ON propuesta.idconcierto = concierto.idconcierto
		INNER JOIN usuario as grupmusical ON  propuesta.idgrupo = grupmusical.idusuario
		WHERE concierto.estado = 'C' and concierto.idlocal=$idlocal and propuesta.aceptado='A'
		ORDER by dia asc";

    $resultado = mysqli_query($con, $query);
    $numero_filas = mysqli_num_rows($resultado);

    if (!$numero_filas == 0) {

        echo "<h2>Concerts amb grup musical assignat</h2>";
        echo "<table style='width:100%;'>";
        echo "<tr style='background-color:#eaeaea;'><td style='width:10%;'>ID concert</td><td style='width:20%;'>Nom del concert</td><td style='width:10%;'>Gènere</td><td style='width:10%;'>Dia</td><td style='width:10%;'>Hora</td><td style='width:20%;'>Grup Musical</td><td style='width:20%;'>Baixa Grup</td></tr>";

        while ($fila = mysqli_fetch_array($resultado, MYSQLI_ASSOC)) {
            echo"<tr>";
            echo "<td>" . $fila["idconcierto"] . "</td><td>" . $fila["nombre"] . "</td><td>" . $fila["nomestilo"] . "</td><td>" . $fila["dia"] . "</td><td>" . $fila["hora"] . "</td><td>" . $fila["gmusical"] . "</td><td><a href='?ida=listca&idcona=" . $fila["idconcierto"] . "&idgrupp=" . $fila["idgmusical"] . "'>Donar de baixa Grup</a></td>";
            echo"</tr>";
        }
        echo "</table>";
    }
    desconectar($con);
}

function listamos_conciertos_pendientes_de_grupo($idlocal) {
    $con = conectar("db4969761_proyecto");
    $query = "SELECT
		concierto.idconcierto,concierto.idlocal,usuario.nombre_artistico,concierto.nombre,genero.nomestilo,
		concierto.estado,concierto.dia,concierto.hora,concierto.pago,concierto.genero,
		Count(*) AS ninscritos
		FROM concierto
		INNER JOIN propuesta ON propuesta.idconcierto = concierto.idconcierto
		INNER JOIN genero ON concierto.genero = genero.idgenero
		INNER JOIN usuario ON concierto.idlocal = usuario.idusuario
		WHERE estado='O' and idlocal=$idlocal
		GROUP BY nombre
		ORDER by dia asc";

    $resultado = mysqli_query($con, $query);
    $numero_filas = mysqli_num_rows($resultado);
    if (!$numero_filas == 0) {
        echo "<h2>Concerts pendents d'assignar (amb total d'inscrits)</h2>";
        echo "<table style='width:100%;'>";
        echo "<tr style='background-color:#eaeaea;'><td style='width:10%;'>ID concert</td><td style='width:20%;'>Nom del concert</td><td style='width:20%;'>Gènere</td><td style='width:20%;'>Dia</td><td style='width:20%;'>Hora</td><td style='width:10%;'>Inscrits</td></tr>";

        while ($fila = mysqli_fetch_array($resultado, MYSQLI_ASSOC)) {
            echo"<tr>";
            echo "<td>" . $fila["idconcierto"] . "</td><td>" . $fila["nombre"] . "</td><td>" . $fila["nomestilo"] . "</td><td>" . $fila["dia"] . "</td><td>" . $fila["hora"] . "</td><td><a href='?ida=listgcpa&idl=" . $fila["idlocal"] . "&idconp=" . $fila["idconcierto"] . "'>" . $fila["ninscritos"] . "</a></td>";
            echo"</tr>";
        }
        echo "</table>";
    }
    desconectar($con);
}

function listamos_grupos_inscritos_en_concierto($idlocal, $idconcert) {
    $con = conectar("db4969761_proyecto");
    $query = "SELECT
		usuario.idusuario,concierto.idlocal, concierto.nombre as Nombre_Concierto, concierto.estado, 
		concierto.dia,concierto.hora,concierto.idconcierto, usuario.nombre_artistico as Grupo_Musical,
		usuario.genero,usuario.componentes,genero.nomestilo 
		FROM concierto
		INNER JOIN propuesta ON propuesta.idconcierto = concierto.idconcierto
		INNER JOIN usuario ON propuesta.idgrupo = usuario.idusuario
		INNER JOIN genero ON  usuario.genero = genero.idgenero
		WHERE estado='O' and $idlocal and concierto.idconcierto=$idconcert
		ORDER by dia asc";
    $resultado = mysqli_query($con, $query);

    echo "<h2>Llistat d'inscrits al concert: $idconcert </h2>";

    echo "<table style='width:100%;'>";
    echo "<tr style='background-color:#eaeaea;'><td style='width:40%;'>Nom del grup</td><td style='width:20%;'>Gènere</td><td style='width:20%;'>Nº de membres grup </td><td style='width:20%;'>Assignar</td></tr>";

    while ($fila = mysqli_fetch_array($resultado, MYSQLI_ASSOC)) {
        echo"<tr>";
        echo "<td>" . $fila["Grupo_Musical"] . "</td><td>" . $fila["nomestilo"] . "</td><td>" . $fila["componentes"] . "</td><td><a href='?ida=listgcp&idconp=$idconcert&idgrupa=" . $fila["idusuario"] . "'>Assignar Grup</a></td>";
        echo"</tr>";
    }
    echo "</table>";
    desconectar($con);
}