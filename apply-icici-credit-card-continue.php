<?php
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';

$cc_bankid= $_REQUEST["ccid"];
$ccuserid= $_REQUEST["req"];
$existing_rel = $_REQUEST["exstrl"];

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
	$exstrl_nw = $_POST["exstrl_nw"];
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Apply for Credit Card | Credit Card Application | Credit Cards Comparison Chart</title>
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
<meta name="description" content="Apply for Credit Cards online: Get facility to apply directly for credit cards in all banks. Online Credit Card application form to get information about credit card schemes from all credit cards provider banks located in major cities of India like Mumbai, Delhi, Gurgaon, Bangalore, Ahmedabad, Chennai, Hyderabad, Navi Mumbai, Kochi etc.">
<meta name="keywords" content="Credit Card Application, Apply Credit Cards, Compare Credit Cards in Mumbai Hyderabad Pune kolkata Delhi Noida Bangalore">
<script type="text/javascript" src="scripts/calendardateinput.js"></script>
<link href="style/new-bima.css" rel="stylesheet"  type="text/css" />
<link href="style/glowing.css" rel="stylesheet"  type="text/css" />
<link href="style/slider.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/dropdowntabs.js"></script>
<script type="text/javascript">
function initUploadsal() {

   /*set the target of the form to the iframe and display the status
      message on form submit.
  */
  
	document.getElementById('uploadformsal').onsubmit=function() {
	document.getElementById('uploadformsal').target = 'target_iframe';
    document.getElementById('status').style.display="block"; 

	}
}

function initUploadstat() {

   /*set the target of the form to the iframe and display the status
      message on form submit.
  */
  
	document.getElementById('uploadformstat').onsubmit=function() {
	document.getElementById('uploadformstat').target = 'target_iframes';
    document.getElementById('statusstat').style.display="block"; 

	}
}

//This function will be called when the upload completes.
function uploadComplete(status){
   //set the status message to that returned by the server
   document.getElementById('status').innerHTML=status;
}

function uploadCompletestat(status){
   //set the status message to that returned by the server
   document.getElementById('statusstat').innerHTML=status;
}

</script>
</head>
<body>

<div id="dvtpbg">
<div id="logo">
<img onclick="javascript:location.href='http://www.deal4loans.com/'" alt="Deal4loans" src="/new-images/d4l-logo.gif"/>
</div>
</div>
<div id="container">
   <div id="txt" style="padding-top:15px;">
 
 <h1 style="color:#ae4212 !important; margin:0px; padding:0px; font-size:14px !important; line-height:22px; text-align:center;"> Thank you for applying for ICICI Credit Card through Deal4Loans.com. An ICICI bank representative will call you within 24 Hours </h1><br />
  <div style="clear:both;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td valign="top" class="crdtext">
		
	
        
        
		  <? if($exstrl_nw >0)
		  { }
		  else
		  { ?>
		  <table width="100%"  border="0" cellspacing="0" cellpadding="0">
		  <tr>
          <td height="35" valign="middle"   class="crdhorizonbg"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td colspan="2" ><?	if($cc_bankid==23)
				{ ?>
			ICICI Bank HPCL Platinum Credit Card
			<? 	}
				else if ($cc_bankid==24)
		{ ?>
			ICICI Bank HPCL Titanium Credit Card
	<? } 
	else if ($cc_bankid==25)
	{ ?>
		ICICI Bank Coral Credit Card
 	<? } 
	else if ($cc_bankid==26)
	{ ?>
		ICICI Bank Rubyx Credit Cards
 	<? } 
	else if ($cc_bankid==27)
	{ ?>
		ICICI Bank Sapphiro Credit Cards
 	<? } 
	?></td>
                </tr>
          </table></td>
        </tr>
		  <tr>
          <td class="yelobordr">
		  <table width="98%"  border="0" align="center" cellpadding="0" cellspacing="0">
              <tr>
                <td width="185" align="center" valign="middle">
			<?	if($cc_bankid==23)
				{ ?>
				<img src="new-images/icici_pltcc.jpg"  width="140" height="85"/> 
			<? 	}
				else if($cc_bankid == 24)
				{ ?>
				<img src="new-images/icici_titanmcc.jpg"  width="140" height="85"/> 
				<? }
				else if($cc_bankid == 25)
				{ ?>
				<img src="new-images/icici_coralcc.jpg"  width="140" height="85"/> 
				<? }
				else if($cc_bankid == 26)
				{ ?>
				<img src="new-images/icici_ruby160x102.gif"  width="140" height="85"/> 
				<? }
				else if($cc_bankid == 27)
				{ ?>
				<img src="new-images/icici_sappire160x102.gif"  width="140" height="85"/> 
				<? }
				else
		{} ?>
				</td>
		
	<td width="30" align="center"><img src="new-images/crd-shado.gif" width="10" height="80" /></td>

	 <td width="369" valign="top" class="crdtext">
<table width="661"  border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#333333" >
 
  <tr>
    <td width="185" height="45"  align="center" bgcolor="#CCCCCC"><b style="font-size:12px; font-family:Verdana, Arial, Helvetica, sans-serif;">Document to Upload</b></td>
    <td width="138"  align="center"  bgcolor="#CCCCCC"  style="font-size:11px; font-family:Verdana, Arial, Helvetica, sans-serif;"><b style="font-size:12px; font-family:Verdana, Arial, Helvetica, sans-serif;">Upload Document</b></td>
  </tr>
  <tr>
    <td colspan="2"></td>
  </tr>

  <form id="uploadformsal" method="post" enctype="multipart/form-data" action="uploadt.php">
    <input type="hidden" name="statement" value="salary" />
	 <input type="hidden" name="req" id="req" value="<? echo $ccuserid; ?>" />
    <tr>
      <td height="45" align="center" bgcolor="#FFFFFF"><b style="font-size:12px; font-family:Verdana, Arial, Helvetica, sans-serif;">3 Months Salary Slip / ITR Copy</b></td>
      <td align="center" bgcolor="#FFFFFF" valign="top"><input type="file" name="file" id="file" />
        &nbsp; &nbsp;
        <input type="submit" name="action" value="Upload" onclick="initUploadsal();" />
        <span id="status" >uploading...</span>
        <iframe id="target_iframe" name="target_iframe" src="" style="width:0;height:0;border:0px"></iframe></td>
    </tr>
  </form>
    <form id="cc_hdfcform" method="POST" action="<? echo $_SERVER['PHP_SELF'] ?>">
	
	<input type="hidden" name="req" id="req" value="<? echo $ccuserid; ?>" />
	<input type="hidden" name="exstrl_nw" id="exstrl_nw" value="<? echo $existing_rel; ?>" />


	 <tr>
        <td colspan="2" align="center" bgcolor="#FFFFFF"><br />
            <input name="submit" type="submit" class="btnclr" value="Save..." /></td>
      </tr>
	
	
</form>

 </table>
 </td>		
           </tr>
          </table>
		  </td>
        </tr>
		 <tr>
          <td height="20" valign="top"><img src="new-images/crds-h-botbg.gif" width="960" height="20" /></td>
        </tr>
		</table>
		  <? } ?>
       
      
	 
     
	  </td>
  </tr>
</table>

</div>
</div>
   
  <? if((strlen($acc_no)>0 || strlen($loan_no)>0))
{ ?>
  <?php include '~Bottom-new.php';?><?php } ?>
</div><!-- </div> -->
</body>
</html>