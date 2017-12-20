<?php
    require 'scripts/db_init.php';
    require 'scripts/functions.php';

//$Query = "SELECT Email,Name,RequestID FROM `Req_Loan_Home` WHERE Updated_Date between '2008-06-01 00:00:00' and '2008-06-31 23:53:53'  GROUP BY `Email";

$Query="SELECT RequestID, Name, Email, City, City_Other, Mobile_Number, Updated_Date, Bidderid_Details, Bidder_Count FROM Req_Loan_Home WHERE ( Bidderid_Details NOT LIKE '%993%' AND Bidderid_Details NOT LIKE '%1082%'
AND Bidderid_Details NOT LIKE '%1121%') AND (Updated_Date BETWEEN '2009-03-01 00:00:00' AND '2009-08-25 23:59:59')
AND ( Email != '' AND Email != 'Email Id') AND (City IN ('Pune', 'Nasik', 'Ahmednagar', 'Amravati', 'Aurangabad', 'Nagpur', 'Jalgaon', 'Satara', 'Kolhapur', 'Solapur', 'Goa', 'Navi Mumbai', 'Panvel', 'Mumbai', 'Gwalior', 'Raipur', 'Bilaspur', 'Raigarh', 'Bhilai', 'Jabalpur', 'Rewa', 'Ujjain', 'Indore', 'Bhopal', 'Bharuch', 'Vadodra', 'Surat', 'Vapi', 'Jamnagar', 'Bhavnagar', 'Rajkot', 'Mehasana', 'Patan', 'Ahmedabad', 'Salem', 'Trichy', 'Madurai', 'Virudhunagar', 'Pondicherry', 'Tiruppur', 'Coimbatore', 'Tirunelveli', 'Nellore', 'Vishakapatnam', 'Tirupathi', 'Vijaywada', 'Guntur', 'Kakinada', 'Rajahmundry', 'Trivandrum', 'Trichur', 'Calicut', 'Cochin', 'Kannur', 'Mysore', 'Mangalore', 'Hyderabad', 'Warangal', 'Karimnagar', 'Vellore', 'Chennai', 'Bangalore', 'Lucknow', 'Bhilwara', 'Udaipur', 'Jodhpur', 'Alwar', 'Jaipur', 'Bharatpur', 'Kota', 'Karnal', 'Rohtak', 'Panipat', 'Ludhiana', 'Jalandhar', 'Chandigarh', 'GAZIABAD', 'Noida', 'Gurgaon', 'Faridabad', 'Delhi', 'Calcutta', 'Kolkata', 'Rourkela', 'Ranchi', 'Bhubneshwar', 'Visakhapatnam', 'Visakhapatanam', 'Vishakapatanam', 'Thane') OR City_Other IN ('Pune', 'Nasik', 'Ahmednagar', 'Amravati', 'Aurangabad', 'Nagpur', 'Jalgaon', 'Satara', 'Kolhapur', 'Solapur', 'Goa', 'Navi Mumbai', 'Panvel', 'Mumbai', 'Gwalior', 'Raipur', 'Bilaspur', 'Raigarh', 'Bhilai', 'Jabalpur', 'Rewa', 'Ujjain', 'Indore', 'Bhopal', 'Bharuch', 'Vadodra', 'Surat', 'Vapi', 'Jamnagar', 'Bhavnagar', 'Rajkot', 'Mehasana', 'Patan', 'Ahmedabad', 'Salem', 'Trichy', 'Madurai', 'Virudhunagar', 'Pondicherry', 'Tiruppur', 'Coimbatore', 'Tirunelveli', 'Nellore', 'Vishakapatnam', 'Tirupathi', 'Vijaywada', 'Guntur', 'Kakinada', 'Rajahmundry', 'Trivandrum', 'Trichur', 'Calicut', 'Cochin', 'Kannur', 'Mysore', 'Mangalore', 'Hyderabad', 'Warangal', 'Karimnagar', 'Vellore', 'Chennai', 'Bangalore', 'Lucknow', 'Bhilwara', 'Udaipur', 'Jodhpur', 'Alwar', 'Jaipur', 'Bharatpur', 'Kota', 'Karnal', 'Rohtak', 'Panipat', 'Ludhiana', 'Jalandhar', 'Chandigarh', 'GAZIABAD', 'Noida', 'Gurgaon', 'Faridabad', 'Delhi', 'Calcutta', 'Kolkata', 'Rourkela', 'Ranchi', 'Bhubneshwar', 'Visakhapatnam', 'Visakhapatanam', 'Vishakapatanam', 'Thane') ) AND ( Bidder_Count <4 ) AND ( Net_Salary >=250000 AND Loan_Amount >=1000000 AND ( DOB != '' AND DATE_SUB( CURDATE( ) ,  INTERVAL 24 YEAR ) >= DOB)) GROUP BY `Mobile_Number`, `Email`";
list($NumRows,$Result)=MainselectfuncNew($Query,$array = array());
$recordcount = $NumRows;
//  for($i=0;$i<$NumRows;$i++)
  for($i=0;$i<$NumRows;$i++)
{
    $Name="";
	$EmailID = "";
	 $LID = "";
	 $EmailID= trim($Result[$i]['Email']);
	 
     $Name = ucfirst(strtolower(trim($Result[$i]['Name'])));
     $LID = trim($Result[$i]['RequestID']);
	
  
  	 $Subject ="Get Home Loans @ emi of 884";
	$Content = '<table width="560" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="25" align="center"   style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px; text-decoration:none; color:#000000;">If you are not able to view this mailer properly, please <a href="http://www.deal4loans.com/emailer/icicihfc09.php" target="_blank">Click here</a> </td>
  </tr>
  <tr>
    <td height="101" align="center" valign="top"><img src="http://www.deal4loans.com/images/mlr-hdr.jpg" width="560" height="101" /></td>
  </tr>
  <tr>
    <td width="560"><table width="560" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td width="1" bgcolor="#7cabda"><img src="http://www.deal4loans.com/images/spacer.gif" width="1"  height="1" border="0" /></td>
        <td><table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; ">Dear '.$Name.',<br />
                <br />
             You had applied with us for a home loan.We had forwarded your quotes from the banks in which you were intrested.If you havent closed and are still looking for a Home Loan,
We have another partner  <b>ICICI HFC</b> who have decreased there rates .<br />
<br />
<table width="95%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:bold; color:#333333;"><b>They are now offering Home loans @ 8.75-9.75% reducing.</b></td>
    <td><a href="http://www.deal4loans.com/icicihfc_thanku.php?id='.$LID.'"><img src="http://www.deal4loans.com/images/apl-now.gif" width="108" height="22" border="0" /></a></td>
  </tr>
</table>
<br />
              In last two months they have reduced there rate of interest  by 0.5% to 1%, which shows there creditability to sanction loans to customers.<br />
              <br />              <strong>Feature of ICICI HFC Home Loan</strong><br />
                        1. Attractive  rate of interest- Floating Rate, Fixed Rates or Part Fixed and Part Floating  Rates.<br />
                                      2. Loan  amount from Rs.2 lac to Rs. 3 Crore.<br />
                                                    3. Loan  sanctioned up to 80% of the cost of property.<br />
                                                                  4. Simple  documentation.<br />
                                                                                5. No  fee on part prepayment.<br />
                                                                                <table width="95%" border="0" cellspacing="0" cellpadding="0">
                                                                                  <tr>
                                                                                    <td width="79%">&nbsp;</td>
                                                                                    <td width="21%" align="right"><a href="http://www.deal4loans.com/icicihfc_thanku.php?id='.$LID.'"><img src="http://www.deal4loans.com/images/apl-now.gif" width="108" height="22" border="0" /></a></td>
                                                                                  </tr>
                                                                                </table>
<table width="495" border="0" align="left" cellpadding="0" cellspacing="0" bgcolor="#f3f8fd">

<tr>
					  <td height="22" align="left" bgcolor="#FFFFFF" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:bold; color:#333333;">Eligibility for ICICI  HFC Home Loan</td>
				    </tr>
					<tr>
					  <td  align="right" bgcolor="#FFFFFF"><table width="100%" border="0" cellpadding="2" cellspacing="1" bgcolor="#649bd0">
                        <tr>
                          <td width="29%" align="center" bgcolor="#fafdff" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size:10px; font-weight:bold; color:#333333;">Age</td>
                          <td width="71%" align="center" bgcolor="#fafdff" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size:10px; font-weight:bold; color:#333333;">Minimum- 21 yrs, 
Maximum- 65yrs</td>
                        </tr>
                        <tr>
                          <td align="center" bgcolor="#fafdff" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size:10px; font-weight:bold; color:#333333;">Loan Amount </td>
                          <td align="center" bgcolor="#fafdff" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size:10px; font-weight:bold; color:#333333;">Minimum- Rs.2 lac, 
                            Maximum- Rs.3 crore</td>
                        </tr>
                      </table></td>
				    </tr>
                </table></td></tr>
          <tr>
            <td style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; ">&nbsp;</td>
          </tr>
          <tr>
            <td style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; "><table width="95%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="79%">&nbsp;</td>
                <td width="21%" align="right"><a href="http://www.deal4loans.com/icicihfc_thanku.php?id='.$LID.'"><img src="http://www.deal4loans.com/images/apl-now.gif" width="108" height="22" border="0" /></a></td>
              </tr>
              
            </table></td>
          </tr>
          <tr>
            <td style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:9px; color:#061c33; line-height:18px; ">** Conditions Apply</td>
          </tr>
        </table></td>
        <td width="1" bgcolor="#7cabda"><img src="http://www.deal4loans.com/images/spacer.gif" width="1"  height="1" border="0" /></td>
      </tr>
    </table></td>
  </tr>
  
  <tr>    <td><img src="http://www.deal4loans.com/images/tp_bl-line.gif" width="560" height="20" /></td>
  </tr>
</table>';

   
    $countI = $i+1;
				$headers  = 'MIME-Version: 1.0' . "\r\n";				
				$headers  = 'From: Deal4loans <live@deal4loans.comm>' . "\r\n";
				$headers .= "Return-Path: <live@deal4loans.com>\r\n";  // Return path for errors
				$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

  
	
echo "<br>Count: ".$countI."  Email: ".$EmailID."  Name: ".$Name."  RequestID: ".$LID;
       // echo "<br>Count: ".$countI."  Email: ".$email[$i]."  Name: ".$name;
		//echo "<br>Count: ".$countI."  Email: ".$EmailID."  Name: ".$Name;
//}

}
//mail("mehra3@gmail.com", $Subject,$Content,$headers);
//echo $Content;
?>
 
