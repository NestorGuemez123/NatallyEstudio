<?php 
	include("conectar.php");
	
	$id_paquete = $_POST["id-paquete"];
	$nombre = $_POST["nombre-paquete"];
	$precio = $_POST["precio-paquete"];
	$opcion = $_POST["opcion"];
	$informacion = [];

	switch ($opcion) {
		case 'nuevo':
			agregar($nombre, $precio, $conexion);
			break;
		case 'modificar':
			modificar($nombre, $precio, $id_paquete, $conexion);
			break;
		case 'remover':
			eliminar($id_paquete, $conexion);
			break;
	}	
	
	function agregar($nombre, $precio, $conexion){
		$query = "INSERT INTO Paquete(id_paquete, descripcion, precio) VALUES (NULL, '$nombre', '$precio')";
		$resultado=mysqli_query($conexion, $query);
		verificar_resultado($resultado);
		cerrar($conexion);
	}

	function modificar($nombre, $precio, $id_paquete, $conexion){
		$query = "UPDATE Paquete SET descripcion='$nombre', precio='$precio' WHERE id_paquete=$id_paquete";
		$resultado=mysqli_query($conexion, $query);
		verificar_resultado($resultado);
		cerrar($conexion);
	}

	function eliminar($id_paquete, $conexion){
		$query = "DELETE FROM Paquete WHERE id_paquete=$id_paquete";
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