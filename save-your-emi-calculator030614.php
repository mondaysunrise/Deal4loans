<?php
require 'scripts/functions.php';?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Save your EMI Calculator – EMI Saving Options</title>
<meta name="Description" content="Looking for EMI saving options on your current outstanding loan amount on credit card, personal loan & home loans. Calculate save emi options & convert or Balance transfer, convert credit card amount to personal loan etc."/>
<meta name="keywords" content="Emi saving calculator, credit card saving calculator, personal loan savings, home loan saving, outstanding loan emi calculator, save emi calculator, emi saving options, covert credit card amount to personal loan, transfer personal loans"/>
<link href="save-my-emi-styles1.css" type="text/css" rel="stylesheet"  />
<link type="text/css" rel="stylesheet" href="easy-responsive-tabssvemi.css" />
    <script src="jquery-1.6.3.min.js"></script>
    <script src="scripts/easyResponsiveTabssvemi.js" type="text/javascript"></script>
	<script type="text/javascript" src="ajax.js"></script>
<script type="text/javascript" src="ajax-dynamic-pllist.js"></script>
<script type="text/javascript" src="scripts/common.js"></script>
 <script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
<script  type="text/JavaScript">
function check4cc()
{	
	var putherediv = document.getElementById('puthere');
	document.getElementById('cc_oustanding').value=1;
	putherediv.innerHTML ='<table cellpadding="2" cellspacing="0"  width="100%"><tr> <td width="48%" class="indfromtxt">Total Outstanding on Card</td><td width="52%" align="left"><input type="text" name="outstanding_amount_cc" class="inputtxtcc" id="outstanding_amount_cc" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);"  onFocus="addToolTip(\'outstanding_amount_cc\');" /></td>        	       </tr>          	         <tr><td colspan="2" class="indfromtxt" height="10"></td></tr>  <tr>   <td class="indfromtxt">You Currently live in </td> <td width="52%" align="left"><select name="City" id="City" class="inputtxtcc" style="height:28px; width:233px;" onChange="othercity();" onFocus="addToolTip(\'City\');">    <option value="Please Select">Please Select</option><option value="Ahmedabad">Ahmedabad</option><option value="Bangalore">Bangalore</option><option value="Chandigarh">Chandigarh</option><option value="Chennai">Chennai</option><option value="Cochin">Cochin</option><option value="Delhi">Delhi</option><option value="Hyderabad">Hyderabad</option><option value="Jaipur">Jaipur</option><option value="Jalandhar">Jalandhar</option><option value="Kolkata">Kolkata</option><option value="Lucknow">Lucknow</option><option value="Mumbai">Mumbai</option><option value="Nagpur">Nagpur</option><option value="Pune">Pune</option><option value="Surat">Surat</option><option value="Ananthpur">Ananthpur</option><option value="Aurangabad">Aurangabad</option><option value="Baroda">Baroda</option><option value="Bahadurgarh">Bahadurgarh</option><option value="Bhimavaram">Bhimavaram</option><option value="Bhiwadi">Bhiwadi</option><option value="Bhopal">Bhopal</option><option value="Bhubneshwar">Bhubneshwar</option><option value="Calicut">Calicut</option><option value="Coimbatore">Coimbatore</option><option value="Cuttack">Cuttack</option><option value="Dehradun">Dehradun</option><option value="Dindigul">Dindigul</option><option value="Eluru">Eluru</option><option value="Ernakulam">Ernakulam</option><option value="Erode">Erode</option><option value="Faridabad">Faridabad</option><option value="Gaziabad">Gaziabad</option><option value="Guntur">Guntur</option><option value="Gurgaon">Gurgaon</option><option value="Guwahati">Guwahati</option><option value="Hosur">Hosur</option><option value="Indore">Indore</option><option value="Jabalpur">Jabalpur</option><option value="Jamshedpur">Jamshedpur</option><option value="Kakinada">Kakinada</option><option value="Karaikkal">Karaikkal</option><option value="Karimnagar">Karimnagar</option><option value="Karur">Karur</option><option value="Kanpur">Kanpur</option><option value="Khammam">Khammam</option><option value="Kishangarh">Kishangarh</option><option value="Kochi">Kochi</option><option value="Kozhikode">Kozhikode</option><option value="Kumbakonam">Kumbakonam</option><option value="Kurnool">Kurnool</option><option value="Ludhiana">Ludhiana</option><option value="Madurai">Madurai</option><option value="Mangalore">Mangalore</option><option value="Mysore">Mysore</option><option value="Nagerkoil">Nagerkoil</option><option value="Nasik">Nasik</option><option value="Navi Mumbai">Navi Mumbai</option><option value="Nellore">Nellore</option><option value="Nizamabad">Nizamabad</option><option value="Noida">Noida</option><option value="Ongole">Ongole</option><option value="Ooty">Ooty</option><option value="Patna">Patna</option><option value="Pondicherry">Pondicherry</option><option value="Pudukottai">Pudukottai</option><option value="Rajahmundry">Rajahmundry</option><option value="Ramagundam">Ramagundam</option><option value="Raipur">Raipur</option><option value="Rewari">Rewari</option><option value="Sahibabad">Sahibabad</option><option value="Salem">Salem</option><option value="Srikakulam">Srikakulam</option><option value="Thane">Thane</option><option value="Thanjavur">Thanjavur</option><option value="Thrissur">Thrissur</option><option value="Thiruvananthapuram">Thiruvananthapuram</option><option value="Tirunelveli">Tirunelveli</option><option value="Tirupathi">Tirupathi</option><option value="Trivandrum">Trivandrum</option><option value="Trichy">Trichy</option><option value="Tuticorin">Tuticorin</option><option value="Vadodara">Vadodara</option><option value="Vellore">Vellore</option><option value="Vishakapatanam">Vishakapatanam</option><option value="Vizag">Vizag</option><option value="Vizianagaram">Vizianagaram</option><option value="Warangal">Warangal</option><option value="Others">Others</option>  <option value="Vapi">Vapi</option> <option value="Ankleshwar">Ankleshwar</option><option value="Anand">Anand</option> <option value="Anand">Dahod</option><option value="Anand">Navsari</option> </select></td> </tr><tr>  <td colspan="2"  class="indfromtxt" height="10"></td></tr><tr><td colspan="2" id="puthere_oc" width="100%"></td>  </tr><tr> <td class="indfromtxt">Your Company Name</td><td align="left"><input type="text" name="company_name" id="company_name" class="inputtxtcc" onkeyup="ajax_showOptions(this,\'getCountriesByLetters\',event, \'http://www.deal4loans.com/ajax-list-plcompanies.php\')" onFocus="addToolTip(\'company_name\');"/></td></tr> <tr> <td colspan="2"  class="indfromtxt" height="10"></td></tr><tr><td class="indfromtxt">Net monthly Income</td><td align="left"><input type="text" name="net_income" id="net_income" class="inputtxtcc" onkeyup="intOnly(this);" onkeypress="intOnly(this);" onFocus="addToolTip(\'net_income\');"/></td>  </tr>   <tr><td colspan="2"  class="indfromtxt" height="10"></td> </tr>  <tr><td class="indfromtxt">Current Experience</td><td align="left"><input type="text" name="current_experience" id="current_experience" class="inputtxtcc" onkeyup="intOnly(this);" onkeypress="intOnly(this);" onFocus="addToolTip(\'current_experience\');"/></td>  </tr><tr><td colspan="2"  class="indfromtxt" height="10"></td> </tr><tr><td class="indfromtxt">Total Experience</td><td align="left"><input type="text" name="total_experience" id="total_experience" class="inputtxtcc" onkeyup="intOnly(this);" onkeypress="intOnly(this);" onFocus="addToolTip(\'current_experience\');"/></td>  </tr><tr><td colspan="2"  class="indfromtxt" height="10"></td> </tr><tr>  <td  class="indfromtxt">Age</td><td align="left"><input type="text" name="age" id="age" class="inputtxtcc" onkeyup="intOnly(this);" onkeypress="intOnly(this);" onFocus="addToolTip(\'age\'); fillthefield(\'net_income\');"/></td></tr>    <tr>  <td colspan="2"  class="indfromtxt" height="10"></td> </tr><tr> <td class="indfromtxt">Salary Account With</td><td align="left"><Select name="salary_account" class="inputtxtcc" onFocus="addToolTip(\'salary_account\');"/><option value="">Please Select</option><option value="AXIS Bank">Axis Bank</option><option value="HDFC Bank">HDFC Bank</option><option value="ICICI Bank">ICICI Bank</option><option value="IngVysya Bank">INGVysya Bank</option><option value="kotak Bank">KOTAK Bank</option><option value="SBI">SBI</option><option value="Others">Others</option></select></td></tr> <tr> <td colspan="2"  class="indfromtxt" height="10"></td></tr><tr> <td class="indfromtxt">Since how long you <br>holding this credit card?</td><td align="left"><select name="card_vintage" class="inputtxtcc" onFocus="addToolTip(\'card_vintage\');"/><option value="">Please Select</option><option value="1">Less than 6 months</option>				<option value="2">6 to 9 months</option> 				<option value="3">9 to 12 months</option><option value="4">more than 12 months</option> </select></td></tr></table>';
			
}
function check4pl()
{
	document.getElementById('pl_btpart').value=1;
	var putherepldiv = document.getElementById('putherepl');
	var partfirst='';
	var cc_oustandingcc = document.getElementById('cc_oustanding').value;
	var ni1valcc='';
	var ni1valcc_cn='';

	if(cc_oustandingcc==1)
	{
		var ni1valcc = document.getElementById('net_income').value;
		var ni1valcc_cn = document.getElementById('company_name').value;
		if(ni1valcc>1 && ni1valcc_cn!='')
		{
			partfirst='';
		}
		else
		{
			partfirst=' <tr><td colspan="2" class="indfromtxt" height="10"></td></tr> <tr> <td class="indfromtxt">You Currently live in </td> <td width="52%" align="left"><select name="plCity" id="plCity" class="inputtxt"  onChange="change2pl();" onFocus="addToolTip(\'City\');">  <option value="Please Select">Please Select</option><option value="Ahmedabad">Ahmedabad</option><option value="Bangalore">Bangalore</option><option value="Chandigarh">Chandigarh</option><option value="Chennai">Chennai</option><option value="Cochin">Cochin</option><option value="Delhi">Delhi</option><option value="Hyderabad">Hyderabad</option><option value="Jaipur">Jaipur</option><option value="Jalandhar">Jalandhar</option><option value="Kolkata">Kolkata</option><option value="Lucknow">Lucknow</option><option value="Mumbai">Mumbai</option><option value="Nagpur">Nagpur</option><option value="Pune">Pune</option><option value="Surat">Surat</option><option value="Ananthpur">Ananthpur</option><option value="Aurangabad">Aurangabad</option><option value="Baroda">Baroda</option><option value="Bahadurgarh">Bahadurgarh</option><option value="Bhimavaram">Bhimavaram</option><option value="Bhiwadi">Bhiwadi</option><option value="Bhopal">Bhopal</option><option value="Bhubneshwar">Bhubneshwar</option><option value="Calicut">Calicut</option><option value="Coimbatore">Coimbatore</option><option value="Cuttack">Cuttack</option><option value="Dehradun">Dehradun</option><option value="Dindigul">Dindigul</option><option value="Eluru">Eluru</option><option value="Ernakulam">Ernakulam</option><option value="Erode">Erode</option><option value="Faridabad">Faridabad</option><option value="Gaziabad">Gaziabad</option><option value="Guntur">Guntur</option><option value="Gurgaon">Gurgaon</option><option value="Guwahati">Guwahati</option><option value="Hosur">Hosur</option><option value="Indore">Indore</option><option value="Jabalpur">Jabalpur</option><option value="Jamshedpur">Jamshedpur</option><option value="Kakinada">Kakinada</option><option value="Karaikkal">Karaikkal</option><option value="Karimnagar">Karimnagar</option><option value="Karur">Karur</option><option value="Kanpur">Kanpur</option><option value="Khammam">Khammam</option><option value="Kishangarh">Kishangarh</option><option value="Kochi">Kochi</option><option value="Kozhikode">Kozhikode</option><option value="Kumbakonam">Kumbakonam</option><option value="Kurnool">Kurnool</option><option value="Ludhiana">Ludhiana</option><option value="Madurai">Madurai</option><option value="Mangalore">Mangalore</option><option value="Mysore">Mysore</option><option value="Nagerkoil">Nagerkoil</option><option value="Nasik">Nasik</option><option value="Navi Mumbai">Navi Mumbai</option><option value="Nellore">Nellore</option><option value="Nizamabad">Nizamabad</option><option value="Noida">Noida</option><option value="Ongole">Ongole</option><option value="Ooty">Ooty</option><option value="Patna">Patna</option><option value="Pondicherry">Pondicherry</option><option value="Pudukottai">Pudukottai</option><option value="Rajahmundry">Rajahmundry</option><option value="Ramagundam">Ramagundam</option><option value="Raipur">Raipur</option><option value="Rewari">Rewari</option><option value="Sahibabad">Sahibabad</option><option value="Salem">Salem</option><option value="Srikakulam">Srikakulam</option><option value="Thane">Thane</option><option value="Thanjavur">Thanjavur</option><option value="Thrissur">Thrissur</option><option value="Thiruvananthapuram">Thiruvananthapuram</option><option value="Tirunelveli">Tirunelveli</option><option value="Tirupathi">Tirupathi</option><option value="Trivandrum">Trivandrum</option><option value="Trichy">Trichy</option><option value="Tuticorin">Tuticorin</option><option value="Vadodara">Vadodara</option><option value="Vellore">Vellore</option><option value="Vishakapatanam">Vishakapatanam</option><option value="Vizag">Vizag</option><option value="Vizianagaram">Vizianagaram</option><option value="Warangal">Warangal</option><option value="Others">Others</option>                   <option value="Vapi">Vapi</option>	   <option value="Ankleshwar">Ankleshwar</option>	  <option value="Anand">Anand</option>	 <option value="Anand">Dahod</option>	 <option value="Anand">Navsari</option>   </select></td> 		</tr> <tr> <td colspan="2" class="indfromtxt" height="10"></td> </tr>    <tr>      <td class="indfromtxt">Company Name</td> <td align="left"><input type="text" name="plbt_companyname" class="inputtxt"  onkeyup="ajax_showOptions(this,\'getCountriesByLetters\',event, \'http://www.deal4loans.com/ajax-list-plcompanies.php\')" onFocus="addToolTip(\'plbt_companyname\');" id="plbt_companyname"/> </td>   </tr>    <tr>    <td colspan="2" class="indfromtxt" height="10"> </td>  </tr>     <tr>    <td class="indfromtxt">Monthly Net Income</td> <td align="left"><input type="text" name="plbt_income" class="inputtxt"  onFocus="addToolTip(\'plbt_income\'); fillthefield(\'plbt_income\');" id="plbt_income" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);"/> </td>       </tr> <tr>  <td colspan="2"  class="indfromtxt" height="10"></td> </tr><tr>  <td  class="indfromtxt">Age</td><td align="left"><input type="text" name="age" id="age" class="inputtxtcc" onkeyup="intOnly(this);" onkeypress="intOnly(this);" onFocus="addToolTip(\'age\'); fillthefield(\'net_income\');"/></td></tr> <tr>       <td colspan="2"  class="indfromtxt" height="10"></td>    </tr>';
		}
	}
	else
	{
		partfirst=' <tr><td colspan="2" class="indfromtxt" height="10"></td></tr> <tr> <td class="indfromtxt">You Currently live in </td> <td width="52%" align="left"><select name="plCity" id="plCity" class="inputtxt"  onChange="change2pl();" onFocus="addToolTip(\'City\');">  <option value="Please Select">Please Select</option><option value="Ahmedabad">Ahmedabad</option><option value="Bangalore">Bangalore</option><option value="Chandigarh">Chandigarh</option><option value="Chennai">Chennai</option><option value="Cochin">Cochin</option><option value="Delhi">Delhi</option><option value="Hyderabad">Hyderabad</option><option value="Jaipur">Jaipur</option><option value="Jalandhar">Jalandhar</option><option value="Kolkata">Kolkata</option><option value="Lucknow">Lucknow</option><option value="Mumbai">Mumbai</option><option value="Nagpur">Nagpur</option><option value="Pune">Pune</option><option value="Surat">Surat</option><option value="Ananthpur">Ananthpur</option><option value="Aurangabad">Aurangabad</option><option value="Baroda">Baroda</option><option value="Bahadurgarh">Bahadurgarh</option><option value="Bhimavaram">Bhimavaram</option><option value="Bhiwadi">Bhiwadi</option><option value="Bhopal">Bhopal</option><option value="Bhubneshwar">Bhubneshwar</option><option value="Calicut">Calicut</option><option value="Coimbatore">Coimbatore</option><option value="Cuttack">Cuttack</option><option value="Dehradun">Dehradun</option><option value="Dindigul">Dindigul</option><option value="Eluru">Eluru</option><option value="Ernakulam">Ernakulam</option><option value="Erode">Erode</option><option value="Faridabad">Faridabad</option><option value="Gaziabad">Gaziabad</option><option value="Guntur">Guntur</option><option value="Gurgaon">Gurgaon</option><option value="Guwahati">Guwahati</option><option value="Hosur">Hosur</option><option value="Indore">Indore</option><option value="Jabalpur">Jabalpur</option><option value="Jamshedpur">Jamshedpur</option><option value="Kakinada">Kakinada</option><option value="Karaikkal">Karaikkal</option><option value="Karimnagar">Karimnagar</option><option value="Karur">Karur</option><option value="Kanpur">Kanpur</option><option value="Khammam">Khammam</option><option value="Kishangarh">Kishangarh</option><option value="Kochi">Kochi</option><option value="Kozhikode">Kozhikode</option><option value="Kumbakonam">Kumbakonam</option><option value="Kurnool">Kurnool</option><option value="Ludhiana">Ludhiana</option><option value="Madurai">Madurai</option><option value="Mangalore">Mangalore</option><option value="Mysore">Mysore</option><option value="Nagerkoil">Nagerkoil</option><option value="Nasik">Nasik</option><option value="Navi Mumbai">Navi Mumbai</option><option value="Nellore">Nellore</option><option value="Nizamabad">Nizamabad</option><option value="Noida">Noida</option><option value="Ongole">Ongole</option><option value="Ooty">Ooty</option><option value="Patna">Patna</option><option value="Pondicherry">Pondicherry</option><option value="Pudukottai">Pudukottai</option><option value="Rajahmundry">Rajahmundry</option><option value="Ramagundam">Ramagundam</option><option value="Raipur">Raipur</option><option value="Rewari">Rewari</option><option value="Sahibabad">Sahibabad</option><option value="Salem">Salem</option><option value="Srikakulam">Srikakulam</option><option value="Thane">Thane</option><option value="Thanjavur">Thanjavur</option><option value="Thrissur">Thrissur</option><option value="Thiruvananthapuram">Thiruvananthapuram</option><option value="Tirunelveli">Tirunelveli</option><option value="Tirupathi">Tirupathi</option><option value="Trivandrum">Trivandrum</option><option value="Trichy">Trichy</option><option value="Tuticorin">Tuticorin</option><option value="Vadodara">Vadodara</option><option value="Vellore">Vellore</option><option value="Vishakapatanam">Vishakapatanam</option><option value="Vizag">Vizag</option><option value="Vizianagaram">Vizianagaram</option><option value="Warangal">Warangal</option><option value="Others">Others</option>                   <option value="Vapi">Vapi</option>	   <option value="Ankleshwar">Ankleshwar</option>	  <option value="Anand">Anand</option>	 <option value="Anand">Dahod</option>	 <option value="Anand">Navsari</option>   </select></td> 		</tr> <tr> <td colspan="2" class="indfromtxt" height="10"></td> </tr>    <tr>      <td class="indfromtxt">Company Name</td> <td align="left"><input type="text" name="plbt_companyname" class="inputtxt"  onkeyup="ajax_showOptions(this,\'getCountriesByLetters\',event, \'http://www.deal4loans.com/ajax-list-plcompanies.php\')" onFocus="addToolTip(\'plbt_companyname\');" id="plbt_companyname"/> </td>   </tr>    <tr>    <td colspan="2" class="indfromtxt" height="10"> </td>  </tr>     <tr>    <td class="indfromtxt">Monthly Net Income</td> <td align="left"><input type="text" name="plbt_income" class="inputtxt"  onFocus="addToolTip(\'plbt_income\'); fillthefield(\'plbt_income\');" id="plbt_income" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);"/> </td>       </tr> <tr>  <td colspan="2"  class="indfromtxt" height="10"></td> </tr><tr>  <td  class="indfromtxt">Age</td><td align="left"><input type="text" name="age" id="age" class="inputtxtcc" onkeyup="intOnly(this);" onkeypress="intOnly(this);" onFocus="addToolTip(\'age\'); fillthefield(\'net_income\');"/></td></tr> <tr>       <td colspan="2"  class="indfromtxt" height="10"></td>    </tr>';
	}

	putherepldiv.innerHTML ='<table cellpadding="2" cellspacing="0"  width="100%"> ' + partfirst + ' <tr> <td width="47%" class="indfromtxt">Personal Loan Running With</td>  <td width="53%" align="left"><select name="existing_bank_pl" id="existing_bank_pl" class="inputtxt" onFocus="addToolTip(\'existing_bank_pl\');" ><option value="Axis">Axis Bank</option><option value="Bajaj">Bajaj Finserv</option><option value="Capital First">Capital First</option><option value="Citibank">Citibank</option><option value="Fullerton">Fullerton India</option><option value="HDFC">HDFC Bank</option><option value="HDBFS">HDB Financial Services</option><option value="HSBC">HSBC Bank</option><option value="ICICI">ICICI Bank</option><option value="IngVysya">IngVysya Bank</option><option value="Kotak">Kotak Bank</option><option value="Indusind">Indusind Bank</option><option value="Standard">Standard Chartered</option><option value="Others">Others</option></select>  </td> </tr>  <tr> <td colspan="2" class="indfromtxt" height="10"></td> </tr>  <tr><td class="indfromtxt">Total Personal Loan Amount</td><td align="left"><input type="text" name="existing_la_pl" class="inputtxt" onFocus="addToolTip(\'existing_la_pl\');" id="existing_la_pl" onkeyup="intOnly(this); getDigitToWords(\'existing_la_pl\',\'formatedlA\',\'wordloanAmount\');" onKeyPress="intOnly(this);"/></td>  </tr>  <tr>  <td colspan="2"  class="indfromtxt" height="10"></td></tr><tr><td></td><td><span id="formatedlA" style="font-size:11px;font-weight:normal; color:#000000;font-Family:Verdana;"></span><span id="wordloanAmount" style="font-size:11px;font-weight:normal; color:#000000;font-Family:Verdana;text-transform: capitalize;"></span></td></tr>  <tr>    <td  class="indfromtxt">Existing ROI</td> <td align="left"><input type="text" name="existing_roi_pl" class="inputtxt" style="width:92px !important;" onFocus="addToolTip(\'existing_roi_pl\');"  id="existing_roi_pl"/> %</td>                  </tr>     <tr>   <td height="10" colspan="2" class="indfromtxt"></td>   </tr>    <tr> 	<td class="indfromtxt">No. of EMI Paid</td>  <td align="left"><input type="text" name="existing_noofemi_pl" class="inputtxt" style="width:45px !important;" onFocus="addToolTip(\'existing_noofemi_pl\');" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);"/> (In months)</td> </tr>  <tr><td colspan="2" class="indfromtxt" height="10"></td></tr>           <tr>  <td class="indfromtxt">Total Tenure</td> <td align="left"><input type="text" name="existing_tenure_pl" class="inputtxt" style="width:45px !important;" onFocus="addToolTip(\'existing_tenure_pl\');" id="existing_tenure_pl" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);"/>  (In months)</td>    </tr>  <tr>   <td colspan="2" class="indfromtxt" height="10"></td> </tr>       <tr>       <td class="indfromtxt">Pre-payment Charges</td> <td align="left"><input type="text" name="existing_prepay_pl" class="inputtxt" style="width:92px !important;" onFocus="addToolTip(\'existing_prepay_pl\');" id="existing_prepay_pl"  /> %</td>   </tr>         </table>';
	}

function check4hl()
{
	var putherehldiv = document.getElementById('putherehl');
	var pl_btpart = document.getElementById('pl_btpart').value;
	var partfirst='';
	var cc_oustandingcc = document.getElementById('cc_oustanding').value;

var initialpartfirst=' <tr> <td class="indfromtxt">You Currently live in </td> <td width="52%" align="left"><select name="hlCity" id="hlCity" class="inputtxt"  onChange="change2pl();" onFocus="addToolTip(\'City\');">  <option value="Please Select">Please Select</option><option value="Ahmedabad">Ahmedabad</option><option value="Bangalore">Bangalore</option><option value="Chandigarh">Chandigarh</option><option value="Chennai">Chennai</option><option value="Cochin">Cochin</option><option value="Delhi">Delhi</option><option value="Hyderabad">Hyderabad</option><option value="Jaipur">Jaipur</option><option value="Jalandhar">Jalandhar</option><option value="Kolkata">Kolkata</option><option value="Lucknow">Lucknow</option><option value="Mumbai">Mumbai</option><option value="Nagpur">Nagpur</option><option value="Pune">Pune</option><option value="Surat">Surat</option><option value="Ananthpur">Ananthpur</option><option value="Aurangabad">Aurangabad</option><option value="Baroda">Baroda</option><option value="Bahadurgarh">Bahadurgarh</option><option value="Bhimavaram">Bhimavaram</option><option value="Bhiwadi">Bhiwadi</option><option value="Bhopal">Bhopal</option><option value="Bhubneshwar">Bhubneshwar</option><option value="Calicut">Calicut</option><option value="Coimbatore">Coimbatore</option><option value="Cuttack">Cuttack</option><option value="Dehradun">Dehradun</option><option value="Dindigul">Dindigul</option><option value="Eluru">Eluru</option><option value="Ernakulam">Ernakulam</option><option value="Erode">Erode</option><option value="Faridabad">Faridabad</option><option value="Gaziabad">Gaziabad</option><option value="Guntur">Guntur</option><option value="Gurgaon">Gurgaon</option><option value="Guwahati">Guwahati</option><option value="Hosur">Hosur</option><option value="Indore">Indore</option><option value="Jabalpur">Jabalpur</option><option value="Jamshedpur">Jamshedpur</option><option value="Kakinada">Kakinada</option><option value="Karaikkal">Karaikkal</option><option value="Karimnagar">Karimnagar</option><option value="Karur">Karur</option><option value="Kanpur">Kanpur</option><option value="Khammam">Khammam</option><option value="Kishangarh">Kishangarh</option><option value="Kochi">Kochi</option><option value="Kozhikode">Kozhikode</option><option value="Kumbakonam">Kumbakonam</option><option value="Kurnool">Kurnool</option><option value="Ludhiana">Ludhiana</option><option value="Madurai">Madurai</option><option value="Mangalore">Mangalore</option><option value="Mysore">Mysore</option><option value="Nagerkoil">Nagerkoil</option><option value="Nasik">Nasik</option><option value="Navi Mumbai">Navi Mumbai</option><option value="Nellore">Nellore</option><option value="Nizamabad">Nizamabad</option><option value="Noida">Noida</option><option value="Ongole">Ongole</option><option value="Ooty">Ooty</option><option value="Patna">Patna</option><option value="Pondicherry">Pondicherry</option><option value="Pudukottai">Pudukottai</option><option value="Rajahmundry">Rajahmundry</option><option value="Ramagundam">Ramagundam</option><option value="Raipur">Raipur</option><option value="Rewari">Rewari</option><option value="Sahibabad">Sahibabad</option><option value="Salem">Salem</option><option value="Srikakulam">Srikakulam</option><option value="Thane">Thane</option><option value="Thanjavur">Thanjavur</option><option value="Thrissur">Thrissur</option><option value="Thiruvananthapuram">Thiruvananthapuram</option><option value="Tirunelveli">Tirunelveli</option><option value="Tirupathi">Tirupathi</option><option value="Trivandrum">Trivandrum</option><option value="Trichy">Trichy</option><option value="Tuticorin">Tuticorin</option><option value="Vadodara">Vadodara</option><option value="Vellore">Vellore</option><option value="Vishakapatanam">Vishakapatanam</option><option value="Vizag">Vizag</option><option value="Vizianagaram">Vizianagaram</option><option value="Warangal">Warangal</option><option value="Others">Others</option>                   <option value="Vapi">Vapi</option>	   <option value="Ankleshwar">Ankleshwar</option>	  <option value="Anand">Anand</option>	 <option value="Anand">Dahod</option>	 <option value="Anand">Navsari</option>   </select></td></tr><tr><td colspan="2"  class="indfromtxt" height="10"></td></tr>  <tr>    <td class="indfromtxt">Monthly Net Income</td> <td align="left"><input type="text" name="hlbt_income" class="inputtxt"  onFocus="addToolTip(\'hlbt_income\'); fillthefield(\'hlbt_income\');" id="hlbt_income" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);"/> </td>       </tr> <tr>  <td colspan="2"  class="indfromtxt" height="10"></td> </tr><tr>  <td  class="indfromtxt">Age</td><td align="left"><input type="text" name="hlage" id="hlage" class="inputtxtcc" onkeyup="intOnly(this);" onkeypress="intOnly(this);" /></td></tr> <tr>       <td colspan="2"  class="indfromtxt" height="10"></td>    </tr>';

	if(cc_oustandingcc==1)
	{	var ni1valcc = document.getElementById('net_income').value;
		var ni1valcc_cn = document.getElementById('company_name').value;
		if(ni1valcc>1 && ni1valcc_cn!='')
		{
			partfirst='';
		}
		else
		{
			partfirst=initialpartfirst;
		}
	}
	else if(pl_btpart==1)
	{
		var ni1val = document.getElementById('plbt_income').value;
		var ni1valcn = document.getElementById('plbt_companyname').value;
		if(ni1val>1 && ni1valcn!='')
		{
			partfirst='';
		}
		else
		{
			partfirst=initialpartfirst;
		}
	}
	
	else
	{
		partfirst=initialpartfirst;
	}

	
	putherehldiv.innerHTML ='<table cellpadding="2" cellspacing="0"  width="100%" style="margin-top:10px;" border=0>' + partfirst + '<tr><td class="indfromtxt">Property Located in Which cty </td> <td width="52%" align="left"><select name="Property_Loc" id="Property_Loc" class="inputtxt"  onFocus="addToolTip(\'Property_Loc\');">  <option value="Please Select">Please Select</option><option value="Ahmedabad">Ahmedabad</option><option value="Bangalore">Bangalore</option><option value="Chandigarh">Chandigarh</option><option value="Chennai">Chennai</option><option value="Cochin">Cochin</option><option value="Delhi">Delhi</option><option value="Hyderabad">Hyderabad</option><option value="Jaipur">Jaipur</option><option value="Jalandhar">Jalandhar</option><option value="Kolkata">Kolkata</option><option value="Lucknow">Lucknow</option><option value="Mumbai">Mumbai</option><option value="Nagpur">Nagpur</option><option value="Pune">Pune</option><option value="Surat">Surat</option><option value="Ananthpur">Ananthpur</option><option value="Aurangabad">Aurangabad</option><option value="Baroda">Baroda</option><option value="Bahadurgarh">Bahadurgarh</option><option value="Bhimavaram">Bhimavaram</option><option value="Bhiwadi">Bhiwadi</option><option value="Bhopal">Bhopal</option><option value="Bhubneshwar">Bhubneshwar</option><option value="Calicut">Calicut</option><option value="Coimbatore">Coimbatore</option><option value="Cuttack">Cuttack</option><option value="Dehradun">Dehradun</option><option value="Dindigul">Dindigul</option><option value="Eluru">Eluru</option><option value="Ernakulam">Ernakulam</option><option value="Erode">Erode</option><option value="Faridabad">Faridabad</option><option value="Gaziabad">Gaziabad</option><option value="Guntur">Guntur</option><option value="Gurgaon">Gurgaon</option><option value="Guwahati">Guwahati</option><option value="Hosur">Hosur</option><option value="Indore">Indore</option><option value="Jabalpur">Jabalpur</option><option value="Jamshedpur">Jamshedpur</option><option value="Kakinada">Kakinada</option><option value="Karaikkal">Karaikkal</option><option value="Karimnagar">Karimnagar</option><option value="Karur">Karur</option><option value="Kanpur">Kanpur</option><option value="Khammam">Khammam</option><option value="Kishangarh">Kishangarh</option><option value="Kochi">Kochi</option><option value="Kozhikode">Kozhikode</option><option value="Kumbakonam">Kumbakonam</option><option value="Kurnool">Kurnool</option><option value="Ludhiana">Ludhiana</option><option value="Madurai">Madurai</option><option value="Mangalore">Mangalore</option><option value="Mysore">Mysore</option><option value="Nagerkoil">Nagerkoil</option><option value="Nasik">Nasik</option><option value="Navi Mumbai">Navi Mumbai</option><option value="Nellore">Nellore</option><option value="Nizamabad">Nizamabad</option><option value="Noida">Noida</option><option value="Ongole">Ongole</option><option value="Ooty">Ooty</option><option value="Patna">Patna</option><option value="Pondicherry">Pondicherry</option><option value="Pudukottai">Pudukottai</option><option value="Rajahmundry">Rajahmundry</option><option value="Ramagundam">Ramagundam</option><option value="Raipur">Raipur</option><option value="Rewari">Rewari</option><option value="Sahibabad">Sahibabad</option><option value="Salem">Salem</option><option value="Srikakulam">Srikakulam</option><option value="Thane">Thane</option><option value="Thanjavur">Thanjavur</option><option value="Thrissur">Thrissur</option><option value="Thiruvananthapuram">Thiruvananthapuram</option><option value="Tirunelveli">Tirunelveli</option><option value="Tirupathi">Tirupathi</option><option value="Trivandrum">Trivandrum</option><option value="Trichy">Trichy</option><option value="Tuticorin">Tuticorin</option><option value="Vadodara">Vadodara</option><option value="Vellore">Vellore</option><option value="Vishakapatanam">Vishakapatanam</option><option value="Vizag">Vizag</option><option value="Vizianagaram">Vizianagaram</option><option value="Warangal">Warangal</option><option value="Others">Others</option>                   <option value="Vapi">Vapi</option>	   <option value="Ankleshwar">Ankleshwar</option>	  <option value="Anand">Anand</option>	 <option value="Anand">Dahod</option>	 <option value="Anand">Navsari</option>   </select></td> 		</tr><tr><td colspan="2"  class="indfromtxt" height="10"></td></tr><tr>  <td width="47%" class="indfromtxt">Home Loan Running With</td>    <td width="53%" align="left"><select name="existing_bank_hl" id="existing_bank_hl" class="inputtxt" onFocus="addToolTip(\'existing_bank_hl\');">   <option value="Axis Bank">Axis Bank</option>  <option value="Bajaj Finserv">Bajaj Finserv</option>  <option value="Capital Finance">Capital First</option><option value="Citibank">Citibank</option> <option value="Fullerton">Fullerton India</option><option value="HDFC">HDFC Bank</option><option value="HDBFS">HDB Financial Services</option><option value="HSBC">HSBC Bank</option><option value="ICICI Bank">ICICI Bank</option><option value="IngVysya">IngVysya Bank</option><option value="Kotak Bank">Kotak Bank</option><option value="INDUS IND bank">Indusind Bank</option><option value="Standard Chartered">Standard Chartered</option><option value="Others">Others</option></select></td></tr><tr><td colspan="2" class="indfromtxt" height="10"></td></tr><tr><td class="indfromtxt">Total Home Loan Amount</td><td align="left"><input type="text" name="existing_la_hl" class="inputtxt" onFocus="addToolTip(\'existing_la_hl\');" id="existing_la_hl" onKeyUp="intOnly(this); getDigitToWords(\'existing_la_hl\',\'formated\',\'wordloan\');" onKeyPress="intOnly(this); "/></td></tr><tr><td></td><td><span id="formated" style="font-size:11px;font-weight:normal; color:#000000;font-Family:Verdana;"></span><span id="wordloan" style="font-size:11px;font-weight:normal; color:#000000;font-Family:Verdana;text-transform: capitalize;"></span></td></tr><tr><td colspan="2"  class="indfromtxt" height="10"></td></tr><tr><td  class="indfromtxt">Existing ROI</td><td align="left"><input type="text" name="existing_roi_hl" class="inputtxt" style="width:92px !important;"  onfocus="addToolTip(\'existing_roi_hl\');" id="existing_roi_hl" />%</td></tr><tr><td colspan="2" class="indfromtxt" height="10"></td></tr><tr><td class="indfromtxt">No. of EMI Paid</td><td align="left"><input type="text" name="existing_noofemi_hl" class="inputtxt" style="width:32px !important;" onFocus="addToolTip(\'existing_noofemi_hl\');" id="existing_noofemi_hl" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);"/>(In months)</td></tr><tr><td colspan="2" class="indfromtxt" height="10"></td></tr><tr><td class="indfromtxt">Total Tenure</td><td align="left"><input type="text" name="existing_tenure_hl" class="inputtxt" style="width:45px !important;" onFocus="addToolTip(\'existing_tenure_hl\');" id="existing_tenure_hl" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);"/>(In months)</td></tr><tr><td colspan="2" class="indfromtxt" height="10"></td></tr></table> <div style="float:right; width:146px; margin-top:33px; margin-right:-10px;"><input name="image"  value="Submit" type="image" src="images/calculate-save-myemi-btn.png" width="160" height="53"  style="border:0px;"  /></div>';
}
function addToolTip(statval)
{
	var ni1 = document.getElementById('tooltipContent');
	if(statval=="outstanding_amount_cc")
	{
	ni1.innerHTML = 'Please fill Total Outstanding on Card';
	}
	if(statval=="City")
	{
	ni1.innerHTML = 'Select city';
	}
	if(statval=="company_name")
	{
	ni1.innerHTML = 'Please fill your current Company Name';
	}
	if(statval=="age")
	{
	ni1.innerHTML = 'Fill your Age';
	}
	if(statval=="net_income")
	{
	ni1.innerHTML = 'Please Fill your Net Monthly Income';
	}
	if(statval=="salary_account")
	{
	ni1.innerHTML = 'Please Fill Salary account bank name';
	}
	if(statval=="card_vintage")
	{
	ni1.innerHTML = 'Select how long you holding this card';
	}

	//for pl bt
	if(statval=="existing_bank_pl")
	{
	ni1.innerHTML = 'Your Personal loan running from which bank, specify name';
	}
	if(statval=="existing_la_pl")
	{
	ni1.innerHTML = 'please fill your Existing personal loan amount';
	}
	if(statval=="plbt_income")
	{
	ni1.innerHTML = 'please fill your Net Monthly Income';
	}
	if(statval=="existing_tenure_pl")
	{
	ni1.innerHTML = 'please fill Personal Loan tenure';
	}
	if(statval=="existing_noofemi_pl")
	{
	ni1.innerHTML = 'please fill Number of EMIs paid of personal loan';
	}
	if(statval=="existing_roi_pl")
	{
	ni1.innerHTML = 'please fill Rate Of Insterest on your cureent personal loan';
	}
	if(statval=="plbt_companyname")
	{
	ni1.innerHTML = 'please fill Name of Company you currently working with';
	}
	if(statval=="existing_prepay_pl")
	{
	ni1.innerHTML = 'please fill prepayment on your personal loan';
	}
	//for hl bt	
	if(statval=="existing_bank_hl")
	{
	ni1.innerHTML = 'Your Home loan running from which bank, specify name';
	}
	if(statval=="existing_la_hl")
	{
	ni1.innerHTML = 'please fill your Existing Home loan amount';
	}
	if(statval=="existing_tenure_hl")
	{
	ni1.innerHTML = 'please fill Home Loan tenure';
	}
	if(statval=="existing_noofemi_hl")
	{
	ni1.innerHTML = 'please fill Number of EMIs paid of Home loan';
	}
	if(statval=="existing_roi_hl")
	{
	ni1.innerHTML = 'please fill Rate Of Insterest on your cureent Home loan';
	}	
}

function fillthefield(fldval)
{
	var ni1val = document.getElementById('plbt_income').value;
	var ni1valcc = document.getElementById('net_income').value;
	var ni1valcc_cn = document.getElementById('company_name').value;
	var ni1valcn = document.getElementById('plbt_companyname').value;
	
		if(fldval=="net_income" && ni1val=="")
		{
			//alert("jhui");
			document.save_emiform.plbt_income.value = ni1valcc;
			document.save_emiform.plbt_companyname.value = ni1valcc_cn;
		}
		else
	{
			document.save_emiform.net_income.value = ni1val;
			document.save_emiform.company_name.value = ni1valcn;
	}
}

function othercity()
{
	var puthereocdiv = document.getElementById('puthere_oc');
	if(document.save_emiform.City.value=="Others")
	{
	puthereocdiv.innerHTML ='<table width="100%" cellpadding="0" cellspacing="0"> <tr><td class="indfromtxt" width="48%">Other City</td><td align="left" width="52%"><input type="text" name="other_city" id="other_city" class="inputtxtcc"/></td>  </tr><tr><td colspan="2"  class="indfromtxt" height="10"></td> </tr></table>';
	}
	else
	{
		puthereocdiv.innerHTML ='';
	}
}
</script>	
<!--<script type="text/javascript" src="ajax-dynamic-list.js"></script>-->
<style type="text/css">
	/* Big box with list of options */
	#ajax_listOfOptions{
		position:absolute;	/* Never change this one */
		width:250px;	/* Width of box */
		height:160px;	/* Height of box */
		overflow:auto;	/* Scrolling features */
		border:1px solid #317082;	/* Dark green border */
		background-color:#FFF;	/* White background color */
    	color: black;
		font-family:Verdana, Arial, Helvetica, sans-serif;
		text-align:left;
		font-size:10px;
		z-index:50;
	}
	#ajax_listOfOptions div{	/* General rule for both .optionDiv and .optionDivSelected */
		margin:1px;		
		padding:1px;
		cursor:pointer;
		font-size:10px;
	}

	#ajax_listOfOptions .optionDivSelected{ /* Selected item in the list */
		background-color:#2375CB;
		color:#FFF;
	}
	#ajax_listOfOptions_iframe{
		background-color:#F00;
		position:relative;
		z-index:5;
	}
	form{
		display:inline;
	}	
.div-displaytext{ width:98%; padding:10px 0px 10px 0px; border-radius:7px; border:thin solid #feb800; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; text-indent:5px; color:#990000;}
.tool-tip-image{ width:185px; margin-top:30px; font-family:Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold; color:#990000; padding:25px 10px 25px 10px; background:#eeeeee; border-radius:7px; border:#90dcef solid 1px; float:left; z-index:2px; margin-left:-5px;  }
.tool-tiparrow{ width:53px; margin:-4px auto;}
</style>
    <style type="text/css">
        .demo {
            width: 1000px;
            margin: 0px auto;
        }
        .demo h1 {
                margin:33px 0 25px;
            }
        .demo h3 {
                margin: 10px 0;
            }
        pre {
            background: #fff;
        }
        @media only screen and (max-width: 780px) {
        .demo {
                margin: 5%;
                width: 90%;
         }
        .how-use {
                float: left;
                width: 300px;
                display: none;
            }
        }
        #tabInfo {display:none;}
		.diverboxnew{width:100%; font-family: Geneva, Arial, Helvetica, sans-serif; font-style:italic; font-size:20px; text-align:center;}
		.diverboxnew-new{width:300px; margin:15px auto; font-family: Geneva, Arial, Helvetica, sans-serif; font-style:italic; font-size:18px; text-align:center;}
		.boxyesone{ float:left; width:100px; margin-left:15px;}
    </style>
    <link rel="stylesheet" href="tabs.css" type="text/css" media="screen, projection"/>
	<script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
	<script type="text/javascript" src="js/jquery-ui-1.7.custom.min.js"></script>
    <script type="text/javascript">
		$(function() {
			var $tabs = $('#tabs').tabs();	
			$(".ui-tabs-panel").each(function(i){	
			  var totalSize = $(".ui-tabs-panel").size() - 1;	
			  if (i != totalSize) {
			      next = i + 2;
   		  $(this).append("<a href='#' class='next-tab mover' rel='" + next + "'>Next &#187;</a>");
				  //$(this).append("<div id='ranjana" + next + "' style='float:right; width:100px !important; font-family: Geneva, Arial, Helvetica, sans-serif; font-style:italic; font-size:18px; margin-right:170px; margin-top:-23px;'> <input type='radio' name='nextt' value='1' class='next-tab mover' rel='" + next + "' > No</div>");
				  $(this).append("<div id='ranjana" + next + "' style='float:right; width:100px !important; font-family: Geneva, Arial, Helvetica, sans-serif; font-style:italic; font-size:18px; margin-right:170px; margin-top:-22px;'> <input type='radio' name='nextt' value='1' class='next-tab mover' rel='" + next + "' > No</div>");
			  }
	  
			  if (i != 0) {
			      prev = i;
			  $(this).append("<a href='#' class='prev-tab mover' rel='" + prev + "'>&#171; Previous </a>");
				   // $(this).append("<input type='radio' name='nextt' value='0' class='next-tab mover' rel='" + prev + "'> No");
			  }
   		
			});
	
			$('.next-tab, .prev-tab').click(function() { 
		           $tabs.tabs('select', $(this).attr("rel"));
		           return false;
		       });  
		});

function pleasehide_cc()
{
	document.getElementById("ranjana2").style.display="none";
	document.getElementById("mainprtcc").style.display="none";
	document.getElementById("maintxtcc").style.display="none";
}
function pleasehide_pl()
{
	document.getElementById("ranjana3").style.display="none";
	document.getElementById("mainprtpl").style.display="none";
	document.getElementById("maintxtpl").style.display="none";
}
function pleasehide_hl()
{
	document.getElementById("mainprthl").style.display="none";
	document.getElementById("maintxthl").style.display="none";
}
    </script>
</head>
<form name="save_emiform" action="save-emi-app-continue.php" method="post">
<input type="hidden" name="cc_oustanding" id="cc_oustanding" value="">
<input type="hidden" name="pl_btpart" id="pl_btpart" value="">
<div class="header-emi-app"></div>
<div class="nav-app-main">
<div class="nav-app-in">
<div class="navmenu">
<ul>
<li><a href="#">Know More</a></li>
<li style="background:url(images/light-blue-bg.jpg) repeat-x !important; "><a href="#" style="padding:25px 15px 15px 15px;">Contact Us</a></li>
</ul>
</div>
</div>
</div>
<div style="clear:both;"></div>
<div class="myapp-save_second-wrapper-new">
<div class="myapp-save_second-wrapper">
  <div class="box-save-app1"><div id="page-wrap">		
		<div id="tabs">		
    		<ul>
        		<li><a href="#fragment-1">Credit Card</a></li>
        		<li><a href="#fragment-2">Personal Loan</a></li>
        		<li><a href="#fragment-3">Home Loan</a></li>
        	  </ul>	
        	<div id="fragment-1" class="ui-tabs-panel">
			<div class="diverboxnew" id="maintxtcc">Do you have any Credit Card Outstanding?</div>
<div class="diverboxnew-new" id="mainprtcc">
<div class="boxyesone"><input type='radio' name='nextt' value='0' onClick="check4cc(); pleasehide_cc();"> Yes </div>
			</div>
			<table cellpadding="2" cellspacing="0"  width="100%" style="margin-top:10px;"><tr> <td width="48%" class="indfromtxt">
			<tr><td id="puthere"></td></tr></table>
        	      	</div><!--First Frm -->        	
        	<div id="fragment-2" class="ui-tabs-panel ui-tabs-hide">  
			<div class="diverboxnew" id="maintxtpl">Do you have any Personal Loan Oustanding</div>
<div class="diverboxnew-new" id="mainprtpl">
<div class="boxyesone"><input type='radio' name='nextt' value='0' onClick="check4pl(); pleasehide_pl(); fillthefield('net_income');"> Yes </div>
			</div>
			<table cellpadding="2" cellspacing="0"  width="100%" ><tr> <td width="48%" class="indfromtxt">
			<tr><td id="putherepl"></td></tr></table>
        </div>            
        	<div id="fragment-3" class="ui-tabs-panel ui-tabs-hide">           
            	<div class="diverboxnew" id="maintxthl">Do you have any Home Loan Oustanding</div>
<div class="diverboxnew-new" id="mainprthl">
<div class="boxyesone"><input type='radio' name='nextt' value='0' onClick="check4hl(); pleasehide_hl();"> Yes </div><div class="boxyesone" style="margin-right:20px;"><input type='radio'  value='0' > No </div>
			</div>
			<table cellpadding="2" cellspacing="0"  width="100%" style="margin-top:10px;"><tr> <td width="48%" class="indfromtxt">
			<tr><td id="putherehl"> <div style="float:right; width:146px; margin-top:195px; margin-right:-10px;"><input name="image"  value="Submit" type="image" src="images/calculate-save-myemi-btn.png" width="160" height="53"  style="border:0px;"  /></div></td></tr></table>          
            </div>                
        </div>		
	</div>
     </div>  
     <div class="gith-panenew-cols">
     <div style="width:135px; margin:auto; "><div class="right-icon-box"><img src="images/graphimage-right-new.png" width="55" height="46" title="Bar Chart"></div>
<div class="right-icon-box"><img src="images/excel-icon-new.png" width="55" height="46" title="Exzcel File"></div></div>
<div style="clear:both;"></div>
<div class="sideangel-bx"><img src="images/arrow-angle-new.png" width="31" height="23"></div>
<div class="tool-tip-image" id="tooltipContent">Please fill the details </div>
<div style="clear:both;"></div>
<div class="chartoon-app-newbx" style="text-align:center;"><img src="images/cool-boy-characterani.gif" width="106" height="230"></div>
</div>
<div style="clear:both;"></div>
<div class="save-my-emi-button-wrapper-new">
</div>
</div>
<div style="clear:both;"></div>
</div>
<div style="clear:both;"></div>
</div> </div>
<div style="clear:both;"></div>
<div class="section-box-buttom">
<div class="section-box-buttom-inn">
<div class="section-box-buttom-left">
<div class="highlight-text"><img src="images/money-pig.png" width="179" height="245"></div>
<div class="highlight-text-b"></div>
</div>
<div class="section-box-buttom-right"><img src="images/laptopgif.gif" width="709" height="503"></div>
<div style="clear:both;"></div>
</div>
<div style="clear:both;"></div>
</div>
<div class="newwrappersecond"> <div class="mobilebox"><img src="images/mobo-img.jpg" width="438" height="570"></div>
<div class="graph-bxnew"><img src="images/graph-savemyapp-img.jpg" width="319" height="318"></div> </div>
<div style="clear: both; height:10px;"></div>
<div class="my-app-buttom"><div class="my-app-buttom-inn buttom-text"><a href="#">ABOUT US</a> | <a href="#">LEGAL TERMS</a> | <a href="#">CONTACT US</a> | <a href="#">ADVERTISING</a> | <a href="#">HELP</a></div> </div>
</form>
<script type="text/javascript">
    $(document).ready(function () {
        $('#horizontalTab').easyResponsiveTabs({
            type: 'default', //Types: default, vertical, accordion           
            width: 'auto', //auto or any width like 600px
            fit: true,   // 100% fit in a container
            closed: 'accordion', // Start closed if in accordion view
            activate: function(event) { // Callback function if tab is switched
                var $tab = $(this);
                var $info = $('#tabInfo');
                var $name = $('span', $info);
                $name.text($tab.text());
                $info.show();
            }
        });
        $('#verticalTab').easyResponsiveTabs({
            type: 'vertical',
            width: 'auto',
            fit: true
        });
    });
</script>
</body>
</html>