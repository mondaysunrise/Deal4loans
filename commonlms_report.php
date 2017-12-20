<?php
//require 'scripts/session_check_online.php';
require 'scripts/db_init.php';
require 'scripts/functions.php';
$currentbidder=$_SESSION['BidderID'];
$Product_Type=$_REQUEST["product"];
$bidderid=$_REQUEST["bidderid"];
session_start();

?>
<html>

<head>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=WINDOWS-1252">
<title>Login</title>
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<link href="includes/style1.css" rel="stylesheet" type="text/css">
<link href="style.css" rel="stylesheet" type="text/css" />
<script language="javascript" type="text/javascript" src="scripts/datetime.js"></script>

<?php //include '~Top.php';?>
  <!-- End Main Banner Menu Panel -->
  <!-- Start Main Container Panel -->
    <div id="dvContentPanel">
   <div id="dvMaincontent">
 
   <table width="720" cellpadding="4" cellspacing="4" align="center">
<tr>
<td class="head1">Bidder ID</td>
    <td class="head1">Name</td>
	  <td class="head1">City</td>
	    
	  <?if($Product_Type==2) {?>
	     <td class="head1"> Property_Location</td>
		
		   <td class="head1"> Loan Amount</td><? } ?>
	  
     <td class="head1">Bidders Details</td>
	 <td class="head1">Bidders Allocated</td>
	  <td class="head1">No of days</td>
	  <td class="head1">Turn around time(Minutes)</td>
   </tr>
   <?
  
   $today_date=date('Y-m-d');
   $max_date=$today_date." 23:59:59";
   $min_date=$today_date." 00:00:00";
    //$max_date="2008-06-11 23:59:59";
   //$min_date="2008-06-11 00:00:00";

  //if($bidderid==732)
  // {
	  if($Product_Type==2)
	  {
	   $qry="SELECT *,TO_DAYS(Req_Loan_Home.Updated_Date) as uday,TO_DAYS(Req_Loan_Home.Dated)As cday,MINUTE(TIMEDIFF(Req_Loan_Home.Updated_Date,Req_Loan_Home.Dated)) as hourold from Req_Loan_Home LEFT OUTER JOIN Req_Feedback_HL ON Req_Feedback_HL.AllRequestID= Req_Loan_Home.RequestID AND Req_Feedback_HL.BidderID= ".$bidderid." and Req_Feedback_HL.Feedback='Send Now' WHERE (((Req_Loan_Home.Bidderid_Details IS NOT  NULL or Req_Loan_Home.Bidderid_Details!='')) and (Req_Loan_Home.Dated Between  '".($min_date)."' and '".($max_date)."' ) and Req_Feedback_HL.BidderID=".$bidderid.")";
		$qry=$qry.$FeedbackClause;
	  }
	  elseif($Product_Type==1)
	  {
		$qry="SELECT *,TO_DAYS(Req_Loan_Personal.Updated_Date) as uday,TO_DAYS(Req_Loan_Personal.Dated)As cday,MINUTE(TIMEDIFF(Req_Loan_Personal.Updated_Date,Req_Loan_Personal.Dated)) as hourold from Req_Loan_Personal LEFT OUTER JOIN Req_Feedback_PL ON Req_Feedback_PL.AllRequestID= Req_Loan_Personal.RequestID AND Req_Feedback_PL.BidderID= ".$bidderid." and Req_Feedback_PL.Feedback='Send Now' WHERE (((Req_Loan_Personal.Bidderid_Details IS NOT  NULL or Req_Loan_Personal.Bidderid_Details!='')) and (Req_Loan_Personal.Dated Between  '".($min_date)."' and '".($max_date)."' ) and Req_Feedback_PL.BidderID=".$bidderid.")";
		$qry=$qry.$FeedbackClause;
	  }
	   elseif($Product_Type==4)
	  {
		  if($bidderid==69 || $bidderid==936)
		  {
			  $qry="SELECT *,TO_DAYS(Req_Credit_Card.Updated_Date) as uday,TO_DAYS(Req_Credit_Card.Updated_Date)As cday,MINUTE(TIMEDIFF(Req_Credit_Card.Dated,Req_Credit_Card.Updated_Date)) as hourold from Req_Credit_Card LEFT OUTER JOIN icicilms_allocation ON icicilms_allocation.cc_requestID= Req_Credit_Card.RequestID AND icicilms_allocation.bidderid= ".$bidderid." and icicilms_allocation.icici_feedback='Send Now' WHERE (((Req_Credit_Card.Bidderid_Details IS NOT  NULL or Req_Credit_Card.Bidderid_Details!='')) and (Req_Credit_Card.Updated_Date Between  '".($min_date)."' and '".($max_date)."' ) and icicilms_allocation.bidderid=".$bidderid.")";
		  }
		  elseif($bidderid==4883)
		  {
			  $qry="SELECT *,TO_DAYS(Req_Credit_Card.Updated_Date) as uday,TO_DAYS(Req_Credit_Card.Updated_Date)As cday,MINUTE(TIMEDIFF(Req_Credit_Card.Dated,Req_Credit_Card.Updated_Date)) as hourold from Req_Credit_Card LEFT OUTER JOIN icicilms_allocation ON icicilms_allocation.cc_requestID= Req_Credit_Card.RequestID AND icicilms_allocation.bidderid= ".$bidderid." and icicilms_allocation.verifier_feedback='Send Now' WHERE (((Req_Credit_Card.Bidderid_Details IS NOT  NULL or Req_Credit_Card.Bidderid_Details!='')) and (Req_Credit_Card.Updated_Date Between  '".($min_date)."' and '".($max_date)."' ) and icicilms_allocation.bidderid=".$bidderid.")";
		  }
		  elseif($bidderid==5657 || $bidderid==5658 || $bidderid==6088)
		  {
			  $qry="SELECT RequestID, Name, City,TO_DAYS(Req_Credit_Card.Updated_Date) as uday,TO_DAYS(Req_Feedback_CC.last_updated) As cday,MINUTE(TIMEDIFF(Req_Feedback_CC.last_updated,Req_Credit_Card.Updated_Date)) as hourold from Req_Credit_Card LEFT OUTER JOIN Req_Feedback_CC ON Req_Feedback_CC.AllRequestID= Req_Credit_Card.RequestID AND Req_Feedback_CC.bidderid= ".$bidderid." and Req_Feedback_CC.Feedback='Process' WHERE ( (Req_Feedback_CC.last_updated='".$today_date."') and Req_Feedback_CC.bidderid=".$bidderid.")";		
		  }
		  elseif($bidderid==5633)
		  {
			  $qry="SELECT RequestID, Name, City,TO_DAYS(Req_Credit_Card.Updated_Date) as uday,TO_DAYS(Req_Feedback_CC.last_updated) As cday,MINUTE(TIMEDIFF(Req_Feedback_CC.last_updated,Req_Credit_Card.Updated_Date)) as hourold from Req_Credit_Card LEFT OUTER JOIN Req_Feedback_CC ON Req_Feedback_CC.AllRequestID= Req_Credit_Card.RequestID AND Req_Feedback_CC.bidderid in (5658,5657) and Req_Feedback_CC.Feedback='Process' WHERE ( (Req_Feedback_CC.last_updated='".$today_date."') and Req_Feedback_CC.bidderid in (5658,5657))";		
		  }
		  elseif($bidderid==6299)
		  {
			  $qry="SELECT * FROM Req_Credit_Card_Sms LEFT OUTER JOIN lead_allocate ON lead_allocate.AllRequestID=Req_Credit_Card_Sms.RequestID WHERE (( Req_Credit_Card_Sms.sendnow_date Between '".($min_date)."' and '".($max_date)."') and Req_Credit_Card_Sms.source='SMS_LeadNew'  AND lead_allocate.BidderID= '".$bidderid."' and Req_Credit_Card_Sms.Feedback='Process') ";
		  }
		   elseif($bidderid==6300)
		  {
			   $qry="SELECT * FROM Req_Credit_Card_Sms LEFT OUTER JOIN lead_allocate ON lead_allocate.AllRequestID=Req_Credit_Card_Sms.RequestID WHERE (( Req_Credit_Card_Sms.sendnow_date Between '".($min_date)."' and '".($max_date)."') and Req_Credit_Card_Sms.source='SMS_LeadNew'  AND lead_allocate.BidderID= '".$bidderid."' and Req_Credit_Card_Sms.Feedback='Process') ";
		  }
		  else
		  {
		$qry="SELECT *,TO_DAYS(Req_Credit_Card.Updated_Date) as uday,TO_DAYS(Req_Credit_Card.Updated_Date)As cday,MINUTE(TIMEDIFF(Req_Credit_Card.Dated,Req_Credit_Card.Updated_Date)) as hourold from Req_Credit_Card LEFT OUTER JOIN Req_Feedback_CC ON Req_Feedback_CC.AllRequestID= Req_Credit_Card.RequestID AND Req_Feedback_CC.BidderID= ".$bidderid." and Req_Feedback_CC.Feedback='Send Now' WHERE (((Req_Credit_Card.Bidderid_Details IS NOT  NULL or Req_Credit_Card.Bidderid_Details!='')) and (Req_Credit_Card.Updated_Date Between  '".($min_date)."' and '".($max_date)."' ) and Req_Feedback_CC.BidderID=".$bidderid.")";
		$qry=$qry.$FeedbackClause;
		  }
	  }
	   elseif($Product_Type==3)
	  {
		$qry="SELECT *,TO_DAYS(Req_Loan_Car.Dated) as uday,TO_DAYS(Req_Loan_Car.Updated_Date) As cday,MINUTE(TIMEDIFF(Req_Loan_Car.Dated,Req_Loan_Car.Updated_Date)) as hourold from Req_Loan_Car LEFT OUTER JOIN Req_Feedback_CL ON Req_Feedback_CL.AllRequestID= Req_Loan_Car.RequestID AND Req_Feedback_CL.BidderID= ".$bidderid." and Req_Feedback_CL.Feedback='Send Now' WHERE (((Req_Loan_Car.Bidderid_Details IS NOT  NULL or Req_Loan_Car.Bidderid_Details!='')) and (Req_Loan_Car.Updated_Date Between  '".($min_date)."' and '".($max_date)."' ) and Req_Feedback_CL.BidderID=".$bidderid.")";
		$qry=$qry.$FeedbackClause;
	  }
	   elseif($Product_Type==5)
	  {
		$qry="SELECT *,TO_DAYS(Req_Loan_Against_Property.Updated_Date) as uday,TO_DAYS(Req_Loan_Against_Property.Updated_Date)As cday,MINUTE(TIMEDIFF(Req_Loan_Against_Property.Dated,Req_Loan_Against_Property.Updated_Date)) as hourold from Req_Loan_Against_Property LEFT OUTER JOIN Req_Feedback_LAP ON Req_Feedback_LAP.AllRequestID= Req_Loan_Against_Property.RequestID AND Req_Feedback_LAP.BidderID= ".$bidderid." and Req_Feedback_LAP.Feedback='Send Now' WHERE (((Req_Loan_Against_Property.Bidderid_Details IS NOT  NULL or Req_Loan_Against_Property.Bidderid_Details!='')) and (Req_Loan_Against_Property.Updated_Date Between  '".($min_date)."' and '".($max_date)."' ) and Req_Feedback_LAP.BidderID=".$bidderid.")";
		$qry=$qry.$FeedbackClause;
	  }
	   elseif($Product_Type==10)
	  {
		  if($bidderid==5923 || $bidderid==5924)
		  {
			   $qry="SELECT sbiccoffersid AS RequestID, sbicc_name AS Name, sbicc_city AS City,TO_DAYS(sbi_ccoffers_directonsite.sbicc_dated) as uday,TO_DAYS(sbi_ccoffers_directonsite.sendnow_date) As cday,MINUTE(TIMEDIFF(sbi_ccoffers_directonsite.sendnow_date,sbi_ccoffers_directonsite.sbicc_dated)) as hourold from sbi_ccoffers_directonsite WHERE (sbi_ccoffers_directonsite.sendnow_date Between  '".($min_date)."' and '".($max_date)."')";		
		  }
	  }
	  else
	  {
		  echo "NO Data Available";
	  }
	//	$qry=$qry."group by Req_Loan_Home.Mobile_Number";
	//	$qry=$qry." LIMIT $startrow, $pagesize"; 
   /*}
   elseif($bidderid==460)
   {
	   $qry="SELECT *,TO_DAYS(Req_Loan_Home.Updated_Date) as uday,TO_DAYS(Req_Loan_Home.Dated)As cday,MINUTE(TIMEDIFF(Req_Loan_Home.Updated_Date,Req_Loan_Home.Dated)) as hourold from Req_Loan_Home LEFT OUTER JOIN Req_Feedback ON Req_Feedback.AllRequestID= Req_Loan_Home.RequestID AND Req_Feedback.BidderID= '460' and Req_Feedback.Feedback='Send Now' WHERE (((Req_Loan_Home.Bidderid_Details IS NOT  NULL or Req_Loan_Home.Bidderid_Details!='')) and (Req_Loan_Home.Dated Between  '".($min_date)."' and '".($max_date)."' ) and Req_Feedback.BidderID='460')";
		$qry=$qry.$FeedbackClause;
	//	$qry=$qry."group by Req_Loan_Home.Mobile_Number";
	}
   else
   {
	   $qry="SELECT *,TO_DAYS(Req_Loan_Home.Updated_Date) as uday,TO_DAYS(Req_Loan_Home.Dated)As cday,MINUTE(TIMEDIFF(Req_Loan_Home.Updated_Date,Req_Loan_Home.Dated)) as hourold from Req_Loan_Home LEFT OUTER JOIN Req_Feedback ON Req_Feedback.AllRequestID= Req_Loan_Home.RequestID AND Req_Feedback.BidderID= '812' and Req_Feedback.Feedback='Send Now' WHERE (((Req_Loan_Home.Bidderid_Details IS NOT  NULL or Req_Loan_Home.Bidderid_Details!='')) and (Req_Loan_Home.Dated Between  '".($min_date)."' and '".($max_date)."' ) and Req_Feedback.BidderID='812')";
		$qry=$qry.$FeedbackClause;
	//	$qry=$qry."group by Req_Loan_Home.Mobile_Number";
	//	$qry=$qry." LIMIT $startrow, $pagesize"; 

   }*/
   $result=d4l_ExecQuery($qry);

$recordcount = d4l_mysql_num_rows($result);

   if($recordcount>0)
		{
		while($row=d4l_mysql_fetch_array($result))
		{
			$request=$row["RequestID"];
			$Bidderid_Details=$row["Bidderid_Details"];
			//$newhour=$row["hournew"];
			$oldhour=$row["hourold"];
			
			$uday=$row["uday"];
			$cday=$row["cday"];
			$exactday=$cday-$uday;


			?>

		<tr>
		<td><? echo $bidderid;?></td>
			<td><? echo $row["Name"];?></td>
			<td><? echo $row["City"];?></td>
			
			<?if($Product_Type==2) {?>
			<td><?echo $row["Property_Loc"];?></td>			
			<td><?echo $row["Loan_Amount"];?></td><?}?>
			
			
		<td><?	// echo "first".$row["RequestID"];?></td>
			<td><? 
				$Biddername="";
			
		$biddername = "select  Bidder_Name from Bidders_List where BidderID in (".$Bidderid_Details.") AND Reply_Type =".$Product_Type;
		//echo $biddername;
	$bidderresult = d4l_ExecQuery($biddername);
	$numbidderresult = d4l_mysql_num_rows($bidderresult);
	if(($numbidderresult)>0)
			{
		while($row=d4l_mysql_fetch_array($bidderresult))
				{
			$Biddername[]=$row["Bidder_Name"];
				}
			}
			//echo $Biddername;
	//print_r($Biddername);
	echo implode(',', $Biddername);
	
	 ?>
			</td>
			 <td class="bodyarial11">
	 <?php 
		 
			 $BidderID="";
	// Manual Process
	//$BiddersChurn = "select  Bidder_Name LEFT OUTER JOIN Bidders_List ON Bidders_List.BidderID=Req_Feedback_Bidder1=1.BidderID and  from Req_Feedback_Bidder1 where  AllRequestID=".$request." and Reply_Type=2 ";
	$BiddersChurn="SELECT Bidder_Name FROM Req_Feedback_Bidder1 LEFT OUTER JOIN Bidders_List ON Bidders_List.BidderID = Req_Feedback_Bidder1.BidderID and Bidders_List.Reply_Type =".$Product_Type." WHERE AllRequestID = '".$request."' AND Req_Feedback_Bidder1.Reply_Type =".$Product_Type;
	//echo $BiddersChurn;
	$BiddersChurnSql = d4l_ExecQuery($BiddersChurn);
	$NumRowBiddersChurnSql = d4l_mysql_num_rows($BiddersChurnSql);
	while($newrow=d4l_mysql_fetch_array($BiddersChurnSql))
				{
			$BidderID[]=$newrow["Bidder_Name"];
				}
			
	//echo count($strShowBidders);?>
	<?
	echo implode(',', $BidderID);
		
	 ?>
	 
	 </td>
	
	<td class="bodyarial11"><?echo $exactday; ?></td>
	 <td class="bodyarial11">
	 <? 
	 echo $oldhour;?> </td>
<?	 }?>

</tr>
<tr><td colspan="9" class="bodyarial11"><b>Total leads sent Today:-</b><?php echo$recordcount;?></td></tr>

		<?}
	//if($recordcount>0)
	//{//}
   ?>

   <!--<table width="700" align="center" border="0" cellspacing="1" cellpadding="4">
 <form name="frmdownload" action="hllms_download.php" method="post">
   <tr>
     <td align="center">
	   <input type="hidden" name="qry1" value="<? echo $qry; ?>">
	    <input type="hidden" name="Product" value="<?// echo $Product_Type; ?>">
	 <input name="Submit2" type="submit" class="bluebutton" value="Export To Excel">
	 </td>
   </tr>
 </form>
 </table>-->
<?
	//}
   ?>
   </div>
   </div>
   </body>

</html>
