<?php
	require 'scripts/session_check_online.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
//print_r($_SESSION);

	function encrypt($string) {
		$key = "abcdefghij";
		$result = '';
		for($i=0; $i<strlen($string); $i++) {
			$char = substr($string, $i, 1);
			$keychar = substr($key, ($i % strlen($key))-1, 1);
			$char = chr(ord($char)+ord($keychar));
			$result.=$char;
		}
		return base64_encode($result);
	}
	
	function decrypt($string) {
		$key = "abcdefghij";
		$result = '';
		$string = base64_decode($string);
		for($i=0; $i<strlen($string); $i++) {
			$char = substr($string, $i, 1);
			$keychar = substr($key, ($i % strlen($key))-1, 1);
			$char = chr(ord($char)-ord($keychar));
			$result.=$char;
		}
		return $result;
	}  

	$search="";
	if(isset($_GET['search']))
	{
		$search=$_GET['search'];
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
}.bluebtn{
font-family:Verdana, Arial, Helvetica, sans-serif; 
font-size:12px;
font-weight:bold;
color:#084459;
border:1px solid #084459;
background-color:#FFFFFF;
}

</style>
<table width="100%" border="0"  align="center" cellpadding="0" cellspacing="0" >
<tr>
    <td align="right">
    <a href="update_feedback_index.php"><strong>Get Leads</strong></a> |  <a href="upload_feedback_index.php"><strong>Upload CSV</strong></a>
</td></tr>
<tr>
    <td align="center">
	<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#45B2D8">
<tr><td align="center">
  <table width="600" border="0" align="center" cellpadding="0" cellspacing="0">
   <tr>
     <td height="30" align="center" valign="middle"><img src="images/login-srch-pnl.gif" width="650" height="30"></td>
   </tr>
   <tr>
     <td align="center" valign="middle" background="images/login-form-login-bg.gif">
 <form name="frmsearch" action="upload_feedback_index.php?search=y" method="post"  enctype="multipart/form-data" >     
     <table width="95%" border="0"  cellpadding="1" cellspacing="0">
 <tr><td colspan="3">&nbsp;</td></tr>
 <tr>
   <td colspan="3" align="center">
   <table border="0" width="90%" cellpadding="0" cellspacing="0"><tr>
     <td width="40%" valign="middle" class="style1">Upload File [CSV Format]:</td>
     <td width="30%" align="left" valign="middle" class="bidderclass" >
     <input type="file" name="userfile" id="userfile"  />
     </td>
	   <td width="30%">
     </td>
  
     </tr>
	   </table>
	   </td></tr>
  
   <tr>
    
	  <td width="33%" colspan="3" align="center" valign="middle"><input name="Submit" type="image"  src="images/login-form-lgn-srch.gif" style="width:111px; height:35px; border:none;" border="0"></td>
     </tr>
 </table>
    </form>
 </td>
   </tr>
   <tr>
     <td width="650" height="8" align="center" valign="top" ><img src="images/login-bot-pnl.gif" width="650" height="8"></td>
   </tr>
   <tr>
     <td align="center" valign="middle" >&nbsp;</td>
   </tr>
 </table>
	<?php
	
	
	
	$search_date="";
	$varmin_date=$min_date;
	$varmax_date=$max_date;

	if($search=="y")
	{
		$userfile= $_REQUEST['userfile'];
	    $allowed_filetypes = array('.csv'); 
        $max_filesize =1524288; // Maximum filesize in BYTES (currently 0.5MB).
        $upload_path = 'hdfc/'; // The place the files will be uploaded to (currently a 'files' directory).
        $F= ini_set("session.gc_maxlifetime","10800"); 
        $filename = $_FILES['userfile']['name']; // Get the name of the file (including file extension).
	    $ext = substr($filename, strpos($filename,'.'), strlen($filename)-1); // Get the extension from the filename.
 	   // Check if the filetype is allowed, if not DIE and inform the user.
   		if(!in_array($ext,$allowed_filetypes))
      		die('The file you attempted to upload is not allowed.');
 	   // Now check the filesize, if it is too large then DIE and inform the user.
   		if(filesize($_FILES['userfile']['tmp_name']) > $max_filesize)
      		die('The file you attempted to upload is too large.');
    // Check if we can upload to the specified path, if not DIE and inform the user.
 	  	if(!is_writable($upload_path))
    		die('You cannot upload to the specified directory, please CHMOD it to 777.');
 
   // Upload the file to your specified path.
   if(move_uploaded_file($_FILES['userfile']['tmp_name'],$upload_path . $filename))
	{
		//echo "Uploaded";
	} 
     
           $fcontents = file($upload_path.$filename);
          
	//	  print_r($fcontents);
	$insert = '';
	$update = '';
		  
			  for($i=1; $i<sizeof($fcontents); $i++) {
			   $ReqID =  ""; 	 $BidID =  ""; 	 $Name = ""; 	 $City = ""; 	 $Mobile = ""; 	 $Feedback = "";	 $Comment = "";
     $numQuery ='';
	        $line = trim($fcontents[$i]);
            $arr = explode("\"", $line);
			$arr1 = explode(",", $arr[0]);
//		print_r($arr1);
		//echo "<br>";
	$dated=date('d-m-y');
 if(strlen($arr1[0])>0)
 {
 	 $ReqID =  decrypt($arr1[0]);
	 $BidID =  decrypt($arr1[1]);
	 $Name = $arr1[2];
	 $City = $arr1[3];
	 $Mobile = $arr1[4];
	 $Feedback = $arr1[5];
	 $Comment = $arr1[6];
	 
	 $selectSql = "select * from Req_Feedback where AllRequestID = '".$ReqID."' and BidderID = '".$BidID."' and Reply_Type=1";
	 $selectQuery = ExecQuery($selectSql);
	 $numQuery = mysql_num_rows($selectQuery);
	 if($numQuery >0)
	 {
	 	//update
		$sql = "update Req_Feedback set Feedback='".$Feedback."', comment_section ='".$Comment."' where AllRequestID = '".$ReqID."' and BidderID = '".$BidID."' and Reply_Type=1";
		$update = $update+1;
		
	 }	
	 else
	 {
	 	$sql = "INSERT INTO Req_Feedback (AllRequestID, BidderID, Reply_Type, Feedback, comment_section, last_update_dated) VALUES ('".$ReqID."', '".$BidID."', '1', '".$Feedback."', '".$Comment."', Now())";
		$insert = $insert + 1;
		
	 }
		
	//	echo  $sql."<br>";		 
 //Sql to Insert/Update
     $query = ExecQuery($sql);
  
  }        
            if(mysql_error()) {
            echo mysql_error() ."<br>\n";
            }
         }
 		
    unlink($upload_path.$filename); 	

	?>
 <p class="bodyarial11">
<strong><?php
   	    echo "<br>";		 
		if($update>0) {	} else { $update=0;	}
		if($insert>0) {	} else { $insert=0;	}
		
		echo  "Updates - ".$update."<br>";		 
		
		
		echo  "New Entries - ".$insert."<br>";		 
?>
</strong></p>
 	<?php
 	}
 	?>
 </td></tr></table>
</td></tr></table>

</body>

</html>
