<?php
   ////////////////////////////////////////
   function db_connect(){
	$dbuser	= "d4lreplica"; 
	$dbserver= "localhost"; 
	$dbpass	= "iengeghhoquoo1Vo>";
	$dbname	= "deal4loans_primary_a"; 
	$conn = mysql_connect($dbserver, $dbuser, $dbpass) or die ('I cannot connect to the database because: ' . mysql_error());
	if($conn && mysql_select_db($dbname))
	    	return $conn;

	return (FALSE);
   }
   ///////////////////////////////////////
   function ExecQuery($sql){

	db_connect();

	/////////////////////////Return the resultset
	return (mysql_query($sql));
   }

//$gethdfccompany="select * from pl_company_list_test ";
$gethdfccompany="select * from  Req_Loan_Against_Property_Quicktest";
echo $gethdfccompany."<br><br>";
$gethdfccompanyresult = ExecQuery($gethdfccompany);
$count=array('464','400','435','484','439','469','425','456','454','498','455','400','447','455','495','454','395','435','485','469','498','453','456','424','454','455','510','437','455','455','495');

$i=1;
$t =0;
$h =10;
$r=1;
$cmp_type="";
$c=0;
$d=1;
while($row=mysql_fetch_array($gethdfccompanyresult))
{
	echo $d;
	echo "<br><br>";
if($i>30)
	{
	}
	if(strlen($i)<2)
		{
			$i= "0".$i;
		}
		else
		{
		$i= $i;}
	
	if($t>23)
	{
		$t=0;
	}
	else
	{
		if($t<10)
		{
			$t= "0".$t;
		}
		else
		{
		$t= $t;}
	}

	if($h>59)
	{
		$h=10;
	}
	else
	{
		$h= $h;
	}
	if($c>2)
	{
		$c=0;
	}
	else
	{
		$c= $c;
	}
	echo $count[$c];
	$Name = $row["Name"];
	$Mobile_Number = $row["Mobile_Number"];
	$City = $row["City"];
	$Age = $row["Age"];
	$Email = $row["Email"];
	$Net_Salary = $row["Net_Salary"];
	echo $Dated = "2010-12-".$i." ".$t.":".$h;
	

  $getinst ="INSERT INTO `Req_Loan_Against_Property_Quick_2010` (`Name`, `Mobile_Number`, `City`, `Age`, `Email`, `Net_Salary`, `source`, `Dated`, `Updated_Date`) VALUES ( '".$Name."', '".$Mobile_Number."', '".$City."', '".$Age."', '".$Email."', '".$Net_Salary."', 'SRC_DIRECT', '".$Dated."', '".$Dated."')";
			ExecQuery($getinst);

			echo "<br><br>";
			echo $count[$c];
			echo "<br><br>";
			echo "<br><br>";
	if($r>98)
	{
				$r=1;
		$i=$i+1;
		$c=$c+1;
	}
	$r=$r+1;
			$t=$t+1;
			
			
			$d=$d+1;
			$h=$h+1;

	}

?>
