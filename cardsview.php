<style type="text/css">

.blue-text{
font-family:Verdana, Arial, Helvetica, sans-serif;
font-size:11px;
color:#10467D;
text-decoration:none;
font-weight:bold;}

.blue-text b{
font-family:Verdana, Arial, Helvetica, sans-serif;
font-size:11px;
color:#10467D;
text-decoration:none;
font-weight:bold;}


.blue-text a{
font-family:Verdana, Arial, Helvetica, sans-serif;
font-size:12px;
color:#10467D;
text-decoration:none;
font-weight:bold;}

.blue-text a:hover{
text-decoration:underline;
}
.blue-cont-panel{
background-image: url(images/content-bg-pnl.gif);
height:25px;
background-repeat:no-repeat;
background-position:center;
font-family:Verdana, Arial, Helvetica, sans-serif;
font-size:12px;
font-weight:bold;
color:#FFFFFF;
text-align:center;
text-decoration:none;
}

.blue-cont-panel a{
background-image: url(images/content-bg-pnl.gif);
width:258px;
height:25px;
background-repeat:no-repeat;
background-position:center;
font-family:Verdana, Arial, Helvetica, sans-serif;
font-size:12px;
font-weight:bold;
color:#FFFFFF;
text-align:center;
text-decoration:none;
}

.blue-tp-bg-pnl{
background-image:url(images/blue-top-bg-pnl.jpg);
background-repeat:no-repeat;
background-position:center;
padding-left:15px;
text-align:left;
font-family:Verdana, Arial, Helvetica, sans-serif;
font-size:12px;
font-weight:bold;
color:#FFFFFF;
text-decoration:none;
}

.blue-cnt-pnl{
text-align:left;
font-family:Verdana, Arial, Helvetica, sans-serif;
font-size:11px;
font-weight:normal;
color:#041423;
text-decoration:none;
}




</style>

<?php

require 'scripts/db_init.php';
//require 'scripts/functions.php';

function kotakcard($product,$requestid,$value)
{
	$carddetails=("select * from card_properties where BidderID=943 and Extra_Clause='".$value."'");
	 list($recordcount,$row)=MainselectfuncNew($carddetails,$array = array());
		$cntr=0;
	
	while($cntr<count($row))
        {
        
		$extra_clause=$row[$cntr]['Extra_Clause'];
		$card_name=$row[$cntr]['Card_Name'];
		$card_image=$row[$cntr]['Card_Image'];
		$card_features=$row[$cntr]['Card_Features'];
		$card_eligibility=$row[$cntr]['Card_Eligibility'];
		$card_annual_fee=$row[$cntr]['Card_Annual_Fee'];
	if($card_annual_fee=="0")
		{
		$annual_fee="Free For Life";
		}
		else
		{
$annual_fee=$card_annual_fee;
		}
//echo "<td>";
echo "<td align='center' style='padding:2px 0px;'>";

echo '<table width="508" border="0" cellspacing="0"  align="center" cellpadding="0" style="border:1px solid #0865C5;">';
echo '<tr><td style="padding:2px;"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"><tr><td height="23" class="blue-tp-bg-pnl" >'.$card_name.'</td></tr><tr><td style="padding:7px;"><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td width="160" align="left"><table width="160" border="0" align="left" cellpadding="0" cellspacing="0"><tr><td align="center" valign="middle"><img src="images/'.$card_image.'" Width="139" height="111" ></td></tr><tr><td width="111" height="38" align="center" valign="middle"><a href="https://www.kotakcards.com/kotak/px/kotak/applyonline.do?csmcode=VE02" target="_blank"><img src="images/blue-aply-btn.gif" width="111" height="38" /></a></td></tr></table></td><td align="left" valign="top" style="border-left: 1px solid #D8E6F4;"><table width="98%" border="0" cellspacing="0" cellpadding="0" align="right"><tr><td align="left" class="blue-cnt-pnl">'.$card_features.'</td></tr><tr><td align="left" valign="bottom" class="blue-cnt-pnl" height="25"><b>'.$annual_fee.'</b></td></tr>  </table></td></tr></table></td></tr></table></td></tr></table>';
echo "</td><tr>";
	$cntr=$cntr+1;
	}
}

function hdfccard($product,$requestid,$value)
{
	$hdfccarddetails=("select * from card_properties where BidderID=913 and Extra_Clause<='".$value."'");
	//echo "select * from card_properties where BidderID=913 and extra_clause<='".$value."'";
	
	 list($recordcount,$hdfcrow)=MainselectfuncNew($hdfccarddetails,$array = array());
		$i=0;
	
	while($i<count($hdfcrow))
        {
		$hdfcextra_clause=$hdfcrow[$i]['Extra_Clause'];
		$hdfccard_name=$hdfcrow[$i]['Card_Name'];
		$hdfccard_image=$hdfcrow[$i]['Card_Image'];
		$hdfccard_features=$hdfcrow[$i]['Card_Features'];
		$hdfccard_eligibility=$hdfcrow[$i]['Card_Eligibility'];
		$hdfccard_annual_fee=$hdfcrow[$i]['Card_Annual_Fee'];
		if($hdfccard_annual_fee=="0")
		{
		$annual_fee="Free For Life";
		}
		else
		{
$annual_fee=$hdfccard_annual_fee;
		}
	
echo "<td align='center' style='padding:2px 0px;'>";

echo '<table width="508" border="0" cellspacing="0"  align="center" cellpadding="0" style="border:1px solid #0865C5;">';
echo '<tr><td style="padding:2px;"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"><tr><td height="23" class="blue-tp-bg-pnl" >'.$hdfccard_name.'</td></tr><tr><td style="padding:7px;"><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td width="160" align="left"><table width="160" border="0" align="left" cellpadding="0" cellspacing="0"><tr><td align="center" valign="middle"><img src="images/'.$hdfccard_image.'" Width="139" height="111" ></td></tr><tr><td width="111" height="38" align="center" valign="middle"><a href="getcard-details.php?cardid=913&requestid=$requestid&product=$product&cname=$hdfccard_name" target="_blank"><img src="images/blue-aply-btn.gif" width="111" height="38" /></a></td></tr></table></td><td align="left" valign="top" style="border-left: 1px solid #D8E6F4;"><table width="98%" border="0" cellspacing="0" cellpadding="0" align="right"><tr><td align="left" class="blue-cnt-pnl">'.$hdfccard_features.'</td></tr><tr><td align="left" valign="bottom" class="blue-cnt-pnl" height="25"><b>'.$annual_fee.'</b></td></tr>  </table></td></tr></table></td></tr></table></td></tr></table>';
echo "</td></tr>";
$i = $i +1;}
}


function icicicard($product,$requestid,$value)
{
	$icicicarddetails=("select * from card_properties where BidderID=903 and Extra_Clause<='".$value."' order by Card_Priority");
	 list($recordcount,$Arrrow)=MainselectfuncNew($icicicarddetails,$array = array());
		$h=0;
	
	//$recordcount = mysql_num_rows($icicicarddetails);
	if($recordcount>2)
	{
		 while($h<count($Arrrow))
        {
			$iciciextra_clause = $Arrrow[$h]['Extra_Clause'];
			$icicicard_name = $Arrrow[$h]['Card_Name'];
			$icicicard_image = $Arrrow[$h]['Card_Image'];
			$icicicard_features = $Arrrow[$h]['Card_Features'];
			$icicicard_eligibility = $Arrrow[$h]['Card_Eligibility'];
			$icicicard_annual_fee = $Arrrow[$h]['Card_Annual_Fee'];

	if($icicicard_annual_fee=="0")
		{
		$annual_fee="Free For Life";
		}
		else
		{
$annual_fee=$icicicard_annual_fee;
		}

	
echo "<td align='center' style='padding:2px 0px;'>";

echo '<table width="508" border="0" cellspacing="0"  align="center" cellpadding="0" style="border:1px solid #0865C5;">';
echo '<tr><td style="padding:2px;"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"><tr><td height="23" class="blue-tp-bg-pnl" >'.$icicicard_name.'</td></tr><tr><td style="padding:7px;"><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td width="160" align="left"><table width="160" border="0" align="left" cellpadding="0" cellspacing="0"><tr><td align="center" valign="middle"><img src="images/'.$icicicard_image.'" Width="139" height="111" ></td></tr><tr><td width="111" height="38" align="center" valign="middle"><a href="getcard-details.php?cardid=903&requestid='.$requestid.'&product='.$product.'&cname='.$icicicard_name.'" target="_blank"><img src="images/blue-aply-btn.gif" width="111" height="38" /></a></td></tr></table></td><td align="left" valign="top" style="border-left: 1px solid #D8E6F4;"><table width="98%" border="0" cellspacing="0" align="right" cellpadding="0"><tr><td align="left" class="blue-cnt-pnl">'.$icicicard_features.'</td></tr><tr><td align="left" valign="bottom" class="blue-cnt-pnl" height="25"><b>'.$annual_fee.'</b></td></tr>  </table></td></tr></table></td></tr></table></td></tr></table>';
echo "</td></tr>";
	$h = $h+1;}

	}
	else
	{
	 list($recordcount,$icicirow)=MainselectfuncNew($icicicarddetails,$array = array());
		$z=0;
	
	while($z<count($icicirow))
        {
		$iciciextra_clause=$icicirow[$z]['Extra_Clause'];
		$icicicard_name=$icicirow[$z]['Card_Name'];
		$icicicard_image=$icicirow[$z]['Card_Image'];
		$icicicard_features=$icicirow[$z]['Card_Features'];
		$icicicard_eligibility=$icicirow[$z]['Card_Eligibility'];
		$icicicard_annual_fee=$icicirow[$z]['Card_Annual_Fee'];
		if($icicicard_annual_fee=="0")
		{
		$annual_fee="Free For Life";
		}
		else
		{
$annual_fee=$icicicard_annual_fee;
		}

	
echo "<td align='center' style='padding:2px 0px;'>";

echo '<table width="508" border="0" cellspacing="0"  align="center" cellpadding="0" style="border:1px solid #0865C5;">';
echo '<tr><td style="padding:2px;"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"><tr><td height="23" class="blue-tp-bg-pnl" >'.$icicicard_name.'</td></tr><tr><td style="padding:7px;"><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td width="160" align="left"><table width="160" border="0" align="left" cellpadding="0" cellspacing="0"><tr><td align="center" valign="middle"><img src="images/'.$icicicard_image.'" Width="139" height="111" ></td></tr><tr><td width="111" height="38" align="center" valign="middle"><a href="getcard-details.php?cardid=903&requestid='.$requestid.'&product='.$product.'&cname='.$icicicard_name.'" target="_blank"><img src="images/blue-aply-btn.gif" width="111" height="38" /></a></td></tr></table></td><td align="left" valign="top" style="border-left: 1px solid #D8E6F4;"><table width="98%" border="0" cellspacing="0" align="right" cellpadding="0"><tr><td align="left" class="blue-cnt-pnl">'.$icicicard_features.'</td></tr><tr><td align="left" valign="bottom" class="blue-cnt-pnl" height="25"><b>'.$annual_fee.'</b></td></tr>  </table></td></tr></table></td></tr></table></td></tr></table>';
echo "</td></tr>";
	$z = $z+1;}
	}
	
}

function tataaigcard($product,$requestid)
{
	$tatadetails=("select * from card_properties where BidderID=947 ");
	
	 list($recordcount,$row)=MainselectfuncNew($tatadetails,$array = array());
		$cntr=0;
	
	while($cntr<count($row))
        {
		$tataextra_clause=$row[$cntr]['Extra_Clause'];
		$tatacard_name=$row[$cntr]['Card_Name'];
		$tatacard_image=$row[$cntr]['Card_Image'];
		$tatacard_features=$row[$cntr]['Card_Features'];
		$tatacard_eligibility=$row[$cntr]['Card_Eligibility'];
		$tatacard_annual_fee=$row[$cntr]['Card_Annual_Fee'];
	if($tatacard_annual_fee=="0")
		{
		$annual_fee="Free For Life";
		}
		else
		{
$annual_fee=$card_annual_fee;
		}
//echo "<td>";
echo "<td align='center' style='padding:2px 0px;'>";

echo '<table width="508" border="0" cellspacing="0"  align="center" cellpadding="0" style="border:1px solid #0865C5;">';
echo '<tr><td style="padding:2px;"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"><tr><td height="23" class="blue-tp-bg-pnl" >'.$tatacard_name.'</td></tr><tr><td style="padding:7px;"><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td width="160" align="left"><table width="160" border="0" align="left" cellpadding="0" cellspacing="0"><tr><td align="center" valign="middle"><img src="images/'.$tatacard_image.'" Width="139" height="111" ></td></tr><tr><td width="111" height="38" align="center" valign="middle"></td></tr></table></td><td align="left" valign="top" style="border-left: 1px solid #D8E6F4;"><table width="98%" border="0" cellspacing="0" cellpadding="0" align="right"><tr><td align="left" class="blue-cnt-pnl">'.$tatacard_features.'</td></tr><tr><td align="left" valign="bottom" class="blue-cnt-pnl" height="25"><b>'.$annual_fee.'</b></td></tr>  </table></td></tr></table></td></tr></table></td></tr></table>';
echo "</td><tr>";
	$cntr = $cntr +1;}
}


?>