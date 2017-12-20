<?php
require 'scripts/db_init.php';
require 'scripts/functions.php';
	
	?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<script language="JavaScript" type="text/javascript" src="scripts/rollovers.js"></script>
	<script Language="JavaScript" Type="text/javascript">
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
<table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="14%" align="right"  ><input type="checkbox" value="1" name="card_type_cc" id="card_type_cc" <?php if($card_type_cc==1) echo "checked"; ?>   onClick="getdivdetailscc();" style="border:none;" /></td>
                    <td width="32%" class="bldtxt">Credit Card</td>
                    <td width="8%" align="right" ><input type="checkbox" value="2" name="card_type_dc" id="card_type_dc" <?php if($card_type_dc==2) echo "checked"; ?> onClick="getdivdetailsdc();"  style="border:none;"/></td>
                    <td width="46%" class="bldtxt">Debit Card</td>
                  </tr>
              <tr>
                <td colspan="4" align="center" style="padding-left:40px; margin-left:40px;"  ><table width="582" border="0" align="center" cellpadding="0" cellspacing="0">
                        <tr>
                          <td id="myDivcc" valign="top" align="left" ><?php 
				if($card_type_cc==1)
				{
				?>
                              <table border="0" cellspacing="0" cellpadding="0" align="left">
                                <?php
				
$selectcard=("select * From creditndebit_card_offer where ccndc_offer_type=1 group by bank_name ");

 list($recordcountmyrows,$myrow)=MainselectfuncNew($selectcard,$array = array());
	
$getrecordcount = count($myrow);
$i=1;
while ($i<count($myrow))
{
	?>
                                <tr>
                                  <td><table width="300" border="0" align="left" cellspacing="0" cellpadding="0">
                                      <tr>
                                        <td height="22" class="bldtxt"  valign="middle" align="left" ><img src="images/plus2.gif" alt="" name="imgfaq<? echo $i;?>" width="12"  height="12"  id="imgfaq<? echo $i;?>" style="cursor:pointer;" onClick="showdetailsFaq(<? echo $i;?>,12)"> <span  onclick="showdetailsFaq(<? echo $i;?>,12)" style="cursor:pointer; font-weight:bold; color:#07468C;" ><? echo $myrow[$i]["bank_name"];?></span>
                                            <div style="display: none;" id="divfaq<? echo $i;?>">
                                              <table width="100%" border="0" align="left" cellspacing="0" cellpadding="0" >
                                                <!-------CODE TO VIEW TYPES OF CARDS---------->
                                                <?
	$selecttype=("select * From creditndebit_card_offer where bank_name='".$myrow[$i]["bank_name"]."' and ccndc_offer_type=1");
	list($recordcountrows,$row)=MainselectfuncNew($selecttype,$array = array());
	$recordcount = count($row);
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
		$cntr=0;
		while ($cntr<count($getrow))
		{
			?>
                                                <tr>
                                                  <td width="25" align="left" valign="top"><input type="checkbox" value="<? echo $row[$cntr]["ccndc_offerid"];?>_<? echo $row[$cntr]["bank_name"];?>" name="category_cc[]" id="category_cc" style="border:none; cursor:pointer;" onClick="showdetailsFaq(<? echo $r;?>,800)" id="imgfaq4"/>
                                                      <? // echo $row["ccndc_offerid"];?>                                                         </td>
                                                  <td class="nrmltxt" align="left"><span  onclick="showdetailsFaq(<? echo $r;?>,800)" style="cursor:pointer;" ><? echo $row[$cntr]["card_name"];?></span>
                                                      <div style="display:none;" id="divfaq<? echo $r;?>">
                                                        <table width="100%" border="0" cellspacing="0" cellpadding="0" align="left">
                                                          <tr>
                                                            <td  width="25" align="left" valign="top"><input type="checkbox" value="dinning_offers" name="category_cc_<?php	 echo $row[$cntr]["ccndc_offerid"]; ?>[]" style="border:none"/></td>
                                                            <td class="nrmltxt" align="left">Dinning Offers</td>
                                                          </tr>
                                                          <tr>
                                                            <td  width="25" align="left" valign="top"><input type="checkbox" value="travel_offers" name="category_cc_<?php echo $row[$cntr]["ccndc_offerid"]; ?>[]" style="border:none"/></td>
                                                            <td class="nrmltxt" align="left">Travel Offer</td>
                                                          </tr>
                                                          <tr>
                                                            <td  width="25" align="left" valign="top"><input type="checkbox" value="shopping_offers" name="category_cc_<?php echo $row[$cntr]["ccndc_offerid"]; ?>[]" style="border:none"/></td>
                                                            <td class="nrmltxt" align="left">Shopping Offer</td>
                                                          </tr>
                                                          <tr>
                                                            <td  width="25" align="left" valign="top"><input type="checkbox" value="entertainment_offers" name="category_cc_<?php echo $row[$cntr]["ccndc_offerid"]; ?>[]" style="border:none"/></td>
                                                            <td class="nrmltxt" align="left">Entertainment Offer</td>
                                                          </tr>
                                                          <tr>
                                                            <td  width="25" align="left" valign="top"><input type="checkbox" value="petrol_offers" name="category_cc_<?php echo $row[$cntr]["ccndc_offerid"]; ?>[]" style="border:none"/></td>
                                                            <td class="nrmltxt" align="left">Petrol Offer</td>
                                                          </tr>
                                                          <tr>
                                                            <td   width="25" align="left" valign="top"><input type="checkbox" value="reward_points_offers" name="category_cc_<?php echo $row[$cntr]["ccndc_offerid"]; ?>[]" style="border:none"/></td>
                                                            <td class="nrmltxt" align="left">Reward Points Offers</td>
                                                          </tr>
                                                          <tr>
                                                            <td   width="25" align="left" valign="top"><input type="checkbox" value="other_offers" name="category_cc_<?php	echo $row[$cntr]["ccndc_offerid"]; ?>[]" style="border:none"/></td>
                                                            <td class="nrmltxt" align="left">Other Offers</td>
                                                          </tr>
                                                        </table>
                                                      </div></td>
                                                </tr>
                                                <!------------------>
                                                <? $r=$p+$row["ccndc_offerid"]; 
		 $cntr=$cntr+1;
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
$selectcard=("select * From creditndebit_card_offer where ccndc_offer_type=2 group by bank_name ");
//$getrecordcount = mysql_num_rows($selectcard);
 list($recordcount,$myrow)=MainselectfuncNew($selectcard,$array = array());
		$getrecordcount = count($myrow);

$i=1;
while($cntr<count($myrow))
        {
	?>
                                <tr>
                                  <td><table width="300" border="0" align="right" cellspacing="0" cellpadding="0">
                                      <tr>
                                        <td height="22" class="bldtxt" valign="middle" align="left" ><img src="images/plus2.gif" alt="" onClick="showdetailsFaqDc(<? echo $i;?>,12)" id="imgfaqdc<? echo $i;?>"  height="12" width="12" style="cursor:pointer;"> <span  onclick="showdetailsFaqDc(<? echo $i;?>,12)" style="cursor:pointer; font-weight:bold;" ><? echo $myrow[$i]["bank_name"];?></span>
                                            <div style="display: none;" id="divfaqdc<? echo $i;?>">
                                              <table width="100%" border="0" align="right" cellspacing="0" cellpadding="0" >
                                                <!-------CODE TO VIEW TYPES OF CARDS---------->
                                                <?
	$selecttype=("select * From creditndebit_card_offer where bank_name='".$myrow[$i]["bank_name"]."' and ccndc_offer_type=2");
	 list($recordcount,$row)=MainselectfuncNew($selecttype,$array = array());
		$y=0;
	
	$recordcount = count($row);
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
		while($y<count($row))
        {
			//echo $r;
			//echo "<br>";
			?>
                                                <tr>
                                                  <td  width="25" align="left" valign="top"><input type="checkbox" value="<? echo $row[$y]["ccndc_offerid"];?>_<? echo $row[$y]["bank_name"];?>" name="category_dc[]" id="category_dc" style="border:none; cursor:pointer;" onClick="showdetailsFaqDc(<? echo $r;?>,800)" id="imgfaqdc4"/>                                                         </td>
                                                  <td class="nrmltxt" align="left"><span  onclick="showdetailsFaqDc(<? echo $r;?>,800)" style="cursor:pointer;" ><? echo $row[$y]["card_name"];?></span>
                                                      <div style="display:none;" id="divfaqdc<? echo $r;?>">
                                                        <table width="100%" border="0" cellspacing="0" cellpadding="0" align="left">
                                                          <tr>
                                                            <td  width="25" align="left" valign="top"><input type="checkbox" value="dinning_offers" name="category_dc_<?php	echo $row[$y]["ccndc_offerid"]; ?>[]" style="border:none"/></td>
                                                            <td class="nrmltxt" align="left">Dinning Offers</td>
                                                          </tr>
                                                          <tr>
                                                            <td  width="25" align="left" valign="top"><input type="checkbox" value="travel_offers" name="category_dc_<?php echo $row[$y]["ccndc_offerid"]; ?>[]" style="border:none"/></td>
                                                            <td class="nrmltxt" align="left">Travel Offer</td>
                                                          </tr>
                                                          <tr>
                                                            <td  width="25" align="left" valign="top"><input type="checkbox" value="shopping_offers" name="category_dc_<?php	echo $row[$y]["ccndc_offerid"]; ?>[]" style="border:none"/></td>
                                                            <td class="nrmltxt" align="left">Shopping Offer</td>
                                                          </tr>
                                                          <tr>
                                                            <td  width="25" align="left" valign="top"><input type="checkbox" value="entertainment_offers" name="category_dc_<?php echo $row[$y]["ccndc_offerid"]; ?>[]" style="border:none"/></td>
                                                            <td class="nrmltxt" align="left">Entertainment Offer</td>
                                                          </tr>
                                                          <tr>
                                                            <td  width="25" align="left" valign="top"><input type="checkbox" value="petrol_offers" name="category_dc_<?php echo $row[$y]["ccndc_offerid"]; ?>[]" style="border:none"/></td>
                                                            <td class="nrmltxt" align="left">Petrol Offer</td>
                                                          </tr>
                                                          <tr>
                                                            <td  width="25" align="left" valign="top"><input type="checkbox" value="reward_points_offers" name="category_dc_<?php	echo $row[$y]["ccndc_offerid"]; ?>[]" style="border:none"/></td>
                                                            <td class="nrmltxt">Reward Points Offers</td>
                                                          </tr>
                                                          <tr>
                                                            <td width="25" align="left" valign="top"><input type="checkbox" value="other_offers" name="category_dc_<?php echo $row[$y]["ccndc_offerid"]; ?>[]" style="border:none"/></td>
                                                            <td class="nrmltxt" align="left">Other Offers</td>
                                                          </tr>
                                                        </table>
                                                      </div></td>
                                                </tr>
                                                <!------------------>
                                                <? $r=$p+$row[$y]["ccndc_offerid"]; 
		 $y = $y+1;
		 
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
              </table>
</body>
</html>
