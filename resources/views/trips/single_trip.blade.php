extends('base')
@section('content')
<div>
    <button class="btn"><i class="fa fa-home"></i></button> 
    <div>
        TRIP Details
    </div>
</div>
<div>
<span>{{$trip->requestTime}}</span>
<span>{{$trip->finalPrice}}</span>
</div>
<div>
    <div>
        PickUp Location: 
        <span id="pickup"> 
            {{$trip->pickUpLocation}}
        </span>
        <span>
            Start time: 
            {{$trip->tripStart}}
        </span>
    </div>
    <div>
        Dropoff Location: 
        <span id="dropoff">    
            {{$trip->dropOffLocation}}
        </span>
        <span>
            End time: 
            {{$trip->tripEnd}}
        </span>
    </div>
</div>
<div>
    <span>
        <img src='app_path()."/../public/images/trips/drivers_cars/{{$trip->driverCar}}"'/>
        <p>
            {{$trip->carModel}}
        <p>  
    </span>
    <span>
        <p>
            DISTANCE:   {{$trip->distance}}
        </p>
        <p>
            DURATION:   {{$trip->duration}}
        </p>
    </span>
    <span>
        <p>
            {{$trip->driverName}}
        </p>
        <img src='app_path()."/../public/images/trips/drivers_pictures/{{$trip->driverPicture}}"'/>
        <p>
            @php $rating = $trip->rate; @endphp  
            @foreach(range(1,5) as $i)
                        <span class="fa-stack" style="width:1em">
                            <i class="far fa-star fa-stack-1x"></i>

                            @if($rating >0)
                                @if($rating >0.5)
                                    <i class="fas fa-star fa-stack-1x"></i>
                                @else
                                    <i class="fas fa-star-half fa-stack-1x"></i>
                                @endif
                            @endif
                            @php $rating--; @endphp
                        </span>
            @endforeach
        </p>
    </span>
</div>  


<div id="map-canvas"> </div>


<script>

    let pickup = document.getElementById("pickup").innerText;
    let dropoff = document.getElementById("dropoff").innerText;

    let latOfPickUp; 
    let longOfPickUp; 

    let latOfDropOff; 
    let longOfDropOff; 

    function calcCoordsOfPickUp(place) {    
        var geocoder = new google.maps.Geocoder();
        geocoder.geocode( { 'address': place}, function(results, status) {
        var location = results[0].geometry.location;
        latOfPickUp = location.lat(); 
        longOfPickUp = location.long(); 
         // alert('LAT: ' + location.lat() + ' LANG: ' + location.lng());
        });
    }

    function calcCoordsOfDropOff(place) {    
        var geocoder = new google.maps.Geocoder();
        geocoder.geocode( { 'address': place}, function(results, status) {
        var location = results[0].geometry.location;
        latOfDropOff = location.lat(); 
        longOfDropOff = location.long(); 
        });
    }

    calcCoordsOfPickUp(pickup); 
    calcCoordsOfDropOff(dropoff); 

    function mapLocation() {
    var directionsDisplay;
    var directionsService = new google.maps.DirectionsService();
    var map;

    function initialize() {
        directionsDisplay = new google.maps.DirectionsRenderer();
        var pickupLocation = new google.maps.LatLng(latOfPickUp, longOfPickUp);
        var mapOptions = {
            zoom: 7,
            center: pickupLocation
        };
        map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
        directionsDisplay.setMap(map);
        google.maps.event.addDomListener(document.getElementById('routebtn'), 'click', calcRoute);
    }

    function calcRoute() {
        var start = new google.maps.LatLng(latOfPickUp, longOfPickUp);
        var end = new google.maps.LatLng(latOfDropOff, longOfDropOff);
                    /*
            var startMarker = new google.maps.Marker({
                        position: start,
                        map: map,
                        draggable: true
                    });
                    var endMarker = new google.maps.Marker({
                        position: end,
                        map: map,
                        draggable: true
                    });
            */
        var bounds = new google.maps.LatLngBounds();
        bounds.extend(start);
        bounds.extend(end);
        map.fitBounds(bounds);
        var request = {
            origin: start,
            destination: end,
            travelMode: google.maps.TravelMode.DRIVING
        };
        directionsService.route(request, function (response, status) {
            if (status == google.maps.DirectionsStatus.OK) {
                directionsDisplay.setDirections(response);
                directionsDisplay.setMap(map);
            } else {
                alert("Directions Request from " + start.toUrlValue(6) + " to " + end.toUrlValue(6) + " failed: " + status);
            }
        });
    }
    google.maps.event.addDomListener(window, 'load', initialize);
}

    mapLocation();
</script>

@endsection