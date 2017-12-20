<?php
require 'scripts/db_init.php';
require 'scripts/functions.php';

$IP_Remote = getenv("REMOTE_ADDR");
if($IP_Remote=='192.99.32.74') { $IP= $_SERVER['HTTP_X_REAL_IP']; }
else { $IP=$IP_Remote;	}

if(($IP=="122.176.100.27" || $IP=="122.176.100.28" || $IP=="122.176.122.134" || $IP=="122.161.196.68" ))
{
if ($_SERVER['REQUEST_METHOD'] == 'POST'){

$checkmobile_no = $_POST["checkmobile_no"];

$tomorrow  = mktime(0, 0, 0, date("m")  , date("d")-90, date("Y"));
	$days30date=date('Y-m-d',$tomorrow);
	$days30datetime = $days30date." 00:00:00";
	$currentdate= date('Y-m-d');
	$currentdatetime = date('Y-m-d')." 23:59:59";

$chklst="Select * from Req_Loan_Personal Where (Mobile_Number=".$checkmobile_no." and Updated_Date between '".$days30datetime."' and '".$currentdatetime."' )";
	list($recordcount,$row)=MainselectfuncNew($chklst,$array = array());
			$myrowcontr=count($row)-1;
		
		if($row[$myrowcontr]["RequestID"]>0 && $recordcount>0)
		{
			$msg="NO";
		}
		else
		{
			$msg="OK";
		}

}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
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
	.style1 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size:12px;}
</style>
<script>
/*var ajaxRequest;  // The variable that makes Ajax possible!
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
		
		function insertData()
		{
		var get_mobile_no = document.getElementById('mobile_no').value;
		var get_product = document.getElementById('product').value;
		var queryString = "?mobile_no=" + get_mobile_no + "&product=" + get_product;
				ajaxRequest.open("GET", "check_mobile_exist.php" + queryString, true);
				// Create a function that will receive data sent from the server
				ajaxRequest.onreadystatechange = function(){
					if(ajaxRequest.readyState == 4)
					{
						if(ajaxRequest.responseText=="OK")
						{	 document.getElementById("view_form").style.visibility= "visible" ;
							document.getElementById("check").style.bgcolor= "blue" ;
						
						}
						else
						{
							document.getElementById("view_form").style.visibility= "hidden" ;
						}
					}
				}
				ajaxRequest.send(null); 
		}*/
</script>
</head>
<body>

<? if(strlen($msg)>1) 
{ if($msg=="NO") { echo "Lead Exist"; ?>
<table border="1" cellpadding="3" cellspacing="0" align="center"><tr>
		<td class="head1 style1">Requestid</td>
			<td class="head1 style1">Name</td>
			<td class="head1 style1">Email</td>
			<td class="head1 style1">Mobile</td>
			<td class="head1 style1">Net_Salary</td>
			<td class="head1 style1">City</td>
			<td class="head1 style1">DOB</td>
			<td class="head1 style1">Doe</td>
            <td class="head1 style1">Allocation Date</td>
			<td class="head1 style1">Bidder Name</td>
				<td class="head1 style1">Feedback</td>
		</tr>
<tr>
		<td class="bodyarial11"><span class="style1"><?php echo $row["RequestID"]; ?></span></td>
			<td class="bodyarial11"><span class="style1"><?php echo $row["Name"]; ?></span></td>
			<td class="bodyarial11"><span class="style1"><?php echo $row["Email"]; ?></span></td>
			<td class="bodyarial11"><span class="style1"><?php echo $row["Mobile_Number"];?></span></td>
			<td class="bodyarial11"><span class="style1"><?php echo  $row["Net_Salary"];?></span></td>
			<td class="bodyarial11"><span class="style1"><?php echo $row["City"]; ?></span></td>
			<td class="bodyarial11"><span class="style1"><?php echo  $row["DOB"];?></span></td>
			<td class="bodyarial11"><span class="style1"><?php echo $row["Updated_Date"];?></span></td>
          <td class="bodyarial11"><span class="style1"><?php echo $row["Dated"]; ?></span></td>  
<td class="bodyarial11 style1">
	 <?php 
	
	$BiddersChurn="SELECT Bidder_Name,Req_Feedback_Bidder_PL.BidderID As bid FROM Req_Feedback_Bidder_PL LEFT OUTER JOIN Bidders_List ON Bidders_List.BidderID = Req_Feedback_Bidder_PL.BidderID and Bidders_List.Reply_Type =1 WHERE (AllRequestID = '".$row["RequestID"]."' AND Req_Feedback_Bidder_PL.Reply_Type =1)";
	//echo $BiddersChurn;
	list($NumRowBiddersChurnSql,$newrow)=MainselectfuncNew($BiddersChurnSql,$array = array());
	for($i=0;$i<$NumRowBiddersChurnSql;$i++)
	{
			$BidderID[]=$newrow[$i]["Bidder_Name"]."(".$newrow[$i]["bid"].")";
			//print_r($BidderID);
				}
	?>
	<?
	echo implode(',', $BidderID);
	?>    </td>
	 <td  class="bodyarial11">
	   <span class="style1">
	   <?php
	 $GETFeedbackSql = "select Feedback from Req_Feedback_PL where AllRequestID=".$row["RequestID"]." and  Reply_Type=1";
	list($NumRowrowFeed,$rowFeed)=MainselectfuncNew($GETFeedbackSql,$array = array());
	$CheckQuerycontr=count($rowFeed)-1;
	echo $Followup_Date = $rowFeed[$CheckQuerycontr]['Feedback'];
	 ?>
    </span>    </td>
  </tr>
</table>
        <? } else { echo "Lead Doesnt Exist"; }?>
        <div style="clear:both; height:20px;"></div>
<form method="post" name="incoming_form2" action="leadentry_pl_thank.php">
<input type="hidden" value="incoming_call" name="source" id="source"  />
<table cellpadding="8" cellspacing="0" border="1" align="center">
      <tr>
    	<td>Mobile Number</td>
      <td width="339"><input type="text" name="Mobile_Number" id="Mobile_Number" value="<? echo $checkmobile_no; ?>"/></td>
    </tr>
     <tr>
        <td width="236">Name</td>
        <td><input type="text" name="Name" id="Name" /></td>
    </tr>
     <tr>
        <td width="236">Email</td>
        <td><input type="text" name="Email" id="Email" /></td>
    </tr>
    <tr>
        <td>Employment Status</td>
        <td><select class="fontstyle" name="Employment_Status" id="Employment_Status">
			<option value="1" >Salaried</option>
			<option value="0" >Self Employed</option></select></td>
    </tr>
    <tr>
        <td width="236">DOB</td>
        <td><input name="day" id="day" type="text" style="width:43px; " value="dd"  maxlength="2" />&nbsp;
                       
                        <input name="month" id="month" type="text" style="width:43px;" value="mm" maxlength="2" />&nbsp;<input name="year" id="year" type="text" style="width:60px; height:16px;" value="yyyy" maxlength="4" /></td>
    </tr>
    <tr>
        <td>City</td>
        <td><select size="1" name="City" id="City"> <?=plgetCityList($City)?></select></td>
    </tr>
     <tr>
        <td>Other City</td>
        <td><input type="text" name="City_Other" id="City_Other"></td>
    </tr>
    <tr>
        <td>Company Name</td>
        <td> <input name="Company_Name" id="Company_Name" type="text"  style="width:180px; height:16px;" onkeyup="ajax_showOptions(this,'getCountriesByLetters',event, 'http://www.deal4loans.com/ajax-list-plcompanies.php')" autocomplete="OFF"/></td>
    </tr>
    <tr>
        <td>Annual Income</td>
        <td><input type="text" name="IncomeAmount" id="IncomeAmount" style="width:180px; "  onkeyup="intOnly(this); getDigitToWords('IncomeAmount','formatedIncome','wordIncome');"  onblur="getDigitToWords('IncomeAmount','formatedIncome','wordIncome');" /><span id='formatedIncome' style='font-size:11px;
font-weight:normal; font-Family:Verdana;'></span> <span id='wordIncome' style='font-size:11px;
font-weight:normal; font-Family:Verdana;text-transform: capitalize;'></span></td>
    </tr>
    <tr><td>Annual Turnover</td>
    <td><select name="Annual_Turnover" id="Annual_Turnover" style="width:180px;  font-family:Verdana, Geneva, sans-serif; font-size:11px; color:#4c4c4c;">		<option value="">Please Select</option>	<option value="1" > 0 To 40 Lacs</option>	<option value="4" > 40 Lacs To 1 Cr</option>		<option value="2" > 1Cr - 3Crs </option>	<option value="3" >3Crs & above</option></select>   </td></tr>
    <tr><td>Total Experience</td>
    <td><input style="width:90px;"  name="Total_Experience" onfocus="this.select();"> (Yrs) </td></tr>
    <tr><td>Current Experience</td>
    <td><input style="width:90px;"  name="Years_In_Company" > (Yrs) </td></tr>
    <tr>
        <td>Card Holder</td>
        <td><input type="radio" name="CC_Holder" id="CC_Holder" value="1" onclick="return addIdentified();" style="border:none;" /> Yes
                     <input type="radio"  name="CC_Holder" id="CC_Holder" onclick="removeIdentified();" value="0" style="border:none;" checked="checked" /> 
                     No</td>
    </tr>
    <tr>
    <td>Card Vimtage</td>
    <td><select size="1" name="Card_Vintage" style="width:180px; font-family:Verdana, Geneva, sans-serif; font-size:11px; color:#4c4c4c;" ><option value="0">Please select</option> <option value="1">Less than 6 months</option> <option value="2">6 to 9 months</option> <option value="3">9 to 12 months</option><option value="4">more than 12 months</option> </select></td>
    </tr>
  <tr>
  <td>Any type of loan(s) running?</td>
  <td><table width="100%" border="0" align="left" cellpadding="0" cellspacing="0"  style="color:#000000;"><tr> <td    height="20" align="left" ><input type="checkbox" style="border:none;" id="Loan_Any" name="Loan_Any[]"  value="hl" /> Home</td><td align="left"><input type="checkbox" style="border:none;"  id="Loan_Any" name="Loan_Any[]" value="pl" /> Personal</td><td align="left">&nbsp;</td></tr><tr> <td  width="71" height="20" align="left" ><input type="checkbox" style="border:none;"  name="Loan_Any[]"  id="Loan_Any" value="cl" /> Car</td><td width="93" align="left"  ><input type="checkbox" style="border:none;" name="Loan_Any[]" id="Loan_Any"  value="lap" /> Property</td><td width="160" align="left"  ><input type="checkbox" style="border:none;" name="Loan_Any[]" id="Loan_Any"  value="other" /> Other</td></tr></table></td></tr>
 <tr><td align="left" height="30" class="bldtxt">How many EMI paid?  </td> <td align="left" width="320"><select name="EMI_Paid" style="width:203px;"  > <option value="0">Please select</option><option value="1">Less than 6 months</option> <option value="2">6 to 9 months</option> <option value="3">9 to 12 months</option> <option value="4">more than 12 months</option ></select></td></tr>
 <tr>
 <td>Salary Account in which bank?</td>
 <td><select  name="Primary_Acc" id="Primary_Acc"><option value="">Please Select</option> <? $bnknm="select Bank_Name from Bank_Master group by Bank_Name "; 
list($cmp_nmerecordcount,$plbnk)=MainselectfuncNew($bnknm,$array = array());

for($cmp=0;$cmp<$cmp_nmerecordcount;$cmp++)
	{ ?>
			<option value="<? echo $plbnk[$cmp]["Bank_Name"]; ?>"><? echo $plbnk[$cmp]["Bank_Name"]; ?></option>
	<? }
	?>
<option value="Other">Other</option></select></td>
 </tr>
<tr>
	<td colspan="2" align="center"> <input type="submit" name="submit" value="submit"/></td>
</tr> 
 </table>
</form>
<? } 
else 
{ ?>
<form name="incoming_form" method="post" action="<? echo $_SERVER['PHP_SELF'] ?>">
<table align="center" border="1" cellpadding="5">
<tr>
<td colspan="2" align="center">PL Entry form </td>
</tr>
<tr>
    	<td width="241">Mobile Number</td>
      <td width="339"><input type="text" name="checkmobile_no" id="checkmobile_no" /><input type="submit" name="submit" id="submit" value="check"></td>
    </tr>
</table>
</form>
<? } ?>
</body>
</html>
