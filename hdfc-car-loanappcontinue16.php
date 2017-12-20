<?php
require 'scripts/db_init.php';
require 'scripts/functions.php';

//print_r($_GET);
$model = $_REQUEST['model'];
//$model = "Toyota";
if($model=="Nissan"){	$getCar = 'Nissan';	}
else if($model=="Mahindra") {	$getCar = 'Mahindra & Mahindra Ltd';	}
else if($model=="Renault") {	$getCar = 'Renault';	}
else if($model=="Tata") {	$getCar = 'Tata Motors Ltd';	}
else if($model=="Maruti") {	$getCar = 'Maruti Suzuki India Ltd';	}
else if($model=="Hyundai") {	$getCar = 'Hyundai Motors India Ltd';	}
else if($model=="Honda") {	$getCar = 'Honda Seil Cars India Ltd';	}
else if($model=="Toyota") {	$getCar = 'Toyota Kirlosker Motors Ltd';	}
else if($model=="Chevrolet") {	$getCar = 'Chevrolet';	}

else if($model=="Porsche") {	$getCar = 'Porsche';	}
else if($model=="Mercedes") {	$getCar = 'Mercedes';	}
else if($model=="Force") {	$getCar = 'Force';	}
else if($model=="Land Rover") {	$getCar = 'Land Rover';	}
else if($model=="Premier") {	$getCar = 'Premier';	}
else if($model=="Jaguar") {	$getCar = 'Jaguar';	}
else if($model=="Mitsubishi") {	$getCar = 'Mitsubishi Motors Ltd';	}

else if($model=="Ford") {	$getCar = 'Ford India Pvt Ltd';	}
else if($model=="Audi") {	$getCar = 'Audi';	}
else if($model=="Bmw") {	$getCar = 'Bmw';	}
else if($model=="Skoda") {	$getCar = 'Skoda Auto India Pvt Ltd';	}
else if($model=="Fiat") {	$getCar = 'Fiat India Automobiles Ltd';	}
else if($model=="Premier") {	$getCar = 'Premier';	}
else if($model=="Volvo") {	$getCar = 'Volvo Auto India Pvt. Ltd';	}
else if($model=="Hindustan Motors") {	$getCar = 'Hindustan Motors';	}
else if($model=="Volkswagen") {	$getCar = 'Volkswagen';	}

$getCarSql = "select hdfc_car_model,hdfc_car_name from hdfc_car_list_category where hdfc_car_manufacturer='".$getCar."' group by hdfc_car_model order by hdfc_car_model asc";
list($getCarNumRows,$getCarQuery)=MainselectfuncNew($getCarSql,$array = array());

if($model=="Land Rover")
{
	$model = "land-rover";
}
else if($model=="Hindustan Motors")
{
	$model = "hindustan-motors";
}
else
{ 
	$model = strtolower($model);
}
//echo '.';
//echo $model;
?>
<div class="<?php echo $model; ?>_menu_top_text_box" style="color:#FFFFFF; padding-top:70px;"><?php 
$carM = array(' Pvt Ltd', 'India Pvt. Ltd', 'Pvt. Ltd', 'Ltd');
echo str_replace($carM, "", $getCar);

 ?></div>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $getCar; ?></title>
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
<link rel="stylesheet" type="text/css" href="images/car_hdfc/carhdfcint.css"/>
<link rel="stylesheet" type="text/css" href="images/car_hdfc/carhdfc15.css"/>
<script type="text/javascript" src="js/dropdowntabs.js"></script>
<script type="text/javascript">
var bustcachevar=1 //bust potential caching of external pages after initial request? (1=yes, 0=no)
var loadedobjects=""
var rootdomain="http://"+window.location.hostname
var bustcacheparameter=""

function ajaxpage(url, containerid){
var page_request = false
if (window.XMLHttpRequest) // if Mozilla, Safari etc
page_request = new XMLHttpRequest()
else if (window.ActiveXObject){ // if IE
try {
page_request = new ActiveXObject("Msxml2.XMLHTTP")
} 
catch (e){
try{
page_request = new ActiveXObject("Microsoft.XMLHTTP")
}
catch (e){}
}
}
else
return false
page_request.onreadystatechange=function(){
loadpage(page_request, containerid)
}
if (bustcachevar) //if bust caching of external page
bustcacheparameter=(url.indexOf("?")!=-1)? "&"+new Date().getTime() : "?"+new Date().getTime()
page_request.open('GET', url+bustcacheparameter, true)
page_request.send(null)
}

function loadpage(page_request, containerid){
if (page_request.readyState == 4 && (page_request.status==200 || window.location.href.indexOf("http")==-1))
document.getElementById(containerid).innerHTML=page_request.responseText
}

function loadobjs(){
if (!document.getElementById)
return
for (i=0; i<arguments.length; i++){
var file=arguments[i]
var fileref=""
if (loadedobjects.indexOf(file)==-1){ //Check to see if this object has not already been added to page before proceeding
if (file.indexOf(".js")!=-1){ //If object is a js file
fileref=document.createElement('script')
fileref.setAttribute("type","text/javascript");
fileref.setAttribute("src", file);
}
else if (file.indexOf(".css")!=-1){ //If object is a css file
fileref=document.createElement("link")
fileref.setAttribute("rel", "stylesheet");
fileref.setAttribute("type", "text/css");
fileref.setAttribute("href", file);
}
}
if (fileref!=""){
document.getElementsByTagName("head").item(0).appendChild(fileref)
loadedobjects+=file+" " //Remember this object as being already added to page
}
}
}
</script>

<style>
.select-car-box{width:500px; height:20px; margin-left:200px; margin-top:50px; color:#000000; font-size:16px; font-family:Arial, Helvetica, sans-serif; font-weight:bold;}
</style>
</head>
<?php
if($model=="mercedes" || $model=="maruti" || $model=="tata")
{
?><body class="<?php //echo $model; ?>" style="width:800px; height:450px; overflow-y:hidden; overflow-x:hidden; border-radius:8px 8px 8px 8px; background-color:#000;" >
<?php
}
 else
 {
 ?>
 <body class="<?php //echo $model; ?>" style="width:800px; height:450px; background: #F5F5F5; border-radius:8px 8px 8px 8px; overflow-y:hidden; overflow-x:hidden;  background-color:#000;">
 <?php
 }
 ?>


           

<table width="723" border="0" style="height:450px;"  >
 <tr><td valign="top"><?php //echo str_replace($carM, "", $getCar); ?>
<table>
<tr>
<?php
$cardetails = $getCarQuery[0]['hdfc_car_model'];
$carM = array('Maruti ', 'Nissan ','Renault ', 'Honda ', 'Mahindra ', 'Toyota', 'Hyundai ', 'Tata ', 'Chevrolet ', 'Porsche ', 'Mercedes ', 'Force ', 'Land Rover ', 'Premier ', 'Jaguar ', 'Mitsubishi ', 'Ford ', 'Audi ', 'Bmw ', 'Skoda ', 'Fiat ', 'Volvo ', 'Volkswagen ','Indica ' );
//$carM = array('Mahindra ', 'Toyota', 'Hyundai ', 'Chevrolet ', 'Porsche ', 'Land Rover ', 'Premier ', 'Jaguar ', 'Mitsubishi ', 'Ford ', 'Audi ', 'Bmw ', 'Fiat ', 'Volvo ', 'Volkswagen ' );
for($i=0;$i<$getCarNumRows;$i++)
{
$count = $i%5;
$hdfc_car_model = $getCarQuery[$i]['hdfc_car_model'];
if((strlen(strpos($hdfc_car_model, "Volkswagen")) > 0) || (strlen(strpos($hdfc_car_model, "Mahindra")) > 0) || (strlen(strpos($hdfc_car_model, "Hyundai")) > 0) || (strlen(strpos($hdfc_car_model, "Toyota")) > 0) || (strlen(strpos($hdfc_car_model, "Chevrolet")) > 0) || (strlen(strpos($hdfc_car_model, "Land Rover")) > 0) || (strlen(strpos($hdfc_car_model, "Mitsubishi")) > 0) || (strlen(strpos($hdfc_car_model, "Renault")) > 0))
{
	$hdfc_car_model_display = str_replace($carM, "", $hdfc_car_model);
}
else if($hdfc_car_model=="Maruti WagonR" || $hdfc_car_model=="Maruti Grand Vitara"  || $hdfc_car_model=="Ford Endeavour" || $hdfc_car_model=="Porsche Boxster" || $hdfc_car_model=="Porsche Cayenne"  || $hdfc_car_model=="Porsche Cayman" || $hdfc_car_model=="Porsche Panamera")
{
	$hdfc_car_model_display = str_replace($carM, "", $hdfc_car_model);
}
else
{
		$hdfc_car_model_display = $hdfc_car_model;
}
//get Lowest Car
$getLowestSql = "select * from hdfc_car_list_category where hdfc_car_model = '".$hdfc_car_model."' order by hdfc_car_price asc LIMIT 0 , 1";
list($getDataNumRows,$getLowestQuery)=MainselectfuncNew($getLowestSql,$array = array());
$hdfc_car_name = $getLowestQuery[0]['hdfc_car_name'];
?>
      <td align="center" width="150" height="120"><table width="122"  border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td height="100" align="center" valign="middle"><a href="hdfc-car-loans-stage2.php?car_name=<?php echo $hdfc_car_name; ?>" style="font-size:16px; text-decoration:none;" target="_parent"><div id="<?php echo $model; ?>bgColor"><div class="<?php echo $model; ?>-body_text3" style="font-size:16px;"><br /><br /><?php echo ucfirst($hdfc_car_model_display); ?></div></div></a> </td></tr></table>


</td>
<?php
if($i!=0 && $count==4)
{
	echo "</tr><tr>";
}
}
?>
</tr></table>


</td></tr></table>


</body>
</html>