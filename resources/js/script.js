$(document).ready(function(){
	$('#addshow').submit(function(e){
		e.preventDefault();
			var request = $(this).serialize();
			$.ajax({
				type: "POST",
				url: "http://localhost:8888/flamingtulips/shows/add_show",
				data: request,
				success: function(){
					alert('success');
				}
			});
			
		return false;
	});
	
});