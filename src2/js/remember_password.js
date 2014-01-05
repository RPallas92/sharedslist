﻿	function remember_password () {
		var email = $("#rememberEmail").val();
		var parameters = { "emailAddress" : email};
		$.ajax({
		data:  parameters,
		url:   'php/remember_password.php',
		dataType: 'text',
		type:  'post',
		success:  function (response){
				if(response == 'success') {
					$('#messageRememberPassword').html('Se ha generado una nueva contraseña aleatoria y se ha enviado a su email.');
					
				}else {
					$('#messageRememberPassword').html(response);
				}
				$('#messageRememberPassword').slideDown('fast');	
			},
			   
		error: function () {
			$('#messageRememberPassword').html('errror');
		}
		});
	}