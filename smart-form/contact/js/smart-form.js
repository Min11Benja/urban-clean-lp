	jQuery(document).ready(function($){

//				function reloadCaptcha(){ $("#captchax").attr("src","./smart-form/contact/php/captcha/captcha.php?r=" + Math.random()); }
//				$('.captcode').click(function(e){
//					e.preventDefault();
//					reloadCaptcha();
//				});
//				
//				function swapButton(){
//					var txtswap = $(".form-footer button[type='submit']");
//					if (txtswap.text() == txtswap.data("btntext-sending")) {
//						txtswap.text(txtswap.data("btntext-original"));
//					} else {
//						txtswap.data("btntext-original", txtswap.text());
//						txtswap.text(txtswap.data("btntext-sending"));
//					}
//				}
			   
				$( "#smart-form" ).validate({
				
						/* @validation states + elements 
						------------------------------------------- */
						errorClass: "state-error",
						validClass: "state-success",
						errorElement: "em",
						onkeyup: false,
						onclick: false,
						
						/* @validation rules 
						------------------------------------------ */
						rules: {
								sendername: {
										required: true,
										minlength: 2
								},		
								emailaddress: {
										required: true,
										email: true
								},
								sendersubject: {
										required: false,
										minlength: 4
								},	
                            sendercp: {
										required: false,
										minlength: 5
								},
								sendermessage: {
										required: false,
										minlength: 6
								}
//                            ,
//								captcha:{
//									required:true,
//									remote:'./smart-form/contact/php/captcha/process.php'
//								}
						},
						messages:{
								sendername: {
										required: 'Por favor escriba su nombre',
										minlength: 'Nombre debe de ser por lo minimo de 2 caracteres'
								},				
								emailaddress: {
										required: 'Por favor escriba un correo electronico valido.',
										email: 'El correo debe de ser valido!'
								},
								sendersubject: {
										required: 'Escriba el servicio que busca adquerir',
										minlength: 'El servicio debe de tener por lo minimo 4 caracteres'
								},														
								sendermessage: {
										required: 'Oops se le olvido el mensaje',
										minlength: 'El mensaje debe de tener por lo menos 6 caracteres.'
								}
                            
//                            ,															
//								captcha:{
//										required: 'You must enter the captcha code',
//										remote:'Captcha code is incorrect'
//								}
						},

						/* @validation highlighting + error placement  
						---------------------------------------------------- */
						highlight: function(element, errorClass, validClass) {
								$(element).closest('.field').addClass(errorClass).removeClass(validClass);
						},
						unhighlight: function(element, errorClass, validClass) {
								$(element).closest('.field').removeClass(errorClass).addClass(validClass);
						},
						errorPlacement: function(error, element) {
						   if (element.is(":radio") || element.is(":checkbox")) {
									element.closest('.option-group').after(error);
						   } else {
									error.insertAfter(element.parent());
						   }
						},
						
						/* @ajax form submition 
						---------------------------------------------------- */						
						submitHandler:function(form) {
							$(form).ajaxSubmit({
								    target:'.result',			   
									beforeSubmit:function(){ 
//											swapButton();
											//$('.form-footer').addClass('progress');
									},
									error:function(){
                                        $message = "Error en enviar datos AJAX - contactar ADMIN!";
                                        echo "<script type='text/javascript'>alert('$message');</script>";
//											swapButton();
											//$('.form-footer').removeClass('progress');
									},
									 success:function(){
										 	swapButton();
											$('.form-footer').removeClass('progress');
											$('.alert-success').show().delay(1000).fadeOut();
											$('.field').removeClass("state-error, state-success");
											if( $('.alert-error').length == 0){
												$('#smart-form').resetForm();
//												reloadCaptcha();
											}
									 }
							  });
						}
						
				});		
		
	});				
    