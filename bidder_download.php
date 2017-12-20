<?php
require 'scripts/session_check_online.php';
require 'scripts/db_init.php';
require 'scripts/functions.php';
//echo $BidderIDstatic;
$session_id = session_id();
if (isset($_POST['BidderIDstatic']) && strlen($_POST['BidderIDstatic']) > 0) {
    $BidderIDstatic = $_REQUEST['BidderIDstatic'];
} else {
    $BidderIDstatic = $BidderIDstatic;
}
$session_id = session_id();
//echo "hello".$BidderIDstatic;
$qry1 = $_POST["qry1"];
$qry2 = $_POST["qry2"];

list($mindate, $mintime) = split(" ", $_POST["min_date"]);
list($maxdate, $maxtime) = split(" ", $_POST["max_date"]);
//$maxdate=$_POST["max_date"];
if (date("l") == "Monday") {
    $yesterday = mktime(0, 0, 0, date("m"), date("d") - 2, date("Y"));
} else {
    $yesterday = mktime(0, 0, 0, date("m"), date("d") - 2, date("Y"));
}
$daytwo = date('Y-m-d', $yesterday);
$datediffvarL = datevardiff($daytwo, $mindate);

if ($datediffvarL <= 2 && $datediffvarL >= 0) {
    $datediffvar = datevardiff($mindate, $maxdate);
} else {
    $datediffvar = 3;
}

function datevardiff($firstTime, $lastTime) {
    $firstTime = strtotime($firstTime);
    $lastTime = strtotime($lastTime);
    $timeDiff = ($lastTime - $firstTime) / 86400;
    return $timeDiff;
}
function getApiStatus($statusVal){
    if($statusVal=='1'){
        $StatusRes="AIP APPROVED";
    }elseif($statusVal=='2'){
        $StatusRes="ELIGIBLE FOR LOWER EMI";
    }elseif($statusVal=='3'){
        $StatusRes="AIP REJECT";
    }elseif($statusVal=='0'){
        $StatusRes="FAILURE/ERROR";
    }
    return $StatusRes;
    
}

function clean($string) {
	return preg_replace('/[^A-Za-z0-9\-]/', ' ', $string); // Removes special chars.
}

function RemoveBS($Str) {  
  $StrArr = str_split($Str); $NewStr = '';
  foreach ($StrArr as $Char) {    
    $CharNo = ord($Char);
    //if ($CharNo == 163) { $NewStr .= $Char; continue; } // keep £ 
    if ($CharNo > 31 && $CharNo < 127) {
      $NewStr .= $Char;    
    }
  }  
  return $NewStr;
}

$qry1 = str_replace("\'", "'", $qry1);

$search_result = ExecQuery($qry1);
$exclusiveLead = '';
while ($row_result = mysql_fetch_array($search_result)) {
    if ($qry2 == "Req_Loan_Personal") {
        //clause to hide mobile number
        /*if ($BidderIDstatic == 2679) {
			//$contactNo = "";
           $contactNo = $row_result["Mobile_Number"];
            //$uniqueid="PL".$row_result["RequestID"]."CMP";
            $uniqueid = "PL" . $row_result["Feedback_ID"] . "S" . $row_result['sentbidder'];
        } else {*/
            if ($datediffvar <= 1) {
                $contactNo = $row_result["Mobile_Number"]; //$uniqueid="PL".$row_result["RequestID"]."CMP";
                $uniqueid = "PL" . $row_result["Feedback_ID"] . "S" . $row_result['sentbidder'];
            } else {
                $contactNo = "";
                //$uniqueid="PL".$row_result["RequestID"]."CMP";
                $uniqueid = "PL" . $row_result["Feedback_ID"] . "S" . $row_result['sentbidder'];
            }
            
            if($BidderIDstatic==2680){
                //$contactNo = $row_result["Mobile_Number"];
               $uniqueid = "PL" . $row_result["Feedback_ID"] . "S" . $row_result['sentbidder'];
            }
            if($BidderIDstatic==7239){
               $uniqueid = $row_result["ReferenceID"];  
            }
            
        //}

        $exclusiveLead = '';
        $residential_status = '';
        if ($row_result["Bidder_Count"] == 1) {
            $exclusiveLead = "Exclusive Lead";
        }

        list($Salary, $exts) = split('[.]', $row_result["Net_Salary"]);
        list($Loan_Amount, $extla) = split('[.]', $row_result["Loan_Amount"]);

        if ($row_result["Annual_Turnover"] == 1) {
            $annual_turnover = "0-40 Lacs";
        } else if ($row_result["Annual_Turnover"] == 2) {
            $annual_turnover = "1Cr - 3Crs";
        } else if ($row_result["Annual_Turnover"] == 3) {
            $annual_turnover = "3Crs & above";
        } else if ($row_result["Annual_Turnover"] == 4) {
            $annual_turnover = "40Lacs To 1 Cr";
        } else {
            $annual_turnover = "";
        }

        if ($BidderIDstatic == 2998 || $BidderIDstatic == 2999 || $BidderIDstatic == 3000 || $BidderIDstatic == 3001 || $BidderIDstatic == 3002 || $BidderIDstatic == 3003 || $BidderIDstatic == 3004 || $BidderIDstatic == 3005 || $BidderIDstatic == 3006 || $BidderIDstatic == 3007 || $BidderIDstatic == 3008 || $BidderIDstatic == 3009 || $BidderIDstatic == 3010 || $BidderIDstatic == 3011 || $BidderIDstatic == 3012 || $BidderIDstatic == 3013 || $BidderIDstatic == 3014 || $BidderIDstatic == 3015 || $BidderIDstatic == 2997 || $BidderIDstatic == 3801 || $BidderIDstatic == 3654 || $BidderIDstatic == 5356 
       ) {
            if ($row_result["Feedback"] == "Closed") {
                $feedback = "Disbursed";
            } elseif ($row_result["Feedback"] == "Process") {
                $feedback = "Login";
            } else {
                $feedback = $row_result["Feedback"];
            }
        } else {
            $feedback = $row_result["Feedback"];
        }

        if ($row_result["Employment_Status"] == 0) {
            $emp_status = "Self Employed";
        } else {
            $emp_status = "Salaried";
        }
        if ($row_result["Residential_Status"] == 1) {
            $residential_status = "Owned By Parent/Sibling";
        }
        if ($row_result["Residential_Status"] == 2) {
            $residential_status = "Rented - Staying Alone";
        }
        if ($row_result["Residential_Status"] == 3) {
            $residential_status = "Company Provided";
        }
        if ($row_result["Residential_Status"] == 4) {
            $residential_status = "Owned By Self/Spouse";
        }
        if ($row_result["Residential_Status"] == 5) {
            $residential_status = "Rented - With Family";
        }
        if ($row_result["Residential_Status"] == 6) {
            $residential_status = "Rented - With Friends";
        }
        if ($row_result["Residential_Status"] == 7) {
            $residential_status = "Paying Guest";
        }
        if ($row_result["Residential_Status"] == 8) {
            $residential_status = "Hostel";
        }

        if ($row_result["CC_Holder"] == 1) {
            $cc_holder = "Yes";
        }
        if ($row_result["CC_Holder"] == 0) {
            $cc_holder = "No";
        }

        if ($row_result["EMI_Paid"] == 1) {
            $emi_paid = "Less than 6 months";
        } elseif ($row_result["EMI_Paid"] == 2) {
            $emi_paid = "6 to 9 months";
        } elseif ($row_result["EMI_Paid"] == 3) {
            $emi_paid = "9 to 12 months";
        } elseif ($row_result["EMI_Paid"] == 4) {
            $emi_paid = "more than 12 months";
        } else {
            $emi_paid = "";
        }
        if ($row_result["Card_Vintage"] == 1) {
            $card_vintage = "Less than 6 months";
        } elseif ($row_result["Card_Vintage"] == 2) {
            $card_vintage = "6 to 9 months";
        } elseif ($row_result["Card_Vintage"] == 3) {
            $card_vintage = "9 to 12 months";
        } elseif ($row_result["Card_Vintage"] == 4) {
            $card_vintage = "more than 12 months";
        } else {
            $card_vintage = "";
        }

        if ($row_result["Salary_Drawn"] == 0) {
            $Salary_Drawn = "Not available";
        }
        if ($row_result["Salary_Drawn"] == 1) {
            $Salary_Drawn = "Cash";
        }
        if ($row_result["Salary_Drawn"] == 2) {
            $Salary_Drawn = "Cheque";
        }
        if ($row_result["Salary_Drawn"] == 3) {
            $Salary_Drawn = "Account Transfer";
        }

        if ($row_result["Company_Type"] == 0) {
            $Company_Type = "";
        }
        if ($row_result["Company_Type"] == 1) {
            $Company_Type = "Pvt Ltd";
        }
        if ($row_result["Company_Type"] == 2) {
            $Company_Type = "MNC Pvt Ltd";
        }
        if ($row_result["Company_Type"] == 3) {
            $Company_Type = "Limited";
        }
        if ($row_result["Company_Type"] == 4) {
            $Company_Type = "Govt.( Central/State )";
        }
        if ($row_result["Company_Type"] == 5) {
            $Company_Type = "PSU (Public sector Undertaking)";
        }

        if ($row_result["eligible"] == 1) {
            $eligible = "Yes";
        } elseif ($row_result["eligible"] == 2) {
            $eligible = "No";
        } else {
            $eligible = " ";
        }

        if ($row_result["interest_stat"] == 1) {
            $interest_stat = "Yes";
        } elseif ($row_result["interest_stat"] == 2) {
            $interest_stat = "No";
        } else {
            $interest_stat = " ";
        }
        $Dateofallocation = $row_result["Allocation_Date"];

        if (strlen($row_result["Hdfc_Eligibility"]) > 0) {
            $hdfceligibility = $row_result["Hdfc_Eligibility"];
        } else {
            $hdfceligibility = "Not Eligibile";
        }

        if (strlen($row_result["Citibank_Eligibility"]) > 0) {
            $citieligibility = $row_result["Citibank_Eligibility"];
        } else {
            $citieligibility = "Not Eligibile";
        }

        if (strlen($row_result["Barclays_Eligibility"]) > 0) {
            $barclayeligibility = $row_result["Barclays_Eligibility"];
        } else {
            $barclayeligibility = "Not Eligibile";
        }

        $dob = $row_result["DOB"];

        $keyFBidders = '';
        $bidderSql = "select Bidders_List.BidderID as BidderID from Bidders_List left join Bidders on Bidders.BidderID = Bidders_List.BidderID and Bidders_List.Reply_Type=1 and Bidders_List.Restrict_Bidder=1 and Bidders_List.BankID=17 where (Bidders_List.Reply_Type=1 and Bidders_List.Restrict_Bidder=1 and Bidders_List.BankID=17 and Bidders.Define_PrePost='PostPaid')";
        $bidderQuery = ExecQuery($bidderSql);
        $numbidder = mysql_num_rows($bidderQuery);
        $arrBidderID = '';
        for ($i = 0; $i < $numbidder; $i++) {
            $BidID = mysql_result($bidderQuery, $i, 'BidderID');
            $arrBidderID[] = $BidID;
        }

        $keyFBidders = array_search($BidderIDstatic, $arrBidderID);
        if (strlen($keyFBidders) > 0) {
            $getAppointmentSql = "SELECT address_apt,changeapp_time,appdate,docs FROM fil_appointments where RequestID='" . $row_result["RequestID"] . "'";
            $getAppointmentQuery = ExecQuery($getAppointmentSql);
            $getAppointmentNum = mysql_num_rows($getAppointmentQuery);
            if ($getAppointmentNum > 0) {
                $address_apt = mysql_result($getAppointmentQuery, 0, 'address_apt');
                $changeapp_time = mysql_result($getAppointmentQuery, 0, 'changeapp_time');
                $time = '';
                if ($changeapp_time == "08:00:00") {
                    $time = "8(am)-9(am)";
                } else if ($changeapp_time == "09:00:00") {
                    $time = "9(am)-10(am)";
                } else if ($changeapp_time == "10:00:00") {
                    $time = "10(am)-11(am)";
                } else if ($changeapp_time == "11:00:00") {
                    $time = "11(am)-12(pm)";
                } else if ($changeapp_time == "12:00:00") {
                    $time = "12(pm)-1(pm)";
                } else if ($changeapp_time == "13:00:00") {
                    $time = "1(pm)-2(pm)";
                } else if ($changeapp_time == "14:00:00") {
                    $time = "2(pm)-3(pm)";
                } else if ($changeapp_time == "15:00:00") {
                    $time = "3(pm)-4(pm)";
                } else if ($changeapp_time == "16:00:00") {
                    $time = "4(pm)-5(pm)";
                } else if ($changeapp_time == "17:00:00") {
                    $time = "5(pm)-6(pm)";
                } else if ($changeapp_time == "18:00:00") {
                    $time = "6(pm)-7(pm)";
                } else if ($changeapp_time == "19:00:00") {
                    $time = "7(pm)-8(pm)";
                }

                $appdate = mysql_result($getAppointmentQuery, 0, 'appdate');
                $docs = mysql_result($getAppointmentQuery, 0, 'docs');
                $apt_dt = $appdate . ", " . $time;
            }

            $qry1 = "insert into temp (session_id, name, dob, email, emp_status, c_name, city, city_other, year_in_comp, total_exp, mobile_number,net_salary, residential_status, loan_any, emi_paid, cc_holder, loan_amount, Feedback, count_views, count_replies, is_modified, is_processed, pincode, doe, card_vintage, card_limit,ip_address,add_comment,Documents, employer, plan_interested, descr, login_date, apt_dt, docs, address_apt, current_age ,car_make, car_model, car_type, unique_id ) values ('" . $session_id . "', '" . $row_result["Name"] . "', '" . $dob . "', '" . $row_result["Email"] . "', '" . $emp_status . "', '" . $row_result["Company_Name"] . "', '" . $row_result["City"] . "', '" . $row_result["City_Other"] . "', '" . $row_result["Years_In_Company"] . "', '" . $row_result["Total_Experience"] . "', '" . $contactNo . "',  '" . $row_result["Net_Salary"] . "','" . $residential_status . "', '" . $row_result["Loan_Any"] . "', '" . $emi_paid . "', '" . $cc_holder . "', '" . $Loan_Amount . "', '" . $row_result["Feedback"] . "', '" . $hdfceligibility . "', '" . $citieligibility . "', '" . $barclayeligibility . "', '" . $row_result["PL_EMI_Amt"] . "', '" . $row_result["Pincode"] . "', '" . $Dateofallocation . "', '" . $card_vintage . "', '" . $row_result["Card_Limit"] . "','" . $row_result["IP_Address"] . "','" . $row_result["comment_section"] . "','" . $row_result["identification_proof"] . "','" . $eligible . "','" . $interest_stat . "','" . $row_result["post_login_stat"] . "','" . $row_result["last_update_dated"] . "', '" . $apt_dt . "', '" . $docs . "', '" . $address_apt . "','" . $exclusiveLead . "', '" . $row_result["Existing_Bank"] . "', '" . $row_result["Existing_Loan"] . "', '" . $row_result["Existing_ROI"] . "', '" . $uniqueid . "')";
        } else if ($BidderIDstatic == 2896 || $BidderIDstatic == 2923 || $BidderIDstatic == 2924 || $BidderIDstatic == 2925 || $BidderIDstatic == 2926 || $BidderIDstatic == 2927 || $BidderIDstatic == 2929 || $BidderIDstatic == 2930 || $BidderIDstatic == 2931 || $BidderIDstatic == 2932 || $BidderIDstatic == 2933 || $BidderIDstatic == 2934 || $BidderIDstatic == 3994 || $BidderIDstatic == 3995 || $BidderIDstatic == 3996 || $BidderIDstatic == 3997 || $BidderIDstatic == 3998 || $BidderIDstatic == 3999) {
            $getcompany = 'select icici_bank from pl_company_list where company_name="' . $row_result["Company_Name"] . '"';
            $getcompanyresult = ExecQuery($getcompany);
            $cmprow = mysql_fetch_array($getcompanyresult);

            $qry1 = "insert into temp (session_id, name, dob, email, emp_status, c_name, city, city_other, year_in_comp, total_exp, mobile_number, net_salary, residential_status, loan_any, emi_paid, cc_holder, loan_amount, Feedback, count_views, count_replies, is_modified, is_processed, pincode, doe, card_vintage, card_limit,ip_address,add_comment,Documents,residence_address, bank_name,property_type,address_apt, referred_page, current_age, car_make, car_model, car_type, unique_id) values ('" . $session_id . "', '" . $row_result["Name"] . "', '" . $dob . "', '" . $row_result["Email"] . "', '" . $emp_status . "', '" . $row_result["Company_Name"] . "', '" . $row_result["City"] . "', '" . $row_result["City_Other"] . "', '" . $row_result["Years_In_Company"] . "', '" . $row_result["Total_Experience"] . "', '" . $contactNo . "', '" . $Salary . "', '" . $residential_status . "', '" . $row_result["Loan_Any"] . "', '" . $emi_paid . "', '" . $cc_holder . "', '" . $Loan_Amount . "', '" . $row_result["Feedback"] . "', '" . $hdfceligibility . "', '" . $citieligibility . "', '" . $barclayeligibility . "', '" . $row_result["PL_EMI_Amt"] . "', '" . $row_result["Pincode"] . "', '" . $Dateofallocation . "', '" . $card_vintage . "', '" . $row_result["Card_Limit"] . "','" . $row_result["IP_Address"] . "','" . $row_result["comment_section"] . "','" . $row_result["identification_proof"] . "','" . $row_result["Residence_Address"] . "','" . $row_result["Primary_Acc"] . "','" . $Company_Type . "','" . $Salary_Drawn . "','" . $cmprow["icici_bank"] . "','" . $exclusiveLead . "', '" . $row_result["Existing_Bank"] . "', '" . $row_result["Existing_Loan"] . "', '" . $row_result["Existing_ROI"] . "', '" . $uniqueid . "')";
        } else {
            if ($BidderIDstatic == 4505 || $BidderIDstatic == 5202) {
                $citiuniqueid = "D4L" . $row_result["Feedback_ID"] . "PL";
            }


//IndusInd Bank		
            if ($BidderIDstatic == 4093) {
                $asmtype = "";
                if ($row_result['sentbidder'] == "5168") {
                    $asmtype = "VITTHAL PAWAR";
                    $smtype = "Vicky Surve";
                } else if ($row_result['sentbidder'] == "4090") {
                    $asmtype = "Nikhil";
                }else if ($row_result['sentbidder'] == "4091") {
                    $asmtype = "WASIM PATEL";
                    $smtype = "Upendra Thakare";
                } else if ($row_result['sentbidder'] == "5937") {
                    $asmtype = "Sunil";
                } else if ($row_result['sentbidder'] == "4087") {
                    $asmtype = "ANAND M";
                    $smtype = "Srikantha";
                } else if ($row_result['sentbidder'] == "6046") {
                    $asmtype = "Anand M";
                } else if ($row_result['sentbidder'] == "6047") {
                    $asmtype = "Mahesh V";
                } else if ($row_result['sentbidder'] == "6048") {
                    $asmtype = "Vishwa";
                }else if ($row_result['sentbidder'] == "4083") {
                    $asmtype = "Dimple";
                    $smtype = "Navraj";
                }else if ($row_result['sentbidder'] == "4089") {
                    $asmtype = "Prashanti";
                    $smtype = "T Vamshith";
                }else if ($row_result['sentbidder'] == "6113") {
                    $asmtype = "Lavanya";
                    $smtype = "T Vamshith";
                }else if ($row_result['sentbidder'] == "6645") {
                    $asmtype = "Shristi";
                    $smtype = "Anuj Gupta";
                }else if ($row_result['sentbidder'] == "6646") {
                    $asmtype = "Saurabh";
                    $smtype = "Navraj";
                }else if ($row_result['sentbidder'] == "6647") {
                    $asmtype = "SUDHA A G";
                    $smtype = "Srikantha";
                }else if ($row_result['sentbidder'] == "6648") {
                    $asmtype = "RAHUL KUMAR";
                    $smtype = "Srikantha";
                }else if ($row_result['sentbidder'] == "6649") {
                    $asmtype = "AJIT KUMAR BAL";
                    $smtype = "Srikantha";
                }else if ($row_result['sentbidder'] == "6650") {
                    $asmtype = "Gangadhar";
                    $smtype = "Srikantha";
                }else if ($row_result['sentbidder'] == "6651") {
                    $asmtype = "VANITHA K";
                    $smtype = "Srikantha";
                }else if ($row_result['sentbidder'] == "6652") {
                    $asmtype = "RADHEESH";
                    $smtype = "Srikantha";
                }else if ($row_result['sentbidder'] == "6653") {
                    $asmtype = "PREETI SINGH";
                    $smtype = "Vicky Surve";
                }else if ($row_result['sentbidder'] == "6654") {
                    $asmtype = "IMRAN KHAN";
                    $smtype = "Vicky Surve";
                }else if ($row_result['sentbidder'] == "6655") {
                    $asmtype = "PRIYANKA MISHRA";
                    $smtype = "Vicky Surve";
                }else if ($row_result['sentbidder'] == "6656") {
                    $asmtype = "Mangesh Hingne";
                    $smtype = "Upendra Thakare";
                }else if ($row_result['sentbidder'] == "4088") {
                    $asmtype = "Kalpana V";
                    $smtype = "Deepak";
                }else if ($row_result['sentbidder'] == "5815") {
                    $asmtype = "Dushant";

                } else {
                    $asmtype = "";
                    $smtype = "";
                }
            }
            if ($BidderIDstatic == 6078) {
                $asmtype = "";
                if ($row_result['sentbidder'] == "6301") {
                    $asmtype = "Rohith Kumar";
                } else if ($row_result['sentbidder'] == "6302") {
                    $asmtype = "Rajshekar H";
                } else if ($row_result['sentbidder'] == "6303") {
                    $asmtype = "Mohan Naik";
                }
            }

//HDFC Bank
            if ($BidderIDstatic == 2663 || $BidderIDstatic == 6279 || $BidderIDstatic == 6387 || $BidderIDstatic == 7180 || $BidderIDstatic == 7236 || $BidderIDstatic == 5373) {
                $asmtype = "";
                if ($row_result['sentbidder'] == "1888") {
                    $asmtype = "Gulbeer";
                    $smtype = "Gulbeer";
                } else if ($row_result['sentbidder'] == "1891") {
                    $asmtype = "Manali";
                    $smtype = "Animesh Mukherjee";
                } else if ($row_result['sentbidder'] == "1950") {
                    $asmtype = "Pratima Kumari";
                    $smtype = "Atul Tripathi";
                } else if ($row_result['sentbidder'] == "5933") {
                    $asmtype = "Neha";
                    $smtype = "Atul Tripathi";
                } else if ($row_result['sentbidder'] == "5934") {
                    $asmtype = "Vijender";
                    $smtype = "Gulbeer";
                } else if ($row_result['sentbidder'] == "5935") {
                    $asmtype = "Vandana";
                    $smtype = "Ankur Aggarwal";
                } else if ($row_result['sentbidder'] == "1957") {
                    $asmtype = "Shweta";
                    $smtype = "Shani Jaiswal";
                } else if ($row_result['sentbidder'] == "1958") {
                    $asmtype = "Ashutosh Tiwari";
                    $smtype = "Narender Kumar";
                } else if ($row_result['sentbidder'] == "2626") {
                    $asmtype = "Shainy";
                    $smtype = "Anuradha";
                } else if ($row_result['sentbidder'] == "2627") {
                    $asmtype = "Mamatha";
                    $smtype = "Shahid";
                } else if ($row_result['sentbidder'] == "2628") {
                    $asmtype = "Vijay";
                    $smtype = "Sonia";
                } else if ($row_result['sentbidder'] == "2629") {
                    $asmtype = "Susmita";
                    $smtype = "Prasanthi";
                } else if ($row_result['sentbidder'] == "3036") {
                    $asmtype = "Vinya";
                    $smtype = "Harish Kumar";
                } else if ($row_result['sentbidder'] == "5724") {
                    $asmtype = "Archana";
                    $smtype = "Harish Kumar";
                } else if ($row_result['sentbidder'] == "5725") {
                    $asmtype = "Lavanya";
                    $smtype = "Harish Kumar";
                } else if ($row_result['sentbidder'] == "4403") {
                    $asmtype = "Padmarao";
                    $smtype = "Jyothi Alla";
                } else if ($row_result['sentbidder'] == "4648") {
                    $asmtype = "Renu";
                    $smtype = "Amit Kumar";
                } else if ($row_result['sentbidder'] == "4804") {
                    $asmtype = "Eshwari";
                    $smtype = "Prasanthi";
                } else if ($row_result['sentbidder'] == "5717") {
                    $asmtype = "Sreenu";
                    $smtype = "Jyothi Alla";
                } else if ($row_result['sentbidder'] == "5204") {
                    $asmtype = "Eswari";
                    $smtype = "Rajkumar";
                } else if ($row_result['sentbidder'] == "5732") {
                    $asmtype = "Sarumathi";
                    $smtype = "Arul";
                } else if ($row_result['sentbidder'] == "5733") {
                    $asmtype = "Geetha";
                    $smtype = "Sonia";
                } else if ($row_result['sentbidder'] == "5313") {
                    $asmtype = "Gulbeer";
                    $smtype = "Gulbeer";
                } else if ($row_result['sentbidder'] == "5314") {
                    $asmtype = "Jayashree";
                    $smtype = "Amey";
                } else if ($row_result['sentbidder'] == "5315") {
                    $asmtype = "Diptika Kadam";
                    $smtype = "Dhananjay";
                } else if ($row_result['sentbidder'] == "5382") {
                    $asmtype = "Shruti";
                    $smtype = "Atul Tripathi";
                } else if ($row_result['sentbidder'] == "4939") {
                    $asmtype = "AmitP Rana";
                } else if ($row_result['sentbidder'] == "4962") {
                    $asmtype = "Avanish Dwivedi";
                } else if ($row_result['sentbidder'] == "5066") {
                    $asmtype = "AmitP Sharma";
                } else if ($row_result['sentbidder'] == "4943") {
                    $asmtype = "Apurv Vijay Wargiya";
                } else if ($row_result['sentbidder'] == "4951") {
                    $asmtype = "Bilal Ahmad";
                } elseif ($row_result["sentbidder"] == "5454") {
                    $asmtype = "Pundalik";
                    $smtype = "Dhananjay";
                } elseif ($row_result["sentbidder"] == "6631") {
                    $asmtype = "Savita";
                    $smtype = "Dhananjay";
                } elseif ($row_result["sentbidder"] == "5456") {
                    $asmtype = "Maya Sinde";
                    $smtype = "Shani jaiswal";
                } elseif ($row_result["sentbidder"] == "6044") {
                    $asmtype = "Yeknath";
                    $smtype = "Amey";
                } elseif ($row_result["sentbidder"] == "5408") {
                    $asmtype = "Pallavi Salaskar";
                    $smtype = "Dhananjay";
                } elseif ($row_result["sentbidder"] == "6002") {
                    $asmtype = "Radha";
                    $smtype = "Harish Kumar";
                } elseif ($row_result["sentbidder"] == "6630") {
                    $asmtype = "Vinitha";
                    $smtype = "Shahid";
                } elseif ($row_result["sentbidder"] == "6159") {
                    $asmtype = "Tanya";
                    $smtype = "Sujit";
                } elseif ($row_result["sentbidder"] == "6287") {
                    $asmtype = "Priyanka";
                    $smtype = "Sarath Chandra";
                } elseif ($row_result["sentbidder"] == "6288") {
                    $asmtype = "Sruti";
                    $smtype = "Biswajit Sahoo";
                } elseif ($row_result["sentbidder"] == "6289") {
                    $asmtype = "Prema";
                    $smtype = "Nilavazhagan";
                } elseif ($row_result["sentbidder"] == "6384") {
                    $asmtype = "Arti";
                    $smtype = "Prashant";
                } elseif ($row_result["sentbidder"] == "6413") {
                    $asmtype = "Rana";
                    $smtype = "Animesh mukherjee";
                } elseif ($row_result["sentbidder"] == "6477") {
                    $asmtype = "Jahara";
                    $smtype = "Jyothi Alla";
                } elseif ($row_result["sentbidder"] == "6511") {
                    $asmtype = "Pallawi";
                    $smtype = "Pawan Shinde";
                }elseif ($row_result["sentbidder"] == "6519") {
                    $asmtype = "Swati";
                    $smtype = "Pawan Shinde";
                } elseif ($row_result["sentbidder"] == "6639") {
                    $asmtype = "Maya";
                    $smtype = "Nupur";
                } elseif ($row_result["sentbidder"] == "6640") {
                    $asmtype = "Irfan Khan";
                    $smtype = "Ronald";
                } elseif ($row_result["sentbidder"] == "6441") {
                    $asmtype = "Sarala";
                    $smtype = "Abdul";
                }elseif ($row_result["sentbidder"] == "6642") {
                    $asmtype = "Guna";
                    $smtype = "Arul";
                }elseif ($row_result["sentbidder"] == "6643") {
                    $asmtype = "Prasanthi";
                    $smtype = "Prasanthi";
                }elseif ($row_result["sentbidder"] == "6644") {
                    $asmtype = "Shivani";
                    $smtype = "Vikash";
                }elseif ($row_result["sentbidder"] == "6670") {
                    $asmtype = "Priyanka";
                    $smtype = "Prasanthi";
                }elseif ($row_result["sentbidder"] == "6735") {
                    $asmtype = "Deepa";
                    $smtype = "Harish Kumar";
                }elseif ($row_result["sentbidder"] == "6540") {
                    $asmtype = "Maya";
                    $smtype = "Nupur Razdan";
                }elseif ($row_result["sentbidder"] == "6542") {
                    $asmtype = "Ashuotsh";
                    $smtype = "Ronald Anthony";
                }elseif ($row_result["sentbidder"] == "6543") {
                    $asmtype = "Arun2";
                    $smtype = "Shahid";
                }elseif ($row_result["sentbidder"] == "6545") {
                    $asmtype = "Guna";
                    $smtype = "Arul";
                }elseif ($row_result["sentbidder"] == "6922") {
                    $asmtype = "Bharath";
                    $smtype = "Charan";
                }elseif ($row_result["sentbidder"] == "6923") {
                    $asmtype = "Pruduvi";
                    $smtype = "Charan";
                }elseif ($row_result["sentbidder"] == "6989") {
                    $asmtype = "Shainy";
                    $smtype = "Anuradha";
                }elseif ($row_result["sentbidder"] == "6924") {
                    $asmtype = "Obleshu";
                    $smtype = "Charan";
                }elseif ($row_result["sentbidder"] == "7102") {
                    $asmtype = "Kajal";
                    $smtype = "Gulbeer";
                }elseif ($row_result["sentbidder"] == "7103") {
                    $asmtype = "Taru";
                    $smtype = "Taru";
                }elseif ($row_result["sentbidder"] == "7179") {
                    $asmtype = "Gulfam";
                    $smtype = "Gulbeer";
                }elseif ($row_result["sentbidder"] == "7185") {
                    $asmtype = "Kajal";
                    $smtype = "Gulbeer";
                }elseif ($row_result["sentbidder"] == "7184") {
                    $asmtype = "Jayashree";
                    $smtype = "Amey";
                }elseif ($row_result["sentbidder"] == "7227") {
                    $asmtype = "Vaibhavi Patel";
                    $smtype = "Nirzar Ghoda";
                }elseif ($row_result["sentbidder"] == "7228") {
                    $asmtype = "Urvashi Rajput";
                    $smtype = "Nirzar Ghoda";
                }elseif ($row_result["sentbidder"] == "7339") {
                    $asmtype = "Taru";
                    $smtype = "Gulbeer";
                }elseif ($row_result["sentbidder"] == "7446") {
                    $asmtype = "Gayatri";
                    $smtype = "Siva Kumar";
                }elseif ($row_result["sentbidder"] == "7447") {
                    $asmtype = "Goutami";
                    $smtype = "Rajesh";
                }elseif ($row_result["sentbidder"] == "7599") {
                    $asmtype = "Kajal";
                    $smtype = "Gulbeer";
                }elseif ($row_result["sentbidder"] == "7659") {
                    $asmtype = "Amit Kumar";


                }
                else {
                    $asmtype = "";
                }
            }

            if ($BidderIDstatic == 2454) {
                $asmtype = "";
                if ($row_result['sentbidder'] == "2425") {
                    $asmtype = "Juber Chaudhary";
                } else if ($row_result['sentbidder'] == "2424") {
                    $asmtype = "Narendran PD - Navitha";
                } else if ($row_result['sentbidder'] == "3645") {
                    $asmtype = "Pradeep Mishra";
                } else if ($row_result['sentbidder'] == "3842") {
                    $asmtype = "Ranjit Verma";
                } else if ($row_result['sentbidder'] == "2429") {
                    $asmtype = "Jayant Verma";
                } else if ($row_result['sentbidder'] == "3335") {
                    $asmtype = "Sanjeev - Ranjan";
                } else if ($row_result['sentbidder'] == "3953") {
                    $asmtype = "Sanjeev - Abhinav";
                } else if ($row_result['sentbidder'] == "2423") {
                    $asmtype = "Neeraj - Priya";
                } else if ($row_result['sentbidder'] == "3966") {
                    $asmtype = "Neeraj - Ramesh";
                } else if ($row_result['sentbidder'] == "3967") {
                    $asmtype = "Dinesh - Prem";
                } else if ($row_result['sentbidder'] == "2426") {
                    $asmtype = "Vicky Sehra";
                } else if ($row_result['sentbidder'] == "4656") {
                    $asmtype = "Vicky Sehra";
                } else if ($row_result['sentbidder'] == "5108") {
                    $asmtype = "Priyanka S";
                } else if ($row_result['sentbidder'] == "4631") {
                    $asmtype = "Tushar Bahl";
                } else if ($row_result['sentbidder'] == "5300") {
                    $asmtype = "Tamil";
                } else if ($row_result['sentbidder'] == "5458") {
                    $asmtype = "Raghavan";
                } else if ($row_result['sentbidder'] == "5457") {
                    $asmtype = "Abhishek Manwar";
                } else if ($row_result['sentbidder'] == "2422") {
                    $asmtype = "Ajit James";
                } else if ($row_result['sentbidder'] == "5888") {
                    $asmtype = "Manikandan S1";
                } else if ($row_result['sentbidder'] == "2433") {
                    $asmtype = "Amit Tiwari";
                } else if ($row_result['sentbidder'] == "5976") {
                    $asmtype = "Rajesh";
                } else if ($row_result['sentbidder'] == "2444") {
                    $asmtype = "Abhishek Manwar";
                } else if ($row_result['sentbidder'] == "5656") {
                    $asmtype = "Azimul Khan";
                } else {
                    $asmtype = "";
                }
            }
            if ($BidderIDstatic == 2501) {
                $asmtype = "";
                if ($row_result['sentbidder'] == 2490) {
                    $asmtype = "Sandeep";
                } else if ($row_result['sentbidder'] == 4018) {
                    $asmtype = "Jimmi";
                } else if ($row_result['sentbidder'] == 2496) {
                    $asmtype = "RAGHUNATHA";
                } else if ($row_result['sentbidder'] == 4019) {
                    $asmtype = "Sridhar";
                } else if ($row_result['sentbidder'] == 2497) {
                    $asmtype = "Praveen Sambhoju";
                } else if ($row_result['sentbidder'] == 4020) {
                    $asmtype = "Bhaskar";
                } else if ($row_result['sentbidder'] == 4663) {
                    $asmtype = "Carolina Mathew";
                } else if ($row_result['sentbidder'] == 4342) {
                    $asmtype = "Vasanti";
                } else if ($row_result['sentbidder'] == 4914) {
                    $asmtype = "Baskar";
                } else if ($row_result['sentbidder'] == 4915) {
                    $asmtype = "Jimmi Thomas";
                } else if ($row_result['sentbidder'] == 4302) {
                    $asmtype = "Leena";
                } else if ($row_result['sentbidder'] == 2498) {
                    $asmtype = "Jatin";
                } else if ($row_result['sentbidder'] == 4309) {
                    $asmtype = "Vikas";
                } else if ($row_result['sentbidder'] == 2499) {
                    $asmtype = "Rohit";
                } else if ($row_result['sentbidder'] == 2500) {
                    $asmtype = "Sukhwinder";
                } else if ($row_result['sentbidder'] == 2813) {
                    $asmtype = "Amit";
                } else if ($row_result['sentbidder'] == 2887) {
                    $asmtype = "Piyush";
                } else if ($row_result['sentbidder'] == 3894) {
                    $asmtype = "Saurabh";
                } else if ($row_result['sentbidder'] == 4528) {
                    $asmtype = "Saurabh Kala";
                } else if ($row_result['sentbidder'] == 4529) {
                    $asmtype = "Gautam Kamble";
                } else {
                    $asmtype = "";
                }
            }

            if ($BidderIDstatic == 5373 || $BidderIDstatic == 6116 || $BidderIDstatic == 6117) {//HDFc small cities
                //for bidderid 6116, 6117
                if ($BidderIDstatic == 6116) {
                    $getallocatebid = "Select Req_Feedback_Bidder_PL.BidderID AS sentbidder from Req_Feedback_Bidder_PL";
                    "select Req_Feedback_Bidder_PL.BidderID AS sentbidder from  Req_Feedback_Bidder_PL Where (BidderID in (4931,4933,4935,4936,4939,4943,4946,4948,4951,4954,4959,4960,4962,4963,4967,4970,4971,4975,4976,4977,4980,4995,5000,5001,5012,5013,5015,5023,5028,5029,5033,5034,5036,5038,5047,5048,5049,5056,5057,5058,5061,5063,5066,5067,5963,5964,5968,5974,5975,6003,6035,6036,6037,6038,6039,6040,6057,6059,6060,6061,6062,6063,6064,6065,6066,6067,6068,6069,6070,6071,6072,6073,6074,6075,6076,6077,6087) and AllRequestID='" . $row_result["RequestID"] . "')";
                    $getallocatebidresult = ExecQuery($getallocatebid);
                    $allocatebid = mysql_fetch_array($getallocatebidresult);
                } elseif ($BidderIDstatic == 6117) {
                    $getallocatebid = "Select Req_Feedback_Bidder_PL.BidderID AS sentbidder from Req_Feedback_Bidder_PL";
                    "select Req_Feedback_Bidder_PL.BidderID AS sentbidder from  Req_Feedback_Bidder_PL Where ((BidderID in (4932,4934,4937,4940,4949,4952,4955,4957,4966,4969,4972,4990,5002,5003,5004,5006,5007,5009,5010,5016,5017,5021,5025,5026,5027,5043,5046,5051,5055,5060,5064,5745,5791,5941,5962,5967,5970,5971,5972,5977,5989,6004,6005,6006,6041,6042,6049,6050,6051,6052,6053,6054,6055,6056,6079,6080,6081,6083,6084,6085,6086) and AllRequestID='" . $row_result["RequestID"] . "')";
                    $getallocatebidresult = ExecQuery($getallocatebid);
                    $allocatebid = mysql_fetch_array($getallocatebidresult);
                }
                if ($row_result['sentbidder'] == "5033" || $allocatebid['sentbidder'] == "5033") {
                    $asmtype = "Sandeep Bajwal";
                } else if ($row_result['sentbidder'] == "5935" || $allocatebid['sentbidder'] == "5935") {
                    $asmtype = "Vandana";
                } elseif ($row_result["sentbidder"] == "4931" || $allocatebid["sentbidder"] == "4931") {
                    $asmtype = "Debraj Das";
                } elseif ($row_result["sentbidder"] == "4957" || $allocatebid["sentbidder"] == "4957") {
                    $asmtype = "deepesh kogje";
                } elseif ($row_result["sentbidder"] == "4936" || $allocatebid["sentbidder"] == "4936") {
                    $asmtype = "Avanish Dwivedi";
                } elseif ($row_result["sentbidder"] == "5023" || $allocatebid["sentbidder"] == "5023") {
                    $asmtype = "Manish";
                    $smtype = "Kavita Verma";
                } elseif ($row_result["sentbidder"] == "4952" || $allocatebid["sentbidder"] == "4952") {
                    $asmtype = "Binit Ghosh";
                } elseif ($row_result["sentbidder"] == "5027" || $allocatebid["sentbidder"] == "5027") {
                    $asmtype = "Richas Sharma";
                } elseif ($row_result["sentbidder"] == "5063" || $allocatebid["sentbidder"] == "5063") {
                    $asmtype = "Vivek Pare";
                } elseif ($row_result["sentbidder"] == "4980" || $allocatebid["sentbidder"] == "4980") {
                    $asmtype = "Indarjit deb";
                } elseif ($row_result["sentbidder"] == "4960" || $allocatebid["sentbidder"] == "4960") {
                    $asmtype = "Dhananjayprakash Tiwari";
                } elseif ($row_result["sentbidder"] == "4954" || $allocatebid["sentbidder"] == "4954") {
                    $asmtype = "Chandrajeet Rawal";
                } elseif ($row_result["sentbidder"] == "4971" || $allocatebid["sentbidder"] == "4971") {
                    $asmtype = "Hetul Agrawal";
                } elseif ($row_result["sentbidder"] == "5008" || $allocatebid["sentbidder"] == "5008") {
                    $asmtype = "Nikhil Kulkarn1";
                } elseif ($row_result["sentbidder"] == "5061" || $allocatebid["sentbidder"] == "5061") {
                    $asmtype = "Avanish Dwivedi";
                } elseif ($row_result["sentbidder"] == "5064" || $allocatebid["sentbidder"] == "5064") {
                    $asmtype = "Rajkumar Dodani";
                } elseif ($row_result["sentbidder"] == "5058" || $allocatebid["sentbidder"] == "5058") {
                    $asmtype = "Vikash Kachhadiya";
                } elseif ($row_result["sentbidder"] == "5057" || $allocatebid["sentbidder"] == "5057") {
                    $asmtype = "Avanish Kumar Rai";
                } elseif ($row_result["sentbidder"] == "5057" || $allocatebid["sentbidder"] == "5057") {
                    $asmtype = "Vikash Kachhadiya";
                } elseif ($row_result["sentbidder"] == "5056" || $allocatebid["sentbidder"] == "5056") {
                    $asmtype = "Vijender Guleria";
                } elseif ($row_result["sentbidder"] == "5055" || $allocatebid["sentbidder"] == "5055") {
                    $asmtype = "Ram Ruthala";
                } elseif ($row_result["sentbidder"] == "5046" || $allocatebid["sentbidder"] == "5046") {
                    $asmtype = "sunita coutinho";
                } elseif ($row_result["sentbidder"] == "5042" || $allocatebid["sentbidder"] == "5042") {
                    $asmtype = "Siraj Garasiya";
                } elseif ($row_result["sentbidder"] == "5034" || $allocatebid["sentbidder"] == "5034") {
                    $asmtype = "Sandeepan";
                } elseif ($row_result["sentbidder"] == "5002" || $allocatebid["sentbidder"] == "5002") {
                    $asmtype = "muralirangu";
                } elseif ($row_result["sentbidder"] == "5015" || $allocatebid["sentbidder"] == "5015") {
                    $asmtype = "Avanish Dwivedi";
                } elseif ($row_result["sentbidder"] == "5029" || $allocatebid["sentbidder"] == "5029") {
                    $asmtype = "Rituraj Dutta";
                } elseif ($row_result["sentbidder"] == "5003" || $allocatebid["sentbidder"] == "5003") {
                    $asmtype = "Muttayya Mamadpur";
                } elseif ($row_result["sentbidder"] == "4934" || $allocatebid["sentbidder"] == "4934") {
                    $asmtype = "Ajay Dhameecha";
                } elseif ($row_result["sentbidder"] == "4975" || $allocatebid["sentbidder"] == "4975") {
                    $asmtype = "Hetul Aggrawal";
                } elseif ($row_result["sentbidder"] == "4949" || $allocatebid["sentbidder"] == "4949") {
                    $asmtype = "Bhaskar Debnath";
                } elseif ($row_result["sentbidder"] == "4937" || $allocatebid["sentbidder"] == "4937") {
                    $asmtype = "Amit Bose";
                } elseif ($row_result["sentbidder"] == "4963" || $allocatebid["sentbidder"] == "4963") {
                    $asmtype = "Dinesh A Joshi";
                } elseif ($row_result["sentbidder"] == "5508" || $allocatebid["sentbidder"] == "5508") {
                    $asmtype = "Anupam Soni";
                } elseif ($row_result["sentbidder"] == "4963" || $allocatebid["sentbidder"] == "4963") {
                    $asmtype = "Dinesh A Joshi";
                } elseif ($row_result["sentbidder"] == "5508" || $allocatebid["sentbidder"] == "5508") {
                    $asmtype = "Anupam Soni";
                } else if ($row_result['sentbidder'] == "4964" || $allocatebid["sentbidder"] == "4964") {
                    $asmtype = "Diwan Singh";
                } else if ($row_result['sentbidder'] == "5006" || $allocatebid["sentbidder"] == "5006") {
                    $asmtype = "NANDANESH HOLLA";
                } else if ($row_result['sentbidder'] == "5009" || $allocatebid["sentbidder"] == "5009") {
                    $asmtype = "NIKHIL VELAPURKAR";
                } else if ($row_result['sentbidder'] == "5012" || $allocatebid["sentbidder"] == "5012") {
                    $asmtype = "Prakashk patel";
                } else if ($row_result['sentbidder'] == "5021" || $allocatebid["sentbidder"] == "5021") {
                    $asmtype = "ragesh divakaran";
                } else if ($row_result['sentbidder'] == "5028" || $allocatebid["sentbidder"] == "5028") {
                    $asmtype = "Ritesh Thakrar";
                } else if ($row_result['sentbidder'] == "5031" || $allocatebid["sentbidder"] == "5031") {
                    $asmtype = "sachin isapure";
                } else if ($row_result['sentbidder'] == "5038" || $allocatebid["sentbidder"] == "5038") {
                    $asmtype = "Shailendra Chauhan";
                } else if ($row_result['sentbidder'] == "4995" || $allocatebid["sentbidder"] == "4995") {
                    $asmtype = "manikandan narayanan";
                } else if ($row_result['sentbidder'] == "4946" || $allocatebid["sentbidder"] == "4946") {
                    $asmtype = "Ashish K Bansal";
                } else if ($row_result['sentbidder'] == "4086" || $allocatebid["sentbidder"] == "4086") {
                    $asmtype = "Meet Marriya";
                } else if ($row_result['sentbidder'] == "5939" || $allocatebid["sentbidder"] == "5939") {
                    $asmtype = "Vijay Pinjarkar";
                } else if ($row_result['sentbidder'] == "5940" || $allocatebid["sentbidder"] == "5940") {
                    $asmtype = "Vijendra Borbacche";
                } else if ($row_result['sentbidder'] == "5941" || $allocatebid["sentbidder"] == "5941") {
                    $asmtype = "Ashish Chouhan";
                } else if ($row_result['sentbidder'] == "5942" || $allocatebid["sentbidder"] == "5942") {
                    $asmtype = "Deepak Salunke";
                } else if ($row_result['sentbidder'] == "5026" || $allocatebid["sentbidder"] == "5026") {
                    $asmtype = "Rayudi Surender Babu";
                } else if ($row_result['sentbidder'] == "5745" || $allocatebid["sentbidder"] == "5745") {
                    $asmtype = "Chetan Trivedi";
                } else if ($row_result['sentbidder'] == "4948" || $allocatebid["sentbidder"] == "4948") {
                    $asmtype = "Renu";
                    $smtype = "Amit Kumar";
                } else if ($row_result['sentbidder'] == "5024" || $allocatebid["sentbidder"] == "5024") {
                    $asmtype = "Geetha";
                    $smtype = "Sonia";

                }
            }
            if ($BidderIDstatic == 5264) { // TATA Capital
                $tataleadid = "";
                //
                $tataleadqry = "Select feedback From webservice_bidder_details where (leadid='" . $row_result["Feedback_ID"] . "' and bidderid in (5235,5237,5242,5243,5245,5247,5241,5250,5236,5240,5239,5319,5320,5321,5422)) order by doe DESC LIMIT 0,1";
                $tataleadresult = ExecQuery($tataleadqry);
                $tatarow = mysql_fetch_array($tataleadresult);
                $webfeedback = $tatarow["feedback"];
                $expires = preg_split('/Lead id/', $webfeedback);
                array_shift($expires);
                $strcheck = implode(" ", $expires);
                $check = explode(" ", $strcheck);
                $Leadid = $check[0];
                if ($Leadid > 0) {
                    $tataleadid = str_replace("=", "", str_replace('"', '', $Leadid));
                } else {
                    $expires = preg_split('/leadId/', trim($webfeedback));
                    array_shift($expires);
                    $strcheck = implode(" ", $expires);
                    $check = explode(" ", $strcheck);
                    $tataleadid = str_replace("=", "", str_replace('"', '', $check[2]));
                }
                //
                $asmtype = "";
                if ($row_result['sentbidder'] == "5247") {
                    $asmtype = "Umesh Kumar Adhikari";
                } elseif ($row_result["sentbidder"] == "5250") {
                    $asmtype = "Suyash Dubey";
                } elseif ($row_result["sentbidder"] == "5235" || $row_result["sentbidder"] == "5236") {
                    $asmtype = "Nirav Joshi";
                } elseif ($row_result["sentbidder"] == "5319") {
                    $asmtype = "Sandeep Pawar";
                } elseif ($row_result["sentbidder"] == "5237") {
                    $asmtype = "Shishir";
                } elseif ($row_result["sentbidder"] == "5243") {
                    $asmtype = "Mahendra Puppala";
                } elseif ($row_result["sentbidder"] == "5241") {
                    $asmtype = "Kaarthikeyan";
                } elseif ($row_result["sentbidder"] == "5242") {
                    $asmtype = "Harsh Vardhan Pandey";
                } elseif ($row_result["sentbidder"] == "5240") {
                    $asmtype = "Neeraj Kumar";
                } elseif ($row_result["sentbidder"] == "5320") {
                    $asmtype = "Kishore";
                } elseif ($row_result["sentbidder"] == "5245") {
                    $asmtype = "Amit Roy";
                } elseif ($row_result["sentbidder"] == "5321") {
                    $asmtype = "Mantosh Rout";
                } elseif ($row_result["sentbidder"] == "5239") {
                    $asmtype = "Puneet Jain";
                } elseif ($row_result["sentbidder"] == "5422") {
                    $asmtype = "Avanish Updhaya";
                } elseif ($row_result["sentbidder"] == "5714") {
                    $asmtype = "Ashutosh";
                }
            }
            if ($BidderIDstatic == 2920) {//ICICI Andro
                if ($row_result['sentbidder'] == "2963") {
                    $smtype = "SONALI";
                } else if ($row_result['sentbidder'] == "4300") {
                    $smtype = "Sangeeta Pandey";
                } elseif ($row_result["sentbidder"] == "2984") {
                    $smtype = "Sangeeta Pandey";
                } elseif ($row_result["sentbidder"] == "4388") {
                    $smtype = "Vikas";
                } elseif ($row_result["sentbidder"] == "6294") {
                    $smtype = "Bhawna Goyal";
                } elseif ($row_result["sentbidder"] == "6295") {
                    $smtype = "Paras";
                } elseif ($row_result["sentbidder"] == "4319") {
                    $smtype = "Latif";
                } elseif ($row_result["sentbidder"] == "5322") {
                    $smtype = "SHANKAR RATHOD";
                } elseif ($row_result["sentbidder"] == "4829") {
                    $smtype = "SHANKAR RATHOD";
                } elseif ($row_result["sentbidder"] == "4798") {
                    $smtype = "Latif";
                } elseif ($row_result["sentbidder"] == "4411") {
                    $smtype = "BHAWNA GOYAL";
                } elseif ($row_result["sentbidder"] == "4412") {
                    $smtype = "Paras";
                } elseif ($row_result["sentbidder"] == "4872") {
                    $smtype = "Brijendra";
                }
            }
            if ($BidderIDstatic == 2997) {
                if ($row_result['sentbidder'] == "3003") {
                    $asmtype = "Deepash";
                } elseif ($row_result['sentbidder'] == "3005") {
                    $asmtype = "Krupa";
                } elseif ($row_result['sentbidder'] == "5920") {
                    $asmtype = "Vishali";
                    $smtype = "Renu";
                } elseif ($row_result['sentbidder'] == "3654") {
                    $asmtype = "Poonam";
                    $smtype = "Gopal";
                } elseif ($row_result['sentbidder'] == "3015") {
                    $asmtype = "Ashwini";
                } elseif ($row_result['sentbidder'] == "5203") {
                    $asmtype = "Sana";
                } elseif ($row_result['sentbidder'] == "3801") {
                    $asmtype = "Vishal";
                } elseif ($row_result['sentbidder'] == "3002") {
                    $asmtype = "S.Sumithra";
                } elseif ($row_result['sentbidder'] == "3001") {
                    $asmtype = "Divya.J";
                } elseif ($row_result['sentbidder'] == "2998") {
                    $asmtype = "Bhayshri";
                } elseif ($row_result['sentbidder'] == "3008") {
                    $asmtype = "Sanjib";
                } elseif ($row_result['sentbidder'] == "3009") {
                    $asmtype = "Anjan";
                } elseif ($row_result['sentbidder'] == "3004") {
                    $asmtype = "Vishal";
                } elseif ($row_result['sentbidder'] == "5889") {
                    $asmtype = "Sanjeev";
                    $smtype = "Gopal";
                } elseif ($row_result['sentbidder'] == "5916") {
                    $asmtype = "Santosh";
                } elseif ($row_result['sentbidder'] == "5566") {
                    $asmtype = "Sangeeta";
                } elseif ($row_result['sentbidder'] == "4407") {
                    $asmtype = "Rajan";
                } elseif ($row_result['sentbidder'] == "6162") {
                    $asmtype = "Vijeta";
                } elseif ($row_result['sentbidder'] == "5386") {
                    $asmtype = "Vinay";
                } elseif ($row_result['sentbidder'] == "6292") {
                    $asmtype = "Jyoti";
                } elseif ($row_result['sentbidder'] == "6293") {
                    $asmtype = "Jyoti";
                } elseif ($row_result['sentbidder'] == "6298") {
                    $asmtype = "Muthuselvi";
                } elseif ($row_result['sentbidder'] == "6375") {
                    $asmtype = "Geetha";
                } elseif ($row_result['sentbidder'] == "3000") {
                    $asmtype = "Prithvi";
                } elseif ($row_result['sentbidder'] == "5378") {
                    $asmtype = "Suraj";
                } elseif ($row_result['sentbidder'] == "5325") {
                    $asmtype = "Priyanka";
                } elseif ($row_result['sentbidder'] == "2999") {
                    $asmtype = "Krupa";
                } elseif ($row_result['sentbidder'] == "7120") {
                    $asmtype = "Geeta Deal4loans";    
                } elseif ($row_result['sentbidder'] == "7445") {
                    $asmtype = "Sakshi"; 
                } else {
                    $asmtype = '';
                }

                $zone = '';
                //$north_zone = array(3003,3004,3009,3010,3012,3013,3014);
//					$west_zone = array(2998,2999,3005,3006,3007,3008,3015);
//				$south_zone = array(3000,3001,3002,3011);
                $dCity = '';
                if ($row_result["City"] == "Others") {
                    $dCity = $row_result["City"];
                } else {
                    $dCity = $row_result["City"];
                }
                $north_zone = array('Delhi', 'Chandigarh', 'Jaipur', 'Ludhiana', 'Jalandhar', 'Patiala', 'Udaipur', 'Noida', 'Gurgaon', 'Gaziabad', 'Faridabad', 'Greater Noida', 'Hyderabad');
                $west_zone = array('Pune', 'Ahmedabad', 'Baroda', 'Surat', 'Nagpur', 'Kolkata', 'Mumbai', 'Vadodara', 'Thane', 'Navi Mumbai'); //added Thane, Navi Mumbai by Upendra 030813
                $south_zone = array('Chennai', 'Bangalore', 'Mysore');
                if (in_array($dCity, $north_zone)) {
                    $zone = 'North';
                }
                if (in_array($dCity, $west_zone)) {
                    $zone = 'West';
                }
                if (in_array($dCity, $south_zone)) {
                    $zone = 'South';
                }
            }

            if ($BidderIDstatic == 5356) {
                if ($row_result['sentbidder'] == "5344") {
                    $asmtype = "OMPRAKASH G.B.";
                } elseif ($row_result['sentbidder'] == "5345") {
                    $asmtype = "Sridhar c";
                } elseif ($row_result['sentbidder'] == "5346") {
                    $asmtype = "Praveen Sambhoju";
                } elseif ($row_result['sentbidder'] == "5347") {
                    $asmtype = "Caroline.Mathew";
                } elseif ($row_result['sentbidder'] == "5348") {
                    $asmtype = "JATIN KUMAR";
                } elseif ($row_result['sentbidder'] == "5349") {
                    $asmtype = "Sukhwinder";
                } elseif ($row_result['sentbidder'] == "5350") {
                    $asmtype = "Amit Sharma";
                } elseif ($row_result['sentbidder'] == "5351") {
                    $asmtype = "Saurabh rathod";
                } elseif ($row_result['sentbidder'] == "5352") {
                    $asmtype = "Leena";
                } elseif ($row_result['sentbidder'] == "5353") {
                    $asmtype = "Jimmi";
                } elseif ($row_result['sentbidder'] == "5354") {
                    $asmtype = "Baskar";
                } elseif ($row_result['sentbidder'] == "5355") {
                    $asmtype = "Rajendra";
                } elseif ($row_result['sentbidder'] == "5676") {
                    $asmtype = "jagadeesh";
                } elseif ($row_result['sentbidder'] == "5677") {
                    $asmtype = "gopi";
                } else {
                    $asmtype = '';
                }
                $zone = '';
                //$north_zone = array(3003,3004,3009,3010,3012,3013,3014);
//					$west_zone = array(2998,2999,3005,3006,3007,3008,3015);
//				$south_zone = array(3000,3001,3002,3011);
                $dCity = '';
                if ($row_result["City"] == "Others") {
                    $dCity = $row_result["City"];
                } else {
                    $dCity = $row_result["City"];
                }
                $north_zone = array('Delhi', 'Chandigarh', 'Jaipur', 'Ludhiana', 'Jalandhar', 'Patiala', 'Udaipur', 'Noida', 'Gurgaon', 'Gaziabad', 'Faridabad', 'Greater Noida', 'Hyderabad');
                $west_zone = array('Pune', 'Ahmedabad', 'Baroda', 'Surat', 'Nagpur', 'Kolkata', 'Mumbai', 'Vadodara', 'Thane', 'Navi Mumbai'); //added Thane, Navi Mumbai by Upendra 030813
                $south_zone = array('Chennai', 'Bangalore', 'Mysore');
                if (in_array($dCity, $north_zone)) {
                    $zone = 'North';
                }
                if (in_array($dCity, $west_zone)) {
                    $zone = 'West';
                }
                if (in_array($dCity, $south_zone)) {
                    $zone = 'South';
                }
            }

            if ($BidderIDstatic == 2920 || $BidderIDstatic == 3199 || $BidderIDstatic == 2962 || $BidderIDstatic == 3945 || $BidderIDstatic == 4127 || $BidderIDstatic == 3380 || $BidderIDstatic == 3133 || $BidderIDstatic == 3381 || $BidderIDstatic == 3451 || $BidderIDstatic == 3407 || $BidderIDstatic == 4032 || $BidderIDstatic == 4293 || $BidderIDstatic == 4300 || $BidderIDstatic == 4301 || $BidderIDstatic == 3868 || $BidderIDstatic == 2984 || $BidderIDstatic == 3532 || $BidderIDstatic == 3533 || $BidderIDstatic == 4242 || $BidderIDstatic == 4292 || $BidderIDstatic == 4299 || $BidderIDstatic == 3061 || $BidderIDstatic == 3198 || $BidderIDstatic == 3554 || $BidderIDstatic == 3196 || $BidderIDstatic == 4156 || $BidderIDstatic == 3553 || $BidderIDstatic == 4126 || $BidderIDstatic == 3944 || $BidderIDstatic == 3197 || $BidderIDstatic == 2995 || $BidderIDstatic == 3132 || $BidderIDstatic == 2917 || $BidderIDstatic == 5356) {
                $getBiddIDSql = "select BidderID from Req_Feedback_Bidder_PL where Feedback_ID = '" . $row_result["Feedback_ID"] . "'";
                $getBiddIDQuery = ExecQuery($getBiddIDSql);
                $getBidd = mysql_result($getBiddIDQuery, 0, 'BidderID');
                $getCityNSql = "select City from Bidders where BidderID='" . $getBidd . "'";
                $getCityNQuery = ExecQuery($getCityNSql);
                $BiddCity = mysql_result($getCityNQuery, 0, 'City');
                //	echo $getCityNSql."<br>";
            }
            if ($BidderIDstatic == 1023 || $BidderIDstatic == 2679) {
                $allocatebidderID = $row_result["sentbidder"];

                if ($row_result['sentbidder'] == "1343") {
                    $allocatebidderID = "Vipin";
                } else if ($row_result['sentbidder'] == "6156") {
                    $allocatebidderID = "Narendran";
                } else if ($row_result['sentbidder'] == "6157") {
                    $allocatebidderID = "Vijayendran";
                }
				if($BidderIDstatic == 2679)
				{
					$fullertonbnkdetails = ExecQuery("Select mkgt_bidderid,sm_name,sma_name2,group_name,rsm_name from hdfcbank_citywise_contactdetails Where (status=1 and mkgt_bidderid=".$row_result['sentbidder'].")");
					$fulrow = mysql_fetch_array($fullertonbnkdetails);
					$sm_name = $fulrow["sm_name"];
					$mkgt_bidderid = $fulrow["mkgt_bidderid"];
					if(strlen($sm_name)>1)
					{
						$allocatebidderID=$sm_name;
					}
					else
					{
						if($mkgt_bidderid>0)
						{
							$allocatebidderID=$mkgt_bidderid;
						}
					}
					$NewCluster = $fulrow["sma_name2"];
					$State = $fulrow["group_name"];
					$Region = $fulrow["rsm_name"];
				}
                $qry1 = "insert into temp (session_id, name, dob, email, emp_status, c_name, city, city_other, year_in_comp, total_exp, mobile_number, net_salary, residential_status, loan_any, emi_paid, cc_holder, loan_amount, Feedback, is_processed, pincode, doe, card_vintage, card_limit,ip_address,add_comment,Documents,residence_address, bank_name,property_type,address_apt, referred_page,vehicle_owned, plan_interested, current_age, docs,request_id, car_make, car_model, car_type, already_download, unique_id, count_views, count_replies, is_modified) values ('" . $session_id . "', '" . $row_result["Name"] . "', '" . $dob . "', '" . $row_result["Email"] . "', '" . $emp_status . "', '" . $row_result["Company_Name"] . "', '" . $row_result["City"] . "', '" . $row_result["City_Other"] . "', '" . $row_result["Years_In_Company"] . "', '" . $row_result["Total_Experience"] . "', '" . $contactNo . "', '" . $row_result["Net_Salary"] . "', '" . $residential_status . "', '" . $row_result["Loan_Any"] . "', '" . $emi_paid . "', '" . $cc_holder . "', '" . $Loan_Amount . "', '" . $feedback . "',  '" . $row_result["PL_EMI_Amt"] . "', '" . $row_result["Pincode"] . "', '" . $Dateofallocation . "', '" . $card_vintage . "', '" . $row_result["Card_Limit"] . "','" . $row_result["IP_Address"] . "','" . $row_result["Add_Comment"] . "','" . $row_result["identification_proof"] . "','" . $asmtype . "','" . $row_result["Primary_Acc"] . "','" . $Company_Type . "','" . $Salary_Drawn . "','" . $row_result["axis_executive_name"] . "', '" . $zone . "','" . $annual_turnover . "','" . $exclusiveLead . "', '" . $BiddCity . "','" . $citiuniqueid . "', '" . $row_result["Existing_Bank"] . "', '" . $row_result["Existing_Loan"] . "', '" . $row_result["Existing_ROI"] . "','" . $allocatebidderID . "','" . $uniqueid . "','".$NewCluster."','".$State."','".$Region."')";
            } elseif ($BidderIDstatic == 5648 || $BidderIDstatic == 5649 || $BidderIDstatic == 5650 || $BidderIDstatic == 5654 || $BidderIDstatic == 6965 || $BidderIDstatic == 6966 || $BidderIDstatic == 6967 || $BidderIDstatic == 6968 || $BidderIDstatic == 6969 || $BidderIDstatic == 6970) {
                if ($row_result["City"] == "Others" && strlen($row_result["City_Other"]) > 0) {
                    $strCity = $row_result["City_Other"];
                } else {
                    $strCity = $row_result["City"];
                }
                $hdfcbnkdetails = ExecQuery("Select * from hdfcbank_citywise_contactdetails Where (status=1 and mkgt_city='" . $strCity . "' and mkgt_bidderid=0)");
                $hdfcrow = mysql_fetch_array($hdfcbnkdetails);
                $sm_name = $hdfcrow["sm_name"];
                $sm_email = $hdfcrow["sm_email"];
                $sm_mobile_no = $hdfcrow["sm_mobile_no"];
                $sma_name2 = $hdfcrow["sma_name2"];
                $group_name = $hdfcrow["group_name"];
                $rsm_name = $hdfcrow["rsm_name"];
                $zsm_name = $hdfcrow["zsm_name"];

                $qry1 = "insert into temp (session_id, name, dob, email, emp_status, c_name, city, city_other, year_in_comp, total_exp, mobile_number, net_salary, residential_status, loan_any, emi_paid, cc_holder, loan_amount, Feedback, count_views, count_replies, is_modified, is_processed, pincode, doe, card_vintage, card_limit,ip_address,add_comment, bank_name,property_type,address_apt, current_age,  car_make, car_model, car_type, account_no, Documents, residence_address, referred_page, vehicle_owned, plan_interested, docs, request_id, unique_id) values ('" . $session_id . "', '" . $row_result["Name"] . "', '" . $dob . "', '" . $row_result["Email"] . "', '" . $emp_status . "', '" . $row_result["Company_Name"] . "', '" . $row_result["City"] . "', '" . $row_result["City_Other"] . "', '" . $row_result["Years_In_Company"] . "', '" . $row_result["Total_Experience"] . "', '" . $contactNo . "', '" . $Salary . "', '" . $residential_status . "', '" . $row_result["Loan_Any"] . "', '" . $emi_paid . "', '" . $cc_holder . "', '" . $Loan_Amount . "', '" . $feedback . "', '" . $hdfceligibility . "', '" . $citieligibility . "', '" . $barclayeligibility . "', '" . $row_result["PL_EMI_Amt"] . "', '" . $row_result["Pincode"] . "', '" . $Dateofallocation . "', '" . $card_vintage . "', '" . $row_result["IP_Address"] . "','" . $row_result["Add_Comment"] . "','" . $row_result["Primary_Acc"] . "','" . $Company_Type . "','" . $Salary_Drawn . "', '" . $annual_turnover . "','" . $exclusiveLead . "', '" . $row_result["Existing_Bank"] . "', '" . $row_result["Existing_Loan"] . "', '" . $row_result["Existing_ROI"] . "', '" . $row_result["comment_section"] . "', '" . $sm_name . "', '" . $sm_email . "', '" . $sm_mobile_no . "', '" . $sma_name2 . "', '" . $group_name . "', '" . $rsm_name . "', '" . $zsm_name . "','" . $uniqueid . "' )";
            } elseif ($BidderIDstatic == 5373 || $BidderIDstatic == 6116 || $BidderIDstatic == 6117 || $BidderIDstatic == 7479 || $BidderIDstatic == 7480) {
                if ($BidderIDstatic == 6116 || $BidderIDstatic == 6117) {
                    $hdfcbnkdetails = ExecQuery("Select * from hdfcbank_citywise_contactdetails Where (status=1 and mkgt_bidderid=" . $allocatebid['sentbidder'] . ")");
                } else {
                    $hdfcbnkdetails = ExecQuery("Select * from hdfcbank_citywise_contactdetails Where (status=1 and mkgt_bidderid=" . $row_result['sentbidder'] . ")");
                }
                $hdfcrow = mysql_fetch_array($hdfcbnkdetails);
                $sm_name = $hdfcrow["sm_name"];
                $sma_name2 = $hdfcrow["sma_name2"];
                $group_name = $hdfcrow["group_name"];
                $rsm_name = $hdfcrow["rsm_name"];
                $zsm_name = $hdfcrow["zsm_name"];
                $aro_name = $hdfcrow["aro_name"];

                $qry1 = "insert into temp (session_id, name, dob, email, emp_status, c_name, city, city_other, year_in_comp, total_exp, mobile_number, net_salary, residential_status, loan_any, emi_paid, cc_holder, loan_amount, Feedback, count_views, count_replies, is_modified, is_processed, pincode, doe, card_vintage, card_limit,ip_address,add_comment, bank_name,property_type,address_apt, annual_income, current_age,  car_make, car_model, car_type, account_no, Documents, vehicle_owned, plan_interested, docs, request_id, query_type, unique_id) values ('" . $session_id . "', '" . RemoveBS(clean($row_result["Name"])) . "', '" . $dob . "', '" . $row_result["Email"] . "', '" . $emp_status . "', '" . RemoveBS(clean($row_result["Company_Name"])) . "', '" . RemoveBS(clean($row_result["City"])) . "', '" . RemoveBS(clean($row_result["City_Other"])) . "', '" . $row_result["Years_In_Company"] . "', '" . $row_result["Total_Experience"] . "', '" . $contactNo . "', '" . $Salary . "', '" . $residential_status . "', '" . $row_result["Loan_Any"] . "', '" . $emi_paid . "', '" . $cc_holder . "', '" . $Loan_Amount . "', '" . $feedback . "', '" . $hdfceligibility . "', '" . $citieligibility . "', '" . $barclayeligibility . "', '" . $row_result["PL_EMI_Amt"] . "', '" . $row_result["Pincode"] . "', '" . $Dateofallocation . "', '" . $card_vintage . "', '" . $row_result["Card_Limit"] . "', '" . $row_result["IP_Address"] . "','" . RemoveBS(clean($row_result["Add_Comment"])) . "','" . RemoveBS(clean($row_result["Primary_Acc"])) . "','" . $Company_Type . "','" . $Salary_Drawn . "', '" . $annual_turnover . "','" . $exclusiveLead . "', '" . RemoveBS(clean($row_result["Existing_Bank"])) . "', '" . $row_result["Existing_Loan"] . "', '" . $row_result["Existing_ROI"] . "', '" . RemoveBS(clean($row_result["comment_section"])) . "', '" . RemoveBS(clean($sm_name)) . "', '" . $sma_name2 . "', '" . $group_name . "', '" . $rsm_name . "', '" . $zsm_name . "', '" . $aro_name . "','" . $uniqueid . "' )";
            } elseif ($BidderIDstatic == 5957) {
                $getcflSql = "select pl_bankrate, pl_bankpf, pl_loanamount from pl_quote_shown_save where (pl_leadid = '" . $row_result["RequestID"] . "' and pl_bankname='Capital First') order by pl_dated DESC LIMIT 0,1";
                $getcflQuery = ExecQuery($getcflSql);
                $cflpl_bankrate = mysql_result($getcflQuery, 0, 'pl_bankrate');
                $cflpl_bankpf = mysql_result($getcflQuery, 0, 'pl_bankpf');
                $cflpl_loanamount = mysql_result($getcflQuery, 0, 'pl_loanamount');

                $qry1 = "insert into temp (session_id, name, dob, email, emp_status, c_name, city, city_other, year_in_comp, total_exp, mobile_number, net_salary, residential_status, loan_any, emi_paid, cc_holder, loan_amount, Feedback,is_processed, pincode, doe, card_vintage, card_limit,ip_address,add_comment,Documents,residence_address, bank_name,property_type,address_apt, referred_page,vehicle_owned, plan_interested, current_age, docs,request_id, car_make, car_model, car_type,account_no, budget, unique_id) values ('" . $session_id . "', '" . $row_result["Name"] . "', '" . $dob . "', '" . $row_result["Email"] . "', '" . $emp_status . "', '" . $row_result["Company_Name"] . "', '" . $row_result["City"] . "', '" . $row_result["City_Other"] . "', '" . $row_result["Years_In_Company"] . "', '" . $row_result["Total_Experience"] . "', '" . $contactNo . "', '" . $Salary . "', '" . $residential_status . "', '" . $row_result["Loan_Any"] . "', '" . $emi_paid . "', '" . $cc_holder . "', '" . $Loan_Amount . "', '" . $feedback . "', '" . $cflpl_bankpf . "', '" . $row_result["Pincode"] . "', '" . $Dateofallocation . "', '" . $card_vintage . "', '" . $cflpl_bankrate . "','" . $row_result["IP_Address"] . "','" . $row_result["Add_Comment"] . "','" . $row_result["identification_proof"] . "','" . $asmtype . "','" . $row_result["Primary_Acc"] . "','" . $Company_Type . "','" . $Salary_Drawn . "','" . $row_result["axis_executive_name"] . "', '" . $zone . "','" . $annual_turnover . "','" . $exclusiveLead . "', '" . $BiddCity . "','" . $citiuniqueid . "', '" . $row_result["Existing_Bank"] . "', '" . $row_result["Existing_Loan"] . "', '" . $row_result["Existing_ROI"] . "', '" . $row_result["comment_section"] . "', '" . $cflpl_loanamount . "','" . $uniqueid . "')";
            } elseif ($BidderIDstatic == 5264) {
                $qry1 = "insert into temp (session_id, name, dob, email, emp_status, c_name, city, city_other, year_in_comp, total_exp, mobile_number, net_salary, residential_status, loan_any, emi_paid, cc_holder, loan_amount, Feedback, count_views, count_replies, is_modified, is_processed, pincode, doe, card_vintage, card_limit,ip_address,add_comment,Documents,residence_address, bank_name,property_type,address_apt, referred_page,vehicle_owned, plan_interested, current_age, docs,request_id, car_make, car_model, car_type,account_no, budget, unique_id) values ('" . $session_id . "', '" . $row_result["Name"] . "', '" . $dob . "', '" . $row_result["Email"] . "', '" . $emp_status . "', '" . $row_result["Company_Name"] . "', '" . $row_result["City"] . "', '" . $row_result["City_Other"] . "', '" . $row_result["Years_In_Company"] . "', '" . $row_result["Total_Experience"] . "', '" . $contactNo . "', '" . $Salary . "', '" . $residential_status . "', '" . $row_result["Loan_Any"] . "', '" . $emi_paid . "', '" . $cc_holder . "', '" . $Loan_Amount . "', '" . $feedback . "', '" . $hdfceligibility . "', '" . $citieligibility . "', '" . $barclayeligibility . "', '" . $row_result["PL_EMI_Amt"] . "', '" . $row_result["Pincode"] . "', '" . $Dateofallocation . "', '" . $card_vintage . "', '" . $row_result["Card_Limit"] . "','" . $row_result["IP_Address"] . "','" . $row_result["Add_Comment"] . "','" . $row_result["identification_proof"] . "','" . $asmtype . "','" . $row_result["Primary_Acc"] . "','" . $Company_Type . "','" . $Salary_Drawn . "','" . $row_result["axis_executive_name"] . "', '" . $zone . "','" . $annual_turnover . "','" . $exclusiveLead . "', '" . $BiddCity . "','" . $tataleadid . "', '" . $row_result["Existing_Bank"] . "', '" . $row_result["Existing_Loan"] . "', '" . $row_result["Existing_ROI"] . "', '" . $row_result["comment_section"] . "', '" . $smtype . "','" . $uniqueid . "')";
            } elseif($BidderIDstatic == 2680){
                $apifeedback = $row_result["feedback"];
                	$apifeedbackarr=explode(",",$apifeedback);
                        $StatusArr = explode(" -",$apifeedbackarr[0]); 
               if (strlen($row_result["Comments"] > 0)) {
                    $comment_section = str_replace('/', '|', str_replace('}', '', str_replace('{', '', str_replace('@', '', str_replace('"', '', str_replace("/", "-", str_replace("#", " ", str_replace("'", " ", $row_result["comment_section"]))))))));
                } else {
                    $comment_section = str_replace('/', '|', str_replace('}', '', str_replace('{', '', str_replace('@', '', str_replace('"', '', str_replace("/", "-", str_replace("#", " ", str_replace("'", " ", $row_result["comment_section"]))))))));
                }

                $qry1 = "insert into temp (session_id, name, dob, email, emp_status, c_name, city, city_other, year_in_comp, total_exp, mobile_number, net_salary, residential_status, loan_any, emi_paid, cc_holder, loan_amount, Feedback, count_views, count_replies, is_modified, is_processed, pincode, doe, card_vintage, card_limit,ip_address,add_comment,Documents,residence_address, bank_name,property_type,address_apt, referred_page,vehicle_owned, plan_interested, current_age, docs,request_id, car_make, car_model, car_type,account_no, budget, unique_id, std_code_o, landline_o, pancard,apt_dt) values ('" . $session_id . "', '" . $row_result["Name"] . "', '" . $dob . "', '" . $row_result["Email"] . "', '" . $emp_status . "', '" . RemoveBS(clean($row_result["Company_Name"])) . "', '" . $row_result["City"] . "', '" . $row_result["City_Other"] . "', '" . $row_result["Years_In_Company"] . "', '" . $row_result["Total_Experience"] . "', '" . $contactNo . "', '" . $Salary . "', '" . $residential_status . "', '" . $row_result["Loan_Any"] . "', '" . $emi_paid . "', '" . $cc_holder . "', '" . $Loan_Amount . "', '" . $feedback . "', '" . $hdfceligibility . "', '" . $citieligibility . "', '" . $barclayeligibility . "', '" . $row_result["PL_EMI_Amt"] . "', '" . $row_result["Pincode"] . "', '" . $Dateofallocation . "', '" . $card_vintage . "', '" . $row_result["Card_Limit"] . "','" . $row_result["IP_Address"] . "','" . RemoveBS(clean($row_result["Add_Comment"])) . "','" . $row_result["identification_proof"] . "','" . $asmtype . "','" . $row_result["Primary_Acc"] . "','" . $Company_Type . "','" . $Salary_Drawn . "','" . $row_result["axis_executive_name"] . "', '" . $zone . "','" . $annual_turnover . "','" . $exclusiveLead . "', '" . $BiddCity . "','" . $citiuniqueid . "', '" . $row_result["Existing_Bank"] . "', '" . $row_result["Existing_Loan"] . "', '" . $row_result["Existing_ROI"] . "', '" . RemoveBS(clean($comment_section)) . "', '" . $smtype . "','" . $uniqueid . "', '" . $row_result["Pincode"] . "', '" . RemoveBS(clean($row_result["Residence_Address"])) . "', '" . $row_result["Pancard"] . "', 'Status-" . getApiStatus($StatusArr[1]).",".$apifeedbackarr[1].", ".$apifeedbackarr[3] . "')"; 
            } elseif($BidderIDstatic == 6976){
                $apifeedback = RemoveBS(clean($row_result["feedback"]));
                	$apifeedbackarr=explode(",",$apifeedback);
                        $StatusArr = explode(" -",$apifeedbackarr[0]); 
               if (strlen($row_result["Comments"] > 0)) {
                    $comment_section = str_replace('/', '|', str_replace('}', '', str_replace('{', '', str_replace('@', '', str_replace('"', '', str_replace("/", "-", str_replace("#", " ", str_replace("'", " ", $row_result["comment_section"]))))))));
                } else {
                    $comment_section = str_replace('/', '|', str_replace('}', '', str_replace('{', '', str_replace('@', '', str_replace('"', '', str_replace("/", "-", str_replace("#", " ", str_replace("'", " ", $row_result["comment_section"]))))))));
                }
                //When BidderId Blank Start
                if($row_result["BidderID"]=="")
                {
                    $QBidId = "SELECT BidderID FROM lead_allocate WHERE leadid='".$row_result['leadid']."'";
                       $Qres = ExecQuery($QBidId);
                       $Qrow = mysql_fetch_array($Qres);
                      $BID = $Qrow['BidderID'];
                }else {
                  $BID = $row_result["BidderID"];  
                }
                //BidderId Blank End
                $qry1 = "insert into temp (session_id, name,loan_time, dob, email, emp_status, c_name, city, city_other, year_in_comp, total_exp, mobile_number, net_salary, residential_status, loan_any, emi_paid, cc_holder, loan_amount, Feedback, count_views, count_replies, is_modified, is_processed, pincode, doe, card_vintage, card_limit,ip_address,add_comment,Documents,residence_address, bank_name,property_type,address_apt, referred_page,vehicle_owned, plan_interested, current_age, docs,request_id, car_make, car_model, car_type,account_no, budget, unique_id, std_code_o, landline_o, pancard,apt_dt) values ('" . $session_id . "', '" . $row_result["Name"] . "', '" . $BID . "', '" . $dob . "', '" . $row_result["Email"] . "', '" . $emp_status . "', '" . RemoveBS(clean($row_result["Company_Name"])) . "', '" . $row_result["City"] . "', '" . RemoveBS(clean($row_result["City_Other"])) . "', '" . $row_result["Years_In_Company"] . "', '" . $row_result["Total_Experience"] . "', '" . $contactNo . "', '" . $Salary . "', '" . $residential_status . "', '" . $row_result["Loan_Any"] . "', '" . $emi_paid . "', '" . $cc_holder . "', '" . $Loan_Amount . "', '" . $feedback . "', '" . $hdfceligibility . "', '" . $citieligibility . "', '" . $barclayeligibility . "', '" . $row_result["PL_EMI_Amt"] . "', '" . $row_result["Pincode"] . "', '" . $Dateofallocation . "', '" . $card_vintage . "', '" . $row_result["Card_Limit"] . "','" . $row_result["IP_Address"] . "','" . RemoveBS(clean($row_result["Add_Comment"])) . "','" . $row_result["identification_proof"] . "','" . $asmtype . "','" . $row_result["Primary_Acc"] . "','" . $Company_Type . "','" . $Salary_Drawn . "','" . $row_result["axis_executive_name"] . "', '" . $zone . "','" . $annual_turnover . "','" . $exclusiveLead . "', '" . $BiddCity . "','" . $citiuniqueid . "', '" . $row_result["Existing_Bank"] . "', '" . $row_result["Existing_Loan"] . "', '" . $row_result["Existing_ROI"] . "', '" . RemoveBS(clean($comment_section)) . "', '" . $smtype . "','" . $row_result['ReferenceID'] . "', '" . $row_result["Pincode"] . "', '" . RemoveBS(clean($row_result["Residence_Address"])) . "', '" . $row_result["Pancard"] . "', 'Status-" . getApiStatus($StatusArr[1]).",".$apifeedbackarr[1].", ".$apifeedbackarr[3] . "')"; 
            } 
            
            else {
                
                if (strlen($row_result["Comments"] > 0)) {
                    $comment_section = str_replace('/', '|', str_replace('}', '', str_replace('{', '', str_replace('@', '', str_replace('"', '', str_replace("/", "-", str_replace("#", " ", str_replace("'", " ", $row_result["comment_section"]))))))));
                } else {
                    $comment_section = str_replace('/', '|', str_replace('}', '', str_replace('{', '', str_replace('@', '', str_replace('"', '', str_replace("/", "-", str_replace("#", " ", str_replace("'", " ", $row_result["comment_section"]))))))));
                }

                $qry1 = "insert into temp (session_id, name, dob, email, emp_status, c_name, city, city_other, year_in_comp, total_exp, mobile_number, net_salary, residential_status, loan_any, emi_paid, cc_holder, loan_amount, Feedback, count_views, count_replies, is_modified, is_processed, pincode, doe, card_vintage, card_limit,ip_address,add_comment,Documents,residence_address, bank_name,property_type,address_apt, referred_page,vehicle_owned, plan_interested, current_age, docs,request_id, car_make, car_model, car_type,account_no, budget, unique_id, std_code_o, landline_o, pancard,no_of_banks,bidderid) values ('" . $session_id . "', '" . $row_result["Name"] . "', '" . $dob . "', '" . $row_result["Email"] . "', '" . $emp_status . "', '" . $row_result["Company_Name"] . "', '" . $row_result["City"] . "', '" . $row_result["City_Other"] . "', '" . $row_result["Years_In_Company"] . "', '" . $row_result["Total_Experience"] . "', '" . $contactNo . "', '" . $Salary . "', '" . $residential_status . "', '" . $row_result["Loan_Any"] . "', '" . $emi_paid . "', '" . $cc_holder . "', '" . $Loan_Amount . "', '" . $feedback . "', '" . $hdfceligibility . "', '" . $citieligibility . "', '" . $barclayeligibility . "', '" . $row_result["PL_EMI_Amt"] . "', '" . $row_result["Pincode"] . "', '" . $Dateofallocation . "', '" . $card_vintage . "', '" . $row_result["Card_Limit"] . "','" . $row_result["IP_Address"] . "','" . $row_result["Add_Comment"] . "','" . $row_result["identification_proof"] . "','" . $asmtype . "','" . $row_result["Primary_Acc"] . "','" . $Company_Type . "','" . $Salary_Drawn . "','" . $row_result["axis_executive_name"] . "', '" . $zone . "','" . $annual_turnover . "','" . $exclusiveLead . "', '" . $BiddCity . "','" . $citiuniqueid . "', '" . $row_result["Existing_Bank"] . "', '" . $row_result["Existing_Loan"] . "', '" . $row_result["Existing_ROI"] . "', '" . $comment_section . "', '" . $smtype . "','" . $uniqueid . "', '" . $row_result["Pincode"] . "', '" . $row_result["Residence_Address"] . "', '" . $row_result["Pancard"] . "','" . $row_result["Followup_Date"] . "','" . $row_result["BidderID"] . "')";
                //$qry1="insert into temp (session_id, name, dob, email, emp_status, c_name, city, city_other, year_in_comp, total_exp, mobile_number, net_salary, residential_status, loan_any, emi_paid, cc_holder, loan_amount, Feedback, count_views, count_replies, is_modified, is_processed, pincode, doe, card_vintage, card_limit,ip_address,add_comment,Documents,residence_address, bank_name,property_type,address_apt, referred_page,vehicle_owned, plan_interested, current_age, docs,request_id, car_make, car_model, car_type,account_no, budget, unique_id) values ('".$session_id."', '".$row_result["Name"]."', '".$dob."', '".$row_result["Email"]."', '".$emp_status."', '".$row_result["Company_Name"]."', '".$row_result["City"]."', '".$row_result["City_Other"]."', '".$row_result["Years_In_Company"]."', '".$row_result["Total_Experience"]."', '".$contactNo."', '".$Salary."', '".$residential_status."', '".$row_result["Loan_Any"]."', '".$emi_paid."', '".$cc_holder."', '".$Loan_Amount."', '".$feedback."', '".$hdfceligibility."', '".$citieligibility."', '".$barclayeligibility."', '".$row_result["PL_EMI_Amt"]."', '".$row_result["Pincode"]."', '".$Dateofallocation."', '".$card_vintage."', '".$row_result["Card_Limit"]."','".$row_result["IP_Address"]."','".$row_result["Add_Comment"]."','".$row_result["identification_proof"]."','".$asmtype."','".$row_result["Primary_Acc"]."','".$Company_Type."','".$Salary_Drawn."','".$row_result["axis_executive_name"]."', '".$zone."','".$annual_turnover."','".$exclusiveLead."', '".$BiddCity."','".$citiuniqueid."', '".$row_result["Existing_Bank"]."', '".$row_result["Existing_Loan"]."', '".$row_result["Existing_ROI"]."', '', '".$smtype."','".$uniqueid."')";
            }
        }
        $result1 = ExecQuery($qry1);
    }// pl ends here

    if ($qry2 == "Req_Loan_Home") {
        if ($datediffvar <= 1) {
            $contactNo = $row_result["Mobile_Number"];
            $uniqueid = "HL" . $row_result["Feedback_ID"] . "S" . $row_result['sentbidder'];
        } else {
            $contactNo = "";
            $uniqueid = "HL" . $row_result["Feedback_ID"] . "S" . $row_result['sentbidder'];
        }
        $comment_section = str_replace('/', '|', str_replace('}', '', str_replace('{', '', str_replace('@', '', str_replace('"', '', str_replace("/", "-", str_replace("#", " ", str_replace("'", " ", $row_result["comment_section"]))))))));
        $exclusiveLead = '';
        if ($row_result["Bidder_Count"] == 1) {
            $exclusiveLead = "Exclusive Lead";
        }
        if ($row_result["Property_Identified"] == 0) {
            $property_identified = "No";
        } elseif ($row_result["Property_Identified"] == 1) {
            $property_identified = "Yes";
        } else {
            $property_identified = "";
        }

        if ($row_result["Employment_Status"] == 0) {
            $emp_status = "Self Employed";
        } else {
            $emp_status = "Salaried";
        }
        $Add_CommentHL = str_replace('/', '|', str_replace('}', '', str_replace('{', '', str_replace('@', '', str_replace('"', '', str_replace("/", "-", str_replace("#", " ", str_replace("'", " ", $row_result["Add_Comment"]))))))));

        $CommentHL_Add = str_replace('/', '|', str_replace('}', '', str_replace('{', '', str_replace('@', '', str_replace('"', '', str_replace("/", "-", str_replace("#", " ", str_replace("'", " ", $row_result["Comments"]))))))));
        $Dateofallocation = $row_result["Allocation_Date"];
        $bank_name = "Deal4loans";
        $total_exp = "Home Loan";

        if ($BidderIDstatic == 5500) { // TATA Capital
            $tataleadid = "";
            //
            $tataleadqry = "Select feedback From webservice_bidder_details where (leadid='" . $row_result["Feedback_ID"] . "' and bidderid in (5498,5499,6090,6091,6092,6097,6098,6099)) order by doe DESC LIMIT 0,1";
            $tataleadresult = ExecQuery($tataleadqry);
            $tatarow = mysql_fetch_array($tataleadresult);
            $webfeedback = $tatarow["feedback"];
            $expires = preg_split('/Lead id/', $webfeedback);
            array_shift($expires);
            $strcheck = implode(" ", $expires);
            $check = explode(" ", $strcheck);
            $Leadid = $check[0];
            if ($Leadid > 0) {
                $tataleadid = str_replace("=", "", str_replace('"', '', $Leadid));
            } else {
                $expires = preg_split('/leadId/', trim($webfeedback));
                array_shift($expires);
                $strcheck = implode(" ", $expires);
                $check = explode(" ", $strcheck);
                $tataleadid = str_replace("=", "", str_replace('"', '', $check[2]));
            }
        }
        if ($BidderIDstatic == 6319) {
            if ($row_result["sbitelecaller"] == 1) {
                $telecallerid = "telecaller";
            } elseif ($row_result["sbitelecaller"] == 2) {
                $telecallerid = "internal telecaller";
            } else {
                $telecallerid = "";
            }
				
            $ASMFollowup_Date = "";
            $Followup_Date = "";
            $ASMFollowup_Date = $row_result["Asm_Followup_Date"];
            $Followup_Date = $row_result["Followup_Date"];

            if ($datediffvar <= 1) {
                $contactNo = $row_result["Mobile_Number"];
                $uniqueid = "HL" . $row_result["Feedback_ID"] . "S" . $row_result['BidderID'];
            } else {
                $contactNo = "";
                $uniqueid = "HL" . $row_result["Feedback_ID"] . "S" . $row_result['BidderID'];
            }
            $Asm_Comments = str_replace('/', '|', str_replace('}', '', str_replace('{', '', str_replace('@', '', str_replace('"', '', str_replace("/", "-", str_replace("#", " ", str_replace("'", " ", $row_result["Asm_Comments"]))))))));
            $Comments = str_replace('/', '|', str_replace('}', '', str_replace('{', '', str_replace('@', '', str_replace('"', '', str_replace("/", "-", str_replace("#", " ", str_replace("'", " ", $row_result["Comments"]))))))));

            $GetCitySql = ExecQuery("select asm_name from sbihl_6168_asmlist where (bidderid=" . $row_result["AsmID"] . " and status=1 )");
            $asmrow = mysql_fetch_array($GetCitySql);
            $GetupdateddateSql = ExecQuery("SELECT Dated FROM telecaller_feedback_bookkeeping WHERE AllRequestID = ".$row_result["AllRequestID"]." AND BidderID IN (SELECT BidderID  FROM `Bidders` WHERE (`Global_Access_ID` = '6319' OR BidderID = 6168)) ORDER BY bookkeepid DESC LIMIT 0,1");
            $ltuprow = mysql_fetch_array($GetupdateddateSql);

            /* SBI HL ASM Details */
            $ASMSBISql = ExecQuery("SELECT final_feedback,feedback FROM webservice_bidder_details WHERE cust_requestid = ".$row_result["AllRequestID"]." AND BidderID IN (SELECT BidderID  FROM `Bidders` WHERE (`Global_Access_ID` = '6319' OR BidderID = 6168))");
            $ASMSBISqlrow = mysql_fetch_array($ASMSBISql);
            $StrRepFirstBracket = str_replace("[", "", $ASMSBISqlrow[0]);
            $StrRepFinal = str_replace("]", "", $StrRepFirstBracket);
            $obj = json_decode($StrRepFinal);
            $CurrentStatus = $obj->{'CurrentStatus'};
            $TeleCallerStatus = $obj->{'TeleCaller Status'};
            $ASMCode = $obj->{'ASMCode'};
            $ASMName = $obj->{'ASMName'};
            $ASMStatus = $obj->{'ASM Status'};
            $LOSNO = $obj->{'LOSNO'};
            $EntryDate = $obj->{'EntryDate'};
            $EntryDate = date('Y-m-d H:i:s', strtotime($EntryDate));
            $LastUpdatedDate = $obj->{'LastUpdated Date'};
            $LastUpdatedDate = date('Y-m-d H:i:s', strtotime($LastUpdatedDate));
			$TCComments = $obj->{'TCComments'};
			$ASMComments = $obj->{'ASMComments'};
			
            $ASMComments = str_replace("�", " ", $ASMComments);
            $ASMComments = str_replace("�", " ", $ASMComments);
            $ASMComments = str_replace("�", " ", $ASMComments); // Put Regex instead str_replace

            $TCComments = clean($TCComments);
            $TCComments = RemoveBS($TCComments);
            
            $ASMComments = clean($ASMComments);
            $ASMComments = RemoveBS($ASMComments);

            if (strlen($ASMSBISqlrow[1]) > 0) {
                $sbifeedback = $ASMSBISqlrow[1];
                $StrRepFirstBracket = str_replace("[", "", $sbifeedback);
                $StrRepFinal = str_replace("]", "", $StrRepFirstBracket);
				$objsbi = json_decode($StrRepFinal);
                $status = $objsbi->Status;
                $statusarray = explode(":", $status);
                $Leadidsbi = $statusarray[2];
            }
            /* ASm End */

             $qry1 = "insert into temp (session_id, name, dob, email, emp_status, city, city_other, pincode, total_exp,mobile_number, net_salary, descr, loan_amount, Feedback, property_identified, property_loc, doe,add_comment,docs,property_value, bank_name , employer,c_name,loan_time,marital_status, residential_status, current_age, account_no, unique_id, contact_time, car_type,logout_date, changeapp_time, login_date,car_make,car_model, property_type, constitution, Documents, year_in_comp, std_code, landline,std_code_o, landline_o, request_id ) values ('" . $session_id . "', '" . $row_result["Name"] . "', '" . $row_result["DOB"] . "', '" . $row_result["Email"] . "', '" . $emp_status . "', '" . $row_result["City"] . "', '" . $row_result["City_Other"] . "', '" . $row_result["Pincode"] . "', '" . $total_exp . "', '" . $contactNo . "', '" . $row_result["Net_Salary"] . "', '" . $Add_CommentHL . "', '" . $row_result["Loan_Amount"] . "', '" . $row_result["Feedback"] . "', '" . $property_identified . "', '" . $row_result["Property_Loc"] . "', '" . $Dateofallocation . "', '" . $Comments . "', '" . $row_result["caller_name"] . "', '" . $row_result["Property_Value"] . "', '" . $asmrow["asm_name"] . "', '" . $row_result["Asm_Feedback"] . "','" . $row_result["Company_Name"] . "','" . $row_result["Existing_Bank"] . "','" . $row_result["Existing_ROI"] . "','" . $row_result["Existing_Loan"] . "','" . $exclusiveLead . "','" . $row_result["RequestID"] . "','" . $uniqueid . "', '" . $ASMFollowup_Date . "', '" . $telecallerid . "','" . $Followup_Date . "','" . $row_result["asm_allocation_date"] . "','" . $ltuprow["Dated"] . "', '" . $CurrentStatus . "', '" . $TeleCallerStatus . "', '" . $ASMCode . "','".$TCComments."', '".$ASMComments."', '" . $ASMName . "', '" . $ASMStatus . "', '" . $LOSNO . "', '" . $EntryDate . "', '" . $LastUpdatedDate . "','" . $Leadidsbi . "')";
        } else if ($BidderIDstatic == 6356) {
            $GetCallerSql = ExecQuery("select BidderID, City from Bidders where (BidderID=" . $row_result['BidderID'] . ")");
            $CallerRows = mysql_fetch_array($GetCallerSql);
            $qry1 = "insert into temp (session_id, name, dob, email, emp_status, city, city_other, pincode, total_exp,mobile_number, net_salary, descr, loan_amount, Feedback, budget, property_identified, property_loc, loan_time, doe,add_comment,docs,property_value, bank_name , employer,c_name,gender,marital_status, residential_status, current_age, account_no, unique_id,request_id, contact_time, logout_date, constitution) values ('" . $session_id . "', '" . $row_result["Name"] . "', '" . $row_result["DOB"] . "', '" . $row_result["Email"] . "', '" . $emp_status . "', '" . $row_result["City"] . "', '" . $row_result["City_Other"] . "', '" . $row_result["Pincode"] . "', '" . $total_exp . "', '" . $contactNo . "', '" . $row_result["Net_Salary"] . "', '" . $Add_CommentHL . "', '" . $row_result["Loan_Amount"] . "', '" . $row_result["Feedback"] . "', '" . $row_result["Budget"] . "', '" . $property_identified . "', '" . $row_result["Property_Loc"] . "', '" . $row_result["Loan_Time"] . "', '" . $Dateofallocation . "', '" . $CommentHL_Add . "', '" . $row_result["Feedback_ID"] . "', '" . $row_result["Property_Value"] . "', '" . $bank_name . "', '" . $row_result["axis_executive_name"] . "','" . $row_result["Company_Name"] . "','" . $row_result["Existing_Bank"] . "','" . $row_result["Existing_ROI"] . "','" . $row_result["Existing_Loan"] . "','" . $exclusiveLead . "','" . $row_result["RequestID"] . "','" . $uniqueid . "','" . $tataleadid . "', '" . $ASMFollowup_Date . "', '" . $Followup_Date . "', '" . $CallerRows['City'] . "' )";
        }
		elseif($BidderIDstatic == 6717 || $BidderIDstatic == 7348) {
			if($row_result["source"] != 'HLReferralProgram' && $row_result["source"] != 'HLInternalReference'){
				$source = 'Web';
			}else{
				$source = $row_result["source"];
			}
			if($BidderIDstatic == 7348)
			{
				$mobileno= "";
			}
			else
			{
				$mobileno= $contactNo;
			}
			$sqllifecycle="Select Dated,Feedback,Comments From feedback_bookkeeping Where (AllRequestID='".$row_result["RequestID"]."' and Reply_Type=2 and leadidentifier='hlallocatelms' and Feedback not in ('Email Sent','Sms Sent','Manager Allocate','Re-assign')) order by Dated DESC LIMIT 0,1";
			$sqllifecycleresult = ExecQuery($sqllifecycle); 
			$licylrow = mysql_fetch_array($sqllifecycleresult);
			
			$sqlmanagerid="Select BidderID as ManagerID, Allocation_Date FROM hlcallinglms_allocation WHERE AllRequestID = '".$row_result["RequestID"]."' AND BidderID IN (SELECT `BidderID` FROM `Bidders` WHERE `Selection_Category`=2 AND `leadidentifier` = 'hlallocatelms') ORDER BY Allocation_Date DESC  LIMIT 0,1";
			$sqlmanageridresult = ExecQuery($sqlmanagerid); 
			$managerrow = mysql_fetch_array($sqlmanageridresult);
			$ManagerID = $managerrow['ManagerID'];
			
            $qry1 = "insert into temp (session_id, name, dob, email, emp_status, city, city_other, pincode, total_exp,mobile_number, net_salary, descr, loan_amount, source, car_make, Feedback, budget, property_identified, property_loc, loan_time, doe,add_comment,docs,property_value, bank_name , employer,c_name,gender,marital_status, residential_status, current_age, account_no, unique_id,request_id, contact_time, logout_date, bidderid) values ('" . $session_id . "', '" . $row_result["Name"] . "', '" . $row_result["DOB"] . "', '" . $row_result["Email"] . "', '" . $emp_status . "', '" . $row_result["City"] . "', '" . $row_result["City_Other"] . "', '" . $row_result["Pincode"] . "', '" . $total_exp . "', '" . $mobileno . "', '" . $row_result["Net_Salary"] . "', '" . $Add_CommentHL . "', '" . $row_result["Loan_Amount"] . "', '" . $source . "', '" . $row_result["Referrer"] . "', '" . $row_result["Feedback"] . "', '" . $row_result["Budget"] . "', '" . $property_identified . "', '" . $row_result["Property_Loc"] . "', '" . $row_result["Loan_Time"] . "', '" . $Dateofallocation . "', '" . $row_result["Comments"]  . "', '" . $row_result["checked_bidders"] . "', '" . $row_result["Property_Value"] . "', '" .$licylrow["Dated"] . "', '" . $row_result["axis_executive_name"] . "','" . $row_result["Company_Name"] . "','" . $row_result["Existing_Bank"] . "','" . $row_result["Existing_ROI"] . "','" . $row_result["Existing_Loan"] . "','" . $exclusiveLead . "','" . $row_result["RequestID"] . "','" . $row_result["RequestID"] . "','" . $row_result["allocatedBidid"] . "', '" . $row_result["old_bidderid"] . "', '" . $row_result["Followup_Date"] . "', '" . $ManagerID . "' )";
			//echo "".$qry1."<br>";
        }else {
            $qry1 = "insert into temp (session_id, name, dob, email, emp_status, city, city_other, pincode, total_exp,mobile_number, net_salary, descr, loan_amount, Feedback, budget, property_identified, property_loc, loan_time, doe,add_comment,docs,property_value, bank_name , employer,c_name,gender,marital_status, residential_status, current_age, account_no, unique_id,request_id, contact_time, logout_date) values ('" . $session_id . "', '" . $row_result["Name"] . "', '" . $row_result["DOB"] . "', '" . $row_result["Email"] . "', '" . $emp_status . "', '" . $row_result["City"] . "', '" . $row_result["City_Other"] . "', '" . $row_result["Pincode"] . "', '" . $total_exp . "', '" . $contactNo . "', '" . $row_result["Net_Salary"] . "', '" . $Add_CommentHL . "', '" . $row_result["Loan_Amount"] . "', '" . $row_result["Feedback"] . "', '" . $row_result["Budget"] . "', '" . $property_identified . "', '" . $row_result["Property_Loc"] . "', '" . $row_result["Loan_Time"] . "', '" . $Dateofallocation . "', '" . $comment_section . "', '" . $row_result["Feedback_ID"] . "', '" . $row_result["Property_Value"] . "', '" . $bank_name . "', '" . $row_result["axis_executive_name"] . "','" . $row_result["Company_Name"] . "','" . $row_result["Existing_Bank"] . "','" . $row_result["Existing_ROI"] . "','" . $row_result["Existing_Loan"] . "','" . $exclusiveLead . "','" . $row_result["RequestID"] . "','" . $uniqueid . "','" . $tataleadid . "', '" . $ASMFollowup_Date . "', '" . $Followup_Date . "' )";
            //echo "".$qry1."<br>";
        }
        $result1 = ExecQuery($qry1);
    }

    if ($qry2 == "Req_Loan_Car") {
        if ($datediffvar <= 1) {
            $contactNo = $row_result["Mobile_Number"];
            $uniqueid = "CL" . $row_result["Feedback_ID"] . "S" . $row_result['sentbidder'];
        } else {
            $contactNo = "";
            $uniqueid = "CL" . $row_result["Feedback_ID"] . "S" . $row_result['sentbidder'];
        }
        $exclusiveLead = '';
        if ($row_result["Bidder_Count"] == 1) {
            $exclusiveLead = "Exclusive Lead";
        }
        if ($row_result["Employment_Status"] == 0) {
            $emp_status = "Self Employed";
        } else {
            $emp_status = "Salaried";
        }
        if ($row_result["Car_Type"] == 1) {
            $car_type = "New";
        }
        if ($row_result["Car_Type"] == 0) {
            $car_type = "Old";
        }

        if ($row_result["Car_Booked"] == 2) {
            $Car_Booked = "Yes";
        } else if ($row_result["Car_Booked"] == 1) {
            $Car_Booked = "No";
        } else {
            $Car_Booked = "";
        }

        $acc_no = $row_result["Account_No"];
        $descr = $Car_Booked;
        $Dateofallocation = $row_result["Allocation_Date"];

        $pieces = explode(",", $row_result["CL_Bank"]);
        $specialP = "";
        for ($i = 0; $i < count($pieces); $i++) {
            if ($pieces[$i] == "HDFC") {
                $specialP = $pieces[$i];
            }
        }
        if ($BidderIDstatic == 1825) {
            $address_apt = "";
            $changeapp_time = "";
            $apt_dt = "";
            $time = "";
            $appdate = "";
            $getAppointmentSql = "SELECT address_apt,changeapp_time,appdate FROM hdfc_cl_appointments where RequestID='" . $row_result["RequestID"] . "'";
            $getAppointmentQuery = ExecQuery($getAppointmentSql);
            $getAppointmentNum = mysql_num_rows($getAppointmentQuery);
            if ($getAppointmentNum > 0) {
                $address_apt = mysql_result($getAppointmentQuery, 0, 'address_apt');
                $changeapp_time = mysql_result($getAppointmentQuery, 0, 'changeapp_time');
                $time = '';
                if ($changeapp_time == "08:00:00") {
                    $time = "8(am)-9(am)";
                } else if ($changeapp_time == "09:00:00") {
                    $time = "9(am)-10(am)";
                } else if ($changeapp_time == "10:00:00") {
                    $time = "10(am)-11(am)";
                } else if ($changeapp_time == "11:00:00") {
                    $time = "11(am)-12(pm)";
                } else if ($changeapp_time == "12:00:00") {
                    $time = "12(pm)-1(pm)";
                } else if ($changeapp_time == "13:00:00") {
                    $time = "1(pm)-2(pm)";
                } else if ($changeapp_time == "14:00:00") {
                    $time = "2(pm)-3(pm)";
                } else if ($changeapp_time == "15:00:00") {
                    $time = "3(pm)-4(pm)";
                } else if ($changeapp_time == "16:00:00") {
                    $time = "4(pm)-5(pm)";
                } else if ($changeapp_time == "17:00:00") {
                    $time = "5(pm)-6(pm)";
                } else if ($changeapp_time == "18:00:00") {
                    $time = "6(pm)-7(pm)";
                } else if ($changeapp_time == "19:00:00") {
                    $time = "7(pm)-8(pm)";
                }
                $appdate = mysql_result($getAppointmentQuery, 0, 'appdate');
                $apt_dt = $appdate . ", " . $time;
            }

            if ($row_result["Existing_Relationship"] == 1) {
                $Existing_Relationship = "Account Holder";
            }
            if ($row_result["Existing_Relationship"] == 2) {
                $Existing_Relationship = "Loan Running";
            }
            if ($row_result["Existing_Relationship"] == 3) {
                $Existing_Relationship = "Credit Card Holder";
            }
            if ($row_result["Existing_Relationship"] == 0) {
                $Existing_Relationship = "";
            }
            $reward_selected = $row_result["reward_selected"];
            $Product_Name = '';
            $getGiftsSql = "SELECT * FROM hdfc_car_loan_gifts WHERE id ='" . $reward_selected . "'";
            $getGiftsQuery = ExecQuery($getGiftsSql);
            $numGiftsQuery = mysql_num_rows($getGiftsQuery);
            if ($numGiftsQuery > 0) {
                $Product_Name = mysql_result($getGiftsQuery, 0, 'Product_Name');
            }
        }

        list($firstnme, $lastnme) = split('[ ]', $row_result["Name"]);

        $qry1 = "insert into temp (session_id, name, dob, email, emp_status, c_name, city, city_other, mobile_number, net_salary, car_model, loan_amount, pincode, Feedback, contact_time, is_processed, doe,add_comment, descr,pancard,referred_page, changeapp_time, apt_dt, address_apt, loan_tenure,docs,bank_name,budget,product_type, constitution, current_age, landline , property_value, car_type) values ('" . $session_id . "', '" . $firstnme . "', '" . $row_result["DOB"] . "', '" . $row_result["Email"] . "', '" . $emp_status . "', '" . $row_result["Company_Name"] . "', '" . $row_result["City"] . "', '" . $row_result["City_Other"] . "', '" . $contactNo . "',  '" . $row_result["Net_Salary"] . "', '" . $row_result["Car_Model"] . "', '" . $row_result["Loan_Amount"] . "', '" . $row_result["Pincode"] . "', '" . $row_result["Feedback"] . "', '" . $row_result["Contact_Time"] . "', '" . $car_type . "', '" . $Dateofallocation . "','" . $row_result["comment_section"] . "','" . $descr . "','" . $acc_no . "','" . $specialP . "','" . $time . "','" . $appdate . "','" . $address_apt . "','" . $Existing_Relationship . "','" . $row_result["Delivery_Date"] . "', '" . $row_result["Pancard"] . "', '" . $row_result["Office_address"] . "', '" . $row_result["Residence_Address"] . "', '" . $Product_Name . "','" . $exclusiveLead . "','" . $row_result["Landline"] . "', '" . $lastnme . "','" . $Car_Booked . "')";
        //echo "".$qry1."<br>";
        $result1 = ExecQuery($qry1);
    }

    if ($qry2 == "Req_Loan_Bike") {
        $exclusiveLead = '';
        if ($row_result["Bidder_Count"] == 1) {
            $exclusiveLead = "Exclusive Lead";
        }
        if ($row_result["Employment_Status"] == 0) {
            $emp_status = "Self Employed";
        } else {
            $emp_status = "Salaried";
        }
        $Dateofallocation = $row_result["Allocation_Date"];
        $qry1 = "insert into temp (session_id, name, dob, email, emp_status, c_name, city, city_other, mobile_number, net_salary, car_model, loan_amount,  Feedback, doe,add_comment, current_age) values ('" . $session_id . "', '" . $row_result["Name"] . "', '" . $row_result["DOB"] . "', '" . $row_result["Email"] . "', '" . $emp_status . "', '" . $row_result["Company_Name"] . "', '" . $row_result["City"] . "', '" . $row_result["City_Other"] . "', '" . $row_result["Mobile_Number"] . "',  '" . $row_result["Net_Salary"] . "', '" . $row_result["Bike_Varient"] . "', '" . $row_result["Loan_Amount"] . "', '" . $row_result["Feedback"] . "', '" . $Dateofallocation . "','" . $row_result["comment_section"] . "', '" . $exclusiveLead . "')";
        //echo "".$qry1."<br>";
        $result1 = ExecQuery($qry1);
    }

    if ($qry2 == "Req_Credit_Card") {
        if ($BidderIDstatic == 5633) {
            $contactNo = "";
            $uniqueid = "CC" . $row_result["Feedback_ID"] . "S" . $row_result['sentbidder'];
        } else {
            if ($datediffvar <= 1) {
                $contactNo = $row_result["Mobile_Number"];
                $uniqueid = "CC" . $row_result["Feedback_ID"] . "S" . $row_result['sentbidder'];
            } else {
                $contactNo = "";
                $uniqueid = "CC" . $row_result["Feedback_ID"] . "S" . $row_result['sentbidder'];
            }
        }
        $exclusiveLead = '';
        $allocateccbid = "";
        $Followupdate = '';

        $Followupdate = $row_result["Followup_Date"];
        if ($row_result["Bidder_Count"] == 1) {
            $exclusiveLead = "Exclusive Lead";
        }
        if ($BidderIDstatic == 3190 || $BidderIDstatic == 3667) {
            if ($row_result["Feedback"] == "FollowUp" || $row_result["Feedback"] == "") {
                $icici_ccstatus = "Open";
            } else {
                $icici_ccstatus = "Closed";
            }

            $cc_Vintage = '';
            $cc_limit = '';
            $ccVintage = '';
            $cclimit = '';
            $cc_Vintage = $row_result["Card_Vintage"];
            $cc_limit = $row_result["Credit_Limit"];
            if ($cc_Vintage == 1) {
                $ccVintage = 'Less than 6 months';
            } else if ($cc_Vintage == 2) {
                $ccVintage = '6 to 9 months';
            } else if ($cc_Vintage == 3) {
                $ccVintage = '9 to 12 months';
            } else if ($cc_Vintage == 4) {
                $ccVintage = 'more than 12 months';
            } else {
                $ccVintage = '';
            }

            if ($cc_limit == 1) {
                $cclimit = 'Upto 75,000';
            } else if ($cc_limit == 2) {
                $cclimit = '75,000 to 1,50,000';
            } else if ($cc_limit == 3) {
                $cclimit = '1,50,000 & Above';
            } else {
                $cclimit = '';
            }
        }

        if ($row_result["Employment_Status"] == 0) {
            $emp_status = "Self Employed";
        } else {
            $emp_status = "Salaried";
        }

        $Dateofallocation = $row_result["Allocation_Date"];
        if ($row_result["Existing_Relationship"] == 1) {
            $Existing_Relationship = "Account Holder";
        }
        if ($row_result["Existing_Relationship"] == 2) {
            $Existing_Relationship = "Loan Running";
        }
        if ($row_result["Existing_Relationship"] == 3) {
            $Existing_Relationship = "Credit Card Holder";
        }
        if ($row_result["Existing_Relationship"] == 0) {
            $Existing_Relationship = "";
        }
        $dob = $row_result["DOB"];

        if ($BidderIDstatic == 2009) {
            $desrc = $row_result["Descr"];
            $strdesrc = "";
            $arrdesrc = explode(",", $desrc);
            for ($ar = 0; $ar < count($arrdesrc); $ar++) {
                if ($arrdesrc[$ar] == "HDFC Platinum Plus Card" || $arrdesrc[$ar] == "HDFC Gold Card") {
                    $strdesrc = $arrdesrc[$ar];
                    //$strdesrc.=$strdesrc.",";
                }
            }
        } else {
            $strdesrc = $row_result["Descr"];
        }
        if ($row_result["CC_Holder"] == 1) {
            $cc_holder = "Yes";
        }
        if ($row_result["CC_Holder"] == 0) {
            $cc_holder = "No";
        }

        if ($BidderIDstatic == 2370) {
            $fname = '';
            $mname = '';
            $lname = '';
            $gender = '';
            $qualification = '';
            $address1 = '';
            $address2 = '';
            $address = '';
            $designation = '';
            $pancard = '';
            $existing_customer = '';

            $getSTancSql = "select * from pl_stanc_leads where RequestID=" . $row_result["RequestID"];
            $getSTancQuery = ExecQuery($getSTancSql);
            $numSTanc = mysql_num_rows($getSTancQuery);
            if ($numSTanc > 0) {
                $fname = mysql_result($getSTancQuery, 0, 'fname');
                $mname = mysql_result($getSTancQuery, 0, 'mname');
                $lname = mysql_result($getSTancQuery, 0, 'lname');
                $gender = mysql_result($getSTancQuery, 0, 'gender');
                $qualification = mysql_result($getSTancQuery, 0, 'qualification');
                $address1 = mysql_result($getSTancQuery, 0, 'address1');
                $address2 = mysql_result($getSTancQuery, 0, 'address2');
                $address = $address1 . " " . $address2;
                $designation = mysql_result($getSTancQuery, 0, 'designation');
                $pancard = mysql_result($getSTancQuery, 0, 'pancard');
                $existing_customer = mysql_result($getSTancQuery, 0, 'existing_customer');
                $Pincode = mysql_result($getSTancQuery, 0, 'pincode');
            } else {
                $fname = $row_result["Name"];
                $Pincode = $row_result["Pincode"];
            }

            $qry1 = "insert into temp (session_id, name, dob, email, emp_status, c_name, city, city_other, mobile_number, net_salary, descr,Feedback, pancard, no_of_banks,  property_type,address_apt,add_comment,employer,bank_name,cc_holder,Documents,doe, std_code, landline, changeapp_time, apt_dt, loan_tenure, 	std_code_o,current_age,unique_id ) values ('" . $session_id . "', '" . $fname . "', '" . $mname . "', '" . $lname . "', '" . $dob . "', '" . $gender . "', '" . $qualification . "', '" . $row_result["Email"] . "', '" . $emp_status . "', '" . $row_result["Company_Name"] . "', '" . $row_result["City"] . "', '" . $row_result["City_Other"] . "', '" . $address . "', '" . $contactNo . "', '" . $row_result["Net_Salary"] . "', '" . $cc_holder . "',  '" . $row_result["No_of_Banks"] . "', '" . $designation . "',  '" . $pancard . "', '" . $existing_customer . "', '" . $strdesrc . "', '" . $Dateofallocation . "' ,'" . $row_result["Std_Code"] . "', '" . $row_result["Landline"] . "', '" . $row_result["Feedback"] . "', '" . $row_result["comment_section"] . "', '" . $Existing_Relationship . "', '" . $Pincode . "', '" . $exclusiveLead . "','" . $uniqueid . "')";
        } else if ($BidderIDstatic == 3190 || $BidderIDstatic == 3179 || $BidderIDstatic == 3183 || $BidderIDstatic == 3184 || $BidderIDstatic == 3185 || $BidderIDstatic == 3186 || $BidderIDstatic == 3188 || $BidderIDstatic == 3187 || $BidderIDstatic == 3189 || $BidderIDstatic == 3491 || $BidderIDstatic == 3492 || $BidderIDstatic == 3493 || $BidderIDstatic == 3494 || $BidderIDstatic == 3495 || $BidderIDstatic == 3478 || $BidderIDstatic == 3479 || $BidderIDstatic == 3480 || $BidderIDstatic == 3481 || $BidderIDstatic == 3501 || $BidderIDstatic == 3502 || $BidderIDstatic == 3662 || $BidderIDstatic == 3663 || $BidderIDstatic == 3664 || $BidderIDstatic == 3665 || $BidderIDstatic == 3666 || $BidderIDstatic == 3667 || $BidderIDstatic == 3821 || $BidderIDstatic == 3822 || $BidderIDstatic == 3823 || $BidderIDstatic == 3820) {
            $cardsarr = explode(",", $row_result["applied_card_name"]);
            $cardsarrunq = "";
            $cardsarrunq = array_unique($cardsarr);

            for ($r = 0; $r < count($cardsarrunq); $r++) {
                if ((strncmp("ICICI", $cardsarrunq[$r], 5)) == 0) {
                    $ccapplyname[] = $cardsarrunq[$r];
                }
            }
            $finalcardsname = $ccapplyname[0];

            $qry1 = "insert into temp (session_id, name, dob, email, emp_status, c_name, city, city_other, mobile_number, net_salary, descr,Feedback, pancard, no_of_banks,  property_type,doe,add_comment,employer,bank_name,cc_holder, std_code, landline,apt_dt, account_no, address_apt, marital_status,Card_Limit,residence_address,current_age,unique_id ) values ('" . $session_id . "', '" . $row_result["Name"] . "', '" . $dob . "', '" . $row_result["Email"] . "', '" . $emp_status . "', '" . $row_result["Company_Name"] . "', '" . $row_result["City"] . "', '" . $row_result["City_Other"] . "', '" . $contactNo . "', '" . $row_result["Net_Salary"] . "', '" . $strdesrc . "',  '" . $row_result["Feedback"] . "', '" . $row_result["Pancard"] . "',  '" . $row_result["No_of_Banks"] . "', '" . $row_result["Pancard_No"] . "', '" . $Dateofallocation . "','" . $row_result["comment_section"] . "', '" . $row_result["Account_No"] . "','" . $Existing_Relationship . "','" . $cc_holder . "','" . $row_result["Std_Code"] . "', '" . $row_result["Landline"] . "', '" . $icici_ccstatus . "','" . $ccVintage . "', '" . $cclimit . "','" . $row_result["Salary_Account"] . "','" . $finalcardsname . "','" . $row_result["Residence_Address"] . "', '" . $exclusiveLead . "','" . $uniqueid . "')";
        } elseif ($BidderIDstatic == 6251) {
            $citiuniqueid = "UN" . $row_result['sentbidder'] . "Q" . $row_result["Feedback_ID"] . "ID";
            $eoffer_code = "";
            $citifbqry = ExecQuery("select Name,DOB,City,City_Other,Gender,Mobile_Number,Email,Std_Code,Landline,Std_Code_O,Landline_O,Residence_Address,Pincode,Office_Address,Employment_Status,Pancard,Net_Salary,Company_Name from Req_Credit_Card where RequestID=" . $row_result["RequestID"] . "");
            $citirow = mysql_fetch_array($citifbqry);
            $ResiAddress = str_replace('|', '', str_replace('"', '', str_replace("/", " ", str_replace("#", " ", str_replace("'", " ", trim($citirow["Residence_Address"]))))));
            $OffiAddress = str_replace('|', '', str_replace('"', '', str_replace("/", " ", str_replace("#", " ", str_replace("'", " ", trim($citirow["Office_Address"]))))));

            if (strlen($row_result["ResiHouseNo"]) > 1 && strlen($row_result["ResiStreetNo"]) > 1) {
                $residential_add = $row_result["ResiHouseNo"]; //constitution =doorno 
                $ResiStreetNo = $row_result["ResiStreetNo"]; //residential_status =streetname
                $Residential_Area = $row_result["ResiArea"]; //vehicle_owned = Residential_Area
                $resi_landmark = $row_result["ResiLandmark"]; //address_apt = landmark
            } else {
                $strresiadd = round((strlen($ResiAddress) / 4));
                $resiadd = str_split($ResiAddress, $strresiadd);
                $residential_add = $resiadd[0]; //constitution=doorno
                $ResiStreetNo = $resiadd[1]; //residential_status =streetname
                $Residential_Area = $resiadd[2]; //vehicle_owned = Residential_Area
                $resi_landmark = $resiadd[3]; //address_apt = landmark
            }
            $residenceAddress = trim($residential_add) . " " . trim($ResiStreetNo) . " " . trim($Residential_Area) . " " . trim($resi_landmark) . " " . trim($citirow["City"]) . "-" . trim($citirow["Pincode"]);
            $offilandmark = "";
            if (strlen($row_result["OffiBuildingNo"]) > 1 && strlen($row_result["OffiStreetNo"]) > 1) {
                $offibuildingnumname = $row_result["OffiBuildingNo"]; //plan_interested =offibuildingnumname
                $offistreetname = $row_result["OffiStreetNo"]; //	year_in_comp = offistreetname
                $Office_Area = $row_result["OffiArea"]; //total_exp =Office_Area
                $offilandmark = $row_result["OffiLandmark"]; //employer =offilandmark 
            } else {
                $stroffiadd = round((strlen($OffiAddress) / 4));
                $offiadd = str_split($OffiAddress, $stroffiadd);
                $offibuildingnumname = $offiadd[0]; //plan_interested =offibuildingnumname
                $offistreetname = $offiadd[1]; //	year_in_comp = offistreetname
                $Office_Area = $offiadd[2]; //total_exp =Office_Area
                $offilandmark = $offiadd[3]; //employer =offilandmark 
            }
            $OfficeeAddress = trim($offibuildingnumname) . " " . trim($offistreetname) . " " . trim($Office_Area) . " " . trim($offilandmark) . " " . trim($row_result["OfficeCity"]) . "-" . trim($row_result["OfficePin"]);
            ; ///total_bill
            if (strlen($row_result["Mailing_Address"] > 2)) { // changeapp_time
                $Mailing_Address = $row_result["Mailing_Address"];
            } else {
                $Mailing_Address = "Residence";
            }

            $datetimearr = explode(" ", $row_result["Dated"]);
            $doearr = explode("-", $datetimearr[0]);
            $doe = $doearr[2] . "-" . $doearr[1] . "-" . $doearr[0];
            if ($citirow["Employment_Status"] == 0) {
                $emp_status = "Self Employed";
            } else {
                $emp_status = "Salaried";
            }
            if (trim($row_result["CardName"]) == "Citi Cash Back Card") {
                $eoffer_code = "PADLDINCCAENCB";
            } elseif (trim($row_result["CardName"]) == "Citi Premiermiles Credit Card") {
                $eoffer_code = "PADLDINCCAENPM";
            } elseif (trim($row_result["CardName"]) == "Citi Rewards Card") {
                $eoffer_code = "PADLDINCCAENCR";
            } elseif (trim($row_result["CardName"]) == "Indian Oil Citibank Card") {
                $eoffer_code = "PADLDINCCAENIO";
            } else {
                $eoffer_code = "PADLDINCCAENCB";
            }
            $offstd = "";
            if ($offstd == "") {
                if ($row_result["OfficeCity"] == "Kolkata") {
                    $offislct = "select std,state from sbi_cc_city_state_list Where (city like'%CALCUTTA%') group by city Limit 0,1";
                } else if ($row_result["OfficeCity"] == "Gaziabad") {
                    $offislct = "select std,state from sbi_cc_city_state_list Where (city like'%GHAZIABAD%') group by city Limit 0,1";
                } else if ($row_result["OfficeCity"] == "Navi Mumbai") {
                    $offislct = "select std,state from sbi_cc_city_state_list Where (city like'%MUMBAI%') group by city Limit 0,1";
                } else {
                    $offislct = "select std,state from sbi_cc_city_state_list Where (city like'%" . strtoupper($row_result["OfficeCity"]) . "%') group by city Limit 0,1";
                }
                $offislct = ExecQuery($offislct);
                $ofirow = mysql_fetch_array($offislct);
                $offstd = "0" . $ofirow["std"];
            }
//resi std
            $resistd = "";
            if ($resistd == "") {
                if ($citirow["City"] == "Kolkata") {
                    $resislct = "select std,state from sbi_cc_city_state_list Where (city like'%CALCUTTA%') group by city Limit 0,1";
                } else if ($citirow["City"] == "Gaziabad") {
                    $resislct = "select std,state from sbi_cc_city_state_list Where (city like'%GHAZIABAD%') group by city Limit 0,1";
                } else if ($citirow["City"] == "Navi Mumbai") {
                    $offislct = "select std,state from sbi_cc_city_state_list Where (city like'%MUMBAI%') group by city Limit 0,1";
                } else {
                    $resislct = "select std,state from sbi_cc_city_state_list Where (city like'%" . strtoupper($citirow["City"]) . "%') group by city Limit 0,1";
                }
                $resislct = ExecQuery($resislct);
                $rsrow = mysql_fetch_array($resislct);
                $resistd = "0" . $rsrow["std"];
            }

//DOE,Name,DOB,City/OtherCity,Gender,Mobile_Number,Email,landline No,Landline_O,,Residence_Address,,,Pincode,,,,,Office_Address,,,Create,Create,,,Employment_status,Create,Pancard_No,,,,,,,,Static Value,Net_salary,Static Value,Static Value,,,,Company name,Std_code+0,Std_code
//	Office_City - count_replies,Office_Pin_Code - count_views,Designation - is_modified, Channel - descr,Relationship Type - no_of_dependents,Agency_Code - source - Campaign_Code - Site,CARDNAME_1 - Card_Limit,Nationality - budget
            $pancard = strtoupper($citirow["Pancard"]);
            $auth = "Yes"; //	is_processed
            $statement_on_email = "No"; //apt_dt
//$Mail_Address1="RESIDENCE"; //referred_page
            $DNDstat = "No"; //already_download
            $compaigncode = "FAS";
            if (strlen($row_result["Qualification"]) > 1) {
                $education = $row_result["Qualification"];
            } else {
                $education = "Others";
            }//current_age
            if ($citirow["Gender"] == "Female") {
                $salutation = "MS";
            } else {
                $salutation = "MR";
            }
            $fullname = $salutation . " " . $citirow["Name"];
            $qry1 = "insert into temp (session_id, name, dob, city, city_other, gender, mobile_number, email, std_code, landline, std_code_o, landline_o, constitution, residential_status, vehicle_owned, address_apt, pincode, plan_interested, year_in_comp, total_exp, employer, emp_status, pancard, net_salary, c_name, count_views, count_replies, is_modified, Card_Limit, doe, descr, no_of_dependents, source, budget, unique_id, is_valid, is_processed, apt_dt, referred_page , already_download, changeapp_time, residence_address, total_bill, add_comment, current_age, bank_name, request_id)
		values ('" . $session_id . "', '" . $fullname . "','" . $citirow["DOB"] . "','" . $citirow["City"] . "','" . $citirow["City_Other"] . "','" . $citirow["Gender"] . "','" . $citirow["Mobile_Number"] . "','" . $citirow["Email"] . "','" . $resistd . "','" . $citirow["Landline"] . "','" . $offstd . "','" . $citirow["Landline_O"] . "','" . $residential_add . "', '" . $residential_area . "', '" . $Residential_Area . "','" . $resi_landmark . "', '" . $citirow["Pincode"] . "','" . $offibuildingnumname . "', '" . $offistreetname . "', '" . $Office_Area . "','" . $offilandmark . "','" . $emp_status . "','" . $pancard . "','" . $citirow["Net_Salary"] . "','" . $citirow["Company_Name"] . "', '" . $row_result["OfficePin"] . "','" . $row_result["OfficeCity"] . "','" . $row_result["Designation"] . "','" . $row_result["CardName"] . "','" . $doe . "', 'alliance', 'NTB-Customers', 'Deal4loans', 'INDIAN','" . $uniqueid . "','', '" . $auth . "', '" . $statement_on_email . "', '" . $Mailing_Address . "', '" . $DNDstat . "', '" . $Mailing_Address . "',  '" . $residenceAddress . "',  '" . $OfficeeAddress . "','" . $compaigncode . "','" . $education . "','" . $eoffer_code . "', '" . $citiuniqueid . "')";
        } else {
            if ($BidderIDstatic == 5633) {
                $allocateccbid = $row_result["allocateccbid"];
                $sbifbqry = ExecQuery("select ApplicationNumber,StatusCode,ProcessingStatus,Messages,message,StatusDesc_3 from sbi_credit_card_5633_log where cc_requestid=" . $row_result["RequestID"] . "");
                $sbirow = mysql_fetch_array($sbifbqry);
                $ApplicationNumber = $sbirow["ApplicationNumber"];
                $StatusCode = $sbirow["StatusCode"];
                $message = $sbirow["message"];
                $StatusDesc = $sbirow["StatusDesc"];
            }

            $amexstat = ExecQuery("select feedback from amex_cardwebservice where (requestID ='" . $row_result["RequestID"] . "')");
            $stat = mysql_fetch_array($amexstat);
            if ($BidderIDstatic == 3838) {
                $Dateofallocation = $row_result["Updated_Date"];
            }
            //print_r($row_result);	 die;
            $ResiAddress = str_replace('"', '', str_replace("/", " ", str_replace("#", " ", str_replace("'", " ", $row_result["Residence_Address"]))));
            $applied_card_name = str_replace('"', '', str_replace("/", " ", str_replace("#", " ", str_replace("'", " ", $row_result["applied_card_name"]))));

            $qry1 = "insert into temp (session_id, name, dob, email, emp_status, c_name, city, city_other, mobile_number, net_salary, descr,Feedback, pancard, no_of_banks,  property_type,doe,add_comment,employer,bank_name,cc_holder, std_code, landline, apt_dt, Card_Limit, is_valid, current_age, Residence_Address, changeapp_time, marital_status, car_make, car_model, car_type, residential_status, unique_id) values ('" . $session_id . "', '" . $row_result["Name"] . "', '" . $dob . "', '" . $row_result["Email"] . "', '" . $emp_status . "', '" . $row_result["Company_Name"] . "', '" . $row_result["City"] . "', '" . $row_result["City_Other"] . "', '" . $contactNo . "', '" . $row_result["Net_Salary"] . "', '" . $strdesrc . "',  '" . $row_result["Feedback"] . "', '" . $row_result["Pancard"] . "',  '" . $row_result["No_of_Banks"] . "', '" . $row_result["Pancard_No"] . "', '" . $Dateofallocation . "','" . $row_result["comment_section"] . "', '" . $row_result["Account_No"] . "','" . $Existing_Relationship . "','" . $cc_holder . "','" . $row_result["Std_Code"] . "', '" . $row_result["Landline"] . "', '" . $icici_ccstatus . "','" . $applied_card_name . "','" . $row_result["is_valid"] . "', '" . $exclusiveLead . "', '" . $ResiAddress . "', '" . $Followupdate . "','" . $allocateccbid . "','" . $ApplicationNumber . "','" . $StatusCode . "','" . $message . "','" . $StatusDesc . "','" . $uniqueid . "')";
        }
        $result1 = ExecQuery($qry1);
    }

    if ($qry2 == "Req_Loan_Against_Property") {
        if ($datediffvar <= 1) {
            $contactNo = $row_result["Mobile_Number"];
            $uniqueid = "LAP" . $row_result["Feedback_ID"] . "S" . $row_result['sentbidder'];
        } else {
            $contactNo = "";
            $uniqueid = "LAP" . $row_result["Feedback_ID"] . "S" . $row_result['sentbidder'];
        }

        $exclusiveLead = '';
        if ($row_result["Bidder_Count"] == 1) {
            $exclusiveLead = "Exclusive Lead";
        }
        if ($row_result["Property_Type"] == 1) {
            $property_type = "Residential";
        } elseif ($row_result["Property_Type"] == 2) {
            $property_type = "Commercial";
        }
        if ($row_result["Employment_Status"] == 0) {
            $emp_status = "Self Employed";
        } else {
            $emp_status = "Salaried";
        }

        $Dateofallocation = $row_result["Allocation_Date"];

        $dob = $row_result["DOB"];

        $qry1 = "insert into temp (session_id, name, dob, email, emp_status, c_name, city, city_other, mobile_number, net_salary, pincode, property_value, loan_amount, Feedback, doe,add_comment, request_id, property_type, current_age) values ('" . $session_id . "', '" . $row_result["Name"] . "', '" . $dob . "', '" . $row_result["Email"] . "', '" . $emp_status . "', '" . $row_result["Company_Name"] . "', '" . $row_result["City"] . "', '" . $row_result["City_Other"] . "', '" . $row_result["Mobile_Number"] . "', '" . $row_result["Net_Salary"] . "', '" . $row_result["Pincode"] . "', '" . $row_result["Property_Value"] . "', '" . $row_result["Loan_Amount"] . "', '" . $row_result["Feedback"] . "', '" . $Dateofallocation . "','" . $row_result["comment_section"] . "','" . $row_result["Feedback_ID"] . "','" . $property_type . "','" . $exclusiveLead . "')";
        $result1 = ExecQuery($qry1);
    }

    if ($qry2 == "Req_Loan_Gold") {

        if ($datediffvar <= 1) {
            $contactNo = $row_result["Mobile_Number"];
            $uniqueid = "GL" . $row_result["Feedback_ID"] . "S" . $row_result['sentbidder'];
        } else {
            $contactNo = "";
            $uniqueid = "GL" . $row_result["Feedback_ID"] . "S" . $row_result['sentbidder'];
        }


        $qry1 = "insert into temp (session_id, name, email, city, city_other, mobile_number, net_salary, loan_amount, dob, doe) values ('" . $session_id . "', '" . $row_result["Name"] . "', '" . $row_result["Email"] . "', '" . $row_result["branch_name"] . "', '" . $row_result["City_Other"] . "', '" . $row_result["Mobile_Number"] . "', '" . $row_result["Net_Salary"] . "', '" . $row_result["Loan_Amount"] . "', '" . $row_result["DOB"] . "', '" . $row_result["Allocation_Date"] . "')";
        $result1 = ExecQuery($qry1);
    }
    if ($qry2 == "Req_Loan_Education") {
        if ($datediffvar <= 1) {
            $contactNo = $row_result["Mobile_Number"];
            $uniqueid = "EL" . $row_result["Feedback_ID"] . "S" . $row_result['sentbidder'];
        } else {
            $contactNo = "";
            $uniqueid = "EL" . $row_result["Feedback_ID"] . "S" . $row_result['sentbidder'];
        }

        if ($row_result["Course"] == 2) {
            $Course = "Post Graduation Courses";
        }
        if ($row_result["Course"] == 3) {
            $Course = "Graduation Courses";
        }
        if ($row_result["Course"] == 4) {
            $Course = "Other Courses";
        }
        if ($row_result["Course"] == "") {
            $Course = "";
        }

        if ($row_result["Employment_Status"] == 1) {
            $Employment_Status = "Salaried";
        }
        if ($row_result["Employment_Status"] == 2) {
            $Employment_Status = "Self Employed";
        }
        if ($row_result["Employment_Status"] == 3) {
            $Employment_Status = "Not Earning";
        }
        if ($row_result["Employment_Status"] == 0) {
            $Employment_Status = "";
        }

        if ($row_result["Country"] == 1) {
            $Country = "India";
        }
        if ($row_result["Country"] == 2) {
            $Country = "UK";
        }
        if ($row_result["Country"] == 3) {
            $Country = "USA";
        }
        if ($row_result["Country"] == 4) {
            $Country = "Other Country";
        }
        if ($row_result["Country"] == 0) {
            $Country = "";
        }

        if ($row_result["Residence_City"] == "Others" && strlen($row_result["Residence_City_Other"]) > 0) {
            $City = $row_result["Residence_City_Other"];
        } else {
            $City = $row_result["Residence_City"];
        }

        $qry1 = "insert into temp (session_id, name, email, city, city_other, mobile_number, emp_status, loan_amount, dob, doe,is_processed) values ('" . $session_id . "', '" . $row_result["Name"] . "', '" . $row_result["Email"] . "', '" . $City . "', '" . $row_result["Residence_City_Other"] . "', '" . $row_result["Mobile_Number"] . "', '" . $Employment_Status . "', '" . $row_result["Loan_Amount"] . "', '" . $Course . "', '" . $row_result["Allocation_Date"] . "','" . $Country . "')";
        $result1 = ExecQuery($qry1);
    }
}

if ($qry2 == "Req_Loan_Personal") {
    $keyFBidders = '';
    $bidderSql = "select Bidders_List.BidderID as BidderID from Bidders_List left join Bidders on Bidders.BidderID= Bidders_List.BidderID and Bidders_List.Reply_Type=1 and Bidders_List.Restrict_Bidder=1 and Bidders_List.BankID=17 where (Bidders_List.Reply_Type=1 and Bidders_List.Restrict_Bidder=1 and Bidders_List.BankID=17 and Bidders.Define_PrePost='PostPaid')";

    $bidderQuery = ExecQuery($bidderSql);
    $numbidder = mysql_num_rows($bidderQuery);
    $arrBidderID = '';
    for ($i = 0; $i < $numbidder; $i++) {
        $BidID = mysql_result($bidderQuery, $i, 'BidderID');
        $arrBidderID[] = $BidID;
    }

    //print_r($arrBidderID);
    $keyFBidders = array_search($BidderIDstatic, $arrBidderID);
    if (strlen($keyFBidders) > 0) {
        $qry = "select unique_id AS ReferenceID, name, dob, email, mobile_number, emp_status, c_name, city, city_other, pincode, cc_holder, net_salary, residential_status, loan_any, emi_paid,is_processed AS EMI_Amt, loan_amount, Feedback, card_vintage, card_limit, ip_address,Documents AS AvailableDocuments, apt_dt as AppointmentTime, docs as DocsforAppointment, address_apt as AppointmentAddress, add_comment AS Comments,doe, current_age as ExclusiveLead  from temp where session_id='" . $session_id . "' order by doe DESC ";
    } else if ($BidderIDstatic == 996 || $BidderIDstatic == 997 || $BidderIDstatic == 998 || $BidderIDstatic == 1000 || $BidderIDstatic == 1012 || $BidderIDstatic == 1015 || $BidderIDstatic == 1037 || $BidderIDstatic == 1050) {
        $qry = "select unique_id AS ReferenceID, name, dob, email, mobile_number,emp_status, c_name AS CompName, year_in_comp AS CurrentExp, total_exp AS TotalExp, address_apt AS SalryDrawn, city AS City, city_other, pincode, residential_status AS ResiStat, cc_holder, net_salary, loan_any, emi_paid, is_processed AS EMI_Amt, loan_amount, Feedback, card_vintage, card_limit,  ip_address,bank_name AS PrimaryAcc , Documents AS AvailableDocuments,add_comment,doe,count_views AS HdfcEligibility, count_replies AS citiEligibility, is_modified AS BarclaysEligibility,referred_page AS AgntName, current_age as ExclusiveLead, car_make AS BTBank, car_model AS BTLoanAmt, car_type AS BTROI from temp where session_id='" . $session_id . "' order by doe DESC ";
    } elseif ($BidderIDstatic == 1023 || $BidderIDstatic == 2679) {
        $qry = "select unique_id AS ReferenceID, name, dob, email, mobile_number,emp_status, c_name AS CompName, year_in_comp AS CurrentExp, total_exp AS TotalExp, address_apt AS SalryDrawn, city AS City, city_other, pincode, residential_status AS ResiStat, cc_holder, net_salary, loan_any, emi_paid, is_processed AS EMI_Amt, loan_amount, Feedback, card_vintage, card_limit,  ip_address,bank_name AS PrimaryAcc , Documents AS AvailableDocuments,add_comment,doe,referred_page AS AgntName, current_age as ExclusiveLead, car_make AS BTBank, car_model AS BTLoanAmt, car_type AS BTROI, already_download AS BidderID,count_views AS Cluster, count_replies AS state, is_modified AS region from temp where session_id='" . $session_id . "' order by doe DESC ";
    } else if ($BidderIDstatic == 1728) {
        $qry = "select unique_id AS ReferenceID, name, dob, email, mobile_number, emp_status, c_name, city, city_other, pincode, cc_holder, net_salary, loan_any, emi_paid,is_processed AS EMI_Amt, loan_amount, Feedback, card_vintage, card_limit, ip_address,Documents AS AvailableDocuments,add_comment,residence_address AS LowestRateFrmOtherBank, doe , current_age as ExclusiveLead, car_make AS BTBank, car_model AS BTLoanAmt, car_type AS BTROI from temp where session_id='" . $session_id . "' order by doe DESC ";
    } else if ($BidderIDstatic == 2501) {
        $qry = "select unique_id AS ReferenceID, name AS Name, dob AS DOB, email AS Email, mobile_number AS MobileNo, emp_status AS Occupation, c_name AS CompanyName, year_in_comp AS CurrentExp, total_exp AS TotalExp, city AS City, city_other AS OtherCity, pincode AS Pincode, cc_holder AS CardHolder, bank_name AS PrimaryAcc,net_salary AS AnnualIncome, loan_any AS LoanRunning, emi_paid AS EMIPaid,is_processed AS EMIAmt, loan_amount AS LoanAmount, Feedback, card_vintage AS CardVintage, card_limit AS CardLimit, ip_address,Documents AS AvailableDocuments,account_no AS Comments,add_comment AS D4lComment,doe,property_type AS CompanyType, residence_address AS AgentName, current_age as ExclusiveLead, car_make AS BTBank, car_model AS BTLoanAmt, car_type AS BTROI, residential_status AS ResidentialStatus   from temp where session_id='" . $session_id . "' order by doe DESC ";
    } else if ($BidderIDstatic == 2454) {
        $qry = "select unique_id AS ReferenceID, name AS Name, dob AS DOB, emp_status AS Occupation, c_name AS CompanyName, year_in_comp AS CurrentExp, total_exp AS TotalExp, city AS City, city_other AS OtherCity, pincode AS Pincode, cc_holder AS CardHolder, bank_name AS PrimaryAcc,net_salary AS AnnualIncome, loan_any AS LoanRunning, emi_paid AS EMIPaid,is_processed AS EMIAmt, loan_amount AS LoanAmount, Feedback, card_vintage AS CardVintage, card_limit AS CardLimit, ip_address,Documents AS AvailableDocuments,account_no AS Comments,add_comment AS D4lComment,doe,property_type AS CompanyType, residence_address AS AgentName, current_age as ExclusiveLead, car_make AS BTBank, car_model AS BTLoanAmt, car_type AS BTROI, residential_status AS ResidentialStatus   from temp where session_id='" . $session_id . "' order by doe DESC ";
    }
    
    else if ($BidderIDstatic == 2896) {
        $qry = "select unique_id AS ReferenceID, name AS Name, dob AS DOB, email AS Email, mobile_number AS MobileNo, emp_status AS Occupation, c_name AS CompanyName, city AS City, city_other AS OtherCity, pincode AS Pincode, cc_holder AS CardHolder, bank_name AS PrimaryAcc,net_salary AS AnnualIncome, loan_any AS LoanRunning, emi_paid AS EMIPaid,is_processed AS EMIAmt, loan_amount AS LoanAmount, Feedback, card_vintage AS CardVintage, card_limit AS CardLimit, ip_address,Documents AS AvailableDocuments,account_no AS Comments,add_comment AS D4lComment,doe,property_type AS CompanyType, referred_page AS CompanyCategory, current_age as ExclusiveLead, car_make AS BTBank, car_model AS BTLoanAmt, car_type AS BTROI  from temp where session_id='" . $session_id . "' order by doe DESC ";
    } else if ($BidderIDstatic == 2997) {
        $qry = "select unique_id AS ReferenceID, name AS Name, dob AS DOB, email AS Email, mobile_number AS MobileNo, emp_status AS Occupation, c_name AS CompanyName, city AS City, city_other AS OtherCity, pincode AS Pincode, cc_holder AS CardHolder, bank_name AS PrimaryAcc,net_salary AS AnnualIncome, residential_status AS ResidentType, loan_any AS LoanRunning, emi_paid AS EMIPaid,is_processed AS EMIAmt, loan_amount AS LoanAmount, Feedback, card_vintage AS CardVintage, card_limit AS CardLimit, ip_address,Documents AS AvailableDocuments,account_no AS Comments,add_comment AS D4lComment,doe,property_type AS CompanyType, no_of_banks AS FollowUpDate, vehicle_owned as Zone,residence_address AS ASMType, current_age as ExclusiveLead, car_make AS BTBank, car_model AS BTLoanAmt, car_type AS BTROI, std_code_o AS ResidencePincode, landline_o AS ResidenceAddress, total_exp AS TotalExp, pancard AS Pancard from temp where session_id='" . $session_id . "' order by doe DESC ";
    } else if ($BidderIDstatic == 5356) {
        $qry = "select unique_id AS ReferenceID, name AS Name, dob AS DOB, email AS Email, mobile_number AS MobileNo, emp_status AS Occupation, c_name AS CompanyName, city AS City, city_other AS OtherCity, pincode AS Pincode, cc_holder AS CardHolder, bank_name AS PrimaryAcc,net_salary AS AnnualIncome, residential_status AS ResidentType, loan_any AS LoanRunning, emi_paid AS EMIPaid,is_processed AS EMIAmt, loan_amount AS LoanAmount, Feedback, card_vintage AS CardVintage, card_limit AS CardLimit, ip_address,Documents AS AvailableDocuments,account_no AS Comments,add_comment AS D4lComment,doe,property_type AS CompanyType, vehicle_owned as Zone,residence_address AS ASMType, current_age as ExclusiveLead, car_make AS BTBank, car_model AS BTLoanAmt, car_type AS BTROI from temp where session_id='" . $session_id . "' order by doe DESC ";
    } else if ($BidderIDstatic == 2998 || $BidderIDstatic == 2999 || $BidderIDstatic == 3000 || $BidderIDstatic == 3001 || $BidderIDstatic == 3002 || $BidderIDstatic == 3003 || $BidderIDstatic == 3004 || $BidderIDstatic == 3005 || $BidderIDstatic == 3006 || $BidderIDstatic == 3007 || $BidderIDstatic == 3008 || $BidderIDstatic == 3009 || $BidderIDstatic == 3010 || $BidderIDstatic == 3011 || $BidderIDstatic == 3012 || $BidderIDstatic == 3013 || $BidderIDstatic == 3014 || $BidderIDstatic == 3015 || $BidderIDstatic == 3801 || $BidderIDstatic == 3654 || $BidderIDstatic == 3890 || $BidderIDstatic == 3889 || $BidderIDstatic == 4407 || $BidderIDstatic == 4837 || $BidderIDstatic == 4846 || $BidderIDstatic == 5203 || $BidderIDstatic == 4592 || $BidderIDstatic == 5356 || $BidderIDstatic == 5920) {
        $qry = "select unique_id AS ReferenceID, name AS Name, dob AS DOB, email AS Email, mobile_number AS MobileNo, emp_status AS Occupation, c_name AS CompanyName, city AS City, city_other AS OtherCity, pincode AS Pincode, cc_holder AS CardHolder, bank_name AS PrimaryAcc,net_salary AS AnnualIncome, residential_status AS ResidentType, loan_any AS LoanRunning, emi_paid AS EMIPaid,is_processed AS EMIAmt, loan_amount AS LoanAmount, Feedback, card_vintage AS CardVintage, card_limit AS CardLimit, ip_address,Documents AS AvailableDocuments,account_no AS Comments,add_comment AS D4lComment,doe,property_type AS CompanyType, no_of_banks AS FollowUpDate, vehicle_owned as Zone,residence_address AS ASMType, current_age as ExclusiveLead, car_make AS BTBank, car_model AS BTLoanAmt, car_type AS BTROI from temp where session_id='" . $session_id . "' order by doe DESC ";
    } else if ($BidderIDstatic == 2920 || $BidderIDstatic == 3199 || $BidderIDstatic == 2962 || $BidderIDstatic == 3945 || $BidderIDstatic == 4127 || $BidderIDstatic == 3380 || $BidderIDstatic == 3133 || $BidderIDstatic == 3381 || $BidderIDstatic == 3451 || $BidderIDstatic == 3407 || $BidderIDstatic == 4032 || $BidderIDstatic == 4293 || $BidderIDstatic == 4300 || $BidderIDstatic == 4301 || $BidderIDstatic == 3868 || $BidderIDstatic == 2984 || $BidderIDstatic == 3532 || $BidderIDstatic == 3533 || $BidderIDstatic == 4242 || $BidderIDstatic == 4292 || $BidderIDstatic == 4299 || $BidderIDstatic == 3061 || $BidderIDstatic == 3198 || $BidderIDstatic == 3554 || $BidderIDstatic == 3196 || $BidderIDstatic == 4156 || $BidderIDstatic == 3553 || $BidderIDstatic == 4126 || $BidderIDstatic == 3944 || $BidderIDstatic == 3197 || $BidderIDstatic == 2995 || $BidderIDstatic == 3132 || $BidderIDstatic == 2917 || $BidderIDstatic == 5356) {
        $qry = "select unique_id AS ReferenceID, name AS Name, dob AS DOB, email AS Email, mobile_number AS MobileNo, emp_status AS Occupation, c_name AS CompanyName,docs as BidderCity, city AS City, city_other AS OtherCity, pincode AS Pincode, cc_holder AS CardHolder, bank_name AS PrimaryAcc,net_salary AS AnnualIncome,plan_interested AS AnnualTurnover, loan_any AS LoanRunning, emi_paid AS EMIPaid,is_processed AS EMIAmt, loan_amount AS LoanAmount, Feedback, card_vintage AS CardVintage, card_limit AS CardLimit, ip_address,Documents AS AvailableDocuments,account_no AS Comments,add_comment AS D4lComment,doe,property_type AS CompanyType, current_age as ExclusiveLead, car_make AS BTBank, car_model AS BTLoanAmt, car_type AS BTROI from temp where session_id='" . $session_id . "' order by doe DESC ";
    } elseif ($BidderIDstatic == 4505 || $BidderIDstatic == 5202) {
        $qry = "select unique_id AS ReferenceID, request_id AS UniqueID, name AS Name, email AS Email, mobile_number AS MobileNo, emp_status AS Occupation, c_name AS CompanyName, city AS City, city_other AS OtherCity, pincode AS Pincode, cc_holder AS CardHolder, bank_name AS PrimaryAcc,net_salary AS AnnualIncome,plan_interested AS AnnualTurnover, loan_any AS LoanRunning, emi_paid AS EMIPaid,is_processed AS EMIAmt, loan_amount AS LoanAmount, Feedback, card_vintage AS CardVintage, card_limit AS CardLimit, ip_address,Documents AS AvailableDocuments,account_no AS Comments,add_comment AS D4lComment,doe,property_type AS CompanyType, current_age as ExclusiveLead, car_make AS BTBank, car_model AS BTLoanAmt, car_type AS BTROI from temp where session_id='" . $session_id . "' order by doe DESC ";
    } elseif ($BidderIDstatic == 5957) {
        $qry = "select unique_id AS ReferenceID, name AS Name, dob AS DOB, email AS Email, mobile_number AS MobileNo, emp_status AS Occupation, c_name AS CompanyName, city AS City, city_other AS OtherCity, pincode AS Pincode, cc_holder AS CardHolder, bank_name AS PrimaryAcc,net_salary AS AnnualIncome, residential_status, plan_interested AS AnnualTurnover, loan_any AS LoanRunning, emi_paid AS EMIPaid, loan_amount AS LoanAmount, Feedback, card_vintage AS CardVintage,  ip_address AS IPaddress,Documents AS AvailableDocuments,account_no AS Comments,add_comment AS D4lComment,doe,property_type AS CompanyType, current_age as ExclusiveLead, car_make AS BTBank, car_model AS BTLoanAmt, car_type AS BTROI,budget AS EligibleLoanAmt,is_processed AS CFL_PF,card_limit AS CFL_ROI from temp where session_id='" . $session_id . "' order by doe DESC ";
    } elseif ($BidderIDstatic == 2663 || $BidderIDstatic == 6279 || $BidderIDstatic == 6387 || $BidderIDstatic == 7180) {
        $qry = "select unique_id AS ReferenceID, name AS Name, dob AS DOB, email AS Email, mobile_number AS MobileNo, emp_status AS Occupation, c_name AS CompanyName, city AS City, city_other AS OtherCity, pincode AS Pincode, cc_holder AS CardHolder, bank_name AS PrimaryAcc,net_salary AS AnnualIncome, residential_status, plan_interested AS AnnualTurnover, loan_any AS LoanRunning, emi_paid AS EMIPaid,is_processed AS EMIAmt, loan_amount AS LoanAmount, Feedback, card_vintage AS CardVintage, card_limit AS CardLimit, ip_address,Documents AS AvailableDocuments,account_no AS Comments,add_comment AS D4lComment,doe,property_type AS CompanyType, current_age as ExclusiveLead, residence_address AS TCName,car_make AS BTBank, car_model AS BTLoanAmt, car_type AS BTROI, budget AS SMName  from temp where session_id='" . $session_id . "' order by doe DESC ";
    }  elseif($BidderIDstatic == 7236) {
     $qry = "select unique_id AS ReferenceID, name AS CustomerName, city AS City, residence_address AS AROName,doe,c_name AS CompanyName, bank_name AS SalaryAccount, loan_amount AS LoanAmount, Feedback, account_no AS Remarks, no_of_banks AS Followup_Date from temp where session_id='" . $session_id . "' order by doe DESC ";   
    }elseif ($BidderIDstatic == 5264) {
        $qry = "select unique_id AS ReferenceID, name AS Name, dob AS DOB, email AS Email, mobile_number AS MobileNo, emp_status AS Occupation, c_name AS CompanyName, city AS City, city_other AS OtherCity, pincode AS Pincode, cc_holder AS CardHolder, bank_name AS PrimaryAcc,net_salary AS AnnualIncome, residential_status, plan_interested AS AnnualTurnover, loan_any AS LoanRunning, emi_paid AS EMIPaid,is_processed AS EMIAmt, loan_amount AS LoanAmount, Feedback, card_vintage AS CardVintage, card_limit AS CardLimit, ip_address,Documents AS AvailableDocuments,account_no AS Comments,add_comment AS D4lComment,doe,property_type AS CompanyType, current_age as ExclusiveLead, residence_address AS TCName,car_make AS BTBank, car_model AS BTLoanAmt, car_type AS BTROI, budget AS SMName, request_id AS Leadid  from temp where session_id='" . $session_id . "' order by doe DESC ";
    } elseif ($BidderIDstatic == 5648 || $BidderIDstatic == 5649 || $BidderIDstatic == 5650 || $BidderIDstatic == 5654 || $BidderIDstatic == 5373 || $BidderIDstatic == 6116 || $BidderIDstatic == 6117 || $BidderIDstatic == 7479 || $BidderIDstatic == 7480) {
        //echo $qry="select name AS Name, dob AS DOB, email AS Email, emp_status AS EmploymentStatus, c_name AS CompanyName, city AS City, city_other AS OtherCity, year_in_comp AS CurrentExperience, total_exp AS TotalExperience, mobile_number AS MobileNo, net_salary AS AnnualIncome, residential_status AS ResiStat, loan_any AS LoanRunning, emi_paid AS EMIpaid, cc_holder AS CCholder, loan_amount AS LoanAmont, Feedback, is_processed AS EMIAmt, pincode AS pincode, doe AS DOE, card_vintage AS CardVintage, card_limit,ip_address,add_comment  AS Comments, bank_name AS BankName,property_type AS CompanyType,address_apt AS SalaryDrawn, current_age AS Annualturnover,  car_make AS ExclusiveLead, car_model AS ExistingBank, car_type AS ExistingLoan, account_no AS ExistingROI , Documents AS sm_name, residence_address AS sm_email, referred_page AS sm_mobile_no, vehicle_owned AS sma_name2, plan_interested AS group_name, docs AS rsm_name, request_id AS zsm_name from temp where session_id='".$session_id."' order by doe DESC";

        $qry = "select unique_id AS ReferenceID, name AS Name, dob AS DOB, email AS Email, mobile_number AS MobileNo, emp_status AS EmploymentStatus, c_name AS CompanyName, city AS City, city_other AS OtherCity, year_in_comp AS CurrentExperience, total_exp AS TotalExperience, net_salary AS AnnualIncome, bank_name AS PrimaryAccount, residential_status AS ResiStat, loan_any AS LoanRunning, emi_paid AS EMIpaid, is_processed AS EMIAmt, cc_holder AS CCholder, card_vintage AS CardVintage, card_limit AS CardLimit, loan_amount AS LoanAmont, doe AS DOE,  property_type AS CompanyType, current_age AS ExclusiveLead, Feedback AS FeedBack, add_comment  AS Comments, car_make AS ExistingBank, car_model AS ExistingLoan, car_type AS ExistingROI, Documents AS SMName, vehicle_owned AS ASMName, docs AS RSMName, request_id AS ZSMName, query_type AS AROName from temp where session_id='" . $session_id . "' order by doe DESC";
    } elseif($BidderIDstatic == 4093)
        {
        $qry = "select unique_id AS ReferenceID, name AS Name, dob AS DOB, email AS Email, mobile_number AS MobileNo, emp_status AS Occupation, c_name AS CompanyName, city AS City, city_other AS OtherCity, pincode AS Pincode, cc_holder AS CardHolder, bank_name AS PrimaryAcc,net_salary AS AnnualIncome, residential_status, plan_interested AS AnnualTurnover, loan_any AS LoanRunning, emi_paid AS EMIPaid,is_processed AS EMIAmt, loan_amount AS LoanAmount, Feedback, card_vintage AS CardVintage, card_limit AS CardLimit, ip_address,Documents AS AvailableDocuments,account_no AS Comments,add_comment AS D4lComment,doe,property_type AS CompanyType, current_age as ExclusiveLead, car_make AS BTBank, car_model AS BTLoanAmt, car_type AS BTROI, residence_address AS CallerName, budget AS SMName from temp where session_id='" . $session_id . "' order by doe DESC ";
    }elseif($BidderIDstatic == 2680) {
       $qry = "select unique_id AS ReferenceID, name AS Name, dob AS DOB, email AS Email, mobile_number AS MobileNo, emp_status AS Occupation, c_name AS CompanyName, city AS City, city_other AS OtherCity, pincode AS Pincode, cc_holder AS CardHolder, bank_name AS PrimaryAcc,net_salary AS AnnualIncome, residential_status, plan_interested AS AnnualTurnover, loan_any AS LoanRunning, emi_paid AS EMIPaid,is_processed AS EMIAmt, loan_amount AS LoanAmount,apt_dt AS BankResponseAPI, Feedback, card_vintage AS CardVintage, card_limit AS CardLimit, ip_address,Documents AS AvailableDocuments,account_no AS Comments,add_comment AS D4lComment,doe,property_type AS CompanyType, current_age as ExclusiveLead, car_make AS BTBank, car_model AS BTLoanAmt, car_type AS BTROI from temp where session_id='" . $session_id . "' order by doe DESC "; 
    }elseif($BidderIDstatic == 6976) {
       $qry = "select unique_id AS ReferenceID,loan_time AS AgentID, name AS Name, mobile_number AS MobileNo, c_name AS CompanyName, city AS City, city_other AS OtherCity, net_salary AS AnnualIncome, loan_amount AS LoanAmount, loan_any AS LoanRunning, add_comment AS D4lComment, Feedback,  doe from temp where session_id='" . $session_id . "' order by doe DESC "; 
    }
    else if($BidderIDstatic == 7239){
        $qry = "select unique_id AS ReferenceID, bidderid AS BidderID, name AS Name, dob AS DOB, email AS Email, emp_status AS Occupation, c_name AS CompanyName, city AS City, city_other AS OtherCity, pincode AS Pincode, cc_holder AS CardHolder, bank_name AS PrimaryAcc,net_salary AS AnnualIncome, residential_status, plan_interested AS AnnualTurnover, loan_any AS LoanRunning, emi_paid AS EMIPaid,is_processed AS EMIAmt, loan_amount AS LoanAmount, Feedback, card_vintage AS CardVintage, card_limit AS CardLimit, ip_address,Documents AS AvailableDocuments,account_no AS Comments,add_comment AS D4lComment,doe,property_type AS CompanyType, current_age as ExclusiveLead, car_make AS BTBank, car_model AS BTLoanAmt, car_type AS BTROI, no_of_banks AS FOllowupDate from temp where session_id='" . $session_id . "' order by doe DESC ";
    }
    else {
        $qry = "select unique_id AS ReferenceID, name AS Name, dob AS DOB, email AS Email, mobile_number AS MobileNo, emp_status AS Occupation, c_name AS CompanyName, city AS City, city_other AS OtherCity, pincode AS Pincode, cc_holder AS CardHolder, bank_name AS PrimaryAcc,net_salary AS AnnualIncome, residential_status, plan_interested AS AnnualTurnover, loan_any AS LoanRunning, emi_paid AS EMIPaid,is_processed AS EMIAmt, loan_amount AS LoanAmount, Feedback, card_vintage AS CardVintage, card_limit AS CardLimit, ip_address,Documents AS AvailableDocuments,account_no AS Comments,add_comment AS D4lComment,doe,property_type AS CompanyType, current_age as ExclusiveLead, car_make AS BTBank, car_model AS BTLoanAmt, car_type AS BTROI from temp where session_id='" . $session_id . "' order by doe DESC ";
    }
}

if ($qry2 == "Req_Loan_Home") {
    if ($BidderIDstatic == 1329) {
        $qry = "select unique_id AS ReferenceID, docs AS ReqID,name, dob, email, mobile_number, emp_status, c_name, city, city_other, pincode, net_salary, descr, loan_amount, Feedback, property_identified, property_loc,property_value AS PropertyValue, budget, residence_address, loan_time, doe, add_comment, current_age as ExclusiveLead from temp where session_id='" . $session_id . "' order by doe DESC";
    } else if ($BidderIDstatic == 1727 || $BidderIDstatic == 1779 || $BidderIDstatic == 2118 || $BidderIDstatic == 2119 || $BidderIDstatic == 2120 || $BidderIDstatic == 2121 || $BidderIDstatic == 2122 || $BidderIDstatic == 2123 || $BidderIDstatic == 2124) {
        $qry = "select unique_id AS ReferenceID, name AS CUSTOMER_NAME, total_exp AS PRODUCT,city AS CITY, residence_address AS CONTACT_ADDRESS, mobile_number AS MOBILE_NO, email AS EMAIL_ID, bank_name AS LEAD_GENERATION_MODE, emp_status AS PROFESSION, add_comment AS REMARKS,loan_amount AS ESTIMATED_LOAN_AMOUNT, descr AS REMARKS,gender AS BTfromBank,marital_status AS BTROI, residential_status AS BTloanamt, current_age as ExclusiveLead from temp where session_id='" . $session_id . "' order by doe DESC";
    } else if ($BidderIDstatic == 1583 || $BidderIDstatic == 1584) {
        $qry = "select  unique_id AS ReferenceID, name AS Name, dob AS DOB, email AS EmailID, mobile_number AS MobileNo, emp_status AS Occupation, c_name AS CompanyName, city AS City, city_other AS OtherCity, pincode AS Pincode, net_salary AS NetSslary, descr AS PropertyType, loan_amount AS LoanAmt, Feedback, property_identified AS PropertyIdentified, property_loc AS PropertyLoc, property_value AS PropertyValue, residence_address AS ResiAddress, loan_time AS LoanTime, doe AS DateOfEntry, add_comment AS Comments, employer AS ExecutiveName ,gender AS BTfromBank,marital_status AS BTROI, residential_status AS BTloanamt, current_age as ExclusiveLead from temp where session_id='" . $session_id . "' order by doe DESC";
    } else if ($BidderIDstatic == 3603) {
        $qry = "select unique_id AS ReferenceID, name, dob, email, mobile_number, emp_status, c_name AS CompanyName, city, city_other, pincode, net_salary, descr, loan_amount, Feedback, property_identified, property_loc,property_value AS PropertyValue, budget, residence_address, loan_time, doe, add_comment ,gender AS BTfromBank,marital_status AS BTROI, residential_status AS BTloanamt, current_age as ExclusiveLead,'2' as Version, account_no AS ConUniqRefCode from temp where session_id='" . $session_id . "' order by doe DESC";
    } else if ($BidderIDstatic == 5752 || $BidderIDstatic == 5753 || $BidderIDstatic == 5754 || $BidderIDstatic == 5755 || $BidderIDstatic == 5756 || $BidderIDstatic == 5757 || $BidderIDstatic == 5758 || $BidderIDstatic == 5759 || $BidderIDstatic == 5760 || $BidderIDstatic == 5761 || $BidderIDstatic == 5762 || $BidderIDstatic == 5763 || $BidderIDstatic == 5764 || $BidderIDstatic == 5765 || $BidderIDstatic == 5766 || $BidderIDstatic == 5767 || $BidderIDstatic == 5768 || $BidderIDstatic == 5769 || $BidderIDstatic == 5770 || $BidderIDstatic == 5771 || $BidderIDstatic == 5772 || $BidderIDstatic == 5773 || $BidderIDstatic == 5774 || $BidderIDstatic == 5775 || $BidderIDstatic == 5776 || $BidderIDstatic == 5777 || $BidderIDstatic == 5778 || $BidderIDstatic == 5779 || $BidderIDstatic == 5780 || $BidderIDstatic == 5781 || $BidderIDstatic == 5782 || $BidderIDstatic == 5783 || $BidderIDstatic == 5784 || $BidderIDstatic == 5785 || $BidderIDstatic == 5786 || $BidderIDstatic == 5787 || $BidderIDstatic == 5788) {
        $qry = "select  unique_id AS ReferenceID, name, dob, email, mobile_number, emp_status, c_name AS CompanyName, city, city_other, pincode, net_salary, descr, loan_amount, Feedback, property_identified, property_loc,property_value AS PropertyValue, budget, residence_address, loan_time, doe, add_comment ,gender AS BTfromBank,marital_status AS BTROI, residential_status AS BTloanamt, current_age as ExclusiveLead,account_no AS ConUniqRefCode  from temp where session_id='" . $session_id . "' order by doe DESC";
    } elseif ($BidderIDstatic == 6095) {
        $qry = "select  unique_id AS ReferenceID, name, dob, email, mobile_number, emp_status, c_name AS CompanyName, city, city_other, pincode, net_salary, descr, loan_amount, Feedback, property_identified, property_loc,property_value AS PropertyValue, budget, residence_address, loan_time, doe, add_comment ,gender AS BTfromBank,marital_status AS BTROI, residential_status AS BTloanamt, current_age as ExclusiveLead, employer AS Employeename  from temp where session_id='" . $session_id . "' order by doe DESC";
    } elseif ($BidderIDstatic == 5500) {
        $qry = "select  unique_id AS ReferenceID, name, dob, email, mobile_number, emp_status, c_name AS CompanyName, city, city_other, pincode, net_salary, descr, loan_amount, Feedback, property_identified, property_loc,property_value AS PropertyValue, budget, residence_address, loan_time, doe, add_comment ,gender AS BTfromBank,marital_status AS BTROI, residential_status AS BTloanamt, current_age as ExclusiveLead , request_id as Leadid from temp where session_id='" . $session_id . "' order by doe DESC";
    } elseif ($BidderIDstatic == 6319) {
        $qry = "select unique_id  AS ReferenceID, name AS Name, dob, email, emp_status AS occupation, city, city_other, pincode, mobile_number AS MobileNo, net_salary AS AnnualIncome, descr AS comment, loan_amount AS LoanAMouont, Feedback, property_identified AS PropertyIdentified, property_loc AS PropertyLoc, doe, add_comment AS CallerComments, docs AS callertype, property_value AS PropertyValue, bank_name as AsmName, employer AS AsmFeedback, c_name AS CompanyName, loan_time AS BTfromBank , marital_status AS BTROI, residential_status AS BTloanamt, current_age as ExclusiveLead, account_no, contact_time, car_type As telecaller, logout_date AS FollowUpDate, changeapp_time AS ASMAllocationDate, login_date AS LastDated, car_make AS R_CurrentStatus, car_model AS R_TeleCaller_Status, property_type AS R_ASMCode, constitution AS TCComments, Documents AS ASMcomments, year_in_comp AS R_ASMName, std_code AS R_ASM_Status, landline AS R_LOSNO, std_code_o AS R_EntryDate, landline_o AS R_LastUpdatedDate,request_id AS LeadID from temp where session_id='" . $session_id . "' order by doe DESC";
    } elseif ($BidderIDstatic == 6356) {
        $qry = "select  unique_id AS ReferenceID, name, dob, email, mobile_number, emp_status, c_name AS CompanyName, city, city_other, pincode, net_salary, descr, loan_amount, Feedback, contact_time AS FollowUpDate, property_identified, property_loc,property_value AS PropertyValue, budget, residence_address, loan_time, doe, add_comment ,gender AS BTfromBank,marital_status AS BTROI, residential_status AS BTloanamt, current_age as ExclusiveLead, constitution as Caller  from temp where session_id='" . $session_id . "' order by doe DESC";
    }
	elseif($BidderIDstatic == 6717 || $BidderIDstatic == 7348) {
       $qry = "select  unique_id AS ReferenceID, name, dob, email, mobile_number, emp_status, c_name AS CompanyName, city, city_other, pincode, net_salary, descr, loan_amount, source, car_make AS Referrer, Feedback, logout_date AS FollowUpDate, property_identified, property_loc,property_value AS PropertyValue, budget, residence_address, loan_time, doe, add_comment ,gender AS BTfromBank,marital_status AS BTROI, residential_status AS BTloanamt, current_age as ExclusiveLead, request_id AS Agentid, bidderid AS Managerid, contact_time AS ReassignAgentid, docs AS selectedBank, bank_name AS LastUpdatedDate  from temp where session_id='" . $session_id . "' order by doe DESC";
    }
	else {
        $qry = "select  unique_id AS ReferenceID, name, dob, email, mobile_number, emp_status, c_name AS CompanyName, city, city_other, pincode, net_salary, descr, loan_amount, Feedback, contact_time AS FollowUpDate, property_identified, property_loc,property_value AS PropertyValue, budget, residence_address, loan_time, doe, add_comment ,gender AS BTfromBank,marital_status AS BTROI, residential_status AS BTloanamt, current_age as ExclusiveLead  from temp where session_id='" . $session_id . "' order by doe DESC";
    }
}
if ($qry2 == "Req_Credit_Card") {
    if ($BidderIDstatic == 904 || $BidderIDstatic == 903) {
        $qry = "select  unique_id AS ReferenceID, name, dob, email, emp_status, c_name, city, city_other,residence_address,property_value As OfficeAddress, mobile_number, net_salary, descr,  cc_holder, Feedback, pancard, property_type As PancardNumber, no_of_banks, card_vintage, doe, add_comment, current_age as ExclusiveLead from temp where session_id='" . $session_id . "' order by doe DESC";
    } else if ($BidderIDstatic == 2009) {
        $qry = "select  unique_id AS ReferenceID,name, dob, email, emp_status AS Occupation, c_name AS CompanyName, city AS City, city_other AS OtherCity, mobile_number AS Mobile, std_code AS StdCode, landline AS Landline,net_salary AS AnnualIncome, cc_holder AS CardHolder,descr AS CardOpted, Feedback,doe AS DateOfEntry, bank_name AS ExistRelation, employer AS AccountNo, current_age as ExclusiveLead from temp where session_id='" . $session_id . "' order by doe DESC";
    } else if ($BidderIDstatic == 2370) {
        $qry = "select  unique_id AS ReferenceID,name as FirstName, dob as MiddleName, email as LastName, no_of_banks as Mobile, property_type as NetSalary,  emp_status as DOB, c_name as Gender, city as Qualification, city_other as Email, mobile_number as EmpStatus, net_salary as CompnayName, descr as City,Feedback as OtherCity, pancard as Address,std_code_o as Pincode, add_comment as NoOfBanks, employer Designation ,bank_name as Pancard, cc_holder as ExistingCustomer, std_code, landline, changeapp_time as Feedback, apt_dt as CommentSection, loan_tenure as ExistingRelationship, address_apt as CCHolder, doe as DateofEntry, current_age as ExclusiveLead from temp where session_id='" . $session_id . "' order by doe DESC";
    } else if ($BidderIDstatic == 3190 || $BidderIDstatic == 3179 || $BidderIDstatic == 3183 || $BidderIDstatic == 3184 || $BidderIDstatic == 3185 || $BidderIDstatic == 3186 || $BidderIDstatic == 3188 || $BidderIDstatic == 3187 || $BidderIDstatic == 3189 || $BidderIDstatic == 3491 || $BidderIDstatic == 3492 || $BidderIDstatic == 3493 || $BidderIDstatic == 3494 || $BidderIDstatic == 3495 || $BidderIDstatic == 3478 || $BidderIDstatic == 3479 || $BidderIDstatic == 3480 || $BidderIDstatic == 3481 || $BidderIDstatic == 3501 || $BidderIDstatic == 3502 || $BidderIDstatic == 3662 || $BidderIDstatic == 3663 || $BidderIDstatic == 3664 || $BidderIDstatic == 3665 || $BidderIDstatic == 3666 || $BidderIDstatic == 3667 || $BidderIDstatic == 3821 || $BidderIDstatic == 3822 || $BidderIDstatic == 3823 || $BidderIDstatic == 3820) {
        $qry = "select  unique_id AS ReferenceID,name AS Name, dob AS DOB, email AS Email, emp_status AS Occupation, c_name AS CompanyName, city AS City, city_other AS CityOther, mobile_number AS MobileNo, std_code AS StdCode, landline AS Landline, net_salary AS AnnualIncome, cc_holder AS CardHolder, Feedback, apt_dt AS LeadStatus , pancard AS Pancard, property_type As PancardNumber, no_of_banks AS AlredyCardHolderOfBank, account_no AS CardVintage, address_apt as CreditLimit, doe, add_comment AS Comments, employer AS AccountNo,Card_Limit AS CardName, bank_name AS ExistingRelation, marital_status AS SalaryAcc, residence_address AS ResiAddress, current_age as ExclusiveLead from temp where session_id='" . $session_id . "' order by doe DESC";
    } elseif ($BidderIDstatic == 3838) {
        $qry = "select  unique_id AS ReferenceID,name AS Name, dob AS DOB, email AS Email, emp_status AS Occupation, c_name AS CompanyName, city AS City, city_other AS CityOther, mobile_number AS MobileNo, std_code AS StdCode, landline AS Landline, net_salary AS AnnualIncome, cc_holder AS CardHolder, Feedback, pancard AS Pancard, property_type As PancardNumber, no_of_banks AS AlredyCardHolderOfBank, card_vintage AS CardVintage, doe, add_comment AS Comments, Card_Limit AS AppliedCardName,residence_address AS Amexstat, current_age as ExclusiveLead  from temp where session_id='" . $session_id . "' order by doe DESC";
    } elseif ($BidderIDstatic == 5633) {
        $qry = "select  unique_id AS ReferenceID,name AS Name, dob AS DOB, email AS Email, emp_status AS Occupation, c_name AS CompanyName, city AS City, city_other AS CityOther, mobile_number AS MobileNo, std_code AS StdCode, landline AS Landline, net_salary AS AnnualIncome, cc_holder AS CardHolder, Feedback, pancard AS Pancard, property_type As PancardNumber, no_of_banks AS AlredyCardHolderOfBank, card_vintage AS CardVintage, doe, add_comment AS Comments, employer AS AccountNo, current_age as ExclusiveLead,  	residence_address AS ResidenceAddress , changeapp_time AS FollowUpDate, marital_status As LMSID,car_make AS ApplicationNo, car_model AS StatusCode, car_type AS Message, residential_status AS Finalstatus from temp where session_id='" . $session_id . "' order by doe DESC";
    } elseif ($BidderIDstatic == 5737) {
        $qry = "select  unique_id AS ReferenceID,name AS Name, dob AS DOB, email AS Email, emp_status AS Occupation, c_name AS CompanyName, city AS City, city_other AS CityOther, mobile_number AS MobileNo, std_code AS StdCode, landline AS Landline, net_salary AS AnnualIncome, cc_holder AS CardHolder, Feedback, no_of_banks AS AlredyCardHolderOfBank, card_vintage AS CardVintage, doe, add_comment AS Comments, current_age as ExclusiveLead,changeapp_time AS FollowUpDate from temp where session_id='" . $session_id . "' order by doe DESC";
    } elseif ($BidderIDstatic == 6251) {
        $qry = "select doe AS TranDt, descr AS Channel, is_valid AS 'Site-Classification', bank_name AS externalOfferCode, is_valid AS externalreferencesite, unique_id AS Ref_ID, is_valid AS Ref_ID2, no_of_dependents AS 'Relationship Type', name AS Name, dob AS DOB, city AS Residence_City, Gender AS Gender, mobile_number AS Mobile, email AS Email_Id, landline AS Home_Phone, landline_o AS Office_Phone, is_valid AS Extension, constitution AS doorno, is_valid AS buildingnumname, is_valid AS floor, residential_status AS streetname, residence_address AS Residential_Address, vehicle_owned AS Residential_Area, address_apt AS landmark, pincode AS Residence_pin_code, plan_interested AS offi_doorno, is_valid AS offibuildingnumname, is_valid AS offifloor, year_in_comp AS offistreetname, total_bill AS Office_Address, total_exp AS Office_Area, employer AS offilandmark, count_replies AS Office_City, count_views AS Office_Pin_Code,  referred_page AS Mail_Address1, current_age AS Education, emp_status AS PROFESSION, is_modified AS Designation, pancard AS no_Pan_no,  is_valid AS  Suvidha_AC,  is_valid AS  Card_No, is_valid AS JPMembershipNo, is_valid AS FCCmembershipno, is_valid AS 'Form id', is_valid AS tataAIG, is_valid AS 'Relation ship', source AS Agency_Code, net_salary AS Annual_Income, add_comment AS Campaign_Code, Card_Limit AS CARDNAME_1, is_valid AS Country_Id, request_id AS Creative, is_valid AS Credit_Limit, c_name AS FIRM, std_code_o AS Office_Std_Code, is_valid AS Other_Bank_Name,  is_valid AS Product_Code, is_valid AS Relation_1, is_valid AS Section, source AS Site, is_valid AS Source_Id, std_code AS STD_Code, is_valid AS Title, is_valid AS vehiclemake, already_download AS DND, budget AS Nationality, is_valid AS refnumber, is_valid AS Other_Bank_Name1, is_valid AS Other_Bank_Name2, is_valid AS Other_Bank_Name3, is_valid AS tb1, is_valid AS tb2, is_valid AS tb3, is_valid AS card1, is_valid AS card2, is_valid AS cardlimit1, is_valid AS cardlimit2, is_processed AS auth, is_valid AS suvStanding, apt_dt AS statement_on_email, is_valid AS Category, is_valid AS tnc, is_valid AS promocode, is_valid AS DUE, is_valid AS LeadStatus, is_valid AS RejectRemarks, is_valid AS director, is_valid AS directorName, is_valid AS relationship from temp where session_id='" . $session_id . "' order by doe DESC";
    } else {
        $qry = "select  unique_id AS ReferenceID,name AS Name, dob AS DOB, email AS Email, emp_status AS Occupation, c_name AS CompanyName, city AS City, city_other AS CityOther, mobile_number AS MobileNo, std_code AS StdCode, landline AS Landline, net_salary AS AnnualIncome, cc_holder AS CardHolder, Feedback, pancard AS Pancard, property_type As PancardNumber, no_of_banks AS AlredyCardHolderOfBank, card_vintage AS CardVintage, doe, add_comment AS Comments, employer AS AccountNo, current_age as ExclusiveLead,	residence_address AS ResidenceAddress , changeapp_time AS FollowUpDate from temp where session_id='" . $session_id . "' order by doe DESC";
    }
}

if ($qry2 == "Req_Loan_Against_Property") {
    if ($BidderIDstatic == 2245) {
        $qry = "select unique_id AS ReferenceID,request_id AS RequestID, name, dob, email, mobile_number, emp_status, c_name, city, city_other, net_salary, residential_status, pincode, descr, property_type, property_value, loan_amount, Feedback, doe, add_comment from temp where session_id='" . $session_id . "' order by doe DESC";
    } else {
        $qry = "select unique_id AS ReferenceID,name, dob, email, mobile_number, emp_status, c_name, city, city_other, net_salary, residential_status, pincode, descr, property_type, property_value, loan_amount, Feedback, doe, add_comment,current_age AS LeadType from temp where session_id='" . $session_id . "' order by doe DESC";
    }
}

if ($qry2 == "Req_Loan_Car") {
    if ($BidderIDstatic == 1825) {
        $qry = "select  unique_id AS ReferenceID,name AS FirstName, property_value AS Lastname, dob AS DOB, email AS Email, emp_status AS Occupation, c_name AS CompanyName, city AS City, city_other AS OtherCity, mobile_number AS MobileNo, net_salary AS AnnualIncome, car_make AS CarMake, car_model AS CarModel, is_processed AS CarType ,loan_amount AS LoanAmount, pincode AS Pincode, Feedback, doe AS DateOfEntry, add_comment AS Comment, descr AS CarBooked,pancard AS AccountNo,referred_page AS SpecialPreference,loan_tenure AS ExistingRelation, apt_dt As ApptDate, changeapp_time As ApptTime,  address_apt AS ApptAddress, constitution as Reward, docs AS DeliveryDate from temp where session_id='" . $session_id . "' order by doe DESC";
    } else if ($BidderIDstatic == 3336 || $BidderIDstatic == 3337 || $BidderIDstatic == 3338 || $BidderIDstatic == 3339 || $BidderIDstatic == 3340 || $BidderIDstatic == 3341 || $BidderIDstatic == 3342 || $BidderIDstatic == 3343 || $BidderIDstatic == 3345) {
        $qry = "select  unique_id AS ReferenceID,name AS FirstName, property_value AS Lastname, dob AS DOB, email AS Email, emp_status AS Occupation, c_name AS CompanyName, city AS City, city_other AS OtherCity, mobile_number AS MobileNo, net_salary AS AnnualIncome, car_make AS CarMake, car_model CarModel, is_processed AS CarType ,loan_amount AS LoanAmount, pincode AS Pincode, Feedback, doe AS DateOfEntry, add_comment AS Comment, descr AS CarBooked,pancard AS AccountNo,referred_page AS SpecialPreference,loan_tenure AS ExistingRelation, apt_dt As ApptDate, changeapp_time As ApptTime,  address_apt AS ApptAddress,docs AS DeliveryDate,bank_name as Pancard, budget as OfficeAddress, product_type as ResidenceAddress from temp where session_id='" . $session_id . "' order by doe DESC";
    } elseif ($BidderIDstatic == 3886 || $BidderIDstatic == 3887 || $BidderIDstatic == 3888) {
        $qry = "select unique_id AS ReferenceID,doe AS Date_Flag,name AS FirstName, property_value AS Lastname, loan_amount AS Loan_Value, net_salary AS Annual_Income, mobile_number AS Individual_Mob_Ph, email AS Email, landline AS Residence_Landline_No, pincode AS Pincode, city AS Pref_Location from temp where session_id='" . $session_id . "' order by doe DESC";
    } else {
        $qry = "select  unique_id AS ReferenceID,name AS Name, dob AS DOB, email AS Email, emp_status AS Occupation, c_name AS CompanyName, city AS City, city_other AS OtherCity, mobile_number AS MobileNo, net_salary AS AnnualIncome, car_make, car_model, is_processed AS CarType ,loan_amount, pincode, Feedback, contact_time, doe, add_comment, docs AS deliveryDate, car_type AS CarBooked from temp where session_id='" . $session_id . "' order by doe DESC";
    }
}

if ($qry2 == "Req_Loan_Bike") {
    $qry = "select  unique_id AS ReferenceID,name AS Name, dob AS DOB, email AS Email, emp_status AS Occupation, c_name AS CompanyName, city AS City, city_other AS OtherCity, mobile_number AS MobileNo, net_salary AS AnnualIncome, car_model as BikeModel, loan_amount as LoanAmount, Feedback, doe, add_comment from temp where session_id='" . $session_id . "' order by doe DESC";
}

if ($qry2 == "Req_Business_Loan") {
    $qry = "select  unique_id AS ReferenceID,name, email, city, city_other, mobile_number, net_salary, industry, constitution, year_of_establishment, loan_amount, pincode, doe AS DateOfEntry,cc_holder  As creditcardholder, no_of_banks, loan_any, emi_paid , annual_income,residential_status,marital_status As OfficeStatus from temp where session_id='" . $session_id . "' order by doe DESC";
}
if ($qry2 == "Req_Loan_Gold") {
    //$qry = "select  unique_id AS ReferenceID,name AS Name, email AS Email, dob AS DOB, city AS City, city_other AS OtherCity, mobile_number AS MobileNo, net_salary AS AnnualIncome, loan_amount AS LoanAmount, doe AS DateOfEntry from temp where session_id='" . $session_id . "' order by doe DESC";
    $qry = "select name AS FullName, mobile_number AS MobileNo, city AS City from temp where session_id='" . $session_id . "' order by doe DESC";
}
if ($qry2 == "Req_Loan_Education") {
    $qry = "select name AS Name, email AS Email, mobile_number AS Mobile_No, city AS City, is_processed AS Country_of_Interest, dob AS Course_of_Interest, loan_amount AS Require_Education_Loan, emp_status AS Income_Status, doe AS DateOfEntry from temp where session_id='" . $session_id . "' order by doe DESC";
}

//Written by Dan Zarrella. Some additional tweaks provided by JP Honeywell
//pear excel package has support for fonts and formulas etc.. more complicated
//this is good for quick table dumps (deliverables)
$header = "";
$data = "";
$result = ExecQuery($qry);
//echo "fff".$qry."<br>";
$num_rows = mysql_num_rows($result);
$CountInsertSql = "insert into BidderDownloadCount (BidderID, BidderName, BidderProduct, BidderTable, BidderSession, NoofRecords, Dated, MinDate, MaxDate) values ('" . $BidderIDstatic . "', '" . $_SESSION['UName'] . "', '" . $_SESSION['ReplyType'] . "', '" . $qry2 . "', '" . $session_id . "',  '" . $num_rows . "', Now(), '" . $mindate . "', '" . $maxdate . "') ";
$CountInsertQuery = ExecQuery($CountInsertSql);

$count = mysql_num_fields($result);

for ($i = 0; $i < $count; $i++) {
    $header .= mysql_field_name($result, $i) . "\t";
}

while ($row = mysql_fetch_row($result)) {
    $line = '';
    foreach ($row as $value) {
        if (!isset($value) || $value == "") {
            $value = '"' . $value . '"' . "\t";
        } else {
            # important to escape any quotes to preserve them in the data.
            $value = str_replace('"', '""', $value);
            # needed to encapsulate data in quotes because some data might be multi line.
            # the good news is that numbers remain numbers in Excel even though quoted.
            $value = '"' . $value . '"' . "\t";
        }
        $line .= $value;
    }
    $data .= trim($line) . "\n";
}
# this line is needed because returns embedded in the data have "\r"
# and this looks like a "box character" in Excel
$data = str_replace("\r", "", $data);

# Nice to let someone know that the search came up empty.
# Otherwise only the column name headers will be output to Excel.
if ($data == "") {
    $data = "\nno matching records found\n";
}

# This line will stream the file to the user rather than spray it across the screen
header("Content-type: application/octet-stream");
# replace excelfile.xls with whatever you want the filename to default to
header("Content-Disposition: attachment; filename=data.xls");
header("Pragma: no-cache");
header("Expires: 0");
echo $header . "\n" . $data;
//Delete data from the temp table
$qry1 = "delete from `temp` where session_id='" . $session_id . "'";
$result1 = ExecQuery($qry1);
?>
