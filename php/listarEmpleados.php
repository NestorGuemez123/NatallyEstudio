<?php
	include ("conectar.php");

	$query = "SELECT id_empleado, UPPER(nombres) as nombres, UPPER(apellidos) as apellidos, telefono, usuario, contrasenia, tipo_usuario FROM Empleado;";
	
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
