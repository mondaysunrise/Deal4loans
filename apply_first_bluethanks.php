<?php
require 'scripts/db_init.php';
require 'scripts/functions.php';
require 'scripts/session_check.php';

$f_Name = $_REQUEST['Name'];
	$l_Name = $_REQUEST['l_Name'];
	$Name=$f_Name." ".$l_Name;
	$Phone = $_REQUEST['Phone'];
	$Email = $_REQUEST['Email'];
	$RequestID = $_REQUEST['RequestID'];
	$Pancard = strtoupper ($_REQUEST['Pancard']);
	$residence_address = $_REQUEST['residence_address'];
	$office_address = $_REQUEST['office_address'];
	$Defaulted = $_REQUEST['Defaulted'];
	$Designation = strtoupper ($_REQUEST['Designation']);
	$declined = $_REQUEST['declined'];
	$Pincode = $_REQUEST['Pincode'];
	$home_std = $_REQUEST['home_std'];
	$home_phone = $_REQUEST['home_phone'];
	$office_std = $_REQUEST['office_std'];
	$office_phone = $_REQUEST['office_phone'];
	$office_ext  = $_REQUEST['office_ext'];
	$home_telephone = $home_std."-".$home_phone;
	$office_telephone = $office_std."-".$office_phone."-".$office_ext;
	
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
	
	  $dataUpdate = array('firstblue_resi_telephone'=>$home_telephone, 'firstblue_office_telephone'=>$office_telephone, 'firstblue_pincode'=>$Pincode, 'firstblue_resi_address1'=>$residence_address, 'firstblue_pancard'=>$Pancard, 'firstblue_resi_address2'=>$office_address, 'firstblue_name'=>$Name, 'firstblue_defaultd'=>$Defaulted, 'firstblue_declined'=>$declined, 'firstblue_designation'=>$Designation);
	  $wherecondition = "(firstblueID=".$RequestID.")";
		Mainupdatefunc ('first_blue_leads', $dataUpdate, $wherecondition);

$sql = "select firstblue_appid from first_blue_leads where firstblueID='".$RequestID."'";
list($alreadyExist,$query)=MainselectfuncNew($sql,$array = array());
$querycontr=count($query)-1;
$AppID = $query[$querycontr]['firstblue_appid'];

$dataSql = "select * from first_blue_leads where firstblueID = ".$RequestID."";
list($alreadyExist,$dataQuery)=MainselectfuncNew($dataSql,$array = array());
$dataQuerycontr=count($dataQuery)-1;
$company_name = $dataQuery[$dataQuerycontr]['firstblue_company_name'];
$firstblue_city = $dataQuery[$dataQuerycontr]['firstblue_city'];
$firstblue_loanamt = $dataQuery[$dataQuerycontr]['firstblue_loanamt'];
$firstblue_roi = $dataQuery[$dataQuerycontr]['firstblue_roi'];
$firstblue_emi = $dataQuery[$dataQuerycontr]['firstblue_emi'];
$firstblue_tenure = $dataQuery[$dataQuerycontr]['firstblue_tenure'];

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
<style>
.frst_cl {
	color:#663300; 
	font-family:Verdana, Arial, Helvetica, sans-serif; 
	font-size:12px;
}
.btnclr {
background-color:#006EAB;
border:medium none;
color:#FFFFFF;
font-family:Verdana,Arial,Helvetica,sans-serif;
font-size:12px;
font-weight:bold;
height:25px;
width:120px;
}
</style>
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
</head>

<body>
<table width="990" align="center">
	<tr>
		<td  colspan="2" width="100%"><table width="100%" style="padding-left:5px; padding-top:5px;"><tr>
		<td width="197" height="117"><img src="new-images/first_blue_logo.jpg" width="188" height="117"/></td>
		<td  align="center" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:26px; font-weight:450;"><table width="641" bgcolor="#EFEFE0" height="94" cellpadding="0" cellspacing="0" style="border:#000000 solid 1px;">
						<tr><td colspan="4" bgcolor="#CC541F" align="center" height="30" class="verdred13" style="color:#FFFFFF; font-size:14px; border-bottom:#D2CECC solid 1px; ">First Blue Home Loan Quote</td></tr>
						<tr><td width="173" align="center" class="frmtxt" style="color:#CC541F; border-right:#D2CECC solid 1px; border-bottom:#D2CECC solid 1px; font-size:13px;" bgcolor="#EFEFE0">Max Loan Amount</td>
						<td width="184" align="center" class="frmtxt" style="color:#CC541F; border-right:#D2CECC solid 1px; border-bottom:#D2CECC solid 1px; font-size:13px;" bgcolor="#EFEFE0">Interest Rate</td>
						<td width="129" align="center" class="frmtxt" style="color:#CC541F; border-right:#D2CECC solid 1px; border-bottom:#D2CECC solid 1px; font-size:13px;" bgcolor="#EFEFE0">Per Month EMI</td>
						<td width="87" align="center" class="frmtxt" style="color:#CC541F; border-bottom:#D2CECC solid 1px; font-size:13px;" bgcolor="#EFEFE0">Tenure</td>
						</tr>
						<tr>
						  <td style="border-right:#D2CECC solid 1px; font-weight:normal;" align="center" class="frst_cl"><? echo $firstblue_loanamt; ?></td>
						  <td style=" border-right:#D2CECC solid 1px; font-weight:normal;" align="center" class="frst_cl"><? echo $firstblue_roi; ?>&nbsp;<br><span style="font-size:9px;">(Monthly Reducing)</span></td><td style=" border-right:#D2CECC solid 1px; font-weight:normal;" align="center"class="frst_cl"><? echo $firstblue_emi; ?></td><td style="font-weight:normal;" align="center" class="frst_cl"><? echo $firstblue_tenure; ?>&nbsp;<span style="font-size:9px;">(yrs)</span></td></tr>
					  </table></td></tr></table></td>
	</tr></table></td>
	</tr>
	<tr>
		<td colspan="2" valign="top" align="center"> 
			<table style="border:#666666 solid 1px;" align="center">
 <tr>
        <td>&nbsp;</td>

      </tr>
      <tr>
        <td bgcolor="#FFFFFF">
<table align="center" border="0" cellpadding="0" cellspacing="0" width="96%">
          <tr>
           
            <td width="817" valign="top"><table border="0" cellpadding="0" cellspacing="0" width="837" align="center">
              <tr>
                <td height="30" bgcolor="#F08600"><table width="100%"><tr><td height="30" align="center" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:13px; color:#FFFFFF;" width="81%"><b>First Blue Home Loan Application</b></td>
                <td width="19%" height="30" align="center" class="frst_cl"> </td>
                </tr></table></td>
              </tr>
              <tr>
			 		   
                           <td width="837" height="286" valign="top"  align="center" bgcolor="#F8C301">
	<table align="center" border="0" cellpadding="0" cellspacing="0" width="96%">
         <tr><td class="frst_cl" align="Center" style="padding-top: 10px;">
    			  <p><b>Your Application No. <?php echo $AppID; ?> is under process. Will contact you shortly for next steps.</b></p>
		 <?php
  if((strlen($Income_Proof)>0) || (strlen($Address_Proof)>0) || (strlen($Identity_Proof)>0) || (strlen($Bank_Statement)>0))
  {
  ?>
       
        		 <p ><b>To make your Loan processing fast please upload the documents.</b></p>
          <?php
		  }
		 else
		 {
		 ?>
		 <p>&nbsp;</p>
         <?php
		 } 
		  ?>		  
     </td></tr>
     <tr><td>
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
<form id="uploadform_1" method="post" enctype="multipart/form-data" action="uploadblue_1.php">
<input type="hidden" name="RequestID" value="<?php echo $RequestID; ?>" />
<input type="hidden" name="Doc_Name" value="<?php echo $Income_Proof; ?>" />
<input type="file" name="file" id="file" />&nbsp;&nbsp;<input type="submit" name="action" value="Upload" onClick="initUpload_1();" /> <span id="status_1" style="display:none">uploading...</span><iframe id="target_iframe_1" name="target_iframe_1" src="" style="width:0;height:0;border:0px"></iframe>
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
<form id="uploadform_2" method="post" enctype="multipart/form-data" action="uploadblue_2.php">
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
<form id="uploadform_3" method="post" enctype="multipart/form-data" action="uploadblue_3.php">
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
<form id="uploadform_4" method="post" enctype="multipart/form-data" action="uploadblue_4.php">
<input type="hidden" name="RequestID" value="<?php echo $RequestID; ?>" />
<input type="hidden" name="Doc_Name" value="<?php echo $Bank_Statement; ?>" />

<input type="file" name="file" id="file" />&nbsp; &nbsp;<input type="submit" name="action" value="Upload" onClick="initUpload_4();" /> <span id="status_4" style="display:none">uploading...</span><iframe id="target_iframe_4" name="target_iframe_4" src="" style="width:0;height:0;border:0px"></iframe>
</form>


</td>
  </tr> 
  <?php
}
?></table>
                
                <form action="icici-carloanthanks.php"  method="post" name="ccform"  onSubmit="return submitform(document.ccform);"  enctype="multipart/form-data" >
                <input type="hidden" name="RequestID" value="<?php echo $userid ; ?>" />
								<input style="width:180px; height:21px;" type="hidden" name="company_name2" id="company_name2" value="<?php echo $company_name; ?>" readonly />
				</form>
				
				</td>
              </tr>
              <tr>
                <td colspan="2">&nbsp;</td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
     
	  </table>
		</td>
	</tr>
</table>
</body>
</html>
