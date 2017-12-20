<?php
//print_r($_POST);
 $requestid = $_REQUEST["postid"];
 $bidderid = $_REQUEST["biddt"];
  $process =  $_REQUEST["process"];
require 'scripts/session_check_online.php';
require 'scripts/db_init.php';
require 'scripts/functions.php';
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
	/*$resiaddress1 = FixString($resiaddress1);
	$resiaddress2 = FixString($resiaddress2);
	$resiaddress3 = FixString($resiaddress3);
	$resiaddress4 = FixString($resiaddress4);*/
	$postpaid_mobile = FixString($postpaid_mobile);
	$pincode = FixString($ResiPin);
	$Net_Salary = FixString($Net_Salary);
	$Employment_Status = FixString($Employment_Status);
	$comment_section = FixString($comment_section);
	$ccfeedback = FixString($ccfeedback);
	$FollowupDate  = FixString($FollowupDate);
	$Residence_Address = $_REQUEST["Residence_Address"];
	$CompanyName = FixString($Company_Name);
	$OfficeAddress1 = FixString($OfficeAddress1);
	$OfficeAddress2 = FixString($OfficeAddress2);
	$OfficeAddress3 = FixString($OfficeAddress3);
	$OfficeAddress4 = FixString($OfficeAddress4);
	$Office_Address = $OfficeAddress1." ".$OfficeAddress2." ".$OfficeAddress3." ".$OfficeAddress4;
	$Office_Addressstr =$OfficeAddress3." ".$OfficeAddress4;
	$OfficePin = FixString($OfficePin);
	$Land_linenumber = FixString($Land_linenumber);
	$OfficeCity = FixString($OfficeCity);
	$Phone_Number = FixString($Phone_Number);	
	$OfficeState = GetCityStatecCode($OfficeCity);
	$Qualification = FixString($Qualification);
	$Designation = FixString($Designation);	
	$card_name = FixString($card_name);
	$STD = "0".FixString($STD);
	$resiSTD = FixString($resiSTD);
	$opt_citicard = FixString($opt_citicard); //citibank option
	$citicard_name = FixString($citicard_name);
	$resiPhone_Number = FixString($resiPhone_Number);;
	$first_name = FixString($first_name);
	$middle_name = FixString($middle_name);
	$last_name = FixString($last_name);
	$Submitciti = FixString($Submitciti);//Citibank Form
	$mailing_address = FixString($mailing_address);
	$citiDesignation = FixString($citiDesignation);
	$dcb_bank = FixString($dcb_bank);
	$CC_Holder = FixString($CC_Holder);
	if(strlen($middle_name)>0 && $middle_name!="Middle Name" && $last_name=="")
		{		$last_name= $middle_name;		$middle_name="";	}
		else
		{		if($last_name=="")
			{ $last_name= "Kumar";	}
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
		$card_id = $_POST["card_id"];
		$Dated=ExactServerdate();

if(strlen($ccfeedback)>0 && $ccfeedback=="Send Now")
	{
		$pushflag=1;
	}
if($sbiccid>0)
	{
	$ccupqry="Update sbi_credit_card_5633 set pushflag='".$pushflag."',RequestID='".$RequestID."',CompanyName='".$Company_Name."',OfficeAddress1='".$OfficeAddress1."',OfficeAddress2='".$OfficeAddress2."',OfficeAddress3='".$Office_Addressstr."',OfficePin='".$OfficePin."',OfficeCity='".$OfficeCity."',LandlineNo='".$Phone_Number."',OfficeState='".$OfficeState."',Qualification='".$Qualification."',CardName='".$card_name."',Designation='".$Designation."',Dated='".$Dated."' Where (sbiccid='".$sbiccid."')";
	}
	else
	{
		$ccupqry="INSERT INTO sbi_credit_card_5633 set RequestID='".$RequestID."',CompanyName='".$Company_Name."',OfficeAddress1='".$OfficeAddress1."',OfficeAddress2='".$OfficeAddress2."',OfficeAddress3='".$Office_Addressstr."',OfficePin='".$OfficePin."',OfficeCity='".$OfficeCity."',LandlineNo='".$Phone_Number."',OfficeState='".$OfficeState."',Qualification='".$Qualification."',CardName='".$card_name."',Designation='".$Designation."',Dated='".$Dated."',pushflag='".$pushflag."', productflag='44' ";
	}
//	echo $ccupqry;
	$ccupqrynw=ExecQuery($ccupqry);
 
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
$upcctblenw="Update Req_Credit_Card_Sms set Name='".$Name."',DOB='".$DOB."',Company_Name='".$Company_Name."',Std_Code='".$resiSTD."',Landline='".$resi_landline."', Email='".$Email."',Net_Salary='".$Net_Salary."',Gender='".$Gender."',Residence_Address ='".$Residence_Address."',State='".$State."', Office_Address='".$Office_Address."',Employment_Status='".$Employment_Status."',CC_Holder='".$CC_Holder."', Pancard='".$panno."',Pincode='".$pincode."' ".$cityclause." ".$othercityclause." Where (RequestID=".$RequestID.")";
	$resulupcctblenw=ExecQuery($upcctblenw);	
//final lead allocation
//

	if(strlen($ccfeedback)>0 || strlen($comment_section)>0)
	{
		if($ccfeedback=="Process")
		{
			$last_updated=Date('Y-m-d');
		}
		else
		{
			$last_updated="";
		}
		$strSQL="";
		$Msg="";
		$result = ExecQuery("select RequestID,not_contactable_counter from Req_Credit_Card_Sms where RequestID=".$requestid."");
		$num_rows = mysql_num_rows($result);
		if($num_rows > 0)
		{	
			$row = mysql_fetch_array($result);
			$strSQL="Update Req_Credit_Card_Sms Set Feedback='".$ccfeedback."',comment_section='".$comment_section."',Followup_Date='".$FollowupDate."', sendnow_date='".$last_updated."'";
			$strSQL=$strSQL."Where RequestID=".$row["RequestID"];
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
if($dcb_bank=="DCB")
	{
		$result = ExecQuery("select id from credit_card_banks_apply where (cc_requestid=".$requestid." and applied_bankname like '%DCB%')");
		$num_rows = mysql_num_rows($result);
		if($num_rows>0)
		{	}
		else
		{
	//"lead_source" => "LMS", "applied_bankname"=> "RBL Bank"
		$strDCBSQL="Insert into credit_card_banks_apply(cc_requestid, lead_source, applied_bankname , date_created) Values ('".$requestid."','SMS LMS','DCB Bank',Now())";
		$DCBresult = ExecQuery($strDCBSQL);
		}
	}

}
$followup_date="";
$ccdetails = "select Gender,Landline,Std_Code, Account_No,Pancard_No,Pancard,Employment_Status, CC_Holder,Dated,DOB,Name,Email,Company_Name,City, City_Other,Mobile_Number,Net_Salary,Loan_Amount,Pincode,IP_Address,Add_Comment,Residence_Address, applied_card_name,Office_Address,Updated_Date, UserID from  Req_Credit_Card_Sms Where (RequestID=".$requestid.")";
//echo $ccdetails."<br>";
$ccdetailsresult = ExecQuery($ccdetails);
$ccrow=mysql_fetch_array($ccdetailsresult);
$applied_card_name = $ccrow["applied_card_name"];
$UserID = $ccrow["UserID"];

$needle = 'SBI';
if (strpos($applied_card_name,$needle) !== false) {
    echo '<center><b>SELECTED SBI CARD</b></center>';
}
$Gender = $ccrow["Gender"];
$Landline = $ccrow["Landline"];
$Std_Code = $ccrow["Std_Code"];
$City = $ccrow["City"];
$OffiAddress= $ccrow["Office_Address"];
$stroffiadd = round((strlen($OffiAddress)/3));
		$offiadd = str_split($OffiAddress, $stroffiadd);
		$OfficeAddress1 = $offiadd[0];
		$OfficeAddress2 = $offiadd[1];
		$OfficeAddress3 = $offiadd[2];
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
		if($last_name=="")
			{ $last_name= "Kumar";	}
	}
	
if($middle_name=="Middle Name")
	{
		$middle_name="";
	}
//echo "select * from sbi_credit_card_5633 Where (RequestID=".$requestid." or RequestID=".$userid.")";

$cc_alldetailsSql = "select * from sbi_credit_card_5633 Where (RequestID=".$requestid;
if($UserID>0)
{
	$cc_alldetailsSql .= " or RequestID=".$UserID ;
}

$cc_alldetailsSql .= " ) ORDER BY  sbiccid DESC ";

$cc_alldetails = ExecQuery($cc_alldetailsSql);
//echo $cc_alldetailsSql."<br>";
$ccrowal=mysql_fetch_array($cc_alldetails);
$Qualification = $ccrowal["Qualification"];
$Designation = $ccrowal["Designation"];
$CardName = $ccrowal["CardName"];
$LandlineNo = $ccrowal["LandlineNo"];
$OfficePin = $ccrowal["OfficePin"];
$OfficeCity = $ccrowal["OfficeCity"];
$sbiccid = $ccrowal["sbiccid"];
if($ccrow["Employment_Status"]==0) { $emp_status="Self Employed"; } else { $emp_status="Salaried"; }
if($ccrow["CC_Holder"]==1) { $cc_holder="Yes"; }  if($ccrow["CC_Holder"]==0) { $cc_holder="No"; }
					
		if($ccrow["Card_Vintage"]==1)	{	$card_vintage="Less than 6 months";}
		elseif($ccrow["Card_Vintage"]==2)	{	$card_vintage="6 to 9 months";}
		elseif($ccrow["Card_Vintage"]==3)	{	$card_vintage="9 to 12 months";}
		elseif($ccrow["Card_Vintage"]==4)		{	$card_vintage="more than 12 months";}
		else
			{
				$card_vintage="";
			}
if(strlen($ccrowal["CompanyName"])>1)
{
	$CompanyName = $ccrowal["CompanyName"];
}
else
{
	$CompanyName = $ccrow["Company_Name"];
}
if(strlen($CompanyName)>1)
{
	$sbi_category="";
$sbi_companycat= ExecQuery('select * from sbi_cc_company_list Where (sbi_companyname="'.$CompanyName.'")');
$sbicomp=mysql_fetch_array($sbi_companycat);
$sbi_category= $sbicomp["sbi_category"];
}


$ccfb_alldetails = ExecQuery("select * from Req_Credit_Card_Sms Where (RequestID=".$requestid.")");
//echo $ccdetails."<br>";
$ccrowfb=mysql_fetch_array($ccfb_alldetails);
$Feedback= $ccrowfb["Feedback"];
$followup_date= $ccrowfb["Followup_Date"];
$comment_section= $ccrowfb["comment_section"];

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
</style>
<style type="text/css">
<!--
.style2 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold;}
.style21 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size:12px;}
-->
</style>
<script>
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
</script>
<script>
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
<?php 
if($process=="cq")
{
?>
<form name="loan_form" method="post" action="<? echo $_SERVER['PHP_SELF'] ?>?postid=<?echo $requestid;?>&biddt=<? echo $bidderid;?>&process="<?php echo $process; ?>"" >
<?php
}
else {
?>
<form name="loan_form" method="post" action="<? echo $_SERVER['PHP_SELF'] ?>?postid=<?echo $requestid;?>&biddt=<? echo $bidderid;?>" >
<?php } ?>
<input type="hidden" name="biddtnw" value="<? echo $bidderid;?>">
<input type="hidden" name="RequestID" value="<? echo $requestid;?>">
<input type="hidden" name="sbiccid" value="<? echo $sbiccid;?>">
<table style='border:1px dotted #9C9A9C;' cellspacing="0" cellpadding="5" width="700" height="80%" align="center" border="1" >
<tr><td colspan="4" align="center" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold; height:25px;">Credit Card customer details</td></tr>
<tr>
        <td width="180"><span class="style2">Customer Name: </span></td>
    <td width="392" colspan="3"><span class="style21"><input type="text" maxlength="12" size="13" name="first_name" id="first_name" value="<? echo $first_name; ?>" />&nbsp;<input type="text" maxlength="10" size="11" name="middle_name" id="middle_name" value="<? echo $middle_name; ?>"/>&nbsp;<input type="text" maxlength="16" size="17" name="last_name" id="last_name" value="<? echo $last_name; ?>" /></span></td></tr>
    <tr>
     <td><span class="style2"> Mobile No: </span></td>
       <td><span class="style21"><? echo ccMasking($ccrow["Mobile_Number"]); ?></span></td>
        <td><span class="style2"> Email: </span></td>
       <td><span class="style21"><input type="text" value="<? echo $ccrow["Email"]; ?>" name="Email" id="Email" /></span></td
  ></tr>
     <tr>
        <td><span class="style2"> DOB: </span></td>
       <td><span class="style21"> <?php echo listbox_date('day',$dd);?>
		  <?php echo listbox_month('month', $mm);?>
           <?php $minage= Date('Y')-18; $maxage=Date('Y')-62;
		   echo listbox_year('year',$maxage,$minage, $year);?></span></td>
           <td><span class="style2"> Gender: </span></td>
       <td><span class="style21"><select name="Gender" id="Gender" >
    <option value="-1">Please Select</option>
    <option value="Male" <? if($Gender=="Male") {echo "selected";} ?>>Male</option>
    <option value="Female" <? if($Gender=="Female") {echo "selected";} ?>>Female</option>
</select></span></td>
     </tr>    
  <tr>
  	<td><span class="style2">PanCard No</span></td>
    <td><input type="text" class="d4l-input" name="panno" id="panno" value="<? echo $ccrow["Pancard"] ;?>"  maxlength="10"/></td>
    <td><span class="style2">Qualification</span></td>
    <td><span class="style21"><select name="Qualification" id="Qualification">
			<option value="">Please Select</option>
            <option  value="10 or below" <? if($Qualification=="10 or below") { echo "Selected"; }?> >Metric or below</option>
            <option value="Plus 2 or below" <? if($Qualification=="Plus 2 or below") { echo "Selected"; }?> >Higher secondary </option>
            <option value="Graduate" <? if($Qualification=="Graduate") { echo "Selected"; }?>>Graduation</option>
            <option value="Post graduate" <? if($Qualification=="Post graduate") { echo "Selected"; }?> >Postgraduate and above</option>
          </select></span></td>
    </tr>
   <tr>
  	<td><span class="style2">Select Card</span></td>
    <td ><select name="card_name" id="card_name">
	<option value="">Please select </option><? $getcardNameSql = "SELECT cc_bankid,cc_bank_name FROM `credit_card_banks_eligibility` WHERE (`cc_bank_name` like '%SBI%' and `cc_bank_flag`=1) group by `cc_bank_name`";
list($numRowsCardName,$getCardNameQuery)=MainselectfuncNew($getcardNameSql,$array = array());

for($cN=0;$cN<$numRowsCardName;$cN++)
{
	$Card_id = $getCardNameQuery[$cN]['cc_bankid'];
	$cc_bank_name = $getCardNameQuery[$cN]['cc_bank_name'];
	?>
      <option value="<?php echo $cc_bank_name; ?>" <? if($cc_bank_name==$CardName) { echo "Selected";} ?>><?php echo ucwords(strtolower($cc_bank_name)); ?></option>
                  <?php
}
?></select></td>
<td><span class="style2">Selected Card</span></td>
<td><?php echo $applied_card_name; ?></td>
    </tr>
    <tr><td colspan="2"><span class="style2">do you hold any card?</span></td>
<td colspan="2"><input type="radio" name="CC_Holder" id="radio-one" value="1" class="css-checkbox" <?php if($ccrow["CC_Holder"]==1) { echo "checked";} ?> />
                 <label for="radio-one" class="css-label radGroup2" >Yes</label>
                
                  <input type="radio" name="CC_Holder" id="radio-two" value="2" class="css-checkbox" <?php if($ccrow["CC_Holder"]==2) { echo "checked";} ?>/>
                   <label for="radio-two" class="css-label radGroup2">No</label></td>
    </tr>
    <tr>
     <td colspan="4" align="center" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold; height:25px;">Residence details</td></tr>
     <tr>
  		<td><span class="style2"> Resi Address: </span></td>
       <td colspan="3"><span class="style21" ><input type="text" maxlength="120" size=80 name="Residence_Address" id="Residence_Address" value="<? echo $Residence_Address; ?>" /></span></td>
  </tr>
  <tr>
        <td><span class="style2">Residence City: </span></td>
    <td><span class="style21"> <select size="1" name="City" id="City">
    <option value="">Please Select</option><?php 
$getCarNameSql = "SELECT * FROM sbi_cc_city_state_list WHERE 1 GROUP BY city";
list($numRowsCarName,$getCarNameQuery)=MainselectfuncNew($getCarNameSql,$array = array());

for($cN=0;$cN<$numRowsCarName;$cN++)
{
	$resicity = ucwords(strtolower($getCarNameQuery[$cN]['city']));
	$cityalias = ucwords(strtolower($getCarNameQuery[$cN]['cityalias']));
	?>
    <option value="<?php echo $resicity; ?>" <? if($resicity==$City || $cityalias==$City) {echo "Selected";} ?> ><?php echo $resicity; ?></option>
                  <?php
				 }
?></select></span></td>
  
        <td><span class="style2"> Other City: </span></td>
       <td><span class="style21"><input type="text" value="<? echo $ccrow["City_Other"]; ?>" name="City_Other" id="City_Other"></span></td>
  </tr>  
  <tr>
       <td><span class="style2"> Resi pincode: </span></td>
       <td><span class="style21">
                  <select name="ResiPin" id="ResiPin" class="d4l-select" onchange="showResiPinCode(this.value)">
				 <?  if($ccrow["City"]=="Gaziabad")
				 {
					 $getPinSql = "SELECT pincode FROM sbi_cc_city_state_list WHERE city like '%Ghaziabad%'";
				 }
				 elseif($ccrow["City"]=="Kolkata")
					 {
					$getPinSql = "SELECT pincode FROM sbi_cc_city_state_list WHERE city like '%CALCUTTA%'";
				 }
				 else
				 { $getPinSql = "SELECT pincode FROM sbi_cc_city_state_list WHERE (city like '%".$ccrow["City"]."%' or cityalias like '%".$ccrow["City"]."%')";
				 }
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
                </span></td>
           <td><span class="style2"> Resi number: </span></td>
        <td><table cellpadding="2" cellspacing="2"><tr><td>
             <div id="resitxtHint2" style="float:left; width:50px;"><input type="text" class="std"  name="resiSTD" value="<? echo $Std_Code; ?>"  onfocus="(this.value == 'STD') && (this.value = '')"   onblur="(this.value == '') && (this.value = 'STD')" id="resiSTD" style="width:50px;"></div></td><td>
          <input type="text" class="stdnumber" id="resiPhone_Number" name="resiPhone_Number" value="<? echo $Landline; ?>" maxlength="8" size="10"/></td></tr></table></td></tr>
		   <tr> <td><span class="style2"> Post-paid mobile number: </span></td>
        <td><table cellpadding="2" cellspacing="2"><tr><td>
          +91<input type="text" class="stdnumber" id="postpaid_mobile" name="postpaid_mobile" value="<? echo $Landline; ?>" maxlength="10" size="15"/></td></tr></table></td></tr>
   <tr>
     <td colspan="4" align="center" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold; height:25px;">Professional details</td></tr>
     <tr>
        <td><span class="style2"> Occupation: </span></td>
       <td><span class="style21"><select name="Employment_Status" id="Employment_Status" >
    <option value="-1">Please Select</option>
    <option value="1" <? if($ccrow["Employment_Status"]==1) {echo "Selected";}?>>Salaried</option>
    <option value="0" <? if($ccrow["Employment_Status"]==0) {echo "Selected";}?>>Self Employment</option>
</select></span></td>
         <td><span class="style2"> Company Name: </span></td>
       <td><span class="style21"><input name="Company_Name" id="Company_Name" type="text" class="d4l-input" onkeyup="ajax_showOptions(this,'getCountriesByLetters',event)"   style="width:200px;" maxlength="30" value="<? echo $CompanyName; ?>" /></span></td>
  </tr>   
     <tr>
        <td><span class="style2"> Designation: </span></td>
       <td><span class="style21"><select name="Designation" id="Designation" >
           <option value="">Select Designation</option>
           <?php 
$getdesgeSql = "SELECT * FROM sbi_cc_designation";
list($numRowsgetdesge,$getdesgeSqlQuery)=MainselectfuncNew($getdesgeSql,$array = array());

for($cN=0;$cN<$numRowsgetdesge;$cN++)
{
	$designation = $getdesgeSqlQuery[$cN]['designation'];
	?> <option value="<?php echo $designation; ?>" <? if($designation ==$Designation) echo "selected"; ?>><?php echo ucwords(($designation)); ?></option>
                  <?php
}
?>	<option value="Other" <? if($Designation=="Other") echo "selected"; ?>>Other</option>
            </select></span></td><td><span class="style2"> Annual Income: </span></td>
        <td><span class="style21"><input type="text"  name="Net_Salary" id="Net_Salary" value="<? echo $ccrow["Net_Salary"]; ?>"/></span></td>
  </tr>
  <tr>
  		<td><span class="style2"> Office Address: </span></td>
       <td colspan="3"><span class="style21" ><input type="text" maxlength="25" size=25 name="OfficeAddress1" id="OfficeAddress1" value="<? echo $OfficeAddress1; ?>" placeholder="*Door/house no." />&nbsp;<input type="text" maxlength="25" size=25 name="OfficeAddress2" id="OfficeAddress2" value="<? echo $OfficeAddress2; ?>" placeholder="*Street & road name"/><br /><br /><input type="text" maxlength="25" size=25 name="OfficeAddress3" id="OfficeAddress3" value="<? echo $OfficeAddress3; ?>" placeholder="*Area/Locality"/>&nbsp;<input type="text" maxlength="25" size=25 name="OfficeAddress4" id="OfficeAddress4" value="<? echo $OfficeAddress4; ?>" placeholder="*Landmark"/>
	</span></td>
  </tr>
  <tr>
        <td><span class="style2"> Office City: </span></td>
       <td><span class="style21" >  <select name="OfficeCity" id="OfficeCity" onchange="showUser(this.value);">
           <option value="">Select City</option>
           <?php 
$getCarNameSql = "SELECT * FROM sbi_cc_city_state_list WHERE 1 GROUP BY city";
list($numRowsCarName,$getCarNameQuery)=MainselectfuncNew($getCarNameSql,$array = array());

for($cN=0;$cN<$numRowsCarName;$cN++)
{
	$hdfc_car_manufacturer = $getCarNameQuery[$cN]['city'];
	?>
                  <option value="<?php echo $hdfc_car_manufacturer; ?>" <? if($hdfc_car_manufacturer==$OfficeCity) {echo "Selected";} ?> ><?php echo ucwords(strtolower($hdfc_car_manufacturer)); ?></option>
                  <?php
				 }
?>	
            </select></span></td>  <td><span class="style2"> Office pincode: </span></td>
       <td> 
	 			<select name="OfficePin" id="OfficePin" class="d4l-select" onchange="showResiPinCode(this.value)">
				 <?  if($OfficeCity=="Gaziabad")
				 {
					 $getoffPinSql = "SELECT pincode FROM sbi_cc_city_state_list WHERE city like '%Ghaziabad%'";
				 }
				 elseif($OfficeCity=="Kolkata")
					 {
					$getoffPinSql = "SELECT pincode FROM sbi_cc_city_state_list WHERE city like '%CALCUTTA%'";
				 }
				 else
				 { $getoffPinSql = "SELECT pincode FROM sbi_cc_city_state_list WHERE city like '%".$OfficeCity."%'";
				 }
				list($numRows,$getoffQuery)=MainselectfuncNew($getoffPinSql,$array = array());
				for($cN=0;$cN<$numRows;$cN++)
				{
					$offPincode = $getoffQuery[$cN]['pincode'];
					?>
					<option value="<?php echo $offPincode; ?>" <? if($offPincode==$OfficePin) {echo "Selected";} ?> ><?php echo $offPincode; ?></option>   
					<?php
				}
				?>	
           </select>				
				</td></tr>
        <tr>
           <td><span class="style2"> Office number: </span></td>
        <td><table cellpadding="2" cellspacing="2"><tr><td>
             <div id="txtHint2" style="float:left; width:50px;"><input type="text" class="std"  name="STD"  onfocus="(this.value == 'STD') && (this.value = '')"   onblur="(this.value == '') && (this.value = 'STD')" id="STD" style="width:50px;"></div></td><td>
          <input type="text" class="stdnumber" id="Phone_Number" name="Phone_Number"  value="<? echo $LandlineNo; ?>" maxlength="8" onkeydown="Land_linenumberVal2" size="10"/></td></tr></table></td><td><span class="style2">Company Category</span></td><td><? echo $sbi_category;?></td></tr>   
  <tr>
     <td colspan="4" align="center" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold; height:25px;">Feedback details</td></tr>
    <tr>
        <td><span class="style2">LMS Comments: </span></td>
        <td><span class="style21"><textarea rows="2" cols="15" name="comment_section"><? echo $ccrowfb["comment_section"]; ?></textarea></span></td>
   
        <td><span class="style2">LMS feedback </span></td>
        <td><span class="style21"><select name="ccfeedback" id="ccfeedback">
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
	</select></span></td>
     </tr>	
	 <tr>
	 <td class="fontstyle"><b>Follow Up Date</b></td>
	<td class="fontstyle"><input type="Text"  name="FollowupDate" id="FollowupDate" maxlength="25" size="15" <?php if($Followup_Date !='0000-00-00 00:00:00') { ?>value="<?php  echo $followup_date; ?>" <?php } ?>><a href="javascript:NewCal('FollowupDate','yyyymmdd',true,24)"><img src="images/cal.gif" width="16" height="16" border="0" alt="Pick a date"></a></td>
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
  <tr><td colspan="4" align="left"><input type="checkbox" name="dcb_bank" value="DCB" <? if($dcb_bank=="DCB") {echo "Checked";} ?>>DCB Bank</td></tr>
<?php } ?>
   <tr><td colspan="4" align="center"><input type="Submit" name="Submit" value="Submit"></td></tr>
     </table>
</form>
</td></tr>
<tr><td>
<table style='border:1px dotted #9C9A9C;' cellspacing="0" cellpadding="5" width="700" height="80%" align="center" border="1" >
<tr><td colspan="4" align="right">
<?php 
if($process=="cq")
{

//Put the Curing Queue Form
?>


<?php
}
else {
?>


<form method="POST" action="/soapservice_sbi5633_1sms_log.php" name="sendform" target="_blank">
      
      <input type="hidden" name="custid"id="custid"  value="<?php echo $requestid; ?>"><input type="Submit" name="Submitd" value="SBI Send now" style="color:#FFF; background-color:#C00;"></form>
        | <?php 
$getStancSql = "select City, Query from Bidders_List where BidderID = 6455 and Restrict_Bidder=1";
$getStancQuery = ExecQuery($getStancSql);
$getStancNumRows = mysql_num_rows($getStancQuery);
if($getStancNumRows>0)
{
	$City = mysql_result($getStancQuery,0,'City');
	$CityList =  str_replace(",", "', '", $City);
	
	$sqlStanc = mysql_result($getStancQuery,0,'Query')." and Req_Credit_Card.RequestID='".$requestid."' and  Req_Credit_Card.City in ('".$CityList."')";
	$sqlStanc = str_replace("Req_Credit_Card", "Req_Credit_Card_Sms",$sqlStanc);
	//echo $sqlStanc."<br>";
	$QueryStanc = ExecQuery($sqlStanc);
	$numRowsStanc = mysql_num_rows($QueryStanc);
	if($numRowsStanc>0)
	{
?>
<a href="scb_agent_form.php?cust_id=<?php echo $requestid; ?>" style="color:#FFF; background-color:#C00;" target="_blank">SCB Send now</a>
      <?php } } ?> 
<?php 
$getrblSql = "select Query,City from Bidders_List where BidderID = 4905";
$getrblQuery = ExecQuery($getrblSql);
$getrblNumRows = mysql_num_rows($getrblQuery);
if($getrblNumRows>0)
{
	$City = mysql_result($getrblQuery,0,'City');
	$CityList =  str_replace(",", "', '", $City);	
	$sqlrbl = mysql_result($getrblQuery,0,'Query')." and Req_Credit_Card.RequestID='".$requestid."' and  Req_Credit_Card.City in ('".$CityList."')";
	$sqlrbl = str_replace("Req_Credit_Card", "Req_Credit_Card_Sms",$sqlrbl);

	$Queryrbl = ExecQuery($sqlrbl);
	$numRowsrbl = mysql_num_rows($Queryrbl);
	if($numRowsrbl>0)
	{
?>
<a href="rblcc_agent_form.php?cust_id=<?php echo $requestid; ?>" style="color:#FFF; background-color:#C00;" target="_blank">RBL Send now</a>
      <?php } } ?>
<?php
$getAmexSql = "select City, Query from Bidders_List where BidderID = 5596";
$getAmexQuery = ExecQuery($getAmexSql);
$getAmexNumRows = mysql_num_rows($getAmexQuery);
if($getAmexNumRows>0)
{
	$City = mysql_result($getAmexQuery,0,'City');
	$CityList =  str_replace(",", "', '", $City);
	
	$sqlAmex = mysql_result($getAmexQuery,0,'Query')." and Req_Credit_Card.RequestID='".$requestid."' and  Req_Credit_Card.City in ('".$CityList."')";
	$sqlAmex = str_replace("Req_Credit_Card", "Req_Credit_Card_Sms",$sqlAmex);
	//echo $sqlAmex ."<br>";
	$QueryAmex = ExecQuery($sqlAmex);
	$numRowsAmex = mysql_num_rows($QueryAmex);
	if($numRowsAmex>0)
	{
?>
| 
<a href="amex_agent_form.php?cust_id=<?php echo $requestid; ?>" style="color:#FFF; background-color:#C00;" target="_blank">AMEX Send now</a>
      <?php } } ?> 

<?php
$getICICISql = "select City, Query from Bidders_List where BidderID = 6588";
$getICICIQuery = ExecQuery($getICICISql);
$getICICINumRows = mysql_num_rows($getICICIQuery);
if($getICICINumRows>0)
{
	$City = mysql_result($getICICIQuery,0,'City');
	$CityList =  str_replace(",", "', '", $City);
	
	$sqlICICI = mysql_result($getICICIQuery,0,'Query')." and Req_Credit_Card.RequestID='".$requestid."' and  Req_Credit_Card.City in ('".$CityList."')";
	$sqlICICI = str_replace("Req_Credit_Card", "Req_Credit_Card_Sms",$sqlICICI);
	//echo $sqlICICI ."<br>";
	$QueryICICI = ExecQuery($sqlICICI);
	$numRowsICICI = mysql_num_rows($QueryICICI);
	if($numRowsICICI>0)
	{
?>
| 
<a href="icici-credit-card-continue_lms.php?cust_id=<?php echo $requestid; ?>" style="color:#FFF; background-color:#C00;" target="_blank">ICICI Send now</a>
      <?php } } ?> 

      </td></tr>
  <tr><td colspan="4">  <?
$checkProductTableDetails = ExecQuery("select * from Req_Credit_Card_Sms Where (RequestID=".$requestid." and UserID>0)");
//echo "select * from Req_Credit_Card_Sms Where (RequestID=".$requestid." and UserID>0)<br>";
$checkProductTableDetailsQry=ExecQuery($checkProductTableDetails);
$checkProductTableDetailsNum = mysql_num_rows($checkProductTableDetails);
if($checkProductTableDetailsNum>0)
{
//echo "select * from sbi_credit_card_5633 Where (RequestID=".$UserID.") and ApplicationNumber!='' ORDER BY sbiccid DESC limit 0,1";
 	$cc_alldetailsqry = ExecQuery("select * from sbi_credit_card_5633 Where (RequestID=".$UserID.") and ApplicationNumber!='' ORDER BY sbiccid DESC limit 0,1");
	$numWSCheck = mysql_num_rows($cc_alldetailsqry);
	if($numWSCheck>0)
	{
		$ccal = mysql_fetch_array($cc_alldetailsqry); 
	
	?>
  <table align="left"><tr><td>Application Number : <? echo $ccal["ApplicationNumber"]; ?> <br>Status Code : <? echo $ccal["ApplicationNumber"]; ?><br>Processing Status : <? echo $ccal["ProcessingStatus"]; ?><br>Messages : <? echo $ccal["Messages"]; ?><br>message : <? echo $ccal["message"]; ?>
  
<?php } else {
 $cc_alldetailsqry = ExecQuery("select * from sbi_credit_card_5633_log Where (cc_requestid=".$UserID.") group by cc_requestid order by first_dated DESC");
	$ccal=mysql_fetch_array($cc_alldetailsqry); ?>
  <table align="left"><tr><td>Application Number : <? echo $ccal["ApplicationNumber"]; ?> <br>Status Code : <? echo $ccal["ApplicationNumber"]; ?><br>Processing Status : <? echo $ccal["ProcessingStatus"]; ?><br>Messages : <? echo $ccal["Messages"]; ?><br>message : <? echo $ccal["message"]; ?>
  <?php }
}
}
?>  </td><tr>
  </table></td></tr>
  </table>
 </td></tr>
 </table>
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
