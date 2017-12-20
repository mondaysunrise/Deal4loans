<?php
require 'scripts/functions.php';
require 'scripts/db_init.php';

$maxage=date('Y')-62;
$minage=date('Y')-18;

function getTableName($pKey)
{
    $titles = array(
        1=> 'Req_Loan_Personal',
        2=> 'Req_Loan_Home',
        3=> 'Req_Loan_Car',
        4=> 'Req_Credit_Card',
        5=> 'Req_Loan_Against_Property',
        6=> 'Req_Business_Loan'
    );
    foreach ($titles as $key=>$value)
        if($pKey==$key)
        return $value;

    return "";
}

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


if ($_SERVER['REQUEST_METHOD'] == 'POST'){

$pr_requestid = $_REQUEST["pr_requestid"];
$prdct_typ = $_REQUEST["prdct_typ"];
$pr_product=getTableName($prdct_typ);

$pr_details="Select RequestID, Name, Email, Mobile_Number, DOB, City, City_Other, Net_Salary, Loan_Amount, Company_Name,Employment_Status From ".$pr_product." Where (RequestID=".$pr_requestid.") ";

list($recordcount,$prresult)=MainselectfuncNew($pr_details,$array = array());
$prresultcontr=count($prresult)-1;

$Name = $prresult[$prresultcontr]["Name"];
$DOB = $prresult[$prresultcontr]["DOB"];

$getDOB = str_replace("-","", $DOB);
$age = DetermineAgeGETDOB($getDOB);
list($Year,$Month,$Day) = split('[-]', $DOB);

$Phone = $prresult[$prresultcontr]["Mobile_Number"];
$Employment_Status = $prresult[$prresultcontr]["Employment_Status"];
$Email = $prresult[$prresultcontr]["Email"];
$Company_Name = $row["Company_Name"];
$City = $prresult[$prresultcontr]["City"];
$Other_City = $prresult[$prresultcontr]["City_Other"];
$Net_Salary = $prresult[$prresultcontr]["Net_Salary"];
$Loan_Amount = $prresult[$prresultcontr]["Loan_Amount"];
$IP = $_SERVER['REMOTE_ADDR'];
$source ="hdfc_plmlr";
if(strlen($Name)>0 && strlen($Phone)>=10)
	{
	$CheckSqlpl = "select RequestID from Req_Loan_Personal where (Mobile_Number = '".$Phone."' and source='hdfc_plmlr')";
	list($CheckNumRowspl,$bidnwpl)=MainselectfuncNew($CheckSqlpl,$array = array());
	$bidnwplcontr=count($bidnwpl)-1;



	if($CheckNumRowspl>0)
	{
		$ProductValue = $bidnwpl[$bidnwplcontr]["RequestID"];
		$Dated = ExactServerdate();
		$DataArray = array("Updated_Date"=>$Dated );
		$wherecondition ="(RequestID='".$ProductValue."')";
		Mainupdatefunc ('Req_Loan_Personal', $DataArray, $wherecondition);
	}
	else
	{
		$CheckSql = "select UserID from wUsers where Email = '".$Email."'";
		list($CheckNumRows,$CheckQuery)=MainselectfuncNew($CheckSql,$array = array());
		$CheckQuerycontr=count($CheckQuery)-1;
		$UserID = $CheckQuery[$CheckQuerycontr]['UserID'];
		$Dated = ExactServerdate();		
		$dataInsert = array('UserID'=>$UserID, 'Name'=>$Name, 'Email'=>$Email, 'Employment_Status'=>$Employment_Status, 'Company_Name'=>$Company_Name, 'City'=>$City, 'City_Other'=>$City_Other, 'Mobile_Number'=>$Mobile_Number, 'Net_Salary'=>$Net_Salary, 'DOB'=>$DOB, 'Dated'=>$Dated, 'source'=>$source, 'Updated_Date'=>$Dated, 'IP_Address'=>$IP, 'Loan_Amount'=>$Loan_Amount);
		$ProductValue = Maininsertfunc ('Req_Loan_Personal', $dataInsert);
		}
		
		
		if($City=="Others" && strlen($City_Other)>0)
		{
			$strcity=$City_Other;
		}
		else
		{
			$strcity=$City;
		}

//echo $strcity."<br>";
		if($Net_Salary>=360000 && $age>=22 && $Employment_Status==1 && $ProductValue>=1)
		{
			$getbid= "select BidderID from Bidders_List Where (City like '%".$strcity."%' and BidderID in (1887,1888,1889,1890,1891,1948,1949,1950,1951,1952,1953,1954,1955,1956,1957,1958,1959,1960,2609,2626,2627,2628,2629) and Restrict_Bidder=1 and Reply_Type=1)";
			//echo "select BidderID from Bidders_List Where (City like '%".$strcity."%' and BidderID in (1887,1888,1889,1890,1891,1948,1949,1950,1951,1952,1953,1954,1955,1956,1957,1958,1959,1960) and Restrict_Bidder=1 and Reply_Type=1)";
			//echo "<br>";
			list($bidrecordcount,$bidnw)=MainselectfuncNew($getbid,$array = array());
			$bidnwcontr=count($bidnw)-1;


			if($bidrecordcount>0)
			{
				$BidderID = $bidnw[$bidnwcontr]['BidderID'];
				if($BidderID>1)
				{
					$DataBiddersArray = array("Bidderid_Details"=>$BidderID );
					$wherecondition ="(RequestID='".$ProductValue."')";
					Mainupdatefunc ('Req_Loan_Personal', $DataBiddersArray, $wherecondition);
				}
			}
		}
		
	}
	
}

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>HDFC Personal Loan</title>
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
	
	if((Form.Name.value=="") || (Form.Name.value=="Name")|| (Trim(Form.Name.value))==false)
	{
		alert("Kindly fill in your Name!");
		Form.Name.focus();
		return false;
	}
	else if(containsdigit(Form.Name.value)==true)
	{
		alert("Name contains numbers!");
		Form.Name.focus();
		return false;
	}
	for (var i = 0; i < Form.Name.value.length; i++) {
	if (iChars.indexOf(Form.Name.value.charAt(i)) != -1) {
		alert ("Name has special characters.\n Please remove them and try again.");
		Form.full_name.focus();
		return false;
	}
	}
		
			
	if((Form.Phone.value=='Mobile No') || (Form.Phone.value=='') || Trim(Form.Phone.value)==false)
	{
		alert("Kindly fill in your Mobile Number!");
		Form.Phone.focus();
		return false;
	}
	 else if(isNaN(Form.Phone.value)|| Form.Phone.value.indexOf(" ")!=-1)
			{
				  alert("Enter numeric value in ");
				  Form.Phone.focus();
				  return false;  
			}
			else if (Form.Phone.value.length < 10 )
			{
					alert("Please Enter 10 Digits"); 
					 Form.Phone.focus();
					return false;
			}
	else if ((Form.Phone.value.charAt(0)!="9") && (Form.Phone.value.charAt(0)!="8") && (Form.Phone.value.charAt(0)!="7"))
			{
				alert("The number should start only with 9 or 8 or 7");
				Form.Phone.focus();
				return false;
			}
	if(Form.Email.value!="Email Id")
		{
			if (!validmail(Form.Email.value))
			{
				//alert("Please enter your valid email address!");
				Form.Email.focus();
				return false;
			}
			
		}
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
	if((Form.year.value < "<?php echo $maxage;?>") || (Form.year.value >"<?php echo $minage;?>"))
	{
		alert("Age Criteria! \n Applicants between age group 18 - 62 only are elgibile.");
		Form.year.focus();
		return false;
		}
	}
	
	if(!checkData(Form.year, 'Year', 4))
		return false;
		
	if(Form.City.selectedIndex==0)
	{
		alert("Please enter City Name to Continue");
		Form.City.focus();
		return false;
	}

	if(Form.Employment_Status.selectedIndex==0)
	{
		alert("Please enter Occupation to Continue");
		Form.Employment_Status.focus();
		return false;
	}
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
	if(Form.Company_Type.selectedIndex==0)
{
	alert("Please enter Company Type to Continue");
	Form.Company_Type.focus();
	return false;
}
if((Form.IncomeAmount.value=='')||(Form.IncomeAmount.value=="Annual Income") || (Form.IncomeAmount.value=="Monthly Income"))
{
	alert("Please enter Income to Continue");
	Form.IncomeAmount.focus();
	return false;
}
/*if(Form.Primary_Acc.selectedIndex==0)
{
	alert("Please select your Salary Account bank to Continue");
	Form.Primary_Acc.focus();
	return Primary_Acc;
}*/

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
	
function addothcity()
{
	
		var nioth = document.getElementById('div_myothcty');
		
		if(nioth.innerHTML=="")
		{
	
			if(document.hdfc_calc.City.value=="Others")
			{
				nioth.innerHTML = '<table  width="100%" border="0" cellspacing="0" cellpadding="0"><tr>                  <td height="29" align="left" class="boldtxt" width="108">Other City :</td>                  <td align="left"><input type="text" name="City_Other" id="City_Other" onfocus="this.select();" style="width:148px;" tabindex="8" /></td>                </tr></table>';
				

			}
		else
			{
				nioth.innerHTML="";
			}
		}
		else
			{
				nioth.innerHTML="";
			}
		
		
		return true;

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
            <td width="77%" height="74"><img src="new-images/hdfc-pl/hdfcbank_logo.gif" width="200" height="54"></td>
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
            <td width="679" align="left" valign="top"  >
			

			<table width="679"  border="0" align="left" cellpadding="0" cellspacing="0">
              <tr>
                <td width="679" valign="top" class="stepbg"><table width="655" border="0" align="right" cellpadding="0" cellspacing="0">
  <tr>
    <td height="35" align="left" valign="middle" class="stepdng">Two Steps to Know your Eligibility</td>
    </tr>
  <tr>
    <td height="65" class="steptxt" style="color:#4f4d4d; ">1. Just Fill in your Details 

      <br>
      2. Online Quote for EMI, ROI, Loan Eligibility</td>
    </tr>
</table>
</td>
              </tr>
              <tr>
                <td >&nbsp;</td>
              </tr>
              <tr>
        <td height="33" bgcolor="#f6f6f6" class="hdng">Features of HDFC Bank Personal Loan</td>
              </tr>
              <tr>
                <td><table width="97%"  border="0" align="right" cellpadding="0" cellspacing="0">
                  <tr>
                    <td width="21"><img src="new-images/hdfc-pl/bullet.gif" width="8" height="8"></td>
                    <td width="522" height="35" class="blutxt" >Get cash loan upto 15 Lacs<br></td>
                    <td width="24"><img src="new-images/hdfc-pl/bullet.gif" width="8" height="8"></td>
                    <td width="348" class="blutxt" >Get loans for 12 to 60 months</td>
                  </tr>
                  <tr>
                    <td width="21"><img src="new-images/hdfc-pl/bullet.gif" width="8" height="8"></td>
                    <td height="35" class="blutxt" >Avail of interest rates as low as 14.75%*</td>
                    <td width="24"><img src="new-images/hdfc-pl/bullet.gif" width="8" height="8"></td>
                    <td class="blutxt" >Repay in easy EMIs</td>
                  </tr>
                  <tr>
                    <td><img src="new-images/hdfc-pl/bullet.gif" width="8" height="8"></td>
                    <td height="35" class="blutxt" >No collateral requirement</td>
                    <td><img src="new-images/hdfc-pl/bullet.gif" width="8" height="8"></td>
                    <td class="blutxt" >Easy Documentation</td>
                  </tr>
				  
                </table></td>
              </tr>
			  <tr><td>&nbsp;</td></tr>
			  <tr><td>&nbsp;</td></tr>
			 
            </table></td>
            <td width="276" height="350"  align="right" valign="top" bgcolor="#F4F4F4"><form name="hdfc_calc" method="POST" action="hdfc-personal-loan-apply-continue.php" onSubmit="return chkpersonalloan(document.hdfc_calc);">
			<input type="hidden" name="source" value="hdfc_plmlr"> 
			<input type="hidden" name="reqtid" id="reqtid" value="<? echo $ProductValue; ?>"> 
			<input type="hidden" name="PostURL" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
              <table width="92%"  border="0" align="center" cellpadding="0" cellspacing="0">
                <tr align="center">
                  <td height="55" colspan="2" class="stepdng">HDFC Personal Loan Request </td>
                  </tr>
                <tr>
                  <td width="42%" height="29" align="left" class="boldtxt">Name</td>
                  <td width="58%" align="left"><input name="Name" id="Name" type="text" style="width: 145px;" tabindex="1"  value="<? echo $Name; ?>"/></td>
                </tr>
                <tr>
                  <td height="29" align="left" class="boldtxt">Mobile</td>
                  <td align="left" class="boldtxt"><font style="font-family: verdana; font-size:10px; font-weight:normal; "> +91</font>
                      <input type="text" style="width:117px;" name="Phone" id="Phone" maxlength="10"   onkeyup="intOnly(this);" onkeypress="intOnly(this);" onchange="intOnly(this);"  value="<? echo $Phone; ?>" tabindex="2"/></td>
                </tr>
                <tr>
                  <td height="29" align="left" class="boldtxt">Email Id</td>
                  <td align="left"><input name="Email" id="Email" type="text" tabindex="3"    style="width: 145px;" value="<? echo $Email; ?>"/></td>
                </tr>
				 <tr>
                  <td height="29" align="left" class="boldtxt">DOB</td>
                  <td align="left"> <input name="day" type="text" id="day" style="width:35px; font-size:12px; " onblur="onBlurDefault(this,'DD');" onfocus="onFocusBlank(this,'DD');" maxlength="2" onkeyup="intOnly(this);" onkeypress="intOnly(this);" value="<? echo $Day; ?>" tabindex="4"/>
                        <input  name="month" type="text" id="month" style="width:35px;font-size:12px; " onblur="onBlurDefault(this,'MM');" onfocus="onFocusBlank(this,'MM');"  maxlength="2" onkeyup="intOnly(this);" onkeypress="intOnly(this);" value="<? echo $Month; ?>" tabindex="5"/>
                        <input type="text" name="year"  id="year" style="width:59px;  font-size:12px; " onblur="onBlurDefault(this,'YYYY');" onfocus="onFocusBlank(this,'YYYY');" maxlength="4" onkeyup="intOnly(this);" onkeypress="intOnly(this);" value="<? echo $Year; ?>" tabindex="6"/></td>
                </tr>
				<tr>
                  <td height="29" align="left" class="boldtxt">City</td>
                  <td align="left"><select name="City" id="City"  style="width: 149px; font-size:13px;" onchange="addothcity();" tabindex="7">
                      <?=plgetCityList($City)?>
                  </select></td>
                </tr>
				<tr><td colspan="2"><div  id="div_myothcty"></div></td></tr>
				
				<tr>
                  <td height="29" align="left" class="boldtxt">Employment Status</td>
                  <td align="left"><select   name="Employment_Status"  id="Employment_Status" style="width:149px;" tabindex="8" >
                         <option value="-1" <? if($Employment_Status=="") { echo "Selected"; } ?>>Employment Status</option>
                         <option value="1" <? if($Employment_Status==1) { echo "Selected"; } ?>>Salaried</option>
                         <option value="0" <? if($Employment_Status==0) { echo "Selected"; } ?>>Self Employment</option>
                     </select></td>
                </tr>
				<tr>
                  <td height="29" align="left" class="boldtxt">Company Name</td>
                  <td align="left"><input name="Company_Name" id="Company_Name" type="text" tabindex="9"    style="width: 144px; height:24px;"  onblur="onBlurDefault(this,'Company Name');" onKeyUp="ajax_showOptions(this,'getCountriesByLetters',event)" onfocus="onFocusBlank(this,'Company Name');" value="<? echo $Company_Name; ?>" /></td>
                </tr>
				<tr> <td height="29" align="left" class="boldtxt">Company Type </td>
				    <td align="left"><select name="Company_Type" id="Company_Type" style="width: 149px; font-size:13px;" tabindex="10">
                       <option value="0">Please Select</option>
		  	<option value="1">Pvt Ltd</option>
			<option value="2">MNC Pvt Ltd</option>
			<option value="3">Limited</option>
                    </select></td></tr>
				<tr>
                  <td height="29" align="left" class="boldtxt"> Annual Income<br>                   </td>
                  <td align="left"><input type="text" name="IncomeAmount" id="IncomeAmount" style="width:145px;" onkeyup="intOnly(this); getDigitToWords('IncomeAmount','formatedIncome','wordIncome');" onkeypress=" getDigitToWords('IncomeAmount','formatedIncome','wordIncome'); intOnly(this);"  onblur="getDigitToWords('IncomeAmount','formatedIncome','wordIncome');" tabindex="11" value="<? echo $Net_Salary; ?>" /></td>
                </tr>
				<tr>
                    <td height="35" colspan="2"  valign="middle"><span id='formatedIncome' style='font-size:11px;
font-weight:normal; color:#b04c09;font-Family:Verdana;'></span>
<span id='wordIncome' style='font-size:11px;
font-weight:normal; color:#b04c09;font-Family:Verdana;text-transform: capitalize;'></span></td>
<td width="0%" colspan="2"  ></td>
              </tr>
                <tr>
                  <td height="29" colspan="2" align="left" class="boldtxt"> Primary Account 
                in which bank?</td></tr>
				<tr><td></td><td> <select name="Primary_Acc" id="Primary_Acc"  style="width:145px;" tabindex="12"><option value="HDFC">HDFC Bank</option><option value="Other">Other Bank</option></select></td>
                  </tr>
              <tr><td colspan="2">&nbsp;</td></tr>
  
                <tr align="left" valign="middle">
                  <td height="35" colspan="2" style="font-family: verdana; font-size:10px; font-weight:normal; "><input type="checkbox" style="border:none ;" name="accept" id="accept" tabindex="8" checked="checked"> I authorize HDFC Bank & its representatives to call me / SMS me with reference to my loan application</td>
                </tr>
                <tr align="center" valign="middle">
                  <td height="55" colspan="2"><input name="image"  value="Submit" type="image" src="new-images/hdfc-pl/get_quotesml.gif" width="129" height="35"  style="border:0px;" tabindex="9" /></td>
                </tr>
              </table>
            </form></td>
          </tr>
        </table></td>
      </tr>
      
      <tr><td style="text-align:center; font-size:9px;"><span style="color:#FF0000;">* </span>Terms & Conditions Apply, Credit at the sole discretion of HDFC Bank.</td></tr>
    </table></td>
    <td width="6" class="rgtshado">&nbsp;</td>
  </tr>
</table>
</body>
</html>
