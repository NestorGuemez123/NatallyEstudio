<?php
	include ("conectar.php");

	$id_evento = $_POST["id_evento"];
	$query = "SELECT id_servicio FROM Evento_Servicio WHERE id_Evento=$id_evento;";
	
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
