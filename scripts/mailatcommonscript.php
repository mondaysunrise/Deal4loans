<? 
if($Type_Loan == "PersonalLoan" || $Type_Loan == "Req_Loan_Personal") 
	{
		if($City=="Others" && strlen($strcity)>0)
		{
			$plcity=$strcity;
		}
		else
		{ $plcity=$City; }
		$plcitylist="Select citylist From  product_wisecitylist Where ( product=1 )";
$resultplcity=ExecQuery($plcitylist);
$plctyrow=mysql_fetch_array($resultplcity);
$plcityliststr = $plctyrow["citylist"];
$nstr=explode(',', trim($plcityliststr));
if (in_array($strcity, $nstr)) {
    $Message2 = "<table align='center' style='max-width:650px; border:solid thin #dad9d9;' width='600' border='0' cellpadding='0' cellspacing='0' >
<tr>
<td height='35' colspan='2'  align='right' bgcolor='#0c74b4' style='font-family:Arial, Helvetica, sans-serif; font-size:18px; color:#FFFFFF; padding-right:5px;'>Deal4loans.com</td>
</tr>
<tr>
<td colspan='2' bgcolor='#FFFFFF'>&nbsp;</td>
</tr>
<tr>
<td width='19' bgcolor='#FFFFFF'>&nbsp;</td>
<td width='581' bgcolor='#FFFFFF' style='font-family:Verdana, Geneva, sans-serif; font-size:12px;'>Dear $FName ,</td>
</tr>
<tr>
<td >&nbsp;</td>
<td style='font-family:Verdana, Geneva, sans-serif; font-size:12px; line-height:16px;'>Thank you for considering Deal4loans for Comparing Loan deals. We are India's Largest Financial Comparative platform with an association with Top 10 Banks/NBFC's for Retail Personal Loans. We are continuously working towards getting you the best deal on your loan requirement basis your profile/eligibility.</td>
</tr>
<tr>
<td colspan='2'  height='5'></td>
</tr>
<tr>
  <td bgcolor='#FFFFFF'>&nbsp;</td>
  <td bgcolor='#FFFFFF'>&nbsp;</td>
</tr>
<tr>
  <td bgcolor='#fffbf0' style='border-top:thin solid #f2f2f2;'>&nbsp;</td>
  <td bgcolor='#fffbf0' style=' font-family:Verdana, Geneva, sans-serif; font-size:12px; color:#404040; border-top:thin solid #f2f2f2;'>Your <em style='color:#055299;'>Profile Summary</em> as per our records:</td>
</tr>
<tr>
  <td bgcolor='#fffbf0'>&nbsp;</td>
<td bgcolor='#fffbf0'><table width='100%' style='max-width:300px;' align='left' cellpadding='0' cellspacing='0'>
<tr>
<td width='152' height='15' style='font-family:Verdana, Geneva, sans-serif; font-size:11px;'>Your Name</td>
<td width='10' height='15' align='left' style='font-family:Verdana, Geneva, sans-serif; font-size:11px;'>:</td>
<td width='136' height='15' style='font-family:Verdana, Geneva, sans-serif; font-size:11px;'>$FName</td>
</tr>
<tr>
<td width='152' height='15' style='font-family:Verdana, Geneva, sans-serif; font-size:11px;'>Location</td>
<td width='10' height='15' align='left' style='font-family:Verdana, Geneva, sans-serif; font-size:11px;'>:</td>
<td width='136' height='15' style='font-family:Verdana, Geneva, sans-serif; font-size:11px;'>$plcity</td>
</tr>
<tr>
<td width='152' height='15' style='font-family:Verdana, Geneva, sans-serif; font-size:11px;'>Income/Salary</td>
<td width='10' height='15' align='left' style='font-family:Verdana, Geneva, sans-serif; font-size:11px;'>:</td>
<td width='136' height='15' style='font-family:Verdana, Geneva, sans-serif; font-size:11px;'>$Net_Salary</td>
</tr>  
<tr>
<td width='152' height='15' style='font-family:Verdana, Geneva, sans-serif; font-size:11px;'>Email Id</td>
<td width='10' height='15' align='left' style='font-family:Verdana, Geneva, sans-serif; font-size:11px;'>:</td>
<td width='136' height='15' style='font-family:Verdana, Geneva, sans-serif; font-size:11px;'>$Email</td>
</tr>
<tr>
  <td height='15' style='font-family:Verdana, Geneva, sans-serif; font-size:11px;'>Contact No.</td>
  <td height='15' align='left' style='font-family:Verdana, Geneva, sans-serif; font-size:11px;'>:</td>
  <td height='15' style='font-family:Verdana, Geneva, sans-serif; font-size:11px;'>$Phone</td>
</tr>  
  </table></td>
</tr>
<tr>
  <td colspan='2' align='center' bgcolor='#FFFFFF' style='font-family:Verdana, Geneva, sans-serif; font-size:14px;'>&nbsp;</td>
</tr>
<tr>
  <td colspan='2' align='center' bgcolor='#FFFFFF' style='font-family:Verdana, Geneva, sans-serif; font-size:14px;'>Deal4loans ensures you choose the best deal and grow with your  <a href='http://www.deal4loans.com/taraqi-ki-emi.php' style='color:#2291af; text-decoration:none; font-weight:bold;'><em>Taraqi Ki EMI</em></a><br />
    <strong>Learn more, Save more</strong> @ deal4loans-  TV commercial </td>
</tr>
<tr>
  <td colspan='2' bgcolor='#FFFFFF'>&nbsp;</td>
</tr>
<tr>
  <td colspan='2' align='center' bgcolor='#FFFFFF'><a href='https://www.youtube.com/watch?v=7dHR9t_wQuA'><img src='http://www.deal4loans.com/images/taraqi-ki-tile.jpg' width='241' height='118' alt='Taraqi ki EMI' border='0'/></a></td>
</tr>
<tr>
  <td colspan='2' bgcolor='#FFFFFF'>&nbsp;</td>
</tr>
<tr>
<td colspan='2' bgcolor='#fffbf0'>
<table cellpadding='0' cellspacing='0' border='0' align='center' style='max-width:588px; width:98%;'>
<tr>
  <td bgcolor='#0c6296' height='8'></td>
  </tr>
<tr>
  <td bgcolor='#0c6296'><table border='0' align='center' cellpadding='0' cellspacing='0' style='max-width:588px; width:95%;'>
    <tr>
      <td colspan='2' bgcolor='#0c6296' height='30' style='color:#fed866; font-family:Verdana, Geneva, sans-serif; font-size:16px; font-weight:bold;'><em>How to make an effective Comparison?</em></td>
    </tr>
    <tr>
      <td colspan='2' bgcolor='#0c6296' style='color:#FFF; font-family: Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold;'> EMI ...</td>
    </tr>
    <tr>
      <td colspan='2' bgcolor='#0c6296' style='color:#FFF; font-family: Arial, Helvetica, sans-serif; font-size:12px; text-align:justify;'><em>Your EMI depends upon the combination of different factors like Rate of Interest being offered, Loan Amount & Tenure. Most of the Banks/NBFCs offer the reducing Rate of Interest wherein your Principal keeps on reducing with each EMI. Use our EMI Calculator to calculate your Accurate Monthly EMI.</em></td></tr>
       <tr>
      <td colspan='2' bgcolor='#0c6296' height='5'></td>
    </tr>
    <tr><td colspan='2' bgcolor='#0c6296' style='color:#FFF; font-family: Arial, Helvetica, sans-serif; font-size:12px; '>
 <a href='http://www.deal4loans.com/Contents_Calculators.php' target='_blank' style='color:#FFF; font-family: Arial, Helvetica, sans-serif; font-size:12px;'>EMI Calculator</a> <br>
<a href='https://play.google.com/store/apps/details?id=d4l.emicalc.com&hl=en' target='_blank' style='color:#FFF; font-family: Arial, Helvetica, sans-serif; font-size:12px;'>Download EMI Calculator App</a> 
</em></td>
    </tr>
    <tr>
      <td colspan='2' bgcolor='#0c6296' height='5'></td>
    </tr>
    <tr>
      <td colspan='2' bgcolor='#0c6296' style='color:#FFF; font-family: Arial, Helvetica, sans-serif; font-size:12px; text-align:justify;'>E.g.  A Loan EMI with 3 year tenure would always be higher compared to a 4 year even if the rate
        of 
        interest is low.</td>
    </tr>
    <tr>
      <td colspan='2' bgcolor='#0c6296' height='5'></td>
    </tr>
    <tr>
      <td colspan='2' bgcolor='#0c6296' style='color:#FFF; font-family: Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold;'> Processing Fee ...</td>
    </tr>
    <tr>
      <td colspan='2' bgcolor='#0c6296' style='color:#FFF; font-family: Arial, Helvetica, sans-serif; font-size:12px; text-align:justify;'><em>This is a one time Loan Processing Charge/Fee that Banks/NBFCs charge to process your Loan Application. This Fee/Charge gets adjusted in the Loan Amount at the time of disbursal and there is no upfront payment that is to be paid. You just have to ensure that you choose the lowest fee option.</em></td>
    </tr>
    <tr>
      <td colspan='2' bgcolor='#0c6296' height='5'></td>
    </tr>
    <tr>
      <td colspan='2' bgcolor='#0c6296' style='color:#FFF; font-family: Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold;'> Prepayment Charges ...</td>
    </tr>
    <tr>
      <td colspan='2' bgcolor='#0c6296' style='color:#FFF; font-family: Arial, Helvetica, sans-serif; font-size:12px; text-align:justify;'><em>This charge is levied by the Bank in case you wish to close your loan before the completion of the entire repayment term. There are few Banks/NBFCs which offer Zero pre-payment charges. You should look at this particular option in case you wish to repay your debt before the completion of the term.<br>
</em></td>
    </tr>
    <tr>
      <td colspan='2' bgcolor='#0c6296' height='5'></td>
    </tr>
      <tr>
      <td colspan='2' bgcolor='#0c6296' style='color:#FFF; font-family: Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold;'> Partial Payment Option ...</td>
    </tr>
    <tr>
      <td colspan='2' bgcolor='#0c6296' style='color:#FFF; font-family: Arial, Helvetica, sans-serif; font-size:12px; text-align:justify;'><em>With this option you can save on your interest portion by making some addition lump sum payments in parts. Very limited Banks/NBFCs has this feature available to the customers.<br>
</em></td>
    </tr>
     <tr>
      <td colspan='2' bgcolor='#0c6296' height='5'></td>
    </tr>
    <tr>
      <td colspan='2' bgcolor='#0c6296' style='color:#FFF; font-family: Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold;'> Processing Time &amp; Documentation ...</td>
    </tr>
    <tr>
      <td colspan='2' bgcolor='#0c6296' style='color:#FFF; font-family: Arial, Helvetica, sans-serif; font-size:12px; text-align:justify;'><em>If fastest and hassle free processing is what you prefer above  fees/charges, then prioritize your selection accordingly.</em></td>
    </tr>
    <tr>
      <td colspan='2' bgcolor='#0c6296' style='color:#FFF; font-family: Arial, Helvetica, sans-serif; font-size:12px; text-align:justify;' height='5'></td>
    </tr>
  </table></td>
  </tr>
</table>  
  </td>
</tr>
<tr>
  <td colspan='2' bgcolor='#FFFFFF' height='5'></td>
</tr>
<tr>
  <td colspan='2' bgcolor='#fffbf0'><table cellpadding='0' cellspacing='0' border='0' width='588' align='center' style='max-width:588px; width:98%;'>
    <tr>
      <td width='588' height='8' bgcolor='#7d7d7d'><table width='588' border='0' align='center' cellpadding='0' cellspacing='0' style='max-width:588px; width:95%;'>
        <tr>
          <td width='6' bgcolor='#7d7d7d'>&nbsp;</td>
          <td colspan='2' bgcolor='#7d7d7d' style='color:#fed866; font-family:Verdana, Geneva, sans-serif; font-size:16px; font-weight:bold;'><em>Why should you try deal4loans once? </em></td>
        </tr>
        <tr>
          <td height='5' colspan='3' bgcolor='#7d7d7d'></td>
        </tr>
        <tr>
          <td bgcolor='#7d7d7d'>&nbsp;</td>
          <td width='16' valign='top' bgcolor='#7d7d7d' style='color:#FFF; font-family: Arial, Helvetica, sans-serif; font-size:12px;'>&bull;</td>
          <td width='1341' bgcolor='#7d7d7d' style='color:#FFF; font-family: Arial, Helvetica, sans-serif; font-size:12px; text-align:justify;'>We aren’t any Brokers who would  advise you which bank to give your documents and     sell you something  just because we are getting good commissions out of that. </td>
        </tr>
        <tr>
          <td colspan='3' bgcolor='#7d7d7d' height='5'></td>
        </tr>
        <tr>
          <td bgcolor='#7d7d7d'>&nbsp;</td>
          <td valign='top' bgcolor='#7d7d7d'><span style='color:#FFF; font-family: Arial, Helvetica, sans-serif; font-size:12px;'>&bull;</span></td>
          <td bgcolor='#7d7d7d' style='color:#FFF; font-family: Arial, Helvetica, sans-serif; font-size:12px; text-align:justify;'>Deal4loans would offer you a wide range of options to choose from. You would get India's max banks 
            of Personal Loan available with us to give you choice.</td>
        </tr>
        <tr>
          <td colspan='3' bgcolor='#7d7d7d' height='5'></td>
        </tr>
        <tr>
          <td bgcolor='#7d7d7d'>&nbsp;</td>
          <td valign='top' bgcolor='#7d7d7d'><span style='color:#FFF; font-family: Arial, Helvetica, sans-serif; font-size:12px;'>&bull;</span></td>
          <td bgcolor='#7d7d7d' style='color:#FFF; font-family: Arial, Helvetica, sans-serif; font-size:12px;'> You would get the power of comparison so that you make an informed decision by Opting  for 4 
            different Banks and choose any one of them only after talking to all 4 before finally deciding upon one.<br /></td>
        </tr>
        <tr>
          <td height='5' colspan='3' bgcolor='#7d7d7d'></td>
        </tr>
        <tr>
          <td bgcolor='#7d7d7d'>&nbsp;</td>
          <td valign='top' bgcolor='#7d7d7d'><span style='color:#FFF; font-family: Arial, Helvetica, sans-serif; font-size:12px;'>&bull;</span></td>
          <td bgcolor='#7d7d7d' style='color:#FFF; font-family: Arial, Helvetica, sans-serif; font-size:12px;'><strong style='color:#face01; font-size:16px;'>54,</strong><strong style='color:#31d9ed; font-size:16px;'>32,</strong><strong style='font-size:16px; color:#9cd175;'>938</strong> quotes/comparison given till date and are still counting.</td>
        </tr>
        <tr>
          <td colspan='3' bgcolor='#7d7d7d'>&nbsp;</td>
        </tr>
      </table></td>
    </tr>
  </table></td>
</tr>
<tr>
  <td colspan='2' bgcolor='#fffbf0'>&nbsp;</td>
</tr>
<tr>
  <td colspan='2' align='center' bgcolor='#fffbf0' style='color:#0397f1; font-size:14px; font-family:Verdana, Geneva, sans-serif; font-weight:bold; font-style:italic;'> Our comparison services are absolutely free for our customers!!</td>
</tr>
<tr>
  <td colspan='2' bgcolor='#fffbf0' style='color:#404040; font-family:Verdana, Geneva, sans-serif; font-size:11px; text-align:center; font-style:italic;'>We invite everyone to visit deal4loans.com atleast once before finalizing a loan deal because any additional information would only help you make a better informed decision. </td>
</tr>
<tr>
  <td colspan='2' bgcolor='#fffbf0' style='border-bottom:thin solid #f2f2f2;'>&nbsp;</td>
</tr>
<tr>
  <td colspan='2' bgcolor='#fffbf0' style='border-bottom:thin solid #f2f2f2;'>
  <table cellpadding='0' cellspacing='0' border='0' width='588' align='center' style='max-width:588px; width:98%;'>
<tr>
  <td colspan='2' bgcolor='#FFFFFF' style='font-size:11px; font-weight:normal; font-family:Verdana, Geneva, sans-serif;'><b>Important Tips</b></td>
</tr>
<tr>    
          <td width='16' valign='top'  style='color:#000; font-family: Arial, Helvetica, sans-serif; font-size:12px;'>&bull;</td>
          <td width='1341' style='color:#000; font-family: Arial, Helvetica, sans-serif; font-size:12px; text-align:justify;'>Never pay any cash or any sort of payment/fee to anyone to get any loan approved.</td></tr>
          <tr>
         
          <td width='16' valign='top' style='color:#000; font-family: Arial, Helvetica, sans-serif; font-size:12px;'>&bull;</td>
          <td width='1341' style='color:#000; font-family: Arial, Helvetica, sans-serif; font-size:12px; text-align:justify;'>
No Banks ask for any processing fee upfront</td></tr>
<tr>
         
          <td width='16' valign='top' style='color:#000; font-family: Arial, Helvetica, sans-serif; font-size:12px;'>&bull;</td>
          <td width='1341' style='color:#000; font-family: Arial, Helvetica, sans-serif; font-size:12px; text-align:justify;'>
Do not fall prey to agents who ask for a fee for a loan approval at very cheap interest rates.
</td>
    </tr>
    <tr>
         
          <td width='16' valign='top' style='color:#000; font-family: Arial, Helvetica, sans-serif; font-size:12px;'>&bull;</td>
          <td width='1341' style='color:#000; font-family: Arial, Helvetica, sans-serif; font-size:12px; text-align:justify;'>
Do not fall for offers that guarantee loan approvals with any kind of advance fee payment to any individual in general or even particularly acting on our behalf.
</td>
    </tr>
    </table>
    </td></tr>
<tr>
  <td colspan='2' bgcolor='#FFFFFF'>&nbsp;</td>
</tr>
<tr>
  <td bgcolor='#FFFFFF'>&nbsp;</td>
  <td bgcolor='#FFFFFF'><strong style='font-size:11px; font-weight:normal; font-family:Verdana, Geneva, sans-serif; color:#404040;'>Regards </strong><br />
<strong style='font-size:11px; font-weight:normal; font-family:Verdana, Geneva, sans-serif; color:#404040;'>    <em>Team <strong style='color:#0f8eda; font-weight:normal;'>Deal4loans.com</strong></em></strong><br />
    <strong style='font-size:10px; font-weight:normal; font-style:italic; font-family:Verdana, Geneva, sans-serif; color:#404040;'>Loans by choice not by chance!!</strong></td>
</tr>
<tr>
  <td height='10' colspan='2' bgcolor='#FFFFFF'></td>
</tr>
<tr>
  <td colspan='2' align='center' bgcolor='#FFFFFF' style='font-family:Verdana, Geneva, sans-serif; color:#000000; font-size:10px;'><a href='http://www.deal4loans.com/Contents_Blogs.php?source=plAM' style='color:#e98b05 !important; text-decoration:none;'>Blogs</a> | <a href='http://www.deal4loans.com/Contents_Feedback.php?source=plAM' style='color:#1484d1 !important; text-decoration:none;'>Testimonials</a> | <a href='http://www.deal4loans.com/Loan_Query.php?source=plAM' style='color:#b1290e !important; text-decoration:none;'>LoanQueries</a></td>
</tr>
<tr>
  <td colspan='2' bgcolor='#FFFFFF'  style='border-bottom:thin solid #f2f2f2;' height='2'></td>
</tr>
<tr>
  <td colspan='2' bgcolor='#FFFFFF'  height='5'></td>
</tr>
<tr>
  <td colspan='2' bgcolor='#FFFFFF' style='color:#404040; font-size:9px; font-family:Verdana, Geneva, sans-serif;'></td>
</tr>
<tr>
  <td bgcolor='#FFFFFF'>&nbsp;</td>
  <td bgcolor='#FFFFFF'  style='color:#404040; font-size:9px; font-family:Verdana, Geneva, sans-serif;'><strong>Disclaimer:</strong> Deal4loans doesn not provide Loans on its own but ensures your information is sent to bank/agent which you have opted for. We do not do short term loans. Deal4loans has no sales team on its own and we just help you to compare loans. All loans are on discretion of the associated</td>
</tr>
<tr>
  <td colspan='2' bgcolor='#FFFFFF'>&nbsp;</td>
</tr>
</table>";
}
else
	{
    $Message2 = "<table align='center' style='max-width:650px; border:solid thin #dad9d9;' width='600' border='0' cellpadding='0' cellspacing='0' >
<tr>
<td height='35' colspan='2'  align='right' bgcolor='#0c74b4' style='font-family:Arial, Helvetica, sans-serif; font-size:18px; color:#FFFFFF; padding-right:5px;'>Deal4loans.com</td>
</tr>
<tr>
<td colspan='2' bgcolor='#FFFFFF'>&nbsp;</td>
</tr>
<tr>
<td width='19' bgcolor='#FFFFFF'>&nbsp;</td>
<td width='581' bgcolor='#FFFFFF' style='font-family:Verdana, Geneva, sans-serif; font-size:12px;'>Dear $FName ,</td>
</tr>
<tr>
<td >&nbsp;</td>
<td style='font-family:Verdana, Geneva, sans-serif; font-size:12px; line-height:16px;'>Thank you for considering Deal4loans for Comparing Loan deals. We are India's Largest Financial Comparative platform with an association with Top 10 Banks/NBFC's for Retail Personal Loans. We are continuously working towards getting you the best deal on your loan requirement basis your profile/eligibility.</td>
</tr>
<tr>
<td colspan='2'  height='5'></td>
</tr>
<tr>
  <td bgcolor='#FFFFFF'>&nbsp;</td>
  <td bgcolor='#FFFFFF'>&nbsp;</td>
</tr>
<tr>
  <td bgcolor='#fffbf0' style='border-top:thin solid #f2f2f2;'>&nbsp;</td>
  <td bgcolor='#fffbf0' style=' font-family:Verdana, Geneva, sans-serif; font-size:12px; color:#404040; border-top:thin solid #f2f2f2;'>Your <em style='color:#055299;'>Profile Summary</em> as per our records:</td>
</tr>
<tr>
  <td bgcolor='#fffbf0'>&nbsp;</td>
<td bgcolor='#fffbf0'><table width='100%' style='max-width:300px;' align='left' cellpadding='0' cellspacing='0'>
<tr>
<td width='152' height='15' style='font-family:Verdana, Geneva, sans-serif; font-size:11px;'>Your Name</td>
<td width='10' height='15' align='left' style='font-family:Verdana, Geneva, sans-serif; font-size:11px;'>:</td>
<td width='136' height='15' style='font-family:Verdana, Geneva, sans-serif; font-size:11px;'>$FName</td>
</tr>
<tr>
<td width='152' height='15' style='font-family:Verdana, Geneva, sans-serif; font-size:11px;'>Location</td>
<td width='10' height='15' align='left' style='font-family:Verdana, Geneva, sans-serif; font-size:11px;'>:</td>
<td width='136' height='15' style='font-family:Verdana, Geneva, sans-serif; font-size:11px;'>$plcity</td>
</tr>
<tr>
<td width='152' height='15' style='font-family:Verdana, Geneva, sans-serif; font-size:11px;'>Income/Salary</td>
<td width='10' height='15' align='left' style='font-family:Verdana, Geneva, sans-serif; font-size:11px;'>:</td>
<td width='136' height='15' style='font-family:Verdana, Geneva, sans-serif; font-size:11px;'>$Net_Salary</td>
</tr>  
<tr>
<td width='152' height='15' style='font-family:Verdana, Geneva, sans-serif; font-size:11px;'>Email Id</td>
<td width='10' height='15' align='left' style='font-family:Verdana, Geneva, sans-serif; font-size:11px;'>:</td>
<td width='136' height='15' style='font-family:Verdana, Geneva, sans-serif; font-size:11px;'>$Email</td>
</tr>
<tr>
  <td height='15' style='font-family:Verdana, Geneva, sans-serif; font-size:11px;'>Contact No.</td>
  <td height='15' align='left' style='font-family:Verdana, Geneva, sans-serif; font-size:11px;'>:</td>
  <td height='15' style='font-family:Verdana, Geneva, sans-serif; font-size:11px;'>$Phone</td>
</tr>  
  </table></td>
</tr>
<tr>
  <td colspan='2' align='center' bgcolor='#FFFFFF' style='font-family:Verdana, Geneva, sans-serif; font-size:14px;'>&nbsp;</td>
</tr>
<tr>
  <td colspan='2' align='center' bgcolor='#FFFFFF' style='font-family:Verdana, Geneva, sans-serif; font-size:14px;'>Deal4loans ensures you choose the best deal and grow with your  <a href='http://www.deal4loans.com/taraqi-ki-emi.php' style='color:#2291af; text-decoration:none; font-weight:bold;'><em>Taraqi Ki EMI</em></a><br />
    <strong>Learn more, Save more</strong> @ deal4loans-  TV commercial </td>
</tr>
<tr>
  <td colspan='2' bgcolor='#FFFFFF'>&nbsp;</td>
</tr>
<tr>
  <td colspan='2' align='center' bgcolor='#FFFFFF'><a href='https://www.youtube.com/watch?v=7dHR9t_wQuA'><img src='http://www.deal4loans.com/images/taraqi-ki-tile.jpg' width='241' height='118' alt='Taraqi ki EMI' border='0'/></a></td>
</tr>
<tr>
  <td colspan='2' bgcolor='#FFFFFF'>&nbsp;</td>
</tr>
<tr>
<td colspan='2' bgcolor='#fffbf0'>
<table cellpadding='0' cellspacing='0' border='0' align='center' style='max-width:588px; width:98%;'>
<tr>
  <td bgcolor='#0c6296' height='8'></td>
  </tr>
<tr>
  <td bgcolor='#0c6296'><table border='0' align='center' cellpadding='0' cellspacing='0' style='max-width:588px; width:95%;'>
    <tr>
      <td colspan='2' bgcolor='#0c6296' height='30' style='color:#fed866; font-family:Verdana, Geneva, sans-serif; font-size:16px; font-weight:bold;'><em>How to make an effective Comparison?</em></td>
    </tr>
    <tr>
      <td colspan='2' bgcolor='#0c6296' style='color:#FFF; font-family: Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold;'> EMI ...</td>
    </tr>
    <tr>
      <td colspan='2' bgcolor='#0c6296' style='color:#FFF; font-family: Arial, Helvetica, sans-serif; font-size:12px; text-align:justify;'><em>Your EMI depends upon the combination of different factors like Rate of Interest being offered, Loan Amount & Tenure. Most of the Banks/NBFCs offer the reducing Rate of Interest wherein your Principal keeps on reducing with each EMI. Use our EMI Calculator to calculate your Accurate Monthly EMI.</em></td></tr>
       <tr>
      <td colspan='2' bgcolor='#0c6296' height='5'></td>
    </tr>
    <tr><td colspan='2' bgcolor='#0c6296' style='color:#FFF; font-family: Arial, Helvetica, sans-serif; font-size:12px; '>
 <a href='http://www.deal4loans.com/Contents_Calculators.php' target='_blank' style='color:#FFF; font-family: Arial, Helvetica, sans-serif; font-size:12px;'>EMI Calculator</a> <br>
<a href='https://play.google.com/store/apps/details?id=d4l.emicalc.com&hl=en' target='_blank' style='color:#FFF; font-family: Arial, Helvetica, sans-serif; font-size:12px;'>Download EMI Calculator App</a> 
</em></td>
    </tr>
    <tr>
      <td colspan='2' bgcolor='#0c6296' height='5'></td>
    </tr>
    <tr>
      <td colspan='2' bgcolor='#0c6296' style='color:#FFF; font-family: Arial, Helvetica, sans-serif; font-size:12px; text-align:justify;'>E.g.  A Loan EMI with 3 year tenure would always be higher compared to a 4 year even if the rate
        of 
        interest is low.</td>
    </tr>
    <tr>
      <td colspan='2' bgcolor='#0c6296' height='5'></td>
    </tr>
    <tr>
      <td colspan='2' bgcolor='#0c6296' style='color:#FFF; font-family: Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold;'> Processing Fee ...</td>
    </tr>
    <tr>
      <td colspan='2' bgcolor='#0c6296' style='color:#FFF; font-family: Arial, Helvetica, sans-serif; font-size:12px; text-align:justify;'><em>This is a one time Loan Processing Charge/Fee that Banks/NBFCs charge to process your Loan Application. This Fee/Charge gets adjusted in the Loan Amount at the time of disbursal and there is no upfront payment that is to be paid. You just have to ensure that you choose the lowest fee option.</em></td>
    </tr>
    <tr>
      <td colspan='2' bgcolor='#0c6296' height='5'></td>
    </tr>
    <tr>
      <td colspan='2' bgcolor='#0c6296' style='color:#FFF; font-family: Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold;'> Prepayment Charges ...</td>
    </tr>
    <tr>
      <td colspan='2' bgcolor='#0c6296' style='color:#FFF; font-family: Arial, Helvetica, sans-serif; font-size:12px; text-align:justify;'><em>This charge is levied by the Bank in case you wish to close your loan before the completion of the entire repayment term. There are few Banks/NBFCs which offer Zero pre-payment charges. You should look at this particular option in case you wish to repay your debt before the completion of the term.<br>
</em></td>
    </tr>
    <tr>
      <td colspan='2' bgcolor='#0c6296' height='5'></td>
    </tr>
      <tr>
      <td colspan='2' bgcolor='#0c6296' style='color:#FFF; font-family: Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold;'> Partial Payment Option ...</td>
    </tr>
    <tr>
      <td colspan='2' bgcolor='#0c6296' style='color:#FFF; font-family: Arial, Helvetica, sans-serif; font-size:12px; text-align:justify;'><em>With this option you can save on your interest portion by making some addition lump sum payments in parts. Very limited Banks/NBFCs has this feature available to the customers.<br>
</em></td>
    </tr>
     <tr>
      <td colspan='2' bgcolor='#0c6296' height='5'></td>
    </tr>
    <tr>
      <td colspan='2' bgcolor='#0c6296' style='color:#FFF; font-family: Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold;'> Processing Time &amp; Documentation ...</td>
    </tr>
    <tr>
      <td colspan='2' bgcolor='#0c6296' style='color:#FFF; font-family: Arial, Helvetica, sans-serif; font-size:12px; text-align:justify;'><em>If fastest and hassle free processing is what you prefer above  fees/charges, then prioritize your selection accordingly.</em></td>
    </tr>
    <tr>
      <td colspan='2' bgcolor='#0c6296' style='color:#FFF; font-family: Arial, Helvetica, sans-serif; font-size:12px; text-align:justify;' height='5'></td>
    </tr>
  </table></td>
  </tr>
</table>  
  </td>
</tr>
<tr>
  <td colspan='2' bgcolor='#FFFFFF' height='5'></td>
</tr>
<tr>
  <td colspan='2' bgcolor='#fffbf0'><table cellpadding='0' cellspacing='0' border='0' width='588' align='center' style='max-width:588px; width:98%;'>
    <tr>
      <td width='588' height='8' bgcolor='#7d7d7d'><table width='588' border='0' align='center' cellpadding='0' cellspacing='0' style='max-width:588px; width:95%;'>
        <tr>
          <td width='6' bgcolor='#7d7d7d'>&nbsp;</td>
          <td colspan='2' bgcolor='#7d7d7d' style='color:#fed866; font-family:Verdana, Geneva, sans-serif; font-size:16px; font-weight:bold;'><em>Why should you try deal4loans once? </em></td>
        </tr>
        <tr>
          <td height='5' colspan='3' bgcolor='#7d7d7d'></td>
        </tr>
        <tr>
          <td bgcolor='#7d7d7d'>&nbsp;</td>
          <td width='16' valign='top' bgcolor='#7d7d7d' style='color:#FFF; font-family: Arial, Helvetica, sans-serif; font-size:12px;'>&bull;</td>
          <td width='1341' bgcolor='#7d7d7d' style='color:#FFF; font-family: Arial, Helvetica, sans-serif; font-size:12px; text-align:justify;'>We aren’t any Brokers who would  advise you which bank to give your documents and     sell you something  just because we are getting good commissions out of that. </td>
        </tr>
        <tr>
          <td colspan='3' bgcolor='#7d7d7d' height='5'></td>
        </tr>
        <tr>
          <td bgcolor='#7d7d7d'>&nbsp;</td>
          <td valign='top' bgcolor='#7d7d7d'><span style='color:#FFF; font-family: Arial, Helvetica, sans-serif; font-size:12px;'>&bull;</span></td>
          <td bgcolor='#7d7d7d' style='color:#FFF; font-family: Arial, Helvetica, sans-serif; font-size:12px; text-align:justify;'>Deal4loans would offer you a wide range of options to choose from. You would get India's max banks 
            of Personal Loan available with us to give you choice.</td>
        </tr>
        <tr>
          <td colspan='3' bgcolor='#7d7d7d' height='5'></td>
        </tr>
        <tr>
          <td bgcolor='#7d7d7d'>&nbsp;</td>
          <td valign='top' bgcolor='#7d7d7d'><span style='color:#FFF; font-family: Arial, Helvetica, sans-serif; font-size:12px;'>&bull;</span></td>
          <td bgcolor='#7d7d7d' style='color:#FFF; font-family: Arial, Helvetica, sans-serif; font-size:12px;'> You would get the power of comparison so that you make an informed decision by Opting  for 4 
            different Banks and choose any one of them only after talking to all 4 before finally deciding upon one.<br /></td>
        </tr>
        <tr>
          <td height='5' colspan='3' bgcolor='#7d7d7d'></td>
        </tr>
        <tr>
          <td bgcolor='#7d7d7d'>&nbsp;</td>
          <td valign='top' bgcolor='#7d7d7d'><span style='color:#FFF; font-family: Arial, Helvetica, sans-serif; font-size:12px;'>&bull;</span></td>
          <td bgcolor='#7d7d7d' style='color:#FFF; font-family: Arial, Helvetica, sans-serif; font-size:12px;'><strong style='color:#face01; font-size:16px;'>54,</strong><strong style='color:#31d9ed; font-size:16px;'>32,</strong><strong style='font-size:16px; color:#9cd175;'>938</strong> quotes/comparison given till date and are still counting.</td>
        </tr>
        <tr>
          <td colspan='3' bgcolor='#7d7d7d'>&nbsp;</td>
        </tr>
      </table></td>
    </tr>
  </table></td>
</tr>
<tr>
  <td colspan='2' bgcolor='#fffbf0'>&nbsp;</td>
</tr>
<tr>
  <td colspan='2' align='center' bgcolor='#fffbf0' style='color:#0397f1; font-size:14px; font-family:Verdana, Geneva, sans-serif; font-weight:bold; font-style:italic;'> Our comparison services are absolutely free for our customers!!</td>
</tr>
<tr>
  <td colspan='2' bgcolor='#fffbf0' style='color:#404040; font-family:Verdana, Geneva, sans-serif; font-size:11px; text-align:center; font-style:italic;'>We invite everyone to visit deal4loans.com atleast once before finalizing a loan deal because any additional information would only help you make a better informed decision. </td>
</tr>
<tr>
  <td colspan='2' bgcolor='#fffbf0' style='border-bottom:thin solid #f2f2f2;'>&nbsp;</td>
</tr>
<tr>
  <td colspan='2' bgcolor='#fffbf0' style='border-bottom:thin solid #f2f2f2;'>
  <table cellpadding='0' cellspacing='0' border='0' width='588' align='center' style='max-width:588px; width:98%;'>
<tr>
  <td colspan='2' bgcolor='#FFFFFF' style='font-size:11px; font-weight:normal; font-family:Verdana, Geneva, sans-serif;'><b>Important Tips</b></td>
</tr>
<tr>    
          <td width='16' valign='top'  style='color:#000; font-family: Arial, Helvetica, sans-serif; font-size:12px;'>&bull;</td>
          <td width='1341' style='color:#000; font-family: Arial, Helvetica, sans-serif; font-size:12px; text-align:justify;'>Never pay any cash or any sort of payment/fee to anyone to get any loan approved.</td></tr>
          <tr>
         
          <td width='16' valign='top' style='color:#000; font-family: Arial, Helvetica, sans-serif; font-size:12px;'>&bull;</td>
          <td width='1341' style='color:#000; font-family: Arial, Helvetica, sans-serif; font-size:12px; text-align:justify;'>
No Banks ask for any processing fee upfront</td></tr>
<tr>
         
          <td width='16' valign='top' style='color:#000; font-family: Arial, Helvetica, sans-serif; font-size:12px;'>&bull;</td>
          <td width='1341' style='color:#000; font-family: Arial, Helvetica, sans-serif; font-size:12px; text-align:justify;'>
Do not fall prey to agents who ask for a fee for a loan approval at very cheap interest rates.
</td>
    </tr>
    <tr>
         
          <td width='16' valign='top' style='color:#000; font-family: Arial, Helvetica, sans-serif; font-size:12px;'>&bull;</td>
          <td width='1341' style='color:#000; font-family: Arial, Helvetica, sans-serif; font-size:12px; text-align:justify;'>
Do not fall for offers that guarantee loan approvals with any kind of advance fee payment to any individual in general or even particularly acting on our behalf.
</td>
    </tr>
    </table>
    </td></tr>
<tr>
  <td colspan='2' bgcolor='#FFFFFF'>&nbsp;</td>
</tr>
<tr>
  <td bgcolor='#FFFFFF'>&nbsp;</td>
  <td bgcolor='#FFFFFF'><strong style='font-size:11px; font-weight:normal; font-family:Verdana, Geneva, sans-serif; color:#404040;'>Regards </strong><br />
<strong style='font-size:11px; font-weight:normal; font-family:Verdana, Geneva, sans-serif; color:#404040;'>    <em>Team <strong style='color:#0f8eda; font-weight:normal;'>Deal4loans.com</strong></em></strong><br />
    <strong style='font-size:10px; font-weight:normal; font-style:italic; font-family:Verdana, Geneva, sans-serif; color:#404040;'>Loans by choice not by chance!!</strong></td>
</tr>
<tr>
  <td height='10' colspan='2' bgcolor='#FFFFFF'></td>
</tr>
<tr>
  <td colspan='2' align='center' bgcolor='#FFFFFF' style='font-family:Verdana, Geneva, sans-serif; color:#000000; font-size:10px;'><a href='http://www.deal4loans.com/Contents_Blogs.php?source=plAM' style='color:#e98b05 !important; text-decoration:none;'>Blogs</a> | <a href='http://www.deal4loans.com/Contents_Feedback.php?source=plAM' style='color:#1484d1 !important; text-decoration:none;'>Testimonials</a> | <a href='http://www.deal4loans.com/Loan_Query.php?source=plAM' style='color:#b1290e !important; text-decoration:none;'>LoanQueries</a></td>
</tr>
<tr>
  <td colspan='2' bgcolor='#FFFFFF'  style='border-bottom:thin solid #f2f2f2;' height='2'></td>
</tr>
<tr>
  <td colspan='2' bgcolor='#FFFFFF'  height='5'></td>
</tr>
<tr>
  <td colspan='2' bgcolor='#FFFFFF' style='color:#404040; font-size:9px; font-family:Verdana, Geneva, sans-serif;'></td>
</tr>
<tr>
  <td bgcolor='#FFFFFF'>&nbsp;</td>
  <td bgcolor='#FFFFFF'  style='color:#404040; font-size:9px; font-family:Verdana, Geneva, sans-serif;'><strong>Disclaimer:</strong> Deal4loans doesn not provide Loans on its own but ensures your information is sent to bank/agent which you have opted for. We do not do short term loans. Deal4loans has no sales team on its own and we just help you to compare loans. All loans are on discretion of the associated</td>
</tr>
<tr>
  <td colspan='2' bgcolor='#FFFFFF'>&nbsp;</td>
</tr>
</table>";
}
	}
elseif($Type_Loan =="CreditCard" || $Type_Loan == "Req_Credit_Card") 
		{
			
		if($City=="Others" && strlen($strcity)>0)
		{
			$cccity=$strcity;
		}
		else
		{ $cccity=$City; }

$cccitylist="Select citylist From  product_wisecitylist Where ( product=4 )";
$resultcccity=ExecQuery($cccitylist);
$ccctyrow=mysql_fetch_array($resultcccity);
$cccityliststr = $ccctyrow["citylist"];
$ccnstr=explode(',', trim($cccityliststr));
if (in_array($cccity, $ccnstr)) {
	$Message2 = "<table width='560' border='0' align='center' cellpadding='0' cellspacing='0'>
  <tr>
    <td width='560' height='101' align='center' valign='top'><img src='http://www.deal4loans.com/images/mlr-hdr.jpg' width='560' height='101' /></td>
  </tr>
  <tr>
    <td><table width='560' border='0' align='center' cellpadding='0' cellspacing='0'>
      <tr>
        <td width='1' bgcolor='#7cabda'><img src='http://www.deal4loans.com/images/spacer.gif' width='1'  height='1' border='0' /></td>
        <td><table width='98%' border='0' align='center' cellpadding='0' cellspacing='0'>
          <tr>
            <td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; '><p><b>Dear $FName</b>,<br />
              We thank you for applying a Credit Card on Deal4loans.com.We are committed to provide you with a platform to compare & choose the best deal that fits your credit needs from the various offers that our participating banks will extend to you. The details that have been provided to the participating banks are listed below. <br />
                  <br />
              
              Your Name: $FName<br />
              Location: $cccity<br />
              Income/Salary: $Net_Salary<br />
              Email Id: $Email<br />
              Contact : $Phone<br />
  <br /></p></td></tr>";
 $Message2.="
<tr>
  <td colspan='2' align='center' bgcolor='#FFFFFF' style='font-family:Verdana, Geneva, sans-serif; font-size:14px;'>Deal4loans ensures you choose the best deal and grow with your  <br><a href='http://www.deal4loans.com/taraqi-ki-emi.php' style='color:#2291af; text-decoration:none; font-weight:bold;'><em>Taraqi Ki EMI</em></a><br />
    <strong>Learn more, Save more</strong> @ deal4loans-  TV commercial </td>
</tr>
<tr>
  <td colspan='2' bgcolor='#FFFFFF'>&nbsp;</td>
</tr>
<tr>
  <td colspan='2' align='center' bgcolor='#FFFFFF'><a href='https://www.youtube.com/watch?v=7dHR9t_wQuA' target='_blank'><img src='http://www.deal4loans.com/images/taraqi-ki-tile.jpg' width='241' height='118' alt='Taraqi ki EMI' border='0'/></a></td>
</tr>
<tr>
  <td colspan='2' bgcolor='#FFFFFF'>&nbsp;</td>
</tr>";
  if($ProductValue>0 && $Net_Salary>=300000)
  {
$selectccbanks="Select * From credit_card_banks_eligibility where (cc_bank_citylist like '%".$City."%' and cc_bank_flag=1) order by cc_bank_fee ASC";
	//echo "query1 ".$selectccbanks."<br><br>";
	$ccbankresult = ExecQuery($selectccbanks);
	$rowscount = mysql_num_rows($ccbankresult);
if($rowscount >0)
{
 $Message2.="<tr><td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; '><b>The following Credit Card companies are interested in your profile:</b></td></tr>"; 
  $Message2.="<tr><td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; '> <table  border='1' cellspacing='0' cellpadding='0'>
		<tr>
		<td  height='40' bgcolor='#197ad6' style='color: #FFFFFF; text-align:center;font-weight:bold; border-bottom:1px #FFFFFF;' >Name</td>
		<td height='40'bgcolor='#197ad6' style='color: #FFFFFF; text-align:center;font-weight:bold; border-bottom:1px #FFFFFF;' >Age</td>
		<td height='40'bgcolor='#197ad6' class='txt-hd' style='color: #FFFFFF; text-align:center;font-weight:bold; border-bottom:1px #FFFFFF;'>Fee</td>
		<td height='40'bgcolor='#197ad6' class='txt-hd' style='color: #FFFFFF; text-align:center;font-weight:bold; border-bottom:1px #FFFFFF;' >Features</td>
		<td  height='40'bgcolor='#197ad6' class='txt-hd' style='color: #FFFFFF; text-align:center;font-weight:bold; border-bottom:1px #FFFFFF;' >Interest Rates</td>
		<td  height='40'bgcolor='#197ad6' class='txt-hd' style='color: #FFFFFF; text-align:center;font-weight:bold; border-bottom:1px #FFFFFF;'  >&nbsp;</td>
		 </tr>";
   
	  while ($row = mysql_fetch_array($ccbankresult))
    {
        $cc_bank_query  = $row['cc_bank_query'];
		$cc_bankid  = $row['cc_bankid'];
		$cc_bank_url  = $row['cc_bank_url'];
		$cc_bank_name  = $row['cc_bank_name'];
		  $qry2 = $cc_bank_query.' and Req_Credit_Card.RequestID ='.$ProductValue;
		 // echo 'query2 '.$qry2.'<br><br>';
		  $result1=ExecQuery($qry2);
        $recordcount = mysql_num_rows($result1);
		if($recordcount>0)
		 {
		 	$i=0;
			while($getrow = mysql_fetch_array($result1))
			 {
			$get_Bank='Select * From credit_card_banks_eligibility Where cc_bankid='.$cc_bankid.' order by cc_bank_fee ASC';
			$get_Bankresult=ExecQuery($get_Bank);
					
		while($myrow = mysql_fetch_array($get_Bankresult))
		 {
			  if($myrow['cc_bank_fee']==0)
			 {
				  $cardfee="free";
			 }
			 else
			 {
				$cardfee=$myrow['cc_bank_fee'];
			 }

			 $Message2.=" <tr>
			  <td  style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; ' >".$myrow['cc_bank_name']."</td>
			  <td  style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; padding-left:5px;' >".$myrow['cc_bank_age']."</td>
			  <td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; padding-left:5px;' >".$cardfee."</td>
			  <td valign='top' >".$myrow['cc_bank_features']."</td>
			  <td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; padding-left:5px;' >". $myrow['cc_bank_rates']."</td>";
			
			$Message2.="<td   align='center' style='font-size:11px; text-align:center;font-weight:bold; '> <form action='http://www.deal4loans.com/apply_cc_consent.php' method='POST' target='_blank' >
				 <input type='hidden' name='cc_bankid' id='cc_bankid' value=".$cc_bankid.">
				 <input type='hidden' name='cc_name' id='cc_name' value=".$cc_bank_name.">
		    <input type='hidden' name='RequestID' id='RequestID' value=".$ProductValue.">
			 <input type='image' value='' name='submit' src='http://www.deal4loans.com/images/blue-aply-btn.gif'  width='111' height='38' border='0' >
					</form></td>
			  </tr>";
						
			  }
			  }    
	  }
	}
	 $Message2.="</table></td></tr>";
	 $Message2.="<tr><td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; '>
			  If you havent applied them,Click on the above links to apply for your set of Credit Cards.It will Just take two minutes to apply for your Credit card.Just make sure you have your Pan card number handy with you.<br><br></td></tr>";
			 }
  }
       $Message2.="<tr><td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; '><b>Other Services from Deal4loans</b>
<ul >
<li ><b>Personal Loan:</b> <a href='http://deal4loans.com/personal-loan-banks.php?source=ccAM' target='_blank'  style='color:#0a4988; text-decoration:underline;'>Check the Banks</a> | <a href='http://www.deal4loans.com/apply-personal-loan.php?source=ccAM' target='_blank' style='color:#0a4988; text-decoration:underline;'>Apply for Personal Loan</a>  | <a href='http://deal4loans.com/personal-loan-interest-rate.php?source=ccAM' target='_blank'  style='color:#0a4988; text-decoration:underline;'>Current Rate of Interest</a>  |<br /> 
    <a href='http://www.deal4loans.com/Contents_Personal_Loan_Mustread.php?source=ccAM' target='_blank' style='color:#0a4988; text-decoration:underline;'>Read more about Personal loan</a> </li>	
	 <li  ><b>Home Loan:</b> <a href='http://www.deal4loans.com/home-loan-banks.php?source=ccAM' target='_blank' style='color:#0a4988; text-decoration:underline;'>Check the Banks</a> | <a href='http://deal4loans.com/home-loans-interest-rates.php' target='_blank' style='color:#0a4988; text-decoration:underline;'>Current Rate of Interest</a>  | <br /> 
    <a href='http://www.deal4loans.com/Contents_Home_Loan_Mustread.php?source=ccAM' target='_blank' style='color:#0a4988; text-decoration:underline;'>Read more about Home Loan</a> | <a href='http://www.deal4loans.com/apply-home-loans.php?source=ccAM' target='_blank' style='color:#0a4988; text-decoration:underline;'>Apply for Home Loan</a></li> 	
	<li><b>Life Insurance:</b> <a href='http://www.bimadeals.in/content/life-insurance-policies' target='_blank' style='color:#0a4988; text-decoration:underline;'>Types of life insurance policies</a> | <a href='http://www.bimadeals.com/life-insurance-india/Contents_Life_Insurance_Mustread.php?source=ccAM' target='_blank' style='color:#0a4988; text-decoration:underline;'>Read more about Life Insurance</a>  | <a href='http://www.bimadeals.com/life-insurance-india/Req_Life_Insurance_New.php?source=ccAM' target='_blank' style='color:#0a4988; text-decoration:underline;'>Apply for Life Insurance</a></li> 	
	<li  ><b>Health Insurance:</b> <a href='http://www.bimadeals.com/health-insurance-india/Contents_Health_Insurance_Mustread.php?source=ccAM' target='_blank' style='color:#0a4988; text-decoration:underline;'>How much Health Insurance you need</a>  | <a href='http://www.bimadeals.com/health-insurance-india/health-insurance-comparison-chart.php?source=ccAM' target='_blank' style='color:#0a4988; text-decoration:underline;'>Compare Family Health Insurance Plan</a>  | <a href='http://www.bimadeals.com/health-insurance-india/Req_Health_Insurance_New.php?source=ccAM' target='_blank' style='color:#0a4988; text-decoration:underline;'>Apply for Health Insurance</a></li>
	
</ul>
</td></tr>
<tr><td colspan='2'>&nbsp;</td></tr>
<tr>
  <td colspan='2' bgcolor='#fffbf0' style='border-bottom:thin solid #f2f2f2;'>
 <table cellpadding='0' cellspacing='0' border='0' width='588' align='center' style='max-width:588px; width:98%;'>
<tr>
  <td colspan='2' bgcolor='#FFFFFF' style='font-size:11px; font-weight:normal; font-family:Verdana, Geneva, sans-serif;'><b>Important Tips</b></td>
</tr>
<tr>    
          <td width='16' valign='top'  style='color:#000; font-family: Arial, Helvetica, sans-serif; font-size:12px;'>&bull;</td>
          <td width='1341' style='color:#000; font-family: Arial, Helvetica, sans-serif; font-size:12px; text-align:justify;'>Never pay any cash or any sort of payment/fee to anyone to get any loan approved.</td></tr>
          <tr>
         
          <td width='16' valign='top' style='color:#000; font-family: Arial, Helvetica, sans-serif; font-size:12px;'>&bull;</td>
          <td width='1341' style='color:#000; font-family: Arial, Helvetica, sans-serif; font-size:12px; text-align:justify;'>
No Banks ask for any processing fee upfront</td></tr>
<tr>
         
          <td width='16' valign='top' style='color:#000; font-family: Arial, Helvetica, sans-serif; font-size:12px;'>&bull;</td>
          <td width='1341' style='color:#000; font-family: Arial, Helvetica, sans-serif; font-size:12px; text-align:justify;'>
Do not fall prey to agents who ask for a fee for a loan approval at very cheap interest rates.
</td>
    </tr>
    <tr>
         
          <td width='16' valign='top' style='color:#000; font-family: Arial, Helvetica, sans-serif; font-size:12px;'>&bull;</td>
          <td width='1341' style='color:#000; font-family: Arial, Helvetica, sans-serif; font-size:12px; text-align:justify;'>
Do not fall for offers that guarantee loan approvals with any kind of advance fee payment to any individual in general or even particularly acting on our behalf.
</td>
    </tr>
    </table>
    </td></tr>
	<tr><td colspan='2'>&nbsp;</td></tr>
	<tr><td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; '>
<b>Regards</b> <br />
Team Deal4loans.com<br />
Loans by choice not by chance!!<br />
<div style='text-align:center;'><a href='http://www.deal4loans.com/Contents_Blogs.php?source=ccAM' target='_blank' style='color:#0a4988; text-decoration:underline;'>Blogs</a> | <a href='http://www.deal4loans.com/Contents_Feedback.php?source=ccAM' target='_blank' style='color:#0a4988; text-decoration:underline;'>Testimonials</a> | <a href='http://www.deal4loans.com/Loan_Query.php?source=ccAM' target='_blank' style='color:#0a4988; text-decoration:underline;'>LoanQueries</a> </div></td>
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
else
	{
		$Message2 = "<table width='560' border='0' align='center' cellpadding='0' cellspacing='0'>
  <tr>
    <td height='101' align='center' valign='top'><img src='http://www.deal4loans.com/images/mlr-hdr.jpg' width='560' height='101' /></td>
  </tr>
  <tr>
    <td width='560'><table width='560' border='0' align='center' cellpadding='0' cellspacing='0'>
      <tr>
        <td width='1' bgcolor='#7cabda'><img src='http://www.deal4loans.com/images/spacer.gif' width='1'  height='1' border='0' /></td>
        <td><table width='98%' border='0' align='center' cellpadding='0' cellspacing='0'>
          <tr>
            <td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#061c33; line-height:18px; '><b>User Name</b>,<br />
			 Thank you for applying on Deal4loans.com
We regret to inform you that your application has not serviced as the Banks/DSAs we are tied-up currently with are not sourcing customers from your city.
 <br />
 But we can update you about the other possible avenues from where you can get your Credit Card. 
Below are the ways from which you can easily avail the credit facility on the basis of followings you can check with the banks which are offering Credit Card facility:
<br />
<ul>
	<li>Bank in which you are holding Saving/Current Account</li> 
	<li>If You hold a credit card from any other bank</li> 	
	<li>You are running a current loan like car loan, personal loan, credit card loan etc.</li>
	</ul>
Following are the List of banks from which you can contact for your Credit Card/Loan Requirement: <br />
<a href='http://www.axisbank.com/24x7banking/telebanking/Tele-Banking.asp' target='_blank'  style='color:#0a4988; text-decoration:underline;'>Axis Bank</a> | <a href='http://www.barclaycard.in/' target='_blank'  style='color:#0a4988; text-decoration:underline;'>Barlcays Bank</a> | <a href='http://www.online.citibank.co.in/customerservice/citiphone.htm' target='_blank'  style='color:#0a4988; text-decoration:underline;'>Citibank</a> | Deutsche Bank- Call 6601 6601 | <a href='https://www.gemoney.in/GEAsiaWebInd/ind?appFunc=DisplayBranchLocator' target='_blank'  style='color:#0a4988; text-decoration:underline;'>GE Money</a> | <a href='http://www.hdfcbank.com/personal/access/popup_pbnumbers.htm' target='_blank'  style='color:#0a4988; text-decoration:underline;'>HDFC Bank</a> | <a href='http://www.hsbc.co.in/1/2/miscellaneous/call-us' target='_blank'  style='color:#0a4988; text-decoration:underline;'>HSBC Bank</a> | <a href='http://icicibank.com/pfsuser/customer/cuscarenos.htm' target='_blank'  style='color:#0a4988; text-decoration:underline;'>ICICI Bank</a> | <a href='http://www.sbi.co.in/viewsection.jsp?id=0,453,554'  target='_blank'  style='color:#0a4988; text-decoration:underline;'>SBI</a><br />
<br />
Also check Eligibility Norms & Product Offerings for Credit Card of the Banks in our Articles Gallery:
<ul><li>
<a href='http://www.deal4loans.com/credit-card-offers.php' style='color:#0a4988; text-decoration:underline;'>Credit Card Offers</a></li>
<li><a href='http://www.deal4loans.com/Contents_Credit_Card_Eligibility.php?source=clAM' style='color:#0a4988; text-decoration:underline;'>Check Eligibility norms of Banks</a></li></ul>

<b>Information on Credit Cards</b>
<ul>
	<li><a href='http://www.deal4loans.in/content/know-more-about-credit-score' target='_blank'  style='color:#0a4988; text-decoration:underline;'>Know more about Credit Score</a></li> 
	<li><a href='http://www.deal4loans.in/content/balance-transfer-your-credit-card' target='_blank'  style='color:#0a4988; text-decoration:underline;'>Balance Transfer on your Credit Card</a></li> 	
	<li><a href='http://www.deal4loans.in/content/know-more-about-your-credit-card' target='_blank'  style='color:#0a4988; text-decoration:underline;'>Know more about your Credit Card</a></li>
	</ul>

<b>Other Services from Deal4loans<br />
<br />
</b>
<ul >
<li ><b>Personal Loan:</b> <a href='http://www.deal4loans.com/personal-loan-banks.php?source=clAM' target='_blank'  style='color:#0a4988; text-decoration:underline;'>Check the Banks</a> | <a href='http://www.deal4loans.com/apply-personal-loan.php?source=clAM' target='_blank' style='color:#0a4988; text-decoration:underline;'>Apply for Personal Loan</a>  | <a href='http://www.deal4loans.com/personal-loan-interest-rate.php' target='_blank'  style='color:#0a4988; text-decoration:underline;'>Current Rate of Interest</a>  |<br /> 
    <a href='http://www.deal4loans.com/Contents_Personal_Loan_Mustread.php?source=clAM' target='_blank' style='color:#0a4988; text-decoration:underline;'>Read more about Personal loan</a>  </li>
	
	 <li  ><b>Home Loan:</b> <a href='http://www.deal4loans.com/home-loan-banks.php?source=clAM' target='_blank' style='color:#0a4988; text-decoration:underline;'>Check the Banks</a> | <a href='http://www.deal4loans.com/apply-home-loans.php' target='_blank' style='color:#0a4988; text-decoration:underline;'>Apply for Home Loan</a> | <a href='http://www.deal4loans.com/home-loans-interest-rates.php' target='_blank' style='color:#0a4988; text-decoration:underline;'>Current Rate of Interest</a>  | <br /> 
   </li> 
	
	<li  ><b>Life Insurance:</b> <a href='http://www.bimadeals.in/content/life-insurance-policies' target='_blank' style='color:#0a4988; text-decoration:underline;'>Types of life insurance policies</a> | <a href='http://www.bimadeals.com/life-insurance-india/Contents_Life_Insurance_Mustread.php?source=clAM' target='_blank' style='color:#0a4988; text-decoration:underline;'>Read more about Life Insurance</a>  | <a href='http://www.bimadeals.com/life-insurance-india/Req_Life_Insurance_New.php?source=clAM' target='_blank' style='color:#0a4988; text-decoration:underline;'>Apply for Life Insurance</a></li> 
	
	<li  ><b>Health Insurance:</b> <a href='http://www.bimadeals.com/health-insurance-india/Contents_Health_Insurance_Mustread.php?source=clAM' target='_blank' style='color:#0a4988; text-decoration:underline;'>How much Health Insurance you need</a>  | <a href='http://www.bimadeals.com/health-insurance-india/health-insurance-comparison-chart.php?source=clAM' target='_blank' style='color:#0a4988; text-decoration:underline;'>Compare Family Health Insurance Plan</a>  | <a href='http://www.bimadeals.com/health-insurance-india/Req_Health_Insurance_New.php?source=clAM' target='_blank' style='color:#0a4988; text-decoration:underline;'>Apply for Health Insurance</a></li> 	
</ul>
</td></tr>
<tr><td colspan='2'>&nbsp;</td></tr>
<tr>
  <td colspan='2' bgcolor='#fffbf0' style='border-bottom:thin solid #f2f2f2;'>
 <table cellpadding='0' cellspacing='0' border='0' width='588' align='center' style='max-width:588px; width:98%;'>
<tr>
  <td colspan='2' bgcolor='#FFFFFF' style='font-size:11px; font-weight:normal; font-family:Verdana, Geneva, sans-serif;'><b>Important Tips</b></td>
</tr>
<tr>    
          <td width='16' valign='top'  style='color:#000; font-family: Arial, Helvetica, sans-serif; font-size:12px;'>&bull;</td>
          <td width='1341' style='color:#000; font-family: Arial, Helvetica, sans-serif; font-size:12px; text-align:justify;'>Never pay any cash or any sort of payment/fee to anyone to get any loan approved.</td></tr>
          <tr>
         
          <td width='16' valign='top' style='color:#000; font-family: Arial, Helvetica, sans-serif; font-size:12px;'>&bull;</td>
          <td width='1341' style='color:#000; font-family: Arial, Helvetica, sans-serif; font-size:12px; text-align:justify;'>
No Banks ask for any processing fee upfront</td></tr>
<tr>
         
          <td width='16' valign='top' style='color:#000; font-family: Arial, Helvetica, sans-serif; font-size:12px;'>&bull;</td>
          <td width='1341' style='color:#000; font-family: Arial, Helvetica, sans-serif; font-size:12px; text-align:justify;'>
Do not fall prey to agents who ask for a fee for a loan approval at very cheap interest rates.
</td>
    </tr>
    <tr>
         
          <td width='16' valign='top' style='color:#000; font-family: Arial, Helvetica, sans-serif; font-size:12px;'>&bull;</td>
          <td width='1341' style='color:#000; font-family: Arial, Helvetica, sans-serif; font-size:12px; text-align:justify;'>
Do not fall for offers that guarantee loan approvals with any kind of advance fee payment to any individual in general or even particularly acting on our behalf.
</td>
    </tr>
    </table>
    </td></tr>
	<tr><td colspan='2'>&nbsp;</td></tr>
	<tr><td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#061c33; line-height:18px; '>
<b>Regards</b> <br />
Team Deal4loans.com<br />
Loans by choice not by chance!!<br />
<div style='text-align:center;'><a href='http://www.deal4loans.com/Contents_Blogs.php?source=clAM' target='_blank' style='color:#0a4988; text-decoration:underline;'>Blogs</a> | <a href='http://www.deal4loans.com/Contents_Feedback.php?source=clAM' target='_blank' style='color:#0a4988; text-decoration:underline;'>Testimonials</a> | <a href='http://www.deal4loans.com/Loan_Query.php?source=clAM' target='_blank' style='color:#0a4988; text-decoration:underline;'>LoanQueries</a> </div></td>
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
elseif($Type_Loan == "HomeLoan" || $Type_Loan == "Req_Loan_Home")
			{
				if($City=="Others" && strlen($strcity)>0)
		{
			$hlcity=$strcity;
		}
		else
		{ $hlcity=$City; }
		$hlcitylist="Select citylist From  product_wisecitylist Where ( product=2 )";
$resulthlcity=ExecQuery($hlcitylist);
$hlctyrow=mysql_fetch_array($resulthlcity);
$hlcityliststr = $hlctyrow["citylist"];
$nstr=explode(',', trim($hlcityliststr));
if (in_array($hlcity, $nstr)) {
$Message2 = "<table width='560' border='0' align='center' cellpadding='0' cellspacing='0'>
  <tr>
    <td height='101' align='center' valign='top'><img src='http://www.deal4loans.com/images/mlr-hdr.jpg' width='560' height='101' /></td>
  </tr>
  <tr>
    <td width='560'><table width='560' border='0' align='center' cellpadding='0' cellspacing='0'>
      <tr>
        <td width='1' bgcolor='#7cabda'><img src='http://www.deal4loans.com/images/spacer.gif' width='1'  height='1' border='0' /></td>
        <td><table width='98%' border='0' align='center' cellpadding='0' cellspacing='0'>
          <tr>
            <td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#061c33; line-height:18px; '><b>Dear $FName</b>,<br />
			
			
			Thanks for applying for Home loan on Deal4loans.com We are committed to providing you with a platform to compare and choose the best deal for your loan requirement from our participating banks.
<table width='100%'>
<tr><td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#061c33; line-height:18px; '>Your <b>Profile Summary</b> as per our records:<br />
 Your Name:$FName<br />
Location:$City
<br />
Income/Salary: $Net_Salary
<br />

Email Id: $Email
<br />
Contact : $Phone</td> <td>&nbsp;</td><td><a href='http://www.bimadeals.com/health-insurance.php?source=hlAM' target='_blank'><img src='http://www.deal4loans.com/new-images/healthins180X150.gif' width='180' height='150' border='0'></a></td>
</tr></table>
In 24 working hour you will get a call from our customer care department, where you can choose the Banks from which you want to take the Home Loan. <br />
<br />
</td></tr>
<tr>
  <td colspan='2' align='center' bgcolor='#FFFFFF' style='font-family:Verdana, Geneva, sans-serif; font-size:14px;'>&nbsp;</td>
</tr>
<tr>
  <td colspan='2' align='center' bgcolor='#FFFFFF' style='font-family:Verdana, Geneva, sans-serif; font-size:14px;'>Deal4loans ensures you choose the best deal and grow with your  <br><a href='http://www.deal4loans.com/taraqi-ki-emi.php' style='color:#2291af; text-decoration:none; font-weight:bold;'><em>Taraqi Ki EMI</em></a><br />
    <strong>Learn more, Save more</strong> @ deal4loans-  TV commercial </td>
</tr>
<tr>
  <td colspan='2' bgcolor='#FFFFFF'>&nbsp;</td>
</tr>
<tr>
  <td colspan='2' align='center' bgcolor='#FFFFFF'><a href='https://www.youtube.com/watch?v=7dHR9t_wQuA'><img src='http://www.deal4loans.com/images/taraqi-ki-tile.jpg' width='241' height='118' alt='Taraqi ki EMI' border='0'/></a></td>
</tr>
<tr>
  <td colspan='2' bgcolor='#FFFFFF'>&nbsp;</td>
</tr>
<tr><td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#061c33; line-height:18px; '>
<b>Information on Home Loans:</b>
<ul>
<li>
  <a href='http://www.deal4loans.com/home-loans-interest-rates.php?source=hlAM' style='color:#0a4988; text-decoration:underline;'>Home Loan Interest Rates</a></li>
<li><a href='http://www.deal4loans.com/loans/home-loan/important-pointers-in-home-loan/' style='color:#0a4988; text-decoration:underline;'>Check Points before applying home loans</a></li>
<li> <a href='http://www.deal4loans.com/home-loan-calculator.php?source=hlAM' style='color:#0a4988; text-decoration:underline;'>Calculate your Eligibility for Home loan</a></li>
<li><a href='http://www.deal4loans.com/Contents_Home_Loan_Faqs.php?source=hlAM' style='color:#0a4988; text-decoration:underline;'>Things to keep in mind before going for a Home Loan</a></li>
<li><a href='http://www.deal4loans.com/home-loan-balance-transfer-calculator.php?source=hlAM' style='color:#0a4988; text-decoration:underline;'>Home Loan Balance transfer
       tips</a></li>
                </ul>
<b>Other Services from Deal4loans<br />
<br />
</b>
<ul >
<li ><b>Personal Loan:</b> <a href='http://www.deal4loans.com/personal-loan-banks.php?source=hlAM' target='_blank'  style='color:#0a4988; text-decoration:underline;'>Check the Banks</a> | <a href='http://www.deal4loans.com/apply-personal-loan.php?source=hlAM' target='_blank' style='color:#0a4988; text-decoration:underline;'>Apply for Personal Loan</a>  | <a href='http://www.deal4loans.com/personal-loan-interest-rate.php?source=hlAM' target='_blank'  style='color:#0a4988; text-decoration:underline;'>Current Rate of Interest</a> <br /> 
    <a href='http://www.deal4loans.com/Contents_Personal_Loan_Mustread.php?source=hlAM' target='_blank' style='color:#0a4988; text-decoration:underline;'>Read more about Personal loan</a>  </li>
	
	 <li  ><b>Life Insurance:</b> <a href='http://www.bimadeals.com/life-insurance-india/life-insurance.php' target='_blank' style='color:#0a4988; text-decoration:underline;'>Types of life insurance policies</a> | <a href='http://www.bimadeals.com/life-insurance-india/Contents_Life_Insurance_Mustread.php?source=hlAM' target='_blank' style='color:#0a4988; text-decoration:underline;'>Read more about Life Insurance</a>  | <a href='http://www.bimadeals.com/life-insurance-india/Req_Life_Insurance_New.php?source=hlAM' target='_blank' style='color:#0a4988; text-decoration:underline;'>Apply for Life Insurance</a></li> 
	
	<li ><b>Credit Card:</b> <a href='http://www.deal4loans.com/credit-card-n-debit-card-offers.php?source=hlAM' target='_blank' style='color:#0a4988; text-decoration:underline;'>Check the latest offers on your credit card</a>  | <a href='http://www.deal4loans.com/Contents_Credit_Card_Mustread.php' target='_blank' style='color:#0a4988; text-decoration:underline;'>Read more about Credit card</a>  | <a href='http://www.deal4loans.in/content/what-are-different-kind-fees-credit-cards' target='_blank' style='color:#0a4988; text-decoration:underline;'>Different fees on Credit card</a>   | <a href='http://www.deal4loans.com/apply-credit-card.php' target='_blank' style='color:#0a4988; text-decoration:underline;'>Apply for Credit Card</a>  | <a href='http://www.deal4loans.com/emailer/cc-mailer09.php' target='_blank' style='color:#0a4988; text-decoration:underline;'>Register yourself for credit card offers</a></li>
	<li  ><b>Health Insurance:</b> <a href='http://www.bimadeals.com/health-insurance-india/Contents_Health_Insurance_Mustread.php?source=hlAM' target='_blank' style='color:#0a4988; text-decoration:underline;'>How much Health Insurance you need</a>  | <a href='http://www.bimadeals.com/health-insurance-india/health-insurance-comparison-chart.php?source=hlAM' target='_blank' style='color:#0a4988; text-decoration:underline;'>Compare Family Health Insurance Plan</a>  | <a href='http://www.bimadeals.com/health-insurance-india/Req_Health_Insurance_New.php?source=hlAM' target='_blank' style='color:#0a4988; text-decoration:underline;'>Apply for Health Insurance</a></li> 
</ul>
</td></tr>
<tr><td colspan='2'>&nbsp;</td></tr>
<tr>
  <td colspan='2' bgcolor='#fffbf0' style='border-bottom:thin solid #f2f2f2;'>
 <table cellpadding='0' cellspacing='0' border='0' width='588' align='center' style='max-width:588px; width:98%;'>
<tr>
  <td colspan='2' bgcolor='#FFFFFF' style='font-size:11px; font-weight:normal; font-family:Verdana, Geneva, sans-serif;'><b>Important Tips</b></td>
</tr>
<tr>    
          <td width='16' valign='top'  style='color:#000; font-family: Arial, Helvetica, sans-serif; font-size:12px;'>&bull;</td>
          <td width='1341' style='color:#000; font-family: Arial, Helvetica, sans-serif; font-size:12px; text-align:justify;'>Never pay any cash or any sort of payment/fee to anyone to get any loan approved.</td></tr>
          <tr>
         
          <td width='16' valign='top' style='color:#000; font-family: Arial, Helvetica, sans-serif; font-size:12px;'>&bull;</td>
          <td width='1341' style='color:#000; font-family: Arial, Helvetica, sans-serif; font-size:12px; text-align:justify;'>
No Banks ask for any processing fee upfront</td></tr>
<tr>
         
          <td width='16' valign='top' style='color:#000; font-family: Arial, Helvetica, sans-serif; font-size:12px;'>&bull;</td>
          <td width='1341' style='color:#000; font-family: Arial, Helvetica, sans-serif; font-size:12px; text-align:justify;'>
Do not fall prey to agents who ask for a fee for a loan approval at very cheap interest rates.
</td>
    </tr>
    <tr>         
          <td width='16' valign='top' style='color:#000; font-family: Arial, Helvetica, sans-serif; font-size:12px;'>&bull;</td>
          <td width='1341' style='color:#000; font-family: Arial, Helvetica, sans-serif; font-size:12px; text-align:justify;'>
Do not fall for offers that guarantee loan approvals with any kind of advance fee payment to any individual in general or even particularly acting on our behalf.
</td>
    </tr>
    </table>
    </td></tr>
	<tr><td colspan='2'>&nbsp;</td></tr>
	<tr><td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#061c33; line-height:18px; '>
<b>Regards</b> <br />
Team Deal4loans.com<br />
Loans by choice not by chance!!<br />
<div style='text-align:center;'><a href='http://www.deal4loans.com/Contents_Blogs.php?source=hlAM' target='_blank' style='color:#0a4988; text-decoration:underline;'>Blogs</a> | <a href='http://www.deal4loans.com/Contents_Feedback.php?source=hlAM' target='_blank' style='color:#0a4988; text-decoration:underline;'>Testimonials</a> | <a href='http://www.deal4loans.com/Loan_Query.php?source=hlAM' target='_blank' style='color:#0a4988; text-decoration:underline;'>LoanQueries</a> </div><br><div style='text-align:center; height:20px;'><a href='http://www.deal4loans.com/Contents_Disclaimer.php' style='color:#0a4988; text-decoration:underline;'>Please go through our Disclaimer</a></div></td>
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
else
		{
	$Message2 = "<table width='560' border='0' align='center' cellpadding='0' cellspacing='0'>
  <tr>
    <td height='101' align='center' valign='top'><img src='http://www.deal4loans.com/images/mlr-hdr.jpg' width='560' height='101' /></td>
  </tr>
  <tr>
    <td width='560'><table width='560' border='0' align='center' cellpadding='0' cellspacing='0'>
      <tr>
        <td width='1' bgcolor='#7cabda'><img src='http://www.deal4loans.com/images/spacer.gif' width='1'  height='1' border='0' /></td>
        <td><table width='98%' border='0' align='center' cellpadding='0' cellspacing='0'>
          <tr>
            <td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; '><b>Dear $FName</b>,<br />
			
			
			Thanks for applying for home loan on Deal4loans.com We are committed to providing you with a platform to compare and choose the best deal for your loan requirement from our participating banks.
<table width='100%'>
<tr><td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; '>
Your <b>Profile Summary</b> as per our records:<br />
 Your Name:$FName<br />
Location:$City
<br />
Income/Salary: $Net_Salary
<br />
Email Id: $Email
<br />
Contact : $Phone</td> <td>&nbsp;</td><td><a href='http://www.bimadeals.com/health-insurance.php?source=hlAM' target='_blank'><img src='http://www.deal4loans.com/new-images/healthins180X150.gif' width='180' height='150' border='0'></a></td>
</tr></table>
In 24 working hour you will get a call from our customer care department, where you can choose the Banks from which you want to take the Home Loan. <br />
<br /><br />
<b>Information on Home Loans:</b>
<ul>
<li>
  <a href='http://www.deal4loans.com/home-loans-interest-rates.php?source=hlAM' style='color:#0a4988; text-decoration:underline;'>Home Loan Interest Rates</a></li>
<li><a href='http://www.deal4loans.com/loans/home-loan/important-pointers-in-home-loan/' style='color:#0a4988; text-decoration:underline;'>Check Points before applying home loans</a></li>
<li> <a href='http://www.deal4loans.com/home-loan-calculator.php?source=hlAM' style='color:#0a4988; text-decoration:underline;'>Calculate your Eligibility for Home loan</a></li>
<li><a href='http://www.deal4loans.com/Contents_Home_Loan_Faqs.php?source=hlAM' style='color:#0a4988; text-decoration:underline;'>Things to keep in mind before going for a Home Loan</a></li>
<li><a href='http://www.deal4loans.com/home-loan-balance-transfer-calculator.php?source=hlAM' style='color:#0a4988; text-decoration:underline;'>Home Loan Balance transfer
       tips</a></li>
                </ul>
<b>Other Services from Deal4loans<br />
<br />
</b>
<ul >
<li ><b>Personal Loan:</b> <a href='http://www.deal4loans.com/personal-loan-banks.php?source=hlAM' target='_blank'  style='color:#0a4988; text-decoration:underline;'>Check the Banks</a> | <a href='http://www.deal4loans.com/apply-personal-loan.php?source=hlAM' target='_blank' style='color:#0a4988; text-decoration:underline;'>Apply for Personal Loan</a> | <a href='http://www.deal4loans.com/personal-loan-interest-rate.php?source=hlAM' target='_blank'  style='color:#0a4988; text-decoration:underline;'>Current Rate of Interest</a>  |<br /> 
    <a href='http://www.deal4loans.com/Contents_Personal_Loan_Mustread.php?source=hlAM' target='_blank' style='color:#0a4988; text-decoration:underline;'>Read more about Personal loan</a>  </li>
	
	 <li  ><b>Life Insurance:</b> <a href='http://www.bimadeals.com/life-insurance-india/life-insurance.php?source=hlAM' target='_blank' style='color:#0a4988; text-decoration:underline;'>Types of life insurance policies</a> | <a href='http://www.bimadeals.com/life-insurance-india/Contents_Life_Insurance_Mustread.php?source=hlAM' target='_blank' style='color:#0a4988; text-decoration:underline;'>Read more about Life Insurance</a>  | <a href='http://www.bimadeals.com/life-insurance-india/Req_Life_Insurance_New.php?source=hlAM' target='_blank' style='color:#0a4988; text-decoration:underline;'>Apply for Life Insurance</a></li> 
	
	<li ><b>Credit Card:</b> <a href='http://www.deal4loans.com/credit-card-n-debit-card-offers.php?source=hlAM' target='_blank' style='color:#0a4988; text-decoration:underline;'>Check the latest offers on your credit card</a>  | <a href='http://www.deal4loans.com/Contents_Credit_Card_Mustread.php' target='_blank' style='color:#0a4988; text-decoration:underline;'>Read more about Credit card</a>  | <a href='http://www.deal4loans.in/content/what-are-different-kind-fees-credit-cards' target='_blank' style='color:#0a4988; text-decoration:underline;'>Different fees on Credit card</a>   | <a href='http://www.deal4loans.com/apply-credit-card.php' target='_blank' style='color:#0a4988; text-decoration:underline;'>Apply for Credit Card</a>  | <a href='http://www.deal4loans.com/emailer/cc-mailer09.php' target='_blank' style='color:#0a4988; text-decoration:underline;'>Register yourself for credit card offers</a></li>
	<li  ><b>Health Insurance:</b> <a href='http://www.bimadeals.com/health-insurance-india/Contents_Health_Insurance_Mustread.php?source=hlAM' target='_blank' style='color:#0a4988; text-decoration:underline;'>How much Health Insurance you need</a>  | <a href='http://www.bimadeals.com/health-insurance-india/health-insurance-comparison-chart.php?source=hlAM' target='_blank' style='color:#0a4988; text-decoration:underline;'>Compare Family Health Insurance Plan</a>  | <a href='http://www.bimadeals.com/health-insurance-india/Req_Health_Insurance_New.php?source=hlAM' target='_blank' style='color:#0a4988; text-decoration:underline;'>Apply for Health Insurance</a></li> 
</ul>
</td></tr>
<tr><td colspan='2'>&nbsp;</td></tr>
<tr>
  <td colspan='2' bgcolor='#fffbf0' style='border-bottom:thin solid #f2f2f2;'>
  <table cellpadding='0' cellspacing='0' border='0' width='588' align='center' style='max-width:588px; width:98%;'>
<tr>
  <td colspan='2' bgcolor='#FFFFFF' style='font-size:11px; font-weight:normal; font-family:Verdana, Geneva, sans-serif;'><b>Important Tips</b></td>
</tr>
<tr>    
          <td width='16' valign='top'  style='color:#000; font-family: Arial, Helvetica, sans-serif; font-size:12px;'>&bull;</td>
          <td width='1341' style='color:#000; font-family: Arial, Helvetica, sans-serif; font-size:12px; text-align:justify;'>Never pay any cash or any sort of payment/fee to anyone to get any loan approved.</td></tr>
          <tr>
         
          <td width='16' valign='top' style='color:#000; font-family: Arial, Helvetica, sans-serif; font-size:12px;'>&bull;</td>
          <td width='1341' style='color:#000; font-family: Arial, Helvetica, sans-serif; font-size:12px; text-align:justify;'>
No Banks ask for any processing fee upfront</td></tr>
<tr>         
          <td width='16' valign='top' style='color:#000; font-family: Arial, Helvetica, sans-serif; font-size:12px;'>&bull;</td>
          <td width='1341' style='color:#000; font-family: Arial, Helvetica, sans-serif; font-size:12px; text-align:justify;'>
Do not fall prey to agents who ask for a fee for a loan approval at very cheap interest rates.
</td>
    </tr>
    <tr>         
          <td width='16' valign='top' style='color:#000; font-family: Arial, Helvetica, sans-serif; font-size:12px;'>&bull;</td>
          <td width='1341' style='color:#000; font-family: Arial, Helvetica, sans-serif; font-size:12px; text-align:justify;'>
Do not fall for offers that guarantee loan approvals with any kind of advance fee payment to any individual in general or even particularly acting on our behalf.
</td>
    </tr>
    </table>
    </td></tr>
	<tr><td colspan='2'>&nbsp;</td></tr>
	<tr> <td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; '><b>Dear $FName</b>,<br />
<b>Regards</b> <br />
Team Deal4loans.com<br />
Loans by choice not by chance!!<br />
<div style='text-align:center;'><a href='http://www.deal4loans.com/Contents_Blogs.php?source=hlAM' target='_blank' style='color:#0a4988; text-decoration:underline;'>Blogs</a> | <a href='http://www.deal4loans.com/Contents_Feedback.php?source=hlAM' target='_blank' style='color:#0a4988; text-decoration:underline;'>Testimonials</a> | <a href='http://www.deal4loans.com/Loan_Query.php?source=hlAM' target='_blank' style='color:#0a4988; text-decoration:underline;'>LoanQueries</a> </div><br><div style='text-align:center; height:20px;'><a href='http://www.deal4loans.com/Contents_Disclaimer.php' style='color:#0a4988; text-decoration:underline;'>Please go through our Disclaimer</a></div></td>
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
	elseif($Type_Loan == "PropertyLoan" || $Type_Loan == "Req_Loan_Against_Property") 
	{
		$Message2 = "<table width='560' border='0' align='center' cellpadding='0' cellspacing='0'>
  <tr>
    <td height='101' align='center' valign='top'><img src='http://www.deal4loans.com/images/mlr-hdr.jpg' width='560' height='101' /></td>
  </tr>
  <tr>
    <td width='560'><table width='560' border='0' align='center' cellpadding='0' cellspacing='0'>
      <tr>
        <td width='1' bgcolor='#7cabda'><img src='http://www.deal4loans.com/images/spacer.gif' width='1'  height='1' border='0' /></td>
        <td><table width='98%' border='0' align='center' cellpadding='0' cellspacing='0'>
          <tr>
            <td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#061c33; line-height:18px; '><b>Dear $FName</b>,<br />
			
			
			Thanks for applying for Loan Against Property on Deal4loans.com We are committed to providing you with a platform to compare and choose the best deal for your loan requirement.<br />
			<br />
Your <b>Profile Summary</b> as per our records:<br />
 Your Name:$FName<br />
Location:$City
<br />
Income/Salary: $Net_Salary
<br />
Email Id: $Email
<br />
Contact : $Phone
<br />
</td></tr>
<tr>
  <td colspan='2' align='center' bgcolor='#FFFFFF' style='font-family:Verdana, Geneva, sans-serif; font-size:14px;'>&nbsp;</td>
</tr>
<tr>
  <td colspan='2' align='center' bgcolor='#FFFFFF' style='font-family:Verdana, Geneva, sans-serif; font-size:14px;'>Deal4loans ensures you choose the best deal and grow with your<br>  <a href='http://www.deal4loans.com/taraqi-ki-emi.php' style='color:#2291af; text-decoration:none; font-weight:bold;'><em>Taraqi Ki EMI</em></a><br />
    <strong>Learn more, Save more</strong> @ deal4loans-  TV commercial </td>
</tr>
<tr>
  <td colspan='2' bgcolor='#FFFFFF'>&nbsp;</td>
</tr>
<tr>
  <td colspan='2' align='center' bgcolor='#FFFFFF'><a href='https://www.youtube.com/watch?v=7dHR9t_wQuA'><img src='http://www.deal4loans.com/images/taraqi-ki-tile.jpg' width='241' height='118' alt='Taraqi ki EMI' border='0'/></a></td>
</tr>
<tr>
  <td colspan='2' bgcolor='#FFFFFF'>&nbsp;</td>
</tr>
<tr><td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#061c33; line-height:18px; '>
<a href='http://www.deal4loans.com/Contents_Loan_Against_Property.php?source=lapAM' style='color:#0a4988; text-decoration:underline;'><b>Product Features</b></a>
<br /><a href='http://deal4loans.com/Contents_Calculators.php?source=lapAM' style='color:#0a4988; text-decoration:underline;'><b>Calculate your EMI</b></a><br />
<a href='http://deal4loans.com/Contents_Loan_Against_Property_Mustread.php?source=lapAM' style='color:#0a4988; text-decoration:underline;'><b>Points to ponder</b></a><br /><br />
<b>Other Services from Deal4loans<br />
<br />
</b>
<ul >
<li ><b>Personal Loan:</b> <a href='http://www.deal4loans.com/personal-loan-banks.php?source=lapAM' target='_blank'  style='color:#0a4988; text-decoration:underline;'>Check the Banks</a> | <a href='http://www.deal4loans.com/apply-personal-loan.php?source=lapAM' target='_blank' style='color:#0a4988; text-decoration:underline;'>Apply for Personal Loan</a>  | <a href='http://www.deal4loans.com/personal-loan-interest-rate.php?source=lapAM' target='_blank'  style='color:#0a4988; text-decoration:underline;'>Current Rate of Interest</a>  |<br /> 
    <a href='http://www.deal4loans.com/Contents_Personal_Loan_Mustread.php?source=lapAM' target='_blank' style='color:#0a4988; text-decoration:underline;'>Read more about Personal loan</a> </li>
	
	 <li ><b>Home Loan:</b> <a href='http://www.deal4loans.com/home-loan-banks.php?source=lapAM' target='_blank' style='color:#0a4988; text-decoration:underline;'>Check the Banks</a> | <a href='http://www.deal4loans.com/apply-home-loans.php?source=lapAM' target='_blank' style='color:#0a4988; text-decoration:underline;'>Apply for Home Loan</a> | <a href='http://www.deal4loans.com/home-loans-interest-rates.php' target='_blank' style='color:#0a4988; text-decoration:underline;'>Current Rate of Interest</a> | <br />
       <a href='http://www.deal4loans.com/Contents_Home_Loan_Mustread.php?source=lapAM' target='_blank' style='color:#0a4988; text-decoration:underline;'>Read more about Home Loan</a> </li>
	 <li  ><b>Life Insurance:</b> <a href='http://www.bimadeals.in/content/life-insurance-policies' target='_blank' style='color:#0a4988; text-decoration:underline;'>Types of life insurance policies</a> | <a href='http://www.bimadeals.com/life-insurance-india/Contents_Life_Insurance_Mustread.php' target='_blank' style='color:#0a4988; text-decoration:underline;'>Read more about Life Insurance</a>  | <a href='http://www.bimadeals.com/life-insurance-india/Req_Life_Insurance_New.php?source=lapAM' target='_blank' style='color:#0a4988; text-decoration:underline;'>Apply for Life Insurance</a></li> 
	
	<li ><b>Credit Card:</b> <a href='http://www.deal4loans.com/credit-card-archives.php?source=lapAM' target='_blank' style='color:#0a4988; text-decoration:underline;'>Check the latest offers on your credit card</a>  | <a href='http://www.deal4loans.com/Contents_Credit_Card_Mustread.php' target='_blank' style='color:#0a4988; text-decoration:underline;'>Read more about Credit card</a>  | <a href='http://www.deal4loans.in/content/what-are-different-kind-fees-credit-cards' target='_blank' style='color:#0a4988; text-decoration:underline;'>Different fees on Credit card</a>   | <a href='http://www.deal4loans.com/apply-credit-card.php' target='_blank' style='color:#0a4988; text-decoration:underline;'>Apply for Credit Card</a>  | <a href='http://www.deal4loans.com/emailer/cc-mailer09.php?source=lapAM' target='_blank' style='color:#0a4988; text-decoration:underline;'>Register yourself for credit card offers</a></li>
	<li  ><b>Health Insurance:</b> <a href='http://www.bimadeals.com/health-insurance-india/Contents_Health_Insurance_Mustread.php?source=lapAM' target='_blank' style='color:#0a4988; text-decoration:underline;'>How much Health Insurance you need</a>  | <a href='http://www.bimadeals.com/health-insurance-india/health-insurance-comparison-chart.php?source=lapAM' target='_blank' style='color:#0a4988; text-decoration:underline;'>Compare Family Health Insurance Plan</a>  | <a href='http://www.bimadeals.com/health-insurance-india/Req_Health_Insurance_New.php?source=lapAM' target='_blank' style='color:#0a4988; text-decoration:underline;'>Apply for Health Insurance</a></li> 
	</ul>
	</td></tr>
	<tr><td colspan='2'>&nbsp;</td></tr>
	<tr>
  <td colspan='2' bgcolor='#fffbf0' style='border-bottom:thin solid #f2f2f2;'>
  <table cellpadding='0' cellspacing='0' border='0' width='588' align='center' style='max-width:588px; width:98%;'>
<tr>
  <td colspan='2' bgcolor='#FFFFFF' style='font-size:11px; font-weight:normal; font-family:Verdana, Geneva, sans-serif;'><b>Important Tips</b></td>
</tr>
<tr>           <td width='16' valign='top'  style='color:#000; font-family: Arial, Helvetica, sans-serif; font-size:12px;'>&bull;</td>
          <td width='1341' style='color:#000; font-family: Arial, Helvetica, sans-serif; font-size:12px; text-align:justify;'>Never pay any cash or any sort of payment/fee to anyone to get any loan approved.</td></tr>
          <tr>
         
          <td width='16' valign='top' style='color:#000; font-family: Arial, Helvetica, sans-serif; font-size:12px;'>&bull;</td>
          <td width='1341' style='color:#000; font-family: Arial, Helvetica, sans-serif; font-size:12px; text-align:justify;'>
No Banks ask for any processing fee upfront</td></tr>
<tr>                   <td width='16' valign='top' style='color:#000; font-family: Arial, Helvetica, sans-serif; font-size:12px;'>&bull;</td>
          <td width='1341' style='color:#000; font-family: Arial, Helvetica, sans-serif; font-size:12px; text-align:justify;'>
Do not fall prey to agents who ask for a fee for a loan approval at very cheap interest rates.
</td>
    </tr>
    <tr>         
          <td width='16' valign='top' style='color:#000; font-family: Arial, Helvetica, sans-serif; font-size:12px;'>&bull;</td>
          <td width='1341' style='color:#000; font-family: Arial, Helvetica, sans-serif; font-size:12px; text-align:justify;'>
Do not fall for offers that guarantee loan approvals with any kind of advance fee payment to any individual in general or even particularly acting on our behalf.
</td>
    </tr>
    </table>
    </td></tr>
	<tr><td colspan='2'>&nbsp;</td></tr>
	<tr><td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#061c33; line-height:18px; '>
<b>Regards</b> <br />
Team Deal4loans.com<br />
Loans by choice not by chance!!<br />
<div style='text-align:center;'><a href='http://www.deal4loans.com/Contents_Blogs.php?source=lapAM' target='_blank' style='color:#0a4988; text-decoration:underline;'>Blogs</a> | <a href='http://www.deal4loans.com/Contents_Feedback.php?source=lapAM' target='_blank' style='color:#0a4988; text-decoration:underline;'>Testimonials</a> | <a href='http://www.deal4loans.com/Loan_Query.php?source=lapAM' target='_blank' style='color:#0a4988; text-decoration:underline;'>LoanQueries</a> </div><br><div style='text-align:center; height:20px;'><a href='http://www.deal4loans.com/Contents_Disclaimer.php' style='color:#0a4988; text-decoration:underline;'>Please go through our Disclaimer</a></div></td>
          </tr>
  <tr><td height='110' valign='middle'><a href='http://www.deal4loans.com/earn-credit-card.php?source=plAM' target='_blank'><img src='http://www.deal4loans.com/images/crdt-bann-mlr.gif' width='550' height='101' border='0'/></a></td>
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
	elseif($Type_Loan == "CarLoan" || $Type_Loan == "Req_Loan_Car") 
	{
		if($City=="Others" && strlen($strcity)>0)
		{
			$clcity=$strcity;
		}
		else
		{ $clcity=$City; }
		$clcitylist="Select citylist From  product_wisecitylist Where ( product=3 )";
$resultclcity=ExecQuery($clcitylist);
$clctyrow=mysql_fetch_array($resultclcity);
$clcityliststr = $clctyrow["citylist"];
$nclstr=explode(',', trim($clcityliststr));
if (in_array($clcity, $nclstr)) {
$Message2 = "<table width='560' border='0' align='center' cellpadding='0' cellspacing='0'>
  <tr>
    <td height='101' align='center' valign='top'><img src='http://www.deal4loans.com/images/mlr-hdr.jpg' width='560' height='101' /></td>
  </tr>
  <tr>
    <td width='560'><table width='560' border='0' align='center' cellpadding='0' cellspacing='0'>
      <tr>
        <td width='1' bgcolor='#7cabda'><img src='http://www.deal4loans.com/images/spacer.gif' width='1'  height='1' border='0' /></td>
        <td><table width='98%' border='0' align='center' cellpadding='0' cellspacing='0'>
          <tr>
            <td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#061c33; line-height:18px; '><b>Dear $FName,</b>,<br />

			 Thank you for applying on Deal4loans.com We are committed to provide you with a platform to compare and choose the best deal for your loan requirement <table width='100%'>
<tr><td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#061c33; line-height:18px; '>
			 Your <b>Profile Summary</b> as per our records:<br />
 
Your Name: $FName<br />
Location: $City<br />
Income/Salary: $Net_Salary<br />
Email Id: $Email<br />
Contact :$Phone
</td> <td>&nbsp;</td><td><a href='http://www.bimadeals.com/health-insurance.php?source=hlAM' target='_blank'><img src='http://www.deal4loans.com/new-images/healthins180X150.gif' width='180' height='150' border='0'></a></td>
</tr></table>
You will receive various deals from banks both at your EMAIL ID and Phone.<br />
<br />
</td></tr>
<tr>
  <td colspan='2' align='center' bgcolor='#FFFFFF' style='font-family:Verdana, Geneva, sans-serif; font-size:14px;'>Deal4loans ensures you choose the best deal and grow with your  <br><a href='http://www.deal4loans.com/taraqi-ki-emi.php' style='color:#2291af; text-decoration:none; font-weight:bold;'><em>Taraqi Ki EMI</em></a><br />
    <strong>Learn more, Save more</strong> @ deal4loans-  TV commercial </td>
</tr>
<tr>
  <td colspan='2' bgcolor='#FFFFFF'>&nbsp;</td>
</tr>
<tr>
  <td colspan='2' align='center' bgcolor='#FFFFFF'><a href='https://www.youtube.com/watch?v=7dHR9t_wQuA'><img src='http://www.deal4loans.com/images/taraqi-ki-tile.jpg' width='241' height='118' alt='Taraqi ki EMI' border='0'/></a></td>
</tr>
<tr>
  <td colspan='2' bgcolor='#FFFFFF'>&nbsp;</td>
</tr>
<tr><td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#061c33; line-height:18px; '>
<b>Articles Gallery</b>
<ul>
<li>
  <a href='http://www.deal4loans.com/credit-card-offers.php?source=clAM' style='color:#0a4988; text-decoration:underline;'>Credit Card Offers</a></li>
<li><a href='http://www.deal4loans.in/content/know-more-about-credit-score' style='color:#0a4988; text-decoration:underline;'>Know More About Credit Score</a></li>
<li>
    <a href='http://www.deal4loans.in/content/banks-now-refer-cibil-report-sanctioning-a-loan' style='color:#0a4988; text-decoration:underline;'>Cibil Check before sanctioning loan</a></li>
<li><a href='http://www.bimadeals.in/content/purchase-right-insurance-policy' style='color:#0a4988; text-decoration:underline;'>Purchase the right Insurance Policy</a></li>
</ul>
<b>Other Services from Deal4loans<br />
<br />
</b>
<ul >
<li ><b>Personal Loan:</b> <a href='http://www.deal4loans.com/personal-loan-banks.php?source=clAM' target='_blank'  style='color:#0a4988; text-decoration:underline;'>Check the Banks</a> | <a href='http://www.deal4loans.com/apply-personal-loan.php?source=clAM' target='_blank' style='color:#0a4988; text-decoration:underline;'>Apply for Personal Loan</a>  | <a href='http://www.deal4loans.com/personal-loan-interest-rate.php' target='_blank'  style='color:#0a4988; text-decoration:underline;'>Current Rate of Interest</a> |<br /> 
    <a href='http://www.deal4loans.com/Contents_Personal_Loan_Mustread.php' target='_blank' style='color:#0a4988; text-decoration:underline;'>Read more about Personal loan</a>  | </li>
	
	 <li  ><b>Home Loan:</b> <a href='http://www.deal4loans.com/home-loan-banks.php?source=clAM' target='_blank' style='color:#0a4988; text-decoration:underline;'>Check the Banks</a> |  <a href='http://www.deal4loans.com/apply-home-loans.php?source=clAM' target='_blank' style='color:#0a4988; text-decoration:underline;'>Apply for Home Loan</a>| <a href='http://www.deal4loans.com/home-loans-interest-rates.php' target='_blank' style='color:#0a4988; text-decoration:underline;'>Current Rate of Interest</a> | <br /> 
    <a href='http://www.deal4loans.com/Contents_Home_Loan_Mustread.php' target='_blank' style='color:#0a4988; text-decoration:underline;'>Read more about Home Loan</a> |</li> 
	
	<li  ><b>Life Insurance:</b> <a href='http://www.bimadeals.in/content/life-insurance-policies' target='_blank' style='color:#0a4988; text-decoration:underline;'>Types of life insurance policies</a> | <a href='http://www.bimadeals.com/life-insurance-india/Contents_Life_Insurance_Mustread.php?source=clAM' target='_blank' style='color:#0a4988; text-decoration:underline;'>Read more about Life Insurance</a>  | <a href='http://www.bimadeals.com/life-insurance-india/Req_Life_Insurance_New.php?source=clAM' target='_blank' style='color:#0a4988; text-decoration:underline;'>Apply for Life Insurance</a></li> 
	
	<li ><b>Credit Card:</b> <a href='http://www.deal4loans.com/credit-card-archives.php?source=clAM' target='_blank' style='color:#0a4988; text-decoration:underline;'>Check the latest offers on your credit card</a>  | <a href='http://www.deal4loans.com/Contents_Credit_Card_Mustread.php' target='_blank' style='color:#0a4988; text-decoration:underline;'>Read more about Credit card</a>  | <a href='http://www.deal4loans.in/content/what-are-different-kind-fees-credit-cards' target='_blank' style='color:#0a4988; text-decoration:underline;'>Different fees on Credit card</a>   | <a href='http://www.deal4loans.com/apply-credit-card.php' target='_blank' style='color:#0a4988; text-decoration:underline;'>Apply for Credit Card</a>  | <a href='http://www.deal4loans.com/emailer/cc-mailer09.php?source=clAM' target='_blank' style='color:#0a4988; text-decoration:underline;'>Register yourself for credit card offers</a></li>
	<li  ><b>Health Insurance:</b> <a href='http://www.bimadeals.com/health-insurance-india/Contents_Health_Insurance_Mustread.php?source=clAM' target='_blank' style='color:#0a4988; text-decoration:underline;'>How much Health Insurance you need</a>  | <a href='http://www.bimadeals.com/health-insurance-india/health-insurance-comparison-chart.php?source=clAM' target='_blank' style='color:#0a4988; text-decoration:underline;'>Compare Family Health Insurance Plan</a>  | <a href='http://www.bimadeals.com/health-insurance-india/Req_Health_Insurance_New.php?source=clAM' target='_blank' style='color:#0a4988; text-decoration:underline;'>Apply for Health Insurance</a></li> 
	</ul>
	</td></tr>
	<tr><td colspan='2'>&nbsp;</td></tr>
	<tr>
  <td colspan='2' bgcolor='#fffbf0' style='border-bottom:thin solid #f2f2f2;'>
 <table cellpadding='0' cellspacing='0' border='0' width='588' align='center' style='max-width:588px; width:98%;'>
<tr>
  <td colspan='2' bgcolor='#FFFFFF' style='font-size:11px; font-weight:normal; font-family:Verdana, Geneva, sans-serif;'><b>Important Tips</b></td>
</tr>
<tr>    
          <td width='16' valign='top'  style='color:#000; font-family: Arial, Helvetica, sans-serif; font-size:12px;'>&bull;</td>
          <td width='1341' style='color:#000; font-family: Arial, Helvetica, sans-serif; font-size:12px; text-align:justify;'>Never pay any cash or any sort of payment/fee to anyone to get any loan approved.</td></tr>
          <tr>
         
          <td width='16' valign='top' style='color:#000; font-family: Arial, Helvetica, sans-serif; font-size:12px;'>&bull;</td>
          <td width='1341' style='color:#000; font-family: Arial, Helvetica, sans-serif; font-size:12px; text-align:justify;'>
No Banks ask for any processing fee upfront</td></tr>
<tr>        
          <td width='16' valign='top' style='color:#000; font-family: Arial, Helvetica, sans-serif; font-size:12px;'>&bull;</td>
          <td width='1341' style='color:#000; font-family: Arial, Helvetica, sans-serif; font-size:12px; text-align:justify;'>
Do not fall prey to agents who ask for a fee for a loan approval at very cheap interest rates.
</td>
    </tr>
    <tr>         
          <td width='16' valign='top' style='color:#000; font-family: Arial, Helvetica, sans-serif; font-size:12px;'>&bull;</td>
          <td width='1341' style='color:#000; font-family: Arial, Helvetica, sans-serif; font-size:12px; text-align:justify;'>
Do not fall for offers that guarantee loan approvals with any kind of advance fee payment to any individual in general or even particularly acting on our behalf.
</td>
    </tr>
    </table>
    </td></tr>
	<tr><td colspan='2'>&nbsp;</td></tr>
	<tr><td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#061c33; line-height:18px; '>
<b>Regards</b> <br />
Team Deal4loans.com<br />
Loans by choice not by chance!!<br />
<div style='text-align:center;'><a href='http://www.deal4loans.com/Contents_Blogs.php?source=clAM' target='_blank' style='color:#0a4988; text-decoration:underline;'>Blogs</a> | <a href='http://www.deal4loans.com/Contents_Feedback.php?source=clAM' target='_blank' style='color:#0a4988; text-decoration:underline;'>Testimonials</a> | <a href='http://www.deal4loans.com/Loan_Query.php?source=clAM' target='_blank' style='color:#0a4988; text-decoration:underline;'>LoanQueries</a></div><br><div style='text-align:center; height:20px;'><a href='http://www.deal4loans.com/Contents_Disclaimer.php' style='color:#0a4988; text-decoration:underline;'>Please go through our Disclaimer</a></div></td>
          </tr>
  <tr><td height='110' valign='middle'><a href='http://www.deal4loans.com/earn-credit-card.php?source=plAM' target='_blank'><img src='http://www.deal4loans.com/images/crdt-bann-mlr.gif' width='550' height='101' border='0'/></a></td>
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
else
		{
	$Message2 = "<table width='560' border='0' align='center' cellpadding='0' cellspacing='0'>
  <tr>
    <td height='101' align='center' valign='top'><img src='http://www.deal4loans.com/images/mlr-hdr.jpg' width='560' height='101' /></td>
  </tr>
  <tr>
    <td width='560'><table width='560' border='0' align='center' cellpadding='0' cellspacing='0'>
      <tr>
        <td width='1' bgcolor='#7cabda'><img src='http://www.deal4loans.com/images/spacer.gif' width='1'  height='1' border='0' /></td>
        <td><table width='98%' border='0' align='center' cellpadding='0' cellspacing='0'>
          <tr>
            <td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; '><b>User Name</b>,<br />
              
              Thank you for applying on Deal4loans.com<br /> 
              Your application has not been serviced because currently we don't have any associations with the Banks and DSAs for your city. But we can inform you about the other possible areas from where you can get your Loan/ Card. Below given are the ways from which you can easily avail the credit from your existing banks with which you are sharing a relation on the following grounds:<br />
           
		   <ul>
		   <li>In which you have your saving account/ Current Account </li>
		   <li>You
       hold a credit card of that bank</li>
		   <li>You
       are running a current loan like car loan, personal loan, credit card
       loan etc.</li>
		   </ul>
		   Following are the List of banks from which you can contact for
  your Credit Card requirement:
		   
		   <br />		   
		   <a href='http://www.axisbank.com/24x7banking/telebanking/Tele-Banking.asp' style='color:#0a4988; text-decoration:underline;'>Axis Bank</a> | <a href='http://www.barclaycard.in/' style='color:#0a4988; text-decoration:underline;'>Barclays Bank</a>  | <a href='http://www.online.citibank.co.in/customerservice/citiphone.htm' style='color:#0a4988; text-decoration:underline;'>Citibank</a>  | Deutsche Bank- Call 6601  6601  | <a href='https://www.gemoney.in/GEAsiaWebInd/ind?appFunc=DisplayBranchLocator' style='color:#0a4988; text-decoration:underline;'>GE Money</a>  | <a href='http://www.hdfcbank.com/personal/access/popup_pbnumbers.htm' style='color:#0a4988; text-decoration:underline;'>HDFC Bank</a>  | <a href='http://www.hsbc.co.in/1/2/miscellaneous/call-us' style='color:#0a4988; text-decoration:underline;'>HSBC Bank</a>  | <a href='http://icicibank.com/pfsuser/customer/cuscarenos.htm' style='color:#0a4988; text-decoration:underline;'>ICICI Bank</a>  | <a href='http://www.sbi.co.in/viewsection.jsp?id=0,453,554' style='color:#0a4988; text-decoration:underline;'>SBI</a><br />    
                <br />
                Articles
                Gallery 
                <ul><li>
  <a href='http://www.deal4loans.com/credit-card-offers.php' style='color:#0a4988; text-decoration:underline;'>Credit Card Offers</a></li>
<li><a href='http://www.deal4loans.in/content/know-more-about-credit-score' style='color:#0a4988; text-decoration:underline;'>Know More About Credit Score</a></li>
<li>    <a href='http://www.deal4loans.in/content/banks-now-refer-cibil-report-sanctioning-a-loan' style='color:#0a4988; text-decoration:underline;'>Cibil Check before sanctioning loan</a></li>
<li><a href='http://www.bimadeals.in/content/purchase-right-insurance-policy' style='color:#0a4988; text-decoration:underline;'>Purchase the right Insurance Policy</a></li>
</ul>
<b>Other Services from Deal4loans<br />
<br />
</b>
<ul >
<li ><b>Personal Loan:</b> <a href='http://deal4loans.com/personal-loan-banks.php' target='_blank'  style='color:#0a4988; text-decoration:underline;'>Check the Banks</a> | <a href='http://www.deal4loans.com/apply-personal-loan.php' target='_blank' style='color:#0a4988; text-decoration:underline;'>Apply for Personal Loan</a>  | <a href='http://www.deal4loans.com/Interest-Rate-Personal-Loans.php' target='_blank'  style='color:#0a4988; text-decoration:underline;'>Current Rate of Interest</a> <br /> 
    <a href='http://www.deal4loans.com/Contents_Personal_Loan_Mustread.php' target='_blank' style='color:#0a4988; text-decoration:underline;'>Read more about Personal loan</a> </li>	
	 <li  ><b>Home Loan:</b> <a href='http://www.deal4loans.com/home-loan-banks.php' target='_blank' style='color:#0a4988; text-decoration:underline;'>Check the Banks</a> | <a href='http://www.deal4loans.com/apply-home-loans.php' target='_blank' style='color:#0a4988; text-decoration:underline;'>Apply for Home Loan</a> | <a href='http://www.deal4loans.com/Interest-Rate-Home-Loans.php' target='_blank' style='color:#0a4988; text-decoration:underline;'>Current Rate of Interest</a> <br /> 
    <a href='http://www.deal4loans.com/Contents_Home_Loan_Mustread.php' target='_blank' style='color:#0a4988; text-decoration:underline;'>Read more about Home Loan</a> | </li>	
	<li  ><b>Life Insurance:</b> <a href='http://www.bimadeals.in/content/life-insurance-policies' target='_blank' style='color:#0a4988; text-decoration:underline;'>Types of life insurance policies</a> | <a href='http://www.bimadeals.com/life-insurance-india/Contents_Life_Insurance_Mustread.php' target='_blank' style='color:#0a4988; text-decoration:underline;'>Read more about Life Insurance</a>  | <a href='http://www.bimadeals.com/life-insurance-india/Req_Life_Insurance_New.php' target='_blank' style='color:#0a4988; text-decoration:underline;'>Apply for Life Insurance</a></li> 	
	<li ><b>Credit Card:</b> <a href='http://www.deal4loans.com/credit-card-archives.php' target='_blank' style='color:#0a4988; text-decoration:underline;'>Check the latest offers on your credit card</a>  | <a href='http://www.deal4loans.com/Contents_Credit_Card_Mustread.php' target='_blank' style='color:#0a4988; text-decoration:underline;'>Read more about Credit card</a>  | <a href='http://www.deal4loans.in/content/what-are-different-kind-fees-credit-cards' target='_blank' style='color:#0a4988; text-decoration:underline;'>Different fees on Credit card</a>   | <a href='http://www.deal4loans.com/apply-credit-card.php' target='_blank' style='color:#0a4988; text-decoration:underline;'>Apply for Credit Card</a>  | <a href='http://www.deal4loans.com/emailer/cc-mailer09.php' target='_blank' style='color:#0a4988; text-decoration:underline;'>Register yourself for credit card offers</a></li>
	<li  ><b>Health Insurance:</b> <a href='http://www.bimadeals.com/health-insurance-india/Contents_Health_Insurance_Mustread.php' target='_blank' style='color:#0a4988; text-decoration:underline;'>How much Health Insurance you need</a>  | <a href='http://www.bimadeals.com/health-insurance-india/health-insurance-comparison-chart.php' target='_blank' style='color:#0a4988; text-decoration:underline;'>Compare Family Health Insurance Plan</a>  | <a href='http://www.bimadeals.com/health-insurance-india/Req_Health_Insurance_New.php' target='_blank' style='color:#0a4988; text-decoration:underline;'>Apply for Health Insurance</a></li> 	
</ul>
</td></tr>
<tr><td colspan='2'>&nbsp;</td></tr>
<tr>
  <td colspan='2' bgcolor='#fffbf0' style='border-bottom:thin solid #f2f2f2;'>
 <table cellpadding='0' cellspacing='0' border='0' width='588' align='center' style='max-width:588px; width:98%;'>
<tr>
  <td colspan='2' bgcolor='#FFFFFF' style='font-size:11px; font-weight:normal; font-family:Verdana, Geneva, sans-serif;'><b>Important Tips</b></td>
</tr>
<tr>  
          <td width='16' valign='top'  style='color:#000; font-family: Arial, Helvetica, sans-serif; font-size:12px;'>&bull;</td>
          <td width='1341' style='color:#000; font-family: Arial, Helvetica, sans-serif; font-size:12px; text-align:justify;'>Never pay any cash or any sort of payment/fee to anyone to get any loan approved.</td></tr>
          <tr>
         
          <td width='16' valign='top' style='color:#000; font-family: Arial, Helvetica, sans-serif; font-size:12px;'>&bull;</td>
          <td width='1341' style='color:#000; font-family: Arial, Helvetica, sans-serif; font-size:12px; text-align:justify;'>
No Banks ask for any processing fee upfront</td></tr>
<tr>         
          <td width='16' valign='top' style='color:#000; font-family: Arial, Helvetica, sans-serif; font-size:12px;'>&bull;</td>
          <td width='1341' style='color:#000; font-family: Arial, Helvetica, sans-serif; font-size:12px; text-align:justify;'>
Do not fall prey to agents who ask for a fee for a loan approval at very cheap interest rates.
</td>
    </tr>
    <tr>        
          <td width='16' valign='top' style='color:#000; font-family: Arial, Helvetica, sans-serif; font-size:12px;'>&bull;</td>
          <td width='1341' style='color:#000; font-family: Arial, Helvetica, sans-serif; font-size:12px; text-align:justify;'>
Do not fall for offers that guarantee loan approvals with any kind of advance fee payment to any individual in general or even particularly acting on our behalf.
</td>
    </tr>
    </table>
    </td></tr>
	<tr><td colspan='2'>&nbsp;</td></tr>
	<tr><td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; '>
<b>Regards</b> <br />
Team Deal4loans.com<br />
Loans by choice not by chance!!<br />
<div style='text-align:center;'><a href='http://www.deal4loans.com/Contents_Blogs.php' target='_blank' style='color:#0a4988; text-decoration:underline;'>Blogs</a> | <a href='http://www.deal4loans.com/Contents_Feedback.php' target='_blank' style='color:#0a4988; text-decoration:underline;'>Testimonials</a> | <a href='http://www.deal4loans.com/Loan_Query.php?source=hlAM' target='_blank' style='color:#0a4988; text-decoration:underline;'>LoanQueries</a> | <a href='http://www.deal4loans.com/quiz.php' target='_blank' style='color:#0a4988; text-decoration:underline;'>Play the Loan Quiz</a></div><br><div style='text-align:center; height:20px;'><a href='http://www.deal4loans.com/Contents_Disclaimer.php' style='color:#0a4988; text-decoration:underline;'>Please go through our Disclaimer</a></div></td>
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
	
		else {
		

					if($City=="Others")
	{
		$Message2 = "<table width='745' cellpadding='2'><tr><td colspan='2'><div align='justify'><font size='2' face='verdana' ><b>Dear $FName,</b><br /><br />Thank you for registering on Deal4loans.com.<br /><br />Your application has not been serviced because currently we don't have any associations with the Banks and DSAs for your city. But we can inform you about the other possible areas from where you can get your Loan/ Card. Below given are the ways from which you can easily avail the credit from your existing banks with which you are sharing a relation on the following grounds:</font><br /><ul><li><font face='Verdana' size='2'><b>In which you have your saving account/ Current Account </b></font></li><li ><font face='Verdana' size='2'><b>You hold a credit card of that bank</b></font></li><li ><font face='Verdana'; size='2'><b>You are running a current loan like car loan, personal loan, credit card loan etc.</b></font></li><li ><font face='Verdana'; size='2'><b>If you have a property/ Asset to leverage and your Loan amount is more than 5 lakhs then you can also go for Loan Against Property because it is a secured Loan, which has a larger tenor, and lesser rate of interest.</b></font></li><li ><font face='Verdana'; size='2'><b>For Loan amount less than 5lakhs, you can get a loan against your Insurance policy, Mutual Funds etc.</b></font></li></ul><font size='2' face='verdana' >The gist of banks from which you can contact for your Loan / Credit Card requirement are mentioned below:</font><br /></div></td></tr><tr><td colspan='2'><table width='520' align='center' cellpadding='2' style='border:solid 1px black'><tr bgcolor='#CCCCCC'><td colspan='2'><div align='center'><font face='Verdana' size='2'><b>Bank Names<br />(Click the bank name to know the number)</b></font></div></td></tr><tr><td width='307'><div align='center'><font face='Verdana' size='2'><a href='http://www.hdfcbank.com/personal/access/popup_pbnumbers.htm'>HDFC Bank</a></font></div></td><td width='369'><div align='center'><font face='Verdana' size='2'><a href='http://icicibank.com/pfsuser/customer/cuscarenos.htm'>ICICI Bank</a></font></div></td></tr><tr><td><div align='center'><font face='Verdana' size='2'><a href='http://www.online.citibank.co.in/portal/citi_home_center.jsp?frameset=centerFramesetVis&amp;framevar1=brandID&amp;frameval1=cbxCustBID&amp;framevar2=workID&amp;frameval2=cbxindloccitiphpgWID&amp;section=CSS01L01&amp;eOfferCode=CSS01L01'>Citibank</a></font></div></td><td><div align='center'><font face='Verdana' size='2'><a href='http://www.hsbc.co.in/1/2/miscellaneous/call-us'>HSBC Bank</a></font></div></td></tr><tr><td><div align='center'><font face='Verdana' size='2'><a href='http://www.sbi.co.in/viewsection.jsp?id=0,453,554'>SBI</a></font></div></td><td><div align='center'><font face='Verdana' size='2'><a href='http://www.kotak.com/Kotak_GroupSite/contact.htm'>Kotak</a></font></div></td></tr><tr><td><div align='center'><font face='Verdana' size='2'><font style='color:#0000ff'>Deutsche Bank </font>- <strong>Call 6601 6601</strong></font></div></td><td><div align='center'><a href='http://www.axisbank.com/24x7banking/telebanking/Tele-Banking.asp'>Axis bank</a></div></td></tr><tr><td><div align='center'><font face='Verdana' size='2'><a href='http://www.abnamro.co.in/India/Contact/index.htm'>ABN Amro</a></font></div></td><td><div align='center'><font face='Verdana' size='2'><a href='https://www.gemoney.in/GEAsiaWebInd/ind?appFunc=DisplayBranchLocator'>GEMoney</a></font></div></td></tr></table></td></tr><tr><td colspan='2'><div align='justify'><font face='Verdana' size='2'>We hope this information would help in your loan seeking process. Deal4loans.com is built to service its customer?s debt related requirements, and we hope to rebuild your trust on that same tradition ? if not by solution then by showing you the ways from which you can get the solution for your credit need. We will be happy to notify you as soon as we receive the information you requested. If you have any queries then you can write to us <a href='mailto:customercare@deal4loans.com'>customercare@deal4loans.com</a><br />
		<tr><td>
			<tr>
  <td colspan='2' bgcolor='#fffbf0' style='border-bottom:thin solid #f2f2f2;'>
  <table cellpadding='0' cellspacing='0' border='0' width='588' align='center' style='max-width:588px; width:98%;'>
<tr>
  <td colspan='2' bgcolor='#FFFFFF' style='font-size:11px; font-weight:normal; font-family:Verdana, Geneva, sans-serif;'><b>Important Tips</b></td>
</tr>
<tr>    
          <td width='16' valign='top'  style='color:#000; font-family: Arial, Helvetica, sans-serif; font-size:12px;'>&bull;</td>
          <td width='1341' style='color:#000; font-family: Arial, Helvetica, sans-serif; font-size:12px; text-align:justify;'>Never pay any cash or any sort of payment/fee to anyone to get any loan approved.</td></tr>
          <tr>         
          <td width='16' valign='top' style='color:#000; font-family: Arial, Helvetica, sans-serif; font-size:12px;'>&bull;</td>
          <td width='1341' style='color:#000; font-family: Arial, Helvetica, sans-serif; font-size:12px; text-align:justify;'>
No Banks ask for any processing fee upfront</td></tr>
<tr>
         
          <td width='16' valign='top' style='color:#000; font-family: Arial, Helvetica, sans-serif; font-size:12px;'>&bull;</td>
          <td width='1341' style='color:#000; font-family: Arial, Helvetica, sans-serif; font-size:12px; text-align:justify;'>
Do not fall prey to agents who ask for a fee for a loan approval at very cheap interest rates.
</td>
    </tr>
    <tr>         
          <td width='16' valign='top' style='color:#000; font-family: Arial, Helvetica, sans-serif; font-size:12px;'>&bull;</td>
          <td width='1341' style='color:#000; font-family: Arial, Helvetica, sans-serif; font-size:12px; text-align:justify;'>
Do not fall for offers that guarantee loan approvals with any kind of advance fee payment to any individual in general or even particularly acting on our behalf.
</td>
    </tr>
    </table>
    </td></tr>
	<tr><td colspan='2'>&nbsp;</td></tr>
		<tr><td>		
		<br />--<br /><b>Regards</b><br />Team Deal4loans<br /><a href='http://www.deal4loans.com/index.php?source=ComonAM'>www.deal4loans.com</a><br />Loans by Choice not by Chance!!</font></div><br>
<div style='font-size:11px;'><b>Disclaimer:</b> Deal4loans does not provide Loans on its own but ensures your information is sent to respective  bank/agent that you have selected. We do not have any sales team of our own but  only help you compare loans and take decision. Deal4loans does not  facilitate short term loans either.</div><br>All loans are on discretion of the associated Banks/Agents<br><div style='text-align:center; height:20px;'><a href='http://www.deal4loans.com/Contents_Disclaimer.php' style='color:#0a4988; text-decoration:underline;'>Please go through our Disclaimer</a></div></td></tr></table>";
	
	}
	else 
	{
				$Message2= "<table border='0' cellspacing='0' width='100%' cellpadding='0'bgcolor='#529BE4' style='border-collapse: collapse' bordercolor='#529BE4'><tr><td valign='top' align=center><table border='0' cellpadding='4' cellspacing='0' style='border-collapse: collapse' bordercolor='#111111' width='100%' id='AutoNumber2' bgcolor='#529BE4'><tr><td align='center'>&nbsp;</td></tr></table><table border='0'  bordercolor='#529BE4' ><tr><td bgcolor='#FFFFFF'><table border='0' cellspacing='5' width='99%' cellpadding='6' id='frm' bgcolor='#FFFFFF'><tr><td bgcolor='#FFFFFF'><tr><td><font face='Verdana' size='2'><b>Dear $FName,</b></font></td><td	align='right' ><img src='http://www.deal4loans.com/images/D4L_Logo.gif' height='40'><br><font face='Verdana' style='font-size:11px;' color='0F74D4'>Loans by choice not by chance!!</font></td></tr><tr><td colspan='2'><font face='Verdana' size='2'><p><b>Thank you</b> for applying on <a href='http://www.deal4loans.com/index.php?source=ComonAM' target='_blank'>Deal4loans.com</a> We are committed to provide you with a platform to <b>compare</b> and <b>choose</b> the best deal for your loan requirement </p><p>Your <b>Profile Summary </b>as per our records: </p><p>Your Name: $FName<br>Location:$City<br>Income/Salary: $Net_Salary<br>Email Id: $Email<br>Contact : $Phone</p><p>You will receive various deals from banks both at your EMAIL ID and you can also SIGN IN at our site to view various offers.</p>
				</td></tr>
				<tr>
  <td colspan='2' bgcolor='#fffbf0' style='border-bottom:thin solid #f2f2f2;'>
  <table cellpadding='0' cellspacing='0' border='0' width='588' align='center' style='max-width:588px; width:98%;'>
<tr>
  <td colspan='2' bgcolor='#FFFFFF' style='font-size:11px; font-weight:normal; font-family:Verdana, Geneva, sans-serif;'><b>Important Tips</b></td>
</tr>
<tr>   
          <td width='16' valign='top'  style='color:#000; font-family: Arial, Helvetica, sans-serif; font-size:12px;'>&bull;</td>
          <td width='1341' style='color:#000; font-family: Arial, Helvetica, sans-serif; font-size:12px; text-align:justify;'>Never pay any cash or any sort of payment/fee to anyone to get any loan approved.</td></tr>
          <tr>
         
          <td width='16' valign='top' style='color:#000; font-family: Arial, Helvetica, sans-serif; font-size:12px;'>&bull;</td>
          <td width='1341' style='color:#000; font-family: Arial, Helvetica, sans-serif; font-size:12px; text-align:justify;'>
No Banks ask for any processing fee upfront</td></tr>
<tr>        
          <td width='16' valign='top' style='color:#000; font-family: Arial, Helvetica, sans-serif; font-size:12px;'>&bull;</td>
          <td width='1341' style='color:#000; font-family: Arial, Helvetica, sans-serif; font-size:12px; text-align:justify;'>
Do not fall prey to agents who ask for a fee for a loan approval at very cheap interest rates.
</td>
    </tr>
    <tr>         
          <td width='16' valign='top' style='color:#000; font-family: Arial, Helvetica, sans-serif; font-size:12px;'>&bull;</td>
          <td width='1341' style='color:#000; font-family: Arial, Helvetica, sans-serif; font-size:12px; text-align:justify;'>
Do not fall for offers that guarantee loan approvals with any kind of advance fee payment to any individual in general or even particularly acting on our behalf.
</td>
    </tr>
    </table>
    </td></tr>
	<tr><td colspan='2'>&nbsp;</td></tr>
	<tr><td colspan='2'>
	<p><b>Regards</b>
				<br>Team Deal4loans.com<br>Loans by choice not by chance!!</p><table width='100%' ><tr><td align='center'> <a href='http://www.deal4loans.com/Contents_Blogs.php?source=ComonAM' target='_blank'><font face='Verdana' size='2'>Blogs</font></a></td><td align='center'> | </td><td align='center'><a href='http://www.deal4loans.com/Contents_Feedback.php?source=ComonAM' target='_blank'><font face='Verdana' size='2'>Testimonials</font></a></td align='center'><td> | </td><td align='center'><a href='http://www.deal4loans.com/Loan_Query.php?source=ComonAM' target='_blank'><font face='Verdana' size='2'>LoanQueries</font></a></td>
</tr>
</table></td></tr><tr><td colspan='2'style='font-size:12px;'><b>Disclaimer:</b> Deal4loans does not provide Loans on its own but ensures your information is sent to respective  bank/agent that you have selected. We do not have any sales team of our own but  only help you compare loans and take decision. Deal4loans does not  facilitate short term loans either.<br><br>All loans are on discretion of the associated Banks/Agents<br><br><div style='text-align:center; height:20px;'><a href='http://www.deal4loans.com/Contents_Disclaimer.php' style='color:#0a4988; text-decoration:underline;'>Please go through our Disclaimer</a></div></td></tr><tr></table></td></tr><td bgcolor='#529BE4'>&nbsp;</td></tr></table></td></tr></table>";
	}
		}

?>