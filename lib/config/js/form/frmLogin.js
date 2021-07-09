'use strict'

$(document).ready(function(){

	$(document).keypress(function(e){
		if (e.which==13){

			if ($("#usuario").val()==""){
				mensaje("Debe ingresar el usuario");
			} else if ($("#clave").val()==""){
				mensaje("Debe ingresar la clave");
			} else {
				let url = "lib/config/validar";

				$.ajax({
					type: 'POST',
					url: url,
					data: $("#frmLogin").serialize(),
					success: function(data){
						if(data==1){
							location.href ="modulos/selectModulo";
						} else if (data==2){
							mensaje("Usuario o Clave incorrectos");
						}
					}
				});
			}


		}
	})

	$("#entrar").click(function(){

		if ($("#usuario").val()==""){
			mensaje("Debe ingresar el usuario");
		} else if ($("#clave").val()==""){
			mensaje("Debe ingresar la clave");
		} else {
			let url = "lib/config/validar";

			$.ajax({
				type: 'POST',
				url: url,
				data: $("#frmLogin").serialize(),
				success: function(data){
					if(data==1){
						location.href ="modulos/selectModulo";
					} else if (data==2){
						mensaje("Usuario o Clave incorrectos");
					}
				}
			});
		}

	})

	$("input").click(function(){
		$("#mensaje").css("display","none");
	})

});

function mensaje(mensaje){
	$("#mensaje").css("display","block").text(mensaje);
}

