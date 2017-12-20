<?php
 $requestid = $_REQUEST["postid"];
 $bidderid = $_REQUEST["biddt"];
require 'scripts/session_check_online.php';
require 'scripts/db_init.php';
require 'scripts/functions.php';
require 'soapservice_cfl_pl.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		foreach($_POST as $a=>$b)
			$$a=$b;	
		
		$full_name = FixString($full_name);
		$dob = FixString($dob);
		$marital_status = FixString($marital_status);
		$purpose_of_loan = FixString($purpose_of_loan);
		$current_address = FixString($current_address);
		$property_status = FixString($property_status);
		$annual_income = FixString($annual_income);
		$company_name =  FixString($company_name);
		$office_address = FixString($office_address);
		$requestid = FixString($requestid);
		$panno = FixString($panno);
		$comment_section = FixString($comment_section);
		$ccfeedback = FixString($ccfeedback);
		$FollowupDate  = FixString($FollowupDate);
		$capfirstid  = FixString($capfirstid);
		$Email  = FixString($Email);
		$City_Other  = FixString($City_Other);
		$City  = FixString($City);
		$Mobile_Number  = FixString($Mobile_Number);
		$first_webservice = FixString($first_webservice);
		$gender = FixString($gender);
		$capitalfirst_resipincode = FixString($resipincode);
		$officepincode = FixString($officepincode);
		$City = FixString($City);
		$City_Other = FixString($City_Other);
		$capitalfirst_occupation = FixString($capitalfirst_occupation);
		$Dated=ExactServerdate();

	if($City=="Others" && strlen($City_Other)>0)
	{
		$strcity=$City_Other;
	}
	else
	{
		$strcity=$City;
	}

if($bidderid==5796 || $bidderid==5795)
	{
		$direct_flag=1;
	}
	else
	{
		$direct_flag=0;
	}
if($capfirstid>0)
	{	
		$DataArray = array("capitalfirst_name" => $full_name, "capitalfirst_dob" => $dob, "capitalfirst_marital_stat" => $marital_status, "capitalfirst_purpose_ofloan" => $purpose_of_loan, "capitalfirst_current_address" => $current_address, "capitalfirst_property_stat" => $property_status, "capitalfirst_annual_income" => $annual_income, "capitalfirst_company_name" => $company_name, "capitalfirst_office_address" => $office_address, "capitalfirst_panno" => $panno, "capitalfirst_requestid" => $requestid, "capitalfirst_dated"=> $Dated, "direct_flag"=>$direct_flag, "capitalfirst_gender" => $gender, "capitalfirst_resipincode" => $capitalfirst_resipincode,"capitalfirst_officepincode"=> $officepincode,"capitalfirst_city"=> $City ,"capitalfirst_city_other"=> $City_Other, "capitalfirst_occupation"=> $capitalfirst_occupation, "capitalfirst_email"=>$Email);
		$wherecondition ="(capitalfirstid=".$capfirstid.")";
		Mainupdatefunc ('apply_pl_capitalfirst', $DataArray, $wherecondition);
	}
	else
	{
if(strlen($full_name)>0 && $requestid>0 && $capfirstid=="")
	{
	
	 $getpldetails="select capitalfirst_requestid From apply_pl_capitalfirst Where (capitalfirst_requestid='".$requestid."')";
	list($alreadyExist,$plrow)=Mainselectfunc($getpldetails,$array = array());
if($alreadyExist>0)
		{
	$DataArray = array("capitalfirst_name" => $full_name, "capitalfirst_dob" => $dob, "capitalfirst_marital_stat" => $marital_status, "capitalfirst_purpose_ofloan" => $purpose_of_loan, "capitalfirst_current_address" => $current_address, "capitalfirst_property_stat" => $property_status, "capitalfirst_annual_income" => $annual_income, "capitalfirst_company_name" => $company_name, "capitalfirst_office_address" => $office_address, "capitalfirst_panno" => $panno, "capitalfirst_dated"=> $Dated, "direct_flag"=>'0', "capitalfirst_gender" => $gender, "capitalfirst_resipincode" => $capitalfirst_resipincode, "capitalfirst_officepincode"=> $officepincode,"capitalfirst_city"=> $City ,"capitalfirst_city_other"=> $City_Other, "capitalfirst_occupation"=> $capitalfirst_occupation, "capitalfirst_email"=>$Email);
		$wherecondition ="(capitalfirst_requestid=".$requestid.")";
		Mainupdatefunc ('apply_pl_capitalfirst', $DataArray, $wherecondition);
		}
		else
		{
$data = array("capitalfirst_name" => $full_name, "capitalfirst_dob" => $dob, "capitalfirst_marital_stat" => $marital_status, "capitalfirst_purpose_ofloan" => $purpose_of_loan, "capitalfirst_current_address" => $current_address, "capitalfirst_property_stat" => $property_status, "capitalfirst_annual_income" => $annual_income, "capitalfirst_company_name" => $company_name, "capitalfirst_office_address" => $office_address, "capitalfirst_panno" => $panno, "capitalfirst_requestid" => $requestid, "capitalfirst_dated"=> $Dated, "direct_flag"=>'0', "capitalfirst_gender" => $gender, "capitalfirst_resipincode" => $capitalfirst_resipincode,"capitalfirst_officepincode"=> $officepincode,"capitalfirst_city"=> $City ,"capitalfirst_city_other"=> $City_Other, "capitalfirst_occupation"=> $capitalfirst_occupation, "capitalfirst_email"=>$Email );
$capitalfirstid = Maininsertfunc("apply_pl_capitalfirst", $data);
	}
	}
	}
//webservice
$findme   = 'Loan Application Number';
$firstpos = strpos($first_webservice, $findme);

if($ccfeedback=="Send Now" && $firstpos===false)
	{
	//echo $strcity." - ".$full_name." - ".$capitalfirst_resipincode." - ".$gender." - ".$marital_status." - ".$dob." - ".$Email." - ".$panno." - ".$current_address."<br><br>";
$firststatus=cflfirstserv($strcity,$full_name,$capitalfirst_resipincode,$gender,$marital_status,$dob,$Email,$panno,$current_address, $Mobile_Number);
if(strlen($firststatus)>2)
	{
		$DataArray = array("first_webservice" => $firststatus,"first_webdated"=> $Dated);
		$wherecondition ="(capitalfirst_requestid=".$requestid.")";
		Mainupdatefunc ('apply_pl_capitalfirst', $DataArray, $wherecondition);
	}
	}
//webservice end
	if(strlen($ccfeedback)>0 || strlen($comment_section)>0)
	{
		$strSQL="";
		$Msg="";
		$result = ExecQuery("select FeedbackID,not_contactable_counter from Req_Feedback_PL where AllRequestID=".$requestid." and BidderID=".$bidderid." AND Reply_Type=4");
		$num_rows = mysql_num_rows($result);
		if($num_rows > 0)
		{	
			$row = mysql_fetch_array($result);
			$strSQL="Update Req_Feedback_PL Set Feedback='".$ccfeedback."',comment_section='".$comment_section."',Followup_Date='".$FollowupDate."'";
			$strSQL=$strSQL."Where FeedbackID=".$row["FeedbackID"];
			}
		else
		{
			$strSQL="Insert into Req_Feedback_PL(AllRequestID, BidderID, Reply_Type , Feedback, Followup_Date,comment_section) Values (";
			$strSQL=$strSQL.$requestid.",".$bidderid.",4,'".$ccfeedback."','".$FollowupDate."','".$comment_section."')";
		}
		//echo $strSQL;
		$result = ExecQuery($strSQL);
		if ($result == 1)
		{
		}
		else
		{
			$Msg = "** There was a problem in adding your feedback. Please try again.";
		}	
}
}
$followup_date="";
 $ccdetails = "select Employment_Status,CC_Holder,Dated,DOB,Name,Email,Company_Name,City,City_Other,Mobile_Number,Net_Salary,Loan_Amount,Pincode,IP_Address,Add_Comment,Residence_Address,Feedback,Followup_Date,comment_section,Total_Experience from Req_Loan_Personal LEFT OUTER JOIN Req_Feedback_PL ON Req_Feedback_PL.AllRequestID=Req_Loan_Personal.RequestID AND Req_Feedback_PL.BidderID= '".$bidderid."' Where (RequestID=".$requestid.")";
//echo $ccdetails."<br>";
$ccdetailsresult = ExecQuery($ccdetails);
$ccrow=mysql_fetch_array($ccdetailsresult);

$Feedback= $ccrow["Feedback"];
$followup_date= $ccrow["Followup_Date"];
$comment_section= $ccrow["comment_section"];
$annual_income = $ccrow["Net_Salary"];
$dob = $ccrow["DOB"];
$fullname = $ccrow["Name"];
$Total_Experience = $ccrow["Total_Experience"];
$company_name =  $ccrow["Company_Name"];

	if($ccrow["Employment_Status"]==0) { $emp_status="Self Employed"; } else { $emp_status="Salaried"; }
	if($ccrow["CC_Holder"]==1) { $cc_holder="Yes"; }  if($ccrow["CC_Holder"]==0) { $cc_holder="No"; }					
	if($ccrow["Card_Vintage"]==1)	{	$card_vintage="Less than 6 months";}
	elseif($ccrow["Card_Vintage"]==2)	{	$card_vintage="6 to 9 months";}
	elseif($ccrow["Card_Vintage"]==3)	{	$card_vintage="9 to 12 months";}
	elseif($ccrow["Card_Vintage"]==4)		{	$card_vintage="more than 12 months";}
	else	{		$card_vintage="";	}

$ccfb_alldetails = ExecQuery("select * from apply_pl_capitalfirst Where (capitalfirst_requestid=".$requestid.")");
$ccrowfb=mysql_fetch_array($ccfb_alldetails);
$recordcount = mysql_num_rows($ccfb_alldetails);
if($recordcount>0 && count($ccrowfb)>0)
{
	$fullname = $ccrowfb["capitalfirst_name"];
	$dob = $ccrowfb["capitalfirst_dob"];
	$marital_status = $ccrowfb["capitalfirst_marital_stat"];
	$purpose_of_loan = $ccrowfb["capitalfirst_purpose_ofloan"];
	$current_address = $ccrowfb["capitalfirst_current_address"];
	$property_status = $ccrowfb["capitalfirst_property_stat"];
	$annual_income = $ccrowfb["capitalfirst_annual_income"];
	$company_name =  $ccrowfb["capitalfirst_company_name"];
	$office_address = $ccrowfb["capitalfirst_office_address"];
	$panno = $ccrowfb["capitalfirst_panno"];
	$capitalfirstid = $ccrowfb["capitalfirstid"];
	$first_webservice = $ccrowfb["first_webservice"];
	$second_webservice = $ccrowfb["second_webservice"];
	$capitalfirst_resipincode = $ccrowfb["capitalfirst_resipincode"];
	$capitalfirst_gender = $ccrowfb["capitalfirst_gender"];
	$capitalfirst_city = $ccrowfb["capitalfirst_city"];
	$capitalfirst_city_other = $ccrowfb["capitalfirst_city_other"];
}
if(strlen($capitalfirst_city)>0)
{
	$strcity=$capitalfirst_city;
}
else
{
	$strcity = $ccrow["City"];
}
if(strlen($capitalfirst_city_other)>0)
{
	$strcityother=$capitalfirst_city_other;
}
else
{
	$strcityother = $ccrow["City_Other"];
}

if(strlen($ccrowfb["capitalfirst_email"])>2)
{
	$plemail=$ccrowfb["capitalfirst_email"];
}
else
{
	$plemail=$ccrow["Email"];
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script language="javascript" type="text/javascript" src="scripts/datetime.js"></script>
<title>Credit Card</title>
<style type="text/css">
<!--
.style2 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold;}
.style21 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size:12px;}
-->
</style>
</head>
<body>
<form name="loan_form" method="post" action="<? echo $_SERVER['PHP_SELF'] ?>?postid=<?echo $requestid;?>&biddt=<? echo $bidderid;?>" >
<input type="hidden" name="biddtnw" value="<?echo $bidderid;?>">
<input type="hidden" name="capfirstid" id="capfirstid" value="<? echo $capitalfirstid;?>">
<input type="hidden" name="first_webservice" id="first_webservice" value="<? echo trim($first_webservice); ?>">
<input type="hidden" name="postidnw" value="<?echo $requestid;?>">
<!--<input type="hidden" name="capitalfirst_occupation" id="capitalfirst_occupation" value="<? echo $emp_status;?>">-->

<table style='border:1px dotted #9C9A9C;' cellspacing="2" cellpadding="5" width="600" height="80%" align="center" border="0" >
<tr><td colspan="2" align="center" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold;">Personal loan customer details</td></tr>
<tr>
        <td width="180"><span class="style2">Customer Name: </span></td>
    <td width="392"><span class="style21"><input name="full_name" type="text" class="capital-first_input" id="full_name" value="<? echo $fullname; ?>"/></span></td>
  </tr>
     <tr>
        <td><span class="style2"> DOB: </span></td>
       <td><span class="style21"><input name="dob" type="text" class="capital-first_input" id="dob" value="<? echo $dob; ?>"/></span></td>
  </tr>
     <tr>
        <td><span class="style2"> Email: </span></td>
       <td><span class="style21"><input type="text" value="<? echo $plemail; ?>" name="Email" id="Email"></span></td>
  </tr>
     <tr>
        <td><span class="style2"> Mobile No: </span></td>
       <td><span class="style21"><input type="hidden" value="<? echo $ccrow["Mobile_Number"]; ?>" name="Mobile_Number" id="Mobile_Number"><? echo $ccrow["Mobile_Number"]; ?></span></td>
  </tr>
     <tr>
        <td><span class="style2"> Occupation: </span></td>
       <td><span class="style21"><select class="fontstyle" name="capitalfirst_occupation" id="capitalfirst_occupation">
			<option value="Salaried" <? if($emp_status=="Salaried") { echo "Selected"; } ?> >Salaried</option>
			<option value="Self Employed" <? if($emp_status=="Self Employed") { echo "Selected"; } ?> >Self Employed</option></select></span></td>
  </tr>
     <tr>
        <td><span class="style2"> Company Name: </span></td>
       <td><span class="style21"><input name="company_name" type="text" class="capital-first_input" id="company_name" value="<? echo $company_name; ?>"/></span></td>
  </tr>
   <tr>
        <td><span class="style2"> Total Experience </span></td>
       <td><span class="style21"><? echo $Total_Experience; ?></span></td>
  </tr>     
<tr>
     <td><span class="style2"> City: </span></td>
    <td><span class="style21"><select size="1" name="City" id="City"> <option value="Ahmedabad">Ahmedabad</option>
		<option value="Bangalore" <? if($strcity=="Bangalore") { echo "Selected"; } ?> >Bangalore</option>
		<option value="Baroda" <? if($strcity=="Baroda") { echo "Selected"; } ?>>Baroda</option>
		<option value="Vadodara" <? if($strcity=="Vadodara") { echo "Selected"; } ?>>Vadodara</option>
		<option value="Bhopal" <? if($strcity=="Bhopal") { echo "Selected"; } ?>>Bhopal</option>
		<option value="Bhubneshwar" <? if($strcity=="Bhubneshwar") { echo "Selected"; } ?>>Bhubneshwar</option>
		<option value="Chandigarh" <? if($strcity=="Chandigarh") { echo "Selected"; } ?>>Chandigarh</option>
		<option value="Chennai" <? if($strcity=="Chennai") { echo "Selected"; } ?>>Chennai</option>
		<option value="Coimbatore" <? if($strcity=="Coimbatore") { echo "Selected"; } ?>>Coimbatore</option>
		<option value="Cuttack" <? if($strcity=="Cuttack") { echo "Selected"; } ?>>Cuttack</option>
		<option value="Delhi" <? if($strcity=="Delhi") { echo "Selected"; } ?>>Delhi</option>
		<option value="Ghaziabad" <? if($strcity=="Ghaziabad") { echo "Selected"; } ?>>Ghaziabad</option>
		<option value="Gurgaon" <? if($strcity=="Gurgaon") { echo "Selected"; } ?>>Gurgaon</option>
		<option value="Noida" <? if($strcity=="Noida") { echo "Selected"; } ?>>Noida</option>
		<option value="Faridabad" <? if($strcity=="Faridabad") { echo "Selected"; } ?>>Faridabad</option>
		<option value="Hyderabad" <? if($strcity=="Hyderabad") { echo "Selected"; } ?>>Hyderabad</option>
		<option value="Indore" <? if($strcity=="Indore") { echo "Selected"; } ?>>Indore</option>
		<option value="Jaipur" <? if($strcity=="Jaipur") { echo "Selected"; } ?>>Jaipur</option>
		<option value="Jalandhar" <? if($strcity=="Jalandhar") { echo "Selected"; } ?>>Jalandhar</option>
		<option value="Jodhpur" <? if($strcity=="Jodhpur") { echo "Selected"; } ?>>Jodhpur</option>
		<option value="Kolkata" <? if($strcity=="Kolkata") { echo "Selected"; } ?>>Kolkata</option>
		<option value="Lucknow" <? if($strcity=="Lucknow") { echo "Selected"; } ?>>Lucknow</option>
		<option value="Ludhiana" <? if($strcity=="Ludhiana") { echo "Selected"; } ?>>Ludhiana</option>
		<option value="Mumbai" <? if($strcity=="Mumbai") { echo "Selected"; } ?>>Mumbai</option>
		<option value="Navi Mumbai" <? if($strcity=="Navi Mumbai") { echo "Selected"; } ?>>Navi Mumbai</option>
		<option value="Thane" <? if($strcity=="Thane") { echo "Selected"; } ?>>Thane</option>
		<option value="Nagpur" <? if($strcity=="Nagpur") { echo "Selected"; } ?>>Nagpur</option>
		<option value="Nasik" <? if($strcity=="Nasik") { echo "Selected"; } ?>>Nasik</option>
		<option value="Pune" <? if($strcity=="Pune") { echo "Selected"; } ?>>Pune</option>
		<option value="Surat" <? if($strcity=="Surat") { echo "Selected"; } ?>>Surat</option>
		<option value="Udaipur" <? if($strcity=="Udaipur") { echo "Selected"; } ?>>Udaipur</option>
		<option value="Vijaywada" <? if($strcity=="Vijaywada") { echo "Selected"; } ?>>Vijaywada</option>
		<option value="Vishakapatnam" <? if($strcity=="Vishakapatnam") { echo "Selected"; } ?>>Vishakapatnam</option>
		<option value="Vizag" <? if($strcity=="Vizag") { echo "Selected"; } ?>>Vizag</option>
		<option value="Madurai" <? if($strcity=="Madurai") { echo "Selected"; } ?>>Madurai</option>
		<option value="Ambala" <? if($strcity=="Ambala") { echo "Selected"; } ?>>Ambala</option>
		<option value="Anand" <? if($strcity=="Anand") { echo "Selected"; } ?>>Anand</option><option value="Others" <? if($strcity=="Others") { echo "Selected"; } ?>>Others</option></select></span></td>
  </tr>
     <tr>
        <td><span class="style2"> Other City: </span></td>
       <td><span class="style21"><input type="text" value="<? echo $strcityother; ?>" name="City_Other" id="City_Other"></span></td>
  </tr>    
     <tr><td colspan="2"><table width="100%" cellpadding="0" cellspacing="0">
     <tr>
        <td width="32%" class="style2"> Card Holder: </td>
        <td width="25%" class="style21"><? echo $cc_holder; ?></td>
        <td width="23%" class="style2">Card Vintage: </td>
        <td width="20%" class="style21"><? echo $card_vintage; ?></td>
     </tr>
     </table></td>
  </tr>
  <tr><td><span class="style2">PAN No:</span></td><td><span class="style21"><input type="text" name="panno" id="panno" maxlength="10" class="capital-first_input" value="<? echo $panno; ?>"/></span></td></tr>
      <tr>
        <td><span class="style2"> Annual Income: </span></td>
        <td><span class="style21"><input name="annual_income" type="text" class="capital-first_input" id="annual_income" value="<? echo $annual_income; ?>"/></span></td>
  </tr>
  <tr>
    <td class="style2">Gender</td>
    <td class="style2"><label for="select"></label>
      <select name="gender" class="capital-first_input" id="gender">
        <option value="Male" <? if($capitalfirst_gender=="Male") echo "Selected"; ?>>Male</option>
        <option value="Female" <? if($capitalfirst_gender=="Female") echo "Selected"; ?>>Female</option>
        </select></td>
  </tr>
  <tr>  
    <td><span class="style2">Marital Status </span></td>
    <td><span class="style2"><label for="select"></label>
      <select name="marital_status" class="capital-first_input" id="marital_status">
        <option value="Single" <? if($marital_status == "Single") { echo "selected"; } ?> >Single</option>
        <option value="Married" <? if($marital_status == "Married") { echo "selected"; } ?> >Married</option>
        </select> </span></td>
  </tr>
  <tr>
    <td><span class="style2">Purpose of Loan </span></td>
    <td><span class="style2"><select name="purpose_of_loan" class="capital-first_input" id="purpose_of_loan">
	<option value="">Please Select</option>
      <option value="Car Repair or Purchase" <? if($purpose_of_loan == "Car Repair or Purchase") { echo "selected"; }?>>Car Repair/Purchase</option>
      <option value="Education" <? if($purpose_of_loan == "Education") { echo "selected"; }?>>Education</option>
      <option value="Holidays" <? if($purpose_of_loan == "Holidays") { echo "selected"; }?>>Holidays</option>
       <option value="Home Improvement or Lot Downpayment" <?if($purpose_of_loan == "Home Improvement or Lot Downpayment") { echo "selected"; }?>>Home Improvement/Lot Downpayment</option>
       <option value="Investments" <? if($purpose_of_loan == "Medical Expense") { echo "selected"; }?>>Investments</option>
       <option value="Medical Expense" <? if($purpose_of_loan == "selected") { echo "selected"; }?>>Medical Expense</option>
       <option value="Others" <? if($purpose_of_loan == "Others") { echo "selected"; }?>>Others</option>
         <option value="Wedding" <? if($purpose_of_loan == "Wedding") { echo "selected"; }?>>Wedding</option>    
    </select> </span></td>
  </tr>
  <tr>
    <td><span class="style2">Current Address (With Landmark) </span></td>
    <td><span class="style2"><textarea rows="3" cols="21" name="current_address" id="current_address" class="capital-first_txtinput"><? echo $current_address; ?></textarea> </span></td>
  </tr>
   <tr>
        <td><span class="style2"> Pincode: <? echo $ccrow["capitalfirst_resipincode"]; ?></span></td>
       <td><span class="style21"><input type="text" value="<? echo $ccrowfb["capitalfirst_resipincode"]; ?>" name="resipincode" id="resipincode"></span></td>
  </tr>
  
  <tr>
    <td><span class="style2">Property Status </span></td>
    <td><span class="style2"><select name="property_status" class="capital-first_input" id="property_status">
		<option value="">Please Select</option>
      <option value="Company Provided" <? if($property_status == "Company Provided") { echo "selected"; } ?> >Company Provided</option>
      <option value="Mortgaged" <? if($property_status == "Mortgaged") { echo "selected"; } ?>>Mortgaged</option>
      <option value="Owned" <? if($property_status == "Owned") { echo "selected"; } ?>>Owned</option>
      <option value="Relatives House" <? if($property_status == "Relatives House") { echo "selected"; } ?>>Relatives House</option>
      <option value="Rented" <? if($property_status == "Rented") { echo "selected"; } ?>>Rented</option>
        </select> </span></td>
    </tr>
	 <tr>
    <td><span class="style2">Office Address (With Landmark) </span></td>
    <td><span class="style2"><textarea rows="3" cols="21" name="office_address" id="office_address" class="capital-first_txtinput"><? echo $office_address; ?></textarea> </span></td>
  </tr>   
   <tr>
        <td><span class="style2">Office Pincode: </span></td>
       <td><span class="style21"><input type="text" value="<? echo $ccrowfb["capitalfirst_officepincode"]; ?>" name="officepincode" id="officepincode"></span></td>
  </tr>
  
     <tr>
        <td><span class="style2">Comments: </span></td>
        <td><span class="style21"><? echo $ccrow["Add_Comment"]; ?></span></td>
     </tr>
	  <tr>
        <td><span class="style2">LMS Comments: </span></td>
        <td><span class="style21"><textarea rows="2" cols="15" name="comment_section"><? echo $ccrow["comment_section"]; ?></textarea></span></td>
     </tr>
	 <tr>
       <td><span class="style2">LMS feedback </span></td>
        <td><span class="style21"><select name="ccfeedback" id="ccfeedback">
		<option value="" <?if($Feedback == "") { echo "selected"; }?>>No Feedback</option>
		<option value="Ringing" <?if($Feedback == "Ringing") { echo "selected"; }?>>Ringing</option>
		<option value="Not Interested" <?if($Feedback == "Not Interested") { echo "selected"; }?>>Not Interested</option>
		<option value="Callback Later" <?if($Feedback == "Callback Later") { echo "selected"; }?>>Callback Later</option>
		<option value="Wrong Number" <?if($Feedback == "Wrong Number") { echo "selected"; }?>>Wrong Number</option>
		<option value="Not Eligible" <?if($Feedback == "Not Eligible") { echo "selected"; }?>>Not Eligible</option>
		<option value="FollowUp" <? if($Feedback == "FollowUp") { echo "selected"; }?>>FollowUp</option>
		<option value="Send Now" <? if($Feedback == "Send Now") { echo "selected"; }?>>Send Now</option>
	<option value="Approved" <? if($Feedback == "Approved") { echo "selected"; }?>>Entry Done- Approved</option>
	<option value="Reject" <? if($Feedback == "Reject") { echo "selected"; }?>>Entry Done- Reject</option>
	</select></span></td>
     </tr>
	
	 <tr>
	 <td class="fontstyle"><b>Follow Up Date</b></td>
	<td class="fontstyle"><input type="Text"  name="FollowupDate" id="FollowupDate" maxlength="25" size="15" <?php if($Followup_Date !='0000-00-00 00:00:00') { ?>value="<?php  echo $followup_date; ?>" <?php } ?>><a href="javascript:NewCal('FollowupDate','yyyymmdd',true,24)"><img src="images/cal.gif" width="16" height="16" border="0" alt="Pick a date"></a></td>
	 </tr>
     <tr>
        <td width="180"><span class="style2">Date of entry: </span></td>
        <td width="392"><span class="style21"><? echo $ccrow["Updated_Date"]; ?></span></td>
  </tr>
  <tr>
        <td width="180"><span class="style2">Customer IP: </span></td>
        <td width="392"><span class="style21"><? echo $ccrow["IP_Address"]; ?></span></td>
  </tr>
  <tr><td colspan="2" align="center"><input type="Submit" name="Submit" value="Submit"></td></tr>
  <tr><td>Status</td><td><? echo "first Webservice ".$first_webservice; ?></td></tr>
  <tr><td>Status</td><td><? echo "Second Webservice ".$second_webservice; ?></td></tr>
 </table>
</form>
</body>
</html>
