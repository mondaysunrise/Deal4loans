<?php
require_once("includes/application-top-inner.php");
$IP_Remote = $_SERVER["REMOTE_ADDR"];
if ($IP_Remote == '192.124.249.12' || $IP_Remote == '185.93.228.12') {
    $IP = $_SERVER['HTTP_X_SUCURI_CLIENTIP'];
} else {
    $IP = $IP_Remote;
}

//echo $IP."<br>";
if ($_FILES[csv][size] > 0) {

    // die;
    //echo "i entered<br>";
    //get the csv file 
    $file = $_FILES[csv][tmp_name];
    $handle = fopen($file, "r");
    //loop through the csv file and insert into database 
    $flag = true;
    do {
        if ($data[0]) {
if($flag) { $flag = false; continue; } // for skip first row of the CSV File
            $tomorrow = mktime(0, 0, 0, date("m"), date("d") - 30, date("Y"));
            $days30date = date('Y-m-d', $tomorrow);
            $days30datetime = $days30date . " 00:00:00";
            $currentdate = date('Y-m-d');
            $currentdatetime = date('Y-m-d') . " 23:59:59";
            $alreadyExist = 0;

            $source = "sms_pl_scb";

          $getdetails = "select RequestID From Req_Loan_Personal Where ( Mobile_Number not in (9811215138,9971396361) and Mobile_Number='" . $data[1] . "' and Updated_Date between '" . $days30datetime . "' and '" . $currentdatetime . "' and source='" . $source . "') order by RequestID DESC";
            $checkavailability = $obj->fun_db_query($getdetails);
            $alreadyExist = $obj->fun_db_get_num_rows($checkavailability);
            $row = $obj->fun_db_fetch_rs_object($checkavailability);
            $RequestID = $row->RequestID;
//echo  $getdetails."<br>";
            if ($data[0] == "Name") {
                $alreadyExist = 1;
            }
            if ($RequestID > 0) {
               
                
            } else {
                    if($data[3]=='Self Employed')
                    {
                        $EmpStatus = 0;
                    }else{
                        $EmpStatus = 1;
                    }
                    $dobarr = explode("-", $data[10]);
                    $DOB = $dobarr[2] . "-" . $dobarr[1] . "-" . $dobarr[0];
                $insertleadqry = ("INSERT INTO Req_Loan_Personal (Name, Mobile_Number,City,Employment_Status,Company_Name,Net_Salary,Loan_Amount,Loan_Any,Card_Vintage,PL_EMI_Amt,DOB,Dated,Updated_Date,IP_Address,source) VALUES 
				( 
					'" . FixString($data[0]) . "',
					'" . FixString($data[1]) . "', 
					'" . FixString($data[2]) . "', 
					'" . $EmpStatus . "',
					'" . FixString($data[4]) . "',
					'" . FixString($data[5]) . "', 
					'" . FixString($data[6]) . "', 
					'" . FixString($data[7]) . "',
					'" . FixString($data[8]) . "',
					'" . FixString($data[9]) . "', 
					'" . $DOB . "', 
					 Now(), 
                                         Now(),
					'" . $IP . "', '" . $source . "') 
			");
                  

                $insertleadqry . "<br>";
                $insertleadresult = $obj->fun_db_query($insertleadqry);

                $ProductValue = mysql_insert_id();
            }
        }
    } while ($data = fgetcsv($handle, 1000, ",", "'"));            // 
    //redirect 
    if ($insertleadresult > 0) {
        $message = 1;
        header("location:scb_data_lead_upload.php?msg=" . $message);
    } else {
        $message = 0;
    }
}
?> 
<html>
    <head>
        <meta http-equiv="Content-Language" content="en-us">
        <meta http-equiv="Content-Type" content="text/html; charset=WINDOWS-1252">
        <title>Login</title>
        <script Language="JavaScript" Type="text/javascript" src="../scripts/common.js"></script>
        <link href="../includes/style1.css" rel="stylesheet" type="text/css">
        <link href="../style.css" rel="stylesheet" type="text/css" />
        <script language="javascript" type="text/javascript" src="../scripts/datetime.js"></script>
    </head>
    <body style="margin:0px 0px 0px 0px; padding:0px 0px 0px 0px; background-color:#45B2D8;">
        <!-- End Main Banner Menu Panel --><div style="width:100%; background: #CCC; padding:0px 0px 10px 0px;"><div style="background:#F00; width:40px; padding-left:7px; line-height:30px; height:30px; float:right; margin-right:50px; margin-top:7px; border-radius:20%;"><a href="logout.php" style="color:#FFF; text-align:center; text-decoration:none; font-size:12px;">Logout</a></div>
            <div style="clear:both;"></div>
        </div>
        <br>

        <div align="center"><b>UPLOAD FOR PERSONAL LOAN SCB Data calling</b></div>
        <div style="clear:both; height:15px;"></div>

        <table align="center">
            <tr> <td colspan="2"><?php
                    if ($_REQUEST['msg'] == 1) {
                        echo "<b style=\"color:green;\">Your file has been imported.</b><br><br>";
                    } //generic success notice  
                    ?> </td></tr>
            <tr><td>
                    <form action="" method="post" enctype="multipart/form-data" name="form1" id="form1" onsubmit="return Validatebackcall();">
                        <table align="center">
                            <tr>
                                <td>Choose your file:</td>
                                <td height="50">
                                    <input name="csv" type="file" id="csv" /> </td></tr>
                            <tr>
                                <td></td>
                                <td>
                                    <input type="submit" name="Submit" value="Submit" />

                                </td>
                            </tr>
                        </table>
                    </form> 
                </td></tr>
        </table>


        <script type="text/javascript">
            var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
            document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
        </script> 
        <script type="text/javascript">
            try {
                var pageTracker = _gat._getTracker("UA-1312775-1");
                pageTracker._trackPageview();
            } catch (err) {
            }</script>
        <script type="text/javascript">
            function Validatebackcall()
            {
                var frm = document.form1;
                if (frm.csv.value == "")
                {
                    alert('Please Choose CSV file');
                    frm.csv.focus();
                    return false;
                }
            }
        </script>


    </body>
</html>