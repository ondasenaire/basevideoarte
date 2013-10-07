$(document).ready(function() {
	var collectionHolder = $('.metadatos');
	collectionHolder.data('index', collectionHolder.find(':input').length);
	
	function add(collectionHolder) {
		
		//var prototype = collectionHolder.attr('data-prototype');
		
		var prototype = collectionHolder.data('prototype');
		var index = collectionHolder.data('index');
		form = prototype.replace(/__name__/g, index);
		collectionHolder.data('index', index + 1);
		
		collectionHolder.append(form);
		 
		 console.log(index);
	}


	$('a.nuevo').live('click', function(event) {
		event.preventDefault();
		add(collectionHolder);
	});
});
