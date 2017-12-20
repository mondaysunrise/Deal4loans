<?php
require 'scripts/db_init.php';
require 'scripts/functions.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
	//echo '<pre>';print_r($_POST);//exit;
	$Dated=ExactServerdate();
	$source = "simply_save_cards_apply";
	$section = isset($_POST["section_value"]) ? $_POST["section_value"] : '';
	//$source = isset($_POST["source"]) ? $_POST["source"] : 'simply_save_cards_apply';
	$group1 = isset($_POST["group1"]) ? $_POST["group1"] : 'no';
	
	$IncomeAmount = isset($_POST["IncomeAmount"]) ? $_POST["IncomeAmount"] : '';
	$occupation = isset($_POST["occupation"]) ? $_POST["occupation"] : '';
	$City = isset($_POST["City"]) ? $_POST["City"] : '';
	$Company_Name = isset($_POST["Company_Name"]) ? $_POST["Company_Name"] : '';
	$first_name = isset($_POST["first_name"]) ? $_POST["first_name"] : '';
	$Email = isset($_POST["Email"]) ? $_POST["Email"] : '';
	$dob = isset($_POST["dob"]) ? $_POST["dob"] : '';
	$Phone = isset($_POST["Phone"]) ? $_POST["Phone"] : '';
	
	$otp = isset($_POST["otp"]) ? $_POST["otp"] : '';
	
	$qualification = isset($_POST["qualification"]) ? $_POST["qualification"] : '';
	$Gender = isset($_POST["Gender"]) ? $_POST["Gender"] : '';
	$NatureOfCompany = isset($_POST["NatureOfCompany"]) ? $_POST["NatureOfCompany"] : '';
	$designation = isset($_POST["designation"]) ? $_POST["designation"] : '';
	$CurrentEmployment = isset($_POST["CurrentEmployment"]) ? $_POST["CurrentEmployment"] : '';
	$pancard = isset($_POST["pancard"]) ? $_POST["pancard"] : '';
	$residence_address = isset($_POST["residence_address"]) ? $_POST["residence_address"] : '';
	$residence_address2 = isset($_POST["residence_address2"]) ? $_POST["residence_address2"] : '';
	$Residencecity = isset($_POST["Residencecity"]) ? $_POST["Residencecity"] : '';
	$pincode = isset($_POST["pincode"]) ? $_POST["pincode"] : '';
	$office_address = isset($_POST["office_address"]) ? $_POST["office_address"] : '';
	$office_address2 = isset($_POST["office_address2"]) ? $_POST["office_address2"] : '';
	$Officecity = isset($_POST["Officecity"]) ? $_POST["Officecity"] : '';
	$office_pincode = isset($_POST["office_pincode"]) ? $_POST["office_pincode"] : '';
	$terms = isset($_POST["terms"]) ? $_POST["terms"] : '';

	$RequestID = isset($_POST["RequestID"]) ? $_POST["RequestID"] : '';
	$cc_bankid = isset($_POST["cc_bankid"]) ? $_POST["cc_bankid"] : '';
	$cc_bankname = isset($_POST["cc_bankname"]) ? $_POST["cc_bankname"] : '';
	
	//Save User Data and generate OTP on click of Generate OTP Button
	if($_POST['request_from'] == 'saveUserData'){
		//Code to check if mobile number already exist for particular time interval in database
		$tomorrow  = mktime(0, 0, 0, date("m")  , date("d")-30, date("Y"));
		$days30date=date('Y-m-d',$tomorrow);
		$days30datetime = $days30date." 00:00:00";
		$currentdate= date('Y-m-d');
		$currentdatetime = date('Y-m-d')." 23:59:59";
		
		//$dob_year = mktime(0, 0, 0, date("m")  , date("d"), date("Y")-22);
		//$dob_default = date('Y-m-d',$dob_year);
		//$CurrentEmployment_deafult = 1;
		$getdetails="SELECT RequestID, Updated_Date FROM Req_Credit_Card WHERE (Mobile_Number='".$Phone."' AND Mobile_Number NOT IN ('9811555306','9971396361','9811215138','9999047207','9873678914','9999570210','9555060388','9311773341','8447380827') AND Updated_Date BETWEEN '".$days30datetime."' AND '".$currentdatetime."') ORDER BY RequestID DESC";
		list($alreadyExist,$myrow)=Mainselectfunc($getdetails,$array = array());
		if($alreadyExist>0){
			$showDate = date("d M, Y",strtotime($myrow['Updated_Date']));
			$errmsg = "You have already applied with us for Credit Card on $showDate. Your application is under process. You will hear from our team to process your application.";
			$errcode = 1;
		}
		else {
			$OtpVal = mt_rand(100000,999999);
			//$SMSMessage = "Please use this code: $OtpVal to activate you loan request at deal4loans.com";
			$SMSMessage = "Please use this code: " . $OtpVal . "  to activate you loan request at deal4loans.com";
			SendSMSforLMS($SMSMessage,$Phone);
			
			if(empty($RequestID)){
				//Insert entry in Req_Credit_card table
				$form_step=1;
				$InsertProductArr = array("Net_Salary"=>$IncomeAmount, "Employment_Status"=>$occupation, "City"=>$City, "Company_Name"=>$Company_Name, "Name"=>$first_name, "Email"=>$Email, "DOB"=>$dob, "Mobile_Number"=>$Phone, "Reference_Code"=>$OtpVal, "Dated"=>$Dated, "source"=>$source,"Updated_Date"=>$Dated, "applied_card_name"=>'SBI SimplySave', "Section"=>$section, "form_step"=>$form_step);
				$RequestID = Maininsertfunc("Req_Credit_Card", $InsertProductArr);
				
				$getSBISql = "select City, Query from Bidders_List where BidderID = 5633 and Restrict_Bidder=1";
				list($alreadyExistSBI,$getSBIRows)=Mainselectfunc($getSBISql,$array = array());
				if($alreadyExistSBI>0)
				{
					$CitySBI = $getSBIRows['City'];
					$CityListSBI =  str_replace(",", "', '", $CitySBI);
					$sqlSBI =  $getSBIRows['Query']." and Req_Credit_Card.RequestID='".$RequestID."' and  Req_Credit_Card.City in ('".$CityListSBI."')";
					list($numRowsSBI,$getSBIRow)=Mainselectfunc($sqlSBI,$array = array());
					if($numRowsSBI>0)
					{
						$insertFeedbackArr = array("AllRequestID"=>$RequestID, "BidderID"=>5633, "Reply_Type"=>4, "Allocation_Date"=>$Dated);
						Maininsertfunc("Req_Feedback_Bidder1", $insertFeedbackArr);
						Maininsertfunc("Req_Feedback_Bidder_CC", $insertFeedbackArr);
						$updateProductAllocationArr = array("Allocated"=>1);
						$UpdateProductWhereCond ="(RequestID='".$RequestID."')";
						Mainupdatefunc("Req_Credit_Card", $updateProductAllocationArr, $UpdateProductWhereCond);
					}
				}
				if(!empty($RequestID)){
					$errmsg = 'Data Saved Successfully';
					$errcode = 0;
				}else{
					$errmsg = 'Some error comes while saving information';
					$errcode = 1;
				}
			}else {
				//Update entry in Req_Credit_card table
				$UpdateProductArr = array("Net_Salary"=>$IncomeAmount, "Employment_Status"=>$occupation, "City"=>$City, "Company_Name"=>$Company_Name, "Name"=>$first_name, "Email"=>$Email, "DOB"=>$dob, "Mobile_Number"=>$Phone, "Reference_Code"=>$OtpVal);
				$UpdateProductWhereCond ="(RequestID='".$RequestID."')";
				Mainupdatefunc("Req_Credit_Card", $UpdateProductArr, $UpdateProductWhereCond);
				
				$errmsg = 'Data Updated Successfully';
				$errcode = 0;
			}
		}
		
		$response = array('errmsg'=>$errmsg, 'errcode'=>$errcode, 'RequestID'=>$RequestID);
		echo json_encode($response);
		exit;
	}
	
	//Validate OTP
	if($_POST['request_from'] == 'validateOTP' && !empty($RequestID)){
		$getotpdetailsqry="SELECT Reference_Code FROM Req_Credit_Card WHERE RequestID='".$RequestID."'";
		list($numrows,$otpdetailsrow) = Mainselectfunc($getotpdetailsqry,$array = array());
		$Reference_Code = $otpdetailsrow['Reference_Code'];
		
		if($Reference_Code == $otp){
			
			$updateSql = "Update Req_Credit_Card SET Is_Valid=1 WHERE RequestID='".$RequestID."'";
			$updateQuery = ExecQuery($updateSql);
			
			$errmsg = 'OTP Verified Successfully';
			$errcode = 0;
		}else{
			$errmsg = 'Incorrect OTP';
			$errcode = 1;
		}
		$response = array('errmsg'=>$errmsg, 'errcode'=>$errcode);
		echo json_encode($response);
		exit;
	}

	//Save All other information
	if(!empty($RequestID) && !empty($terms)){
		$FinalResidenceAddress = $residence_address. ' , '. $residence_address2. ' , ' .$Residencecity;
		$FinalOfficeAddress = $office_address. ' '. $office_address2;
		$stroffadd = round((strlen($FinalOfficeAddress )/3));
		$offadd = str_split($FinalOfficeAddress, $stroffadd);
		$offAddress1 = trim($offadd[0]);
		$offAddress2 = trim($offadd[1]);
		$offAddress3 = trim($offadd[2]);
		
		
		if(!empty($Company_Name)){
			$checkCompanyqry = "SELECT sbi_category FROM sbi_cc_company_list WHERE (sbi_companyname='".$Company_Name."')";
			list($Getnum,$catrow)=Mainselectfunc($checkCompanyqry,$array = array());
			$sbicompcat= $catrow["sbi_category"];
		}

		//Update entry in Req_Credit_card
		$form_step=2;
		$UpdateProductArr = array("Name"=>$first_name, "Email"=>$Email, "City"=>$City, "Net_Salary"=>$IncomeAmount, "Mobile_Number"=>$Phone, "DOB"=>$dob, "Gender"=>$Gender, "Employment_Status"=>$occupation, "Company_Name"=>$Company_Name, "Company_Type"=>$NatureOfCompany, "Total_Experience"=>$CurrentEmployment, "Pancard"=>$pancard, "Residence_Address"=>$FinalResidenceAddress, "Pincode"=>$pincode, "Office_Address"=>$FinalOfficeAddress, "Office_City"=>$Officecity, "Updated_Date"=>$Dated, "form_step"=>$form_step);
		$UpdateProductWhereCond ="(RequestID='".$RequestID."')";
		Mainupdatefunc("Req_Credit_Card", $UpdateProductArr, $UpdateProductWhereCond);
		

		//Insert/Update entry in sbi_credit_card_5633 table
		$getsccdetailsqry="SELECT sbiccid FROM sbi_credit_card_5633 WHERE (RequestID='".$RequestID."') AND process_type='direct' ORDER BY sbiccid DESC LIMIT 0,1";
		list($alreadyExist,$sccrow)=Mainselectfunc($getsccdetailsqry,$array = array());
		$sbiccid=$sccrow['sbiccid'];
		if($alreadyExist>0){
			$UpdateSccArr = array("OfficeAddress1" => $offAddress1, "OfficeAddress2" => $offAddress2, "OfficeAddress3" => $offAddress3, "OfficePin" => $office_pincode, "OfficeCity" => $Officecity, "Qualification"=> $qualification, "Designation" => $designation, "date_modified" =>$Dated, "table_name"=>'Req_Credit_Card');
			$UpdateSccWhereCond ="(sbiccid='".$sbiccid."')";
			Mainupdatefunc ("sbi_credit_card_5633", $UpdateSccArr, $UpdateSccWhereCond);
		}else{
			$process_type = 'direct';
			$InsertSccArr= array("RequestID" => $RequestID, "OfficeAddress1" => $offAddress1, "OfficeAddress2" => $offAddress2, "OfficeAddress3" => $offAddress3, "OfficePin" => $office_pincode, "OfficeCity" => $Officecity, "Qualification"=> $qualification, "Designation" => $designation, "CardName"=>$cc_bankname, "bank_name"=>'SBI', "sbi_cc_holder"=>$group1 , "Dated" =>$Dated, "process_type"=>$process_type, "productflag"=>'4', "table_name"=>'Req_Credit_Card');
			$sbiccid = Maininsertfunc("sbi_credit_card_5633", $InsertSccArr);
		}
		
		$encoded_cc_bankid = base64_encode($cc_bankid);
		$encoded_cc_bankname = base64_encode($cc_bankname);
		header('Location: http://www.deal4loans.com/simply-save-cards-apply-thanks.php?RequestID='.$RequestID.'&cc_bankid='.$encoded_cc_bankid.'&cc_bankname='.$encoded_cc_bankname);
	}
}

$retrivesource="simply_save_cards_apply";
$section_value = $_REQUEST['section'];

?>
<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Simply Spend.Simply Save.</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW"> <!--Remove tag when live page-->
        <link href="css/materialize.min.css" type="text/css" rel="stylesheet" />
        <link href="css/sbi-cc-styles.css?<?=time();?>" type="text/css" rel="stylesheet" />
        <style type="text/css">
			/* Big box with list of options */
			#ajax_listOfOptions {
				position: absolute;	/* Never change this one */
				width: 250px;	/* Width of box */
				height: 160px;	/* Height of box */
				overflow: auto;	/* Scrolling features */
				border: 1px solid #317082;	/* Dark green border */
				background-color: #FFF;	/* White background color */
				color: black;
				font-family: Verdana, Arial, Helvetica, sans-serif;
				text-align: left;
				font-size: 10px;
				z-index: 50;
			}
			#ajax_listOfOptions div {	/* General rule for both .optionDiv and .optionDivSelected */
				margin: 1px;
				padding: 1px;
				cursor: pointer;
				font-size: 10px;
			}
			#ajax_listOfOptions .optionDivSelected { /* Selected item in the list */
				background-color: #2375CB;
				color: #FFF;
			}
			#ajax_listOfOptions_iframe {
				background-color: #F00;
				position: relative;
				z-index: 5;
			}
		</style>
    </head>
    <body>
        <div class="pd-top-bottom-10 white">
            <div class="container">
                <div class="row mr-no-btn">
                    <div class="col s6 left-align"><img src="images/d4l-logo-wp.png" alt="logo" class="responsive-img" /></div>
      <div class="col s6 right-align"><img src="images/sbi-logo.png" alt="logo" class="responsive-img" /> </div>
                </div>
            </div>
        </div>
        <header class="sbi_cc_header">
            <div class="container">
                <div class="row mr-no-btn">
                    <div class="col m9 s12 pd-top-25">
                        <h1>Simply Spend. Simply <em>Save</em></h1>
                        <h2>Presenting the Simply<i>SAVE</i> SBI Card.</h2>
                    </div>
                    <div class="col m3 s12 center-align"><img src="images/sbi-simply-save.png" class="responsive-img center-align" alt="SBI Simply Save" /></div>
                </div>
                <div class="row mr-no-btn">
                    <div class="col m12 s12">
                        <div class="dark-blue-box center-align"><span>&bull;</span> 10X Reward Points* on Dining, Grocery, 
							Departmental Store &amp; Movie spends <span class="pd-left-16">&bull;</span> Annual Fee Reversal on spends</div>
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
								<div style="margin-bottom:20px;" id="ShowMessageVal"></div>
                                <div class="col s12 m8">
                                    <div class="form-box">
                                        <form method="post" name="SssFrm" action="simply-save-cards-apply.php" id="formValidate">
											<input type="hidden" id="RequestID" name="RequestID" value=""/>
											<input type="hidden" id="source" name="source" value="<?php echo $retrivesource; ?>"/>
											<input type="hidden" id="section_value" name="section_value" value="<?php echo $section_value; ?>"/>
											
											<input type="hidden" id="cc_bankid" name="cc_bankid" value="52">
											<input type="hidden" id="cc_bankname" name="cc_bankname" value="SBI SimplySave">
                                            Do you already have an SBI Credit Card? 
                                            <!-- Modal Structure -->
                                            <div id="modal1" class="modal">
                                                <div class="right-align col s12 pd-top-16"><a class="modal-action modal-close cross-btn">X</a></div>
                                                <div class="modal-content">
                                                    <p class="center-align">Thank you for showing interest in SBI credit card, as you are already an SBI Credit Card Holder, we may not be able to service your request for another SBI Credit Card through our platform.</p>
                                                </div>
                                            </div>
                                            <input name="group1" type="radio" id="yes" data-target="modal1" value="yes" />
                                            <label for="yes">Yes</label>
                                            <input name="group1" type="radio" id="no" value="no" />
                                            <label for="no">No</label>
                                            <div id="AnswerVal"></div>
                                            <h2>Professional Information</h2>
                                            <div class="row">
                                                <div class="input-field col s12">
                                                    <select id="IncomeAmount" name="IncomeAmount" onchange="validateDiv('IncomeAmountVal');">
                                                        <option value="" disabled selected>Select</option>
                                                        <option value="300000">Upto 3 Lakh</option>
                                                        <option value="600000">3 to 6 Lacs</option>
                                                        <option value="900000">6 to 9 Lacs</option>
                                                        <option value="1200000">9 to 12 Lacs</option>
                                                        <option value="1500000">12 to 15 Lacs</option>
                                                        <option value="1600000"> 15 Lac & Above</option> 
                                                    </select>
                                                    <label for="IncomeAmount">Annual Income</label>
                                                </div>
                                                <div id="IncomeAmountVal"></div>
                                            </div>
                                            <div class="row">
												<div class="input-field col s12">
													<select id="occupation" name="occupation" onchange="validateDiv('empStatusVal');"> 
														<option value="Select">Select</option>
														<option value="1">Salaried</option>
														<option value="0">Self- employed</option>
														<option value="2">Housmaker</option>
														<option value="3">Retired/pensioner</option>
														<option value="4">Student</option>
													</select>
													<label for="occupation">Occupation</label>
												</div>
												<div id="empStatusVal"></div>
											</div>
											<div class="row">
                                                <div class="input-field col s12">
                                                    <select id="City" name="City"  onchange="validateDiv('CityVal');">
                                                        <!--<option value="" disabled selected>Select City</option>-->
                                                        <option value="">Please Select</option>
                                                       		<?php	$getCarNameSql = "SELECT * FROM sbi_cc_city_state_list WHERE 1 GROUP BY city";
			list($numRowsCarName,$getCarNameQuery)=MainselectfuncNew($getCarNameSql,$array = array());
for($cN=0;$cN<$numRowsCarName;$cN++)
																	{
																		$resicity = ucwords(strtolower($getCarNameQuery[$cN]['city']));
																		$displaycity = $resicity;
																		$cityalias = ucwords(strtolower($getCarNameQuery[$cN]['cityalias']));
																		if(strlen($cityalias)>2) { $displaycity=$cityalias; }
																		?>
																		<option value="<?php echo $resicity; ?>"  ><?php echo $displaycity; ?></option>
														            <?php
																	}
																	?>


                                                    </select>
                                                    <label for="City">City</label>
                                                </div>
                                                <div id="CityVal"></div>
                                            </div>
                                            <div class="row">
												<div class="input-field col s12">
													<input placeholder="Enter Company Name" id="Company_Name" name="Company_Name" type="text" class="validate" aria-required="true" onkeydown="validateDiv('companyNameVal');" onKeyUp="ajax_showOptions(this,'getCountriesByLetters',event)">
													<label for="Company_Name">Company Name</label>
												</div>
												<div id="companyNameVal"></div>
											</div>
                                            <div id="personalInfo" style="display: none">
                                                <h2>Personal Information</h2>
                                                <div class="row">
													<div class="input-field col s12">
														<input placeholder="Enter Name as per Pancard" id="first_name" name="first_name" aria-required="true" type="text" class="validate" onkeydown="validateDiv('FirstnameVal');"onKeyPress="return isCharsetKey(event);" >
														<label for="first_name">Name</label>
													</div>
													<div id="FirstnameVal"></div>
												</div>
												<div class="row">
													<div class="input-field col s12">
														<input placeholder="Enter Email id" id="Email" type="text" name="Email" class="validate" onkeydown="validateDiv('EmailVal');" maxlength="40">
														<label for="Email">Email id</label>
													</div>
													<div id="EmailVal"></div>
												</div>
                                                <div class="row">
                                                    <div class="input-field col s12">
                                                        <input type="date" name="dob" id="dob" class="datepicker no-bottom-margin" placeholder="Date of Birth" aria-required="true" onchange="validateDiv('dobVal');" >
                                                        <label for="dob">Date of Birth</label>
                                                    </div>
                                                    <div id="dobVal"></div>
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
															<input name="GenearateOTP" type="button" class="gent-otp-btn" id="GenearateOTP" value="Generate OTP" maxlength="7">
														</div>
														<div id="PhoneVal"></div>
													</div>
												</div>
												<div style="display: none;" id="ShowOTPField">
													<div class="row">
														<div class="input-field col s6 m9">
															<input placeholder="Enter OTP" id="otp" name="otp" aria-required="true" type="text" class="validate" onkeydown="validateDiv('OTPVal');" onKeyPress="return numOnly(event);" maxlength="6">
															<label for="otp">OTP</label>
														</div>
														<div class="input-field col s6 m3">
															<input name="validateotpbutton" id="validateotpbutton" type="button" class="gent-otp-submit" value="Submit">
														</div>
														<div id="OTPVal"></div>
													</div>
												</div>
                                                 <div class="row" style="display: none;" id="OTPMsg">
                                                     <div class="right-align col s12 optsucess-msg">OTP Validation Successful</div>
                                                 </div>
                                            </div>
                                            <div id="OtherInfo" style="display: none">
                                                <h2>Other Information</h2>
                                                <div class="row">
                                                    <div class="col s12">
                                                        <div>Gender</div>
                                                        <input name="Gender" type="radio" id="male" value="Male" aria-required="true" class="validate" onchange="validateDiv('GenderVal');" />
                                                        <label for="male">Male</label>
                                                        <input name="Gender" type="radio" id="female" value="Female" aria-required="true" class="validate" onchange="validateDiv('GenderVal');" />
                                                        <label for="female">Female</label>
                                                    </div>
                                                    <div id="GenderVal"></div>
                                                </div>
                                                <div class="row">
                                                    <div class="input-field col s12">
                                                        <select id="qualification" name="qualification" onchange="validateDiv('qualificationVal');">
                                                            <option value="Select">Select</option>
                                                            <option value="Metric or Below">Metric or Below</option>
                                                            <option value="Higher Secondary">Higher Secondary</option>
                                                            <option value="Graduate">Graduate</option>
                                                            <option value="Post Graduate and Above">Post Graduate and Above</option>
                                                        </select>
                                                        <label for="qualification">Qualification</label>
                                                    </div>
                                                    <div id="qualificationVal"></div>
                                                </div>
                                                <div class="row">
                                                    <div class="input-field col s12">
                                                        <select id="NatureOfCompany" name="NatureOfCompany" onchange="validateDiv('NatureOfCompanyVal');">
                                                            <!--<option value="" disabled selected>Choose your option</option>-->
                                                            <option value="Choose option">Choose your option</option>
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
                                                        <input placeholder="Current Employment Years" id="CurrentEmployment" name="CurrentEmployment" type="text" class="validate" onkeydown="validateDiv('CurrentEmploymentVal');" onKeyPress="return numOnly(event);" maxlength="2">
                                                        <label for="CurrentEmployment">Years at Current employment</label>
                                                    </div>
                                                    <div id="CurrentEmploymentVal"></div>
                                                </div>
                                                <div class="row">
                                                    <div class="input-field col s12">
                                                        <input placeholder="ABCDE 1234 Q" id="pancard" name="pancard" type="text" class="validate" onkeydown="validateDiv('pancardVal');" maxlength="10">
                                                        <label for="pancard">Pancard Number</label>
                                                    </div>
                                                    <div id="pancardVal"></div>
                                                </div>
                                                <div class="row">
                                                    <div class="input-field col s12">
                                                        <input placeholder="Enter your address" id="residence_address" name="residence_address" type="text" class="validate" onkeydown="validateDiv('residenceAddressVal');" maxlength="60">
                                                        <!--<input placeholder="Enter your address" id="residence_address" name="residence_address" type="text" class="validate" onkeydown="validateDiv('residenceAddressVal');" onKeyPress="return isSpecialChar(event);">-->
                                                        <label for="residence_address">Residence address <span class="grey-text">(Line 1)</span></label>
                                                    </div>
                                                    <div id="residenceAddressVal"></div>
                                                </div>
                                                <div class="row">
                                                    <div class="input-field col s12">
                                                        <input placeholder="Enter your address" id="residence_address2" name="residence_address2" type="text" class="validate" maxlength="60">
                                                        <label for="residence_address2">Residence address <span class="grey-text">(Line 2)</span></label>
                                                    </div></div>
                                                <div class="row">
                                                    <div class="input-field col s12">
                                                        <select id="Residencecity" name="Residencecity" onchange="validateDiv('ResidencecityVal');">
                                                            	<option value="">Please Select</option>
                                                            	<?php	$getCarNameSql = "SELECT * FROM sbi_cc_city_state_list WHERE 1 GROUP BY city";
			list($numRowsCarName,$getCarNameQuery)=MainselectfuncNew($getCarNameSql,$array = array());
for($cN=0;$cN<$numRowsCarName;$cN++)
																	{
																		$resicity = ucwords(strtolower($getCarNameQuery[$cN]['city']));
																		$displaycity = $resicity;
																		$cityalias = ucwords(strtolower($getCarNameQuery[$cN]['cityalias']));
																		if(strlen($cityalias)>2) { $displaycity=$cityalias; }
																		?>
																		<option value="<?php echo $resicity; ?>"  ><?php echo $displaycity; ?></option>
														            <?php
																	}
																	?>

                                                        </select>
                                                        <label for="city">City</label>
                                                    </div>
                                                    <div id="ResidencecityVal"></div>
                                                </div>
                                                <div class="row">
                                                    <div class="input-field col s12">
                                                         <select name="pincode" id="pincode" onchange="validateDiv('pincodeVal');"><option value="">Select Pincode</option>
                                                    </select><label for="pincode">Pincode</label>

                                                    </div>
                                                    <div id="pincodeVal"></div>
                                                </div>
                                                <div class="row">
                                                    <div class="input-field col s12">
                                                        <input placeholder="Enter your address" aria-required="true" id="office_address" name="office_address" type="text" class="validate" onkeydown="validateDiv('officeAddressVal');" maxlength="60">
                                                        <label for="office_address">Office address <span class="grey-text">(Line 1)</span></label>
                                                    </div>
                                                    <div id="officeAddressVal"></div>
                                                </div>
                                                <div class="row">
                                                    <div class="input-field col s12">
                                                        <input placeholder="Enter your address" id="office_address2" name="office_address2" type="text" class="validate" maxlength="58">
                                                        <label for="office_address2">Office address <span class="grey-text">(Line 2)</span></label>
                                                    </div></div>
                                                <div class="row">
                                                    <div class="input-field col s12">
                                                        <select id="Officecity" name="Officecity" onchange="validateDiv('OfficecityVal');">
                                                          <option value="">Please Select</option>
                                                       		<?php	$getCarNameSql = "SELECT * FROM sbi_cc_city_state_list WHERE 1 GROUP BY city";
			list($numRowsCarName,$getCarNameQuery)=MainselectfuncNew($getCarNameSql,$array = array());

			for($cN=0;$cN<$numRowsCarName;$cN++)
																	{
																		$resicity = ucwords(strtolower($getCarNameQuery[$cN]['city']));
																		$displaycity = $resicity;
																		$cityalias = ucwords(strtolower($getCarNameQuery[$cN]['cityalias']));
																		if(strlen($cityalias)>2) { $displaycity=$cityalias; }
																		?>
																		<option value="<?php echo $resicity; ?>"  ><?php echo $displaycity; ?></option>
														            <?php
																	}
																	?>

                                                        </select>
                                                        <label for="office_city">City</label>
                                                    </div>
                                                    <div id="OfficecityVal"></div>
                                                </div>
                                                <div class="row">
                                                    <div class="input-field col s12">
                                                         <select name="office_pincode" id="office_pincode" onchange="validateDiv('officePincodeVal');"><option value="">Select Pincode</option>
                                                    </select>
                                                        <label for="office_pincode">Pincode</label>
                                                    </div>
                                                    <div id="officePincodeVal"></div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col s12"><input type="checkbox" id="terms" name="terms" value ="1" onchange="validateDiv('termsVal');">
                                                    <label for="terms" class="tc">I authorize Deal4loans.com & its partnering banks to contact me to explain the product & I Agree to <a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow"  style=" color:#3671d5; text-decoration:underline;">Privacy policy</a> and <a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow"  class="text" style=" color:#3671d5; text-decoration:underline;">Terms and Conditions</a>.
                                                    
                                                    </label></div>
                                                <div id="termsVal"></div>
                                            </div>
                                            <div class="row">
                                                <div class="col s12 center-align">
                                                    <button name="submitform" id="submitform" type="submit" class="waves-effect waves-light btn blue waves-input-wrapper guote-btn" disabled>Submit</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="col m4 s12 features-mr-top25">
                                    <div class="card">
                                        <div class="gift-box"><img src="images/gift_box.png" alt="Gift" /></div>
                                        <div class="benefits-box center-align">Benefits with your Simply<i>SAVE</i> 
											SBI Card</div>
                                        <div class="features-main">
                                            <ul class="features-text">
                                                <li>Get &#8377;2,000 bonus Reward Points* on Spends of &#8377;2,000 or more in first 60 days.</li>
                                                <li>Get annual membership fee reversal from second year of your subscription with annual spends of &#8377;90,000 or more.</li>
                                                <li>Enjoy 10X Reward Points* per &#8377;100 spent on Dining, Movies, Departmental Stores and Grocery 
												spends.</li>
                                                <li>1 % Fuel Surcharge Waiver* across all petrol pumps.</li>
                                            </ul>
                                            <hr>
                                            <p><span>Annual fee:</span> Nil, if the total spends made by you in the previous year >= &#8377;90,000. Else, an annual fee of &#8377;499 is charged.</p>
                                            <p><span>Joining fee (one time): </span>
											&#8377;499 (Service Tax, as applicable).</p>
                                            <p><span>Add-on fee:</span> Nil.</p>
                                            <p class="right-align tc">*T&C Apply</p>
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
        <script src="js/jquery-2.1.4.min.js" type="text/javascript"></script> 
        <script src="js/materialize.js" type="text/javascript"></script> 
        <script src="js/materialize.min.js" type="text/javascript"></script>
        <script type="text/javascript" src="ajax.js"></script>
        <script type="text/javascript" src="ajax-dynamic-sbicclist.js"></script>
        <script src="js/sbi-cards.js"></script> 
        <script type="text/javascript">

			var todaysDate = new Date();
			todaysDate.setFullYear(todaysDate.getFullYear() - 18);

			$('.datepicker').pickadate({   
				format: 'yyyy-mm-dd',
				selectYears: 60,
				selectMonths: true,
				max: todaysDate
			});
			
			$(document).ready(function () {
				$('#Phone').keypress(function () {
					$('#GenearateOTP').addClass('gent-otp-submit');
				});

				// the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
				$('.modal').modal();
				
				$('select').material_select();

				$('#GenearateOTP').on('click',function(e){
					var group1 = $('input[name="group1"]:checked').val();
					var IncomeAmount = $('#IncomeAmount').val();
					var occupation = $('#occupation').val();
					var City = $('#City').val();
					var Company_Name = $('#Company_Name').val();
					var first_name = $('#first_name').val();
					var Email = $('#Email').val();
					var dob = $('#dob').val();
					var Phone = $('#Phone').val();
					var section_value = $('#section_value').val();

					$('#ShowMessageVal').html('');
					$('#AnswerVal').html('');
					$('#IncomeAmountVal').html('');
					$('#empStatusVal').html('');
					$('#CityVal').html('');
					$('#companyNameVal').html('');
					$('#FirstnameVal').html('');
					$('#EmailVal').html('');
					$('#dobVal').html('');
					$('#PhoneVal').html('');

					if(group1 == "" || group1 === undefined){
						$('#AnswerVal').html('<span class="hintanchor">Please select option!</span>');
						$('input[name="group1"]').focus();
						return false;
					}
					
					if(IncomeAmount == '' || IncomeAmount == null){
						$('#IncomeAmountVal').html('<span class="hintanchor">Select Annual Income!</span>');
						$('#IncomeAmount').focus();
						return false;
					}
					
					if (occupation == "Select"){
						$('#empStatusVal').html('<span class="hintanchor">Select Employment Status!</span>');
						$('#occupation').focus();
						return false;
					}
					
					if(City == '' || City == null || City == 'Please Select'){
						$('#CityVal').html('<span class="hintanchor">Select City!</span>');
						$('#City').focus();
						return false;
					}

					if (Company_Name == ""){
						$('#companyNameVal').html('<span class="hintanchor">Fill Company Name!</span>');
						$('#Company_Name').focus();
						return false;
					}
					
					if(first_name == ''){
						$('#FirstnameVal').html('<span class="hintanchor">Please Enter Your First Name!</span>');
						$('#first_name').focus();
						return false;
					}
					
					if(Email == ''){
						$('#EmailVal').html('<span class="hintanchor">Enter Email Address!</span>');
						$('#Email').focus();
						return false;
					}
					var testEmail = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
					if (!testEmail.test(Email)){
						$('#EmailVal').html('<span class="hintanchor">Enter Valid Email Address!</span>');
						$('#Email').focus();
						return false;
					}

					if (dob == ""){
						$('#dobVal').html('<span class="hintanchor">Select dob!</span>');
						$('#dob').focus();
						return false;
					}
					
					if(Phone == ''){
						$('#PhoneVal').html('<span class="hintanchor">Enter Mobile Number!</span>');
						$('#Phone').focus();
						return false;
					}
					if (Phone.length < 10){
						$('#PhoneVal').html('<span class="hintanchor">Enter 10 Digits!</span>');
						$('#Phone').focus();
						return false;
					}
					if ((Phone.charAt(0) != "9") && (Phone.charAt(0) != "8") && (Phone.charAt(0) != "7")){
						$('#PhoneVal').html('<span class="hintanchor">Phone number should start with 9 or 8 or 7!</span>');
						$('#Phone').focus();
						return false;
					}
					
					//Disable button to avoid duplicate entries
					$('#GenearateOTP').prop('disabled',true);
					
					//Save data to database
					$.ajax({
						type: 'POST',
						url: 'simply-save-cards-apply.php',
						data: {
							IncomeAmount: IncomeAmount,
							occupation: occupation,
							City: City,
							Company_Name: Company_Name,
							first_name: first_name,
							Email: Email,
							dob: dob,
							Phone: Phone,
							section_value: section_value,
							request_from:'saveUserData',
						},
						success: function (response) {
							//console.log(response);
							var obj = JSON.parse(response);
							if (obj.errcode == 0) {
								$('#RequestID').val(obj.RequestID);
								//Show Otp Field
								$('#ShowOTPField').css({ 'display': 'block' });
								return true;
							} else {
								$('#ShowMessageVal').html('<span class="hintanchor" style="font-size:20px">'+obj.errmsg+'</span>');
								return false;
							}
						}
					});
				});
				
				$('#validateotpbutton').on('click',function(){
					var otp = $('#otp').val();
					var RequestID = $('#RequestID').val();
					
					$('#ShowMessageVal').html('');
					
					if(otp == ''){
						$('#OTPVal').html('<span  class="hintanchor">Enter OTP!</span>');
						$('#OTPVal').focus();
						return false;
					}
					
					//Validate OTP from database
					$.ajax({
						type: 'POST',
						url: 'simply-save-cards-apply.php',
						data: {
							otp: otp,
							RequestID: RequestID,
							request_from:'validateOTP',
						},
						success: function (response) {
						//console.log(response);
							var obj = JSON.parse(response);
							if (obj.errcode == 0) {
								$('#OtherInfo').css({'display':'block'});
								$('#submitform').prop('disabled', false);
								$('#OTPMsg').css({'display':'block'});
								$('#OTPMsg').html('<div class="right-align col s12 optsucess-msg">OTP Validation Successful</div>');
								return true;
							} else {
								//$('#ShowMessageVal').html('<span class="hintanchor" style="font-size:20px">'+obj.errmsg+'</span>');
								$('#OTPMsg').css({'display':'block'});
								$('#OTPMsg').html('<div class="right-align col s12 opterror-msg">'+obj.errmsg+'</div>');
								return false;
							}
						}
					});
				});
				
				$('#Residencecity').on('change',function(){
				var Residencecity = $('#Residencecity').val();
				$.ajax({
						type: 'POST',
						url: 'getresidence_pin_sbilp.php',
						data: {
							q: Residencecity
						},
						success: function (response) {
						$('#pincode').html(response);
					 	$('#pincode').material_select();
						}
					});	
				});

				$('#Officecity').on('change',function(){
				var Officecity= $('#Officecity').val();
				$.ajax({
						type: 'POST',
						url: 'getresidence_pin_sbilp.php',
						data: {
							q: Officecity
						},
						success: function (response) {
						$('#office_pincode').html(response);
					 	$('#office_pincode').material_select();
						}
					});	
				});
				$('#Company_Name').on('keydown',function(){
					$('#personalInfo').css({'display':'block'});
				});
				
				$('#submitform').on('click',function(event){

					var IncomeAmount = $('#IncomeAmount').val();
					var occupation = $('#occupation').val();
					var City = $('#City').val();
					var Company_Name = $('#Company_Name').val();
					var first_name = $('#first_name').val();
					var Email = $('#Email').val();
					var dob = $('#dob').val();
					var Phone = $('#Phone').val();
					var otp = $('#otp').val();
					var Gender = $('input[name="Gender"]:checked').val();
					var qualification = $('#qualification').val();
					var NatureOfCompany = $('#NatureOfCompany').val();
					var designation = $('#designation').val();
					var CurrentEmployment = $('#CurrentEmployment').val();
					var pancard = $('#pancard').val();
					var residence_address = $('#residence_address').val();
					var Residencecity = $('#Residencecity').val();
					var pincode = $('#pincode').val();
					var office_address = $('#office_address').val();
					var Officecity = $('#Officecity').val();
					var office_pincode = $('#office_pincode').val();

					$('#ShowMessageVal').html('');
					$('#IncomeAmountVal').html('');
					$('#empStatusVal').html('');
					$('#CityVal').html('');
					$('#companyNameVal').html('');
					$('#FirstnameVal').html('');
					$('#EmailVal').html('');
					$('#dobVal').html('');
					$('#PhoneVal').html('');
					$('#OTPVal').html('');
					$('#GenderVal').html('');
					$('#qualificationVal').html('');
					$('#NatureOfCompanyVal').html('');
					$('#designationVal').html('');
					$('#CurrentEmploymentVal').html('');
					$('#pancardVal').html('');
					$('#residenceAddressVal').html('');
					$('#ResidencecityVal').html('');
					$('#pincodeVal').html('');
					$('#officeAddressVal').html('');
					$('#OfficecityVal').html('');
					$('#officePincodeVal').html('');
					
					if(IncomeAmount == '' || IncomeAmount == null){
						$('#IncomeAmountVal').html('<span class="hintanchor">Select Annual Income!</span>');
						$('#IncomeAmount').focus();
						return false;
					}
					
					if (occupation == "Select"){
						$('#empStatusVal').html('<span class="hintanchor">Select Employment Status!</span>');
						$('#occupation').focus();
						return false;
					}
					
					if(City == '' || City == null || City == 'Please Select'){
						$('#CityVal').html('<span class="hintanchor">Select City!</span>');
						$('#City').focus();
						return false;
					}

					if (Company_Name == ""){
						$('#companyNameVal').html('<span class="hintanchor">Fill Company Name!</span>');
						$('#Company_Name').focus();
						return false;
					}
					
					if(first_name == ''){
						$('#FirstnameVal').html('<span class="hintanchor">Please Enter Your First Name!</span>');
						$('#first_name').focus();
						return false;
					}
					
					if(Email == ''){
						$('#EmailVal').html('<span class="hintanchor">Enter Email Address!</span>');
						$('#Email').focus();
						return false;
					}
					var testEmail = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
					if (!testEmail.test(Email)){
						$('#EmailVal').html('<span class="hintanchor">Enter Valid Email Address!</span>');
						$('#Email').focus();
						return false;
					}
					
					if (dob == ""){
						$('#dobVal').html('<span class="hintanchor">Select dob!</span>');
						$('#dob').focus();
						return false;
					}
					
					if(Phone == ''){
						$('#PhoneVal').html('<span class="hintanchor">Enter Mobile Number!</span>');
						$('#Phone').focus();
						return false;
					}
					if (Phone.length < 10){
						$('#PhoneVal').html('<span class="hintanchor">Enter 10 Digits!</span>');
						$('#Phone').focus();
						return false;
					}
					if ((Phone.charAt(0) != "9") && (Phone.charAt(0) != "8") && (Phone.charAt(0) != "7")){
						$('#PhoneVal').html('<span class="hintanchor">Phone number should start with 9 or 8 or 7!</span>');
						$('#Phone').focus();
						return false;
					}

					if (otp == ""){
						$('#OTPVal').html('<span class="hintanchor">Enter OTP!</span>');
						$('#otp').focus();
						return false;
					}

					if (Gender == "" || Gender === undefined){
						$('#GenderVal').html('<span class="hintanchor">Enter Gender!</span>');
						$('input[name="Gender"]').focus();
						return false;
					}

					if (qualification=="Select"){
						$('#qualificationVal').html('<span class="hintanchor">Select Qualification!</span>');
						$('#qualification').focus();
						return false;
					}

					if (NatureOfCompany == "Choose option"){
						$('#NatureOfCompanyVal').html('<span class="hintanchor">Select Nature of Company!</span>');
						$('#NatureOfCompany').focus();
						return false;
					}

					if (designation == "")	{
						$('#designationVal').html('<span class="hintanchor">Enter Designation!</span>');
						$('#designation').focus();
						return false;
					}
					
					if (CurrentEmployment == ""){
						$('#CurrentEmploymentVal').html('<span class="hintanchor">Enter Years at Current employment!</span>');
						$('#CurrentEmployment').focus();
						return false;
					}
					
					if (pancard == ""){
						$('#pancardVal').html('<span class="hintanchor">Please Enter Pan Card Number!</span>');
						$('#pancard').focus();
						return false;
					}
					
					var regex1 = /^[a-zA-Z]{5}\d{4}[a-zA-Z]{1}$/;  //this is the pattern of regular expersion
					if (regex1.test(pancard) == false){
						$('#pancardVal').html('<span class="hintanchor">Please enter valid pan number!</span>');
						$('#pancard').focus();
						return false;
					}
					if (pancard.charAt(3) != "P" && pancard.charAt(3) != "p"){
						$('#pancardVal').html('<span class="hintanchor">Please enter valid pan number!</span>');
						$('#pancard').focus();
						return false;
					}

					if (residence_address == ""){
						$('#residenceAddressVal').html('<span class="hintanchor">Enter Residence Address!</span>');
						$('#residence_address').focus();
						return false;
					}

					if (Residencecity == "" || Residencecity == "Please Select"){
						$('#ResidencecityVal').html('<span class="hintanchor">Select Residence City!</span>');
						$('#Residencecity').focus();
						return false;
					}

					if (pincode == ""){
						$('#pincodeVal').html('<span class="hintanchor">Please Enter Pincode!</span>');
						$('#pincode').focus();
						return false;
					}

					if (office_address == ""){
						$('#officeAddressVal').html('<span class="hintanchor">Enter Office Address!</span>');
						$('#office_address').focus();
						return false;
					}

					if (Officecity == "" || Officecity == "Please Select"){
						$('#OfficecityVal').html('<span class="hintanchor">Select Office City!</span>');
						$('#Officecity').focus();
						return false;
					}
					
					if (office_pincode == ""){
						$('#officePincodeVal').html('<span class="hintanchor">Please Enter Office Pincode!</span>');
						$('#office_pincode').focus();
						return false;
					}

					if (!$('#terms').is(':checked')){
						$('#termsVal').html('<span class="hintanchor">Please Check Term and condition to proceed.</span>');
						$('#terms').focus();
						return false;
					}

					return true;
				});
			});
        </script>
    </body>
</html>
