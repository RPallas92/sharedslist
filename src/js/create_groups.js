var id = 1; // Identificador de los checkbox

/*
 * A�ade el correo del campo #text-2 a la lista de correo
 * si y s�lo si es un correo v�lido.
 */
function addUsers()
{
	var txt = $("#text-2");
	var val = txt.val();
	if(validateEmail(val)){
		$("#check2").append('<input type="checkbox" checked id="cb'+id+'"/><label id="cb'+id+'"for="cb'+id+'">'+val+'</label>');
		$("#check").trigger("create");
		id = id +1;
		$("#text-2").val("");
		$('#message').html('');
	}
	else{
		$('#message').html('Email incorrecto');
	}
}

/*
 * Devuelve cierto si y solo si el par�metro de entrada 
 * email tiene la estructura de un correo electr�nico. 
 * En caso contrario devuelve falso.
 */
function validateEmail(email) 
{ 
    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
} 

/*
 * Devuelve cierto si y solo si el par�metro de entrada name 
 * no se encuentra vac�o. En caso contrario devuelve falso.
 */
function validateName(name) 
{ 	
	if($.trim(name) == ""){
		return false;
	}
	else{
		return true;
	}
}

/*
 * Env�a una petici�n ajax con el nombre del grupo y los
 * correos electr�nicos seleccionados en la lista de correos.
 * Crea el grupo y devuelve la p�gina encargada de listar grupos.
 */
function createGroup()
{
	var users = new Array();
	var group_name = $("#text-1").val();
	if(validateName(group_name)){
		var n = $('form#createform').find('input:checked');
		var name;
		for(var i=1; i< n.length+1; i++)
		{	
			name = $("#"+n[i-1].id).next("label").text();
			users[i-1] = {'name' : $.trim(name)};
		}
		var parameters = { "users" : users, "group_name" : group_name};
		$.ajax({
			data:  parameters,
			url:   document.URL+'/../php/create_groups.php',
			dataType: 'text',
			type:  'post',
			success:  function (response)
				   {window.location.href = 'list_groups.html';}
			});
	}
	else{
		$('#message').html('Nombre de grupo vacio');
	}
}
