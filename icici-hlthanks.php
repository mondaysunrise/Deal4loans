<?php
require 'scripts/db_init.php';
require 'scripts/functions.php';
require 'scripts/session_check.php';

//print_r($_REQUEST);

	$Name = $_REQUEST['Name'];
	$Phone = $_REQUEST['Phone'];
	$Email = $_REQUEST['Email'];
	$RequestID = $_REQUEST['insertedID'];// home_loan_eligibility
	$Pancard = strtoupper ($_REQUEST['Pancard']);
	$residence_address = $_REQUEST['residence_address'];
	$office_address = $_REQUEST['office_address'];
	$Defaulted = $_REQUEST['Defaulted'];
	$Designation = strtoupper ($_REQUEST['Designation']);
	$declined = $_REQUEST['declined'];
	
	$Income_Proof = $_REQUEST['Income_Proof'];
	  $file_id_1='file_1';
	  $filename_1=$_FILES[$file_id_1]['name'];
	  $tmpfile_1=$_FILES[$file_id_1]['tmp_name'];
	  $filename_1 = $RequestID."_".$filename_1;
	
	$Address_Proof = $_REQUEST['Address_Proof'];
		  $file_id_2='file_2';
	  $filename_2=$_FILES[$file_id_2]['name'];
	  $tmpfile_2=$_FILES[$file_id_2]['tmp_name'];
	 $filename_2 = $RequestID."_".$filename_2;
	 
	$Identity_Proof = $_REQUEST['Identity_Proof'];
	  $file_id_3='file_3';
	  $filename_3=$_FILES[$file_id_3]['name'];
	  $tmpfile_3=$_FILES[$file_id_3]['tmp_name'];
	   $filename_3 = $RequestID."_".$filename_3;
	
	$Bank_Statement = $_REQUEST['Bank_Statement'];
	  $file_id_4='file_4';
	  $filename_4=$_FILES[$file_id_4]['name'];
	  $tmpfile_4=$_FILES[$file_id_4]['tmp_name'];
	   $filename_4 = $RequestID."_".$filename_4;
	
	$Pincode = $_REQUEST['Pincode'];
	$home_std = $_REQUEST['home_std'];
	$home_phone = $_REQUEST['home_phone'];
	$office_std = $_REQUEST['office_std'];
	$office_phone = $_REQUEST['office_phone'];
	$office_ext  = $_REQUEST['office_ext'];
	$home_telephone = $home_std."-".$home_phone;
	$office_telephone = $office_std."-".$office_phone."-".$office_ext;
	 $Dated = ExactServerdate();
	
	
	
//	, allocated_sms='0'

	$DataArray = array("resi_phone"=>$home_telephone, "off_phone"=>$office_telephone, "pincode"=>$Pincode, "resi_address"=>$residence_address, "pan_no"=>$Pancard, "office_address"=>$office_address, "Name"=>$Name, "Defaulted"=>$Defaulted, "declined"=>$declined, "Designation"=>$Designation);
	$wherecondition ="(AllRequestID=".$get_requestid." and Reply_Type=".$get_product.")";
	Mainupdatefunc ('home_loan_eligibility', $DataArray, $wherecondition);

$sql = "select AppID from home_loan_eligibility where id='".$RequestID."'";
list($recordcount,$getrow)=MainselectfuncNew($sql,$array = array());
$cntr=0;
$AppID = $getrow[$cntr]['AppID'];

$iciciactualemi = $_POST['iciciactualemi'];
$iciciprint_term = $_POST['iciciprint_term'];
$iciciinter = $_POST['iciciinter'];
$iciciviewLoanAmt = $_POST['iciciviewLoanAmt'];
?>
<html><head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>ICICI Bank Home Loan</title>
<link href="icici_car/style.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="scripts/common.js"></script>
<script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
<link type='text/css' href='css/contact.css' rel='stylesheet' media='screen' />
<script type="text/javascript" src="ajax.js"></script>
<script type="text/javascript" src="ajax-dynamic-pllist.js"></script>

<link href="style/new-bima.css" rel="stylesheet"  type="text/css" />
<link href="style/glowing.css" rel="stylesheet"  type="text/css" />
<link href="style/slider.css" rel="stylesheet" type="text/css" />
<link href="style/pl-hl.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/jquery-1.2.6.min.js"></script>
<script language="JavaScript" type="text/javascript" src="images/rollovers.js"></script>
<script type="text/javascript" src="js/jquery-ui-personalized-1.5.2.packed.js"></script>
<script type="text/javascript" src="js/sprinkle.js"></script>
<script type="text/javascript" src="/scripts/common.js"></script>
<script type="text/javascript" src="js/dropdowntabs.js"></script>
<!--<script type="text/javascript" src="js/jquery.js"></script>
 --><script type="text/javascript" src="js/easySlider1.5.js"></script>
 
<script language="javascript">
	
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
<link rel="stylesheet" href="home_style.css" type="text/css" />
<style type="text/css">
<!--
.style1 {font-weight: bold}
.style2 {font-weight: bold}
.style3 {font-weight: bold}
.style4 {font-weight: bold}
-->
</style>
</head><body>

<table align="center" border="0" cellpadding="0" cellspacing="0" width="886">
  <tbody><tr>
    <td background="icici_car/main_bg.gif"><table align="center" border="0" cellpadding="0" cellspacing="0" width="872">
      <tbody><tr>
       <td>
			<table>
				<tr>
					<td><img src="icici_car/top_logo1_small.jpg" height="104" width="285"></td>
					<td valign="bottom">
						<table width="575" bgcolor="#EFEFE0" height="94" cellpadding="0" cellspacing="0" style="border:#000000 solid 1px;">
						<tr>
						  <td colspan="4" bgcolor="#CC541F" align="center" class="verdred13" style="color:#FFFFFF; border-bottom:#D2CECC solid 1px; ">ICICI Bank Home Loan Quote</td>
						</tr>
						<tr><td width="173" align="center" bgcolor="#EFEFE0" style="color:#CC541F; border-right:#D2CECC solid 1px; border-bottom:#D2CECC solid 1px; font-size:13px;"><strong>Max Loan Amount</strong></td>
						<td width="184" align="center" bgcolor="#EFEFE0" style="color:#CC541F; border-right:#D2CECC solid 1px; border-bottom:#D2CECC solid 1px; font-size:13px;"><strong>Interest Rate</strong></td>
						<td width="129" align="center" bgcolor="#EFEFE0" style="color:#CC541F; border-right:#D2CECC solid 1px; border-bottom:#D2CECC solid 1px; font-size:13px;"><strong>Per Month EMI</strong></td>
						<td width="87" align="center" bgcolor="#EFEFE0" style="color:#CC541F; border-bottom:#D2CECC solid 1px; font-size:13px;"><strong>Tenure</strong></td>
						</tr>
						<tr>
						  <td style="border-right:#D2CECC solid 1px; font-weight:normal; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px;" align="center" >Rs. <? echo abs($iciciviewLoanAmt); ?></td>
						  <td style=" font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; border-right:#D2CECC solid 1px; font-weight:normal;  font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px;" align="center" ><? echo $iciciinter; ?>%&nbsp;<br><span style="font-size:9px;">(Monthly Reducing)</span></td><td style="color:#000000; border-right:#D2CECC solid 1px; font-weight:normal;  font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px;" align="center" >Rs. <? echo $iciciactualemi; ?></td><td style=" font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; font-weight:normal;" align="center" ><? echo $iciciprint_term; ?>&nbsp;<span style="font-size:9px;">(years)</span></td></tr>
					  </table></td></tr></table>
		</td>
      </tr>
         
      <tr>
        <td><img src="icici_car/body_top.gif" height="10" width="872"></td>
      </tr>
      <tr>
        <td background="icici_car/body_bg.gif"><table align="center" border="0" cellpadding="0" cellspacing="0" width="96%">
          <tbody><tr>
            <td align="center" valign="top" style="color:#000099; font-family: Arial, Helvetica, sans-serif; font-size:17px; font-weight:bold; color:#802891; padding:3px;">
               
	   <p>Your Application No. <?php echo $AppID; ?> is under process. Will contact you shortly for next steps.</p>
		 <?php
  if((strlen($Income_Proof)>0) || (strlen($Address_Proof)>0) || (strlen($Identity_Proof)>0) || (strlen($Bank_Statement)>0))
  {
  ?>
       
        		 <p>To make your Loan processing fast please upload the documents.</p>
          <?php
		  }
		 else
		 {
		 ?>
		 <p>&nbsp;</p>
         <?php
		 } 
		  ?>		  
        </td>
          </tr>
         
        <tr>		 
			<td width="837" height="286" valign="top" background="icici_car/bbg.jpg" align="center">
			<table width="95%"  border="0" align="center" cellpadding="4" cellspacing="4">
<tr>
	<td height="26" align="left" valign="top" class="frmtxt" colspan="4"></td>
  </tr>
  <?php
  if(strlen($Income_Proof)>0)
  {
  ?>
  <tr>
	<td width="142" height="26" align="left" valign="top" class="frmtxt"><strong>Proof of Income</strong></td>
	<td width="272" valign="top" class="frmtxt" >
      <span class="style4">
      <?php 
	echo $Income_Proof; 
	?>
      </span></td>
<td width="341"  colspan="2" align="left" valign="top">
<form id="uploadform_1" method="post" enctype="multipart/form-data" action="uploadhl_1.php">
<input type="hidden" name="RequestID" value="<?php echo $RequestID; ?>" />
<input type="hidden" name="Doc_Name" value="<?php echo $Income_Proof; ?>" />
<input type="file" name="file" id="file" />&nbsp; &nbsp;<input type="submit" name="action" value="Upload" onClick="initUpload_1();" /> <span id="status_1" style="display:none">uploading...</span><iframe id="target_iframe_1" name="target_iframe_1" src="" style="width:0;height:0;border:0px"></iframe>
</form>
</td>
</tr>
<?php
}
  if(strlen($Address_Proof)>0)
  {

?>
  <tr>
	<td height="26" align="left" valign="top" class="frmtxt"><strong>Proof of Address</strong></td>
    <td valign="top" class="frmtxt">
        <span class="style3">
        <?php 
	echo $Address_Proof; 
	?>
        </span>   </td>
<td colspan="2" align="left" valign="top" style="color:#FF0000; font-size:10px;">
<form id="uploadform_2" method="post" enctype="multipart/form-data" action="uploadhl_2.php">
<input type="hidden" name="RequestID" value="<?php echo $RequestID; ?>" />
<input type="hidden" name="Doc_Name" value="<?php echo $Address_Proof; ?>" />
<input type="file" name="file" id="file" />&nbsp; &nbsp;<input type="submit" name="action" value="Upload" onClick="initUpload_2();" /> <span id="status_2" style="display:none">uploading...</span><iframe id="target_iframe_2" name="target_iframe_2" src="" style="width:0;height:0;border:0px"></iframe>
</form>

</td>
  </tr>
  <?php
}
  if(strlen($Identity_Proof)>0)
  {

?>
   <tr>
	<td height="26" align="left" valign="top" class="frmtxt"><strong>Proof of Identity</strong></td>
	<td valign="top" class="frmtxt" >
      <span class="style2">
      <?php 
	echo $Identity_Proof; 
	?>
      </span>    </td>
<td colspan="2" align="left" valign="top" style="color:#FF0000; font-size:10px;">   
<form id="uploadform_3" method="post" enctype="multipart/form-data" action="uploadhl_3.php">
<input type="hidden" name="RequestID" value="<?php echo $RequestID; ?>" />
<input type="hidden" name="Doc_Name" value="<?php echo $Identity_Proof; ?>" />
<input type="file" name="file" id="file" />&nbsp; &nbsp;<input type="submit" name="action" value="Upload" onClick="initUpload_3();" /> <span id="status_3" style="display:none">uploading...</span><iframe id="target_iframe_3" name="target_iframe_3" src="" style="width:0;height:0;border:0px"></iframe>
</form>


</td>
  </tr>
  <?php
}
  if(strlen($Bank_Statement)>0)
  {

?>
   <tr>
	<td height="26" align="left" valign="top" class="frmtxt"><strong>Bank Statement</strong></td>
	<td valign="top" class="frmtxt">
      <span class="style2">
      <?php 
	echo $Bank_Statement; 
	?>
      </span></td>
<td colspan="2" align="left" valign="top"  style="color:#FF0000; font-size:10px;"> 
<form id="uploadform_4" method="post" enctype="multipart/form-data" action="uploadhl_4.php">
<input type="hidden" name="RequestID" value="<?php echo $RequestID; ?>" />
<input type="hidden" name="Doc_Name" value="<?php echo $Bank_Statement; ?>" />

<input type="file" name="file" id="file" />&nbsp; &nbsp;<input type="submit" name="action" value="Upload" onClick="initUpload_4();" /> <span id="status_4" style="display:none">uploading...</span><iframe id="target_iframe_4" name="target_iframe_4" src="" style="width:0;height:0;border:0px"></iframe>
</form>


</td>
  </tr> 
  <?php
}
?>
  
  <tr valign="bottom">

    <td colspan="4" align="center">&nbsp;</td>
  </tr>
</table>
	
				
				</td>
              </tr>
           <tr>
        <td height="35">&nbsp;</td>
      </tr>  
       <td height="35">&nbsp;</td>
      </tr>   <td height="35">&nbsp;</td>
      </tr>    
        </table></td>
      </tr>
     <tr>
        <td><img src="icici_car/body_btm.gif" height="10" width="872"></td>
      </tr>

    </tbody></table></td>
  </tr>
</tbody></table>
</body></html>