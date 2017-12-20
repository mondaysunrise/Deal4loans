<?php
require 'scripts/db_init.php';
	//require 'scripts/functions.php';

$gethdfccompany="select * from pl_company_hdfc_test ";
//$gethdfccompany="select * from  pl_company_altest";
echo $gethdfccompany."<br><br>";
$gethdfccompanyresult = ExecQuery($gethdfccompany);
$i=0;
$cmp_type="";
while($row=mysql_fetch_array($gethdfccompanyresult))
{
	$company_name = $row["company_name"];
	//$comp_cat = $row["comp_cat"];
	$comp_cat = $row["hdfc"];
	$interest_rate_csa = $row["interest_rate_csa"];
	$processing_fee = $row["processing_fee"];
	$interest_rate_noncsa = $row["interest_rate_noncsa"];
	$prcessing_fee_noncsa = $row["prcessing_fee_noncsa"];
	
echo "<br><br>";
	//echo $getcompany='select * from pl_company_list where (company_name="'.$company_name.'")';
	echo $getcompany='select * from pl_company_hdfc where (company_name="'.$company_name.'")';
echo "<br><br>";
$getcompanyresult = ExecQuery($getcompany);
$grow=mysql_fetch_array($getcompanyresult);
	$recordcount = mysql_num_rows($getcompanyresult);
	$plcompanyid=$grow["id"];
	//$plcompanyid=$grow["plcompanyid"];
	if($plcompanyid>0)
	{
		//$plcompanyid=$grow["plcompanyid"];
		$plcompanyid=$grow["id"];
		echo $getup="update pl_company_hdfc set hdfc='".$comp_cat."',interest_rate_csa='".$interest_rate_csa."',processing_fee='".$processing_fee."',interest_rate_noncsa='".$interest_rate_noncsa."',prcessing_fee_noncsa='".$prcessing_fee_noncsa."' where (id=".$plcompanyid.")";
		//echo $getup="update pl_company_list set adityabirla='".$comp_cat."' where (plcompanyid=".$plcompanyid.")";
			$getupresult = ExecQuery($getup);
			echo "<br><br>";
	}
		else
	{
			//echo $getinst ="INSERT INTO pl_company_list (company_name,citibank) VALUE ('".$company_name."','".$comp_cat."')";
			echo $getinst ="INSERT INTO pl_company_hdfc (company_name, hdfc, interest_rate_csa, processing_fee, interest_rate_noncsa, prcessing_fee_noncsa) VALUE ('".$company_name."','".$comp_cat."', '".$interest_rate_csa."', '".$processing_fee."', '".$interest_rate_noncsa."', '".$prcessing_fee_noncsa."' )";
			ExecQuery($getinst);
			echo "<br><br>";
	}
}
?>
