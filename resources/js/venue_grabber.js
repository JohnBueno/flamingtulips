var gmarkers = []; 

function addMarkers(venue, index){
	//create venue object
	//var venue = data.response.venues[i];
	
	//Add venue to table list
	$('#venue_table tr:last').after('<tr><td><a data-id="'+ index +'" href=shows/by_venue/'+venue.id+' >'+venue.name+'</a></td></tr>');

	//Set icon to blue for venue has shows and red for no shows
	var hasShowMarker = "http://maps.google.com/mapfiles/ms/icons/blue-dot.png";
	var noShowMarker = "http://maps.google.com/mapfiles/ms/icons/red-dot.png";
	
	var marker = noShowMarker;
	if(venue.future_shows.length > 0){
		marker = hasShowMarker;
	}
	
	//create new lat long for map marker
	var myLatlng = new google.maps.LatLng(venue.location.lat, venue.location.lng);
	
	//place marker on map at new lat and long
	var marker = new google.maps.Marker({
	      icon:marker,
	      position: myLatlng,
	      map: map,
	      title:venue.name  
	});
	
	gmarkers.push(marker);
	
	
	return marker;
}


function addInfoWindow(theMarker, i, data){
	
	google.maps.event.addListener(theMarker, 'click', (function(event, index) {
		return function(){
		infowindow.close();
		
		var content;
		var markerIndex = data.response.venues[index]
		
		//If venue has shows then show predicted rating for upcomming shows
		if(markerIndex.future_shows.length >0){
			$('#venue-rating').show();
			$('#band-rating').show();
			$('#shows').html('Next Show: ' + markerIndex.shows[0].name);
			var showRating = markerIndex.shows[0].rating;
			var venueRating = markerIndex.venue_rating;
			
			for(var i = 0; i < venueRating; i++){
				$('.venue-star-'+i).removeClass('icon-star-empty').addClass('icon-star');;
			}
			
			for(var i = 0; i < showRating; i++){
				$('.band-star-'+i).removeClass('icon-star-empty').addClass('icon-star');;
			}
		}else{
		//hide rating system
			$('#venue-rating').hide();
			$('#band-rating').hide();
			
			$('#shows').html('No shows scheduled');
		}
		
		$('#name').html(markerIndex.name);
		content = $('#infoHTML').html();
		
		infowindow.content = content
		infowindow.open(map,this);
		}
	})(theMarker,i));

}

function getLocalVenues(lat, lon){
	var newLatLng = new google.maps.LatLng(lat,lon);
	//set map center to new lat and long after find geo location runs
	
	map.setCenter(newLatLng);
	$.ajax({
		url: _baseUrl+"venues/get_local/",
		data: {'lat':lat, 'lon':lon},
		type: 'POST',
		dataType:'JSON',
		success: function(data){
	
			//Loop through venues and plot marker for each venue;
			var infoWindow;
			
			infowindow = new google.maps.InfoWindow({
				content: "holding..."
			});

			
			for(var i = 0; i < data.response.venues.length; i++){
			
				var marker = addMarkers(data.response.venues[i], i);
				
				addInfoWindow(marker, i, data);  
			
			}
		},
		//if ajax fails show error
		error: function(data){
			console.log(data);
		}
	});
}


//On success of find geo location place marker in current location
function geo_success(position) {
	 
	 var goldStar = {
	  path: 'M 125,5 155,90 245,90 175,145 200,230 125,180 50,230 75,145 5,90 95,90 z',
	  fillColor: "red",
	  fillOpacity: 0.8,
	  scale: .08,
	  strokeColor: "red",
	  strokeWeight: 1,
	  archor: (0, 0)
	};
	 
	 
	 usrLat = position.coords.latitude;
	 usrLong = position.coords.longitude;
	 usrLat = (usrLat).toFixed(2);
	 usrLong = (usrLong).toFixed(2);
	 getLocalVenues(usrLat, usrLong);
	 var myLatlng = new google.maps.LatLng(usrLat,usrLong);
	 var marker = new google.maps.Marker({
	       position: myLatlng,
	       map: map,
	       title:"Your Location",
	       icon:goldStar 
	 });
	 
	
	
	$.ajax({
		type: "POST",
		data: "lat=" + usrLat + "&long=" + usrLong,
		url: _baseUrl+"home/setMapCenter/",
		cache: false,
		success: function(html){
			//alert("success");	
		}
	});
	 
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

function venueHover(i) {	
  google.maps.event.trigger(gmarkers[i], "click");
}

$(document).ready(function(){
	var usrLat = 0;
	var usrLong = 0;
	//create an empty reference array for Markers
	
	//initialize all google maps and create map object.
	initialize();
	
	//Show Venue info window on hover
	$("#venue_table a").live({
			mouseenter:
				function()
				{
					venueHover($(this).attr('data-id'));
				},
				mouseleave:
				function()
				{
					infowindow.close();
				}
		});
		
	// test for presence of geolocation
	if (navigator && navigator.geolocation) {
	    navigator.geolocation.getCurrentPosition(geo_success, geo_error);
	} else {
	    error('Geolocation is not supported.');
	}
});