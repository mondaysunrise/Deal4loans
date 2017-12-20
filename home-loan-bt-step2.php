<?php
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';

if(isset($_POST['submit']) || $_SERVER['REQUEST_METHOD'] == 'POST')
	{
		$Name = $_POST['Name'];
		$Phone = $_POST['Phone'];
		$Email = $_POST['Email'];
		$source = $_POST['source'];
		$City = $_POST['City'];
		$Type_Loan = "Req_Loan_Home";
		$IP = getenv("REMOTE_ADDR");
		$Employment_Status =1;
		$Net_Salary=650000;
		$dateofbirth="1978-01-01";
		$tomorrow  = mktime(0, 0, 0, date("m")  , date("d")-30, date("Y"));
		$days30date=date('Y-m-d',$tomorrow);
		$days30datetime = $days30date." 00:00:00";
		$currentdate= date('Y-m-d');
		$currentdatetime = date('Y-m-d')." 23:59:59";
		$validMobile = is_numeric($Phone);	
		$Existing_Bank= $_POST['Existing_Bank'];
		$Existing_Loan= $_POST['loan_amount'];
		$pre_payment_charges = $_POST['pre_payment_charges'];
		
if(strlen($Name)>0 && (preg_match("/1/", $Name)==1 || preg_match("/0/", $Name)==1) || preg_match("/!/", $Name)==1)
{
  $validname=0;
}
else
{
	$validname=1;
}

	if(($validMobile==1) && ($Name!="") && strlen($City)>0 && $validname==1)
{
		$getdetails="select RequestID From ".$Type_Loan."  Where ((Mobile_Number='".$Phone."' and Mobile_Number not in ('9811555306','9811215138','9971396361')) and Updated_Date between '".$days30datetime."' and '".$currentdatetime."') order by RequestID DESC";
		list($alreadyExist,$myrow)=MainselectfuncNew($getdetails,$array = array());
		$myrowcontr=count($myrow)-1;
		
			if($alreadyExist>0)
			{
				$ProductValue = $myrow[$myrowcontr]["RequestID"];
				$_SESSION['Temp_LID'] = $ProductValue;
				echo "<script language=javascript>"." location.href='update-home-loan-lead.php'"."</script>";
			}
			else
			{			
			$CheckSql = "select UserID from wUsers where Email = '".$Email."'";
			list($CheckNumRows,$CheckQuery)=MainselectfuncNew($CheckSql,$array = array());
			$CheckQuerycontr=count($CheckQuery)-1;
			$Dated = ExactServerdate();
			if($CheckNumRows>0)
			{
				$UserID = $CheckQuery[$CheckQuerycontr]['UserID'];
				$data = array("UserID"=>$UserID, "Name"=>$Name, "Email"=>$Email, "City"=>$City, "City_Other"=>$City_Other, "Mobile_Number"=>$Mobile_Number, "Net_Salary"=>$Net_Salary, "Loan_Amount"=>$Loan_Amount, "Dated"=>$Dated, "source"=>$source, "Referrer"=>$Referrer, "Creative"=>$Creative, "Section"=>$Section, "IP_Address"=>$IP_Address, "Reference_Code"=>$Reference_Code,"Updated_Date"=>$Dated,"Accidental_Insurance"=>$Accidental_Insurance, 'Property_Identified'=>$Property_Identified, 'Employment_Status'=>$Employment_Status, 'DOB'=>$dateofbirth, 'Property_Loc'=>$Property_Loc, 'Co_Applicant_Name'=>$co_name, 'Co_Applicant_DOB'=>$DOB_co, 'Co_Applicant_Income'=>$co_monthly_income, 'Co_Applicant_Obligation'=>$co_obligations, 'Property_Value'=>$property_value, 'Total_Obligation'=>$obligations, 'Edelweiss_Compaign'=>$edelweiss, 'Pincode'=>$Pincode, 'Existing_ROI'=>$Existing_ROI, 'Existing_Loan'=>$Existing_Loan, 'Existing_Bank'=>$Existing_Bank);
			}
			else
			{
				$wUsersdata = array("Email"=>$Email, "FName"=>$Name, "Phone"=>$Phone, "Join_Date"=>$Dated, "IsPublic"=>$IsPublic);
				$UserID = Maininsertfunc("wUsers", $wUsersdata);
				$data = array("UserID"=>$UserID, "Name"=>$Name, "Email"=>$Email, "City"=>$City, "City_Other"=>$City_Other, "Mobile_Number"=>$Mobile_Number, "Net_Salary"=>$Net_Salary, "Loan_Amount"=>$Loan_Amount, "Dated"=>$Dated, "source"=>$source, "Referrer"=>$Referrer, "Creative"=>$Creative, "Section"=>$Section, "IP_Address"=>$IP_Address, "Reference_Code"=>$Reference_Code,"Updated_Date"=>$Dated,"Accidental_Insurance"=>$Accidental_Insurance, 'Property_Identified'=>$Property_Identified, 'Employment_Status'=>$Employment_Status, 'DOB'=>$dateofbirth, 'Property_Loc'=>$Property_Loc, 'Co_Applicant_Name'=>$co_name, 'Co_Applicant_DOB'=>$DOB_co, 'Co_Applicant_Income'=>$co_monthly_income, 'Co_Applicant_Obligation'=>$co_obligations, 'Property_Value'=>$property_value, 'Total_Obligation'=>$obligations, 'Edelweiss_Compaign'=>$edelweiss, 'Pincode'=>$Pincode, 'Existing_ROI'=>$Existing_ROI, 'Existing_Loan'=>$Existing_Loan, 'Existing_Bank'=>$Existing_Bank);
			}

			$ProductValue = Maininsertfunc ('Req_Loan_Home', $data);
		}	
	}
	}
	else
		{
			//echo "Track URI and redirect this to the same page";
			$msg = "NotAuthorised";
			$PostURL ="http://www.deal4loans.com".$_POST["PostURL"]."?msg=".$msg;
			header("Location: $PostURL");
		}

?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Home Loan Balance Transfer Calculator</title> 
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0"> 
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<script language="javascript">
function validateDiv(div)
{
	var ni1 = document.getElementById(div);
	ni1.innerHTML = '';
}

function check_form(Form)
{

var iChars ="/@#$%^&*()+=-[]\\\';,{}|\":<>?!";
	
	if (Form.Existing_Bank.value=="")
	{
		document.getElementById('existBankVal').innerHTML = "<span  class='hintanchor'>Enter Existing Bank!</span>";	
		Form.Existing_Bank.focus();
		return false;
	}	
	if(Form.emi_paid.value=="")
	{
		document.getElementById('emiPaidVal').innerHTML = "<span  class='hintanchor'>Enter No of EMI Paid !</span>";	
		Form.emi_paid.focus();
		return false;
	}
	if(Form.loan_amount.value=="")
	{
		document.getElementById('loanAmountVal').innerHTML = "<span  class='hintanchor'>Enter Loan Amount!</span>";	
		Form.loan_amount.focus();
		return false;
	}
if(Form.tenure.selectedIndex==0)
	{
		document.getElementById('tenureVal').innerHTML = "<span  class='hintanchor'>Select Tenure!</span>";	
		Form.tenure.focus();
		return false;
	}	
	if(Form.roi.value=="")
	{
		document.getElementById('roiVal').innerHTML = "<span  class='hintanchor'>Rate of Interest!</span>";	
		Form.roi.focus();
		return false;
	}
	for (var i = 0; i <Form.roi.value.length; i++) 
   {
		if (iChars.indexOf(Form.roi.value.charAt(i)) != -1) 
		{
			document.getElementById('roiVal').innerHTML = "<span  class='hintanchor'>Contains special characters!</span>";
			Form.roi.focus();
			return false;
		}
  }
}

function shw_tooltip()
{
	var nishw = document.getElementById('shw_tultip');
	nishw.innerHTML = "<span  class='hinttooltip'>Most Banks/NBFC charge 0% prepayment offers. Please check with your lender.</span>";
}

function shw_tooltipOFF()
{
	var nishw = document.getElementById('shw_tultip');
	nishw.innerHTML = "";
}

</script>
 <style>
.hinttooltip{
position:absolute;
background-color:#F5FCE1;
width: 243px;
padding: 2px;
border:1px solid #7F9D27;
font:normal 10px Verdana;
color:#404042;
line-height:14px;
z-index:100;
border-right: 3px solid #7F9D27;
border-bottom: 3px solid #7F9D27;
}

.red {
	color: #F00;
}
-->
  .alert_msg{color:#990000; font-weight:bold; font-size:12px; font-family: Verdana, Geneva, sans-serif;}


{
border:#FF0000 1px solid; 
}
</style>
<link href="css/hlbtc-styles.css" rel="stylesheet" type="text/css">
<script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
</head>
<body>
<div id="hlbtc_top_box">
<div class="hlbtc_inner_box">
<div class="logo"><img src="new-images/hlbtc_d4l-new.jpg" style="width:192; height:77px;"></div>
<div class="top_text_box"><span class="top_text">Home Loan Balance Transfer Calculator</span><br />
<span class="sub_top_text">Save over 1 Lac, Switch your Existing Home Loan</span>
</div>
</div>
</div>
<div style="clear:both;"></div>
<div class="hlbtc_second_wrapper" style="margin-top:5px;">
<div class="left_colum">
<div class="form_wrapper">
<form name="loancalc" id="loancalc" method="post" action="home-loan-bt-thank.php" onSubmit="return check_form(document.loancalc);" >
<input type="hidden" name="hlrequestid" id="hlrequestid" value="<? echo $ProductValue; ?>">
<input type="hidden" name="Name" id="Name" value="<? echo $Name; ?>">

 <table width="100%" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td colspan="2" class="text_head">Loan Details</td>
      </tr>
    <tr>
      <td width="47%" height="50" class="form_body">Name of Existing Bank :</td>
      <td width="53%">
     <input type="text" name="Existing_Bank"  id="Existing_Bank" class="input_box" onKeyUp="ajax_showOptions(this,'getCountriesByLetters',event); getstatementlink();" onChange="getstatementlink();" onKeyDown="validateDiv('existBankVal');" onClick="getstatementlink();" tabindex="1" autocomplete="off" value="<? echo $Existing_Bank; ?>" />
<div id="existBankVal" class="alert_msg"></div>
   </td>
    </tr>
    <tr>
      <td height="50" class="form_body">No. of EMI Paid (in Months):</td>
      <td>
       <input type="text" name="emi_paid" class="input_box"  onKeyDown="validateDiv('emiPaidVal'); intOnly(this);" tabindex="2" autocomplete="off" onKeyUp="intOnly(this);" onChange="intOnly(this);" />
                    <div id="emiPaidVal" class="alert_msg"></div>
     </td>
    </tr>
    <tr>
      <td height="50" class="form_body">Home Loan Borrowed:</td>
      <td><input name="loan_amount"  id="loan_amount" onFocus="this.select();" onChange="intOnly(this);"  onKeyUp="intOnly(this); getDigitToWords('loan_amount', 'formatedlA', 'wordloanAmount');" onKeyPress="intOnly(this); getDigitToWords('loan_amount', 'formatedlA','wordloanAmount');" onKeyDown="getDigitToWords('loan_amount', 'formatedlA','wordloanAmount');" onBlur="getDigitToWords('loan_amount', 'formatedlA','wordloanAmount');" class="input_box" tabindex="3" autocomplete="off" value="<? echo $Existing_Loan; ?>"/><div id="loanAmountVal" class="alert_msg"></div></td>
    </tr>
    <tr><td class="form_body"></td><td>  <span id="formatedlA" style="font-family: Verdana, Arial, Helvetica, sans-serif;	font-size:11px;	color:#3A0D04; text-decoration:none; font-weight:bold; text-align:left;"></span><span id="wordloanAmount" style="font-family: Verdana, Arial, Helvetica, sans-serif;	font-size:11px;	color:#3A0D04; text-decoration:none; font-weight:bold; text-align:left;"></span>    </td></tr> 
    <tr>
      <td height="50" class="form_body">Tenure (in Years):</td>
      <td align="right"><label><select name="tenure" id="tenure" onkeydown="validateDiv('tenureVal');" tabindex="4" ><option value="">Please Select</option><option value="5"  >5</option><option value="6"  >6</option><option value="7"  >7</option><option value="8"  >8</option><option value="9"  >9</option><option value="10"  >10</option><option value="11"  >11</option><option value="12"  >12</option><option value="13"  >13</option><option value="14"  >14</option><option value="15"  >15</option><option value="16"  >16</option><option value="17"  >17</option><option value="18"  >18</option><option value="19"  >19</option><option value="20"  >20</option><option value="21"  >21</option><option value="22"  >22</option><option value="23"  >23</option><option value="24"  >24</option><option value="25"  >25</option></select></label><div id="tenureVal" class="alert_msg"></div></td>
    </tr>
    <tr>
      <td height="50" class="form_body">ROI on Current Home Loan:</td>
      <td><input type="text" name="roi" id="roi" onKeyDown="validateDiv('roiVal');" class="input_box"  value="<?php echo $Interest_Rate; ?>" tabindex="5" autocomplete="off" style="width:255px;"/> %<div id="roiVal" class="alert_msg"></div></td>
    </tr>
	 <tr>
      <td height="50" class="form_body">Pre Payment Charges:</td>
      <td><input type="text" name="pre_payment_charges" id="pre_payment_charges" onKeyDown="validateDiv('prepaymentVal');" class="input_box"  value="<?php echo $Interest_Rate; ?>" tabindex="5" autocomplete="off" style="width:255px;" onFocus="shw_tooltip();" onBlur="shw_tooltipOFF();" />   <div id="prepaymentVal" ></div>
									  <div id="shw_tultip"></div></td>
    </tr>
    
     <tr>      <td height="50" colspan="2" align="center" class="form_body">      <input type="submit" style="border: 0px none ; background-image: url(new-images/hlbtc_button.png); width:248px; height:46px;" value=""/></td>    </tr>
 
  </table>
  </form>
</div>
<div class="form_shadow"></div>
<div class="description_box"><div class="des_text"><strong>Home Loan Balance transfer</strong> need not only mean saving money, you can also utilize the same for investing in different options. After all securing a home loan is not the end of journey. Balance transfer - by switching to another lender may give you a better deal. While a balance transfer will certainly reduce your EMI outgo, there is no one-size-fits-all solution for everybody. To know if it will help you, you need to decipher its workings and calculate the actual benefit before taking a call.
<br /><br />
<strong>Home Loan Balance Transfer Calculator</strong> involves doing a simple math which in turn would save you from coughing up your hard earned money. All you need to do is insert your existing home loan rate and prepayment charges and based on that it gives you instant quote of four other bank rates as well and tells you how much you can save.
</div></div>

</div>
<div class="right_colum">
<div class="row_one">
  <table width="100%" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td height="34" align="center" bgcolor="#21a0d6" class="text_white">Sample Balance Transfer Quotes </td>
    </tr>
    <tr>
      <td align="center"><img src="new-images/hlbtc_lp_graph.jpg"  style="width:352px; height:178px;"></td>
    </tr>
  </table>
</div>
<div class="row_two">
  <table width="100%" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td height="30" class="why_text_head">Why Deal4loans.com</td>
    </tr>
    <tr>
      <td class="bullet_text"><ul>
      <li>
      Balance transfer rates as low as <span style="color:#e35500; font-weight:bold;">9.95 % -10.5%</span></li>
      <li>Check  <span style="color:#e35500; font-weight:bold;">offers</span> from Nationalized and Private sector Banks</li>
      <li>Quotes are  <span style="color:#e35500; font-weight:bold;">free</span> for customers</li>
      <li> <?php $hlamtcnt = "select Amount,countr_amt From totalLoans Where (Name='Totalcountr' and flag=1)";

		list($alreadyExist,$hlamtcntQuery)=MainselectfuncNew($hlamtcnt,$array = array());
		$hlamtcntQuerycontr=count($hlamtcntQuery)-1;
		$ttl_hltaken = $hlamtcntQuery[$hlamtcntQuerycontr]["Amount"];

$revarrnumber=str_split($ttl_hltaken);
$contstr=count($revarrnumber);

//for($i=count($revarrnumber);$i>-1;$i--)
for($i=0;$i<$contstr;$i++)
{
if($i == $contstr-3 || $i== ($contstr-1) || $i==($contstr-2))
	{

		$lasttxt.='<span style="color:#954D03; font-family:Arial, Helvetica, sans-serif; font-size:16px; font-weight:bold;">'.$revarrnumber[$i].'</span>';
	 }
	else if($i == $contstr-4 || $i== ($contstr-5))
	{	
		$middletxt.='<span style="color:#FEAB0D; font-family:Arial, Helvetica, sans-serif; font-size:24px; font-weight:bold;">'.$revarrnumber[$i].'</span>';

	}
	else
	{
		$starttxt.='<span style="color:#148FD5; font-family:Arial, Helvetica, sans-serif; font-size:20px; font-weight:bold;">'.$revarrnumber[$i].'</span>';
	 }

}
$linkup='<span style="color:#FEAB0D; font-family:Arial, Helvetica, sans-serif; font-size:22px; font-weight:bold;">,</span>';
$linkup2='<span style="color:#148FD5; font-family:Arial, Helvetica, sans-serif; font-size:22px; font-weight:bold;">,</span>';
echo $total_homeloan_taken= $starttxt."".$linkup2."".$middletxt."".$linkup."".$lasttxt;
?> quotes taken from Deal4loans.com</li>
      <li>Your details are  <span style="color:#e35500; font-weight:bold;">secured</span> with us and will not be shared without your consent </li>
      </ul></td>
    </tr>
  </table>
</div>

<div class="row_three" style="margin-top:10px;">
  <table width="100%" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td class="form_body" style="font-weight:bold; text-align:center;" height="30">Top Home Loan Balance Transfer Banks </td>
    </tr>
    <tr>
      <td  class="logo_box">
      <ul>
      <li style="margin-left:5px; text-align:center" ><img src="new-images/sbi-new-hlbtc-logo.png" style="width:106px; height:45px;"></li>
      <li style="text-align:center"><img src="new-images/lici-new-hlbtc-logo.png" style="width:106px; height:45px;"></li>
      <li style="text-align:center"><img src="new-images/hdfc-new-hlbtc-logo.png" style="width:106px; height:45px;"></li>
          </ul>
          <div style="clear:both;"></div>
           <ul>
      <li style="margin-left:5px; text-align:center;"><img src="new-images/axis-new-hlbtc-logo.png" style="width:106px; height:45px;"></li>
      <li style="text-align:center"><img src="new-images/pnb-new-hlbtc-logo.png" style="width:106px; height:45px;"></li>
      <li style="text-align:center"><img src="new-images/icici-new-hlbtc-logo.png" style="width:106px; height:45px;"></li>
          </ul>
      </td>
    </tr>
  </table>
</div>
</div>
</div>
</body>
</html>