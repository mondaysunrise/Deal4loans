<?php
	require 'scripts/db_init.php';
	require 'scripts/functions.php';

	session_start();
	$Msg = "";

	if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		foreach($_POST as $a=>$b)
	    $$a=$b;

	$Email = FixString($Email);
	$PWD =  FixString($PWD);
	if(isset($PWD) && isset($Email))
	{
			if($Email=="interactive@d4l.com" && $PWD=="compaign1")
			{ //$PWD=="interactive"
				$_SESSION["Comp_Source"] = "interactive";
				$_SESSION["UserType"] = "bidder";
				$_SESSION['UName'] = "Interactive";
			}
			if($Email=="inboxmatters@d4l.com" && $PWD=="inboxmatterspl")
			{ //$PWD=="interactive"
				$_SESSION["Comp_Source"] = "inboxmatterspl";
				$_SESSION["UserType"] = "bidder";
				$_SESSION['UName'] = "Inboxmatters";
			}
			else if($Email=="networkply@d4l.com" && $PWD=="networkply")
			{
				$_SESSION["Comp_Source"] = "ntwkply";
				$_SESSION["UserType"] = "bidder";
				$_SESSION['UName'] ="Network Play";
			}
			else if($Email=="clawdigital@d4l.com" && $PWD=="clawdigital")
			{
				$_SESSION["Comp_Source"] = "clawdigital";
				$_SESSION["UserType"] = "bidder";
				$_SESSION['UName'] ="ClawDigital";
			}
			elseif($Email=="adchakra_pl@d4l.com"  && $PWD=="compaign1")
			{ //$PWD=="adchakra"
				$_SESSION["Comp_Source"] = "Adchakra";
				$_SESSION["UserType"] = "bidder";
				$_SESSION['UName'] = "Adchakra";
			}
			elseif($Email=="komli_pl@d4l.com" && $PWD=="komlipl")
			{
				$_SESSION["Comp_Source"] = "komlipl";
				$_SESSION["UserType"] = "bidder";
				$_SESSION['UName'] = "Komli";
			}
			elseif($Email=="admagnet_pl@d4l.com" && $PWD=="admagnetpl")
			{
				$_SESSION["Comp_Source"] = "admagnet";
				$_SESSION["UserType"] = "bidder";
				$_SESSION['UName'] = "Admagnetpl";
			}
			elseif($Email=="nexzenpro_pl@d4l.com" && $PWD=="nexzenpropl")
			{
				$_SESSION["Comp_Source"] = "nexzenpropl";
				$_SESSION["UserType"] = "bidder";
				$_SESSION['UName'] = "Nexzenpro";
			}
			elseif($Email=="ozonemedia_pl@d4l.com"  && $PWD=="compaign1")
			{ //$PWD=="ozonemedia"
				$_SESSION["Comp_Source"] = "ozonemedia";
				$_SESSION["UserType"] = "bidder";
				$_SESSION['UName'] = "Ozonemedia";
			}
			elseif($Email=="clovedigital_pl@d4l.com"  && $PWD=="compaign1")
			{ //$PWD=="clovedigital"
				$_SESSION["Comp_Source"] = "clove_network";
				$_SESSION["UserType"] = "bidder";
				$_SESSION['UName'] = "Clovedigital";
			}
			elseif($Email=="tyroo_pl@d4l.com"  && $PWD=="compaign1")
			{ //$PWD=="tyroopl"
				$_SESSION["Comp_Source"] = "tyroo";
				$_SESSION["UserType"] = "bidder";
				$_SESSION['UName'] = "Tyroo";
			}
			elseif($Email=="ibibo_pl@d4l.com"  && $PWD=="ibibopl")
			{
				$_SESSION["Comp_Source"] = "ibibopl";
				$_SESSION["UserType"] = "bidder";
				$_SESSION['UName'] = "IBIBO";
			}
			elseif($Email=="ibibo_septpl@d4l.com" && $PWD=="ibibopl")
			{
				$_SESSION["Comp_Source"] = "ibiboplnw";
				$_SESSION["UserType"] = "bidder";
				$_SESSION['UName'] = "IBIBO";
			}
			elseif($Email=="icubes_pl@d4l.com"  && $PWD=="icubespl")
			{
				$_SESSION["Comp_Source"] = "icubespl";
				$_SESSION["UserType"] = "bidder";
				$_SESSION['UName'] = "icubes";
			}
			elseif($Email=="aduncle_pl@d4l.com"  && $PWD=="adunclepl")
			{
				$_SESSION["Comp_Source"] = "aduncle";
				$_SESSION["UserType"] = "bidder";
				$_SESSION['UName'] = "aduncle";
			}
			elseif($Email=="logicserve_pl@d4l.com"  && $PWD=="logicservepl")
			{
				$_SESSION["Comp_Source"] = "logicserve";
				$_SESSION["UserType"] = "bidder";
				$_SESSION['UName'] = "logicserve";
			}
			elseif($Email=="clickthruntwk_pl@d4l.com"  && $PWD=="clickthruntwkpl")
			{
				$_SESSION["Comp_Source"] = "clckthrnetwk";
				$_SESSION["UserType"] = "bidder";
				$_SESSION['UName'] = "clckthrnetwk";
			}
			elseif($Email=="dgm_pl@d4l.com"  && $PWD=="dgmpl")
			{
				$_SESSION["Comp_Source"] = "dgm_ploct13";
				$_SESSION["UserType"] = "bidder";
				$_SESSION['UName'] = "DGM";
			}
			elseif($Email=="times_pl@d4l.com"  && $PWD=="timesmobl")
			{
				$_SESSION["Comp_Source"] = "timesmobpl";
				$_SESSION["UserType"] = "bidder";
				$_SESSION['UName'] = "Times Mobile";
			}
			elseif($Email=="netcore_pl@d4l.com"  && $PWD=="netcorepl")
			{
				$_SESSION["Comp_Source"] = "netcorepl";
				$_SESSION["UserType"] = "bidder";
				$_SESSION['UName'] = "Netcore";
			}
			elseif($Email=="valuefirst_pl@d4l.com"  && $PWD=="valuefirstpl")
			{
				$_SESSION["Comp_Source"] = "valuefirstpl";
				$_SESSION["UserType"] = "bidder";
				$_SESSION['UName'] = "Value First";
			}
			elseif($Email=="blueearth_pl@d4l.com"  && $PWD=="blueearthpl")
			{
				$_SESSION["Comp_Source"] = "blueearthpl";
				$_SESSION["UserType"] = "bidder";
				$_SESSION['UName'] = "blueearth";
			}
			elseif($Email=="proformics_pl@d4l.com"  && $PWD=="proformicspl")
			{
				$_SESSION["Comp_Source"] = "proformicspl";
				$_SESSION["UserType"] = "bidder";
				$_SESSION['UName'] = "proformics";
			}
			elseif($Email=="udayavani@d4l.com"  && $PWD=="udayavani")
			{
				$_SESSION["Comp_Source"] = "udayavani";
				$_SESSION["UserType"] = "bidder";
				$_SESSION['UName'] = "Udayavani";
			}
			elseif($Email=="ifsccodechk@d4l.com"  && $PWD=="ifsccodechk")
			{
				$_SESSION["Comp_Source"] = "ifsccodechkcom";
				$_SESSION["UserType"] = "bidder";
				$_SESSION['UName'] = "IFSCCODECHK";
			}
			elseif($Email=="whitedwarf_pl@d4l.com"  && $PWD=="whitedwarf")
			{
				$_SESSION["Comp_Source"] = "WhiteDwarf";
				$_SESSION["UserType"] = "bidder";
				$_SESSION['UName'] = "WhiteDwarf";
			}
			elseif($Email=="pkonline_pl@d4l.com"  && $PWD=="pkonlinepl")
			{
				$_SESSION["Comp_Source"] = "pkonlinepl";
				$_SESSION["UserType"] = "bidder";
				$_SESSION['UName'] = "pkonline";
			}
			elseif($Email=="vcommission_pl@d4l.com"  && $PWD=="vcommissionpl")
			{
				$_SESSION["Comp_Source"] = "vcommissionpl";
				$_SESSION["UserType"] = "bidder";
				$_SESSION['UName'] = "vcommission";
			}
			elseif($Email=="allmarketingbct_pl@d4l.com"  && $PWD=="allmarketingbct")
			{
				$_SESSION["Comp_Source"] = "ammbctpl";
				$_SESSION["UserType"] = "bidder";
				$_SESSION['UName'] = "all marketing";
			}
			elseif($Email=="allmarketingv3_pl@d4l.com"  && $PWD=="allmarketingv3")
			{
				$_SESSION["Comp_Source"] = "ammv3pl";
				$_SESSION["UserType"] = "bidder";
				$_SESSION['UName'] = "all marketing";
			}
			elseif($Email=="svgmedia_pl@d4l.com"  && $PWD=="svgmediapl")
			{
				$_SESSION["Comp_Source"] = "svgmediapl";
				$_SESSION["UserType"] = "bidder";
				$_SESSION['UName'] = "SVG Media";
			}
			elseif($Email=="optimise_pl@d4l.com"  && $PWD=="optimise")
			{
				$_SESSION["Comp_Source"] = "AFL_MLR_OPTMED_PL";
				$_SESSION["UserType"] = "bidder";
				$_SESSION['UName'] = "optimise";
			}
			elseif($Email=="pointific_pl@d4l.com"  && $PWD=="pointific")
			{
				$_SESSION["Comp_Source"] = "AFL_MLR_POINTIFIC_PL";
				$_SESSION["UserType"] = "bidder";
				$_SESSION['UName'] = "pointific";
			}
			elseif($Email=="delhipress_lms@d4l.com"  && $PWD=="delpress@d4l")
			{
				$_SESSION["Comp_Source"] = "AFL_DELHIPRESS";
				$_SESSION["UserType"] = "bidder";
				$_SESSION['UName'] = "Delhi Press";
			}
			elseif($Email=="monster_pllms@d4l.com"  && $PWD=="monster@d4l")
			{
				$_SESSION["Comp_Source"] = "monsterpl";
				$_SESSION["UserType"] = "bidder";
				$_SESSION['UName'] = "Monster";
			}
			elseif($Email=="cardekho_pllms@d4l.com"  && $PWD=="cardekho@d4l")
			{
				$_SESSION["Comp_Source"] = "AFL_WFMLR_CARDEKHO_PL";
				$_SESSION["UserType"] = "bidder";
				$_SESSION['UName'] = "Car Dekho";
			}
			elseif($Email=="leadsutra_pllms@d4l.com"  && $PWD=="leadsutra@d4l")
			{
				$_SESSION["Comp_Source"] = "AFL_MLR_LEADSUTRA_PL";
				$_SESSION["UserType"] = "bidder";
				$_SESSION['UName'] = "Lead Sutra";
			}
			elseif($Email=="ad2click_pllms@d4l.com"  && $PWD=="ad2click@d4l")
			{
				$_SESSION["Comp_Source"] = "AFL_MLR_AD2CLICK_PL";
				$_SESSION["UserType"] = "bidder";
				$_SESSION['UName'] = "Ad2click";
			}
			elseif($Email=="profiliad_pllms@d4l.com"  && $PWD=="profiliad@d4l")
			{
				$_SESSION["Comp_Source"] = "AFL_MLR_PROFILIAD_PL";
				$_SESSION["UserType"] = "bidder";
				$_SESSION['UName'] = "PROFILIAD";
			}
			elseif($Email=="lucini_pllms@d4l.com"  && $PWD=="lucini@d4l")
			{
				$_SESSION["Comp_Source"] = "AFL_D4LMLR_LUCINI_PL";
				$_SESSION["UserType"] = "bidder";
				$_SESSION['UName'] = "LUCINI";
			}
			else 
		{
				global $Msg;
			$Msg =  "** You are not Authorized. Please try again **";
		}
		if($Email=="interactive@d4l.com" && $PWD=="compaign1")
		{
			$strDir = dir_name();
			//header("Location: http://".$_SERVER['HTTP_HOST'].$strDir."banner-comp-lmsinteractive.php");
			//exit;
		}
		elseif($Email=="clawdigital@d4l.com" && $PWD=="compaign1")
		{
			$strDir = dir_name();
			//header("Location: http://".$_SERVER['HTTP_HOST'].$strDir."banner-comp-lmsclawdigital.php");
			//exit;
		}
		elseif($Email=="optimisepl@d4l.com" && $PWD=="optimisepl")
		{
			$strDir = dir_name();
			$_SESSION["Comp_Source"] = "AFL_MLR_OPTMED_PL";
			$_SESSION["UserType"] = "bidder";
			$_SESSION['UName'] = "optimise";
			$_SESSION['joindate'] = "2016-02-01";
			header("Location: http://".$_SERVER['HTTP_HOST'].$strDir."banner_feedback_pllmsview.php");
			exit;
		}
		elseif($Email=="profiliadpl@d4l.com" && $PWD=="profiliadpl")
		{
			$strDir = dir_name();
			$_SESSION["Comp_Source"] = "AFL_MLR_PROFILIAD_PL";
			$_SESSION["UserType"] = "bidder";
			$_SESSION['UName'] = "PROFILIAD";
			$_SESSION['joindate'] = "2016-12-01";
			header("Location: http://".$_SERVER['HTTP_HOST'].$strDir."banner_feedback_pllmsview.php");
			exit;
		}
		elseif($Email=="ad2clickpl@d4l.com" && $PWD=="ad2clickpl")
		{
			$strDir = dir_name();
			$_SESSION["Comp_Source"] = "AFL_MLR_AD2CLICK_PL";
			$_SESSION["UserType"] = "bidder";
			$_SESSION['UName'] = "AD2CLICK";
			$_SESSION['joindate'] = "2016-11-01";
			header("Location: http://".$_SERVER['HTTP_HOST'].$strDir."banner_feedback_pllmsview.php");
			exit;
		}
		elseif($Email=="lucinipl@d4l.com" && $PWD=="lucinipl")
		{
			$strDir = dir_name();
			$_SESSION["Comp_Source"] = "AFL_D4LMLR_LUCINI_PL";
			$_SESSION["UserType"] = "bidder";
			$_SESSION['UName'] = "LUCINI";
			$_SESSION['joindate'] = "2016-12-01";
			header("Location: http://".$_SERVER['HTTP_HOST'].$strDir."banner_feedback_pllmsview.php");
			exit;
		}
		elseif($Email=="netcorepl@d4l.com" && $PWD=="netcorepl")
		{
			$strDir = dir_name();
				$_SESSION["Comp_Source"] = "netcorepl";
				$_SESSION["UserType"] = "bidder";
				$_SESSION['UName'] = "Netcore";
			header("Location: http://".$_SERVER['HTTP_HOST'].$strDir."netcore_pllmsview.php");
			exit;
		}
		elseif($Email=="vcommission_fdbk@d4l.com" && $PWD=="vcommission")
		{
			$strDir = dir_name();
				$_SESSION["Comp_Source"] = "vcommissionpl";
				$_SESSION["UserType"] = "bidder";
				$_SESSION['UName'] = "vcommission";
			header("Location: http://".$_SERVER['HTTP_HOST'].$strDir."bannerfb_lmsview.php");
			exit;
		}
		elseif($Email=="infomedia@d4l.com" && $PWD=="infomedia")
		{
			$strDir = dir_name();
			$_SESSION["Comp_Source"] = "infomedia";
				$_SESSION["UserType"] = "bidder";
				$_SESSION['UName'] = "infomedia";
			header("Location: http://".$_SERVER['HTTP_HOST'].$strDir."banner-comp-clicks.php");
			exit;
		}
		elseif($Email=="commonfloor@d4l.com" && $PWD=="commonfloorHL")
		{
			$strDir = dir_name();
			$_SESSION["Comp_Source"] = "commonfloor";
				$_SESSION["UserType"] = "bidder";
				$_SESSION['UName'] = "commonfloor";
			header("Location: http://".$_SERVER['HTTP_HOST'].$strDir."commonfloor_hlview.php");
			exit;
		}
		else
		{
				if(strlen($_SESSION['UName'])>0 && strlen($_SESSION["Comp_Source"])>0)
			{
	   		 $strDir = dir_name();
			header("Location: http://".$_SERVER['HTTP_HOST'].$strDir."banner-comp-lmsview.php");
			exit;
			}
		}
		}
		else{
			global $Msg;
			$Msg =  "** Invalid Email. Please try again **";
		}
	}
?>
<html>
<head>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Login(Bidder)</title>
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<link href="includes/style1.css" rel="stylesheet" type="text/css">
<link href="style.css" rel="stylesheet" type="text/css" />    
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
</style>
  <Script Language="JavaScript">
   function validateMe(theFrm){
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
	if(!checkData(theFrm.PWD, 'Password', 3))
		return false;
	return true;
    }
 </Script>
 <body style="margin:0px; padding:0px; background-color:#45B2D8;">
 <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" style="border-collapse: collapse" valign="top">
	 <tr bgcolor="#FFFFFF">
	 <Td align="left"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="323" height="93" align="left" valign="top"><img src="images/logo.gif"  /></td>
        <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td height="67" align="right" bgcolor="#C6E3F2">&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
            </tr>
        </table></td>
      </tr>
    </table></Td>
   </tr>
	 <tr>
		<td style="padding-top:15px;">
			<table  width="669" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#5BBEE0" >
		
		  </table>
		</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
	</tr>
	<tr>
	<td align="center">
		 
	 </td>
   </tr>
	 <tr>
    <td bgcolor="#45B2D8" ><table width="361"   border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td width="361" height="43" align="center" valign="middle"><img src="images/login-form-topshine-bg.gif" width="361" height="43"></td>
        </tr>
        <tr>
          <td height="156" align="center" valign="middle" background="images/login-form-login-bg.gif"><form method="post" action="<? echo $_SERVER['PHP_SELF'] ?>" onSubmit="return validateMe(this);">
			<table width="250" border="0" cellpadding="4" cellspacing="0">
			   
			   <tr>
				 <td colspan="2" align="center" id="Alert">&nbsp; <span class="bodyarial11"><? echo $Msg ?></span></td>
			   </tr>
			   <tr>
				 <td width="100%" class="style1">Email</td>
				 <td width="100%"><input type="text" name="Email" size="20" maxlength="50"></td>
			   </tr>
			   <tr>
				 <td width="100%" class="style1">Password</td>
				 <td width="100%"><input type="password" name="PWD" size="20" maxlength="50"></td>
			   </tr>
			   <tr>
				 <td width="100%" colspan="2" align="center"><input name="submit" type="image"  src="images/login-form-lgn-sbtn.gif" style="width:111px; height:35px; border:none;"></td>
			   </tr>
		  </table>
		 </form>
          </td>
        </tr>
        <tr>
          <td width="361" height="70" align="center" valign="middle"><img src="images/login-form-bot-shine-bg.jpg" width="361" height="70"></td>
    </tr>
  </table></td>
  </tr>
</table> 
</body>
</html>

