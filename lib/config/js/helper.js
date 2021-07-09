'use strict'

function cargando(msj) {
	swal({
		text:msj,
		imageUrl: '../../../../lib/assets/images/load.gif',
		imageWidth: 32,
  		imageHeight: 32,
		showConfirmButton:false,
		showCancelButton:false,
		showCloseButton:false,
		allowOutsideClick: false,
		allowEscapeKey: false
	});
}

function sweetealerta(titulo,msj,tipo){
	swal(titulo,msj,tipo);
}

function sweerAlertProceso (){
	swal({
	  position: 'top-right',
	  type: 'success',
	  title: 'Proceso realizado con exito...',
	  showConfirmButton: false,
	  timer: 1500
	})
}

function sweetwait(titulo,msj,tipo) {
    swal({
        title:titulo,
        text:msj,
        type:tipo,
        showConfirmButton:false,
        showCancelButton:false,
        showCloseButton:false,
        allowOutsideClick: false,
        allowEscapeKey: false
    });
}