<?php
//ob_start();
require 'scripts/session_check_online.php';
require 'scripts/db_init.php';
require 'scripts/functions.php';

print_r($_POST);
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
	$BD_Manager= $_POST['BD_Manager'];
  }

/*if(isset($_POST['submit']))
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
	
	
}*/
?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="css/menu.css">
<link rel="stylesheet" type="text/css" href="css/style.css">
<link href="includes/style.css" rel="stylesheet" type="text/css">
</head>

<body>

 <?php include '~TopBidder.php'; ?>
 <br /><br />
 <form name="Enter_Multiplier" method="post" action="<? echo $_SERVER['PHP_SELF']; ?>">
 <table align="center" style="border:1px solid #0000CC;" width="200">
 <tr><td>BD Name</td><td><select name="BD_Manager" id="BD_Manager"><option name="">Please Select</option><? $bdsql = "SELECT BD_Manager FROM BD_List WHERE (1=1) order by BD_Manager ASC";
$bdquery = ExecQuery($bdsql); 
$bd_mag="";
while($bdrow=mysql_fetch_array($bdquery))
		{  $bd_mag[] = $bdrow["BD_Manager"]; ?>
			<option value="<? echo $bdrow["BD_Manager"]; ?>" <? if($BD_Manager==$bdrow["BD_Manager"]) { echo "Selected";} ?>><? echo $bdrow["BD_Manager"]; ?></option>
		<? }
?></select></td>
 </tr>
 <tr><td colspan="2" align="center"><input type="submit" value="submit" name="submit"></td></tr>
 </table>
 </form>
<?php
if(isset($_POST['submit']))
  {
	  
$sql = "SELECT Multiplier,Bidders.BidderID,Associated_Bank,Bidders.City,Bidders.Bidder_Name,BidderEmailID,BD_Name,Define_PrePost FROM Bidders LEFT OUTER JOIN Bidders_List ON Bidders_List.BidderID= Bidders.BidderID  WHERE (Bidders.Join_Date >='2010-01-01' and BD_Name like '%".$BD_Manager."%' and  Bidders.BidderID in (2389,2392,2394,2395)) order by Bidders.BidderID ASC";
//echo $sql;
$query = ExecQuery($sql);
$num_rows = mysql_num_rows($query);
if($num_rows>0)
	  { ?>
<table><tr><td>&nbsp;<br /><br /></td></tr></table>
<!--<form name="Enter_Multiplier" method="post" action="getbidderdeatails.php">-->
<table border="1">
<tr><td colspan=5>PLease provide the Details for the following Bidders</td></tr>
<tr color='Yellow'><td width='20%' align='center'><strong>BidderID</strong></td>
<td width='20%' align='center'><strong>BidderName</strong></td>
<td width='20%' align='center'><strong>AssociatedBank</strong></td>
<!--<td width='20%' align='center'><strong>Email ID</strong></td>-->
<td width='20%' align='center'><strong>Contact Number</strong></td>
<td width='20%' align='center'><strong>City</strong></td>
<td width='20%' align='center'><strong>Define Model</strong></td>
 <td width='20%' align='center'><strong>Enter CPL</strong></td>
  <td width='20%' align='center'><strong>BD Name</strong></td>
  <td>&nbsp;</td>
</tr>
<? 
for($i=0;$i<$num_rows;$i++)
{
	$Bid = mysql_result($query,$i,'BidderID');
	$Associated_Bankold  = mysql_result($query,$i,'Associated_Bank');
	$City = mysql_result($query,$i,'City');
	$Bidder_Nameold = mysql_result($query,$i,'Bidder_Name');
	$Multiplierold = mysql_result($query,$i,'Multiplier');
	$BidderEmailIDold =  mysql_result($query,$i,'BidderEmailID');
	$BD_Name =  mysql_result($query,$i,'BD_Name'); 
	$Define_PrePost =  mysql_result($query,$i,'Define_PrePost'); 

$blsql = "SELECT Reply_Type,Multiplier FROM Bidders_List WHERE (BidderID=".$Bid.")";
//$blquery = ExecQuery($sql);
//while($blrow=mysql_fetch_array($blquery))
//	{//
	echo getReqValue($blrow[Reply_Type]);
	

	?>
	<tr><td><?php echo $Bid; ?></td>
		<td><?php echo $Bidder_Nameold; ?></td>
	<td><?php echo $Associated_Bankold; ?></td>
		<td><?php echo $Contact_Numold; ?></td>
	<td ><?php echo $City; ?></td>
	<td><select name="DefinePrePost_<? echo $i;?>_<? echo $j; ?>" >
			 <option value="PostPaid" <?php if($Define_PrePost=='PostPaid') echo "selected"; ?>>PostPaid</option>
              <option value="PrePaid" <?php if($Define_PrePost=='PrePaid') echo "selected"; ?>>PrePaid</option>
             
              </select> </td>
	
	<td> <input name='Multiplier_<? echo $i;?>_<? echo $j; ?>' type='text' value='<?php echo $Multiplierold; ?>' size="5"> <input name='BidderID_<? echo $i;?>_<? echo $j; ?>' type='hidden' value='<?php echo $Bid; ?>'></td>
	<td><select name="GeneratedBy_<? echo $i;?>_<? echo $j; ?>" >

	<? for($r=0;$r<count($bd_mag);$r++)
		{ ?>
<option value="<? echo $bd_mag[$r];?>" <? if($BD_Manager==$bd_mag[$r]) echo "Selected"; ?>><? echo $bd_mag[$r];?></option>
		<? } ?>
</select> </td>
<td> <input type="button" name="save" value="Save"></td>
	</tr>
<?php
	//}
}
	  }
  }



//echo '<tr><td colspan="5" align="right"><input type="submit" value="submit" name="submit"></td></tr></table></form>';

?>
</table>
</body>
</html>
