<?php
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{
	$full_name = $_POST["full_name"];
	$mobile_number = $_POST["Phone"];
	$email_id = $_POST["email_id"];
	$city = $_POST["City"];
	$salary = $_POST["net_salary"];
	
	$approvel = $_POST['approvel'];
	
	$Activate = generateNumber(4);
	$app_code = date('dmy')."".$Activate;

$todayDate = date("Y-m-d")." 23:59:59";
$lastmonth = mktime(0, 0, 0, date("m"), date("d")-30, date("Y"));
$days30ago = date("Y-m-d",$lastmonth)." 00:00:00";

$checkDupSql = "select * from hdfc_pl_calc_leads where mobile_number = '".$mobile_number."' and mobile_number not in (9971396361,9911940202,9891118553,9811215138) and (Dated between '".$days30ago."' and '".$todayDate."')";
list($checkDupNum,$checkDupQuery)=MainselectfuncNew($checkDupSql,$array = array());
if($checkDupNum>0)
{
//HDFC OUtStanding
	header("Location: hdfc-personal-loan-new-thank.php");
	exit();
	
}
else
{
	//Insert DATA For HDFC PL
	$Dated = ExactServerdate();
	$dataInsert = array('name'=>$full_name, 'mobile_number'=>$mobile_number, 'email_id'=>$email_id, 'city'=>$city, 'net_salary'=>$salary, 'Dated'=>$Dated, 'AppID'=>$app_code, 'Status'=>$approvel);
	$last_inserted_id = Maininsertfunc ('hdfc_pl_calc_leads', $dataInsert);

		
	if($approvel=="chat")
	{
		header("Location: http://server.iad.liveperson.net/hc/18259720/?cmd=file&file=visitorWantsToChat&site=18259720&imageUrl=http://server.iad.liveperson.net/hcp/Gallery/ChatButton-Gallery/English/General/1a/&referrer=http://www.deal4loans.com&utm_content=ad+banner&utm_campaign=d4l/test/personal_loans.htm");
		exit();
	}
}	

}

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>HDFC Personal Loan</title>
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
<script type="text/javascript" src="ajax.js"></script>
<script type="text/javascript" src="ajax-dynamic-hdfc-pllist.js"></script>
<link href="css/hdfc_pl-new.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="/scripts/common.js"></script>
<script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
<script Language="JavaScript" Type="text/javascript">
function onFocusBlank(element,defaultVal){
	if(element.value==defaultVal){
		element.value="";
	}
}

function onBlurDefault(element,defaultVal){
	if(element.value==""){
		element.value = defaultVal;
	}
}

function addElement()
{
	var ni = document.getElementById('myDiv');
		
		if(ni.innerHTML=="")
		{		
			if(document.hdfc_calc.loan_running.value="on")
			{
				//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = '<table width="100%"  border="0" cellspacing="0" cellpadding="0"><tr><td width="23%" height="25" align="left" valign="middle" class="boldtxt">Availed Loan Amount</td><td width="29%" align="left"><input type="text" name="availed_loan_amt" id="availed_loan_amt"  style="width: 145px;" onkeyup="intOnly(this);" onkeypress="intOnly(this);" /></td><td width="25%" height="25" align="left" valign="middle" class="boldtxt">Amount of EMI Paying</td><td width="23%" align="left"><input type="text" name="hdfc_emi_amt" id="hdfc_emi_amt"  style="width: 145px;" onkeyup="intOnly(this);" onkeypress="intOnly(this);" /></td></tr><tr><td height="25" align="left" valign="middle" class="boldtxt">Tenure</td><td align="left"><select name="hdfc_loan_tenure" id="hdfc_loan_tenure" style="width:149px; font-size:13px; "><option value="">Please Select</option><option value="12">12 months (1 yr)</option><option value="24">24 months (2 yrs)</option><option value="36">36 months (3 yrs)</option><option value="48">48 months (4 yrs)</option><option value="60">60 months (5 yrs)</option></select></td><td height="25" align="left" valign="middle"  class="boldtxt">No Of EMI Paid ?</td><td align="left"><select name="no_emi_paid"  style="width: 149px; font-size:13px;"><option value="0">Please select</option><option value="1">Less than 9 months</option><option value="2">9 to 12 months</option><option value="3">more than 12 months</option ></select></td></tr></table>';
			}
		}
		
		return true;

	}


function removeElement()
{
		var ni = document.getElementById('myDiv');
		
		if(ni.innerHTML!="")
		{
		
			if(document.hdfc_calc.loan_running.value="on")
			{
				//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = '';
				
			}
		}
		
		return true;

	}

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

function chkpersonalloan(Form)
{
	var regMail = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9])+$/
	var dt,mdate;dt=new Date();
	var alpha=/^[a-zA-Z\ ]*$/;
	var alphanum=/^[a-zA-Z0-9]*$/;
	var num=/^[0-9]*$/;
	var space=/^[\ ]*$/;
	var iChars ="/@#$%^&*()+=-[]\\\';,.{}|\":<>?!";
	var myOption;
	var i;
	
	if(Form.day.value=="" ||  Form.day.value=="DD")
	{
		alert("Please fill your day of birth.");
		Form.day.focus();
		return false;
	}
	if(Form.day.value!="")
	{
	 if((Form.day.value<1) || (Form.day.value>31))
	{
	alert("Kindly Enter your valid Date of Birth(Range 1-31)");
	Form.day.focus();
	return false;
	}
	}
	if(!checkData(Form.day, 'Day', 2))
		return false;
	
	if(Form.month.value=="" || Form.month.value=="MM")
	{
		alert("Please fill your month of birth.");
		Form.month.focus();
		return false;
	}
	if(Form.month.value!="")
	{
	if((Form.month.value<1) || (Form.month.value>12))
	{
	alert("Kindly Enter your valid Month of Birth(Range 1-12)");
	Form.month.focus();
	return false;
	}
	}
	if(!checkData(Form.month, 'month', 2))
		return false;

	if(Form.year.value=="" || Form.year.value=="YYYY")
	{
		alert("Please fill your year of birth.");
		Form.year.focus();
		return false;
	}
		if(Form.year.value!="")
	{
	if((Form.year.value < "1948") || (Form.year.value >"1992"))
	{
		alert("Age Criteria! \n Applicants between age group 18 - 62 only are elgibile.");
		Form.year.focus();
		return false;
		}
	}
	
	if(!checkData(Form.year, 'Year', 4))
		return false;
		
	if((Form.Company_Name.value=="") || (Form.Company_Name.value=="Company Name")|| (Trim(Form.Company_Name.value))==false)
	{
		alert("Kindly fill in your Company Name!");
		Form.Company_Name.focus();
		return false;
	}
	else if(Form.Company_Name.value.length < 3)
	{
		alert("Kindly fill in your Company Name!");
		Form.Company_Name.focus();
		return false;
	}
	if(Form.company_cate_type.selectedIndex==0)
	{
		alert("Please enter Company Type");
		Form.company_cate_type.focus();
		return false;
	}
	if(Form.company_type.selectedIndex==0)
	{
		alert("Please enter Company Category");
		Form.company_type.focus();
		return false;
	}
	if(Form.residence_status.selectedIndex==0)
	{
		alert("Please enter Residence Status");
		Form.residence_status.focus();
		return false;
	}

	myOption = -1;
		for (i=Form.loan_running.length-1; i > -1; i--) {
			if(Form.loan_running[i].checked) {
				if(i==0)
				{
					if (Form.availed_loan_amt.value=='')
					{
							alert("Please Enter the Loan Amount availed from HDFC");
							Form.availed_loan_amt.focus();
							return false;
					}

					if (Form.hdfc_loan_tenure.selectedIndex==0)
					{
							alert("Please Select The Loan Tenure");
							Form.hdfc_loan_tenure.focus();
							return false;
					}
					if (Form.hdfc_emi_amt.value=='')
					{
							alert("Please Enter Amount of EMI Paying to  HDFC");
							Form.hdfc_emi_amt.focus();
							return false;
					}

					if (Form.no_emi_paid.selectedIndex==0)
					{
							alert("Please Enter No of EMI Paid so far");
							Form.no_emi_paid.focus();
							return false;
					}

				}
					myOption = i;
	
			}
		}
	
		if (myOption == -1) 
		{
			alert("Please select do you have any Personal loan running with HDFC or not");
			return false;
		}
	if(!Form.accept.checked)
	{
		alert("Accept the Terms and Condition");
		Form.accept.focus();
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

	</script>
</head>

<body>
<table width="990" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="6" class="lftshado">&nbsp;</td>
    <td bgcolor="#FFFFFF"><table width="965"  border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td><table width="100%"  border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="77%" height="74"><img src="new-images/hdfc-pl/hdfcbank_logo.gif" width="171" height="29"></td>
            <td width="23%"><img src="new-images/hdfc-pl/deal4loans_logo.gif" width="200" height="54"></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><table width="100%"  border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="200" height="290" align="left" valign="top"><img src="new-images/hdfc-pl/hdr1.gif" width="200" height="290"></td>
            <td width="187"><img src="new-images/hdfc-pl/hdr2-new.gif" width="187" height="290"></td>
            <td width="202"><img src="new-images/hdfc-pl/hdr3-new.gif" width="202" height="290"></td>
            <td width="193" align="left" valign="top"><img src="new-images/hdfc-pl/hdr4-new.gif" width="193" height="290"></td>
            <td width="183" align="left" valign="top"><img src="new-images/hdfc-pl/hdr5.gif" width="183" height="290"></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td height="3"></td>
      </tr>
      <tr>
        <td><table width="100%"  border="0" cellspacing="0" cellpadding="0">
          <tr>
<td width="280"   align="right" valign="top" bgcolor="#FFFFFF"><table width="100%"  border="0" cellspacing="0" cellpadding="0" style="border:1px solid #e4e4e4; ">
  <tr>
        <td height="33" align="center" bgcolor="#f3f3f3" class="frmhdng" style="font-size:14px; ">Features of HDFC Bank Personal Loan</td>
  </tr>
  <tr>
    <td><table width="275"  border="0" align="right" cellpadding="0" cellspacing="0">
      <tr>
        <td align="center" height="8" colspan="2"></td>
       </tr>
      <tr>
        <td width="22" align="center"><img src="new-images/hdfc-pl/bullet.gif" width="8" height="8"></td>
        <td width="253" height="30" align="left" class="blutxt" >Get cash loan upto 15 Lacs</td>
        </tr>
      <tr>
        <td width="22" align="center" valign="top" style="padding-top:4px; "><img src="new-images/hdfc-pl/bullet.gif" width="8" height="8"></td>
        <td height="30" align="left" class="blutxt"  >Rate of Interest ranges between<br>15.5-22 %</td>
        </tr>
      <tr>
        <td align="center"><img src="new-images/hdfc-pl/bullet.gif" width="8" height="8"></td>
        <td height="30" align="left" class="blutxt" >No collateral requirement</td>
        </tr>
      <tr>
        <td width="22" align="center"><img src="new-images/hdfc-pl/bullet.gif" width="8" height="8"></td>
        <td width="253" height="30" align="left" class="blutxt" >Get loans for 12 to 60 months</td>
        </tr>
      <tr>
        <td width="22" align="center"><img src="new-images/hdfc-pl/bullet.gif" width="8" height="8"></td>
        <td height="30" align="left" class="blutxt" >Repay in easy EMIs</td>
        </tr>
      <tr>
        <td align="center"><img src="new-images/hdfc-pl/bullet.gif" width="8" height="8"></td>
        <td height="30" align="left" class="blutxt" >Easy Documentation</td>
        </tr>
    </table></td>
  </tr>
</table></td>            
<td valign="top">
			<form name="hdfc_calc" method="POST" action="hdfc-personal-loan-new-thanks.php" onSubmit="return chkpersonalloan(document.hdfc_calc);">

			<table width="98%"  border="0" align="center" cellpadding="0" cellspacing="0"  class="frmbg">
              <tr>
                <td height="35" align="center" bgcolor="#f3f3f3" class="frmhdng">2nd Step Form</td>
              </tr>
              <tr>
                <td align="right" valign="top"><table width="100%"  border="0" align="right" cellpadding="0" cellspacing="0">
                  <tr>
                    <td width="1%" align="left" class="boldtxt">&nbsp;</td>
                    <td width="23%" height="28" align="left" class="boldtxt">DOB</td>
                    <td width="29%" align="left" class="boldtxt">
					<input name="full_name" id="full_name" type="hidden" value="<?php echo $full_name; ?>"/>
					<input name="Phone" id="Phone" type="hidden" value="<?php echo $Phone; ?>"/>
					<input name="email_id" id="email_id" type="hidden" value="<?php echo $email_id; ?>"/>
					<input name="City" id="City" type="hidden" value="<?php echo $City; ?>"/>
					<input name="net_salary" id="net_salary" type="hidden" value="<?php echo $net_salary; ?>"/>
					<input name="lead_id" id="lead_id" type="hidden" value="<?php echo $last_inserted_id; ?>"/>
					
					
					
                        <input name="day" type="text" id="day"  value="DD" style="  width:35px; font-size:12px; " onblur="onBlurDefault(this,'DD');" onfocus="onFocusBlank(this,'DD');" maxlength="2" onkeyup="intOnly(this);" onkeypress="intOnly(this);" tabindex="3"/>
                        <input  name="month" type="text" id="month" style="width:35px;  font-size:12px; " value="MM" onblur="onBlurDefault(this,'MM');" onfocus="onFocusBlank(this,'MM');" maxlength="2" onkeyup="intOnly(this);" onkeypress="intOnly(this);" tabindex="4"/>
                        <input name="year" type="text" id="year" style="width:59px;  font-size:12px; " value="YYYY" onblur="onBlurDefault(this,'YYYY');" onfocus="onFocusBlank(this,'YYYY');" maxlength="4" onkeyup="intOnly(this);" onkeypress="intOnly(this);" tabindex="4"/></td>
                    <td width="24%" align="left" class="boldtxt"> Company Category </td>
                    <td width="23%" align="left"><select name="company_type" id="company_type" tabindex="11" style="width: 149px; font-size:13px;">
                        <option value="">Please Select</option>
                        <option value="BPO">BPO</option>
                        <option value="Insurance">Insurance</option>
                        <option value="Others">Others</option>
                      </select>
                    </td>
                  </tr>
                  <tr>
                    <td align="left" class="boldtxt">&nbsp;</td>
                    <td height="28" align="left" class="boldtxt">Employment Status</td>
                    <td align="left"><select   name="Employment_Status"  id="Employment_Status" style="width:149px; font-size:13px;" tabindex="6" >
                        <option value="1">Salaried</option>
                        <option value="0">Self Employment</option>
                    </select></td>
                    <td align="left" class="boldtxt">Primary Account </td>
                    <td align="left"><select name="primary_acc" id="primary_acc"  style="width: 149px; font-size:13px;" tabindex="12" >
                        <option value="HDFC Bank">HDFC Bank</option>
                        <option value="Other">Other</option>
                    </select></td>
                  </tr>
                  <tr>
                    <td align="left" class="boldtxt">&nbsp;</td>
                    <td height="28" align="left" class="boldtxt">Company Name</td>
                    <td align="left"><input name="Company_Name" id="Company_Name" type="text" tabindex="7"    style="width: 144px;"  onblur="onBlurDefault(this,'Company Name');" onKeyUp="ajax_showOptions(this,'getCountriesByLetters',event)" onfocus="onFocusBlank(this,'Company Name');" /></td>
                    <td align="left" class="boldtxt">No. of Loan Running </td>
                    <td align="left"><select name="no_of_loans"  style="width: 149px; font-size:13px;" tabindex="13" >
                        <option value="">0</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">More than 3</option>
                    </select></td>
                  </tr>
                 
				  <tr>
				    <td align="left" class="boldtxt">&nbsp;</td>
				    <td height="28" align="left" class="boldtxt">Company Type </td>
				    <td align="left"><select name="company_cate_type" id="company_cate_type" style="width: 149px; font-size:13px;" tabindex="10">
                      <option value="0">Please Select</option>
                      <option value="1">Pvt Ltd</option>
                      <option value="2">MNC Pvt Ltd</option>
                      <option value="3">Limited</option>
                      <option value="4">Partnership</option>
                      <option value="5">Sole Proprietor</option>
                    </select></td>
				    <td align="left" class="boldtxt">Clubbed EMI :</td>
				    <td align="left"><input type="text" name="clubbed_emi" id="clubbed_emi"  style="width: 144px;" tabindex="14" onkeyup="intOnly(this);" onkeypress="intOnly(this);" /></td>
				  </tr>
				   <tr>
				   <td>&nbsp;</td>
				     <td height="28" align="left" class="boldtxt">Residence Status</td>
				     <td align="left"><select name="residence_status" id="residence_status" style="width: 149px; font-size:13px;" tabindex="10">
                      <option value="0">Please Select</option>
                      <option value="1">Owned</option>
                      <option value="2">Rented</option>
                      <option value="3">Company Provided</option>
                      </select></td>
					<td align="left" class="boldtxt">&nbsp;</td>
				     <td align="left">&nbsp;</td>
                  </tr>
				   <tr>
				   <td>&nbsp;</td>
				     <td height="28" colspan="2" align="left" class="boldtxt"><b>Personal Loan Running with HDFC Bank ?</b></td>
				     <td height="25" align="left" class="boldtxt" style="font-weight:normal; "><input type="radio" name="loan_running" id="loan_running" value="1" onClick="addElement();" style="border:none ;" tabindex="15"/>
  Yes &nbsp;
  <input type="radio" name="loan_running" id="loan_running" value="2" onClick="removeElement();" style="border:none ;" tabindex="16"/>
  No</td>
				     <td align="left">&nbsp;</td>
                  </tr>
                  <tr>
				  <td>&nbsp;</td>
                    <td colspan="4"  valign="top"><div id="myDiv"></div></td>
                    </tr>                  
                  <tr>
				  <td>&nbsp;</td>
                    <td height="58" colspan="3" align="left" valign="middle" class="privcytxt"  style="text-align:justify; padding-right:10px; "  ><input type="checkbox" style="border:none ;" name="accept" id="accept">    I / We declare that the information provided herein above is accurate and complete. I/We understand that the offer of the bank is only indicative and final sanction including the amount and the tenure of the loan is at the sole discretion of the bank  and subject to my creditability and the bank may at its discretion conduct additional verification to complete this process. </td>
                    <td align="left"><input name="image"  value="Submit" type="image" src="new-images/hdfc-pl/get_quote.gif" width="151" height="37"  style="border:0px;" /></td>
                  </tr>
                </table></td>
              </tr>
            </table></form></td>
            
          </tr>
        </table></td>
      </tr>
      <tr>
        <td height="3"></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
    </table></td>
    <td width="6" class="rgtshado">&nbsp;</td>
  </tr>
</table>


</body>
</html>
