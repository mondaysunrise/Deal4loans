<?php
require 'scripts/db_init.php';
require 'scripts/functions.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST'){
	//echo '<pre>';print_r($_POST);//exit;
	$Dated=ExactServerdate();
	
	$first_name = isset($_POST["first_name"]) ? $_POST["first_name"] : '';
	$Company_Name = isset($_POST["Company_Name"]) ? $_POST["Company_Name"] : '';
	$pancard = isset($_POST["pancard"]) ? $_POST["pancard"] : '';
	$residence_address = isset($_POST["residence_address"]) ? $_POST["residence_address"] : '';
	$residence_address2 = isset($_POST["residence_address2"]) ? $_POST["residence_address2"] : '';
	$office_address = isset($_POST["office_address"]) ? $_POST["office_address"] : '';
	$office_address2 = isset($_POST["office_address2"]) ? $_POST["office_address2"] : '';
	
	$RequestID = isset($_POST["RequestID"]) ? $_POST["RequestID"] : '';
	$sbiccid = isset($_POST["RequestID"]) ? $_POST["sbiccid"] : '';
	$cc_bankid = isset($_POST["cc_bankid"]) ? $_POST["cc_bankid"] : '';
	$cc_bankname = isset($_POST["cc_bankname"]) ? $_POST["cc_bankname"] : '';
	
	
	$FinalResidenceAddress = $residence_address. ' , '. $residence_address2;
	$FinalOfficeAddress = $office_address. ' '. $office_address2;
	$stroffadd = round((strlen($FinalOfficeAddress )/3));
	$offadd = str_split($FinalOfficeAddress, $stroffadd);
	$offAddress1 = trim($offadd[0]);
	$offAddress2 = trim($offadd[1]);
	$offAddress3 = trim($offadd[2]);
	
	$form_step=3;
	$UpdateProductArr = array("Name"=>$first_name, "Company_Name"=>$Company_Name, "Pancard"=>$pancard, "Residence_Address"=>$FinalResidenceAddress, "Office_Address"=>$FinalOfficeAddress, "form_step"=>$form_step);
	$UpdateProductWhereCond ="(RequestID='".$RequestID."')";
	Mainupdatefunc("Req_Credit_Card", $UpdateProductArr, $UpdateProductWhereCond);

	$UpdateSccArr= array("OfficeAddress1" => $offAddress1, "OfficeAddress2" => $offAddress2, "OfficeAddress3" => $offAddress3);
	$UpdateSccWhereCond ="(sbiccid='".$sbiccid."')";
	Mainupdatefunc ("sbi_credit_card_5633", $UpdateSccArr, $UpdateSccWhereCond);
	$encoded_cc_bankid = base64_encode($cc_bankid);
	$encoded_cc_bankname = base64_encode($cc_bankname);
	header('Location: http://www.deal4loans.com/sbi-cards-apply-thanks.php?RequestID='.$RequestID.'&cc_bankid='.$encoded_cc_bankid.'&cc_bankname='.$encoded_cc_bankname);
}

$RequestID = isset($_REQUEST["RequestID"]) ? $_REQUEST["RequestID"] : '';
$cc_bankid = isset($_REQUEST["cc_bankid"]) ? $_REQUEST["cc_bankid"] : '';
$cc_bankname = isset($_REQUEST["cc_bankname"]) ? $_REQUEST["cc_bankname"] : '';
$sbiccid= isset($_REQUEST["sbiccid"]) ? $_REQUEST["sbiccid"] : '';
$card_id = base64_decode($cc_bankid);
$card_name = base64_decode($cc_bankname);
$sbiccid = base64_decode($sbiccid);

$errArray=unserialize(urldecode($_REQUEST['errArray']));

$process_type = 'direct';
$NameVal = $errArray['Name'];
if($NameVal==1) { $NameMsg = $errArray['NameMsg']; }
$PANVal = $errArray['PAN'];
if($PANVal==1) { $PANMsg= $errArray['PANMsg']; }
$CompanyNameVal = $errArray['CompanyName'];
if($CompanyNameVal==1) { $PANMsg= $errArray['CompanyNameMsg']; }

$ResiAddress1Val = $errArray['ResiAddress1'];
if($ResiAddress1Val==1) { $ResiAddress1Msg= $errArray['ResiAddress1Msg']; }

$OfficeAddress1Val = $errArray['OfficeAddress1'];
if($OfficeAddress1NameVal==1) { $OfficeAddress1Msg= $errArray['OfficeAddress1Msg']; }

if($PANMsg=="NOTMATCHED")
{
	$nameMessage="Your Name is not matching with Name on Pancard. Please enter valid Name as per Pancard to get instant Approval.";
}
else if($PANMsg=="WEBSERVICEERROR" || $PANMsg=="PARSEERROR" || $PANMsg=="INVALIDPAN")
{
	$panMessage="Some Error occured please Enter Pancard again.";
}
else if($PANMsg=="NORECORDFOUND")
{
	$panMessage="Pancard entered is not valid. Please enter valid Pancard to get instant Approval.";
}

$name_enable=$NameVal;
$companyName_enable=$CompanyNameVal;
$pancard_enable=$PANVal;
$residenceaddress_enable=$ResiAddress1Val;
$officeaddress_enable=$OfficeAddress1NameVal;

$selectqry="SELECT * FROM Req_Credit_Card WHERE (RequestID='".$RequestID."')";
list($Getnum,$row)=Mainselectfunc($selectqry,$array = array());
$Name = $row["Name"];
$pancard = $row["Pancard"];
$Company_Name = $row["Company_Name"];
$Residence_Address = $row["Residence_Address"];
$Office_Address = $row["Office_Address"];

$strresieadd = round((strlen($Residence_Address)/2));
$residenceadd = str_split($Residence_Address, $strresieadd);
$residence_address= $residenceadd[0];
$residence_address2= $residenceadd[1];

$stroffadd = round((strlen($Office_Address)/2));
$officeadd = str_split($Office_Address, $strresieadd);
$office_address= $officeadd[0];
$office_address2= $officeadd[1];

	
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
                                        <form method="post" name="SssFrm" action="sbi-cards-apply-continue.php" id="formValidate">
											<input type="hidden" id="RequestID" name="RequestID" value="<?php echo $RequestID; ?>" />
											<input type="hidden" id="cc_bankid" name="cc_bankid" value="52">
											<input type="hidden" id="cc_bankname" name="cc_bankname" value="SBI SimplySave">
											<input type="hidden" id="sbiccid" name="sbiccid" value="<?php echo $sbiccid; ?>">
											
                                            <h2>Pending Information</h2>
                                            <?php 
											if($name_enable==1 || $pancard_enable==1)	
											{ ?>
                                            <div class="row" >
                                                <div class="input-field col s12">
                                                    <input placeholder="Enter Name" id="first_name" name="first_name" aria-required="true" type="text" class="validate" onkeydown="validateDiv('FirstnameVal');"onKeyPress="return isCharsetKey(event);" value="<?php echo $Name;?>" maxlength="38" >
                                                    <label for="first_name">Name</label>
                                                </div>
                                                <div id="FirstnameVal" class="hintanchor"><?php echo $nameMessage; ?></div>
                                            </div>
                                            <?php } else { ?><input id="first_name" name="first_name" type="hidden" value="<?php echo $Name;?>" > <?php } ?>
                                            <div id="personalInfo">
                                            <?php 
											if($companyName_enable==1)	
											{ ?>
											   <div class="row">
                                                    <div class="input-field col s12">
														<input placeholder="Enter Company Name" id="Company_Name" name="Company_Name" type="text" class="validate" aria-required="true" onkeydown="validateDiv('companyNameVal');" onKeyUp="ajax_showOptions(this,'getCountriesByLetters',event)">
                                                        <label for="Company_Name">Company Name</label>
                                                    </div>
                                                    <div id="companyNameVal"></div>
                                                </div>
                                             <?php } else { ?><input id="Company_Name" name="Company_Name" type="hidden" value="<?php echo $Company_Name;?>" > <?php } ?> 
                                            </div>
                                            <div id="OtherInfo" >
                                             <?php 
											if($pancard_enable==1 || $name_enable==1)	
											{ ?>
                                               <div class="row">
                                                    <div class="input-field col s12">
                                                        <input placeholder="ABCDE 1234 Q" id="pancard" name="pancard" type="text" class="validate" onkeydown="validateDiv('pancardVal');" maxlength="10"  value="<?php echo $pancard;?>" >
                                                        <label for="pancard">Pancard Number</label>
                                                    </div>	
                                                    <div id="pancardVal" class="hintanchor"><?php echo $panMessage; ?></div>
                                                </div>
                                            <?php } else { ?><input id="pancard" name="pancard" type="hidden" value="<?php echo $pancard;?>" > <?php } ?>     
											<?php
											if($residenceaddress_enable==1)	
											{ ?>                                             
											  <div class="row">
                                                    <div class="input-field col s12">
                                                        <input placeholder="Enter your address" id="residence_address" name="residence_address" type="text" class="validate" onkeydown="validateDiv('residenceAddressVal');"  maxlength="60">
                                                        <label for="residence_address">Residence address <span class="grey-text">(Line 1)</span></label>
                                                    </div>
                                                    <div id="residenceAddressVal"></div>
                                                </div>
                                             <?php } else { ?><input id="residence_address" name="residence_address" type="hidden" value="<?php echo $residence_address;?>" > <?php } 											if($residenceaddress_enable==1)	
											{ ?>                                             
                                                <div class="row">
                                                    <div class="input-field col s12">
                                                        <input placeholder="Enter your address" id="residence_address2" name="residence_address2" type="text" class="validate"  maxlength="60">
                                                        <label for="residence_address2">Residence address <span class="grey-text">(Line 2)</span></label>
                                                    </div></div>
                                               <?php } else { ?><input id="residence_address2" name="residence_address2" type="hidden" value="<?php echo $residence_address2;?>" > <?php }     									 
                                               if($officeaddress_enable==1)	
											{ ?>
                                                <div class="row">
                                                    <div class="input-field col s12">
                                                        <input placeholder="Enter your address" aria-required="true" id="office_address" name="office_address" type="text" class="validate" onkeydown="validateDiv('officeAddressVal');"  maxlength="60">
                                                        <label for="office_address">Office address <span class="grey-text">(Line 1)</span></label>
                                                    </div>
                                                    <div id="officeAddressVal"></div>
                                                </div>
                                             <?php } else { ?><input id="office_address" name="office_address" type="hidden" value="<?php echo $office_address;?>" > <?php }     									if($officeaddress_enable==1)	
											{ ?>       
                                              <div class="row">
                                                    <div class="input-field col s12">
                                                        <input placeholder="Enter your address" id="office_address2" name="office_address2" type="text" class="validate"  maxlength="58">
                                                        <label for="office_address2">Office address <span class="grey-text">(Line 2)</span></label>
                                                    </div></div>
                                           <?php } else { ?><input id="office_address2" name="office_address2" type="hidden" value="<?php echo $office_address2;?>" > <?php }   ?>  
                                            </div>
                                            <div class="row">
                                                <div class="col s12 center-align">
                                                    <button name="submitform" id="submitform" type="submit" class="waves-effect waves-light btn blue waves-input-wrapper guote-btn" >Submit</button>
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

			

				// the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
				$('.modal').modal();
				
				$('select').material_select();

				$('#submitform').on('click',function(event){
					
					var first_name = $('#first_name').val();
					var Company_Name = $('#Company_Name').val();
					var pancard = $('#pancard').val();
					var residence_address = $('#residence_address').val();
					var office_address = $('#office_address').val();
				
					$('#ShowMessageVal').html('');
					$('#FirstnameVal').html('');
					$('#companyNameVal').html('');
					$('#pancardVal').html('');
					$('#residenceAddressVal').html('');
					$('#officeAddressVal').html('');
					
					if(first_name == ''){
						$('#FirstnameVal').html('<span class="hintanchor">Please Enter Your First Name!</span>');
						$('#first_name').focus();
						return false;
					}
					//alert(Company_Name);
					if (Company_Name == ""){
						$('#companyNameVal').html('<span class="hintanchor">Fill Company Name!</span>');
						$('#Company_Name').focus();
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
					if (office_address == ""){
						$('#officeAddressVal').html('<span class="hintanchor">Enter Office Address!</span>');
						$('#office_address').focus();
						return false;
					}
					return true;
				});
        </script>
    </body>
</html>
