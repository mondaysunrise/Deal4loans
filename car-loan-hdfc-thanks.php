<?php
require 'scripts/db_init.php';
require 'scripts/functions.php';
require 'eligible1825.php';
//print_r($_REQUEST);
//echo "<br>";
	$last_inserted_id = $_POST['last_inserted_id'];
	$final_emiPerLac = $_POST['final_emiPerLac'];
	$Loan_Amt = $_POST['Loan_Amt'];
	$Tenure = $_POST['Tenure'];
	$roi = $_POST['roi'];
	$RequestID = $last_inserted_id;
	$Pancard = $_POST['Pancard'];
	$residence_address = $_POST['residence_address'];
	$residence1_address = $_POST['residence1_address'];
	$residence = $residence_address.", ".$residence1_address;
	$pincode = $_POST['pincode'];
	$home_phone_std = $_POST['home_phone_std'];
	$home_phone = $_POST['home_phone'];
	$promotional = $_REQUEST['promotion_code'];
	$car_name = $_POST['car_name'];
	
	$Company_Name = $_POST['Company_Name'];
	$Primary_Acc = $_POST['Primary_Acc'];
	$CC_Holder = $_POST['CC_Holder'];
	$off_address = $_POST['off_address'];
	$off1_address = $_POST['off1_address'];
	$office = $off_address.", ".$off1_address;
	$pincode_o = $_POST['pincode_o'];
	$office_std = $_POST['office_std'];
	$office_phone = $_POST['office_phone'];
	$office_ext = $_POST['office_ext'];
	$Car_Model = $_POST['Car_Model'];
	$Income_Proof = $_REQUEST['Income_Proof'];
	$Address_Proof = $_REQUEST['Address_Proof'];
 	$Identity_Proof = $_REQUEST['Identity_Proof'];
	$Bank_Statement = $_REQUEST['Bank_Statement'];
	
	$dataUpdate = array('Pancard'=>$Pancard, 'Residence_Address'=>$residence, 'Residence_Pincode'=>$pincode, 'Resi_Std'=>$home_phone_std, 'Resi_Telephone'=>$home_phone, 'CC_Holder'=>$CC_Holder, 'Off_Landline'=>$office_phone, 'office_std'=>$office_std, 'Off_Address'=>$office, 'off_pincode'=>$pincode_o, 'office_ext'=>$office_ext, 'income_proof'=>$Income_Proof, 'address_proof'=>$Address_Proof, 'identify_proof'=>$Identity_Proof, 'bank_statement'=>$Bank_Statement, 'promotional'=>$promotional, 'Primary_Acc'=>$Primary_Acc);
	$wherecondition = "(RequestID = '".$last_inserted_id."')";
	Mainupdatefunc ('hdfc_car_loan_leads', $dataUpdate, $wherecondition);
//	echo $updateSql;
	
$getCarSql = "select hdfc_car_manufacturer,hdfc_car_name ,hdfc_car_price , hdfc_car_price_delhi  from hdfc_car_list_category where hdfc_car_name = '".$car_name."'";
list($getCarNumRows,$getCarQuery)=MainselectfuncNew($getCarSql,$array = array());
$hdfc_car_name = $getCarQuery[0]['hdfc_car_name'];
$hdfc_car_price = $getCarQuery[0]['hdfc_car_price'];
if($hdfc_car_price=='delhi')
{
	$hdfc_car_price = $getCarQuery[0]['hdfc_car_price_delhi'];
}

$model = $_REQUEST['model'];
if($model=="land"){	$model = "landrover"; }

$getCitySql = "select * from hdfc_car_loan_leads where RequestID='".$last_inserted_id."'";
list($getCityNR, $getCityQuery)=MainselectfuncNew($getCitySql, $array = array());
$strProduct=3;
$strRequestID = $last_inserted_id;
$strCity = $getCityQuery[0]['City'];
//list($FinalBidder,$finalBidderName) = getBiddersList($strProduct,$strRequestID,$strCity);

if((count($FinalBidder)>10) && (strlen($FinalBidder[0])>0) )
{
	//echo "Insert to database";
	$Name = $getCityQuery[0]['Name'];
	$Mobile_Number = $getCityQuery[0]['Mobile_Number'];
	$Email = $getCityQuery[0]['Email'];
	$DOB = $getCityQuery[0]['DOB'];
	$Pancard = $getCityQuery[0]['Pancard'];
	$Residence_Address = $getCityQuery[0]['Residence_Address'];
	$Employment_Status = $getCityQuery[0]['Employment_Status'];
	$Net_Salary = $getCityQuery[0]['Net_Salary'];	
	$Company_Name = $getCityQuery[0]['Company_Name'];
	$Primary_Acc = $getCityQuery[0]['Primary_Acc'];
	$Residence_Status = $getCityQuery[0]['Residence_Status'];
	$Total_Experience = $getCityQuery[0]['Total_Experience'];
	$CC_Holder = $getCityQuery[0]['CC_Holder'];
	$Dated = $getCityQuery[0]['Dated'];
	$IP_Address = $getCityQuery[0]['IP'];
	$Loan_Amount = $getCityQuery[0]['Loan_Amount'];	
	$source = "HDFCApp";	
	$Car_Type=1;
	$Bidderid_Details =implode(",", $FinalBidder);
	$Bidder_Count = count($FinalBidder);
	$Allocated = 1;
}


?>
<!DOCTYPE html>
<html >
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="images/car_hdfc/maruti_css.css" type="text/css" rel="stylesheet" />
<title>Deal4loans</title>
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
<link href="css/hdfccl-style.css" rel="stylesheet" type="text/css" />
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
<script language="javascript">

function onBlurDefault(element,defaultVal){
	if(element.value==""){
		element.value = defaultVal;
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

function Trim(strValue) {
var j=strValue.length-1;i=0;
while(strValue.charAt(i++)==' ');
while(strValue.charAt(j--)==' ');
return strValue.substr(--i,++j-i+1);
}

function initUpload_1() {
	document.getElementById('uploadform_1').onsubmit=function() {
	document.getElementById('uploadform_1').target = 'target_iframe_1';
		document.getElementById('status_1').style.display="block"; 
	}
}

function uploadComplete_1(status){
   document.getElementById('status_1').innerHTML=status;
}

function initUpload_2() {
	document.getElementById('uploadform_2').onsubmit=function() {
	document.getElementById('uploadform_2').target = 'target_iframe_2';
    document.getElementById('status_2').style.display="block"; 
	}
}

function uploadComplete_2(status){
   document.getElementById('status_2').innerHTML=status;
}

function initUpload_3() {
	document.getElementById('uploadform_3').onsubmit=function() {
	document.getElementById('uploadform_3').target = 'target_iframe_3';
    document.getElementById('status_3').style.display="block"; 
	}
}

function uploadComplete_3(status){
   document.getElementById('status_3').innerHTML=status;
}

function initUpload_4() {
	document.getElementById('uploadform_4').onsubmit=function() {
	document.getElementById('uploadform_4').target = 'target_iframe_4';
    document.getElementById('status_4').style.display="block"; 
	}
}

function uploadComplete_4(status){
   document.getElementById('status_4').innerHTML=status;
}



</script>

<style>
.rightboxspecification{ width:100%; padding:0px 2px 0px 2px;  margin:auto; border:#e4ddf9 solid thin; background: #FFFFFF; height:auto;} 
.thanks_box{ width:970px; height:50px; border: thin solid #00CC00; padding:20px 0px 0px 10px;}
.lining{ width:980px; height:2px; margin-top:2px;  background:#00CC00;}
.thanks_heading_text{ font-family:Arial, Helvetica, sans-serif; font-size:20px; font-weight:bold; color:#08b04f;  }
.thanks_sub-heading_text{ font-family:Arial, Helvetica, sans-serif; font-size:16px; font-weight:bold; color:#777e7a;  }
.thanks_sub-heading_text_A{ font-family:Arial, Helvetica, sans-serif; font-size:16px; font-weight:bold; color: #333333;  }
.thanks_sub-heading_text_B{ font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:normal; color: #666666;  }
.form-box{ width:960px; padding:10px; background:#e8f4f9;}
</style>
</head>
<body style="padding-left:10px;">
<div class="main-wrapper">
<div align="left" style="padding-left:5px;"><img src="images/newimages/eligibility-check-hdfc-logo.jpg" border="0" height="85" width="193"></div>
<div style="float:right; width:800px; margin-top:-55px;"><div style="vertical-align:bottom;  padding-left:5px;" ><span class="<?php echo $model; ?>-heading_A" style="font-size:20px;">HDFC Bank offers you complete package of <span class="<?php echo $model; ?>-heading_B" style="font-size:20px;">timely service</span>,</span>
  <span style="color:#CCCCCC">  
  <h1 class="<?php echo $model; ?>-heading_B" style="font-size:20px;">Competitive rates &amp; Competent guidance <span class="<?php echo $model; ?>-heading_A" style="font-size:20px;">along with 100% finance on select models.  </span></h1>
  </span></div></div>
<div style="clear:both; "></div>
<div class="thanks_box"><span class="thanks_heading_text">Thank you for applying for Car Loan with us. Our representative will contact you shortly. <br />
    <span class="thanks_sub-heading_text">Your application reference number: <?php
	$getusersRefSql = "select  AppID from hdfc_car_loan_leads where RequestID='".$last_inserted_id."'";
	list($getusersRefNumRows,$getusersRefQuery)=MainselectfuncNew($getusersRefSql,$array = array());

echo	$AppID = $getusersRefQuery[0]['AppID'];
	
	?>.</span></span></div>
    <div class="lining"></div>
    <div class="form-box" style="margin-top:10px;">

    <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
   <?php
    if((strlen($Income_Proof)>0) || (strlen($Address_Proof)>0) || (strlen($Identity_Proof)>0) || (strlen($Bank_Statement)>0) )
  {     
  ?>     
<tr>
          <td colspan="3"><span class="thanks_sub-heading_text_A">To make your Loan processing fast please upload the documents.</span></td>
  </tr>
   <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
       
        </tr>

  <?php
  } 
  if(strlen($Income_Proof)>0)
  {
  ?>
  <tr>
	<td width="24%" valign="top"><span class="thanks_sub-heading_text_A">Proof of Income
   </span><br />
            <span class="thanks_sub-heading_text_B">    <?php 
	echo stripslashes($Income_Proof); 
	?></span></td>
<td  align="left" valign="middle" width="70%">
<form id="uploadform_1" method="post" enctype="multipart/form-data" action="uploadhdfccl1.php">
<input type="hidden" name="RequestID" value="<?php echo $RequestID; ?>" />
<input type="hidden" name="Doc_Name" value="<?php echo $Income_Proof; ?>" />
<input type="file" name="file" id="file" />&nbsp; &nbsp;<input type="submit" name="action" value="Upload" onClick="initUpload_1();" /> <span id="status_1" style="display:none">uploading...</span><iframe id="target_iframe_1" name="target_iframe_1" src="" style="width:0;height:0;border:0px"></iframe>
</form>
</td>
  <td width="6%">&nbsp;</td>
</tr>
 <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
       
        </tr>
       
<?php
}
if(strlen($Address_Proof)>0)
{
?>
<tr>
	<td width="24%" valign="top"><span class="thanks_sub-heading_text_A">Proof of Address    </span><br />
            <span class="thanks_sub-heading_text_B">  <?php 	echo stripslashes($Address_Proof); 	?></span>
   </td>
<td  align="left" valign="middle" width="70%">
<form id="uploadform_2" method="post" enctype="multipart/form-data" action="uploadhdfccl2.php">
<input type="hidden" name="RequestID" value="<?php echo $RequestID; ?>" />
<input type="hidden" name="Doc_Name" value="<?php echo $Address_Proof; ?>" />
<input type="file" name="file" id="file" />&nbsp; &nbsp;<input type="submit" name="action" value="Upload" onClick="initUpload_2();" /> <span id="status_2" style="display:none">uploading...</span><iframe id="target_iframe_2" name="target_iframe_2" src="" style="width:0;height:0;border:0px"></iframe>
</form>

</td>
  <td width="6%">&nbsp;</td>
  </tr>
 <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
       
        </tr>

  <?php
}
 if(strlen($Identity_Proof)>0)
  {
?>
   <tr>
	<td width="24%" valign="top"><span class="thanks_sub-heading_text_A">Proof of Identity   </span><br />
            <span class="thanks_sub-heading_text_B">
      <?php 
	echo stripslashes($Identity_Proof); 
	?></span>
    </td>
<td  align="left" valign="middle" width="70%">
<form id="uploadform_3" method="post" enctype="multipart/form-data" action="uploadhdfccl3.php">
<input type="hidden" name="RequestID" value="<?php echo $RequestID; ?>" />
<input type="hidden" name="Doc_Name" value="<?php echo $Identity_Proof; ?>" />
<input type="file" name="file" id="file" />&nbsp; &nbsp;<input type="submit" name="action" value="Upload" onClick="initUpload_3();" /> <span id="status_3" style="display:none">uploading...</span><iframe id="target_iframe_3" name="target_iframe_3" src="" style="width:0;height:0;border:0px"></iframe>
</form>


</td>
  <td width="6%">&nbsp;</td>
  </tr>
 <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
       
        </tr>
  <?php
}
if(strlen($Bank_Statement)>0)
{
?>
   <tr>
	<td width="24%"><span class="thanks_sub-heading_text_A">Bank Statement   </span><br />
            <span class="thanks_sub-heading_text_B">
      <?php 
	echo stripslashes($Bank_Statement); 
	?></span>
    
</td>
<td  align="left" valign="middle" width="70%">
<form id="uploadform_4" method="post" enctype="multipart/form-data" action="uploadhdfccl4.php">
<input type="hidden" name="RequestID" value="<?php echo $RequestID; ?>" />
<input type="hidden" name="Doc_Name" value="<?php echo $Bank_Statement; ?>" />

<input type="file" name="file" id="file" />&nbsp; &nbsp;<input type="submit" name="action" value="Upload" onClick="initUpload_4();" /> <span id="status_4" style="display:none">uploading...</span><iframe id="target_iframe_4" name="target_iframe_4" src="" style="width:0;height:0;border:0px"></iframe>
</form>
</td>
  <td width="6%">&nbsp;</td>
 </tr> 
 <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
       
        </tr>

<?php
}
?>
  
</table> 

</div>
</body>
</html>
