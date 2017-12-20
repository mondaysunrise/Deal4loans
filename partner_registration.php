<?php
	require 'scripts/functions.php';
	require 'scripts/db_init.php';
	session_start();
	
	//print_r($_POST);
	$msg = "Thanks for Registering with Deal4loans Referral Programme. Kindly Check your account details on your Email.";

	function getrmname($pKey)
{
    $titles = array(
        1=> 'Afsana',
        4=> 'Balbir Singh',
        5=> 'Bhawna Sharma',
        6=> 'Mondeep Das',
        8=> 'Neha Singh',
        10=> 'Priyanka Sharma',
		12=> 'Sumiti Aggarwal',
		13=> 'Beena',
		15=> 'Shilpa Mehta'

    );
    foreach ($titles as $key=>$value)
        if($pKey==$key)
        return $value;

    return "";
}

	if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		$partner_name = $_REQUEST['partner_name'];
		$partner_email = $_REQUEST['partner_email'];
		$partner_city = $_REQUEST['partner_city'];
		$partner_city_other = $_REQUEST['partner_city_other'];
		$partner_mobile = $_REQUEST['partner_mobile'];
		$company = $_REQUEST['partner_company'];
		$comment =$_REQUEST['partner_comment'];
		$mngcode= $_REQUEST['mngcode'];
		$Reference_Code = $_REQUEST['Reference_Code'];
		$activation_code = $_REQUEST['activation_code'];
		$partner_manager =getrmname($mngcode);
		$pwd_date = date("dmy");
		$trimName = strtolower (substr(trim($partner_name), 0,5));
		$password=$trimName."".$pwd_date;
		$partner_username= $password."@d4l.com";
		if($Reference_Code == $activation_code)
		{
			$Is_Valid=1;
			$validvalue="Yes";
		}
		else
		{
			$Is_Valid=0;
			$validvalue="No";
		}

	$getbdEmail = "select BD_Email from BD_List where (BD_Manager='".$partner_manager."')";
	list($recordcount,$rowemail)=Mainselectfunc($getbdEmail,$array = array());
	$bd_email=$rowemail['BD_Email'];

$RMmessage="Details of your Partner are :
Username: ".$partner_username."<br>
Password: ".$password."<br>
Validated : ".$validvalue."<br>
Regards<br>
Deal4loans";

			$Message2 = "<table border='0' cellspacing='0' width='100%' cellpadding='0'bgcolor='#529BE4' style='border-collapse: collapse' bordercolor='#529BE4'><tr><td valign='top' align=center><table border='0' cellpadding='4' cellspacing='0' style='border-collapse: collapse' bordercolor='#111111' width='100%' id='AutoNumber2' bgcolor='#529BE4'><tr><td align='center'>&nbsp;</td></tr></table><table border='0'  bordercolor='#529BE4' ><tr><td bgcolor='#FFFFFF'><table border='0' cellspacing='5' width='99%' cellpadding='6' id='frm' bgcolor='#FFFFFF'><tr><td bgcolor='#FFFFFF'><tr><td><font face='Verdana' size='2'><b>Dear ".$partner_name.",</b></font></td><td align='right' ><img src='http://www.deal4loans.com/images/logo.gif'/></td></tr><tr><td colspan='2'><p><font face='Verdana' size='2'>Welcome to deal4loans affliate channel.<br>Here is your chance to make healthy commisions on passing leads to us for loans product.<br>All you need to do is ensure the customer detail is shared with us and leave the rest to us.
So Go now <br>
Click here or save this link as yor favourite i.e www.deal4loans.com/affliate.php<br>
Username: ".$partner_username."<br>
Password: ".$password."<br>
<br><br>
</font></p>
<tr><td><p><font face='Verdana' size='2'><b>Regards</b><br>
<b>Team Affliates</b> <br><a href='www.deal4loans.com'>Deal4loans.com</a></font></p> </td><td width='40%'><p></td></tr></table></td></tr><tr><td bgcolor='#529BE4'>&nbsp;</td></tr></table></td></tr></table>";
	
		
		$headers  = 'From: Deal4loans<no-reply@deal4loans.com>' . "\r\n";
		$headers .= "Return-Path: <no-reply@deal4loans.com>\r\n";  // Return path for errors
		//$headers .= "Cc: ".$bd_email.""."\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

		mail($partner_email,'Welcome to Deal4loans - '.$partner_name, $Message2, $headers);

		mail($bd_email,'New Partner in Deal4loans Referral Programme', $RMmessage, $headers);
	
	echo "<script language=javascript>alert('".$msg."');"." location.href='index.php'"."</script>";

		}
		
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<title>Information on Loans | Loan Partner - Deal4Loans</title>
<meta name="keywords" content="home loans, car loans, personal loans, loans against property, credit cards, loan information, loan portal, loans india, online loan application, loan calculator, loan eligibility, banks india, easy loans, quick loans, EMI calculator, loan providers india, home loans banks, instant personal loan, quick car loans, compare loans">
<meta name="verify-v1" content="iC5qAw9C0E3rRZYbtAKvnPHmBSQU3zWJu5Ooj8hO3Og=">
<meta name="description" content="Deal4Loans is an online loan information portal, provides valuable information on all types of loans in India offered by top banks. Read online information on home loans, car loans, personal loans, loans against property, loan providers and credit cards.">
<link href="style/new-bima.css" rel="stylesheet"  type="text/css" />
<link href="style/glowing.css" rel="stylesheet"  type="text/css" />
<script type="text/javascript" src="js/dropdowntabs.js"></script>
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<Script Language="JavaScript">
				
function cityother()
{
	if(partner_frm.partner_city.value=="Others")
	{
		partner_frm.partner_city_other.disabled = false;
	}
	else
	{
		partner_frm.partner_city_other.disabled = true;
	}
}



function validateMe(theFrm){

				if(theFrm.partner_name.value=="")
				{
					alert("Please enter Your Name");
					theFrm.partner_name.focus();
					return false;
				}
				
				
				if(theFrm.partner_email.value=="")
					{
						alert("Please enter  Email Address");
						theFrm.partner_email.focus();
						return false;
					}
				var str=theFrm.partner_email.value
					var aa=str.indexOf("@")
					var bb=str.indexOf(".")
					var cc=str.charAt(aa)
					
	
					if(aa==-1)
						{
					alert("Please enter the valid Email Address");
					theFrm.partner_email.focus();
						return false;
						}
					else if(bb==-1)
					{
					alert("Please enter the valid Email Address");
					theFrm.partner_email.focus();
					return false;
					}
				
				
					if (theFrm.partner_city.selectedIndex==0)
					{
						alert("Please enter City Name to Continue");
						theFrm.partner_city.focus();
						return false;
					}
					if((theFrm.partner_city.value=="Others") && (theFrm.partner_city_other.value=="" || theFrm.partner_city_other.value=="Other City"  ) || !isNaN(theFrm.partner_city_other.value))
					{
						alert("Kindly fill your Other City!");
						theFrm.partner_city_other.focus();
						return false;
					}
					
					if(theFrm.partner_mobile.value=="")
					{
						alert("Please Enter partner_mobile Number");
						theFrm.partner_mobile.focus();
					return false;
					}
					  if(isNaN(theFrm.partner_mobile.value)|| theFrm.partner_mobile.value.indexOf(" ")!=-1)
					{
						  alert("Enter numeric value");
						  theFrm.partner_mobile.focus();
						  return false;  
					}
					if (theFrm.partner_mobile.value.length < 10 )
					{
							alert("Please Enter 10 Digits"); 
							 theFrm.partner_mobile.focus();
							return false;
					}
					if ((theFrm.partner_mobile.value.charAt(0)!="9") && (theFrm.partner_mobile.value.charAt(0)!="8") && (theFrm.partner_mobile.value.charAt(0)!="7"))
					{
							alert("The number should start only with 9 or 8 or 7");
							 theFrm.partner_mobile.focus();
							return false;
					}

					if(theFrm.activation_code.value=="")
					{
						alert("Please Enter Activation Code");
						theFrm.activation_code.focus();
					return false;
					}
					
	if(!theFrm.trm_cnd.checked)
	{
	alert("Accept the Terms and Condition");
	theFrm.trm_cnd.focus();
	return false;
	}
						

									
		return true;
    }



function HandleAgent2()
{
 myWindow = window.open("PlayEditor/agent(may09).html","","height=115,width=215,toolbar=no,menubar=no,scrollbar=no,resizable=no,location=no,directories=no,minimize=no,maximize=no")
  myWindow.document.close(); 


}
function HandleAgent1()
{
 myWindow = window.open("PlayEditor/agent(march09).html","","height=115,width=215,toolbar=no,menubar=no,scrollbar=no,resizable=no,location=no,directories=no,minimize=no,maximize=no")
  myWindow.document.close(); 


}

function HandleAgent3()
{
 myWindow = window.open("PlayEditor/agent(june09).html","","height=115,width=215,toolbar=no,menubar=no,scrollbar=no,resizable=no,location=no,directories=no,minimize=no,maximize=no")
  myWindow.document.close(); 


}
</script>
<Script Language="JavaScript">
var ajaxRequest;  // The variable that makes Ajax possible!
		function ajaxFunctionMain(){
			
			try{
				// Opera 8.0+, Firefox, Safari
				ajaxRequest = new XMLHttpRequest();
			} catch (e){
				// Internet Explorer Browsers
				try{
					ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
				} catch (e) {
					try{
						
						ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
					} catch (e){
						// Something went wrong
						alert("Your browser broke!");
						return false;
					}
				}
			}
		}

function activatecode()
		{
			
			var get_full_name = document.getElementById('partner_name').value;
			
			var get_mobile_no = document.getElementById('partner_mobile').value;
			
			var get_reference_code = document.getElementById('Reference_Code').value;
			
if(get_reference_code=="" && get_mobile_no>0)
			{
				var queryString = "?get_Mobile=" + get_mobile_no + "&get_name=" + get_full_name ;
			//alert(queryString); 
				ajaxRequest.open("GET", "get_activation_codePrtReg.php" + queryString, true);
				// Create a function that will receive data sent from the server
				ajaxRequest.onreadystatechange = function(){
					if(ajaxRequest.readyState == 4)
					{
						document.getElementById('Reference_Code').value=ajaxRequest.responseText;
					}
				}
			}

				ajaxRequest.send(null); 
				
			 
		}


	window.onload = ajaxFunctionMain;

    </Script>
</head>
<body>
<?php include '~Top-new.php';?>
<?php include '~menu.php';?>
<div id="container">
<div id="lftbar">
<div class="lfttxtbar">
  <span><a href="index.php">Home</a> > Get the Deal4loans Advantage </span>
<h1>Get the Deal4loans Advantage</h1>
  <div id="txt">
  
	        <table width="100%"  border="0" cellspacing="0" cellpadding="0">
              
              <tr> 
      <td align="center"> 
</table> 
	<form name="partner_frm" method="post" action="<? echo $_SERVER['PHP_SELF'] ?>" onSubmit="return validateMe(this);">
	<input type="hidden" name="mngcode" id="mngcode" value="<? echo $_REQUEST['prtmng']; ?>">
    	 <input type="hidden" name="Reference_Code" id="Reference_Code" >
					<table width="500" border="0" align="center" cellpadding="0" cellspacing="0" >
<tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="74" valign="middle" background="new-images/apl-tp-prt.gif" style="background-repeat:no-repeat; "><h2 style="color:#443133; font-size:17px;  margin:0 0 10px; padding:15px 0 3px; text-align:center; font-family:Arial, Helvetica, sans-serif;">Partner's Registration form</h2></td>
  </tr>
  
  <tr>
    <td class="aplfrm"><table width="460" border="0" align="right" cellpadding="0" cellspacing="0"   >
      <tr>
        <td width="37%" height="26" valign="middle" class="frmbldtxt">Your Name<font size="1" color="#FF0000">*</font></td>
        <td width="63%" align="left"><input name="partner_name" id="partner_name" type="text" class="form" style="width:150px;" /></td>
      </tr>
      <tr>
        <td height="26" valign="middle" class="frmbldtxt">Your Email ID<font size="1" color="#FF0000">*</font></td>
        <td align="left"><input name="partner_email" type="text" class="form" style="width:150px;" /></td>
      </tr>
      
      <tr>
        <td height="26" valign="middle" class="frmbldtxt">Your Mobile<font size="1" color="#FF0000">*</font></td>
        <td align="left" class="frmtxt">+91 
            <input name="partner_mobile" id="partner_mobile" onChange="activatecode();" onkeyup="intOnly(this);" onkeypress="intOnly(this);"  type="text" class="form"  style="width:123px;" maxlength="10" /></td>
      </tr>
	  <tr>
        <td height="26" valign="middle" class="frmbldtxt">Your City <font size="1" color="#FF0000">*</font></td>
        <td align="left" class="frmbldtxt"><select size="1" name="partner_city" id="partner_city" onchange="cityother();"  style="width:155px;">
            <?=getCityList($city)?>
          </select>        </td>
      </tr>
      <tr>
        <td height="26" valign="middle" class="frmbldtxt">Other City<font size="1" color="#FF0000">*</font></td>
        <td width="63%" align="left" class="frmbldtxt"><input type="text" name="partner_city_other" id="partner_city_other" disabled="disabled" value="Other City" onfocus="this.select();" style="width:150px;" /></td>
      </tr>
    
           <tr>
        <td height="26" valign="middle" class="frmbldtxt">Add Comment</td>
        <td align="left" class="frmtxt"><textarea name="partner_comment" id="partner_comment" rows="3" cols="20"/></textarea></td>
      </tr>
       
      <tr>
        <td class="frmbldtxt">&nbsp;</td>
        <td class="frmbldtxt">&nbsp;</td>
      </tr>
	   <tr>
        <td class="frmbldtxt" colspan="2">Terms of Service<br></td>
      </tr>
      <tr>
        <td colspan="2" ><br>
         <div style=" height: 200px; overflow-y: scroll; scrollbar-arrow-color:blue; scrollbar-face-color: #e7e7e7; scrollbar-3dlight-color: #a0a0a0; scrollbar-darkshadow-color:#888888; border:#000000 1px solid;"><center><b>Referral Program Agreement</b></center><br>
This Agreement governs your participation in the WRS Info India Pvt. Ltd  Referral Program (the "Program"). This Agreement between you and WRS Info India  Pvt. Ltd ("Deal4loans.com") is in addition to the Membership Agreement, our Terms  of Use, our Privacy Policy and all other documents and provisions applicable to  the use of www.deal4loans.com (the "Site").<br />  As a bona fide member of the WRS Info India Pvt. Ltd., you are entitled to  participate in the Program on condition that you accept the terms and  conditions of this Agreement by inserting "I agree" below. If you do not agree  to accept and abide by this Agreement, you should not participate in the  Program. In the event of any inconsistency between this Agreement, the  Membership Agreement and the Terms of Use, the terms of this Agreement shall  govern.<br />
This may be a temporary program. WRS Info India Pvt. Ltd. reserves the  right, in its discretion, to change, terminate or modify all or any part of the  Program or this Agreement at any time, effective immediately upon notice  published on the Site. Your continued participation in the Program after such  notice constitutes your binding acceptance of the terms and conditions in this  Agreement, including any changes or modifications made by WRS Info India Pvt.  Ltd as permitted above. If at any time the terms and conditions of this  Agreement are no longer acceptable to you, you should immediately cease  participation in the Program. </p>
<b>Rules of the Program</b><br />
You agree to actively refer potential customers to the Site. For each  Successful Referral (as defined below) WRS Info India Pvt. Ltd. will pay to you  a referral commission of (the "Commission"). <br />
A "Successful Referral" is one that we determine satisfies each of the  following criteria: <br /><br />
<ul type="disc">
<li>The referred customer (a "New Customer") must not be a current or past customer of Deal4loans.com and       must complete, submit and have accepted a valid customer online application through the referral;</li>
<li>The New Customer's request must be updated on the Site "By the Referral" through the Referral Program       interface;</li>
<li>There must be a bona fide <strong>closure of the Loan</strong> through either of our associates for which payment is received by WRS Info India Pvt. Ltd and is not reversed or otherwise set aside as a potentially false transaction;</li>
<li>By submitting the application of your referral You/"New Customer" are consenting to receive telephone       calls and/or emails from our participating financial partners even if you are currently registered on the National Do Not Call Registry. Any argument       over violation on any/all part would be the sole responsibility of the "Referral"</li>
<li>"The Referral" is not entitled to charge any type of fees/charges from the customer. If anyone found guilty of terminating this clause his/her account would be seized and agreement would be terminated without any notice.</li>
</ul>
All Commission which are payable will be credited to your account and may be  adjusted to reflect actual receipts or artificial transactions in accordance  with the terms of the Program or WRS Info India Pvt. Ltd. discretion. Amounts  will be paid by cheque or other means within a period of <strong>45 days</strong> after the closure of the Loan. WRS Info India Pvt. Ltd  reserves the right for any reason to refuse any New Customer application in its  discretion, without notice or any communication to you. Payment of Fees and  amendments to the Program are at the sole discretion of WRS Info India Pvt.  Ltd. Under no circumstances shall WRS Info India Pvt. Ltd. be required to  provide you with any information or updates regarding the New Customer, except  to confirm the referral.<br />
You also agree not to use the Site Name, links, or your referral account in  any manner that could damage, disable, overburden, or impair the Site or any  other site, create spam or any other unwanted solicitation, or interfere with  any other party's use and enjoyment of the Site, their own site or other  location links. You agree not to use any of our trademarks or intellectual  property or make any representations, warranties or other statements concerning  WRS Info India Pvt. Ltd, the Site or any of our products, services or policies,  except as detailed in this Agreement.<br />
Each party shall act as an independent contractor and shall have no  authority to obligate or bind the other in any respect. Nothing in this Agreement  will constitute or be construed as constituting or tending to create an agency,  partnership or employer/employee relationship between you and us.<br /><br />
<b>Indemnity</b><br />
You agree to indemnify, defend and hold WRS Info India Pvt. Ltd. and its  affiliates, and their respective directors, officers, employees, shareholders,  partners and agents (collectively, the "WRS Info India Pvt. Ltd Parties")  harmless from and against any and all claims, liability, losses, costs and  expenses (including lawyers fees on a solicitor and client basis) incurred by  any WRS Info India Pvt. Ltd Party in connection with any breach by you of this  Agreement. WRS Info India Pvt. Ltd reserves the right, at your expense, to  assume the exclusive defense and control of any matter otherwise subject to  indemnification by you, and in such case, you agree to cooperate with WRS Info  India Pvt. Ltd defense of such claim. <br /><br />
<b>Term and Termination</b><br />
This Agreement is effective so long as you participate in the Program or  until the Program is discontinued by WRS Info India Pvt. Ltd., whichever first  occurs. The Referral Program or any aspect of it can be discontinued at any  time in WRS Info India Pvt. Ltd's discretion upon notice posted on the Site.  Upon posting of such notice, the Program and this Agreement shall be thereby  terminated as it relates to you.<br /><br />
<b>DISCLAIMER OF WARRANTIES</b><br />
WRS INFO INDIA  PVT. LTD. DOES NOT REPRESENT OR WARRANT THAT THE SITE OR ANY CONTENT AVAILABLE  FOR DOWNLOADING THROUGH THE SITE WILL BE FREE OF VIRUSES OR SIMILAR  CONTAMINATION OR DESTRUCTIVE FEATURES. <br /><br />
<b>LIMITATION OF LIABILITY</b><br />
YOU ASSUME ALL RESPONSIBILITY AND RISK FOR USE OF THE PROGRAM. IN NO EVENT  SHALL WRS INFO INDIA  PVT. LTD. OR ANY OF ITS DIRECTORS, OFFICERS, EMPLOYEES, SHAREHOLDERS, PARTNERS,  LICENSORS OR AGENTS BE LIABLE FOR ANY INCIDENTAL, INDIRECT, PUNITIVE,  EXEMPLARY, OR CONSEQUENTIAL DAMAGES WHATSOEVER (INCLUDING DAMAGES FOR LOSS OF  PROFITS, INTERRUPTION, LOSS OF BUSINESS INFORMATION, OR ANY OTHER PECUNIARY  LOSS) IN CONNECTION WITH ANY CLAIM, LOSS, DAMAGE, ACTION, SUIT OR OTHER PROCEEDING  ARISING UNDER OR OUT OF THIS AGREEMENT OR THE REFERRAL PROGRAM, INCLUDING  WITHOUT LIMITATION YOUR USE OF, RELIANCE UPON, ACCESS TO, OR ANY RIGHTS GRANTED  TO YOU HEREUNDER, EVEN IF WRS INFO INDIA PVT. LTD. HAS BEEN ADVISED OF THE  POSSIBILITY OF SUCH DAMAGES, WHETHER THE ACTION IS BASED ON CONTRACT, TORT  (INCLUDING NEGLIGENCE), INFRINGEMENT OF INTELLECTUAL PROPERTY RIGHTS OR  OTHERWISE. <br /><br />
<b>Age and Responsibility</b><br />
You represent and warrant that you are of sufficient legal age to use the  Program/Business and to create binding legal obligations for any liability you  may incur as a result of the use of the Program and your participation in the  Program.<br /><br />
<b>Applicable law</b><br />
The Site is controlled, operated and administered by WRS Info India Pvt.  Ltd. from within the Province of Delhi Court.  You hereby irrevocably submit to the exclusive jurisdiction of the Courts of  the Province of Indian Law with respect to the subject  matter of this Agreement. <br />
Any and all disputes arising out of, under or in connection with this  Agreement, including without limitation, its validity, interpretation,  performance and breach, shall be submitted to (Delhi   Court)<br />
If WRS Info India Pvt. Ltd. is obligated to go to court, rather than  arbitration, to enforce any of its rights, or to collect any fees, you agree to  reimburse WRS Info India Pvt. Ltd for its legal fees, costs and disbursements  if WRS Into India Pvt. Ltd. is successful. <br /><br />
<b>General</b><br />
You specifically agree and acknowledge that you have, in addition to the  terms of this Agreement, reviewed the terms of the Membership Agreement, the  Terms of Use and any other agreements which may be incorporated by reference  therein, and you agree to be bound by them.<br /><br />
<b>Contact</b><br />
If you have concerns relating to this Referral Program, or this Agreement,  Please contact us at bd@deal4loans.com<br /><br />
<b>Acknowledgement</b><br />
YOU ACKNOWLEDGE THAT YOU HAVE READ THIS AGREEMENT, UNDERSTAND IT, AND AGREE  TO BE BOUND BY ITS TERMS AND CONDITIONS. YOU FURTHER AGREE THAT IT IS THE  COMPLETE AND EXCLUSIVE STATEMENT OF THE AGREEMENT BETWEEN YOU AND WRS INFO INDIA PVT. LTD.  REGARDING THE REFERRAL PROGRAM, WHICH SUPERSEDES ANY PROPOSAL OR PRIOR  AGREEMENT, ORAL OR WRITTEN, AND ANY OTHER COMMUNICATION BETWEEN YOU AND  DEAL4LOANS RELATING TO THE SUBJECT OF THIS AGREEMENT.</div></td>
      </tr>
	  <tr>
        <td class="frmbldtxt" colspan="2"><input type="checkbox" name="trm_cnd" style="border:none;" onChange="activatecode();" > I Accept Terms and conditions<br></td>
      </tr>
	  <tr>
        <td class="frmbldtxt">&nbsp;</td>
        <td class="frmbldtxt">&nbsp;</td>
      </tr>
	  <tr>
        <td width="37%" height="26" valign="middle" class="frmbldtxt">Activation Code</td>
        <td width="63%" align="left"><input name="activation_code" id="activation_code" type="text" class="form" style="width:100px;" maxlength="4"/></td>
      </tr>
	  <tr>
        <td colspan="2" align="center"><br />
            <input name="submit" type="submit" class="btnclr" value="Submit" /></td>
      </tr>
    </table></td>
  </tr>
   <tr>
          <td width="500" height="28"><img src="new-images/apl-bt-prt.gif" width="500" height="28" /></td>
  </tr>
</table>

        </form></td>
              </tr>
             
            </table>
 
    </div> </div>
    </div>
	 <div style="float:right;"><table width="250" border="0"  cellpadding="0" cellspacing="0" style="border:1px dashed #4a9fd1;">
        <tr>
  <td height="22"  bgcolor="#4a9fd1" align="center" class="quick"><font style="font-size:13px; font-weight:bold; color:#FFFFFF;">DSA’s Speak Section </font></td>  </tr>
    
        <tr>
          <td height="22" align="left" valign="top"  bgcolor="#F4F9FD" style="font-size:11px; font-family:Verdana, Arial, Helvetica, sans-serif; color:#000000; padding:0px 4px; line-height:18px;" ><table width="99" border="0" align="right" cellpadding="0" cellspacing="0">
              <tr bgcolor="#F4F9FD">
                <td height="120" align="center" valign="top" ><img src="images/mohit-agent-sml.jpg" width="100" height="120"></td>
              </tr>
            </table>
              <p ><b style="color:#04335F;">Mr.Mohit Gokhale,<br>
                DSA of the Month April, </b> <a  href="/dsa-speak-section.php#aprl" style="color:#04335F; text-decoration:none;   outline:none;">DSA of the Month has active association with Deal4Loans for sourcing Home Loan Leads since Mar&rsquo;09 & has converted maximum no. of leads in short span. Mr Mohit is currently tied up with LICHFL Mumbai. He has shared his experience with Deal4Loans about the conversions, lead quality, for generating business.<br>
                  He has sourced leads from Deal4loans.com through the prepaid model and the association has been profitable for him.<br>
                  Here is the snippet of the conversation we had with him on Dated 28th April 09:</a></p></td>
        </tr>
        <tr>
          <td height="22" align="left" valign="top"  bgcolor="#F4F9FD" style="font-size:12px; font-family:Arial, Helvetica, sans-serif; color:#000000; padding:0px 4px; line-height:18px;" ><table width="100%" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td align="right" valign="middle" ><a onClick="HandleAgent2();" style="cursor:pointer; color:#e15002; font-weight:bold;">Listen Here</a></td>
              <td width="30" align="right" valign="middle" ><img src="images/trnsprnt-spkr.gif" width="23" height="19" style="cursor:pointer;" onClick="HandleAgent2();"/></td>
            </tr>
          </table></td>
        </tr>
       <tr>
          <td height="10" align="left" valign="middle"  bgcolor="#F4F9FD" style="font-size:12px; font-family:Arial, Helvetica, sans-serif; color:#000000; padding:0px 4px; line-height:18px;" ><img src="images/rgt-sprt-line.jpg" width="207" height="1"></td>
       </tr>
       <tr>
          <td height="22" align="left" valign="top"  bgcolor="#F4F9FD" style="font-size:11px; font-family:Verdana, Arial, Helvetica, sans-serif; color:#000000; padding:0px 4px; line-height:18px;" ><table width="99" border="0" align="right" cellpadding="0" cellspacing="0">
            <tr bgcolor="#F4F9FD">
              <td height="120" align="center" valign="top" style="font-family:Arial, Helvetica, sans-serif; font-size:12px;"><img src="images/agent-pic-sml.jpg" width="99" height="120"></td>
            </tr>
          </table>
            <p ><b style="color:#04335F;">Mr.Anil Yadav,<br>
 DSA of the Month March, </b> <a  href="/dsa-speak-section.php#mrch" style="color:#04335F; text-decoration:none; outline:none;">has active association with Deal4Loans for sourcing Home Loan Leads since July’08.Mr Anil is currently tied up with Mumbai branch of Hdfc ltd. He has shared  his experience with Deal4Loans about the conversions, lead quality, for generating business.<br>
              He has sourced more than <b>500 leads from Deal4loans.com in the prepaid model</b>  and the association has been profitable for him .<br>
			  Here is the snippet of the conversation we had with him on Dated 13th Mar 09:</a> </p>          </td>
      </tr>
       <tr>
         <td height="10" align="left" valign="middle"  bgcolor="#F4F9FD" style="font-size:12px; font-family:Arial, Helvetica, sans-serif; color:#000000; padding:0px 4px; line-height:18px;" ><table width="100%" border="0" cellpadding="0" cellspacing="0">
           <tr>
             <td align="right" valign="middle" ><a onClick="HandleAgent1();" style="cursor:pointer; color:#e15002; font-weight:bold;">Listen Here</a></td>
             <td width="30" align="right" valign="middle" ><img src="images/trnsprnt-spkr.gif" width="23" height="19" style="cursor:pointer;" onClick="HandleAgent1();"/></td>
           </tr>
         </table></td>
       </tr>
    </table></div>
<?php include '~Bottom-new.php';?>
</div>
  </body>
</html>