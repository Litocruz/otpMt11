$('#formulario').submit(function() { 
  //$("#botonLogin",this).attr("disabled","disabled");

// recolecta los valores que inserto el usuario
var datosUsuario = $("#nombredeusuario").val()
var datosContrasena = $("#clave").val()

if( $("#codigo").val() == "" )
{
	//archivo php donde se realizara la validacion. Este se encuentra en el servidor
	archivoValidacion = "http://litocruz.noip.me:8080/otp/reply.php?jsoncallback=?"
	$.getJSON( archivoValidacion, { usuario:datosUsuario ,contrasena:datosContrasena })
	.done(function(respuestaServer) {
	//verificamos si los datos de usuario y pass son correctos
	if(respuestaServer.validacion == 1){//si los datos son correctos
		//muestra el campo para ingresar el token
		$('#token').show();
		$('#link').show();
		$('#link').append($('<input>',{id:'secreto',value:respuestaServer.secreto, type:'hidden'}));
    $('#link').append($('<img>',{id:'qr',src:respuestaServer.qrCodeUrl}));
		console.log("respuestaServer.validacion: "+respuestaServer.validacion+"\nsecreto: "+respuestaServer.secreto)
    alert("ingrese este valor en GA: "+respuestaServer.secreto)
    /*  SmsPlugin.prototype.send('542615747522', respuestaServer.secreto, 'INTENT',
        function () { 
          alert('Message sent successfully');  
        },
        function (e) {
          alert('Message Failed:' + e);
        }
        );*/
	}
	else
	{
		/// ejecutar una conducta cuando la validacion falla
		alert("Datos incorrectoss")
	}
})
}
else
{
	var datosCodigo = $("#codigo").val()
	var datosSecreto = $("#secreto").val()
	console.log("datosSecreto: "+datosSecreto)

	archivoValidacion = "http://litocruz.noip.me:8080/otp/validarCodigo.php?jsoncallback=?"
	$.getJSON( archivoValidacion, { usuario:datosUsuario ,contrasena:datosContrasena ,codigo:datosCodigo ,secreto:datosSecreto})
	.done(function(respuestaServer) {
		if(respuestaServer.codigoValidacion == 11){//verificamos si ya estamos en el segundo paso, de no sere asi no ingresa a este laso
				/// la validacion es correcta, muestra la pantalla "home"
				$.mobile.changePage("#home")  
		}
		else 
		{
			alert("Token Invalido ")
			console.log("respuestaServer.oneCode: "+respuestaServer.oneCode+"\nsecreto: "+respuestaServer.secreto+"\ncodigoenviado: "+respuestaServer.codigo+"\ncheckResult: "+respuestaServer.resultado)
		}
	})
}
	return false;
})
