<?php
require 'scripts/db_init.php';
//require 'scripts/functions.php';


$fName = $_REQUEST['fName'];
$email = $_REQUEST['email'];
$mobile = $_REQUEST['mobile'];
$city = $_REQUEST['city'];
$ip = getenv("REMOTE_ADDR");
$Dated = ExactServerdate();
	$data = array("name"=>$fName , "mobile"=>$mobile, "email"=>$email, "city"=>$city, "dated"=>$Dated, 'ip'=>$ip);
		$table = 'tax_query';
		$insert = Maininsertfunc ($table, $data);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title></title>

<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<script src='scripts/pldigittowordconverter.js' type='text/javascript' language='javascript'></script>
	<script type="text/javascript" src="ajax.js"></script>
	<script type="text/javascript" src="list_hdfc.js"></script>
<style type="text/css">
body{
	margin:0px;
	padding:0px;
	font-family:Verdana, Arial, Helvetica, sans-serif;
	font-size:11px;
	line-height:16px;
	color:#292323;
	background-image:url(new-images/hdfc-gold/bg.gif);

}

input{
	margin:0px;
	padding:0px;
	border:1px solid #878787;
}

select{
	margin:0px;
	padding:0px;
	border:1px solid #878787;

}
form{
margin:0px;
padding:0px;

}

.bldtxt{
font-weight:bold;
color:#4f4d4d;
 }


.txt ul{
	margin:0px;
	padding:0px;
}

.txt ul li{
	background: url(new-images/hdfc-gold/arrow.gif) no-repeat 0px 6px;
	list-style-type:none;
	color:#292323;
	padding-left:15px; 
	padding-right:0; 
	padding-top:0; 
	padding-bottom:4px 
}

	/* START CSS NEEDED ONLY IN DEMO */

	
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
	/* END CSS ONLY NEEDED IN DEMO */
	
	
	/* Big box with list of options */
	#ajax_listOfOptions{
		position:absolute;	/* Never change this one */
		width:195px;	/* Width of box */
		height:100px;	/* Height of box */
		overflow:auto;	/* Scrolling features */
		border:1px solid #666666;	/* Dark green border */
		background-color:#FFFFFF;	/* White background color */
   		color: #333333;
		text-align:left;
		font-size:9px;
		z-index:100;
	}
	#ajax_listOfOptions div{	/* General rule for both .optionDiv and .optionDivSelected */
		margin:1px;		
		padding:1px;
		cursor:pointer;
		font-size:11px;
	}
	#ajax_listOfOptions .optionDiv{	/* Div for each item in list */
		
	}
	#ajax_listOfOptions .optionDivSelected{ /* Selected item in the list */
		background-color:#3d87d4;
		line-height:20px;
		color:#FFFFFF;
	}
	#ajax_listOfOptions_iframe{
		background-color:#F00;
		position:absolute;
		z-index:5;
	}
	
	

</style>
</head>
<body>
<table width="960" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF" style="border:1px solid #eadbc8; ">
  <tr>
    <td height="200" valign="top"><table width="946" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
   
    </table></td>
  </tr>
  <tr>
    <td height="18">&nbsp;</td>
  </tr>
  <tr>
    <td height="250" align="center" valign="top"  style="font-size:16px; font-family:Arial, Helvetica, sans-serif; color:#990000; font-weight:bold; ">Thanks for your Information. We will get back to you soon.</td>
  </tr>
</table>


<script src="http://www.google-analytics.com/urchin.js"  
type="text/javascript">
</script>
<script type="text/javascript">
_uacct = "UA-1312775-1";
urchinTracker();
</script>
</body>
</html>
