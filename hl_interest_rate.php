<?php
	require 'scripts/db_init.php';
	require 'scripts/functions.php';




	if ($_SERVER['REQUEST_METHOD'] == 'POST'){

	$loan_amount=trim($_REQUEST["loan_amount"]);
	$loan_tenure = trim($_REQUEST["loan_tenure"]);
	//echo $loan_tenure."<br>";
	//echo $loan_amount."";

$selectresult="select  bank_name,".$loan_amount.", prepayment_charges,processing_fee from `home_loan_interest_rate_chart` where  tenure='".$loan_tenure."' order by bank_name ASC";
echo "query2".$selectresult."<br>";
	 list($recordcount,$multiget)=MainselectfuncNew($selectresult,$array = array());
		$cntr=0;
	
	//$getbank_result=ExecQuery($selectresult);
	//$get=mysql_fetch_array($getbank_result);
	$msg="valid";
	}
	else
	{
		$selectgetresult="select  bank_name,upto_30lacs, prepayment_charges,processing_fee from `home_loan_interest_rate_chart` where  tenure='4' order by bank_name ASC";
		echo "query1".$selectgetresult."<br>";
	
	list($recordcount,$newmultiget)=MainselectfuncNew($selectgetresult,$array = array());
		$i=0;
	
	//$newgetbank_result=ExecQuery($selectgetresult);
	//$newget=mysql_fetch_array($newgetbank_result);
	$getmsg="valid";
	}
?>
<html>
<head>
</head>
<body>
<form name="hlinterest" action="<? echo $_SERVER['PHP_SELF'] ?>" method="POST">
<table>
<tr><td colspan="2">Fill details</td></tr>
<tr>
	<td>Loan Amount</td><td>
	<select name="loan_amount"> 
	<option value="PLease Select">PLease Select</option>
	<option value="upto_20lacs" <?if($loan_amount=="upto_20lacs" ) { echo "selected";}?>>Upto 20lacs</option>
	<option value="upto_30lacs" <?if($loan_amount=="upto_30lacs" ) { echo "selected";} elseif(!isset($msg)) {echo "selected";}?> >Above 20lacs to 30lacs</option>
	<option value="above_30lacs" <?if($loan_amount=="above_30lacs") { echo "selected";}?>>Above 30lacs to 75lacs</option>
	<option value="above_75lacs" <?if($loan_amount=="above_75lacs" ) { echo "selected";}?>>Above 75lacs to 1.5crores</option>
	</select>
</td>
</tr>
<tr>
	<td>Loan Tenure</td><td>
	<select name="loan_tenure"> 
	<option value="PLease Select">PLease Select</option>
	<option value="1" <?if($loan_tenure=="1") { echo "selected";}?>>Upto 5yrs</option>
	<option value="2" <?if($loan_tenure=="2") { echo "selected";}?>>From 5yrs to 10yrs</option>
	<option value="3" <?if($loan_tenure=="3") { echo "selected";}?>>From 10yrs to 15yrs</option>
	<option value="4" <?if($loan_tenure=="4") { echo "selected";} elseif(!isset($msg)) {echo "selected";}?>>From 15yrs to 20yrs</option>
	<option value="5" <?if($loan_tenure=="5") { echo "selected";}?>>From 20yrs to 25yrs</option>
	</select>
	</td>
</tr>
<tr>
	<td><input type="image" src="images/sbmt.gif"  style="border:0px;" value="submit" name="none" /></td>
</tr>
<?if($msg=="valid")
{?>

<tr><td>Bank Name</td><td>Interest rate</td><td>Processing Fee</td><td>Prepayment Charges</td></tr>
<?
			while($cntr<count($multiget))
       		 {
			
	?>
			<tr><td><? echo $multiget[$cntr]["bank_name"];?></td><td><? echo $multiget[$cntr][1];?></td><td><? echo $multiget[$cntr][2];?></td><td><? echo $multiget[$cntr][3];?></td></tr>
	<?	$cntr = $cntr + 1;}
}?>
<?if($getmsg=="valid" && (!isset($msg)))
{?>

<tr><td>Bank Name</td><td>Interest rate</td><td>Processing Fee</td><td>Prepayment Charges</td></tr>
<? 
			while($i<count($newmultiget))
       		 {
	?>
			<tr><td><? echo $newmultiget[$i]["bank_name"];?></td><td><? echo $newmultiget[$i][1];?></td><td><? echo $newmultiget[$i][2];?></td><td><? echo $newmultiget[$i][3];?></td></tr>
	<?	$i=$i+1;}
}?>

</table>
</form>
</body>
</html>