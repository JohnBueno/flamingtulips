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
	
	
	$('.rate_show').click(function(e){
		var rating = $(this).text();
		var show_id = $(this).attr('title');
		$.ajax({
			type: "POST",
			url: _baseUrl+"shows/rate_show",
			data: { rating: rating, show_id: show_id },
			success: function(d){
				console.log(d);
			}
		});
	});
	
	$("#band_name").autocomplete({
        source: _baseUrl+"bands/bandquery/",
        select: function(event, ui) {
        	
            //$('#state_id').val(ui.item.id);
            //$('#abbrev').val(ui.item.abbrev);
        },
        change: function(event, ui){
        	//autocomplete = _baseUrl+"bands/bandquery/";
        	console.log(ui);
        }
    });
	/*
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
	*/
});