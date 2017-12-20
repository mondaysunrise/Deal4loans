<?php
	require 'scripts/db_init.php';
	require 'scripts/functions_nw.php';
	function getIST()
	{
		$GMT = time() - date("Z");
		$Time = gmdate($GMT + 3600*5.5);
		$getTime = $Time;
		return ($getTime);
	} 
	
	
	$maxDate = date("Y-m-d")." 07:50:00";
	
	$now = date("Y-m-d H:i:s");
	
	$now1 = date("Y-m-d H:i:s",getIST());
	echo $now." ----- ".$now1;
	echo "<br>";
	$mkTime = mktime(0, 0, 0, date("m")  , date("d")-1, date("Y"));

	$minDate = date("Y-m-d",$mkTime)." 17:10:00";

  	$city_List = "'Amritsar','Chandigarh','Jalandhar','Ludhiana','Lucknow','Delhi','Gaziabad','Sahibabad','Noida','Faridabad','Gurgaon','Greater Noida','Ranchi','Kolkata','Ahmedabad','Surat','Jaipur','Mumbai','Navi Mumbai','Thane','Pune','Chennai','Hyderbad','Vijaywada','Bangalore'";

$sql = "select * from fixed_deposit where city in (".$city_List.") and (dated between '".$minDate."' and '".$maxDate."' ) and sms_send!=1";
$query = ExecQuery($sql);
$num = mysql_num_rows($query);
echo $sql ; 
echo "<br>";
if($num>0)
{
$SMSMessage = "FD Lead: ";
for($i=0;$i<$num;$i++)
{
	$requestid = mysql_result($query,$i,'requestid');
	$Name =  mysql_result($query,$i,'name');
	$dob = mysql_result($query,$i,'dob');
	$age =  mysql_result($query,$i,'age');
	$city = mysql_result($query,$i,'city');
	$mobile_number =  mysql_result($query,$i,'mobile_number');
	$tenure = mysql_result($query,$i,'investment_duration');
	$amount_invest =  mysql_result($query,$i,'investment_amount');
	
	$counter = $i +1 ;
	$SMSMessage .= $counter.") : Name-".$Name.",Age-".$age.",Mob-".$mobile_no.",City-".$city.",Term-".$tenure.",Amt-".$amount_invest." ";
		
	echo $updateSql = "update fixed_deposit set sms_send=1 where requestid ='".$requestid."'";
	$updateQuery = ExecQuery($updateSql);
}

	$PhoneNumber = 9818996971;//Gaurav Jain 
//			$PhoneNumber = 9971396361;	
SendSMS($SMSMessage, $PhoneNumber);
}
?>