(function($){
	
	// validacion
		//metodo agregado
		$.validator.addMethod('selec', function (value) {
				return value != 'selec';
		}, 'Seleccione una opcion');
		//metodo agregado
		$.validator.addMethod('fecha', function (value) {
				return value !== '';
		}, 'Seleccione una fecha');
		//metodo agregado
		$.validator.addMethod('ContainsAtLeastOneDigit', function (value) {
				return (/[0-9]/).test(value);
		}, 'Su password debe contener al menos un número.');
		//metodo agregado
		$.validator.addMethod('ContainsAtLeastOneCapitalLetter', function (value) {
				return (/[A-Z]/).test(value);
		}, 'Su password debe contener al menos una letra mayúscula.');
		//metodo agregado
		$.validator.addMethod('ContainsAtLeastOneNonCapitalLetter',	function (value) {
				return (/[a-z]/).test(value);
		}, 'Su password debe contener al menos una letra minúscula.');
		//Reglas
		$.validator.addClassRules({
			passn0: { // this is from the name="password" attribute, not id="password-id" attribute
					ContainsAtLeastOneDigit: true,
					ContainsAtLeastOneCapitalLetter: true,
					ContainsAtLeastOneNonCapitalLetter: true
			},
			passn1: { // this is from the name="password2" attribute, not id="password2-id" attribute
					equalTo: '#passn0'
			},
			pass: {
					remote: {
							url: 'php/actualpasschk.php',
							type: 'post'
					}
			},
			user: {
					remote: {
							url: 'php/veruser.php',
							type: 'post'
					}
			},
			marca: {
					remote: {
							url: 'php/veruser.php',
							type: 'post'
					}
			}
		});
		//Defaults
		$.validator.setDefaults({
			messages: {
				passn1: {
					equalTo: 'La contraseña no coincide con la introducida en el campo anterior'
				},
				pass: {
					remote: 'La contraseña no es correcta'
				},
				user: {
					remote: 'El usuario ingresado ya se encuentra en uso'
				},
				marca: {
					remote: 'La marca ya se encuentra cargada'
				}
			},
			highlight: function (element) { //donde aplico el error
					$(element).closest('.form-group').removeClass('has-success').addClass('has-error');
			},
			success: function (element) { //donde aplico el succes
					$(element).closest('.form-group').removeClass('has-error').addClass('has-success');
			},
			errorClass: 'help-block',
			errorPlacement: function(error,element){
				var aca = $(element).closest('.input-group');
				if(element.hasClass('appendedtext')){
					error.insertAfter(aca);
				}else{
					error.insertAfter(element);
				}
			}
		});
		//alertas y confirms
	alertify.defaults = {
        // dialogs defaults
        modal:true,
        basic:false,
        frameless:false,
        movable:true,
        resizable:true,
        closable:true,
        closableByDimmer:true,
        maximizable:true,
        startMaximized:false,
        pinnable:true,
        pinned:true,
        padding: true,
        overflow:true,
        maintainFocus:true,
        transition:'pulse',
        autoReset:true,

        // notifier defaults
        notifier:{
            // auto-dismiss wait time (in seconds)  
            delay:3,
            // default position
            position:'top-right'
        },

        // language resources 
        glossary:{
            // dialogs default title
            title:'Atención!',
            // ok button text
            ok: 'Aceptar',
            // cancel button text
            cancel: 'Cancelar'            
        },

        // theme settings
        theme:{
            // class name attached to prompt dialog input textbox.
            input:'ajs-input',
            // class name attached to ok button
            ok:'ajs-ok',
            // class name attached to cancel button 
            cancel:'ajs-cancel'
        }
    };
	////////////////////////////////////////////////////////////////////////////////////////////
	$.extend({
		// carga de un form
		contacto: function(options){
			$('form#contacto').validate({
				submitHandler: function (form) {
					
					var datos = $(form).serialize();
					
					$.ajax({
						type: 'POST',
						url: '/contacto/consultacar.php',
						data: datos,
						success: function (data) {
							alertify.success(data,3);
							$('form#contacto')[0].reset();
							$('#envio').toggle();
						},
						error:function(jqXHR, textStatus, errorThrown){
							alertify.error('Error:'+errorThrown);
						}
					});
		
				}
			});
		}
	});
		
})(jQuery);