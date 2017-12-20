<? 
require 'scripts/db_init.php';
require 'eligiblebidderfuncPL.php';
require 'scripts/pl_interest_rate_view.php';
require 'scripts/personal_loan_eligibility_function_form.php';

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

if ($_SERVER['REQUEST_METHOD'] == 'POST'){

	$Mobile_Number = $_POST["Mobile_Number"];
	$source = $_POST["source"];
	$Name = $_POST["Name"];
	$Employment_Status = $_POST["Employment_Status"];
	$City = $_POST["City"];
	$City_Other = $_POST["City_Other"];
	$Company_Name = $_POST["Company_Name"];
	$Email = $_POST["Email"];
	$IncomeAmount = $_POST["IncomeAmount"];
	$Annual_Turnover = $_POST["Annual_Turnover"];
	$CC_Holder = $_POST["CC_Holder"];
	$Card_Vintage = $_POST["Card_Vintage"];
	$Primary_Acc = $_POST["Primary_Acc"];
	$Years_In_Company = $_POST["Years_In_Company"];
	$Total_Experience = $_POST["Total_Experience"];
	$Day = $_POST["day"];
	$Month = $_POST["month"];
	$Year = $_POST["year"];
	$DOB=$Year."-".$Month."-".$Day;
	$age = str_replace("-","", $DOB);
$getDOB = DetermineAgeGETDOB($age);
	$Loan_Any = $_REQUEST['Loan_Any'];
	$EMI_Paid = $_POST["EMI_Paid"];
	$Loan_Amount =100000;
	$nn = count($Loan_Any);
	$ii  = 0;
	while ($ii < $nn)
	{
	$Loan_A .= "$Loan_Any[$ii], ";
	$ii++;
	}
	$IP = getenv("REMOTE_ADDR");

	
$CheckSql = "select UserID from wUsers where Email = '".$Email."'";
			list($alreadyExist,$myrow)=MainselectfuncNew($CheckSql,$array = array());
			$myrowcontr=count($myrow)-1;
			$CheckNumRows = $alreadyExist;
			$Dated = ExactServerdate();
			if($CheckNumRows>0)
			{
				$UserID = $myrow[$myrowcontr]["UserID"];
				$dataInsert = array('UserID'=>$UserID, 'Name'=>$Name, 'Email'=>$Email, 'Employment_Status'=>$Employment_Status, 'Company_Name'=>$Company_Name, 'City'=>$City, 'City_Other'=>$City_Other, 'Mobile_Number'=>$Phone, 'Net_Salary'=>$Net_Salary, 'CC_Holder'=>$CC_Holder, 'Loan_Amount'=>'100000', 'DOB'=>$DOB, 'Dated'=>$Dated, 'source'=>$source, 'Card_Vintage'=>$Card_Vintage, 'Updated_Date'=>$Dated, 'IP_Address'=>$IP, 'EMI_Paid'=>$EMI_Paid, 'Primary_Acc'=>$Primary_Acc, 'Annual_Turnover'=>$Annual_Turnover, 'Years_In_Company'=>$Years_In_Company, 'Loan_Any'=>$Loan_A, 'Total_Experience'=>$Total_Experience);
			//	echo "<br>if".$InsertProductSql;
			}
			else
			{
				$wUsersdata = array("Email"=>$Email, "FName"=>$Name, "Phone"=>$Phone, "Join_Date"=>$Dated, "IsPublic"=>$IsPublic);
				$UserID = Maininsertfunc("wUsers", $wUsersdata);
				$dataInsert = array('UserID'=>$UserID, 'Name'=>$Name, 'Email'=>$Email, 'Employment_Status'=>$Employment_Status, 'Company_Name'=>$Company_Name, 'City'=>$City, 'City_Other'=>$City_Other, 'Mobile_Number'=>$Phone, 'Net_Salary'=>$Net_Salary, 'CC_Holder'=>$CC_Holder, 'Loan_Amount'=>'100000', 'DOB'=>$DOB, 'Dated'=>$Dated, 'source'=>$source, 'Card_Vintage'=>$Card_Vintage, 'Updated_Date'=>$Dated, 'IP_Address'=>$IP, 'EMI_Paid'=>$EMI_Paid, 'Primary_Acc'=>$Primary_Acc, 'Annual_Turnover'=>$Annual_Turnover, 'Years_In_Company'=>$Years_In_Company, 'Loan_Any'=>$Loan_A, 'Total_Experience'=>$Total_Experience);
				//echo "<br>else".$InsertProductSql;
			}
			$ProductValue = Maininsertfunc ('Req_Loan_Personal', $dataInsert);
			
		if($City=="Others")
		{
			$strcity = $City_Other;
		}
		else
		{
			$strcity=$City;
		}
$Type_Loan="Req_Loan_Personal";
		//Code Added to mailtocommonscript.php
			$FName = $Name;
			$Net_Salary = $IncomeAmount; 
			$Phone = $Mobile_Number;
			$Checktosend="getthank_individual";
			include "scripts/mailtocommonproduct.php";

			$SubjectLine = $Name.", Learn to get Best Deal on Personal Loan";
	
	$headers = "From: deal4loans <no-reply@deal4loans.com>";
		 $semi_rand = md5( time() ); 
        $mime_boundary = "==Multipart_Boundary_x{$semi_rand}x"; 
         $headers .= "\nMIME-Version: 1.0\n" . 
                    "Content-Type: multipart/mixed;\n" . 
                    " boundary=\"{$mime_boundary}\""."\n";
		$headers .= "Bcc: testthankuse@gmail.com"."\n";
	    $message = "This is a multi-part message in MIME format.\n\n" . 
                "--{$mime_boundary}\n" . 
                "Content-Type: text/html; charset=\"iso-8859-1\"\n" . 
                "Content-Transfer-Encoding: 7bit\n\n" . 
                $Message2 . "\n\n";
//	cho $Message2."<br>";
				//echo $Type_Loan;
			if(isset($Email))
			{
				mail($Email, $SubjectLine, $message, $headers);
			}

$icici_bankcmp="";
$stanc_account="";
$ingvyasyacategory="";
$bajajfinservcategory="";
$hdbfscategorycmp="";
$hdfccategory="";
$standard_charteredcategory="";
$bajajfinserv="";
$Indusind="";
$citicategorycmp="";
$stanc_category="";
$getcompany='select * from pl_company_list where ((company_name="'.$Company_Name.'"))';
//$getcompany."<br>";
list($recordcount,$grow)=MainselectfuncNew($getcompany,$array = array());
$growcontr=count($grow)-1;
$hdfccategory= $grow[$growcontr]["hdfc_bank"];
$fullertoncategory= $grow[$growcontr]["fullerton"];
$bajajfinservcategory= $grow[$growcontr]["bajajfinserv"];
$citicategorycmp= $grow[$growcontr]["citibank"];
$hdbfscategorycmp = $grow[$growcontr]["hdbfs"];
$icici_bankcmp = $grow[$growcontr]["icici_bank"];
$ingvyasyacategory = $grow[$growcontr]["ingvyasya"];
$kotakcategory = $grow[$growcontr]["kotak"];
$stanc_category= $grow[$growcontr]["standard_chartered"];
$bajajfinserv = $grow[$growcontr]["bajajfinserv"];
$Indusind = $grow[$growcontr]["Indusind"];
if(($Primary_Acc=="Citibank" || $Primary_Acc=="citibank" || $Primary_Acc=="Citi Bank") || (strlen($citicategorycmp)>2))
{
	$citicategory= "Done";
	$citicategory_n= "Done";
}
else
{
	$citicategory= "";
	$citicategory_n="";
}
//echo $citicategory."<br>";
$barclayscategory= $grow[$growcontr]["barclays"];

if($Primary_Acc=="Standard Chartered")
{
	$standard_charteredcategory= "Done";
	$stanc_account="Done";
}
else
{
$standard_charteredcategory = $stanc_category;
	$stanc_account="";
}

$monthsalary = $IncomeAmount/12;

}

if($City=="Others" || $City=="Please Select")
{
	$City=$City_Other;
}
else
{
	$City= $City;
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>
<body>
<form method="post" name="incoming_form2" action="leadentry_pl_thank_final.php">
<input type="hidden" name="leadid" id="leadid" value="<? echo $ProductValue; ?>"/>
<table cellpadding="6" cellspacing="0" border="1" align="center">
<tr><td class="fontstyle"><b>Eligible for Bidders</b></td><? if(strlen($Bidderid_Details)>0){?><td class="fontstyle" colspan="2"> already send</td><? } else {?><td colspan="2"><div id="checkdiv" name="checkdiv"><table cellpadding="5" border="1"><tr><td>Bank Name</td><td align='center'>Contact</td><td>Submit</td><td align='center'>Missed Call</td></tr><? list($FinalBidder,$finalBidderName)= getBiddersList("Req_Loan_Personal",$ProductValue,$City,$Referral_Flag,$source);
   for($i=0;$i<count($FinalBidder);$i++)
			{
	   
	  //3994,3995,3996,3997,3998,3999,4030,4031,2927,4035,4036,2930
	   //echo $FinalBidder[$i]."<br>";

	   if((($FinalBidder[$i]==2490 || $FinalBidder[$i]==4018 || $FinalBidder[$i]==2496 || $FinalBidder[$i]==4019 || $FinalBidder[$i]==2497 || $FinalBidder[$i]==4020 || $FinalBidder[$i]==2498 || $FinalBidder[$i]==2499 || $FinalBidder[$i]==4342 || $FinalBidder[$i]==2500 || $FinalBidder[$i]==2813 || $FinalBidder[$i]==2887 || $FinalBidder[$i]==3894 || $FinalBidder[$i]==4302 || $FinalBidder[$i]==4309))  && ($ingvyasyacategory==""))
	   {	
		  
		}
		elseif(($ingvyasyacategory=='' && $FinalBidder[$i]==4447 && $Company_Type!=2) && (strlen($ingvyasyacategory)>0 && $FinalBidder[$i]==4447))
			{
			}
		elseif(($FinalBidder[$i]==3994 || $FinalBidder[$i]==3995 || $FinalBidder[$i]==3996 || $FinalBidder[$i]==3997 || $FinalBidder[$i]==3998 || $FinalBidder[$i]==3999 || $FinalBidder[$i]==4030 || $FinalBidder[$i]==4031 || $FinalBidder[$i]==2927 || $FinalBidder[$i]==4035 || $FinalBidder[$i]==4036 || $FinalBidder[$i]==2930 || $FinalBidder[$i]==4336 || $FinalBidder[$i]==4337 || $FinalBidder[$i]==4338 || $FinalBidder[$i]==4339 || $FinalBidder[$i]==4382 || $FinalBidder[$i]==4381) && (($icici_bankcmp=='') && $Net_Salary<480000))
				{
				}
		elseif(($FinalBidder[$i]==4083 || $FinalBidder[$i]==4084 || $FinalBidder[$i]==4085 || $FinalBidder[$i]==4086 || $FinalBidder[$i]==4087 || $FinalBidder[$i]==4088 || $FinalBidder[$i]==4089 || $FinalBidder[$i]==4090 || $FinalBidder[$i]==4091 || $FinalBidder[$i]==4092) && (($Indusind=='') && $Net_Salary<480000))
				{
				}
	  else if((($FinalBidder[$i]==2896 || $FinalBidder[$i]==2923 || $FinalBidder[$i]==2925 || $FinalBidder[$i]==2926 || $FinalBidder[$i]==3254 || $FinalBidder[$i]==3255 || $FinalBidder[$i]==3256 || $FinalBidder[$i]==2929 || $FinalBidder[$i]==3258 || $FinalBidder[$i]==2983 ||  $FinalBidder[$i]==2931 || $FinalBidder[$i]==2932 || $FinalBidder[$i]==2933 || $FinalBidder[$i]==3259 || $FinalBidder[$i]==3061 || $FinalBidder[$i]==3075 || $FinalBidder[$i]==3076 ||  $FinalBidder[$i]==3134 || $FinalBidder[$i]==3195 || $FinalBidder[$i]==3196 || $FinalBidder[$i]==3198 || $FinalBidder[$i]==3199 || $FinalBidder[$i]==3216 || $FinalBidder[$i]==2919 || $FinalBidder[$i]==3241 || $FinalBidder[$i]==2963 || $FinalBidder[$i]==3371 || $FinalBidder[$i]==3380 || $FinalBidder[$i]==3382 || $FinalBidder[$i]==3383 || $FinalBidder[$i]==2996 || $FinalBidder[$i]==3449 || $FinalBidder[$i]==3450 || $FinalBidder[$i]==3451 || $FinalBidder[$i]==3452 ||  $FinalBidder[$i]==3537 || $FinalBidder[$i]==3553 || $FinalBidder[$i]==3554 || $FinalBidder[$i]==3576 || $FinalBidder[$i]==3581 || $FinalBidder[$i]==3595 || $FinalBidder[$i]==3658 || $FinalBidder[$i]==3753 || $FinalBidder[$i]==3754  || $FinalBidder[$i]==4242 ) && (($icici_bankcmp=='' && $Net_Salary<360000 && ((strncmp("ICICI", $Primary_Acc,5))==0)) || ($icici_bankcmp=='' && ((strncmp("ICICI", $Primary_Acc,5))!=0) && $Net_Salary<480000))) 
|| 
((($icici_bankcmp=="Preferred" && ((strncmp("ICICI", $Primary_Acc,5))!=0) && $Net_Salary<360000) || ($icici_bankcmp=="Preferred" && ((strncmp("ICICI", $Primary_Acc,5))==0) && $Net_Salary<300000)) && ($FinalBidder[$i]==2896 || $FinalBidder[$i]==2923 || $FinalBidder[$i]==2925 || $FinalBidder[$i]==2926 || $FinalBidder[$i]==3254 || $FinalBidder[$i]==3255 || $FinalBidder[$i]==3256 || $FinalBidder[$i]==2929 || $FinalBidder[$i]==3258 || $FinalBidder[$i]==2983 || $FinalBidder[$i]==2931 || $FinalBidder[$i]==2932 || $FinalBidder[$i]==2933 || $FinalBidder[$i]==3259 ||  $FinalBidder[$i]==3061 || $FinalBidder[$i]==3075 || $FinalBidder[$i]==3076 || $FinalBidder[$i]==3134 || $FinalBidder[$i]==3195  ||  $FinalBidder[$i]==3198 || $FinalBidder[$i]==3199 || $FinalBidder[$i]==3216 || $FinalBidder[$i]==3241 ||  $FinalBidder[$i]==2919 ||  $FinalBidder[$i]==2963 || $FinalBidder[$i]==3371 ||   $FinalBidder[$i]==3382 || $FinalBidder[$i]==3383 || $FinalBidder[$i]==2996 || $FinalBidder[$i]==3449 || $FinalBidder[$i]==3450 || $FinalBidder[$i]==3451 || $FinalBidder[$i]==3452   || $FinalBidder[$i]==3537 || $FinalBidder[$i]==3553 || $FinalBidder[$i]==3554 || $FinalBidder[$i]==3576 || $FinalBidder[$i]==3581 || $FinalBidder[$i]==3595 || $FinalBidder[$i]==3658 || $FinalBidder[$i]==3753 || $FinalBidder[$i]==3754  || $FinalBidder[$i]==4242)))
		{
		}
elseif ((($icici_bankcmp=="Preferred" && ($Net_Salary<360000)) || ($icici_bankcmp=="" && ((strncmp("ICICI", $Primary_Acc,5))!=0) && $Net_Salary<480000) || ($icici_bankcmp=="" && ((strncmp("ICICI", $Primary_Acc,5))==0) && $Net_Salary<360000)) && $FinalBidder[$i]==4387)
				{
				}
		elseif((($icici_bankcmp=="Preferred" && ($Net_Salary<360000)) || ($icici_bankcmp=="" && $Net_Salary<360000)) && $FinalBidder[$i]==4393)
				{
				}
	elseif(($FinalBidder[$i]==2962 || $FinalBidder[$i]==3945 || $FinalBidder[$i]==3133 || $FinalBidder[$i]==3944 || $FinalBidder[$i]==3132 || $FinalBidder[$i]==2995 || $FinalBidder[$i]==2917 || $FinalBidder[$i]==3381 || $FinalBidder[$i]==4156 || $FinalBidder[$i]==4398 || $FinalBidder[$i]==4399 || $FinalBidder[$i]==4461 || $FinalBidder[$i]==4460 || $FinalBidder[$i]==3380 || $FinalBidder[$i]==4459 || $FinalBidder[$i]==3868 || $FinalBidder[$i]==2984 || $FinalBidder[$i]==3532 || $FinalBidder[$i]==3533 ||  $FinalBidder[$i]==3196 ||  $FinalBidder[$i]==4353 ||  $FinalBidder[$i]==4388) && ((strncmp("ICICI", $Primary_Acc,5))!=0 && ($icici_bankcmp=="" && $Net_Salary<360000)))
			{
			}
		else if((($FinalBidder[$i]==2934) && (($icici_bankcmp=='' && $Net_Salary<300000 && ((strncmp("ICICI", $Primary_Acc,5))==0)) || ($icici_bankcmp=='' && ((strncmp("ICICI", $Primary_Acc,5))!=0) && $Net_Salary<360000))) 
|| 
((($icici_bankcmp=="Preferred" && ((strncmp("ICICI", $Primary_Acc,5))!=0) && $Net_Salary<360000) || ($icici_bankcmp=="Preferred" && ((strncmp("ICICI", $Primary_Acc,5))==0) && $Net_Salary<300000)) && ($FinalBidder[$i]==2934)))
				{

				}
else if((($FinalBidder[$i]==3197 || $FinalBidder[$i]==3257) && (($icici_bankcmp=='' && $Net_Salary<360000 && ((strncmp("ICICI", $Primary_Acc,5))==0)) || ($icici_bankcmp=='' && ((strncmp("ICICI", $Primary_Acc,5))!=0) && $Net_Salary<420000))) 
|| 
((($icici_bankcmp=="Preferred" && ((strncmp("ICICI", $Primary_Acc,5))!=0) && $Net_Salary<360000) || ($icici_bankcmp=="Preferred" && ((strncmp("ICICI", $Primary_Acc,5))==0) && $Net_Salary<300000)) && ($FinalBidder[$i]==3197 || $FinalBidder[$i]==3257 || $FinalBidder[$i]==3407)))
		{
		}
	   else if(($FinalBidder[$i]==1632 || $FinalBidder[$i]==1633 || $FinalBidder[$i]==1634 || $FinalBidder[$i]==1635 || $FinalBidder[$i]==1636 || $FinalBidder[$i]==1646 || $FinalBidder[$i]==1759  || $FinalBidder[$i]==2020 || $FinalBidder[$i]==2021) && ($standard_charteredcategory=='' && $Employment_Status ==0 && $Net_Salary<600000))
				{
					// echo "3: ".$FinalBidder[$i]."<br>";
				}
				else if(($FinalBidder[$i]==3301 || $FinalBidder[$i]==3302 || $FinalBidder[$i]==3303) && (strlen($stanc_category)<1 && (strlen($stanc_account)<1) && $Net_Salary<600000) )
				{
				}
				else if (($FinalBidder[$i]==3301 || $FinalBidder[$i]==3302 || $FinalBidder[$i]==3303) && ((strlen($stanc_account)>1) && (strlen($stanc_category)<1) && $Net_Salary<192000))
				{
					
				}
				else if (($FinalBidder[$i]==3301 || $FinalBidder[$i]==3302 || $FinalBidder[$i]==3303) && (strlen($stanc_category)>1 && $Net_Salary<325000)) 
				{
				}
				else if(($FinalBidder[$i]==2781 || $FinalBidder[$i]==2780 || $FinalBidder[$i]==3136 || $FinalBidder[$i]==2764) && (($Net_Salary>600000 && $stanc_category!="") || ($Net_Salary<600000 && $stanc_category=="")))
				{		}
				elseif(($FinalBidder[$i]==3050 || $FinalBidder[$i]==2479 || $FinalBidder[$i]==2908 || $FinalBidder[$i]==3098 || $FinalBidder[$i]==3107 || $FinalBidder[$i]==3116 || $FinalBidder[$i]==3161 || $FinalBidder[$i]==3214 || $FinalBidder[$i]==3208 || $FinalBidder[$i]==3219 || $FinalBidder[$i]==2952 || $FinalBidder[$i]==2765 || $FinalBidder[$i]==3226 || $FinalBidder[$i]==3263 || $FinalBidder[$i]==3264 | $FinalBidder[$i]==3276 || $FinalBidder[$i]==3306 || $FinalBidder[$i]==3416 || $FinalBidder[$i]==3428 || $FinalBidder[$i]==3446 || $FinalBidder[$i]==3539 || $FinalBidder[$i]==3559 || $FinalBidder[$i]==2574 || $FinalBidder[$i]==3661 || $FinalBidder[$i]==3695 || $FinalBidder[$i]==3700 || $FinalBidder[$i]==3721 || $FinalBidder[$i]==3670 || $FinalBidder[$i]==3732 || $FinalBidder[$i]==2878 || $FinalBidder[$i]==2774 || $FinalBidder[$i]==3755 || $FinalBidder[$i]==3763 || $FinalBidder[$i]==3773 || $FinalBidder[$i]==3790  || $FinalBidder[$i]==3828 || $FinalBidder[$i]==3892 || $FinalBidder[$i]==3922 || $FinalBidder[$i]==3937 || $FinalBidder[$i]==3939 || $FinalBidder[$i]==3949 || $FinalBidder[$i]==4008 || $FinalBidder[$i]==4121 || $FinalBidder[$i]==2765 || $FinalBidder[$i]==4194 || $FinalBidder[$i]==4243 || $FinalBidder[$i]==4286 || $FinalBidder[$i]==4325 || $FinalBidder[$i]==4334 || $FinalBidder[$i]==4348 || $FinalBidder[$i]==4405 || $FinalBidder[$i]==4464)  && ($citicategorycmp==''))
				{ 
				}
				elseif(($FinalBidder[$i]==2721 || $FinalBidder[$i]==3359 || $FinalBidder[$i]==3722 || $FinalBidder[$i]==2722 || $FinalBidder[$i]==3390 || $FinalBidder[$i]==3579 || $FinalBidder[$i]==2809 || $FinalBidder[$i]==2723 || $FinalBidder[$i]==2830 || $FinalBidder[$i]==3376 || $FinalBidder[$i]==2937) && (($citicategory=="") && ($Company_Type<4)))
				{
				}
				elseif($hdbfscategorycmp=='' && ($FinalBidder[$i]==2691 || $FinalBidder[$i]==2471 || $FinalBidder[$i]==2472 || $FinalBidder[$i]==2473 ))
				{
				}				
elseif(($kotakcategory=='' && $Net_Salary<480000) && ($FinalBidder[$i]==2998 ||  $FinalBidder[$i]==2999 ||  $FinalBidder[$i]==3000 ||  $FinalBidder[$i]==3001 ||  $FinalBidder[$i]==3002 ||  $FinalBidder[$i]==3801 ||  $FinalBidder[$i]==3003 ||  $FinalBidder[$i]==3004 ||  $FinalBidder[$i]==3005 ||  $FinalBidder[$i]==3006 ||  $FinalBidder[$i]==3009 ||  $FinalBidder[$i]==3014 ||  $FinalBidder[$i]==3015 ||  $FinalBidder[$i]==3890 ||  $FinalBidder[$i]==3889))
				{
				}
	elseif(($FinalBidder[$i]==2422 || $FinalBidder[$i]==2423 || $FinalBidder[$i]==2424 || $FinalBidder[$i]==2425 || $FinalBidder[$i]==2426 || $FinalBidder[$i]==2427 || $FinalBidder[$i]==2428 || $FinalBidder[$i]==2429 || $FinalBidder[$i]==2431 || $FinalBidder[$i]==2433 || $FinalBidder[$i]==2435 || $FinalBidder[$i]==2438 || $FinalBidder[$i]==2439 || $FinalBidder[$i]==2442 || $FinalBidder[$i]==2444 || $FinalBidder[$i]==2447 || $FinalBidder[$i]==3335 || $FinalBidder[$i]==3645 || $FinalBidder[$i]==3842 || $FinalBidder[$i]==3953 || $FinalBidder[$i]==3966 || $FinalBidder[$i]==3967) && ($Net_Salary<900000 && $bajajfinservcategory==""))
				{
	//echo "<bR>bajajfinservcategory: ".$bajajfinservcategory."<br><br>";
					}
			else if ($City=="Chandigarh" && ($Company_Name=="dell international" || $Company_Name=="DELL INTERNATIONAL SERVICE LIMITED/DELL INTERNATIONAL SERVICES INDIA PVT. LIMITED" || (strncmp ("Dell", $Company_Name,4))==0 || (strncmp ("DELL", $Company_Name,4))==0 || (strncmp ("dell", $Company_Name,4))==0) && $FinalBidder[$i]==1887)
				{
				}
	elseif(($FinalBidder[$i]==3724 || $FinalBidder[$i]==3725 || $FinalBidder[$i]==3787 || $FinalBidder[$i]==3788 || $FinalBidder[$i]==3968 || $FinalBidder[$i]==3900) && ($stanc_category=="" && $stanc_account==""))
				{
				}
				elseif($compforbajaj=="bajaj" && ($finalBidderName[$i]=="Bajaj Finserv" || $finalBidderName[$i]=="Bajaj finserv"))
				{
				}
				else
				{
			echo "<input type='checkbox' value='$FinalBidder[$i]' name='Final_Bidder[$i]' id='Final_Bidder[$i]'>".$finalBidderName[$i]."(".$FinalBidder[$i].")";
				}
			}
}	
		?></table></div></td>
</tr>
<tr><td colspan="3"><table border="1" width="100%">
<tr> <td width="11%" height="25" align="center" valign="middle"><b style="font-size:12px;">Bank Name</b></td>
	<td width="11%" align="center"><b style="font-size:12px;">Loan Amount</b></td>
	<td width="11%" align="center"><b style="font-size:12px;">ROI</b></td>
	<td width="11%" align="center"><b style="font-size:12px;">Tenure</b></td>
	<td width="11%" align="center"><b style="font-size:12px;">EMI(Per Lac)</b></td>
	<td width="11%" align="center"><b style="font-size:12px;">Company Cat</b></td>
	<td width="11%" align="center"><b style="font-size:12px;">Pre. charges</b></td>
	<td width="11%" align="center"><b style="font-size:12px;">prco. feee</b></td>
	</tr>
<? 
$finalBidderName_unique = array_unique($finalBidderName);
//print_r($finalBidderName_unique);
$finalBidderName_unique1=implode(",",$finalBidderName_unique);
$finalBidderName = explode(",",$finalBidderName_unique1);
//print_r($finalBidderName);
for($ij=0;$ij<count($finalBidderName_unique);$ij++)
{
	if(($finalBidderName[$ij]=="Stanc" || $finalBidderName[$ij]=="Standard Chartered"))
	{
		list($stancrate,$stancprepay_chrge,$stancpro_fee)=stancIR($monthsalary,$grow[$growcontr]["standard_chartered"]); 
		if($standard_charteredcategory!='' )
	{
		?>
		<tr> <td colspan="2" height="25" align="center" valign="middle"><b style="font-size:12px;">Eligible for Standard Chartered</b></td>
		<td align="center"><? echo $stancrate; ?></td>
		<td colspan="2">&nbsp;</td>
		<td align="center"><? echo $grow[$growcontr]["standard_chartered"]; ?></td>
		<td align="center"><? echo $stancprepay_chrge; ?></td>
		<td align="center"><? echo $stancpro_fee; ?></td>
		</tr>
		<? }
		else
		{
			if($Net_Salary>=600000)
		{ ?> 
<tr> <td colspan="2" height="25" align="center" valign="middle"><b style="font-size:12px;">Eligible for Standard Chartered</b></td>
		<td align="center"><? echo $stancrate; ?></td>
		<td colspan="2">&nbsp;</td>
		<td align="center"><? echo $grow[$growcontr]["standard_chartered"]; ?></td>
		<td align="center"><? echo $stancprepay_chrge; ?></td>
		<td align="center"><? echo $stancpro_fee; ?></td>
		</tr>
	 <?	}
			else
			{
			}
		}
	}
		elseif($finalBidderName[$ij]=="HDFC" || $finalBidderName[$ij]=="HDFC Bank")
		{
		
		list($hdfcinterestrate,$hdfcgetloanamout,$hdfcgetemicalc,$hdfcterm)=hdfcbank($monthsalary,$PL_EMI_Amt,$Company_Name,$hdfccategory,$getDOB,$Company_Type,$Primary_Acc);

//list($hdfcrate,$hdfcprepay_chrge,$hdfcpro_fee)=hdfcIR($monthsalary,$hdfccategory);
			?>
		<tr> <td width="11%" height="25" align="center" valign="middle"><b style="font-size:12px;"><? echo $finalBidderName[$ij]; ?></b></td>
	<td width="11%" align="center"><b style="font-size:12px;"><? echo $hdfcgetloanamout; ?></b></td>
	<td width="11%" align="center"><b style="font-size:12px;"><? if(isset($hdfcinterestrate)) { echo $hdfcinterestrate; } else { echo $hdfcrate ;} ?></b></td>
	<td width="11%" align="center"><b style="font-size:12px;"><? echo $hdfcterm."yrs";?></b></td>
	<td width="11%" align="center"><b style="font-size:12px;"><? echo $hdfcgetemicalc; ?></b></td>
	<td width="11%" align="center"><b style="font-size:12px;"><? echo $hdfccategory; ?></b></td>
	<td width="11%" align="center"><b style="font-size:12px;"><? echo $hdfcprepay_chrge; ?></b></td>
	<td width="11%" align="center"><b style="font-size:12px;"><? echo $hdfcpro_fee; ?></b></td>
	</tr>	
	<? }
	elseif(($finalBidderName[$ij]=="Citibank" || $finalBidderName[$ij]=="Citibank" || $finalBidderName[$ij]=="CitiBank") && $citicategory!='')
	{
	list($citiinterestrate,$citigetloanamout,$citigetemicalc,$cititerm)=citibank($monthsalary,$PL_EMI_Amt,$Company_Name,$getDOB,$citicategory);
	list($citirate,$citiprepay_chrge,$citipro_fee)=citiIR($monthsalary,$grow[$growcontr]["citibank"]);
			?>
		<tr> <td width="11%" height="25" align="center" valign="middle"><b style="font-size:12px;"><? echo $finalBidderName[$ij]; ?></b></td>
		<td width="11%" align="center"><b style="font-size:12px;"><? echo $citigetloanamout; ?></b></td>
		<td width="11%" align="center"><b style="font-size:12px;"><? if(isset($citiinterestrate)) { echo $citiinterestrate; } else { echo $citirate ;} ?></b></td>
		<td width="11%" align="center"><b style="font-size:12px;"><? echo $cititerm; ?></b></td>
		<td width="11%" align="center"><b style="font-size:12px;"><? $citigetemicalc; ?></b></td>
		<td width="11%" align="center"><b style="font-size:12px;"><? echo $citicategory; ?></b></td>
	<td width="11%" align="center"><b style="font-size:12px;"><? echo $citiprepay_chrge; ?></b></td>
	<td width="11%" align="center"><b style="font-size:12px;"><? echo $citipro_fee; ?></b></td>
		</tr>	
	<?
	}
elseif($finalBidderName[$ij]=="Fullerton" || $finalBidderName[$ij]=="Fullerton" || $finalBidderName[$ij]=="Fullerton (Chattisgarh)")
{
list($fullertoninterestrate,$fullertongetloanamout,$fullertongetemicalc,$fullertonterm)=fullerton($monthsalary,$PL_EMI_Amt,$Company_Name,$fullertoncategory,$getDOB,$City);
list($fulrate,$fulprepay_chrge,$fulpro_fee)=fullertonIR($monthsalary,$grow[$growcontr]["fullerton"]);
	?>
<tr> <td width="11%" height="25" align="center" valign="middle"><b style="font-size:12px;"><? echo $finalBidderName[$ij]; ?></b></td>
<td width="11%" align="center"><b style="font-size:12px;"><? echo $fullertongetloanamout; ?></b></td>
<td width="11%" align="center"><b style="font-size:12px;"><? if(isset($fullertoninterestrate)) { echo $fullertoninterestrate; } else { echo $fulrate ;} ?></b></td>
<td width="11%" align="center"><b style="font-size:12px;"><? echo $fullertonterm; ?></b></td>
<td width="11%" align="center"><b style="font-size:12px;"><? echo $fullertongetemicalc; ?></b></td>
<td width="11%" align="center"><b style="font-size:12px;"><? echo $grow[$growcontr]["fullerton"]; ?></b></td>
	<td width="11%" align="center"><b style="font-size:12px;"><? echo $fulprepay_chrge; ?></b></td>
	<td width="11%" align="center"><b style="font-size:12px;"><? echo $fulpro_fee; ?></b></td>
</tr>	
<?
}

elseif(($finalBidderName[$ij]=="IngVysya" || $finalBidderName[$ij]=="IngVysya" || $finalBidderName[$ij]=="ING Vysya") && $grow[$growcontr]["ingvyasya"]!='')
{

list($interestrate,$getloanamout,$getemicalc,$term,$Processing_Fee)=@ingVyasyaLoans_nw
($ingvyasyacategory, $monthsalary, $account_holder,$getDOB,$PL_EMI_Amt,$Loan_Amount,$Company_Name,$Company_Type);

//list($ingrate,$ingprepay_chrge,$ingpro_fee)=ingIR($monthsalary,$grow[$growcontr]["ingvyasya"]);
		?>
	<tr> <td width="11%" height="25" align="center" valign="middle"><b style="font-size:12px;"><? echo $finalBidderName[$ij]; ?></b></td>
	<td width="11%" align="center"><b style="font-size:12px;"><? echo $getloanamout; ?></b></td>
	<td width="11%" align="center"><b style="font-size:12px;"><? if(isset($interestrate)) { echo $interestrate; } else { echo $ingrate ;} ?></b></td>
	<td width="11%" align="center"><b style="font-size:12px;"><? echo $term; ?></b></td>
	<td width="11%" align="center"><b style="font-size:12px;"><? echo $getemicalc; ?></b></td>
	<td width="11%" align="center"><b style="font-size:12px;"><? echo $grow[$growcontr]["ingvyasya"]; ?></b></td>
	<td width="11%" align="center"><b style="font-size:12px;"><? echo $ingprepay_chrge; ?></b></td>
	<td width="11%" align="center"><b style="font-size:12px;"><? echo $ingpro_fee; ?></b></td>
	</tr>	
<?
}
elseif($finalBidderName[$ij]=="ICICI" || $finalBidderName[$ij]=="ICICI Bank")
{
list($iciciinterestrate,$icicigetloanamout,$icicigetemicalc,$iciciterm,$iciciperlacemi)=icicibank($monthsalary,$Company_Name,$icici_bankcmp,$getDOB,$Company_Type,$Primary_Acc);
//list($icicirate,$iciciprepay_chrge,$icicipro_fee)=iciciIR($monthsalary,$grow[$growcontr]["icici_bank"]);
	?>
<tr> <td width="11%" height="25" align="center" valign="middle"><b style="font-size:12px;"><? echo $finalBidderName[$ij]; ?></b></td>
<td width="11%" align="center"><b style="font-size:12px;"><? echo $icicigetloanamout; ?></b></td>
<td width="11%" align="center"><b style="font-size:12px;"><? echo $iciciinterestrate; ?></b></td>
<td width="11%" align="center"><b style="font-size:12px;"><? echo $iciciterm; ?></b></td>
<td width="11%" align="center"><b style="font-size:12px;"><? echo $icicigetemicalc; ?></b></td>
<td width="11%" align="center"><b style="font-size:12px;"><? echo $grow[$growcontr]["icici_bank"]; ?></b></td>
	<td width="11%" align="center"><b style="font-size:12px;"><? echo $iciciprepay_chrge; ?></b></td>
	<td width="11%" align="center"><b style="font-size:12px;"><? echo $icicipro_fee; ?></b></td>
</tr>	
<?
}
	elseif(($finalBidderName[$ij]=="Kotak Bank" || $finalBidderName[$ij]=="Kotak") && $grow[$growcontr]["kotak"]!='')
	{
		list($kotakrate)=kotakbank($monthsalary,$Company_Name,$kotakcategory,$getDOB,$Company_Type,$Primary_Acc);
		//list($kotakrate,$kotakprepay_chrge,$kotakpro_fee)=kotakIR($monthsalary,$grow[$growcontr]["kotak"]);
		?>
		<tr> <td colspan="2" height="25" align="center" valign="middle"><b style="font-size:12px;">for Kotak Bank</b></td>
		<td align="center"><? echo $kotakrate; ?></td>
		<td colspan="2">&nbsp;</td>
		<td align="center"><? echo $grow[$growcontr]["kotak"]; ?></td>
		<td align="center"><? echo $kotakprepay_chrge; ?></td>
		<td align="center"><? echo $kotakpro_fee; ?></td>
	</tr>
<?	}
	elseif(($finalBidderName[$ij]=="Bajaj Finserv") && $grow[$growcontr]["bajajfinserv"]!='')
	{	 list($bajajrate,$bajajprepay_chrge,$bajajpro_fee)=bajajIR($monthsalary,$grow[$growcontr]["bajajfinserv"]); 
	?>
<tr> <td colspan="2" height="25" align="center" valign="middle"><b style="font-size:12px;">for Bajaj Finserv</b></td>
		<td align="center"><? echo $bajajrate; ?></td>
		<td colspan="2">&nbsp;</td>
		<td align="center"><? echo $grow[$growcontr]["bajajfinserv"]; ?></td>
		<td align="center"><? echo $bajajprepay_chrge; ?></td>
		<td align="center"><? echo $bajajpro_fee; ?></td>
		</tr>
<?	}
	elseif(($finalBidderName[$ij]=="HDBFS") && $grow[$growcontr]["hdbfs"]!='')
	{
		list($hdbfsrate,$hdbfsprepay_chrge,$hdbfspro_fee)=hdbfsIR($monthsalary,$grow[$growcontr]["hdbfs"]); 
	?>
<tr> <td colspan="2" height="25" align="center" valign="middle"><b style="font-size:12px;">for HDBFS</b></td>
		<td align="center"><? echo $hdbfsrate; ?></td>
		<td colspan="2">&nbsp;</td>
		<td align="center"><? echo $grow[$growcontr]["hdbfs"]; ?></td>
		<td align="center"><? echo $hdbfsprepay_chrge; ?></td>
		<td align="center"><? echo $hdbfspro_fee; ?></td>
		</tr>
<?	}
}?>
</table></td></tr>
<tr><td colspan="3" align="center"><input type="submit" name="submit" value="Final Send" /></td></tr>
</table>
</form>
</body>
</html>
