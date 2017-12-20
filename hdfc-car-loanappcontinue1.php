<?php
require 'scripts/db_init.php';
require 'scripts/functions.php';

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

$getCarSql = "select hdfc_car_model from hdfc_car_list_category where hdfc_car_manufacturer='".$getCar."' group by hdfc_car_model order by hdfc_car_model asc";
list($getCarNumRows,$getCarQuery)=MainselectfuncNew($getCarSql,$array = array());

if($model=="Land Rover")
{
	$model = "landrover";
}
else
{ 
	$model = strtolower($model);
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $getCar; ?></title>
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
<link rel="stylesheet" type="text/css" href="images/car_hdfc/carhdfc.css"/>
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
?><body class="<?php echo $model; ?>" >
<?php
}
 else
 {
 ?>
 <body class="<?php echo $model; ?>" style="background: #F5F5F5;">
 <?php
 }
 ?>

<div class="<?php echo $model; ?>_menu_top_text_box"><?php 
$carM = array(' Pvt Ltd', 'India Pvt. Ltd', 'Pvt. Ltd', 'Ltd');
echo str_replace($carM, "", $getCar);

 ?></div>
<div class="<?php echo $model; ?>_center_box">
<div class="select-car-box">Select Your Car Model</div>
<div class="<?php echo $model; ?>-menu-section">
<div id="<?php echo $model; ?>-model-box" ><div style="margin-top:60px; font-family:Arial, Helvetica, sans-serif; font-size:17px; font-weight:bold;"><?php echo ucfirst($model); ?></div></div>
</div>
<div class="<?php echo $model; ?>-content">
<div id="<?php echo $model; ?>menu"> 
<ul>

           <?php
$cardetails = mysql_result($getCarQuery,0,'hdfc_car_model');
for($i=0;$i<$getCarNumRows;$i++)
{
$hdfc_car_model = $getCarQuery[$i]['hdfc_car_model'];
?>
<li>
<a class="<?php echo $model; ?>-body_text3" href="javascript:ajaxpage('getCarData.php?cardetails=<?php echo $hdfc_car_model; ?>&model=<?php echo $model; ?>', 'contentarea');" onmouseover="javascript:ajaxpage('getCarData.php?cardetails=<?php echo $hdfc_car_model; ?>&model=<?php echo $model; ?>', 'contentarea');"><?php echo $hdfc_car_model; ?></a></li>
<?php
}
?>
           
</ul>
</div>
</div>

<div class="<?php echo $model; ?>-content2" id="contentarea">

<?
 include $Content;?>

</div>
</div>



</body>
</html>