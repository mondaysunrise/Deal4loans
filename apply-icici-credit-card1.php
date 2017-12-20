<?php
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';

//print_r($_POST);

	$ccuserid = $_POST['RequestID'];
$cc_bankid = $_POST['cc_bankid'];
$City = $_POST["cityval"];
$crd_nme = $_POST["crd_nme"];

if((strlen(trim($crd_nme))>0) && $cc_bankid >1)
{
	$slct="select applied_card_name from Req_Credit_Card Where (RequestID='".$ccuserid."')";
	list($GetnumVal,$row)=Mainselectfunc($slct,$array = array());
	
	if(strlen($row['applied_card_name'])>0)
	{
	$strcrd_nme=$row['applied_card_name'].",".$crd_nme;
	}
	else
	{
		$strcrd_nme=$crd_nme;
	}

//$getcc_option=ExecQuery("Update Req_Credit_Card Set applied_card_name ='".$strcrd_nme."' Where (RequestID='".$ccuserid."')");

$DataArray = array("applied_card_name" =>$strcrd_nme);
$wherecondition ="(RequestID='".$ccuserid."')";
Mainupdatefunc ('Req_Credit_Card', $DataArray, $wherecondition);
	}


if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
	foreach($_POST as $a=>$b)
			$$a=$b;
	
	$existing_rel = $_POST["existing_rel"];
	$Residence_Address_line1 = $_POST["Residence_Address_line1"];
	$Residence_Address_line2 = $_POST["Residence_Address_line2"];
	$Address_City = $_POST["Address_City"];
	$Pincode = $_POST["Pincode"];
	$existing_relationship = $_POST['existing_relationship'];
	$cc_bankid_nw = $_POST["cc_bankid_nw"];
	
	$Residence_Address = $Residence_Address_line1." | ".$Residence_Address_line2." ".$Address_City;
	
	if($cc_bankid==23)
	{ 
		$Descr = "ICICI Bank HPCL Platinum Credit Card";
	}
	else if ($cc_bankid==24)
	{ 
		$Descr = "ICICI Bank HPCL Titanium Credit Card";
 	} 
	else if ($cc_bankid==25)
	{ 
		$Descr = " 	ICICI Bank Coral Credit Card";
 	} 
	else if ($cc_bankid==26)
	{ 
		$Descr = "ICICI Bank Rubyx Credit Cards";
 	} 
	else if ($cc_bankid==27)
	{ 
		$Descr = "ICICI Bank Sapphiro Credit Cards";
 	} 
	else if ($cc_bankid==29)
	{ 
		$Descr = "ICICI Bank Platinum Chip Credit Card";
 	} 
	
$hdfcd="select Descr from Req_Credit_Card Where (RequestID='".$ccuserid."')";
	
	list($GetnumVal,$hdfcrow)=Mainselectfunc($hdfcd,$array = array());
	

if(strlen($hdfcrow['Descr'])>0)
	{	$hdfrd_nme=$hdfcrow['Descr'].",".$Descr;}
	else
	{	$hdfrd_nme=$Descr;}

$DataArray = array("Residence_Address"=>$Residence_Address, "Descr"=>$hdfrd_nme, "Dated" =>$Dated, "Existing_Relationship"=>$existing_rel, "Existing_Relationship_ICICI" =>$existing_relationship, "applied_card_name "=>$hdfrd_nme, "Pincode"=>$Pincode);
$wherecondition ="(Req_Credit_Card.RequestID=".$ccuserid.")";
Mainupdatefunc ('Req_Credit_Card', $DataArray, $wherecondition);

	
	if($cc_bankid_nw>0)
	{
		header("Location: apply-icici-credit-card-continue.php?req=".$ccuserid."&ccid=".$cc_bankid."&exstrl=".$existing_rel);
		exit();
	}
	//echo $ccupdate."<br>";

}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Apply for Credit Card | Credit Card Application | Credit Cards Comparison Chart</title>
<meta name="description" content="Apply for Credit Cards online: Get facility to apply directly for credit cards in all banks. Online Credit Card application form to get information about credit card schemes from all credit cards provider banks located in major cities of India like Mumbai, Delhi, Gurgaon, Bangalore, Ahmedabad, Chennai, Hyderabad, Navi Mumbai, Kochi etc.">
<meta name="keywords" content="Credit Card Application, Apply Credit Cards, Compare Credit Cards in Mumbai Hyderabad Pune kolkata Delhi Noida Bangalore">
<script type="text/javascript" src="scripts/calendardateinput.js"></script>
<script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
<link href="style/new-bima.css" rel="stylesheet"  type="text/css" />
<link href="style/glowing.css" rel="stylesheet"  type="text/css" />
<link href="style/slider.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/dropdowntabs.js"></script>
<script>


function addElement()
{
		var ni = document.getElementById('myDiv');
		ni.innerHTML = '<table cellspacing="0"><tr><td class="frmbldtxt" align="bottom">Existing Relationship With Bank ?</td>	   <td class="frmbldtxt"><select name="existing_rel" id="existing_rel">	   <option value="">Please Select</option>	   <option value="1">Account</option>	   <option value="2">Loan Running</option>	   <option value="3">Credit Card</option>	   </select></td>     </tr></table>';
		return true;
}

function removeElement()
{
	var ni = document.getElementById('myDiv');
		ni.innerHTML = '';
	return true;
}

</script>
</head>
<body>
<div id="dvtpbg">
<div id="logo">
<img onclick="javascript:location.href='http://www.deal4loans.com/'" alt="Deal4loans" src="/new-images/d4l-logo.gif"/>
</div>
</div>

<div id="container">
  <!--<span><a href="index.php">Home</a> > <a href="credit-cards.php">Credit Card</a> </span>-->
  <div id="txt" style="padding-top:15px;">
<? if(strlen($Descr) >0)
{ ?>
 <h1 style="color:#ae4212 !important; margin:0px; padding:0px; font-size:13px !important; line-height:22px; text-align:left;"> Thanks for applying ICICI Bank Credit Card through Deal4loans.com. </h1>
 <? } 
 else
 { ?>
 <h1 style="color:#ae4212 !important; margin:0px; padding:0px; font-size:13px !important; line-height:22px; text-align:left;"> Your application for ICICI Bank Card is 90% complete.<br />
Please fill in few more details for your online application.</h1>

 <? } ?>
  <div style="clear:both;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td valign="top" class="crdtext">
		<table width="100%"  border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td height="35" valign="middle"   class="crdhorizonbg"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td colspan="2" ><?	if($cc_bankid==23)
				{ ?>
			ICICI Bank HPCL Platinum Credit Card
			<? 	}
				else if ($cc_bankid==24)
		{ ?>
			ICICI Bank HPCL Titanium Credit Card
	<? } ?></td>
                </tr>
          </table></td>
        </tr>
        <tr>
          <td class="yelobordr"><table width="98%"  border="0" align="center" cellpadding="0" cellspacing="0">
              <tr>
                <td width="185" align="center" valign="top">
			<?	if($cc_bankid==23)
				{ ?>
				<img src="new-images/icici_pltcc.jpg"  width="140" height="85"/> 
			<? 	}
				else if($cc_bankid == 24)
				{ ?>
				<img src="new-images/icici_titanmcc.jpg"  width="140" height="85"/> 
				<? }
				else if($cc_bankid == 25)
				{ ?>
				<img src="new-images/icici_coralcc.jpg"  width="140" height="85"/> 
				<? }
				else if($cc_bankid == 26)
				{ ?>
				<img src="new-images/icici_ruby160x102.gif"  width="140" height="85"/> 
				<? }
				else if($cc_bankid == 27)
				{ ?>
				<img src="new-images/icici_sappire160x102.gif"  width="140" height="85"/> 
				<? }
				else if($cc_bankid == 29)
				{ ?>
				<img src="new-images/icici_pltchipcrd.jpg"  width="140" height="85"/> 
				<? }
				else
		{} ?>
				</td>
				
                <td width="30" align="center"><img src="new-images/crd-shado.gif" width="10" height="80" /></td>
                <td width="369" valign="top" class="crdtext">
				<? if($cc_bankid==24) 
		{?>
        <table cellpadding="0">
		  <tr>
            <td  valign="bottom" class="crdbold">Annual Fee</td>
          </tr>
          <tr>
            <td valign="top" class="crdtext" style="padding-bottom:6px;"><ul>
               <li><b>Joining Fee</b> – Nil </li>
              <li><b>Annual Fee</b> –   Rs. 500 (1st year)<br />
                – Rs. 500 (Reversed in case spends exceed Rs. 50,000 in the previous year)(2nd year onwards)<br />  </li>
			   <li><b>Joining Benefit</b> - Cashback of Rs 500 if purchases exceed Rs. 5,000 within 60 days of card set   up. </li>
            </ul>            </td>
          </tr>
        <tr>
            <td height="22" valign="bottom" class="crdbold">Reward Points</td>
        </tr>
          <tr>
            <td valign="top" class="crdtext" height="55" style="padding-bottom:14px;"><ul>
                <li>5 PAYBACK points on fuel purchases at HPCL on ICICI Merchant  Services swipe   machines, 2 PAYBACK points on all other purchases.</li>
            </ul></td>
          </tr>
          </table>
					  <? } 
				else if($cc_bankid == 23)
		{ ?>
                <table cellpadding="0">
                <tr>
                <td valign="top" class="crdtext" height="50" style="padding-bottom:6px;"><ul>
               <li><b>Joining Fee</b> – Nil </li>
               <li><b>Annual Fee</b> –   Rs. 500 (1st year)<br />
                – Rs. 500 (Reversed in case spends exceed Rs. 50,000 in the previous year)(2nd year onwards)<br />
               </li>
			   <li><b>Joining Benefit</b> - Cashback of Rs 500 if purchases exceed Rs. 5,000 within 60 days of card set   up. </li>
            </ul>          </td>
          </tr>
         <tr>
            <td height="22" valign="bottom" class="crdbold">Reward Points</td>
        </tr>
          <tr>
            <td valign="top" class="crdtext"  style="padding-bottom:2px;"><ul>
                <li>5 PAYBACK points on fuel purchases at HPCL on ICICI Merchant  Services swipe   machines, 2 PAYBACK points on all other purchases.</li>
            </ul></td>
          </tr>
                  </table>
		<? } else if($cc_bankid == 25)
		{ ?>
                <table cellpadding="0">
                <tr>
                <td valign="top" class="crdtext" height="50" style="padding-bottom:6px;"><b>Option I:</b> <ul>
               <li><b>Joining Fee</b> – Rs. 1,000 </li>
               <li><b>Annual Fee</b> –   Rs. 500 (2nd Year onwards; waived off if spends cross Rs. 1,25,000 in the previous year)               </li>
			   <li><b>Welcome Gift</b> - Satya Paul gifts worth Rs.5,000. </li>
            </ul>          </td>
          </tr>
		  <tr>
                <td valign="top" class="crdtext" height="50" style="padding-bottom:6px;"><b>Option I:</b> <ul>
               <li><b>Lifetime Fee</b> – Rs. 5,000 </li>
               		   <li><b>Welcome Gift</b> - Bose Headphones. </li>
            </ul>          </td>
          </tr>
         <tr>
            <td height="22" valign="bottom" class="crdbold">Reward Points</td>
        </tr>
          <tr>
            <td valign="top" class="crdtext"  style="padding-bottom:2px;"><ul>
                <li>2 PAYBACK points per Rs 100 spent, 4 PAYBACK points per Rs 100 spent on dining, groceries and supermarkets </li>
            </ul></td>
          </tr>
                  </table>
		<? } 
		else if($cc_bankid == 26)
		{ ?>
                 <table cellpadding="0">
                <tr>
                <td valign="top" class="crdtext" height="50" style="padding-bottom:6px;"><b>Option I:</b> <ul>
               <li><b>Joining Fee</b> – Rs. 5,000 </li>
               <li><b>Annual Fee</b> –   Rs. 2,000 (2nd Year onwards; waived off if spends cross Rs. 2,50,000 in the previous year)                </li>
			   <li><b>Welcome Gift</b> - Bose Headphones. </li>
            </ul>          </td>
          </tr>
		  <tr>
                <td valign="top" class="crdtext" height="50" style="padding-bottom:6px;"><b>Option I:</b> <ul>
               <li><b>Lifetime Fee</b> – Rs. 25,000 </li>
               		   <li><b>Welcome Gift</b> - Apple iPad2. </li>
            </ul>          </td>
          </tr>
         <tr>
            <td height="22" valign="bottom" class="crdbold">Reward Points</td>
        </tr>
          <tr>
            <td valign="top" class="crdtext"  style="padding-bottom:2px;"><ul>
                <li>4 PAYBACK Points on selected categories, 2 PAYBACK Points on others. 50% more reward points on American Express</li>
            </ul></td>
          </tr>
                  </table>
		<? }
		
		else if($cc_bankid == 27)
		{ ?>
                 <table cellpadding="0">
                <tr>
                <td valign="top" class="crdtext" height="50" style="padding-bottom:6px;"><b>Option I:</b> <ul>
               <li><b>Joining Fee</b> – Rs. 25,000 </li>
               <li><b>Annual Fee</b> –   Rs. 3,500 (2nd Year onwards; waived off if spends cross Rs. 5,00,000 in the previous year)                </li>
			   <li><b>Welcome Gift</b> - Apple iPad2. </li>
            </ul>          </td>
          </tr>
		  <tr>
                <td valign="top" class="crdtext" height="50" style="padding-bottom:6px;"><b>Option I:</b> <ul>
               <li><b>Lifetime Fee</b> – Rs. 75,000 </li>
               		   <li><b>Welcome Gift</b> - Apple Macbook Air. </li>
            </ul>          </td>
          </tr>
         <tr>
            <td height="22" valign="bottom" class="crdbold">Reward Points</td>
        </tr>
          <tr>
            <td valign="top" class="crdtext"  style="padding-bottom:2px;"><ul>
                <li>2 PAYBACK Points on Domestic Spends, 4 PAYBACK Points on International Spends. 50% more reward points on American Express.</li>
            </ul></td>
          </tr>
                  </table>
		<? }
		else if($cc_bankid == 29)
		{ ?>
		 <table cellpadding="0">
                <tr>
                <td valign="top" class="crdtext" height="50" style="padding-bottom:6px;"><b><div style="float:left;">Joining Fee </div><div style="font-size:9px;float:right; background-color:#FFFF00; color:#FF0000; width:80px;" >Exclusive offer</div></b><br> <ul>
				<li>Fee- Rs-<span style="text-decoration:line-through;">199</span>&nbsp;  Nil **</li>
                       <li><b>Annual Fee</b> –   Rs. 99 (waived off if spends cross Rs. 50,000 during previous year)                </li>
			   
            </ul>          </td>
          </tr>
		  
         <tr>
            <td height="22" valign="bottom" class="crdbold">Reward Points</td>
        </tr>
          <tr>
            <td valign="top" class="crdtext"  style="padding-bottom:2px;"><ul>
                <li>2 PAYBACK points for every Rs. 100 spent (except on fuel)</li>
            </ul></td>
          </tr>
		  <tr>
            <td height="22" valign="bottom" class="crdbold">Special Feature</td>
        </tr>
          <tr>
            <td valign="top" class="crdtext"  style="padding-bottom:2px;"><ul>
                <li>The card comes with a micro-chip that is difficult to duplicate.</li>
            </ul></td>
          </tr>
		  <tr><td style="font-size:11px;"><br />** Only for deal4loans customers</td></tr>
                  </table>
		<? }
		?>
					  </td>
<? if(strlen($Descr) >0)
{ ?>

					<td width="30" align="center" valign="top"><img src="new-images/crd-shado.gif" width="10" height="80" /></td>
                <td width="357" align="center" valign="top"  class="crdtext"><form name="hdfc_cc" action="<? echo $_SERVER['PHP_SELF'] ?>" method="POST" onSubmit="return ckhcreditcard(document.hdfc_cc); "><input type="hidden" name="RequestID" value="<? echo $ccuserid;?>">
				<input type="hidden" name="cc_bankid" value="<? echo $cc_bankid;?>">
				<input type="hidden" name="cc_bankid_nw" value="<? echo $cc_bankid;?>">
  		  	<table width="90%">
				<tr>
		<td width="52%" height="28" align="left" class="frmbldtxt">Existing Relationship with ICICI Bank</td>
		<td width="48%" align="left" class="frmbldtxt">
        <input type="radio" name="existing_relationship" id="existing_relationship" value="1"   onClick="addElement();" /> Yes  <input type="radio" name="existing_relationship" id="existing_relationship" value="0"   onClick="removeElement();" /> No
        </td>
	</tr>
    <tr>
       <td class="frmbldtxt" align="bottom" colspan="2" id="myDiv"></td></tr>
       <tr>
		<td width="52%" height="28" align="left" class="frmbldtxt">Address Line 1</td>
		<td width="48%" align="left" class="frmbldtxt">
          <textarea rows="1" cols="20" name="Residence_Address_line1" id="Residence_Address_line1"></textarea>
        </td>
	</tr>
    <tr>
		<td width="52%" height="28" align="left" class="frmbldtxt">Address Line 2</td>
		<td width="48%" align="left" class="frmbldtxt">
          <textarea rows="1" cols="20" name="Residence_Address_line2" id="Residence_Address_line2"></textarea>
        </td>
	</tr>
     <tr>
		<td width="52%" height="28" align="left" class="frmbldtxt">City</td>
		<td width="48%" align="left" class="frmbldtxt">
          <select name="Address_City" id="Address_City"  style="font-family:Verdana, Geneva, sans-serif; font-size:11px; color:#4c4c4c;">
                            <?=plgetCityList($City)?>                 
                        </select>
        </td>
	</tr>
     <tr>
		<td width="52%" height="28" align="left" class="frmbldtxt">Pincode</td>
		<td width="48%" align="left" class="frmbldtxt">
          <input type="text" name="Pincode" id="Pincode">
        </td>
	</tr>
	 <tr>
	   <td colspan="2" align="center"><input name="submit" type="submit" style="width: 143px; height: 63px; border: 0px none ; background-image: url(new-images/cards-apply.gif); margin-bottom: 0px;" value=""/></td>
	 </tr>
				</table>
					</form>
	</td>
<? } ?>
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
   
  <? if($existing_rel==0 || $existing_rel==1)
{ ?>
  <?php include '~Bottom-new.php';?><?php } ?>
</div><!-- </div> -->
</body>
</html>