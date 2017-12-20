<?php
ob_start();
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	require 'getlistofeligiblebidders.php';
			require 'scripts/home_loan_eligibility_function.php';


	function getProductCode($pKey){
	$titles = array(
		'Req_Loan_Personal' => '1',
		'Req_Loan_Home' => '2',
		'Req_Loan_Car' => '3',
		'Req_Credit_Card' => '4',
		'Req_Loan_Against_Property' => '5',
		'Req_Business_Loan' => '6',
	);

	foreach ($titles as $key=>$value)
	    if($pKey==$key)
		return $value;

	return "";
   }

	
function DetermineAgeGETDOB ($YYYYMMDD_In)
{
  $yIn=substr($YYYYMMDD_In, 0, 4);
  $mIn=substr($YYYYMMDD_In, 4, 2);
  $dIn=substr($YYYYMMDD_In, 6, 2);

  $ddiff = date("d") - $dIn;
  $mdiff = date("m") - $mIn;
  $ydiff = date("Y") - $yIn;

  // Check If Birthday Month Has Been Reached
  if ($mdiff < 0)
  {
    // Birthday Month Not Reached
    // Subtract 1 Year From Age
    $ydiff--;
  } elseif ($mdiff==0)
  {
    // Birthday Month Currently
    // Check If BirthdayDay Passed
    if ($ddiff < 0)
    {
      //Birthday Not Reached
      // Subtract 1 Year From Age
      $ydiff--;
    }
  }
  return $ydiff;
}


	
   function getTransferURL($pKey){
	$titles = array(
		'Req_Loan_Personal' => 'Contents_Personal_Loan_Mustread.php',
		'Req_Loan_Home' => 'Contents_Home_Loan_Mustread.php',
		'Req_Loan_Car' => 'Contents_Car_Loan_Mustread.php',
		'Req_Credit_Card' => 'Contents_Credit_Card_Mustread.php',
		'Req_Loan_Against_Property' => 'Contents_Loan_Against_Property_Mustread.php',
		'Req_Life_Insurance' => 'index.php'
	);

	foreach ($titles as $key=>$value)
	    if($pKey==$key)
		return $value;

	return "";
   }

	if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{
			$Type_Loan=$_REQUEST['Type_Loan'];
			$Reference_Code1 = $_REQUEST['Reference_Code1'];
			$ProductValue = $_REQUEST['ProductValue'];	
			$Day=$_REQUEST['day'];
			$Month=$_REQUEST['month'];
			$Year=$_REQUEST['year'];
			$DOB=$Year."-".$Month."-".$Day;
			$Residence_Address = $_REQUEST['Residence_Address'];
			$Pincode = $_REQUEST['Pincode'];
			$Employment_Status = $_REQUEST['Employment_Status'];
			$Company_Name = $_REQUEST['Company_Name'];
			$Property_Identified = $_REQUEST['Property_Identified'];
			$Property_Loc = $_REQUEST['Property_Loc'];
			$updateProperty = $_REQUEST['updateProperty'];
			$Loan_Time = $_REQUEST['Loan_Time'];
			$Budget = $_REQUEST['Budget'];
			$Accidental_Insurance = $_REQUEST['Accidental_Insurance'];
			$RePhone = $_REQUEST['RePhone'];
			$Phone = $_REQUEST['Phone'];
			$City = $_REQUEST['City'];
			$Net_Salary = $_REQUEST['Net_Salary'];
			$Net_Salary = $_POST['Net_Salary'];
			$monthly_income = ($Net_Salary /12);
			$obligations = $_POST['obligations'];
			$co_appli = $_POST['co_appli'];
			$co_name = $_POST['co_name'];
			$dob_arr_co[] = $_POST['co_year'];
			$dob_arr_co[] = $_POST['co_month'];
			$dob_arr_co[] = $_POST['co_day'];
			$DOB_co = implode("-", $dob_arr_co);
			$co_monthly_income = $_POST['co_monthly_income'];
			$co_obligations = $_POST['co_obligations'];
			$property_value = $_POST['Property_Value'];
			$getnetAmount = ($monthly_income + $co_monthly_income);
			$total_obligation = $obligations + $co_obligations;
			$netAmount=($getnetAmount - $total_obligation);
			$currentyear=date('Y');
$age=$currentyear-$Year;



			$CheckSql = "select  Reference_Code,Name from ".$Type_Loan." where RequestID =".$ProductValue;
			list($CheckRow,$CheckQuery)=MainselectfuncNew($CheckSql,$array = array());
			$CheckQuerycontr=count($CheckQuery)-1;
			
			$CheckRef = $CheckQuery[$CheckQuerycontr]['Reference_Code'];
			$Name = $CheckQuery[$CheckQuerycontr]['Name'];
				
			$getDOB = str_replace("-","", $DOB);
			$age = DetermineAgeGETDOB($getDOB);
			//echo $age."<br>";
			$agecalc="50";
			$exactage = $agecalc- $age;
			//echo $exactage."<br>";
			//get inflation amount
			$getinflation = $Net_Salary *(5/100);
			$getinflationage = $getinflation * $exactage;
			$getexactvalue = $getinflationage + $Net_Salary;
			$getexactvaluemonthly = $getexactvalue/12;
				
			$crap = " ".$Property_Identified." ".$Property_Loc." ".$company." ".$City_Other." ".$Primary_Acc." ".$Descr." ".$Years_In_Company." ".$Total_Experience;
			//echo $crap,"<br>";
			$crapValue = validateValues($crap);
		
			//exit();
			if($crapValue=="Put")
			{
	
				
				if (($Type_Loan=="Req_Loan_Home") || ($product=="HomeLoan"))
					{
					
						$Dated = ExactServerdate();									
						getEligibleBidders("home","$City","$Mobile");
						
						$dataUpdate = array('Co_Applicant_Name'=>$co_name, 'Co_Applicant_DOB'=>$DOB_co, 'Co_Applicant_Income'=>$co_monthly_income, 'Co_Applicant_Obligation'=>$co_obligations, 'Property_Value'=>$property_value, 'Total_Obligation'=>$total_obligation, 'DOB'=>$DOB, 'Residence_Address'=>$Residence_Address, 'Pincode'=>$Pincode, 'Employment_Status'=>$Employment_Status, 'Company_Name'=>$Company_Name, 'Property_Identified'=>$Property_Identified, 'Property_Loc'=>$Property_Loc, 'Loan_Time'=>$Loan_Time, 'Is_Valid'=>$Is_Valid, 'Budget'=>$budget);
				
						$wherecondition ="(RequestID=".$ProductValue.")";
						Mainupdatefunc ('Req_Loan_Home', $dataUpdate, $wherecondition);
				
						if($Net_Salary>=200000)
						{
							$productname = "hlsalaryclause";
						}
						else
						{
						$productname = "HomeLoan";
						}

					
					}
			
				
			}//$crap Check
		else if($crapValue=='Discard')
		{
			header("Location: Redirect.php");
			exit();
		}
		else
		{
			header("Location: Redirect.php");
			exit();
		}
		
	}//$_POST
	$_SESSION['ProductValueHL'] = $ProductValue;	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Thank you Home Loan</title>
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<script type="text/javascript" src="scripts/calendardateinput.js"></script>
<script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
<link href="style/new-bima.css" rel="stylesheet"  type="text/css" />
<link href="style/glowing.css" rel="stylesheet"  type="text/css" />
<link href="style/slider.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/dropdowntabs.js"></script>
<script Type="text/javascript">
var ajaxRequest;  // The variable that makes Ajax possible!
		function ajaxFunction(){
			
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

		function taxinsertData()
		{
			var get_netSalary = document.getElementById('netSalary').value;
			var get_DOB = document.getElementById('DOB').value;
			var get_agecalc = document.getElementById('agecalc').value;
			
			
			if(get_netSalary!='')
			{
				var queryString = "?netSalary=" + get_netSalary + "&dob=" + get_DOB + "&agecalc=" + get_agecalc ;
			}
			
			//alert(queryString); 
				ajaxRequest.open("GET", "insert_pension_premimum.php" + queryString, true);
				// Create a function that will receive data sent from the server
				ajaxRequest.onreadystatechange = function(){
					if(ajaxRequest.readyState == 4)
					{
					
						var ajaxDisplay = document.getElementById('calculate');
					   ajaxDisplay.innerHTML = ajaxRequest.responseText;
					   

				
					}
				}

				ajaxRequest.send(null); 
			 
		}

		window.onload = ajaxFunction;
		</script>

</head>
<style>
.bnk_logo{
	width:105px;
	height:35px;
	padding-left:4px;
	padding-top:0px;
	*padding-top:11px;
}
</style>
<body>
<?php include '~Top-new.php';?>
<?php //include '~menu.php';?>
<div id="container">
  <div id="txt" style="padding-top:15px;">
<div style="text-align:center; font-weight:bold; line-height:18px; padding-bottom:15px;">Thanks for applying Home Loan through Deal4loans.com. You will soon receive a Call from us.<br /></div>
<?php 
	list($realbankiD,$bankID,$FinalBidder,$finalBidderName)= getBiddersList("Req_Loan_Home",$ProductValue,$strCity);
$FinalBidder=implode(',',$FinalBidder);
$realbankiD=implode(',',$realbankiD);

if(count($FinalBidder)>0)
	{
		//echo "hello1: ";
		 
	 if($City=="Others")
{
	if(strlen($Other_City)>0)
	{
		$strCity=$Other_City;
	}
	else
	{
		$strCity=$City;
	}
}
else
{
	$strCity=$City;
}?>


 <?php 
	list($realbankiD,$bankID,$FinalBidder,$finalBidderName)= getBiddersList("Req_Loan_Home",$ProductValue,$strCity);

$Final_Bid = "";
		while (list ($key,$val) = @each($bankID)) { 
			$Final_Bid[]= $val; 
		} 

   

	$FinalBidder=implode(',',$FinalBidder);
$realbankiD=implode(',',$realbankiD);

if(count($FinalBidder)>0 )
	 {

	?>
	<div style="text-align:center; font-weight:bold; line-height:18px; padding-bottom:15px;">
Following Banks are interested in your profile, will get back to you & give you the best Deal..</div>
<div align="left" style="padding-left:40px; padding-bottom:3px; padding-top:3px;">
We at deal4loans.com believe that its big financial decision that you
are about to take.<br />
To get best deal, speak to 3 - 4 banks mentioned below and then decide
upon the best deal.<br />
This will help you get best deal & save on Emi & choose best product &
best service.
</b>
</div>

	
      <table width="959" border="0" cellpadding="0" cellspacing="0" bgcolor="#dbf2ff">
        <tr>
          <td height="45" background="new-images/hl-thnk-hdr.gif" style="background-repeat:no-repeat; "><table width="100%"  border="0" cellspacing="0" cellpadding="0">
              <tr align="center">
                <td width="157" height="30"><b>Bank Name</b></td>
                <td width="204"><b>ROI</b></td>
                <td width="210"><b>EMI (Per Month)</b></td>
                <td width="63"><b>Tenure</b></td>
                <td width="96"><b>Eligible Loan Amount</b></td>
                <td width="230"><span class="fontbld10"><b>Request for more Information</b></span></td>
            </tr>
          </table></td>
        </tr>
    
          <?
for($i=0;$i<count($Final_Bid);$i++)
	{
	
		?>
          <tr>
            <td height="117" background="new-images/hl-thnk-bnkbg.gif" style="background-repeat:no-repeat; "><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                <tr align="center">
                  <?
    if($Final_Bid[$i]=="Axis Bank" || $Final_Bid[$i]=="Axis")
	{
	list($axisactualemi,$axisemi,$axisinter,$axisprint_term,$axisloan_amount,$axisviewLoanAmt,$axisperlacemi,$axisperlacemifortwo,$axisterm,$axissemi)=Axis_Homeloan($getnetAmount,$loan_amount,$age,$total_obligation,$strCity,$property_value);
		?>
	  <td height="117"  valign="middle" align="center"> <div class="bnk_logo"><img src="http://www.deal4loans.com/new-images/hl-thnk-axis.jpg" width="105" height="35" /> </div>
		  <img src="images/spacer.gif" width="154" height="1" border="0" /> </td>
	  <td><?php echo abs($axisinter); ?> %<br />
		  <img src="images/spacer.gif" width="202" height="1" border="0" /></td>
	  <td class="tbl_txt"><?php echo $axisemi; ?><br />
		  <img src="images/spacer.gif" width="212" height="1" border="0" /> </td>
	  <td><?php echo abs($axisprint_term); ?> yrs.<br />
		  <img src="images/spacer.gif" width="63" height="1" border="0" /></td>
	  <td>Rs. <?php echo abs($axisviewLoanAmt); ?><br />
		  <img src="images/spacer.gif" width="96" height="1" border="0" /></td>
	 
             <td  class="tbl_txt"> <form action="apply_hl_consent.php" method="POST" target="_blank" >
			 <input type="hidden" name="pl_requestid" value="<? echo $ProductValue; ?>" id="pl_requestid">
		    <input type="hidden" name="pl_bank_name" id="pl_bank_name" value="<? echo $Final_Bid[$i]; ?>">
			<input type="submit" style="width: 49px; height: 20px; border: 0px none ; cursor:pointer; background-image: url(http://www.deal4loans.com/new-images/apl-yelo-nxt.jpg); margin-bottom: 0px; background-repeat:no-repeat; background-color:#FFFFFF;" value=""  />
				  </form> <br /><img src="images/spacer.gif" width="226" height="1" border="0" /></td>
	  <? }
	
			elseif($Final_Bid[$i]=="ICICI" || $Final_Bid[$i]=="ICICI Bank")
	{
list($iciciactualemi,$iciciemi,$iciciinter,$iciciprint_term,$iciciloan_amount,$iciciviewLoanAmt,$iciciperlacemi,$perlacemifortwo,$iciciterm,$icicisemi)=ICICI_Homeloan($netAmount,$loan_amount,$age,$total_obligation,$strCity,$property_value); 
?>
	  <td height="117"  valign="middle" align="center"><div class="bnk_logo">
	  <img src="http://www.deal4loans.com/new-images/hl-thnk-icici.jpg" width="105" height="35" />
	  </div>
	   <img src="images/spacer.gif" width="154" height="1" border="0" /> </td>
	  <td  ><? echo $iciciinter; ?> %<br />
		  <img src="images/spacer.gif" width="202" height="1" border="0" /></td>
	  <td   class="tbl_txt"><?php echo $iciciactualemi; ?><br />
		  <img src="images/spacer.gif" width="212" height="1" border="0" /></td>
	  <td  ><?php echo abs($iciciprint_term); ?> yrs.<br />
		  <img src="images/spacer.gif" width="63" height="1" border="0" /></td>
	  <td  >Rs. <?php echo abs($iciciviewLoanAmt); ?><br />
		  <img src="images/spacer.gif" width="96" height="1" border="0" /></td>
	           <td  class="tbl_txt"> <form action="apply_hl_consent.php" method="POST" target="_blank" >
			 <input type="hidden" name="pl_requestid" value="<? echo $ProductValue; ?>" id="pl_requestid">
		    <input type="hidden" name="pl_bank_name" id="pl_bank_name" value="<? echo $Final_Bid[$i]; ?>">
			<input type="submit" style="width: 49px; height: 20px; border: 0px none ; cursor:pointer; background-image: url(http://www.deal4loans.com/new-images/apl-yelo-nxt.jpg); margin-bottom: 0px; background-repeat:no-repeat; background-color:#FFFFFF;" value=""  />
				  </form><br /> <img src="images/spacer.gif" width="226" height="1" border="0" /></td>   
                
                  <?
	
	}
	elseif($Final_Bid[$i]=="HDFC" || $Final_Bid[$i]=="HDFC Bank" || $Final_Bid[$i]=="HDFC Ltd")
	{
		list($hdfcactualemi,$hdfcemi,$hdfcinter,$hdfcprint_term,$hdfcloan_amount,$hdfcviewLoanAmt,$hdfcperlacemi,$hdfcperlacemifortwo,$hdfcterm,$hdfcsemi)=HDFC_Homeloan($getnetAmount,$loan_amount,$age,$total_obligation,$strCity,$property_value);

	?>
		 <td height="117" width="160" valign="middle" align="center"><div class="bnk_logo"><img src="http://www.deal4loans.com/new-images/thnk-hdfc-l.jpg" width="105" height="35" /></div>
	  </td>
		  <td width="210" align="left" class="colprop"><?php echo $hdfcinter; ?></td>
		  <td  width="210" align="left" class="colprop"><?php echo  $hdfcemi; ?></td>
		  <td width="60" class="colprop"><?php echo abs($hdfcprint_term); ?> yrs.</td>
		  <td width="130" class="colprop">Rs. <?php echo abs($hdfcviewLoanAmt); ?></td>
		   <td width="215" align="left" class="colprop"> <form action="apply_hl_consent.php" method="POST" target="_blank" >
			 <input type="hidden" name="pl_requestid" value="<? echo $ProductValue; ?>" id="pl_requestid">
		    <input type="hidden" name="pl_bank_name" id="pl_bank_name" value="<? echo $Final_Bid[$i]; ?>">
			<input type="submit" style="width: 49px; height: 20px; border: 0px none ; cursor:pointer; background-image: url(http://www.deal4loans.com/new-images/apl-yelo-nxt.jpg); margin-bottom: 0px; background-repeat:no-repeat; background-color:#FFFFFF;" value=""  />
				  </form></td>   
                
		  <?

	}
	elseif($Final_Bid[$i]=="First Blue Home Finance" || $Final_Bid[$i]=="First Blue" || (strncmp ("First",$Final_Bid[$i],5))==0)
	{
		if($Employment_Status==0)
		{
			list($perlacemi,$viewLoanAmt,$frstblloan_amount,$frstblinter,$frstblactualemi,$frstblterm)=firstblue_HomeloanSE($getnetAmount,$age,$total_obligation,$property_value,$Property_Identified);
		}
		else
		{
			list($perlacemi,$viewLoanAmt,$frstblloan_amount,$frstblinter,$frstblactualemi,$frstblterm)=firstblue_HomeloanSal($getnetAmount,$age,$total_obligation,$property_value,$Property_Identified);
		}
		
?>
	 <td width="145" height="50" ><img src="http://www.deal4loans.com/new-images/first-blue-logo.jpg" width="95" height="50" /></td>
	  <td width="192"  class="colprop"><?php echo $frstblinter; ?> %</td>
	  <td width="201" class="colprop" >Rs. <?php echo  $frstblactualemi; ?></td>
	  <td width="66" class="colprop"><?php echo $frstblterm; ?> yrs.</td>
	  <td width="132" class="colprop">Rs. <?php echo $frstblloan_amount; ?></td>
	   <td width="224"  class="colprop"> <form action="apply_hl_consent.php" method="POST" target="_blank" >
			 <input type="hidden" name="pl_requestid" value="<? echo $ProductValue; ?>" id="pl_requestid">
		    <input type="hidden" name="pl_bank_name" id="pl_bank_name" value="<? echo $Final_Bid[$i]; ?>">
			<input type="submit" style="width: 49px; height: 20px; border: 0px none ; cursor:pointer; background-image: url(http://www.deal4loans.com/new-images/apl-yelo-nxt.jpg); margin-bottom: 0px; background-repeat:no-repeat; background-color:#FFFFFF;" value=""  />
				  </form></td>   
                
	  <?
}
	else
	{
		if($Final_Bid[$i]=="Citibank" || $Final_Bid[$i]=="Citi Bank")
	{
		
		$bankwimg='';

	}
	elseif($Final_Bid[$i]=="DHFL")
	{
		
		$bankwimg='';
		
	}
	elseif($Final_Bid[$i]=="Standard Chartered" || (strncmp ("Standard", $Final_Bid[$i],8))==0 )
	{
		
		$bankwimg='';
		
	}
	elseif($Final_Bid[$i]=="Reliance capital" || (strncmp ("Reliance", $Final_Bid[$i],8))==0)
	{
		
		$bankwimg='';
		
	}
	elseif($Final_Bid[$i]=="ING VYSYA" || $Final_Bid[$i]=="Ing Vysya" || (strncmp ("ING", $Final_Bid[$i],3))==0)
	{
		
		$bankwimg='<div class="bnk_logo"><img src="http://www.deal4loans.com/new-images/hl-thnk-ing.jpg" width="105" height="35" /></div>';
		
	}
	elseif($Final_Bid[$i]=="India Bulls")
	{
		
		$bankwimg='';
		
	}
	elseif($Final_Bid[$i]=="Kotak Bank" || (strncmp ("Kotak", $Final_Bid[$i],5))==0)
	{
		
		$bankwimg='';
		
	}
	elseif((strncmp ("Barclays", $Final_Bid[$i],8))==0)
	{
		
		$bankwimg='';
		
	}
	elseif($Final_Bid[$i]=="Citifinancial")
	{
		
		$bankwimg='';
		
	}
	elseif($Final_Bid[$i]=="SBI")
	{
		
		$bankwimg='';
		
	}
	else
		{
			$bankwimg='<b>'.$Final_Bid[$i].'</b><br />';
		}
		?>
                  <td   height="30" valign="middle" style="padding-left:4px;"><? echo $bankwimg;?>
                      <img src="images/spacer.gif" width="154" height="1" border="0" /> </td>
                 
                
		<td colspan='5' style='font-size:12px;' align='center' bgcolor='#FFFFFF' height='100' width='802' > <form action="apply_hl_consent.php" method="POST" target="_blank" >
			 <input type="hidden" name="pl_requestid" value="<? echo $ProductValue; ?>" id="pl_requestid">
		    <input type="hidden" name="pl_bank_name" id="pl_bank_name" value="<? echo $Final_Bid[$i]; ?>">
			<input type="submit" style="width: 49px; height: 20px; border: 0px none ; cursor:pointer; background-image: url(http://www.deal4loans.com/new-images/apl-yelo-nxt.jpg); margin-bottom: 0px; background-repeat:no-repeat; background-color:#FFFFFF;" value=""  />
				  </form><br />
<img src='images/spacer.gif' width='802' height='1' border='0' /></td>
	 <?}
	?>
                </tr>
            </table></td>
          </tr>
          <? } 
		?>
          <tr>
            <td colspan="6" align="right" ><a href="http://www.deal4loans.com/rate-disclaimer.php" target="_blank">Disclaimer</a><p align="center"> 
				<span style="font-size:10px;">Advertisment</span><br />
			<script language='JavaScript' type='text/javascript' src='http://ads.deal4loans.com/adx.js'></script>
<script language='JavaScript' type='text/javascript'>
<!--
   if (!document.phpAds_used) document.phpAds_used = ',';
   phpAds_random = new String (Math.random()); phpAds_random = phpAds_random.substring(2,11);
   
   document.write ("<" + "script language='JavaScript' type='text/javascript' src='");
   document.write ("http://ads.deal4loans.com/adjs.php?n=" + phpAds_random);
   document.write ("&amp;clientid=92&amp;target=_blank");
   document.write ("&amp;exclude=" + document.phpAds_used);
   if (document.referrer)
      document.write ("&amp;referer=" + escape(document.referrer));
   document.write ("'><" + "/script>");
//-->
</script><noscript><a href='http://ads.deal4loans.com/adclick.php?n=a97316c1' target='_blank'><img src='http://ads.deal4loans.com/adview.php?clientid=92&amp;n=a97316c1' border='0' alt=''></a></noscript>
<?php
$Dated = ExactServerdate();
$dataTrack = array('RequestID'=>$ProductValue ,'PageName'=>$_SERVER['HTTP_REFERER'] ,'Dated'=>$Dated ,'Counter'=>'1');
$insert = Maininsertfunc ("trackBanner", $dataTrack);
?>
</p></td>
          </tr>
          <tr>
            <td colspan="6" align="center" bgcolor="#FFFFFF"><img src="new-images/hl-thnk-btm.jpg" width="959" height="11" /></td>
          </tr>
        
      </table>
    
	<? }
	
	 }
	 	 
	 else
	 {
		 //echo "hello2: ";
		 
		 ?>
            <div style="text-align:center; font-weight:bold; line-height:18px; padding-bottom:15px;">Thanks for applying Home Loan through Deal4loans.com.</div><p align="center"> 
				<span style="font-size:10px;">Advertisment</span><br />
			<script language='JavaScript' type='text/javascript' src='http://ads.deal4loans.com/adx.js'></script>
<script language='JavaScript' type='text/javascript'>
<!--
   if (!document.phpAds_used) document.phpAds_used = ',';
   phpAds_random = new String (Math.random()); phpAds_random = phpAds_random.substring(2,11);
   
   document.write ("<" + "script language='JavaScript' type='text/javascript' src='");
   document.write ("http://ads.deal4loans.com/adjs.php?n=" + phpAds_random);
   document.write ("&amp;clientid=92&amp;target=_blank");
   document.write ("&amp;exclude=" + document.phpAds_used);
   if (document.referrer)
      document.write ("&amp;referer=" + escape(document.referrer));
   document.write ("'><" + "/script>");
//-->
</script><noscript><a href='http://ads.deal4loans.com/adclick.php?n=a97316c1' target='_blank'><img src='http://ads.deal4loans.com/adview.php?clientid=92&amp;n=a97316c1' border='0' alt=''></a></noscript>
<?php
$Dated = ExactServerdate();
$dataTrack = array('RequestID'=>$ProductValue ,'PageName'=>$_SERVER['HTTP_REFERER'] ,'Dated'=>$Dated ,'Counter'=>'1');
$insert = Maininsertfunc ("trackBanner", $dataTrack);

?>
</p>
    <?
	 }
  

?>

</div>
      
  <? if ((($_REQUEST['flag'])!=1))
	{ ?>
  <?php include '~Bottom-new.php';?><?php } ?>
</div><!-- </div>-->
<?// }?>

<!-- Google Code for lead Conversion Page -->
<script language="JavaScript" type="text/javascript">
<!--
var google_conversion_id = 1063319470;
var google_conversion_language = "en_US";
var google_conversion_format = "1";
var google_conversion_color = "666666";
if (1) {
  var google_conversion_value = 1;
}
var google_conversion_label = "lead";
//-->
</script>
<script language="JavaScript" src="http://www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<img height=1 width=1 border=0 src="http://www.googleadservices.com/pagead/conversion/1063319470/imp.gif?value=1&label=lead&script=0">
</noscript>
</body>
</html>

