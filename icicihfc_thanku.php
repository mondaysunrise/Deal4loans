<?php
require 'scripts/session_check.php';
require 'scripts/db_init.php';
require 'scripts/functions.php';
	
	$LeadID=$_REQUEST['id'];
	$ProductType = 2;
	$BiddersValue = 993;
	$Dated = ExactServerdate();
	 $checkSql = "select * from icicihfc_leads where RequestID='".$LeadID."' ";
	//$checkQuery = ExecQuery($checkSql);
	// $numRows = mysql_num_rows($checkQuery);

 list($numRows,$getrow)=MainselectfuncNew($checkSql,$array = array());
	
	if($numRows>0)
	{
	}
	else
	{
		//$InsertFeedBackSql = "Insert into Req_Feedback_Bidder1 (AllRequestID,BidderID,Reply_Type,Allocation_Date) Values ('$LeadID', '$BiddersValue','$ProductType', Now())";
				
				//echo "<br>".$InsertFeedBackSql."<br>";
		
$dataInsert = array("AllRequestID"=>$LeadID, "BidderID"=>$BiddersValue, "Reply_Type"=>$ProductType, "Allocation_Date"=>$Dated);
$table = 'Req_Feedback_Bidder1';
$insert = Maininsertfunc ($table, $dataInsert);
  
				
		//$InsertFeedBackResult = ExecQuery($InsertFeedBackSql);
		$BK_Year = date('Y');
		$BK_Month = date('m');
		$BK_Week = date('W');
		$BK_Day = date('d');
	   
		$BookKeepingSql = "select * from Bidders_Book_Keeping where BidderID=".$BiddersValue." and BookProduct=".$ProductType." and BookDate=".$BK_Day." and BookMonth=".$BK_Month." and BookYear=".$BK_Year."";
		 list($recordcount,$getrow)=MainselectfuncNew($BookKeepingSql,$array = array());
		$cntr=0;

		
		//$BookKeepingQuery = ExecQuery($BookKeepingSql);
	   
		$BookLeadCountExisting = $getrow[$cntr]['BookLeadCount'];
		$BookDate = $getrow[$cntr]['BookDate'];//added
		$BookMonth = $getrow[$cntr]['BookMonth'];//added
		$BookYear = $getrow[$cntr]['BookYear'];//added
	
		 if($BookLeadCountExisting>=1)
		 {
			 //Update
			$IncrementLeadCount = $BookLeadCountExisting + 1;
			//$UpdateBKSql = "update Bidders_Book_Keeping set BookLeadCount=".$IncrementLeadCount.", BookEntryTime = Now()  where BidderID = ".$BiddersValue." and BookDate = ".$BK_Day." and BookMonth=".$BK_Month." and BookYear =".$BK_Year." and BookProduct =".$ProductType."";
		   // ExecQuery($UpdateBKSql);
		   
		     $DataArray = array("BookLeadCount"=>$IncrementLeadCount, "BookEntryTime"=>$Dated);
		$wherecondition ="BidderID = ".$BiddersValue." and BookDate = ".$BK_Day." and BookMonth=".$BK_Month." and BookYear =".$BK_Year." and BookProduct =".$ProductType;
		Mainupdatefunc ('Bidders_Book_Keeping', $DataArray, $wherecondition);
		   
			//echo "<br>".$UpdateBKSql."<br>";
		 }
		 else
		 {
			//Insert
			$InitialCount = 1;
			//$InsertBKSql = "INSERT INTO Bidders_Book_Keeping ( BidderID , BookProduct , BookDate , BookWeek , BookMonth , BookYear , BookLeadCount, BookEntryTime ) VALUES (".$BiddersValue.", ".$ProductType.", ".$BK_Day.",".$BK_Week.", ".$BK_Month.", ".$BK_Year.", ".$InitialCount.",Now())";
		    //ExecQuery($InsertBKSql);
			
			$dataInsert = array("BidderID"=>$BiddersValue, "BookProduct"=>$ProductType, "BookDate"=>$BK_Day, "BookWeek"=>$BK_Week, "BookMonth"=>$BK_Month, "BookYear"=>$BK_Year, "BookLeadCount"=>$InitialCount, "BookEntryTime"=>$Dated);
$table = 'Bidders_Book_Keeping';
$insert = Maininsertfunc ($table, $dataInsert);
			
			//echo "<br>".$InsertBKSql."<br>";
		 }
	
		$captureLeadSql = "insert into icicihfc_leads (RequestID, Reply_Type,Dated) values ('".$LeadID."', '2',Now())";
		//ExecQuery($captureLeadSql);
		
		$dataInsert = array("RequestID"=>$LeadID, "Reply_Type"=>2, "Dated"=>$Dated);
		$table = 'icicihfc_leads';
		$insert = Maininsertfunc ($table, $dataInsert);
		
		//echo "<br>".$captureLeadSql."<br>";
	}
	
	$R_URL="Contents_Home_Loan_Mustread.php";
	if(strlen($R_URL)>0)
	{
		Header("Refresh: 5 URL=".$R_URL);
	}
	?>
<html>
<head>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Home Loan</title>
<meta name="keywords" content="Apply Personal Loans, Compare Personal Loans in Mumbai Hyderabad Pune kolkata Delhi Noida Bangalore">
<meta name="description" content="Apply Online Personal Loans through Deal4loans.com Get instant information on personal loans from all personal loan provider banks located in major cities of India like Mumbai, Delhi, Noida, Kolkata, Gurgaon, Bangalore, Ahmedabad, Chennai, Hyderabad, Navi Mumbai, Kochi etc. ">
<link href="includes/style1.css" rel="stylesheet" type="text/css">

<?php include '~Top.php';?>
<link href="style.css" rel="stylesheet" type="text/css" />

<div id="dvMainbanner">
<?php if ((($_REQUEST['flag'])!=1))
	{ ?>
   <?php include '~Upper.php';?><?php } ?>
  </div>
  <!-- End Main Banner Menu Panel -->
  <!-- Start Main Container Panel -->
  <div id="dvContentPanel">
   <div id="dvMaincontent">
      <table width="777"  border="1" cellspacing="0" cellpadding="0" height="300">
		<tr>
		<td align="center"><div style="Font-size:12px; font-family:Verdana, Arial, Helvetica, sans-serif; font-weight:bold; padding-bottom:10px; padding-top:10px;">Thanks for applying for ICICI HFC Home Loan through Deal4loans.com. <br> You would soon receive a call from ICICI HFC. </div>
</td>
			  
			  </tr>
			  </table>
   
	 </div>


  </div>
  <? if ((($_REQUEST['flag'])!=1))
	{ ?>
<?php include '~NewBottom.php';?><?php } ?>

  </body>
</html>