<?php
require 'scripts/session_check.php';
require 'scripts/db_init.php';
require 'scripts/functions.php';

$pl_requestid = $_REQUEST['pl_requestid'];
$pl_bank_name = $_REQUEST['pl_bank_name'];
$rbl_irr = $_REQUEST['rbl_irr'];
$rbl_lnamt = $_REQUEST['rbl_lnamt'];
$rbl_tnrmths = $_REQUEST['rbl_tnrmths'];
$rbl_procfee = $_REQUEST['rbl_procfee'];
/*$pl_requestid = 3236722;
$pl_bank_name = "RBL Bank";
$rbl_irr = "19";
$rbl_lnamt = "459866";
$rbl_tnrmths = "4";
$rbl_procfee ="2%";
*/
if (strlen($pl_bank_name) > 1 && $pl_requestid > 1) {
    $selqry = "select PL_Bank,Loan_Amount,Name,DOB,gender,Pancard,Residence_Address,Pincode,Residential_Status,Company_Type,Company_Name,Net_Salary,City,Mobile_Number,Email,source,Total_Experience from Req_Loan_Personal Where RequestID=" . $pl_requestid;
    list($Numrows, $plrow) = MainselectfuncNew($selqry, $array = array());
    $countr = count($plrow) - 1;
    $pl_banks = $plrow[$countr]['PL_Bank'];
    $loan_amount = $plrow[$countr]["Loan_Amount"];
    $name = $plrow[$countr]["Name"];
    $DOB = $plrow[$countr]["DOB"];
    $company_name = $plrow[$countr]["Company_Name"];
    $salary = round($plrow[$countr]["Net_Salary"] / 12);
    $City = $plrow[$countr]["City"];
    $Mobile_Number = $plrow[$countr]["Mobile_Number"];
    $Email = $plrow[$countr]["Email"];
    $gender = $plrow[$countr]["gender"];
    $Pancard = $plrow[$countr]["Pancard"];
    $ResiAddress = $plrow[$countr]["Residence_Address"];
    $Pincode = $plrow[$countr]["Pincode"];
    $Residential_Status = $plrow[$countr]["Residential_Status"];
    $Company_Type = $plrow[$countr]["Company_Type"];
	$TotWrkExp = $plrow[$countr]["Total_Experience"];
    
    $source = $plrow[$countr]["source"];
    
    if (strlen($pl_banks) > 1) {
        $newpl_banks = $pl_banks . "," . $pl_bank_name;
        $wherecondition = "(Req_Loan_Personal.RequestID=" . $pl_requestid . ")";
        $dataarray = array("PL_Bank" => $newpl_banks);
    } else {
        $dataarray = array("PL_Bank" => $pl_bank_name);
        $wherecondition = "(Req_Loan_Personal.RequestID=" . $pl_requestid . ")";
    }
    $rowcount = Mainupdatefunc("Req_Loan_Personal", $dataarray, $wherecondition);
    //echo $plupdate."<br>";
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW" /> <!---remove Robots tag when it will be Live.-->
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <style type="text/css">
            .heading_text{font: bold 18px/100% Arial, Helvetica, sans-serif; color:#0199cd; margin-left:15px; }
            .sbi_text_c{ color:#0199cd; font-family:Arial, Helvetica, sans-serif; font-size:13px; font-weight:bold;}
            #sidebar {
                width: 340px;
                float: right;
                margin: 30px 0 30px;
            }
            #content {
                background: #fff;
                margin: 30px 0 30px 20px;
                padding: 10px;
                width: 570px;
                float: left;
                /* rounded corner */
                -webkit-border-radius: 8px;
                -moz-border-radius: 8px;
                border-radius: 8px;
                /* box shadow */
                -webkit-box-shadow: 0 1px 3px rgba(0,0,0,.4);
                -moz-box-shadow: 0 1px 3px rgba(0,0,0,.4);
                box-shadow: 0 1px 3px rgba(0,0,0,.4);
            }

            .widget {
                background: #fff;
                margin: 0 0 30px;
                padding: 10px 20px;
                /* rounded corner */
                -webkit-border-radius: 8px;
                -moz-border-radius: 8px;
                border-radius: 8px;
                /* box shadow */
                -webkit-box-shadow: 0 1px 3px rgba(0,0,0,.4);
                -moz-box-shadow: 0 1px 3px rgba(0,0,0,.4);
                box-shadow: 0 1px 3px rgba(0,0,0,.4);
            }
            .bajaj-fin_input{width:100%; height:25px; border-radius:5px 5px 5px 5px; border: solid 2px #0199cd;}
            .bajaj-fin_txtinput{width:100%;  border-radius:5px 5px 5px 5px; border: solid 2px #0199cd;}

            .sbi_text_bullet ul{ padding:0px 0px 0px 0px; margin:0px 0px 0px 0px}
            .sbi_text_bullet li{color:#0199cd; font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold; list-style: url(/new-images/sbi_bullet1.jpg); margin-left:15px; line-height:25px; }
            .sbi_text_bullet li a{color:#0199cd; font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold;}

        </style>


        <link href="source.css" rel="stylesheet" type="text/css" />
        <style type="text/css">
            .heading_text1 {font: bold 20px/100% Arial, Helvetica, sans-serif; color:#0199cd; margin-left:20px; }
        </style>
        <script type="text/javascript" src="scripts/mainmenu.js"></script>
        <script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
        
        
        
        
        <script Language="JavaScript" Type="text/javascript">
            function ckhcreditcard(Form){
                if (Form.loan_amount.value == "")
                {
                    alert("Please enter loan amount");
                    Form.loan_amount.focus();
                    return false;
                }
                if (Form.name.value == "")
                {
                    alert("Please enter your fullname");
                    Form.name.focus();
                    return false;
                }
                if (Form.Email.value == "")
                {
                    alert("Please enter your email");
                    Form.Email.focus();
                    return false;
                }
                if (Form.Mobile.value == "")
                {
                    alert("Please enter your mobile");
                    Form.Mobile.focus();
                    return false;
                }
                if (Form.dob.value == "")
                {
                    alert("Please enter your DOB in yyyy-mm-dd format");
                    Form.dob.focus();
                    return false;
                }
                if (Form.gender.value == "")
                {
                    alert("Please select gender");
                    Form.gender.focus();
                    return false;
                }
                if (Form.qualification.value == "")
                {
                    alert("Please select your qualification");
                    Form.qualification.focus();
                    return false;
                }
                var a = Form.panno.value;
                var regex1 = /^[a-zA-Z]{5}\d{4}[a-zA-Z]{1}$/;  //this is the pattern of regular expersion
                if (regex1.test(a) == false)
                {
                    alert('Please enter valid pan number');
                    Form.panno.focus();
                    return false;
                }
                if (Form.panno.value.charAt(3) != "P" && Form.panno.value.charAt(3) != "p")
                {
                    alert("Please enter valid pan number");
                    Form.panno.focus();
                    return false;
                }
                if (Form.caddress.value == "")
                {
                    alert("Please enter current address");
                    Form.caddress.focus();
                    return false;
                }
                if (Form.ResCity.value == "")
                {
                    alert("Please select residence city");
                    Form.ResCity.focus();
                    return false;
                }
                if (Form.ResPIN.value == "")
                {
                    alert("Please enter residence pincode");
                    Form.ResPIN.focus();
                    return false;
                } else if (Form.ResPIN.value.length < 6)
                {
                    alert("Kindly fill in your pincode(6 Digits)!");
                    Form.ResPIN.focus();
                    return false;
                }
                if (Form.ResType.value == "")
                {
                    alert("Please select residence type");
                    Form.ResType.focus();
                    return false;
                }
                if (Form.CurResSince.value == "")
                {
                    alert("Please enter current residence since");
                    Form.CurResSince.focus();
                    return false;
                }
                if (Form.EmpType.value == "")
                {
                    alert("Please select employment type");
                    Form.EmpType.focus();
                    return false;
                }
                if (Form.company_name.value == "")
                {
                    alert("Please enter company name");
                    Form.company_name.focus();
                    return false;
                }
                if (Form.OrgCategory.value == "")
                {
                    alert("Please select organization category");
                    Form.OrgCategory.focus();
                    return false;
                }
                if (Form.TotWrkExp.value == "")
                {
                    alert("Please enter total work experience");
                    Form.TotWrkExp.focus();
                    return false;
                }
                if (Form.CurCmpnyJoinDt.value == "")
                {
                    alert("Please enter current company join date");
                    Form.CurCmpnyJoinDt.focus();
                    return false;
                }
                if (Form.salary.value == "")
                {
                    alert("Please enter net monthly income");
                    Form.salary.focus();
                    return false;
                }
            }
        </script>
    </head>
    <body>
        <?php include "middle-menu.php"; ?>
        <div style="clear:both;"></div>
        <div class="cc_inner_wrapper">
            <div style="clear:both;"></div>
            <div class="common-bread-crumb" style="margin:auto; width:74%; margin-top:70px; color:#0a8bd9;"><u><a href="index.php" class="text12" style="color:#0080d6;" >Home</a></u> > <a href="#"  class="text12" style="color:#0080d6;"><u>Personal Loan</u></a> <span class="text12" style="color:#4c4c4c;">> Apply for Personal Loan</span></div>
            <div style="clear:both; height:15px;"></div>
            <div style="width:995px;  margin:auto;">
                <div id="content"><form name="cibil_form" method="post" action="/apply_rbl_pl_consent_thank.php"  onSubmit="return ckhcreditcard(document.cibil_form);">
                        <input type="hidden" name="requestid" id="requestid" value="<? echo $pl_requestid; ?>"/> 
						 <input type="hidden" name="rbl_irr" value="<? echo $rblinterestrate; ?>" id="rbl_irr">
						 <input type="hidden" name="rbl_lnamt" value="<? echo $rbl_lnamt; ?>" id="rbl_lnamt">
						 <input type="hidden" name="rbl_tnrmths" value="<? echo $rbl_tnrmths; ?>" id="rbl_tnrmths">
						 <input type="hidden" name="rbl_procfee" value="<? echo $rbl_procfee; ?>" id="rbl_procfee">
						<input type="hidden" name="City" id="City" value="<? echo $City; ?>"/>
                        <input type="hidden" name="source" id="source" value="<? echo $source; ?>"/>
                        <input type="hidden" name="pl_bank_name" id="pl_bank_name" value="<? echo $pl_bank_name; ?>"/>
                        <input type="hidden" name="Mobile_Number" id="Mobile_Number" value="<? echo $Mobile_Number; ?>"/>
                        <table align="center"  cellpadding="5" cellspacing="0"  width="100%">
                            <tr>
                                <td colspan="2"   bgcolor="#FFFFFF" class="heading_text" align="left">Fill in the below details to start your loan application process</td>
                            </tr>
                            <tr>
                                <td colspan="2" valign="middle" bgcolor="#FFFFFF" class="heading_text" height="40"> &nbsp;Enquiry Details</td></tr>
                            <tr>
                                <td class="sbi_text_c">Loan Amount:</td>
                                <td><input type="text" name="loan_amount" id="loan_amount" value="<? echo $loan_amount; ?>" maxlength="11" class="bajaj-fin_input" /></td></tr>
                            <tr>
                                <td colspan="2"  class="heading_text" height="40"> &nbsp;Personal Details</td></tr>
                            <tr>
                                <td class="sbi_text_c" height="25">Name:</td>
                                <td><input type="text" name="name" id="name" value="<? echo $name; ?>" class="bajaj-fin_input"/></td>
                            </tr>
                            <tr>
                                <td class="sbi_text_c" height="25">Email:</td><td><input type="text" name="Email" id="Email" value="<? echo $Email; ?>" class="bajaj-fin_input"/></td>
                            </tr>
                            <tr>
                                <td class="sbi_text_c" height="25">Mobile:</td><td><input type="text" name="Mobile" id="Mobile"  value="<? echo $Mobile_Number; ?>" maxlength="10" class="bajaj-fin_input"/></td>
                            </tr>
                            <tr>
                                <td class="sbi_text_c" height="25">DOB:</td>
                                <td><input type="text" name="dob" id="dob" value="<? echo $DOB; ?>" class="bajaj-fin_input"/></td>
                            </tr>
                            <tr>
                                <td width="205" class="sbi_text_c">Gender:</td>
                                <td width="273" class="sbi_text_c"><input type="radio" name="gender" id="gender" value="1" <?php if($gender ==1){ echo "checked";}?> />Male <input type="radio" name="gender" id="gender" value="2" <?php if($gender ==2){ echo "checked";}?>/>female</td>
                            </tr>
                            <tr>
                                <td class="sbi_text_c" height="25">Qualification:</td>
                                <td><select Name="qualification" class="bajaj-fin_input"><option value="">Select Qualification</option>
                                        <option value="1">Under Graduate</option>
                                        <option value="2">Graduate</option>
                                        <option value="3">Post Graduate</option>
                                        <option value="4">Professional</option>
                                        <option value="9999">Other</option>
                                    </select>
                                </td></tr>
                            <tr>
                                <td colspan="2" valign="middle" class="heading_text" height="40"> &nbsp;Identification</td>
                            </tr>
                            <tr>
                                <td class="sbi_text_c" height="25">PAN No:</td><td><input type="text" name="panno" id="panno" value="<?php echo $Pancard;?>" maxlength="10" class="bajaj-fin_input"/></td></tr>
                            <tr>
                                <td class="sbi_text_c" >Residence Address <br />(With Landmark):</td>
                                <td ><textarea rows="3" cols="21" name="caddress" id="caddress" class="bajaj-fin_txtinput"><?php echo $ResiAddress;?></textarea></td>
                            </tr>
                            <tr>
                                <td class="sbi_text_c" >Residence City :</td>
                                <td ><select name="ResCity" class="bajaj-fin_input">
                                        <option value="">Select City</option>
                                        <option value="Gurgaon">Gurgaon</option>
                                        <option value="Hyderabad">Hyderabad</option>
                                        <option value="Bengaluru">Bengaluru</option>
                                        <option value="Chennai">Chennai</option>
                                        <option value="Mumbai">Mumbai</option>
                                        <option value="Pune">Pune</option>
                                        <option value="Noida">Noida</option>
                                        <option value="Ghaziabad">Ghaziabad</option>
                                        <option value="Navi Mumbai">Navi Mumbai</option>
                                        <option value="New Delhi">New Delhi</option>
                                        <option value="Thane">Thane</option>
                                        <option value="Faridabad">Faridabad</option>
                                        <option value="Panvel">Panvel</option>
                                        <option value="Greater Noida">Greater Noida</option>
                                        <option value="Chandigarh">Chandigarh</option>
                                        <option value="Jaipur">Jaipur</option>
                                        <option value="Ahmedabad">Ahmedabad</option>
                                        <option value="Vadodara">Vadodara</option>
                                        <option value="Indore">Indore</option>
                                        <option value="69">Coimbatore</option>
                                        <option value="Coimbatore">Hubli</option>
                                        <option value="Tumkoor">Tumkoor</option>
                                        <option value="Nagpur">Nagpur</option>
                                        <option value="Secunderabad">Secunderabad</option>
                                        <option value="Surat">Surat</option>
                                        <option value="Bhopal">Bhopal</option>
                                        <option value="Hosur">Hosur</option>
                                        <option value="Kolhapur">Kolhapur</option>
                                        <option value="Salem">Salem</option>
                                        <option value="Sangli">Sangli</option>
                                        <option value="Vijayawada">Vijayawada</option>
                                        <option value="Vizag">Vizag</option>
                                        <option value="Chakan">Chakan</option>
                                    </select></td>
                            </tr>
                            <tr>
                                <td class="sbi_text_c" >Residence Pincode :</td>
                                <td ><input type="text" name="ResPIN" id="ResPIN" maxlength="6" value="<?php echo $Pincode;?>" class="bajaj-fin_input"/></td>
                            </tr>
                            <tr>
                                <td class="sbi_text_c" >Residence Type :</td>
                                <td><select Name="ResType" class="bajaj-fin_input"><option value="">Select Residence Type</option>
                                        <option value="1" <?php if($Residential_Status==1) { echo "selected";}?>>Owned by Self-Spouse</option>
                                        <option value="2" <?php if($Residential_Status==2) { echo "selected";}?>>Owned by Parents/Sibling</option>
                                        <option value="3"<?php if($Residential_Status==3) { echo "selected";}?>>Owned by Relative</option>
                                        <option value="4"<?php if($Residential_Status==4) { echo "selected";}?>>Rented with Family</option>
                                        <option value="5"<?php if($Residential_Status==5) { echo "selected";}?>>Rented with Friends</option>
                                        <option value="6"<?php if($Residential_Status==6) { echo "selected";}?>>Rented- Staying Alone</option>
                                        <option value="7"<?php if($Residential_Status==7) { echo "selected";}?>>Guest House</option>
                                        <option value="8"<?php if($Residential_Status==8) { echo "selected";}?>>Hostel</option>
                                        <option value="9"<?php if($Residential_Status==9) { echo "selected";}?>>Company Lease</option>
                                    </select></td>
                            </tr>
                            <tr>
                                <td class="sbi_text_c" height="25">Current Residence Since:</td><td><input type="text" name="CurResSince" id="CurResSince" class="bajaj-fin_input" placeholder="dd-mm-yyyy" /></td>
                            </tr>
                            <tr>
                                <td class="sbi_text_c" height="25">Employment Type:</td>
                                <td><select Name="EmpType" class="bajaj-fin_input"><option value="">Select Employment Type</option>
                                        <option value="1">Salaried: Account Transfer</option>
                                        <option value="2">Salaried: By Cheque</option>
                                        <option value="3">Salaried: By Cash</option>
                                        <option value="4">Self employed</option>
                                        <option value="5">Others</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" valign="middle" class="heading_text"> &nbsp;Employer Details</td>
                            </tr>
                            <tr>
                                <td class="sbi_text_c" height="25">Company Name:</td>
                                <td><input type="text" name="company_name" id="company_name" value="<? echo $company_name; ?>" class="bajaj-fin_input"/></td>
                            </tr>

                            <tr>
                                <td class="sbi_text_c" height="25">Organization Category:</td>
                                <td><select Name="OrgCategory" class="bajaj-fin_input"><option value="">Select Organization Category</option>
                                        <option value="1" <?php if($Company_Type==1) { echo "selected";}?>>Public Ltd</option>
                                        <option value="2"<?php if($Company_Type==2) { echo "selected";}?>>Private Ltd</option>
                                        <option value="3"<?php if($Company_Type==3) { echo "selected";}?>>MNC</option>
                                        <option value="4"<?php if($Company_Type==4) { echo "selected";}?>>Central/State Govt</option>
                                        <option value="5"<?php if($Company_Type==5) { echo "selected";}?>>Proprietorship</option>
                                        <option value="6"<?php if($Company_Type==6) { echo "selected";}?>>LLP</option>
                                        <option value="7"<?php if($Company_Type==7) { echo "selected";}?>>Partnership firm</option>
                                        <option value="8"<?php if($Company_Type==8) { echo "selected";}?>>Others including Society/Trust/AOP</option>
                                    </select></td>
                            </tr>
                            <tr>
                                <td class="sbi_text_c" height="25">Total Work Experience:</td>
                                <td><input type="text" name="TotWrkExp" id="TotWrkExp" value="<? echo $TotWrkExp; ?>" class="bajaj-fin_input"/></td>
                            </tr>
                            <tr>
                                <td class="sbi_text_c" height="25">Current Company Join Date: </td>
                                <td><input type="text" name="CurCmpnyJoinDt" id="CurCmpnyJoinDt" value="" class="bajaj-fin_input" placeholder="dd-mm-yyyy"/></td>
                            </tr>
                            <tr>
                                <td class="sbi_text_c" height="25">Net Monthly Salary:</td>
                                <td><input type="text" name="salary" id="salary" value="<?php echo $salary;?>" class="bajaj-fin_input"/></td>
                            </tr>
                            <tr>
                                <td colspan="2" align="center"><input type="submit" style="border: 0px none ; background-image: url(new-images/submit_details.jpg); width: 153px; height: 47px; margin-bottom: 0px;" value=""/></td>
                            </tr>
                            <!--<tr><td colspan="2" class="sbi_text_c" style="color:#333333; font-weight:normal;"><b>Disclaimer</b> : By submitting the above details you are authorizing Bajaj Finserv Lending to run a CIBIL check on your profile
                        </td></tr>-->
                        </table></form>    
                </div>    
                <div id="sidebar">
                    <div class="widget">
                        <table width="100%" align="center" cellpadding="0" cellspacing="0">
                            <tr>
                                <td width="58%" height="40" class="heading_text1" style="font-size:18px;"><span class="heading_text_b">Why <? echo $pl_bank_name; ?>?</span></td>
                                <td width="42%" align="right" class="heading_text1" style="font-size:18px;"></td>
                            </tr>
                            <tr>
                                <td colspan="2" style="color:#999; font-family:Verdana, Geneva, sans-serif; font-size:12px;">&nbsp;</td>
                            </tr>
                        </table>
                        <!--<div class="sbi_text_bullet">
                    <ul>
                  <li>Loans up to Rs.18 lacs<br/>
                  <div style="font-size:11px; color:#999; font-weight:normal; line-height:15px;">Bold dreams need big means. We offer the highest ticket size of up to 25 lacs so that you can pursue your bold dreams. This is the highest ticket size that anyone offers in this category.</div></li>
                  <li>Step Down Interest Rate
                  <br/>
                  <div style="font-size:11px; color:#999; font-weight:normal; line-height:15px;">0.20% reduction in IRR in year 2 and year 3 (only for 2 yrs).
                  </div>
                  </li>
                  <li>Part Prepayment facility
                  <br/>
                  <div style="font-size:11px; color:#999; font-weight:normal; line-height:15px;">You can prepay upto 6 times in a calendar year at any interval with the minimum amount per prepay transaction being not less than 3 EMIs. There is no limit on the maximum amount. This is subject to your clearing your first EMI. 
                  </div>
                  </li>
                  <li>Nil Foreclosure charges
                  <br/>
                  <div style="font-size:11px; color:#999; font-weight:normal; line-height:15px;">Now you can choose to foreclose your loan anytime during your loan tenor without paying any foreclosure charges. 
                  </div>
                  </li>
                  <li>Access to best Relationship Manager
                  <br/>
                  <div style="font-size:11px; color:#999; font-weight:normal; line-height:15px;">Get best service from quality sales representative.
                  </div>
                  </li>
                  </ul>  
                  </div>-->
                    </div>
                </div>
            </div>

            <div style="clear:both;"></div>
            <!--partners-->
            <?php
            $REMOVE_ADD = 1;
            include("footer_sub_menu.php");
            ?>
    </body>
    <!--DatePicker Start-->
		<link rel="stylesheet" type="text/css" href="/callinglms/css-datepicker/jquery-ui.css">
		<link rel="stylesheet" type="text/css" href="/callinglms/css-datepicker/datepicker.css">
		<script src="/callinglms/js-datepicker/jquery-1.5.1.js"></script>
		<script src="/callinglms/js-datepicker/jquery.ui.core.js"></script>
		<script src="/callinglms/js-datepicker/jquery.ui.datepicker.js"></script>
		<script>
		$(document).ready(function() {
			
			var date = new Date();
			var m = date.getMonth(), d = date.getDate(), y = date.getFullYear();
			
			$('#CurResSince').datepicker({
					maxDate: new Date(y, m, d),
                                        yearRange: 'c-65:c+0',
					changeMonth: true,
					changeYear: true,
					dateFormat: 'dd-mm-yy'
			});
                        $('#CurCmpnyJoinDt').datepicker({
					maxDate: new Date(y, m, d),
                                        yearRange: 'c-45:c+0',
					changeMonth: true,
					changeYear: true,
					dateFormat: 'dd-mm-yy'
			});
			}); 
			$(function() {
				$( "#CurResSince" ).datepicker();
				
			});
                        $(function() {
				$( "#CurCmpnyJoinDt" ).datepicker();
				
			});
			
		</script> 
                <!--End Date picker-->
</html>