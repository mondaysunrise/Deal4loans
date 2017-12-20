<?php
ob_start();
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	session_start();

//print_r($_POST);

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
		$Ibibo_compaign = FixString($Ibibo_compaign);
		$Employment_Status = FixString($Employment_Status);
		$Course_Name = FixString($Course_Name);
		$Coborrower_Income = FixString($Coborrower_Income);
		$hdfclife = FixString($hdfclife);

	
		$crap = " ".$Name." ".$Email;
		$crapValue = validateValues($crap);
		$_SESSION['crapValue'] = $crapValue;
		$validMobile = is_numeric($Phone);
		$validYear  = is_numeric($Year);
		$validMonth = is_numeric($Month);
		$validDay = is_numeric($Day);
		$Reference_Code = generateNumber(4);
		
	if(strlen($Course_Name)>0)
		{
			$chkcrs='select hdfccourse_name from hdfc_credila_ncourse_list Where (hdfccourse_name like "%'.$Course_Name.'%")';
			list($chkcrsnum,$myrow)=MainselectfuncNew($chkcrs,$array = array());

			if($chkcrsnum>0)
			{
				$hdfc_credila=0;
			}
			else
			{
				$hdfc_credila=1;
			}
		}
			
	
function  Insert_ibibo($ProductValue, $Name, $City, $Phone, $DOB, $Ibibo_compaign, $Email )
	{
		$Dated = ExactServerdate();		
		$dataInsert = array("ibibo_product"=>'7' , "ibibo_requestid"=>$ProductValue , "ibibo_name"=>$Name , "ibibo_city"=>$City , "ibibo_mobile"=>$Phone, "ibibo_dob"=>$DOB , "ibibo_car_name"=>$Ibibo_compaign , "ibibo_dated"=>$Dated , "ibibo_email"=>$Email );
		$table = 'ibibo_compaign_leads';
		$insert = Maininsertfunc ($table, $dataInsert);
	}

if(($validMobile==1) && ($Name!=""))
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
	list($alreadyExist,$myrow)=MainselectfuncNew($CheckSql,$array = array());
			$myrowcontr=count($myrow)-1;
			$CheckNumRows = $alreadyExist;
			$Dated = ExactServerdate();
			if($CheckNumRows>0)
			{
				$UserID = $myrow[$myrowcontr]["UserID"];
		$dataInsert = array('UserID'=>$UserID, 'Name'=>$Name, 'Email'=>$Email, 'Mobile_Number'=>$Phone, 'DOB'=>$DOB, 'Gender'=>$Gender, 'Loan_Amount'=>$Loan_Amount, 'Residence_City'=>$Residence_City, 'Residence_City_Other'=>$Residence_City_Other, 'Country'=>$Country, 'Course'=>$Course, 'Collateral_Security'=>$Collateral_Security, 'IP_Address'=>$IP, 'source'=>$source, 'Dated'=>$Dated, 'Updated_Date'=>$Dated, 'Reference_Code'=>$Reference_Code, 'Employment_Status'=>$Employment_Status, 'Course_Name'=>$Course_Name, 'Coborrower_Income'=>$Coborrower_Income, 'hdfc_credila'=>$hdfc_credila);
	}
	else
	{
		$wUsersdata = array("Email"=>$Email, "FName"=>$Name, "Phone"=>$Phone, "Join_Date"=>$Dated, "IsPublic"=>$IsPublic);
		$UserID = Maininsertfunc("wUsers", $wUsersdata);

		$dataInsert = array('UserID'=>$UserID, 'Name'=>$Name, 'Email'=>$Email, 'Mobile_Number'=>$Phone, 'DOB'=>$DOB, 'Gender'=>$Gender, 'Loan_Amount'=>$Loan_Amount, 'Residence_City'=>$Residence_City, 'Residence_City_Other'=>$Residence_City_Other, 'Country'=>$Country, 'Course'=>$Course, 'Collateral_Security'=>$Collateral_Security, 'IP_Address'=>$IP, 'source'=>$source, 'Dated'=>$Dated, 'Updated_Date'=>$Dated, 'Reference_Code'=>$Reference_Code, 'Employment_Status'=>$Employment_Status, 'Course_Name'=>$Course_Name, 'Coborrower_Income'=>$Coborrower_Income, 'hdfc_credila'=>$hdfc_credila);
		}
	//echo "hello>".$InsertProductSql."<br>";
	$ProductValue = Maininsertfunc ("Req_Loan_Education", $dataArray);
	if(strlen($Ibibo_compaign)>0)
		{
			Insert_ibibo($ProductValue, $Name, $City, $Phone, $DOB, $Ibibo_compaign, $Email);
		}
		
		if($hdfclife==1)
		{
			$Product=9;
			Insert_HdfcLife($Name, $Residence_City, $Phone, $DOB, $Email, $Net_Salary, $Product, $ProductValue );
		}
	
		$SMSMessage = "Dear $Name,your activation code is: $Reference_Code. Use it in step 2 of loan app form to get quotes. And help us serve you better.";
				if(strlen(trim($Phone)) > 0)
				{
					//SendSMS($SMSMessage, $Phone);
				}
	$_SESSION['Temp_LID'] = $ProductValue;


	//header("Location: thank-apply-education-loans.php");
				//exit();	

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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Education Loan | Education Loan India</title>
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
<meta name="keywords" content="Apply Education Loans, Compare Education Loans in Mumbai Hyderabad Pune kolkata Delhi Noida Bangalore">
<meta name="description" content="Apply Online Education Loans through Deal4loans.com Get instant information on education loans from all education provider banks located in major cities of India like Mumbai, Delhi, Noida, Kolkata, Gurgaon, Bangalore, Ahmedabad, Chennai, Hyderabad, Navi Mumbai, Kochi etc. ">
<link href="style/new-bima.css" rel="stylesheet"  type="text/css" />
<link href="style/glowing.css" rel="stylesheet"  type="text/css" />
<link href="css/slider.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/dropdowntabs.js"></script>
<script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
<script type="text/javascript" src="/scripts/common.js"></script>
</head>
<table width="1004" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td><table width="100%"  border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td valign="top"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="161" height="169" align="left" valign="top"><img src="new-images/el/el-1.jpg" /></td>
            <td width="158" height="169" align="left" valign="top"><img src="new-images/el/el-2.jpg" /></td>
            <td width="177" height="169" align="left" valign="top"><img src="new-images/el/el-3.gif" /></td>
            <td width="186" height="169" align="left" valign="top"><img src="new-images/el/el-4.jpg" /></td>
          </tr>
          <tr>
            <td height="167" align="left" valign="top"><img src="new-images/el/el-5.jpg" /></td>
            <td height="167" align="left" valign="top"><img src="new-images/el/el-6.jpg" /></td>
            <td height="167" align="left" valign="top"><img src="new-images/el/el-7.jpg" /></td>
            <td height="167" align="left" valign="top"><img src="new-images/el/el-8.jpg" /></td>
          </tr>
          <tr>
            <td colspan="4"><table width="95%"  border="0" align="center" cellpadding="0" cellspacing="0">
              <tr>
                <td class="bldtxt" style="font-size:17px; font-family:Arial, Helvetica, sans-serif; " >&nbsp;</td>
              </tr>
              <tr>
                <td height="30" style="font-size:17px; font-family:Arial, Helvetica, sans-serif; font-weight:bold;" >Why Deal4loans.com</td>
              </tr>
              <tr>
                <td  align="center" valign="middle">
               <table width="650" border="0" cellspacing="0" cellpadding="0" style="border:2px solid #def3f8; ">
                  <tr>
                    <td style="padding-left:15px; "><table width="98%"  border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="35" height="40" align="center" valign="middle"><img src="new-images/pl/arrow.gif" width="20" height="22" /></td>
                        <td><div style="color:#7e5a09; font-size:13px; font-weight:bold; background-color:#f6fcfd; line-height:24px;  ">Over 6 lakh customers have taken quote at Deal4loans.com</div></td>
                      </tr>
                                          <tr>
                        <td width="30" height="35" align="center" valign="middle"><img src="new-images/pl/arrow.gif" width="20" height="22" /></td>
                        <td><div style="color:#7e5a09; font-size:13px; font-weight:bold; background-color:#f6fcfd; line-height:24px;  ">Education loan  Offers are free for customers.</div></td>
                      </tr>
                      <tr>
                        <td width="30" height="35" align="center" valign="middle"><img src="new-images/pl/arrow.gif" width="20" height="22" /></td>
                        <td><div style="color:#7e5a09; font-size:13px; font-weight:bold; background-color:#f6fcfd; line-height:24px;  ">Deal4loans.com has tie ups with major Education loan Banks in India.</div></td>
                      </tr>
                       <tr>
                        <td width="30" height="35" align="center" valign="middle"><img src="new-images/pl/arrow.gif" width="20" height="22" /></td>
                        <td><div style="color:#7e5a09; font-size:13px; font-weight:bold; background-color:#f6fcfd; line-height:24px;  ">Your details will not be shared with any bank unless you opt for it.</div></td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                      </tr>
                    </table></td>
                  </tr>
                </table></td>
              </tr>
              <tr>
                <td align="center" valign="middle">&nbsp;</td>
              </tr>
              <tr>
                <td><table width="100%"  border="0" align="center" cellpadding="0" cellspacing="0">
                  <tr>
                    <td width="100" class="bldtxt">Loan Partners</td>
                    <td><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td><img src="new-images/pl/logo_credila.gif" width="96" height="25" /></td>
                          <td><img src="new-images/pl/hdfc.jpg" width="99" height="29" /></td>
                          <td><img src="new-images/pl/sbi.gif" width="97" height="24" /></td>
                          <td><img src="new-images/pl/bob.jpg" width="97" height="24" /></td>
                         	
                            </tr>
                    </table></td>
                  </tr>
                </table>                  </td>
              </tr>
            </table></td>
            </tr>
        </table></td>
        <td width="322" valign="top"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td valign="top"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="289" height="88" align="left" valign="top"><img src="new-images/el/edu-loan-reqst.jpg" width="289" height="88" /></td>
              </tr>
              <tr>
                <td valign="top" height="450" style="border-left:1px solid #c2c2c2; border-right:1px solid #c2c2c2; padding-top:10px">
				 <div align="center"><b><font color="#3366CC">Thanks for applying on Deal4loans.com.<br />
				    You will get a call from us, for information and rates. </font></b><br><br></div>
                </td>
              </tr>
              <tr>
                <td valign="top"><img src="images/cl/frm-btm.gif" width="289"   height="21"></td>
              </tr>
              </table></td>
            <td width="33" height="336" align="right" valign="top"><img src="new-images/el/right-bg.jpg" /></td>
          </tr>
		  
        </table></td>
      </tr>
    </table></td>
  </tr>
  <Tr>
  <td height="10" align="center" valign="middle" bgcolor="#0099FF"></td>
  </Tr>
</table>
<!-- Google Code for education Conversion Page -->

<script type="text/javascript">

/* <![CDATA[ */

var google_conversion_id = 1066264455;

var google_conversion_language = "ar";

var google_conversion_format = "2";

var google_conversion_color = "ffffff";

var google_conversion_label = "WfqfCJ34jQIQh8-3_AM";

var google_conversion_value = 0;

/* ]]> */

</script>

<script type="text/javascript" src="http://www.googleadservices.com/pagead/conversion.js">

</script>

<noscript>

<div style="display:inline;">

<img height="1" width="1" style="border-style:none;" alt="" src="http://www.googleadservices.com/pagead/conversion/1066264455/?label=WfqfCJ34jQIQh8-3_AM&amp;guid=ON&amp;script=0"/>

</div>

</noscript>

</body>
</html>
