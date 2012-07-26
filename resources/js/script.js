$(document).ready(function(){
	$('#addshow').submit(function(e){
		e.preventDefault();
			var request = $(this).serialize();
			$.ajax({
				type: "POST",
				url: _baseUrl+"shows/add_show",
				data: request,
				success: function(){
					alert('success');
				}
			});
			
		return false;
	});
	
	$('#band_name').keyup(function(event){
		var query = $(this).attr('value');
		if(query){
			$.ajax({
				type: "POST",
				url: _baseUrl+"bands/bandquery/"+query,
				success: function(data){
					console.log(data);
				}
			});
		}
	});
	
});