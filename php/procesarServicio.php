<?php 
	include("conectar.php");
	
	$id_servicio = $_POST["id-servicio"];
	$nombre = $_POST["nombre-servicio"];
	$precio = $_POST["precio-servicio"];
	$opcion = $_POST["opcion"];
	$informacion = [];

	switch ($opcion) {
		case 'nuevo':
			agregar($nombre, $precio, $conexion);
			break;
		case 'modificar':
			modificar($nombre, $precio, $id_servicio, $conexion);
			break;
		case 'remover':
			eliminar($id_servicio, $conexion);
			break;
	}	
	
	function agregar($nombre, $precio, $conexion){
		$query = "INSERT INTO Servicio(id_servicio, descripcion, precio) VALUES (NULL, '$nombre', '$precio')";
		$resultado=mysqli_query($conexion, $query);
		verificar_resultado($resultado);
		cerrar($conexion);
	}

	function modificar($nombre, $precio, $id_servicio, $conexion){
		$query = "UPDATE Servicio SET descripcion='$nombre', precio='$precio' WHERE id_servicio=$id_servicio";
		$resultado=mysqli_query($conexion, $query);
		verificar_resultado($resultado);
		cerrar($conexion);
	}

	function eliminar($id_servicio, $conexion){
		$query = "DELETE FROM Servicio WHERE id_servicio=$id_servicio";
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