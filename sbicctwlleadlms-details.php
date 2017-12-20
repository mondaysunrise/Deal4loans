<?php
//print_r($_POST);
 $requestid = $_REQUEST["postid"];
 $bidderid = $_REQUEST["biddt"];
require 'scripts/session_check_online.php';
require 'scripts/db_init.php';
require 'scripts/functions.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		foreach($_POST as $a=>$b)
			$$a=$b;
	$RequestID = $_REQUEST["RequestID"];
	$sbiccid = $_REQUEST["sbiccid"];
	$Email = $_REQUEST["Email"];
	$Gender = $_REQUEST["Gender"];
	$panno = $_REQUEST["panno"];
	$City = $_REQUEST["City"];
	$City_Other = $_REQUEST["City_Other"];
	$State = GetCityStatecCode($City);
	$resiaddress1 = $_REQUEST["resiaddress1"];
	$resiaddress2 = $_REQUEST["resiaddress2"];
	$resiaddress3 = $_REQUEST["resiaddress3"];
	$pincode = $_REQUEST["ResiPin"];
	$Net_Salary = $_REQUEST["Net_Salary"];
	$Employment_Status = $_REQUEST["Employment_Status"];
	$comment_section = $_POST["comment_section"];
	$ccfeedback = $_POST["ccfeedback"];
	$FollowupDate  = $_POST["FollowupDate"];
	$Residence_Address = $resiaddress1." | ".$resiaddress2." | ".$resiaddress3;
	$CompanyName = $_POST["Company_Name"];
	$OfficeAddress1 = $_POST["OfficeAddress1"];
	$OfficeAddress2 = $_POST["OfficeAddress2"];
	$OfficeAddress3 = $_POST["OfficeAddress3"];
	$OfficePin = $_POST["OfficePin"];
	$Land_linenumber = $_POST["Land_linenumber"];
	$OfficeCity = $_POST["OfficeCity"];
	$Phone_Number = $_POST["Phone_Number"];	
	$OfficeState = GetCityStatecCode($OfficeCity);
	$Qualification = $_POST["Qualification"];
	$Designation = $_POST["Designation"];	
	$card_name = $_POST["card_name"];
	$STD = "0".$_POST["STD"];
	$resiSTD = $_POST["resiSTD"];
	$resiPhone_Number = $_POST["resiPhone_Number"];;
	$first_name = $_POST["first_name"];
	$middle_name = $_POST["middle_name"];
	$last_name = $_POST["last_name"];
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
	$ccupqry="Update sbi_credit_card_5633 set pushflag='".$pushflag."',RequestID='".$RequestID."',CompanyName='".$Company_Name."',OfficeAddress1='".$OfficeAddress1."',OfficeAddress2='".$OfficeAddress2."',OfficeAddress3='".$OfficeAddress3."',OfficePin='".$OfficePin."',OfficeCity='".$OfficeCity."',LandlineNo='".$Phone_Number."',OfficeState='".$OfficeState."',Qualification='".$Qualification."',CardName='".$card_name."',Designation='".$Designation."',Dated='".$Dated."', productflag=10 Where (sbiccid='".$sbiccid."')";
	}
	else
	{
		$ccupqry="INSERT INTO sbi_credit_card_5633 set RequestID='".$RequestID."',CompanyName='".$Company_Name."',OfficeAddress1='".$OfficeAddress1."',OfficeAddress2='".$OfficeAddress2."',OfficeAddress3='".$OfficeAddress3."',OfficePin='".$OfficePin."',OfficeCity='".$OfficeCity."',LandlineNo='".$Phone_Number."',OfficeState='".$OfficeState."',Qualification='".$Qualification."',CardName='".$card_name."',Designation='".$Designation."',Dated='".$Dated."',pushflag='".$pushflag."',productflag=10 ";
	}
	//echo $ccupqry;
	//echo "<br><br>";
	$ccupqrynw=ExecQuery($ccupqry);
 
if(strlen($City)>0)
{
	$cityclause=", City='".$City."'";
	if(strlen($City_Other)>0)
	{
		$othercityclause=", City_Other='".$City_Other."'";
	}
}
if(strlen($Company_Name)>1)
{
	$sbi_category="";
$sbi_companycat= ExecQuery('select * from sbi_cc_company_list Where (sbi_companyname="'.$Company_Name.'")');
$sbicomp=mysql_fetch_array($sbi_companycat);
$sbi_category= $sbicomp["sbi_category"];
}

$upcctblenw="Update sbi_ccoffers_directonsite set sbicc_name='".$Name."',sbicc_dob='".$DOB."',sbicc_company_name='".$Company_Name."',sbicc_std_code='".$resiSTD."',sbicc_landline='".$resiPhone_Number."', sbicc_email='".$Email."',sbicc_net_salary='".$Net_Salary."',sbicc_gender='".$Gender."',sbicc_residence_address ='".$Residence_Address."' ,sbicc_state='".$State."', sbicc_pancard='".$panno."',sbicc_pincode='".$pincode."',sbicc_city='".$City."' Where (sbiccoffersid=".$RequestID.")";
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
		if($requestid>0)
		{
		$strSQL="Update sbi_ccoffers_directonsite Set lms_feedback='".$ccfeedback."',lms_comment='".$comment_section."',lms_followup_date='".$FollowupDate."', lms_last_updated='".$last_updated."', sendnow_date=Now()";
		$strSQL=$strSQL."Where sbiccoffersid=".$requestid;
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
$ccdetails = "select * from sbi_ccoffers_directonsite Where (sbiccoffersid=".$requestid.")";
//echo $ccdetails."<br>";
$ccdetailsresult = ExecQuery($ccdetails);
$ccrow=mysql_fetch_array($ccdetailsresult);

if($ccrow["sbicc_occupation"]==0) { $emp_status="Self Employed"; } else { $emp_status="Salaried"; }
$sbiccoffersid= $ccrow["sbiccoffersid"];
$Feedback= $ccrow["lms_feedback"];
$followup_date= $ccrow["lms_followup_date"];
$comment_section= $ccrow["lms_comment"];
$sbicc_email = $ccrow["sbicc_email"];
$sbicc_mobile = $ccrow["sbicc_mobile"];
$sbicc_occupation = $ccrow["sbicc_occupation"];
$sbicc_net_salary = $ccrow["sbicc_net_salary"];
$CompanyName = $ccrow["sbicc_company_name"];
$sbicc_pincode = $ccrow["sbicc_pincode"];
$Landline = $ccrow["sbicc_landline"];
$Std_Code = $ccrow["sbicc_std_code"];
$sbicc_requestid = $ccrow["sbicc_requestid"];
$sbicc_residence_address = $ccrow["sbicc_residence_address"];
list($resiaddress1,$resiaddress2,$resiaddress3) = split('[|]',$sbicc_residence_address);
$City = $ccrow["sbicc_city"];
$sbicc_pancard = $ccrow["sbicc_pancard"];
list($year,$mm,$dd) = split("[-]",$ccrow["sbicc_dob"]);
list($first_name,$middle_name,$last_name) = split("[ ]",$ccrow["sbicc_name"]);
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

$cc_alldetails = ExecQuery("select * from sbi_credit_card_5633 Where (RequestID=".$requestid." and productflag=10)");
//echo $ccdetails."<br>";
$ccrowal=mysql_fetch_array($cc_alldetails);
$Qualification = $ccrowal["Qualification"];
$Designation = $ccrowal["Designation"];
$CardName = $ccrowal["CardName"];
$LandlineNo = $ccrowal["LandlineNo"];
$CompanyName = $ccrowal["CompanyName"];
$OfficeAddress1 = $ccrowal["OfficeAddress1"];
$OfficeAddress2 = $ccrowal["OfficeAddress2"];
$OfficeAddress3 = $ccrowal["OfficeAddress3"];
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
<form name="loan_form" method="post" action="<? echo $_SERVER['PHP_SELF'] ?>?postid=<?echo $requestid;?>&biddt=<? echo $bidderid;?>" >
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
       <td><span class="style21"><? echo $sbicc_mobile; ?></span></td>
        <td><span class="style2"> Email: </span></td>
       <td><span class="style21"><input type="text" value="<? echo $sbicc_email; ?>" name="Email" id="Email" /></span></td
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
    <td><input type="text" class="d4l-input" name="panno" id="panno" value="<? echo $sbicc_pancard; ;?>"  maxlength="10"/></td>
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
    <td colspan="3"><select name="card_name" id="card_name">
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
    </tr>
    <tr>
     <td colspan="4" align="center" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold; height:25px;">Residence details</td></tr>
     <tr>
  		<td><span class="style2"> Resi Address: </span></td>
       <td colspan="3"><span class="style21" ><input type="text" maxlength="40" size=35 name="resiaddress1" id="resiaddress1" value="<? echo $resiaddress1; ?>" />&nbsp;<input type="text" maxlength="40" size=35 name="resiaddress2" id="resiaddress2" value="<? echo $resiaddress2; ?>"/><br /><br /><input type="text" maxlength="40" size=35 name="resiaddress3" id="resiaddress3" value="<? echo $resiaddress3; ?>"/></span></td>
  </tr>
  <tr>
        <td><span class="style2">Residence City: </span></td>
    <td><span class="style21"> <select size="1" name="City" id="City"> 
	  <?php 
$getCarNameSql = "SELECT * FROM sbi_cc_city_state_list WHERE 1 GROUP BY city";
list($numRowsCarName,$getCarNameQuery)=MainselectfuncNew($getCarNameSql,$array = array());

for($cN=0;$cN<$numRowsCarName;$cN++)
{
	$resicity = $getCarNameQuery[$cN]['city'];
	?>
                  <option value="<?php echo $resicity; ?>" <? if($resicity==$City) {echo "Selected";} ?> ><?php echo ucwords(strtolower($resicity)); ?></option>
                  <?php
				 }
?>	
	</select></span></td>
  
        <td><span class="style2"> Other City: </span></td>
       <td><span class="style21"><input type="text" value="<? echo $ccrow["City_Other"]; ?>" name="City_Other" id="City_Other"></span></td>
  </tr>  
  <tr>
       <td><span class="style2"> Resi pincode: </span></td>
       <td><span class="style21">
                  <select name="ResiPin" id="ResiPin" class="d4l-select" onchange="showResiPinCode(this.value)">
				 <?  if($City=="Gaziabad")
				 {
					 $getPinSql = "SELECT pincode FROM sbi_cc_city_state_list WHERE city like '%Ghaziabad%'";
				 }
				 elseif($City=="Kolkata")
					 {
					$getPinSql = "SELECT pincode FROM sbi_cc_city_state_list WHERE city like '%CALCUTTA%'";
				 }
				 else
				 { $getPinSql = "SELECT pincode FROM sbi_cc_city_state_list WHERE city like '%".$City."%'";
				 }
				list($numRowsCarName,$getCarNameQuery)=MainselectfuncNew($getPinSql,$array = array());
				for($cN=0;$cN<$numRowsCarName;$cN++)
				{
					$Pincode = $getCarNameQuery[$cN]['pincode'];
					?>
					<option value="<?php echo $Pincode; ?>" <? if($Pincode==$sbicc_pincode) {echo "Selected";} ?> ><?php echo $Pincode; ?></option>   
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
   <tr>
     <td colspan="4" align="center" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold; height:25px;">Professional details</td></tr>
     <tr>
        <td><span class="style2"> Occupation: </span></td>
       <td><span class="style21"><select name="Employment_Status" id="Employment_Status" >
    <option value="-1">Please Select</option>
    <option value="1" <? if($sbicc_occupation==1) {echo "Selected";}?>>Salaried</option>
    <option value="0" <? if($sbicc_occupation==0) {echo "Selected";}?>>Self Employment</option>
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
	?>
                  <option value="<?php echo $designation; ?>" <? if($designation ==$Designation) echo "selected"; ?>><?php echo ucwords(($designation)); ?></option>
                  <?php
}
?>	<option value="Other" <? if($Designation=="Other") echo "selected"; ?>>Other</option>
            </select></span></td><td><span class="style2"> Annual Income: </span></td>
        <td><span class="style21"><input type="text"  name="Net_Salary" id="Net_Salary" value="<? echo $sbicc_net_salary; ?>"/></span></td>
  </tr>
  <tr>
  		<td><span class="style2"> Office Address: </span></td>
       <td colspan="3"><span class="style21" ><input type="text" maxlength="40" size=35 name="OfficeAddress1" id="OfficeAddress1" value="<? echo $OfficeAddress1; ?>"/>&nbsp;<input type="text" maxlength="40" size=35 name="OfficeAddress2"  id="OfficeAddress2"  value="<? echo $OfficeAddress2; ?>"/></span></td>
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
        <td><span class="style21"><textarea rows="2" cols="15" name="comment_section"><? echo $ccrow["lms_comment"]; ?></textarea></span></td>
   
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
        <td width="392"><span class="style21"><? echo $ccrowal["Allocation_Date"]; ?></span></td>
  </tr>
  
   <tr><td colspan="4" align="center"><input type="Submit" name="Submit" value="Submit"></td></tr>
  </table>
</form>
<table style='border:1px dotted #9C9A9C;' cellspacing="0" cellpadding="5" width="700" height="80%" align="center" border="1" >
<tr><td colspan="4" align="right"><form method="POST" action="/soapservice_sbi5633_twl.php" name="sendform" target="_blank"><input type="hidden" name="custid"id="custid"  value="<?php echo $requestid; ?>"><input type="Submit" name="Submitd" value="Send now" style="color:#FFF; background-color:#C00;"></form></td></tr>
  <tr><td colspan="4">&nbsp;</td></tr>
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