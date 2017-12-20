<?php
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	
	

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
	$leadid = $_POST['leadid'];
	$Final_Bidder = $_REQUEST['Final_Bidder'];

	$Final_Bid = "";
		while (list ($key,$val) = @each($Final_Bidder)) { 
			$Final_Bid = $Final_Bid."$val,"; 
		} 

$Final_Bid = substr(trim($Final_Bid), 0, strlen(trim($Final_Bid))-1); //remove the final comma sign

echo $Final_Bid."<br>";

if(strlen($Final_Bid)>0)
		{
			$DataArray = array("Bidderid_Details"=>$Final_Bid, 'Allocated'=>'2');
			$wherecondition ="(RequestID = '".$leadid."')";
			Mainupdatefunc ('Req_Loan_Home', $DataArray, $wherecondition);
		}
}

?>
<html>
<body>
	<table>
		<tr>
			<td>Thanks your lead has been submitted..</td>
		</tr>
	</table>
</body>
</html>