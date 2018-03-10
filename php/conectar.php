<?php
	$host = "localhost";
	$usuario = "id3881562_root";
	$contrasenia = "casayork123";
	$bd = "id3881562_estudio";
	$conexion = new mysqli($host, $usuario, $contrasenia, $bd);
    
    if($conexion->connect_errno) {
        echo "Fallo al conectar a MariaDB: (" . $conexion->connect_errno . ") " . $conexion->connect_error;
    }

?>