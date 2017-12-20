<?php
require 'scripts/session_check_online.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	
	
 if ($_SERVER['REQUEST_METHOD'] == 'POST'){
 
 $Company_Name = $_POST["Company_Name"];
 
 $getcompany='select * from pl_company_list where ((company_name="'.$Company_Name.'"))';
 $getcompanyresult = ExecQuery($getcompany);
$grow=mysql_fetch_array($getcompanyresult);
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
 <script type="text/javascript" src="ajax.js"></script>
<script type="text/javascript" src="ajax-dynamic-pllist.js"></script>
<style type="text/css">
	/* Big box with list of options */
	#ajax_listOfOptions{
		position:absolute;	/* Never change this one */
		width:350px;	/* Width of box */
		height:200px;	/* Height of box */
		overflow:auto;	/* Scrolling features */
		border:1px solid #317082;	/* Dark green border */
		background-color:#FFF;	/* White background color */
    	color: black;
		font-family:Verdana, Arial, Helvetica, sans-serif;
		text-align:left;
		font-size:10px;
		z-index:50;
	}
	#ajax_listOfOptions div{	/* General rule for both .optionDiv and .optionDivSelected */
		margin:1px;		
		padding:1px;
		cursor:pointer;
		font-size:10px;
	}

	#ajax_listOfOptions .optionDivSelected{ /* Selected item in the list */
		background-color:#2375CB;
		color:#FFF;
	}
	#ajax_listOfOptions_iframe{
		background-color:#F00;
		position:relative;
		z-index:5;
	}
	form{
		display:inline;
	}
</style>
</head>
<body>
<?php 
	 if(isset($_SESSION['UserType']))
	{
echo "<table width='100%' border='0' cellspacing='0' cellpadding='0'><tr><td width='323' height='93' align='left' valign='top'  ><img src='http://www.deal4loans.com/images/logo.gif' width='323' height='93' /></td><td align='left' valign='top' style='color:#0B6FCC;' ><table width='100%' border='0' cellspacing='0' cellpadding='0' bgcolor='#0A92C0'><tr><td height='67' align='right' valign='middle' bgcolor='#C8E3F3' style='padding-right:10px;'><table border='0' align='right' cellpadding='0' cellspacing='0' bgcolor='#0A92C0'><tr><td width='6' height='32' align='left' valign='top'><img  src='http://www.deal4loans.com/rnew/images/login-form-logut-lft.gif' width='6' height='32' /></td><td background='http://www.deal4loans.com/rnew/images/login-form-logut-bg.gif' style=' background-repeat:repeat-x; height:32px;'><table width='100%' border='0' align='center' cellpadding='0' cellspacing='0'><tr><td align='left' valign='middle' style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#FFFFFF; font-weight:bold; padding-right:15px;' > Welcome ".ucwords($_SESSION['UserType'])." ".$_SESSION['UName']."</td><td align='left' style='padding-right:2px;' width='22'><img src='http://www.deal4loans.com/rnew/images/login-logut-btn.gif' /></td><td align='right' class='style1' style='color:#FFFFFF; font-weight:bold;'><div align='right' class='style1' style='color:#FFFFFF; font-weight:bold;'> <a href='Logout.php' style='color:#FFFFFF; font-size:13px; text-decoration:none; font-family:Verdana, Arial, Helvetica, sans-serif;'>Logout</a></div></td></tr></table></td><td width='6' height='32'><img src='http://www.deal4loans.com/rnew/images/login-form-logut-rgt.gif' width='6' height='32' /></td></tr></table></td></tr><tr><td>&nbsp;</td></tr></table></td></tr></table>";
	}
?>
<table cellpadding="0" cellspacing="0" align="center">
<? if($_SESSION["Email"]=="Administrator")
{ ?>
<tr><td align="right"><a href="company_listadd.php" target="_blank">Add New Company</a></td></tr>
<? } ?>
<tr>
<td>
<form name="company_update" action="" method="post">
<table cellpadding="8" cellspacing="0" width="50%" align="center">
<tr>
<td>Company Name</td>
<td><input name="Company_Name" id="Company_Name" type="text"  style="width:250px; height:20px;" onblur="onBlurDefault(this,'Type slowly to autofill');" onkeyup="ajax_showOptions(this,'getCountriesByLetters',event, 'http://www.deal4loans.com/ajax-list-plcompanies.php')" value="<? echo $Company_Name; ?>" /> </td>
</tr>
<tr><td colspan="2" align="center"><input type="submit" name="submit" /></td></tr>
</table>
</form>
</td></tr>
<tr><td align="center">&nbsp;</td></tr>
<? if ($_SERVER['REQUEST_METHOD'] == 'POST'){

?>
<tr>
<td>
	<table width="100%" cellpadding="5" cellspacing="0" border="1">
    	<tr>
            <td>S no</td>
           	<td>Company Name</td>
            <td>HDFC Bank</td>
            <td>Fullerton</td>
            <td>Citibank</td>
            <td>Standard Chartered</td>
            <td>TATA Capital</td>
            <td>Bajaj Finserv</td>
            <td>ICICI Bank</td>
            <td>Kotak Bank</td>
            <td>IndusInd Bank</td>
           	 <td>Capital First</td>
			  <td>Aditya birla</td>
			  <td>RBL Bank</td>
			  <td>IIFL</td>
            <td></td>
        </tr>
        <tr>
        <td><? echo $grow["plcompanyid"]; ?></td>
          	<td><? echo $grow["company_name"]; ?></td>
            <td align="center"><? echo $grow["hdfc_bank"]; ?></td>
            <td align="center"><? echo $grow["fullerton"]; ?></td>
            <td align="center"><? echo $grow["citibank"]; ?></td>
            <td align="center"><? echo $grow["standard_chartered"]; ?></td>
            <td align="center"><? echo $grow["tatacapital"]; ?></td>
            <td align="center"><? echo $grow["bajajfinserv"]; ?></td>
            <td align="center"><? echo $grow["icici_bank"]; ?></td>
            <td align="center"><? echo $grow["kotak"]; ?></td>
            <td align="center"><? echo $grow["Indusind"]; ?></td>
            <td align="center"><? echo $grow["capitalfirst"]; ?></td>
			 <td align="center"><? echo $grow["adityabirla"]; ?></td>
			 <td align="center"><? echo $grow["rblbank"]; ?></td>
			 <td align="center"><? echo $grow["iifl"]; ?></td>
               <td align="center"><a href="company_listedit.php?cmpid=<? echo $grow["plcompanyid"]; ?>&user=<? echo $_SESSION['Code']; ?>" target="_blank">Edit</a></td>

        </tr>
        
    </table>
</td>
</tr>
<? } ?>
</table>
</body>
</html>
