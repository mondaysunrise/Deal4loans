<?php
require 'scripts/db_init.php';
require 'scripts/functions.php';
require 'scripts/session_check.php';

//print_r($_REQUEST);

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
	
	  $dataUpdate = array('icici_home_telephone'=>$home_telephone, 'icici_office_telephone'=>$office_telephone, 'icici_pincode'=>$Pincode, 'icici_resi_address'=>$residence_address, 'icici_pan_no'=>$Pancard, 'icici_office_address'=>$office_address, 'icici_name'=>$Name, 'Defaulted'=>$Defaulted, 'declined'=>$declined, 'Designation'=>$Designation);
	  $table = 'icici_car_loan_calc';
	  $insert = Maininsertfunc ($table, $dataUpdate);

$sql = "select AppID from icici_car_loan_calc where icici_clid='".$RequestID."'";
list($cNumRows,$query)=MainselectfuncNew($sql,$array = array());
$AppID = $query[0]['AppID'];

$dataSql = "select * from icici_car_loan_calc where icici_clid = ".$RequestID."";
list($cNumRows,$dataQuery)=MainselectfuncNew($dataSql,$array = array());
$company_name = $dataQuery[0]['icici_company_name'];
$icici_city = $dataQuery[0]['icici_city'];
$icici_eligible_loanamt = $dataQuery[0]['icici_eligible_loanamt'];
$icici_eligible_interestrate = $dataQuery[0]['icici_eligible_interestrate'];
$icici_eligible_emi = $dataQuery[0]['icici_eligible_emi'];
$icici_eligible_tenure = $dataQuery[0]['icici_eligible_tenure'];

?>
<html><head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>ICICI Bank Car Loan</title>
<link href="icici_car/style.css" rel="stylesheet" type="text/css">
<script language="javascript" type="text/javascript" src="icici_car/Functions.js"></script>
<script src="icici_car/AC_ActiveX.js" type="text/javascript"></script>
<script src="icici_car/AC_RunActiveContent.js" type="text/javascript"></script>
<script language="javascript" src="icici_car/Functions_002.js"></script>
<script type="text/javascript" src="scripts/common.js"></script>
<script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
<script language="javascript" src="icici_car/FormCheck.js"></script>
<script src="icici_car/Default.htm" type="text/javascript"></script>
<link type='text/css' href='css/contact.css' rel='stylesheet' media='screen' />

<script>
function validmail(email1) 
{
	invalidChars = " /:,;";
	if (email1 == "")
	{// cannot be empty
		alert("Invalid E-mail ID.");
		return false;	
	}
	for (i=0; i<invalidChars.length; i++) 
	{	// does it contain any invalid characters?
		badChar = invalidChars.charAt(i);
		if (email1.indexOf(badChar,0) > -1) 
		{
			return false;
		}
	}
	atPos = email1.indexOf("@",1)// there must be one "@" symbol
	if (atPos == -1) 
	{
		alert("Invalid E-mail ID.");
		return false;
	}
	if (email1.indexOf("@",atPos+1) != -1) 
	{	// and only one "@" symbol
		alert("Invalid E-mail ID.");
		return false;
	}
	periodPos = email1.indexOf(".",atPos)
	if (periodPos == -1) 
	{// and at least one "." after the "@"
		alert("Invalid E-mail ID.");
		return false;
	}
	//alert(periodPos);
	//alert(email.length);
	if (periodPos+3 > email1.length)	
	{		// must be at least 2 characters after the "."
		alert("Invalid E-mail ID.");
		return false;
		
	}
	return true;
}
function submitform(Form)
{
	var regMail = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9])+$/
	var dt,mdate;dt=new Date();
	
	var alpha=/^[a-zA-Z\ ]*$/;
	var alphanum=/^[a-zA-Z0-9]*$/;
	var num=/^[0-9]*$/;
	var space=/^[\ ]*$/;
	var iChars ="/@#$%^&*()+=-[]\\\';,.{}|\":<>?!";

	if(Form.residence_address.value=="")
	{
		alert("Kindly fill in your Residence Address!");
		Form.residence_address.focus();
		return false;
	}
	if((Form.Pincode.value=='PinCode') || (Form.Pincode.value=='') || Trim(Form.Pincode.value)==false)
{
alert("Kindly fill in your Pincode!");
Form.Pincode.focus();
return false;
}
else if(Form.Pincode.value.length < 6)
{
alert("Kindly fill in your Pincode(6 Digits)!");
Form.Pincode.focus();
return false;
}
else if(containsalph(Form.Pincode.value)==true)
{
alert("Kindly fill in your Correct Pincode (Numeric Only)!");
Form.Pincode.focus();
return false;
}
	var a=Form.Pancard.value;
	
	var regex1=/^[a-zA-Z]{5}\d{4}[a-zA-Z]{1}$/;  //this is the pattern of regular expersion
	if(regex1.test(a)== false)
	{
	   alert('Please enter valid pan number');
	   Form.Pancard.focus();
	   return false;
	}
	
	if (Form.Pancard.value.charAt(3)!="P" && Form.Pancard.value.charAt(3)!="p")
	{
		alert("Please enter valid pan number.");
		Form.Pancard.focus();
		return false;
	}
	
	if ( ( Form.Defaulted[0].checked == false ) && ( Form.Defaulted[1].checked == false ) )
	{
	  alert ( "Please choose defaulted on any loan or credit card" ); 
	  return false; 
	}
	
	if ( ( Form.declined[0].checked == false ) && ( Form.declined[1].checked == false ) )
	{
	  alert ( "Please choose loan application declined in last month?" ); 
	  return false; 
	}
	
	
	
	if(Form.office_address.value=="")
	{
		alert("Kindly fill in your Office Address!");
		Form.office_address.focus();
		return false;
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

function containsalph(param)
	{
		mystrLen = param.length;
		for(i=0;i<mystrLen;i++)
		{
		if((param.charAt(i)<"0")||(param.charAt(i)>"9"))
		{
		return true;
		}
		}
		return false;
	}
function Trim(strValue)
	{
		var j=strValue.length-1;i=0;
		while(strValue.charAt(i++)==' ');
		while(strValue.charAt(j--)==' ');

		return strValue.substr(--i,++j-i+1);
	}
</script>
<style>
		.black_overlay{
			display: none;
			position: absolute;
			top: 0%;
			left: 0%;
			width: 100%;
			height: 100%;
			background-color: black;
			z-index:1001;
			-moz-opacity: 0.8;
			opacity:.80;
			filter: alpha(opacity=80);
		}
		.white_content {
			display: none;
			position: absolute;
			top: 25%;
			left: 25%;
			width: 50%;
			height: 50%;
			padding: 16px;
			border: 16px solid orange;
			background-color: white;
			z-index:1002;
			overflow: auto;
		}
		.frmtxt{	font-family:Verdana, Arial, Helvetica, sans-serif;	font-size:12px;	font-weight:bold;	color:#332d33;}
		.frmtxt1{	font-family:Verdana, Arial, Helvetica, sans-serif;	font-size:12px;	color:#332d33;}
	</style>

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

	window.onload = ajaxFunction;

</script>

<script language="javascript">

function verification()
{
//alert("gfdfg");
		var get_RequestID = document.ccform.RequestID.value;
			//var get_full_name = document.getElementById('full_name').value;
					
			var get_Phone = document.ccform.Phone.value;
			//var get_mobile_no = document.getElementById('mobile_no').value;
			
			var get_id = document.ccform.verify_code.value;
			//var get_id = document.getElementById('Activate').value;

				var queryString = "?get_Mobile=" + get_Phone +"&get_RequestID=" + get_RequestID +"&get_id=" + get_id ;
	//		alert(queryString); 
				ajaxRequest.open("GET", "verifyMobile.php" + queryString, true);
				// Create a function that will receive data sent from the server
				ajaxRequest.onreadystatechange = function(){
					if(ajaxRequest.readyState == 4)
					{
					   var ajaxDisplay = document.getElementById('displayVerify');
					   ajaxDisplay.innerHTML = ajaxRequest.responseText;
					}
				}

				ajaxRequest.send(null); 
		

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

</head><body>

<table align="center" border="0" cellpadding="0" cellspacing="0" width="886">
  <tbody><tr>
    <td background="icici_car/main_bg.gif"><table align="center" border="0" cellpadding="0" cellspacing="0" width="872">
      <tbody><tr>
        <td>
			<table>
				<tr>
					<td><img src="icici_car/small_top_logo.gif" height="104" width="285"></td>
					<td valign="bottom">
						<table width="575" bgcolor="#EFEFE0" height="94" cellpadding="0" cellspacing="0" style="border:#000000 solid 1px;">
						<tr><td colspan="4" bgcolor="#CC541F" align="center" class="verdred13" style="color:#FFFFFF; border-bottom:#D2CECC solid 1px; ">ICICI Bank Car Loan Quote</td></tr>
						<tr><td width="173" align="center" class="frmtxt" style="color:#CC541F; border-right:#D2CECC solid 1px; border-bottom:#D2CECC solid 1px; font-size:13px;" bgcolor="#EFEFE0">Max Loan Amount</td>
						<td width="184" align="center" class="frmtxt" style="color:#CC541F; border-right:#D2CECC solid 1px; border-bottom:#D2CECC solid 1px; font-size:13px;" bgcolor="#EFEFE0">Interest Rate</td>
						<td width="129" align="center" class="frmtxt" style="color:#CC541F; border-right:#D2CECC solid 1px; border-bottom:#D2CECC solid 1px; font-size:13px;" bgcolor="#EFEFE0">Per Month EMI</td>
						<td width="87" align="center" class="frmtxt" style="color:#CC541F; border-bottom:#D2CECC solid 1px; font-size:13px;" bgcolor="#EFEFE0">Tenure</td>
						</tr>
						<tr>
						  <td style="border-right:#D2CECC solid 1px; font-weight:normal;" align="center" class="frmtxt"><? echo $icici_eligible_loanamt; ?></td>
						  <td style=" border-right:#D2CECC solid 1px; font-weight:normal;" align="center" class="frmtxt"><? echo $icici_eligible_interestrate; ?>&nbsp;<br><span style="font-size:9px;">(Monthly Reducing)</span></td><td style="color:#000000; border-right:#D2CECC solid 1px; font-weight:normal;" align="center"class="frmtxt"><? echo $icici_eligible_emi; ?></td><td style="font-weight:normal;" align="center" class="frmtxt"><? echo $icici_eligible_tenure; ?>&nbsp;<span style="font-size:9px;">(months)</span></td></tr>
					  </table></td></tr></table>
		</td>
      </tr>
     
      
      <tr>
        <td><img src="icici_car/body_top.gif" height="10" width="872"></td>

      </tr>
      <tr>
        <td background="icici_car/body_bg.gif"><table align="center" border="0" cellpadding="0" cellspacing="0" width="96%">
          <tbody><tr>
           
            <td width="817" valign="top"><table border="0" cellpadding="0" cellspacing="0" width="837" align="center">
              <tr>
                <td height="30" ><table width="100%">
                
                <tr><td height="30" align="center" class="verdred13" width="100%"style="color:#000099; font-family: Arial, Helvetica, sans-serif; font-size:17px; font-weight:bold; color:#802891; padding:3px;">
             <p>Your Application No. <?php echo $AppID; ?> is under process. Will contact you shortly for next steps.</p>
             <p>To make your Loan processing fast please upload the documents.</p>
				</td>
                </tr>
                
                </table></td>
              </tr>
              <tr>
			 			 
			               <td width="837" height="286" valign="top" background="icici_car/bbg.jpg" align="center">
			
				<table width="95%"  border="0" align="center" cellpadding="4" cellspacing="4">
<tr>
	<td height="26" align="left" valign="top" class="frmtxt" colspan="4">Select one document in each section below that you will provide as proof</td>
  </tr>
  
  <tr>
	<td width="149" height="26" align="left" valign="top" class="frmtxt">Proof of Income</td>
	<td width="200" >
    <?php 
	echo $Income_Proof; 
	?></td>
<td width="269" colspan="2" align="left" valign="top">
<form id="uploadform_1" method="post" enctype="multipart/form-data" action="uploadcc_1.php">
<input type="hidden" name="RequestID" value="<?php echo $RequestID; ?>" />
<input type="hidden" name="Doc_Name" value="<?php echo $Income_Proof; ?>" />
<input type="file" name="file" id="file" />&nbsp; &nbsp;<input type="submit" name="action" value="Upload" onclick="initUpload_1();" /> <span id="status_1" style="display:none">uploading...</span><iframe id="target_iframe_1" name="target_iframe_1" src="" style="width:0;height:0;border:0px"></iframe>
</form>
</td>
</tr>
  <tr>
	<td height="26" align="left" valign="top" class="frmtxt">Proof of Address</td>
    <td>
        <?php 
	echo $Address_Proof; 
	?>
   </td>
<td colspan="2" align="left" valign="top">
<form id="uploadform_2" method="post" enctype="multipart/form-data" action="uploadcc_2.php">
<input type="hidden" name="RequestID" value="<?php echo $RequestID; ?>" />
<input type="hidden" name="Doc_Name" value="<?php echo $Address_Proof; ?>" />
<input type="file" name="file" id="file" />&nbsp; &nbsp;<input type="submit" name="action" value="Upload" onclick="initUpload_2();" /> <span id="status_2" style="display:none">uploading...</span><iframe id="target_iframe_2" name="target_iframe_2" src="" style="width:0;height:0;border:0px"></iframe>
</form>

</td>
  </tr>
   <tr>
	<td height="26" align="left" valign="top" class="frmtxt">Proof of Identity</td><td >
      <?php 
	echo $Identity_Proof; 
	?>
    </td>
<td colspan="2" align="left" valign="top">   
<form id="uploadform_3" method="post" enctype="multipart/form-data" action="uploadcc_3.php">
<input type="hidden" name="RequestID" value="<?php echo $RequestID; ?>" />
<input type="hidden" name="Doc_Name" value="<?php echo $Identity_Proof; ?>" />
<input type="file" name="file" id="file" />&nbsp; &nbsp;<input type="submit" name="action" value="Upload" onclick="initUpload_3();" /> <span id="status_3" style="display:none">uploading...</span><iframe id="target_iframe_3" name="target_iframe_3" src="" style="width:0;height:0;border:0px"></iframe>
</form>


</td>
  </tr>
   <tr>
	<td height="26" align="left" valign="top" class="frmtxt">Bank Statement</td><td >
      <?php 
	echo $Bank_Statement; 
	?>
    
</td>
<td colspan="2" align="left" valign="top"> 
<form id="uploadform_4" method="post" enctype="multipart/form-data" action="uploadcc_4.php">
<input type="hidden" name="RequestID" value="<?php echo $RequestID; ?>" />
<input type="hidden" name="Doc_Name" value="<?php echo $Bank_Statement; ?>" />

<input type="file" name="file" id="file" />&nbsp; &nbsp;<input type="submit" name="action" value="Upload" onclick="initUpload_4();" /> <span id="status_4" style="display:none">uploading...</span><iframe id="target_iframe_4" name="target_iframe_4" src="" style="width:0;height:0;border:0px"></iframe>
</form>


</td>
  </tr> 

  
  <tr valign="bottom">

    <td colspan="4" align="center">&nbsp;</td>
  </tr>
</table>
	
				
				</td>
              </tr>
              <tr>
                <td colspan="2">&nbsp;</td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><img src="icici_car/body_btm.gif" height="10" width="872"></td>
      </tr>
      <tr>
        <td height="35"><table align="center" border="0" cellpadding="0" cellspacing="0" width="98%">
          <tbody><tr>
            <td class="disclaimer" height="10"></td>
          </tr>
           <tr>
             <td class="cnbc" height="103" valign="bottom" width="850"><table border="0" cellpadding="0" cellspacing="6" width="100%">
               <tbody>
                 <tr>
                   <td width="500">&nbsp;</td>
                   <td class="cnbc_link">www.consumerawards.moneycontrol.com/categories.php</td>
                 </tr>
               </tbody>
             </table></td>
           </tr>
          <tr>
            <td class="disclaimer"><a href="javascript:void(0);" onClick="javascript:showHideDiv(0);" class="disclaimer"><b><u>Disclaimer</u></b></a></td>
          </tr>
          <tr>
            <td class="disclaimer">&nbsp;</td>
          </tr>
        </tbody></table></td>
      </tr>
    </tbody></table></td>
  </tr>
</tbody></table>

</body></html>