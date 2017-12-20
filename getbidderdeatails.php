<?php
ob_start();
require 'scripts/session_check_online.php';
require 'scripts/db_init.php';
require 'scripts/functions.php';
	require 'login_validation_bidders.php';

		$_SESSION['BidderID']='1674';

  function getReqValue($pKey){
    $titles = array(
       '1' => 'PL'  ,
		'2'=>'HL'  ,
		'3'=>'CL'  ,
		'4' =>'CC' ,
		 '5'=>'LAP' ,
		'6' =>'BL' ,
    );
    foreach ($titles as $key=>$value)
        if($pKey==$key)
        return $value;

    return "";
  }

if(isset($_POST['submit']))
{
	$Multiplier = $_POST['Multiplier'];
	$bid = $_POST['BidderID'];
	$Bidder_Name = $_POST['Bidder_Name'];
	$Associated_Bank = $_POST['Associated_Bank'];
	$BidderEmailID = $_POST['BidderEmailID'];
	$Address = $_POST['Address'];
	$Contact_Num = $_POST['Contact_Num'];
	$GeneratedBy = $_POST['GeneratedBy'];
	$BidderlistID = $_POST['BidderlistID'];
	$DefinePrePost = $_POST['DefinePrePost'];
	
	for($i=0;$i<count($bid);$i++)
	{
		$Updatesql = "update Bidders set Bidder_Name='".$Bidder_Name[$i]."', Associated_Bank='".$Associated_Bank[$i]."', BidderEmailID='".$BidderEmailID[$i]."', Address='".$Address[$i]."', Contact_Num='".$Contact_Num[$i]."', BD_Name = '".$GeneratedBy[$i]."', Define_PrePost = '".$DefinePrePost[$i]."'  where BidderID=".$bid[$i];
		$Updatequery = ExecQuery($Updatesql);
		//echo $Updatesql."<br>";
		if($Multiplier[$i]>1)
		{	
			$sql = "update Bidders_List set Multiplier='".$Multiplier[$i]."' where BidderID=".$bid[$i]." and Bidder_listID=".$BidderlistID[$i];
			$query = ExecQuery($sql);
		
		//	echo $sql."<br>";
		}
	}
	
	//header("location:thankuemail.php?msg=Details");
	
	
}
?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="css/menu.css">
<link rel="stylesheet" type="text/css" href="css/style.css">
<link href="includes/style.css" rel="stylesheet" type="text/css">
</head>

<body>
<div align="center">
 <?php include '~TopBidder.php'; ?>
 <br /><br />
<?php


//$sql = "SELECT * FROM Bidders_List WHERE `Restrict_Bidder`=1 order by BidderID";
$sql = "SELECT * FROM Bidders_List WHERE (1=1 and Dated >='2009-01-01' and Restrict_Bidder=1) order by BidderID";
$query = ExecQuery($sql);
$num_rows = mysql_num_rows($query);
?>
<table><tr><td>&nbsp;<br /><br /></td></tr></table>
<form name='Enter_Multiplier' method='post' action='getbidderdeatails.php'>
<table border=1>
<tr><td colspan=5>PLease provide the Details for the following Bidders</td></tr>
<tr color='Yellow'><td width='20%' align='center'><strong>BidderID</strong></td>
<!--<td width='20%' align='center'><strong>Username</strong></td>
<td width='20%' align='center'><strong>Password</strong></td>-->
<td width='20%' align='center'><strong>BidderName</strong></td>
<td width='20%' align='center'><strong>AssociatedBank</strong></td>
<td width='20%' align='center'><strong>Email ID</strong></td>
<!--<td width='20%' align='center'><strong>Address</strong></td>-->
<td width='20%' align='center'><strong>Contact Number</strong></td>
<td width='20%' align='center'><strong>City</strong></td>
<td width='20%' align='center'><strong>Define Model</strong></td>
 <td width='20%' align='center'><strong>Enter CPL</strong></td>
  <td width='20%' align='center'><strong>BD Name</strong></td>

<?php
for($i=0;$i<$num_rows;$i++)
{
	$Bid = mysql_result($query,$i,'BidderID');
	$Multiplierold = mysql_result($query,$i,'Multiplier');
	$Reply_Typeold = mysql_result($query,$i,'Reply_Type');
	

	$Bidder_listID = mysql_result($query,$i,'Bidder_listID');
	
	$sql_inner = "SELECT * FROM `Bidders` WHERE BidderID =".$Bid; 
	$query_inner = ExecQuery($sql_inner);
	$Bidder_Name = mysql_result($query_inner,0,'Bidder_Name');
	$Email = mysql_result($query_inner,0,'Email');
	$PWD = mysql_result($query_inner,0,'PWD');
	$Associated_Bankold  = mysql_result($query_inner,0,'Associated_Bank');
	$City = mysql_result($query_inner,0,'City');
	$Bidder_Nameold = mysql_result($query_inner,0,'Bidder_Name');
	$BidderEmailIDold =  mysql_result($query_inner,0,'BidderEmailID');
	$Contact_Numold =  mysql_result($query_inner,0,'Contact_Num');   
	$Addressold =  mysql_result($query_inner,0,'Address'); 
	$BD_Name =  mysql_result($query_inner,0,'BD_Name'); 
	$Define_PrePost =  mysql_result($query_inner,0,'Define_PrePost'); 
	?>
	<tr><td><?php echo $Bid; echo " (".getReqValue($Reply_Typeold).")"; ?></td>
		<td><input name='Bidder_Name[]' type='text' value='<?php echo $Bidder_Nameold; ?>' size="10"></td>
	<td><input name='Associated_Bank[]' type='text' value='<?php echo $Associated_Bankold; ?>' size="14"> </td>
	<td><input name='BidderEmailID[]' type='text' value='<?php echo $BidderEmailIDold; ?>'></td>
	<!--<td><input name='Address[]' type='text' value='<?php //echo $Addressold; ?>'></td>-->
	<td><input name='Contact_Num[]' type='text' size="10" value='<?php echo $Contact_Numold; ?>' maxlength="10"></td>
	<td><textarea rows="1"><?php echo $City; ?></textarea></td>
	<td><?php //echo $Define_PrePost; ?><select name="DefinePrePost[]" >
			 <option value="PostPaid" <?php if($Define_PrePost=='PostPaid') echo "selected"; ?>>PostPaid</option>
              <option value="PrePaid" <?php if($Define_PrePost=='PrePaid') echo "selected"; ?>>PrePaid</option>
             
              </select> </td>
	
	<td> <input name='Multiplier[]' type='text' value='<?php echo $Multiplierold; ?>' size="5"> <input name='BidderID[]' type='hidden' value='<?php echo $Bid; ?>'><input name='BidderlistID[]' type='hidden' value='<?php echo $Bidder_listID; ?>'></td>
	<td><select name="GeneratedBy[]" >
	<option value="Rakhi Bhadoria" <?php if($BD_Name=='Rakhi Bhadoria') echo "selected";?>>Rakhi Bhadoria</option>
	<option value="Anita Negi" <?php if($BD_Name=='Anita Negi') echo "selected";?>>Anita Negi</option>
	<option value="Balbir Singh" <?php if($BD_Name=='Balbir Singh') echo "selected";?>>Balbir Singh</option>
	<option value="Neha Singh" <?php if($BD_Name=='Neha Singh') echo "selected";?>>Neha Singh</option>
<option value="Neha Gupta" <?php if($BD_Name=='Neha Gupta') echo "selected";?>>Neha Gupta</option>
<option value="Namrata Medhi" <?php if($BD_Name=='Namrata Medhi') echo "selected";?>>Namrata Medhi</option>
<option value="Parveen Sayyed" <?php if($BD_Name=='Parveen Sayyed') echo "selected";?>>Parveen Sayyed</option>
<option value="Priyanka Sharma" <?php if($BD_Name=='Priyanka Sharma') echo "selected";?>>Priyanka Sharma</option>
<option value="Shweta Sharma" <?php if($BD_Name=='Shweta Sharma') echo "selected";?>> Shweta Sharma</option>
<option value="Sumiti Aggarwal" <?php if($BD_Name=='Sumiti Aggarwal') echo "selected";?>> Sumiti Aggarwal</option>
<option value="Vibhina Bhaskaran" <?php if($BD_Name=='Vibhina Bhaskaran') echo "selected";?>> Vibhina Bhaskaran</option>
<option value="Akansha" <?php if($BD_Name=='Akansha') echo "selected";?>>Akansha</option>

</select> </td>
	</tr>
<?php
}
echo '<tr><td colspan="5" align="right"><input type="submit" value="submit" name="submit"></td></tr></table></form>';

?>
</div>
</body>
</html>
