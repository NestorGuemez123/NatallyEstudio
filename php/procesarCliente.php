<?php 
	include("conectar.php");
	
	$id_cliente = $_POST["id-cli"];
	$nombres = $_POST["nombre-cli"];
	$apellidos = $_POST["apellido-cli"];
	$telefono = $_POST["cel-cli"];
	$opcion = $_POST["opcion"];
	$informacion = [];

	switch ($opcion) {
		case 'nuevo':
			agregar($nombres, $apellidos, $telefono, $conexion);
			break;
		case 'modificar':
			modificar($nombres, $apellidos, $telefono, $id_cliente, $conexion);
			break;
		case 'remover':
			eliminar($id_cliente, $conexion);
			break;
	}	
	
	function agregar($nombres, $apellidos, $telefono, $conexion){
		$query = "INSERT INTO Cliente(id_cliente, nombres, apellidos, telefono, estatus) VALUES (NULL, '$nombres', '$apellidos', '$telefono', TRUE)";
		$resultado=mysqli_query($conexion, $query);
		verificar_resultado($resultado);
		cerrar($conexion);
	}

	function modificar($nombres, $apellidos, $telefono, $id_cliente, $conexion){
		$query = "UPDATE Cliente SET nombres='$nombres', apellidos='$apellidos', telefono='$telefono' WHERE id_cliente=$id_cliente";
		$resultado=mysqli_query($conexion, $query);
		verificar_resultado($resultado);
		cerrar($conexion);
	}

	function eliminar($id_cliente, $conexion){
		$query = "UPDATE Cliente SET estatus=FALSE WHERE id_cliente=$id_cliente";
		$resultado=mysqli_query($conexion, $query);
		verificar_resultado($resultado);
		cerrar($conexion);
	}

	function verificar_resultado($resultado){
		if(!$resultado){
			$informacion["respuesta"] = "Hubo un error al realizar la peticion";	
		}else{
			$informacion["respuesta"] = "La peticion se ejecuto correctamente";	
		} 
		echo json_encode($informacion);
	}

	function cerrar($conexion){
		mysqli_close($conexion);
	}
?>