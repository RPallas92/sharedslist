
function getName() 
{	
	$('#currentUserName').slideUp('fast');
	$.ajax({
		data:  {getUser : "usuario"},
		url:   'php/userConfig.php',
		type:  'post',
		success:  function (data)
					{
					var userName = data.trim();
					$('#currentUserName').html(userName);
					$('#currentUserName').slideDown('fast');							
					},
		error: function () {
					$('#currentUserName').html('Error de conexi�n.');
					$('#currentUserName').slideDown('fast');
					}
	});		
	return false;

};