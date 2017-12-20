<?php
require 'scripts/db_init.php';
	require 'scripts/functions.php';
	session_start();
	$post=$_REQUEST['BidderID'];


	
?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="css/menu.css">
<link rel="stylesheet" type="text/css" href="css/style.css">
<link href="includes/style.css" rel="stylesheet" type="text/css">
<script>
function insertdropdown(id)
{
		var ni = document.getElementById(id);
		
		if(ni.innerHTML=="")
		{
		
				//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = '<td><select><option name="FollowUp">followup</option></select></td>';
				

			
		}
		
		return true;

	}
	</script>
<STYLE>
a
{
	cursor:pointer;

}
.bluebutton {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 11px;
	color: blue;
	font-weight: bold;
}</style>

</head>

<body >
<p align="center"><b> Lead Details </b></p>
<? $min_date = date('Y-m-d')." 00:00:00";
?>
<table style='border:1px dotted #9C9A9C;' height="80%" align="center">
<tr>	
	<td><b>Name</b></td>
	<td ><b>Email id</b></td>
	<td ><b>Mobile</b></td>
	<td><b>Employment Status</b></td>
	<td><b>Loan Amount</b></td>
	<td><b>Net Salary</b></td>
	
</tr>
<?php $qry="select RequestID,Name,Mobile_Number,Employment_Status,City,Loan_Amount,Email,DOB,Net_Salary from Req_Loan_Home LEFT OUTER JOIN Req_Feedback ON Req_Feedback.AllRequestID= Req_Loan_Home.RequestID AND Req_Feedback.BidderID= '".$post."' where Req_Feedback.Feedback in('FollowUp','Callback Later','PickUp') and Req_Feedback.Followup_Date >='".$min_date."'"; 
echo "dd".$qry;

 list($recordcount,$row)=MainselectfuncNew($qry,$array = array());
		$cntr=0;

//$result = ExecQuery($qry);
//$recordcount = mysql_num_rows($result);
$i=1;
if($recordcount>0)
		{
		while($i<count($row)-1)
        {
?>

</script>
<tr>	
	<td><? echo $row[$i]["Name"];?></td>
	<td ><? echo $row[$i]["Email"];?></td>
	<td ><? echo $row[$i]["Mobile"];?></td>
	<td><? echo $row[$i]["Employment_Status"];?></td>
	<td><? echo $row[$i]["Loan_Amount"];?></td>
	<td><? echo $row[$i]["Net_Salary"];?></td>
	<td><input type="checkbox" onClick="insertdropdown(<?echo$row["RequestID"];?>);"><div id="<? echo $row[$i]["RequestID"];?>"></div></td>

</tr>
<? $i=$i+1;
		}
		
		}
		?>

<?
function getJumpMenu($varPHPPage, $varRequestID, $varType, $varFeedback, $varpageon, $varmindate, $varmaxdate,$cmbfeedback)
{
	$strURL="";
	$strURL=$varPHPPage."?search=y&RequestID=".$varRequestID."&type=".$varType."&pageno=".$varpageon."&min_date=".urlencode($varmindate)."&max_date=".urlencode($varmaxdate)."&cmbfeedback=".urlencode($cmbfeedback);
?>
	<select name="type" id="type" onChange="MM_jumpMenu('parent',this,0);">
		<option value="<? echo $strURL.'&Feedback='?>" <? if($varFeedback == "") { echo "selected"; } ?>>No Feedback</option>
		<option value="<? echo $strURL.'&Feedback=FollowUp'?>" <? if($varFeedback == "FollowUp") { echo "selected"; } ?>>FollowUp</option>
		<option value="<? echo $strURL.'&Feedback=Not Eligible'?>" <? if($varFeedback == "Not Eligible") { echo "selected"; } ?>>Not Eligible</option>
		<option value="<? echo $strURL.'&Feedback=Not Interested'?>" <? if($varFeedback == "Not Interested") { echo "selected"; } ?>>Not Interested</option>
		<option value="<? echo $strURL.'&Feedback=Callback Later'?>" <? if($varFeedback == "Callback Later") { echo "selected"; } ?>>Callback Later</option>
		<option value="<? echo $strURL.'&Feedback=Wrong Number'?>" <? if($varFeedback == "Wrong Number") { echo "selected"; } ?>>Wrong Number</option>
		<option value="<? echo $strURL.'&Feedback=PickUp'?>" <? if($varFeedback == "PickUp") { echo "selected"; } ?>>PickUp</option>
		<option value="<? echo $strURL.'&Feedback=Ringing'?>" <? if($varFeedback == "Ringing") { echo "selected"; } ?>>Ringing</option>
	</select>


<?
}
?>
</table>
</body>
</html>