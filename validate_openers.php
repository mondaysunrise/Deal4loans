<?php
require 'scripts/db_init.php';
require 'scripts/db_init_bimadeal.php';



$mainqry="Select * from Req_Compaign Where (BidderID=1 and Bank_Name='openers base' and Reply_Type=100)";
$mainqryresult=ExecQuery($mainqry);
$main=mysql_fetch_array($mainqryresult);
//$RequestID="0";
echo $RequestID=$main["RequestID"];
//echo $RequestIDplus = $RequestID+100; 
//$RequestID="0";
echo "<br><br>";
echo $openersqry="Select openersid,TRIM(emailid) As emailid from openers_datacheck LIMIT ".$RequestID.",250";
$openersqryresult=ExecQuery($openersqry);
//$RequestID=20;
echo "counter: ".$i=$RequestID;
echo "<br><br>";
while($row=mysql_fetch_array($openersqryresult))
{
	echo "entered";
	$email=$row["emailid"];
	$openersid =$row["openersid"];
	echo "<br><br>";
	//PL
	 $openersplqry="Select RequestID,Updated_Date from Req_Loan_Personal Where ((Updated_Date between '2015-03-01 00:00:00' and '2015-08-20 23:59:59') and Email='".$email."') order by RequestID DESC limit 0,1 ";
	$openersplqryresult=ExecQuery($openersplqry);
	$plrow=mysql_fetch_array($openersplqryresult);
	$plrequestid = $plrow["RequestID"];
	$plUpdated_Date = $plrow["Updated_Date"];
	if($plrequestid>0)
	{
		$plupdateqry="Update openers_datacheck set plflag=1,pldated='".$plUpdated_Date."' Where (openersid=".$openersid.")";
		$plupdateqryresult=ExecQuery($plupdateqry);
	}

	echo "<br><br>";
	//HL
	 $openershlqry="Select RequestID,Updated_Date from Req_Loan_Home Where ((Updated_Date between '2015-05-20 00:00:00' and '2015-08-20 23:59:59') and Email='".$email."') order by RequestID DESC limit 0,1 ";
	echo "<br><br>";
	$openershlqryresult=ExecQuery($openershlqry);
	$hlrow=mysql_fetch_array($openershlqryresult);
	$hlrequestid = $hlrow["RequestID"];
	$hlUpdated_Date = $hlrow["Updated_Date"];
	if($hlrequestid>0)
	{
		 $hlupdateqry="Update openers_datacheck set hlflag=1,hldated='".$hlUpdated_Date."' Where (openersid=".$openersid.")";
		$hlupdateqryresult=ExecQuery($hlupdateqry);
	}
echo "<br><br>";
	//LI
	 $openersliqry="Select RequestID,Updated_Date from Req_Life_Insurance Where ((Updated_Date between '2014-08-19 00:00:00' and '2015-08-20 23:59:59')  and Email='".$email."') order by RequestID DESC limit 0,1 ";
	echo "<br><br>";
	$openersliqryresult=ExecQuery_bima($openersliqry);
	$lirow=mysql_fetch_array($openersliqryresult);
	$lirequestid = $lirow["RequestID"];
	$liUpdated_Date = $lirow["Updated_Date"];
	if($lirequestid>0)
	{
		 $liupdateqry="Update openers_datacheck set  liflag=1,lidated='".$liUpdated_Date."' Where (openersid=".$openersid.")";
		$liupdateqryresult=ExecQuery($liupdateqry);
	}
	echo "<br><br>";

	$i=$i+1;
}

echo "counter2: ".$i;
if($i>0)
{
	echo $upqry="Update Req_Compaign  set RequestID='".$i."' Where (BidderID=1 and Bank_Name='openers base' and Reply_Type=100)";
	$upqryresult=ExecQuery($upqry);
}
echo "<br><br>";
echo "Done";
?>