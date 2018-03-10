//Variables de los modales y tablas
var modalDelCli = $("#ClienteModal");
    var campoIdCli = $("#id-cli");
    var campoOpCli = $("#ClienteModal #opcion");
    var campoNombresCli = $("#nombre-cli");
    var campoApellidosCli = $("#apellido-cli");
    var campoTelefonoCli = $("#cel-cli");

    var tablaClientes = $("#tabla-clientes");

var modalDelEmp = $("#EmpleadoModal");
    var campoIdEmp = $("#id-emp");
    var campoOpEmp = $("#EmpleadoModal #opcion");
    var campoNombresEmp = $("#nombre-emp");
    var campoApellidosEmp = $("#apellido-emp");
    var campoTelefonoEmp = $("#cel-emp");
    var campoUsuarioEmp = $("#usuario-emp");
    var campoContraseniaEmp = $("#contrasenia-emp");
    var campoTipoEmp = $("#tipo-emp");

    var tablaEmpleados = $("#tabla-empleados");

var modalDelPaquete = $("#PaqueteModal");
    var campoIdPaquete = $("#id-paquete");
    var campoOpPaquete = $("#PaqueteModal #opcion");
    var campoNombrePaquete = $("#nombre-paquete");
    var campoPrecioPaquete = $("#precio-paquete");

    var tablaPaquetes = $("#tabla-paquetes");

var modalDelServicio = $("#ServicioModal");
    var campoIdServicio = $("#id-servicio");
    var campoOpServicio = $("#ServicioModal #opcion");
    var campoNombreServicio = $("#nombre-servicio");
    var campoPrecioServicio = $("#precio-servicio");

    var tablaServicios = $("#tabla-servicios");

var modalDelEvento = $("#EventoModal");
    var campoIdEvento = $("#id-evento");
    var campoOpEvento = $("#EventoModal #opcion");
    var campoCliEvento = $("#nombre-cli-evento");
    var campoDireccionEvento = $("#direccion-evento");
    var campoFechaEvento = $("#fecha-evento");
    var campoHoraEvento = $("#hora-evento");
    var campoPaqueteEvento = $("#paquete-evento");
    var campoServiciosEvento = $("#servicios-evento");
    var campoPrecioEvento = $("#precio-evento");
    var campoSaldoEvento = $("#saldo-evento");
    var campoGrupoEmpEvento = $("#grupo-empleado-evento");
    var campoEmpEvento = $("#empleado-evento");
    var campoGrupoAnticipoEvento = $("#grupo-anticipo-evento");
    var campoAnticipoEvento = $("#anticipo-evento");
    var campoGrupoSaldoEvento = $("#grupo-saldo-evento");

    var tablaEventos = $("#tabla-eventos");

var modalDeVenta = $("#VentaModal");
    var campoIdVenta = $("#id-venta");
    var campoCliVenta = $("#nombre-cli-venta");
    var campoFechaSol = $("#fecha-sol-venta");
    var campoFechaSal = $("#fecha-sal-venta");
    var campoServicioVenta = $("#servicio-venta");
    var campoPrecioVenta = $("#precio-venta");
    var campoOpVenta = $("#VentaModal #opcion");

    var tablaVentas = $("#tabla-ventas");

//Variable del idioma de las tablas
var idioma_espaniol = {
    "sProcessing":     "Procesando...",
    "sLengthMenu":     "Mostrar _MENU_ registros",
    "sZeroRecords":    "No se encontraron resultados",
    "sEmptyTable":     "Ningún dato disponible en esta tabla",
    "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
    "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
    "sInfoPostFix":    "",
    "sSearch":         "Buscar:",
    "sUrl":            "",
    "sInfoThousands":  ",",
    "sLoadingRecords": "Cargando...",
    "oPaginate": {
        "sFirst":    "Primero",
        "sLast":     "Último",
        "sNext":     "Siguiente",
        "sPrevious": "Anterior"
    },
    "oAria": {
        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
    }
};


$(document).ready(function(){ //Funcion que se ejecuta al cargar la pagina (tipo 'main' en java)

    //Lista los datos actuales de la bd en las tablas
    listar();
    procesar();

    //Agrega comportamiento por defecto al boton 'AGREGAR NUEVO CLIENTE'
	habilitarBotonNuevoCliente("#linkCliente", modalDelCli, "#contenedorModificarAgregarCli", "#contenedorRemoverCli", "Registro de nuevo cliente");
    habilitarBotonNuevoEmpleado("#linkEmpleado", modalDelEmp, "#contenedorModificarAgregarEmp", "#contenedorRemoverEmp", "Registro de nuevo empleado");
    habilitarBotonNuevoPaquete("#linkPaquete", modalDelPaquete, "#contenedorModificarAgregarPaquete", "#contenedorRemoverPaquete", "Registro de nuevo paquete");
    habilitarBotonNuevoServicio("#linkServicio", modalDelServicio, "#contenedorModificarAgregarServicio", "#contenedorRemoverServicio", "Registro de nuevo servicio");
    habilitarBotonNuevoEvento("#linkEvento", modalDelEvento, "#contenedorModificarAgregarEvento", "#contenedorRemoverEvento", "Registro de nuevo evento");
    habilitarBotonNuevaVenta("#linkVenta", modalDeVenta, "#contenedorModificarAgregarVenta", "#contenedorRemoverVenta", "Registro de nueva venta");
	$(".selector-fecha").datepicker({
        format: "yyyy-mm-dd",
        language: "es",
        autoclose: true,
        todayHighlight: true
    }); 

    campoServiciosEvento.select2();
    campoServiciosEvento.on("change", function(e){
        var calculo = 0;

        var array = $("#servicios-evento").find(":selected");
        for(var i = 0; i < array.length; i++){
            calculo = calculo + parseInt($(array[i]).data("precio"));
        }
        var array2 = $("#paquete-evento option:selected");
        for(var i = 0; i < array2.length; i++){
            calculo = calculo + parseInt($(array2[i]).data("precio"));
        }
        $("#precio-evento").val(calculo);
        
    });

    campoPaqueteEvento.select2();
    campoPaqueteEvento.on("change", function(e){
        var calculo = 0;

        var array = $("#servicios-evento").find(":selected");
        for(var i = 0; i < array.length; i++){
            calculo = calculo + parseInt($(array[i]).data("precio"));
        }

        var array2 = $("#paquete-evento option:selected");
        for(var i = 0; i < array2.length; i++){
            calculo = calculo + parseInt($(array2[i]).data("precio"));
        }
        $("#precio-evento").val(calculo);
    });

    
});	

var listar = function(){
  listarClientes();
  listarEmpleados();
  listarPaquetes();
  listarServicios();
  listarEventos();
  //listarVentas();
}

var listarClientes = function(){
    var tabla = tablaClientes.DataTable({
        "destroy": true,
        "ajax": {
            "url": "../php/listarClientes.php",
            "type": "POST"
        },
        "columns": [
            { "data": "nombres" },
            { "data": "apellidos" },
            { "data": "telefono" },
            { "defaultContent": "<div class='btn-group' role='group' aria-label='group'><button type='button' class='modificar-cliente btn btn-info'>Modificar</button><button type='button' class='eliminar-cliente btn btn-danger'>Anular</button></div>"}
        ],
        "language": idioma_espaniol,
        "pageLength": 7,
        "lengthMenu": [ 7, 10, 25, 50, 75, 100 ]
    } );

     /*Se agrega un escucha al evento click para los botones 'MODIFICAR' con el fin de 
    recuperar la data de la BD respectiva para la fila a la que pertenece el boton 'MODIFICAR' y
    escribirla en los campos del modal(aviso) correspondientes
    */
    var cuerpoDeTabla = tablaClientes.find("tbody");
    
    cuerpoDeTabla.on("click", "button.modificar-cliente,button.eliminar-cliente", function(){
        var datos = tabla.row($(this).parents("tr")).data();
        var id = campoIdCli.val(datos.id_cliente),
            nombres = campoNombresCli.val(datos.nombres),
            apellidos = campoApellidosCli.val(datos.apellidos),
            telefono = campoTelefonoCli.val(datos.telefono);
    });

    //Habilita los botones 'MODIFICAR para que lancen el modal para editar
    habilitarBotonesTabla(cuerpoDeTabla, "button.modificar-cliente", "button.eliminar-cliente", modalDelCli, "Modificar clientes", "Baja de cliente", "#contenedorModificarAgregarCli", "#contenedorRemoverCli");
}

var listarEmpleados = function(){
    var tabla = tablaEmpleados.DataTable({
        "destroy": true,
        "ajax": {
            "url": "../php/listarEmpleados.php",
            "type": "POST"
        },
        "columns": [
            { "data": "nombres" },
            { "data": "apellidos" },
            { "data": "telefono" },
            { "data": "usuario"},
            { "data": "contrasenia"},
            { "data": "tipo_usuario"},
            { "defaultContent": "<div class='btn-group' role='group' aria-label='group'><button type='button' class='modificar-empleado btn btn-info'>Modificar</button><button type='button' class='eliminar-empleado btn btn-danger'>Anular</button></div>"}
        ],
        "language": idioma_espaniol,
        "pageLength": 7,
        "lengthMenu": [ 7, 10, 25, 50, 75, 100 ]
    } );

     /*Se agrega un escucha al evento click para los botones 'MODIFICAR' con el fin de 
    recuperar la data de la BD respectiva para la fila a la que pertenece el boton 'MODIFICAR' y
    escribirla en los campos del modal(aviso) correspondientes
    */
    var cuerpoDeTabla = tablaEmpleados.find("tbody");
    
    cuerpoDeTabla.on("click", "button.modificar-empleado,button.eliminar-empleado", function(){
        var datos = tabla.row($(this).parents("tr")).data();
        var id = campoIdEmp.val(datos.id_empleado),
            nombres = campoNombresEmp.val(datos.nombres),
            apellidos = campoApellidosEmp.val(datos.apellidos),
            telefono = campoTelefonoEmp.val(datos.telefono),
            usuario = campoUsuarioEmp.val(datos.usuario),
            contrasenia = campoContraseniaEmp.val(datos.contrasenia),
            tipo = campoTipoEmp.val(datos.tipo_usuario);
    });

    //Habilita los botones 'MODIFICAR para que lancen el modal para editar
    habilitarBotonesTabla(cuerpoDeTabla, "button.modificar-empleado", "button.eliminar-empleado", modalDelEmp, "Modificar empleado", "Baja de empleado", "#contenedorModificarAgregarEmp", "#contenedorRemoverEmp");
}

var listarPaquetes = function(){
    var tabla = tablaPaquetes.DataTable({
        "destroy": true,
        "ajax": {
            "url": "../php/listarPaquetes.php",
            "type": "POST"
        },
        "columns": [
            { "data": "descripcion" },
            { "data": "precio" },
            { "defaultContent": "<div class='btn-group' role='group' aria-label='group'><button type='button' class='modificar-paquete btn btn-info'>Modificar</button><button type='button' class='eliminar-paquete btn btn-danger'>Anular</button></div>"}
        ],
        "language": idioma_espaniol,
        "pageLength": 7,
        "lengthMenu": [ 7, 10, 25, 50, 75, 100 ],
        "info": false
    } );

     /*Se agrega un escucha al evento click para los botones 'MODIFICAR' con el fin de 
    recuperar la data de la BD respectiva para la fila a la que pertenece el boton 'MODIFICAR' y
    escribirla en los campos del modal(aviso) correspondientes
    */
    var cuerpoDeTabla = tablaPaquetes.find("tbody");
    
    cuerpoDeTabla.on("click", "button.modificar-paquete,button.eliminar-paquete", function(){
        var datos = tabla.row($(this).parents("tr")).data();
        var id = campoIdPaquete.val(datos.id_paquete),
            nombre = campoNombrePaquete.val(datos.descripcion),
            precio = campoPrecioPaquete.val(datos.precio);
    });

    //Habilita los botones 'MODIFICAR para que lancen el modal para editar
    habilitarBotonesTabla(cuerpoDeTabla, "button.modificar-paquete", "button.eliminar-paquete", modalDelPaquete, "Modificar paquete", "Baja de paquete", "#contenedorModificarAgregarPaquete", "#contenedorRemoverPaquete");
}

var listarServicios = function(){
    var tabla = tablaServicios.DataTable({
        "destroy": true,
        "ajax": {
            "url": "../php/listarServicios.php",
            "type": "POST"
        },
        "columns": [
            { "data": "descripcion" },
            { "data": "precio" },
            { "defaultContent": "<div class='btn-group' role='group' aria-label='group'><button type='button' class='modificar-servicio btn btn-info'>Modificar</button><button type='button' class='eliminar-servicio btn btn-danger'>Anular</button></div>"}
        ],
        "language": idioma_espaniol,
        "pageLength": 7,
        "lengthMenu": [ 7, 10, 25, 50, 75, 100 ],
        "info": false
    } );

     /*Se agrega un escucha al evento click para los botones 'MODIFICAR' con el fin de 
    recuperar la data de la BD respectiva para la fila a la que pertenece el boton 'MODIFICAR' y
    escribirla en los campos del modal(aviso) correspondientes
    */
    var cuerpoDeTabla = tablaServicios.find("tbody");
    
    cuerpoDeTabla.on("click", "button.modificar-servicio,button.eliminar-servicio", function(){
        var datos = tabla.row($(this).parents("tr")).data();
        var id = campoIdServicio.val(datos.id_servicio),
            nombre = campoNombreServicio.val(datos.descripcion),
            precio = campoPrecioServicio.val(datos.precio);
    });

    //Habilita los botones 'MODIFICAR para que lancen el modal para editar
    habilitarBotonesTabla(cuerpoDeTabla, "button.modificar-servicio", "button.eliminar-servicio", modalDelServicio, "Modificar servicio", "Baja de servicio", "#contenedorModificarAgregarServicio", "#contenedorRemoverServicio");    
}

var listarEventos = function(){
    var tabla = tablaEventos.DataTable({
        "destroy": true,
        "ajax": {
            "url": "../php/listarEventos.php",
            "type": "POST"
        },
        "columns": [
            { "data": "fecha" },
            { "data": "cliente" },
            { "data": "empleado" },
            { "data": "direccion" },
            { "data": "precio" },
            { "data": "saldo" },
            { "defaultContent": "<div class='btn-group' role='group' aria-label='group'><button type='button' class='modificar-evento btn btn-info'>Modificar</button><button type='button' class='eliminar-evento btn btn-danger'>Anular</button></div>"}
        ],
        "language": idioma_espaniol,
        "pageLength": 7,
        "lengthMenu": [ 7, 10, 25, 50, 75, 100 ],
        "info": false
    } );

    //Obtiene los clientes disponibles
    $.ajax({
        url: "../php/obtenerMiniListaClientes.php",
        method: "POST"
    }).done(function(respuesta){
        var array = JSON.parse(respuesta);

        campoCliEvento.find("option").remove();

        for(var i in array){
            var opt = document.createElement('option');
            opt.value = array[i].id_cliente;
            opt.innerHTML = array[i].nombres;
            campoCliEvento.append(opt);
        }

    }).fail(function(respuesta){
        console.log("Error al actualizar los clientes");
    });

    //Obtiene los paquetes disponibles
    $.ajax({
        url: "../php/obtenerMiniListaPaquetes.php",
        method: "POST"
    }).done(function(respuesta){
        var array = JSON.parse(respuesta);

        campoPaqueteEvento.find("option").remove();

        for(var i in array){
            var opt = $(document.createElement('option'));

            opt.val(array[i].id_paquete);
            opt.text(array[i].nombre + "  " + "$"+ array[i].precio);
            opt.data("precio", array[i].precio);
            campoPaqueteEvento.append(opt);
        }

    }).fail(function(respuesta){
        console.log("Error al actualizar los paquetes");
    });

    //Obtener los servicios disponibles
    $.ajax({
        url: "../php/obtenerMiniListaServicios.php",
        method: "POST"
    }).done(function(respuesta){
        var array = JSON.parse(respuesta);

        campoServiciosEvento.val("");

        for(var i in array){
            var opt = $(document.createElement('option'));

            opt.val(array[i].id_servicio);
            opt.text(array[i].nombre + "  " + "$"+ array[i].precio);
            opt.data("precio", array[i].precio);
            campoServiciosEvento.append(opt);
        }

    }).fail(function(respuesta){
        console.log("Error al actualizar los servicios");
    });

    /*Se agrega un escucha al evento click para los botones 'MODIFICAR' con el fin de 
    recuperar la data de la BD respectiva para la fila a la que pertenece el boton 'MODIFICAR' y
    escribirla en los campos del modal(aviso) correspondientes*/
    var cuerpoDeTabla = tablaEventos.find("tbody");
    
    cuerpoDeTabla.on("click", "button.modificar-evento,button.eliminar-evento", function(){

        var datos = tabla.row($(this).parents("tr")).data();
        campoGrupoEmpEvento.css("display","initial");
        campoGrupoAnticipoEvento.css("display","none");
        campoGrupoSaldoEvento.css("display","initial");
        var id = campoIdEvento.val(datos.id_evento),
            cliente = campoCliEvento.val(datos.id_cliente),
            direccion = campoDireccionEvento.val(datos.direccion),
            fecha = campoFechaEvento.val(datos.fecha),
            paquete = campoPaqueteEvento.val(datos.id_paquete),
            hora = campoHoraEvento.val(datos.hora),
            precio = campoPrecioEvento.val(datos.precio),
            saldo = campoSaldoEvento.val(datos.saldo),
            empleado = campoEmpEvento.val(datos.empleado);   

        $.ajax({
            url: "../php/obtenerMiniListaServiciosModificar.php",
            method: "POST",
            data: {"id_evento": campoIdEvento.val()}
        }).done(function(respuesta){
            var array = JSON.parse(respuesta);

            $("#servicios-evento option").prop("selected", false);
  
            for(var i in array){
                $("#servicios-evento option[value="+array[i].id_servicio+"]").prop("selected", true);
            }

        }).fail(function(respuesta){
            console.log("Error al actualizar los servicios");
        });

    });

    //Habilita los botones 'MODIFICAR para que lancen el modal para editar
    habilitarBotonesTabla(cuerpoDeTabla, "button.modificar-evento", "button.eliminar-evento", modalDelEvento, "Modificar evento", "Baja de evento", "#contenedorModificarAgregarEvento", "#contenedorRemoverEvento");
}

var listarVentas = function(){
    var tabla = tablaVentas.DataTable({
        "destroy": true,
        "ajax": {
            "url": "../php/listarVentas.php",
            "type": "POST"
        },
        "columns": [
            { "data": "" },
            { "data": "cliente" },
            { "data": "empleado" },
            { "data": "servicio" },
            { "data": "fecha_solicitud" },
            { "data": "fecha_entrega" },
            { "defaultContent": "<div class='btn-group' role='group' aria-label='group'><button type='button' class='modificar-venta btn btn-info'>Modificar</button><button type='button' class='eliminar-venta btn btn-danger'>Anular</button></div>"}
        ],
        "language": idioma_espaniol,
        "pageLength": 7,
        "lengthMenu": [ 7, 10, 25, 50, 75, 100 ],
        "info": false
    } );

    //Obtiene los clientes disponibles
    $.ajax({
        url: "../php/obtenerMiniListaClientes.php",
        method: "POST"
    }).done(function(respuesta){
        var array = JSON.parse(respuesta);

        campoCliVenta.find("option").remove();

        for(var i in array){
            var opt = document.createElement('option');
            opt.value = array[i].id_cliente;
            opt.innerHTML = array[i].nombres;
            campoCliVenta.append(opt);
        }

    }).fail(function(respuesta){
        console.log("Error al actualizar los clientes");
    });

    //Obtener los servicios disponibles
    $.ajax({
        url: "../php/obtenerMiniListaServicios.php",
        method: "POST"
    }).done(function(respuesta){
        var array = JSON.parse(respuesta);

        campoServicioVenta.val("");

        for(var i in array){
            var opt = $(document.createElement('option'));

            opt.val(array[i].id_servicio);
            opt.text(array[i].nombre + "  " + "$"+ array[i].precio);
            opt.data("precio", array[i].precio);
            campoServicioVenta.append(opt);
        }

    }).fail(function(respuesta){
        console.log("Error al actualizar los servicios");
    });

    /*Se agrega un escucha al evento click para los botones 'MODIFICAR' con el fin de 
    recuperar la data de la BD respectiva para la fila a la que pertenece el boton 'MODIFICAR' y
    escribirla en los campos del modal(aviso) correspondientes*/
    var cuerpoDeTabla = tablaVentas.find("tbody");
    
    cuerpoDeTabla.on("click", "button.modificar-venta,button.eliminar-venta", function(){

        var datos = tabla.row($(this).parents("tr")).data();
        var id = campoIdVenta.val(datos.id_evento),
            cliente = campoCliVenta.val(datos.id_cliente),
            servicio = campoServicioVenta.val(datos.id_servicio);
            fecha_sol = campoFechaSol.val(datos.fecha_solicitud),
            fecha_sal = campoFechaSal.val(datos.fecha_entrega),
            empleado = campoEmpVenta.val(datos.empleado);   
    });

    //Habilita los botones 'MODIFICAR para que lancen el modal para editar
    habilitarBotonesTabla(cuerpoDeTabla, "button.modificar-venta", "button.eliminar-venta", modalDelEvento, "Modificar venta", "Baja de venta", "#contenedorModificarAgregarVenta", "#contenedorRemoverVenta");    
}

var procesar = function(){
    procesarCliente();
    procesarEmpleado();
    procesarPaquete();
    procesarServicio();
    procesarEvento();
    //procesarVenta();
} 

var procesarCliente = function(){
    $("#formularioCliente").on("submit", function(evento){
        evento.preventDefault();
        var formulario = $(this).serialize();
        modalDelCli.modal('hide');

        $.ajax({
            method: "POST",
            url: "../php/procesarCliente.php",
            data: formulario
        }).done(function(informacion){
            var json_informacion = JSON.parse(informacion);
            alert(json_informacion.respuesta);
            listarClientes();
        });
    });
}

var procesarEmpleado = function(){
    $("#formularioEmpleado").on("submit", function(evento){
        evento.preventDefault();
        var formulario = $(this).serialize();
        modalDelEmp.modal('hide');

        $.ajax({
            method: "POST",
            url: "../php/procesarEmpleado.php",
            data: formulario
        }).done(function(informacion){
            var json_informacion = JSON.parse(informacion);
            alert(json_informacion.respuesta);
            listarEmpleados();
        });
    });
}

var procesarPaquete = function(){
    $("#formularioPaquete").on("submit", function(evento){
        evento.preventDefault();
        var formulario = $(this).serialize();
        modalDelPaquete.modal('hide');

        $.ajax({
            method: "POST",
            url: "../php/procesarPaquete.php",
            data: formulario
        }).done(function(informacion){
            var json_informacion = JSON.parse(informacion);
            alert(json_informacion.respuesta);
            listarPaquetes();
        });
    });
}

var procesarServicio = function(){
    $("#formularioServicio").on("submit", function(evento){
        evento.preventDefault();
        var formulario = $(this).serialize();
        modalDelServicio.modal('hide');

        $.ajax({
            method: "POST",
            url: "../php/procesarServicio.php",
            data: formulario
        }).done(function(informacion){
            var json_informacion = JSON.parse(informacion);
            alert(json_informacion.respuesta);
            listarServicios();
        });
    });
}

var procesarEvento = function(){
    $("#formularioEvento").on("submit", function(evento){
        evento.preventDefault();
        var formulario = $(this).serialize();
        modalDelEvento.modal('hide');

        $.ajax({
            method: "POST",
            url: "../php/procesarEvento.php",
            data: formulario
        }).done(function(informacion){
            var json_informacion = JSON.parse(informacion);
            alert(json_informacion.respuesta);
            
        }).fail(function(informacion){
            console.log(informacion);
        });

        listarEventos();
    });
}

var procesarVenta = function(){
    $("#formularioVenta").on("submit", function(evento){
        evento.preventDefault();
        var formulario = $(this).serialize();
        modalDeVenta.modal('hide');

        $.ajax({
            method: "POST",
            url: "../php/procesarVenta.php",
            data: formulario
        }).done(function(informacion){
            var json_informacion = JSON.parse(informacion);
            alert(json_informacion.respuesta);
            
        }).fail(function(informacion){
            console.log(informacion);
        });

        listarVentas();
    });
}   

var habilitarBotonesTabla = function(tbody, botonesModificar, botonesRemover, modal, textoModificar, textoEliminar, contenedorPrincipal, contenedorSecundario){
    
    tbody.on("click", botonesModificar, function(){
        modal.find(".submit").text("Guardar");
        modal.find(".modal-title").text(textoModificar);
        modal.find("#opcion").val("modificar");
        modal.find(contenedorSecundario).css("display","none");
        modal.find(contenedorPrincipal).css("display","flex");
        modal.modal('show');
    });

    tbody.on("click", botonesRemover, function(){
        modal.find(".submit").text("Remover");
        modal.find(".modal-title").text(textoEliminar);
        modal.find("#opcion").val("remover");
        modal.find(contenedorPrincipal).css("display","none");
        modal.find(contenedorSecundario).css("display","flex");
        modal.modal('show');
    });
}

var habilitarBotonNuevoCliente = function(id_button, modal, contenedorMostrar, contenedorOcultar, text){

    $(id_button).click(function(){
        campoNombresCli.val("");
        campoApellidosCli.val("");
        campoTelefonoCli.val("");

        $(contenedorMostrar).css("display","flex");
        $(contenedorOcultar).css("display","none");

        modal.find(".modal-title").text(text);
        modal.find(".submit").text("Registrar");
        modal.find("#opcion").val("nuevo"); 
        modal.modal('show');
    });
}

var habilitarBotonNuevoEmpleado = function(id_button, modal, contenedorMostrar, contenedorOcultar, text){
   
    $(id_button).click(function(){
        campoNombresEmp.val("");
        campoApellidosEmp.val("");
        campoTelefonoEmp.val("");
        campoUsuarioEmp.val("");
        campoContraseniaEmp.val("");
        campoTipoEmp.val("");

        $(contenedorMostrar).css("display","flex");
        $(contenedorOcultar).css("display","none");

        modal.find(".modal-title").text(text);
        modal.find(".submit").text("Registrar");
        modal.find("#opcion").val("nuevo"); 
        modal.modal('show');
    });
}

var habilitarBotonNuevoServicio = function(id_button, modal, contenedorMostrar, contenedorOcultar, text){
    campoNombreServicio, campoPrecioServicio  
     $(id_button).click(function(){
        campoNombreServicio.val("");
        campoPrecioServicio.val("");

        $(contenedorMostrar).css("display","flex");
        $(contenedorOcultar).css("display","none");

        modal.find(".modal-title").text(text);
        modal.find(".submit").text("Registrar");
        modal.find("#opcion").val("nuevo"); 
        modal.modal('show');
    });
}

var habilitarBotonNuevoPaquete = function(id_button, modal, contenedorMostrar, contenedorOcultar, text){

    $(id_button).click(function(){
        campoNombrePaquete.val("");
        campoPrecioPaquete.val("");

        $(contenedorMostrar).css("display","flex");
        $(contenedorOcultar).css("display","none");

        modal.find(".modal-title").text(text);
        modal.find(".submit").text("Registrar");
        modal.find("#opcion").val("nuevo"); 
        modal.modal('show');
    });
}

var habilitarBotonNuevaVenta = function(id_button, modal, contenedorMostrar, contenedorOcultar, text){

    $(id_button).click(function(){
        campoCliVenta.val("");
        campoFechaSol.val("");
        campoFechaSal.val("");
        campoServicioVenta.val("");
        campoPrecioVenta.val("");
        
        $(contenedorMostrar).css("display","flex");
        $(contenedorOcultar).css("display","none");

        modal.find(".modal-title").text(text);
        modal.find(".submit").text("Registrar");
        modal.find("#opcion").val("nuevo"); 
        modal.modal('show'); 
    });
}

var habilitarBotonNuevoEvento = function(id_button, modal, contenedorMostrar, contenedorOcultar, text){

    $(id_button).click(function(){
        campoCliEvento.val("");
        campoDireccionEvento.val("");
        campoFechaEvento.val("");
        campoHoraEvento.val("");
        campoPaqueteEvento.val("");
        campoServiciosEvento.val("");
        campoPrecioEvento.val("0");
        campoGrupoEmpEvento.css("display", "none");
        campoGrupoAnticipoEvento.css("display", "initial");
        campoGrupoSaldoEvento.css("display", "none");

        $(contenedorMostrar).css("display","flex");
        $(contenedorOcultar).css("display","none");

        modal.find(".modal-title").text(text);
        modal.find(".submit").text("Registrar");
        modal.find("#opcion").val("nuevo"); 
        modal.modal('show'); 
    });
}
