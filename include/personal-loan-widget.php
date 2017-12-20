<div class="form-common-box">
    <h3><strong>Rs. 273,923 </strong>crores worth of Personal Loan Applications received! <span>(last updated on <?php echo date('d F Y'); ?>)</span></h3>
    <div class="form-main-wrapper">
        <div class="container container-full-width">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h3><?php echo $TagLine;?></h3>
                </div>
            </div>
            <form name="plfrm" id="plfrm" method="post" action="insert_personal_loan_value_step1.php">
                <input type="hidden" name="Type_Loan" value="<?php echo $TypeLoan;?>" />
    <input type="hidden" name="source" value="<?php echo $source;?>" />
    <input type="hidden" name="PostURL" value="<?php echo $PostURL;?>">
    <input type="hidden" name="section" value="BL16June15" />
                <div class="row panel1">
                    <div class="col-md-3">
                        <div class="form-label-text">Loan Amount</div>
                        <input name="Loan_Amount" id="Loan_Amount" maxlength="8" type="text" onkeyup="intOnly(this); getDigitToWords('Loan_Amount', 'formatedlA', 'wordloanAmount');" onblur="getDigitToWords('Loan_Amount', 'formatedlA', 'wordloanAmount');" onkeypress="intOnly(this);" autocomplete="off" >
                        <div id="loanAmtVal"></div>
                        <div id='formatedlA'></div>
                        <div id='wordloanAmount'></div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-label-text">Employment Status</div>
                        <label class="radio">
                            <input id="Employment_Status1"  type="radio" name="Employment_Status" value="1">
                            <span class="outer"><span class="inner"></span></span>Salaried</label>
                        <label class="radio">
                            <input id="Employment_Status2" type="radio" name="Employment_Status" class="self-employed-display" value="0">
                            <span class="outer"><span class="inner"></span></span>Self-Employed</label>
                    </div>
                    <div class="col-md-3">
                        <div class="form-label-text">City</div>
                        <select name="City" id="City" class="city_select custom_select">
                            <?=plgetCityList($City); ?>
                        </select>
                    </div>
                    <div class="col-md-3 remove-first button-mob-mr-tp-20" id="remove-submit-btn"><button type="submit"  id="submit_btn">Get Quote</button></div>
                </div>
                <div class="row salaried-box panel2" style="display:none;">
                    <div class="col-md-3">
                        <div class="form-label-text">Company Name</div>
                        <input name="Company_Name" id="Company_Name" type="text" class="form-input" onkeyup="ajax_showOptions(this, 'getCountriesByLetters', event, 'http://www.deal4loans.com/ajax-list-plcompanies.php')" autocomplete="off" >
                        <div id="companyNameVal"></div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-label-text">Annual Income</div>
                        <input type="text" name="IncomeAmount" id="IncomeAmount" autocomplete="off" onkeyup="intOnly(this); getDiToWordsIncome('IncomeAmount', 'formatedIncome', 'wordIncome');" onkeypress="intOnly(this);" onblur="getDiToWordsIncome('IncomeAmount', 'formatedIncome', 'wordIncome');">
                        <div id='formatedIncome'></div>
                        <div id='wordIncome'></div>        
                    </div>


                    <div class="col-md-3 second_button_remove button-mob-mr-tp-20"><button type="submit" class="no-tp-mr" id="submit_btn2">Get Quote</button></div>
                </div>


                <div class="row self-employed-box panel4" style="display:none;">
                    <div class="col-md-3">
                        <div class="form-label-text">You Are Running Business Since ?</div>
                        <div><label class="radio">
                                <input id="running_business1" type="radio" name="Total_Experience" value="1" class="radio-display">
                                <span class="outer"><span class="inner"></span></span>Less Than 2 Yrs</label>
                            <label class="radio">
                                <input id="running_business2" type="radio" name="Total_Experience" class="radio-display" value="2.5">
                                <span class="outer"><span class="inner"></span></span>2 To 3 Yrs</label>
                        </div>
                        <div><label class="radio">
                                <input id="running_business3" type="radio" name="Total_Experience" class="radio-display" value="4">
                                <span class="outer"><span class="inner"></span></span>3 To 5 Yrs</label> <label class="radio">
                                <input id="running_business4" type="radio" name="Total_Experience" class="radio-display" value="5">
                                <span class="outer"><span class="inner"></span></span>5 Yrs & Above</label></div>
                    </div>
                    <div class="col-md-3 radio-display-box" style="display:none;">
                        <div class="form-label-text">Your Annual Income/ ITR</div>
                        <div><label class="radio">
                                <input id="IncomeAmount1" type="radio" name="IncomeAmount" class="radio-display2" value="200000" />
                                <span class="outer"><span class="inner"></span></span>Upto 2 Lacs</label>
                            <label class="radio">
                                <input id="IncomeAmount2" type="radio" name="IncomeAmount" class="radio-display2" value="250000">
                                <span class="outer"><span class="inner"></span></span>2 To 3 Lacs</label>
                        </div>
                        <div><label class="radio">
                                <input id="IncomeAmount3" value="450000" type="radio" name="IncomeAmount" class="radio-display2">
                                <span class="outer"><span class="inner"></span></span>3 To 5 Lacs</label>
                            <label class="radio">
                                <input id="IncomeAmount4" type="radio" value="550000" name="IncomeAmount" class="radio-display2">
                                <span class="outer"><span class="inner"></span></span>5 Lacs & Above</label>
                        </div>

                    </div>
                    <div class="col-md-3 radio-display-box2" style="display:none;">
                        <div class="form-label-text">Annual Turnover For Your Business</div>
                        <div><label class="radio">
                                <input id="Annual_Turnover1" type="radio" name="Annual_Turnover" value="1" class="radio-display3">
                                <span class="outer"><span class="inner"></span></span>Upto 50 Lacs</label>
                            <label class="radio">
                                <input id="Annual_Turnover2" type="radio" name="Annual_Turnover" value="2" class="radio-display3">
                                <span class="outer"><span class="inner"></span></span>50 Lacs To 1 Cr</label>
                        </div>
                        <div><label class="radio">
                                <input id="Annual_Turnover3" type="radio" name="Annual_Turnover" value="3" class="radio-display3">
                                <span class="outer"><span class="inner"></span></span>1 Cr To 3 Crs	</label>
                            <label class="radio">
                                <input id="Annual_Turnover4" type="radio" name="Annual_Turnover" value="4" class="radio-display3">
                                <span class="outer"><span class="inner"></span></span>3 Crs & Above</label>
                        </div>
                    </div>

                    <div class="col-md-3 radio-display-box3" style="display:none;">
                        <div class="form-label-text">Any Existing Loan</div>
                        <div><label class="radio">
                                <input id="Existing_Loan1" type="radio" value="1" name="Existing_Loan" class="existing_loan">
                                <span class="outer"><span class="inner"></span></span>Yes</label>
                            <label class="radio">
                                <input id="Existing_Loan2" type="radio" value="2" name="Existing_Loan" class="no_existing_loan">
                                <span class="outer"><span class="inner"></span></span>No</label>
                        </div>
                    </div>
                    <div class="col-md-3 second_button_remove button-mob-mr-tp-20"><button type="submit" class="no-tp-mr" id="submit_btn4">Get Quote</button></div>
                </div>

                <div class="row existing_loan_display panel5 mr-tp20" style="display:none;">
                    <div class="col-md-3 loan_type" style="display:none;">
                        <div class="form-label-text">Loan Type</div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="checkbox">
                                    <label> <input type="checkbox" class="loan_type" name="Loan_Any" id="Loan_Type1" value="cl" /> <span>Auto Loan</span> </label></div>
                                <div class="checkbox">
                                    <label> <input type="checkbox" class="loan_type" name="Loan_Any" id="Loan_Type2" value="hl" /> <span>Home Loan</span> </label></div>
                            </div>
                            <div class="col-md-6">
                                <div class="checkbox">
                                    <label> <input type="checkbox" class="loan_type" id="Loan_Type3" name="Loan_Any" value="odl" /> <span>Over Draft Loan</span> </label></div>
                                <div class="checkbox">
                                    <label> <input type="checkbox" class="loan_type" id="Loan_Type4" name="Loan_Any" value="other" /> <span>Other</span> </label></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 emi_paid_display" style="display:none;">
                        <div class="form-label-text">EMIs Paid</div>
                        <div><label class="radio">
                                <input id="Emi_Paid1" type="radio" name="EMI_Paid" class="emi_paid" value="1" />
                                <span class="outer"><span class="inner"></span></span>0 To 6</label>
                            <label class="radio">
                                <input id="Emi_Paid2" type="radio" name="EMI_Paid" class="emi_paid" value="2">
                                <span class="outer"><span class="inner"></span></span>6 To 9</label></div>
                        <div><label class="radio">
                                <input id="Emi_Paid3" type="radio" name="EMI_Paid" class="emi_paid" value="3">
                                <span class="outer"><span class="inner"></span></span>9 To 12</label>
                            <label class="radio">
                                <input id="Emi_Paid4" type="radio" name="EMI_Paid" class="emi_paid" value="4">
                                <span class="outer"><span class="inner"></span></span>More than 12</label></div>
                    </div>

                    <div class="col-md-2 anycreditcard_main_display mr-tp20">
                        <div class="form-label-text">Any Credit Card</div>
                        <label class="radio">
                            <input id="CC_Holder1" type="radio" name="CC_Holder" class="holding-credit-card" value="1">
                            <span class="outer"><span class="inner"></span></span>Yes</label>
                        <label class="radio">
                            <input id="CC_Holder2" type="radio" name="CC_Holder" class="no-holding-credit-card" value="0">
                            <span class="outer"><span class="inner"></span></span>No</label>
                    </div>

                    <div class="col-md-4 holding-credit-card-display" style="display:none;">
                        <div class="form-label-text">Holding This Credit Card Since</div>
                        <div>
                            <label class="radio">
                                <input id="Card_Vintage1" type="radio" value="1" name="Card_Vintage" class="card_holding_duration">
                                <span class="outer"><span class="inner"></span></span>0 To 6 Months</label>
                            <label class="radio">
                                <input id="Card_Vintage2" type="radio" value="2" name="Card_Vintage" class="card_holding_duration">
                                <span class="outer"><span class="inner"></span></span>6 To 9 Months</label>
                        </div>
                        <div>
                            <label class="radio">
                                <input id="Card_Vintage3" type="radio" name="Card_Vintage" value="3" class="card_holding_duration">
                                <span class="outer"><span class="inner"></span></span>9 To 12 Months</label>
                            <label class="radio">
                                <input id="Card_Vintage4" type="radio" name="Card_Vintage" value="4" class="card_holding_duration">
                                <span class="outer"><span class="inner"></span></span>More Than 12 Months</label>
                        </div>
                    </div>

                    <div class="col-md-3 tp-mr23 third_btn_remove button-mob-mr-tp-20"><button type="submit" id="submit_btn5">Get Quote</button></div>
                </div>

                <div class="row personal_details_display_first panel3" style="display:none;">
                    <div class="col-md-12 details_text">Personal Details</div>
                    <div class="col-md-12 privacy_text"><i class="fa fa-lock" aria-hidden="true"></i> Your Information is secure with us and will not be shared without your consent</div>
                    <div class="col-md-3">
                        <div class="form-label-text">Name</div>

                        <input name="Name" id="Name" type="text" class="form-input" autocomplete="off">
                    </div>
                    <div class="col-md-3">
                        <div class="form-label-text">E-Mail ID</div>
                        <input name="Email" id="Email" type="text" class="form-input"  autocomplete="off">
                    </div>
                    <div class="col-md-3">
                        <div class="form-label-text">Mobile Number</div>
                        <input name="Phone" id="Phone" maxlength="10" onkeyup="intOnly(this);" onkeypress="intOnly(this)" onchange="intOnly(this);" type="text" class="form-input" autocomplete="off">                                            </div>

                    <div class="col-md-3">
                        <div class="form-label-text">Age</div>
                        <select class="select" name="Age" id="Age">
                            <option value="">Select Age</option>
                            <?php for($a=18;$a<=65;$a++) {?><option value="<?php echo $a;?>"><?php echo $a;?></option><?php }?>
                        </select>
                    </div>

                    <div class="clearfix"></div>

                    <div class="col-md-3 mr-tp20 second-card-hide">
                        <div class="form-label-text">Any Credit Card</div>
                        <label class="radio">
                            <input id="CC_Holder" type="radio" name="CC_Holder" class="first_holding_credit-card" value="1">
                            <span class="outer"><span class="inner"></span></span>Yes</label>
                        <label class="radio">
                            <input id="CC_Holder2" type="radio" name="CC_Holder" class="first_no_credit-card" value="0" checked>
                            <span class="outer"><span class="inner"></span></span>No</label>
                    </div>

                    <div class="col-md-4 mr-tp20 first_holding_credit-card-display" style="display:none;">
                        <div class="form-label-text">Holding This Credit Card Since</div>
                        <div>
                            <label class="radio">
                                <input id="running_business2" type="radio" name="Card_Vintage" value="1">
                                <span class="outer"><span class="inner"></span></span>0 To 6 Months</label>
                            <label class="radio">
                                <input id="running_business2" type="radio" name="Card_Vintage" value="2">

                                <span class="outer"><span class="inner"></span></span>6 To 9 Months</label>
                        </div>
                        <div>
                            <label class="radio">
                                <input id="running_business2" type="radio" name="Card_Vintage" value="3">
                                <span class="outer"><span class="inner"></span></span>9 To 12 Months</label>
                            <label class="radio">
                                <input id="running_business2" type="radio" name="Card_Vintage" value="4">
                                <span class="outer"><span class="inner"></span></span>More Than 12 Months</label>
                        </div>
                    </div>

                    <div class="col-md-3 mr-tp20 residence_status">
                        <div class="form-label-text">Residence Status</div>
                        <div>
                            <label class="radio">
                                <input id="Residence_Status1" type="radio" name="Residential_Status" value="1" />
                                <span class="outer"><span class="inner"></span></span>Owned</label>
                            <label class="radio">
                                <input id="Residence_Status2" type="radio" name="Residential_Status" value="0" />
                                <span class="outer"><span class="inner"></span></span>Rented</label>
                        </div>
                    </div>

                    <div class="col-md-3 mr-tp20 office_status">
                        <div class="form-label-text">Office Status</div>
                        <div>
                            <label class="radio">
                                <input id="Office_Status1" type="radio" name="Office_Status" value="1" />
                                <span class="outer"><span class="inner"></span></span>Owned</label>
                            <label class="radio">
                                <input id="Office_Status2" type="radio" name="Office_Status" value="0" />
                                <span class="outer"><span class="inner"></span></span>Rented</label>
                        </div>
                    </div>

                    <div class="clearfix"></div>
                    <div class="col-md-10">
                        <div class="checkbox">
                            <label> <input type="checkbox" class="emi_paid custom_checkbox" name="accept"/><span class="privacy_text">I authorize Deal4loans.com & its <a href="http://www.deal4loans.com/pl-partnering-banks.php" target="_blank" rel="nofollow" style="text-decoration:underline!important; color:#FFF;"> partnering banks</a> to contact me to explain the product & I Agree to Privacy policy and Terms and Conditions.</span> </label></div>
                    </div>
                    <div class="col-md-2"> <button type="submit" id="submit_btn3" class="no-tp-mr" data-loading-text="Submitting...">Get Quote</button></div>
                </div>
            </form>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="partner-logos"><img src="images/icici-bank-logo-pl.png" alt="ICICI Bank"></div>
                <div class="partner-logos"><img src="images/kotak-logo-pl.png" alt="Kotak Bank"></div>
                <div class="partner-logos"><img src="images/bajajfinserv-logo-pl.png" alt="Kotak Bank"></div>
                <div class="partner-logos"><img src="images/standrad-chartered-pl.png" alt="Standrad Chartered"></div>
                <div class="partner-logos"><img src="images/hdfc-logo-pl.png" alt="HDFC"></div>
                <div class="partner-logos"><img src="images/fullorton-pl-logo.png" alt="Fullorton"></div>
                <div class="partner-logos"><img src="images/tata-capital-logo-pl.png" alt="Fullorton"></div>
                <div class="partner-logos"><img src="images/indusind-logo-pl.png" alt="Indusind"></div>
            </div>
        </div>
    </div>
</div>