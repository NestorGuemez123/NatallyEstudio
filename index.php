<?php
    session_start();

    if(isset($_SESSION['empleadologeado'])){
        if($_SESSION['empleadologeado']['tipo_usuario'] == "admin"){
            header("Location: paneladministracion.php");
        }else if($_SESSION['empleadologeado']['tipo_usuario'] == "empleado"){
            header("Location: paneltrabajo.php");
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="node_modules/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="css/style.css">

	<title>Nattaly Estudio</title>
</head>
<body>
    <div id="error-login" class="text-center">
      El usuario o contraseña no son validos, intente otra vez
    </div>
	<div class="container">
		<div class="row row-login justify-content-md-center">
			<div class="col-md-5">
				<div class="card">
                    <h3 class="card-header bg-info text-white text-center">Ingreso</h3>
                    <div class="card-body">
                       	<form action="" id="formulariolg">
                       		<div class="form-group row">
                        		<label for="usuariolg" class="col-md-4 col-form-label">Usuario</label>
                        		<div class="col-md-8">
                            		<input type="email" class="form-control" id="usuariolg" name="usuariolg" placeholder="usuario@nataly.com" required>
                        		</div>
                        	</div>
                    		<div class="form-group row">
                        		<label for="contrasenialg" class="col-md-4 col-form-label">Contraseña</label>
                        		<div class="col-md-8">
                            		<input type="password" pattern="[A-Za-z0-9_-]{1-50}" class="form-control" id="contrasenialg" name="contrasenialg" placeholder="Contraseña" required>
                                    <small id="passwordHelp" class="form-text text-muted">Pedir el password al gerente si no se cuenta con él</small>
                        		</div>
                        	</div>
                        	<div class="form-group row justify-content-end">
                       			<div class="col-auto">
                            		<button id="boton-login" type="submit" class="btn btn-info">Ingresar</button>
                        		</div>
                    		</div>
                        </form>
                    </div>
                    </div>
                </div>
			</div>
		</div>	
	</div>
	
	<script src="node_modules/jquery/dist/jquery.min.js"></script>
    <script src="node_modules/popper.js/dist/umd/popper.min.js"></script>
    <script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>

</body>

</html>