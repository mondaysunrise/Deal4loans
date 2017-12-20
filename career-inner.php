<?php
require 'scripts/session_check.php';
require 'scripts/db_init.php';
require 'scripts/functions.php';
define("SITE_URL","http://www.deal4loans.com/");

$jobTitle = $_REQUEST['job'];
if(strlen(strpos($_SERVER['REQUEST_URI'], "?")) > 0)
{
	$pageName = SITE_URL."career/".$jobTitle;
	header("HTTP/1.1 301 Moved Permanently");
	header("Location: ".$pageName);
	exit();
}
function detectFileMimeType($filename='')
{
    $filename = escapeshellcmd($filename);
    $command = "file -b --mime-type -m /usr/share/misc/magic {$filename}";

    $mimeType = shell_exec($command);
            
    return trim($mimeType);
}

function mail_attachment($filename, $path, $mailto, $from_mail, $from_name, $subject, $message) {
    $file = $path.$filename;
    $file_size = filesize($file);
    $handle = fopen($file, "r");
    $content = fread($handle, $file_size);
    fclose($handle);
    $content = chunk_split(base64_encode($content));
    $uid = md5(uniqid(time()));
    $name = basename($file);
    $header = "From: ".$from_name." <".$from_mail.">\r\n";
   // $header .= "Reply-To: ".$replyto."\r\n";
    $header .= 'MIME-Version: 1.0' . "\r\n";
    $header .= "Content-Type: multipart/mixed; boundary=\"".$uid."\"\r\n\r\n";
    $header .= "This is a multi-part message in MIME format.\r\n";
    $header .= "--".$uid."\r\n";
    $header .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    $header .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
    $header .= $message."\r\n\r\n";
    $header .= "--".$uid."\r\n";
    $header .= "Content-Type: application/octet-stream; name=\"".$filename."\"\r\n"; // use different content types here
    $header .= "Content-Transfer-Encoding: base64\r\n";
    $header .= "Content-Disposition: attachment; filename=\"".$filename."\"\r\n\r\n";
   $header .= $content."\r\n\r\n";
   //echo $header .= "--".$uid."--"; die;
    if (mail($mailto, $subject, "", $header)) {
        echo  "mail send ... OK"; // or use booleans here
    } else {
        echo  "mail send ... ERROR!";
    }
}
	
	$selqry="select * from careers WHERE access_url ='".$_REQUEST['job']."'";
	list($Numrows,$Resrows)=MainselectfuncNew($selqry,$array = array());
	
	$Dated = date("Y-m-d H:i:s");
	if(isset($_POST['submitButton']) && ($_REQUEST['fullName']!='')  && ($_REQUEST['Email']!='') && ($_REQUEST['Phone']!='')  && ($_FILES["uploadFile"]["name"]!='')) {
	
$fileName=$_FILES["uploadFile"]["name"];
$fileSize=$_FILES["uploadFile"]["size"]/1024;
$fileType=$_FILES["uploadFile"]["type"];
$fileTmpName=$_FILES["uploadFile"]["tmp_name"];  


	if(empty($_SESSION['captcha_code'] ) || strcasecmp($_SESSION['captcha_code'], $_POST['captcha_code']) != 0){  
		$_SESSION['captcha_msg'] = "<span class='hintanchor'>The Validation code does not match!</span>";// Captcha verification is incorrect.
	}
else{

if(($fileType=="application/vnd.openxmlformats-officedocument.wordprocessingml.document") || ($fileType=="application/msword")|| ($fileType=="application/pdf")){
if($fileSize<=2048){
	
$AttTitle = str_replace(" ", "_",$_REQUEST['JobTitle'])."_".str_replace(" ", "_",$_REQUEST['fullName']);

//New file name
$revstr = strrev($fileName);
$exparr = explode(".",$revstr);
$extention = strrev($exparr[0]);

$newFileName=$AttTitle.".".$extention;
//File upload path
$uploadPath="upload_resume/".$newFileName;
$uploadPath2="/home/deal4loans/public_html/upload_resume/";

//function for upload file
if(move_uploaded_file($fileTmpName,$uploadPath)){
	

  $DetectMimeType = detectFileMimeType($uploadPath);
  
  if(($DetectMimeType=='application/zip') || ($DetectMimeType=='application/doc') || ($DetectMimeType=='application/pdf'))
  {
  
  $dataInsert = array("career_id"=>$_REQUEST['id'], "fullname"=>$_REQUEST['fullName'], "email"=>$_REQUEST['Email'], "phone"=>$_REQUEST['Phone'], "upload_files"=>$newFileName, "cover_letter"=>$_REQUEST['coverLetter'], "city"=>$_REQUEST['City'], "job_title"=>$_REQUEST['JobTitle'], "flag"=>1, "added_date"=>$Dated);

$table = 'career_job_apply';
$insert = Maininsertfunc($table, $dataInsert);

$mailto = 'career.d4l@gmail.com'; //sender email
//$mailto = 'yaswant10chauhan@gmail.com'; //sender email
$from_mail = $_REQUEST['Email'];
$subject = $_REQUEST['JobTitle']." CV (".$_REQUEST['fullName'].")";
$message="<table width='500' border='1' style='border:thin; border-color:#CCC; border-collapse: collapse;' cellspacing='0' cellpadding='5'>
        <tr>
          <td  colspan='2' style='font-family:Arial, Helvetica, sans-serif; font-size:14px;'>Hi,<br>
            <br>
          Please find Applicant details.</td>
        </tr>
        <tr>
          <td width='164' style='font-family:Arial, Helvetica, sans-serif; font-size:14px;'><strong>Name</strong></td>
          <td width='308' style='font-family:Arial, Helvetica, sans-serif; font-size:14px;'>".$_REQUEST['fullName']."</td>
        </tr>
        <tr>
          <td style='font-family:Arial, Helvetica, sans-serif; font-size:14px;'><strong>Email</strong></td>
          <td style='font-family:Arial, Helvetica, sans-serif; font-size:14px;'>".$_REQUEST['Email']."</td>
        </tr>
        <tr>
          <td style='font-family:Arial, Helvetica, sans-serif; font-size:14px;'><strong>Phone</strong></td>
          <td style='font-family:Arial, Helvetica, sans-serif; font-size:14px;'>".$_REQUEST['Phone']."</td>
        </tr>
       <tr>
<td style='font-family:Arial, Helvetica, sans-serif; font-size:14px;'><strong>Cover Letter</strong></td>
<td style='font-family:Arial, Helvetica, sans-serif; font-size:14px;'>".$_REQUEST['coverLetter']."</td>
</tr>
<tr>
<td colspan='2' style='font-family:Arial, Helvetica, sans-serif; font-size:14px;'><br>
  <br>
  Regards</td>
</tr>
</table>";


mail_attachment($newFileName, $uploadPath2, $mailto, $from_mail, $_REQUEST['fullName'], $subject, $message);

// Auto Responce mail
$toAuto = $_REQUEST['Email'];
$subjectAuto = "Thank you for your application";
$messageAuto = "<table width='500' border='0' style='border:thin; border-color:#CCC;' cellspacing='0' cellpadding='0'>
        <tr>
          <td>Thanks for applying to Deal4loans.com. We will review your resume and get back to you shortly.</td>
        </tr>
      </table>";


// To send HTML mail, the Content-type header must be set
$headersAuto  = 'MIME-Version: 1.0' . "\r\n";
$headersAuto .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

// Additional headers
$headersAuto .= 'From: Deal4loans Recruitment Team <'.$mailto.'>' . "\r\n";
// Mail it
mail($toAuto, $subjectAuto, $messageAuto, $headersAuto);

header("location:".SITE_URL."career/".$_REQUEST['job']."&msg=success");
  }else{
	  	//unlink();
		header("location:".SITE_URL."career/".$_REQUEST['job']."&msg=invalid");
		
	  }

	}
}
else{
	 header("location:".SITE_URL."career/".$_REQUEST['job']."&msg=max");
}
}
else{
	 header("location:".SITE_URL."career/".$_REQUEST['job']."&msg=type");
}  
	}
}



?> 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="<?php echo SITE_URL;?>careers-css/career-styles.css" type="text/css" rel="stylesheet"  />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<title>Career with Us</title>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js"></script>
<script type="application/javascript">
function validatefrm()
{		
	var regMail = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9])+$/
	var dt,mdate;dt=new Date();
	var j;
	var cnt=-1;
	var alpha=/^[a-zA-Z\ ]*$/;
	var alphanum=/^[a-zA-Z0-9]*$/;
	var num=/^[0-9]*$/;
	var space=/^[\ ]*$/;
	var iChars ="/@#$%^&*()+=-[]\\\';,.{}|\":<>?!";

	
	if (document.career_frm.fullName.value=="")
		{ 
		
			document.getElementById('fullNameVal').innerHTML = "<span  class='hintanchor'>Please Enter Full Name!</span>";
			document.career_frm.fullName.focus();
		return false;
		}	
	
	if(document.career_frm.Email.value=="")
	{
		document.getElementById('emailVal').innerHTML = "<span  class='hintanchor'>Enter  Email Address!</span>";	
		document.career_frm.Email.focus();
		return false;
	}
	var str=document.career_frm.Email.value
	var aa=str.indexOf("@")
	var bb=str.indexOf(".")
	var cc=str.charAt(aa)
	if(aa==-1)
	{
		document.getElementById('emailVal').innerHTML = "<span  class='hintanchor'>Enter Valid Email Address!</span>";	
		document.career_frm.Email.focus();
		return false;
	}
	else if(bb==-1)
	{
		document.getElementById('emailVal').innerHTML = "<span  class='hintanchor'>Enter Valid Email Address!</span>";	
		document.career_frm.Email.focus();
		return false;
	}
	
	
	if(document.career_frm.Phone.value=="")
	{
		document.getElementById('phoneVal').innerHTML = "<span  class='hintanchor'>Enter Phone No.!</span>";
		document.career_frm.Phone.focus();
		return false;  
	}
	if (document.career_frm.Phone.value.length < 10 )
	{
	  	document.getElementById('phoneVal').innerHTML = "<span  class='hintanchor'>Enter 10 Digits!</span>";	
		document.career_frm.Phone.focus();
		return false;
	}
	if ((document.career_frm.Phone.value.charAt(0)!="9") && (document.career_frm.Phone.value.charAt(0)!="8") && (document.career_frm.Phone.value.charAt(0)!="7"))
	{
	  	document.getElementById('phoneVal').innerHTML = "<span  class='hintanchor'>should start with 9 or 8 or 7!</span>";	
		document.career_frm.Phone.focus();
		return false;
	}
	
	
	if(document.career_frm.uploadFile.value=="")
	{
		document.getElementById('uploadFileVal').innerHTML = "<span  class='hintanchor'>Please choose file!</span>";
		document.career_frm.uploadFile.focus();
		return false;  
	}
	if(document.career_frm.captcha_code.value=="")
	{
		document.getElementById('CapchaVal').innerHTML = "<span  class='hintanchor'>Please Enter Validation code!</span>";
		document.career_frm.captcha_code.focus();
		return false;  
	}
	
}  


function validateDiv(div) {	var ni1 = document.getElementById(div); 	ni1.innerHTML = ''; }

function isCharsetKey(evt)
	{
		var charCode=(evt.which)?evt.which:event.keyCode
		if((charCode>33)&&(charCode<58))
		return false;
		return true;
	}
function numOnly(evt)
	{
		var charCode=(evt.which)?evt.which:window.event.keyCode;if(charCode<=13)
		{
			return true;
		}
	else
		{
			var keyChar=String.fromCharCode(charCode);var re=/[0-9]/
			return re.test(keyChar);
		}
	}
</script>
<script type='text/javascript'>
function refreshCaptcha(){
	var img = document.images['captchaimg'];
	img.src = img.src.substring(0,img.src.lastIndexOf("?"))+"?rand="+Math.random()*1000;
}
</script>

<script type="text/javascript">
$(document).ready(function(){
    var totalChars      = 500; //Total characters allowed in textarea
    var countTextBox    = $('#coverLetter') // Textarea input box
    var charsCountEl    = $('#countchars'); // Remaining chars count will be displayed here
    
    charsCountEl.text(totalChars); //initial value of countchars element
    countTextBox.keyup(function() { //user releases a key on the keyboard
        var thisChars = this.value.replace(/{.*}/g, '').length; //get chars count in textarea
        if(thisChars > totalChars) //if we have more chars than it should be
        {
            var CharsToDel = (thisChars-totalChars); // total extra chars to delete
            this.value = this.value.substring(0,this.value.length-CharsToDel); //remove excess chars from textarea
        }else{
            charsCountEl.text( totalChars - thisChars ); //count remaining chars
        }
    });
});
</script>



</head>

<body>
<div class="header">
<?php include "middle-menu.php"; ?>
<div class="clearfix"></div>
<div class="headerin">
<div class="logo">&nbsp;</div>
</div>
</div>
<div class="clearfix"></div>
<div class="banner">
<div class="headerin padding">
<h1>About Us</h1>
<?php echo $Resrows[0]['about_us'];?>
</div>
</div>
<div class="clearfix"></div>
<div class="wrapper">
<div class="inner-page"><h1 class="h1"><?php echo $Resrows[0]['job_title'];?></h1> <span class="location"><?php if($Resrows[0]['location']!="") echo "Location:". $Resrows[0]['location'];?></span><div class="clearfix"></div>
<div><?php echo $Resrows[0]['description'];?></div>
</div>
<div class="right-fromwraper">
<div class="form">
<?php if($_REQUEST['msg']=='success') {echo "<span class=\"success-messages\">Resume uploaded successfully</span>"; }?>
<?php if($_REQUEST['msg']=='max') {echo "<span class=\"error-messages\">You can upload maximum 2 MB file.</span>"; }?>
<?php if($_REQUEST['msg']=='invalid') {echo "<span class=\"error-messages\">Invalid format.</span>"; }?>
<?php if($_REQUEST['msg']=='type') {echo "<span class=\"error-messages\">Only PDF, Doc, Docx are permitted</span>";} ?>
<form name="career_frm" id="career_frm" action="" method="post" enctype="multipart/form-data" onSubmit="return validatefrm();">
<input type="hidden" name="JobTitle" value="<?php echo $Resrows[0]['job_title'];?>" />
<label class="font_a">FULL NAME*</label>
<input name="fullName" id="fullName" type="text" value="" onkeypress="return isCharsetKey(event)" onkeydown="validateDiv('fullNameVal');" />
 <div id="fullNameVal"></div>
<label class="font_a">EMAIL*</label>
<input name="Email" id="Email" type="text" value=""  onkeydown="validateDiv('emailVal');" />
 <div id="emailVal"></div>
<label class="font_a">PHONE*</label>
<input name="Phone" id="Phone" type="text" value="" onkeypress="return numOnly(event)" onkeydown="validateDiv('phoneVal');" />
<div id="phoneVal"></div>
<label class="font_a">UPLOAD RESUME* </label>
<input name="uploadFile" id="uploadFile" type="file" onkeydown="validateDiv('uploadFileVal');" style="border:none;" class="filed" />
<label class="font_a" style="color:#F00; font-size:10px;">Format: Pdf, Doc, Docx with size <=2 MB</label>
<div id="uploadFileVal"></div>
<div style="margin-top:5px;"><label class="font_a" >COVER LETTER</label></div>
<textarea name="coverLetter" id="coverLetter" cols="" maxlength="500" rows="5"></textarea>
<input type="hidden" name="City" value="Noida" />
<label class="font_a"><span name="countchars" id="countchars"></span> Characters Remaining</label><br />
<div class="column5 font_a mrgin-top">VALIDATION CODE: </div>
<div class="column6"><img src="http://www.deal4loans.com/captcha/captcha1.php?rand=<?php echo rand();?>" id='captchaimg'></div>
<div class="clearfix"></div>
<div class="column5 font_a mrgin-top">ENTER THE ABOVE CODE HERE:</div>
<div class="column6 font_a"><input id="captcha_code" name="captcha_code" type="text" size="10" onkeydown="validateDiv('CapchaVal');"> <div id="CapchaVal"><?php if($_SESSION['captcha_code']!=$_REQUEST['captcha_code']){echo $_SESSION['captcha_msg'];}  ?></div>
<label > </label>
<label class="font_a"></label>
</div>
<div class="clearfix"></div>
<label for='message' class="font_a"> Can't read the image? <a href='javascript: refreshCaptcha();'>click here</a> to refresh.</label>
<br />

<input name="submitButton" type="submit" class="submit" value="Apply"/>
</form>

</div>
<div class="right">
<h3 class="h3">Why work for us: </h3>

<p>Because you want to change lives! We are helping millions of average Indians make responsible financial decisions, leveraging our technology and algorithms. We offer you a platform to be a part of that change!</p> 

<p>We offer ownership, responsibility and fast career progression. We are collegial, young, quick, hungry and we have a company culture that you have never experienced. Join us to demystify finance for millions of Indians.</p>
</div>
</div>

<div class="clearfix"></div>
</div>
</div>
<div style="clear:both; height:10px;"></div>
<?php include "footer_sub_menu.php"; ?>

</body>
</html>