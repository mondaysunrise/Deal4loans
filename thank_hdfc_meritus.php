<?php
    require 'scripts/db_init.php';
	require 'scripts/functions.php';
	session_start();
	
	if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		$father_name= $_REQUEST['father_name'];
		$student_name= $_REQUEST['student_name'];
		$student_class= $_REQUEST['student_class'];
		$city= $_REQUEST['city'];
		$day= $_REQUEST['day'];
		$month= $_REQUEST['month'];
		$year= $_REQUEST['year'];
		$DOB =$year."-".$month."-".$day;
		$mobile = $_REQUEST['mobile'];
		$IP = getenv("REMOTE_ADDR");
		$validMobile = is_numeric($mobile);
		$validYear  = is_numeric($year);
		$validMonth = is_numeric($month);
		$validDay = is_numeric($day);

		if((strlen($father_name)>0) && ($validMonth==1) && ($validDay==1) && ($validYear==1))
		{
			$get_HDFC_meritus_details = "INSERT INTO hdfc_meritus_scholarships (HdfcmeritID,Father_Name,Student_Name,Student_Class,City,DOB,Mobile_No,IP_Address,Date_Of_Entry) VALUES ('','".$father_name."','".$student_name."','".$student_class."','".$city."','".$DOB."','".$mobile."','".$IP."',Now())";
		$get_HDFC_meritus_result=ExecQuery($get_HDFC_meritus_details);
		//echo $get_HDFC_meritus_details."<br>";
		}
		else
		{
 header("Location: http://www.deal4loans.com/meritus-scholarship-mailer.html");
	exit();

		}
		
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>HDFC Meritus Scholarship</title>
</head>

<body>
<table width="770" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#e7e7fe">
  
  <tr>
    <td width="770" height="280" align="center" valign="top">
	<img src="http://www.deal4loans.com/emailer/meritus-09/hdfc-banner.gif" width="770" height="280" /></td>
  </tr>
  <tr>
    <td height="63" valign="middle" bgcolor="#e7e7fe"><table width="100%" border="0" align="right" cellpadding="0" cellspacing="0">
      <tr>
        <td height="63" align="left" valign="middle" style="font-family:Arial, Helvetica, sans-serif; font-size:11px; font-weight:bold; color:#1a4588;">&nbsp;&nbsp;Last date for registration 18th Feb. 2009</td>
        <td width="220" align="center" valign="middle"><img src="http://www.deal4loans.com/emailer/meritus-09/logo-txt.gif" width="180" height="53" /></td>
      </tr>
      
    </table></td>
  </tr>
  <tr>
    <td height="27" align="center" valign="middle" bgcolor="#FFFFFF"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#e10024">
      <tr>
        <td height="25" align="center" ><a href="http://www.hdfcbankmeritus.com/index.asp" style="font-family:Arial, Helvetica, sans-serif; font-size:11px; font-weight:bold; color:#FFFFFF; text-decoration:none; padding:0px 3px; display:block; height:25px; line-height:25px;">Overview</a></td>
        <td width="1" align="center" bgcolor="#FFFFFF"></td>
        <td align="center"> 	<a href="http://www.hdfcbankmeritus.com/index.asp" style="font-family:Arial, Helvetica, sans-serif; font-size:11px; font-weight:bold; color:#FFFFFF; text-decoration:none; padding:0px 3px; display:block; height:25px; line-height:25px;">Eligibility & Documentation</a></td>
        <td width="1" align="center" bgcolor="#FFFFFF"></td>
        <td align="center"><a href="http://www.hdfcbankmeritus.com/index.asp" style="font-family:Arial, Helvetica, sans-serif; font-size:11px; font-weight:bold; color:#FFFFFF; text-decoration:none; padding:0px 3px; display:block; height:25px; line-height:25px;">The Participation Rounds</a></td>
        <td width="1" align="center" bgcolor="#FFFFFF"></td>
        <td align="center"><a href="http://www.hdfcbankmeritus.com/index.asp" style="font-family:Arial, Helvetica, sans-serif; font-size:11px; font-weight:bold; color:#FFFFFF; text-decoration:none; padding:0px 3px; display:block; height:25px; line-height:25px;">Prepare for Meritus</a></td>
        <td width="1" align="center" bgcolor="#FFFFFF"></td>
        <td align="center"> 	<a href="http://www.hdfcbankmeritus.com/index.asp" style="font-family:Arial, Helvetica, sans-serif; font-size:11px; font-weight:bold; color:#FFFFFF; text-decoration:none; padding:0px 3px; display:block; height:25px; line-height:25px;">Rewards</a></td>
        <td width="1" align="center" bgcolor="#FFFFFF"></td>
        <td align="center"><a href="http://www.hdfcbankmeritus.com/index.asp" style="font-family:Arial, Helvetica, sans-serif; font-size:11px; font-weight:bold; color:#FFFFFF; text-decoration:none; padding:0px 5px; ">Frequently Asked Questions</a></td>
      </tr>
    </table></td>
  </tr>
  <tr><td height="110" align="center" valign="bottom"><img src="emailer/meritus-09/thank.gif" width="316" height="72" /></td>
  </tr>
  <tr>
    <td height="60" align="center" valign="middle" bgcolor="#e7e7fe" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold; color:#1a4588; line-height:18px;">for applying for HDFC Bank Meritus Scholarships.<br /> 
    We will get back to you soon to confirm few more details.</td>
  </tr>
           <tr><td>&nbsp;</td></tr>
          <tr>
            <td bgcolor="#cecece"><table width="760" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr>
                <td width="400" height="22" style="font-family:Arial, Helvetica, sans-serif; font-size:11px; color:#000000;">Terms &amp; Conditions*</td>
                <td align="right" style="font-family:Arial, Helvetica, sans-serif; font-size:11px; color:#000000;">For more details, write to us on <a href="mailto:meritus@hdfcbank.com" style="font-family:Arial, Helvetica, sans-serif; font-size:11px; color:#000000; text-decoration:underline;">meritus@hdfcbank.com</a></td>
              </tr>
            </table></td>
          </tr>
</table></td>
      </tr>
    </table></td>
 
  </tr>
</table>
</body>
</html>
