<?php 
	include ("conectar.php");
	session_start();

	$user = $_POST["usuariolg"];
	$password = $_POST["contrasenialg"];
	$query2 = "SELECT id_empleado, nombres, apellidos, tipo_usuario FROM Empleado WHERE usuario='$user' AND contrasenia='$password'";
	
	$resultado = mysqli_query($conexion, $query2);

	if($resultado->num_rows == 1){
		$datos = mysqli_fetch_assoc($resultado);
		$_SESSION['empleadologeado'] = $datos;

		echo json_encode(array('error' => false, 'tipo' => $datos["tipo_usuario"]));
	}else{
		echo json_encode(array('error' => true));
		
	}	
	mysqli_close($conexion);

?>