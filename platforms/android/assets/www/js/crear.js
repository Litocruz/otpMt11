$('#formularioAltaUsuario').submit(function() { 
// recolecta los valores que inserto el usuario
var datosUsuario = $("#nuevousuario").val()
var datosContrasena = $("#nuevaclave").val()

	//archivo php donde se realizara la validacion. Este se encuentra en el servidor
	archivoValidacion = "http://litocruz.noip.me:8080/otp/alta.php?jsoncallback=?"
	$.getJSON( archivoValidacion, { usuario:datosUsuario ,contrasena:datosContrasena})
	.done(function(respuestaServer) {
	if(respuestaServer.creacion == 1){
		$.mobile.changePage("#inicio")  
    console.log(respuestaServer.log)
	}
	else
	{
		/// ejecutar una conducta cuando la validacion falla
    console.log(respuestaServer.creacion)
    console.log(respuestaServer.log)
		alert("Datos incorrectos: probable usuario existente ")
	}
})
	return false;
})
