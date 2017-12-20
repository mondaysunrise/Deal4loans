<?php
 $ReqID = $_REQUEST["postid"];
 $BidID = $_REQUEST["biddt"];


$requestid = $_REQUEST["postid"];
//$requestid = '945612';
$bidderid = $_REQUEST["biddt"];
//$bidderid = '6705';
//require 'scripts/session_check_online.php';
require 'scripts/db_init.php';
require 'scripts/functions.php';
require 'webservices_functions.php';
//error_reporting(E_ALL);
//ini_set('display_errors', 1);

function ccMasking($number, $maskingCharacter = 'X') 
{
	return substr($number, 0, 2) . str_repeat($maskingCharacter, strlen($number) - 4) . substr($number, -2);
}

$updateqry= "Update lead_allocate set BidderID='".$BidID."' Where AllRequestID = '".$ReqID."' and BidderID=6847";
$updateqryresult = ExecQuery($updateqry);

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
	//echo '<pre>';print_r($_POST);exit;
	foreach($_POST as $a=>$b)
		$$a=$b;
	$RequestID = FixString($RequestID);
	$first_name = FixString($first_name);
	$middle_name = FixString($middle_name);
	$last_name = FixString($last_name);
	$Email = FixString($Email);
	$Mobile_Number = FixString($Mobile_Number);
	$Gender = FixString($Gender);
	$panno = FixString($panno);
	$Qualification = FixString($Qualification);
	$relation_with_bank = FixString($relation_with_bank);
	$IncomeProof = FixString($IncomeProof);
	$IncomeProofValue = FixString($IncomeProofValue);
	$Residence_Address1 = $_POST["Residence_Address1"];
	$Residence_Address1 = str_ireplace('|','',$Residence_Address1);
	$City = FixString($City);
	$ResiPin = FixString($ResiPin);
	$EmpType = FixString($EmpType);
	$CompanyName = FixString($Company_Name);
	$Designation = FixString($Designation);	
	$Net_Salary = FixString($Net_Salary);
	$comment_section = FixString($comment_section);
	$ccfeedback = FixString($ccfeedback);
	$FollowupDate  = FixString($FollowupDate);
	$card_name = FixString($card_name);

	if(strlen($middle_name)>0 && $middle_name!="Middle Name" && $last_name==""){
		$last_name= $middle_name;
		$middle_name="";
	}else{
		if($last_name==""){
			$last_name= "Kumar";
		}
	}
		
	if($middle_name=="Middle Name"){
		$middle_name="";
	}
	$Name=$first_name." ".$middle_name." ".$last_name;
	
	$day = $_POST["day"];
	if(strlen($day)==1){
		$dd="0".$day;
	}else{
		$dd=$day;
	}
	$month = $_POST["month"];
	if(strlen($month)==1){
		$mm="0".$month;
	}else{
		$mm=$month;
	}
	$year = $_POST["year"];
	$DOB = $year."-".$mm."-".$dd;
	$Dated=ExactServerdate();


	//Update Lead Details
	if($requestid>0){
		$InsertProductDataArray= array("Name"=>$Name, "Email" => $Email, "Gender" => $Gender, "Employment_Status" => $EmpType, "Company_Name" => $CompanyName, "City" => $City, "Net_Salary" => $Net_Salary, "Pincode" => $ResiPin, "DOB" => $DOB, "Pancard" => $panno, "applied_card_name" =>$card_name, "Residence_Address" => $Residence_Address1, "Dated" => $Dated);
		$whereproductcondition ="(RequestID='".$requestid."')";
		Mainupdatefunc("Req_Credit_Card", $InsertProductDataArray, $whereproductcondition);
	}


	//Check Feedback Details
	$feedbackDetailsRes = ExecQuery("SELECT * FROM Req_Feedback_CC WHERE AllRequestID='".$requestid."' AND BidderID='".$bidderid."'");
	$feedbackData=mysql_fetch_array($feedbackDetailsRes);
	if(count($feedbackData)){
		//Update Feedback Details
		$ccfeedbackqry="UPDATE Req_Feedback_CC SET Feedback='".$ccfeedback."',Followup_Date='".$FollowupDate."',comment_section='".$comment_section."' WHERE AllRequestID='".$requestid."' AND BidderID='".$bidderid."'";
	}
	else{
		//Insert Feedback Details
		$ccfeedbackqry="INSERT INTO Req_Feedback_CC SET Feedback='".$ccfeedback."',Followup_Date='".$FollowupDate."',comment_section='".$comment_section."'";
	}
	//echo $ccfeedbackqry;exit;
	$ccfeedbackres=ExecQuery($ccfeedbackqry);


	//Check credit_card_banks_apply(ccba) entry
	$getccbadetailsquery="SELECT * FROM credit_card_banks_apply WHERE cc_requestid='".$requestid."' AND applied_bankname= 'Standard Chartered'";
	list($alreadyExist,$getccbadetails)=Mainselectfunc($getccbadetailsquery,$array = array());
	$ccbaid=$getccbadetails['id'];
	//echo '<pre>';echo $alreadyExist; print_r($getccbadetails);exit;
	if($alreadyExist>0){
		$InsertCCBADataArray = array("qualification" => $Qualification , "designation" => $Designation, "relation_with_bank"=>$relation_with_bank);
		$whereccbacondition = "(id='".$ccbaid."')";
		Mainupdatefunc('credit_card_banks_apply', $InsertCCBADataArray, $whereccbacondition);
		$ccbaID = $ccbaid;
	}
	else{
		$InsertCCBADataArray= array("cc_requestid" => $requestid, "qualification" => $Qualification , "designation" => $Designation, "relation_with_bank"=>$relation_with_bank, "applied_bankname"=> "Standard Chartered");
		$ccbaID = Maininsertfunc("credit_card_banks_apply", $InsertCCBADataArray);
	}


	//Code to send data to API
	if(isset($_POST['hitApi']) && ($_POST['hitApi'] == 'checked')){
		$card_id = $_POST["card_id"];
		$getCardSql = " SELECT * FROM `credit_card_banks_eligibility` WHERE cc_bankid='".$card_id."' and `cc_bank_flag`=1";
		list($numRowscard,$getCardData)=MainselectfuncNew($getCardSql,$array = array());
		$card_type = '';
		if($card_id==13){
			$card_type=13;
		}elseif($card_id==19){
			$card_type=9;
		} elseif($card_id==21){
			$card_type=10;
		} elseif($card_id==67){
			$card_type=7;
		}
		
		$gender = '1';
		if($Gender == "Male"){
			$gender="1";
		}else{
			$gender="2";
		}
		$Residence_Address = substr(trim($Residence_Address1),0,38);
		$citycode=GetCityCode($City);
		$dobstr= $dd."-".$mm."-".$year;
		$AnnIncome = intval($Net_Salary);
		$monthlyincome = round($AnnIncome/12);
		$CompanyName = substr(trim($CompanyName),0,99);
		
		$noofbanksresult = ExecQuery("SELECT No_of_Banks FROM Req_Credit_Card WHERE (RequestID=".$requestid.")");
		$noofbanksdata = mysql_fetch_array($noofbanksresult);
		$No_of_Banks = $noofbanksdata["No_of_Banks"];
		
		if($No_of_Banks == "Standard Chartered"){
			$HasExistingScbCC="Y";
		}else{
			$HasExistingScbCC="N";
		}
		
		if($relation_with_bank>0){
			$IsExtngScbCust="Y";
		} else{
			$IsExtngScbCust="N";
		}

		if(strlen($first_name)>1 && strlen($CompanyName)>2 && $Mobile_Number>0 && strlen($Email)>2 && $AnnIncome>0){
			
			$dataArr = array();
			$dataArr['RequestID'] = $requestid;
			$dataArr['CreditCardApplied'] = $card_type;
			$dataArr['HasExistingScbCC'] = $HasExistingScbCC;
			$dataArr['IsExtngScbCust'] = $IsExtngScbCust;
			$dataArr['CustReltnType'] = $relation_with_bank;
			$dataArr['FirstName'] = $first_name;
			$dataArr['MiddleName'] = $middle_name;
			$dataArr['LastName'] = $last_name;
			$dataArr['Gender'] = $gender;
			$dataArr['DOB'] = $dobstr;
			$dataArr['Qualification'] = $Qualification;
			$dataArr['ResAddress1'] = $Residence_Address;
			$dataArr['ResAddress2'] = $City;
			$dataArr['ResCity'] = $citycode;
			$dataArr['ResPIN'] = $ResiPin;
			$dataArr['Email'] = $Email;
			$dataArr['Mobile'] = $Mobile_Number;
			$dataArr['EmpType'] = $EmpType;
			$dataArr['AnnIncome'] = $AnnIncome;
			$dataArr['GMI'] = $monthlyincome;
			$dataArr['CompanyName'] = $CompanyName;
			$dataArr['Designation'] = $Designation;
			$dataArr['IncomeProof'] = $IncomeProof;
			$dataArr['IncomeProofValue'] = $AnnIncome;
			$dataArr['PAN'] = $panno;

			SCBWebservice($dataArr, $ccbaID);

		}
	}

}



// To show details prefilled
$ccdetails = "SELECT Gender, Landline, Std_Code, Account_No, Pancard, Employment_Status, CC_Holder, Dated, DOB, Name, Email, Company_Name, City, Mobile_Number, Net_Salary, Loan_Amount, Pincode, IP_Address, Add_Comment, Residence_Address, applied_card_name, Office_Address, No_of_Banks, Updated_Date FROM Req_Credit_Card WHERE (RequestID=".$requestid.")";
$ccdetailsresult = ExecQuery($ccdetails);
$ccrow = mysql_fetch_array($ccdetailsresult);
$Gender = $ccrow["Gender"];
$Email = $ccrow["Email"];
//$Landline = $ccrow["Landline"];
//$Std_Code = $ccrow["Std_Code"];
$Pancard = $ccrow["Pancard"];
$Employment_Status = $ccrow["Employment_Status"];
//$CC_Holder = $ccrow["CC_Holder"];
//$No_of_Banks = $ccrow["No_of_Banks"];
//$Dated = $ccrow["Dated"];
$Company_Name = $ccrow["Company_Name"];
$City = $ccrow["City"];
$Mobile_Number = $ccrow["Mobile_Number"];
$Net_Salary = $ccrow["Net_Salary"];
//$Loan_Amount = $ccrow["Loan_Amount"];
$Pincode = $ccrow["Pincode"];
//$IP_Address = $ccrow["IP_Address"];
//$Add_Comment = $ccrow["Add_Comment"];
$Updated_Date = $ccrow["Updated_Date"];
$applied_card_name = $ccrow["applied_card_name"];
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
if(strlen($middle_name)>0 && $middle_name!="Middle Name" && $last_name==""){
	$last_name= $middle_name;
	$middle_name="";
}else{
	if($last_name==""){
		$last_name= "Kumar";
	}
}
if($middle_name=="Middle Name"){
	$middle_name="";
}

//Get Details From credit_card_banks_apply
$cc_alldetails = ExecQuery("SELECT * FROM credit_card_banks_apply WHERE cc_requestid='".$requestid."'");
$ccrowal=mysql_fetch_array($cc_alldetails);
$qualification = $ccrowal["qualification"];
$designation = $ccrowal["designation"];
$relation_with_bank = $ccrowal["relation_with_bank"];



//Get Details From Req_Credit_Card_Sms
$ccfb_alldetails = ExecQuery("SELECT * FROM Req_Feedback_CC WHERE AllRequestID='".$requestid."' AND BidderID='".$bidderid."'");
$ccrowfb=mysql_fetch_array($ccfb_alldetails);
$Feedback= isset($ccrowfb["Feedback"]) ? $ccrowfb["Feedback"] : '';
$followup_date= isset($ccrowfb["Followup_Date"]) ? $ccrowfb["Followup_Date"] : '';
$comment_section= isset($ccrowfb["comment_section"]) ? $ccrowfb["comment_section"] : '';

if((strlen($first_name)<3 || strlen($first_name)>32) ||
(strlen($last_name)<3 || strlen($last_name)>32) ||
(filter_var($Email, FILTER_VALIDATE_EMAIL) === false) ||
(($dd<1 || $dd>31) && ($mm<1 || $mm>12) && ($year<$minage || $year>$maxage)) ||
($Gender!='Male' && $Gender!='Female' ) ||
(strlen($Pancard)!=10) ||
($qualification =='') ||
($relation_with_bank =='') ||
((strlen(strpos(trim($applied_card_name), 'Standard Chartered'))) == 0) ||
(strlen($Residence_Address)<4 || strlen($Residence_Address)>39) ||
(strlen($City) == '') ||
(strlen($Pincode)!=6) ||
($ccrow["Employment_Status"]!=1 && $ccrow["Employment_Status"]!=2 && $ccrow["Employment_Status"]!=3) ||
(strlen($Company_Name) < 2 || strlen($Company_Name) > 100) ||
($designation == ''))
{
	$submitApiStatus = 0;
} else {
	$submitApiStatus = 1;
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Credit Card</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="js/jquery-2.2.js"></script>
<!--<script type="text/javascript" src="js/jquery.validate.js"></script>-->
<script language="javascript" type="text/javascript" src="scripts/datetime.js"></script>
<script language="javascript" type="text/javascript" src="scripts/common.js"></script>
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
    margin-right: 100px;
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

function changeincomeProof(){
	$('#IncomeProof').html('');
	if($('#EmpType').val()==1){
		$('#IncomeProof').append('<option value="1">Payslip (Recommended Document)</option>');
		$('#IncomeProof').append('<option value="5">Savings account bank statement with ITR</option>');
		$('#IncomeProof').append('<option value="8">Salary credit in SCB salary account</option>');
		$('#IncomeProof').append('<option value="10">Life Insurance Premium Reciepts</option>');
		$('#IncomeProof').append('<option value="15">Other Bank Credit card statement</option>');
		$('#IncomeProof').append('<option value="21">Housing Loan with SCB</option>');
		$('#IncomeProof').append('<option value="23">Savings account with SCB</option>');
		$('#IncomeProof').append('<option value="24">Emirates Frequent Flyer</option>');
	}else if($('#EmpType').val()==2){
		$('#IncomeProof').append('<option value="2">Current account statement with ITR</option>');
		$('#IncomeProof').append('<option value="10">Life Insurance Premium Reciepts</option>');
		$('#IncomeProof').append('<option value="15">Other Bank Credit card statement</option>');
		$('#IncomeProof').append('<option value="21">Housing Loan with SCB</option>');
		$('#IncomeProof').append('<option value="24">Emirates Frequent Flyer</option>');
	}
	else{
		$('#IncomeProof').append('<option value="2">Current account statement with ITR</option>');
		$('#IncomeProof').append('<option value="10">Life Insurance Premium Reciepts</option>');
		$('#IncomeProof').append('<option value="15">Other Bank Credit card statement</option>');
		$('#IncomeProof').append('<option value="16">Self employed doctors with degree certification</option>');
		$('#IncomeProof').append('<option value="18">Professional Certificate (Company Secretary / Chartered accountant / Architect)</option>');
		$('#IncomeProof').append('<option value="21">Housing Loan with SCB</option>');
		$('#IncomeProof').append('<option value="24">Emirates Frequent Flyer</option>');
	}
}

// Form validation code will come here.
function validate_loan_form(){
	
	var first_name = $("#first_name").val();
	var middle_name = $("#first_name").val();
	var last_name = $("#last_name").val();
	var Email = $("#Email").val();
	
	$(".validation").remove();

	if( first_name == "" ){
		$("#first_name").parent().after("<div class='validation' style='color:red;font-size:15px;'>Please enter first name</div>");
		$("#first_name").focus() ;
		return false;
	}
	else if (first_name.length < 3 || first_name.length > 32) {
		$("#first_name").parent().after("<div class='validation' style='color:red;font-size:15px;'>Please enter first name between 3 to 32 chars</div>");
		$("#first_name").focus() ;
		return false;
	}

	if( last_name == "" ){
		$("#last_name").parent().after("<div class='validation' style='color:red;font-size:15px;'>Please enter last name</div>");
		$("#last_name").focus() ;
		return false;
	}
	else if (last_name.length < 3 || last_name.length > 32) {
		$("#first_name").parent().after("<div class='validation' style='color:red;font-size:15px;'>Please enter first name between 3 to 32 chars</div>");
		$("#first_name").focus() ;
		return false;
	}
	
	if( Email == "" ){
		$("#Email").parent().after("<div class='validation' style='color:red;font-size:15px;'>Please enter Email</div>");
		$("#Email").focus() ;
		return false;
	}
	
	if( Gender == "" ){
		$("#Gender").parent().after("<div class='validation' style='color:red;font-size:15px;'>Please enter Gender</div>");
		$("#Gender").focus() ;
		return false;
	}
	
	return true;
}

function checkValue(sender){
	//alert(sender.id);
	//alert(sender.value);

	$(".validation").remove();

	if(sender.id == 'first_name'){
		var first_name = sender.value;
		if (first_name.length < 3 || first_name.length > 32) {
			$("#first_name").parent().after("<div class='validation' style='color:red;font-size:15px;'>Please enter first name between 3 to 32 chars</div>");
			$("#first_name").focus() ;
			return false;
		}
	}
	if(sender.id == 'middle_name'){
		var middle_name = sender.value;
		if (middle_name.length < 3 || middle_name.length > 32) {
			$("#middle_name").parent().after("<div class='validation' style='color:red;font-size:15px;'>Please enter middle name between 3 to 32 chars</div>");
			$("#middle_name").focus() ;
			return false;
		}
	}
	if(sender.id == 'last_name'){
		var last_name = sender.value;
		if (last_name.length > 32) {
			$("#last_name").parent().after("<div class='validation' style='color:red;font-size:15px;'>Please enter last name less than 32 chars</div>");
			$("#last_name").focus() ;
			return false;
		}
	}
	
	if(sender.id == 'Email'){
		var email = sender.value;
		var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
		if(!email.match(mailformat))  
		{  
			$("#Email").parent().after("<div class='validation' style='color:red;font-size:15px;'>Please enter valid email id</div>");
			$("#Email").focus() ;
			return false; 
		}
	}
	
	if(sender.id == 'panno'){
		var panVal = sender.value;
		var regpan = /^[a-zA-Z]{5}\d{4}[a-zA-Z]{1}$/;
		if(!regpan.test(panVal)){
			$("#panno").parent().after("<div class='validation' style='color:red;font-size:15px;'>Please enter valid Pan No</div>");
			$("#panno").focus() ;
			return false; 
		}
	}
	
	if(sender.id == 'Residence_Address1'){
		var address1 = sender.value;
		if (address1.length < 4 || address1.length > 39) {
			$("#Residence_Address1").parent().after("<div class='validation' style='color:red;font-size:15px;'>Please enter address 1 between 4 to 39 chars</div>");
			$("#Residence_Address1").focus() ;
			return false;
		}
	}

	if(sender.id == 'Company_Name'){
		var company_name = sender.value;
		if (company_name.length > 100) {
			$("#Company_Name").parent().after("<div class='validation' style='color:red;font-size:15px;'>Please enter company name 2 less than 100 chars</div>");
			$("#Company_Name").focus() ;
			return false;
		}
	}
	return true;

}


function showUser(str) {
    if (str == "") {
        document.getElementById("txtHint").innerHTML = "";
        return;
    } else { 
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("txtHint").innerHTML = xmlhttp.responseText;
            }
        };
        xmlhttp.open("GET","getcity-value.php?q="+str,true);
        xmlhttp.send();
    }
}

function showResiUser(str) {
    if (str == "") {
        document.getElementById("txtResiHint").innerHTML = "";
        return;
    } else { 
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("txtResiHint").innerHTML = xmlhttp.responseText;
            }
        };
        xmlhttp.open("GET","getcity-resivalue.php?q="+str,true);
        xmlhttp.send();
    }
}

function showPinCode(str) {
   // alert('ddd');
	if (str == "") {
         document.getElementById("txtHint2").innerHTML = "";
        return;
    } else { 
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("txtHint2").innerHTML = xmlhttp.responseText;
            }
        };
        xmlhttp.open("GET","get-stdcode.php?q="+str,true);
        xmlhttp.send();
    }
}

function showResiPinCode(str) {
   // alert('ddd');
	if (str == "") {
         document.getElementById("resiSTD").value = "";
        return;
    } else { 
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("resiSTD").value = xmlhttp.responseText;
            }
        };
        xmlhttp.open("GET","get-resistdcode.php?q="+str,true);
        xmlhttp.send();
    }
}
</script>
</head>
<body>
<table cellpadding="0" cellspacing="0" align="center">
<tr><td>
<form name="loan_form" method="post" action="<? echo $_SERVER['PHP_SELF'] ?>?postid=<?echo $requestid;?>&biddt=<? echo $bidderid;?>" >
<input type="hidden" name="biddtnw" value="<? echo $bidderid;?>">
<input type="hidden" name="RequestID" value="<? echo $requestid;?>">
<input type="hidden" name="Mobile_Number" value="<? echo $Mobile_Number;?>">
<table style='border:1px dotted #9C9A9C;' cellspacing="0" cellpadding="5" width="700" height="80%" align="center" border="1" >
<tr>
	<td colspan="4" align="center" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold; height:25px;">Credit Card customer details
	<br />
	<?php 
	if($submitApiStatus == 1){
	?>
	<div class="alert_msg" style="font-size:16px;">Submit the SCB Service by checking SCB Webservice Run and then SUBMIT</div>
	<?php 
	}
	?>
	</td>
</tr>
<tr>
	<td width="180"><span class="style2">Customer Name: </span></td>
    <td width="392" colspan="3">
		<span class="style21">
			<input type="text" maxlength="32" size="13" name="first_name" id="first_name" value="<? echo $first_name; ?>" onkeyup="checkValue(this);"/>&nbsp;
			<input type="text" maxlength="32" size="11" name="middle_name" id="middle_name" value="<? echo $middle_name; ?>" onkeyup="checkValue(this);"  />&nbsp;
			<input type="text" maxlength="32" size="17" name="last_name" id="last_name" value="<? echo $last_name; ?>" onkeyup="checkValue(this);" />
		</span>
		<div id="fnameVal"  class="alert_msg">
			<?php if(strlen($first_name)<3 || strlen($first_name)>32){ echo "FirstName - Min : 3, Max : 32 Characters";}?>
			<?php if(strlen($last_name)<3 || strlen($last_name)>32){ echo "LastName - Min : 3, Max : 32 Characters"; }?>
		</div>
	</td>
</tr>
<tr>
	<td><span class="style2"> Mobile No: </span></td>
	<td><span class="style21"><? echo ccMasking($Mobile_Number); ?></span></td>
	<td><span class="style2"> Email: </span></td>
	<td><span class="style21">
		<input type="text" value="<? echo $Email; ?>" name="Email" id="Email" onkeyup="checkValue(this);" /></span>
		<div id="emailVal"  class="alert_msg">
			<?php 
			if (filter_var($Email, FILTER_VALIDATE_EMAIL) === false) {
				echo "Email should be like - abc@xyx.com";
			}
			?>
		</div>
	</td>
</tr>
<tr>
	<td><span class="style2"> DOB: </span></td>
	<td><span class="style21">
		<?php echo listbox_date('day',$dd);?>
		<?php echo listbox_month('month', $mm);?>
		<?php $minage= Date('Y')-18; $maxage=Date('Y')-62; echo listbox_year('year',$maxage,$minage, $year);?>
		<div id="emailVal"  class="alert_msg">
			<?php
			if(($dd<1 || $dd>31) && ($mm<1 || $mm>12) && ($year<$minage || $year>$maxage)){
				echo "Select valid DOB";
			}
			?>
		</div>
		</span>
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
    <td>
		<input type="text" class="d4l-input" name="panno" id="panno" value="<? echo $Pancard ;?>"  maxlength="10" onkeyup="checkValue(this);" />
		<div id="panVal"  class="alert_msg">
			<?php if(strlen($Pancard)!=10) { echo "Pancard should be like - xxxPx1234x"; } ?>
		</div>
		</td>
    <td><span class="style2">Qualification</span></td>
    <td><span class="style21">
		<select name="Qualification" id="Qualification">
			<option value="">Please Select</option>
            <option  value="9" <? if($qualification=="9") { echo "Selected"; }?> >Diploma</option>
            <option value="10" <? if($qualification=="10") { echo "Selected"; }?> >Graduate</option>
            <option value="13" <? if($qualification=="13") { echo "Selected"; }?> >Post-Graduate</option>
            <option value="15" <? if($qualification=="15") { echo "Selected"; }?> >Professional</option>
            <option value="19" <? if($qualification=="19") { echo "Selected"; }?> >Others</option>
            <option value="20" <? if($qualification=="20") { echo "Selected"; }?> >Architect</option>
            <option value="23" <? if($qualification=="23") { echo "Selected"; }?> >Lawyer</option>
            <option value="24" <? if($qualification=="24") { echo "Selected"; }?> >CA</option>
            <option value="25" <? if($qualification=="25") { echo "Selected"; }?> >Doctor</option>
            <option value="26" <? if($qualification=="26") { echo "Selected"; }?> >Engineer</option>
            <option value="27" <? if($qualification=="27") { echo "Selected"; }?> >MBA/MMS</option>
		</select></span>
		<div id="genderVal"  class="alert_msg">
			<?php if($qualification =='') { echo "Select Qualification"; } ?>
		</div>
	</td>
</tr>
<tr>
  	<td><span class="style2">Any relation with Standard Chartered Bank?</span></td>
    <td><span class="style21">
		<select name="relation_with_bank" id="relation_with_bank">
			<option value="">Please Select</option>
			<option value="0" <? if($relation_with_bank=="0") { echo "Selected"; }?> >No Relation</option>
            <option value="2" <? if($relation_with_bank=="2") { echo "Selected"; }?> >Savings Account</option>
            <option value="5" <? if($relation_with_bank=="5") { echo "Selected"; }?> >Current Account (Personal)</option>
            <option value="11" <? if($relation_with_bank=="11") { echo "Selected"; }?> >Current Account (Business)</option>
            <option value="13" <? if($relation_with_bank=="13") { echo "Selected"; }?> >Term Deposit</option>
            <option value="14" <? if($relation_with_bank=="14") { echo "Selected"; }?> >Credit Card</option>
            <option value="18" <? if($relation_with_bank=="18") { echo "Selected"; }?> >Personal Loan</option>
            <option value="20" <? if($relation_with_bank=="20") { echo "Selected"; }?> >Home Loan</option>
            <option value="26" <? if($relation_with_bank=="26") { echo "Selected"; }?> >Business Loan</option>
		</select></span>
		<div id="bankrelationVal"  class="alert_msg">
			<?php if($relation_with_bank =='') { echo "Select Relationship"; } ?>
		</div>
	</td>
	<td><span class="style2">Select Your Card</span></td>
    <td><span class="style21">
		<select name="card_id" id="card_id">
			<option value="">Select Your Card</option>
            <?php 
			$getCardSql = " SELECT * FROM `credit_card_banks_eligibility` WHERE `cc_bank_name` like '%standard%' and `cc_bank_flag`=1";
			list($numRowscard,$getCardData)=MainselectfuncNew($getCardSql,$array = array());
			for($i=0;$i<$numRowscard;$i++){
				$ccbankid = $getCardData[$i]['cc_bankid'];
				$cc_bank_name =ucwords(strtolower($getCardData[$i]['cc_bank_name']));
			?>
			<option value="<?php echo $ccbankid; ?>" <? if($cc_bank_name==$applied_card_name){echo "selected";}?>><?php echo $cc_bank_name; ?></option>
			<?php
			}
			?>
		</select>
		<script>
			$("#card_id").on('change', function(){
				var bank_name = $("#card_id :selected").text();
				$("#card_name").val(bank_name);
			});
		</script>
		<input type="hidden" name="card_name" id="card_name" value="<?php echo $applied_card_name;?>">
		</span>
		<div id="cardVal"  class="alert_msg">
			<?php if((strlen(strpos(trim($applied_card_name), 'Standard Chartered'))) == 0) { echo "Select Card";} ?>
		</div>
	</td>
</tr>
<tr>
	<td colspan="4" align="center" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold; height:25px;">Residence details</td>
</tr>
<tr>
	<td><span class="style2"> Resi Address1: </span></td>
	<td colspan="3"><span class="style21" >
		<input type="text" maxlength="39" size=80 name="Residence_Address1" id="Residence_Address1" value="<? echo $Residence_Address; ?>" onkeyup="checkValue(this);" /></span>
		<div id="resiVal"  class="alert_msg">
			<?php if(strlen($Residence_Address)<4 || strlen($Residence_Address)>39) { echo "Address - Min : 4, Max : 39 Characters"; } ?>
		</div>
	</td>
</tr>
<tr>
	<td><span class="style2">Residence City: </span></td>
	<td><span class="style21">
		<select size="1" name="City" id="City">
			<option value="">Please Select</option>
			<option  value="Gurgaon" <? if($City=="Gurgaon") { echo "Selected"; }?> >Gurgaon</option>
			<option  value="Chandigarh" <? if($City=="Chandigarh") { echo "Selected"; }?> >Chandigarh</option>
			<option  value="Hyderabad" <? if($City=="Hyderabad") { echo "Selected"; }?> >Hyderabad</option>
			<option  value="Bengaluru" <? if($City=="Bengaluru") { echo "Selected"; }?> >Bengaluru</option>
			<option  value="Chennai" <? if($City=="Chennai") { echo "Selected"; }?> >Chennai</option>
			<option  value="Ahmedabad" <? if($City=="Ahmedabad") { echo "Selected"; }?> >Ahmedabad </option>
			<option  value="Mumbai" <? if($City=="Mumbai") { echo "Selected"; }?> >Mumbai</option>
			<option  value="Pune" <? if($City=="Pune") { echo "Selected"; }?> >Pune</option>
			<option  value="Kolkata" <? if($City=="Kolkata") { echo "Selected"; }?> >Kolkata</option>
			<option  value="Coimbatore" <? if($City=="Coimbatore") { echo "Selected"; }?> >Coimbatore</option>
			<option  value="Noida" <? if($City=="Noida") { echo "Selected"; }?> >Noida</option>
			<option  value="Secunderabad" <? if($City=="Secunderabad") { echo "Selected"; }?> >Secunderabad</option>
			<option  value="Jaipur" <? if($City=="Jaipur") { echo "Selected"; }?> >Jaipur</option>
			<option  value="Indore" <? if($City=="Indore") { echo "Selected"; }?> >Indore</option>
			<option  value="Nagpur" <? if($City=="Nagpur") { echo "Selected"; }?> >Nagpur</option>
			<option  value="Navi Mumbai" <? if($City=="Navi Mumbai") { echo "Selected"; }?> >Navi Mumbai</option>
			<option  value="Surat" <? if($City=="Surat") { echo "Selected"; }?> >Surat</option>
			<option  value="Cochin" <? if($City=="Cochin") { echo "Selected"; }?> >Cochin</option>
			<option  value="New Delhi" <? if($City=="New Delhi") { echo "Selected"; }?> >New Delhi</option>
			<option  value="Bhopal" <? if($City=="Bhopal") { echo "Selected"; }?> >Bhopal</option>
			<option  value="Thane" <? if($City=="Thane") { echo "Selected"; }?> >Thane</option>
			<option  value="Greater Noida" <? if($City=="Greater Noida") { echo "Selected"; }?> >Greater Noida</option>
			<option  value="Baroda" <? if($City=="Baroda") { echo "Selected"; }?> >Baroda</option>
			<option  value="Rajkot" <? if($City=="Rajkot") { echo "Selected"; }?> >Rajkot</option>
		</select>
		</span>
		<div id="resiCityVal"  class="alert_msg">
			<?php if(strlen($City) == '') { echo "Select City"; } ?>
		</div>
	</td>
	<td><span class="style2"> Resi pincode: </span></td>
	<td><span class="style21">
        <input name="ResiPin" id="ResiPin" type="text" class="d4l-input" maxlength="6" value="<? echo $Pincode; ?>" onKeyPress="intOnly(this);"/>
        </span>
        <div id="ResiPinVal"  class="alert_msg">
			<?php if(strlen($Pincode)!=6) { echo "Pincode should be 6 digits"; } ?>
		</div>
	</td>
</tr>
</tr>  
<tr>
<tr>
	<td colspan="4" align="center" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold; height:25px;">Professional details</td>
</tr>
<tr>
	<td><span class="style2">Occupation: </span></td>
    <td><span class="style21">
		<select name="EmpType" id="EmpType" onchange="changeincomeProof()">
			<option value="">Please Select</option>
            <option value="1" <? if($Employment_Status==1) {echo "Selected";}?> >Salaried</option>
            <option value="2" <? if($Employment_Status==2) {echo "Selected";}?> >Self Employed Business</option>
            <option value="3" <? if($Employment_Status==3) {echo "Selected";}?> >Self Employed Professional</option>
		</select></span>
		<div id="empVal"  class="alert_msg">
			<?php if($Employment_Status!=1 && $Employment_Status!=2 && $Employment_Status!=3) { echo "Select Employment Status"; } ?>
		</div>
	</td>
	<td><span class="style2"> Company Name: </span></td>
	<td><span class="style21">
		<input name="Company_Name" id="Company_Name" type="text" class="d4l-input" onkeyup="ajax_showOptions(this,'getCountriesByLetters',event)"   style="width:200px;" maxlength="100" value="<? echo $Company_Name; ?>" onkeyup="checkValue(this);" /></span>
		<div id="compVal"  class="alert_msg">
			<?php if(strlen($Company_Name) < 2 || strlen($Company_Name) > 100) { echo "Company name - Min : 2, Max : 100 Characters"; } ?>
		</div>
	</td>
</tr>   
<tr>
	<td><span class="style2"> Designation: </span></td>
	<td><span class="style21">
		<select name="Designation" id="Designation" >
			<option value="">Select Designation</option>
			<option value="10" <? if($designation==10) {echo "Selected";}?>>Non Management</option>
			<option value="20" <? if($designation==20) {echo "Selected";}?>>Junior Management</option>
			<option value="30" <? if($designation==30) {echo "Selected";}?>>Middle Management</option>
			<option value="40" <? if($designation==40) {echo "Selected";}?>>Senior Management</option>
			<option value="50" <? if($designation==50) {echo "Selected";}?>>Other</option>
		</select></span>
		<div id="designationVal"  class="alert_msg">
			<?php if($designation == '') { echo "Enter your designation"; } ?>
		</div>
	</td>
	<td><span class="style2"> Annual Income: </span></td>
	<td><span class="style21">
		<input type="text"  name="Net_Salary" id="Net_Salary" value="<? echo $Net_Salary; ?>"/></span>
		<div id="compVal"  class="alert_msg">
			<?php if(intval($Net_Salary) == 0) { echo "Enter your Annual Income"; } ?>
		</div>
	</td>
</tr>
<tr>
  	<td><span class="style2">IncomeProof</span></td>
    <td><span class="style21">
		<select name="IncomeProof" id="IncomeProof">
			<option value="">Please Select</option>
			<?php 
			if($Employment_Status == 1){
			?>
			<option value="1">Payslip (Recommended Document)</option>
			<option value="5">Savings account bank statement with ITR</option>
			<option value="8">Salary credit in SCB salary account</option>
			<option value="10">Life Insurance Premium Reciepts</option>
			<option value="15">Other Bank Credit card statement</option>
			<option value="21">Housing Loan with SCB</option>
			<option value="23">Savings account with SCB</option>
			<option value="24">Emirates Frequent Flyer</option>
			<?php 
			}elseif($Employment_Status == 2){
			?>
			<option value="2">Current account statement with ITR</option>
			<option value="10">Life Insurance Premium Reciepts</option>
			<option value="15">Other Bank Credit card statement</option>
			<option value="21">Housing Loan with SCB</option>
			<option value="24">Emirates Frequent Flyer</option>
			<?php
			}elseif($Employment_Status == 3){
			?>
			<option value="2">Current account statement with ITR</option>
			<option value="10">Life Insurance Premium Reciepts</option>
			<option value="15">Other Bank Credit card statement</option>
			<option value="16">Self employed doctors with degree certification</option>
			<option value="18">Professional Certificate (Company Secretary / Chartered accountant / Architect)</option>
			<option value="21">Housing Loan with SCB</option>
			<option value="24">Emirates Frequent Flyer</option>
			<?php
			}
			?>
		</select></span>
	</td>
    <td><span class="style2">IncomeProofValue</span></td>
    <td><input type="text" class="d4l-input" name="IncomeProofValue" id="IncomeProofValue" value="<? echo $Net_Salary; ?>" /></td>
</tr>
<tr>
     <td colspan="4" align="center" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold; height:25px;">Feedback details</td>
</tr>
<tr>
	<td><span class="style2">LMS Comments: </span></td>
	<td><span class="style21"><textarea rows="2" cols="15" name="comment_section"><? echo $comment_section; ?></textarea></span></td>

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
			<option value="Process" <?if($Feedback == "Cibil ok") { echo "selected"; }?>>Cibil ok</option>
			<option value="Closed" <?if($Feedback == "Cibil Reject") { echo "selected"; }?>>Cibil Reject</option>
		</select></span>
	</td>
</tr>	
<tr>
	<td class="fontstyle"><b>Follow Up Date</b></td>
	<td class="fontstyle"><input type="Text"  name="FollowupDate" id="FollowupDate" maxlength="25" size="15" <?php if($followup_date !='0000-00-00 00:00:00') { ?>value="<?php  echo $followup_date; ?>" <?php } ?>><a href="javascript:NewCal('FollowupDate','yyyymmdd',true,24)"><img src="images/cal.gif" width="16" height="16" border="0" alt="Pick a date"></a></td>
	<td width="180"><span class="style2">Date of entry: </span></td>
	<td width="392"><span class="style21"><? echo $Updated_Date; ?></span></td>
</tr>

<tr>
	<td colspan="8">
		<span class="firstLabel">
			<?php 
			if($submitApiStatus == 1){
			?>
			<input type="checkbox" id="hitApi" name="hitApi" value="checked"><b>Check this to Submit to SCB</b></input>
			<?php 
			}
			else{
			?>
			<label class="alert_msg" style="font-size:14px;">SCB Criteria Fields Missing</label>
			<?php
			}
			?>
		</span>
		<span class="secondLabel"><input type="Submit" name="Submit" value="Submit">
		</span>
	</td>
</tr>
</table>
</form>
</td></tr>
</table>
<tr><td colspan="4">
<table style='border:1px dotted #9C9A9C;' cellspacing="0" cellpadding="5" width="700" height="80%" align="center" border="1" >
	<tr>
		<td>
			<?php 
			if(isset($Status)){
			?>
			Status : <? echo $Status; ?> 
			<?php
			}
			if(isset($ReferenceCode) && !empty($ReferenceCode)){
			?>
			<br>
			ReferenceCode : <? echo $ReferenceCode; ?>
			<?php
			}
			if(isset($Errorinfo) && !empty($Errorinfo)){
			?>
			<br>
			Errorinfo : <? echo $Errorinfo; ?>
			<?php
			}
			if(isset($Errorcode) && !empty($Errorcode)){
			?>
			<br>
			Errorcode : <? echo $Errorcode; ?>
			<?php
			}
			?>
	</td></tr>
</table>
</td></tr>
</body>
</html>
<?php
function GetCityCode($pKey){
    $titles = array(
	'Gurgaon' => '7',
	'Chandigarh' => '9',
	'Hyderabad' => '15',
	'Bangalore' => '19',
	'Chennai' => '21',
	'Ahmedabad ' => '22',
	'Mumbai' => '25',
	'Pune' => '26',
	'Kolkata' => '64',
	'CALCUTTA' => '64',
	'Coimbatore' => '69',
	'Noida' => '78',
	'Secunderabad' => '94',
	'Jaipur' => '100',
	'Indore' => '106',
	'Nagpur' => '135',
	'Navi Mumbai' => '163',
	'Surat' => '190',
	'Cochin' => '241',
	'Delhi' => '318',
	'New Delhi' => '318',
	'Bhopal' => '623',
	'Thane' => '640',
	'Greater Noida' => '704',
	'Baroda' => '707',
	'Rajkot' => '1035',
    	);
    foreach ($titles as $key=>$value)
        if($pKey==$key)
        return $value;
    return "";
}
?>
