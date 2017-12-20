<?php

session_start();
require 'scripts/db_init.php';
require 'scripts/functions_nw.php';

function getReqemailValue($pKey) {
    $titles = array(
    '1891' => 'Animesh.Mukherjee@hdfcbank.com,neha.gupta@deal4loans.com',
    '1959' => 'nilesh.mahadik@hdfcbank.com',
    '1960' => 'nilesh.mahadik@hdfcbank.com',
    '1957' => 'Shani.Jaiswal@hdfcbank.com,rakhi.bhadoria@deal4loans.com,neha.gupta@deal4loans.com',
    '4648' => 'Amit.Kumar67@hdfcbank.com',
    '4931' => 'Shashi.kumar2@hdfcbank.com',
    '4936' => 'Deep.Verma@hdfcbank.com',
    '5023' => 'mohdahsan.kidwai@hdfcbank.com',
    '4952' => 'Binit.Ghosh@hdfcbank.com',
    '1900' => 'AshokK.Rathi@hdfcbank.com',
    '5033' => 'Neha.Sharma2@hdfcbank.com,yadvinder.singh@hdfcbank.com,jyoti.kumari@deal4loans.com',
    '4932' => 'abhishek.choubey@hdfcbank.com',
    '4933' => 'Abhishek.KumarChhetri@hdfcbank.com',
    '4935' => 'Ajay G.Kumar@hdfcbank.com',
    '4934' => 'ajay.dhamecha@hdfcbank.com',
    '5063' => 'Raman.Nayak@hdfcbank.com,nisha.jain@deal4loans.com,neha.gupta@deal4loans.com',
    '5374' => 'jyoti.kumari@deal4loans.com',
    '4939' => 'AmitP.Rana@hdfcbank.com',
    '5024' => 'rajivu.kumar@hdfcbank.com',
    '5025' => 'suresh.rajagopalan@hdfcbank.com,jyoti.kumari@deal4loans.com',
    '4950' => 'Bhavesh.Raval@hdfcbank.com',
    '4963' => 'DineshA.Joshi@hdfcbank.com,jyoti.kumari@deal4loans.com',
    '4966' => 'ganeshs.kumar@hdfcbank.com,jyoti.kumari@deal4loans.com',
    '4977' => 'himanshu.mathur@hdfcbank.com,jyoti.kumari@deal4loans.com',
    '4990' => 'kishore.rangapure@hdfcbank.com,piyush.baghel@deal4loans.com',
    '5013' => 'Prashant.Pandey@hdfcbank.com,piyush.baghel@deal4loans.com',
    '5043' => 'sudhir.patil@hdfcbank.com,piyush.baghel@deal4loans.com',
    '5039' => 'shibuprakash.mishra@hdfcbank.com,piyush.baghel@deal4loans.com',
    '5314' => 'Shani.Jaiswal@hdfcbank.com,rakhi.bhadoria@deal4loans.com,neha.gupta@deal4loans.com',
    '5456' => 'Shani.Jaiswal@hdfcbank.com,rakhi.bhadoria@deal4loans.com,neha.gupta@deal4loans.com',
    '6044' => 'Shani.Jaiswal@hdfcbank.com,rakhi.bhadoria@deal4loans.com,neha.gupta@deal4loans.com',
    '5061' => 'Deep.Verma@hdfcbank.com',
    '5047' => 'Deep.Verma@hdfcbank.com',
    '5029' => 'Rituraj.Dutta@hdfcbank.com',
    '5016' => 'prince.john@hdfcbank.com',
    '5015' => 'Deep.Verma@hdfcbank.com',
    '5003' => 'maksud.maniyar@hdfcbank.com,jyoti.kumari@deal4loans.com',
    '4980' => 'INDRAJIT.DEB@HDFCBANK.COM',
    '4948' => 'Deep.Verma@hdfcbank.com',
    '4939' => 'AmitP.Rana@hdfcbank.com',
    '4962' => 'Deep.Verma@hdfcbank.com',
    '4937' => 'Abhijeet.Paul@hdfcbank.com',
    '5066' => 'AmitP.Sharma@hdfcbank.com',
    '4949' => 'Rana.Bahadur@hdfcbank.com,jyoti.kumari@deal4loans.com',
    '4951' => 'bhaskar.devnath@hdfcbank.com',
    '4967' => 'Deep.Verma@hdfcbank.com',
    '5508' => 'Soni-anupam.soni@hdfcbank.com',
    '4954' => 'Chandrajeet.Rawal@hdfcbank.com',
    '4960' => 'Dhananjayprakash.Tiwari@hdfcbank.com',
    '4971' => 'Hetul.Agrawal@hdfcbank.com',
    '5008' => 'nikhil.kulkarni@hdfcbank.com',
    '5064' => 'vivekk.sinha@hdfcbank.com',
    '5058' => 'Vikash.Kachhadiya@hdfcbank.com',
    '5057' => 'VipulS.Kumar@hdfcbank.com,jyoti.kumari@deal4loans.com',
    '5056' => 'Mohinder.Bisht@hdfcbank.com,jyoti.kumari@deal4loans.com',
    '5055' => 'Vijaykumar.nimmagadda@hdfcbank.com',
    '5046' => 'sunita.coutinho@hdfcbank.com',
    '5042' => 'Siraj.Garasiya1@hdfcbank.com',
    '5034' => 'Sandeepan.Hazarika@hdfcbank.com',
    '5002' => 'murali.rangu@hdfcbank.com',
    '4976' => 'himanshu.garg@hdfcbank.com',
    '4972' => 'Hemakumar.Raveendran@hdfcbank.com',
    '4970' => 'Hariom.Gurjar@hdfcbank.com',
    '4964' => 'Diwan.Singh@hdfcbank.com',
    '5006' => 'NANDANESH.HOLLA@HDFCBANK.COM',
    '5009' => 'NIKHIL.VELAPURKAR@HDFCBANK.COM',
    '5012' => 'Prakashk.patel@hdfcbank.com',
    '5028' => 'Ritesh.Thakrar@hdfcbank.com',
    '5031' => 'sachin.isapure@hdfcbank.com',
    '5038' => 'Shailendra.Chauhan@hdfcbank.com',
    '4995' => 'jyoti.kumari@deal4loans.com',
    '4946' => 'AshishK.Bansal@hdfcbank.com',
    '5791' => 'piyush.baghel@deal4loans.com',
    '1958' => 'Eknath.Sable@hdfcbank.com,rakhi.bhadoria@deal4loans.com',
    '4086' => 'meet.marriya@indusind.com,neha.gupta@deal4loans.com',
    '4092' => 'kumar.vazirani@indusind.com,neha.gupta@deal4loans.com',
    '2627' => 'Panneer.Thambdeal4loans.comusamy@hdfcbank.com,neha.gupta@deal4loans.com',
    '3036' => 'Harishkumar.R@hdfcbank.com,priyanka.sharma@deal4loans.com,neha.gupta@deal4loans.com',
    '5724' => 'Harishkumar.R@hdfcbank.com,priyanka.sharma@deal4loans.com,neha.gupta@deal4loans.com',
    '5725' => 'Harishkumar.R@hdfcbank.com,priyanka.sharma@deal4loans.com,neha.gupta@deal4loans.com',
    '6002' => 'Panneer.Thambdeal4loans.comusamy@hdfcbank.com,neha.gupta@deal4loans.com',
    '5454' => 'Eknath.Sable@hdfcbank.com,rakhi.bhadoria@deal4loans.com',
    '5315' => 'Tushar.Amtey@hdfcbank.com,rakhi.bhadoria@deal4loans.com',
    '6159' => 'Sujit.Mohapatra7@hdfcbank.com,neha.gupta@deal4loans.com',
    '6384' => 'prashant.patel2@hdfcbank.com,rakhi.bhadoria@deal4loans.com,neha.gupta@deal4loans.com',
    '5745' => 'Chetan.Trivedii@hdfcbank.com,jyoti.kumari@deal4loans.com',
    '5048' => 'Tony.Aggarwal@hdfcbank.com,jyoti.kumari@deal4loans.com',
    '5049' => 'Varun.Khajuria@hdfcbank.com,jyoti.kumari@deal4loans.com',
    '5067' => 'Jitendra Singh.Handa@hdfcbank.com,jyoti.kumari@deal4loans.com',
    '5964' => 'Neeraj.Gill@hdfcbank.com,jyoti.kumari@deal4loans.com',
    '6041' => 'Mahendra.Yadav@hdfcbank.com,jyoti.kumari@deal4loans.com',
    '6042' => 'Ashish.rachh@hdfcbank.com,pritesh.gardi@hdfcbank.com,jyoti.kumari@deal4loans.com',
    '6053' => 'raja.kumar@hdfcbank.com,jyoti.kumari@deal4loans.com',
    '6080' => 'nilabh.prasad@hdfcbank.com,jyoti.kumari@deal4loans.com',
    '6081' => 'nilabh.prasad@hdfcbank.com,jyoti.kumari@deal4loans.com',
    '6246' => 'maksud.maniyar@hdfcbank.com,jyoti.kumari@deal4loans.com',
    '6058' => 'samarjeet.kahlon@hdfc bank.com,Pradeep.singh3@hdfcbank.com,jyoti.kumari@deal4loans.com',
    '6249' => 'Abhishek.Kumar17@hdfcbank.com,jyoti.kumari@deal4loans.com',
    '5990' => 'maksud.maniyar@hdfcbank.com,jyoti.kumari@deal4loans.com',
    '6247' => 'suresh.rajagopalan@hdfcbank.com,jyoti.kumari@deal4loans.com',
    '6511' => 'Pawan.Shinde@hdfcbank.com,rakhi.bhadoria@deal4loans.com,neha.gupta@deal4loans.com',
    '6287' => 'Sarathchandra.Vakati@hdfcbank.com,priyanka.sharma@deal4loans.com,neha.gupta@deal4loans.com',
    '6288' => 'biswajit.sahoo@hdfcbank.com,priyanka.sharma@deal4loans.com,neha.gupta@deal4loans.com',
    '6413' => 'Animesh.Mukherjee@hdfcbank.com,neha.gupta@deal4loans.com',
    '5000' => 'Deep.Verma@hdfcbank.com');

    foreach ($titles as $key => $value)
        if ($pKey == $key)
            return $value;

    return "";
}

function getReqcityValue($pKey) {
    $titles = array(
        '1888' => 'Ahmedabad',
        '1891' => 'Kolkata',
        '1958' => 'Mumbai',
        '1959' => 'Navi Mumbai',
        '1960' => 'Thane',
        '1957' => 'Pune',
        '4648' => 'Chandigarh',
        '4931' => 'smallcities',
        '4936' => 'amanb',
        '4957' => 'deepeshk',
        '5023' => 'rajeshk',
        '4952' => 'binitg',
        '1900' => 'Consolidated',
        '5033' => 'Sandeep',
        '4932' => 'Abhishekchoubey',
        '4933' => 'AbhishekChhetri',
        '4935' => 'AjayKumar',
        '4934' => 'Ajaydhamecha',
        '5063' => 'Vivek',
        '5374' => 'bibekananda',
        '4939' => 'AmitPRana',
        '5024' => 'rajivukumar',
        '5025' => 'ranjithshanmugam',
        '4950' => 'BhaveshRaval',
        '4963' => 'DineshAJoshi',
        '4966' => 'ranjithshanmugam2',
        '4977' => 'himanshumathur',
        '4990' => 'kishorerangapure',
        '5001' => 'monindersingh',
        '5061' => 'VishalAnand',
        '5047' => 'SuryaGupta',
        '5029' => 'RiturajDutta',
        '5016' => 'princejohn',
        '5015' => 'PraveenVsharma',
        '5003' => 'muttayyamamadapur',
        '4980' => 'INDRAJIT',
        '4948' => 'Atharva',
        '4939' => 'AmitPRana',
        '4962' => 'DheerajKumar',
        '4937' => 'amitbose1',
        '5066' => 'AmitPSharma',
        '4943' => 'apurvvijaywargiya',
        '4949' => 'apurvvijaywargiya',
        '4951' => 'apurvvijaywargiya',
        '4967' => 'GauravAshish',
        '5508' => 'AnupamSoni',
        '4954' => 'Chandrajeetrawal',
        '4960' => 'Dhananjayprakash',
        '4971' => 'HetulAgrawal',
        '5008' => 'nikhilkulkarni',
        '5064' => 'vivekksinha',
        '5058' => 'VikashKachhadiya',
        '5057' => 'vikaschaudhary',
        '5056' => 'VijenderGuleria',
        '5055' => 'RamRuthala',
        '5046' => 'sunitacoutinho',
        '5042' => 'SirajGarasiya',
        '5034' => 'Sandeepan',
        '5002' => 'muralirangu',
        '4959' => 'muralirangu',
        '4976' => 'himanshugarg',
        '4972' => 'HemakumarRaveendran',
        '4970' => 'HariomGurjar',
        '4964' => 'DiwanSingh',
        '5006' => 'NANDANESHHOLLA',
        '5009' => 'NIKHILVELAPURKAR',
        '5012' => 'Prakashkpatel',
        '5021' => 'rageshdivakaran',
        '5028' => 'RiteshThakrar',
        '5031' => 'sachinisapure',
        '5038' => 'ShailendraChauhan',
        '4995' => 'manikandannarayanan',
        '5313' => 'Jitendrapanwar',
        '5791' => 'ShibuPrakashMishra',
        '5408' => 'Ankit',
        '1958' => 'Sadaf',
        '4086' => 'MeetMarriya',
        '5933' => 'Vikas',
        '5934' => 'Preeti',
        '5935' => 'Vandana',
        '1950' => 'Alok',
        '5382' => 'Reena Sunani'
    );
    foreach ($titles as $key => $value)
        if ($pKey == $key)
            return $value;
    return "";
}

function retrivedataforhdfc() {
    $session_id = session_id();
    $Today = date("Y-m-d");
//	$Today = "2012-01-04"; 
    $min_date = $Today . " 00:00:00";
    $max_date = $Today . " 23:59:59";
    //'5003',
    $hdfcpl = array('1888', '1891', '1958', '1959', '1960', '1957', '4648', '4931', '4936', '4957', '5023', '4952', '1900', '5033', '4932', '4933', '4935', '4934', '5063', '5374', '4939', '5024', '5025', '4950', '4963', '4966', '4977', '4990', '5001', '5314', '5061', '5047', '5029', '5016', '5015', '4980', '4948', '4939', '4962', '4937', '5066', '4943', '4949', '4951', '4967', '5508', '4954', '4960', '4971', '5008', '5064', '5058', '5057', '5056', '5055', '5046', '5042', '5034', '5002', '4959', '4976', '4972', '4970', '4964', '5006', '5009', '5012', '5021', '5028', '5031', '5038', '4995', '4946', '5791', '5313', '5408', '4086', '5933', '1950', '5382', '5934', '5935');

    for ($k = 0; $k < count($hdfcpl); $k++) {
        if ($hdfcpl[$k] == "1900") {
            $citifinquery = "SELECT Name,DOB,Email, Mobile_Number,Std_Code, Landline,Company_Name,City, City_Other,Pincode, Net_Salary, Loan_Any, Loan_Amount, IP_Address,Add_Comment,Allocation_Date, Employment_Status,EMI_Paid,CC_Holder, Card_Vintage FROM Req_Feedback_Bidder_PL,Req_Loan_Personal WHERE (Req_Feedback_Bidder_PL.AllRequestID=Req_Loan_Personal.RequestID and Req_Feedback_Bidder_PL.BidderID in (4648,5313,1891,1950) and Req_Feedback_Bidder_PL.Reply_Type=1 and Req_Feedback_Bidder_PL.Allocation_Date Between '" . ($min_date) . "' and '" . ($max_date) . "')";
        } else {
            $citifinquery = "SELECT Name,DOB,Email, Mobile_Number,Std_Code, Landline,Company_Name,City, City_Other,Pincode, Net_Salary, Loan_Any, Loan_Amount, IP_Address,Add_Comment,Allocation_Date, Employment_Status,EMI_Paid,CC_Holder, Card_Vintage FROM Req_Feedback_Bidder_PL,Req_Loan_Personal WHERE (Req_Feedback_Bidder_PL.AllRequestID=Req_Loan_Personal.RequestID and Req_Feedback_Bidder_PL.BidderID in (" . $hdfcpl[$k] . ") and Req_Feedback_Bidder_PL.Reply_Type=1 and Req_Feedback_Bidder_PL.Allocation_Date Between '" . ($min_date) . "' and '" . ($max_date) . "')";
        }
        $search_result = ExecQuery($citifinquery);
        $recordcount = mysql_num_rows($search_result);
//	echo "i m in else".$citifinquery."<br><br>";

        while ($row_result = mysql_fetch_array($search_result)) {
            if ($row_result["Employment_Status"] == 0) {
                $emp_status = "Self Employed";
            } else {
                $emp_status = "Salaried";
            }
            if ($row_result["CC_Holder"] == 1) {
                $cc_holder = "Yes";
            } if ($row_result["CC_Holder"] == 0) {
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

            $qry1 = "insert into temp (session_id, name, dob, email, mobile_number, std_code, landline, emp_status, c_name, city, city_other, pincode, cc_holder, net_salary, loan_any, emi_paid, loan_amount, card_vintage,  ip_address, add_comment,doe) values ('" . $session_id . "', '" . $row_result["Name"] . "', '" . $row_result["DOB"] . "', '" . $row_result["Email"] . "', '" . $row_result["Mobile_Number"] . "','" . $row_result["Std_Code"] . "', '" . $row_result["Landline"] . "','" . $emp_status . "','" . $row_result["Company_Name"] . "', '" . $row_result["City"] . "', '" . $row_result["City_Other"] . "','" . $row_result["Pincode"] . "','" . $cc_holder . "','" . $row_result["Net_Salary"] . "','" . $row_result["Loan_Any"] . "','" . $emi_paid . "','" . $row_result["Loan_Amount"] . "','" . $card_vintage . "','" . $row_result["IP_Address"] . "','" . $row_result["Add_Comment"] . "','" . $row_result["Allocation_Date"] . "')";
            $result1 = ExecQuery($qry1);
        }

        $emailid = getReqemailValue($hdfcpl[$k]);
        $cityname = getReqcityValue($hdfcpl[$k]);

        $qry = "select name, dob AS DOB, email AS EmailID, mobile_number AS MobileNo, std_code AS StdCode, landline AS Landline, emp_status AS Occupation, c_name AS CompanyName, city AS City, city_other AS OtherCity, pincode AS Pincode, cc_holder AS CardHolder, net_salary AS AnnualIncome, loan_any AS LoanRunning, emi_paid AS NoOfEMIPaid, loan_amount AS LoanAmt, card_vintage AS CardVintage, ip_address AS IPAddress,add_comment AS comments,doe AS DateOfEntry  from temp where session_id='" . $session_id . "' order by doe DESC ";

        //Written by Dan Zarrella. Some additional tweaks provided by JP Honeywell
        //pear excel package has support for fonts and formulas etc.. more complicated
        //this is good for quick table dumps (deliverables)
        $header = "";
        $newdata = "";
        $result = ExecQuery($qry);
        $count = mysql_num_fields($result);

        for ($i = 0; $i < $count; $i++) {
            $header .= mysql_field_name($result, $i) . "\t";
        }
        //$value = '"' . $header . '"' . "\t";
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
            $newdata .= trim($line) . "\n";
        }
        # this line is needed because returns embedded in the data have "\r"
        # and this looks like a "box character" in Excel
        $retnewdata = str_replace("\r", "", $header);
        $retnewdata .="\n";
        $retnewdata .= str_replace("\r", "", $newdata);

//echo $citifincity."hello::";
        $newToday = date('d') . "" . date('m') . "" . date('y');
//$newToday ="170810";
        // Open the file and erase the contents if any
        $newfileatt = "/home/deal4loans/public_html/hdfc/hdfcpl" . $cityname . "" . $newToday . ".xls";
        //echo "fine".$newfileatt."<br>";
        $newfile = fopen($newfileatt, 'w+');
        $dataold = fwrite($newfile, $retnewdata);
        fclose($newfile);
        if ($recordcount > 0) {
            sendexcelfileattachment($emailid, $session_id, $emailid, $cityname);
        }
    }
}

function sendexcelfileattachment($emailid, $session_id, $emailid, $cityname) {
    //$newToday ="170810";
    $newToday = date('d') . "" . date('m') . "" . date('y');
    //$to = "ranjana5chauhan@gmail.com"; 
    $to = $emailid;
    $from = "Deal4loans <no-reply@deal4loans.com>";
    $subject = "Personal Loan Leads @ deal4loans.com " . $cityname . "" . $newToday;
    $fileatt = "/home/deal4loans/public_html/hdfc/hdfcpl" . $cityname . "" . $newToday . ".xls";
    $fileatttype = "application/xls";
    $fileattname = "hdfcpl" . $cityname . "" . $newToday . ".xls";


    $file = fopen($fileatt, 'r+');
    $data = fread($file, filesize($fileatt));
    fclose($file);

    $headers = "From: $from";


    $semi_rand = md5(time());
    $mime_boundary = "==Multipart_Boundary_x{$semi_rand}x";

    $headers .= "\nMIME-Version: 1.0\n" .
            "Content-Type: multipart/mixed;\n" .
            " boundary=\"{$mime_boundary}\"" . "\n";
    $headers .= "Cc: neha.gupta@deal4loans.com,neha.gupta20n@gmail.com" . "\n";

    $message = "This is a multi-part message in MIME format.\n\n" .
            "--{$mime_boundary}\n" .
            "Content-Type: text/plain; charset=\"iso-8859-1\"\n" .
            "Content-Transfer-Encoding: 7bit\n\n" .
            $message . "\n\n";

    $data = chunk_split(base64_encode($data));

    $message .= "--{$mime_boundary}\n" .
            "Content-Type: {$fileatttype};\n" .
            " name=\"{$fileattname}\"\n" .
            "Content-Disposition: attachment;\n" .
            " filename=\"{$fileattname}\"\n" .
            "Content-Transfer-Encoding: base64\n\n" .
            $data . "\n\n" .
            "--{$mime_boundary}--\n";


    if (mail($to, $subject, $message, $headers)) {

        echo "<p>The email was sent.</p>";
    } else {

        echo "<p>There was an error sending the mail.</p>";
    }
    $qry1 = "delete from `temp` where session_id='" . $session_id . "'";
    $result1 = ExecQuery($qry1);
}

main();

function main() {
    retrivedataforhdfc();
}

?>