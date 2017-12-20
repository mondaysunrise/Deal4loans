<?php
//print_r($_POST);
 $ReqID = $_REQUEST["postid"];
 $BidID = $_REQUEST["biddt"];

 $requestid = $_REQUEST["postid"];
 $bidderid = $_REQUEST["biddt"];
  $process =  $_REQUEST["process"];
//require 'scripts/session_check_online.php';
require 'scripts/db_init.php';
require 'scripts/functions.php';
//error_reporting(E_ALL);
//ini_set('display_errors', 1);
$updateqry= "Update lead_allocate set BidderID='".$BidID."' Where AllRequestID = '".$ReqID."' and BidderID=6846";
$updateqryresult = ExecQuery($updateqry);


function ccMasking($number, $maskingCharacter = 'X') 
{
	return substr($number, 0, 2) . str_repeat($maskingCharacter, strlen($number) - 4) . substr($number, -2);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		foreach($_POST as $a=>$b)
			$$a=$b;
	$RequestID = FixString($RequestID);
	$sbiccid = FixString($sbiccid);
	$Email = FixString($Email);
	$Gender = FixString($Gender);
	$panno = FixString($panno);
	$City = FixString($City);
	$City_Other = FixString($City_Other);
	$State = GetCityStatecCode($City);
	//$resiaddress1 = FixString($resiaddress1);
	//$resiaddress2 = FixString($resiaddress2);
	//$resiaddress3 = FixString($resiaddress3);
	//$resiaddress4 = FixString($resiaddress4);*/
	$postpaid_mobile = FixString($postpaid_mobile);
	$pincode = FixString($ResiPin);
	$Net_Salary = FixString($Net_Salary);
	$Employment_Status = FixString($Employment_Status);
	$comment_section = FixString($comment_section);
	$ccfeedback = FixString($ccfeedback);
	$FollowupDate  = FixString($FollowupDate);
	$Residence_Address = $_REQUEST["Residence_Address"];
	$CompanyName = FixString($Company_Name);
	//$OfficeAddress1 = FixString($OfficeAddress1);
	//$OfficeAddress2 = FixString($OfficeAddress2);
	//$OfficeAddress3 = FixString($OfficeAddress3);
	//$OfficeAddress4 = FixString($OfficeAddress4);
	//$Office_Address = $OfficeAddress1." ".$OfficeAddress2." ".$OfficeAddress3." ".$OfficeAddress4;
	//$Office_Addressstr =$OfficeAddress3." ".$OfficeAddress4;
	//$OfficePin = FixString($OfficePin);
	//$Land_linenumber = FixString($Land_linenumber);
	//$OfficeCity = FixString($OfficeCity);
	//$Phone_Number = FixString($Phone_Number);	
	//$OfficeState = GetCityStatecCode($OfficeCity);
	//$Qualification = FixString($Qualification);
	//$Designation = FixString($Designation);	
	$card_name = FixString($card_name);
	//$STD = "0".FixString($STD);
	$resiSTD = FixString($resiSTD);
	//$opt_citicard = FixString($opt_citicard); //citibank option
	//$citicard_name = FixString($citicard_name);
	$resiPhone_Number = FixString($resiPhone_Number);;
	$first_name = FixString($first_name);
	$middle_name = FixString($middle_name);
	$last_name = FixString($last_name);
	//$Submitciti = FixString($Submitciti);//Citibank Form
	//$mailing_address = FixString($mailing_address);
	//$citiDesignation = FixString($citiDesignation);
	//$dcb_bank = FixString($dcb_bank);
	$CC_Holder = FixString($CC_Holder);
	$relation_with_bank = FixString($_POST["ICICIBankRelationship"]);
	$bank_relationship_number = FixString($_POST["bank_relationship_number"]);
	$SalaryAccountOpened = FixString($_POST["SalaryAccountOpened"]);
	$page_name="SMS LMS";
	$total_exp = FixString($_POST["total_exp"]);

	if(strlen($middle_name)>0 && $middle_name!="Middle Name" && $last_name=="")
	{
		$last_name= $middle_name;
		$middle_name="";
	}
	else
	{		
		if($last_name=="")
		{
			$last_name= "Kumar";
		}
	}
		
	if($middle_name=="Middle Name")
	{		$middle_name="";	}
	$Name=$first_name." ".$middle_name." ".$last_name;
	$day = $_POST["day"];
	if(strlen($day)==1)
	{		$dd="0".$day;	}
	else
	{		$dd=$day;	}
	$month = $_POST["month"];
	if(strlen($month)==1)
	{		$mm="0".$month;	}
	else
	{		$mm=$month;	}
	$year = $_POST["year"];
	$DOB = $year."-".$mm."-".$dd;
	$Dated=ExactServerdate();

	if(strlen($ccfeedback)>0 && $ccfeedback=="Send Now")
	{
		$pushflag=1;
	}
	
	$othercityclause = '';
	if(strlen($City)>0)
	{
		$cityclause=", City='".$City."'";
		if(strlen($City_Other)>0)
		{
			$othercityclause=", City_Other='".$City_Other."'";
		}
	}

	if($resiPhone_Number>0)
	{
		$resi_landline=$resiPhone_Number;
	}
	else
	{
		$resi_landline=$postpaid_mobile;
	}

	$upcctblenw="Update Req_Credit_Card set Name='".$Name."',DOB='".$DOB."',Company_Name='".$Company_Name."',Std_Code='".$resiSTD."',Landline='".$resi_landline."', Email='".$Email."',Net_Salary='".$Net_Salary."',Gender='".$Gender."',Residence_Address ='".$Residence_Address."',State='".$State."',Employment_Status='".$Employment_Status."',CC_Holder='".$CC_Holder."', Total_Experience='".$total_exp."' , applied_card_name='".$card_name."', Pancard='".$panno."',Pincode='".$pincode."' ".$cityclause." ".$othercityclause." Where (RequestID=".$RequestID.")";
	$resulupcctblenw=ExecQuery($upcctblenw);

	$getdetails="select id From credit_card_banks_apply Where ( cc_requestid='".$RequestID."' and applied_bankname= 'ICICI Bank') order by id DESC";
	list($alreadyExist,$myrow)=Mainselectfunc($getdetails,$array = array());
	$id=$myrow['id'];
	if($alreadyExist>0)
	{
		$DataArray = array("cc_requestid"=>$RequestID,"relation_with_bank"=>$relation_with_bank, "lead_source" =>$page_name, "applied_bankname"=> "ICICI Bank", "bank_relationship_number"=> $bank_relationship_number, "billing_preference"=> $SalaryAccountOpened);
		$wherecondition ="(id='".$id."')";
		Mainupdatefunc ('credit_card_banks_apply', $DataArray, $wherecondition);
		$ProductValue =$id;
	}
	else
	{
		$InsertProductSql= array("cc_requestid" => $requestid, "relation_with_bank"=>$relation_with_bank, "lead_source" =>$page_name, "applied_bankname"=> "ICICI Bank", "bank_relationship_number"=> $bank_relationship_number, "billing_preference"=> $SalaryAccountOpened);
		$ProductValue = Maininsertfunc("credit_card_banks_apply", $InsertProductSql);
	}

	
	if(strlen($ccfeedback)>0 || strlen($comment_section)>0)
	{
		$strSQL="";
		$Msg="";
		$result = ExecQuery("select FeedbackID,not_contactable_counter from Req_Feedback_CC where AllRequestID=".$requestid." and BidderID=".$bidderid." AND Reply_Type=4");
		$num_rows = mysql_num_rows($result);
		if($num_rows > 0)
		{
			$row = mysql_fetch_array($result);
			$strSQL="Update Req_Feedback_CC Set Feedback='".$ccfeedback."',comment_section='".$comment_section."',Followup_Date='".$FollowupDate."', last_updated=Now()";
			$strSQL=$strSQL."Where FeedbackID=".$row["FeedbackID"];
		}
		else
		{
			$strSQL="Insert into Req_Feedback_CC(AllRequestID, BidderID, Reply_Type , Feedback, Followup_Date,comment_section,last_updated) Values (";
			$strSQL=$strSQL.$requestid.",".$bidderid.",4,'".$ccfeedback."','".$FollowupDate."','".$comment_section."',Now())";
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
	
	//Code to send data to API
	if(isset($_POST['hitApi']) && ($_POST['hitApi'] == 'checked')){
		$resiaddress1 = $Residence_Address;
		$strresiadd = round((strlen($resiaddress1)/2));
		$resiadd = str_split($resiaddress1, $strresiadd);
		$ResidenceAddress1 = substr(trim($resiadd[0]),0,40);
		$ResidenceAddress2 = substr(trim($resiadd[1]),0,40);
		$resiCity = $City;
		$getStateSql = "SELECT state,cityalias FROM icici_city_cc_list WHERE (city like '%".$City."%' or cityalias like '%".$City."%') and status=1 group by city";
		list($numRowsStateName,$getStateNameQuery)=MainselectfuncNew($getStateSql ,$array = array());
		$resistate= $getStateNameQuery[0]['state'];		
		$Stdcode = GetStdCode($resiCity);
		$resiCity = $getStateNameQuery[0]['cityalias'];
	
		$slct="select Email,DOB,Company_Name,Net_Salary,Mobile_Number,Employment_Status,City from Req_Credit_Card Where (RequestID='".$RequestID."')";
		list($Getnum,$row)=Mainselectfunc($slct,$array = array());
		$DOB = $row["DOB"];
		list($year,$month,$day) = explode("-",$DOB);
		$dobstr= $day."/".$month."/".$year;
		$CompanyName = $row["Company_Name"];
		$Email = $row["Email"];
		$Net_Salary = $row["Net_Salary"];
		$AnnIncome = intval($Net_Salary);
		$monthlyincome = round($AnnIncome/12);
		$Mobile_Number = $row["Mobile_Number"];
		$Employment_Status = $row["Employment_Status"];
		
		if($Employment_Status==0)
		{
			$EmpType="Selfemployed";
		}else
		{
			$EmpType="Salaried";
		}
		

		if($relation_with_bank=="Norelationship")
		{
			$SalaryAccountWithOtherBank="Yes";
		}
		else
		{
			$SalaryAccountWithOtherBank="No";
		}
		
		if($SalaryAccountOpened=="1")
		{
			$SalaryAccountOpenedDuration="Above2Months";
		}
		elseif($SalaryAccountOpened == "2")
		{
			$SalaryAccountOpenedDuration="Below2Months";
		}

		$jsonurl='{"UserID": "ehj8bmnI+ML6/loUxYHxOQy/bYqCe5depANl4020mVq03TlUM3jt+hsCiQsEF+lPz33zds1tfUXAsqcgHPHT2SAHzZDVdVu/5A9IIYyV30JwRNZRfZM/i7rver3vbMpfM30O7gc577eQZqJvYjg0AfXm959kfUii760L2LAzF6g=",   "Password": "D/3TLsXOYPQyYc6ynjW8hPYycLy/3ucicv4y55s8xRnVOvG3079trwMHKEa5CS1sb6qikGzpV/1Tj/Knr4V5cwrLMkc7iaJ7utKNKg9fgG4d8On8mtlrK34YLbncwNc3ix6AsjOB6bb5oGUn1iYGeBVWXwQd+SLLWJmL0eMz18s=",
		"ChannelType":"Deal4loans", 
		"ApplicantFirstName":"'.$first_name.'", 
		"ApplicantMiddleName":"'.$middle_name.'", 
		"ApplicantLastName":"'.$last_name.'", 
		"Gender":"'.$Gender.'", 
		"DateOfBirth":"'.$dobstr.'",
		"ResidenceAddress1":"'.$ResidenceAddress1.'", 
		"ResidenceAddress2":"'.$ResidenceAddress2.'", 
		"ResidenceAddress3":"", 
		"City":"'.$resiCity.'", 
		"ResidencePincode":"'.$pincode.'", 
		"ResidenceState":"'.$resistate.'", 
		"STDCode":"'.$Stdcode.'" ,
		"ResidencePhoneNumber":"", 
		"ResidenceMobileNo":"'.$Mobile_Number.'", 
		"PanNo":"'.$panno.'", 
		"ICICIBankRelationship":"'.$relation_with_bank.'", 
		"ICICIRelationshipNumber":"'.$bank_relationship_number.'", 
		"CustomerProfile":"'.$EmpType.'", 
		"CompanyName":"'.$CompanyName.'", 
		"SalaryAccountWithOtherBank":"'.$SalaryAccountWithOtherBank.'", 
		"Total_Exp":"'.$total_exp.'", 
		"Income":"'.$monthlyincome.'", 
		"SalaryAccountOpened":"'.$SalaryAccountOpenedDuration.'"}';

		//echo $jsonurl."<br><br>";exit;
		$url ="https://www.dc.transuniondecisioncentre.co.in/DC/TU.DC.GenericAPI/API/ICICICCEAS/NewApplication/";// Prod
		// cURL's initialization
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_FAILONERROR, 1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonurl);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json','Content-Type: application/json'));
		$response_data = curl_exec($ch);
		//print_r($response_data);
		$result = json_decode($response_data);
		$ApplicationId = $result->ApplicationId;
		$Decision = $result->Decision;
		$ErrorMessage = $result->ErrorMessage;
		$Reason = $result->Reason;
		$DataArray = array("request_data" =>$jsonurl, "response_data" =>$response_data);
		$wherecondition ="(id='".$ProductValue."')";
		Mainupdatefunc ('credit_card_banks_apply', $DataArray, $wherecondition);
	}
}

$followup_date="";
$ccdetails = "select Gender,Landline,Std_Code,Account_No,Pancard_No,Pancard,Employment_Status,CC_Holder,Dated,DOB,Name,Email,Company_Name,City,City_Other,Mobile_Number,Net_Salary,Loan_Amount,Pincode,IP_Address,Add_Comment,Residence_Address,applied_card_name,Total_Experience,Office_Address,Updated_Date from  Req_Credit_Card Where (RequestID=".$requestid.")";
$ccdetailsresult = ExecQuery($ccdetails);
$ccrow=mysql_fetch_array($ccdetailsresult);
$applied_card_name = $ccrow["applied_card_name"];

$needle = 'SBI';
if (strpos($applied_card_name,$needle) !== false) {
    echo '<center><b>SELECTED SBI CARD</b></center>';
}
$Gender = $ccrow["Gender"];
$pincode = $ccrow["Pincode"];
$CompanyName = $ccrow["Company_Name"];
$Landline = $ccrow["Landline"];
$Std_Code = $ccrow["Std_Code"];
$City = $ccrow["City"];
//$OffiAddress= $ccrow["Office_Address"];
//$stroffiadd = round((strlen($OffiAddress)/3));
//$offiadd = str_split($OffiAddress, $stroffiadd);
//$OfficeAddress1 = $offiadd[0];
//$OfficeAddress2 = $offiadd[1];
//$OfficeAddress3 = $offiadd[2];
list($year,$mm,$dd) = split("[-]",$ccrow["DOB"]);
$Residence_Address = $ccrow["Residence_Address"];
$Residence_Address = str_ireplace('|','',$Residence_Address);
list($first_name,$middle_name,$last_name) = split("[ ]",$ccrow["Name"]);
if(strlen($middle_name)>0 && $middle_name!="Middle Name" && $last_name=="")
{
	$last_name= $middle_name;
	$middle_name="";
}
else
{
	if($last_name==""){
		$last_name= "Kumar";
	}
}
if($middle_name=="Middle Name")
{
	$middle_name="";
}


$ccfb_alldetails = ExecQuery("select * from Req_Feedback_CC Where AllRequestID='".$requestid."' AND BidderID='".$bidderid."'");
$ccrowfb=mysql_fetch_array($ccfb_alldetails);
$Feedback= $ccrowfb["Feedback"];
$followup_date= $ccrowfb["Followup_Date"];
$comment_section= $ccrowfb["comment_section"];

$result = ExecQuery("select office_city,relation_with_bank,bank_relationship_number,office_pincode,billing_preference,qualification from credit_card_banks_apply where (cc_requestid=".$requestid." and applied_bankname like '%ICICI%')");
$num_rows = mysql_num_rows($result);
if($num_rows > 0)
{
	$amexrow = mysql_fetch_array($result);
	$OfficePin = $amexrow["office_pincode"];
	$SalaryAccountOpened= $amexrow["billing_preference"];
	$Qualification = $amexrow["qualification"];
	$officecity = $amexrow["office_city"];
	$relation_with_bank = $amexrow["relation_with_bank"];
	$bank_relationship_number = $amexrow["bank_relationship_number"];
}

if((strlen($first_name)<=1 || strlen($first_name)>=26) || 
(strlen($last_name)<=1 || strlen($last_name)>=26) ||
(strlen($ccrow["Email"])<3) || 
(($dd<1 || $dd>31) && ($mm<1 || $mm>12) && ($year<$minage || $year>$maxage)) || 
($Gender!='Male' && $Gender!='Female' ) || 
(strlen($ccrow["Pancard"])!=10) || 
((strlen(strpos(trim($applied_card_name), 'ICICI'))) == 0) || 
(strlen($Residence_Address)<=40) || 
(strlen($City)<2) || 
(strlen($pincode)!=6) || 
($ccrow["Employment_Status"] == 1 && intval($ccrow["Total_Experience"])==0) || 
($ccrow["Employment_Status"]!=1 && $ccrow["Employment_Status"]!=0) || 
($ccrow["Employment_Status"] == 1 && $CompanyName == '') || 
(intval($ccrow["Net_Salary"]) == '' || strlen(intval($ccrow["Net_Salary"])) > 7 ) || 
($relation_with_bank == '') || 
($relation_with_bank == 'Salary' && $SalaryAccountOpened == 0) ||
(($relation_with_bank == 'Salary'|| $relation_with_bank == 'Saving') && ($bank_relationship_number == '' || (strlen($bank_relationship_number) < 12) || (strlen($bank_relationship_number) > 16))))
{
	$submitApiStatus = 0;
} else {
	$submitApiStatus = 1;
}
//echo $SalaryAccountOpened;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Credit Card</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script language="javascript" type="text/javascript" src="scripts/datetime.js"></script>
<script type="text/javascript" src="ajax.js"></script>
<script type="text/javascript" src="ajax-dynamic-sbicclist.js"></script>
<style type="text/css">
/* Big box with list of options */
#ajax_listOfOptions {
	position: absolute;	/* Never change this one */
	width: 260px;	/* Width of box */
	height: 160px;	/* Height of box */
	overflow: auto;	/* Scrolling features */
	border: 1px solid #317082;	/* Dark green border */
	background-color: #FFF;	/* White background color */
	color: black;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	text-align: left;
	font-size: 10px;
	z-index: 50;
}
#ajax_listOfOptions div {	/* General rule for both .optionDiv and .optionDivSelected */
	margin: 1px;
	padding: 1px;
	cursor: pointer;
	font-size: 10px;
}
#ajax_listOfOptions .optionDivSelected { /* Selected item in the list */
	background-color: #2375CB;
	color: #FFF;
}
#ajax_listOfOptions_iframe {
	background-color: #F00;
	position: relative;
	z-index: 5;
}
form {
	display: inline;
}
.firstLabel {
    margin-right: 200px;
}
</style>
<style type="text/css">
<!--
.style2 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold;}
.style21 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size:12px;}
-->
.alert_msg {
font-family: Verdana, Arial, Helvetica, sans-serif; 
    color: #FF0000;
    font-weight: bold;
    font-size: 10px;
}
</style>
<script>
function showResiPinCode(str) {
//    alert('ddd');
	if (str == "") {
         document.getElementById("getPincodeList").innerHTML= "";
        return;
    } else {// alert("2");
        if (window.XMLHttpRequest) { // alert("3");

            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
       // alert("4");

            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() { //alert("5");

            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) { //alert("6");

                document.getElementById("getPincodeList").innerHTML= xmlhttp.responseText;
            }
        };
        xmlhttp.open("GET","geticici-resistdcode.php?q="+str,true);
        xmlhttp.send();
    }
}
</script>
</head>
<body>
<table cellpadding="0" cellspacing="0" align="center">
<tr><td>
<form name="loan_form" method="post" action="<? echo $_SERVER['PHP_SELF'] ?>?postid=<?echo $requestid;?>&biddt=<? echo $bidderid;?>" >
<input type="hidden" name="biddtnw" value="<? echo $bidderid;?>" />
<input type="hidden" name="RequestID" value="<? echo $requestid;?>" />
<input type="hidden" name="sbiccid" value="<? echo $sbiccid;?>" />
<table style='border:1px dotted #9C9A9C;' cellspacing="0" cellpadding="5" width="700" height="80%" align="center" border="1" >
	<tr>
		<td colspan="4" align="center" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold; height:25px;">ICICI Credit Card customer details
		<br />
		<?php 
		if($submitApiStatus == 1){
		?>
		<div class="alert_msg" style="font-size:16px;">Submit the ICICI Service by checking ICICI Webservice Run and then SUBMIT</div>
		<?php 
		}
		?>

		</td>
	</tr>
	<tr>
		<td width="180"><span class="style2">Customer Name: </span></td>
		<td width="392" colspan="3">
			<span class="style21">
				<input type="text" maxlength="30" size="13" name="first_name" id="first_name" value="<? echo $first_name; ?>" />&nbsp;
				<input type="text" maxlength="30" size="11" name="middle_name" id="middle_name" value="<? echo $middle_name; ?>"/>&nbsp;
				<input type="text" maxlength="30" size="17" name="last_name" id="last_name" value="<? echo $last_name; ?>"/>
			</span>
			<div id="fnameVal"  class="alert_msg">
				<?php if(strlen($first_name)<=1 || strlen($first_name)>=26) { echo "FirstName - Min : 1, Max : 26 Characters"; } ?><?php if(strlen($last_name)<=1 || strlen($last_name)>=26) { echo "LastName - Min : 1, Max : 26 Characters"; } ?>
			</div>
		</td>
	</tr>
    <tr>
		<td><span class="style2"> Mobile No: </span></td>
		<td><span class="style21"><? echo ccMasking($ccrow["Mobile_Number"]); ?></span></td>
        <td><span class="style2"> Email: </span></td>
		<td><span class="style21">
			<input type="text" value="<? echo $ccrow["Email"]; ?>" name="Email" id="Email" />
			<div id="emailVal"  class="alert_msg"><?php if(strlen($ccrow["Email"])<3){ echo "EMail should be like - abc@xyx.com";}?></div></span>
		</td>
	</tr>
	<tr>
		<td><span class="style2"> DOB: </span></td>
		<td><span class="style21">
			<?php echo listbox_date('day',$dd);?>
			<?php echo listbox_month('month', $mm);?>
			<?php $minage= Date('Y')-18; $maxage=Date('Y')-62; echo listbox_year('year',$maxage,$minage, $year);?>
			</span>
			<div id="emailVal"  class="alert_msg">
				<?php
				if(($dd<1 || $dd>31) && ($mm<1 || $mm>12) && ($year<$minage || $year>$maxage)){
					echo "Select valid DOB";
				}
				?>
			</div>
		</td>
		<td><span class="style2"> Gender: </span></td>
		<td><span class="style21">
			<select name="Gender" id="Gender" >
				<option value="-1">Please Select</option>
				<option value="Male" <? if($Gender=="Male") {echo "selected";} ?>>Male</option>
				<option value="Female" <? if($Gender=="Female") {echo "selected";} ?>>Female</option>
			</select></span>
			<div id="genderVal"  class="alert_msg">
				<?php if($Gender!='Male' && $Gender!='Female' ) { echo "Select Gender"; } ?>
			</div>
		</td>
	</tr>    
	<tr>
		<td><span class="style2">PanCard No</span></td>
		<td><input type="text" class="d4l-input" name="panno" id="panno" value="<? echo $ccrow["Pancard"] ;?>"  maxlength="10"/>
			<div id="panVal"  class="alert_msg"><?php if(strlen($ccrow["Pancard"])!=10) { echo "Pancard should be like - xxxpx1234x"; } ?></div>
		</td>
		<td><span class="style2">do you hold any card?</span></td>
		<td><span class="style21" >
			<input type="radio" name="CC_Holder" id="radio-one" value="1" class="css-checkbox" <?php if($ccrow["CC_Holder"]==1) { echo "checked";} ?> />
			<label for="radio-one" class="css-label radGroup2" >Yes</label>
			<input type="radio" name="CC_Holder" id="radio-two" value="2" class="css-checkbox" <?php if($ccrow["CC_Holder"]==2) { echo "checked";} ?>/>
			<label for="radio-two" class="css-label radGroup2">No</label>
			</span>
		</td>
    </tr>
	<tr>
		<td><span class="style2">Select Card</span></td>
		<td>
			<select name="card_name" id="card_name">
				<option value="">Please select </option>
				<? $getcardNameSql = "SELECT cc_bankid,cc_bank_name FROM `credit_card_banks_eligibility` WHERE (`cc_bank_name` like '%ICICI%' and `cc_bank_flag`=1) group by `cc_bank_name`";

				list($numRowsCardName,$getCardNameQuery)=MainselectfuncNew($getcardNameSql,$array = array());
				for($cN=0;$cN<$numRowsCardName;$cN++){
					$Card_id = $getCardNameQuery[$cN]['cc_bankid'];
					$cc_bank_name = $getCardNameQuery[$cN]['cc_bank_name'];
					?>
					<option value="<?php echo $cc_bank_name; ?>" <? if($cc_bank_name==$applied_card_name) { echo "Selected";} ?>><?php echo ucwords(strtolower($cc_bank_name)); ?></option>
				<?php
				}
				?>
			</select>
			<div id="cardVal"  class="alert_msg">
				<?php if((strlen(strpos(trim($applied_card_name), 'ICICI'))) == 0) { echo "Select Card";} ?>
			</div>
		</td>
		<td><span class="style2">Selected Card</span></td>
		<td><?php echo $applied_card_name; ?></td>
	</tr>
    <tr>
		<td colspan="4" align="center" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold; height:25px;">Residence details</td>
	</tr>
	<tr>
		<td><span class="style2"> Resi Address: </span></td>
		<td colspan="3"><span class="style21" >
			<input type="text" size=80 name="Residence_Address" id="Residence_Address" value="<? echo $Residence_Address; ?>" maxlength="120" /></span>
			<div id="resiVal"  class="alert_msg">
				<?php if(strlen($Residence_Address)<=40) { echo "Address Should be minimum 40 characters"; } ?>
			</div>
		</td>
	</tr>
	<tr>
		<td><span class="style2">Residence City: </span></td>
		<td><span class="style21">
			<select size="1" name="City" id="City" onchange="showResiPinCode(this.value)">
				<option value="">Please Select</option>
				<?php 
					$getICICISql= "select city from icici_city_cc_list where status=1 group by city";
					$getICICIQuery = ExecQuery($getICICISql);
					$cityCount= mysql_num_rows($getICICIQuery);
					$CityArr="";
					$optionCity = '';
					for($i=0;$i<$cityCount;$i++)
					{
						$CityArr = mysql_result($getICICIQuery, $i, 'city' );
						if($CityArr==$ccrow["City"]) { $selected="selected"; } else { $selected = "";}
						echo $optionCity = "<option value='".$CityArr."' ".$selected.">".$CityArr."</option>"; 
						$selected="";
					}
				?>
				<option value="Others">Others</option>
			</select></span>
			<div id="resiCityVal"  class="alert_msg">
				<?php if(strlen($City)<2) { echo "Select City"; } ?>
			</div>
		</td>
        <td><span class="style2"> Other City: </span></td>
		<td><span class="style21">
			<input type="text" value="<? echo $ccrow["City_Other"]; ?>" name="City_Other" id="City_Other" /></span>
		</td>
	</tr>  
	<tr>
		<td><span class="style2"> Resi pincode: </span></td>
		<td><span class="style21" id="getPincodeList">
		
		<select name="ResiPin" id="ResiPin" class="d4l-select" >
		 <option value="">Please Select</option>
				 <?  $getPinSql = "SELECT pincode FROM icici_city_cc_list WHERE (city like '%".$ccrow["City"]."%' or cityalias like '%".$ccrow["City"]."%') and status=1";
				 
				// echo $getPinSql;
				list($numRowsCarName,$getCarNameQuery)=MainselectfuncNew($getPinSql,$array = array());
				for($cN=0;$cN<$numRowsCarName;$cN++)
				{
					$Pincode = $getCarNameQuery[$cN]['pincode'];
					?>
					<option value="<?php echo $Pincode; ?>" <? if($Pincode==$ccrow["Pincode"]) {echo "Selected";} ?> ><?php echo $Pincode; ?></option>   
					<?php
				}
				?>	
                    <option value="">Select City first</option>
                  </select>

			<!--<input type="text" name="ResiPin" id="ResiPin"  value="<?php echo $pincode ; ?>" />--></span>
			<div id="ResiPinVal"  class="alert_msg">
				<?php if(strlen($pincode)!=6) { echo "Pincode should be 6 digits"; } ?>
			</div>
		</td>
		<td><span class="style2"> Resi number: </span></td>
        <td>
			<table cellpadding="2" cellspacing="2">
				<tr>
					<td>
						<div id="resitxtHint2" style="float:left; width:50px;"><input type="text" class="std"  name="resiSTD" value="<? echo $Std_Code; ?>"  onfocus="(this.value == 'STD') && (this.value = '')"   onblur="(this.value == '') && (this.value = 'STD')" id="resiSTD" style="width:50px;" /></div>
					</td>
					<td>
						<input type="text" class="stdnumber" id="resiPhone_Number" name="resiPhone_Number" value="<? echo $Landline; ?>" maxlength="8" size="10"/>
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td><span class="style2"> Post-paid mobile number: </span></td>
        <td>
			<table cellpadding="2" cellspacing="2">
				<tr>
					<td>
						+91<input type="text" class="stdnumber" id="postpaid_mobile" name="postpaid_mobile" value="<? echo $Landline; ?>" maxlength="10" size="15"/>
					</td>
				</tr>
			</table>
		</td>
		<td><span class="style2"> </span></td>
		<td><span class="style21"></span></td>
	</tr>
	<tr>
		<td colspan="4" align="center" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold; height:25px;">Professional details</td>
	</tr>
	<tr>
		<td><span class="style2"> Occupation: </span></td>
		<td><span class="style21">
			<select name="Employment_Status" id="Employment_Status" >
				<option value="-1">Please Select</option>
				<option value="1" <? if($ccrow["Employment_Status"]==1) {echo "Selected";}?>>Salaried</option>
				<option value="0" <? if($ccrow["Employment_Status"]==0) {echo "Selected";}?>>Self Employment</option>
			</select></span>
			<div id="empVal"  class="alert_msg">
				<?php if($ccrow["Employment_Status"]!=1 && $ccrow["Employment_Status"]!=0) { echo "Select Employment Status"; } ?>
			</div>
		</td>
		<td><span class="style2"> Company Name: </span></td>
		<td><span class="style21">
			<input name="Company_Name" id="Company_Name" type="text" class="d4l-input" onkeyup="ajax_showOptions(this,'getCountriesByLetters',event)"   style="width:200px;" maxlength="30" value="<? echo $CompanyName; ?>" /></span>
			<div id="compVal"  class="alert_msg">
				<?php if($ccrow["Employment_Status"] == 1 && $CompanyName == '') { echo "Enter your company name"; } ?>
			</div>
		</td>
	</tr>   
	<tr>
		<td><span class="style2">Total Experience: </span></td>
		<td>
			<input name="total_exp" id="total_exp" type="text" class="annual-income-ui-input pancard-icon float-left" placeholder="Total Experience (in Years)" onkeydown="validateDiv('resiaddressVal');" maxlength="4" value="<?php echo intval($ccrow["Total_Experience"]); ?>" />
			<div id="totalexpVal"  class="alert_msg">
				<?php if($ccrow["Employment_Status"] == 1 && intval($ccrow["Total_Experience"])==0) { echo "Enter your total experience"; } ?>		
			</div>
		</td>
		<td><span class="style2"> Annual Income: </span></td>
        <td><span class="style21"><input type="text"  name="Net_Salary" id="Net_Salary" value="<? echo $ccrow["Net_Salary"]; ?>"/></span>
			<div id="compVal"  class="alert_msg">
				<?php if(intval($ccrow["Net_Salary"]) == 0 || strlen(intval($ccrow["Net_Salary"])) > 7 ) { echo "Salary should be between 1-7 characters"; } ?>
			</div>
        </td>
	</tr>
	<tr>
		<td><span class="style2">Bank Relationship</span></td>
		<td><span class="style21">
			<select name="ICICIBankRelationship" id="ICICIBankRelationship" class="mobile-ui-input pancard-icon input-bottom-margin" onchange="validateDiv('ICICIBankRelationshipVal');">
			  <option value="">Any Relation with ICICI Bank</option>
			  <option value="Salary" <?php if($relation_with_bank=="Salary") { echo "selected"; } ?> >Salary Account</option>
			  <option value="Saving" <?php if($relation_with_bank=="Saving") { echo "selected"; } ?>>Saving Account</option>
			  <option value="Loan"  <?php if($relation_with_bank=="Loan") { echo "selected"; } ?>>Loan Running</option>
			  <option value="Norelationship"  <?php if($relation_with_bank=="Norelationship") { echo "selected"; } ?> >Norelationship</option>
			</select></span>
			<div id="bankrelationVal"  class="alert_msg">
			  <?php if($relation_with_bank == '') { echo "Select Relationship with bank"; } ?>
			</div>
		</td> 
		<td><strong>Salary Account Opened</strong></td>
		<td>
			<select name="SalaryAccountOpened" id="SalaryAccountOpened" class="mobile-ui-input pancard-icon input-bottom-margin" onchange="validateDiv('DesignationVal');">
				<option value="">Duration of Salary Account Opened</option>
				<option value="1" <?php if($SalaryAccountOpened=="1") { echo "selected"; } ?> >Above 2 months</option>
				<option value="2" <?php if($SalaryAccountOpened=="2") { echo "selected"; } ?> >Below 2 months</option>
			</select>
			<div id="salaryaccountopenVal"  class="alert_msg">
			  <?php if($relation_with_bank == 'Salary' && $SalaryAccountOpened == 0) { echo "Select Relationship with bank"; } ?>
			</div>
		</td>
	</tr>
	<tr>
		<td><span class="style2">Bank Relationship Number</span></td>
		<td><span class="style21"><input type="text"  name="bank_relationship_number" id="bank_relationship_number" value="<? echo $bank_relationship_number; ?>" maxlength="16"/></span>
			<div id="bankrelationshipnumberVal"  class="alert_msg">
				<?php 
				if(($relation_with_bank == 'Salary'|| $relation_with_bank == 'Saving') && ($bank_relationship_number == '' || (strlen($bank_relationship_number) < 12) || (strlen($bank_relationship_number) > 16))){ 	echo "Bank Relationship Number should be in between 12-16 characters";
				}
				?>
			</div>
        </td>
        <td><span class="style2"> </span></td>
		<td><span class="style21"></span></td>
	</tr>
	<tr>
		<td colspan="4" align="center" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold; height:25px;">Feedback details</td>
	</tr>
    <tr>
        <td><span class="style2">LMS Comments: </span></td>
        <td><span class="style21"><textarea rows="2" cols="15" name="comment_section"><? echo $ccrowfb["comment_section"]; ?></textarea></span></td>
        <td><span class="style2">LMS feedback </span></td>
        <td><span class="style21">
			<select name="ccfeedback" id="ccfeedback">
				<option value="" <?if($Feedback == "") { echo "selected"; }?>>No Feedback</option>
				<option value="Other Product" <?if($Feedback == "Other Product") { echo "selected"; }?>>Other Product</option>
				<option value="Not Interested" <?if($Feedback == "Not Interested") { echo "selected"; }?>>Not Interested</option>
				<option value="Callback Later" <?if($Feedback == "Callback Later") { echo "selected"; }?>>Callback Later</option>
				<option value="Wrong Number" <?if($Feedback == "Wrong Number") { echo "selected"; }?>>Wrong Number</option>
				<option value="Send Now" <?if($Feedback == "Send Now") { echo "selected"; }?>>Send Now</option>
				<option value="Not Eligible" <?if($Feedback == "Not Eligible") { echo "selected"; }?>>Not Eligible</option>
				<option value="Duplicate" <?if($Feedback == "Duplicate") { echo "selected"; }?>>Duplicate</option>
				<option value="Not Contactable" <?if($Feedback == "Not Contactable") { echo "selected"; }?>>Not Contactable</option>
				<option value="Ringing" <?if($Feedback == "Ringing") { echo "selected"; }?>>Ringing</option>
				<option value="FollowUp" <?if($Feedback == "FollowUp") { echo "selected"; }?>>FollowUp</option>
				<option value="Not Applied" <?if($Feedback == "Not Applied") { echo "selected"; }?>>Not Applied</option>
				<option value="Process" <?if($Feedback == "Process") { echo "selected"; }?>>Cibil ok</option>
				<option value="Closed" <?if($Feedback == "Closed") { echo "selected"; }?>>Cibil Reject</option>
			</select></span>
		</td>
	</tr>	
	<tr>
		<td class="fontstyle"><b>Follow Up Date</b></td>
		<td class="fontstyle"><input type="Text"  name="FollowupDate" id="FollowupDate" maxlength="25" size="15" <?php if($followup_date !='0000-00-00 00:00:00') { ?>value="<?php  echo $followup_date; ?>" <?php } ?> /><a href="javascript:NewCal('FollowupDate','yyyymmdd',true,24)"><img src="images/cal.gif" width="16" height="16" border="0" alt="Pick a date" /></a></td>
	    <td width="180"><span class="style2">Date of entry: </span></td>
        <td width="392"><span class="style21"><? echo $ccrow["Updated_Date"]; ?></span></td>
	</tr>
	<?php //dcb_cards_pincode
	$getDCBSql="select id from dcb_cards_pincode where (city like '%".$City."%' and pincode='".$ccrow["Pincode"]."')";
	$getDCBQuery = ExecQuery($getDCBSql);
	$getDCBNumRows = mysql_num_rows($getDCBQuery);
	if($getDCBNumRows>0)
	{
	?>
	<tr>
		<td colspan="4" align="left">&nbsp;</td>
		</tr>
	<?php } ?>
	<tr>
		<td colspan="8">
			<span class="firstLabel">
				<?php 
				if($submitApiStatus == 1){
				?>
				<input type="checkbox" id="hitApi" name="hitApi" value="checked"><b>Check this to Submit to ICICI</b></input>
				<?php 
				}
				else{
				?>
				<label class="alert_msg" style="font-size:14px;">ICICI Criteria Fields Missing</label>
				<?php
				}
				?>
			</span>
			<span class="secondLabel">
				<input type="Submit" name="Submit" value="Submit">
			</span>
		</td>
	</tr>
</table>
</form>
</td></tr>
</table>

<tr><td colspan="4">
	<table style='border:1px dotted #9C9A9C;' cellspacing="0" cellpadding="5" width="700" height="20%" align="center" border="1" >
		<tr>
			<td>
				<?php 
				if(isset($ApplicationId)){
				?>
				ApplicationId : <? echo $ApplicationId; ?> 
				<?php
				}
				if(isset($Decision) && !empty($Decision)){
				?>
				<br>
				Decision : <? echo $Decision; ?>
				<?php
				}
				if(isset($ErrorMessage) && !empty($ErrorMessage)){
				?>
				<br>
				ErrorMessage : <? echo $ErrorMessage; ?>
				<?php
				}
				if(isset($Reason) && !empty($Reason)){
				?>
				<br>
				Reason : <? echo $Reason; ?>
				<?php
				}
				?>
			</td>
		</tr>
	</table>
</td><tr>
</body>
</html>
<?php
function GetCityStatecCode($pKey){
    $titles = array(
	'AHMEDABAD' => 'GUJ',
	'AURANGABAD' => 'MAH',
	'BANGALORE' => 'KTK',
	'BARODA' => 'GUJ',
	'BHOPAL' => 'MAD',
	'BHUBANESHWAR' => 'ORI',
	'CALCUTTA' => 'WGB',
	'CHANDIGARH' => 'CHD',
	'CHENNAI' => 'TMN',
	'COIMBATORE' => 'KTK',
	'FARIDABAD' => 'HAR',
	'GHAZIABAD' => 'UP',
	'GURGAON' => 'HAR',
	'HYDERABAD' => 'APR',
	'INDORE' => 'MAD',
	'JAIPUR' => 'RAJ',
	'JALANDHAR' => 'PUN',
	'JAMNAGAR' => 'MAD',
	'LUCKNOW' => 'UP',
	'LUDHIANA' => 'PUN',
	'MUMBAI' => 'MAH',
	'NAGPUR' => 'MAH',
	'NASIK' => 'MAD',
	'NEW DELHI' => 'DEL',
	'NOIDA' => 'UP',
	'PATNA' => 'BIH',
	'PUNE' => 'MAH',
	'RAJKOT' => 'MAD',
	'SURAT' => 'GUJ',
	'TIRUPUR' => 'TMN',
	'TRIVANDRUM' => 'KER'
);
    foreach ($titles as $key=>$value)
        if($pKey==$key)
        return $value;
    return "";
  }
?>
<?php
function GetStateName($pKey){
    $titles = array(
	'Mumbai'=>'MAHARASHTRA',
	'Thane'=>'MAHARASHTRA',
	'Navi Mumbai'=>'MAHARASHTRA',
	'New Delhi'=>'DELHI',
	'Delhi'=>'DELHI',
	'Noida'=>'UTTAR PRADESH',
	'Gurgaon'=>'HARYANA',
	'Gaziabad'=>'UTTAR PRADESH',
	'Faridabad'=>'HARYANA',
	'Pune'=>'MAHARASHTRA',
	'Chennai'=>'TAMIL NADU',
	'Hyderabad'=>'ANDHRA PRADESH',
	'Bangalore'=>'KARNATAKA',
	'Kolkata'=>'WEST BENGAL',
	'Ahmedabad'=>'GUJARAT',
	'Jaipur'=>'RAJASTHAN',
	'Chandigarh'=>'PUNJAB'
	   	);
    foreach ($titles as $key=>$value)
        if($pKey==$key)
        return $value;
    return "";
  }

function GetStdCode($pKey){
    $titles = array(
	'Mumbai'=>'724',
	'Thane'=>'22',
	'Navi Mumbai'=>'22',
	'New Delhi'=>'11',
	'Delhi'=>'11',
	'Noida'=>'120',
	'Gurgaon'=>'124',
	'Gaziabad'=>'120',
	'Faridabad'=>'129',
	'Pune'=>'724',
	'Chennai'=>'44',
	'Hyderabad'=>'40',
	'Bangalore'=>'80',
	'Kolkata'=>'33',
	'Ahmedabad'=>'79',
	'Jaipur'=>'141',
	'Chandigarh'=>'172'
		   	);
    foreach ($titles as $key=>$value)
        if($pKey==$key)
        return $value;
    return "";
  }
?>
