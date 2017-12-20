<?php
ob_start();
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	require 'eligiblebidderfuncCL.php';
	session_start();

	if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		foreach($_POST as $a=>$b)
			$$a=$b;
			
		$inst_req = FixString($inst_req);
		$Name = FixString($Name);
		$Day=FixString($day);
		$Month=FixString($month);
		$Year=FixString($year);
		$DOB=$Year."-".$Month."-".$Day;
		$Phone = FixString($Phone);
		$Email = FixString($Email);
		$City = FixString($City);
		$Car_Type = FixString($Car_Type);
		$Employment_Status = FixString($Employment_Status);
		$City_Other = FixString($City_Other);
		$Net_Salary = FixString($Net_Salary);
		$Car_Model = FixString($Car_Model);
		$Car_Varient = FixString($Car_Varient);
		$Car_Booked = FixString($Car_Booked);
		$Loan_Amount = FixString($Loan_Amount);
		$hdfclife = FixString($hdfclife);
		$source = FixString($source);
		$Net_Salary_Monthly = $Net_Salary / 12;
		$IsPublic = 1;
		$Referrer=FixString($referrer);
		$source=FixString($source);
		$Dated=ExactServerdate();
		$IP = getenv("REMOTE_ADDR");
				
		$n       = count($From_Product);
		$i      = 0;
		//echo $n."<br>";
		   while ($i < $n)
		   {
			  $From_Pro .= "$From_Product[$i], ";
			 $i++;
		   }
		  
$final_url=FixString($HTTP_REFERER);
$_SESSION['final_url'] = $final_url;
$_SESSION['Net_Salary'] = $Net_Salary;
$_SESSION['City']= $City;
$_SESSION['City_Other']= $City_Other;
$QArequestid = $_SESSION['Temp_Last_Inserted'];

$Type_Loan="Req_Loan_Car";

		$crap = " ".$Name." ".$Email;
		$crapValue = validateValues($crap);
		$_SESSION['crapValue'] = $crapValue;
		$validMobile = is_numeric($Phone);
		$validYear  = is_numeric($Year);
		$validMonth = is_numeric($Month);
		$validDay = is_numeric($Day);
			
if(($validMobile==1) && ($validMonth==1) && ($validDay==1) && ($validYear==1) && ($Name!=""))
{
	$wherecondition="RequestID =".$inst_req;
	$DataArray = array("Employment_Status" => $Employment_Status, "City" => $City, "City_Other" => $City_Other, "Loan_Amount" => $Loan_Amount, "IP_Address" => $IP, "DOB" => $DOB, "Car_Booked" => $Car_Booked, "Dated" => $Dated);

	Mainupdatefunc ('Req_Loan_Car', $DataArray, $wherecondition);
	
	 $lastInserted = $inst_req;
	$_SESSION['Temp_LID'] = $lastInserted;
	$client_transaction_id = $lastInserted."_CL";

	$zipdimage = mobile_verify($Phone,$client_transaction_id);
			
		if($City=="Others")
		{
			$strCity = $City_Other;
		}
		else
		{
			$strCity = $City;
		}

			if($lastInserted>0)
		{
			list($FinalBidder,$finalBidderName)= getBiddersList("Req_Loan_Car",$lastInserted,$strCity);
			//print_r($FinalBidder);
//echo "<br>";
			//print_r($finalBidderName);


		}
			
	
		if($hdfclife==1)
		{
			$Product=3;
			Insert_HdfcLife($Name, $strCity, $Phone, $DOB, $Email, $Net_Salary, $Product, $ProductValue );
		}

			list($First,$Last) = split('[ ]', $Name);
					
			//Code Added to mailtocommonscript.php
			$FName = $Name;
			$Checktosend="getthank_individual";
			include "scripts/mailatcommonscript.php";

			$headers  = 'From: Deal4loans <no-reply@deal4loans.com>' . "\r\n";
			$headers .= "Return-Path: <no-reply@deal4loans.com>\r\n";  // Return path for errors
			$headers .= "Bcc: testthankuse@gmail.com"."\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			
			if($Name)
				$SubjectLine = $Name.", Learn to get Best Deal on Car Loan";
			else
				$SubjectLine = "Learn to get Best Deal on Car Loan";
			//echo $Type_Loan;
			if(isset($Type_Loan))
			{
				mail($Email, $SubjectLine, $Message2, $headers);
			}
		
	if(count($finalBidderName)==0)
		{
		if(strlen($Email)>0)
			{
			$Message="<table width='700' border='0' align='center' cellpadding='0' cellspacing='0' style='border:1px ridge #0099FF;'><tr><td><table width='100%' border='0' cellspacing='0' cellpadding='0'><tr><td width='40%' valign='top'> <tr>    <td><table width='100%' border='0' cellspacing='0' cellpadding='0'> <tr>     <td width='40%' valign='top'></td>        <td width='60%' align='right' style='padding-top:5px;'><img src='http://www.deal4loans.com/images/cc/crdt-crd-logo.gif'  /><br />          <span style='font-family: Verdana, Arial, Helvetica, sans-serif;	font-size: 10px;	color:#0A71D9;'>Loans by Choice not by Chance!</span></td>      </tr>    </table></td>  </tr></table></td></tr><tr><td style=' font-family:Verdana; font-size:12px; color:#333333; padding-top:20px; padding-left:10px; padding-right:10px;'><b>Dear $Name,</b><p>As per your profile, no bank is associated with us to serve your <b>Car loan</b> requirement. We will not be able to service your request and hence we are not sharing your details with any bank.</p><p>&nbsp; <br />
  Regards</p>
Team Deal4loans.com <br /><br /></td></tr><tr><td style=' font-family:Verdana; font-size:12px; color:#ffffff;  padding-left:10px; padding-right:10px; background-color:#248ACA; border-top:1px solid  #0099CC;'><table width='100%' border='0' cellspacing='0' cellpadding='0'><tr><td align='center' valign='middle'><a href='http://www.deal4loans.com/Contents_Blogs.php?source=d4l-noteligi' style=' font-family:Verdana; font-size:12px; color:#ffffff;'>Blogs</a> </td><td align='center' valign='middle'> <a href='http://www.deal4loans.com/quiz.php?source=d4l-noteligi' style=' font-family:Verdana; font-size:12px; color:#ffffff;'>Loan Quiz</a></td><td align='center' valign='middle'> <a href='http://www.deal4loans.com/debt-consolidation-plans.php?source=d4l-noteligi' style=' font-family:Verdana; font-size:12px; color:#ffffff;'>Loan Guru </a></td><td align='center' valign='middle'> <a href='http://www.deal4loans.in?source=d4l-noteligi' style=' font-family:Verdana; font-size:12px; color:#ffffff;'>Deal4loans.in </a></td><td height='25' align='center' valign='middle'> <a href='http://www.bimadeals.com?source=d4l-noteligi' style=' font-family:Verdana; font-size:12px; color:#ffffff;'>Bimadeals.com </a></td><td align='center' valign='middle'> <a href='http://www.askamitoj.com?source=d4l-noteligi' style=' font-family:Verdana; font-size:12px; color:#ffffff;'>Askamitoj.com</a> </td></tr></table></td></tr></table>
";
		$headers  = 'From: Deal4loans <no-reply@deal4loans.com>' . "\r\n";
$headers .= "Return-Path: <no-reply@deal4loans.com>\r\n";  // Return path for errors
$headers .= "Bcc: testthankuse@gmail.com"."\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
//mail($Email,'Thanks for Registering for Car Loan on deal4loans.com', $Message, $headers);
			}

			header("Location: thank_cl.php");
			exit();
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

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Car Loans | Apply Car Loans online | Compare Car Loans</title>
<meta name="keywords" content="apply car loan, car loans online, apply online car loans, Car Motor loans India, Apply Car Motor Loans, Compare Car Loans in Mumbai Hyderabad Pune kolkata Delhi Noida Bangalore">
<meta name="description" content="Car Loans – Compare and Choose Best car loans schemes from all loan provider banks of India."><link href="style/new-bima.css" rel="stylesheet"  type="text/css" />
<link href="style/glowing.css" rel="stylesheet"  type="text/css" />
<link href="css/slider.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/dropdowntabs.js"></script>
<script type="text/javascript" src="scripts/common.js"></script>
<script type="text/javascript" src="scripts/jquery.js"></script>
<Script Language="JavaScript">


function onclick_proceedVal()
    {
          jQuery.post(
                    "VerifyZipDial.php",

                    {get_RequestID: document.getElementById('RequestID').value , get_proid: 3},

                    function(data){
						//alert(data);
						if(data=="yes")
						{
								window.open("thank_cl.php","_self");
						}
						else
						{
							alert("We haven't yet received your call,Please wait for 10 seconds and try again.");
						}
   
 }
        );
    }


</script>
</head>
<body>
<?php include '~Top-new.php';?>
<?php include '~menu.php';?>
 
<div id="container"  >  
   <span><a href="index.php">Home</a> > <a href="car-loans.php">Car Loan</a> > Apply Car Loan</span>
  <div style="padding-top:15px; ">

          
<table width="100%"  border="0" align="center" cellpadding="0" cellspacing="0" class="brdr5">
	
      <tr>
     <td>
      <? if($source=="CLQuickapply")
	  {$lastInserted = $QArequestid; }?>
         <input type="hidden" name="RequestID" id="RequestID"  value="<? echo $lastInserted; ?>" >
	 <input type="hidden" name="source" value="<? echo $retrivesource; ?>">     
       <table width="100%"  border="0" cellspacing="0" cellpadding="0">
	   <tr>
        <td style=" padding:12px;" colspan="2"><table width="539" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="489" height="30"  bgcolor="#FFFFFF" class="frmbldtxt" ><h1 style="margin:0px; padding:0px;"> Car Loan Application</h1></td>
  </tr>
</table></td>
 </tr>
                   <tr valign="middle">
                     <td height="28" class="frmbldtxt" style="padding-top:3px; ">Dear <?php echo $Name ; ?>, </td>
                     
                     <td width="24%" height="28" class="frmbldtxt"  style="padding-top:3px; ">&nbsp;</td>
                   </tr>
                     <tr valign="middle">
                     <td height="28" colspan="2" class="frmbldtxt" style="padding-top:3px; font-weight:normal; " align="center">To get quotes and Compare offers from all Banks and <span style="color: #D02037;"> Save Upto Rs. 25000* by comparison on your EMI</span>. Please verify your Mobile Number.
	</td>                   
                     </tr>
  <tr><td colspan="2" style="color: #D02037; font-size:12px;" height="20" align="center"><b>To Verify, Please Initiate A Miss Call From your Mobile "<span style="color:#000000;" ><? echo $Phone; ?></span>" , To The Below Mentioned TOLL-FREE Number</b></td></tr>
                   <tr><td colspan="2" align="center"><img src="<? echo $zipdimage; ?>" /></td></tr>
				    <tr><td style="color: #D02037; font-size:12px; padding-left:250px;" height="30" align="center">Will auto disconnect after 1 ring </td><td colspan="3"><input name="submit" type="button" style="width:240px; background-color: #D02037; color:#FFFFFF; font-weight:700" value="Click After 10 secs of Missed Call" onclick="onclick_proceedVal();"/></td></tr>
                 </table>
        </td>
      </tr>
       <tr>
            <td  height="25" align="center" class="frmbldtxt"  style="font-weight:normal;" colspan="2" >
			1) Get call back assistance on <span style="color: #D02037;">verified mobile number</span> directly from all the comparable banks within 24 hours. <br />
2) Compare EMI and <span style="color: #D02037;">save Upto Rs. 25000 on interest</span> .<br />
3) Provides you with the best suitable offers.<br /> 
4) Help in processing your loan faster.         </td>
           
          </tr>
		   <tr><td>&nbsp;</td></tr>
		 
       <tr><td>&nbsp;</td></tr>
	   
    </table>

   </div>
  <? if ((($_REQUEST['flag'])!=1))
	{ ?>
  <?php include '~Bottom-new.php';?> <? } ?>
</div>
</body>
</html>
