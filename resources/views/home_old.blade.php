@extends('layouts.app')

@section('content')

<style>
	html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
      #map {
        height: 100%;
      }
      #floating-panel {
        position: absolute;
        top: 10px;
        left: 25%;
        z-index: 5;
        background-color: #fff;
        padding: 5px;
        border: 1px solid #999;
        text-align: center;
        font-family: 'Roboto','sans-serif';
        line-height: 30px;
        padding-left: 10px;
      }
      #direct-control{
      	margin: 0 10px;
      	width: 30%;
      	background-color: #fff;
      	box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
      	font-family: Roboto;
        font-size: 15px;
        font-weight: 300;
      }
      #direct-control label{
      	width: 20%;
      	margin: 0 10px;
      }
      #direct-control input{
      	background-color: #fff;
        border-radius: 2px;
        border: 1px solid rgba(0, 0, 0, 0.1);
        box-sizing: border-box;
        
        height: 29px;
        
        margin-top: 10px;
        outline: none;
        padding: 0 11px 0 13px;
        text-overflow: ellipsis;
        width: 70%;
      }
      #direct-control input:focus {
        border-color: #4d90fe;
      }
      #direct-control button {
      	margin-left: 10px;
      	margin-top: 10px;
      }
</style>

<div id="app">
	<!--<google-maps name="map"></google-maps>-->
</div>
<!--<div id="floating-panel">
    <b>Start: </b>
    <input type="text" id="start" value="218 Bach Dang, Hai Chau, Da Nang, Viet Nam"/>
    <b>End: </b>
    <input type="text" id="end" value="Duong Van Nga, Nai Hien Dong, Son Tra, Da Nang"/>
    <input type="button" value="Submit" id="reloadMap"/>
    <hr/>
    <span id="infoDirections">...</p>
    </div>-->
    <div id="direct-control">
    	<div class="">
    		<label>From</label>
    		<input type="text" name="from" id="from" placeholder="Enter a location" />
    	</div>
    	<div class="">
    		<label>To</label>
    		<input type="text" name="to" id="to" placeholder="Enter a location" />
    	</div>
    	<div class="form-group">
    		<button class="btn btn-primary" type="button" id="direct-button">Chỉ đường</button>
    	</div>
    	<span id="infoDirections">...</p>
    </div>
   <div id="map"></div>


   <div id="infowindow-content" style="display: none;">
      <span id="place-name"  class="title"></span><br>
      Place ID <span id="place-id"></span><br>
      <span id="place-address"></span>
    </div>
@endsection
@section('scripts')
<script async defer src="//maps.googleapis.com/maps/api/js?libraries=places‌​&key=AIzaSyA0kXy7r6QF_I9nixVMeP1TbIZ3ERfWgYc&libraries=places"></script>
<script>
	var snappedCoordinates = [];
	var placeIdArray = [];
	function processSnapToRoadResponse(data) {
	  snappedCoordinates = [];
	  placeIdArray = [];
	  for (var i = 0; i < data.snappedPoints.length; i++) {
	    var latlng = new google.maps.LatLng(
	        data.snappedPoints[i].location.latitude,
	        data.snappedPoints[i].location.longitude);
	    snappedCoordinates.push({lat:data.snappedPoints[i].location.latitude, lng:data.snappedPoints[i].location.longitude});
	    placeIdArray.push(data.snappedPoints[i].placeId);
	  }
	}

	$(document).ready(function() {
        let map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: 10.764237, lng: 106.689597},
          zoom: 17
        });
        /*$.ajax({
        	url: 'https://roads.googleapis.com/v1/snapToRoads',
        	type: 'GET',

        	dataType: 'JSON',
        	data: {
        		key: 'AIzaSyA0kXy7r6QF_I9nixVMeP1TbIZ3ERfWgYc',
        		interpolate: true,
        		path: '10.7642593,106.6914468|10.761967,106.691753',
        	},
        })
        .done(data => {

        	processSnapToRoadResponse(data);
        	//console.log(snappedCoordinates);

        	var flightPath = new google.maps.Polyline({
	          path: snappedCoordinates,
	          geodesic: true,
	          strokeColor: '#FF0000',
	          strokeOpacity: 1.0,
	          strokeWeight: 4
	        });

	        flightPath.setMap(map);
       //  	for (var i = 0; i < Things.length; i++) {
       //  		var snappedPolyline = new google.maps.Polyline({
			    //   path: snappedCoordinates.slice(start + i, start + i + 2);,
			    //   strokeColor: 'red',
			    //   strokeWeight: 6
			    // });
			    // snappedPolyline.setMap(map);
			    // //polylines.push(snappedPolyline);
       //  	}
        })
        .fail(error => {
        	console.log(error);
        })
        .always(function() {
        	console.log("complete");
        });*/
        

  //       var marker = new google.maps.Marker({position: {lat:10.7642593,lng:106.6914468}});
		// marker.setMap(map);
		// marker = new google.maps.Marker({position: {lat:10.766141, lng:106.696404}});
		// marker.setMap(map);


		var geocoder = new google.maps.Geocoder;
        var infowindow = new google.maps.InfoWindow;


		

		//var latlng = {lat:10.7642593,lng:106.6914468};
		// geocoderLatLng(geocoder, map, infowindow, {lat:10.7642593,lng:106.6914468});
		// geocoderLatLng(geocoder, map, infowindow, {lat:10.761967, lng:106.691753});
		// 
		


		//var input = document.getElementById('from');
		map.controls[google.maps.ControlPosition.LEFT_TOP].push(document.getElementById('direct-control'));
        var autocompleteFrom = new google.maps.places.Autocomplete(document.getElementById('from'));
        var autocompleteTo = new google.maps.places.Autocomplete(document.getElementById('to'));
        //autocomplete.bindTo('bounds', map);

        

        //var infowindow = new google.maps.InfoWindow();
        //var infowindowContent = document.getElementById('infowindow-content');
        //infowindow.setContent(infowindowContent);
        // var marker = new google.maps.Marker({
        //   map: map
        // });
        // marker.addListener('click', function() {
        //   //infowindow.open(map, marker);
        // });

        // autocomplete.addListener('place_changed', function() {
        //   //infowindow.close();
        //   var place = autocomplete.getPlace();
        //   if (!place.geometry) {
        //     return;
        //   }

        //   if (place.geometry.viewport) {
        //     map.fitBounds(place.geometry.viewport);
        //   } else {
        //     map.setCenter(place.geometry.location);
        //     map.setZoom(17);
        //   }

        //   // Set the position of the marker using the place ID and location.
        //   marker.setPlace({
        //     placeId: place.place_id,
        //     location: place.geometry.location
        //   });
        //   marker.setVisible(true);

        //   //infowindowContent.children['place-name'].textContent = place.name;
        //   // infowindowContent.children['place-id'].textContent = place.place_id;
        //   // infowindowContent.children['place-address'].textContent = place.formatted_address;
        //   //infowindow.open(map, marker);
        // });
        
        var directionsService = new google.maps.DirectionsService;
        var directionsDisplay = new google.maps.DirectionsRenderer;
        directionsDisplay.setMap(map);
        document.getElementById('direct-button').addEventListener('click', () => calculateAndDisplayRoute(directionsService, directionsDisplay));
        // $('#direct-button').click(() => {
        // 	directionsService.route({
	       //    origin: document.getElementById('from').value,
	       //    destination: document.getElementById('to').value,
	       //    travelMode: google.maps.TravelMode.DRIVING
	       //  }, function(response, status) {
	       //    if (status === google.maps.DirectionsStatus.OK) {
	       //      directionsDisplay.setDirections(response);
	       //      //get direction info
	       //      var htmlReturn = '';
	       //      var route = response.routes[0];
	       //      htmlReturn += "Distance: <strong>" + route.legs[0].distance.text + "</strong>, Duration: <strong>" + route.legs[0].duration.text + "</strong>";
	       //      document.getElementById('infoDirections').innerHTML  = htmlReturn;
	       //    } else {
	       //      window.alert('Directions request failed due to ' + status);
	       //    }
	       //  });
        	
        // });
	});
function calculateAndDisplayRoute(directionsService, directionsDisplay) {
        directionsService.route({
          origin: document.getElementById('from').value,
          destination: document.getElementById('to').value,
          travelMode: google.maps.TravelMode.DRIVING,
        }, function(response, status) {
          if (status === google.maps.DirectionsStatus.OK) {
            directionsDisplay.setDirections(response);
            //get direction info
            var htmlReturn = '';
            var route = response.routes[0];
            htmlReturn += "Distance: <strong>" + route.legs[0].distance.text + "</strong>, Duration: <strong>" + route.legs[0].duration.text + "</strong>";
            document.getElementById('infoDirections').innerHTML  = htmlReturn;
          } else {
            window.alert('Directions request failed due to ' + status);
          }
        });
}
	let geocoderLatLng = (geocoder, map, infowindow, latlng) => {
		geocoder.geocode({'location': latlng}, function(results, status) {
			console.log(results);
          if (status === 'OK') {
            if (results[0]) {
              //map.setZoom(11);
              var marker = new google.maps.Marker({
                position: latlng,
                map: map
              });
              infowindow.setContent(results[0].formatted_address);
             // infowindow.open(map, marker);
              marker.addListener('mouseover', () => {
		          infowindow.open(map, marker);
		        });
              marker.addListener('mouseout', () => {
              	infowindow.close();
              });
            } else {
              window.alert('No results found');
            }
          } else {
            window.alert('Geocoder failed due to: ' + status);
          }
        });

        
	}

</script>
<!--<script>
	$(document).ready(function() {
		var directionsService = new google.maps.DirectionsService;
        var directionsDisplay = new google.maps.DirectionsRenderer;
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 14,
          center: {lat: 10.75, lng: 106.67}//10.771125, 106.673476
        });
        directionsDisplay.setMap(map);
 
        var onChangeHandler = function() {
         calculateAndDisplayRoute(directionsService, directionsDisplay);
        };
        document.getElementById('reloadMap').addEventListener('click', onChangeHandler);
         
        //calculateAndDisplayRoute(directionsService, directionsDisplay);


var flightPlanCoordinates = [//10.7448013,106.6408183
          {lat: 10.7438213, lng: 106.6428783},
          {lat: 10.7448013, lng: 106.6408183}
        ];
var flightPath = new google.maps.Polyline({
          path: flightPlanCoordinates,
          geodesic: true,
          strokeColor: '#FF0000',
          strokeOpacity: 1.0,
          strokeWeight: 2
        });
        flightPath.setMap(map);

$.ajax({
	url: 'https://roads.googleapis.com/v1/snapToRoads?interpolate=true&key=AIzaSyA0kXy7r6QF_I9nixVMeP1TbIZ3ERfWgYc&path=10.7448013,106.6408183|10.7438213,106.6428783',
	type: 'GET'
})
.done(function(data) {
	console.log(data);
})
.fail(function() {
	console.log("error");
})
.always(function() {
	console.log("complete");
});

	});
	function calculateAndDisplayRoute(directionsService, directionsDisplay) {
        directionsService.route({
          origin: document.getElementById('start').value,
          destination: document.getElementById('end').value,
          travelMode: google.maps.TravelMode.DRIVING
        }, function(response, status) {
          if (status === google.maps.DirectionsStatus.OK) {
            directionsDisplay.setDirections(response);
            //get direction info
            var htmlReturn = '';
            var route = response.routes[0];
            htmlReturn += "Distance: <strong>" + route.legs[0].distance.text + "</strong>, Duration: <strong>" + route.legs[0].duration.text + "</strong>";
            document.getElementById('infoDirections').innerHTML  = htmlReturn;
          } else {
            window.alert('Directions request failed due to ' + status);
          }
        });
      }

</script>-->
<!--<script>
	function initMap() {
        var directionsService = new google.maps.DirectionsService;
        var directionsDisplay = new google.maps.DirectionsRenderer;
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 7,
          center: {lat: 10.764237, lng: 106.689597},
        });
        directionsDisplay.setMap(map);
 
        var onChangeHandler = function() {
         calculateAndDisplayRoute(directionsService, directionsDisplay);
        };
        document.getElementById('reloadMap').addEventListener('click', onChangeHandler);
         
        calculateAndDisplayRoute(directionsService, directionsDisplay);
      }
 
      function calculateAndDisplayRoute(directionsService, directionsDisplay) {
        directionsService.route({
          origin: document.getElementById('start').value,
          destination: document.getElementById('end').value,
          travelMode: google.maps.TravelMode.DRIVING
        }, function(response, status) {
          if (status === google.maps.DirectionsStatus.OK) {
            directionsDisplay.setDirections(response);
            //get direction info
            var htmlReturn = '';
            var route = response.routes[0];
            htmlReturn += "Distance: <strong>" + route.legs[0].distance.text + "</strong>, Duration: <strong>" + route.legs[0].duration.text + "</strong>";
            document.getElementById('infoDirections').innerHTML  = htmlReturn;
          } else {
            window.alert('Directions request failed due to ' + status);
          }
        });
      }
</script>-->

<!--<script src="//maps.googleapis.com/maps/api/js?v=3&client=AIzaSyA0kXy7r6QF_I9nixVMeP1TbIZ3ERfWgYc" type="text/javascript"></script>-->
@endsection