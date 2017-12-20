<?php
require 'scripts/db_init.php';
require 'scripts/functions.php';
?>
<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Simply Spend.Simply Save.</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW"> <!--Remove tag when live page-->
        <link href="css/materialize.min.css" type="text/css" rel="stylesheet" />
        <link href="css/sbi-cc-styles.css" type="text/css" rel="stylesheet" />
        
    </head>
    <body>
        <div class="pd-top-bottom-10 white">
            <div class="container">
                <div class="row mr-no-btn">
                    <div class="col s12 m12"> <img src="images/sbi-logo.jpg" alt="logo" class="responsive-img" /> </div>
                </div>
            </div>
        </div>
        <header class="sbi_cc_header">
            <div class="container">
                <div class="row mr-no-btn">
                    <div class="col m9 s12 pd-top-25">
                        <h1>Simply Spend. Simply Save</h1>
                        <h2>Presenting the SimplySAVE SBI Card.</h2>
                    </div>
                    <div class="col m3 s12 center-align"><img src="images/sbi-simply-save.png" class="responsive-img center-align" alt="SBI Simply Save" /></div>
                </div>
                <div class="row mr-no-btn">
                    <div class="col m12 s12">
                        <div class="dark-blue-box center-align"><span>&bull;</span> 10 times rewards* points on Dinning , Grocery and movie spends <span class="pd-left-16">&bull;</span> Annual Fee Reversal</div>
                    </div>
                </div>
            </div>
        </header>
        <section>
            <div class="container">
                <div class="row mr-no-btn">
                    <div class="col s12 m12">
                        <div class="card pd-20">
                            <div class="row">
                                <div class="col s12 m8">
                                    <div class="form-box">
                                        <form method="post" name="SssFrm" action="" id="formValidate" onSubmit="return sssFormValidate(document.SssFrm);">
                                            Do you already have an SBI Credit Card? 
                                            <!-- Modal Structure -->
                                            <div id="modal1" class="modal">
                                                <div class="right-align col s12 pd-top-16"><a class="modal-action modal-close cross-btn">X</a></div>
                                                <div class="modal-content">

                                                    <p class="center-align">Thanks You showing interest in SBI credit card, as you are already a SBI Credit Card Holder, we may not be able to service your request for another SBI Credit Card through our platform.</p>
                                                </div>

                                            </div>
                                            <input name="group1" type="radio" id="yes" data-target="modal1" />
                                            <label for="yes">Yes</label>
                                            <input name="group1" type="radio" id="no" />
                                            <label for="no">No</label>
                                            <h2>Personal Information</h2>
                                            <div class="row">
                                                <div class="input-field col s12">
                                                    <input placeholder="Enter Name" id="first_name" name="first_name" aria-required="true" type="text" class="validate" onkeydown="validateDiv('FirstnameVal');"onKeyPress="return isCharsetKey(event);" >
                                                    <label for="first_name">First Name</label>
                                                </div>
                                                <div id="FirstnameVal"></div>
                                            </div>

                                            <div class="row">
                                                <div class="input-field col s12">
                                                    <input placeholder="Enter Email id" id="Email" type="text" name="Email" class="validate" onkeydown="validateDiv('EmailVal');">
                                                    <label for="Email">Email id</label>
                                                </div>
                                                <div id="EmailVal"></div>
                                            </div>

                                            <div class="row">
                                                <div class="input-field col s12">
                                                    <select id="City" name="City"  onchange="validateDiv('CityVal');">
                                                        <option value="" disabled selected>Select City</option>
                                                        <?= plgetCityList($City) ?>
                                                    </select>
                                                    <label for="City">City</label>
                                                </div>
                                                <div id="CityVal"></div>
                                            </div>
                                            <div class="row">
                                                <div class="input-field col s12">
                                                    <select id="IncomeAmount" name="IncomeAmount" onchange="validateDiv('IncomeAmountVal');">
                                                        <option value="" disabled selected>Select</option>
                                                        <option value="1">Upto 3 Lakh</option>
                                                        <option value="1">3 to 6 Lacs</option>
                                                        <option value="1">6 to 9 Lacs</option>
                                                        <option value="1">9 to 12 Lacs</option>
                                                        <option value="1">12 to 15 Lacs</option>
                                                        <option value="1"> 15 Lac & Above</option> 

                                                    </select>


                                                    <label for="IncomeAmount">Annual Income</label>
                                                </div>
                                                <div id="IncomeAmountVal"></div>
                                            </div>
                                            <div class="row">
                                                <div class="col s6 m9">
                                                <div class="input-field">
                                                    <input placeholder="XXX" id="Phone" name="Phone" type="text" aria-required="true" class="validate" onkeydown="validateDiv('PhoneVal');" onKeyPress="return numOnly(event);" maxlength="10">
                                                    <label for="Phone">Mobile no</label>
                                                </div>
                                                    </div>
                                                <div class="col s6 m3">
                                                <div class="input-field">
                                                    <input name="GenearateOTP" type="button" class="gent-otp-btn" id="GenearateOTP" value="Generate OTP" onclick="return ShowOTPField(event)" maxlength="7">

                                                </div>
                                                <div id="PhoneVal"></div>
                                            </div>
                                            </div>
                                            <div style="display: none;" id="ShowOTPField">
                                                <div class="row">
                                                    <div class="input-field col s6 m9">
                                                        <input placeholder="Enter OTP" id="otp" name="otp" aria-required="true" type="text" class="validate" onkeydown="validateDiv('OTPVal');" maxlength="6">
                                                        <label for="otp">OTP</label>
                                                    </div>
                                                    <div class="input-field col s6 m3">
                                                        <input name="" type="button" class="gent-otp-submit" value="Submit" onclick="return ShowPersonalInfoField(event)">
                                                    </div>
                                                    <div id="OTPVal"></div>
                                                </div>
                                            </div>


                                            <div id="personalInfo" style="display: none">
                                                <!--- 
                                                 <div class="row">
                                                     <div class="right-align col s12 optsucess-msg">OTP Validation Successful</div>
                                                 </div>-->
                                                <h2>Personal Information</h2>
                                                <div class="row">
                                                    <div class="input-field col s12">
                                                        <input type="date" name="dob" id="dob" class="datepicker no-bottom-margin" placeholder="Date of Birth" aria-required="true" onchange="validateDiv('dobVal');" >
                                                        <label for="dob">Date of Birth</label>
                                                    </div>
                                                    <div id="dobVal"></div>
                                                </div>
                                                <div class="row">
                                                    <div class="input-field col s12">
                                                        <select id="qualification" name="qualification" onchange="validateDiv('qualificationVal');">
                                                            <option value="" disabled selected>Select</option>
                                                            <option value="1">Metric or Below</option>
                                                            <option value="2">Higher Secondary</option>
                                                            <option value="3">Graduate</option>
                                                            <option value="4">Post Graduate and Above</option>
                                                        </select>
                                                        <label for="qualification">Qualification</label>
                                                    </div>
                                                    <div id="qualificationVal"></div>
                                                </div>
                                                <div class="row">
                                                    <div class="col s12">
                                                        <div>Gender</div>
                                                        <input name="Gender" type="radio" id="male" aria-required="true" class="validate" onchange="validateDiv('GenderVal');" />
                                                        <label for="male">Male</label>
                                                        <input name="Gender" type="radio" id="female" aria-required="true" class="validate" onchange="validateDiv('GenderVal');" />
                                                        <label for="female">Female</label>
                                                    </div>
                                                    <div id="GenderVal"></div>
                                                </div>
                                                <div class="row">
                                                    <div class="input-field col s12">
                                                        <select id="occupation" name="occupation" onchange="validateDiv('empStatusVal');"> 
                                                            <option value="-1" disabled selected>Select</option>

                                                            <option value="1">Salaried</option>
                                                            <option value="2">Self- employed</option>
                                                            <option value="3">Housmaker</option>
                                                            <option value="4">Retired/pensioner</option>
                                                            <option value="5">Student</option>
                                                        </select>
                                                        <label for="occupation">Occupation</label>
                                                    </div>
                                                    <div id="empStatusVal"></div>
                                                </div>
                                                <div class="row">
                                                    <div class="input-field col s12">
                                                        <input placeholder="Enter Company Name" id="Company_Name" name="Company_Name" type="text" class="validate" aria-required="true" onkeydown="validateDiv('companyNameVal');">
                                                        <label for="Company_Name">Company Name</label>
                                                    </div>
                                                    <div id="companyNameVal"></div>
                                                </div>

                                                <div class="row">
                                                    <div class="input-field col s12">
                                                        <select id="NatureOfCompany" name="NatureOfCompany" onchange="validateDiv('NatureOfCompanyVal');">
                                                            <option value="" disabled selected>Choose your option</option>
                                                            <option value="1">Medical</option>
                                                            <option value="2">Retaling/Trading (Export/Import)</option>
                                                            <option value="3">Retaling/Trading (Domestic)</option>
                                                            <option value="4">Textiles</option>
                                                            <option value="5">Transportation</option>
                                                            <option value="6">Enginerring/Fabrication</option>
                                                            <option value="7">Hospitality/Hotel</option>
                                                            <option value="8">Others</option>
                                                            <option value="9">Service Industry</option>
                                                            <option value="10">Real Estate</option>
                                                            <option value="11">Media</option>
                                                            <option value="12">IT Software Development</option>
                                                            <option value="13">Advertising/Marketing Research</option>
                                                            <option value="14">Verification/Collection Agency</option>
                                                            <option value="15">Government Ministry</option>
                                                            <option value="16">Construction</option>
                                                            <option value="17">IT Non Software</option>
                                                            <option value="18">Manufacturing</option>
                                                            <option value="19">Auto Sales - Old Cars</option>
                                                            <option value="20">Auto Sales - New Cars</option>
                                                            <option value="21">Publishing</option>
                                                            <option value="22">Freelancer</option>
                                                            <option value="23">NGO</option>
                                                            <option value="24">DSA/DST</option>
                                                            <option value="25">Security Staffing Agencies</option>
                                                            <option value="26">HR Placement Consultant</option>
                                                            <option value="27">Banking/Finance/NBFC</option>
                                                            <option value="28">Travel/Tourism Agencies</option>
                                                        </select>
                                                        <label for="NatureOfCompany">Nature of company</label>
                                                    </div>
                                                    <div id="NatureOfCompanyVal"></div>
                                                </div>

                                                <div class="row">
                                                    <div class="input-field col s12">
                                                        <input placeholder="designation" id="designation" name="designation" type="text" class="validate" onkeydown="validateDiv('designationVal');">
                                                        <label for="designation">Designation</label>
                                                    </div>
                                                    <div id="designationVal"></div>
                                                </div>
                                                <div class="row">
                                                    <div class="input-field col s12">
                                                        <input placeholder="Placeholder" id="CurrentEmployment" name="CurrentEmployment" type="text" class="validate" onkeydown="ShowOtherInfoField(event); validateDiv('CurrentEmploymentVal');" onKeyPress="return numOnly(event);" maxlength="2">
                                                        <label for="CurrentEmployment">Years at Current employment</label>
                                                    </div>
                                                    <div id="CurrentEmploymentVal"></div>
                                                </div>
                                            </div>
                                            <div id="OtherInfo" style="display: none">
                                                <h2>Other Information</h2>
                                                <div class="row">
                                                    <div class="input-field col s12">
                                                        <input placeholder="ABCDE 1234 Q" id="pancard" name="pancard" type="text" class="validate" onkeydown="validateDiv('pancardVal');" maxlength="10">
                                                        <label for="pancard">Pancard Number</label>
                                                    </div>
                                                    <div id="pancardVal"></div>
                                                </div>
                                                <div class="row">
                                                    <div class="input-field col s12">
                                                        <input placeholder="Enter your address" id="residence_address" name="residence_address" type="text" class="validate" onkeydown="validateDiv('residenceAddressVal');" onKeyPress="return isSpecialChar(event);">
                                                        <label for="residence_address">Residence address <span class="grey-text">(Line 1)</span></label>
                                                    </div>
                                                    <div id="residenceAddressVal"></div>
                                                </div>

                                                <div class="row">
                                                    <div class="input-field col s12">
                                                        <input placeholder="Enter your address" id="residence_address2" name="residence_address2" type="text" class="validate" onKeyPress="return isSpecialChar(event);">
                                                        <label for="residence_address2">Residence address <span class="grey-text">(Line 2)</span></label>
                                                    </div></div>
                                                <div class="row">
                                                    <div class="input-field col s12">
                                                        <select id="Residencecity" name="Residencecity" onchange="validateDiv('ResidencecityVal');">
                                                            <option value="" disabled selected>Choose your option</option>
                                                            <?= plgetCityList($City) ?>
                                                        </select>
                                                        <label for="city">City</label>
                                                    </div>
                                                    <div id="ResidencecityVal"></div>
                                                </div>
                                                <div class="row">
                                                    <div class="input-field col s12">
                                                        <input placeholder="Enter Pincode" id="pincode" name="pincode" type="text" class="validate" onkeydown="validateDiv('pincodeVal');" onKeyPress="return numOnly(event);" maxlength="6">
                                                        <label for="pincode">Pincode</label>
                                                    </div>
                                                    <div id="pincodeVal"></div>
                                                </div>
                                                <div class="row">
                                                    <div class="input-field col s12">
                                                        <input placeholder="Enter your address" aria-required="true" id="office_address" name="office_address" type="text" class="validate" onkeydown="validateDiv('officeAddressVal');" onKeyPress="return isSpecialChar(event);">
                                                        <label for="office_address">Office address <span class="grey-text">(Line 1)</span></label>
                                                    </div>
                                                    <div id="officeAddressVal"></div>
                                                </div>
                                                <div class="row">
                                                    <div class="input-field col s12">
                                                        <input placeholder="Enter your address" id="office_address2" name="office_address2" type="text" class="validate" onKeyPress="return isSpecialChar(event);">
                                                        <label for="office_address2">Office address <span class="grey-text">(Line 2)</span></label>
                                                    </div></div>
                                                <div class="row">
                                                    <div class="input-field col s12">
                                                        <select id="Officecity" name="Officecity" onchange="validateDiv('OfficecityVal');">
                                                            <option value="" disabled selected>Choose your option</option>
                                                            <?= plgetCityList($City) ?>
                                                        </select>
                                                        <label for="office_city">City</label>
                                                    </div>
                                                    <div id="OfficecityVal"></div>
                                                </div>
                                                <div class="row">
                                                    <div class="input-field col s12">
                                                        <input placeholder="Enter Pincode" id="office_pincode" name="office_pincode" type="text" class="validate" onkeydown="validateDiv('officePincodeVal');" onKeyPress="return numOnly(event);" maxlength="6">
                                                        <label for="office_pincode">Pincode</label>
                                                    </div>
                                                    <div id="officePincodeVal"></div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col s12"><input type="checkbox" id="terms" name="terms" onchange="validateDiv('termsVal');">
                                                    <label for="terms" class="tc">I have read Customer Declaration of SBI Card and understood all its terms and conditions. I confirm that the details given above belong to me and authorize SBICPSL and its affiliates / associates and CPP* to contact me on the details provided to provide further information about the SBI Card and the card protection plan.
                                                        <br> <br>I also provide my consent to verify the information provided in the application form with the credit bureau. I agree to pay Rs. 499 as joining fee and Rs. 499 as annual fee associated with this card.<br>
                                                        *CPP Assistance Services Private Limited
                                                    </label></div>
                                                <div id="termsVal"></div>
                                            </div>
                                            <div class="row">
                                                <div class="col s12 center-align">
                                                    <button type="submit" class="waves-effect waves-light btn blue waves-input-wrapper guote-btn">Submit</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="col m4 s12 features-mr-top25">
                                    <div class="card">
                                        <div class="gift-box"><img src="images/gift_box.png" alt="Gift" /></div>
                                        <div class="benefits-box center-align">Benifits with your Simply Save Sbi Cards</div>
                                        <div class="features-main">
                                            <ul class="features-text">
                                                <li>Get 2,000 bonus Reward Points on Spends of Rs. 2,000 or more in first 60 days</li>
                                                <li>Get annual membership fee reversal from second year of your subscriptio</li>
                                                <li>Enjoy up to 2.5% value back, as you get 10X Reward Points per Rs. 100 spent at all Departmental and Grocery stores</li>
                                                <li>1 % Fuel Surcharge Waiver across all petrol pumps</li>
                                            </ul>
                                            <hr>
                                            <p><span>Annual fee:</span> Nil, if the total purchases made by you in the previous year >= Rs. 90,000. Else, an annual fee of Rs. 499 is charged annually</p>
                                            <p><span>Joining fee, one time:</span>Joining fee, one time: Rs. 499, Service Tax, as applicable</p>
                                            <p><span>Add-on fee, Nil</span></p>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row"></div>
                    </div>
                </div>
            </div>
        </section>
        <script src="https://code.jquery.com/jquery-2.1.4.min.js"></script> 
        <script src="js/materialize.js" type="text/javascript"></script> 
        <script src="js/materialize.min.js" type="text/javascript"></script>
        <script src="js/sbi-cards.js" type="text/javascript"></script> 
        <script>
            $(document).ready(function () {
                $("#Phone").keypress(function () {
                    $("#GenearateOTP").addClass("gent-otp-submit");
                });
            });
        </script>
        <script type="text/javascript">
                                                    $(document).ready(function () {
                                                        // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
                                                        $('.modal').modal();
                                                    });

                                                    $('.datepicker').pickadate({
                                                        selectMonths: true, // Creates a dropdown to control month
                                                        selectYears:-60, // Creates a dropdown of 15 years to constrol year
                                                        format: 'yyyy-mm-dd'
                                                    });

                                                    $(document).ready(function () {
                                                        $('select').material_select();
                                                    });
        </script>
    </body>
</html>