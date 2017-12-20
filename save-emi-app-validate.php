<?php
require 'scripts/db_init.php';
require 'scripts/functions.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
$quotetblid = $_POST["quotetblid"];
$requestid = $_POST["requestid"];
$Reference_Code = generateNumber(4);
$name = $_POST["name"];
$email = $_POST["email"];
$mobile_number = $_POST["mobile_number"];

//update pl details
if(strlen($mobile_number)==10 && strlen($name)>0 && $requestid>0)
	{
		$Dated = ExactServerdate();
		$DataArray = array("Name"=>$Name , "Email"=>$Email , "Mobile_No"=>$mobile_number, "unique_code"=>$Reference_Code );
		$wherecondition ="(saveemiid=".$requestid.")";
		Mainupdatefunc ('saveemicalc_tbl', $DataArray, $wherecondition);
		$SMScampMessage = "Please use this code: ".$Reference_Code."  to activate you loan request at deal4loans.com";

		if(strlen(trim($mobile_number)) > 0)
		{	SendSMSforLMS($SMScampMessage, $mobile_number); }
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Save My EMI</title>
<link href="save-my-emi-styles1.css" type="text/css" rel="stylesheet"  />
<link type="text/css" rel="stylesheet" href="easy-responsive-tabssvemi.css" />
    <script src="jquery-1.6.3.min.js"></script>
    <script src="scripts/easyResponsiveTabssvemi.js" type="text/javascript"></script>
<script type="text/javascript" src="scripts/common.js"></script>
<style type="text/css">	
.div-displaytext{ width:98%; padding:10px 0px 10px 0px; border-radius:7px; border:thin solid #feb800; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; text-indent:5px; color:#990000;}
.tool-tip-image{ width:185px; margin-top:30px; font-family:Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold; color:#990000; padding:25px 10px 25px 10px; background:#eeeeee; border-radius:7px; border:#90dcef solid 1px; float:left; z-index:2px; margin-left:-5px;  }
.tool-tiparrow{ width:53px; margin:-4px auto;}
</style>
    <style type="text/css">
        .demo {
            width: 1000px;
            margin: 0px auto;
        }
        .demo h1 {
                margin:33px 0 25px;
            }
        .demo h3 {
                margin: 10px 0;
            }
        pre {
            background: #fff;
        }
        @media only screen and (max-width: 780px) {
        .demo {
                margin: 5%;
                width: 90%;
         }
        .how-use {
                float: left;
                width: 300px;
                display: none;
            }
        }
        #tabInfo {display:none;}
		.diverboxnew{width:100%; font-family: Geneva, Arial, Helvetica, sans-serif; font-style:italic; font-size:20px; text-align:center;}
		.diverboxnew-new{width:300px; margin:15px auto; font-family: Geneva, Arial, Helvetica, sans-serif; font-style:italic; font-size:18px; text-align:center;}
		.boxyesone{ float:left; width:100px; margin-left:15px;}
		.thanks_section{ width:1000px; margin:auto; padding-bottom:10px;}
    </style>
	  <link rel="stylesheet" href="tabs.css" type="text/css" media="screen, projection"/>	
	   <script language="javascript">
function validateFrm ()
{
	if(document.validate.activation_code.value=="")
	{
		alert("Please fill the activation code.");
		document.validate.activation_code.focus();
		return false;
	}
if(document.validate.activation_code.value!="")
	{
		if(document.validate.activation_code.value!=<?php echo $Reference_Code; ?>)
		{
			alert("Please fill the correct activation code.");
			document.validate.activation_code.focus();
			return false;
		}
	}
}
</script>
 <style type="text/css">
	/* Big box with list of options */
	#ajax_listOfOptions{
		position:absolute;	/* Never change this one */
		width:250px;	/* Width of box */
		height:160px;	/* Height of box */
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
.div-displaytext{ width:98%; padding:10px 0px 10px 0px; border-radius:7px; border:thin solid #feb800; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; text-indent:5px; color:#990000;}
.tool-tip-image{ width:185px; margin-top:30px; font-family:Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold; color:#990000; padding:25px 10px 25px 10px; background:#eeeeee; border-radius:7px; border:#90dcef solid 1px; float:left; z-index:2px; margin-left:-5px;  }
.tool-tiparrow{ width:53px; margin:-4px auto;}
</style>
    <style type="text/css">
        .demo {
            width: 1000px;
            margin: 0px auto;
        }
        .demo h1 {
                margin:33px 0 25px;
            }
        .demo h3 {
                margin: 10px 0;
            }
        pre {
            background: #fff;
        }
        @media only screen and (max-width: 780px) {
        .demo {
                margin: 5%;
                width: 90%;
         }
        .how-use {
                float: left;
                width: 300px;
                display: none;
            }
        }
        #tabInfo {display:none;}
		.diverboxnew{width:100%; font-family: Geneva, Arial, Helvetica, sans-serif; font-style:italic; font-size:20px; text-align:center;}
		.diverboxnew-new{width:300px; margin:15px auto; font-family: Geneva, Arial, Helvetica, sans-serif; font-style:italic; font-size:18px; text-align:center;}
		.boxyesone{ float:left; width:100px; margin-left:15px;}
    </style>
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
.text11 {
	font-family: Verdana, Geneva, sans-serif;
	font-size: 11px;
	font-weight: normal;
	font-variant: normal;
	color: #005399;
	text-decoration: none; 	
}
.text9 {
	font-family: Verdana, Geneva, sans-serif;
	font-size: 9px;
	font-weight: normal;
	font-variant: normal;
	color: #697e94;
	text-decoration: none; 
}

.text9 a{
	font-family: Verdana, Geneva, sans-serif;
	font-size: 9px;
	font-weight: normal;
	font-variant: normal;
	color: #697e94;
	margin:0px;
	padding:0px;
	text-decoration:underline;
}

.text12 {
	font-family: Verdana, Geneva, sans-serif;
	font-size: 11px;
	font-weight: normal;
	font-variant: normal;
	color: #ffffff;
	text-decoration: none; 
}
 
.text {
	font-family: 'Droid Serif', serif;
	font-size: 18px;
	font-weight: normal;
	font-variant: normal;
	color: #005399;
	text-decoration: none;
	font-style: italic;
	@import url(http://fonts.googleapis.com/css?family=Droid+Serif);
	line-height: 18px;
}
.text2 {
	font-family: 'Droid Serif', serif;
	font-size: 18px;
	font-weight: normal;
	font-variant: normal;
	color: #ffffff;
	text-decoration: none;
	font-style: italic;
	@import url(http://fonts.googleapis.com/css?family=Droid+Serif);
}
.text3 {
	font-family: 'Droid Sans', sans-serif;
	font-size: 12px;
	font-weight: normal;
	font-variant: normal;
	color: #909faf;
	text-decoration: none;
	text-transform: uppercase;
	@import url(http://fonts.googleapis.com/css?family=Droid+Sans); 
}

a.btn:link {
	font-family: 'Droid Sans', sans-serif;
	font-size: 14px;
 	font-variant: normal;
	color: #588f27;
	text-decoration: none;
 	padding:5px 12px 5px 12px ;
	@import url(http://fonts.googleapis.com/css?family=Droid+Sans); 
}

a.btn:visited {
	font-family: 'Droid Sans', sans-serif;
	font-size: 14px;
 	font-variant: normal;
	color: #588f27;
	text-decoration: none;
 		padding:5px 12px 5px 12px ;
		@import url(http://fonts.googleapis.com/css?family=Droid+Sans); 
}

a.btn:hover {
	font-family: 'Droid Sans', sans-serif;
	font-size: 14px;
	font-variant: normal;
	color: #203f5f;
	text-decoration: none;
	  	padding:5px 12px 5px 12px ;
		@import url(http://fonts.googleapis.com/css?family=Droid+Sans); 
}
.text4 {
	font-family: 'Droid Sans', sans-serif;
	font-size: 10px;
	font-weight: bold;
	font-variant: normal;
	color: #ffffff;
	text-decoration: none;
	text-transform: uppercase;
	@import url(http://fonts.googleapis.com/css?family=Droid+Sans); 
}
.textbox {
	font-family: Verdana, Geneva, sans-serif;
	font-size: 11px;
	font-weight: normal;
	color: #666;
	text-decoration: none;
	height: 18px;
	width: 153px;
	border: none;
	margin-top:7px;
	margin-left:30px;
 }

.font {
	font-family: DroidSansRegular;
	font-size: 12px;
	font-weight: normal;
	font-variant: normal;
	color: #666666;
	text-decoration: none;
	font-style: italic;	  
}
-->
</style>
<link href="source1.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="scripts/mainmenu.js"></script>
<link href="source.css" rel="stylesheet" type="text/css" />
<link href='http://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Droid+Serif' rel='stylesheet' type='text/css'>
</head>
<?php include "top-menu.php"; ?><!-top-></div>
<!-logo navigation->
<?php include "main-menu-saveemiapp.php"; ?>
<div style="clear:both;"></div>
<div class="myapp-save_second-wrapper-new">
<div style="clear:both;"></div>
</div>
<div style="clear:both;"></div>
</div> </div>
<div style="clear:both;"></div>
<div class="thanks_section">
<form action="save-emi-app-thanks.php" method="POST" name="personaldetails">
<input type="hidden" name="quotetblid" id="quotetblid" value="<? echo $quotetblid;?>">
<input type="hidden" name="requestid" id="requestid" value="<? echo $requestid;?>">
<input type="hidden" name="Reference_Code" id="Reference_Code" value="<? echo $Reference_Code;?>">
    <table width="600" cellpadding="0" cellspacing="0" height="300" border="1" align="center">
        <tr>
            <td valign="top" align="center" style="padding-top:12px;">
                <table cellpadding="0" cellspacing="10" border="0">
                    <tr>	
                        <td>Acticvation Code</td>
                        <td><input type="text" name="activation_code" id="activation_code"></td>
                    </tr>                    
                    <tr>	
                        <td colspan="2" align="center"><input name="image"  value="Submit" type="image" src="images/saveemi-sbt.jpg" width="120" height="39"  style="border:0px;" />							                          </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
	</form>  
</div>
<div class="section-box-buttom">
<div class="section-box-buttom-inn">
<div class="section-box-buttom-left">
<div class="highlight-text"><img src="images/money-pig.png" width="179" height="245"></div>
<div class="highlight-text-b"></div>
</div>
<div class="section-box-buttom-right"><img src="images/laptopgif.gif" width="709" height="503"></div>
<div style="clear:both;"></div>
</div>
<div style="clear:both;"></div>
</div>
<div class="newwrappersecond"> <div class="mobilebox"><img src="images/mobo-img.jpg" width="438" height="570"></div>
<div class="graph-bxnew"><img src="images/graph-savemyapp-img.jpg" width="319" height="318"></div> </div>
<div style="clear: both; height:10px;"></div>
<div style="background-color:#203F5F;"><?php include "footer_index.php";?> </div>
</body>
</html>