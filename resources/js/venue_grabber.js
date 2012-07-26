$(document).ready(function(){
	
	var usrLat = 0;
	var usrLong = 0;
	
	function getLocalVenues(lat, lon){
		$.ajax({
			url: _baseUrl+"venues/get_local/",
			data: {'lat':lat, 'lon':lon},
			type: 'POST',
			dataType:'JSON',
			success: function(data){
			console.log( data);
				var data = jQuery.parseJSON(data);
				for(var i = 0; i < data.response.venues.length; i++){
					var venue = data.response.venues[i];
					//console.log(venue);
					$('#venue_table tr:last').after('<tr><td><a href=shows/by_venue/'+venue.id+' >'+venue.name+'</a></td></tr>');
				}
			},
			error: function(data){
				console.log(data);
			}
		});
	}
	
	function geo_success(position) {
		 usrLat = position.coords.latitude;
		 usrLong = position.coords.longitude;
		 usrLat = (usrLat).toFixed(2);
		 usrLong = (usrLong).toFixed(2);
		 getLocalVenues(usrLat, usrLong);
		 //printLatLong(position.coords.latitude, position.coords.longitude);
	}
	 
	// The PositionError object returned contains the following attributes:
	// code: a numeric response code
	// PERMISSION_DENIED = 1
	// POSITION_UNAVAILABLE = 2
	// TIMEOUT = 3
	// message: Primarily for debugging. It's recommended not to show this error
	// to users.
	function geo_error(err) {
	    if (err.code == 1) {
	        error('The user denied the request for location information.')
	    } else if (err.code == 2) {
	        error('Your location information is unavailable.')
	    } else if (err.code == 3) {
	        error('The request to get your location timed out.')
	    } else {
	        error('An unknown error occurred while requesting your location.')
	    }
	}
	 
	// output lat and long
	function printLatLong(lat, long) {
	    $('body').append('<p>Lat: ' + lat + '</p>');
	    $('body').append('<p>Long: ' + long + '</p>');
	}
	 
	function error(msg) {
	    alert(msg);
	}
	
	// test for presence of geolocation
	if (navigator && navigator.geolocation) {
	    navigator.geolocation.getCurrentPosition(geo_success, geo_error);
	} else {
	    error('Geolocation is not supported.');
	}
});