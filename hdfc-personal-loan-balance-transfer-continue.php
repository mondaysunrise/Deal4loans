<?php
require 'scripts/functions.php';
require 'scripts/db_init.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
	$full_name = $_POST["full_name"];
	$Phone = $_POST["Phone"];
	$email_id = $_POST["email_id"];
	$City = $_POST["City"];
	$net_salary = $_POST["net_salary"];
	$exist_loan_amt = $_POST["exist_loan_amt"];
	$exist_bnk_nme = $_POST["exist_bnk_nme"];

$validMobile = is_numeric($Phone);

if($validMobile==1 && strlen($full_name)>0 && strlen($City)>0)
{

	$tomorrow  = mktime(0, 0, 0, date("m")  , date("d")-30, date("Y"));
	$days30date=date('Y-m-d',$tomorrow);
	$days30datetime = $days30date." 00:00:00";
	$currentdate= date('Y-m-d');
	$currentdatetime = date('Y-m-d')." 23:59:59";
	
	$getdetails="select hdfcbtid From hdfc_balance_transfer_leads Where ( hdfcbt_mobile not in (9971396361,9811215138,9811555306,9999570210) and hdfcbt_mobile='".$Phone."' and hdfcbt_dated between '".$days30datetime."' and '".$currentdatetime."') order by hdfcbtid DESC";
	list($alreadyExist,$myrow)=MainselectfuncNew($getdetails,$array = array());

	$Dated = ExactServerdate();		
	if($alreadyExist>0)
	{
		
	}
	else
	{
		$dataArray = array('hdfcbt_name'=>$full_name, 'hdfcbt_mobile'=>$Phone, 'hdfcbt_email'=>$email_id, 'hdfcbt_city'=>$City, 'hdfcbt_net_salary'=>$net_salary, 'hdfcbt_existibg_loan_amt'=>$exist_loan_amt, 'hdfcbt_existing_loan_bank'=>$exist_bnk_nme, 'hdfcbt_dated'=>$Dated);
		$insert = Maininsertfunc ('hdfc_balance_transfer_leads', $dataArray);
	}

}
		else
		{
			//echo "Track URI and redirect this to the same page";
			$msg = "NotAuthorised";
			$PostURL ="http://www.deal4loans.com".$_POST["PostURL"]."?msg=".$msg;
			header("Location: $PostURL");
		}
}

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>HDFC Personal Loan</title>
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
<link href="css/hdfc_pl-new.css" rel="stylesheet" type="text/css">
</head>
<body>
<table width="990" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="6" class="lftshado">&nbsp;</td>
    <td bgcolor="#FFFFFF"><table width="965"  border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td><table width="100%"  border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="77%" height="74"><img src="new-images/hdfc-pl/hdfcbank_logo.gif" width="200" height="54"></td>
            <td width="23%"><img src="new-images/hdfc-pl/deal4loans_logo.gif" width="200" height="54"></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><table  border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td valign="top"><img src="new-images/hdfc-pl/hdfcpl_bck_01.jpg" width="167" height="290"></td>
            <td ><img src="new-images/hdfc-pl/hdfcpl_bck_02.jpg" width="180" height="290"></td>
            <td ><img src="new-images/hdfc-pl/hdfcpl_bck_03.jpg" width="184" height="290"></td>
            <td valign="top"><img src="new-images/hdfc-pl/hdfcpl_bck_04.jpg" width="220" height="290"></td>
            <td valign="top"><img src="new-images/hdfc-pl/hdfcpl_bck_05.jpg" width="213" height="290"></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td height="3"></td>
      </tr>
      <tr>
        <td><table width="100%"  border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="679" align="left" valign="top"  >
			

			<table width="679"  border="0" align="left" cellpadding="0" cellspacing="0">
              <tr>
                <td width="679" valign="top" class="stepbg"><table width="655" border="0" align="right" cellpadding="0" cellspacing="0">
  <tr>
    <td height="35" align="left" valign="middle" class="stepdng">Two Steps to Know your Eligibility</td>
    </tr>
  <tr>
    <td height="65" class="steptxt" style="color:#4f4d4d; ">1. Just Fill in your Details 

      <br>
      2. Choose to Get Online Quote.</td>
    </tr>
</table>
</td>
              </tr>
              <tr>
                <td >&nbsp;</td>
              </tr>
              <tr>
        <td height="33" bgcolor="#f6f6f6" class="hdng">Features of HDFC Bank Personal Loan Balance Transfer</td>
              </tr>
              <tr>
                <td><table width="97%"  border="0" align="right" cellpadding="0" cellspacing="0">
                  <tr>
                    <td width="21"><img src="new-images/hdfc-pl/bullet.gif" width="8" height="8"></td>
                    <td width="522" height="35" class="blutxt" >Get cash loan upto 15 Lacs<br></td>
                    <td width="24"><img src="new-images/hdfc-pl/bullet.gif" width="8" height="8"></td>
                    <td width="348" class="blutxt" >Get loans for 12 to 60 months</td>
                  </tr>
                  <tr>
                    <td width="21"><img src="new-images/hdfc-pl/bullet.gif" width="8" height="8"></td>
                    <td height="35" class="blutxt" >Minimum rate of interest 14%</td>
                    <td width="24"><img src="new-images/hdfc-pl/bullet.gif" width="8" height="8"></td>
                    <td class="blutxt" >Repay in easy EMIs</td>
                  </tr>
                  <tr>
                    <td><img src="new-images/hdfc-pl/bullet.gif" width="8" height="8"></td>
                    <td height="35" class="blutxt" >No collateral requirement</td>
                    <td><img src="new-images/hdfc-pl/bullet.gif" width="8" height="8"></td>
                    <td class="blutxt" >Easy Documentation</td>
                  </tr>
				  <tr>
                    <td><img src="new-images/hdfc-pl/bullet.gif" width="8" height="8"></td>
                    <td height="35" class="blutxt" >Flat Processing fee of Rs.1000/-</td>
                    <td><img src="new-images/hdfc-pl/bullet.gif" width="8" height="8"></td>
                    <td class="blutxt" >2% lower rate on Balance Transfer</td>
                  </tr>
                </table></td>
              </tr>
			  
            </table></td>
            <td  valign="top" class="steptxt" style="color:#4f4d4d; " align="center" ><br>Thank you for Regsitering through Deal4loans.com for Balance Transfer</td>
          </tr>
        </table></td>
      </tr>
      
      <tr>
        <td>&nbsp;</td>
      </tr>
    </table></td>
    <td width="6" class="rgtshado">&nbsp;</td>
  </tr>
</table>

</body>
</html>

