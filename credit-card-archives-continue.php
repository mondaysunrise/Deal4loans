<?php
require 'scripts/db_init.php';
	require 'scripts/functions.php';
//error_reporting ( E_ALL );

	session_start();
//print_r($_POST);
	$name = $_POST['name'];
	$mobile = $_POST['mobile'];
	$email = $_POST['email'];
	$city = $_POST['city'];
	$source = $_POST['source'];
	$card_type_cc = $_POST['card_type_cc'];				
	$card_type_dc = $_POST['card_type_dc'];
	$Accidental_Insurance =$_POST['Accidental_Insurance'];
        $url = "credit-card-archives-continue.php";
//$IP = getenv("REMOTE_ADDR");
$IP=ExactCustomerIP();


if($city=="Ahmedabad" || $city=="Bangalore" || $city=="Chennai" ||  $city=="Delhi" || $city=="Hyderabad" || $city=="Kolkata" || $city=="Mumbai" || $city=="Pune")
{
	$strcity=$city;
}
else
{
	$strcity="All";
}
	if(strlen($name)>0 && strlen($email)>0 && strlen($mobile)>0 && strlen($city)>0)
	{
		//echo "deal4loans"; die;
		$Dated = ExactServerdate();
		//$dataInsert = array('name'=>$name, 'email'=>$email, 'mobile'=>$mobile, 'city'=>$city, 'ccholder_bank'=>$From_Pro, 'source'=>$source, 'accidental_insurance'=>$Accidental_Insurance, 'mailer_dated'=>$Dated, 'mailerip'=>$IP, 'url'=>$url);
                //$last_id = Maininsertfunc('store_records_mailer', $dataInsert);	
               
$dataInsert = d4l_ExecQuery("INSERT INTO `store_records_mailer` (`mailerid`, `name`, `email`, `mobile`, `city`, `ccholder_bank`, `accidental_insurance`, `source`, `mailer_dated`, `mailerip`, `url`) VALUES (NULL, '".$name."','".$email."','".$mobile."','".$city."','".$From_Pro."','".$source."','".$Accidental_Insurance."','".$Dated."','".$IP."','".$url."')");             

		
		//Send SMS
		ProductSendSMStoRegis($mobile);	
	}
	else
	{
		echo "<script language=javascript>"." location.href='earn-credit-card1.php'"."</script>";	
	}
	?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href='http://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css' />
<link href='http://fonts.googleapis.com/css?family=Droid+Serif' rel='stylesheet' type='text/css' />  
<title>Apply for Credit Card | Credit Card Application | Credit Cards Comparison Chart</title>
<meta name="keywords" content="Credit Card Application, Apply Credit Cards, Compare Credit Cards in Mumbai Hyderabad Pune kolkata Delhi Noida Bangalore" />
<link href="source.css" rel="stylesheet" type="text/css" />
<link href="css/common-d4l-styles.css" type="text/css" rel="stylesheet"  />
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0" />
<script type="text/javascript" src="scripts/mainmenu.js"></script>
<style type="text/css">

body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	background-color: #203f5f;
	overflow-x:hidden;
	background-color:#FFF;
}
.red {
	color: #F00;
}
.nrmltxt {
font-family: Verdana, Geneva, sans-serif;
	font-size: 11px;
	font-weight: normal;
	font-variant: normal;
	color: #4c4c4c;
	text-decoration: none; 
}
</style>
<script type="text/javascript">
function ccofferformstep2()
{
	var btn2;
	var btn1;
	var btn3;
	if(!(document.getElementById('card_type_cc').checked) && !(document.getElementById('card_type_dc').checked))
	{
		alert("please choose any Card Type");
		return false;
		
	}
	

	if(document.getElementById('card_type_cc').checked)
	{

		btn1=forCC();
		if(!btn1)
		{
			alert('Click on bank and Choose Credit Card');
			return false;
		}
	}
	if(document.getElementById('card_type_dc').checked)
	{

		btn2=forDC();
		if(!btn2)
		{
			alert('Click on bank and Choose Debit card');
			return false;
		}
	}
		
}
function forCC()
{
	var cnt = -1;
		var i;
		for(i=0; i<document.CC_offers_form.category_cc.length; i++) 
		{
			if(document.CC_offers_form.category_cc[i].checked)
			{
				cnt=i;
				
			}
		}
		if(cnt > -1)
		{ 
			return true;
		}
		else
		{
			return false;
		}

}


function forDC()
{
var cnt1 = -1;
		var j;
		for(j=0; j<document.CC_offers_form.category_dc.length; j++) 
		{
			if(document.CC_offers_form.category_dc[j].checked)
			{
				cnt1=j;
				
			}
		}
		if(cnt1 > -1)
		{ 
			return true;
		}
		else
		{
			return false;
		}
	            
}
/**AJAX SCRIPT**************************************************************/


var ajaxRequest;  // The variable that makes Ajax possible!
		function ajaxFunction(){
			
			try{
				// Opera 8.0+, Firefox, Safari
				ajaxRequest = new XMLHttpRequest();
			} catch (e){
				// Internet Explorer Browsers
				try{
					ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
				} catch (e) {
					try{
						ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
					} catch (e){
						// Something went wrong
						alert("Your browser broke!");
						return false;
					}
				}
			}
		}

		function getdivdetailscc()
		{
			var card_type=document.getElementById('card_type_cc').value;		
			//alert(card_type);
			if((document.getElementById('card_type_cc').checked))
			{
				var queryString = "?card_type=" + card_type;
		//alert(queryString); 
				ajaxRequest.open("GET", "get_ccdetails.php" + queryString, true);
				// Create a function that will receive data sent from the server
				ajaxRequest.onreadystatechange = function(){
					if(ajaxRequest.readyState == 4)
					{				
						// alert(ajaxRequest.responseText);
						var ajaxDisplay = document.getElementById('myDivcc');
					   ajaxDisplay.innerHTML = ajaxRequest.responseText;
					}
				}
				ajaxRequest.send(null); 
			 }
			 else
			 {
				 var ajaxDisplay = document.getElementById('myDivcc');
				 ajaxDisplay.innerHTML = "";
			 }
		}
		
		function getdivdetailsdc()
		{
			var card_type=document.getElementById('card_type_dc').value;		
			if((document.getElementById('card_type_dc').checked))
			{
				var queryString = "?card_type=" + card_type;
		//alert(queryString); 
				ajaxRequest.open("GET", "get_dcdetails.php" + queryString, true);
				// Create a function that will receive data sent from the server
				ajaxRequest.onreadystatechange = function(){
					if(ajaxRequest.readyState == 4)
					{				
						// alert(ajaxRequest.responseText);
						var ajaxDisplay = document.getElementById('myDivdc');
					   ajaxDisplay.innerHTML = ajaxRequest.responseText;
					}
				}
				ajaxRequest.send(null); 
			 }
			 else
			 {
				 var ajaxDisplay = document.getElementById('myDivdc');
				 ajaxDisplay.innerHTML = "";
			 }
		}
		
	window.onload = ajaxFunction;
/***********************************************************/

function addElement()
{
		var ni = document.getElementById('myDiv');
		
		if(ni.innerHTML=="")
		{
		
			if(document.CC_offers_mailer.card_type.value="on")
			{
				//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = '<tr><td width="75" height="26" align="left" class="bldtxt">Credit Card</td><td align="left"><select name="city" style="width:135px; font-size:11px;"><option>Please Select</option> <option>CC Card</option></select></td></tr>';
				

			}
		}
		
		return true;

	}
	function addDCElement()
{
		var ni = document.getElementById('myDCDiv');
		
		if(ni.innerHTML=="")
		{
		
			if(document.CC_offers_mailer.card_type.value="on")
			{
				//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = '<tr><td width="75" height="26" align="left" class="bldtxt">Debit Card</td><td align="left"><select name="city" style="width:135px; font-size:11px;"><option>Please Select</option> <option>CC Card</option></select></td></tr>';
				

			}
		}
		
		return true;

	}


function removeElement()
{
		var ni = document.getElementById('myDiv');
		
		if(ni.innerHTML!="")
		{
		
			if(document.CC_offers_mailer.CC_Holder.value="on")
			{
				//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = '';
				
			}
		}
		
		return true;

	}

	function addBankdetails1()
	{
        var ni = document.getElementById('myDivcc');
            if(ni.innerHTML=="")
        {
				   ni.innerHTML = '<table width="230" border="0" align="right" cellspacing="0" cellpadding="0" ><tr><td class="bldtxt" valign="middle"> <img src="images/plus2.gif" alt="" onClick="showdetailsFaq(1,12)" id="imgfaq1"  height="13" width="12" style="cursor:pointer;"> <span  onclick="showdetailsFaq(1,12)" style="cursor:pointer; font-weight:bold;" >ABN AMRO </span><div style="display: none;" id="divfaq1">';

        }
    return true;
    }

	function removeBankdetails1()
	{
        var ni = document.getElementById('myDivcc');
        if(ni.innerHTML!="")
        {
	        ni.innerHTML = '';
        }
        return true;
    }

	function addBankdetailsdc()
	{
        var ni = document.getElementById('myDivdc');
            if(ni.innerHTML=="")
        {
				   ni.innerHTML = '<table width="230" border="0" align="right" cellspacing="0" cellpadding="0" ><tr><td class="bldtxt" valign="middle"> <img src="images/plus2.gif" alt="" onClick="showdetailsFaq(1,12)" id="imgfaq1"  height="13" width="12" style="cursor:pointer;"> <span  onclick="showdetailsFaq(1,12)" style="cursor:pointer; font-weight:bold;" >ABN AMRO </span><div style="display: none;" id="divfaq1">';

        }
    return true;
    }

	function removeBankdetailsdc()
	{
        var ni = document.getElementById('myDivdc');
        if(ni.innerHTML!="")
        {
	        ni.innerHTML = '';
        }
        return true;
    }

</script>
<script language="JavaScript" type="text/javascript" src="scripts/rollovers.js"></script>
	<script language="JavaScript">
	  function showdetailsFaq(d,e)
			{			
				for(j=1;j<=e;j++)
					{
						if(d==j)
							{
								//alert("imgfaq"+j);
								if(eval(document.getElementById("divfaq"+j)).style.display=='none')
									{
										
										eval(document.getElementById("divfaq"+j)).style.display=''
										eval(document.getElementById("imgfaq"+j)).src='images/minus2.gif'
									}
								else
									{
										
										eval(document.getElementById("divfaq"+j)).style.display='none'
										eval(document.getElementById("imgfaq"+j)).src='images/plus2.gif'
									}
							}
						else
							{
								
								//eval(document.getElementById("divfaq"+j)).style.display="none"
								//eval(document.getElementById("imgfaq"+j)).src='/images/plus.gif'
							}
					}
			}
			
			function showdetailsFaqDc(d,e)
			{			
				for(j=1;j<=e;j++)
					{
						if(d==j)
							{
								if(eval(document.getElementById("divfaqdc"+j)).style.display=='none')
									{
									
										eval(document.getElementById("divfaqdc"+j)).style.display=''
										eval(document.getElementById("imgfaqdc"+j)).src='images/minus2.gif'
									}
								else
									{
										
										eval(document.getElementById("divfaqdc"+j)).style.display='none'
										eval(document.getElementById("imgfaqdc"+j)).src='images/plus2.gif'
									}
							}
						else
							{
								
								//eval(document.getElementById("divfaq"+j)).style.display="none"
								//eval(document.getElementById("imgfaq"+j)).src='/images/plus.gif'
							}
					}
			}
							//window.onload=showdetailsFaq
</script>
</head>
<body>
<!--top-->
<?php include "middle-menu.php"; ?>
<div class="lac-main-wrapper">
<div class="text12" style="margin:auto; width:100%; height:11px; margin-top:70px; color:#0a8bd9;"><u><a href="index.php" class="text12" style="color:#0080d6;" >Home</a> > <a href="credit-cards.php"  class="text12" style="color:#0080d6;">Credit Card</a> > <span class="text12" style="color:#4c4c4c;">Apply Credit Card</span></u></div>
<div class="intrl_txt">

<div style="clear:both; height:15px;"></div>

    <form  name="CC_offers_form" action="check-cc.php" method="POST" ONsubmit="return ccofferformstep2(document.CC_offers_form);">
   <div class="agent-form-archive"> 
    <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
	<input type="hidden" name="last_id"  maxlength="30" value="<?php echo $last_id;?>" readonly />
	<input type="hidden" name="name"  maxlength="30" value="<?php echo $name;?>"  />
      <tr>
        <td  >&nbsp;</td>
      </tr>
      <tr>
        <td width="100%" height="58" align="center" class="text">To Get Updated Card Rewards/Offers, <u>Register Here</u></td>
    </tr>
      
      <tr>
        <td valign="top" align="center" bgcolor="#f6fcff"><table width="97%" border="0" align="center" cellpadding="0" cellspacing="0"  >
          <tr>
            <td align="center" valign="middle" class="bldtxt"><table width="80%" border="0" align="center" cellpadding="2" cellspacing="1" bgcolor="#d3ecf8">
                <tr>
                  <td height="22" bgcolor="#f6fcff" class="nrmltxt" style="font-weight:bold;">Name</td>
                  <td bgcolor="#f6fcff"><input type="text" name="name2"  maxlength="30" value="<?php echo $name;?>" readonly="readonly" /></td>
                </tr>
                <tr>
                  <td height="22" bgcolor="#f6fcff" class="nrmltxt" style="font-weight:bold;">Mobile</td>
                  <td valign="middle" bgcolor="#f6fcff" class="bldtxt" style="font-weight:bold; ">+ 91
                      <input type="text" name="mobile" style="width:105px; border:none; font-size:11px; font-weight:bold; color:#07468C;" value="<?php echo $mobile;?>" maxlength="10" /></td>
                </tr>
                <tr>
                  <td height="22" bgcolor="#f6fcff" class="nrmltxt" style="font-weight:bold;">Email Id </td>
                  <td bgcolor="#f6fcff"><input type="text" name="email" maxlength="30" value="<?php echo $email;?>" readonly="readonly" /></td>
                </tr>
                <tr>
                  <td height="22" bgcolor="#f6fcff" class="nrmltxt" style="font-weight:bold;">City</td>
                  <td bgcolor="#f6fcff"><input type="text" name="city"  maxlength="30" value="<?php echo $city;?>" readonly="readonly" /></td>
                </tr>
            </table></td>
          </tr>
          <tr>
            <td height="30" align="center" valign="middle" class="text">I require following Card Offers/Rewards</td>
          </tr>
          <tr>
            <td height="25" align="center" valign="middle" ><div class="overflow-width"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="14%" align="right"  ><input type="checkbox" value="1" name="card_type_cc" id="card_type_cc" <?php if($card_type_cc==1) echo "checked"; ?>   onclick="getdivdetailscc();" style="border:none;" /></td>
                  <td width="32%" align="left" class="text11" style="color:#4c4c4c; ">Credit Card</td>
                  <td width="8%" align="right" ><input type="checkbox" value="2" name="card_type_dc" id="card_type_dc" <?php if($card_type_dc==2) echo "checked"; ?> onclick="getdivdetailsdc();"  style="border:none;"/></td>
                  <td width="46%" align="left" class="text11" style="color:#4c4c4c; ">Debit Card</td>
                </tr>
                <tr>
                  <td colspan="4" align="center" style="padding-left:40px; margin-left:40px;"  ><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                      <tr>
                        <td id="myDivcc" valign="top" align="left" ><?php 
				if($card_type_cc==1)
				{
				?>
                            <table border="0" cellspacing="0" cellpadding="0" align="left">
                              <?php
				
$selectcard="select * From creditndebit_card_offer where (ccndc_offer_type=1 and ccndc_approval=1 and city_list like '%".$strcity."%') group by bank_name ";
list($getrecordcount,$myrow)=MainselectfuncNew($selectcard,$array = array());

$i=1;
for($j=0;$j<$getrecordcount;$j++)
{
	?>
                              <tr>
                                <td><table width="100%" border="0" align="left" cellspacing="0" cellpadding="0">
                                    <tr>
                                      <td height="22" class="bldtxt"  valign="middle" align="left" ><img src="images/plus2.gif" alt="" name="imgfaq<? echo $i;?>" width="12"  height="12"  id="imgfaq<? echo $i;?>" style="cursor:pointer;" onclick="showdetailsFaq(<? echo $i;?>,13)" /> <span  onclick="showdetailsFaq(<? echo $i;?>,13)" class="text11"><? echo $myrow[$j]["bank_name"];?></span>
                                          <div style="display: none;" id="divfaq<? echo $i;?>">
                                            <table width="100%" border="0" align="left" cellspacing="0" cellpadding="0" >
                                              <?
	$selecttype="select * From creditndebit_card_offer where (bank_name='".$myrow[$j]["bank_name"]."' and ccndc_offer_type=1 and ccndc_approval=1 and city_list like '%".$strcity."%')";
	list($recordcount,$row)=MainselectfuncNew($selecttype,$array = array());
	if($i>1)
	{
		$r=100+$i;
	}
	else
	{
		$r=100;
	}
	$p=100;
	if($recordcount>0)
	{
		for($k=0;$k<$recordcount;$k++)
		{
			?>
                                              <tr>
                                                <td width="25" align="left" valign="top"><input type="checkbox" value="<? echo $row[$k]["ccndc_offerid"];?>_<? echo $row[$k]["bank_name"];?>" name="category_cc[]" id="category_cc" style="border:none; cursor:pointer;" onclick="showdetailsFaq(<? echo $r;?>,800)" />
                                                    <? // echo $row["ccndc_offerid"];?>
                                                </td>
                                                <td class="nrmltxt" align="left"><span  onclick="showdetailsFaq(<? echo $r;?>,800)" style="cursor:pointer;" ><? echo $row[$k]["card_name"];?></span>
                                                    <div style="display:none;" id="divfaq<? echo $r;?>">
                                                      <table width="100%" border="0" cellspacing="0" cellpadding="0" align="left">
                                                        <tr>
                                                          <td  width="25" align="left" valign="top"><input type="checkbox" value="dinning_offers" name="category_cc_<?php	 echo $row[$k]["ccndc_offerid"]; ?>[]" style="border:none"/></td>
                                                          <td class="nrmltxt" align="left">Dinning Offers</td>
                                                        </tr>
                                                        <tr>
                                                          <td  width="25" align="left" valign="top"><input type="checkbox" value="travel_offers" name="category_cc_<?php echo $row[$k]["ccndc_offerid"]; ?>[]" style="border:none"/></td>
                                                          <td class="nrmltxt" align="left">Travel Offer</td>
                                                        </tr>
                                                        <tr>
                                                          <td  width="25" align="left" valign="top"><input type="checkbox" value="shopping_offers" name="category_cc_<?php echo $row[$k]["ccndc_offerid"]; ?>[]" style="border:none"/></td>
                                                          <td class="nrmltxt" align="left">Shopping Offer</td>
                                                        </tr>
                                                        <tr>
                                                          <td  width="25" align="left" valign="top"><input type="checkbox" value="entertainment_offers" name="category_cc_<?php echo $row[$k]["ccndc_offerid"]; ?>[]" style="border:none"/></td>
                                                          <td class="nrmltxt" align="left">Entertainment Offer</td>
                                                        </tr>
                                                        <tr>
                                                          <td  width="25" align="left" valign="top"><input type="checkbox" value="petrol_offers" name="category_cc_<?php echo $row[$k]["ccndc_offerid"]; ?>[]" style="border:none"/></td>
                                                          <td class="nrmltxt" align="left">Petrol Offer</td>
                                                        </tr>
                                                        <tr>
                                                          <td   width="25" align="left" valign="top"><input type="checkbox" value="reward_points_offers" name="category_cc_<?php echo $row[$k]["ccndc_offerid"]; ?>[]" style="border:none"/></td>
                                                          <td class="nrmltxt" align="left">Reward Points Offers</td>
                                                        </tr>
                                                        <tr>
                                                          <td   width="25" align="left" valign="top"><input type="checkbox" value="other_offers" name="category_cc_<?php	echo $row[$k]["ccndc_offerid"]; ?>[]" style="border:none"/></td>
                                                          <td class="nrmltxt" align="left">Other Offers</td>
                                                        </tr>
                                                      </table>
                                                    </div></td>
                                              </tr>
                                              <? $r=$p+$row[$k]["ccndc_offerid"]; 
		 } ?>
                                              <? 
	
	} ?>
                                            </table>
                                          </div></td>
                                    </tr>
                                </table></td>
                              </tr>
                              <? $i=$i+1;
}
?>
                            </table>
                          <?php
}
?></td>
                        <td align="left" valign="top" id="myDivcc" >&nbsp;</td>
                        <td id="myDivdc" valign="top"  align="right" ><?php
if($card_type_dc==2)
{
?>
                            <table align="left" cellpadding="0" cellspacing="0">
                              <?php
$selectcard="select * From creditndebit_card_offer where (ccndc_offer_type=2 and ccndc_approval=1 and city_list like '%".$strcity."%') group by bank_name ";
list($getrecordcount,$myrow)=MainselectfuncNew($selectcard,$array = array());

$i=1;
for($j=0;$j<$getrecordcount;$j++)
{
	?>
                              <tr>
                                <td><table width="100%" border="0" align="right" cellspacing="0" cellpadding="0">
                                    <tr>
                                      <td height="22" class="bldtxt" valign="middle" align="left" ><img src="images/plus2.gif" alt="" onclick="showdetailsFaqDc(<? echo $i;?>,12)" id="imgfaqdc<? echo $i;?>"  height="12" width="12" style="cursor:pointer;" /> <span  onclick="showdetailsFaqDc(<? echo $i;?>,12)" class="text11"><? echo $myrow[$j]["bank_name"];?></span>
                                          <div style="display: none;" id="divfaqdc<? echo $i;?>">
                                            <table width="100%" border="0" align="right" cellspacing="0" cellpadding="0" >
                                              <?
	$selecttype="select * From creditndebit_card_offer where (bank_name='".$myrow[$j]["bank_name"]."' and ccndc_offer_type=2 and ccndc_approval=1 and city_list like '%".$strcity."%')";
	list($recordcount,$row)=MainselectfuncNew($selecttype,$array = array());
	if($i>1)
	{
		$r=141+$i;
	}
	else
	{
		$r=141;
	}
	$p=100;
	if($recordcount>0)
	{
		for($k=0;$k<$recordcount;$k++)
		{
			//echo $r;
			//echo "<br>";
			?>
                                              <tr>
                                                <td  width="25" align="left" valign="top"><input type="checkbox" value="<? echo $row[$k]["ccndc_offerid"];?>_<? echo $row[$k]["bank_name"];?>" name="category_dc[]" id="category_dc" style="border:none; cursor:pointer;" onclick="showdetailsFaqDc(<? echo $r;?>,800)"/>
                                                </td>
                                                <td class="nrmltxt" align="left"><span  onclick="showdetailsFaqDc(<? echo $r;?>,800)" style="cursor:pointer;" ><? echo $row[$k]["card_name"];?></span>
                                                    <div style="display:none;" id="divfaqdc<? echo $r;?>">
                                                      <table width="100%" border="0" cellspacing="0" cellpadding="0" align="left">
                                                        <tr>
                                                          <td  width="25" align="left" valign="top"><input type="checkbox" value="dinning_offers" name="category_dc_<?php	echo $row[$k]["ccndc_offerid"]; ?>[]" style="border:none"/></td>
                                                          <td class="nrmltxt" align="left">Dinning Offers</td>
                                                        </tr>
                                                        <tr>
                                                          <td  width="25" align="left" valign="top"><input type="checkbox" value="travel_offers" name="category_dc_<?php echo $row[$k]["ccndc_offerid"]; ?>[]" style="border:none"/></td>
                                                          <td class="nrmltxt" align="left">Travel Offer</td>
                                                        </tr>
                                                        <tr>
                                                          <td  width="25" align="left" valign="top"><input type="checkbox" value="shopping_offers" name="category_dc_<?php	echo $row[$k]["ccndc_offerid"]; ?>[]" style="border:none"/></td>
                                                          <td class="nrmltxt" align="left">Shopping Offer</td>
                                                        </tr>
                                                        <tr>
                                                          <td  width="25" align="left" valign="top"><input type="checkbox" value="entertainment_offers" name="category_dc_<?php echo $row["ccndc_offerid"]; ?>[]" style="border:none"/></td>
                                                          <td class="nrmltxt" align="left">Entertainment Offer</td>
                                                        </tr>
                                                        <tr>
                                                          <td  width="25" align="left" valign="top"><input type="checkbox" value="petrol_offers" name="category_dc_<?php echo $row["ccndc_offerid"]; ?>[]" style="border:none"/></td>
                                                          <td class="nrmltxt" align="left">Petrol Offer</td>
                                                        </tr>
                                                        <tr>
                                                          <td  width="25" align="left" valign="top"><input type="checkbox" value="reward_points_offers" name="category_dc_<?php	echo $row[$k]["ccndc_offerid"]; ?>[]" style="border:none"/></td>
                                                          <td class="nrmltxt">Reward Points Offers</td>
                                                        </tr>
                                                        <tr>
                                                          <td width="25" align="left" valign="top"><input type="checkbox" value="other_offers" name="category_dc_<?php echo $row[$k]["ccndc_offerid"]; ?>[]" style="border:none"/></td>
                                                          <td class="nrmltxt" align="left">Other Offers</td>
                                                        </tr>
                                                      </table>
                                                    </div></td>
                                              </tr>
                                              <? $r=$p+$row[$k]["ccndc_offerid"]; 
		 } ?>
                                              <? 
	
	} ?>
                                            </table>
                                          </div></td>
                                    </tr>
                                </table></td>
                              </tr>
                              <? $i=$i+1;
}
?>
                            </table>
                          <?php
}
?></td>
                      </tr>
                  </table></td>
                </tr>
            </table></div></td>
          </tr>
          <tr>
            <td height="35" align="center" valign="middle"><input name="submit" value="Subscribe" type="submit" style=" background: url(images/cc-sbsrb.jpg); width:143px; height:37px; font-size:0px; color:#FFFFFF; border:none;"/></td>
          </tr>
        </table>
          </td>
      </tr>
      
      <tr>
        <td height="22" align="center" valign="top" bgcolor="#f6fcff"></td>
                </tr>
      </table>
      </div>
      
    </form>
  

<div style="clear:both; height:15px;"></div>
</div>
</div>
<!--partners-->
<!--partners-->
<?php include("footer_sub_menu.php"); ?>
</body>
</html>
