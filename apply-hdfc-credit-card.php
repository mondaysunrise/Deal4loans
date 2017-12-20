<?php
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	$Dated = ExactServerdate();

//print_r($_POST);

	$ccuserid = $_REQUEST['RequestID'];
$cc_bankid = $_REQUEST['cc_bankid'];


if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
	foreach($_POST as $a=>$b)
			$$a=$b;

	$company_cate_type = $_POST["company_cate_type"];
	$Std_Code1= $_POST["Std_Code1"];
	$Std_Code2= $_POST["Std_Code2"];
	$Phone1= $_POST["Phone1"];
	$Phone2= $_POST["Phone2"];
	$ext= $_POST["ext"];
	$landline_o=$Phone2."-".$ext;	
if($cc_bankid==10)
	{
	$Descr="HDFC Gold Card";
}
else if ($cc_bankid==16)
	{
$Descr="HDFC Titanium Card";
	}
	else if ($cc_bankid==15)
	{
$Descr="HDFC Platinum Plus Card";
	}

//$ccupdate= "Update Req_Credit_Card  set Company_Type='".$company_cate_type."',Std_Code_O='".$Std_Code2."' ,Landline_O='".$Phone2."',Landline='".$Phone1."' ,Std_Code='".$Std_Code1."',Descr='".$Descr."',Dated=Now()  Where (Req_Credit_Card.RequestID=".$ccuserid.")";
	//ExecQuery($ccupdate);
	//echo $ccupdate."<br>";
	
	
$DataArray = array("Company_Type"=>$company_cate_type, "Std_Code_O"=>$Std_Code2, "Landline_O"=>$Phone2, "Landline"=>$Phone1, "Std_Code"=>$Std_Code1, "Descr"=>$Descr, "Dated"=>$Dated);
$wherecondition ="(Req_Credit_Card.RequestID=".$ccuserid.")";
Mainupdatefunc ('Req_Credit_Card', $DataArray, $wherecondition);

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
function ckhcreditcard(Form)
{
	if(Form.company_cate_type.selectedIndex==0)
	{
		alert("Please enter Company Type Name to Continue");
		Form.company_cate_type.focus();
		return false;
	}
	if(Form.Std_Code1.value=='' || Form.Std_Code1.value=='std' )
	{
	alert("Kindly fill Std Code.");
	Form.Std_Code1.focus();
	return false;
	}
	if(Form.Phone1.value=='')
	{
	alert("Kindly fill Lanline no.");
	Form.Phone1.focus();
	return false;
	}
}
</script>
</head>
<body>
<? if($company_cate_type>0)
{ ?>
<?php include '~Top-new.php';?>
<?php include '~menu.php';?>
<? } 
else
{ ?>
<div id="dvtpbg">
<div id="logo">
<img onclick="javascript:location.href='http://www.deal4loans.com/'" alt="Deal4loans" src="/new-images/d4l-logo.gif"/>
</div>
</div>
<? } ?>
<div id="container">
  <!--<span><a href="index.php">Home</a> > <a href="credit-cards.php">Credit Card</a> </span>-->
  <div id="txt" style="padding-top:15px;">
  <? if($company_cate_type>0)
{ ?>
 <h1 style="color:#ae4212 !important; margin:0px; padding:0px; font-size:13px !important; line-height:22px; text-align:left;"> Thanks for applying HDFC Credit Card through Deal4loans.com. </h1>
 <? } 
 else
 {?>
 <h1 style="color:#ae4212 !important; margin:0px; padding:0px; font-size:13px !important; line-height:22px; text-align:left;"> Your application for Hdfc Card is 90% complete.<br />
Please fill in few more details for your online application.</h1>

 <? } ?>
  <div style="clear:both;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td valign="top" class="crdtext">
	<? if($company_cate_type==4 || $company_cate_type==5)
	{ ?>
		<h1 style="color:#ae4212 !important; margin:0px; padding:0px; font-size:13px !important; line-height:22px; text-align:left;"> We're sorry. As per eligibility criteria of HDFC Bank, We will not be able to offer Credt card Product.</h1>
	<? }
	else
	{ ?>
	<table width="100%"  border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td height="35" valign="middle"   class="crdhorizonbg"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td colspan="2" ><?	if($cc_bankid==16)
				{ ?>
				HDFC Titanium Card 
			<? 	}
				else if ($cc_bankid==15)
		{ ?>
			HDFC Platinum Plus Card 
	<? }
		else 
		{ ?>
				HDFC Gold Card 
				<? } ?></td>
                </tr>
          </table></td>
        </tr>
        <tr>
          <td class="yelobordr"><table width="98%"  border="0" align="center" cellpadding="0" cellspacing="0">
              <tr>
                <td width="185" align="center" valign="middle">
			<?	if($cc_bankid==16)
				{ ?>
				<img src="new-images/hdfc-titanium-crd.jpg"  width="140" height="85"/> 
			<? 	}
				else if($cc_bankid == 15)
				{ ?>
				<img src="new-images/hdfc-platinum-crd.jpg"  width="140" height="85"/> 
				<? }
				else
		{ ?>
		<img src="new-images/hdfc-gold-crd.jpg"  width="140" height="85"/> 
		<? } ?>
				</td>
				
                <td width="30" align="center"><img src="new-images/crd-shado.gif" width="10" height="80" /></td>
                <td width="369" valign="top" class="crdtext"><b>Features :</b>
				<? if($cc_bankid==16) 
		{?>
		<ul>
<li>Fee-Rs 249 P.a</li>
<li>Earn 2 Reward Points for every Rs.150 spends.</li>
<li>From 1st April 2011, earn 50% more Reward Points (i.e total 3 Reward Points per Rs. 150) on incremental spends above Rs. 35,000 per statement cycle.</li>
<li>No Fuel surcharge at any Petrol pump across India.</li></ul>
          
					  <? } 
				else 
		{ ?>
<ul><li>From 1st April 2011, earn 50% more Reward Points (i.e total 1.5 Reward Points per Rs. 150) on incremental spends above Rs. 20,000 per statement cycle.
</li>
                              <li>Annual Fee : 199 Rs. </li>
							  <li><b>Spend condition for waiver of annual charges.</b><br />1st year fee waiver condition: Rs. 5,000 retail spends in 1st 3 months from the card setup date.Renewal fee (2nd year onwards) waiver condition: Rs.15,000 retail spends in 12 months from card renewal date.
 </li>
                      </ul>
		<? }?>
					  </td>
<? if($company_cate_type>0)
				{

				}
				else {
					?>
					<td width="30" align="center"><img src="new-images/crd-shado.gif" width="10" height="80" /></td>
                <td width="357" align="center" valign="middle"  class="crdtext"><form name="hdfc_cc" action="apply-hdfc-credit-card.php" method="POST" onSubmit="return ckhcreditcard(document.hdfc_cc); "><input type="hidden" name="RequestID" value="<? echo $ccuserid;?>">
				<input type="hidden" name="cc_bankid" value="<? echo $cc_bankid;?>">
  		  	<table width="90%">
				<tr>
		<td width="52%" height="28" align="left" class="frmbldtxt">Company Type </td>
		<td width="48%" align="left" class="frmbldtxt"><select name="company_cate_type" id="company_cate_type" style="width: 145px; font-size:13px;" tabindex="10">
		<option value="0">Please Select</option>
		<option value="1">Pvt Ltd</option>
		<option value="2">MNC Pvt Ltd</option>
		<option value="3">Limited</option>
		<option value="4">Partnership</option>
		<option value="5">Sole Proprietor</option>
		</select></td>
	</tr>
		<!--<tr> <td width="45%" align="left" class="boldtxt"> Company Category </td>
		<td width="55%" align="left"><select name="company_type" id="company_type" tabindex="11" style="width: 149px; font-size:13px;">
		<option value="">Please Select</option>
		<option value="BPO">BPO</option>
		<option value="Insurance">Insurance</option>
		<option value="Others">Others</option>
		</select>
		</td>
	</tr>-->
	<tr>
       <td class="frmbldtxt" align="bottom">Residence Landline no / Office Landline no</td>
	   <td class="frmbldtxt"><input type="text" name="Std_Code1" id="Std_Code1" style="width:25px;" maxlength="5" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this)"; value="std">&nbsp;<input type="text" name="Phone1" style="width:110px;" maxlength="10" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this)";></td>
     </tr>
	 <!--<tr>
       <td class="frmbldtxt" align="bottom">Office Landline No</td>
	   <td class="frmbldtxt"><input type="text" name="Std_Code2" style="width:25px;" maxlength="5" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this)"; value="std">&nbsp;<input type="text" name="Phone2" style="width:75px;" maxlength="10" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this)";>&nbsp;<input type="text" name="ext" id="ext" style="width:35px;" maxlength="5" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this)"; value="Ext"></td>
     </tr>
	 <tr>
       <td class="frmbldtxt" align="bottom">&mbsp;</td>
	   <td style="height:10px;">std&nbsp;<input type="text" name="Phone2" style="width:75px;" maxlength="10" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this)";>&nbsp;<input type="text" name="ext" id="ext" style="width:35px;" maxlength="5" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this)"; value="Ext"></td>
     </tr>-->
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
	  <? } ?>
     
	  </td>
  </tr>
</table>
</div>
</div>
   
  <? if($company_cate_type>0)
{ ?>
  <?php include '~Bottom-new.php';?><?php } ?>
</div><!-- </div> -->
</body>
</html>