<?php

if($product=="Personal Loan")
{
	if($feedback=="Not Contactable" || $feedback=="Ringing" || $feedback=="Wrong Number")
	{
$Message = "<table width='700' border='0' align='center' cellpadding='0' cellspacing='0' style='border:1px ridge #0099FF;'><tr><td><table width='100%' border='0' cellspacing='0' cellpadding='0'><tr><td width='40%' valign='top'> <tr>    <td><table width='100%' border='0' cellspacing='0' cellpadding='0'> <tr>     <td width='40%' valign='top'></td>        <td width='60%' align='right' style='padding-top:5px;'><img src='http://www.deal4loans.com/images/cc/crdt-crd-logo.gif'  /><br />          <span style='font-family: Verdana, Arial, Helvetica, sans-serif;	font-size: 10px;	color:#0A71D9;'>Loans by Choice not by Chance!</span></td>      </tr>    </table></td>  </tr></table></td></tr><tr><td style=' font-family:Verdana; font-size:12px; color:#333333; padding-top:20px; padding-left:10px; padding-right:10px;'><b>Dear $plname,</b><p>We  at<b> <a href='http://deal4loans.com?source=d4l-notcontactable' style=' font-family:Verdana; font-size:12px; color:#333333;'>deal4loans.com</a> </b>thank you for giving us an opportunity to get you multiple  offers from various banks for your $product requirement.</p><p>Your <b>Profile Summary</b> as per our records: </p><b style='line-height:28px;'>Name: $plname<br />Email Id: $plemail<br />Contact: $plmobile<br />City: $plcity<br />Annual Income: $plnet_salary</b><p>As  part of our process, we have tried reaching you at <b>&lt; $plmobile&gt;</b> but without  any luck.<br />Due  to this your request is not being forwarded to our partners <b>( HDFC, Fullerton, Bajaj Finserv, Axis Bank &amp; many more suitable for your profile)</b> who can provide you with the BEST deals for your $product requirement.</p>
<p>If  you are looking for a $product,  <a href='http://www.deal4loans.com/apply-personal-loans.php'><b>re-apply </b></a>at deal4loans with correct details.</p>
<p>&nbsp; <br />Regards</p>Team Deal4loans.com <br /><br /></td></tr></table>";
}
elseif($feedback=="Not Eligible")
	{
		$Message="<table width='700' border='0' align='center' cellpadding='0' cellspacing='0' style='border:1px ridge #0099FF;'><tr><td><table width='100%' border='0' cellspacing='0' cellpadding='0'><tr><td width='40%' valign='top'> <tr>    <td><table width='100%' border='0' cellspacing='0' cellpadding='0'> <tr>     <td width='40%' valign='top'></td>        <td width='60%' align='right' style='padding-top:5px;'><img src='http://www.deal4loans.com/images/cc/crdt-crd-logo.gif'  /><br />          <span style='font-family: Verdana, Arial, Helvetica, sans-serif;	font-size: 10px;	color:#0A71D9;'>Loans by Choice not by Chance!</span></td>      </tr>    </table></td>  </tr></table></td></tr><tr><td style=' font-family:Verdana; font-size:12px; color:#333333; padding-top:20px; padding-left:10px; padding-right:10px;'><b>Dear $plname,</b><p>As per your profile, no bank is associated with us to serve your <b>Personal loan</b> requirement. We will not be able to service your request and hence we are not sharing your details with any bank.</p><p>&nbsp; <br />
  Regards</p>
Team Deal4loans.com <br /><br /></td></tr></table>";
	}
elseif($feedback=="Not Interested")
{
	$Message="<table width='560' border='0' align='center' cellpadding='0' cellspacing='0'>
  <tr>
    <td width='560' height='101' align='center' valign='top'><img src='http://www.deal4loans.com/images/mlr-hdr.jpg' width='560' height='101' /></td>
  </tr>
  <tr>
    <td><table width='560' border='0' align='center' cellpadding='0' cellspacing='0'>
      <tr>
        <td width='1' bgcolor='#7cabda'><img src='http://www.deal4loans.com/images/spacer.gif' width='1'  height='1' border='0' /></td>
        <td><table width='98%' border='0' align='center' cellpadding='0' cellspacing='0'>
          <tr>
            <td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; '><b>Dear $plname,</b> <br /><br />
        We at <u>Deal4loans.com</u> thank  you for giving us an opportunity to get you multiple offers from various banks  for your personal loan requirement.</font>
      <p><font face='Verdana' size='2'>Your <strong>Profile Summary</strong> as per our records: </font></p>
      <p><font face='Verdana' size='2'><b>Name: $plname<br />
Email Id: $plemail<br />
Contact: $plmobile<br />
City: $plcity<br />
Annual Income: $plnet_salary</b></font></p>
      <p><font face='Verdana' size='2'>As  part of our process, while speaking to you we have found that your  needs are different, therefore your request is not being  forwarded to our partners<b> ( HDFC Bank, Fullerton, Bajaj Finserv &amp; many more suitable for your profile) </b>who can provide you with the BEST deal for your  Personal Loan requirement.</font></p>
      <p><font face='Verdana' size='2'>If  you are looking for a Personal Loan, <strong><u><a href='http://www.deal4loans.com/apply-personal-loans.php?source=Not-Interested'>re-apply</a></u> </strong>at deal4loans with correct details.</font></p>
      <p><font face='Verdana' size='2'>If  you are looking for Loans &amp; credit cards in future please <strong><u><a href='http://www.deal4loans.com/index.php?source=Not-Interested'>apply</a></u> </strong>at deal4loans. We will get  the BEST deal for you.</font></p>      
      <font face='Verdana' size='2'>   Regards<br />    Team Deal4Loans.com</font><br />
Loans by choice not by chance!!<br />
<div style='text-align:center;'><a href='http://www.deal4loans.com/Contents_Blogs.php?source=Not-Interested' target='_blank' style='color:#0a4988; text-decoration:underline;'>Blogs</a> | <a href='http://www.deal4loans.com/Contents_Feedback.php?source=Not-Interested' target='_blank' style='color:#0a4988; text-decoration:underline;'>Testimonials</a> | <a href='http://www.deal4loans.com/Loan_Query.php?source=Not-Interested' target='_blank' style='color:#0a4988; text-decoration:underline;'>LoanQueries</a></div></td>
          </tr>
		  
        </table></td>
        <td width='1' bgcolor='#7cabda'><img src='http://www.deal4loans.com/images/spacer.gif' width='1'  height='1' border='0' /></td>
      </tr>
    </table></td>
  </tr>
  <tr>    <td><img src='http://www.deal4loans.com/images/tp_bl-line.gif' width='560' height='20' /></td>

  </tr>
</table>";
}
}


else if($product=="Home Loan")
{
	if($hlfeedback=="Not Contactable" || $hlfeedback=="Ringing" || $hlfeedback=="Wrong Number")
	{
$Message = "<table width='700' border='0' align='center' cellpadding='0' cellspacing='0' style='border:1px ridge #0099FF;'><tr><td><table width='100%' border='0' cellspacing='0' cellpadding='0'><tr><td width='40%' valign='top'> <tr>    <td><table width='100%' border='0' cellspacing='0' cellpadding='0'> <tr>     <td width='40%' valign='top'></td>        <td width='60%' align='right' style='padding-top:5px;'><img src='http://www.deal4loans.com/images/cc/crdt-crd-logo.gif'  /><br />          <span style='font-family: Verdana, Arial, Helvetica, sans-serif;	font-size: 10px;	color:#0A71D9;'>Loans by Choice not by Chance!</span></td>      </tr>    </table></td>  </tr></table></td></tr><tr><td style=' font-family:Verdana; font-size:12px; color:#333333; padding-top:20px; padding-left:10px; padding-right:10px;'><b>Dear $hlname,</b>      <p>We  at<b> <a href='http://deal4loans.com?source=d4l-notcontactable' style=' font-family:Verdana; font-size:12px; color:#333333;'>deal4loans.com</a> </b>thank you for giving us an opportunity to get you multiple  offers from various banks for your $product requirement.</p><p>Your <b>Profile Summary</b> as per our records: </p><b style='line-height:28px;'>Name: $hlname<br />      Email Id: $hlemail<br />     Contact: $hlmobile<br />      City: $hlcity<br />      Annual Income: $hlnet_salary</b>      <p>As  part of our process, we have tried reaching you at <b>&lt; $hlmobile&gt;</b> but without  any luck.<br />Due  to this your request is not being forwarded to our partners <b>( ICICI, HDFC Ltd, Axis Bank, Standard Chartered &amp; many more suitable for your profile)</b> who can provide you with the BEST deals for your $product requirement.</p>      <p>If  you are looking for a $product,  <a href='http://www.deal4loans.com/apply-home-loans.php'><b>re-apply </b></a>at deal4loans with correct details.</p>
<p>&nbsp; <br />Regards</p>Team Deal4loans.com <br /><br /></td></tr></table>";
	}
	elseif($feedback=="Not Eligible")
	{	
		$Message="<table width='700' border='0' align='center' cellpadding='0' cellspacing='0' style='border:1px ridge #0099FF;'><tr><td><table width='100%' border='0' cellspacing='0' cellpadding='0'><tr><td width='40%' valign='top'> <tr>    <td><table width='100%' border='0' cellspacing='0' cellpadding='0'> <tr>     <td width='40%' valign='top'></td>        <td width='60%' align='right' style='padding-top:5px;'><img src='http://www.deal4loans.com/images/cc/crdt-crd-logo.gif'  /><br />          <span style='font-family: Verdana, Arial, Helvetica, sans-serif;	font-size: 10px;	color:#0A71D9;'>Loans by Choice not by Chance!</span></td>      </tr>    </table></td>  </tr></table></td></tr><tr><td style=' font-family:Verdana; font-size:12px; color:#333333; padding-top:20px; padding-left:10px; padding-right:10px;'><b>Dear $hlname,</b><p>As per your profile, no bank is associated with us to serve your <b>Home loan</b> requirement. We will not be able to service your request and hence we are not sharing your details with any bank.</p><p>&nbsp; <br />
  Regards</p>
Team Deal4loans.com <br /><br /></td></tr></table>
";

	}
	elseif($hlfeedback=="Not Interested")
	{
		$Message="<table width='560' border='0' align='center' cellpadding='0' cellspacing='0'>
  <tr>
    <td width='560' height='101' align='center' valign='top'><img src='http://www.deal4loans.com/images/mlr-hdr.jpg' width='560' height='101' /></td>
  </tr>
  <tr>
    <td><table width='560' border='0' align='center' cellpadding='0' cellspacing='0'>
      <tr>
        <td width='1' bgcolor='#7cabda'><img src='http://www.deal4loans.com/images/spacer.gif' width='1'  height='1' border='0' /></td>
        <td><table width='98%' border='0' align='center' cellpadding='0' cellspacing='0'>
          <tr>
            <td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; '><b>Dear $hlname,</b> <br /><br />
        We at <u>Deal4loans.com</u> thank  you for giving us an opportunity to get you multiple offers from various banks  for your $product  requirement.</font>
      <p><font face='Verdana' size='2'>Your <strong>Profile Summary</strong> as per our records: </font></p>
      <p><font face='Verdana' size='2'><b>Name: $hlname<br />      Email Id: $hlemail<br />     Contact: $hlmobile<br />      City: $hlcity<br />      Annual Income: $hlnet_salary</b></font></p>
      <p><font face='Verdana' size='2'>As  part of our process, while speaking to you we have found that your  needs are different, therefore your request is not being  forwarded to our partners<b> ( ICICI, HDFC Ltd, Axis Bank & many more suitable for your profile)  </b>who can provide you with the BEST deal for your  $product requirement.</font></p>
      <p><font face='Verdana' size='2'>If  you are looking for a $product,  <strong><u><a href='http://www.deal4loans.com/apply-home-loans.php?source=Not-Interested'>re-apply</a></u> </strong>at deal4loans with correct details.</font></p>
      <p><font face='Verdana' size='2'>If  you are looking for Loans &amp; credit cards in future please <strong><u><a href='http://www.deal4loans.com/index.php?source=Not-Interested'>apply</a></u> </strong>at deal4loans. We will get  the BEST deal for you.</font></p>      
      <font face='Verdana' size='2'>   Regards<br />    Team Deal4Loans.com</font><br />
Loans by choice not by chance!!<br />
<div style='text-align:center;'><a href='http://www.deal4loans.com/Contents_Blogs.php?source=Not-Interested' target='_blank' style='color:#0a4988; text-decoration:underline;'>Blogs</a> | <a href='http://www.deal4loans.com/Contents_Feedback.php?source=Not-Interested' target='_blank' style='color:#0a4988; text-decoration:underline;'>Testimonials</a> | <a href='http://www.deal4loans.com/Loan_Query.php?source=Not-Interested' target='_blank' style='color:#0a4988; text-decoration:underline;'>LoanQueries</a></div></td>
          </tr>
		  
        </table></td>
        <td width='1' bgcolor='#7cabda'><img src='http://www.deal4loans.com/images/spacer.gif' width='1'  height='1' border='0' /></td>
      </tr>
    </table></td>
  </tr>
  <tr>    <td><img src='http://www.deal4loans.com/images/tp_bl-line.gif' width='560' height='20' /></td>

  </tr>
</table>";
	}
}
else if($product=="Credit Card")
{
$Message = "<table width='700' border='0' align='center' cellpadding='0' cellspacing='0' style='border:1px ridge #0099FF;'><tr><td><table width='100%' border='0' cellspacing='0' cellpadding='0'><tr><td width='40%' valign='top'> <tr>    <td><table width='100%' border='0' cellspacing='0' cellpadding='0'> <tr>     <td width='40%' valign='top'></td>        <td width='60%' align='right' style='padding-top:5px;'><img src='http://www.deal4loans.com/images/cc/crdt-crd-logo.gif'  /><br />          <span style='font-family: Verdana, Arial, Helvetica, sans-serif;	font-size: 10px;	color:#0A71D9;'>Loans by Choice not by Chance!</span></td>      </tr>    </table></td>  </tr></td></tr></table></td></tr><tr><td style=' font-family:Verdana; font-size:12px; color:#333333; padding-top:20px; padding-left:10px; padding-right:10px;'><b>Dear $ccname,</b>      <p>We  at<b> <a href='http://deal4loans.com?source=d4l-notcontactable' style=' font-family:Verdana; font-size:12px; color:#333333;'>deal4loans.com</a> </b>thank you for giving us an opportunity to get you multiple  offers from various banks for your $product requirement.</p><p>Your <b>Profile Summary</b> as per our records: </p><b style='line-height:28px;'>Name: $ccname<br />      Email Id: $ccemail<br />      Contact: $ccmobile<br />      City: $cccity<br />      Annual Income: $ccnet_salary</b>      <p>As  part of our process, we have tried reaching you at <b>&lt; </b><b style='line-height:28px;'>$ccmobile</b><b>&gt;</b> but without  any luck.<br />Due  to this your request is not being forwarded to our partners, who can provide you with the BEST deals for your $product requirement.</p>            
<p>If  you are looking for a $product,  <a href='http://www.deal4loans.com/apply-credit-card.php?source=Not-Interested'><b>re-apply </b></a>at deal4loans with correct details or SMS DEAL at 56161.</p>
<p>&nbsp; <br />Regards</p>Team Deal4loans.com <br /><br /></td></tr></table>";
}
else if($product=="Loan Against Property")
{
$Message = "<table width='700' border='0' align='center' cellpadding='0' cellspacing='0' style='border:1px ridge #0099FF;'><tr><td><table width='100%' border='0' cellspacing='0' cellpadding='0'><tr><td width='40%' valign='top'> <tr>    <td><table width='100%' border='0' cellspacing='0' cellpadding='0'> <tr>     <td width='40%' valign='top'></td>        <td width='60%' align='right' style='padding-top:5px;'><img src='http://www.deal4loans.com/images/cc/crdt-crd-logo.gif'  /><br />          <span style='font-family: Verdana, Arial, Helvetica, sans-serif;	font-size: 10px;	color:#0A71D9;'>Loans by Choice not by Chance!</span></td>      </tr>    </table></td>  </tr></td></tr></table></td></tr><tr><td style=' font-family:Verdana; font-size:12px; color:#333333; padding-top:20px; padding-left:10px; padding-right:10px;'><b>Dear $lapname,</b>      <p>We  at<b> <a href='http://deal4loans.com?source=d4l-notcontactable' style=' font-family:Verdana; font-size:12px; color:#333333;'>deal4loans.com</a> </b>thank you for giving us an opportunity to get you multiple  offers from various banks for your $product requirement.</p><p>Your <b>Profile Summary</b> as per our records: </p><b style='line-height:28px;'>Name: $lapname<br />    Email Id: $lapemail<br />      Contact: $lapmobile<br />      City: $lapcity<br />      Annual Income: $lapnet_salary</b>      <p>As  part of our process, we have tried reaching you at <b>&lt; </b><b style='line-height:28px;'>$lapmobile</b><b>&gt;</b> but without  any luck.<br />Due  to this your request is not being forwarded to our partners, who can provide you with the BEST deals for your $product requirement.</p>      <p>If  you are looking for a $product,  <b><a href='http://www.deal4loans.com/apply-loan-against-property.php'>re-apply </a></b>at deal4loans with correct details or SMS DEAL at 56161.</p>
<p>&nbsp; <br />Regards</p>Team Deal4loans.com <br /><br /></td></tr></table>";
}
?>