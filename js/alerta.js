function validarAlertas(){

	var verificar = true;

	var usuario = document.getElementById("usuario");
	var contra = document.getElementById("password");

	if(!usuario.value){

		swal("ERROR", "El campo usuario es requerido", "error");
		verificar = false;

	}else if(!contra.value){

		swal("ERROR", "El campo contraseña es requerido", "error");
		verificar = false;
	}
}

window.onload = function(){

	var botonEnviar;

	botonEnviar = document.proceso.aceptar;
	botonEnviar.onclick = validarAlertas;
}