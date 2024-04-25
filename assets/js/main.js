$(document).bind("contextmenu",function(e){
	return false;
});
$(window).on('beforeunload', function(){ alert ('Bye now')});
$(function(){
	$('#wizard').on('submit', (e) => {
		e.preventDefault();
		var formData = new FormData($('#wizard')[0]);
	});
});