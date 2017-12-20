<?php
	require 'scripts/session_check_online.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';



$product="";
if(isset($_REQUEST['product']))
{
	$product=$_REQUEST['product'];
}




$source="";
	if(isset($_REQUEST['source']))
	{
		$source=$_REQUEST['source'];
	}

$partner_manager="";
if(isset($_REQUEST['partner_manager']))
	{
		$partner_manager=$_REQUEST['partner_manager'];
	}


	$FeedbackClause="";


	$search="";
	if(isset($_GET['search']))
	{
		$search=$_GET['search'];
	}
	
	$min_date="";
	if(isset($_REQUEST['min_date']))
	{
		$min_date=$_REQUEST['min_date'];
	}
	
	$max_date="";
	if(isset($_REQUEST['max_date']))
	{
		$max_date=$_REQUEST['max_date'];
	}

	$varCmbFeedback="";
	if(isset($_REQUEST['cmbfeedback']))
	{
		$varCmbFeedback=$_REQUEST['cmbfeedback'];
	}

	$RequestID="";
	if(isset($_REQUEST['RequestID']))
	{
		$RequestID=$_REQUEST['RequestID'];
	}
	$type="";
	if(isset($_REQUEST['type']))
	{
		$type=$_REQUEST['type'];
	}
	$Feedback="";
	if(isset($_REQUEST['Feedback']))
	{
		$Feedback=$_REQUEST['Feedback'];
	}
	
	
	
   
	//Paging
	$pagesize=25;
	$startrow=0;
	
	//Set the page no

	if(empty($_GET['pageno']))
	{
		if($startrow == 0)
		{
			$pageno = $startrow + 1;
		}
	}
	else
	{
		$pageno = $_GET['pageno'];
		$startrow = ($pageno - 1) * $pagesize;
	}
	
	//Set the counter start
	if($pageno/$pagesize == 0)
	{
		$counterstart = $pageno - ($pagesize - 1);
	}
	else
	{
		$counterstart = $pageno - ($pageno % $pagesize) + 1;
	}
	//Counter End
	$counterend = $counterstart + ($pagesize - 1);
	///


?>

<html>

<head>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=WINDOWS-1252">
<title>RM Details</title>
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<link href="includes/style1.css" rel="stylesheet" type="text/css">
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="style/new-bima.css" rel="stylesheet" type="text/css" />
<?php 
	 if(isset($_SESSION['UserType']))
	{
echo "<table width='100%' border='0' cellspacing='0' cellpadding='0'><tr><td width='323' height='93' align='left' valign='top'  ><img src='http://www.deal4loans.com/images/logo.gif' width='323' height='93' /></td><td align='left' valign='top' style='color:#0B6FCC;' ><table width='100%' border='0' cellspacing='0' cellpadding='0' bgcolor='#0A92C0'><tr><td height='67' align='right' valign='middle' bgcolor='#C8E3F3' style='padding-right:10px;'><table border='0' align='right' cellpadding='0' cellspacing='0' bgcolor='#0A92C0'><tr><td width='6' height='32' align='left' valign='top'><img  src='http://www.deal4loans.com/rnew/images/login-form-logut-lft.gif' width='6' height='32' /></td><td background='http://www.deal4loans.com/rnew/images/login-form-logut-bg.gif' style=' background-repeat:repeat-x; height:32px;'><table width='100%' border='0' align='center' cellpadding='0' cellspacing='0'><tr><td align='left' valign='middle' style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#FFFFFF; font-weight:bold; padding-right:15px;' > Welcome ".ucwords($_SESSION['UserType'])." ".$_SESSION['UName']."</td><td align='left' style='padding-right:2px;' width='22'><img src='http://www.deal4loans.com/rnew/images/login-logut-btn.gif' /></td><td align='right' class='style1' style='color:#FFFFFF; font-weight:bold;'><div align='right' class='style1' style='color:#FFFFFF; font-weight:bold;'> <a href='Logout.php' style='color:#FFFFFF; font-size:13px; text-decoration:none; font-family:Verdana, Arial, Helvetica, sans-serif;'>Logout</a></div></td></tr></table></td><td width='6' height='32'><img src='http://www.deal4loans.com/rnew/images/login-form-logut-rgt.gif' width='6' height='32' /></td></tr></table></td></tr><tr><td>&nbsp;</td></tr></table></td></tr></table>";
	}
?>



  <!-- End Main Banner Menu Panel -->
  <!-- Start Main Container Panel -->

<style>
  
body{	
background-color:#FFFFFF!important;
background-image:none!important;
}

h1{	font-family:Arial,Helvetica,sans-serif;
	font-size:17px;
	text-align:center;
	color:#443133;
	margin:0px;
	padding:15px 0px 3px 0px;
	line-height:19px;
	margin-bottom:10px;
	font-weight: bold;
}


	#mainContainer{
		width:660px;
		margin:0 auto;
		text-align:left;
		height:100%;		
		border-left:3px double #000;
		border-right:3px double #000;
	}
	#formContent{
		padding:5px;
	}
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
  <Script Language="JavaScript">
   function validateMe(theFrm){
	
	if(!checkData(theFrm.Name, 'Name', 4))
	{
		return false;
	}
	if(!checkData(theFrm.Email, 'Email', 4))
	{
		return false;
	}
	var str=theFrm.Email.value
					var aa=str.indexOf("@")
					var bb=str.indexOf(".")
					var cc=str.charAt(aa)
	
					if(aa==-1)
						{
					alert("Please enter the valid Email Address");
					theFrm.Email.focus();
						return false;
						}
					else if(bb==-1)
					{
					alert("Please enter the valid Email Address");
					theFrm.Email.focus();
					return false;
					}
	
		if(theFrm.Phone.value=="")
		{
			alert("Please fill your mobile number.");
			theFrm.Phone.focus();
			return false;
		}
        if(isNaN(theFrm.Phone.value)|| theFrm.Phone.value.indexOf(" ")!=-1)
		{
              alert("Enter numeric value");
			  theFrm.Phone.focus();
			  return false;  
		}
        if (theFrm.Phone.value.length < 10 )
		{
			alert("Enter 10 Digits");
			theFrm.Phone.focus();
			return false;
        }
	
	return true;
    }
 </Script>

</head><body>


<table width="100%" border="0"  align="center" cellpadding="0" cellspacing="0" >

<tr>
    <td align="center">
	<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#45B2D8">
      <tr>
	  <td style="padding-top:15px;" align="center"><h1 style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:13px; color:#052733; line-height:18px; font-weight:bold;">Welcome to Deal4loans MIS</h1></td>
     
	</tr>
	<tr><td align="right" style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#FFFFFF; font-weight:bold; padding-right:10px;'>
    <?php include "referal_head.php"; ?>    
     </td></tr>
     
 <tr><td align="center">
<table width="438"  border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td valign="top"><table  width="438" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#45B2D8" >
			<tr align="left">
			  <td height="10" colspan="2" ></td>
			  </tr>
			<tr align="left">
				  <td height="58" colspan="2" align="center" background="images/logintop_bg.gif"><h1>RM Registration</h1></td>
				  </tr>
				  <div align="center"><font face="Verdana, Arial, Helvetica, sans-serif;" color="#FF0000"><strong><?php if(isset($_GET['msg'])) echo "Kindly give Valid Details"; ?></strong></font></div>
              <tr>
                <td valign="top"  background="images/login-form-login-bg.gif" ><form name="rm_form"  action="add_rm_referal_continue.php" method="POST" onSubmit="return validateMe(this);">

<table width="95%"  border="0" align="right" cellpadding="0" cellspacing="0"  >
			
				<tr align="left">
				  <Td width="14%" class="frmbldtxt">&nbsp;</Td>
				<Td width="35%" height="27" class="frmbldtxt">Full Name </Td>
 				<Td width="51%"><input name="Name" type="text" id="Name" style=" width:140px;" onBlur="onBlurDefault(this,'Name');"  onFocus="onFocusBlank(this,'Name');" onchange="insertData();"/></Td>
				</tr>
				<tr align="left">
				  <Td class="frmbldtxt">&nbsp;</Td>
				  <Td height="27" class="frmbldtxt">Email Id </Td>
				  <Td><input name="Email" id="Email" type="text" style="width:140px; "  onblur="onBlurDefault(this,'Email Id');" /></Td>
				  </tr>
                <tr align="left">
				  <Td class="frmbldtxt">&nbsp;</Td>
				  <Td height="27" class="frmbldtxt">Mobile No. </Td>
				  <Td class="frmbldtxt">+91 
	  <input name="Phone" id="Phone" type="text" style="width:111px; " onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);"  maxlength="10"  /></Td>
				  </tr>
				 
				
				
				<tr align="left">
				<td>&nbsp;</td>
				  <Td colspan="2" ></Td>
		  </tr>
			
				<tr align="center" valign="middle">
				  <Td height="35" colspan="3"><input type="image" name="Submit"  src="images/submit.jpg"  style="width:50px; height:18px; border:none; " /></Td>
				  </tr>
                </table>
				</form>
					</td>
                    
                    
              </tr>
             
              <tr>
                <td width="438" height="16" align="left" valign="top" ><img src="images/loginbt_bg.gif" width="438" height="16" /></td>
              </tr>
			  <tr align="left">
			  <td height="10" colspan="2" ></td>
			  </tr>
              
            </table></td>
            
          </tr>
        </table>
 <br></td>
 </tr></table>
</td></tr></table>


</body>

</html>
