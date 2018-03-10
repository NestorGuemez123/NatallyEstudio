<?php
	include ("conectar.php");

	$query = "SELECT UPPER(CONCAT(em.nombres,' ',em.apellidos)) AS empleado, UPPER(CONCAT(cli.nombres,' ',cli.apellidos)) AS cliente, cli.id_cliente, v.id_venta, v.fecha_solicitud, v.fecha_entrega, v.id_servicio AS servicio FROM Realiza r INNER JOIN Empleado em ON em.id_empleado=r.id_empleado INNER JOIN Cliente cli ON cli.id_cliente=r.id_cliente INNER JOIN Venta v ON v.id_venta=r.id_venta;";
	
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
