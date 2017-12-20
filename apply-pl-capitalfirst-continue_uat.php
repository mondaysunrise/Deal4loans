<?php
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		foreach($_POST as $a=>$b)
			$$a=$b;
		$first_name = FixString($first_name);
		$middle_name = FixString($middle_name);
		$last_name = FixString($last_name);
		if($middle_name=="Middle Name")
		{
		$middle_namestr="";
		$full_name1 = $first_name;
			} else { $middle_namestr = $middle_name; $full_name1 = $first_name." ".$middle_namestr;}

		if($last_name=="Last Name")
		{$last_namestr="";
		$full_name = $full_name1;} else { $last_namestr = $last_name; $full_name = $full_name1." ".$last_namestr;}
				list($firstn,$lastn) =  split('[ ]',$full_name);
		$day = FixString($day);
		$month = FixString($month);
		$year = FixString($year);
		$dob= $year."-".$month."-".$day;
		$dobstr= $day."/".$month."/".$year;
		$gender = FixString($gender);
		$marital_status = FixString($marital_status);
		$purpose_of_loan = FixString($purpose_of_loan);
		$current_address = FixString($current_address);
		$current_address2 = str_split($current_address, (strlen($current_address)/2));
		$address1 = $current_address2[0];
		$address2 = $current_address2[1];
		$property_status = FixString($property_status);
		$annual_income = FixString($annual_income);
		$company_name =  FixString($company_name);
		$office_address = FixString($office_address);
		$current_address_pincode = FixString($current_address_pincode);
		$requestid = FixString($requestid);
		$panno = FixString($panno);
		$Dated=ExactServerdate();

if(strlen($full_name)>0 && $requestid>0)
	{
	$getdetailspl="select Mobile_Number,Email,City,City_Other From Req_Loan_Personal Where ( RequestID='".$requestid."') order by Updated_Date DESC";
	list($alreadyExistpl,$myrowpl)=Mainselectfunc($getdetailspl,$array = array());
	$Mobile_Number = $myrowpl["Mobile_Number"];
	$Email = $myrowpl["Email"];
	$City = $myrowpl["City"];
	$City_Other = $myrowpl["City_Other"];
	if($City=="Others" && strlen($City_Other)>0)
		{
			$strCity= strtoupper($City_Other);
		}
		else
		{
			$strCity= strtoupper($City);
		}


	$getdetails="select capitalfirstid From apply_pl_capitalfirst Where ( capitalfirst_requestid='".$requestid."') order by capitalfirstid DESC";
	list($alreadyExist,$myrow)=MainselectfuncNew($getdetails,$array = array());
	if($alreadyExist>0)
	{
	}
	else
	{

$data = array("capitalfirst_name" => $full_name, "capitalfirst_dob" => $dob, "capitalfirst_marital_stat" => $marital_status, "capitalfirst_purpose_ofloan" => $purpose_of_loan, "capitalfirst_current_address" => $current_address, "capitalfirst_property_stat" => $property_status, "capitalfirst_annual_income" => $annual_income, "capitalfirst_company_name" => $company_name, "capitalfirst_office_address" => $office_address, "capitalfirst_panno" => $panno, "capitalfirst_requestid" => $requestid, "capitalfirst_dated"=> $Dated, "direct_flag"=>'1');
 $ProductValue = Maininsertfunc("apply_pl_capitalfirst", $data);

//CFL webservice UAT
	$access_token = cflgettoken();
	$url = "https://cs31.salesforce.com/services/apexrest/CreateLoan/";
	$content='{"loanAppWrapper": 
	 { 
	 "location":"'.$strCity.'", 
	 "lob":"PL",      
	 "createdBy":"Customer",   
	"partnerName":"DealForLoans_PL", 
	 "firstName":"'.$firstn.'", 
	 "lastName":"'.$lastn.'", 
	 "middleName":"", 
	 "loanSource":"PLOnline",    
	 "gender":"'.$gender.'",     
	 "maritalStatus":"'.$marital_status.'",     
	 "dateOfBirth":"'.$dobstr.'", 
	 "mobileNumber":"'.$Mobile_Number.'", 
	 "emailId":"'.$Email.'", 
	 "PAN":"'.$panno.'",  
	 "voterId":"", 
	 "passportNumber":"",    
	 "listAddress": 
	  [{"addressLine1":"'.$address1.'",
	"addressLine2":"'.$address2.'",
	"pincode":"'.$current_address_pincode.'",
	"addressType":"RESIDENCE ADDRESS",
	"landmark":""}]
	}}';
//echo $content;
	$curl = curl_init($url);
    curl_setopt($curl, CURLOPT_HEADER, false);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER,
            array("Authorization: Bearer $access_token",
                "Content-type: application/json", "Accept: application/json"));
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $content);

    $json_response = curl_exec($curl);

    $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
	$response = json_decode($json_response, true);
	$bodytag = str_replace("success:", "", $response);
   curl_close($curl);

$webdata = array("leadid" => $requestid, "product" => '1', "feedback" => $bodytag, "bidderid" => '5795', "doe" => $Dated, "cust_requestid" => $requestid);
 $webProductValue = Maininsertfunc("webservice_bidder_details", $webdata);
	}
}
}

function cflgettoken()
{
		$grant_type = "password";
		$LoginURL   =  "https://test.salesforce.com/services/oauth2/token";
		$ClientID   =  "3MVG9Se4BnchkASky48PDFhRdaKqZFbXyi5Ap869pbVr8eaNVLCOD8ze3XFoeQ.v1buh4pQBOlrrFxRUfRBXi";
		$ClientSecret  =  "2950331567982633593";
		$UserName      =  "reporting.manager.misuser@capfirst.com.uat2";
		$Password      =  "New#1234";

		$param="";
		$param["grant_type"] = $grant_type;
		$param["client_id"] = $ClientID;
		$param["client_secret"] = $ClientSecret;
		$param["username"] = $UserName;
		$param["password"] = $Password;
	
		$request = '';
		foreach($param as $key=>$val) //traverse through each member of the param array
		{ 
		  $request.= $key."=".urlencode($val); //we have to urlencode the values
		  $request.= "&"; //append the ampersand (&) sign after each paramter/value pair
		}
		
		 $request = substr($request, 0, strlen($request)-1);
		
		 $ch = curl_init($LoginURL);
		  curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");  
		  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		  curl_setopt($ch, CURLOPT_POSTFIELDS,$request);
			$result = curl_exec($ch);
		  curl_close($ch); 	
		$obj = json_decode($result);
		$access_token = $obj->{'access_token'}; 
		$instance_url = $obj->{'instance_url'}; 
		$token_type = $obj->{'token_type'}; 
		$issued_at =  $obj->{'issued_at'}; 
		$signature = $obj->{'signature'}; 

		return($access_token);
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<script type="text/javascript" src="js/jquery-1.11.0.min.js"></script>
<style type="text/css">
.heading_text{font: bold 18px/100% Arial, Helvetica, sans-serif; color:#AE1518; margin-left:15px; }
.capital-first{ color:#0199cd; font-family:Arial, Helvetica, sans-serif; font-size:13px; font-weight:bold;}
#sidebar {
	width: 340px;
	float: right;
	margin: 30px 0 30px;
}
#content {
	background: #fff;
	margin: 30px 0 30px 20px;
	padding: 10px;
	width: 570px;
	float: left;
	/* rounded corner */
	-webkit-border-radius: 8px;
	-moz-border-radius: 8px;
	border-radius: 8px;
	/* box shadow */
	-webkit-box-shadow: 0 1px 3px rgba(0,0,0,.4);
	-moz-box-shadow: 0 1px 3px rgba(0,0,0,.4);
	box-shadow: 0 1px 3px rgba(0,0,0,.4);
}
.widget {
	background: #fff;
	margin: 0 0 30px;
	padding: 10px 20px;
	/* rounded corner */
	-webkit-border-radius: 8px;
	-moz-border-radius: 8px;
	border-radius: 8px;
	/* box shadow */
	-webkit-box-shadow: 0 1px 3px rgba(0,0,0,.4);
	-moz-box-shadow: 0 1px 3px rgba(0,0,0,.4);
	box-shadow: 0 1px 3px rgba(0,0,0,.4);
}
.capital-first_txtinput{width:100%;  border-radius:5px 5px 5px 5px; border: 1px solid #AE1518;}
.capital-first_input{width:100%; height:25px; border-radius:5px 5px 5px 5px; border: solid 2px #0199cd;}
.capital-first_input{width:100%;  border-radius:5px 5px 5px 5px; border: solid 2px #0199cd;}

.sbi_text_bullet ul{ padding:0px 0px 0px 0px; margin:0px 0px 0px 0px}
.sbi_text_bullet li{color:#AE1518; font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold; list-style: url(/new-images/sbi_bullet1.jpg); margin-left:15px; line-height:25px; }
.sbi_text_bullet li a{color:#AE1518; font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold;}

.capital-first {
    color: #333;
    font-family: Arial, Helvetica, sans-serif;
    font-size: 13px;
    font-weight: bold;
}
.capital-first_input {
    width: 100%;
    height: 25px;
    border-radius: 5px 5px 5px 5px;
    border: solid 1px #AE1518;}
	
	.capital-first_input-one {
    width:31%;
    height: 25px;
    border-radius: 5px 5px 5px 5px;
    border: solid 1px #AE1518;}
	.capital-first_select-one {
    width:31.5%;
    height: 27px;
    border-radius: 5px 5px 5px 5px;
    border: solid 1px #AE1518;}
	
	.capital-first_input{
    width: 100%;
    border-radius: 5px 5px 5px 5px;
    border:solid 1px #AE1518;}
	
	@media screen and (max-width: 800px){
.heading_text{font: bold 18px/100% Arial, Helvetica, sans-serif; color:#AE1518; margin-left:15px; }
.capital-first{ color:#0199cd; font-family:Arial, Helvetica, sans-serif; font-size:13px; font-weight:bold;}
#sidebar {
	width:90%;
	float:none;
	margin: 30px 0 30px;
}
#content {
	background: #fff;
	margin: 30px 0 30px 20px;
	padding: 10px;
	width:90%;
	float:none;
	/* rounded corner */
	-webkit-border-radius: 8px;
	-moz-border-radius: 8px;
	border-radius: 8px;
	/* box shadow */
	-webkit-box-shadow: 0 1px 3px rgba(0,0,0,.4);
	-moz-box-shadow: 0 1px 3px rgba(0,0,0,.4);
	box-shadow: 0 1px 3px rgba(0,0,0,.4);
}

.widget {
	background: #fff;
	margin: 0 0 30px;
	padding: 10px 20px;
	/* rounded corner */
	-webkit-border-radius: 8px;
	-moz-border-radius: 8px;
	border-radius: 8px;
	/* box shadow */
	-webkit-box-shadow: 0 1px 3px rgba(0,0,0,.4);
	-moz-box-shadow: 0 1px 3px rgba(0,0,0,.4);
	box-shadow: 0 1px 3px rgba(0,0,0,.4);
}
.capital-first_input{width:100%; height:25px; border-radius:5px 5px 5px 5px; border: solid 2px #0199cd;}
.capital-first_txtinput{width:100%;  border-radius:5px 5px 5px 5px; border:1px solid #AE1518;}

.sbi_text_bullet ul{ padding:0px 0px 0px 0px; margin:0px 0px 0px 0px}
.sbi_text_bullet li{color:#AE1518; font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold; list-style: url(/new-images/sbi_bullet1.jpg); margin-left:15px; line-height:25px; }
.sbi_text_bullet li a{color:#AE1518; font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold;}

.capital-first {
    color: #333;
    font-family: Arial, Helvetica, sans-serif;
    font-size: 13px;
    font-weight: bold;
}
.capital-first_input {
    width: 100%;
    height: 25px;
    border-radius: 5px 5px 5px 5px;
    border: solid 1px #AE1518;}
	
	.capital-first_input-one {
    width:98%;
    height: 25px;
    border-radius: 5px 5px 5px 5px;
    border: solid 1px #AE1518;}
	.capital-first_select-one {
    width:98%;
    height: 27px;
    border-radius: 5px 5px 5px 5px;
    border: solid 1px #AE1518;}
	
	.capital-first_input{
    width: 100%;
    border-radius: 5px 5px 5px 5px;
    border:solid 1px #AE1518;}
	
	}
</style>
<style type="text/css">
.heading_text1 {font: bold 20px/100% Arial, Helvetica, sans-serif; color:#AE1518; margin-left:20px; }
</style>
<script type="text/javascript" src="scripts/mainmenu.js"></script>
</head>
<body>
<?php include "middle-menu.php"; ?>
<div style="clear:both;"></div>
<div class="cc_inner_wrapper">
<div style="clear:both;"></div>
<div class="common-bread-crumb" style="margin:auto; width:74%; margin-top:70px; color:#0a8bd9;"><u><a href="index.php" class="text12" style="color:#0080d6;" >Home</a></u> > <a href="#"  class="text12" style="color:#0080d6;"><u>Personal Loan</u></a> <span class="text12" style="color:#4c4c4c;">> Apply for Capital First</span></div>
<div style="clear:both; height:15px;"></div>
<div style="max-width:995px;  margin:auto;">
<div id="content">
<table align="center"  cellpadding="5" cellspacing="0"  width="100%">
<tr><td width="478" align="left" height="200"  valign="top" bgcolor="#FFFFFF" class="heading_text">Thank you for applying Capital first.<br><br> <? echo $bodytag; ?></td></tr>
    </table></div>    
    <div id="sidebar">
    <div class="widget">
      <table width="100%" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td width="58%" height="40" class="heading_text1" style="font-size:18px;"><span class="heading_text_b">Why Capital First?</span></td>
          <td width="42%" align="right" class="heading_text1" style="font-size:18px;"><img src="http://www.deal4loans.com/homeimages/capital-first-logo-index.png" /></td>
        </tr>
        <tr>
          <td colspan="2" style="color:#999; font-family:Verdana, Geneva, sans-serif; font-size:12px;">&nbsp;</td>
        </tr>
      </table>
      <div class="sbi_text_bullet">
  <ul>
  <li>Only KYC Documents required <br> <div style="font-size:11px; color:#999; font-weight:normal; line-height:15px;">Get loan basis your KYC documents only, no need to submit any financial documents like salary slip, ITR, form 16 etc.</div></li>
<li>Get online in-principle approval <br><div style="font-size:11px; color:#999; font-weight:normal; line-height:15px;"> Just provide your basic Personal/Professional details to get instant approval on your Personal Loan</div></li>
<li>Loans up to Rs.4 lacs<br/></li>
<li>Disbursal in 3 working days</li>
</ul>  
</div>
    </div>
    </div>
</div>
<div style="clear:both;"></div>
<!--partners-->
<?php include("footer_sub_menu.php"); ?>
</body>
</html>