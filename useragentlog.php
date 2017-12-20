<?php
$useragent = $_SERVER['HTTP_USER_AGENT'];
$counter = 0;
$getdetails="select id, useragent,counter From useragentlog Where useragent = '".$useragent."'";
list($alreadyExist,$myrow)=MainselectfuncNew($getdetails,$array = array());
$myrowcontr=count($myrow)-1;
if($alreadyExist>0)
{
	/*$id = $myrow[$myrowcontr]["id"];
	$existingcounter = $myrow[$myrowcontr]["counter"];
	$counter = $existingcounter +1;
	$Dated = ExactServerdate();
	$DataArray = array("Dated"=>$Dated, "counter"=>$counter);
	$wherecondition ="(id=".$id.")";
	Mainupdatefunc ('useragentlog', $DataArray, $wherecondition);*/
}
else
{
	$Dated = ExactServerdate();
	$dataInsert = array('useragent'=>$useragent, 'Dated'=>$Dated);	
	$ProductValue = Maininsertfunc ('useragentlog', $dataInsert);
}
//Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.157 UBrowser/5.5.8071.1206 Safari/537.36
//Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/49.0.2623.112 Safari/537.36
?>