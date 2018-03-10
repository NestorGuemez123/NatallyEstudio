<?php 
	include("conectar.php");
	
	$id_empleado = $_POST["id-emp"];
	$nombres = $_POST["nombre-emp"];
	$apellidos = $_POST["apellido-emp"];
	$telefono = $_POST["cel-emp"];
	$usuarioEmp = $_POST["usuario-emp"];
	$contraseniaEmp = $_POST["contrasenia-emp"];
	$tipoEmp = $_POST["tipo-emp"]; 
	$opcion = $_POST["opcion"];
	$informacion = [];

	switch ($opcion) {
		case 'nuevo':
			agregar($nombres, $apellidos, $telefono, $usuarioEmp, $contraseniaEmp, $tipoEmp, $conexion);
			break;
		case 'modificar':
			modificar($nombres, $apellidos, $telefono, $usuarioEmp, $contraseniaEmp, $tipoEmp, $id_empleado, $conexion);
			break;
		case 'remover':
			eliminar($id_empleado, $conexion);
			break;
	}	
	
	function agregar($nombres, $apellidos, $telefono, $usuarioEmp, $contraseniaEmp, $tipoEmp, $conexion){
		$query = "INSERT INTO Empleado(id_empleado, nombres, apellidos, telefono, usuario, contrasenia, tipo_usuario, estatus) VALUES (NULL, '$nombres', '$apellidos', '$telefono', '$usuarioEmp', '$contraseniaEmp', '$tipoEmp', TRUE);";
		$resultado=mysqli_query($conexion, $query);
		verificar_resultado($resultado);
		cerrar($conexion);
	}

	function modificar($nombres, $apellidos, $telefono, $usuarioEmp, $contraseniaEmp, $tipoEmp, $id_empleado, $conexion){
		$query = "UPDATE Empleado SET nombres='$nombres', apellidos='$apellidos', telefono='$telefono', usuario='$usuarioEmp', contrasenia='$contraseniaEmp', tipo_usuario='$tipoEmp' WHERE id_empleado=$id_empleado";
		$resultado=mysqli_query($conexion, $query);
		verificar_resultado($resultado);
		cerrar($conexion);
	}

	function eliminar($id_empleado, $conexion){
		$query = "DELETE FROM Empleado WHERE id_empleado=$id_empleado";
		$query = "UPDATE Empleado SET estatus=FALSE WHERE id_cliente=$id_cliente";
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