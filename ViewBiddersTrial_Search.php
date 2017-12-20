<?php
		require 'scripts/session_check_online.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	//print_r ($_POST);
//if(isset($_POST['Submit']))
  //{
  $bidder = $_POST['BidderName'];
  $location = $_POST['Location'];
  $product = $_POST['Product'];
  
  if($product == 0)
 		$sql = "SELECT * FROM Bidders_List WHERE `Restrict_Bidder`=1 and  Bidder_Name like '%$bidder%'  and City like '%$location%'";
 else
 		$sql = "SELECT * FROM Bidders_List WHERE `Restrict_Bidder`=1 and  Bidder_Name like '%$bidder%'  and City like '%$location%'  and Reply_Type ='$product'";		
 //}
   
	
	function getReqValue($pKey){
       $titles = array(
              '1'=> 'Personal Loan',
              '2'=>'Home Loan' ,
              '3'=>'Car loan' ,
              '4'=>'Credit Card',
              '5'=>'Loan Against Property' ,
       );

       foreach ($titles as $key=>$value)
           if($pKey==$key)
               return $value;

       return "";
  }
  
?>
<html>
<head>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<title>View Bidders Login Details</title>
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<link rel="stylesheet" type="text/css" href="css/menu.css">
<link rel="stylesheet" type="text/css" href="css/style.css">
<link href="includes/style.css" rel="stylesheet" type="text/css">
</head>
<body>
 <?php include '~TopBidder.php'; ?>
   
 <table width="660" border="0" cellpadding="4" cellspacing="1" class="blueborder" align="center">
 <form name="frmsearch" action="ViewBiddersTrial_Search.php" method="post">
   <tr>
     <td colspan="3" class="head1">Search</td>
     </tr>
   <tr>
     <td>&nbsp;</td>
     <td>&nbsp;</td>
	 <td>&nbsp;</td>
   </tr>
   <tr>
     <td width="33%"><strong>Loaction: </strong><br> <input name="Location" type="text" id="location" size="15" ></td>
     <td width="33%"><strong>Product: </strong><br>
        <select size="1" align="left"  name="Product"  class="style4">
		   <option value="">Search By</option>
		   <option value="1" >Personal Loan</option>
		   <option value="2" >Home Loan</option>
		   <option value="3" >Car loan</option>
		  <option value="4">Credit Card</option>
		   <option value="5">LAP</option>
			 </select> </td> <td width="33%"><strong>Bidder Name:</strong><br>
	   <input name="BidderName" type="text" id="BidderName" size="15" >
        </td>
   </tr>
   <tr>
     <td colspan="3" align="center"><input name="Submit" type="submit" class="bluebutton" value="submit" border="0"></td>
     </tr>
   </form>
 </table>
 <p>&nbsp;</p>
 
<?php
$today = date("Y-m-d");
$explodeToday = explode("-",$today);
$field_date =  $explodeToday[2];
$today_fielddate = "Date_".$field_date;
$yesterday  = mktime(0, 0, 0, date("m")  , date("d")-1, date("Y"));
$yesterdayDate = date("Y-m-d",$yesterday); 
$explodeYesterday = explode("-",$yesterdayDate);
$y_fielddate = $explodeYesterday[2];
$yesterday_fielddate = "Date_".$y_fielddate;
//echo $yesterday_fielddate= "Date_".$field_date-1;

//$sql = 'SELECT * FROM Bidders_List WHERE `Restrict_Bidder`=1';
$query = ExecQuery($sql);
$num_rows = mysql_num_rows($query);
echo "<br><table border='1' cellpadding=4 cellspacing=1 class='blueborder'  align='center'><tr color='Yellow'><td>Sl. No.</td><td width='20%' align='center'><strong>Product Name</strong></td><td width='20%' align='center'><strong>BidderName</strong></td><td width='20%' align='center'><strong>City</strong></td><td width='20%' align='center'><strong>Today's Login ($today)</strong></td><td width='20%' align='center'><strong>Yesterday's Login ($yesterdayDate)</strong></td><td width='20%' align='center'><strong>Login in Last 48Hrs</strong></td>";
for($i=0;$i<$num_rows;$i++)
{
	$Bid = mysql_result($query,$i,'BidderID');
	$Reply_Type = mysql_result($query,$i,'Reply_Type');
	$Bidder_Name = mysql_result($query,$i,'Bidder_Name');
	$City = mysql_result($query,$i,'City');
	$sql_inner = "SELECT * FROM `BiddersLoginDetails` WHERE BidderID =".$Bid; 
	$query_inner = ExecQuery($sql_inner);
	$query_innerNumRows = mysql_num_rows($query_inner);
	$todaydateCount = mysql_result($query_inner,0,$today_fielddate);
	$yesterdaydateCount = mysql_result($query_inner,0,$yesterday_fielddate);
	if($todaydateCount>0 || $yesterdaydateCount>0 )
		$durationValue = "Yes";
	else
		$durationValue = "No";
	$count = $i+1;
	
	if($todaydateCount>0)
		$today_date = $todaydateCount;
	else
		$today_date = 0;

	if($yesterdaydateCount>0)
		$yesterday_date = $yesterdaydateCount;
	else
		$yesterday_date = 0;
	$product_name = getReqValue($Reply_Type);
	//if($query_innerNumRows>0)
	//{
//	$Bidder_Name = mysql_result($query_inner,0,'Bidder_Name');
	echo "<tr><td>$count</td><td>$product_name($Bid)</td><td>$Bidder_Name</td><td><input type='textarea' value='$City' readonly></td><td>$today_date</td><td>$yesterday_date</td><td>$durationValue</td>";
	echo "<td></td></tr>";
	//}
}
echo '</table>';


?> <h3 class="bodyarial11">
   
   <?php include '~Bottom.php'; ?>
 </h3>
 
</body>

</html>