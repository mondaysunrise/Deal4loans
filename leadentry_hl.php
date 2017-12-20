<?php
require 'scripts/db_init.php';
require 'scripts/functions.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST'){

$checkmobile_no = $_POST["checkmobile_no"];

$tomorrow  = mktime(0, 0, 0, date("m")  , date("d")-90, date("Y"));
	$days30date=date('Y-m-d',$tomorrow);
	$days30datetime = $days30date." 00:00:00";
	$currentdate= date('Y-m-d');
	$currentdatetime = date('Y-m-d')." 23:59:59";

$chklst="Select * from Req_Loan_Home Where (Mobile_Number=".$checkmobile_no." and Updated_Date between '".$days30datetime."' and '".$currentdatetime."' )";
list($recordcount,$row)=MainselectfuncNew($chklst,$array = array());
if($row[0]["RequestID"]>0 && $recordcount>0)
	{
			$msg="NO";
		}
		else
		{
			$msg="OK";
		}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Home Loan Lead Entry</title>
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
		<td class="bodyarial11"><span class="style1"><?php echo $row[0]["RequestID"]; ?></span></td>
			<td class="bodyarial11"><span class="style1"><?php echo $row[0]["Name"]; ?></span></td>
			<td class="bodyarial11"><span class="style1"><?php echo $row[0]["Email"]; ?></span></td>
			<td class="bodyarial11"><span class="style1"><?php echo $row[0]["Mobile_Number"];?></span></td>
			<td class="bodyarial11"><span class="style1"><?php echo  $row[0]["Net_Salary"];?></span></td>
			<td class="bodyarial11"><span class="style1"><?php echo $row[0]["City"]; ?></span></td>
			<td class="bodyarial11"><span class="style1"><?php echo  $row[0]["DOB"];?></span></td>
			<td class="bodyarial11"><span class="style1"><?php echo $row[0]["Updated_Date"];?></span></td>
            <td class="bodyarial11"><span class="style1"><?php echo $row[0]["Dated"]; ?></span></td>  
			<td class="bodyarial11 style1">
	 <?php 
	
	$BiddersChurn="SELECT Bidder_Name,Req_Feedback_Bidder_HL.BidderID As bid FROM Req_Feedback_Bidder_HL LEFT OUTER JOIN Bidders_List ON Bidders_List.BidderID = Req_Feedback_Bidder_HL.BidderID and Bidders_List.Reply_Type =2 WHERE (AllRequestID = '".$row["RequestID"]."' AND Req_Feedback_Bidder_HL.Reply_Type =2)";
	//echo $BiddersChurn;

	list($NumRowBiddersChurnSql,$newrow)=MainselectfuncNew($BiddersChurn,$array = array());
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
	 $GETFeedbackSql = "select Feedback from Req_Feedback_HL where AllRequestID=".$row["RequestID"]." and  Reply_Type=2";
	list($recordcount,$rowFeed)=MainselectfuncNew($GETFeedbackSql,$array = array());
	echo $Followup_Date = $rowFeed[0]['Feedback'];
	 ?>
    </span>    </td>
  </tr>
</table>
        <? } else { echo "Lead Doesnt Exist"; }?>
        <div style="clear:both; height:20px;"></div>
<form method="post" name="incoming_form2" action="leadentry_hl_thank.php">
<input type="hidden" value="incoming_call" name="source" id="source"  />
<table cellpadding="8" cellspacing="0" border="1" align="center">
<tr>
    	<td bgcolor="#FFFFFF"><strong>Mobile Number</strong></td>
      <td width="329"><input type="text" name="Mobile_Number" id="Mobile_Number" value="<? echo $checkmobile_no; ?>"/></td>
    
      <td width="155" bgcolor="#FFFFFF"><strong>Name</strong></td>
      <td width="300"><input type="text" name="Name" id="Name" /></td>
  </tr>
     <tr>
            <td width="211" bgcolor="#CCCCCC"><strong>Email</strong></td>
       <td bgcolor="#CCCCCC"><input type="text" name="Email" id="Email" /></td>

       <td bgcolor="#CCCCCC"><strong>Employment Status</strong></td>
 <td bgcolor="#CCCCCC"><select class="fontstyle" name="Employment_Status" id="Employment_Status">
			<option value="1" >Salaried</option>
			<option value="0" >Self Employed</option></select></td>
</tr>
     <tr>
        <td width="211" bgcolor="#FFFFFF"><strong>DOB</strong></td>
<td><input name="day" id="day" type="text" style="width:43px; " value="dd"  maxlength="2" />&nbsp;
                       
                        <input name="month" id="month" type="text" style="width:43px;" value="mm" maxlength="2" />&nbsp;<input name="year" id="year" type="text" style="width:60px; height:16px;" value="yyyy" maxlength="4" /></td>
    
        <td bgcolor="#FFFFFF"><strong>City</strong></td>
       <td><select size="1" name="City" id="City"> <?=plgetCityList($City)?></select></td>
     </tr>
     <tr>
        <td bgcolor="#CCCCCC"><strong>Other City</strong></td>
       <td bgcolor="#CCCCCC"><input type="text" name="City_Other" id="City_Other"></td>

        <td bgcolor="#CCCCCC"><strong>Company Name</strong></td>
       <td bgcolor="#CCCCCC"> <input name="Company_Name" id="Company_Name" type="text"  style="width:180px; height:16px;" onkeyup="ajax_showOptions(this,'getCountriesByLetters',event, 'http://www.deal4loans.com/ajax-list-plcompanies.php')" autocomplete="OFF"/></td>
    </tr>
    <tr>
        <td bgcolor="#FFFFFF"><strong>Annual Income</strong></td>
        <td valign="top"><input type="text" name="IncomeAmount" id="IncomeAmount" style="width:180px; "  onkeyup="intOnly(this); getDigitToWords('IncomeAmount','formatedIncome','wordIncome');"  onblur="getDigitToWords('IncomeAmount','formatedIncome','wordIncome');" /><span id='formatedIncome' style='font-size:11px;
font-weight:normal; font-Family:Verdana;'></span> <span id='wordIncome' style='font-size:11px;
font-weight:normal; font-Family:Verdana;text-transform: capitalize;'></span></td>
    <td bgcolor="#FFFFFF"><strong>Loan Amount</strong></td>
    <td valign="top"><input type="text" name="Loan_Amount" id="Loan_Amount" value="<? echo $Loan_Amount;?>" onKeyUp="getDigitToWords('Loan_Amount','formatedloan','wordloan');" onKeyPress="getDigitToWords('Loan_Amount','formatedloan','wordloan');" style="width:180px;" onBlur="getDigitToWords('Loan_Amount','formatedloan','wordloan');"><span id='formatedloan' style='font-size:11px; font-weight:bold;color:666699;font-Family:Verdana;'></span><span id='wordloan' style='font-size:11px;
font-weight:bold;color:666699;font-Family:Verdana;text-transform: capitalize;'></span>   </td>
    </tr>
    <tr>
    <td bgcolor="#CCCCCC"><strong>Residence Address</strong></td>
    <td bgcolor="#CCCCCC"><textarea  name="hlresiaddress" rows="2" cols="18"><? echo $Residence_Address;?></textarea> </td>
    <td bgcolor="#CCCCCC"><strong>Pincode</strong></td>
    <td bgcolor="#CCCCCC"><input type="text" name="hlpincode" size="10" value="<? echo $Pincode;?>" id="hlpincode"></td></tr>
    <tr>
        <td><strong>Residence No.</strong></td>
        <td><input type="text" name="hlstd_code" size="2" value="<? echo $Std_Code;?>" >-<input type="text" name="hllandline" size="10" value="<? echo $Landline;?>"></td>
    
    <td><strong>Office No.</strong></td>
    <td><input type="text" name="hlstd_code_o"  size="2" value="<? echo $Std_Code_O; ?>" >-<input type="text" name="hllandline_o" size="10" value="<? echo $Landline_O;?>"></td>
    </tr>
  
  <tr>
	<td bgcolor="#CCCCCC"><b>Property Identified</b></td>

	<td bgcolor="#CCCCCC" ><input type="radio" name="hlproperty_identified" <? if($Property_Identified==1){ echo "checked";}?> value="1">Yes<input type="radio" name="hlproperty_identified" <? if($Property_Identified==0){echo "checked";}?> value="0">No</td>
	<td bgcolor="#CCCCCC"><b>Property Location</b></td>
	<td bgcolor="#CCCCCC" ><select size="1" name="hlproperty_loc" id="hlproperty_loc"> <?=plgetCityList($Property_Loc)?></select>
    </td>
</tr>

<tr>
	<td><b>Property Value</b></td>
<td><input type="text" name="hlProperty_Value" id="hlProperty_Value" value="<? echo $Property_Value; ?>"></td>
	<td><b>Total Obligation</b></td>
<td><input type="text" name="hlTotal_Obligation" id="hlTotal_Obligation" value="<? echo $Total_Obligation; ?>"></td>
</tr>

<tr>
<td bgcolor="#CCCCCC" ><b>Loan Time</b></td>
	<td colspan="3" bgcolor="#CCCCCC" ><select name="hlloantime" >
	<option value="-1" <? if (($Loan_Time==-1) || ($Loan_Time=="")) { echo "selected";}?>>Please select</option>
    	<OPTION value="15 days" <? if($Loan_Time =="15 days"){echo "selected"; }?>>15 days</OPTION>
	<OPTION value="1 month" <? if($Loan_Time =="1 month"){echo "selected"; }?>>1 months</OPTION>
	<OPTION value="2 months" <? if($Loan_Time =="2 months"){echo "selected"; }?>>2 months</OPTION>
	<OPTION value="3 months" <? if($Loan_Time =="3 months"){echo "selected"; }?>>3 months</OPTION>
	<OPTION value="3 months above" <? if($Loan_Time =="3 months above"){echo "selected"; }?>>more than 3 months</OPTION>
	</SELECT>	</td>
</tr>
<tr>
	<td style="border:1px solid black;" colspan="4" bgcolor="#DAEAF9" align="center" class="fontstyle" ><b>Co applicant Details</b></td></tr>
	<tr>
	<td><b>Co Applicant Name:</b></td>
<td><input type="text" name="hlCo_Applicant_Name" id="hlCo_Applicant_Name" value="<? echo $Co_Applicant_Name; ?>"></td>
	<td ><b>Co-Applicant DOB</b></td><td><input type="text" name="hlCo_Applicant_DOB" id="hlCo_Applicant_DOB" value="<? echo $Co_Applicant_DOB; ?>"></td>
</tr>
<tr>
	<td bgcolor="#CCCCCC"><b>Co Monthly Income:</b></td>
<td bgcolor="#CCCCCC"><input type="text" name="hlCo_Applicant_Income" id="hlCo_Applicant_Income" value="<? echo $Co_Applicant_Income; ?>"></td>
	<td bgcolor="#CCCCCC" ><b>Co Applicant Obligation</b></td>
	<td bgcolor="#CCCCCC"><input type="text" name="hlCo_Applicant_Obligation" id="hlCo_Applicant_Obligation" value="<? echo $Co_Applicant_Obligation; ?>"></td>
</tr>

<tr>
	<td style="border:1px solid black;" colspan="4" bgcolor="#DAEAF9" align="center" class="fontstyle" ><b>Balance Transfer</b></td></tr>

<tr>
	<td width="25%"><b>Existing Bank</b></td>
	<td width="25%"><input type="text" name="hl_Existing_Bank" id="hl_Existing_Bank" value="<?php echo $Existing_Bank; ?>"></td>
	<td ><b>Existing Loan </b></td>
	<td ><input type="text" name="hl_Existing_Loan" id="hl_Existing_Loan" value="<?php echo $Existing_Loan; ?>"></td>
</tr>
<tr>
	<td width="25%"><b>Existing ROI</b></td>
	<td width="25%"><input type="text" name="hl_Existing_ROI" id="hl_Existing_ROI" value="<?php echo $Existing_ROI; ?>"></td>
	<td >&nbsp;</td>
	<td >&nbsp;</td>
</tr>
<tr>
	<td colspan="4" align="center"> <input type="submit" name="submit" value="submit"/></td>
</tr> 
 </table>
</form>
<? } 
else 
{ ?>
<form name="incoming_form" method="post" action="<? echo $_SERVER['PHP_SELF'] ?>">
<table align="center" border="1" cellpadding="5">
<tr>
<td colspan="2" align="center">Home Loan Entry form </td>
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
