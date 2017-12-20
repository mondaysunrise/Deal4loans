<?php
require 'scripts/session_check_online.php';
require 'scripts/db_init.php';
require 'scripts/functions.php';
//echo $BidderIDstatic;
$session_id=session_id();
if(isset($_POST['BidderIDstatic']) && strlen($_POST['BidderIDstatic'])>0 )
	{
		 $BidderIDstatic=$_REQUEST['BidderIDstatic'];
	}
	else
	{
		$BidderIDstatic=$BidderIDstatic;
	}
$session_id=session_id();
$qry1=$_POST["qry1"];
$qry2=$_POST["qry2"];

list($mindate, $mintime)=split(" ",$_POST["min_date"]);
list($maxdate, $maxtime)=split(" ",$_POST["max_date"]);
if(date("l")=="Monday")
	{
		$yesterday  = mktime(0, 0, 0, date("m")  , date("d")-2, date("Y"));
	}
else{
		 $yesterday  = mktime(0, 0, 0, date("m")  , date("d")-2, date("Y"));
	}
$daytwo=date('Y-m-d',$yesterday);
$datediffvarL= datevardiff($daytwo,$mindate);
if($datediffvarL<=2 && $datediffvarL>=0)
	{
		$datediffvar= datevardiff($mindate,$maxdate);
	}
else{
		$datediffvar=3;
	}
function datevardiff($firstTime,$lastTime)
	{
		$firstTime=strtotime($firstTime);
		$lastTime=strtotime($lastTime);
		$timeDiff = ($lastTime-$firstTime)/86400;
		return $timeDiff;
	}
$qry1=str_replace("\'", "'", $qry1);
$search_result=ExecQuery($qry1);
$exclusiveLead = '';
//Get Bidders from GlobalId
$QryBidId = "select BidderID from Bidders where Global_Access_ID like '%6252%' or Global_Access_ID like '%6253%' or Global_Access_ID like '%6290%' or Global_Access_ID like '%".$_SESSION['BidderID']."%'";
$BidIdQuery = ExecQuery($QryBidId);
$BdId = '';
while($rowBidId=mysql_fetch_array($BidIdQuery))
{
	$BdId[] = $rowBidId['BidderID'];
}
$AllBiddersID = implode(",",$BdId);
//echo $AllBiddersID."<br>";
$company_category = '';
while($row_result=mysql_fetch_array($search_result))
	{
		$company_category = '';
		$company_category = $row_result['company_category'];
		//Get FeedbackId and Biider Id from Req_Feedback_Bidder_PL
		$QryFdbkBidId = "select Feedback_ID, BidderID from Req_Feedback_Bidder_PL where AllRequestID='".$row_result['RequestID']."' AND BidderID IN (".$AllBiddersID.")";
		//echo	$QryFdbkBidId."<br>";
		$FdbkBidIdQuery = ExecQuery($QryFdbkBidId);
		$FdbkId ='';
		$BiddId = '';
		while($rowFdbkBidId=mysql_fetch_array($FdbkBidIdQuery))
		{
			$FdbkId .= $rowFdbkBidId['Feedback_ID'];
			$BiddId .= $rowFdbkBidId['BidderID'];
		}
	
		if( $qry2=="Req_Loan_Personal")
		{
			$uniqueid ="PL".$FdbkId."S".$BiddId;
			$qry1="insert into temp (session_id, unique_id, Feedback, add_comment, c_name, city) values ('".$session_id."','".$uniqueid."','".$row_result["Feedback"]."','".$row_result["comment_section"]."', '".$company_category."','".$row_result["City"]."')";
		//	echo $qry1."<br>";
			$result1=ExecQuery($qry1);
		}
		$company_category = '';
		
	}
//die();
if($qry2=="Req_Loan_Personal")
	{
		$qry="select unique_id AS ReferenceID, city, Feedback, add_comment as Comment,c_name as CompanyCategory from temp where session_id='".$session_id."' order by doe DESC ";
	}

	//Written by Dan Zarrella. Some additional tweaks provided by JP Honeywell
	//pear excel package has support for fonts and formulas etc.. more complicated
	//this is good for quick table dumps (deliverables)
	$header="";
	$data="";
	$result = ExecQuery($qry);
	//echo "fff".$qry."<br>";
	$num_rows = mysql_num_rows($result);
	$CountInsertSql = "insert into BidderDownloadCount (BidderID, BidderName, BidderProduct, BidderTable, BidderSession, NoofRecords, Dated, MinDate, MaxDate) values ('".$BidderIDstatic."', '".$_SESSION['UName']."', '".$_SESSION['ReplyType']."', '".$qry2."', '".$session_id."',  '".$num_rows."', Now(), '".$mindate."', '".$maxdate."') ";
	$CountInsertQuery  = ExecQuery($CountInsertSql);
	
	$count = mysql_num_fields($result);
	
	for ($i = 0; $i < $count; $i++){
		$header .= mysql_field_name($result, $i)."\t";
	}
	
	while($row = mysql_fetch_row($result)){
	  $line = '';
	  foreach($row as $value){
		if(!isset($value) || $value == ""){
		  $value = '"' . $value . '"' . "\t";
		}else{
	# important to escape any quotes to preserve them in the data.
		  $value = str_replace('"', '""', $value);
	# needed to encapsulate data in quotes because some data might be multi line.
	# the good news is that numbers remain numbers in Excel even though quoted.
		  $value = '"' . $value . '"' . "\t";
		}
		$line .= $value;
	  }
	  $data .= trim($line)."\n";
	}
	# this line is needed because returns embedded in the data have "\r"
	# and this looks like a "box character" in Excel
	  $data = str_replace("\r", "", $data);	
	
	# Nice to let someone know that the search came up empty.
	# Otherwise only the column name headers will be output to Excel.
	if ($data == "") {
	  $data = "\nrecords not found \n";
	}
	
	# This line will stream the file to the user rather than spray it across the screen
	header("Content-type: application/octet-stream");
	# replace excelfile.xls with whatever you want the filename to default to
	header("Content-Disposition: attachment; filename=data.xls");
	header("Pragma: no-cache");
	header("Expires: 0");
	echo $header."\n".$data;	
	//Delete data from the temp table
	$qry1="delete from `temp` where session_id='".$session_id."'";
	$result1 = ExecQuery($qry1);
?>
