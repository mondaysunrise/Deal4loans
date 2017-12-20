<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>

  <div id="map" style="width:100%; height: 305px;"></div> 
 <script type="text/javascript"> 

 var beaches = [
   ['India',23.090700, 78.706949, 1,],
 
 ];

 var map = new google.maps.Map(document.getElementById('map'), {
    zoom: 12,
    center: new google.maps.LatLng(23.090, 78.706),
    mapTypeId: google.maps.MapTypeId.ROADMAP
 });

 var markers = [];

 var i, newMarker;

 for (i = 0; i < beaches.length; i++) {
   newMarker = new google.maps.Marker({
   position: new google.maps.LatLng(beaches[i][1], beaches[i][2]),
   map: map,
   title: beaches[i][0]
 });

 newMarker.category = beaches[i][3];
 newMarker.setVisible(true);

 markers.push(newMarker);
 }

  function displayMarkers(category) {
  var i;

 for (i = 0; i < markers.length; i++) {
   if (markers[i].category === category) {
     markers[i].setVisible(true);
   }
   else {
     markers[i].setVisible(true);
   }
 }
 }    

</script> 
