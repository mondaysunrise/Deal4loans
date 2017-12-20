<?php
require 'scripts/db_init.php';
require 'scripts/functions.php';
require 'eligiblebidderfuncPL.php';
require 'scripts/pl_interest_rate_view.php';
require 'scripts/personal_loan_eligibility_function_form.php';
require 'scripts/personal_loan_bt_eligibility.php';
require 'd4lproduct.php';

//2503122

function DetermineAgeGETDOB($YYYYMMDD_In) {
    $yIn = substr($YYYYMMDD_In, 0, 4);
    $mIn = substr($YYYYMMDD_In, 4, 2);
    $dIn = substr($YYYYMMDD_In, 6, 2);
    $ddiff = date("d") - $dIn;
    $mdiff = date("m") - $mIn;
    $ydiff = date("Y") - $yIn;
    if ($mdiff < 0) {
        $ydiff--;
    } elseif ($mdiff == 0) {
        if ($ddiff < 0) {
            $ydiff--;
        }
    } return $ydiff;
}

$id = $_REQUEST['id'];

$bank_name = "";
if (isset($_REQUEST['bank_name'])) {
    $bank_name = $_REQUEST['bank_name'];
}
$company_name = "";
if (isset($_REQUEST['company_name'])) {
    $company_name = $_REQUEST['company_name'];
}

$viewqry = "select Pancard,Name, CC_Age,Annual_Turnover, Company_Type,PL_Bank,PL_Tenure,Name,Net_Salary,Residential_Status,City,City_Other,Dated,Employment_Status,Loan_Amount, source,Loan_Any,Pincode,Emi_Paid, CC_Holder,Card_Vintage, PL_EMI_Amt,Card_Limit, Total_Experience, Years_In_Company, DOB,Primary_Acc,Existing_ROI from Req_Loan_Personal where Req_Loan_Personal.RequestID=" . $id . " ";
//echo "dd".$viewqry;
$viewlead = ExecQuery($viewqry);
$viewleadscount = mysql_num_rows($viewlead);
$Net_Salary = mysql_result($viewlead, 0, 'Net_Salary');
$Name = mysql_result($viewlead, 0, 'Name');
$City = mysql_result($viewlead, 0, 'City');
$City_Other = mysql_result($viewlead, 0, 'City_Other');
$Dated = mysql_result($viewlead, 0, 'Dated');
$Employment_Status = mysql_result($viewlead, 0, 'Employment_Status');
$Loan_Amount = mysql_result($viewlead, 0, 'Loan_Amount');
$Loan_Any = mysql_result($viewlead, 0, 'Loan_Any');
$Pincode = mysql_result($viewlead, 0, 'Pincode');
$SentEmail = mysql_result($viewlead, 0, 'SentEmail');
$Emi_Paid = mysql_result($viewlead, 0, 'Emi_Paid');
$CC_Holder = mysql_result($viewlead, 0, 'CC_Holder');
$Card_Vintage = mysql_result($viewlead, 0, 'Card_Vintage');
$PL_EMI_Amt = mysql_result($viewlead, 0, 'PL_EMI_Amt');
$Card_Limit = mysql_result($viewlead, 0, 'Card_Limit');
$Salary_Drawn = mysql_result($viewlead, 0, 'Salary_Drawn');
$Total_Experience = mysql_result($viewlead, 0, 'Total_Experience');
$Years_In_Company = mysql_result($viewlead, 0, 'Years_In_Company');
$DOB = mysql_result($viewlead, 0, 'DOB');
$PL_Tenure = mysql_result($viewlead, 0, 'PL_Tenure');
$Primary_Acc = mysql_result($viewlead, 0, 'Primary_Acc');
$Company_Type = mysql_result($viewlead, 0, 'Company_Type');
$Loan_Any = substr($Loan_Any, 0, strlen($Loan_Any) - 1);
$getDOB = DetermineAgeGETDOB($DOB);
$Annual_Turnover = mysql_result($viewlead, 0, 'Annual_Turnover');
$PL_Bank = mysql_result($viewlead, 0, 'PL_Bank');
$pancard = @mysql_result($viewlead, 0, 'Pancard');
$monthsalary = $Net_Salary / 12;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {


    if ($bank_name == "HDFC") {
        $getcompany = 'select * from wf_company_list_hdfc where ((company_name="' . $company_name . '") and status=1)';
  //    echo $getcompany."<br>";
        $getcompanyresult = ExecQuery($getcompany);
        $grow = mysql_fetch_array($getcompanyresult);
        $recordcount = mysql_num_rows($getcompanyresult);
        $hdfccategory = strtoupper($grow["hdfc"]);

	//	echo $monthsalary.", ".$PL_EMI_Amt.", ".$company_name.", ".$hdfccategory.", ".$getDOB.", ".$Company_Type.", ".$Primary_Acc;
		$getEligiblieQuotes='';
		$hdfcBankPL='';
		for($i=1;$i<=5;$i++)
		{
			$hdfcBankPL='';
			$reqtenure = $i;
	    	$hdfcBankPL = HdfcBankPL($monthsalary, $PL_EMI_Amt, $company_name, $hdfccategory, $getDOB, $Company_Type, $primaryAcc, $reqtenure, $Loan_Amount);
	    	if ($hdfcBankPL['loan_amount']>50000 && strlen($hdfcBankPL['emi'])>2 && $i==$hdfcBankPL['tenure']) { $getEligiblieQuotes[] = $hdfcBankPL; }
		}
		
        if ($hdfcgetloanamout > 1000000) {
            $hdfcprepay = "NIL";
        } else {
            $hdfcprepay = "4%";
        }
    }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
        <title>Validate Company</title>
        <script type="text/javascript" src="http://www.deal4loans.com/ajax-dynamic-wfpl.js"></script>
<script type="text/javascript" src="http://www.deal4loans.com/ajax.js"></script>
<script type="text/javascript" src="http://www.deal4loans.com/scripts/common.js"></script>
        <style type="text/css">	
            #mainContainer{	width:660px; margin:0 auto;	text-align:left; height:100%; border-left:3px double #000; border-right:3px double #000; }
            #formContent{	padding:5px;	}
            #ajax_listOfOptions{		position:absolute;	/* Never change this one */		width:520px;	/* Width of box */		height:160px;	/* Height of box */		overflow:auto;	/*Scrolling features */		border:1px solid #317082;	/* Dark green border */		background-color:#FFF;	/* White background color */    color: black;		text-align:left;	fontsize:0.9em;		z-index:100;	}
            #ajax_listOfOptions div{	/* General rule for both .optionDiv and .optionDivSelected */		margin:1px;				padding:1px;		cursor:pointer;		font-size:0.9em;	}
            #ajax_listOfOptions .optionDiv{	/* Div for each item in list */	}
            #ajax_listOfOptions .optionDivSelected{ /* Selected item in the list */		background-color:#2375CB;		color:#FFF;	}
            #ajax_listOfOptions_iframe{		background-color:#F00;		position:absolute;		z-index:5;	}
            form{		display:inline;	}
            a {	cursor:pointer; }
            .bluebutton {	font-family: Verdana, Arial, Helvetica, sans-serif;	font-size: 11px;	color: blue;	font-weight: bold;}
        </style>

    </head>
    <body style="font-family:Arial, Helvetica, sans-serif;">
        <form action="" method="post" name="check_company">
            <input type="hidden" name="id" id="id"  value="<? echo $id; ?>" />
            <table style='border:1px dotted #9C9A9C;' cellspacing="2" cellpadding="5" width="800"  align="center" border="0" >
                <tr>
                    <td style="border:1px solid black;" colspan="4" bgcolor="#DAEAF9" align="center" class="fontstyle" ><b>Check Company for <?php echo $Name; ?></b></td></tr>
                <tr>
                    <td class="fontstyle" width="150"><b> Bank Name</b></td>
                    <td class="fontstyle" width="150"><select name="bank_name">
                           <!-- <option value="">Select</option>-->
                            <option value="HDFC" <?php if ($bank_name == "HDFC") {
    echo "selected";
} ?> >HDFC Bank</option>
                         <!--   <option value="ICICI" <?php if ($bank_name == "ICICI") {
    echo "selected";
} ?>>ICICI Bank</option>-->
                        </select></td>
                </tr>
                <tr>
                    <td class="fontstyle"><b>Company Name</b></td>
                    <td class="fontstyle"><input type="text" name="company_name" id="company_name" autocomplete="false" style=" width:522px;" value="<?php echo $company_name; ?>" onkeyup="ajax_showOptions(this,'getCountriesByLetters',event, 'http://www.deal4loans.com/ajax-list-hdfccompanies.php')" /></td>
                </tr>
                <tr>
                    <td class="fontstyle"><b> </b></td>
                    <td class="fontstyle"><input type="submit" class="bluebutton" value="Submit" /></td>
                </tr>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    ?>
                    <tr>
                        <td colspan="2">
                            <table cellpadding="2" cellspacing="3" width="100%" border="1">
                              <tr> <td width="11%" height="25" align="center" valign="middle"><b style="font-size:12px;">Bank Name</b></td>
	<td width="11%" align="center"><b style="font-size:12px;">Loan Amount</b></td>
	<td width="11%" align="center"><b style="font-size:12px;">ROI</b></td>
	<td width="11%" align="center"><b style="font-size:12px;">EMI</b></td>
	<td width="11%" align="center"><b style="font-size:12px;">EMI(Per Lac)</b></td>
	<td width="11%" align="center"><b style="font-size:12px;">Company Cat</b></td>
	<!--<td width="11%" align="center"><b style="font-size:12px;">Pre. charges</b></td>-->
	<td width="11%" align="center"><b style="font-size:12px;">prco. fee</b></td>
	<td width="11%" align="center"><b style="font-size:12px;">Tenure</b></td>
	</tr>
	<?php 
	for($i=0;$i<count($getEligiblieQuotes);$i++)
{

	?>
                               <tr> 
	<td width="11%" height="25" align="center" valign="middle"><b style="font-size:12px;"><? echo $getEligiblieQuotes[$i]['bank_code']; ?></b></td>
	<td width="11%" align="center"><b style="font-size:12px;"><? echo  $getEligiblieQuotes[$i]['loan_amount']; ?></b></td>
	<td width="11%" align="center"><b style="font-size:12px;"><? echo  $getEligiblieQuotes[$i]['interest_rate']; ?></b></td>
	<td width="11%" align="center"><b style="font-size:12px;"><? echo  $getEligiblieQuotes[$i]['emi']; ?></b></td>
	<td width="11%" align="center"><b style="font-size:12px;"><? echo  $getEligiblieQuotes[$i]['emiperlac']; ?></b></td>
	<td width="11%" align="center"><b style="font-size:12px;"><? echo  $getEligiblieQuotes[$i]['category']; ?></b></td>
	<td width="11%" align="center"><b style="font-size:12px;"><? echo  $getEligiblieQuotes[$i]['processing_fee']; ?></b></td>
	<!--<td width="11%" align="center"><b style="font-size:12px;"><? //echo "0 - 4%" ?></b></td>-->
	<td width="11%" align="center"><b style="font-size:12px;"><? echo $getEligiblieQuotes[$i]['tenure']." yrs"; ?></b></td>
	</tr>
<?php } ?>

                            </table>
                        </td>
                    </tr>
    <?php
}
?>		
            </table>




        </form>
    </body>

</html>