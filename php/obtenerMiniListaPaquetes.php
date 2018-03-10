<?php
	include ("conectar.php");

	$query = "SELECT id_paquete, UPPER(descripcion) as nombre, precio FROM Paquete;";
	
	$resultado = mysqli_query($conexion, $query);

	if(!$resultado){
		die("Error");
	}else{
		while($data = mysqli_fetch_assoc($resultado)){
			$arreglo[] = $data;
		}

		echo json_encode($arreglo);
	}

	mysqli_free_result($resultado);
	mysqli_close($conexion);