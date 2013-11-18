$(document).ready(function(){
//sacado de : http://blog.dashaft.net/jquery-como-crear-las-tabs-mas-faciles/	
 $(function (activar_pestanya) {
	// llamamos a la función y la nombramos
		var tabContainerssup = $('div.tab_form > div');
		// Convertimos una ruta en una variable, así la llamada a esa ruta será más fácil
 
    		$('div.tab a').click(function () {
		// ahora le estamos diciendo que active la siguiente 
		// función cada vez que clickamos dentro de los a situados dentro del div tab
 
		tabContainerssup.hide().filter(this.hash).show();
		// con la variable que hemos creado antes, le decimos que oculte todo su contenido, y que sólo muestre el contenido del anchor que hemos clickado
 
	        	return false;
		// ponemos esta linia para que no se nos desplace al hacer click arriba de la página
 
		}).filter(':first').click();
		// esta sentencia indica que lo primero que mostrará sera el primer anchor de la lista, si pusiéramos :last en vez de :first mostraría el último en un principio
	});
});
