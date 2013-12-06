/*
 * Env�a una petici�n ajax y lista los nombres de 
 * los grupos a los que pertenece el usuario en sesi�n.
 */
function listGroups()
{
	$.ajax({
		url: document.URL+'/../php/list_groups.php',
		dataType: 'text',
		type:  'post',
		success:  function (response)
			   {
			   obj = JSON.parse(response);
			   list(obj.names);}
		});
}

/*
 * Lista los nombres de los grupos a los que 
 * pertenece el usuario en sesi�n.
 */
function list(groups)
{
	var name;
	for(var i=0; i< groups.length; i++)
	{
		name = groups[i].name;
		$("#mylist").append('<li id="group'+i+'"><a href="#">'+groups[i]+'</a></li>');
		$("#mylist").listview('refresh');
	}
}