<?php
require 'scripts/db_init.php';
require 'scripts/functions.php';
//$_REQUEST['RequestID'] = 5714;
//print_r($_SESSION);

//print_r($_POST);
	$RequestID = $_REQUEST['RequestID'];
	$max_loan_amount = $_POST['max_loanamt'];
	$calc_emi = $_POST['permonemi'];
	$loan_tenure = $_POST['tene'];

	$Name = $_REQUEST['Name'];
	$Phone = $_REQUEST['Phone'];
	$Email = $_REQUEST['Email'];

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
	  
	  $permonemi = $_POST['permonemi'];
	  	  $tene = $_POST['tene'];
		  	  $max_loanamt = $_POST['max_loanamt'];
			  
	$Pincode = $_REQUEST['Pincode'];
	$home_std = $_REQUEST['home_std'];
	$home_phone = $_REQUEST['home_phone'];
	$office_std = $_REQUEST['office_std'];
	$office_phone = $_REQUEST['office_phone'];
	$office_ext  = $_REQUEST['office_ext'];
	$home_telephone = $home_std."-".$home_phone;
	$office_telephone = $office_std."-".$office_phone."-".$office_ext;
	  
	
//	, allocated_sms='0'

$appointment = $_REQUEST['appointment'];
$upload = $_REQUEST['upload'];

$docs = '';
$Income_Proof = $_REQUEST['Income_Proof'];
if(strlen($Income_Proof)>0)
{
	$docs .= $Income_Proof.", ";
}

$Address_Proof = $_REQUEST['Address_Proof'];
if(strlen($Address_Proof)>0)
{
	$docs .= $Address_Proof.", ";
}
$Identity_Proof = $_REQUEST['Identity_Proof'];
if(strlen($Identity_Proof)>0)
{
	$docs .= $Identity_Proof.", ";
}
$Bank_Statement = $_REQUEST['Bank_Statement'];
if(strlen($Bank_Statement)>0)
{
	$docs .= $Bank_Statement;
}


$sql = "select * from Req_Loan_Personal where RequestID='".$RequestID."'";
list($alreadyExist,$myrow)=MainselectfuncNew($sql,$array = array());
$myrowcontr=count($myrow)-1;
$Name = $myrow[$myrowcontr]["Name"];
$AppID = $myrow[$myrowcontr]["AppID"];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Personal Loans</title>
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
<meta name="keywords" content="Personal Loan, Personal Loans, Personal Loan India, compare personal loans, personal loans comparision, online personal loans, Personal Loans India, Personal loans Online">
<meta name="description" content="Personal Loan – Get Personal loan quotes, compare personal loans online, Best interest rates and EMI from all major personal loan banks.">
<style type="text/css">
body{	margin:0px;	padding:0px;	font-family:Verdana, Arial, Helvetica, sans-serif;	font-size:11px;	color:#2e2e2e;}input{	margin:0px;	padding:0px;	border:1px solid #878787;}select{	margin:0px;	padding:0px;	border:1px solid #878787;}form{margin:0px;padding:0px;}.hdr{	background-image:url(images/hdr.gif);	background-repeat:no-repeat;	height:75px;}.hdng-bg{	background-image:url(images/bgn.jpg);	background-repeat:no-repeat;	height:36px;	font-family:Arial, Helvetica, sans-serif;	font-size:17px;	font-weight:bold;	color:#802891; 	text-indent:15px;}.yelobrder{	border-left:1px solid #fde37a;	border-right:1px solid #fde37a;}#txt{	font-family:Verdana, Arial, Helvetica, sans-serif;	font-size:11px;  	padding-left:25px;	line-height:21px;	padding-top:8px;}.yelobrder ul{	margin:0px 0px 0px 10px;	padding:0px 0px 0px 10px;}.yelobrder ul li{	background-image:url(images/arow.jpg) ;	background-repeat:no-repeat;	list-style-type:none; 	padding-left:18px; 	padding-right:0; 	padding-top:0; 	padding-bottom:4px;	font-family:Verdana, Arial, Helvetica, sans-serif;	font-size:11px;	line-height:18px; }.imgpostn{	padding-left:31px;	padding-top:10px;	padding-bottom:4px;} .btmboxbg{	background-image:url(images/btm-box.jpg);	width:273px;	height:131px;	background-repeat:no-repeat;	background-position:center;}.redtxt{	font-family:Verdana, Arial, Helvetica, sans-serif;	font-size:12px;	font-weight:bold;	color:#8b321b;}.blktxt{	font-family:Verdana, Arial, Helvetica, sans-serif;	font-size:11px;	text-align:left;	line-height:16px;	padding-top:6px;}.frmhdng{	font-family:Arial, Helvetica, sans-serif;	font-size:17px;	font-weight:bold;	color:#802891;}.frmbg{ 	border-left:1px solid #c2c2c2;	border-bottom:1px solid #c2c2c2;}.frmtxt{	font-family:Verdana, Arial, Helvetica, sans-serif;	font-size:11px;	font-weight:bold;	color:#332d33;}.frmrgtbrdr{		border-bottom:22px solid #d1001f;	background-color:#003871;}/* START CSS NEEDED ONLY IN DEMO */		#mainContainer{		width:660px;		margin:0 auto;		text-align:left;		height:100%;				border-left:3px double #000;		border-right:3px double #000;	}	#formContent{		padding:5px;	}	/* END CSS ONLY NEEDED IN DEMO */			/* Big box with list of options */	#ajax_listOfOptions{		position:absolute;	/* Never change this one */		width:195px;	/* Width of box */		height:100px;	/* Height of box */		overflow:auto;	/* Scrolling features */		border:1px solid #666666;	/* Dark green border */		background-color:#FFFFFF;	/* White background color */   		color: #333333;		text-align:left;		font-family:Verdana, Arial, Helvetica, sans-serif;		text-transform: lowercase;		font-size:11px;			z-index:100;	}	#ajax_listOfOptions div{	/* General rule for both .optionDiv and .optionDivSelected */		margin:1px;				padding:1px;		cursor:pointer;		font-family:Verdana, Arial, Helvetica, sans-serif;		font-size:11px;		}	#ajax_listOfOptions .optionDiv{	/* Div for each item in list */			}	#ajax_listOfOptions .optionDivSelected{ /* Selected item in the list */		background-color:#3d87d4;		line-height:20px;		color:#FFFFFF;	}	#ajax_listOfOptions_iframe{		background-color:#F00;		position:absolute;		z-index:5;	}				#dhtmlgoodies_tooltip{		background-color:#ffe688;		border:1px solid #000;		position:absolute;		color:#000000;		display:none;		margin-left:-13px;		z-index:20000;		padding:0px;		font-size:0.9em;		font-family: "Trebuchet MS", "Lucida Sans Unicode", Arial, sans-serif;			}	#dhtmlgoodies_tooltipShadow{		position:absolute;		background-color:#555;		display:none;		margin-left:-13px;		z-index:10000;		opacity:0.7;		filter:alpha(opacity=70);		-khtml-opacity: 0.7;		-moz-opacity: 0.7;	} 

    .btnclr1 {
    background-color: #1273AB;
    border: medium none;
    color: #FFFFFF;
    font-family: Verdana,Arial,Helvetica,sans-serif;
    font-size: 14px;
    font-weight: bold;
    height: 40px;
    width: 210px;
}
</style>


<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
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

  <script>

var ajaxRequest;  // The variable that makes Ajax possible!

		function ajaxFunction(){
			try{
				// Opera 8.0+, Firefox, Safari
				ajaxRequest = new XMLHttpRequest();
			} catch (e){
				// Internet Explorer Browsers
				try{
					ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
				} catch (e) {
					try{
						ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
					} catch (e){
						// Something went wrong
						alert("Your browser broke!");
						return false;
					}
				}
			}
		}
		
function getFeedBack()
{
	var residence_address = document.getElementById('residence_address').value;
	var RequestIDVal = document.getElementById('RequestID').value;
	var appdate = document.getElementById('appdate').value;
	var changeapp_time = document.getElementById('changeapp_time').value;
	var office_address = document.getElementById('office_address').value;
	var pincode = document.getElementById('Pincode').value;
	//alert(fieldName);
//	var queryString = "?fieldName=" + fieldName + "&Email="+ new_email + "&Type=" + new_type + "&Request=" + new_request ;
	var queryString = "?residence_address=" + residence_address + "&RequestIDVal="+ RequestIDVal + "&appdate="+ appdate + "&changeapp_time=" + changeapp_time + "&office_address=" + office_address + "&pincode=" + pincode;
	//alert(queryString); 
	ajaxRequest.open("GET", "getCITIAPT.php" + queryString, true);
	// Create a function that will receive data sent from the server
	ajaxRequest.onreadystatechange = function(){
		if(ajaxRequest.readyState == 4)
		{		
			//alert(ajaxRequest.responseText);
			var ajaxDisplay = document.getElementById('ajaxFeedback');
			ajaxDisplay.innerHTML = ajaxRequest.responseText;
			
			
		
		}
	}

	ajaxRequest.send(null); 
	
}

		
	window.onload = ajaxFunction;
</script>
<script language="javascript" type="text/javascript" src="http://www.bimadeals.com/scripts/datetime.js"></script>
</head>

<body>

<table width="1004" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="75" ><table width="1004" border="0" cellspacing="0" cellpadding="0">

  <tr>

    <td width="450" height="75" align="left" valign="top"><a href="http://www.fullertonindia.com/" target="_blank"><img src="images/citibanklogo.jpg" width="450" height="75" border="0" /></a></td>
    <td colspan="2" height="75">
		<table height="75" width="100%" style="border:#7F6B53 solid 1px;">
		
		<tr>
				<td bgcolor="#ffffff" colspan="3" style="font-size:12px; color:#DE6020; border-bottom:#7F6B53 solid 1px;" align="center"><b>Citibank Personal Loan Quote</b></td>
			</tr>
			<tr>
				<td style="color:#7F6B53; font-size:11px; border-right:#7F6B53 solid 1px; border-bottom:#7F6B53 solid 1px;" align="center"><b>Max Loan Amount</b></td><td style="color:#7F6B53; font-size:11px; border-right:#7F6B53 solid 1px; border-bottom:#7F6B53 solid 1px;" align="center"><b>Per Month EMI </b></td><td style="color:#7F6B53; font-size:11px; border-bottom:#7F6B53 solid 1px;" align="center"><b>Tenure</b></td>
			</tr>
			<tr>
				<td style=" border-right:#7F6B53 solid 1px; font-weight:normal; font-size:11px;" align="center"><? echo $max_loan_amount; ?></td><td style=" border-right:#7F6B53 solid 1px; font-weight:normal; font-size:11px;" align="center"><? echo $calc_emi; ?></td><td align="center" style="font-size:11px;"><? echo $loan_tenure; ?> yrs</td>
			</tr>
		</table>
	</td>

  </tr>

</table>

</td>

  </tr>

  <tr>

    <td><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">

      <tr>

        <td valign="top"><table width="100%"  border="0" cellspacing="0" cellpadding="0">

          <tr>

            <td width="94%" align="left" valign="left" class="hdng-bg"><strong>Dear <?php echo $Name;?>,</strong></td>

          </tr>

      

        </table></td>



      </tr>

    </table></td>

  </tr>
<tr><td>&nbsp;

</td>
</tr>
<?php

if(strlen($appointment)>0)
{	
	$Dated = ExactServerdate();
	$data = array("RequestID"=>$RequestID , "docs"=>$docs , "Reply_Type"=>'1', "Dated"=>$Dated );
	$table = 'citi_appointments';
	$insert = Maininsertfunc ($table, $data);

/*  ************* Commented by Upendra */
//$insSql = "INSERT INTO citi_appointments ( RequestID, docs , Reply_Type, Dated ) VALUES ('".$RequestID."', '".$docs."', '1', Now())";
//$insQuery = ExecQuery($insSql);
/*  ************* Commented by Upendra */
?>

<tr><td>
<form action="#" method="post" name="frmApt">
  <input type="hidden" name="max_loan_amount" value="<?php echo $max_loanamt ; ?>" />
	   <input type="hidden" name="calc_emi" value="<?php echo $permonemi ; ?>" />
	    <input type="hidden" name="loan_tenure" value="<?php echo $tene ; ?>" />
        

<table width="753"  border="0" align="center" cellpadding="0" cellspacing="1" >
	 <tr><td width="751" height="70" align="center" style="color:#000099; font-family: Arial, Helvetica, sans-serif; font-size:17px; font-weight:bold; color:#802891;"><p>&nbsp;</p>
	   <p>Your Application  is under process. Will contact you shortly for next steps</p></td>
	    </tr>
        	 <tr><td width="751" height="70" align="center" style="color:#000099; font-family: Arial, Helvetica, sans-serif; font-size:17px; font-weight:bold; color:#802891; border:#0000FF 1px solid;">
             <table width="95%"  border="0" align="center" cellpadding="4" cellspacing="4"  >
             
		<tr>

		<td class="frmtxt"><b>Appointment Date<span style="font-weight:normal; color:#FF0000; font-size:9;">*</span></b></td>

		<td>
		<input type="hidden" name="RequestID" id="RequestID" value="<?php echo $RequestID; ?>" />
        <?php
		$tomorrow  = mktime(0, 0, 0, date("m")  , date("d")+1, date("Y"));

		$appointment_date = date ("Y-m-d" , $tomorrow);
        ?>
	    <input type='Text'  name='appdate' id='appdate' maxlength='25' size='15' value="<? echo $appointment_date;?>">

		  <a href="javascript:NewCal('appdate','yyyymmdd',false,'');" ><img src='images/cal.gif' width='16' height='16' border='0' alt='Pick a date'></a></td>
		</tr>

		<tr>

		<td class="frmtxt"><b>Appointment Time<span style="font-weight:normal; color:#FF0000; font-size:9;">*</span></b></td>

		<td class="frmtxt">

		  <select name="changeapp_time" id="changeapp_time">

		    <option value="please select">Anytime</option>

		    <option <? if($appointment_time=="08:00:00") echo "selected"; ?> value="08:00:00">8(am)-9(am)</option>

		    <option <? if($appointment_time=="09:00:00") echo "selected"; ?> value="09:00:00">9(am)-10(am)</option>

		    <option <? if($appointment_time=="10:00:00") echo "selected"; ?> value="10:00:00">10(am)-11(am)</option>

		    <option <? if($appointment_time=="11:00:00") echo "selected"; ?> value="11:00:00">11(am)-12(am)</option>

		    <option value="12:00:00" <? if($appointment_time=="12:00:00") echo "selected"; ?>>12(am)-1(pm)</option>

		    <option <? if($appointment_time=="13:00:00") echo "selected"; ?> value="13:00:00">1(pm)-2(pm)</option>

		    <option value="14:00:00" <? if($appointment_time=="14:00:00") echo "selected"; ?>>2(pm)-3(pm)</option>

		    <option <? if($appointment_time=="15:00:00") echo "selected"; ?> value="15:00:00">3(pm)-4(pm)</option>

		    <option value="16:00:00" <? if($appointment_time=="16:00:00") echo "selected"; ?>>4(pm)-5(pm)</option>

		    <option <? if($appointment_time=="17:00:00") echo "selected"; ?> value="17:00:0">5(pm)-6(pm)</option>

		    <option <? if($appointment_time=="18:00:00") echo "selected"; ?> value="18:00:00">6(pm)-7(pm)</option>

		    <option <? if($appointment_time=="19:00:00") echo "selected"; ?> value="19:00:00">7(pm)-8(pm)</option>
	    </select>		 </td>
		</tr>
        
		<tr>

		<td class="frmtxt"><b>Appointment Address  Line 1</b><span style="font-weight:normal; color:#FF0000; font-size:9;">*</span></td>

		<td>
		<input type="text" name="residence_address" id="residence_address" style="width:250px;  height:21px;" ></td>
		</tr>
        
		<tr>

		<td class="frmtxt"><b>Appointment Address  Line 2</b><span style="font-weight:normal; color:#FF0000; font-size:9;">*</span></td>

		<td>
        <input type="text" name="office_address" id="office_address" style="width:250px;  height:21px;" ></td>
		</tr>
		<tr>

		<td class="frmtxt"><b>Pincode</b><span style="font-weight:normal; color:#FF0000; font-size:9;">*</span></td>

		<td>
       <input  style="width:150px;  height:21px;" maxlength="6"  name="Pincode" id="Pincode" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" /></td>
		</tr>


        <tr>

		<td colspan="2" align="center" class="frmtxt" style="color:#FF0000; height:40px;" ><div id="ajaxFeedback"> <input name="appointment" type="button" class="btnclr1" value="Fix an Appointment" onclick="return getFeedBack();" /></div></td>
		</tr>
             </table>
             
             </td></tr></table>
</form>
</td>
</tr>
<?php
}

if(strlen($upload)>0)
{

//$uploadUpdate = "update Req_Loan_Personal set identification_proof = '".$docs."' where RequestID= '".$RequestID."'";
//$uploadUpdateQuery = ExecQuery($uploadUpdate); 

?>

<tr><td>
<table width="753"  border="0" align="center" cellpadding="0" cellspacing="1" >
	 <tr><td width="751" height="70" align="center" style="color:#000099; font-family: Arial, Helvetica, sans-serif; font-size:17px; font-weight:bold; color:#802891;"><p>&nbsp;</p>
	   <p>Your Application  is under process. Will contact you shortly for next steps</p></td>
	    </tr>
        	 <tr><td width="751" height="70" align="center" style="color:#000099; font-family: Arial, Helvetica, sans-serif; font-size:17px; font-weight:bold; color:#802891; border:#0000FF 1px solid;">
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
	<td width="149" height="26" align="left" valign="top" class="frmtxt">Proof of Income</td>
	<td width="200"class="frmtxt" valign="top">
    <?php 
	echo stripslashes($Income_Proof); 
	?></td>
<td  colspan="2" align="left" valign="top" class="frmtxt">
<form id="uploadform_1" method="post" enctype="multipart/form-data" action="uploadciti_1.php">
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
	<td height="26" align="left" valign="top" class="frmtxt">Proof of Address</td>
    <td class="frmtxt" valign="top">
        <?php 
	echo stripslashes($Address_Proof); 
	?>
   </td>
<td colspan="2" align="left" valign="top" class="frmtxt">
<form id="uploadform_2" method="post" enctype="multipart/form-data" action="uploadciti_2.php">
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
	<td height="26" align="left" valign="top" class="frmtxt">Proof of Identity</td><td  class="frmtxt" valign="top">
      <?php 
	echo stripslashes($Identity_Proof); 
	?>
    </td>
<td colspan="2" align="left" valign="top" class="frmtxt">   
<form id="uploadform_3" method="post" enctype="multipart/form-data" action="uploadciti_3.php">
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
	<td height="26" align="left" valign="top" class="frmtxt">Bank Statement</td><td class="frmtxt" valign="top">
      <?php 
	echo stripslashes($Bank_Statement); 
	?>
    
</td>
<td colspan="2" align="left" valign="top" class="frmtxt"> 
<form id="uploadform_4" method="post" enctype="multipart/form-data" action="uploadciti_4.php">
<input type="hidden" name="RequestID" value="<?php echo $RequestID; ?>" />
<input type="hidden" name="Doc_Name" value="<?php echo $Bank_Statement; ?>" />

<input type="file" name="file" id="file" />&nbsp; &nbsp;<input type="submit" name="action" value="Upload" onclick="initUpload_4();" /> <span id="status_4" style="display:none">uploading...</span><iframe id="target_iframe_4" name="target_iframe_4" src="" style="width:0;height:0;border:0px"></iframe>
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
             
             
             </td></tr>
             
 <?php
 }?>            
        
      </table>
  </td></tr>

</table>

</body>

</html>