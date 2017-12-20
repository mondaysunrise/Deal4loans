<?php
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	require 'hrAppFunction.php';

	function DetermineAgeFromDOB ($YYYYMMDD_In)
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
	
			foreach($_POST as $a=>$b)
			$$a=$b;
			
	$ProductValue = $_POST['ProductValue'];	
	$Day=FixString($day);
	$Month=FixString($month);
	$Year=FixString($year);
	$DOB=$Year."-".$Month."-".$Day;
	$Net_Salary = $_POST['Net_Salary'];
	$last_id = FixString($last_id);
	$Car_Type = FixString($Car_Type);
	$Car_Insurance = FixString($Car_Insurance);
	$City = $_POST['City'];
	$City_Other = FixString($City_Other);
	$Ibibo_compaign = FixString($Ibibo_compaign);
	$Company_Name = $_POST['Company_Name'];
	$Car_Model = FixString($Car_Model);
	$Car_Varient = FixString($Car_Varient);
	$Loan_Tenure = FixString($Loan_Tenure);
	$Car_Booked = FixString($Car_Booked);
	$Loan_Amount = FixString($Loan_Amount);
	$cpp_card_protect = FixString($cpp_card_protect);
	$hdfclife = FixString($hdfclife);
	$From_Product = $_REQUEST['From_Product'];
	$Net_Salary_Monthly = $Net_Salary / 12;
	$IsPublic = 1;
	$Referrer=$_REQUEST['referrer'];
	$source=$_REQUEST['source'];
	$Reference_Code = generateNumber(4);
	$IP = getenv("REMOTE_ADDR");
	$lastInserted = $_REQUEST["ProductValue"];
	$City_Other = $_POST['City_Other'];
	
	$n       = count($From_Product);
	$i      = 0;
	//echo $n."<br>";
	   while ($i < $n)
	   {
		  $From_Pro .= "$From_Product[$i], ";
		 $i++;
	   }
		  
	$final_url=$_SERVER['HTTP_REFERER'];
	$_SESSION['final_url'] = $final_url;
	$_SESSION['Net_Salary'] = $Net_Salary;
	$_SESSION['City']= $City;
	$_SESSION['City_Other']= $City_Other;
	
	if($City=="Others")
	{
		$strcity=$City_Other;
	}
	else
	{
		$strcity=$City;
	}
	
	$Type_Loan="Req_Loan_Car";
	
	$BiddID  = array(1825);
	//echo $ProductValue."-".$strcity;
	$Bidds = getBiddersListCL(3,$ProductValue,$strcity,$BiddID);
//	print_r($Bidds);	
	$strFinalBidders = implode(",", $Bidds[0]);


	//$InsertProductSql = "Update Req_Loan_Car Set City_Other = '$City_Other' , Loan_Amount = '$Loan_Amount', DOB = '$DOB', Pincode = '$Pincode', Car_Type ='$Car_Type', Car_Model = '$Car_Model', Car_Booked='".$Car_Booked."', Company_Name = '".$Company_Name."', Bidderid_Details='".$strFinalBidders."' Where RequestID =".$lastInserted;
	//$InsertProductQuery = ExecQuery($InsertProductSql);
	$DataArray = array("City_Other" => $City_Other, "Loan_Amount" => $Loan_Amount, "DOB" =>$DOB, "Pincode" => $Pincode, "Car_Type" =>$Car_Type, "Car_Model" => $Car_Model, "Car_Booked"=>$Car_Booked, "Company_Name" =>$Company_Name, "Bidderid_Details"=>$strFinalBidders);
$wherecondition ="RequestID =".$lastInserted;
Mainupdatefunc ('Req_Loan_Car', $DataArray, $wherecondition);
	
//echo $InsertProductSql;	

	$getDetailsSql = "select * from Req_Loan_Car where RequestID =".$lastInserted;
	list($GetnumVal,$row)=Mainselectfunc($getDetailsSql,$array = array());

	$Name = $row['Name'];
	$Phone = $row['Mobile_Number'];
	$client_transaction_id = $lastInserted."_CL";	
	$zipdimage = mobile_verify($Phone,$client_transaction_id);
	$BiddID  = array(1825);
	//echo $ProductValue."-".$strcity;
	$Bidds = getBiddersListCL(3,$ProductValue,$strcity,$BiddID);
//	print_r($Bidds);	
	$strFinalBidders = implode(",", $Bidds[0]);
	//$InsertProductSql = "Update Req_Loan_Car Set Bidderid_Details='".$strFinalBidders."' Where RequestID =".$lastInserted;
//	$InsertProductQuery = ExecQuery($InsertProductSql);
	
	$DataArray = array("Bidderid_Details" => $strFinalBidders);
$wherecondition ="RequestID =".$lastInserted;
Mainupdatefunc ('Req_Loan_Car', $DataArray, $wherecondition);

			
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Car Loan</title>
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<script type="text/javascript" src="scripts/mootools.js"></script>
<script type="text/javascript" src="scripts/common.js"></script>
<script type="text/javascript" src="scripts/jquery.js"></script>
<link href="source.css" rel="stylesheet"  type="text/css" />
<style type="text/css">
body{
	margin:0px;
	padding:0px;
	font-family:Verdana, Arial, Helvetica, sans-serif;
	font-size:11px;
	line-height:16px;
	color:#292323;

}

input{
	margin:0px;
	padding:0px;
	border:1px solid #878787;
}

select{
	margin:0px;
	padding:0px;
	border:1px solid #878787;

}

.bldtxt{
font-weight:bold;
line-height:16px;
color:#4f4d4d;
}

form{
		display:inline;
		margin:0px;
		padding:0px;
}
	
</style>
<script>
function onclick_proceedVal()
{
	jQuery.post(
		"VerifyZipDial.php",
		{get_RequestID: document.getElementById('RequestID').value , get_proid: 3},

		function(data)
		{
			//alert(data);
			if(data=="yes")
			{
				window.open("thankyou_cl.php","_self");
			}
			else
			{
//				window.open("thankyou_cl.php","_self");
				alert("We haven't yet received your call,Please wait for 10 seconds and try again.");
			}
		}
	);
}
</script>
</head>
<body>
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td style="padding-left:40px;" >
<div id="logo_sml">
	<img src="new-images/d4l-sml-logo.gif" alt="Deal4loans"  onclick="javascript:location.href='http://www.deal4loans.com/'"/>
</div>
</td></tr>
<tr><td>
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><table width="100%"  border="0" cellspacing="0" cellpadding="0">
	
	  <tr>
	   <td align="center" >&nbsp;</td>            
      </tr>
	 	   <tr>
	   <td align="center" >&nbsp;</td>            
      </tr>
	    <tr>
	   <td align="center" >&nbsp;</td>            
      </tr>
	
    </table></td>
  </tr>
  <tr>
    <td valign="top" style="padding-top:8px; "><table width="940"  border="0" align="center" cellpadding="4" cellspacing="4" class="brdr5">
	
      <tr>
     <td>
         <input type="hidden" name="RequestID" id="RequestID"  value="<? echo $lastInserted; ?>" >
	 <input type="hidden" name="source" value="<? echo $retrivesource; ?>">     
       <table width="100%"  border="0" cellspacing="0" cellpadding="0">
	   <tr>
        <td style=" padding:12px;" colspan="2"><table width="539" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="489" height="30"  bgcolor="#FFFFFF" class="frmbldtxt" align="center"><h1 style="margin:0px; padding:0px; text-align:center;"> Car Loan Application</h1></td>
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
    </table></td>
  </tr>
</table>
</td></tr></table>
</body>
</html>