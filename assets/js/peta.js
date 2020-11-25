function updateMarkerPosition(latLng) {
    document.getElementById('lat').value = [latLng.lat()];
    document.getElementById('lng').value = [latLng.lng()];
  }

function initMap() {	
    var myOptions = {
      zoom: 11,
        scaleControl: true,
        center: {lat: -5.385338, lng: 105.269748},
      mapTypeId: google.maps.MapTypeId.ROADMAP
    };

    var map = new google.maps.Map(document.getElementById("map"),
        myOptions);

    // Create the search box and link it to the UI element.
  var input = document.getElementById('nama_jalan');
  var searchBox = new google.maps.places.SearchBox(input);

  // Bias the SearchBox results towards current map's viewport.
  map.addListener('bounds_changed', function() {
    searchBox.setBounds(map.getBounds());
  });

  var markers = [];
  // Listen for the event fired when the user selects a prediction and retrieve
  // more details for that place.
  searchBox.addListener('places_changed', function() {
    var places = searchBox.getPlaces();

    if (places.length == 0) {
      return;
    }

    // Clear out the old markers.
    markers.forEach(function(marker) {
      marker.setMap(null);
    });
    markers = [];

    // For each place, get the icon, name and location.
    var bounds = new google.maps.LatLngBounds();
    places.forEach(function(place) {
      document.getElementById('lat').value = place.geometry.location.lat();
      document.getElementById('lng').value = place.geometry.location.lng();
      var icon = {
        url: place.icon,
        size: new google.maps.Size(71, 71),
        origin: new google.maps.Point(0, 0),
        anchor: new google.maps.Point(0, 0),
        scaledSize: new google.maps.Size(25, 25)
      };

      var marker1 = new google.maps.Marker({
        map: map,
        title: place.name,
        position: place.geometry.location,
        draggable: true
      });
      
      google.maps.event.addListener(marker1, 'drag', function() {
      updateMarkerPosition(marker1.getPosition());
      });
      // Create a marker for each place.
      markers.push(marker1);
      
      if (place.geometry.viewport) {
        // Only geocodes have viewport.
        bounds.union(place.geometry.viewport);
      } else {
        bounds.extend(place.geometry.location);
      }
    });
    map.fitBounds(bounds);
  });

 }