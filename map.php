<?php 
$GetCityInfo = GetCityIdCity($_REQUEST['city']);
$GetStateInfo = GetCityInfo($_REQUEST['state']);
$BankInfo = GetBankID($_REQUEST['bank']);
if($rowsqlIfsc['latitude']!="" and $rowsqlIfsc['longitude']!="")
	{
		$lattitude = $rowsqlIfsc['latitude'];
		$longitude = $rowsqlIfsc['longitude'];
		$Address = $rowsqlIfsc['address'];
	}
else if($_REQUEST['state']!="" and $_REQUEST['city']=="")
	{
		$lattitude = $GetStateInfo['city_latitude'];
		$longitude = $GetStateInfo['city_longitide'];
		$Address = $BankInfo['bank_name'];
	}
else if($_REQUEST['bank']!="" and $_REQUEST['state']=="" and $_REQUEST['city']=="")
	{
		
		$lattitude = "23.090700";
		$longitude = "78.706949";
		$Address = $BankInfo['bank_name'];
	}

else{
	$lattitude = $GetCityInfo['city_latitude'];
	$longitude = $GetCityInfo['city_longitide'];
	$Address = $BankInfo['bank_name'];
	}
?>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>

  <div id="map" style="width:100%; height: 305px;"></div> 
 <script type="text/javascript"> 

 var beaches = [
   ['<?php echo trim($Address);?>',<?php echo $lattitude;?>, <?php echo $longitude;?>, 1,],
 
 ];

 var map = new google.maps.Map(document.getElementById('map'), {
    zoom: 12,
    center: new google.maps.LatLng(<?php echo round($lattitude, 3); ?>, <?php echo round($longitude,3); ?>),
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