<?php 
	include("conectar.php");
	session_start();

	$id_evento = $_POST["id-evento"];
	$id_cliente = $_POST["nombre-cli-evento"];
	$id_empleado = $_SESSION["empleadologeado"]["id_empleado"];
	$direccion = $_POST["direccion-evento"];
	$fecha = $_POST["fecha-evento"];
	$hora = $_POST["hora-evento"];
	$id_paquete = $_POST["paquete-evento"];
	$ids_servicios = $_POST["servicios-evento"];
	$precio = $_POST["precio-evento"];
	$saldo = $_POST["saldo-evento"];
	$anticipo = $_POST["anticipo-evento"];
	$opcion = $_POST["opcion"];
	$informacion = [];

	switch ($opcion) {
		case 'nuevo':
			agregar($id_cliente, $id_empleado, $direccion, $fecha, $hora, $id_paquete, $ids_servicios, $precio, $anticipo, $conexion);
			break;
		case 'modificar':
			modificar($id_evento, $fecha, $hora, $direccion, $precio, $saldo, $ids_servicios, $conexion);
			break;
		case 'remover':
			eliminar($id_evento, $conexion);
			break;
	}	
	
	function agregar($id_cliente, $id_empleado, $direccion, $fecha, $hora, $id_paquete, $ids_servicios, $precio, $anticipo, $conexion){

		//Ingresa los datos en las tablas Evento y Contrata
		$query = "CALL NuevoEvento($id_empleado, $id_cliente, '$fecha', '$hora', '$direccion', $precio, $anticipo, $id_paquete);";
		$resultado=mysqli_query($conexion, $query);
	
		verificar_resultado($resultado);
		cerrar($conexion);
	}

	function modificar($id_evento, $fecha, $hora, $direccion, $precio, $saldo, $ids_servicios){
		$query = "CALL ActualizarEvento($id_evento, $fecha, $hora, $direccion, $precio, $saldo);";
		$resultado=mysqli_query($conexion, $query);

		if(count($ids_servicios) > 0){
			for($i = 0; $i < count($ids_servicios); $i++){
				$query = "INSERT INTO Evento_Servicio(id_evento, id_servicio) VALUES((SELECT MAX(id_evento) FROM Evento), $ids_servicios[$i])";
				$resultado = mysqli_query($conexion, $query);
			}
		}

		verificar_resultado($resultado);
		cerrar($conexion);
	}

	function eliminar($id_evento, $conexion){
		$query = "CALL EliminarEvento($id_evento);";
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