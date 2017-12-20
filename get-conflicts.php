<?php
require 'scripts/db_init.php';
require 'scripts/functions.php';
print_r($_POST);
$bidderid = trim($_POST['bidderid']);
$bidderid = str_replace("-", "", $bidderid);

$Reply_Type = $_POST['Reply_Type'];
$str = "Thane,Navi Mumbai,Mumbai,Bangalore";
$arr = explode(",", $str);
$str = implode("%' or City like '%", $arr);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Check Bidder</title>
</head>
<body>
<table cellpadding="3" cellspacing="2" border="1" width="800">
<tr><td>
<form action="get-conflicts.php" name="bidders" method="post">
<table cellpadding="0" cellspacing="0" border="0"  width="800" >
<tr><td colspan="2" align="center"><strong>Check Conflicting</strong></td><td>Put Bidders ID</td><td><input type="text" name="bidderid" id="bidderid" value="<?php echo $bidderid; ?>"  /></td><td>Product</td><td><select name="Reply_Type"><option value="1" <?php if($Reply_Type==1) echo "selected"; ?>>PL </option><option value="2" <?php if($Reply_Type==2) echo "selected"; ?>>HL </option><option value="3" <?php if($Reply_Type==3) echo "selected"; ?>>CL </option><option value="4" <?php if($Reply_Type==4) echo "selected"; ?>>CC </option><option value="5" <?php if($Reply_Type==5) echo "selected"; ?>>LAP </option></select></td><td></td><td><input type="submit" name="submit" value="Submit" /></td></tr>
</table>
</form>
</td></tr>
<tr><td>
<table cellpadding="0" cellspacing="2" border="1"  width="800">
<?php 
echo $IP_Remote = $_SERVER["REMOTE_ADDR"];
if($IP_Remote=='192.124.249.12' || $IP_Remote=='185.93.228.12' || $IP_Remote=='185.93.230.12') { $IP= $_SERVER['HTTP_X_SUCURI_CLIENTIP']; }
else { $IP= $IP_Remote;	}

if($IP=="122.176.100.27" || $IP=="122.176.100.28" || $IP=="122.176.100.29" || $IP=="122.176.122.134" || $IP=="122.161.196.68" || $IP=="122.160.74.235" || $IP=="182.71.109.218")
{

$output = '';
$sql = "select * from `Bidders_List` where `BidderID` ='".$bidderid."'  and  `Reply_Type`='".$Reply_Type."'  ";
list($alreadyExist,$query)=MainselectfuncNew($sql,$array = array());
$myrowcontr = count($query)-1;
$Restrict_Bidder = $query[0]['Restrict_Bidder'];

//echo "<br>";
//if($Restrict_Bidder==1)
//{
	$City = $query[0]['City'];
	$Bidder_Name = $query[0]['Bidder_Name'];
	$Table_Name = $query[0]['Table_Name'];
	
	$BankID = $query[0]['BankID'];
	//$Reply_Type  = $query[0]['Reply_Type'];
	$Restrict_Bidder = $query[0]['Restrict_Bidder'];
	$Conflict_bidder = $query[0]['Conflict_bidder'];
	$arr = explode(",", $City);
	$city_list = implode("%' or City like '%", $arr);
	$finalCity = "(City like '%".$city_list."%')";
	 $proposedSql = "select * from Bidders_List where ".$finalCity." and Restrict_Bidder=1 and Reply_Type='".$Reply_Type."' and BankID='".$BankID."'";	
	list($proposedCount,$proposedQuery)=MainselectfuncNew($proposedSql,$array = array());
	$conBids = '';
	for($i=0;$i<$proposedCount;$i++)
	{
		$BidderID = $proposedQuery[$i]['BidderID'];
		$conBids[] = $BidderID;
	}
?>
<tr><td><?php echo $Bidder_Name;?></td><td><?php echo $Table_Name;?> (<?php echo $Reply_Type;?>) <?php if($Restrict_Bidder!=1)
{ echo "Disabled"; } ?></td></tr>
<tr><td>Conflicting Bidders (Already Defined)</td><td><?php echo $Conflict_bidder;?></td></tr>
<tr><td>Bidders in <?php echo $City; ?></td><td><?php echo implode(',',$conBids);?></td></tr>
<tr><td colspan="2">Conflicts Defined in Bidders</td></tr>
<tr><td colspan="3">
<table cellpadding="2" cellspacing="2" border="1"  width="800">
<tr><td>Bidders ID</td><td>Conflict</td><td>City List</td><td>Sequence</td><td>Lead Count</td><td>Bidders ID</td></tr>
<?php
$con_Bids = '';	
$color = '';
$stopBidders = '';
$ppColor ='';
	for($i=0;$i<$proposedCount;$i++)
	{
		//$stopBidders = '';
		$color = '';
		$ppColor ='';
		$BidderID = $proposedQuery[$i]['BidderID'];
		$Conflict_bidder = $proposedQuery[$i]['Conflict_bidder'];	
		$City = $proposedQuery[$i]['City'];	
		$Sequence_no = $proposedQuery[$i]['Sequence_no'];
		$BookKeeping_Sql = "SELECT sum(`BookLeadCount`) AS bidcount  FROM `Bidders_Book_Keeping` WHERE `BidderID` ='".$BidderID."' and BookProduct = '".$Reply_Type."'";
		list($BookKeepingCount,$rowcnt)=MainselectfuncNew($BookKeeping_Sql,$array = array());

		$CapLead_Count = $proposedQuery[$i]['CapLead_Count'];
	    $explodeCapLead_Count = explode(",", $CapLead_Count);
		
		if($explodeCapLead_Count[3]==$rowcnt[0]["bidcount"])
		{
			$color = 'style="background-color:#FFCC00"';
			$stopBidders[] = $BidderID;
		}
		$Define_PrePost ='';
		$getBidPPSql = "select Define_PrePost from Bidders where `BidderID` ='".$BidderID."'";
		list($getBidPPCount,$getBidPPQuery)=MainselectfuncNew($getBidPPSql,$array = array());
		$Define_PrePost = $getBidPPQuery[0]['Define_PrePost'];
		if($Define_PrePost=='PostPaid')
		{
			$ppColor ='style="background-color:#CCFF00"';
		}
?>
<tr <?php echo $color; ?>><td  <?php echo $ppColor; ?>><?php echo $BidderID;?></td><td><?php echo $Conflict_bidder;?></td><td><?php echo $City;?></td><td><?php echo $Sequence_no;?></td>
<td><? echo $explodeCapLead_Count[3]; ?> | <? echo $rowcnt[0]["bidcount"] ;?></td><td><?php echo $BidderID;?></td></tr>

<?php		
	}
?>
</table></td>


</tr>
<tr><td>&nbsp;</td></tr>
<tr><td align="right" colspan="2">
Stop Bidders- <?php 
//print_r($stopBidders);
$pieces = implode(",", $stopBidders);
echo $pieces;
?>

</td></tr>
<?php
//}
//else
//{
	//$output = 'Bidder is disabled';	
// }

}
else
{
	echo "not allowed";

}
?>
</table>
</td></tr>
</table>
</body>
</html>
