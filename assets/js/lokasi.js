function updateMarkerPosition(latLng) {
    document.getElementById('lat').value = [latLng.lat()];
    document.getElementById('lng').value = [latLng.lng()];
  }
        var geocoder;
        var map;
        function initMap() {  
            geocoder = new google.maps.Geocoder();
            var latlng = new google.maps.LatLng(-5.385338, 105.269748);
            var mapOptions = {
                zoom: 15,
                center: latlng
              }
              map = new google.maps.Map(document.getElementById('map'), mapOptions);
            }

    function geocodeLokasi() {
  var address = document.getElementById('nama_jalan').value;
  geocoder.geocode( { 'address': address}, function(results, status) {
    if (status == google.maps.GeocoderStatus.OK) {
      map.setCenter(results[0].geometry.location);
      var marker = new google.maps.Marker({
          map: map,
          draggable: true,
          position: results[0].geometry.location          
      });
      google.maps.event.addListener(marker, 'dragend', function() {
      updateMarkerPosition(marker.getPosition());
      });
      var lat = results[0].geometry.location.lat();
      var lng = results[0].geometry.location.lng();
    } else {
      alert('Geocode was not successful for the following reason: ' + status);
    }
      document.getElementById("lat").value = lat;      
      document.getElementById('lng').value=lng;    
  });
}