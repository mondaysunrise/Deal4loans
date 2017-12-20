<?php
require_once("includes/application-top-inner.php");
$requestid = $_REQUEST["postid"];
$bidderid = $_REQUEST["biddt"];
$process = $_REQUEST["process"];
$feedback_tble = "lead_allocate";

$followup_date = "";
if ($_REQUEST['products'] == 1) {
    $qry = "SELECT * FROM sbi_ccoffers_directonsite LEFT JOIN Req_Loan_Bike ON sbi_ccoffers_directonsite.sbicc_requestid=Req_Loan_Bike.RequestID WHERE RequestID=$requestid";
} else if ($_REQUEST['products'] == 2) {
    $qry = "SELECT * FROM Req_Credit_Card_Sms LEFT OUTER JOIN lead_allocate ON lead_allocate.AllRequestID=Req_Credit_Card_Sms.RequestID WHERE (lead_allocate.BidderID  in (" . $bidderid . ") AND RequestID=$requestid) ";
} else if ($_REQUEST['products'] == 3) {
    $qry = "SELECT *, " . $feedback_tble . ".BidderID as BidID  FROM " . $feedback_tble . "," . TABLE_REQ_CREDIT_CARD . " LEFT OUTER JOIN Req_Feedback_CC ON Req_Feedback_CC.AllRequestID=" . TABLE_REQ_CREDIT_CARD . ".RequestID AND Req_Feedback_CC.BidderID in (" . $bidderid . ") WHERE " . $feedback_tble . ".AllRequestID=" . TABLE_REQ_CREDIT_CARD . ".RequestID and " . $feedback_tble . ".BidderID in (" . $bidderid . ") and " . $feedback_tble . ".Reply_Type=4 AND RequestID=$requestid";
}
$result = $obj->fun_db_query($qry);
$resCount = $objAdmin->fun_get_num_rows($qry);
$ccrow = $obj->fun_db_fetch_rs_object($result);
$applied_card_name = $ccrow->applied_card_name;
$Name = $ccrow->Name;
$Gender = $ccrow->Gender;
$Landline = $ccrow->Landline;
$Std_Code = $ccrow->Std_Code;
$NetSalaried = $ccrow->Net_Salary;
$City = $ccrow->City;
if ($ccrow->Employment_Status == 0) {
    $emp_status = "Self Employed";
} else {
    $emp_status = "Salaried";
}
$OffiAddress = $ccrow->Office_Address;
$stroffiadd = round((strlen($OffiAddress) / 3));
$offiadd = str_split($OffiAddress, $stroffiadd);
$OfficeAddress1 = $offiadd[0];
$OfficeAddress2 = $offiadd[1];
$OfficeAddress3 = $offiadd[2];

$stroffiadd = round((strlen($OffiAddress) / 3));
$offiadd = str_split($OffiAddress, $stroffiadd);
$OfficeAddress1 = $offiadd[0];
$OfficeAddress2 = $offiadd[1];
$OfficeAddress3 = $offiadd[2];
$dob = date("d M Y",strtotime($ccrow->DOB));
list($year, $mm, $dd) = split("[-]", $ccrow->DOB);
$Residence_Address = $ccrow->Residence_Address;
$Residence_Address = str_ireplace('|', '', $Residence_Address);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Credit Card</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <style type="text/css">
            <!--
            .style2 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold;}
            .style21 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size:12px;}
            -->
        </style>
    </head>
    <body>
        <table cellpadding="0" cellspacing="0" align="center">
            <tr><td>
                    <table style='border:1px dotted #9C9A9C;' cellspacing="0" cellpadding="5" width="700" height="80%" align="center" border="1" >
                        <tr><td colspan="4" align="center" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold; height:25px;">Credit Card customer details</td></tr>
                        <tr>
                            <td width="180"><span class="style2">Customer Name: </span></td>
                            <td width="392" colspan="3"><span class="style21"><? echo $Name; ?></span></td></tr>
                        <tr>
                            <td><span class="style2"> DOB: </span></td>
                            <td><span class="style21"> <?php echo $dob; ?></span></td>
                            <td><span class="style2"> Gender: </span></td>
                            <td><span class="style21"><? if ($Gender != "-1") echo $Gender; ?></span></td>
                        </tr>    

                        <tr><td colspan="2"><span class="style2">do you hold any card?</span></td>
                            <td colspan="2"><?php
                                    if ($ccrow->CC_Holder == 1) {
                                        echo "Yes";
                                    }
?>
            <?php
                                if ($ccrow->CC_Holder == 2) {
                                    echo "No";
                                }
                                ?>
                            </td>
                        </tr>

                        <tr><td><span class="style2">Salary</span></td>
                            <td><?php echo $NetSalaried; ?> 
                            </td>
                            <td><span class="style2">City</span></td>
                            <td><?php echo $City; ?>                        </td>
                        </tr>
                        <tr><td><span class="style2">Emp Status</span></td>
                            <td><? echo $emp_status; ?>                        </td>
                        </tr>


                        <tr>
                            <td colspan="4" align="center" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold; height:25px;">Residence details</td></tr>
                        <tr>
                            <td><span class="style2"> Resi Address: </span></td>
                            <td colspan="3"><span class="style21" ><? echo $Residence_Address; ?></span></td>
                        </tr>

                        <tr>
                            <td colspan="4" align="center" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold; height:25px;">Professional details</td></tr>


                        <tr>
                            <td><span class="style2"> Office Address: </span></td>
                            <td colspan="3"><span class="style21" ><? echo $OfficeAddress1; ?>&nbsp;<? echo $OfficeAddress2; ?><br /><br /><? echo $OfficeAddress3; ?>&nbsp;<? echo $OfficeAddress4; ?>
                                </span></td>
                        </tr>
                        <tr>
                            <td colspan="4" align="center" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold; height:25px;">Feedback details</td></tr>
                        <tr>
                            <td><span class="style2">LMS Comments: </span></td>
                            <td><span class="style21"><? echo $ccrow->comment_section; ?></span></td>

                            <td><span class="style2">LMS feedback </span></td>
                            <td><span class="style21"><?php echo $ccrow->Feedback; ?></span></td>
                        </tr>	
                        <tr>
                            <td class="fontstyle"><b>Follow Up Date</b></td>
                            <td class="fontstyle"><?php if ($ccrow -> Followup_Date != '0000-00-00 00:00:00') { ?><?php echo $ccrow -> Followup_Date; ?> <?php } ?></td>
                            <td width="180"><span class="style2">Date of entry: </span></td>
                            <td width="392"><span class="style21"><? echo $ccrow->Updated_Date; ?></span></td>
                        </tr>
<?php
                        $quryResData = "SELECT * FROM credit_card_banks_apply WHERE cc_requestid ='" . $requestid . "' and cc_requestid>0 and applied_bankname='ICICI Bank' GROUP BY cc_requestid";
                        $resultResData = $obj->fun_db_query($quryResData);
                        $rowResData = $obj->fun_db_fetch_rs_object($resultResData);
                        $appliedBankname = $rowResData->applied_bankname;
                        //Json FOrmat
                        $ResponseData = $rowResData->response_data;
                        $JSonRes = json_decode($ResponseData);
                        $ApplicationId = $JSonRes->ApplicationId;
                        $Decision = $JSonRes->Decision;
                        if($appliedBankname!=''){
                        ?>
                        <tr>
                            <td colspan="4" align="center" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold; height:25px;">ICICI MIS Detail's</td></tr>
                        
                        <tr>
                            <td class="fontstyle"><b>Bank Name(ICICI)</b></td>
                            <td class="fontstyle"><?php echo $appliedBankname; ?></td>
                            <td width="180"><span class="style2">Application ID: </span></td>
                            <td width="392"><span class="style21"><? echo $ApplicationId; ?></span></td>

                        </tr>
                        <tr>
                            <td width="180"><span class="style2">Decision Status: </span></td>
                            <td width="392"><span class="style21"><? echo $Decision; ?></span></td>

                        </tr> 
                        <?php }?>
                        <?php
                        $RBLquryResData = "SELECT * FROM credit_card_banks_apply WHERE cc_requestid ='" . $requestid . "' and cc_requestid>0 and applied_bankname='RBL Bank' GROUP BY cc_requestid";
                        $RBLresultResData = $obj->fun_db_query($RBLquryResData);
                        $RBLrowResData = $obj->fun_db_fetch_rs_object($RBLresultResData);
                        $RBLappliedBankname = $RBLrowResData->applied_bankname;
                        //Json FOrmat
                        $RBLResponseData = $RBLrowResData->response_data;
                        $RBLJSonResSeprate = explode(",", $RBLResponseData);
                        $RBLReFcodeArr = $RBLJSonResSeprate[1];
                        $RBLRefVal = explode("-#", $RBLReFcodeArr);
                        $RBLRefValPrint = $RBLRefVal[1];

                        //for Decision Status
                        $RBLDeciArr = $RBLJSonResSeprate[3];
                        $RBLDeciVal = explode("-", $RBLDeciArr);
                        $RBLDeciValPrint = $RBLDeciVal[1];

                        if ($RBLappliedBankname != '') {
                            ?>
                            <tr>
                                <td colspan="4" align="center" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold; height:25px;">RBL MIS Detail's</td></tr>


                            <tr>
                                <td class="fontstyle"><b>Bank Name(RBL)</b></td>
                                <td class="fontstyle"><?php echo $RBLappliedBankname; ?></td>
                                <td width="180"><span class="style2">Application ID: </span></td>
                                <td width="392"><span class="style21"><? echo $RBLRefValPrint; ?></span></td>

                            </tr>
                            <tr>
                                <td width="180"><span class="style2">Decision Status: </span></td>
                                <td width="392"><span class="style21"><? echo $RBLDeciValPrint; ?></span></td>

                            </tr> 
                        <?php }?>
                            <?php
                            //Standard Charted
                            $StancquryResData = "SELECT * FROM credit_card_banks_apply WHERE cc_requestid ='" . $requestid . "' and cc_requestid>0 and applied_bankname='Standard Chartered' GROUP BY cc_requestid";
                            $StancresultResData = $obj->fun_db_query($StancquryResData);
                            $StancrowResData = $obj->fun_db_fetch_rs_object($StancresultResData);
                            $StancappliedBankname = $StancrowResData->applied_bankname;
                            //echo "<pre>";
                            //print_r($rowResData);
                            //Json FOrmat
                            $StancResponseData = $StancrowResData->response_data;
                            $StancJSonRes = json_decode($StancResponseData);                                     //print_r($JSonRes);

                            $StancRespData = $StancrowResData->response_data;


                            $StancJSonResSeprate = explode(",", $StancRespData);
                            //print_r($JSonResSeprate);
                            $StancReFcodeArr = $StancJSonResSeprate[1];
                            $StancRefVal = explode("-#", $StancReFcodeArr);
                            //print_r($ReFcodeArr);
                            $StancRefValPrint = $StancRefVal[1];

                            //for Decision Status
                            $StancDeciArr = $StancJSonResSeprate[3];
                            $StancDeciVal = explode("-", $StancDeciArr);
                            $StancDeciValPrint = $StancDeciVal[1];
                            if ($StancappliedBankname != "") {
                                ?>

                                <tr>
                                    <td colspan="4" align="center" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold; height:25px;">Standard Chartered MIS Detail's</td></tr>


                                <tr>
                                    <td class="fontstyle"><b>Bank Name(Standard Chartered)</b></td>
                                    <td class="fontstyle"><?php echo $StancappliedBankname; ?></td>
                                    <td width="180"><span class="style2">Application ID: </span></td>
                                    <td width="392"><span class="style21"><? echo $StancRefValPrint; ?></span></td>

                                </tr>
                                <tr>
                                    <td width="180"><span class="style2">Decision Status: </span></td>
                                    <td width="392"><span class="style21"><? echo $StancDeciValPrint; ?></span></td>

                                </tr> 
    <?php } ?>
                            <?php
                            // American Express 
                            $resCountAmex = "";
                            $AmexquryResData = "SELECT * FROM credit_card_banks_apply WHERE cc_requestid ='" . $row->AllRequestID . "' and cc_requestid>0 and applied_bankname='American Express' GROUP BY cc_requestid";
                            $AmexresultResData = $obj->fun_db_query($AmexquryResData);
                            $resCountAmex = $objAdmin->fun_get_num_rows($AmexquryResData);
                            if ($resCountAmex > 0) {
                                $AmexrowResData = $obj->fun_db_fetch_rs_object($AmexresultResData);

                                $AmexappliedBankname = $AmexrowResData->applied_bankname;
                                $outputAmex = $AmexrowResData->response_data;
                                $ArrxmlAmex = "";
                                $outputAmex = str_replace('<?xml version="1.0" encoding="utf-8"?><soap:Envelope xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema"><soap:Body><submitApplicationResponse xmlns="http://tempuri.org/">', '', $outputAmex);
                                $outputAmex = str_replace('</submitApplicationResponse></soap:Body></soap:Envelope>', '', $outputAmex);
                                $ArrxmlAmex = new SimpleXMLElement($outputAmex);
                            }
                            if ($resCountAmex > 0) {
                                ?> 

                                <tr>
                                    <td colspan="4" align="center" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold; height:25px;">Amex MIS Detail's</td></tr>

                                <tr>
                                    <td class="fontstyle"><b>Bank Name(Amex)</b></td>
                                    <td class="fontstyle"><?php if ($resCountAmex > 0) {
                            echo $AmexappliedBankname;
                        }
                        ?></td>
                                    <td width="180"><span class="style2">Application ID: </span></td>
                                    <td width="392"><span class="style21"><?php
                        if ($resCountAmex > 0) {
                            //echo "<pre>";
                            //print_r($ArrxmlAmex);

                            echo $successRespons = $ArrxmlAmex->successResponse->approved;
                        }
                                ?></span></td>
                                </tr>
                                <tr>
                                    <td width="180"><span class="style2">Decision Status: </span></td>
                                    <td width="392"><span class="style21"><?php
                                            if ($resCountAmex > 0) {
                                                echo $Status = $ArrxmlAmex->status->success;
                                            }
                                            ?></span></td>

                                </tr> 
    <?php } ?>


                    </table>
                </td></tr>
            
        </table>
    </body>
</html>