<?php
require 'scripts/db_init.php';
require 'scripts/functions.php';

function filter_blank($var) 
{
        return !(empty($var) || is_null($var));
}

//var queryString = "?get_bank_name=" + get_bank_name +"&get_city=" + get_city + "&get_Reply_type=" + get_Reply_type ;

$get_bank_name = $_REQUEST['get_bank_name'];
$get_city = $_REQUEST['get_city'];
$get_Reply_type = $_REQUEST['get_Reply_type'];
$get_Other_City = $_REQUEST['get_Other_City'];

$exp_City = explode(",", $get_city);
$City = array_filter($exp_City, "filter_blank"); 
$city1 = implode("%' or City like '%",$City);
//$city1 = implode("','",$City);
//$conditionCity = "City in ('".$city1."')";
$conditionCity =  " (City like '%".$city1."%') ";

if(strlen($get_Other_City)>0)
{
	$exp_Other_City = explode(",", $get_Other_City);
	$Other_City = array_filter($exp_Other_City, "filter_blank"); 
	//$Other_City1 = implode("','",$Other_City);
	$Other_City1 = implode("%' or City like '%",$Other_City);
	//$conditionCity = "City in ('".$city1."','".$Other_City1."')";
	$conditionCity = " (City like '%".$city1."%' or City like '%".$Other_City1."%') ";
	
}

$selectSql = "select BidderID from Bidders_List where Restrict_Bidder =1 and ".$conditionCity." and Reply_type='".$get_Reply_type."' and BankID='".$get_bank_name."'";
//echo $selectSql;
//echo "<br>";
list($selectNum,$getrow)=MainselectfuncNew($selectSql,$array = array());
$cntr=0;

//$selectQuery = ExecQuery($selectSql);
$selectNum = mysql_num_rows($selectQuery);
$Bidder_ID="";
while($cntr<count($getrow))
   {
	$BidderID = $getrow[$cntr]['BidderID'];
	$Bidder_ID[] = $BidderID;
$cntr = $cntr+1;

}
$impBidders = implode(",",$Bidder_ID);

//echo count($Bidder_ID);
if((count($Bidder_ID)>0) && strlen($Bidder_ID[0])>0 )
{
	echo "<b>Conflict is defined.</b>";
}
else
{
	echo "<b>No Conflict For this.</b>";
}
?>
<input type="text" name="conflict_set" id="conflict_set" value="<?php echo $impBidders; ?>" readonly >