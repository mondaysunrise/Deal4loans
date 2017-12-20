<?php
require 'scripts/db_init.php';
//require_once('webservice/nusoaptu.php'); 

//$client= new nusoap_client("https://www.test.transuniondecisioncentre.co.in/dc/TU.SSPL.Wrapper/wrapper.asmx?wsdl", true);
//$client= new nusoap_client("https://www.dc.transuniondecisioncentre.co.in/dc/TU.SSPL.Wrapper/wrapper.asmx?wsdl", true);//Live Link


if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
	$RequestID = $_POST["RequestID"];
	$icicicheck2 = $_POST["icicicheck2"];
	$icicicheck1 = $_POST["icicicheck1"];
	$cc_bankid = $_POST["cc_bankid"];
	$Pancard = $_POST["Pancard"];
	$existing_relationship = $_POST["existing_relationship"]; 
	$Residence_Address_line1 = $_POST["Residence_Address_line1"];
	$Residence_Address_line2 = $_POST["Residence_Address_line2"];
	$Residence_Address_line3 = $_POST["Residence_Address_line3"];
	$Pincode = $_POST["Pincode"];
	$Address_City = $_POST["Address_City"];
	$Address_State = $_POST["Address_State"];
	$Gender = $_POST["Gender"];
	$Company_Type = $_POST["Company_Type"];
	$stdcode = $_POST["stdcode"];
	$landline = $_POST["landline"];
	$existing_rel = $_POST["existing_rel"];
	$completeaddresstr = $Residence_Address_line1." ".$Residence_Address_line2." ".$Residence_Address_line3;
	$completeaddres = substr(trim($completeaddresstr),0,40);
	//select details
	$creditcarddt ="select Name,DOB,Mobile_Number,Employment_Status,City,City_Other,Net_Salary,Company_Name from Req_Credit_Card Where (RequestID=".$RequestID.")";
	list($alreadyExist,$row)=MainselectfuncNew($creditcarddt,$array = array());
	$rowcontr=count($row)-1;

	$DOB = $row[$rowcontr]["DOB"];
	$Company_Name = $row[$rowcontr]["Company_Name"];
	$Mobile_Number = $row[$rowcontr]["Mobile_Number"];
	$Net_Salary = $row[$rowcontr]["Net_Salary"];
	$Employment_Status = $row[$rowcontr]["Employment_Status"];
	
	
	$monthlyincome = $Net_Salary/12;
	list($monthly,$fraction) = split('[.]',$monthlyincome);
	list($first,$last) = split('[ ]',$row[$rowcontr]["Name"]);
	if($last=="")
	{
		$last= "K";
	}
	list($year,$month,$day) = split('[/.-]', $DOB);
	$dobstr=$day."/".$month."/".$year;
	$City = $row[$rowcontr]["City"];
	$City_Other = $row[$rowcontr]["City_Other"];
	if($City =="Others" && strlen($City_Other)>0)
	{
		$Citystr = $City_Other;
	}
	else
	{
		$Citystr = $City;
	}
	if($Employment_Status==0) { $emp_status="Selfemployed"; } else { $emp_status="Salaried"; }

if($Employment_Status==1)
	{
	$creditcarddtcomp ='select company_category from  HDFC_CC_Company_List Where (hdfc_company_name="'.$Company_Name.'")';
		list($rowcnCount,$rowcn)=MainselectfuncNew($creditcarddtcomp,$array = array());
	$rowcncontr=count($rowcn)-1;
	if(strlen($rowcn[$rowcncontr]["company_category"])>0)
	{
		$Typeofcompany=ucfirst(strtolower($rowcn[$rowcncontr]["company_category"]));
		if($Typeofcompany=="Prefered" || $Typeofcompany=="PREFERRED")
		{
			$Typeofcompany="Preffered";
		}	

	}
	else
	{
		$Typeofcompany="Others";
	}
	}
	else
	{
		$Typeofcompany="Others";
	}
if($existing_rel=="")
	{
		$existing_rel="Norelationship";
	}

$Userid = "icici_deals4loans";
$pwd = "Password@123";
$EnvironmentType = "P";
$Reference_Number = "U010000104854";//D4L0000000011;
$Purpose = "10";
$Amount = 50000;
$ScoreType = '01';
$ApplicantFirstName = $first;
$ApplicantLastName = $last;
$Gender = $Gender;
$DateOfBirth = $dobstr; //dd/mm/yyyy
//$DateOfBirth = "09/06/1978";
$ResidenceCode = "01";// 01 = Owned 02 = Rented 
$ResidenceAddress1 = $completeaddres;
//$ResidenceAddress1 ="B-16 SF, PArshanath, Mohan Ghaziabad";
$ResidencePincode = $Pincode;
$City = $Address_City;
$ResidenceState = $Address_State;
$CountryCode = "356";
$ResidenceMobileNo = $Mobile_Number;
$CreditCardType = "-1";
$MonthlyIncome = round($monthly);
//$MonthlyIncome=100000;
$PanNo = $Pancard;
$ICICIBankRelationship = $existing_rel; // Salary, Saving, Current, Loan, Noreleationship // case sensitice
$Typeofcompany = $Typeofcompany; //Elite, Superprime, Preffered, Others, Selfemployed // case sensitice
$CustomerProfile = $emp_status; // Salaried,Selfemployed // case sensitice
$ApplicationDate = date("m/d/Y H:m:s A");

//06/19/2014 19:32:19 PM;

//&lt;?xml version=&quot;1.0&quot;?&gt;
$xml_str = '<CallExternalService xmlns="http://tempuri.org/"><xml>';
$xml_str .= '<![CDATA[ &lt;DCRequest xmlns=&quot;http://transunion.com/dc/extsvc&quot;&gt;&lt;Authentication type=&quot;OnDemand&quot;&gt;&lt;UserId&gt;icici_deals4loans&lt;/UserId&gt;&lt;Password&gt;Password@123&lt;/Password&gt;&lt;/Authentication&gt;&lt;RequestInfo&gt;&lt;SolutionSetId&gt;133&lt;/SolutionSetId&gt;&lt;SolutionSetVersion&gt;84&lt;/SolutionSetVersion&gt;&lt;ExecutionMode&gt;NewWithContext&lt;/ExecutionMode&gt;&lt;/RequestInfo&gt;&lt;UserData /&gt;&lt;Fields&gt;&lt;Field key=&quot;EnvironmentType&quot;&gt;P&lt;/Field&gt;&lt;Field key=&quot;Reference_Number&quot;&gt;U010000104854&lt;/Field&gt;&lt;Field key=&quot;Purpose&quot;&gt;10&lt;/Field&gt;&lt;Field key=&quot;Amount&quot;&gt;'.$Amount.'&lt;/Field&gt;&lt;Field key=&quot;ScoreType&quot;&gt;01&lt;/Field&gt;&lt;Field key=&quot;ApplicantFirstName&quot;&gt;'.$ApplicantFirstName.'&lt;/Field&gt;&lt;Field key=&quot;ApplicantMiddleName&quot; /&gt;&lt;Field key=&quot;ApplicantLastName&quot;&gt;'.$ApplicantLastName.'&lt;/Field&gt;&lt;Field key=&quot;Gender&quot;&gt;'.$Gender.'&lt;/Field&gt;&lt;Field key=&quot;DateOfBirth&quot;&gt;'.$DateOfBirth.'&lt;/Field&gt;&lt;Field key=&quot;ResidenceCode&quot;&gt;'.$ResidenceCode.'&lt;/Field&gt;&lt;Field key=&quot;ResidenceAddress1&quot;&gt;'.$ResidenceAddress1.'&lt;/Field&gt;&lt;Field key=&quot;ResidenceAddress2&quot; /&gt;&lt;Field key=&quot;ResidenceAddress3&quot; /&gt;&lt;Field key=&quot;ResidenceAddress4&quot; /&gt;&lt;Field key=&quot;ResidenceAddress5&quot; /&gt;&lt;Field key=&quot;Location&quot; /&gt;&lt;Field key=&quot;Town&quot; /&gt;&lt;Field key=&quot;ResidencePincode&quot;&gt;'.$ResidencePincode.'&lt;/Field&gt;&lt;Field key=&quot;City&quot;&gt;'.$City.'&lt;/Field&gt;&lt;Field key=&quot;ResidenceState&quot;&gt;'.$Address_State.'&lt;/Field&gt;&lt;Field key=&quot;STDCode&quot; /&gt;&lt;Field key=&quot;CityShortName&quot; /&gt;&lt;Field key=&quot;ResidenceStateShortName&quot; /&gt;&lt;Field key=&quot;CountryCode&quot;&gt;356&lt;/Field&gt;&lt;Field key=&quot;ResidencePhoneNumber&quot; /&gt;&lt;Field key=&quot;ResidenceMobileNo&quot;&gt;'.$ResidenceMobileNo.'&lt;/Field&gt;&lt;Field key=&quot;CreditCardType&quot;&gt;-1&lt;/Field&gt;&lt;Field key=&quot;CreditCardTemplate&quot; /&gt;&lt;Field key=&quot;NACSDMAID&quot; /&gt;&lt;Field key=&quot;NACSDMACITY&quot; /&gt;&lt;Field key=&quot;MonthlyIncome&quot;&gt;'.$MonthlyIncome.'&lt;/Field&gt;&lt;Field key=&quot;PanNo&quot;&gt;'.$PanNo.'&lt;/Field&gt;&lt;Field key=&quot;PassportNo&quot; /&gt;&lt;Field key=&quot;VoterId&quot; /&gt;&lt;Field key=&quot;FutureUse1&quot; /&gt;&lt;Field key=&quot;FutureUse2&quot; /&gt;&lt;Field key=&quot;ConsumerName4&quot; /&gt;&lt;Field key=&quot;ConsumerName5&quot; /&gt;&lt;Field key=&quot;DLNo&quot; /&gt;&lt;Field key=&quot;UId&quot; /&gt;&lt;Field key=&quot;RationCardNo&quot; /&gt;&lt;Field key=&quot;AdditionalID1&quot; /&gt;&lt;Field key=&quot;AdditionalID2&quot; /&gt;&lt;Field key=&quot;ResidenceTelephoneExtension1&quot; /&gt;&lt;Field key=&quot;ResidenceTelephoneExtension2&quot; /&gt;&lt;Field key=&quot;ICICIBankRelationship&quot;&gt;'.$ICICIBankRelationship.'&lt;/Field&gt;&lt;Field key=&quot;Typeofcompany&quot;&gt;'.$Typeofcompany.'&lt;/Field&gt;&lt;Field key=&quot;ApplicationDate&quot;&gt;'.$ApplicationDate.'&lt;/Field&gt;&lt;Field key=&quot;QACIRFilePath&quot;&gt;D:\DecisionCentre\QA\ICICI\&lt;/Field&gt;&lt;Field key=&quot;FileName&quot;&gt;Scenario1.xml&lt;/Field&gt;&lt;/Fields&gt;&lt;/DCRequest&gt;]]>';
	$xml_str .= '</xml></CallExternalService>';	
	
//echo $xml_str;
	/*$return =  $client->call('CallExternalService', $xml_str);
	
	$return['CallExternalServiceResult'];
	$xml = new SimpleXMLElement($return['CallExternalServiceResult']);
	
	$Status = $xml->Status;// result
	$Authentication_Status =  $xml->Authentication->Status;// result
	
	$Authentication_Token =  $xml->Authentication->Token;
	
	$ResponseInfo_ApplicationId =  $xml->ResponseInfo->ApplicationId; // ApplicationID
	
	$ResponseInfo_SolutionSetInstanceId =  $xml->ResponseInfo->SolutionSetInstanceId;
	
	$ResponseInfo_CurrentQueue =  $xml->ResponseInfo->CurrentQueue;
	
	$ContextDataField0 =  $xml->ContextData->Field[0];
	
	$PLReason =  $xml->ContextData->Field[1];
	
	$FirstName =  $xml->ContextData->Field[2]; //First name
	
	$LastName =  $xml->ContextData->Field[3];//Last name
	
	$EMICalculatedString =  $xml->ContextData->Field[4];
	
	$ApplicationID =  $xml->ContextData->Field[5]; // ApplicationID

	$ContextDataField6 =  $xml->ContextData->Field[6];
	
	$ContextDataField7 =  $xml->ContextData->Field[7];

	$ContextDataField8 =  $xml->ContextData->Field[8];

	$ContextDataField9 =  $xml->ContextData->Field[9];

	$Gender =  $xml->ContextData->Field[10];//Gender
	$BTDataSet =  $xml->ContextData->Field[11];
	
	$MonthlyIncome =  $xml->ContextData->Field[12]; //Monthly INcome
	$LoanAmountString =  $xml->ContextData->Field[13];
	$TUEF_ErrorDescription =  $xml->ContextData->Field[32];
	$TUEF_ErrorResponse =  $xml->ContextData->Field[33];
	$RuleStatus =  $xml->ContextData->Field[34];
	$StatusDescription =  $xml->ContextData->Field[35]; // Status Description
	
		$CreditScore =  $xml->ContextData->Field[57];
	*/

if($RequestID>0)
	{
		$Dated = ExactServerdate();
		$dataInsert = array('RequestID'=>$RequestID, 'PanNo'=>$Pancard, 'Result'=>$Status, 'Pincode'=>$Pincode, 'Address'=>$completeaddres, 'City'=>$Address_City, 'State'=>$Address_State, 'Gender'=>$Gender, 'existing_relation'=>$existing_rel, 'Status'=>$Authentication_Status, 'Status_Description'=>$TUEF_ErrorDescription, 'Credit_Score'=>$CreditScore, 'ApplicationID'=>$ApplicationID, 'Dated'=>$Dated, 'RuleStatus'=>$RuleStatus, 'icici_check1'=>$icicicheck1, 'icici_check2'=>$icicicheck2, 'Response'=>$TUEF_ErrorResponse, 'Type_Of_Company'=>$Typeofcompany, 'flag'=>'1');
		$insert = Maininsertfunc ("credit_card_cibil_check", $dataInsert);
	}

}
	?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Apply for Credit Card | Credit Card Application | Credit Cards Comparison Chart</title>
<meta name="description" content="Apply for Credit Cards online: Get facility to apply directly for credit cards in all banks. Online Credit Card application form to get information about credit card schemes from all credit cards provider banks located in major cities of India like Mumbai, Delhi, Gurgaon, Bangalore, Ahmedabad, Chennai, Hyderabad, Navi Mumbai, Kochi etc.">
<meta name="keywords" content="Credit Card Application, Apply Credit Cards, Compare Credit Cards in Mumbai Hyderabad Pune kolkata Delhi Noida Bangalore">
<script type="text/javascript" src="scripts/calendardateinput.js"></script>
<script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
<link href="style/new-bima.css" rel="stylesheet"  type="text/css" />
<link href="style/glowing.css" rel="stylesheet"  type="text/css" />
</head>
<body>
<div id="dvtpbg">
<div id="logo">
<img onclick="javascript:location.href='http://www.deal4loans.com/'" alt="Deal4loans" src="/new-images/d4l-logo.gif"/>
</div>
</div>

<div id="container">
  <!--<span><a href="index.php">Home</a> > <a href="credit-cards.php">Credit Card</a> </span>-->
  <div id="txt" style="padding-top:15px;">

 <h1 style="color:#ae4212 !important; margin:0px; padding:0px; font-size:13px !important; line-height:22px; text-align:center;"> Thanks for applying ICICI Bank Credit Card through Deal4loans.com. You will soon receive call from our Representative ! </h1>
 
  <div style="clear:both;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td valign="top" class="crdtext">
		<table width="100%"  border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td height="35" valign="middle"   class="crdhorizonbg"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td colspan="2" ><?	if($cc_bankid==23)
				{ ?>
			ICICI Bank HPCL Platinum Credit Card
			<? 	}
				else if ($cc_bankid==24)
		{ ?>
			ICICI Bank HPCL Titanium Credit Card
	<? } ?></td>
                </tr>
          </table></td>
        </tr>
        <tr>
          <td class="yelobordr"><table width="98%"  border="0" align="center" cellpadding="0" cellspacing="0">
              <tr>
                <td width="185" align="center" valign="top">
			<?	if($cc_bankid==23)
				{ ?>
				<img src="new-images/icici_pltcc.jpg"  width="140" height="85"/> 
			<? 	}
				else if($cc_bankid == 24)
				{ ?>
				<img src="new-images/icici_titanmcc.jpg"  width="140" height="85"/> 
				<? }
				else if($cc_bankid == 25)
				{ ?>
				<img src="new-images/icici_coralcc.jpg"  width="140" height="85"/> 
				<? }
				else if($cc_bankid == 26)
				{ ?>
				<img src="new-images/icici_ruby160x102.gif"  width="140" height="85"/> 
				<? }
				else if($cc_bankid == 27)
				{ ?>
				<img src="new-images/icici_sappire160x102.gif"  width="140" height="85"/> 
				<? }
				else if($cc_bankid == 29)
				{ ?>
				<img src="new-images/icici_pltchipcrd.jpg"  width="140" height="85"/> 
				<? }
				else
		{} ?>
				</td>
				
                <td width="30" align="center"><img src="new-images/crd-shado.gif" width="10" height="80" /></td>
                <td width="369" valign="top" class="crdtext">
				<? if($cc_bankid==24) 
		{?>
        <table cellpadding="0">
		  <tr>
            <td  valign="bottom" class="crdbold">Annual Fee</td>
          </tr>
          <tr>
            <td valign="top" class="crdtext" style="padding-bottom:6px;"><ul>
               <li><b>Joining Fee</b> � Nil </li>
              <li><b>Annual Fee</b> �   Rs. 500 (1st year)<br />
                � Rs. 500 (Reversed in case spends exceed Rs. 50,000 in the previous year)(2nd year onwards)<br />  </li>
			   <li><b>Joining Benefit</b> - Cashback of Rs 500 if purchases exceed Rs. 5,000 within 60 days of card set   up. </li>
            </ul>            </td>
          </tr>
        <tr>
            <td height="22" valign="bottom" class="crdbold">Reward Points</td>
        </tr>
          <tr>
            <td valign="top" class="crdtext" height="55" style="padding-bottom:14px;"><ul>
                <li>5 PAYBACK points on fuel purchases at HPCL on ICICI Merchant� Services swipe   machines, 2 PAYBACK points on all other purchases.</li>
            </ul></td>
          </tr>
          </table>
					  <? } 
				else if($cc_bankid == 23)
		{ ?>
                <table cellpadding="0">
                <tr>
                <td valign="top" class="crdtext" height="50" style="padding-bottom:6px;"><ul>
               <li><b>Joining Fee</b> � Nil </li>
               <li><b>Annual Fee</b> �   Rs. 500 (1st year)<br />
                � Rs. 500 (Reversed in case spends exceed Rs. 50,000 in the previous year)(2nd year onwards)<br />
               </li>
			   <li><b>Joining Benefit</b> - Cashback of Rs 500 if purchases exceed Rs. 5,000 within 60 days of card set   up. </li>
            </ul>          </td>
          </tr>
         <tr>
            <td height="22" valign="bottom" class="crdbold">Reward Points</td>
        </tr>
          <tr>
            <td valign="top" class="crdtext"  style="padding-bottom:2px;"><ul>
                <li>5 PAYBACK points on fuel purchases at HPCL on ICICI Merchant� Services swipe   machines, 2 PAYBACK points on all other purchases.</li>
            </ul></td>
          </tr>
                  </table>
		<? } else if($cc_bankid == 25)
		{ ?>
                <table cellpadding="0">
                <tr>
                <td valign="top" class="crdtext" height="50" style="padding-bottom:6px;"><b>Option I:</b> <ul>
               <li><b>Joining Fee</b> � Rs. 1,000 </li>
               <li><b>Annual Fee</b> �   Rs. 500 (2nd Year onwards; waived off if spends cross Rs. 1,25,000 in the previous year)               </li>
			   <li><b>Welcome Gift</b> - Satya Paul gifts worth Rs.5,000. </li>
            </ul>          </td>
          </tr>
		  <tr>
                <td valign="top" class="crdtext" height="50" style="padding-bottom:6px;"><b>Option I:</b> <ul>
               <li><b>Lifetime Fee</b> � Rs. 5,000 </li>
               		   <li><b>Welcome Gift</b> - Bose Headphones. </li>
            </ul>          </td>
          </tr>
         <tr>
            <td height="22" valign="bottom" class="crdbold">Reward Points</td>
        </tr>
          <tr>
            <td valign="top" class="crdtext"  style="padding-bottom:2px;"><ul>
                <li>2 PAYBACK points per Rs 100 spent, 4 PAYBACK points per Rs 100 spent on dining, groceries and supermarkets </li>
            </ul></td>
          </tr>
                  </table>
		<? } 
		else if($cc_bankid == 26)
		{ ?>
                 <table cellpadding="0">
                <tr>
                <td valign="top" class="crdtext" height="50" style="padding-bottom:6px;"><b>Option I:</b> <ul>
               <li><b>Joining Fee</b> � Rs. 5,000 </li>
               <li><b>Annual Fee</b> �   Rs. 2,000 (2nd Year onwards; waived off if spends cross Rs. 2,50,000 in the previous year)                </li>
			   <li><b>Welcome Gift</b> - Bose Headphones. </li>
            </ul>          </td>
          </tr>
		  <tr>
                <td valign="top" class="crdtext" height="50" style="padding-bottom:6px;"><b>Option I:</b> <ul>
               <li><b>Lifetime Fee</b> � Rs. 25,000 </li>
               		   <li><b>Welcome Gift</b> - Apple iPad2. </li>
            </ul>          </td>
          </tr>
         <tr>
            <td height="22" valign="bottom" class="crdbold">Reward Points</td>
        </tr>
          <tr>
            <td valign="top" class="crdtext"  style="padding-bottom:2px;"><ul>
                <li>4 PAYBACK Points on selected categories, 2 PAYBACK Points on others. 50% more reward points on American Express</li>
            </ul></td>
          </tr>
                  </table>
		<? }
		
		else if($cc_bankid == 27)
		{ ?>
                 <table cellpadding="0">
                <tr>
                <td valign="top" class="crdtext" height="50" style="padding-bottom:6px;"><b>Option I:</b> <ul>
               <li><b>Joining Fee</b> � Rs. 25,000 </li>
               <li><b>Annual Fee</b> �   Rs. 3,500 (2nd Year onwards; waived off if spends cross Rs. 5,00,000 in the previous year)                </li>
			   <li><b>Welcome Gift</b> - Apple iPad2. </li>
            </ul>          </td>
          </tr>
		  <tr>
                <td valign="top" class="crdtext" height="50" style="padding-bottom:6px;"><b>Option I:</b> <ul>
               <li><b>Lifetime Fee</b> � Rs. 75,000 </li>
               		   <li><b>Welcome Gift</b> - Apple Macbook Air. </li>
            </ul>          </td>
          </tr>
         <tr>
            <td height="22" valign="bottom" class="crdbold">Reward Points</td>
        </tr>
          <tr>
            <td valign="top" class="crdtext"  style="padding-bottom:2px;"><ul>
                <li>2 PAYBACK Points on Domestic Spends, 4 PAYBACK Points on International Spends. 50% more reward points on American Express.</li>
            </ul></td>
          </tr>
                  </table>
		<? }
		else if($cc_bankid == 29)
		{ ?>
		 <table cellpadding="0">
                <tr>
                <td valign="top" class="crdtext" height="50" style="padding-bottom:6px;"><b><div style="float:left;">Joining Fee </div><div style="font-size:9px;float:right; background-color:#FFFF00; color:#FF0000; width:80px;" >Exclusive offer</div></b><br> <ul>
				<li>Fee- Rs-<span style="text-decoration:line-through;">199</span>&nbsp;  Nil **</li>
                       <li><b>Annual Fee</b> �   Rs. 99 (waived off if spends cross Rs. 50,000 during previous year)                </li>
			   
            </ul>          </td>
          </tr>
		  
         <tr>
            <td height="22" valign="bottom" class="crdbold">Reward Points</td>
        </tr>
          <tr>
            <td valign="top" class="crdtext"  style="padding-bottom:2px;"><ul>
                <li>2 PAYBACK points for every Rs. 100 spent (except on fuel)</li>
            </ul></td>
          </tr>
		  <tr>
            <td height="22" valign="bottom" class="crdbold">Special Feature</td>
        </tr>
          <tr>
            <td valign="top" class="crdtext"  style="padding-bottom:2px;"><ul>
                <li>The card comes with a micro-chip that is difficult to duplicate.</li>
            </ul></td>
          </tr>
		  <tr><td style="font-size:11px;"><br />** Only for deal4loans customers</td></tr>
                  </table>
		<? }
		?>
					  </td>
              </tr>
          </table></td>
        </tr>
        <tr>
          <td height="20" valign="top"><img src="new-images/crds-h-botbg.gif" width="960" height="20" /></td>
        </tr>
      </table>
	   
	  </td>
  </tr>
</table>
</div>
</div>
   
  <? if($existing_rel==0 || $existing_rel==1)
{ ?>
  <?php include '~Bottom-new.php';?><?php } ?>
</div><!-- </div> -->
</body>
</html>