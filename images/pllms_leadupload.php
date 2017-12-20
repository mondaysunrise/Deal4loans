<?php
ob_start();

//require 'scripts/session_check_leads.php';
require 'scripts/db_init.php';
require 'scripts/functions.php';

function appendzero($number, $digits=4)
{
	$output = str_pad($number, $digits, "0", STR_PAD_LEFT);
	return $output;
} 
	
	
if ($_SERVER['REQUEST_METHOD']=='POST')
{
	echo "hee";
 $content = "";
	$userfile= $_REQUEST['userfile'];
echo $userfile;
echo "<br>";
  // Configuration - Your Options
      $allowed_filetypes = array('.doc','.csv','.jpg','.gif','.bmp','.png','.rtf'); // These will be the types of file that will pass the validation.
      $max_filesize =1524288; // Maximum filesize in BYTES (currently 0.5MB).
      $upload_path = 'files/'; // The place the files will be uploaded to (currently a 'files' directory).
   $F= ini_set("session.gc_maxlifetime","10800"); 
    $filename = $_FILES['userfile']['name']; // Get the name of the file (including file extension).
   $ext = substr($filename, strpos($filename,'.'), strlen($filename)-1); // Get the extension from the filename.
 echo "<br>";
 echo "1:";
   // Check if the filetype is allowed, if not DIE and inform the user.
   if(!in_array($ext,$allowed_filetypes))
   {
      $content = 'The file you attempted to upload is not allowed.';
   }
   // Now check the filesize, if it is too large then DIE and inform the user.
   if(filesize($_FILES['userfile']['tmp_name']) > $max_filesize)
   {
      $content = 'The file you attempted to upload is too large.';
 	}
   // Check if we can upload to the specified path, if not DIE and inform the user.
   if(!is_writable($upload_path))
   {
      $content = 'You cannot upload to the specified directory, please CHMOD it to 777.';
 	}
	 echo "<br>";
 echo "2:";
   // Upload the file to your specified path.
   if(move_uploaded_file($_FILES['userfile']['tmp_name'],$upload_path . $filename))
 //        echo 'Your file upload was successful, view the file <a href="' . $upload_path . $filename . '" title="Your File">here</a>'; // It worked.
 //     else
   //      echo 'There was an error during the file upload.  Please try again.'; // It failed :(.
 
     
           $fcontents = file($filename);
          # expects the csv file to be in the same dir as this script
         
		 echo "<br>";
 echo "3 ";
		    for($i=1; $i<sizeof($fcontents); $i++) {
echo             $line = trim($fcontents[$i]);

echo "hefgge";
			echo "<br>";
            $arr = explode("\"", $line);
			$arr1 = explode(",", $arr[0]);

	$dated=date('d-m-y');
 if(strlen($arr1[1])>0)
 {

  $Month = date('M');

  $L_Date = explode('/', $arr1[1]);
  $LeadsDate = appendzero($L_Date[2])."-".appendzero($L_Date[0],2)."-".appendzero($L_Date[1],2); 

  $A_Date = explode('/', $arr1[2]);
  $ApptDate = appendzero($A_Date[2])."-".appendzero($A_Date[0],2)."-".appendzero($A_Date[1],2); 
  
  $dob_Date = explode('/', $arr1[5]);
  $DOB = appendzero($dob_Date[2])."-".appendzero($dob_Date[0],2)."-".appendzero($dob_Date[1],2); 
  
  $Lo_Date = explode('/', $arr1[17]);
  $LoginDate = appendzero($Lo_Date[2])."-".appendzero($Lo_Date[0],2)."-".appendzero($Lo_Date[1],2);
  
  $Status_Dated = explode('/', $arr1[21]);
  $StatusDated = appendzero($Status_Dated[2])."-".appendzero($Status_Dated[0],2)."-".appendzero($Status_Dated[1],2);
  
   $checkSql = "select * from final_fullerton_leads where MobNo ='".$arr1[4]."'";
   $checkQuery = ExecQuery($checkSql);
   $checknumRows = mysql_num_rows($checkQuery);
   
   if($checknumRows>0)
   {
   		$content .= $arr1[4]." Already in the database. <br>";
   }
   else
   {
  	  $todayDate = date("Y-m-d H:i:s",getIST());
	  
 	  $sql = "INSERT INTO final_fullerton_leads (RequestID, Month, TCName, LeadsDate, ApptDate, CMName, MobNo, DOB, EmpStatus, CompanyName, NetSalary, LoanAmount, FinalLoanAmount, ApptTime, Address, Cities, Pincode, Feedback, Remark, LoginDate, AppRefNo, SpecialRate, ROI, StatusDated, Dated) VALUES ('', '".$Month."', '".addslashes($arr1[0])."', '".$LeadsDate."', '".$ApptDate."', '".addslashes($arr1[3])."', '".addslashes($arr1[4])."', '".$DOB."', '".addslashes($arr1[6])."', '".addslashes($arr1[7])."', '".addslashes($arr1[8])."', '".addslashes($arr1[9])."', '".addslashes($arr1[10])."', '".addslashes($arr1[11])."', '".addslashes($arr1[12])."', '".addslashes($arr1[13])."', '".addslashes($arr1[14])."', '".addslashes($arr1[15])."', '".addslashes($arr1[16])."', '".$LoginDate."', '".addslashes($arr1[18])."', '".addslashes($arr1[19])."', '".addslashes($arr1[20])."', '".$StatusDated."', '".$todayDate."' )"; 
//echo $sql.";";
//echo "<br>";
 		$query = @ExecQuery($sql);
		$content = "Data Inserted Successfully.";
	}

 
             
      
	}        
            if(mysql_error()) {
            echo mysql_error() ."<br>\n";
            }
         }
		 
		 
    unlink($filename); 
	
    //  header("Location: fullerton_leads.php");
	//  exit();
}	  
?>
<html>

<head>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=WINDOWS-1252">
<title>Login</title>
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<link href="includes/style1.css" rel="stylesheet" type="text/css">
<link href="style.css" rel="stylesheet" type="text/css" />

<?php 
	 if(isset($_SESSION['UserType']))
	{
echo "<table width='100%' border='0' cellspacing='0' cellpadding='0'><tr><td width='323' height='93' align='left' valign='top'  ><img src='http://www.deal4loans.com/rnew/images/login-logo.gif' width='323' height='93' /></td><td align='left' valign='top' style='color:#0B6FCC;' ><table width='100%' border='0' cellspacing='0' cellpadding='0' bgcolor='#0A92C0'><tr><td height='67' align='right' valign='middle' bgcolor='#C8E3F3' style='padding-right:10px;'><table border='0' align='right' cellpadding='0' cellspacing='0' bgcolor='#0A92C0'><tr><td width='6' height='32' align='left' valign='top'><img  src='http://www.deal4loans.com/rnew/images/login-form-logut-lft.gif' width='6' height='32' /></td><td background='http://www.deal4loans.com/rnew/images/login-form-logut-bg.gif' style=' background-repeat:repeat-x; height:32px;'><table width='100%' border='0' align='center' cellpadding='0' cellspacing='0'><tr><td align='left' valign='middle' style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#FFFFFF; font-weight:bold; padding-right:15px;' > Welcome ".ucwords($_SESSION['UserType'])." ".$_SESSION['UName']."</td><td align='left' style='padding-right:2px;' width='22'><img src='http://www.deal4loans.com/rnew/images/login-logut-btn.gif' /></td><td align='right' class='style1' style='color:#FFFFFF; font-weight:bold;'><div align='right' class='style1' style='color:#FFFFFF; font-weight:bold;'> <a href='Logout.php' style='color:#FFFFFF; font-size:13px; text-decoration:none; font-family:Verdana, Arial, Helvetica, sans-serif;'>Logout</a></div></td></tr></table></td><td width='6' height='32'><img src='http://www.deal4loans.com/rnew/images/login-form-logut-rgt.gif' width='6' height='32' /></td></tr></table></td></tr><tr><td>&nbsp;</td></tr></table></td></tr></table>";
	}
?>



  <!-- End Main Banner Menu Panel -->
  <!-- Start Main Container Panel -->

<style>
.bidderclass
{
Font-family:Comic Sans MS;
font-size:13px;
}
.style1 {
	font-family: verdana;
	font-size: 12px;
	font-weight: bold;
	color:#084459;
}
.style2 {
	font-family: verdana;
	font-size: 11px;
	font-weight: bold;
	color:#084459;
}

.style3 {
	font-family: verdana;
	font-size: 11px;
	font-weight: normal;
	color:#084459;
	text-decoration:none;
}


.bluebtn{
font-family:Verdana, Arial, Helvetica, sans-serif; 
font-size:12px;
font-weight:bold;
color:#084459;
border:1px solid #084459;
background-color:#FFFFFF;
}

</style>
</head>
<body  >
<table width="100%" border="0"  align="center" cellpadding="0" cellspacing="0" >

<tr>
    <td align="center">
	<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#45B2D8">
     <tr><td align="center" style="color:#FFFFFF; font-weight:bold; font-size:20px;">Add Leads</td></tr>
	<tr><td>&nbsp;</td></tr>
 <tr><td align="center">
<table cellpadding="0" cellspacing="0" border="0">
<tr><td align="center">
<?php 
if(isset($content))
{
	echo $content;
}

if ($_SERVER['REQUEST_METHOD']=='POST')
{
	//echo "<br>";
	
}
?>
</td></tr>
<tr><td align="center">
<!--<form  action="insert_fullerton_leads.php"  method="post"  enctype="multipart/form-data"> -->


<form  action="<? echo $_SERVER['PHP_SELF'] ?>"  method="post"  enctype="multipart/form-data">
<table align="center" cellpadding="3" cellspacing="3" bgcolor="ece691" border="5">

<tr>
<td colspan="4" align="right">
<a href="sample_main_file.php">Sample File</a>
</td></tr>

<tr>
<td colspan="2" align="right">
<b>File</b>
</td>
<td colspan="2">
<input type="file" name="userfile" id="userfile"  />
</td>
</tr>
<tr>
<td colspan="2">
<input type="submit" name="sbmit" value="Upload Leads..." />
</td>
</tr>
</table>
</form>
</td></tr></table>
</td></tr></table>
</td></tr></table>
 



</BODY>
</HTML>
