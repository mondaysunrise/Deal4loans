<?php
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';

//print_r($_POST);

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
	foreach($_POST as $a=>$b)
			$$a=$b;
$ccuserid = $_POST["Temp_ID"];

	if($ccuserid>0)
	{
		$Is_Valid=1;
	}
	else
	{
		$Is_Valid=0;
	}

	$DataArray = array("Is_Valid"=>$Is_Valid, 'Email_Sent'=>$Is_Valid);
	$wherecondition ="(RequestID = '".$ccuserid."')";
	Mainupdatefunc ('Req_Credit_Card', $DataArray, $wherecondition);

}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Apply for Credit Card | Credit Card Application | Credit Cards Comparison Chart</title>
<meta name="keywords" content="Credit Card Application, Apply Credit Cards, Compare Credit Cards in Mumbai Hyderabad Pune kolkata Delhi Noida Bangalore">
<script type="text/javascript" src="scripts/calendardateinput.js"></script>
<script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
<link href="style/new-bima.css" rel="stylesheet"  type="text/css" />
<link href="style/glowing.css" rel="stylesheet"  type="text/css" />
<link href="style/slider.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/dropdowntabs.js"></script>
</head>
<body>
<?php include '~Top-new.php';?>
<?php include '~menu.php';?>
<div id="container">
  <span><a href="index.php">Home</a> > <a href="credit-cards.php">Credit Card</a> </span>
  <div id="txt" style="padding-top:15px;">
  
<h1 style="color:#ae4212 !important; margin:0px; padding:0px; font-size:13px !important; line-height:22px;"> Thanks for applying Standard Chartered Credit Card through Deal4loans.com. </h1>
			
  <div style="clear:both;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td valign="top">
	<table width="100%"  border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td height="35" valign="middle"   class="crdhorizonbg"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td colspan="2"> Standard Chartered Super Value Titanium Card </td>
                
              </tr>
          </table></td>
        </tr>
        <tr>
          <td class="yelobordr"><table width="98%"  border="0" align="center" cellpadding="0" cellspacing="0">
              <tr>
                <td width="184" align="center" valign="top">Standard Chartered Super Value Titanium Card </td>
                <td width="30" align="center"><img src="new-images/crd-shado.gif" width="10" height="80" /></td>
                <td width="505" valign="top"   class="crdtext"><b>Features :</b>
             <ul>
                              <li>Free for Life time.</li>
                              <li>Earn 1 reward point per Rs. 150 spent </li>
                              <li>5% cash back on Domestic Flights and Rail Tickets* </li>
                        </ul></td>
                <td width="215" align="center" valign="middle"  class="crdtext">
				
</td>
              </tr>
          </table></td>
        </tr>
        <tr>
          <td height="20" valign="top"><img src="new-images/crds-h-botbg.gif" width="960" height="20" /></td>
        </tr>
      </table>
     
	  </td>
  </tr>
</table>
</div>
 

  </div>
      <?
  //include '~Right2.php';

  ?>
  <? if ((($_REQUEST['flag'])!=1))
	{ ?>
  <?php include '~Bottom-new.php';?><?php } ?>
</div><!-- </div> -->
</body>
</html>