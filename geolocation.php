<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
$latitude = $_POST["latitude"];
$longitude = $_POST["longitude"];

 echo "Your Address: ".getAddress($latitude, $longitude);
}

   function getAddress($lat, $lon){
   $url  = "http://maps.googleapis.com/maps/api/geocode/json?latlng=".
            $lat.",".$lon."&sensor=false";
   $json = @file_get_contents($url);
   $data = json_decode($json);
  //print_r($data);
   $status = $data->status;
   $address = '';
   if($status == "OK"){
      $address = $data->results[0]->formatted_address;
	  //echo $address ="City";
	  $arrto = $data->results[0]->address_components[5];
	   $arrtot = $data->results[0]->address_components[3];
	   echo "<br><br>";
	 // print_r($arrto);
	  //echo "<br><br>";
	  //print_r($arrtot);
    }
   return $address;
  }
//  Lat: 28.593582100000003 Lon: 77.3266879

  # Call function
//  12.9667° N, 77.5667° E
 //echo getAddress("28.593582100000003", "77.3266");
  echo "<br><br>";
 // echo getAddress("12.9667", "77.5667");
?>
<!DOCTYPE html>
<html>
  <head>
 
    <script src="//code.jquery.com/jquery-1.4.2.min.js"></script>
    <script>
        jQuery(window).ready(function(){
            //jQuery("#btnInit").click(initiate_geolocation);
			if(jQuery("#latitude").val()=="" && jQuery("#longitude").val()=="")
		{
			initiate_geolocation();
		}
        });
 
        function initiate_geolocation() {
            navigator.geolocation.getCurrentPosition(handle_geolocation_query);
        }
 
        function handle_geolocation_query(position){
				document.getElementById('latitude').value=position.coords.latitude;
				document.getElementById('longitude').value=position.coords.longitude;
			  //alert('Lat: ' + position.coords.latitude + ' ' +
                  //'Lon: ' + position.coords.longitude);
        }
    </script>

  </head>
  <body>
 
    <div>
      <!--<button id="btnInit" >Find my location</button>-->
	  <form name="geolocation" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
	  <input type="hidden" name="latitude" id="latitude" >
	  <input type="hidden" name="longitude" id="longitude" >
	  <input type="submit" value="get address">
	  </form>
    </div> 

  </body>
</html>
