<? 
require 'scripts/db_init.php';
require 'scripts/functions.php';
	
	$last_inserted_id = $_POST['last_inserted_id'];
	$RequestID = $last_inserted_id;
	$pay = $_POST['pay'];
	$tot_amount = $_POST['tot_amount'];;
	$tot_interest = $_POST['tot_interest'];;

	$Car_Model = $_POST['Car_Model'];
	$Income_Proof = $_REQUEST['Income_Proof'];
	$Address_Proof = $_REQUEST['Address_Proof'];
	$Identity_Proof = $_REQUEST['Identity_Proof'];
	$Bank_Statement = $_REQUEST['Bank_Statement'];
	
	$getDataSql = "Select * from hdfc_car_loan_leads where RequestID = '".$last_inserted_id."'";
	list($getDatanumRewards,$getDataQuery)=MainselectfuncNew($getDataSql,$array = array());	
	$Car_Model = $getDataQuery[0]['Car_Model'];
	
		
	$dataUpdate = array('income_proof'=>$Income_Proof, 'address_proof'=>$Address_Proof, 'identify_proof'=>$Identity_Proof, 'bank_statement'=>$Bank_Statement);
	$wherecondition ="(RequestID = '".$last_inserted_id."')";
	Mainupdatefunc ('hdfc_car_loan_leads', $dataUpdate, $wherecondition);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>HDFC BANK | Deal4loans</title>
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
<link href='http://fonts.googleapis.com/css?family=Carrois+Gothic' rel='stylesheet' type='text/css'>
<style type="text/css"> 
<!-- 
body  {
	font: 100% Verdana, Arial, Helvetica, sans-serif;
	margin: 0;
	padding: 0;
	text-align: center; 
	color: #000000;
}
.twoColLiqRtHdr #container { 
	width: 90%;  
	background: #FFFFFF;
	margin: 0 auto; 
	border: 1px solid #000000;
	text-align: left; 
} 
.twoColLiqRtHdr #header { 
	background: #DDDDDD; 
	padding: 0 10px;
} 
.twoColLiqRtHdr #header h1 {
	margin: 0; 
	padding: 10px 0;
}
.twoColLiqRtHdr #sidebar1 {
	float: right; 
	width: 30%; 
	padding-top: 15px; 
	padding-left: 15px; 
}
.twoColLiqRtHdr #sidebar1 h3, .twoColLiqRtHdr #sidebar1 p {
	margin-left: 10px; 
	margin-right: 10px;
}
.twoColLiqRtHdr #mainContent { 
	margin: 0 0 0 10px;
	width:610px;
} 

.twoColLiqRtHdr #footer { 
	padding:10px; 
	background:#DDDDDD; 
} 
.twoColLiqRtHdr #footer p {
	margin: 0; 
	padding: 10px 0; 
}
.fltrt { 
	float: right;
	margin-left: 8px;
}
.fltlft {
	float: left;
	margin-right: 8px;
}
.clearfloat {
	clear:both;
    height:0;
    font-size: 1px;
    line-height: 0px;
}
.text8 {
	font-family: 'Carrois Gothic', serif;
	font-size: 13px;
	font-weight: bold;
	font-variant: normal;
	text-decoration: none;
	@import url(http://fonts.googleapis.com/css?family=Carrois+Gothic);
}

.text9 {
	font-family: 'Carrois Gothic', serif;
	font-size: 20px;
	font-weight: bold;
	font-variant: normal;
	text-decoration: none;
	@import url(http://fonts.googleapis.com/css?family=Carrois+Gothic);
}
.inputtext
{
	-moz-border-radius: 10px;
	border-radius: 10px;
    border:solid 1px #e6e6e6;
    padding:5px;
	background-color:#e6e6e6; 
	height:20px;
}
.design2{
background-color:#ff1552;
border:1px solid #ff1552;
padding:5px;
-webkit-border-radius:10px;
-moz-border-radius:10px;
width:150px;
text-align:left;
height:37px;
font-size:15px;
color:#FFFFFF;
font-family: 'Carrois Gothic', serif;
@import url(http://fonts.googleapis.com/css?family=Carrois+Gothic);
font-weight:bolder;
}

#emi_sum { background: none repeat scroll 0pt 0pt #fcfcfc; clear: both; float: left; width: 200px; margin: 0pt 0px 0px 0pt;  height: 195px; }
#emi_sum div { margin: 0pt 0pt 0px; padding: 10px 0px 0pt; text-align: center; width: 200px; border-top: 1px dotted rgb(147, 79, 79); }
#emi_sum h4 { color: #934f4f; font-weight: bold; }
#emi_sum p { font-size: 18px; font-weight: bold; margin: 0pt auto; }
#emi_sum span { padding-left: 5px; }

#emiamount { border-top: 0pt none ! important; }
#emiamount p { font-size: 24px; }
.showintr  { margin: 0; padding: 0; border: 0; outline: 0; font: 13px Arial, Helvetica, sans-serif;    color: #00000;}
input{	margin:0px;	padding:0px;	border:1px solid #878787;}
--> 
</style><!--[if IE]>
<style type="text/css"> 
/* place css fixes for all versions of IE in this conditional comment */
.twoColLiqRtHdr #sidebar1 { padding-top: 30px; }
.twoColLiqRtHdr #mainContent { zoom: 1; padding-top: 15px; }
/* the above proprietary zoom property gives IE the hasLayout it needs to avoid several bugs */
</style>
<![endif]-->

<style>	
.design21 {background-color:#ff1552;
border:1px solid #ff1552;
padding:5px;
-webkit-border-radius:10px;
-moz-border-radius:10px;
width:150px;
text-align:left;
height:37px;
font-size:15px;
color:#FFFFFF;
font-family: 'Carrois Gothic', serif;
@import url(http://fonts.googleapis.com/css?family=Carrois+Gothic);
font-weight:bolder;
}
.inputtext1 {	-moz-border-radius: 10px;
	border-radius: 10px;
    border:solid 1px #e6e6e6;
    padding:5px;
	background-color:#e6e6e6; 
	height:20px;
}
#dhtmlgoodies_tooltipShadow{		position:absolute;		background-color:#555;		display:none;		margin-left:-13px;		z-index:10000;		opacity:0.7;		filter:alpha(opacity=70);		-khtml-opacity: 0.7;		-moz-opacity: 0.7;	} 
.frmtxt {
    color: #332D33;
    font-family: Verdana,Arial,Helvetica,sans-serif;
    font-size: 11px;
    font-weight: bold;
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
</head>
<body class="twoColLiqRtHdr">
<div id="container">
  <div id="header" >
    <div align="left" style="height:45px; padding-top:6px;"><img src="new-images/hdfc_cl_logo.gif" width="184" height="34" border="0"/></div>
  <!-- end #header --></div>
  <div id="sidebar1" style="padding-top:30px;">
  <table cellpadding="0" cellspacing="0" border="0"   class="inputtext" style="width:230px; height:220px; ">
<tr><td class="text9" style="color:#4c4c4c; size:18px; height:37px; padding-left:70px;"  ><span >Results</span></td></tr>
  <tr><td valign="top" align="center" style="padding-left:9px; background-color:#e6e6e6;">
  <div id="emipaymentdetails" style="background-color:#e6e6e6;" class="showintr" >
	<div  id="emi_sum" style="background-color:#e6e6e6;" class="showintr">
		<div id="emiamount" style="background-color:#e6e6e6;" class="showintr">
		  <h4 class="showintr">Monthly Instalment (EMI)</h4>
		  <p style="font-size:12px;" class="showintr">Rs. <span><?php echo number_format(round($pay)); ?></span></p>
		  <p style="font-size:12px;" class="showintr">&nbsp;</p>
		</div>
        <div id="emitotalinterest" class="showintr" style="background-color:#e6e6e6;"><h4 class="showintr">Total Interest Amount</h4><p style="font-size:12px;" class="showintr">Rs. <span><?php echo number_format(round($tot_interest)); ?></span></p>
          <p style="font-size:12px;" class="showintr">&nbsp;</p>
        </div>
        <div id="emitotalamount" class="showintr" style="background-color:#e6e6e6;"><h4 class="showintr">Total Amount<br/>(Principal + Interest)</h4><p style="font-size:12px;" class="showintr">Rs. <span><?php echo number_format(round($tot_amount)); ?></span></p></div>
    </div>

</div>

  </td></tr>
  
  </table>
  
  </div>
  <div id="mainContent" style="padding-top:6px; padding-bottom:60px; " >
  <table cellpadding="0" cellspacing="0" border="0">
   
    <tr >
      <td class="text8" ><table width="325" border="0" >
          <tr>
            <td width="325" class="text8">&nbsp;</td>
          </tr>
        <tr>
            <td width="375" class="text9" colspan="2" style="padding-left:5px; padding-bottom:4px;"><div style=" color:#333333; padding-bottom:4px;border-bottom:#000000 0px solid;width:585px;"><span  >
            Thank You for registering with us.</span></div>
            </td>
        </tr>
      </table></td>
      <td>&nbsp;</td>
    </tr>
    <tr >
      <td style="font-family:Arial, Helvetica, sans-serif; font-size:13px; height:15px;" >&nbsp;</td>
    </tr>
   
    <tr >
      <td class="text8" colspan="2" style="color:#000099; font-family: Arial, Helvetica, sans-serif; font-size:17px; font-weight:bold; color:#802891; border:#0000FF 1px solid;">
   <table width="95%"  border="0" align="center" cellpadding="4" cellspacing="4"  >
   <?php
    if((strlen($Income_Proof)>0) || (strlen($Address_Proof)>0) || (strlen($Identity_Proof)>0) || (strlen($Bank_Statement)>0) )
  {     
  ?>     
<tr>
	<td height="26" align="left" valign="top" class="frmtxt" colspan="4">To make your Loan processing fast please upload the documents.</td>
  </tr>
  <?php
  } 
  if(strlen($Income_Proof)>0)
  {
  ?>
  <tr>
	<td width="218" height="26" align="left" valign="top" class="frmtxt">Proof of Income
    <br />
<span style="font-weight:normal;">    <?php 
	echo stripslashes($Income_Proof); 
	?></span></td>
<td width="315"  colspan="2" align="left" valign="top" class="frmtxt">
<form id="uploadform_1" method="post" enctype="multipart/form-data" action="uploadhdfccl1.php">
<input type="hidden" name="RequestID" value="<?php echo $RequestID; ?>" />
<input type="hidden" name="Doc_Name" value="<?php echo $Income_Proof; ?>" />
<input type="file" name="file" id="file" />&nbsp; &nbsp;<input type="submit" name="action" value="Upload" onclick="initUpload_1();" /> <span id="status_1" style="display:none">uploading...</span><iframe id="target_iframe_1" name="target_iframe_1" src="" style="width:0;height:0;border:0px"></iframe>
</form>
</td>
</tr>
<?php
}
 if(strlen($Address_Proof)>0)
  {
?>

  <tr>
	<td height="26" align="left" valign="top" class="frmtxt">Proof of Address    <br />
<span style="font-weight:normal;">
        <?php 
	echo stripslashes($Address_Proof); 
	?></span>
   </td>
<td colspan="2" align="left" valign="top" class="frmtxt">
<form id="uploadform_2" method="post" enctype="multipart/form-data" action="uploadhdfccl2.php">
<input type="hidden" name="RequestID" value="<?php echo $RequestID; ?>" />
<input type="hidden" name="Doc_Name" value="<?php echo $Address_Proof; ?>" />
<input type="file" name="file" id="file" />&nbsp; &nbsp;<input type="submit" name="action" value="Upload" onclick="initUpload_2();" /> <span id="status_2" style="display:none">uploading...</span><iframe id="target_iframe_2" name="target_iframe_2" src="" style="width:0;height:0;border:0px"></iframe>
</form>

</td>
  </tr>
  <?php
}
 if(strlen($Identity_Proof)>0)
  {
?>
   <tr>
	<td height="26" align="left" valign="top" class="frmtxt">Proof of Identity    <br />
<span style="font-weight:normal;">
      <?php 
	echo stripslashes($Identity_Proof); 
	?></span>
    </td>
<td colspan="2" align="left" valign="top" class="frmtxt">   
<form id="uploadform_3" method="post" enctype="multipart/form-data" action="uploadhdfccl3.php">
<input type="hidden" name="RequestID" value="<?php echo $RequestID; ?>" />
<input type="hidden" name="Doc_Name" value="<?php echo $Identity_Proof; ?>" />
<input type="file" name="file" id="file" />&nbsp; &nbsp;<input type="submit" name="action" value="Upload" onclick="initUpload_3();" /> <span id="status_3" style="display:none">uploading...</span><iframe id="target_iframe_3" name="target_iframe_3" src="" style="width:0;height:0;border:0px"></iframe>
</form>


</td>
  </tr>
  <?php
}
 if(strlen($Bank_Statement)>0)
  {
?>
   <tr>
	<td height="26" align="left" valign="top" class="frmtxt">Bank Statement    <br />
<span style="font-weight:normal;">
      <?php 
	echo stripslashes($Bank_Statement); 
	?></span>
    
</td>
<td colspan="2" align="left" valign="top" class="frmtxt"> 
<form id="uploadform_4" method="post" enctype="multipart/form-data" action="uploadhdfccl4.php">
<input type="hidden" name="RequestID" value="<?php echo $RequestID; ?>" />
<input type="hidden" name="Doc_Name" value="<?php echo $Bank_Statement; ?>" />

<input type="file" name="file" id="file" />&nbsp; &nbsp;<input type="submit" name="action" value="Upload" onclick="initUpload_4();" /> <span id="status_4" style="display:none">uploading...</span><iframe id="target_iframe_4" name="target_iframe_4" src="" style="width:0;height:0;border:0px"></iframe>
</form>


</td>
  </tr> 

<?php
}
?>
  
</table>   
      
      </td>
    </tr>
    
<tr >	<td style="font-family:Arial, Helvetica, sans-serif; font-size:13px; height:85px;" >&nbsp;</td></tr>

  </table>

</div>
<br class="clearfloat" />
<div id="footer">
</div>
</div>
</body>
</html>