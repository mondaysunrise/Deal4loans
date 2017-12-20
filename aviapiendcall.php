<?php 
require 'scripts/db_init.php';
$CampaignID=$_REQUEST['campid'];
$ListID=$_REQUEST['listid'];
$Agent_Name=$_REQUEST['a_name'];
$AgentID=$_REQUEST['a_id'];
$RequestID=$_REQUEST['bimaid']; //RequestID
$LeadID=$_REQUEST['d_id']; // Dialler LeadID 
$Phone=$_REQUEST['mob'];
$Disposition=$_REQUEST['disposition'];
//$DOE=$_REQUEST['doe'];
$DOE= str_replace("%20", " ", $_REQUEST['doe']);
$url_data =implode(',', $_GET);


if(isset($RequestID) && isset($LeadID) && isset($Phone) && isset($Disposition) )
{
	$insertSql = "INSERT INTO Req_Dialler_Report (RequestID, LeadID, AgentID, Agent_Name, CampaignID, ListID, Phone, Disposition, DOE, date_created,DOE_String,url_data) VALUES ('".$RequestID."', '".$LeadID."', '".$AgentID."', '".$Agent_Name."', '".$CampaignID."', '".$ListID."', '".$Phone."', '".$Disposition."', '".$DOE."', Now(), '".$DOE."', '".$url_data."' )";

	//$insertSql = "INSERT INTO Req_Dialler_Report (RequestID, LeadID, AgentID, Agent_Name, CampaignID, ListID, Phone, Disposition, DOE, date_created,DOE_String) VALUES ('".$RequestID."', '".$LeadID."', '".$AgentID."', '".$Agent_Name."', '".$CampaignID."', '".$ListID."', '".$Phone."', '".$Disposition."', '".$DOE."', Now(),, '".$DOE."')";

	$result = d4l_ExecQuery($insertSql);
	$id = d4l_mysql_insert_id();
	$return = "inserted";
}
else
{
	$return = "error";
}
echo $return;
//?campid=1212&listid=1001&a_name=&a_id=&bimaid=1212121&d_id=121&mob=9953696361&disposition=ringing&doe=2017-10-30 16:30:09

//7891132131,INSURANCE,18,AD110220171705390225,2,1534958
?>
