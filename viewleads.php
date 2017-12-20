<?php
require 'scripts/db_init.php';
require 'scripts/functions.php';
	session_start();
	$post=$_REQUEST['id'];
	$bidid =$_REQUEST['Bid'];
	$product =$_REQUEST['pro'];
		
?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="css/menu.css">
<link rel="stylesheet" type="text/css" href="css/style.css">
<link href="includes/style.css" rel="stylesheet" type="text/css">
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

<?php 
if($product=="Req_Loan_Home")
{
$qry="select Req_Loan_Home.Name,Req_Loan_Home.Landline,Req_Loan_Home.Std_Code,Req_Loan_Home.Residence_Address,Req_Loan_Home.Net_Salary,Req_Loan_Home.Landline_O,Req_Loan_Home.Std_Code_O,Req_Loan_Home.Mobile_Number,Req_Loan_Home.Employment_Status,Req_Loan_Home.City,Req_Loan_Home.Loan_Amount,Req_Loan_Home.Email,Req_Loan_Home.DOB,Req_Loan_Home.Sms_Sent,Req_Loan_Home.Email_Sent,Req_Feedback.Feedback,Req_Feedback.BidderID,Req_Feedback.Followup_Date from Req_Loan_Home LEFT OUTER JOIN Req_Feedback ON Req_Feedback.AllRequestID=`".$product."`.RequestID AND Req_Feedback.BidderID= '".$bidid."' where Req_Loan_Home.RequestID=$post "; 
}
elseif($product=="Req_Loan_Personal")
{

$qry="select Req_Loan_Personal.Name,Req_Loan_Personal.Landline,Req_Loan_Personal.Std_Code,Req_Loan_Personal.Residence_Address,Req_Loan_Personal.Net_Salary,Req_Loan_Personal.Landline_O,Req_Loan_Personal.Std_Code_O,Req_Loan_Personal.Mobile_Number,Req_Loan_Personal.Employment_Status,Req_Loan_Personal.City,Req_Loan_Personal.Loan_Amount,Req_Loan_Personal.Email,Req_Loan_Personal.DOB,Req_Loan_Personal.Sms_Sent,Req_Loan_Personal.Email_Sent,Req_Feedback.Feedback,Req_Feedback.BidderID,Req_Feedback.Followup_Date from Req_Loan_Personal LEFT OUTER JOIN Req_Feedback ON Req_Feedback.AllRequestID=`".$product."`.RequestID AND Req_Feedback.BidderID= '".$bidid."' where Req_Loan_Personal.RequestID=$post "; 

}
elseif($product=="Req_Loan_Car")
{
	$qry="select Req_Loan_Car.Name,Req_Loan_Car.Landline,Req_Loan_Car.Std_Code,Req_Loan_Car.Residence_Address,Req_Loan_Car.Net_Salary,Req_Loan_Car.Landline_O,Req_Loan_Car.Std_Code_O,Req_Loan_Car.Mobile_Number,Req_Loan_Car.Employment_Status,Req_Loan_Car.City,Req_Loan_Car.Loan_Amount,Req_Loan_Car.Email,Req_Loan_Car.DOB,Req_Feedback.Feedback,Req_Feedback.BidderID,Req_Feedback.Followup_Date from Req_Loan_Car LEFT OUTER JOIN Req_Feedback ON Req_Feedback.AllRequestID=`".$product."`.RequestID AND Req_Feedback.BidderID= '".$bidid."' where Req_Loan_Car.RequestID=$post "; 

}
elseif($product=="Req_Credit_Card")
{

$qry="select Req_Credit_Card.Name,Req_Credit_Card.Landline,Req_Credit_Card.Std_Code,Req_Credit_Card.Residence_Address,Req_Credit_Card.Net_Salary,Req_Credit_Card.Landline_O,Req_Credit_Card.Std_Code_O,Req_Credit_Card.Mobile_Number,Req_Credit_Card.Employment_Status,Req_Credit_Card.City,Req_Credit_Card.Loan_Amount,Req_Credit_Card.Email,Req_Credit_Card.DOB,Req_Credit_Card.Sms_Sent,Req_Credit_Card.Email_Sent,Req_Feedback.Feedback,Req_Feedback.BidderID,Req_Feedback.Followup_Date from Req_Credit_Card LEFT OUTER JOIN Req_Feedback ON Req_Feedback.AllRequestID=`".$product."`.RequestID AND Req_Feedback.BidderID= '".$bidid."' where Req_Credit_Card.RequestID=$post "; 
}
elseif($product=="Req_Loan_Against_Property")
{

$qry="select Req_Loan_Against_Property.Name,Req_Loan_Against_Property.Landline,Req_Loan_Against_Property.Std_Code,Req_Loan_Against_Property.Residence_Address,Req_Loan_Against_Property.Net_Salary,Req_Loan_Against_Property.Landline_O,Req_Loan_Against_Property.Std_Code_O,Req_Loan_Against_Property.Mobile_Number,Req_Loan_Against_Property.Employment_Status,Req_Loan_Against_Property.City,Req_Loan_Against_Property.Loan_Amount,Req_Loan_Against_Property.Email,Req_Loan_Against_Property.DOB,Req_Loan_Against_Property.Sms_Sent,Req_Loan_Against_Property.Email_Sent,Req_Feedback.Feedback,Req_Feedback.BidderID,Req_Feedback.Followup_Date from Req_Loan_Against_Property LEFT OUTER JOIN Req_Feedback ON Req_Feedback.AllRequestID=`".$product."`.RequestID AND Req_Feedback.BidderID= '".$bidid."' where Req_Loan_Against_Property.RequestID=$post "; 
}
elseif($product=="Req_Business_Loan")
{
	$qry="select  Req_Business_Loan.Name, Req_Business_Loan.Net_Salary, Req_Business_Loan.Mobile_Number,							 Req_Business_Loan.City,Req_Business_Loan.Loan_Amount,Req_Business_Loan.Email,Req_Business_Loan.DOB,  Req_Feedback.Feedback,Req_Feedback.BidderID,Req_Feedback.Followup_Date from Req_Business_Loan LEFT OUTER JOIN Req_Feedback ON Req_Feedback.AllRequestID= Req_Business_Loan.RequestID AND Req_Feedback.BidderID= '".$bidid."' where Req_Business_Loan.RequestID=$post "; 

}

//echo "dd".$qry;

 list($recordcount,$getrow)=MainselectfuncNew($qry,$array = array());
		$i=0;
//$result = ExecQuery($qry);

$Name = $getrow[$i]['Name'];
$Mobile = $getrow[$i]['Mobile_Number'];
$Landline = $getrow[$i]['Landline'];
$Landline_O = $getrow[$i]['Landline_O'];
$Std_Code = $getrow[$i]['Std_Code'];
$Std_Code_O = $getrow[$i]['Std_Code_O'];
$Net_Salary = $getrow[$i]['Net_Salary'];
$Residence_Address = $getrow[$i]['Residence_Address'];
$City = $getrow[$i]['City'];
$Employment_Status = $getrow[$i]['Employment_Status'];
$Loan_Amount = $getrow[$i]['Loan_Amount'];
$Email = $getrow[$i]['Email'];
$DOB = $getrow[$i]['DOB'];
$SMS = $getrow[$i]['SMS_Sent'];
$Email_Sent = $getrow[$i]['Email_Sent'];
//$Bidder_Flag = $getrow[$i]['Bidder_Flag '];
$followup_date = $getrow[$i]['Followup_Date'];
$Feedback = $getrow[$i]['Feedback'];
//echo "ff".$followup_date;
?>


<table style='border:1px dotted #9C9A9C;'width="600" height="80%" align="center">
<form name="loan_form" method="post" action="<? echo $_SERVER['PHP_SELF'] ?>?id=<?echo $post;?>" ><tr>	<td ><b>Name</b>
	</td>
	<td ><? echo $Name;?></td>
	
</tr>
<tr>
	<td ><b>Email id</b></td>
	<td ><?echo $Email;?></td>
</tr>
<tr>
	<td ><b>Mobile</b></td>
	<td ><?echo $Mobile;?></td>
</tr>
<tr>
	<td ><b>Other Contact No(Residence No.)</b></td>
	<td ><? echo $Std_Code; ?>-<?echo $Landline;?></td>
</tr>
<tr>
	<td ><b>Other Contact No(Office No.)</b></td>
	<td ><? echo $Std_Code_O; ?>-<?echo $Landline_O;?></td>
</tr>
<tr>
	<td><b>City</b></td>
	<td><?echo $City;?></textarea></td>
</tr>
<tr>
	<td><b>Employment Status</b></td>
	<td ><?if($Employment_Status==1){echo "Salaried";}else {"Self Employment";}?></td>
</tr>
<tr>
	<td ><b>Annual Income</b></td>
	<td ><?echo $Net_Salary;?></td>
</tr>
<tr>
	<td ><b>Residence Address</b></td>
	<td ><?echo $Residence_Address;?></td>
</tr>
<tr>
	<td><b>Loan Amount</b></td>
	<td ><?echo $Loan_Amount;?></td>
</tr>
<tr>
	<td><b>Feedback</b></td>
	<td ><?echo $Feedback;?></td>
</tr>
<tr>
	<td ><b>Follow Up Date</b></td>
	<td ><?echo $followup_date;?></td>
</tr>
<tr>
	<td><b>SMS Sent</b></td>
	<td ><?if($SMS == 1){echo "Yes";} else {echo "No";}	?></td></td>
</tr>
<tr>
	<td><b>Email Sent</b></td>
	<td ><?if($Email_Sent == 1){echo "Yes";} else {echo "No";}?></td>
</tr>

</table>
</body>
</html>