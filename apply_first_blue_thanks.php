<?php
require 'scripts/db_init.php';
require 'scripts/functions.php';
require 'scripts/session_check.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		foreach($_POST as $a=>$b)
			$$a=$b;

			$userid = $_POST['get_reqid'];
			$email = $_POST['email'];
			$full_name = $_POST['full_name'];
			$mobile = $_POST['mobile'];
			list($firstn,$lastn) = split(" ",$full_name);
			

	$Reference_Code = generateNumber(4);
	$app_code = date('dmy')."".$Reference_Code;
		$SMSMessage = "Dear Customer, the activation code - $Reference_Code for First Blue home finance Process. Use in activation code box to verify your mobile number.";
	if(strlen(trim($mobile)) > 0)
	{
		SendSMS($SMSMessage, $mobile);
	}
			
if($userid>0)
	{
		$dataUpdate = array('firstblue_name'=>$full_name, 'firstblue_mobile'=>$mobile, 'firstblue_email'=>$email, 'Reference_Code'=>$Reference_Code, 'firstblue_appid'=>$app_code);
		$wherecondition = "(firstblueID=".$userid.")";
		Mainupdatefunc ('first_blue_leads', $dataUpdate, $wherecondition);
	}
}

$dataSql = "select * from first_blue_leads where firstblueID = ".$userid."";
list($alreadyExist,$dataQuery)=MainselectfuncNew($dataSql,$array = array());
$dataQuerycontr=count($dataQuery)-1;
$company_name = $dataQuery[$dataQuerycontr]['firstblue_company_name'];
$firstblue_city = $dataQuery[$dataQuerycontr]['firstblue_city'];
$firstblue_loanamt = $dataQuery[$dataQuerycontr]['firstblue_loanamt'];
$firstblue_roi = $dataQuery[$dataQuerycontr]['firstblue_roi'];
$firstblue_emi = $dataQuery[$dataQuerycontr]['firstblue_emi'];
$firstblue_tenure = $dataQuery[$dataQuerycontr]['firstblue_tenure'];

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
<style>
.frst_cl {
	color:#663300; 
	font-family:Verdana, Arial, Helvetica, sans-serif; 
	font-size:12px;
}
.btnclr {
background-color:#006EAB;
border:medium none;
color:#FFFFFF;
font-family:Verdana,Arial,Helvetica,sans-serif;
font-size:12px;
font-weight:bold;
height:25px;
width:120px;
}
</style>

<script>
function submitform(Form)
{
	var regMail = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9])+$/
	var dt,mdate;dt=new Date();
	
	var alpha=/^[a-zA-Z\ ]*$/;
	var alphanum=/^[a-zA-Z0-9]*$/;
	var num=/^[0-9]*$/;
	var space=/^[\ ]*$/;
	var iChars ="/@#$%^&*()+=-[]\\\';,.{}|\":<>?!";

	if(Form.residence_address.value=="")
	{
		alert("Kindly fill in your Residence Address!");
		Form.residence_address.focus();
		return false;
	}
	if((Form.Pincode.value=='PinCode') || (Form.Pincode.value=='') || Trim(Form.Pincode.value)==false)
{
alert("Kindly fill in your Pincode!");
Form.Pincode.focus();
return false;
}
else if(Form.Pincode.value.length < 6)
{
alert("Kindly fill in your Pincode(6 Digits)!");
Form.Pincode.focus();
return false;
}
else if(containsalph(Form.Pincode.value)==true)
{
alert("Kindly fill in your Correct Pincode (Numeric Only)!");
Form.Pincode.focus();
return false;
}

if(Form.office_std.value=="" || Form.office_std.value=="Std")

	{

		alert("Kindly fill in your Office Std Code!");

		Form.office_std.focus();

		return false;

	}

	if(Form.office_phone.value=="" || Form.office_phone.value=="Number")

	{

		alert("Kindly fill in your Office Number!");

		Form.office_phone.focus();

		return false;

	}
	if(Form.office_ext.value=="" || Form.office_ext.value=="Extn")

	{

		alert("Kindly fill in your Office Ext. If there is no Ext , kindly put 0!");

		Form.office_ext.focus();

		return false;

	}
	var a=Form.Pancard.value;
	
	var regex1=/^[a-zA-Z]{5}\d{4}[a-zA-Z]{1}$/;  //this is the pattern of regular expersion
	if(regex1.test(a)== false)
	{
	   alert('Please enter valid pan number');
	   Form.Pancard.focus();
	   return false;
	}
	
	if (Form.Pancard.value.charAt(3)!="P" && Form.Pancard.value.charAt(3)!="p")
	{
		alert("Please enter valid pan number.");
		Form.Pancard.focus();
		return false;
	}
	
	if ( ( Form.Defaulted[0].checked == false ) && ( Form.Defaulted[1].checked == false ) )
	{
	  alert ( "Please choose defaulted on any loan or credit card" ); 
	  return false; 
	}
	
	if ( ( Form.declined[0].checked == false ) && ( Form.declined[1].checked == false ) )
	{
	  alert ( "Please choose loan application declined in last month?" ); 
	  return false; 
	}
	


}


function containsdigit(param)
	{
		mystrLen = param.length;
		for(i=0;i<mystrLen;i++)
		{
			if((param.charAt(i)=="0") || (param.charAt(i)=="1") || (param.charAt(i)=="2") || (param.charAt(i)=="3") || (param.charAt(i)=="4") || (param.charAt(i)=="5") || (param.charAt(i)=="6") || (param.charAt(i)=="7") || (param.charAt(i)=="8") || (param.charAt(i)=="9") || (param.charAt(i)=="/"))
			{
				return true;
			}
		}
		return false;
	}

function containsalph(param)
	{
		mystrLen = param.length;
		for(i=0;i<mystrLen;i++)
		{
		if((param.charAt(i)<"0")||(param.charAt(i)>"9"))
		{
		return true;
		}
		}
		return false;
	}
function Trim(strValue)
	{
		var j=strValue.length-1;i=0;
		while(strValue.charAt(i++)==' ');
		while(strValue.charAt(j--)==' ');

		return strValue.substr(--i,++j-i+1);
	}

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

	window.onload = ajaxFunction;

</script>

<script language="javascript">

function verification()
{
		var get_RequestID = document.ccform.RequestID.value;
								
			var get_Phone = document.ccform.Phone.value;
		
			var get_id = document.ccform.verify_code.value;
			
				var queryString = "?get_Mobile=" + get_Phone +"&get_RequestID=" + get_RequestID +"&get_id=" + get_id ;
	//		alert(queryString); 
				ajaxRequest.open("GET", "verifyMobile_frstbl.php" + queryString, true);
				// Create a function that will receive data sent from the server
				ajaxRequest.onreadystatechange = function(){
					if(ajaxRequest.readyState == 4)
					{
					   var ajaxDisplay = document.getElementById('displayVerify');
					   ajaxDisplay.innerHTML = ajaxRequest.responseText;
					}
				}

				ajaxRequest.send(null); 
		

	}

 function rqtcllbck()
{
		var ni = document.getElementById('rqt_cllbck');
		ni.innerHTML = 'Thanks We Will Contact You Shortly';

}


</script>
</head>

<body>
<table width="990">
	<tr>
		<td  colspan="2" width="100%"><table width="100%" style="padding-left:5px; padding-top:5px;"><tr>
		<td width="197" height="117"><img src="new-images/first_blue_logo.jpg" width="188" height="117"/></td>
		<td width="773" align="center" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:26px; color:#F8C301; font-weight:450;"><table width="641" bgcolor="#EFEFE0" height="94" cellpadding="0" cellspacing="0" style="border:#000000 solid 1px;">
						<tr><td colspan="4" bgcolor="#CC541F" align="center" height="30" class="verdred13" style="color:#FFFFFF; font-size:14px; border-bottom:#D2CECC solid 1px; ">First Blue Home Loan Quote</td></tr>
						<tr><td width="173" align="center" class="frmtxt" style="color:#CC541F; border-right:#D2CECC solid 1px; border-bottom:#D2CECC solid 1px; font-size:13px;" bgcolor="#EFEFE0">Max Loan Amount</td>
						<td width="184" align="center" class="frmtxt" style="color:#CC541F; border-right:#D2CECC solid 1px; border-bottom:#D2CECC solid 1px; font-size:13px;" bgcolor="#EFEFE0">Interest Rate</td>
						<td width="129" align="center" class="frmtxt" style="color:#CC541F; border-right:#D2CECC solid 1px; border-bottom:#D2CECC solid 1px; font-size:13px;" bgcolor="#EFEFE0">Per Month EMI</td>
						<td width="87" align="center" class="frmtxt" style="color:#CC541F; border-bottom:#D2CECC solid 1px; font-size:13px;" bgcolor="#EFEFE0">Tenure</td>
						</tr>
						<tr>
						  <td style="border-right:#D2CECC solid 1px; font-weight:normal;" align="center" class="frst_cl"><? echo $firstblue_loanamt; ?></td>
						  <td style=" border-right:#D2CECC solid 1px; font-weight:normal;" align="center" class="frst_cl"><? echo $firstblue_roi; ?>&nbsp;<br><span style="font-size:9px;">(Monthly Reducing)</span></td><td style="border-right:#D2CECC solid 1px; font-weight:normal;" align="center"class="frst_cl"><? echo $firstblue_emi; ?></td><td style="font-weight:normal;" align="center" class="frst_cl"><? echo $firstblue_tenure; ?>&nbsp;<span style="font-size:9px;">(yrs)</span></td></tr>
					  </table></td></tr></table></td>
	</tr></table></td>
	</tr>
	<tr>
		<td colspan="2" valign="top" align="center"> 
			<table style="border:#666666 solid 1px;" align="center">
 <tr>
        <td>&nbsp;</td>

      </tr>
      <tr>
        <td bgcolor="#FFFFFF">
<table align="center" border="0" cellpadding="0" cellspacing="0" width="96%">
          <tr>
           
            <td width="817" valign="top"><table border="0" cellpadding="0" cellspacing="0" width="837" align="center">
              <tr>
                <td height="30" bgcolor="#F08600"><table width="100%"><tr><td height="30" align="center" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:13px; color:#FFFFFF;" width="81%"><b>First Blue Home Loan Application</b></td>
                <td width="19%" height="30" align="center" class="frst_cl"> <div id="rqt_cllbck" style="font-size:10px; color:#3333FF;"><a style="text-decoration:underline; cursor:pointer;" onClick="rqtcllbck();">Request a Call Back</a></div></td>
                </tr></table></td>
              </tr>
              <tr>
			 			 
			               <td width="837" height="286" valign="top"  align="center" bgcolor="#F8C301">
				<form action="apply_first_bluethanks.php"  method="post" name="ccform"  onSubmit="return submitform(document.ccform);"  enctype="multipart/form-data" >
                <input type="hidden" name="RequestID" value="<?php echo $userid ; ?>" />
								<input style="width:180px; height:21px;" type="hidden" name="company_name2" id="company_name2" value="<?php echo $company_name; ?>" readonly />
			
				<table width="95%"  border="0" align="center" cellpadding="4" cellspacing="4" bgcolor="#F8C301">
  <tr align="center">
    <td height="11" colspan="4"></td>
  </tr>
  <tr>
	<td width="149" height="26" align="left" class="frst_cl">First Name <span style="font-weight:normal; color:#FF0000; font-size:9;">*</span></td>

	<td width="200" align="left" class="frst_cl"><input style="width:150px;  height:21px;"  name="Name" id="Name" value="<?php echo $firstn; ?>" ></td>
	<td width="108" align="left" valign="top" class="frst_cl">Last Name <span style="font-weight:normal; color:#FF0000; font-size:9;">*</span></td>

	<td width="161" align="left" class="frst_cl1" ><input style="width:150px;  height:21px;"  name="l_Name" id="l_Name" value="<?php echo $lastn; ?>" ></td>
  </tr>
  
   <tr>
	<td height="26" align="left" class="frst_cl">Email <span style="font-weight:normal; color:#FF0000; font-size:9;">*</span></td>
	<td height="26" align="left" class="frst_cl"><input  style="width:150px;  height:21px;"   name="Email" id="Email" value="<?php echo $email; ?>" readonly  /></td>
	<td width="108" align="left" valign="top" class="frst_cl"><span class="frst_cl">Mobile No. </span> </td>

	<td width="161" align="left" class="frst_cl1" ><input   name="Phone" id="Phone" value="<?php echo $mobile; ?>"  type="hidden" >+91 <?php echo $mobile; ?><span id="displayVerify"><input type="text" name="verify_code" maxlength="4" style="width:35px;" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" /> <!--<a href="#" onClick="return verification();" style="font-size:10px; font-family:Verdana, Arial, Helvetica, sans-serif; text-decoration:none;">--><input type="button" value="Verify" name="verify" onClick="return verification();"><!--</a>--><div style="font-weight:normal; color:#FF0000; font-size:10px; text-align:left">Enter Verification code to validate  mobile.</div></span></td>
	
   </tr>
     <tr><td height="26" align="left" class="frst_cl">City <span style="font-weight:normal; color:#FF0000; font-size:9;">*</span></td>
	<td height="26" align="left" class="frst_cl"><input  style="width:150px;  height:21px;"   name="City" id="City" value="<?php echo $firstblue_city; ?>"  readonly  /></td><td colspan="2"></td>
	</tr> 
 <tr>
	<td height="26" align="left" valign="top" class="frst_cl">Resi Address Line 1 <span style="font-weight:normal; color:#FF0000; font-size:9;">*</span></td>
	<td height="26" align="left" class="frst_cl"><input type="text" name="residence_address" id="residence_address" style="width:150px;  height:21px;" ></td>
	<td align="left" valign="top" class="frst_cl">Resi Address Line 2</td>
	<td align="left"><span class="frst_cl" style="font-weight:normal; "><input type="text" name="office_address" id="office_address" style="width:150px;  height:21px;" >
    </span></td>
  </tr> 
   <tr>
	<td height="26" align="left" class="frst_cl">Pincode <span style="font-weight:normal; color:#FF0000; font-size:9;">*</span></td>
	<td height="26" align="left" class="frst_cl"><input  style="width:150px;  height:21px;" maxlength="6"  name="Pincode" id="Pincode" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" /></td>
	<td height="26" align="left" class="frst_cl">Resi Telephone</td>
	<td height="26" align="left" class="frst_cl"><input style="width:40px;  height:21px;" name="home_std" id="home_std" value="Std" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);"/> <input style="width:100px;  height:21px;" name="home_phone" id="home_phone" value="Number" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);"/></td>
   </tr>
  
  <tr>
	<td align="center" valign="top" colspan="4" >----------------------------------------------------------------------------------------------------------------</td>
  </tr>
   <tr><td align="left" valign="top" class="frst_cl">Employer  <span style="font-weight:normal; color:#FF0000; font-size:9;">*</span></td>
	 <td align="left" class="frst_cl"><input style="width:150px; height:21px;"  name="company_name" id="company_name" value="<?php echo $company_name; ?>" readonly /></td>
	 <td align="left" valign="top" class="frst_cl">Designation</td>
	<td align="left" class="frst_cl"><input style="width:150px; height:21px;"  name="Designation" id="Designation" /></td>
</tr>
   <tr><td align="left" valign="top" class="frst_cl">Office Telephone  <span style="font-weight:normal; color:#FF0000; font-size:9;">*</span></td>
	<td align="left" class="frst_cl"><input style="width:40px; height:21px;" value="Std" name="office_std" id="office_std" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);"/> <input style="width:60px; height:21px;" value="Number" name="office_phone" id="office_phone" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);"/> <input style="width:40px; height:21px;" value="Extn" name="office_ext" id="office_ext" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);"/></td>
	<td align="left" valign="top" class="frst_cl">Pancard <span style="font-weight:normal; color:#FF0000; font-size:9;">*</span></td>
<td align="left" class="frst_cl"><input style="width:150px; height:21px;"  name="Pancard" id="Pancard" maxlength="10" /></td>
	</tr>
	
   <tr>
	<td align="center" valign="top" colspan="4" >-------------------------------------------------------------------------------------------------------------</td>
  </tr>
  <tr>
	<td height="26" align="left" class="frst_cl" colspan="2">Ever defaulted on any loan or credit card? <span style="font-weight:normal; color:#FF0000; font-size:9;">*</span></td>
	<td height="26" align="left" class="frst_cl" colspan="2"><input type="radio" name="Defaulted" id="Defaulted" value="true" >Yes
<input type="radio" name="Defaulted" id="Defaulted" value="false" />No</td>

   </tr>
   
         <tr>
	<td height="26" align="left" class="frst_cl" colspan="2">Had loan application declined in last month? <span style="font-weight:normal; color:#FF0000; font-size:9;">*</span></td>
	<td height="26" align="left" class="frst_cl" colspan="2"><input type="radio" name="declined" id="declined" value="true" >Yes
<input type="radio" name="declined" id="declined" value="false" />No</td>

	 </tr>
	 <tr>
	<td align="center" valign="top" colspan="4" >&nbsp;</td>
  </tr>
<tr>
	<td height="26" align="left" valign="top" class="frst_cl" colspan="4">Select one document in each section below that you will provide as proof</td>
  </tr>
  
  <tr>
	<td height="26" align="left" valign="top" class="frst_cl">Proof of Income</td>
	<td ><select name="Income_Proof" id="Income_Proof"style="width:200px;" >
    <option value=""
    >Select</option>
    <option value="Latest ITR">Latest ITR</option>
    <option value="Form 16">Form 16</option>
    <option value="Salary ceritificate for last 3 months">Salary ceritificate for last 3 months</option>
    <option value="Pay slip - last 3 months">Pay slip - last 3 months</option>


</select>
</td>
<td colspan="2" align="left" valign="top">&nbsp;</td>
  </tr>
  <tr>
	<td height="26" align="left" valign="top" class="frst_cl">Proof of Address</td>
    <td>
    <select name="Address_Proof" id="Address_Proof" style="width:200px;">
    <option value="">Select</option>
    <option value="Ration Card">Ration Card</option>
    <option value="Telephone, electricity, water or gas bill less than 2 months old (incl downloaded)">Telephone, electricity, water or gas bill less than 2 months old (incl downloaded)</option>
    <option value="Latest Life Insurance policy premium receipts (paid)">Latest Life Insurance policy premium receipts (paid)</option>

    <option value="Post-paid mobile phone bill in your name">Post-paid mobile phone bill in your name</option>
    <option value="Letter from Employer certifying current mailing address">Letter from Employer certifying current mailing address</option>
    <option value="Passport">Passport</option>
    <option value="Election ID card">Election ID card</option>
    <option value="Registered Rental / Lease Agreement">Registered Rental / Lease Agreement</option>
    <option value="Property Registration documents/Ownership proof copy">Property Registration documents/Ownership proof copy</option>

    <option value="Passbook">Passbook</option>
    <option value="Bank statement (last 3 months)">Bank statement (last 3 months)</option>
    <option value="Driving License">Driving License</option>
    <option value="Loan repayment track record">Loan repayment track record</option>
    <option value=" Registration certificate (RC) of 4-wheeler in applicant's name"> Registration certificate (RC) of 4-wheeler in applicant's name</option>
</select></td>
<td colspan="2" align="left" valign="top">&nbsp;</td>
  </tr>
   <tr>
	<td height="26" align="left" valign="top" class="frst_cl">Proof of Identity</td><td ><select name="Identity_Proof" id="Identity_Proof"  style="width:200px;">
    <option value=""
    >Select</option>
    <option value="Passport">Passport</option>
    <option value="Election ID card">Election ID card</option>
    <option value="Driving License">Driving License</option>
    <option value="Photo Credit/Debit/ATM Card">Photo Credit/Debit/ATM Card</option>
    <option value="Government organisation ID card with signature and photo">Government organisation ID card with signature and photo</option>

    <option value="PAN Card">PAN Card</option>
    <option value="Company ID card">Company ID card</option>
    <option value="Insurance / Mediclaim Photo Card">Insurance / Mediclaim Photo Card</option>
    <option value="Ration Card">Ration Card</option>
    <option value="Home property papers (registered deed">Home property papers (registered deed</option>
    <option value="Registration certificate (RC) of vehicle in applicant's name">Registration certificate (RC) of vehicle in applicant's name</option>


</select></td>
<td colspan="2" align="left" valign="top">&nbsp;</td>
  </tr>
   <tr>
	<td height="26" align="left" valign="top" class="frst_cl">Bank Statement</td><td ><select name="Bank_Statement" id="Bank_Statement"  style="width:200px;" >
    <option value="">Select</option>
    <option value="Salary account bank statement - last 6 months">Salary account bank statement - last 6 months</option>
</select>
</td>
<td colspan="2" align="left" valign="top">&nbsp;</td>
  </tr> 

  <tr valign="bottom">

    <td height="40" colspan="4" align="center">
    

    <input name="submit" type="submit" class="btnclr" value="Submit" /></td>
    </tr>

  <tr valign="bottom">

    <td colspan="4" align="center">&nbsp;</td>
  </tr>
</table>
				</form>
				
				</td>
              </tr>
              <tr>
                <td colspan="2">&nbsp;</td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
     
	  </table>
		</td>
	</tr>
</table>
</body>
</html>
