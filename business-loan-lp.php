<?php
//require 'scripts/functions.php';

if(isset($_REQUEST['source']))
{
	$src=$_REQUEST['source'];
}
else
{
	$src="business-loan LP";
}
$maxage=date('Y')-65;
$minage=date('Y')-18;
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Business Loan</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="css/bl-styles.css" type="text/css" rel="stylesheet" media="all" />
<link href="css/bl-custom-styles.css" type="text/css" rel="stylesheet" media="all" />
<script src="http://code.jquery.com/jquery-1.10.2.js"></script>
<script type="text/javascript" src="js/validation-business-loan-lp.js"></script>
</head>

<body>
<div class="container">
  <div class="row">
    <div class="col-xs-12"><img src="images/d4l-logo.png" alt="logo" /> </div>
  </div>
</div>
<div class="details-box">
  <div class="container">
    <div class="row">
      <div class="details-inner-box">
        <div class="col-xs-12 col-sm-6 col-md-6">
          <div class="forom-box">
            <div class="formheader text-center">
              <h1>Business Loan from Top 17 Banks</h1>
            </div>
            <div class="col-xs-12">
              <ul class="nav nav-tabs">
                <?php 
  $iphone = strpos($_SERVER['HTTP_USER_AGENT'],"iPhone");
  $android = strpos($_SERVER['HTTP_USER_AGENT'],"Android");
  $palmpre = strpos($_SERVER['HTTP_USER_AGENT'],"webOS");
  $berry = strpos($_SERVER['HTTP_USER_AGENT'],"BlackBerry");
  $ipod = strpos($_SERVER['HTTP_USER_AGENT'],"iPod");
  if ($iphone || $android || $palmpre || $ipod || $berry == true) 
  {
  	
	 $shhome='class="tab-pane fade in active"';
	$shmenu='class="tab-pane fade"';
  
  ?>
                <?php
  }
  else
  {
   	 $shhome='class="tab-pane fade"';
	$shmenu='class="tab-pane fade in active"';
	
  ?>
              
                <?php
        }
  ?>
  <li class="active"><a data-toggle="tab" href="#home" class="quote-hide">Leave your Number</a></li>
   <li><a data-toggle="tab" href="#menu1" class="hide-number-tab">Get Quote</a></li>
                
              </ul>
              <div class="tab-content">
              <div id="home" <? echo $shhome; ?>>
                <form name="personal_form" action="business-loan-lp-continue.php" method="POST" onsubmit="return chkbloan(document.personal_form);">
					 <input type="hidden" name="source2" value="<?php echo $src;?>" />
					<input type="hidden" name="section" value="BLLP28Sept2016MOB" />
                  <div class="row">
                    <div class="col-xs-12 col-md-6"> Name </div>
                    <div class="col-xs-12 col-md-6">
                      <input name="Name2" id="Name2" type="text" class="form-control" onkeydown="validateDiv('nameVal2');">
                      <div id="nameVal2"> </div>
                    </div>
                    <div class="col-xs-12 col-md-6"> Mobile Number </div>
                    <div class="col-xs-12 col-md-6">
                      <input name="Phone2" id="Phone2" type="text" class="form-control" onkeydown="validateDiv('mobileVal2');">
                      <div id="mobileVal2"></div>
                    </div>
				      <div class="col-xs-12 col-md-6">City</div>
                      <div class="col-xs-12 col-md-6">
                        <select name="City2" id="City2" class="form-control" onchange="validateDiv('CityVal'); othercity1();">
                          <option value="Please Select">Please Select</option>
                          <option value="Ahmedabad">Ahmedabad</option>
                          <option value="Bangalore">Bangalore</option>
                          <option value="Chandigarh">Chandigarh</option>
                          <option value="Chennai">Chennai</option>
                          <option value="Cochin">Cochin</option>
                          <option value="Delhi">Delhi</option>
                          <option value="Hyderabad">Hyderabad</option>
                          <option value="Jaipur">Jaipur</option>
                          <option value="Jalandhar">Jalandhar</option>
                          <option value="Kolkata">Kolkata</option>
                          <option value="Lucknow">Lucknow</option>
                          <option value="Mumbai">Mumbai</option>
                          <option value="Nagpur">Nagpur</option>
                          <option value="Pune">Pune</option>
                          <option value="Surat">Surat</option>
                          <option value="Ananthpur">Ananthpur</option>
                          <option value="Aurangabad">Aurangabad</option>
                          <option value="Baroda">Baroda</option>
                          <option value="Bahadurgarh">Bahadurgarh</option>
                          <option value="Bhimavaram">Bhimavaram</option>
                          <option value="Bhiwadi">Bhiwadi</option>
                          <option value="Bhopal">Bhopal</option>
                          <option value="Bhubneshwar">Bhubneshwar</option>
                          <option value="Calicut">Calicut</option>
                          <option value="Coimbatore">Coimbatore</option>
                          <option value="Cuttack">Cuttack</option>
                          <option value="Dehradun">Dehradun</option>
                          <option value="Dindigul">Dindigul</option>
                          <option value="Eluru">Eluru</option>
                          <option value="Ernakulam">Ernakulam</option>
                          <option value="Erode">Erode</option>
                          <option value="Faridabad">Faridabad</option>
                          <option value="Gaziabad">Gaziabad</option>
                          <option value="Guntur">Guntur</option>
                          <option value="Gurgaon">Gurgaon</option>
                          <option value="Guwahati">Guwahati</option>
                          <option value="Hosur">Hosur</option>
                          <option value="Indore">Indore</option>
                          <option value="Jabalpur">Jabalpur</option>
                          <option value="Jamshedpur">Jamshedpur</option>
                          <option value="Kakinada">Kakinada</option>
                          <option value="Karaikkal">Karaikkal</option>
                          <option value="Karimnagar">Karimnagar</option>
                          <option value="Karur">Karur</option>
                          <option value="Kanpur">Kanpur</option>
                          <option value="Khammam">Khammam</option>
                          <option value="Kishangarh">Kishangarh</option>
                          <option value="Kochi">Kochi</option>
                          <option value="Kozhikode">Kozhikode</option>
                          <option value="Kumbakonam">Kumbakonam</option>
                          <option value="Kurnool">Kurnool</option>
                          <option value="Ludhiana">Ludhiana</option>
                          <option value="Madurai">Madurai</option>
                          <option value="Mangalore">Mangalore</option>
                          <option value="Mysore">Mysore</option>
                          <option value="Nagerkoil">Nagerkoil</option>
                          <option value="Nasik">Nasik</option>
                          <option value="Navi Mumbai">Navi Mumbai</option>
                          <option value="Nellore">Nellore</option>
                          <option value="Nizamabad">Nizamabad</option>
                          <option value="Noida">Noida</option>
                          <option value="Ongole">Ongole</option>
                          <option value="Ooty">Ooty</option>
                          <option value="Patna">Patna</option>
                          <option value="Pondicherry">Pondicherry</option>
                          <option value="Pudukottai">Pudukottai</option>
                          <option value="Rajahmundry">Rajahmundry</option>
                          <option value="Ramagundam">Ramagundam</option>
                          <option value="Raipur">Raipur</option>
                          <option value="Rewari">Rewari</option>
                          <option value="Sahibabad">Sahibabad</option>
                          <option value="Salem">Salem</option>
                          <option value="Srikakulam">Srikakulam</option>
                          <option value="Thane">Thane</option>
                          <option value="Thanjavur">Thanjavur</option>
                          <option value="Thrissur">Thrissur</option>
                          <option value="Thiruvananthapuram">Thiruvananthapuram</option>
                          <option value="Tirunelveli">Tirunelveli</option>
                          <option value="Tirupathi">Tirupathi</option>
                          <option value="Trivandrum">Trivandrum</option>
                          <option value="Trichy">Trichy</option>
                          <option value="Tuticorin">Tuticorin</option>
                          <option value="Vadodara">Vadodara</option>
                          <option value="Vellore">Vellore</option>
                          <option value="Vishakapatanam">Vishakapatanam</option>
                          <option value="Vizag">Vizag</option>
                          <option value="Vizianagaram">Vizianagaram</option>
                          <option value="Warangal">Warangal</option>
                          <option value="Others">Others</option>
                        </select>
                        <div id="CityVal"> </div>
                      </div>
                   
                    <div class="row">
                      <div class="col-xs-12 text-center">
                        <input name="Submit2" type="submit" value="GET QUOTE" class="btn blue-button" >
                      </div>
                    </div>
                  </div>
 </form>
              </div>
              
              
                <div id="menu1" <? echo $shmenu; ?>>
                <form name="personalloan_form" action="insert_personal_loan_value_step1.php" method="POST" >
				<input type="hidden" name="Employment_Status" value="0" />
				 <input type="hidden" name="source" value="<?php echo $src."MOB";?>" />
					<input type="hidden" name="section" value="BLLP28Sept2016" />
                  <div class="col-md-6">Loan Amount</div>
                  <div class="col-md-6">
                    <input name="Loan_Amount" id="Loan_Amount" type="text" class="form-control" onkeydown="validateDiv('loanAmtVal');" onkeypress="return numOnly(event);" autocomplete="off">
                    <div id="loanAmtVal"></div>
                  </div>
                  <div class="blmainforminn margin-top-business-loan" id="running-business-ar" style="display:none;">
                    <div class="col-md-6">You Are Running Business Since ?</div>
                    <div class="col-md-6">
                      <div class="inputwrapprer">
                        <input type="radio" name="Total_Experience" id="running_business1" value="1" class="css-checkbox" onclick="validateDiv('TotalExperienceVal')">
                        <label for="running_business1" class="css-label radGroup2">Less Than 2 Yrs</label>
                        <input type="radio" name="Total_Experience" id="running_business2" value="2.5" class="css-checkbox" onclick="validateDiv('TotalExperienceVal')">
                        <label for="running_business2" class="css-label radGroup2">2 To 3 Yrs</label>
                      </div>
                      <div class="inputwrapprer">
                        <input type="radio" name="Total_Experience" id="running_business3" value="4" class="css-checkbox" onclick="validateDiv('TotalExperienceVal')">
                        <label for="running_business3" class="css-label radGroup">3 To 5 Yrs</label>
                        <input type="radio" name="Total_Experience" id="running_business4" value="5" class="css-checkbox" onclick="validateDiv('TotalExperienceVal')">
                        <label for="running_business4" class="css-label radGroup2">5 Yrs &amp; Above</label>
                        <div id="TotalExperienceVal"> </div>
                      </div>
                    </div>
                  </div>
                  <div class="blmainforminn margin-top-business-loan" id="annual-ancome-ar" style="display:none;">
                    <div class="col-md-6">Your Annual Income/ ITR</div>
                    <div class="col-md-6">
                      <div class="inputwrapprer">
                        <input type="radio" name="IncomeAmount" id="IncomeAmount1" value="200000" class="css-checkbox" onclick="validateDiv('NetSalaryVal')">
                        <label for="IncomeAmount1" class="css-label radGroup2">Upto 2 Lacs</label>
                        <input type="radio" name="IncomeAmount" id="IncomeAmount2" value="300000" class="css-checkbox" onclick="validateDiv('NetSalaryVal')">
                        <label for="IncomeAmount2" class="css-label radGroup2">2 To 3 Lacs</label>
                      </div>
                      <div class="inputwrapprer">
                        <input type="radio" name="IncomeAmount" id="IncomeAmount3" value="500000" class="css-checkbox" onclick="validateDiv('NetSalaryVal')">
                        <label for="IncomeAmount3" class="css-label radGroup2">3 To 5 Lacs</label>
                        <input type="radio" name="IncomeAmount" id="IncomeAmount4" value="600000" class="css-checkbox" onclick="validateDiv('NetSalaryVal')">
                        <label for="IncomeAmount4" class="css-label radGroup2">5 Lacs &amp; Above</label>
                        <div id="NetSalaryVal"></div>
                      </div>
                    </div>
                  </div>
                  <div class="blmainforminn margin-top-business-loan" id="annual-turnover-ar" style="display:none;">
                    <div class="col-md-6">Annual Turnover For Your Business</div>
                    <div class="col-md-6">
                      <div class="inputwrapprer">
                        <input type="radio" name="Annual_Turnover" id="Annual_Turnover1" value="1" class="css-checkbox" onclick="validateDiv('AnnualTurnoverVal')">
                        <label for="Annual_Turnover1" class="css-label radGroup2">Upto 50 Lacs</label>
                        <input type="radio" name="Annual_Turnover" id="Annual_Turnover2" value="2" class="css-checkbox" onclick="validateDiv('AnnualTurnoverVal')">
                        <label for="Annual_Turnover2" class="css-label radGroup2">50 Lacs To 1 Cr</label>
                      </div>
                      <div class="inputwrapprer">
                        <input type="radio" name="Annual_Turnover" id="Annual_Turnover3" value="3" class="css-checkbox" onclick="validateDiv('AnnualTurnoverVal')">
                        <label for="Annual_Turnover3" class="css-label radGroup2">1 Cr To 3 Crs</label>
                        <input type="radio" name="Annual_Turnover" id="Annual_Turnover4" value="4" class="css-checkbox" onclick="validateDiv('AnnualTurnoverVal')">
                        <label for="Annual_Turnover4" class="css-label radGroup2">3 Crs &amp; Above</label>
                        <div id="AnnualTurnoverVal"></div>
                      </div>
                    </div>
                  </div>
                  <div class="blmainforminn_b" id="existing-loan-ar" style="display:none;">
                    <div class="col-md-6">Any Existing Loan</div>
                    <div class="col-md-6">
                      <div class="inputwrapprer">
                        <input type="radio" name="Existing_Loan" id="Existing_Loan1" value="1" class="css-checkbox" onclick="validateDiv('ExistingLoanVal')">
                        <label for="Existing_Loan1" class="css-label radGroup2">Yes</label>
                        <input type="radio" name="Existing_Loan" id="Existing_Loan2" value="2" class="css-checkbox" onclick="validateDiv('ExistingLoanVal')">
                        <label for="Existing_Loan2" class="css-label radGroup2">No</label>
                        <div id="ExistingLoanVal"></div>
                      </div>
                    </div>
                    <div id="loan-type-ar" style="display:none;">
                      <div class="col-md-6">Loan Type</div>
                      <div class="col-md-6">
                        <div class="inputwrapprer">
                          <input type="checkbox" name="Loan_Any" id="Loan_Type1" class="css-checkbox" value="cl" onclick="validateDiv('LoanAnyVal')">
                          <label for="Loan_Type1" class="css-label-check">Auto Loan</label>
                          <input type="checkbox" name="Loan_Any" id="Loan_Type2" class="css-checkbox" value="hl" onclick="validateDiv('LoanAnyVal')">
                          <label for="Loan_Type2" class="css-label-check">Home Loan</label>
                        </div>
                        <div class="inputwrapprer">
                          <input type="checkbox" name="Loan_Any" id="Loan_Type3" class="css-checkbox" value="odl" onclick="validateDiv('LoanAnyVal')">
                          <label for="Loan_Type3" class="css-label-check">Over Draft Loan</label>
                          <input type="checkbox" name="Loan_Any" id="Loan_Type4" class="css-checkbox" value="other" onclick="validateDiv('LoanAnyVal')">
                          <label for="Loan_Type4" class="css-label-check">Other</label>
                          <div id="LoanAnyVal"></div>
                        </div>
                      </div>
                    </div>
                    <div id="loan-emi-paid-ar" style="display:none;">
                      <div class="col-md-6">EMIs Paid</div>
                      <div class="col-md-6">
                        <div class="inputwrapprer">
                          <input type="radio" name="EMI_Paid" id="Emi_Paid1" value="1" class="css-checkbox" onclick="validateDiv('EMIPaidVal')">
                          <label for="Emi_Paid1" class="css-label radGroup2">0 To 6</label>
                          <input type="radio" name="EMI_Paid" id="Emi_Paid2" value="2" class="css-checkbox" onclick="validateDiv('EMIPaidVal')">
                          <label for="Emi_Paid2" class="css-label radGroup2">6 To 9</label>
                        </div>
                        <div class="inputwrapprer">
                          <input type="radio" name="EMI_Paid" id="Emi_Paid3" value="3" class="css-checkbox" onclick="validateDiv('EMIPaidVal')">
                          <label for="Emi_Paid3" class="css-label radGroup2">9 To 12</label>
                          <input type="radio" name="EMI_Paid" id="Emi_Paid4" value="4" class="css-checkbox" onclick="validateDiv('EMIPaidVal')">
                          <label for="Emi_Paid4" class="css-label radGroup2">More than 12</label>
                          <div id="EMIPaidVal"> </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="blmainforminn_b" id="credit-card-ar" style="display:none;">
                    <div class="col-md-6">Holding Current Account</div>
                    <div class="col-md-6">
                      <div class="inputwrapprer">
                        <input type="radio" name="Holding_Current_Account" id="Holding_Current_Account1" value="1" class="css-checkbox" onclick="validateDiv('HoldingCurrentAccountVal')">
                        <label for="Holding_Current_Account1" class="css-label radGroup2">Yes</label>
                        <input type="radio" name="Holding_Current_Account" id="Holding_Current_Account2" value="0" class="css-checkbox" onclick="validateDiv('HoldingCurrentAccountVal')">
                        <label for="Holding_Current_Account2" class="css-label radGroup2">No </label>
                        <div id="HoldingCurrentAccountVal"> </div>
                      </div>
                    </div>
                  </div>
                  <div class="clearfix"></div>
                  <div class="col-xs-12" id="pl-personal-details" style="display:none;">
                    <div class="row">
                      <div class="col-xs-12 text-center">
                        <h3 class="text-left">Personal Details</h3>
                        <p class="text-left small"> <img src="images/y-lock.png" alt="Lock" /> Your Information is secure with us and will not be shared without your consent</p>
                      </div>
                      <div class="col-sm-6"> </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">Name </div>
                      <div class="col-md-6">
                        <input name="Name" id="Name" type="text" class="form-control" onkeydown="validateDiv('FullNameVal')">
                        <div id="FullNameVal"> </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">Mobile Number</div>
                      <div class="col-md-6">
                        <input name="Phone" id="Phone" type="text" maxlength="10" class="form-control" onkeydown="validateDiv('MobileNumVal')">
                        <div id="MobileNumVal"> </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">City</div>
                      <div class="col-md-6">
                        <select name="City" id="City" class="form-control" onchange="validateDiv('City2Val'); othercity1();">
                          <option value="Please Select">Please Select</option>
                          <option value="Ahmedabad">Ahmedabad</option>
                          <option value="Bangalore">Bangalore</option>
                          <option value="Chandigarh">Chandigarh</option>
                          <option value="Chennai">Chennai</option>
                          <option value="Cochin">Cochin</option>
                          <option value="Delhi">Delhi</option>
                          <option value="Hyderabad">Hyderabad</option>
                          <option value="Jaipur">Jaipur</option>
                          <option value="Jalandhar">Jalandhar</option>
                          <option value="Kolkata">Kolkata</option>
                          <option value="Lucknow">Lucknow</option>
                          <option value="Mumbai">Mumbai</option>
                          <option value="Nagpur">Nagpur</option>
                          <option value="Pune">Pune</option>
                          <option value="Surat">Surat</option>
                          <option value="Ananthpur">Ananthpur</option>
                          <option value="Aurangabad">Aurangabad</option>
                          <option value="Baroda">Baroda</option>
                          <option value="Bahadurgarh">Bahadurgarh</option>
                          <option value="Bhimavaram">Bhimavaram</option>
                          <option value="Bhiwadi">Bhiwadi</option>
                          <option value="Bhopal">Bhopal</option>
                          <option value="Bhubneshwar">Bhubneshwar</option>
                          <option value="Calicut">Calicut</option>
                          <option value="Coimbatore">Coimbatore</option>
                          <option value="Cuttack">Cuttack</option>
                          <option value="Dehradun">Dehradun</option>
                          <option value="Dindigul">Dindigul</option>
                          <option value="Eluru">Eluru</option>
                          <option value="Ernakulam">Ernakulam</option>
                          <option value="Erode">Erode</option>
                          <option value="Faridabad">Faridabad</option>
                          <option value="Gaziabad">Gaziabad</option>
                          <option value="Guntur">Guntur</option>
                          <option value="Gurgaon">Gurgaon</option>
                          <option value="Guwahati">Guwahati</option>
                          <option value="Hosur">Hosur</option>
                          <option value="Indore">Indore</option>
                          <option value="Jabalpur">Jabalpur</option>
                          <option value="Jamshedpur">Jamshedpur</option>
                          <option value="Kakinada">Kakinada</option>
                          <option value="Karaikkal">Karaikkal</option>
                          <option value="Karimnagar">Karimnagar</option>
                          <option value="Karur">Karur</option>
                          <option value="Kanpur">Kanpur</option>
                          <option value="Khammam">Khammam</option>
                          <option value="Kishangarh">Kishangarh</option>
                          <option value="Kochi">Kochi</option>
                          <option value="Kozhikode">Kozhikode</option>
                          <option value="Kumbakonam">Kumbakonam</option>
                          <option value="Kurnool">Kurnool</option>
                          <option value="Ludhiana">Ludhiana</option>
                          <option value="Madurai">Madurai</option>
                          <option value="Mangalore">Mangalore</option>
                          <option value="Mysore">Mysore</option>
                          <option value="Nagerkoil">Nagerkoil</option>
                          <option value="Nasik">Nasik</option>
                          <option value="Navi Mumbai">Navi Mumbai</option>
                          <option value="Nellore">Nellore</option>
                          <option value="Nizamabad">Nizamabad</option>
                          <option value="Noida">Noida</option>
                          <option value="Ongole">Ongole</option>
                          <option value="Ooty">Ooty</option>
                          <option value="Patna">Patna</option>
                          <option value="Pondicherry">Pondicherry</option>
                          <option value="Pudukottai">Pudukottai</option>
                          <option value="Rajahmundry">Rajahmundry</option>
                          <option value="Ramagundam">Ramagundam</option>
                          <option value="Raipur">Raipur</option>
                          <option value="Rewari">Rewari</option>
                          <option value="Sahibabad">Sahibabad</option>
                          <option value="Salem">Salem</option>
                          <option value="Srikakulam">Srikakulam</option>
                          <option value="Thane">Thane</option>
                          <option value="Thanjavur">Thanjavur</option>
                          <option value="Thrissur">Thrissur</option>
                          <option value="Thiruvananthapuram">Thiruvananthapuram</option>
                          <option value="Tirunelveli">Tirunelveli</option>
                          <option value="Tirupathi">Tirupathi</option>
                          <option value="Trivandrum">Trivandrum</option>
                          <option value="Trichy">Trichy</option>
                          <option value="Tuticorin">Tuticorin</option>
                          <option value="Vadodara">Vadodara</option>
                          <option value="Vellore">Vellore</option>
                          <option value="Vishakapatanam">Vishakapatanam</option>
                          <option value="Vizag">Vizag</option>
                          <option value="Vizianagaram">Vizianagaram</option>
                          <option value="Warangal">Warangal</option>
                          <option value="Others">Others</option>
                        </select>
                        <div id="City2Val"> </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">E-Mail ID</div>
                      <div class="col-md-6">
                        <input name="Email" id="Email" type="text" class="form-control" onkeydown="validateDiv('EmailIDVal')">
                        <div id="EmailIDVal"></div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">Age</div>
                      <div class="col-md-6">
                        <select onchange="validateDiv('AgeVal');" class="form-control" name="Age" id="Age">
                          <option value="">Select Age</option>
                          <option value="18">18</option>
                          <option value="19">19</option>
                          <option value="20">20</option>
                          <option value="21">21</option>
                          <option value="22">22</option>
                          <option value="23">23</option>
                          <option value="24">24</option>
                          <option value="25">25</option>
                          <option value="26">26</option>
                          <option value="27">27</option>
                          <option value="28">28</option>
                          <option value="29">29</option>
                          <option value="30">30</option>
                          <option value="31">31</option>
                          <option value="32">32</option>
                          <option value="33">33</option>
                          <option value="34">34</option>
                          <option value="35">35</option>
                          <option value="36">36</option>
                          <option value="37">37</option>
                          <option value="38">38</option>
                          <option value="39">39</option>
                          <option value="40">40</option>
                          <option value="41">41</option>
                          <option value="42">42</option>
                          <option value="43">43</option>
                          <option value="44">44</option>
                          <option value="45">45</option>
                          <option value="46">46</option>
                          <option value="47">47</option>
                          <option value="48">48</option>
                          <option value="49">49</option>
                          <option value="50">50</option>
                          <option value="51">51</option>
                          <option value="52">52</option>
                          <option value="53">53</option>
                          <option value="54">54</option>
                          <option value="55">55</option>
                          <option value="56">56</option>
                          <option value="57">57</option>
                          <option value="58">58</option>
                          <option value="59">59</option>
                          <option value="60">60</option>
                          <option value="61">61</option>
                          <option value="62">62</option>
                          <option value="63">63</option>
                          <option value="64">64</option>
                          <option value="65">65</option>
                        </select>
                        <div id="AgeVal"></div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">Residence Status</div>
                      <div class="col-md-6">
                        <div class="inputwrapprer">
                          <input type="radio" name="Residential_Status" id="Residence_Status1" value="1" class="css-checkbox" onclick="validateDiv('ResidentialStatusVal')">
                          <label for="Residence_Status1" class="css-label radGroup2">Owned</label>
                          <input type="radio" name="Residential_Status" id="Residence_Status2" value="0" class="css-checkbox" onclick="validateDiv('ResidentialStatusVal')">
                          <label for="Residence_Status2" class="css-label radGroup2">Rented</label>
                        </div>
                        <div id="ResidentialStatusVal"></div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">Office Status</div>
                      <div class="col-md-6">
                        <div class="inputwrapprer">
                          <input type="radio" name="Office_Status" id="Office_Status1" value="1"  onclick="validateDiv('OfficeStatusVal')" class="css-checkbox">
                          <label for="Office_Status1" class="css-label radGroup2">Owned</label>
                          <input type="radio" name="Office_Status" id="Office_Status2" value="0" class="css-checkbox" onclick="validateDiv('OfficeStatusVal')">
                          <label for="Office_Status2" class="css-label radGroup2">Rented</label>
                        </div>
                        <div id="OfficeStatusVal"></div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-xs-12 text-left small">
                        <input type="checkbox" name="checkbox" id="checkbox" checked="">
                        I authorize Deal4loans.com & its partnering banks to contact me to explain the product & I Agree to Privacy policy and Terms and Conditions.</div>
                    </div>
                    <div class="row">
                      <div class="col-xs-12 text-center">
                        <input name="button" type="submit" value="GET QUOTE" class="btn blue-button"  onclick="return formValidate();" >
                      </div>
                    </div>
                  </div>
                  <div class="clearfix"></div>
                  <div class="row" id="hideButton">
                    <div class="col-xs-12 text-center">
                      <input name="button" type="submit" value="GET QUOTE" class="btn blue-button"  onclick="return formValidate();" >
                    </div>
                  </div>
                </form>
                </div>
                </div>
             
            </div>
            <div class="clearfix"></div>
          </div>
        </div>
      </div>
      <div class="col-xs-12 col-sm-6 col-md-6 margin-top">
        <div class="details-inner-box">
          <div class="col-xs-12">
            <div class="forom-box">
              <div class=" form-right-header text-center">
                <p class="text-center"><strong>Business Loan</strong> for all your Financial needs</p>
              </div>
              <div class="table-responsive">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td rowspan="5" align="center" bgcolor="#d5d5d5">Sample <br>
                      Personal Loan <br>
                      Quotes</td>
                    <td align="center" bgcolor="#e4e4e4">Banks</td>
                    <td align="center" bgcolor="#e4e4e4">Interest Rate</td>
                    <td align="center" bgcolor="#e4e4e4">Eligible Loan Amt.</td>
                    <td align="center" bgcolor="#e4e4e4">EMI</td>
                    <td align="center" bgcolor="#e4e4e4">Pre-Payment</td>
                  </tr>
                  <tr>
                    <td align="center" bgcolor="#f1f1f1">Bank A</td>
                    <td align="center" bgcolor="#f1f1f1">11.99%</td>
                    <td align="center" bgcolor="#f1f1f1">Rs. 1,25,000</td>
                    <td bgcolor="#f1f1f1">Rs. 3,291</td>
                    <td align="center" bgcolor="#f1f1f1">Nil</td>
                  </tr>
                  <tr>
                    <td align="center" bgcolor="#f1f1f1">Bank B</td>
                    <td align="center" bgcolor="#f1f1f1">13.49%</td>
                    <td align="center" bgcolor="#f1f1f1">Rs. 1,00,000</td>
                    <td bgcolor="#f1f1f1">Rs. 3,383</td>
                    <td align="center" bgcolor="#f1f1f1">%</td>
                  </tr>
                  <tr>
                    <td align="center" bgcolor="#f1f1f1">Bank C</td>
                    <td align="center" bgcolor="#f1f1f1">13.60%</td>
                    <td align="center" bgcolor="#f1f1f1">Rs. 1,25,000</td>
                    <td bgcolor="#f1f1f1">Rs. 3,390</td>
                    <td align="center" bgcolor="#f1f1f1">Rs. 3,390</td>
                  </tr>
                  <tr>
                    <td align="center" bgcolor="#f1f1f1">Bank D</td>
                    <td align="center" bgcolor="#f1f1f1">13.75%</td>
                    <td align="center" bgcolor="#f1f1f1">Rs. 1,80,000</td>
                    <td bgcolor="#f1f1f1">Rs. 3,400</td>
                    <td align="center" bgcolor="#f1f1f1">Rs. 3,400</td>
                  </tr>
                </table>
              </div>
              <h3 class="text-center">Why Deal4loans.com - Widest Choice of Banks</h3>
              <div class="whyd4l">
                <ul>
                  <li>Business loans from <strong>2 lac – 50 Lac</strong></li>
                  <li>Compare <strong>Top 17 Banks</strong> for Eligibility, rates , Emi</li>
                  <li>Tenure From <strong>2 years – 7 years</strong>.</li>
                  <li>Instant Online Approval from  17 Banks.</li>
                  <li>Compare Rates from <strong>12.5% to 21%</strong>.</li>
                </ul>
              </div>
              <div class="clearfix"></div>
            </div>
            <h5>Best Business Loan Banks - <strong>ICICI Bank, Hdfc Bank, Fullerton India, RBL, Religare</strong> </h5>
            <div class="notification">
              <div class="col-xs-8 text-left"> Silicon Valley stalwarts from Google and Whatsapp back 
                financial technology firm Deal4Loans </div>
              <div class="col-md-4"><img src="images/the-economic-times.png"></div>
              <div class="clearfix"></div>
            </div>
            <h4>Loan quotes taken at Deal4loans <strong class="red-text">61</strong>,<strong class="blue-text">67</strong>, <strong class="sky-text">640</strong></h4>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
<div class="container">
  <div class="row">
    <div class="col-md-6"></div>
    <div class="col-md-6"></div>
  </div>
</div>
<hr>
<script src="js/jquery.min.js" type="text/javascript" ></script> 
<script src="js/bootstrap.min.js" type="text/javascript" ></script> 
<script type="text/javascript">
function chkbloan(Form)
{
	var btn2;
	var btn3;
	var myOption;
	var i;
var regMail = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9])+$/
var dt,mdate;dt=new Date();
var alpha=/^[a-zA-Z\ ]*$/;
var alphanum=/^[a-zA-Z0-9]*$/;
var num=/^[0-9]*$/;
var space=/^[\ ]*$/;
var iChars ="/@#$%^&*()+=-[]\\\';,.{}|\":<>?!";

if((Form.Name2.value==""))
{
	//alert("Kindly fill in your Name!");
	document.getElementById('nameVal2').innerHTML = "<span  class='hintanchor' style='color:#CC0000;'>Please Enter Your name</span>";		
	Form.Name2.focus();
	return false;
}
for (var i = 0; i < Form.Name2.value.length; i++) 
{
  	if (iChars.indexOf(Form.Name2.value.charAt(i)) != -1) 
	{
//		alert ("Name has special characters.\n Please remove them and try again.");
		document.getElementById('nameVal2').innerHTML = "<span  class='hintanchor' style='color:#CC0000;'>Name has special characters</span>";		
		Form.Name2.focus();
		return false;
  	}
}

if(Form.Phone2.value=='')
{
	//alert("Kindly fill in your Mobile Number!");
	document.getElementById('mobileVal2').innerHTML = "<span class='hintanchor' style='color:#CC0000;'>Enter Mobile Number</span>";
	Form.Phone2.focus();
	return false;
}
 else if(isNaN(Form.Phone2.value)|| Form.Phone2.value.indexOf(" ")!=-1)
		{
		  //alert("Enter numeric value in ");
		  document.getElementById('mobileVal2').innerHTML = "<span class='hintanchor' style='color:#CC0000;'>Enter Numeric Value</span>";
		  Form.Phone2.focus();
		  return false;  
		}
        else if (Form.Phone2.value.length < 10 )
		{
//		  alert("Please Enter 10 Digits"); 
		  document.getElementById('mobileVal2').innerHTML = "<span class='hintanchor'>Enter 10 Digits</span>";
		  Form.Phone2.focus();
		  return false;
        }
else if ((Form.Phone2.value.charAt(0)!="9") && (Form.Phone2.value.charAt(0)!="8") && (Form.Phone2.value.charAt(0)!="7"))
		{
                alert("The number should start only with 9 or 8 or 7");
				 document.getElementById('mobileVal2').innerHTML = "<span class='hintanchor' style='color:#CC0000;'>Start with 9 or 8 or 7</span>";
				 Form.Phone2.focus();
                return false;
        }
	if ((Form.City2.value=="") || (Form.City2.value=="Please Select"))
		{
			document.getElementById('CityVal').innerHTML = "<span  class='hintanchor'>Enter City to Continue!</span>";	
			Form.City2.focus();
			return false;
		}		
	
}
</script>
</body>
</html>
