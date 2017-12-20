<?php
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	
$maxage=date('Y')-62;
$minage=date('Y')-18;

	if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		foreach($_POST as $a=>$b)
			$$a=$b;
		$Type_Loan = $_POST['Type_Loan'];
		$finalurl=$_POST["PostURL"];
		$Name = FixString($Name);
		$Day=FixString($day);
		$Month=FixString($month);
		$Year=FixString($year);
		$Loan_Amount= FixString($Loan_Amount);
		$DOB=$Year."-".$Month."-".$Day;
		$Phone = FixString($Phone);
		$Email = FixString($Email);
		$Residence_City = FixString($City);
		$Gender = FixString($gender);
		$Residence_City_Other = FixString($City_Other);
		$Course = FixString($Course);
		$Country = FixString($Country);
		$Collateral_Security =FixString($Collateral_Security);
		//$cpp_card_protect = FixString($cpp_card_protect);
		$source = FixString($source);
		$IP = getenv("REMOTE_ADDR");

	
		$crap = " ".$Name." ".$Email;
		$crapValue = validateValues($crap);
		$_SESSION['crapValue'] = $crapValue;
		$validMobile = is_numeric($Phone);
		$validYear  = is_numeric($Year);
		$validMonth = is_numeric($Month);
		$validDay = is_numeric($Day);
		$Reference_Code = generateNumber(4);
			

if(($validMobile==1) && ($validMonth==1) && ($validDay==1) && ($validYear==1) && ($Name!=""))
{
	$tomorrow  = mktime(0, 0, 0, date("m")  , date("d")-30, date("Y"));
	$days30date=date('Y-m-d',$tomorrow);
	$days30datetime = $days30date." 00:00:00";
	$currentdate= date('Y-m-d');
	$currentdatetime = date('Y-m-d')." 23:59:59";
	
	$getdetails="select RequestID From Req_Loan_Education Where ((Mobile_Number='".$Phone."' and Mobile_Number not in ('9891118553','9911940202','9811215138','9971396361') and Updated_Date between '".$days30datetime."' and '".$currentdatetime."') order by RequestID DESC";
	list($alreadyExist,$myrow)=MainselectfuncNew($getdetails,$array = array());
			$myrowcontr=count($myrow)-1;
			if($alreadyExist>0)
			{
				$ProductValue = $myrow[$myrowcontr]["RequestID"];
		$_SESSION['Temp_LID'] = $ProductValue;
		echo "<script language=javascript>"." location.href='update-education-loan-lead.php'"."</script>";
	}
	else
{
	$CheckSql = "select UserID from wUsers where Email = '".$Email."'";
		$myrowcontr=count($myrow)-1;
			$CheckNumRows = $alreadyExist;
			$Dated = ExactServerdate();
			if($CheckNumRows>0)
			{
				$UserID = $myrow[$myrowcontr]["UserID"];
		
		$dataInsert = array('UserID'=>$UserID, 'Name'=>$Name, 'Email'=>$Email, 'Mobile_Number'=>$Phone, 'DOB'=>$DOB, 'Gender'=>$Gender, 'Loan_Amount'=>$Loan_Amount, 'Residence_City'=>$Residence_City, 'Residence_City_Other'=>$Residence_City_Other, 'Country'=>$Country, 'Course'=>$Course, 'Collateral_Security'=>$Collateral_Security, 'IP_Address'=>$IP, 'source'=>$source, 'Dated'=>$Dated, 'Updated_Date'=>$Dated, 'Reference_Code'=>$Reference_Code);

	}
	else
	{
		$wUsersdata = array("Email"=>$Email, "FName"=>$Name, "Phone"=>$Phone, "Join_Date"=>$Dated, "IsPublic"=>$IsPublic);
		$UserID = Maininsertfunc("wUsers", $wUsersdata);
		$dataInsert = array('UserID'=>$UserID, 'Name'=>$Name, 'Email'=>$Email, 'Mobile_Number'=>$Phone, 'DOB'=>$DOB, 'Gender'=>$Gender, 'Loan_Amount'=>$Loan_Amount, 'Residence_City'=>$Residence_City, 'Residence_City_Other'=>$Residence_City_Other, 'Country'=>$Country, 'Course'=>$Course, 'Collateral_Security'=>$Collateral_Security, 'IP_Address'=>$IP, 'source'=>$source, 'Dated'=>$Dated, 'Updated_Date'=>$Dated, 'Reference_Code'=>$Reference_Code);
	}
	//echo "hello>".$InsertProductSql."<br>";
	$ProductValue = Maininsertfunc ("Req_Loan_Education", $dataArray);
	
		$SMSMessage = "Dear $Name,your activation code is: $Reference_Code. Use it in step 2 of loan app form to get quotes. And help us serve you better.";
				if(strlen(trim($Phone)) > 0)
				{
					//SendSMS($SMSMessage, $Phone);
				}
	$_SESSION['Temp_LID'] = $ProductValue;

	header("Location: education-loan-thank.php");
	exit();	

		}
}
		else
		{
			//echo "Track URI and redirect this to the same page";
			$msg = "NotAuthorised";
			$PostURL ="http://www.deal4loans.com".$_POST["PostURL"]."?msg=".$msg;
			header("Location: $PostURL");
		}

	}



?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Education Loan</title>
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
<script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
<script type="text/javascript" src="/scripts/common.js"></script>
<style type="text/css">

body{
	background-color:#f5f5f5;
	font-family: Arial, Helvetica, sans-serif;
	font-size:13px;
	color:#3c3725;
	margin:0px;
	padding:0px;}
	
input, select{
	border:1px solid #e0e0e0;
	margin:0px;
	padding:0px;
}

.frmbldtxt{
	padding-left:12px;	
}
	
.redtxt{

	color:#b54a0b;
	font-size:17px;
	font-family:Arial, Helvetica, sans-serif;
	font-weight:bold;
	line-height:22px;
 	
}	
.blutxt{
	color:#137aaf;
	font-weight:bold;
	font-size:30px;
 }
 
.brdr{
	background-color:#FFFFFF;
	border-left:1px solid #e8e8e8;
	border-right:1px solid #e8e8e8;
}
.frmbrdr{
	background-color:#e7f7ad;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	color:#45501d;
	font-size:11px;
	font-weight:bold;
	border-left:1px solid #d7e898;
	border-right:1px solid #d7e898;
}
.frmhdng{
	background:url(new-images/edu/frmhdng1.gif) no-repeat center top;
 	color:#3d3d3d;
	font-size:16px;
	font-weight:bold;
	font-family:Arial, Helvetica, sans-serif;
	height:36px;
	line-height:35px;
}

.txthdng{
	background:url(new-images/edu/hdngbg.gif) no-repeat left top;
	font-size:12px;
	font-family:Verdana, Arial, Helvetica, sans-serif;
	font-weight:bold;
	text-indent:30px;
	color:#3d3d3d;
	height:34px;
  	line-height:32px;
}
	
</style>
<script Language="JavaScript" Type="text/javascript">

function addElement()
{
	var ni = document.getElementById('myDiv');
	var newdiv = document.createElement('div');
		
		if(ni.innerHTML=="")
		{
			
				ni.innerHTML = '<table border="0"><tr><td height="25"><font color="#330101">Reconfirm Mobile No.</font></td>	<td width="158" ><input size="18" type="text" style="margin-left:8px;" maxlength="10"  name="RePhone" id="RePhone"></td></tr></table>';
			
			ni.appendChild(newdiv);
		}
			
		else if(ni.innerHTML!="")
		{
					
				//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = '';
			
		}
		
		//return true;
		}

function chkeducaionloan(Form)
{

		if(Form.Reference_Code1.value=="")
		{
			if(!Form.confirm.checked)
			{
					alert("if you havnt received activation code click check box.");
					Form.confirm.focus();
					return false;
			}
			else if(Form.confirm.checked)
			{
				if(Form.RePhone.value=="")
				{
					alert("Please Re confirm your mobile number again");
					Form.RePhone.focus();
					return false;
				}
				else if(isNaN(Form.RePhone.value)|| Form.RePhone.value.indexOf(" ")!=-1)
				{
					 alert("Enter numeric value in ");
					 Form.RePhone.focus();
					 return false;  
				}
				else if (Form.RePhone.value.length < 10 )
				{
					alert("Please Enter 10 Digits"); 
					Form.RePhone.focus();
					return false;
				}
				else if (Form.RePhone.value.charAt(0)!="9")
				{
					alert("The number should start only with 9");
					Form.RePhone.focus();
					return false;
				}
				
			}
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
function Trim(strValue) {
var j=strValue.length-1;i=0;
while(strValue.charAt(i++)==' ');
while(strValue.charAt(j--)==' ');
return strValue.substr(--i,++j-i+1);
}

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

</script>
</head>

<body>
<table width="835" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><table width="100%"  border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="148" height="185" align="left" valign="top"><img src="new-images/edu/hdr1.gif" width="148" height="185"></td>
        <td width="142" height="185" align="left"><img src="new-images/edu/hdr2.gif" width="142" height="185"></td>
        <td width="335" height="185" valign="top" background="new-images/edu/education-hdr.gif"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td height="40" >&nbsp;</td>
          </tr>
          <tr>
            <td height="40" valign="top" class="blutxt">Education Loan </td>
          </tr>
          <tr>
            <td valign="top" class="redtxt">Finance your Higher Education <br>
      to unlock your Professional Success</td>
          </tr>
        </table></td>
        <td width="158" align="right"><img src="new-images/edu/hdr-logo.gif" width="234" height="185"></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td class="brdr" style="padding-top:10px; "> <table width="813" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td valign="top"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td height="33" align="left" class="txthdng">3 step to your Education Loan </td>
          </tr>
          <tr>
            <td align="left" height="6"></td>
          </tr>
          <tr>
            <td align="left"><table width="97%"  border="0" align="right" cellpadding="0" cellspacing="0">
              <tr>
                <td width="4%"><img src="new-images/edu/arrow.gif" width="6" height="9"></td>
                <td width="96%" height="22">Post your Loan requirement</td>
              </tr>
              <tr>
                <td width="4%"><img src="new-images/edu/arrow.gif" width="6" height="9"></td>
                <td height="22">Get &amp; Compare Offers from various Banks </td>
              </tr>
              <tr>
                <td width="4%"><img src="new-images/edu/arrow.gif" width="6" height="9"></td>
                <td height="22">Choose the lowest Loan Quote
</td>
              </tr>
              <tr>
                <td colspan="2" height="15"></td>                 
              </tr>
            </table></td>
          </tr>
          
          <tr>
            <td height="33" align="left" class="txthdng">Get Loan Quotes from </td>
          </tr>
		  <tr>
            <td height="10"></td>
          </tr>
          <tr>
            <td ><table width="97%"  border="0" align="right" cellpadding="0" cellspacing="0">
              <tr>
                <td width="4%">&nbsp;</td>
                <td width="96%"><img src="new-images/edu/bank-logo.gif" width="404" height="40"></td>
              </tr>
            </table></td>
          </tr>
              <tr>
                <td colspan="2" height="15"></td>                 
              </tr>
          <tr>
            <td height="33" align="left" class="txthdng">Benefits of Education Loan</td>
          </tr>
		    <tr>
            <td align="left" height="6"></td>
          </tr>
          <tr>
            <td><table width="97%"  border="0" align="right" cellpadding="0" cellspacing="0">
              <tr>
                <td width="4%"><img src="new-images/edu/arrow.gif" width="6" height="9"></td>
                <td width="96%" height="22">Borrow upto cost of Education</td>
              </tr>
              <tr>
                <td width="4%"><img src="new-images/edu/arrow.gif" width="6" height="9"></td>
                <td height="22">No repayment of loan while studying</td>
              </tr>
              <tr>
                <td width="4%"><img src="new-images/edu/arrow.gif" width="6" height="9"></td>
                <td height="22">No burden on parents</td>
              </tr>
              <tr>
                <td width="4%"><img src="new-images/edu/arrow.gif" width="6" height="9"></td>
                <td height="22">Low Rate of Interest</td>
              </tr>
              <tr>
                <td width="4%"><img src="new-images/edu/arrow.gif" width="6" height="9"></td>
                <td height="22">Quick Loan Sanction</td>
              </tr>
              <tr>
                <td colspan="2" height="15"></td>                 
              </tr>
            </table></td>
          </tr>
          <tr>
            <td height="33" align="left" class="txthdng">Testimonial</td>
          </tr>
          <tr>
            <td align="left" height="6"></td>
          </tr>
          <tr>
            <td align="left" >Delhi Education Loan<br>
              I am glad that i could get my loan approval in just 48 hours. Its like dream<br>
              come true now I can take my higher studies without burdening my<br>
              parents. Good Luck team &amp; thanks for getting my education loan disbursed.<br></td>
          </tr>
              <tr>
                <td colspan="2" height="15"></td>                 
              </tr>
          <tr>
            <td height="61" background="new-images/edu/tipsbg.gif" style="background-repeat:no-repeat; "><table width="95%"  border="0" align="center" cellpadding="0" cellspacing="0">
              <tr>
                <td height="25"><b>Helpful Tips </b></td>
              </tr>
              <tr>
                <td>Do not wait till last minute apply for education loan before admission.</td>
              </tr>
            </table></td>
          </tr>
        </table></td>
        <td width="370" align="right" valign="top"><table width="360"  border="0" cellpadding="0" cellspacing="0" bgcolor="#ebf8ff">
          <tr>
            <td width="360" height="8" valign="top"><img src="new-images/edu/formtp1.gif" width="360" height="8"></td>
          </tr>
          <tr>
            <td class="frmbrdr" valign="top"><form name="eduloan_form" action="thank-apply-education-loans.php" method="POST" onSubmit="return chkeducaionloan(document.eduloan_form);">
            <input type="hidden" name="RequestID" value="<?php echo $ProductValue; ?>">
            <table width="92%"  border="0" align="center" cellpadding="0" cellspacing="0">
              <tr align="center">
                <td height="36" colspan="2" align="center" class="frmhdng">Apply Education Loan</td>
              </tr>
              <tr>
                <td height="6" colspan="2" ></td>
              </tr>
              <tr>
                <td width="43%" height="26" align="left" valign="middle" class="frmbldtxt" style="padding-top:3px; ">Activation Code :</td><td width="57%" align="left" valign="middle" class="frmbldtxt"  style="padding-top:3px; "><input type="text" name="Reference_Code1" id="Reference_Code1" style="width:150px;" maxlength="4"  tabindex="1" /></td>
              </tr>
              <tr>
                <td width="43%" height="26" align="left" valign="middle" class="frmbldtxt" style="padding-top:3px;" colspan="2"><input   type="checkbox" style="border:none;"  name="confirm" value="hello"  id="confirm"  onClick="addElement();" > <font color="#330101"> If you havent received activation code sms</font></td>
              </tr>
               <tr>
                <td width="43%" height="26" align="left" valign="middle" class="frmbldtxt" style="padding-top:3px;" colspan="2">  <div id="myDiv"></div></td>
              </tr>
              <tr>
                <td align="center" valign="bottom" height="50" colspan="2" ><input type="submit" style="border: 0px none ; background-image: url(new-images/edu/get-quote-grn.gif); width: 172px; height: 36px; margin-bottom: 0px;" value=""/></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
            </table>
            </form></td>
          </tr>
          <tr>
            <td width="360" height="8" align="left" valign="bottom"><img src="new-images/edu/formbt1.gif" width="360" height="8"></td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td width="835" height="12"><img src="new-images/edu/brdr-btm.gif" width="835" height="12"></td>
  </tr>
</table>
</body>
</html>
