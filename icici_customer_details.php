<?php
require 'scripts/db_init.php';
require 'scripts/functions.php';
session_start();

$tonumber="";
$ccnumber="";
$fosname="";

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{	
	$customer_name = $_POST["customer_name"];
	$customer_mobile = $_POST["customer_mobile"];
	$City = $_POST["City"];
	$appointment_address = $_POST["appointment_address"];
	$appointment_place = $_POST["appointment_place"];
	$app_time = $_POST["app_time"];
	$appdate = $_POST["appdate"];
	$document_proof=$_POST['Document_proof'];
	$document_proof_doc=implode(",",$document_proof);
	$other_documents = $_POST['other_documents'];	
	$customer_telecaller = $_POST["customer_telecaller"];	
	$tomorrow  = mktime(0, 0, 0, date("m")  , date("d")-30, date("Y"));
	$days30date=date('Y-m-d',$tomorrow);
	$days30datetime = $days30date." 00:00:00";
	$currentdate= date('Y-m-d');
	$currentdatetime = date('Y-m-d')." 23:59:59";

if($City=="Delhi" || $City=="Noida" || $City=="Gurgaon" || $City=="Gaziabad" || $City=="Faridabad")
	{
		$tonumber = 9015351897;
		$ccnumber = 9213867329;
		$fosname = "Amit";
	}
	elseif($City=="Mumbai" || $City=="Thane" || $City=="Navi Mumbai")
	{
		$tonumber = 9768447241;
		$ccnumber = 8898501102;
		$fosname = "Gurunath";
	}
	elseif($City=="Chennai")
	{
		$tonumber = 9677187897;
		$ccnumber = 9094943230;
		$fosname = "Hari";
	}
	elseif($City=="Hyderabad")
	{
		$tonumber = 9032197399;
		$ccnumber = 9030973468;
		$fosname = "Shiva";
	}
	elseif($City=="Pune")
	{
		$tonumber = 8408881896;
		$ccnumber = 9657745787;
		$fosname = "Chetan";
	}
	elseif($City=="Bangalore")
	{
		$tonumber = 9066035143;
		$ccnumber = 8892323304;
		$fosname = "Harish";
	}
	elseif($City=="Kolkata")
	{
		$tonumber = 9066035143;
	}
			
	$getdetails="select iciciaaptid From icicipl_appointment_details  Where (icici_mobileno not in (9811215138) and icici_mobileno='".$customer_mobile."' and icici_dated between '".$days30datetime."' and '".$currentdatetime."') order by iciciaaptid DESC";
	list($alreadyExist,$myrow)=MainselectfuncNew($getdetails,$array = array());
	if($alreadyExist>0)
	{
		//echo "Lead Already Exist";				
	}
	else
	{
		$Dated = ExactServerdate();
		$dataInsert = array('icici_name'=>$customer_name, 'icici_mobileno'=>$customer_mobile, 'icici_city'=>$City, 'icici_appointment_address'=>$appointment_address, 'icici_appointment_place'=>$appointment_place, 'icici_app_time'=>$app_time, 'icici_appdate'=>$appdate, 'icici_document_proof'=>$document_proof_doc, 'icici_other_document'=>$other_documents, 'icici_telecaller'=>$customer_telecaller, 'icici_allocateno'=>$tonumber, 'icici_dated'=>$Dated);

	}
	//echo $InsertProductSql."<br>";
	$ProductValue = Maininsertfunc ('icicipl_appointment_details', $dataInsert);
	if($ProductValue>0)
		{
			$AgentSMSMessage="Appointment Fixed: $customer_name, $customer_mobile,add- $appointment_address,place- $appointment_place, $appdate $app_time ,docs- $document_proof_doc $other_documents";
			// send to SMS
			if(strlen(trim($tonumber)) > 0)
			{
				//echo $tonumber;
			 SendSMSforLMS($AgentSMSMessage, $tonumber);
			}
			
			//echo "<br><br>";
			// send cc SMS
			if(strlen(trim($ccnumber)) > 0)
			{
				//echo $ccnumber;
				SendSMSforLMS($AgentSMSMessage, $ccnumber);
			}
			
			if($ccnumber>2)
			{
				$SMSMessage = "Appointment Fixed: with ICICI at $app_time on $appdate, .".$fosname.",".$ccnumber.",will visit on the appointed day & doc Reqd ".$document_proof_doc.",".$other_documents;
				//sms to customer
				if(strlen(trim($ccnumber)) > 0)
				{
				 SendSMSforLMS($SMSMessage, $customer_mobile);
				}			
			}
		}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<title>Customer Details</title>
<script language="javascript" type="text/javascript" src="http://www.bimadeals.com/scripts/datetime.js"></script>
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
<style type="text/css">
.frmtxt {
color:#332D33;
font-family:Verdana,Arial,Helvetica,sans-serif;
font-size:11px;
font-weight:bold;
}
input {
border:1px solid #878787;
margin:0;
padding:0;
}
</style>
<Script Language="JavaScript">
function validmail(email1) 
{
	invalidChars = " /:,;";
	if (email1 == "")
	{// cannot be empty
		alert("Invalid E-mail ID.");
		return false;	
	}
	for (i=0; i<invalidChars.length; i++) 
	{	// does it contain any invalid characters?
		badChar = invalidChars.charAt(i);
		if (email1.indexOf(badChar,0) > -1) 
		{
			return false;
		}
	}
	atPos = email1.indexOf("@",1)// there must be one "@" symbol
	if (atPos == -1) 
	{
		alert("Invalid E-mail ID.");
		return false;
	}
	if (email1.indexOf("@",atPos+1) != -1) 
	{	// and only one "@" symbol
		alert("Invalid E-mail ID.");
		return false;
	}
	periodPos = email1.indexOf(".",atPos)
	if (periodPos == -1) 
	{// and at least one "." after the "@"
		alert("Invalid E-mail ID.");
		return false;
	}
	//alert(periodPos);
	//alert(email.length);
	if (periodPos+3 > email1.length)	
	{		// must be at least 2 characters after the "."
		alert("Invalid E-mail ID.");
		return false;
	}
	return true;
}

function chkform(Form)
{
	var regMail = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9])+$/
	var dt,mdate;dt=new Date();
	var alpha=/^[a-zA-Z\ ]*$/;
	var alphanum=/^[a-zA-Z0-9]*$/;
	var num=/^[0-9]*$/;
	var space=/^[\ ]*$/;
	var iChars ="/@#$%^&*()+=-[]\\\';,.{}|\":<>?!";

	if((Form.customer_name.value=="") || (Form.customer_name.value=="Name")|| (Trim(Form.customer_name.value))==false)
	{
		alert("Kindly fill in Customer Name!");
		Form.customer_name.focus();
		return false;
	}
	if(Form.customer_mobile.value=="")
	{
		alert("Please Enter Mobile Number");
		Form.customer_mobile.focus();
		return false;
	}

	if(isNaN(Form.customer_mobile.value)|| Form.customer_mobile.value.indexOf(" ")!=-1)
	{
	  alert("Enter numeric value");
		  Form.customer_mobile.focus();
		  return false;  
	}
	if (Form.customer_mobile.value.length < 10 )
	{
			alert("Please Enter 10 Digits"); 
			 Form.customer_mobile.focus();
			return false;
	}	

	if(Form.City.selectedIndex==0)
	{
		alert("Please enter City Name to Continue");
		Form.City.focus();
		return false;
	}

	if(Form.customer_c_name.value=="" )
	{
		alert("Please Enter Company Name");
		Form.customer_c_name.focus();
		return false;

	}
	if(Form.appdate.value=="")
	{
		alert("Please Enter Application Date");
		Form.appdate.focus();
		return false;
	}	  

	if(Form.app_time.selectedIndex==0)
	{
		alert("Please enter app time to Continue");
		Form.app_time.focus();
		return false;
	}  
	 if(Form.customer_telecaller.selectedIndex==0)
	{
		alert("Please enter telecaller name to Continue");
		Form.customer_telecaller.focus();
		return false;
	}
}
</script>
</head>
<body>
<?php include '~Top.php';?>
<table width="1000" border="0" align="center" cellpadding="0" cellspacing="0">
	
	<tr>
		<td><table cellpadding="0" cellspacing="0" border="0" width="100%">
			<tr>
				<td valign="top" ></td>
 <td align="center" valign="top"><table width="100%" border="0" align="center">
                <tr>
                  <td height="31" align="right" class="style1"></td>				  </tr>
				  <tr>
				<td> <table width="100%">
	<? if($alreadyExist>0)
	{ ?>
				<tr><td align="center" style="color:#7F6B53;"><b>Lead Already Exist</b></td></tr>
				<? } ?>

				<tr><td align="center" style="color:#7F6B53;"><b>ICICI Customer Details</b></td></tr>
					<tr>
						<td ><form name="ful_loan_form" method="POST" action="<? echo $_SERVER['PHP_SELF'] ?>" onSubmit="return chkform(document.ful_loan_form);">
							<table width="400" align="center" style="border:1px solid #DCD8D5;" cellpadding="2">
								<tr>
									<td width="203" height="26" class="frmtxt">Name</td>
									<td width="16" align="center" class="frmtxt">:</td>
									<td width="165"><input style="height:20px;" type="text" name="customer_name" id="customer_name" tabindex="1"/></td>
								</tr>
								<tr>
									<td class="frmtxt">Mobile</td>
									<td width="16" align="center" class="frmtxt">:</td>
									<td>+91<input type="text" name="customer_mobile" id="customer_mobile" style=" width:120px; height:20px; "tabindex="2" onChange="intOnly(this);" maxlength="10" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);"/></td>
								</tr>
								<tr>
									<td class="frmtxt">City</td>
									<td width="16" align="center" class="frmtxt">:</td>
									<td><select size="1" align="left" style="width:143px; height:20px;"  name="City" id="City" tabindex="6"/>
									<option value="Delhi">Delhi</option>
									<option value="Noida">Noida</option>
									<option value="Gurgaon">Gurgaon</option>
									<option value="Gaziabad">Gaziabad</option>
									<option value="Faridabad">Faridabad</option>
									<option value="Chennai">Chennai</option>
									<option value="Mumbai">Mumbai</option>
									<option value="Navi Mumbai">Navi Mumbai</option>
									<option value="Thane">Thane</option>
									<option value="Hyderabad">Hyderabad</option>
									<option value="Pune">Pune</option>
									<option value="Bangalore">Bangalore</option>
									<option value="Kolkata">Kolkata</option>
									</select></td>
								</tr>
                                <tr>
									<td class="frmtxt">Appt Address With <br />Pin Code & Landmark</td>
									<td width="16" align="center" class="frmtxt">:</td>
									<td><textarea cols="22" rows="3" type="text" name="appointment_address" id="appointment_address" tabindex="11" ></textarea></td>
								</tr>
                                <tr>
                                <td class="frmtxt">Appt Address Type </td>
                                <td width="16" align="center" class="frmtxt">:</td>
                                <td><select name="appointment_place" id="appointment_place" >
                                 <option>please select</option>
                                 <option value="Office" >Office</option>
                                 <option value="Residence">Residence</option>
                                 </select>
                                 </td></tr>
								<tr>
									<td class="frmtxt">Appointment Date</td>
									<td width="16" align="center" class="frmtxt">:</td>
									<td>
									

<input type='Text'  name='appdate' id='appdate' maxlength='25' size='15' value="<? echo $appointment_date;?>" tabindex="13" style="height:20px;"/>

									<a href="javascript:NewCal('appdate','yyyymmdd',false,'');" ><img src='images/cal.gif' width='16' height='16' border='0' alt='Pick a date'></a></span></td>

								</tr>
								<tr>
									<td class="frmtxt">Appointment Time</td>
									<td width="16" align="center" class="frmtxt">:</td>
									<td>
								<select name="app_time" id="app_time" tabindex="14">
										<option value="please select">Time slab</option>
									<option value="Call Before coming">Call Before coming</option>		
                                    <option value="8(am)-9(am)" >8(am)-9(am)</option>
                                    <option value="9(am)-10(am)" >9(am)-10(am)</option>
                                    <option value="10(am)-11(am)" >10(am)-11(am)</option>
                                    <option value="11(am)-12(am)" >11(am)-12(am)</option>
                                    <option value="12(am)-1(pm)" >12(am)-1(pm)</option>
                                    <option value="1(pm)-2(pm)">1(pm)-2(pm)</option>
                                    <option value="2(pm)-3(pm)" >2(pm)-3(pm)</option>
                                    <option value="3(pm)-4(pm)" >3(pm)-4(pm)</option>
                                    <option value="4(pm)-5(pm)" >4(pm)-5(pm)</option>
                                    <option value="5(pm)-6(pm)" >5(pm)-6(pm)</option>
                                    <option value="6(pm)-7(pm)" >6(pm)-7(pm)</option>
                                    <option value="7(pm)-8(pm)" >7(pm)-8(pm)</option>
										</select>									</td>

								</tr>
								
								<tr>
								<td height="25" colspan="3"  align="left" class="frmtxt">Which of the following Documents you Have?</td>

            <tr>
              <td colspan="3" class="frmtxt"> 
  
                        <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                          <tr>
                            <td width="7%" height="20" align="center" valign="middle"><input type="checkbox" value="Appt Letr" name="Document_proof[]" id="Document_proof" style="border:none;"/></td>
                            <td width="47%" align="left" class="frmtxt">Appointment Letter </td>
                            <td width="7%" align="center" valign="middle"><input type="checkbox" value="Form16" name="Document_proof[]" id="Document_proof"  style="border:none;"/></td>
                            <td width="39%" align="left" class="frmtxt">Form -16</td>
                          </tr>                     
                                                
                          <tr>
                            <td width="7%" height="20" align="center" valign="middle"><input type="checkbox" value="Pancard" name="Document_proof[]" id="Document_proof"style="border:none;" /></td>
                            <td width="47%" align="left" class="frmtxt">Pan Card </td>
                            <td width="7%" align="center" valign="middle"><input type="checkbox" value="Voterid" name="Document_proof[]" id="Document_proof"  style="border:none;"/></td>
                            <td width="39%" align="left" class="frmtxt">Voter Id </td>
                          </tr>

                          <tr>
                            <td height="20" align="center" valign="middle"><input type="checkbox" value="Passport" name="Document_proof[]" id="Document_proof"  style="border:none;"/></td>
                            <td align="left" class="frmtxt">Passport</td>
                            <td align="center" valign="middle"><input type="checkbox" value="Driving License" name="Document_proof[]" id="Document_proof"  style="border:none;"/></td>
                            <td align="left" class="frmtxt">Driving License </td>

                          </tr>
                          <tr>
                            <td height="20" align="center" valign="middle"><input type="checkbox" value="photo" name="Document_proof[]" id="Document_proof"  style="border:none;"/></td>
                            <td align="left" class="frmtxt">Passport size photo </td>
                            <td height="20" align="center" valign="middle"><input type="checkbox" value="LIC Policy" name="Document_proof[]" id="Document_proof"  style="border:none;"/></td>
                            <td align="left" class="frmtxt">LIC Policy </td></tr>
                          <tr>
                            <td height="20" align="center" valign="middle"><input type="checkbox" value="phone Bill" name="Document_proof[]" id="Document_proof"  style="border:none;"/></td>
                            <td align="left" class="frmtxt">Telphone Bill </td>
                            <td align="center" valign="middle"><input type="checkbox" value="Electricity Bill" name="Document_proof[]" id="Document_proof"  style="border:none;"/></td>
                            <td align="left" class="frmtxt">Electricity Bill </td>
                          </tr>
						  <tr>
                            <td height="20" align="center" valign="middle"><input type="checkbox" value="Loan Track" name="Document_proof[]" id="Document_proof"  style="border:none;"/></td>
                            <td align="left" class="frmtxt">Loan Track </td>
                            <td align="center" valign="middle"><input type="checkbox" value="CC phcopy" name="Document_proof[]" id="Document_proof"  style="border:none;"/></td>
                            <td align="left" class="frmtxt" >Credit Card photocopy</td>
                          </tr>
						  <tr>
                            <td height="20" align="center" valign="middle"><input type="checkbox" value="3 mnth salryslip" name="Document_proof[]" id="Document_proof"  style="border:none;"/></td>
                            <td align="left" class="frmtxt" >Latest 3 months Salary Slip </td><td align="center" valign="middle"><input type="checkbox" value="10th Certificate" name="Document_proof[]" id="Document_proof"  style="border:none;"/></td><td align="middle" class="frmtxt">10th Certificate</td>
							</tr>
							<tr>
							<td width="7%" align="center" valign="middle"><input type="checkbox" value="6 mnths bnkstat" name="Document_proof[]" id="Document_proof"  style="border:none;"/></td>
							<td align="left" class="frmtxt" >6 months Bank Statement</td><td align="center" valign="middle"><input type="checkbox" value="rent agreement" name="Document_proof[]" id="Document_proof"  style="border:none;"/></td><td align="middle" class="frmtxt">Rent Agreement</td>
                          </tr>

                        </table>                  </td>

            </tr>
            <tr>
              <td align="left" class="frmtxt">Other Documents required</td><td class="frmtxt" align="center">:</td><td><textarea cols="18" rows="2" type="text" name="other_documents" id="other_documents" tabindex="17" ></textarea></td>
			</tr>
          			<tr>
             <td  colspan="3" align="left"  >&nbsp;</td>
								</tr>                                
								<tr>
								 <td colspan="3" align="center"><input type="submit" style="border: 0px none ; background-image: url(images/submit.gif); width: 109px; height: 29px; margin-bottom: 0px;" value=""/></td>
								</tr>
								</table>
						</form></td>
					</tr>
				</table></td>
			</tr>
		</table></td>
	</tr>
</table>
</td></tr></table>
</body>
</html>
