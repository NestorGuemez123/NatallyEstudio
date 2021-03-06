<?php
    session_start();

    if(isset($_SESSION['empleadologeado'])){
        if($_SESSION['empleadologeado']['tipo_usuario'] != "empleado"){
            header("Location: paneladministracion.php");
        }
    }else{
    	header("Location: index.php");
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <!-- Librerias css necesarias -->
	<link rel="stylesheet" href="css/dependencies/bootstrap.min.css">
	<link rel="stylesheet" href="css/dependencies/font-awesome.min.css">
	<link rel="stylesheet" href="css/dependencies/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" href="css/dependencies/dataTables.fontAwesome.css">
	<link rel="stylesheet" href="css/dependencies/bootstrap-datepicker.standalone.min.css">
	<link rel="stylesheet" href="css/dependencies/select2.min.css">

	<!-- Css para estructura del sitio --> 
	<link rel="stylesheet" href="css/style.css">

	<title>Panel de trabajo</title>
	
	
</head>
<body>
	<!--
	Clientes: 
	Mostrar a los clientes
	Dar de baja a los clientes
	Modificar a los clientes

	Empleados:
	Dar de baja a los empleados
	Modificar a los empleados
	-->


	<!-- Modal para el registro/modificacion/remocion de un cliente-->
	<div id="ClienteModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg" role="content">
        
        <!-- Contenido-->
        <div class="modal-content">
        	<!-- Titulo variable dependiendo de para que accion se use-->
            <div class="modal-header">
                <h4 class="modal-title">Registro de cliente</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Fin del titulo variable-->

            <form id="formularioCliente">
                <div class="modal-body">
                	<!-- Campos ocultos del ID y la OPCION a relizar-->
                	<input type="hidden" class="form-control" id="id-cli" name="id-cli" value="">
                	<input type="hidden" class="form-control" id="opcion" name="opcion" value="">


                	<!-- Campos para las opciones de NUEVO y MODIFICAR -->
		  			<div id="contenedorModificarAgregarCli" class="form-row">
		  				<div class="form-group col-4">
		  					<label for="nombre-cli" class="col-form-label">Nombre(s)</label>
		  					<input type="text" class="form-control" id="nombre-cli" name="nombre-cli" placeholder="Nombres" required autofocus>
		  				</div>
		  				<div class="form-group col-4">
		  					<label for="apellido-cli" class="col-form-label">Apellido(s)</label>
		  					<input type="text" class="form-control" id="apellido-cli" name="apellido-cli" placeholder="Apellidos" required>
		  				</div>
		  				<div class="form-group col-4">
		  					<label for="cel-cli" class="col-form-label">Celular</label>
		  					<input type="tel" class="form-control" id="cel-cli" name="cel-cli" placeholder="Celular" required>
		  				</div>
		  			</div>

		  			<!-- Campos para las opciones de REMOVER -->
		  			<div id="contenedorRemoverCli" class="form-row">
		  				<label class="col-form-label">¿Esta seguro de querer remover al cliente?</label>
		  			</div>

            	</div>
            	<div class="modal-footer">
	            	<div class="form-group row justify-content-end">
	           			<div class="col-auto">
	      
	           				<button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cancelar</button>
	                		
	                		<!-- Boton que se adapta dependiendo de la accion a realizar-->
	                		<button type="submit" class="submit btn btn-info btn-sm">Registrar/Guardar/Remover</button>
	                	</div>
	        		</div>
            	</div>
            </form>
            
        </div>
        <!-- Final del contenido-->

        </div>
    </div>

    <!-- Modal para el registro/modificacion/remocion de un nuevo evento-->
	<div id="EventoModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg" role="content">
        <!-- Modal content-->
        <div class="modal-content">
        	<!-- Titulo variable dependiendo de para que accion se use-->
            <div class="modal-header">
                <h4 class="modal-title">Registro de evento</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
			<!-- Fin del titulo variable -->            
                
                <form id="formularioEvento">
	                <div class="modal-body">
		                <!-- Campos ocultos del ID y la OPCION a relizar-->
	                	<input type="hidden" class="form-control" id="id-evento" name="id-evento" value="" required>
	                	<input type="hidden" class="form-control" id="opcion" name="opcion" value="" required>
			  			
			  			<!-- Campos para las opciones de NUEVO y MODIFICAR -->
			  			<div id="contenedorModificarAgregarEvento" class="form-row">
			  				<div class="form-group col-md-6">
			  					<label for="nombre-cli-evento" class="col-form-label">Cliente</label>
			  					<select id="nombre-cli-evento" class="form-control" name="nombre-cli-evento" required>
							    </select>			  				
							</div>
			  				<div class="form-group col-md-6">
			  					<label for="direccion-evento" class="col-form-label">Direccion</label>
			  					<input type="text" class="form-control" id="direccion-evento" name="direccion-evento" required>
			  				</div>
			  				<div class="form-group col-md-3">
			  					<label for="fecha-evento" class="col-form-label">Fecha</label>
			  					<div class="input-group date selector-fecha" data-provide="datepicker">
								    <input type="text" class=" form-control" id="fecha-evento" name="fecha-evento" placeholder="YYYY-MM-DD" required>
								    <div class="input-group-addon">
								        <i class="fa fa-calendar fa-lg" aria-hidden="true"></i>
								    </div>
								</div>
			  				</div>
			  				<div class="form-group col-md-3">
			  					<label for="hora-evento" class="col-form-label">Hora</label>
			  					<div class="input-group">
								    <input type="text" class="form-control" id="hora-evento" name="hora-evento" placeholder="HH:MM:SS" required>
								    <div class="input-group-addon">
								        <i class="fa fa-clock-o fa-lg" aria-hidden="true"></i>
								    </div>
								</div>
			  				</div>
			  				<div class="form-group col-md-6">
			  					<label for="paquete-evento" class="col-form-label">Paquete</label>
			  					<select id="paquete-evento" name="paquete-evento" class="form-control" style="width: 100%">
			  					</select>
			  				</div>
			  				<div class="form-group col-md-12">
			  					<label for="servicios-evento" class="col-form-label">Servicios</label>
			  					<select id="servicios-evento" name="servicios-evento[]" class="form-control" multiple style="width: 100%">
			  					</select>
			  				</div>
			  				<div class="form-group col-md-3">
			  					<label for="precio-evento" class="col-form-label">Costo total: </label>
			  					<input type="text" class="form-control" id="precio-evento" name="precio-evento">
			  				</div>
			  				<div id="grupo-saldo-evento" class="form-group col-md-3">
			  					<label for="saldo-evento" class="col-form-label">Saldo: </label>
			  					<input type="text" readonly class="form-control-plaintext text-danger" id="saldo-evento" name="saldo-evento" placeholder="0">
			  				</div>
			  				<div id="grupo-empleado-evento" class="form-group col-md-5">
			  					<label for="empleado-evento" class="col-form-label">Empleado en turno</label>
			  					<input type="text" class="form-control" id="empleado-evento" name="empleado-evento" readonly>
			  				</div>
			  				<div id="grupo-anticipo-evento" class="form-group col-md-5">
			  					<label for="anticipo-evento" class="col-form-label">Anticipo</label>
			  					<input type="number" class="form-control" id="anticipo-evento" name="anticipo-evento" value="0" required>
			  				</div>
			  			</div>

			  			<!-- Campos para las opciones de REMOVER -->
			  			<div id="contenedorRemoverEvento" class="form-row">
			  				<label class="col-form-label">¿Esta seguro de querer remover el evento?</label>
			  			</div>
		  			</div>

		  			<div class="modal-footer">
		            	<div class="form-group row justify-content-end">
		           			<div class="col-auto">
		           				<button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cancelar</button>
		                		
		                		<!-- Boton que se adapta dependiendo de la accion a realizar-->
	                			<button type="submit" class="submit btn btn-info btn-sm">Registrar/Guardar/Remover</button>
		            		</div>
		        		</div>
	            	</div>
            	</form>
            
        </div>
        </div>
    </div>

    <!-- Modal para el registro/modificacion/remocion de un nueva venta -->
	<div id="VentaModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg" role="content">
        <!-- Modal content-->
        <div class="modal-content">
        	<!-- Titulo variable dependiendo de para que accion se use-->
            <div class="modal-header">
                <h4 class="modal-title">Registro de venta</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
			<!-- Fin del titulo variable -->            
                
                <form id="formulario">
	                <div class="modal-body">
		                <!-- Campos ocultos del ID y la OPCION a relizar-->
	                	<input type="hidden" class="form-control" id="id-venta" name="id-venta" value="" required>
	                	<input type="hidden" class="form-control" id="opcion" name="opcion" value="" required>
			  			
			  			<!-- Campos para las opciones de NUEVO y MODIFICAR -->
			  			<div id="contenedorModificarAgregarVenta" class="form-row">
			  				<div class="form-group col-md-6">
			  					<label for="nombre-cli-venta" class="col-form-label">Cliente</label>
			  					<select id="nombre-cli-venta" class="form-control" name="nombre-cli-venta" required>
							    </select>			  				
							</div>
			  				<div class="form-group col-md-3">
			  					<label for="fecha-sol-venta" class="col-form-label">Fecha de solicitud</label>
			  					<div class="input-group date selector-fecha" data-provide="datepicker">
								    <input type="text" class=" form-control" id="fecha-sol-venta" name="fecha-sol-venta" placeholder="YYYY-MM-DD" required>
								    <div class="input-group-addon">
								        <i class="fa fa-calendar fa-lg" aria-hidden="true"></i>
								    </div>
								</div>
			  				</div>
			  				<div class="form-group col-md-3">
			  					<label for="fecha-sal-venta" class="col-form-label">Fecha de entrega</label>
			  					<div class="input-group date selector-fecha" data-provide="datepicker">
								    <input type="text" class=" form-control" id="fecha-sal-venta" name="fecha-sal-venta" placeholder="YYYY-MM-DD">
								    <div class="input-group-addon">
								        <i class="fa fa-calendar fa-lg" aria-hidden="true"></i>
								    </div>
								</div>
			  				</div>
			  				
			  				<div class="form-group col-md-6">
			  					<label for="servicio-venta" class="col-form-label">Servicio</label>
			  					<select id="servicio-venta" name="servicio-venta" class="form-control" style="width: 100%">
			  					</select>
			  				</div>
			  				<div class="form-group col-md-3" style="display: none">
			  					<label for="precio-venta" class="col-form-label">Costo total: </label>
			  					<input type="text" class="form-control" id="precio-venta" name="precio-venta">
			  				</div>
			  			</div>

			  			<!-- Campos para las opciones de REMOVER -->
			  			<div id="contenedorRemoverVenta" class="form-row">
			  				<label class="col-form-label">¿Esta seguro de querer remover la venta?</label>
			  			</div>
		  			</div>

		  			<div class="modal-footer">
		            	<div class="form-group row justify-content-end">
		           			<div class="col-auto">
		           				<button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cancelar</button>
		                		
		                		<!-- Boton que se adapta dependiendo de la accion a realizar-->
	                			<button type="submit" class="submit btn btn-info btn-sm">Registrar/Guardar/Remover</button>
		            		</div>
		        		</div>
	            	</div>
            	</form>
            
        </div>
        </div>
    </div>
    <nav class="navbar fixed-top navbar-dark bg-dark">
	 	<div class="col-auto">
			<h4 class="navbar-brand">Bienvenido <?php echo "".$_SESSION["empleadologeado"]["nombres"]." ".$_SESSION["empleadologeado"]["apellidos"]."" ?></h4>
		</div>
		<div class="col-auto">
			<a class="btn btn-danger btn-sm" href="php/salir.php">Cerrar sesion</a>	
		</div>
	</nav>


	<div class="container-fluid">		
		<div class="row">
                    <div class="col">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                          <li class="nav-item">
                            <a class="nav-link active" id="clientes-tab" data-toggle="tab" href="#clientes" role="tab" aria-controls="clientes" aria-selected="true">Clientes</a>
                          </li>
                         
                          <li class="nav-item">
                            <a class="nav-link" id="eventos-ventas-ingresos-tab" data-toggle="tab" href="#eventos-ventas-ingresos" role="tab" aria-controls="eventos-ventas-ingresos" aria-selected="false">Eventos y Ventas</a>
                          </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                          
                          <!-- Tab de clientes-->
                          <div class="tab-pane fade show active" id="clientes" role="tabpanel" aria-labelledby="clientes-tab">
                            <div class="row justify-content-end">
						  		<div class="col-auto btn-agregar">		
									<a id="linkCliente" class="btn btn-info">Agregar nuevo cliente</a>	  			
						  		</div>
						  	</div>
						  	<div class="row row-content">
						  		<div class="col panel-info">
						  			<!-- Contenido -->
										<table id="tabla-clientes" class="table table-hover table-sm" cellspacing="0" width="100%">
										  <thead class="thead-dark">
										    <tr>
										      <th scope="col">Nombres</th>
										      <th scope="col">Apellidos</th>
										      <th scope="col">Telefono</th>
										      <th scope="col">Opciones</th>
										    </tr>
										  </thead>
										</table>
						  			<!-- Fin de contenido -->
						  		</div>
						  	</div>
                          </div>

                          <!-- Tab de Eventos/Ventas/Ingresos -->
                          <div class="tab-pane fade" id="eventos-ventas-ingresos" role="tabpanel" aria-labelledby="eventos-ventas-ingresos-tab">
						  	<div class="row justify-content-end">
						  		<div class="col-auto btn-agregar">		
									<a id="linkEvento" class="btn btn-info">Agregar nuevo evento</a>	  			
						  		</div>
						  		<!--<div class="col-auto btn-agregar">		
									<a id="linkVenta" class="btn btn-info">Agregar nueva venta</a>	  			
						  		</div>-->
						  	</div>
						  	<div class="row row-content">
						  		<div class="col-12 panel-info">
						  			<!-- Contenido -->
										<table id="tabla-eventos" class="table table-sm table-hover table-sm" cellspacing="0" width="100%">
										  <thead class="thead-dark">
										    <tr>
										      <th scope="col">Fecha</th>
										      <th scope="col">Cliente</th>
										      <th scope="col">Empleado</th>
										      <th scope="col">Direccion</th>
										      <th scope="col">Costo</th>
										      <th scope="col">Saldo</th>								   
										      <th scope="col">Opciones</th>
										    </tr>
										  </thead>
										</table>
						  			<!-- Fin de contenido -->
						  		</div>
						  	</div>
						  	<div class="row justify-content-end">
						  		
						  		<div class="col-auto btn-agregar">		
									<a id="linkVenta" class="btn btn-info">Agregar nueva venta</a>	  			
						  		</div>
						  	</div>
						  	<div class="row row-content">
						  		<div class="col-12 panel-info">
						  			
										<table id="tabla-ventas" class="table table-sm table-hover table-sm" cellspacing="0" width="100%">
										  <thead class="thead-dark">
										    <tr>
										      <th scope="col">Cliente</th>
										      <th scope="col">Empleado</th>
										      <th scope="col">Servicio</th>
										      <th scope="col">Fecha de solicitud</th>
										      <th scope="col">Fecha de entrega</th>
										      <th scope="col">Costo</th>
										      <th scope="col">Opciones</th>				   
										    </tr>
										  </thead>
										</table>
						  			
						  		</div>
						  	</div>
                          </div>

                        </div>         
                    </div>
               </div>
	</div>
	<!-- Librerias js necesarias -->
	<script src="js/dependencies/jquery.min.js"></script>
	<script src="js/dependencies/popper.min.js"></script>
	<script src="js/dependencies/bootstrap.min.js"></script>
	<script src="js/dependencies/jquery.dataTables.min.js"></script>
	<script src="js/dependencies/dataTables.bootstrap4.min.js"></script>
	<script src="js/dependencies/bootstrap-datepicker.min.js"></script>
	<script src="js/dependencies/bootstrap-datepicker.es.min.js"></script>
	<script src="js/dependencies/select2.min.js"></script>

	<!-- Js para funcionamiento del sitio -->
	<script src="js/scripts.js"></script>
</body>

</html>