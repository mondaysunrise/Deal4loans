<?php
require 'scripts/db_init.php';
require 'scripts/db_init_bima.php';
require 'scripts/functions.php';
require 'eligiblebidderfuncPL.php';
//require 'scripts/personal_loan_eligibility_function.php';
require 'scripts/personal_loan_eligibility_function_form.php';

//require 'neweligibilelist.php';

//	error_reporting();
	session_start();
	$post=$_REQUEST['id'];
	$min_date =$_REQUEST['to'];
	$max_date=$_REQUEST['from'];
	$bidid =$_REQUEST['Bid'];
	$fbidder_id = $_REQUEST["fbidder_id"];
//print_r($_SESSION);		
function DetermineAgeGETDOB ($YYYYMMDD_In)
{
  $yIn=substr($YYYYMMDD_In, 0, 4);
  $mIn=substr($YYYYMMDD_In, 4, 2);
  $dIn=substr($YYYYMMDD_In, 6, 2);

  $ddiff = date("d") - $dIn;
  $mdiff = date("m") - $mIn;
  $ydiff = date("Y") - $yIn;

  // Check If Birthday Month Has Been Reached
  if ($mdiff < 0)
  {
    // Birthday Month Not Reached
    // Subtract 1 Year From Age
    $ydiff--;
  } elseif ($mdiff==0)
  {
    // Birthday Month Currently
    // Check If BirthdayDay Passed
    if ($ddiff < 0)
    {
      //Birthday Not Reached
      // Subtract 1 Year From Age
      $ydiff--;
    }
  }
  return $ydiff;
}
		
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" type="text/css" href="css/menu.css">
<link rel="stylesheet" type="text/css" href="css/style.css">
<link href="includes/style.css" rel="stylesheet" type="text/css">
<script language="javascript" type="text/javascript" src="scripts/datetime.js"></script>
<script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
<script type="text/javascript" src="ajax.js"></script>
<script type="text/javascript" src="ajax-dynamic-pllist.js"></script>
<style type="text/css">
	
	/* START CSS NEEDED ONLY IN DEMO */
	
	#mainContainer{
		width:660px;
		margin:0 auto;
		text-align:left;
		height:100%;
		
		border-left:3px double #000;
		border-right:3px double #000;
	}
	#formContent{
		padding:5px;
	}
	/* END CSS ONLY NEEDED IN DEMO */
	
	
	/* Big box with list of options */
	#ajax_listOfOptions{
		position:absolute;	/* Never change this one */
		width:280px;	/* Width of box */
		height:160px;	/* Height of box */
		overflow:auto;	/* Scrolling features */
		border:1px solid #317082;	/* Dark green border */
		background-color:#FFF;	/* White background color */
    color: black;
		text-align:left;
		font-size:0.9em;
		z-index:100;
	}
	#ajax_listOfOptions div{	/* General rule for both .optionDiv and .optionDivSelected */
		margin:1px;		
		padding:1px;
		cursor:pointer;
		font-size:0.9em;
	}
	#ajax_listOfOptions .optionDiv{	/* Div for each item in list */
		
	}
	#ajax_listOfOptions .optionDivSelected{ /* Selected item in the list */
		background-color:#2375CB;
		color:#FFF;
	}
	#ajax_listOfOptions_iframe{
		background-color:#F00;
		position:absolute;
		z-index:5;
	}
	
	form{
		display:inline;
	}
	</style>
	
<script>

var ajaxRequest;  // The variable that makes Ajax possible!
		function ajaxFunction(){
			
			try{
				// Opera 8.0+, Firefox, Safari
				ajaxRequest = new XMLHttpRequest();
			} catch (e){
				// Internet Explorer Browsers
				try{
					ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
				} catch (e) {
					try{
						ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
					} catch (e){
						// Something went wrong
						alert("Your browser broke!");
						return false;
					}
				}
			}
		}
		
//Not in Use
		function getAppointment(i)
		{
			var lead_id = document.getElementById('lead_id').value;
			var feedback = document.getElementById('feedback_'+i).value;
			var FollowupDate = document.getElementById('FollowupDate_'+i).value;
			var bidder_id =  document.getElementById('bidder_id_'+i).value;
			var doa = document.getElementById('doa_'+i).value;
			var toa = document.getElementById('toa_'+i).value;
			var address =  document.getElementById('address_'+i).value;
			var fbidder_id =  document.getElementById('fbidder_id').value;

			if((lead_id!=""))
			{
				var queryString = "?lead_id=" + lead_id + "&feedback="+ feedback + "&FollowupDate=" + FollowupDate + "&bidder_id=" + bidder_id + "&i=" + i  + "&doa=" + doa  + "&toa=" + toa  + "&address=" + address + "&fbidder_id=" + fbidder_id  ;
				ajaxRequest.open("GET", "plappt.php" + queryString, true);
				// Create a function that will receive data sent from the server
				ajaxRequest.onreadystatechange = function(){
					if(ajaxRequest.readyState == 4)
					{
						
						var ajaxDisplay = document.getElementById('feeds');
						ajaxDisplay.innerHTML = ajaxRequest.responseText;
					}
				}
				ajaxRequest.send(null); 
			 }
		}

		
		function insertPLFeedback(i)
		{
			var lead_id = document.getElementById('lead_id').value;
			var feedback = document.getElementById('feedback_'+i).value;
			var comment = document.getElementById('comment_'+i).value;
			var FollowupDate = document.getElementById('FollowupDate_'+i).value;
			var bidder_id =  document.getElementById('bidder_id_'+i).value;
			var fbidder_id =  document.getElementById('fbidder_id').value;
			
			if((lead_id!=""))
			{
				var queryString = "?lead_id=" + lead_id + "&feedback="+ feedback + "&FollowupDate=" + FollowupDate + "&bidder_id=" + bidder_id + "&i=" + i  + "&comment=" + comment  + "&fbidder_id=" + fbidder_id ;
				ajaxRequest.open("GET", "plFeedback.php" + queryString, true);
				// Create a function that will receive data sent from the server
				ajaxRequest.onreadystatechange = function(){
					if(ajaxRequest.readyState == 4)
					{
						
						var ajaxDisplay = document.getElementById('feeds');
						ajaxDisplay.innerHTML = ajaxRequest.responseText;
					}
				}
				ajaxRequest.send(null); 
			 }
		}
		
		
		function getFollowupDate(i)
		{
			var lead_id = document.getElementById('lead_id').value;
			var feedback = document.getElementById('feedback_'+i).value;
			var FollowupDate = document.getElementById('FollowupDate_'+i).value;
			var bidder_id =  document.getElementById('bidder_id_'+i).value;
			var fbidder_id =  document.getElementById('fbidder_id').value;
			if((lead_id!=""))
			{
				var queryString = "?lead_id=" + lead_id + "&feedback="+ feedback + "&FollowupDate=" + FollowupDate + "&bidder_id=" + bidder_id + "&fbidder_id=" + fbidder_id  ;
				ajaxRequest.open("GET", "plFollowup.php" + queryString, true);
				// Create a function that will receive data sent from the server
				ajaxRequest.onreadystatechange = function(){
					if(ajaxRequest.readyState == 4)
					{
						
						var ajaxDisplay = document.getElementById('feeds');
						ajaxDisplay.innerHTML = ajaxRequest.responseText;
					}
				}
				ajaxRequest.send(null); 
			 }
		}

		function insertPLCusContact()
		{
			
		//	alert("Test");
			var lead_id = document.getElementById('lead_id').value;
			//alert(lead_id);
			var cus_contacted = document.getElementById('cus_contacted').value;
			//alert(feedback);
			var bidder_id =  document.getElementById('bidder_id_list').value;
			var fbidder_id =  document.getElementById('fbidder_id').value;
			if((lead_id!=""))
			{

				var queryString = "?lead_id=" + lead_id + "&cus_contacted="+ cus_contacted + "&bidder_id=" + bidder_id + "&fbidder_id=" + fbidder_id ;
				//alert(queryString); 
				ajaxRequest.open("GET", "plCustomerCall.php" + queryString, true);
				// Create a function that will receive data sent from the server
				ajaxRequest.onreadystatechange = function(){
					if(ajaxRequest.readyState == 4)
					{
						
						var ajaxDisplay = document.getElementById('feeds');
						ajaxDisplay.innerHTML = ajaxRequest.responseText;
					}
				}
				ajaxRequest.send(null); 
			 }
		}		function insertPLContact(i)
		{
			
			//alert("Test");
			var lead_id = document.getElementById('lead_id').value;
			
			var contacted = document.getElementById('contacted_'+i).value;
			//alert(feedback);
			var bidder_id =  document.getElementById('bidder_id_'+i).value;
			var fbidder_id =  document.getElementById('fbidder_id').value;
			//alert(lead_id);

			if((lead_id!=""))
			{

				var queryString = "?lead_id=" + lead_id + "&contacted="+ contacted + "&bidder_id=" + bidder_id + "&fbidder_id=" + fbidder_id ;
				//alert(queryString); 
				ajaxRequest.open("GET", "plContacts.php" + queryString, true);
				// Create a function that will receive data sent from the server
				ajaxRequest.onreadystatechange = function(){
					if(ajaxRequest.readyState == 4)
					{
						
						var ajaxDisplay = document.getElementById('feeds');
						ajaxDisplay.innerHTML = ajaxRequest.responseText;
					}
				}
				ajaxRequest.send(null); 
			 }
		}	window.onload = ajaxFunction;
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
<p align="center"><b>Personal loan Lead Details </b></p>
<?php 
$viewqry="select * from Req_Loan_Personal LEFT OUTER JOIN Req_Feedback ON Req_Feedback.AllRequestID=Req_Loan_Personal.RequestID and Req_Feedback.BidderID= '".$bidid."' where Req_Loan_Personal.RequestID=".$post." "; 
$REquestID = $post;

list($viewleadscount,$getrow)=MainselectfuncNew($viewqry,$array = array());
$cntr=0;
$Name = $getrow[$cntr]['Name'];
$Tataaig_Home=   $getrow[$cntr]['Tataaig_Home'];
$Tataaig_Health=   $getrow[$cntr]['Tataaig_Health'];
$Tataaig_Auto=   $getrow[$cntr]['Tataaig_Auto'];
$Accidental_Insurance =  $getrow[$cntr]['Accidental_Insurance'];
$Add_Comment=  $getrow[$cntr]['Add_Comment'];
$Mobile =  $getrow[$cntr]['Mobile_Number'];
$Landline =  $getrow[$cntr]['Landline'];
$Landline_O =  $getrow[$cntr]['Landline_O'];
$Std_Code =  $getrow[$cntr]['Std_Code'];
$Std_Code_O =  $getrow[$cntr]['Std_Code_O'];
$Net_Salary =  $getrow[$cntr]['Net_Salary'];
$Residential_Status =  $getrow[$cntr]['Residential_Status'];
$City =  $getrow[$cntr]['City'];
$City_Other =  $getrow[$cntr]['City_Other'];
$Is_Valid =  $getrow[$cntr]['Is_Valid'];
$Dated =  $getrow[$cntr]['Dated'];
$Employment_Status =  $getrow[$cntr]['Employment_Status'];
$Loan_Amount =  $getrow[$cntr]['Loan_Amount'];
$Email =  $getrow[$cntr]['Email'];
$Contactable =  $getrow[$cntr]['Contactable'];
$source =  $getrow[$cntr]['source'];
$Loan_Any =  $getrow[$cntr]['Loan_Any'];
$Pincode =  $getrow[$cntr]['Pincode'];
$SentEmail =  $getrow[$cntr]['SentEmail'];
$Emi_Paid =  $getrow[$cntr]['Emi_Paid'];
$CC_Holder =  $getrow[$cntr]['CC_Holder'];
$Card_Vintage =  $getrow[$cntr]['Card_Vintage'];
$followup_date =  $getrow[$cntr]['Followup_Date'];
$Feedback =  $getrow[$cntr]['Feedback'];
$CC_Mailer =  $getrow[$cntr]['CC_Mailer'];
$Company_Name =  $getrow[$cntr]['Company_Name'];
$PL_EMI_Amt =  $getrow[$cntr]['PL_EMI_Amt'];
$Card_Limit =  $getrow[$cntr]['Card_Limit'];
$Salary_Drawn =  $getrow[$cntr]['Salary_Drawn'];
$Landline_Connection =  $getrow[$cntr]['Landline_Connection'];
$Mobile_Connection =  $getrow[$cntr]['Mobile_Connection'];
$Total_Experience =  $getrow[$cntr]['Total_Experience'];
$Years_In_Company =  $getrow[$cntr]['Years_In_Company'];
$DOB =  $getrow[$cntr]['DOB'];
//$Company_Name  =  $getrow[$cntr]['Company_Name'];
$Bidderid_Details =  $getrow[$cntr]['Bidderid_Details'];
$checked_bidders =  $getrow[$cntr]['checked_bidders'];
$Primary_Acc =  $getrow[$cntr]['Primary_Acc'];
$Company_Type =  $getrow[$cntr]['Company_Type'];
$checked_bidders = explode(",",$checked_bidders);
//print_r($checked_bidders);
//echo "ff".$SentEmail;
$Loan_Any = substr($Loan_Any, 0, strlen($Loan_Any)-1); 
$getDOB =DetermineAgeGETDOB($DOB);
$age = $getDOB;
$getCompany_Name =  $getrow[$cntr]['Company_Name'];	

$getcompany='select hdfc_bank,fullerton,citibank,barclays,standard_chartered,hdbfs,ingvyasya,bajajfinserv from pl_company_list where company_name="'.$getCompany_Name.'"';//$getcompany."<br>";
 list($recordcount,$grow)=MainselectfuncNew($getcompany,$array = array());
		$j=0;

$hdfccategory= $grow[$j]["hdfc_bank"];
$fullertoncategory= $grow[$j]["fullerton"];
$citicategory= $grow[$j]["citibank"];
$barclayscategory= $grow[$j]["barclays"];
$stanccategory = $grow[$j]["standard_chartered"];
$hdbfscategory = $grow[$j]["hdbfs"]; 
$ingvyasyacategory = $grow[$j]["ingvyasya"]; 
$bajajfinservcategory = $grow[$j]["bajajfinserv"]; 

$monthsalary = $Net_Salary/12;if($Bidder_Count!=0)
{
	$strbidderid="";
	$z=0;
$retrieve_query="select BidderID from Req_Feedback_Bidder1 where AllRequestID=".$post." and Reply_Type=1";
//echo $retrieve_query."<br>";
	
	 list($retrieve_recordcount,$Arrrow)=MainselectfuncNew($retrieve_query,$array = array());

	for($r=0;$r<$retrieve_recordcount;$r++)
	{
		$BidderID12 = $Arrrow[$r]['BidderID'];
		$strbidderid = $strbidderid.$BidderID12.",";
	}
}
?>
<style>
.fontstyle
{
	font-family:Verdana Arial, Helvetica, sans-serif;
	font-size:12px;
}
</style>
<!--<form name="loan_form" method="post" action="<? echo $_SERVER['PHP_SELF'] ?>?id=<? echo $post;?>&Bid=<? echo $bidid;?>&to=<? echo $min_date?>&from=<? echo $max_date;?>" > -->
<table style='border:1px dotted #9C9A9C;' cellspacing="2" cellpadding="5" width="700" height="80%" align="center" border="0" >
<tr>
	<!--<td>
		<table width="100%">
		<tr>--><td style="border:1px solid black;" colspan="4" bgcolor="#DAEAF9" align="center" class="fontstyle" ><b>Personal Details</b> [ <?php echo $Dated; ?>]</td></tr>
		<tr>
			<td class="fontstyle" width="117"><b> Name</b></td>
			<td class="fontstyle" width="270"><? echo $Name;?></td>
			<td class="fontstyle" width="126"><b>Email id</b></td>
			<td class="fontstyle" width="135"><? echo $Email;?></td>
		</tr>
		<tr>
		<td class="fontstyle"><b>DOB</b></td>
			<td class="fontstyle"><? echo $DOB;?></td>
			<td class="fontstyle"><b>Mobile</b></td>
			<td class="fontstyle">+91 <? echo $Mobile;?></td>
			</tr>
					
		<tr>
			<td class="fontstyle"><b>City</b></td>
			<td class="fontstyle"><?=$City?></td>
			<td class="fontstyle"><b>Other City</b></td>
			<td class="fontstyle"><? echo $City_Other;?></td>
		</tr>
		<tr>
		<td class="fontstyle"><b>Pincode</b></td><td><? echo $Pincode;?></td>
<td class="fontstyle"><b>Residence Status</b></td>
			<td class="fontstyle">
			<? if($Residential_Status==1){ echo "Owned";}
			   else if($Residential_Status==2){ echo "Rented";}
			  else if($Residential_Status==3){ echo "Company Provided";}?><input type="hidden" name="BidderId" value="<? echo $bidid;?>"> <input type="hidden" name="plrequestid" id="plrequestid" value="<? echo $post;?>">
       
              </td>
		</tr>
	
		<tr>

		<td colspan="4" bgcolor="#DAEAF9" align="center" style="border:1px solid black;"><b>Employment Details</b></td></tr>
	<tr>
		<td class="fontstyle"><b>Employment Status</b></td>
		<td class="fontstyle"><? if($Employment_Status ==1){echo "Salaried"; } else if($Employment_Status ==0) {echo "Self Employed"; }?></td>
		<td class="fontstyle"><b>Annual Income</b></td>
		<td class="fontstyle"><? echo $Net_Salary;?></td>
	</tr>
	<tr><td class="fontstyle"><b>Company Name</b></td>
	<td class="fontstyle"><? echo $Company_Name;?></td>
	<td class="fontstyle">
	<b>Loan Amount	</b>
		</td>
		<td class="fontstyle"><? echo $Loan_Amount;
	?>	</td>
	</tr>
	
	<tr>
		<td class="fontstyle"><b>Total Experience</b></td>
		<td class="fontstyle"><? echo $Total_Experience;?><b>(years)</b></td>
		<td class="fontstyle"><b>Current experience in company</b></td>
		<td class="fontstyle"><? echo $Years_In_Company;?><b>(years)</b></td>
	</tr><tr>
<tr>
	
	<td colspan="4" bgcolor="#DAEAF9" align="center" style="border:1px solid black;"><b>Bidders Details </b></td></tr>
		<? if($City=="Others" || $City=="Please Select")
{
	$City=$City_Other;
}
else
{
	$City= $City;
}
//echo $City;?>
<tr><td class="fontstyle"><b>Send to Bidders</b></td>
<td colspan="3">
 <?php

	 $getBiddersSql = "select * from Req_Feedback_Bidder1 where  Reply_Type = 1 and AllRequestID='".$REquestID."'";
	 
	  list($numgetBidders,$mygetrow)=MainselectfuncNew($getBiddersSql,$array = array());
		$cntr=0;
	 
	 
	
	 $BFeeds = "";
	 $BiddersFeedback = "";
	 $FinalBidder = "";
	 $finalBidderName = "";
	 for($ii=0;$ii<$numgetBidders;$ii++)
	 {
	 	
		 $Bidder_ID = $mygetrow[$ii]['BidderID'];
	 	 $checkBidderSql = "select * from Bidders where BidderID='".$Bidder_ID."' and  Bidders.Define_PrePost = 'PostPaid'";
		 list($checkNumRows,$myBidrow)=MainselectfuncNew($checkBidderSql,$array = array());
		$bid=0;
		 
		 if($checkNumRows>0)
		 {
		 	 $Bidder_Name = $myBidrow[$bid]['Bidder_Name'];
			 $BidderEmailID = $myBidrow[$bid]['BidderEmailID'];
			 $Contact_Num = $myBidrow[$bid]['Contact_Num'];
			 if($Contact_Num == "")
			 {
			 	 $checkBidder_Sql = "select * from Req_Compaign where BidderID='".$Bidder_ID."'";
				 list($checkNumRowsReq,$myReqcrow)=MainselectfuncNew($checkBidderSql,$array = array());
				 $Reqc=0;
				 $Contact_Num = $myReqcrow[$Reqc]['Mobile_no'];
			 }
			 
			 $BidNameSql = "select * from Bank_Master left join Bidders_List on Bidders_List.BankID=Bank_Master.BankID where Bidders_List.BidderID='".$Bidder_ID."'";
			 list($checkNumRowsReq,$mybnkMastrrow)=MainselectfuncNew($BidNameSql,$array = array());
			 $bnkM=0;
			 $BidderName = $mybnkMastrrow[$bnkM]['Bank_Name'];
			$BFeeds = '';
			 $bidderFeedbackSql = "select Feedback from Req_Feedback where (AllRequestID = '".$REquestID."' and  BidderID='".$Bidder_ID."' and Reply_Type=1)";
			list($numbidderFeedback,$getRqFdrow)=MainselectfuncNew($bidderFeedbackSql,$array = array());
			$rf=0;
			 if($numbidderFeedback>0)
			 {
			 	$BFeeds = '';
				$feedbackB =$getRqFdrow[$rf]['Feedback'];
				if(strlen($feedbackB)>0)
				{
					$BFeeds ="<b> [ ".$feedbackB." ]</b>";
				}
			 }
			 else if($BidderName=="HDFC")
			 {
			 $arrBidderID = array(1887,1888,1889,1890,1891,1948,1949,1950,1951,1952,1953,1954,1955,1956,1957,1958,1959,1960);
			 if(in_array($Bidder_ID,$arrBidderID))
			 {
				 $BFeeds = '';
					$getReqSql = "select hdfcplid from hdfc_pl_calc_leads where RequestID = '".$REquestID."'";
					list($getReqNum,$gethdfcrow)=MainselectfuncNew($getReqSql,$array = array());
					$hd=0;
					
					$hdfcplid = $gethdfcrow[$hd]['hdfcplid'];
					if($getReqNum>0 && $hdfcplid>0)
					{
						$BFeeds = '';
						 $bidderFeedbackSql = "select Feedback from Req_Feedback where (AllRequestID = '".$hdfcplid."' and  BidderID in (2037,2410,2411) and Reply_Type=1)";
						
						list($numbidderFeedback,$gefdbkrow)=MainselectfuncNew($bidderFeedbackSql,$array = array());
						$fdbk=0;
						
						 if($numbidderFeedback>0)
						 {
							$feedbackB = $gefdbkrow[$fdbk]['Feedback'];
							if(strlen($feedbackB)>0)
							{
								$BFeeds =" <b>[ ".$feedbackB." ]</b>";
						  }
						}	 
					}
				}
			 }
			
			 $FinalBidder[] = trim($Bidder_ID);
			 $finalBidderName[] = trim($BidderName);
		    
			 echo "&nbsp;&nbsp;".$BidderName." [".$Bidder_ID."] ".$BFeeds."<br> ";
			 echo "&nbsp;&nbsp;".$Bidder_Name." ".$Contact_Num." ".$BidderEmailID."<br><br> ";
			 
			//$BiddersFeedback[] = "&nbsp;&nbsp;".$BidderName." [".$Bidder_ID."] ".$BFeeds;
		}
	 }
//	 $Feedback = implode("<br>", $BiddersFeedback);
	//echo $Feedback;
	 ?></td>
</tr>

<tr>
					<td><label for="country">Company Name </label></td>

					<td><? echo $Company_Name;?></td>
				</tr>	
<tr><td colspan="4"><table border="1">
<tr> <td width="11%" height="25" align="center" valign="middle"><b style="font-size:12px;">Bank Name</b></td>
	<td width="11%" align="center"><b style="font-size:12px;">Loan Amount</b></td>
	<td width="11%" align="center"><b style="font-size:12px;">ROI</b></td>
	<td width="11%" align="center"><b style="font-size:12px;">Tenure</b></td>
	<td width="11%" align="center"><b style="font-size:12px;">EMI(Per Lac)</b></td>
	</tr>

<?
//print_r($finalBidderName);
//echo $monthsalary.",".$PL_EMI_Amt.",".$Company_Name.",".$hdfccategory.",".$getDOB;
//echo "<br>";
//echo $monthsalary.",".$PL_EMI_Amt.",".$Company_Name.",".$getDOB.",".$citicategory;
//echo "<br>";
//echo $monthsalary.",".$PL_EMI_Amt.",".$Company_Name.",".$fullertoncategory.",".$getDOB.",".$City;
//echo "<br>";
//print_r($FinalBidder);
//echo "<br>";
 for($ij=0;$ij<count($FinalBidder);$ij++)
{
	//echo $finalBidderName[$ij];
		if($finalBidderName[$ij]=="HDFC" || $finalBidderName[$ij]=="HDFC Bank")
		{
			list($hdfcinterestrate,$hdfcgetloanamout,$hdfcgetemicalc,$hdfcterm)=hdfcbank($monthsalary,$PL_EMI_Amt,$Company_Name,$hdfccategory,$age,$Company_Type,$Primary_Acc);
			if($hdfcgetloanamout>0)
			{
				?>
			<tr> <td width="11%" height="25" align="center" valign="middle"><b style="font-size:12px;"><? echo $finalBidderName[$ij]; ?></b></td>
		<td width="11%" align="center"><b style="font-size:12px;"><? echo $hdfcgetloanamout; ?></b></td>
		<td width="11%" align="center"><b style="font-size:12px;"><? echo $hdfcinterestrate; ?></b></td>
		<td width="11%" align="center"><b style="font-size:12px;"><? echo $hdfcterm." yrs";?></b></td>
		<td width="11%" align="center"><b style="font-size:12px;"><? echo $hdfcgetemicalc; ?></b></td>
		</tr>	
			<?
			}
		}
		elseif($finalBidderName[$ij]=="Citibank" || $finalBidderName[$ij]=="Citibank")
		{
		
			list($citiinterestrate,$citigetloanamout,$citigetemicalc,$cititerm)=citibank($monthsalary,$PL_EMI_Amt,$Company_Name,$getDOB,$citicategory);
			if($citigetloanamout>0)
			{
			?>
			<tr> <td width="11%" height="25" align="center" valign="middle"><b style="font-size:12px;"><? echo $finalBidderName[$ij]; ?></b></td>
			<td width="11%" align="center"><b style="font-size:12px;"><? echo $citigetloanamout; ?></b></td>
			<td width="11%" align="center"><b style="font-size:12px;"><? echo $citiinterestrate; ?></b></td>
			<td width="11%" align="center"><b style="font-size:12px;"><? echo $cititerm; ?></b></td>
			<td width="11%" align="center"><b style="font-size:12px;"><? $citigetemicalc; ?></b></td>
			</tr>	
		<?
			}
		}
		elseif($finalBidderName[$ij]=="Fullerton" || $finalBidderName[$ij]=="Fullerton")
		{
			list($fullertoninterestrate,$fullertongetloanamout,$fullertongetemicalc,$fullertonterm)=fullerton($monthsalary,$PL_EMI_Amt,$Company_Name,$fullertoncategory,$getDOB,$City);
			
			if($fullertongetloanamout>0)
			{
				?>
                <tr> 
                    <td width="11%" height="25" align="center" valign="middle"><b style="font-size:12px;"><? echo $finalBidderName[$ij]; ?></b></td>
                    <td width="11%" align="center"><b style="font-size:12px;"><? echo $fullertongetloanamout; ?></b></td>
                    <td width="11%" align="center"><b style="font-size:12px;"><? echo $fullertoninterestrate; ?></b></td>
                    <td width="11%" align="center"><b style="font-size:12px;"><? echo $fullertonterm; ?></b></td>
                    <td width="11%" align="center"><b style="font-size:12px;"><? echo $fullertongetemicalc; ?></b></td>
                </tr>	
            	<?
			}
		}
		elseif($finalBidderName[$ij]=="Barclays Finance" || $finalBidderName[$ij]=="Barclays")
		{
	//	echo $barclayscategory;
			
			list($barclayinterestrate,$barclaygetloanamout,$barclaygetemicalc,$barclayterm)=@barclays($monthsalary,$PL_EMI_Amt,$Company_Name,$barclayscategory,$getDOB,$City);
			if($barclaygetloanamout>0)
			{
				?>
			<tr> <td width="11%" height="25" align="center" valign="middle"><b style="font-size:12px;"><? echo $finalBidderName[$ij]; ?></b></td>
			<td width="11%" align="center"><b style="font-size:12px;"><? echo $barclaygetloanamout; ?></b></td>
			<td width="11%" align="center"><b style="font-size:12px;"><? echo $barclayinterestrate; ?></b></td>
			<td width="11%" align="center"><b style="font-size:12px;"><? echo $barclayterm; ?></b></td>
			<td width="11%" align="center"><b style="font-size:12px;"><? echo $barclaygetemicalc; ?></b></td>
			</tr>	
		<?
			}
		}
		
	
		elseif($finalBidderName[$ij]=="HDBFS")
		{
		//	echo $hdbfscategory;
//			$monthsalary,$PL_EMI_Amt,$Company_Name,$fullertoncategory,$getDOB,$City);
			list($interestrate,$getloanamout,$getemicalc,$term,$Processing_Fee)= hdbfcLoans ($hdbfscategory, $monthsalary, $Primary_Acc,$age,$PL_EMI_Amt,$Loan_Amount);
	
			if($getloanamout>0)
			{
			?>
				<tr> 
					<td width="11%" height="25" align="center" valign="middle"><b style="font-size:12px;"><? echo $finalBidderName[$ij]; ?></b></td>
					<td width="11%" align="center"><b style="font-size:12px;"><? echo $getloanamout; ?></b></td>
					<td width="11%" align="center"><b style="font-size:12px;"><? echo $interestrate; ?></b></td>
					<td width="11%" align="center"><b style="font-size:12px;"><? echo $term; ?></b></td>
					<td width="11%" align="center"><b style="font-size:12px;"><? echo $getemicalc; ?></b></td>
				</tr>	
			
			<?php
			}
		}
			
		elseif($finalBidderName[$ij]=="IngVysya")
		{
			if($Primary_Acc=="IngVysya")
			{
				$account_holder = 1;
			}
			list($interestrate,$getloanamout,$getemicalc,$term,$Processing_Fee)= ingVyasyaLoans ($ingvyasyacategory, $monthsalary, $account_holder,$age,$PL_EMI_Amt,$Loan_Amount,$getCompany_Name);
	
			if($getloanamout>0)
			{
				?>
				<tr> 
					<td width="11%" height="25" align="center" valign="middle"><b style="font-size:12px;"><? echo $finalBidderName[$ij]; ?></b></td>
					<td width="11%" align="center"><b style="font-size:12px;"><? echo $getloanamout; ?></b></td>
					<td width="11%" align="center"><b style="font-size:12px;"><? echo $interestrate; ?></b></td>
					<td width="11%" align="center"><b style="font-size:12px;"><? echo $term; ?></b></td>
					<td width="11%" align="center"><b style="font-size:12px;"><? echo $getemicalc; ?></b></td>
				</tr>	
			
			<?php
			}
		}		
		elseif($finalBidderName[$ij]=="IngVysya")
		{
			if($Primary_Acc=="IngVysya")
			{
				$account_holder = 1;
			}
			list($interestrate,$getloanamout,$getemicalc,$term,$Processing_Fee)= ingVyasyaLoans ($ingvyasyacategory, $monthsalary, $account_holder,$age,$PL_EMI_Amt,$Loan_Amount,$getCompany_Name);
	
			if($getloanamout>0)
			{
				?>
				<tr> 
					<td width="11%" height="25" align="center" valign="middle"><b style="font-size:12px;"><? echo $finalBidderName[$ij]; ?></b></td>
					<td width="11%" align="center"><b style="font-size:12px;"><? echo $getloanamout; ?></b></td>
					<td width="11%" align="center"><b style="font-size:12px;"><? echo $interestrate; ?></b></td>
					<td width="11%" align="center"><b style="font-size:12px;"><? echo $term; ?></b></td>
					<td width="11%" align="center"><b style="font-size:12px;"><? echo $getemicalc; ?></b></td>
				</tr>	
			
			<?php
			}
		}
			
				
}?>
</table></td></tr>

<tr><td colspan="4" bgcolor="#DAEAF9" align="center" style="border:1px solid black;" ><b>ADD Feedback </b></td></tr>
<tr><td colspan="4" bgcolor="#DAEAF9" >

<input type="hidden" name="lead_id" id="lead_id" value="<?php echo $post; ?>" >
    <input type="hidden" name="fbidder_id" id="fbidder_id" value="<? echo $fbidder_id;?>">  
<table cellpadding="0" cellspacing="3" border="0"><tr>
			<td align="center" class="head1" height="24">Bidder Details</td>
		<td align="center" class="head1">Feedback</td>
		<td align="center" class="head1">Comment</td>
			
			<td align="center" class="head1">Followup Date</td>
		</tr>
<?php
 for($i=0;$i<count($FinalBidder);$i++)
{
if($i%2==0)
			{	
				$bgcolor = "#CCCCCC";	
			}
			else
			{
				$bgcolor = "#DFF6FF";	
			}
?>
<tr bgcolor="<?php echo $bgcolor; ?>">
	<td width="166" class="fontstyle"><b><?php echo $finalBidderName[$i]; ?> [<?php echo $FinalBidder[$i]; ?>] </b>
	<?php
	$sqlBid = "select Define_PrePost as BidderDef from Bidders where BidderID='".$FinalBidder[$i]."'";
	
	list($recordcount,$getbdrow)=MainselectfuncNew($sqlBid,$array = array());
	$bd=0;
	$BidderDef = $getbdrow[$bd]['BidderDef'];
	echo " <b>[".$BidderDef."]</b>";
	?>	</td>
	<td width="214" class="fontstyle">


	<?php
	$Feedback = "";
	$checkSql = "select * from pl_feedback where lead_id='".$post."' and bidder_id = '".$FinalBidder[$i]."' and fbidder_id='".$fbidder_id."'";
	list($recordcount,$getplfrow)=MainselectfuncNew($fbidder_id,$array = array());
	$plf=0;
	echo $Feedback = $getplfrow[$plf]['feedback'];
	?></td>
<td width="112"  class="fontstyle">
<?php
$comment = "";
$checkSql = "select * from pl_feedback where lead_id='".$post."' and bidder_id = '".$FinalBidder[$i]."' and fbidder_id='".$fbidder_id."'";

list($recordcount,$getPlfdrow)=MainselectfuncNew($checkSql,$array = array());
	$fdPl=0;
	
echo $comment = $getPlfdrow[$fdPl]['comment'];
?></td>	
	<td width="177" class="fontstyle">
	<?php
	$Feedback = "";
	$checkSql = "select * from pl_feedback where lead_id='".$post."' and bidder_id = '".$FinalBidder[$i]."' and fbidder_id='".$fbidder_id."'";
	
	list($recordcount,$getPlfdrow2)=MainselectfuncNew($checkSql,$array = array());
	$fdPl2=0;
	
	$followup_date = $getPlfdrow2[$fdPl2]['followupdate'];
	$Feedback = $getPlfdrow2[$fdPl2]['feedback'];
	?>
    <?php if($followup_date !='0000-00-00 00:00:00' && $Feedback=="Follow Up/Out of station" ) {  echo $followup_date; } ?>	</td>
</tr>
<?php
}
?>
<?php
if($Feedback=="Appointment")
{
$doa = $getPlfdrow2[$fdPl2]['doa'];
$toa = $getPlfdrow2[$fdPl2]['toa'];
$address = $getPlfdrow2[$fdPl2]['address'];
?>
<tr><td colspan="4"><strong>Appointment Details</strong>: <br />Date : <?php echo $doa; ?>, Time  : <?php echo $toa; ?>, Address : <?php echo $address; ?> </td></tr>
<?php
}
?>
<tr><td colspan="4"><div id="feeds" style="text-align:center; font-weight:bold;"></div></td></tr>
</table></td></tr>

 <tr>
     <td colspan="4" align="center"><!--<input type="submit" class="bluebutton" value="Submit">  -->     </td>
   </tr>
</table>
<!--</form> -->
</body>
</html>