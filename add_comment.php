<?php

		if ($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			$full_name=$_POST['full_name'];
			$email = $_POST['email'];
			$comments= $_POST['comments'];
$Subject="Newsletter Comment deal4loans";
			$message='<table style="border:1px solid;">
<tr><td colspan="2">Comment on Newsletter</td></tr>
<tr><td>name:</td><td>'.$full_name.'</td></tr>
<tr><td>email</td><td>'.$email.'</td></tr>
<tr><td>Comments:</td><td>'.$comments.'</td></tr>
</table>';
	$headers = 'From: '.$full_name.' <'.$email.'>' . "\r\n";
	$headers .= "Return-Path: <".$email.">\r\n";  // Return path for errors

	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

	$to = 'deal4loans.info@gmail.com';
	mail($to,$Subject, $message, $headers);
	echo "<script language=javascript>location.href='index.php'"."</script>";
			
		}
	


?>
<html>
<head>
<style>
.hdng{
	font-family:Verdana, Arial, Helvetica, sans-serif; 
	font-size:13px; 
	font-weight:bold; 
	color:#FFFFFF; 
	padding-left:15px;
}

.txt{
	font-family:Verdana, Arial, Helvetica, sans-serif; 
	font-size:12px;
	color:#2A2A2A;
	text-align:left;
}

.sbtn{	
	font-family:Verdana, Arial, Helvetica, sans-serif;
	font-size:13px;
	color:#FFFFFF;
	font-weight:bold;
	background-color:#6B7173;
	width:80px;
	height:26px;
	border:none;
}

</style>
</head>
<body>
<table width="400" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="57"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="170" height="65" align="left" valign="middle"><img src="images/smllogo.gif" width="168" height="51"></td>
        <td  style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:bold; color:#3366CC">Loans by Choice not by Chance ! </td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><table  width="100%" border="0" align="center" cellpadding="0"  cellspacing="3" bgcolor="#F9F9F9" style="border:1px solid #E7E6E6;">
      <tr>
        <td height="28" bgcolor="#6B7173" class="hdng" >Add Comment</td>
      </tr>
      <tr>
        <td><form name="add_comment" method="POST" action="<? echo $_SERVER['PHP_SELF'] ?>">
            <table align="center">
              <tr>
                <td class="txt">Name</td>
                <td><input type="text" name="full_name" id="full_name" style="border:1px solid #767D80;" ></td>
              </tr>
              <tr>
                <td class="txt">Email</td>
                <td><input type="text" name="email" id="email" style="border:1px solid #767D80;" ></td>
              </tr>
              <tr>
                <td class="txt">Comments</td>
                <td><textarea rows="4" cols="30" name="comments" id="comments" style="border:1px solid #767D80;" ></textarea></td>
              </tr>
              <tr>
                <td colspan="2" align="center"><input type="submit" name="submit" value="Submit" class="sbtn" ></td>
              </tr>
            </table>
        </form></td>
      </tr>
    </table></td>
  </tr>
</table>
</body>

</html>