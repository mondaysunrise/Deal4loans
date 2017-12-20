<?php
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	
	function appendzero($number, $digits=4)
	{
	   $output = str_pad($number, $digits, "0", STR_PAD_LEFT);
	   return $output;
	} 
	
	$cityList = array('1' => '996','2' => '997','3' => '998','4' => '1000','5' => '1012','6' => '1015', '7' => '1037', '8' => '1050'	);

	$cityListStr = implode("," , $cityList);

if(isset($_POST['submit']))
{
	$type = $_POST['type'];
	$FollowupDate = $_POST['FollowupDate'];
	$a_month = $_POST['a_month'];
	$telecaller = $_POST['telecaller'];
 	$ApptDate = $_POST['ApptDate'];
	$ApptTime = $_POST['ApptTime'];
	$a_address = $_POST['a_address'];
	$a_city = $_POST['a_city'];
	$a_pincode = $_POST['a_pincode'];
	$a_loan_amt = $_POST['a_loan_amt'];
	$a_final_loan_amt = $_POST['a_final_loan_amt'];
	$LeadDate = $_POST['LeadDate'];
	$add_comment = $_POST['add_comment'];
	$net_take_home = $_POST['net_take_home'];
	$LeadID = $_POST['LeadID'];
	$post = $LeadID; 
	$BidderID = $_POST['BidderID'];
	
	$roi = $_POST['roi'];
	
	$doclist = $_POST['doclist'];
	$doc_list = implode(",", $doclist);
	$leadsSql = "select * from fullerton_leads where LeadID='".$LeadID."'";
	list($leadsNumRows,$leadsQuery)=MainselectfuncNew($leadsSql,$array = array());
	$Dated = ExactServerdate();
	if($leadsNumRows>0)
	{
		$dataUpdate = array('a_feedback'=>$type, 'a_fullowup_date'=>$FollowupDate, 'a_month'=>$a_month, 'a_telecaller'=>$telecaller, 'a_date'=>$ApptDate, 'a_time'=>$ApptTime, 'a_address'=>$a_address, 'a_city'=>$a_city, 'a_pincode'=>$a_pincode, 'a_loan_amt'=>$a_loan_amt, 'a_final_loan_amt'=>$a_final_loan_amt, 'a_leaddate'=>$LeadDate, 'a_netsalary'=>$net_take_home, 'a_remark'=>$add_comment, 'BidderID'=>$BidderID, 'dated'=>$Dated,' doclist'=>$doc_list, 'roi'=>$roi);
		$wherecondition ="(LeadID=".$LeadID.")";
		Mainupdatefunc ('fullerton_leads', $DataArray, $wherecondition);
	}
	else
	{
		$dataInsert = array('LeadID'=>$LeadID, 'a_feedback'=>$type, 'a_fullowup_date'=>$FollowupDate, 'a_month'=>$a_month, 'a_telecaller'=>$telecaller, 'a_date'=>$ApptDate, 'a_time'=>$ApptTime, 'a_address'=>$a_address, 'a_city'=>$a_city, 'a_pincode'=>$a_pincode, 'a_loan_amt'=>$a_loan_amt, 'a_final_loan_amt'=>$a_final_loan_amt, 'a_leaddate'=>$LeadDate, 'a_netsalary'=>$net_take_home, 'a_remark'=>$add_comment, 'BidderID'=>$BidderID, 'dated'=>$Dated,' doclist'=>$doc_list, 'roi'=>$roi);
			$table = 'fullerton_leads';
		$insert = Maininsertfunc ($table, $data);
	}
	//echo $sql;
	
	$customerDetailsSql = "select * from Req_Loan_Personal where RequestID='".$LeadID."' ";
	list($customerDetailsRows,$customerDetailsQuery)=MainselectfuncNew($customerDetailsSql,$array = array());

	$Name = $customerDetailsQuery[0]['Name'];
	$Mobile_Number = $customerDetailsQuery[0]['Mobile_Number'];
	$Company_Name = $customerDetailsQuery[0]['Company_Name'];
	//address $a_address
	//Loan  $a_loan_amt
	$Net_Salary = $customerDetailsQuery[0]['Net_Salary'];
	//Time  $ApptTime
	//ROI $roi 
	
	$fd_explode = explode(" ", $ApptDate);
	$sd_explode = explode("-", $fd_explode[0]);
	$dmktime = mktime(0,0,0, $sd_explode[1], $sd_explode[2], $sd_explode[0] );
	$finalDate = date("d/m", $dmktime);
	//Message Txt
	
	
	$getRMDetailsSql = "select * from rm_detail_fullerton where rm_city='".$a_city."'";
	list($getRMDetailsRows,$getRMDetailsQuery)=MainselectfuncNew($getRMDetailsSql,$array = array());
	$rm_name = $getRMDetailsQuery[0]['rm_name'];
	$rm_contact = $getRMDetailsQuery[0]['rm_contact'];
	
	
	$SMSMessage = "Appt Details: Dt-".$finalDate.",CM-".$Name.",Mob-".$Mobile_Number.",Com-".$Company_Name.",Add-".$a_address.",Ln AMT-".$a_loan_amt.",Salary-".$a_netsalary.",Time-".$ApptTime.",ROI-".$roi.".";
	
	if(strlen($rm_contact)>0)
	{
		//$mobileB = 9899802807;
	//	$mobileB = "9971396361";
		$mobileB = $rm_contact;
		$mobArr = explode(",",$mobileB);
		$mob = "";
		for($ij=0;$ij<count($mobArr);$ij++)
		{
			$mob = trim($mobArr[$ij]);
			SendSMSforLMS($SMSMessage, $mob);	
		}
		
	//	$mobileB = $rm_contact;
		
		
	}
	
	
}

$post = $_GET['id'];
//$post = 299786;
$viewqry="select * from Req_Loan_Personal where Req_Loan_Personal.RequestID=".$post." "; 
list($viewleadscount,$viewlead)=MainselectfuncNew($viewqry,$array = array());

$Name = $viewlead[0]['Name'];
$Add_Comment= $viewlead[0]['Add_Comment'];
$Mobile = $viewlead[0]['Mobile_Number'];
$Net_Salary = $viewlead[0]['Net_Salary'];
$City = $viewlead[0]['City'];

if($City=="Others" || $City=="Please Select")
{
	$City = $viewlead[0]['City_Other'];
}

$Dated = $viewlead[0]['Dated'];
$Employment_Status = $viewlead[0]['Employment_Status'];
if($Employment_Status==0) { $emp_status="Self Employed"; } else { $emp_status="Salaried"; }
$Loan_Amount = $viewlead[0]['Loan_Amount'];
$Email = $viewlead[0]['Email'];
$Loan_Any = $viewlead[0]['Loan_Any'];
$Pincode = $viewlead[0]['Pincode'];
$followup_date = $viewlead[0]['Followup_Date'];
$Company_Name = $viewlead[0]['Company_Name'];

$DOB = $viewlead[0]['DOB'];
$Loan_Any = substr($Loan_Any, 0, strlen($Loan_Any)-1); 

$feedbackSql = "select * from Req_Feedback where  AllRequestID=".$post." and BidderID in (".$cityListStr.")";
list($feedbackcount,$feedbackQuery)=MainselectfuncNew($feedbackSql,$array = array());
$feedbackBidder = $feedbackQuery[0]['Feedback'];


//fullerton_leads
$leadsSql = "select * from fullerton_leads where LeadID='".$post."'";
list($leadsNumRows,$leadsQuery)=MainselectfuncNew($leadsSql,$array = array());

if($leadsNumRows>0)
{
	$varFeedback = $leadsQuery[0]['a_feedback'];
	$followup_date = $leadsQuery[0]['a_fullowup_date'];
	$a_month = $leadsQuery[0]['a_month'];
	$a_telecaller = $leadsQuery[0]['a_telecaller'];
	$a_date = $leadsQuery[0]['a_date'];
	$a_time = $leadsQuery[0]['a_time'];
	$a_address = $leadsQuery[0]['a_address'];
	$a_city = $leadsQuery[0]['a_city'];
	$a_pincode = $leadsQuery[0]['a_pincode'];
	$a_loan_amt = $leadsQuery[0]['a_loan_amt'];
	$a_final_loan_amt = $leadsQuery[0]['a_final_loan_amt'];
	$a_leaddate = $leadsQuery[0]['a_leaddate'];
	$a_netsalary = $leadsQuery[0]['a_netsalary'];
	$a_remark = $leadsQuery[0]['a_remark'];
	$dated = $leadsQuery[0]['dated'];
	$doclist = $leadsQuery[0]['doclist'];
	$doclistArr = explode(',',$doclist);
	$roi = $leadsQuery[0]['roi'];
	
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Edit Lead</title>
<link rel="stylesheet" type="text/css" href="css/menu.css">
<link rel="stylesheet" type="text/css" href="css/style.css">
<link href="includes/style.css" rel="stylesheet" type="text/css">
<script language="javascript" type="text/javascript" src="scripts/datetime.js"></script>
<script language="javascript" type="text/javascript" src="scripts/common.js"></script>
<script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
<style>
.sty {
color:#1E1E1E;
font-family:Verdana,Arial,Helvetica,sans-serif;
font-size:11px;
line-height:12px;
}
</style>
</head>

<body>
<form name="updateCalling" method="post" action="updatecalling.php?id=<?php echo $post; ?>&BidderID=<? echo $BidderID; ?>">
<table style='border:1px dotted #9C9A9C;' width="731" height="80%" cellpadding="5" cellspacing="0" align="center" >
<tr>
	<!--<td>
		<table width="100%">
		<tr>--><td style="border:1px solid black;" colspan="4" bgcolor="#DAEAF9" align="center" class="fontstyle" ><b>Personal Details</b></td></tr><tr>	<td class="sty" ><b>Name</b>
	</td>
	<td ><? echo $Name;?> </td>
	
<td width="26%" class="sty" ><b>Email id</b></td>
	<td width="23%" ><? echo $Email;?></td>
	</tr>
<tr>
	<td width="28%" class="sty"><b>Mobile</b></td>
	<td width="23%">+91 <? echo $Mobile;?></td>
	<td class="sty" ><b>DOB </b></td>
	<td ><? echo $DOB;?> (yyyy-mm-dd)</td>
</tr>
<tr>
	<td class="sty" ><b>City</b></td>
	<td>
<?
echo $City;
?></td>
	<td class="sty" ><b>Pincode</b></td>
	<td ><? echo $Pincode;?></td>
</tr>

<tr>
	<td class="sty"><b>Employment Status</b></td>
	<td><? if($Employment_Status ==1 ) {echo "Salaried"; } else echo "Self Employed"; ?></td>

	<td class="sty" ><b>Annual Income</b></td>
	<td><? echo $Net_Salary;?></td>
</tr>
<tr><td class="sty"><b>Company Name</b></td>
<td><? echo $Company_Name?></td><td class="sty"><b>Loan Amount</b></td>
<td><? echo $Loan_Amount;?></td></tr>
<tr><td class="sty"><b>Feedback</b></td>
<td><? echo $feedbackBidder?></td><td><b></b></td><td></td></tr>

<tr>
	<td height="25" colspan="4" align="center" bgcolor="#DAEAF9" class="fontstyle" style="border:1px solid black;" ><b class="sty">Add Feedback</b></td>
</tr>
<tr>
	<td class="sty"><b>Feedback</b></td>
	<td>
	<?php //echo $varFeedback; ?>
	<select name="type" id="type" >
		<option value="Fresh" <? if($varFeedback == "Fresh" || $varFeedback == "" ) { echo "selected"; } ?>>Fresh</option>
		<!--<option value="" <? //if($varFeedback == "") { echo "selected"; } ?> >No Feedback</option> -->
		<option value="Approved" <? if($varFeedback == "Approved") { echo "selected"; } ?>>Approved</option>
		<option value="Disbursed" <? if($varFeedback == "Disbursed") { echo "selected"; } ?>>Disbursed</option>
		
		<option value="Incomplete Document" <? if($varFeedback == "Incomplete Document") { echo "selected"; } ?>>Incomplete Document</option>
		<option value="Logged In" <? if($varFeedback == "Logged In") { echo "selected"; } ?>>Logged In</option>
		<option value="Lost to other Branch/DSA" <? if($varFeedback == "Lost to other Branch/DSA") { echo "selected"; } ?>>Lost to other Branch/DSA</option>
		
	<option value="Not Eligible Post Logged in" <? if($varFeedback == "Not Eligible Post Logged in") { echo "selected"; } ?>>Not Eligible Post Logged in</option>
		
		<option value="Not Eligible Pre logged in" <? if($varFeedback == "Not Eligible Pre logged in") { echo "selected"; } ?>>Not Eligible Pre logged in</option>
		
		<option value="Not Interested Post Logged In" <? if($varFeedback == "Not Interested Post Logged In") { echo "selected"; } ?>>Not Interested Post Logged In</option>
		
		<option value="Not Interested Post Logged In" <? if($varFeedback == "Not Interested Post Logged In") { echo "selected"; } ?>>Not Interested Post Logged In</option>
		<option value="Not Interested Pre Logged in" <? if($varFeedback == "Not Interested Pre Logged in") { echo "selected"; } ?>>Not Interested Pre Logged in</option>
		<option value="Reject Post Logged in" <? if($varFeedback == "Reject Post Logged in") { echo "selected"; } ?>>Reject Post Logged in</option>
		<option value="Reject Pre Logged in" <? if($varFeedback == "Reject Pre Logged in") { echo "selected"; } ?>>Reject Pre Logged in</option>
		<option value="Reschedule" <? if($varFeedback == "Reschedule") { echo "selected"; } ?>>Reschedule</option>
			<option value="Yet to Login " <? if($varFeedback == "Yet to Login ") { echo "selected"; } ?>>Yet to Login </option>			
</select>
</td>
<td class="sty"><b>Follow Up Date</b></td>
<td><input type="Text"  name="FollowupDate" id="FollowupDate" maxlength="25" size="15" <?php if($followup_date !='0000-00-00 00:00:00') { ?>value="<?php  echo $followup_date; ?>" <?php } ?>>&nbsp;<a href="javascript:NewCal('FollowupDate','yyyymmdd',true,24)"><img src="images/cal.gif" width="16" height="16" border="0" alt="Pick a date"></a></td>
</tr>


	<tr>
	  <td class="sty"><b>Month</b></td>
		<td>
		<select name="a_month">
		<option value="">Select</option>
		<?php 
		for($i=1;$i<=12;$i++)
		{
 			$selected = "";
			$val = appendzero($i,2);
			$mtTime = mktime(0, 0, 0, date($val)  , date("d"), date("Y"));
			$valMonth = date("M",$mtTime);
			$viewMonth = date("F", $mtTime);
			$currentMonth = date("n");
			
			if($valMonth==$a_month)
			{
				$selected = "selected";
			}
			else if($currentMonth==$i)
			{
				$selected = "selected";
			}
			echo '<option value="'.$valMonth.'" '.$selected.'>'.$viewMonth.'</option>';	
		}	
		?>
		</select>
		</td>
		<td class="sty"><b>Telecaller</b></td>
		<td >
		<select name="telecaller">
		<option value="">Select</option>
		<?php 
		  $getData = "select * from telecaller_fullerton where 1=1";
		 list($recordcount,$getDataQuery)=MainselectfuncNew($getData,$array = array());

		  $selec_ted = "";
		  for($i=0;$i<$recordcount;$i++)
		  {
		  	$selec_ted = "";
 			$name = $getDataQuery[$i]['name'];
			if($a_telecaller==$name)
			{
				$selec_ted = "selected";
			}
			echo '<option value="'.$name.'" '.$selec_ted.'>'.$name.'</option>';	
		  } 	
		?>
		</select></td>
	</tr>
	<tr>
	<td class="sty"><b>Appt Date</b></td>
	<td><input type="Text"  name="ApptDate" id="ApptDate" maxlength="25" size="15" <?php if($a_date !='0000-00-00 00:00:00') { ?>value="<?php  echo $a_date; ?>" <?php } ?>>&nbsp;<a href="javascript:NewCal('ApptDate','yyyymmdd',true,24)"><img src="images/cal.gif" width="16" height="16" border="0" alt="Pick a date"></a></td>
		<td class="sty"><b>Appt Time</b></td>
		<td>
		<select name="ApptTime">
		<option value="">Select</option>
		<option value="8 AM - 10 AM" <?php if($a_time=="8 AM - 10 AM") echo "selected"; ?> >8 AM - 10 AM</option>
		<option value="10 AM - 12 PM" <?php if($a_time=="10 AM - 12 PM") echo "selected"; ?>>10 AM - 12 PM</option>
		<option value="12 PM - 2 PM" <?php if($a_time=="12 PM - 2 PM") echo "selected"; ?>>12 PM - 2 PM</option>
		<option value="2 PM - 4 PM" <?php if($a_time=="2 PM - 4 PM") echo "selected"; ?>>2 PM - 4 PM</option>
		<option value="4 PM - 6 PM" <?php if($a_time=="4 PM - 6 PM") echo "selected"; ?>>4 PM - 6 PM</option>
		<option value="6 PM - 8 PM" <?php if($a_time=="6 PM - 8 PM") echo "selected"; ?>>6 PM - 8 PM</option>
		<option value="Call Before Going" <?php if($a_time=="Call Before Going") echo "selected"; ?>>Call Before Going</option>
		</select>
		</td>
	</tr>
 
 <tr>
	<td class="sty"><b>Address</b></td>
	<td><textarea rows="2" cols="20" name="a_address" id="a_address" ><? echo $a_address; ?></textarea></td>
		<td class="sty"><p><b>City</b></p>
		  <p><b>Pincode</b><br />
      </p></td>
		<td><p>
		<!--Mumbai Bangalore Chennai Delhi (Asaf Ali) Delhi (Nehru P) Hyderabad Mumbai Pune
		
		Pune Tushal 996
		Pune Tushal 997
		Pune Samadan kale 998
		
		 -->
		 <select name="a_city">
		<option value="">Select City</option>
		<option value="Tushal" <?php if($a_city=="Tushal") echo "selected"; ?> >Pune [Tushal]</option>
		<option value="Samadan Kale" <?php if($a_city=="Samadan Kale") echo "selected"; ?> >Pune [Samadan kale]</option>
		<option value="Asaf Ali" <?php if($a_city=="Asaf Ali") echo "selected"; ?> >Delhi [Asaf Ali]</option>
		<option value="Nehru P" <?php if($a_city=="Nehru P") echo "selected"; ?> >Delhi [Nehru P]</option>
		<option value="Hyderabad"  <?php if($a_city=="Hyderabad") echo "selected"; ?> >Hyderabad</option>
		<option value="Mumbai"  <?php if($a_city=="Mumbai") echo "selected"; ?> >Mumbai</option>
		<option value="Chennai" <?php if($a_city=="Chennai") echo "selected"; ?> >Chennai</option>
		<option value="Bangalore" <?php if($a_city=="Bangalore") echo "selected"; ?> >Bangalore</option>
		</select>
<!--		<input type="text" name="a_city" id="a_city" value="<?php //echo $a_city; ?>"  /> --></p>
		<p><input type="text" name="a_pincode" id="a_pincode" maxlength="6"  onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" value="<?php echo $a_pincode; ?>" /></p>
		</td>
  </tr>

 <tr>
	<td class="sty"><b>Loan Amount</b></td>
		<td><input type="text" name="a_loan_amt" id="a_loan_amt"  onKeyUp="intOnly(this);" onKeyPress="intOnly(this);"  value="<?php echo $a_loan_amt; ?>" /></td>
	  <td class="sty"><b>Final Loan Amount</b><br /></td>
		<td><input type="text" name="a_final_loan_amt" id="a_final_loan_amt"  onKeyUp="intOnly(this);" onKeyPress="intOnly(this);"  value="<?php echo $a_final_loan_amt; ?>" /></td>
 </tr>
 <tr>
	<td class="sty"><b>Lead Date</b><?php  $lDate = date("Y-m-d h:i:s"); ?></td>
	<td><input type="text"  name="LeadDate" id="LeadDate" maxlength="25" size="15" <?php if($a_leaddate =='0000-00-00 00:00:00' ||$a_leaddate=='') { ?>value="<?php  echo $lDate; ?>" <?php } else { ?>value="<?php  echo $a_leaddate; ?>" <?php } ?>>&nbsp;<a href="javascript:NewCal('LeadDate','yyyymmdd',true,24)"><img src="images/cal.gif" width="16" height="16" border="0" alt="Pick a date"></a></td>
		<td class="sty"><b>Net Take Home </b></td>
		<td><input type="text" name="net_take_home" id="net_take_home"  onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" value="<?php echo $a_netsalary; ?>" />
		</td>
	</tr>
	<tr>
	<td class="sty"><b>Remark</b></td>
	<td><textarea rows="2" cols="20" name="add_comment" id="add_comment" ><? echo $a_remark; ?></textarea></td>
	<td class="sty"><b>ROI</b></td>
		<td><input type="text" name="roi" id="roi"   value="<?php echo $roi; ?>" /> %
	  </td>
	</tr>
	<tr>
		<td valign="top" class="sty"><b>Application Form with</b></td>
		<td colspan="3" class="sty">
		<?php 
		$sqlAddress = "select * from fullerton_doc_list where p_id=51";
	    list($numRowsAddress,$queryAddress)=MainselectfuncNew($sqlAddress,$array = array());
		for($i=0;$i<$numRowsAddress;$i++)
		{
			$selected = "";
			$document = $queryAddress[$i]['document'];
			$abbr = $queryAddress[$i]['abbr'];
			
			if(in_array($abbr,$doclistArr))
			{
				$selected = "checked";
			}
			
			?>
			<input type="checkbox" name="doclist[]" value="<?php echo $abbr; ?>" <?php echo $selected; ?>  />&nbsp;<?php echo $document; ?>
			<?php
			if($i%2==0)
			{
				echo "<br>";
			}
		}
		?></td>
	</tr>
	
	
	<tr>
		<td valign="top" class="sty"><b>Address Proof</b></td>
		<td colspan="3" class="sty">
		<?php 
		$sqlAddress = "select * from fullerton_doc_list where p_id=1";
	    list($numRowsAddress,$queryAddress)=MainselectfuncNew($sqlAddress,$array = array());
		for($i=0;$i<$numRowsAddress;$i++)
		{
			$selected = "";
			$document = $queryAddress[$i]['document'];
			$abbr = $queryAddress[$i]['abbr'];
			
			if(in_array($abbr,$doclistArr))
			{
				$selected = "checked";
			}
			
			?>
			<input type="checkbox" name="doclist[]" value="<?php echo $abbr; ?>" <?php echo $selected; ?>  />&nbsp;<?php echo $document; ?>
			<?php
			if($i%2==0)
			{
				echo "<br>";
			}
		}
		?></td>
	</tr>
	
	<tr>
		<td valign="top" class="sty"><b>ID Proof</b></td>
		<td colspan="3" class="sty">
		<?php 
		$sqlAddress = "select * from fullerton_doc_list where p_id=2";
		   list($numRowsAddress,$queryAddress)=MainselectfuncNew($sqlAddress,$array = array());
		for($i=0;$i<$numRowsAddress;$i++)
		{
			$selected = "";
			$document = $queryAddress[$i]['document'];
			$abbr = $queryAddress[$i]['abbr'];
			if(in_array($abbr,$doclistArr))
			{
				$selected = "checked";
			}
			?>
			<input type="checkbox" name="doclist[]" value="<?php echo $abbr; ?>" <?php echo $selected; ?>  />&nbsp;<?php echo $document; ?>
			<?php
				
			if($i%2==0)
			{
				echo "<br>";
			}
		}
		?></td>
	</tr>
	
	<tr>
		<td valign="top" class="sty"><b>Business Continuity for 3 years</b></td>
		<td colspan="3"  class="sty">
		<?php 
		$sqlAddress = "select * from fullerton_doc_list where p_id=3";
	   list($numRowsAddress,$queryAddress)=MainselectfuncNew($sqlAddress,$array = array());
		for($i=0;$i<$numRowsAddress;$i++)
		{
			$selected = "";
			$document = $queryAddress[$i]['document'];
			$abbr = $queryAddress[$i]['abbr'];
			if(in_array($abbr,$doclistArr))
			{
				$selected = "checked";
			}
			
			?>
			<input type="checkbox" name="doclist[]" value="<?php echo $abbr; ?>" <?php echo $selected; ?>  />&nbsp;<?php echo $document; ?>
			<?php
			//	if($i%2==0)
			//{
				echo "<br>";
			//}
		}
		?></td>
	</tr>
	
	<tr>
		<td valign="top"  class="sty"><b>Income Proof</b></td>
		<td colspan="3" class="sty">
		<?php 
		$sqlAddress = "select * from fullerton_doc_list where p_id=4";
   list($numRowsAddress,$queryAddress)=MainselectfuncNew($sqlAddress,$array = array());
		for($i=0;$i<$numRowsAddress;$i++)
		{
			$selected = "";
			$document = $queryAddress[$i]['document'];
			$abbr = $queryAddress[$i]['abbr'];
			if(in_array($abbr,$doclistArr))
			{
				$selected = "checked";
			}
			?>
			<input type="checkbox" name="doclist[]" value="<?php echo $abbr; ?>" <?php echo $selected; ?> />&nbsp;<?php echo $document; ?>
			<?php
				if($i%2==0)
			{
				echo "<br>";
			}
		}
		?></td>
	</tr>
	
	<tr>
		<td valign="top" class="sty"><b>Bank Statement</b></td>
		<td colspan="3"  class="sty">
		<?php 
		$sqlAddress = "select * from fullerton_doc_list where p_id=5";
		   list($numRowsAddress,$queryAddress)=MainselectfuncNew($sqlAddress,$array = array());
		for($i=0;$i<$numRowsAddress;$i++)
		{
			$selected = "";
			$document = $queryAddress[$i]['document'];
			$abbr = $queryAddress[$i]['abbr'];
			if(in_array($abbr,$doclistArr))
			{
				$selected = "checked";
			}
			?> 
			<input type="checkbox" name="doclist[]" value="<?php echo $abbr; ?>" <?php echo $selected; ?>  />&nbsp;<?php echo $document; ?>
			<?php
				if($i%2==0)
			{
				echo "<br>";
			}
		}
		?></td>
	</tr>
	
	<tr>
	<td><b></b></td>
	<td></td>
	<td><b></b></td>
		<td>
		<input type="hidden" name="BidderID" id="BidderID" value="<?php echo $_GET['BidderID']; ?>" />
		<input type="hidden" name="LeadID" id="LeadID" value="<?php echo $post; ?>" />
		<input type="submit" class="bluebutton" name="submit" value="Submit">   </td>
	</tr>
 
 
</table>
</form>
</body>
</html>
