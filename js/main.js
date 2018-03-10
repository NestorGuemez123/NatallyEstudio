$(document).on("submit", "#formulariolg", function(evento){
	evento.preventDefault();

	$.ajax({
		url: "../php/login.php",
		method: "POST",
		data: $(this).serialize(),
		dataType: "json"

	}).done(function(respuesta){
		console.log(respuesta);

		if(!respuesta.error){
			if(respuesta.tipo == 'admin'){
				location.href = "paneladministracion.php";
			}else if(respuesta.tipo == 'empleado'){
				location.href = "paneltrabajo.php";
			}
		}else{
			$("#error-login").slideDown('slow');
			setTimeout(function(){
				$("#error-login").slideUp('slow');
			},3000);
			$("#boton-login").val("Ingresar");
		}
	}).fail(function(resp){
		console.log(resp);
	}).always(function(){
		console.log("Completado");
	});
});