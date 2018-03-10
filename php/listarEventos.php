<?php
	include ("conectar.php");

	$query = "SELECT UPPER(CONCAT(em.nombres,' ',em.apellidos)) AS empleado, UPPER(CONCAT(cli.nombres,' ',cli.apellidos)) AS cliente, cli.id_cliente, ev.id_evento, UPPER(ev.direccion) AS direccion, ev.fecha, ev.hora, ev.precio, ev.saldo, ev.id_paquete FROM Contrata c INNER JOIN Empleado em ON em.id_empleado=c.id_empleado INNER JOIN Cliente cli ON cli.id_cliente=c.id_cliente INNER JOIN Evento ev ON ev.id_evento=c.id_evento;";
	
	$resultado = mysqli_query($conexion, $query);

	if(!$resultado){
		die("Error");
	}else{
		while($data = mysqli_fetch_assoc($resultado)){
			$arreglo["data"][] = $data;
		}

		echo json_encode($arreglo);
	}

	mysqli_free_result($resultado);
	mysqli_close($conexion);
