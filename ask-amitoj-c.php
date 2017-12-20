<?php
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	session_start();
	if ($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			foreach($_POST as $a=>$b)
				$$a=$b;

			$custName = FixString($custName);
			$custEmail = FixString($custEmail);
			$day = FixString($day);
			$month = FixString($month);
			$year = FixString($year);
			$custCity = FixString($custCity);
			$custEmployment_Status = FixString($custEmployment_Status);
			$custPhone = FixString($custPhone);
			
			$custDependants = FixString($custDependants);
			$custEarningMembers = FixString($custEarningMembers);
			$dob = $day."-".$month."-".$year;	
	if($custEmployment_Status==1){$employ_stat="Salaried";}else{$employ_stat="Self Employed";}

//Ticketing System Code Starts
/* Generate tracking ID */
$useChars='AEUYBDGHJLMNPQRSTVWXZ123456789';
$trackingID = $useChars{mt_rand(0,29)};
for($i=1;$i<10;$i++)
{
    $trackingID .= $useChars{mt_rand(0,29)};
}

$message = "City : ".$custCity;
$message .= "<br>Employment Status : ".$employ_stat;
$message .= "<br>DOB : ".$dob;
$message .= "<br>Mobile Number : ".$custPhone;
$message .= "<br>Earning Members : ".$custEarningMembers;
$message .= "<br>Dependants : ".$custDependants;

//print_r($_POST);
//echo "<br>";
$hesk_ticketssql = "INSERT INTO `hesk_tickets` ( `trackid`,`name`,`email`,`subject`,`message`,`dt`,`lastchange`,`ip`,`status`, `view_message`) VALUES ('$trackingID','$custName','$custEmail','Debt Consolidation','$message',NOW(),NOW(),'$_SERVER[REMOTE_ADDR]','0', '$message')";
	$hesk_ticketsresult= ExecQuery($hesk_ticketssql);
$ID = mysql_insert_id();

//Ticketing System Code End
//echo "<br>";
	
	//	$sql = "INSERT INTO Ask_Amitoj_Section (Ask_Name, Ask_Email, Ask_City, Ask_Mobile, Ask_Emp_Status, Ask_Loan_Type, Ask_EMI_Amount, Ask_EMI_Paid, Ask_Loan_Tenure, Ask_ROI_Loan, Ask_CC_Holder, Ask_CC_Due, Ask_Loan_On_CC, Ask_Residential_Status, Ask_Vehicle_Owned, Ask_Query, Ask_Dated) VALUES ('$custName', '$custEmail', '$custCity', '$custPhone', '$custEmployment_Status', '$Loan_A', '$custEMI_Amount', '$custEMI_Paid', '$custTenure', '$custROI_Loan', '$custCC_Holder', '$custCC_Due', '$custLoan_On_CC', '$custResidential_Status', '$custVehicle_Owned', '$custQuery', Now())";
		
	//	$result= ExecQuery($sql);
		//echo "query".$sql;
		
		$msg = "Value Insert";
//exit();
$trackingURL='http://www.deal4loans.com/helpdesk/ticket.php?track='.$trackingID;

$headers  = 'From: Deal4loans <no-reply@deal4loans.com>' . "\r\n";
					$headers .= "Return-Path: <no-reply@deal4loans.com>\r\n";  // Return path for errors
					$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";/* Get e-mail message for customer */
$fp=fopen('helpdesk/emails/new_ticket.txt','r');
$message_Email=fread($fp,filesize('helpdesk/emails/new_ticket.txt'));
fclose($fp);
$subject = "Debt Consolidation";
$message_Email=str_replace('%%NAME%%',$custName,$message_Email);
$message_Email=str_replace('%%SUBJECT%%',$subject,$message_Email);
$message_Email=str_replace('%%TRACK_ID%%',$trackingID,$message_Email);
$message_Email=str_replace('%%TRACK_URL%%',$trackingURL,$message_Email);
$message_Email=str_replace('%%SITE_TITLE%%','AskAmitoj.com' ,$message_Email);
$message_Email=str_replace('%%SITE_URL%%','http://www.askamitoj.com' ,$message_Email);

$message_Email = "<pre style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px;'>".$message_Email."</pre>";
//$message_Email ="<pre>".$message_Email."</pre>";
//echo $message_Email;
//$message=str_replace('%%SITE_TITLE%%',$hesk_settings['site_title'] ,$message);
//$message=str_replace('%%SITE_URL%%',$hesk_settings['site_url'] ,$message);
@mail($custEmail,"Query Debt Consolidation",$message_Email,$headers);




	$headers = 'From: '.$custName.' <'.$custEmail.'>' . "\r\n";
	$headers .= "Return-Path: <".$From_Email.">\r\n";  // Return path for errors
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	$headers .= 'Bcc: mehra3@gmail.com' . "\r\n";
	$to = 'amitoj.sethi@gmail.com';
	$messagesend="<table><tr><td>Dear Sir,</td></tr><tr><td>$custQuery</td></tr><tr><td>City :&nbsp; $custCity</td></tr><tr><td>Mobile Number :&nbsp;$custPhone</td></tr><tr><td>Residential Status:&nbsp;$resi_stat</td></tr><tr><td>Employment Status:&nbsp;$employ_stat</td></tr><tr><td>Net Salary:&nbsp;$custNet_Salary</td></tr><tr><td>Loan running:&nbsp;$Loan_A</td></tr><tr><td>Amount of Emi Paying:&nbsp;$custEMI_Amount</td></tr><tr><td>No of EMI paid:&nbsp;$custEMI_Paid</td></tr><tr><td>ROI:&nbsp;$custROI_Loan</td></tr><tr><td>Tenure:&nbsp;$custTenure</td></tr><tr><td>credit card holder:&nbsp;$cc</td></tr><tr><td>Due On Card:&nbsp;$custCC_Due</td></tr><tr><td>Loan on Card:&nbsp;$loan_cc</td></tr><tr><td>regards<br>$custName</td></tr></table>";
//	mail($to, "Debt Consolidation", $message, $headers);

/*		echo "<script language=javascript>alert(' your request has been forwarded to our Loan Expert and you will recieve a personalized Debt Consolidation plan on your email id as per our records. ');"." location.href='Contents_Online_Users.php'"."</script>";*/

}

	
	
		?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Ask Amitoj Loan Queries | Loan Guru | Debt Consolidation| Deal4loans</title>
<!--<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">-->
<meta http-equiv="Content-Language" content="en-us">
<meta name="keywords" content="Debt Consolidation Solutions, Ask Amitoj, Loan Guru, Deal4loans Guru, Loan Queries">
<meta name="description" content="Get loan advice, loan eligibility and EMI calculators and other tips for your car, personal loans & credit card from experts on Deal4loans.com." />

<script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
<script language="javascript">

function askamitoj(Form)
{
	if(Form.custNet_Salary.value=="")
	{
		alert("Please enter your Annual Income");
			Form.custNet_Salary.focus();
			return false;
	}
	if(Form.custQuery.value=="")
	{
		alert("Please enter your Query");
		Form.custQuery.focus();
		return false;
	}
}

    var row_no=1;
    function addRowLoans(tbl,row){
        //so that user can only add 3 rows
        if(row_no<=4){   
       
        var textbox1 = '<select name="Type_Loan[]" id="Type_Loan[]" style="width:120px;"><option value="Property Loan">Property Loan</option><option value="Twowheeler Car Loan">Car 2wheeler Loan</option><option value="Personal Loan">Personal Loan</option><option value="Other Loans">Other Loans</option></select>';//for text box
		var textbox2 = '<input type="text" name="pl_loanamount[]" id="pl_loanamount[]" style="width:60px;" maxlength="30" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);">';
		var textbox3 = '<input type="text" name="pl_tenure[]" id="pl_tenure[]" style="width:40px;" maxlength="30" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);">';
		var textbox4 = '<input type="text" name="pl_emi[]" id="pl_emi[]" style="width:60px;" maxlength="30" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);">';
		var textbox5 = '<input type="text" name="pl_roi[]" id="pl_roi[]" style="width:60px;" maxlength="30">';
		var textbox6 = '<input type="text" name="pl_emipaid[]" id="pl_emipaid[]" style="width:60px;" maxlength="30" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);">';
	
        var tbl = document.getElementById(tbl);//to identify the table in which the row will get insert
        var rowIndex = document.getElementById(row).value;//to identify the row after which the row will be inserted
        try {
            var newRow = tbl.insertRow(row_no);//creation of new row
          // var newCell = newRow.insertCell(0);//first  cell in the row
            //newCell.innerHTML = text;//insertion of the 'text' variable in first cell
            var newCell = newRow.insertCell(0);//second cell in the row
            newCell.innerHTML = "<table width='100%' cellspacing='0' cellpadding='0' border='0'><tr><td width='24%'> " + textbox1 + " </td><td width='17%'> " + textbox2 + "</td><td width='10%'> " + textbox3 + "</td><td width='14%'> " + textbox4 + "</td><td width='11%'> " + textbox5 + "</td><td width='14%'> " + textbox6 + "</td></tr></table>";//insertion of the text box and the remove text using their variable
            row_no++;
        } catch (ex) {
            alert(ex); //if exception occurs
        }
           
    }
    if(row_no>4)//if the row contain 3 textbox, the add button will disapper
    {
       //alert("You can add Only 5 Rows");
	    document.getElementById("add").style.display="none";
    }                       
}

//http://www.codingforums.com/archive/index.php?t-105270.html

    var rownumber=1;
    function addRowCards(tbname,countrow){
        //so that user can only add 3 rows
        if(rownumber<=4){   
       
        var textbox10 = '<select name="card_due_payment[]" id="card_due_payment[]" style="width:120px;"><option value="M A D">M A D **</option><option value="Less than M A D">Less than M A D</option><option value="More than M A D">More than M A D</option><option value="Full Payment">Full Payment</option></select>';//for text box
		var textbox20 = '<input type="text" name="card_name[]" id="card_name[]" style="width:60px;" maxlength="30" >';
		
        var tbname = document.getElementById(tbname);//to identify the table in which the row will get insert
        var rowIndex = document.getElementById(countrow).value;//to identify the row after which the row will be inserted
        try {
            var newRowCards = tbname.insertRow(rownumber);//creation of new row
           // var newCell = newRowCards.insertCell(0);//first  cell in the row
            //newCell.innerHTML = "Heloo";//insertion of the 'text' variable in first cell
            var newCell = newRowCards.insertCell(0);//second cell in the row
            newCell.innerHTML  = "<table width='100%' cellspacing='0' cellpadding='0' border='0'><tr><td width='24%'> " + textbox10 + " </td><td width='17%'> " + textbox20 + "</td></tr></table>";//insertion of the text box and the remove text using their variable
            rownumber++;
        } catch (ex) {
            alert(ex); //if exception occurs
        }
           
    }
    if(rownumber>4)//if the row contain 3 textbox, the add button will disapper
    {
//       alert("You can add Only 5 Rows");
    document.getElementById("addCards").style.display="none";
    }
}

</script>
<link href="includes/style1.css" rel="stylesheet" type="text/css">

<?php include '~Top.php';?>
<div id="dvMainbanner">
<? if ((($_REQUEST['flag'])!=1))
	{ ?>
    <?php include '~Upper.php';?><? } ?> 
    <div id="dvbannerContainer"><table width="777" height="161" border="0" Background="images/plain copy.gif" >
      <tr><td width="30%" align="center"><img src="images/amitojsir.gif"></td><td width="70%" align="left" valign="top"><font style="font-size:20px; font-family:Verdana, Arial, Helvetica, sans-serif; color:#FFFFFF;">Ask Amitoj</font>
      <p style="font-size:12px; font-family:Arial, Helvetica, sans-serif; color:#FFFFFF;"><b>Profile :- </b> Masters in Marketing from JBIMS, Amitoj has worked with Citibank
for more than 9 years in the areas of Operations, Credit, Sales and
Marketing. He has more than 4 years of exposure to Personal Loans and more
than 3 years to Credit Cards in the areas of product development,
acquisition channel enhancement and credit underwriting.</p>
</td>
</tr>
<tr>
<td align="center"  style="font-size:12px;font-family:Arial, Helvetica, sans-serif; color:#FFFFFF; font-weight:bold;">Amitoj Sethi (Director)</td>
<td align="right" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:16px; font-weight:bold; color:#FFFFFF;">Loans by choice not by chance!!</td>
</tr></table> </div>
</div>
  <!-- End Main Banner Menu Panel -->
  <!-- Start Main Container Panel -->
  <div id="dvContentPanel">
       <div id="dvMaincontent">
	
<br />
		<table width="515" border="0" align="left" cellpadding="0" cellspacing="0">
          <tr>
            <td align="center"><table width="370" align="center" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="10" height="26" align="left" valign="top"><img src="images/frm-lft-bg.gif" width="10" height="26"></td>
                  <td align="center" bgcolor="#3178BB"  class="head2" style="color:#FFFFFF; ">Financial  Details (Step 1)</td>
                  <td width="10" height="26" align="right" valign="top"><img src="images/frm-rgt-bg.gif" width="10" height="26"></td>
                </tr>
              </table>          </tr>
          <tr>
            <td><table width="515" align="center" border="0" cellspacing="0" cellpadding="0" bgcolor="#F2F6FA"   style="border:1px solid #6B9ECE;">
                <tr>
                  <td><form name="ask_amitoj_form"  method="post" action="ask-amitoj-submit.php" onSubmit="return askamitoj(document.ask_amitoj_form);"><table border="0" width="95%"cellpadding="4" cellspacing="0" id="frm" align="center">
                      
                        <tr>
                          <td width="33%" height="40" align="left">Net Monthly Income</td>
                          <td width="66%" ><input type="hidden" name="DataSubmited" id="DataSubmited" value="<?php echo $message; ?>" >
						  <input type="hidden" name="custCity" id="custCity" value="<?php echo $custCity; ?>" >
						  <input type="hidden" name="custEmployment_Status" id="custEmployment_Status" value="<?php echo $custEmployment_Status; ?>" >
						  <input type="hidden" name="dob" id="dob" value="<?php echo $dob; ?>" >
						  <input type="hidden" name="custPhone" id="custPhone" value="<?php echo $custPhone; ?>" >
						  <input type="hidden" name="custEarningMembers" id="custEarningMembers" value="<?php echo $custEarningMembers; ?>" >
						  <input type="hidden" name="custDependants" id="custDependants" value="<?php echo $custDependants; ?>" >
						  <input type="hidden" name="HeskID" id="HeskID" value="<?php echo $ID; ?>" >
						  
						  
							<input type="hidden" name="custName" value="<?php echo $custName; ?>">						  
						  <input type="hidden" name="custEmail"  value="<?php echo $custEmail; ?>">
						  
						  <input type="text" name="custNet_Salary" id="custNet_Salary" style="width:120px;" maxlength="30" onChange="intOnly(this);" onKeyUp="intOnly(this);getDigitToWords('custNet_Salary','formatedlA','wordloanAmount');"  style="float: left" onKeyDown="getDigitToWords('custNet_Salary','formatedlA','wordloanAmount');" onKeyPress="intOnly(this); getDigitToWords('custNet_Salary','formatedlA','wordloanAmount');" onBlur="getDigitToWords('custNet_Salary','formatedlA','wordloanAmount');">
						  </td>
                        </tr>

<tr><td colspan="2"><span id='formatedlA' style='font-size:11px; font-weight:bold;color:666699;font-Family:Verdana;'></span><span id='wordloanAmount' style='font-size:11px; font-weight:bold;color:666699;font-Family:Verdana;text-transform: capitalize;'></span></td></tr>	
						
                        <tr>
                          <td colspan="2" align="left"><span style="font-size:12px;">Assets</span><table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td width="34%" height="22">Land / Property</td>
                              <td width="34%"> Car / Two Wheeler</td>
                              <td width="34%">Share/Insurance/FD/ Gold</td>
                            </tr>
                            <tr>
                              <td><select style="width:120px;" name="Assets_Property" id="Assets_Property">
                              <option selected value="Owned">Owned</option>
                              <option  value="Financed">Financed</option>
                              <option value="Rented">Rented</option>
                              <option value="Do not own">Do not own</option>
                          </select></td>
                              <td><select style="width:120px;" name="Assets_Vechile" id="Assets_Vechile">
                                  <option selected value="Owned">Owned</option>
                                  <option  value="Financed">Financed</option>
                                  <option value="Company Provided">Company Provided</option>
                                  <option value="Do not own">Do not own</option>
                              </select></td>
                              <td><select style="width:120px;" name="Assets_Others" id="Assets_Others">
                                <option selected value="Owned">Owned</option>
                                <option  value="Pledged">Pledged</option>
                                <option value="Do not own">Do not own</option>
                              </select></td>
                            </tr>
                          </table></td>
                        </tr>
                        <tr>
                          <td colspan="2" align="left" ><font size="1" color="#FF0000">*</font>R O I = Rate of Interest&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;                              <font size="1" color="#FF0000">**</font>M A D = Minimum Amount Due</td>
                        </tr>
                        <tr>
                          <td colspan="2"><span style="font-size:12px;">Loan Details</span>
                              <table width="100%" border="0" cellspacing="0" cellpadding="0"> 
  <tr><td>
  <table width="100%" border="0" cellspacing="0" cellpadding="0"> 
 <tr><td width='24%' height='22' align='left'>Loan Type </td><td width='17%' align='center' valign='top'>Loan Amount</td><td width='10%' align='center' valign='top'>Tenure<br>
 (Months)</td>
   <td width='14%' align='center' valign='top'>EMI</td><td width='11%' align='center'>R O   I<font size='1' color='#FF0000'>*</font><br>(%)</td><td width='14%' align='center' valign='top'>EMI   Paid</td></tr>
 <tr><td width='24%'>
 <select name="Type_Loan_1" id="Type_Loan_1" style="width:120px;"><option value="Property Loan">Property Loan</option><option value="Twowheeler Car Loan">Car/2wheeler Loan</option><option value="Personal Loan">Personal Loan</option><option value="Other Loans">Other Loans</option></select></td>
 
 <td width='17%'><input type="text" name="pl_loanamount_1" style="width:60px;" maxlength="30" onChange="intOnly(this);" onKeyUp ="intOnly(this);" onKeyPress ="intOnly(this);"></td>
 <td width='10%'><input type="text" name="pl_tenure_1" style="width:40px;" maxlength="30" onChange="intOnly(this);" onKeyUp ="intOnly(this);" onKeyPress ="intOnly(this);"></td>
 <td width='14%'><input type="text" name="pl_emi_1" id="pl_emi_1" style="width:60px;" maxlength="30" onChange="intOnly(this);" onKeyUp ="intOnly(this);" onKeyPress ="intOnly(this);"></td>
 <td width='11%'><input type="text" name="pl_roi_1" style="width:60px;" maxlength="30" ></td>
 <td width='14%'><input type="text" name="pl_emipaid_1" style="width:60px;" maxlength="30" onChange="intOnly(this);" onKeyUp ="intOnly(this);" onKeyPress ="intOnly(this);"></td>
 </tr>
 </table></td></tr>
 <tr><td align="right">
 
  <table width="100%" border="0" cellspacing="0" cellpadding="0" id="mytable">
   
   
    <tr id="myrow"><td align="center"></td></tr>
   <tr ID="add" >
         <td align="right" ><input type="button" name="Button" id="Button" value="Add" onClick="addRowLoans('mytable','myrow')"></td>
    </tr>
  <!--  <tr ID="add">
      <td width="177"> </td>
      <td width="273" align="right"> </td>
    </tr>-->
  </table>
 </td></tr></table></td>
     </tr>
                        <tr>
                          <td colspan="2"><span style="font-size:12px;">Card Details</span> <table width="100%" border="0" cellspacing="0" cellpadding="0"> 
  <tr><td>
  <table width="100%" border="0" cellspacing="0" cellpadding="0"> 
 <tr><td width='24%' height='22' align='left'>Monthly Payment Due on Card</td><td width='17%' align='left' valign='top'>Outstanding on Card</td></tr>
 <tr><td width='24%' height='22' align='left'><select name="card_due_payment_1" id="card_due_payment_1" style="width:120px;"><option value="M A D">M A D **</option><option value="Less than M A D">Less than M A D</option><option value="More than M A D">More than M A D</option><option value="Full Payment">Full Payment</option></select></td><td width='17%' align='left' valign='top'><input type="text" name="card_name_1" id="card_name_1" style="width:60px;" maxlength="30" ></td></tr>
 </table></td></tr>
 <tr><td>
 <table width="100%" border="0" cellspacing="0" cellpadding="0" id="mytableCards">
   
   
    <tr id="myrowCards"><td colspan="2" align="center"></td></tr>
   <tr ID="addCards" >
         <td align="right" colspan="2"><input type="button" name="Button" id="Button" value="Add" onClick="addRowCards('mytableCards','myrowCards')"></td>
    </tr><!--
    <tr ID="addCards">
      <td colspan="2"> </td>
    </tr>-->
	  </table>
 </td></tr></table></td>
                        </tr>
                        	<tr>
						                        <td colspan="2" align="left"><span style="font-size:12px;">Query</span></td>
						</tr>
                        
                        <tr>
						  <td colspan="2" align="left"><textarea cols="92" rows="4" name="custQuery"></textarea></td>
						</tr>
                        <tr>
                          <td colspan="2" align="center" ><br>
                              <input value="" type="submit" style=" background-image:url(images/sbmt-btn.gif); border:0px; width:64px; height:30px; margin-bottom:0px;"  />                          </td>
                        </tr>    
                  </table></form></td>
                </tr>
            </table></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
      </table>
    </div>
    <?
  include '~Right2.php';

  ?>
  </div>
  <? if ((($_REQUEST['flag'])!=1))
	{ ?>
<?php include '~Bottom.php';?><? } ?>
</body>
</html>