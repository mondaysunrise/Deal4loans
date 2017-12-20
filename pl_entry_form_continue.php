<?php
require 'scripts/db_init.php';
require 'scripts/functions.php';
require 'eligiblebidderfuncPL.php';
require 'scripts/pl_interest_rate_view.php';
require 'scripts/personal_loan_eligibility_function_lms.php';

		if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		foreach($_POST as $a=>$b)
			$$a=$b;
		$Name = FixString($Name);
		$DOB=FixString($DOB);
		$getDOB =DetermineAgeGETDOB($DOB);
		$Pincode = FixString($Pincode);
		$Phone = FixString($Mobile_Number);
		$Employment_Status = FixString($Employment_Status);
		$Phone1 = FixString($Landline);
		$Std_Code1 = FixString($Std_Code);
		$Card_Vintage = FixString($Card_Vintage);
		$CC_Holder = FixString($CC_Holder);
		$EMI_Paid = FixString($EMI_Paid);
		$Net_Salary = FixString($Net_Salary);
		$monthsalary = $Net_Salary/12;
		$Company_Type=1;
		$Card_Limit = FixString($Card_Limit);
		$Email = FixString($Email);
		$Primary_Acc = FixString($Primary_Acc);
		$Type_Loan = "Req_Loan_Personal";
		$Company_Name = FixString($Company_Name);
		$Loan_Amount = FixString($Loan_Amount);
		$City = FixString($City);
		$Primary_Acc = FixString($Primary_Acc);
		$Final_Bidder = $_REQUEST['Final_Bidder'];
		$Residential_Status =FixString($Residential_Status);
		$Loan_Any = $_REQUEST['Loan_Any'];
		$Total_Experience = FixString($Total_Experience);
		$Years_In_Company = FixString($Years_In_Company);
		$City_Other = FixString($City_Other);


		if($City=="Others")
		{
			$strcity=$City;
		}
		else
		{
			$strcity=$City_Other;
		}
if($Card_Vintage>0)
{
	$CC_Holder=1;
}
else
{
	$CC_Holder=0;
}
if($EMI_Paid>0)
{
	$Loan_Any=$_REQUEST['Loan_Any'];
}
else
{
	$Loan_Any="";
}

		$validMobile = is_numeric($Phone);
		

		if(($validMobile==1) )
{		
			$CheckSql = "select UserID from wUsers where Email = '".$Email."'";
		 list($CheckNumRows,$getrow)=MainselectfuncNew($CheckSql,$array = array());
			$k=0;
			if($CheckNumRows>0)
			{
				$UserID = $getrow[$k]['UserID'];

				$dataInsert = array("UserID"=>$UserID, "Name"=>$Name, "Email"=>$Email, "Employment_Status"=>$Employment_Status, "Company_Name"=>$Company_Name, "City"=>$City, "City_Other"=>$City_Other, "Mobile_Number"=>$Mobile_Number, "Std_Code"=>$Std_Code1, "Landline"=>$Phone1, "Net_Salary"=>$Net_Salary, "CC_Holder"=>$CC_Holder, "Loan_Amount"=>$Loan_Amount, "DOB"=>$DOB, "Count_Views"=>0, "Count_Replies"=>0, "IsModified"=>0, "IsProcessed"=>0, "IsPublic"=>$IsPublic, "Dated"=>$Dated, "Pincode"=>$Pincode, "Reference_Code"=>$Reference_Code, "source"=>$source, "CC_Bank"=>$From_Pro, "Card_Vintage"=>$Card_Vintage, "Referrer"=>$Referrer, "Creative"=>$Creative, "Section"=>$Section, "Updated_Date"=>$Dated, "IP_Address"=>$IP, "Accidental_Insurance"=>$Accidental_Insurance, 'Residential_Status'=>$Residential_Status, 'EMI_Paid'=>$EMI_Paid, 'Total_Experience'=>$Total_Experience, 'Years_In_Company'=>$Years_In_Company, 'Primary_Acc'=>$Primary_Acc);
			
			}
			else
			{
				$dataInsert = array("Email"=>$Email, "FName"=>$Name, "Phone"=>$Phone, "Join_Date"=>$Dated, "IsPublic"=>$IsPublic);
				$table = 'wUsers';
				$UserID = Maininsertfunc ($table, $dataInsert);
				$dataInsert = array("UserID"=>$UserID, "Name"=>$Name, "Email"=>$Email, "Employment_Status"=>$Employment_Status, "Company_Name"=>$Company_Name, "City"=>$City, "City_Other"=>$City_Other, "Mobile_Number"=>$Mobile_Number, "Std_Code"=>$Std_Code1, "Landline"=>$Phone1, "Net_Salary"=>$Net_Salary, "CC_Holder"=>$CC_Holder, "Loan_Amount"=>$Loan_Amount, "DOB"=>$DOB, "Count_Views"=>0, "Count_Replies"=>0, "IsModified"=>0, "IsProcessed"=>0, "IsPublic"=>$IsPublic, "Dated"=>$Dated, "Pincode"=>$Pincode, "Reference_Code"=>$Reference_Code, "source"=>$source, "CC_Bank"=>$From_Pro, "Card_Vintage"=>$Card_Vintage, "Referrer"=>$Referrer, "Creative"=>$Creative, "Section"=>$Section, "Updated_Date"=>$Dated, "IP_Address"=>$IP, "Accidental_Insurance"=>$Accidental_Insurance, 'Residential_Status'=>$Residential_Status, 'EMI_Paid'=>$EMI_Paid, 'Total_Experience'=>$Total_Experience, 'Years_In_Company'=>$Years_In_Company, 'Primary_Acc'=>$Primary_Acc);
							
			}
			//echo "hello".$InsertProductSql."<br>";
			$table = 'Req_Loan_Personal';
			$ProductValue = Maininsertfunc ($table, $dataInsert);
			
			//Code Added to mailtocommonscript.php
			$FName = $Name;
			$Checktosend="getthank_individual";
			include "scripts/mailatcommonscript.php";

			$headers  = 'From: Deal4loans <no-reply@deal4loans.com>' . "\r\n";
			$headers .= "Return-Path: <no-reply@deal4loans.com>\r\n";  // Return path for errors
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			
			if($Name)
				$SubjectLine = $Name.", Learn to get Best Deal on Personal Loan";
			else
				$SubjectLine = "Learn to get Best Deal on Personal Loan";
			//echo $Type_Loan;
			if(isset($Type_Loan))
			{
				mail($Email, $SubjectLine, $Message2, $headers);
			}
			
}
		}

$icici_bankcmp="";
$stanc_account="";
$ingvyasyacategory="";
$bajajfinservcategory="";
$hdbfscategorycmp="";
$standard_charteredcategory="";
$bajajfinserv="";
$getcompany='select * from pl_company_list where ((company_name="'.$Company_Name.'"))';
list($recordcount,$grow)=Mainselectfunc($getcompany,$array = array());
$hdfccategory= $grow["hdfc_bank"];
$fullertoncategory= $grow["fullerton"];
$bajajfinservcategory= $grow["bajajfinserv"];
$citicategorycmp= $grow["citibank"];
$hdbfscategorycmp = $grow["hdbfs"];
$icici_bankcmp = $grow["icici_bank"];
$ingvyasyacategory = $grow["ingvyasya"];
$kotakcategory = $grow["kotak"];
$stanc_category= $grow["standard_chartered"];
$bajajfinserv = $grow["bajajfinserv"];

list($FinalBidder,$finalBidderName)= getBiddersList("Req_Loan_Personal",$ProductValue,$City,$Referral_Flag,$source);

if(count($FinalBidder)>0)
{
	?>
	<form name='pl_entry' action='pl_entry_form_thank.php' method='post'>
	<input type="hidden" value="<? echo $ProductValue; ?>" name="Requestid" id="Requestid">
	<table width='90%'>
	<tr><td width='50'>Eligible Bidders</td><td  style='font-size:12px; height:50px;'>

      <? for($i=0;$i<count($FinalBidder);$i++)
			{
	   //echo $FinalBidder[$i]."<br>";
	   if(($FinalBidder[$i]==2490 || $FinalBidder[$i]==2496 || $FinalBidder[$i]==2497 || $FinalBidder[$i]==2498 || $FinalBidder[$i]==2499 || $FinalBidder[$i]==2500 || $FinalBidder[$i]==2813 || $FinalBidder[$i]==2887) && ($ingvyasyacategory=='') && $Employment_Status ==1 && $Company_Type!=4 && $Company_Type!=5)
	   {
		 //echo "1: ".$FinalBidder[$i]."<br>";
	   }
	  else if((($FinalBidder[$i]==2896 || $FinalBidder[$i]==2923 || $FinalBidder[$i]==2925 || $FinalBidder[$i]==2926 || $FinalBidder[$i]==2927 || $FinalBidder[$i]==3254 || $FinalBidder[$i]==3255 || $FinalBidder[$i]==3256 || $FinalBidder[$i]==2929 || $FinalBidder[$i]==3258 || $FinalBidder[$i]==2983 || $FinalBidder[$i]==2984 || $FinalBidder[$i]==2930 || $FinalBidder[$i]==2931 || $FinalBidder[$i]==2932 || $FinalBidder[$i]==2933 || $FinalBidder[$i]==2962 || $FinalBidder[$i]==3259 || $FinalBidder[$i]==2934 ||  $FinalBidder[$i]==3061 || $FinalBidder[$i]==3075 || $FinalBidder[$i]==3076 || $FinalBidder[$i]==3133 || $FinalBidder[$i]==3134 || $FinalBidder[$i]==3195 ||  $FinalBidder[$i]==3196 || $FinalBidder[$i]==3198 || $FinalBidder[$i]==3199 || $FinalBidder[$i]==3216 || $FinalBidder[$i]==3241) && (($icici_bankcmp=='' && $Net_Salary<360000 && ((strncmp("ICICI", $Primary_Acc,5))==0)) || ($icici_bankcmp=='' && ((strncmp("ICICI", $Primary_Acc,5))!=0) && $Net_Salary<480000))) 
|| 
((($icici_bankcmp=="Preferred" && ((strncmp("ICICI", $Primary_Acc,5))!=0) && $Net_Salary<360000) || ($icici_bankcmp=="Preferred" && ((strncmp("ICICI", $Primary_Acc,5))==0) && $Net_Salary<300000)) && ($FinalBidder[$i]==2896 || $FinalBidder[$i]==2923 || $FinalBidder[$i]==2925 || $FinalBidder[$i]==2926 || $FinalBidder[$i]==2927 || $FinalBidder[$i]==3254 || $FinalBidder[$i]==3255 || $FinalBidder[$i]==3256 || $FinalBidder[$i]==2929 || $FinalBidder[$i]==3258 || $FinalBidder[$i]==2983 || $FinalBidder[$i]==2984 || $FinalBidder[$i]==2930 || $FinalBidder[$i]==2931 || $FinalBidder[$i]==2932 || $FinalBidder[$i]==2933 || $FinalBidder[$i]==2962 || $FinalBidder[$i]==3259 || $FinalBidder[$i]==2934 ||  $FinalBidder[$i]==3061 || $FinalBidder[$i]==3075 || $FinalBidder[$i]==3076 || $FinalBidder[$i]==3133 || $FinalBidder[$i]==3134 || $FinalBidder[$i]==3195 ||  $FinalBidder[$i]==3196 ||  $FinalBidder[$i]==3198 || $FinalBidder[$i]==3199 || $FinalBidder[$i]==3216 || $FinalBidder[$i]==3241)))
		{
			 //echo "2: ".$FinalBidder[$i]."<br>";
		}	
else if((($FinalBidder[$i]==3132 || $FinalBidder[$i]==2917 || $FinalBidder[$i]==3197 || $FinalBidder[$i]==3257) && (($icici_bankcmp=='' && $Net_Salary<360000 && ((strncmp("ICICI", $Primary_Acc,5))==0)) || ($icici_bankcmp=='' && ((strncmp("ICICI", $Primary_Acc,5))!=0) && $Net_Salary<420000))) 
|| 
((($icici_bankcmp=="Preferred" && ((strncmp("ICICI", $Primary_Acc,5))!=0) && $Net_Salary<360000) || ($icici_bankcmp=="Preferred" && ((strncmp("ICICI", $Primary_Acc,5))==0) && $Net_Salary<300000)) && ($FinalBidder[$i]==3132 || $FinalBidder[$i]==2917 || $FinalBidder[$i]==3197 || $FinalBidder[$i]==3257)))
		{
		}
	   else if(($FinalBidder[$i]==1632 || $FinalBidder[$i]==1633 || $FinalBidder[$i]==1634 || $FinalBidder[$i]==1635 || $FinalBidder[$i]==1636 || $FinalBidder[$i]==1646 || $FinalBidder[$i]==1759  || $FinalBidder[$i]==2020 || $FinalBidder[$i]==2021) && ($standard_charteredcategory=='' && $Employment_Status ==0 && $Net_Salary<600000))
				{
					// echo "3: ".$FinalBidder[$i]."<br>";
				}
				else if(($FinalBidder[$i]==2764 || $FinalBidder[$i]==3301 || $FinalBidder[$i]==3302 || $FinalBidder[$i]==3303) && (strlen($stanc_category)<1 && (strlen($stanc_account)<1) && $Net_Salary<600000) )
				{
				}
				else if (($FinalBidder[$i]==2764 || $FinalBidder[$i]==3301 || $FinalBidder[$i]==3302 || $FinalBidder[$i]==3303) && ((strlen($stanc_account)>1) && (strlen($stanc_category)<1) && $Net_Salary<192000))
				{
					echo "hello: ".strlen($stanc_account)."<br>";
				}
				else if (($FinalBidder[$i]==2764 || $FinalBidder[$i]==3301 || $FinalBidder[$i]==3302 || $FinalBidder[$i]==3303) && (strlen($stanc_category)>1 && $Net_Salary<325000)) 
				{

				}
				else if (($FinalBidder[$i]==2781) && (strlen($stanc_category)<1 && $Net_Salary<600000))
				{
				}
				else if(($FinalBidder[$i]==2780 || $FinalBidder[$i]==3136) && (strlen($stanc_category)<1))
				{
				}
				else if(($FinalBidder[$i]==1053 || $FinalBidder[$i]==1054 || $FinalBidder[$i]==1057 || $FinalBidder[$i]==1058 || $FinalBidder[$i]==1055 || $FinalBidder[$i]==1913 || $FinalBidder[$i]==1056 || $FinalBidder[$i]==1154 || $FinalBidder[$i]==2073 || $FinalBidder[$i]==2072 || $FinalBidder[$i]==1060 || $FinalBidder[$i]==2774 || $FinalBidder[$i]==2765 || $FinalBidder[$i]==2878 || $FinalBidder[$i]==2908 || $FinalBidder[$i]==2952 || $FinalBidder[$i]==2938 || $FinalBidder[$i]==2985 || $FinalBidder[$i]==3050 || $FinalBidder[$i]==2479 || $FinalBidder[$i]==3098 || $FinalBidder[$i]==3107 || $FinalBidder[$i]==3116 || $FinalBidder[$i]==3161 || $FinalBidder[$i]==3214 || $FinalBidder[$i]==3219 || $FinalBidder[$i]==3226 || $FinalBidder[$i]==3263 || $FinalBidder[$i]==3264 || $FinalBidder[$i]==3276) && ($citicategorycmp=='') && $Employment_Status ==1)
				{
				}
				elseif(($FinalBidder[$i]==2721 || $FinalBidder[$i]==2722 || $FinalBidder[$i]==2723 || $FinalBidder[$i]==2830 || $FinalBidder[$i]==2937 || $FinalBidder[$i]==2809 || $FinalBidder[$i]==3050 || $FinalBidder[$i]==2479 || $FinalBidder[$i]==2908 || $FinalBidder[$i]==3098 || $FinalBidder[$i]==3107 || $FinalBidder[$i]==3116 || $FinalBidder[$i]==3161 || $FinalBidder[$i]==3214 || $FinalBidder[$i]==3208 || $FinalBidder[$i]==3219 || $FinalBidder[$i]==2952 || $FinalBidder[$i]==2765 || $FinalBidder[$i]==3226 || $FinalBidder[$i]==3263 || $FinalBidder[$i]==3264 | $FinalBidder[$i]==3276)  && ($citicategorycmp==''))
				{
// echo "5: ".$FinalBidder[$i]."<br>";
				}
				elseif($hdbfscategorycmp=='' && $FinalBidder[$i]==2691)
				{

				}
elseif(($kotakcategory=='' && ( $FinalBidder[$i]==2998 || $FinalBidder[$i]==2999|| $FinalBidder[$i]==3000 || $FinalBidder[$i]==3001 || $FinalBidder[$i]==3002 || $FinalBidder[$i]==3003 || $FinalBidder[$i]==3004 || $FinalBidder[$i]==3005 || $FinalBidder[$i]==3006 || $FinalBidder[$i]==3007 || $FinalBidder[$i]==3008 || $FinalBidder[$i]==3009 || $FinalBidder[$i]==3010 || $FinalBidder[$i]==3011 || $FinalBidder[$i]==3012 || $FinalBidder[$i]==3013 || $FinalBidder[$i]==3014 || $FinalBidder[$i]==3015 )) || (($kotakcategory=="CAT C" || $kotakcategory=="CAT D") && $Net_Salary<720000 && ( $FinalBidder[$i]==2998 || $FinalBidder[$i]==2999|| $FinalBidder[$i]==3000 || $FinalBidder[$i]==3001 || $FinalBidder[$i]==3002 || $FinalBidder[$i]==3003 || $FinalBidder[$i]==3004 || $FinalBidder[$i]==3005 || $FinalBidder[$i]==3006 || $FinalBidder[$i]==3007 || $FinalBidder[$i]==3008 || $FinalBidder[$i]==3009 || $FinalBidder[$i]==3010 || $FinalBidder[$i]==3011 || $FinalBidder[$i]==3012 || $FinalBidder[$i]==3013 || $FinalBidder[$i]==3014 || $FinalBidder[$i]==3015 )))
				{

				}
elseif(($FinalBidder[$i]==2426 || $FinalBidder[$i]==2426 || $FinalBidder[$i]==2425 || $FinalBidder[$i]==2423 || $FinalBidder[$i]==2424 || $FinalBidder[$i]==2422) && ($Net_Salary<900000 && $bajajfinserv==""))
				{
				}
				else if ($City=="Chandigarh" && ($Company_Name=="dell international" || $Company_Name=="DELL INTERNATIONAL SERVICE LIMITED/DELL INTERNATIONAL SERVICES INDIA PVT. LIMITED" || (strncmp ("Dell", $Company_Name,4))==0 || (strncmp ("DELL", $Company_Name,4))==0 || (strncmp ("dell", $Company_Name,4))==0) && $FinalBidder[$i]==1887)
				{
					// echo "6: ".$FinalBidder[$i]."<br>";
				}
				else
				{
					 // echo "7: ".$FinalBidder[$i]."<br>";
		echo "<input type='checkbox' value='$FinalBidder[$i]' name='Final_Bidder[$i]' id='Final_Bidder[$i]'>".$finalBidderName[$i]."(".$FinalBidder[$i].")";
		echo "&nbsp;";
				}
			}

?>
</td></tr>
<tr> 
<td colspan="2"><table border=1 cellspacing="2"><tr>
<td width="11%" height="25" align="center" valign="middle"><b style="font-size:12px;">Bank Name</b></td>
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
		list($stancrate,$stancprepay_chrge,$stancpro_fee)=stancIR($monthsalary,$grow["standard_chartered"]); 
		if($standard_charteredcategory!='' )
	{
		
		?>
		<tr> <td colspan="2" height="25" align="center" valign="middle"><b style="font-size:12px;">Eligible for Standard Chartered</b></td>
		<td align="center"><? echo $stancrate; ?></td>
		<td colspan="2">&nbsp;</td>
		<td align="center"><? echo $grow["standard_chartered"]; ?></td>
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
		<td align="center"><? echo $grow["standard_chartered"]; ?></td>
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

list($hdfcrate,$hdfcprepay_chrge,$hdfcpro_fee)=hdfcIR($monthsalary,$hdfccategory);
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
	list($citirate,$citiprepay_chrge,$citipro_fee)=citiIR($monthsalary,$grow["citibank"]);
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
list($fulrate,$fulprepay_chrge,$fulpro_fee)=fullertonIR($monthsalary,$grow["fullerton"]);
	?>
<tr> <td width="11%" height="25" align="center" valign="middle"><b style="font-size:12px;"><? echo $finalBidderName[$ij]; ?></b></td>
<td width="11%" align="center"><b style="font-size:12px;"><? echo $fullertongetloanamout; ?></b></td>
<td width="11%" align="center"><b style="font-size:12px;"><? if(isset($fullertoninterestrate)) { echo $fullertoninterestrate; } else { echo $fulrate ;} ?></b></td>
<td width="11%" align="center"><b style="font-size:12px;"><? echo $fullertonterm; ?></b></td>
<td width="11%" align="center"><b style="font-size:12px;"><? echo $fullertongetemicalc; ?></b></td>
<td width="11%" align="center"><b style="font-size:12px;"><? echo $grow["fullerton"]; ?></b></td>
	<td width="11%" align="center"><b style="font-size:12px;"><? echo $fulprepay_chrge; ?></b></td>
	<td width="11%" align="center"><b style="font-size:12px;"><? echo $fulpro_fee; ?></b></td>
</tr>	
<?
}

elseif($finalBidderName[$ij]=="Barclays Finance" || $finalBidderName[$ij]=="Barclays Finance")
{
list($barclayinterestrate,$barclaygetloanamout,$barclaygetemicalc,$barclayterm)=@barclays($monthsalary,$PL_EMI_Amt,$Company_Name,$barclayscategory,$getDOB,$City);
	?>
<tr> <td width="11%" height="25" align="center" valign="middle"><b style="font-size:12px;"><? echo $finalBidderName[$ij]; ?></b></td>
<td width="11%" align="center"><b style="font-size:12px;"><? echo $barclaygetloanamout; ?></b></td>
<td width="11%" align="center"><b style="font-size:12px;"><? echo $barclayinterestrate; ?></b></td>
<td width="11%" align="center"><b style="font-size:12px;"><? echo $barclayterm; ?></b></td>
<td width="11%" align="center"><b style="font-size:12px;"><? echo $barclaygetemicalc; ?></b></td>
</tr>	
<?
}
elseif(($finalBidderName[$ij]=="IngVysya" || $finalBidderName[$ij]=="IngVysya" || $finalBidderName[$ij]=="ING Vysya") && $grow["ingvyasya"]!='')
{
list($interestrate,$getloanamout,$getemicalc,$term,$Processing_Fee)=@ingVyasyaLoans($ingvyasyacategory,$monthsalary,$Primary_Acc,$getDOB,$PL_EMI_Amt,$Loan_Amount,$Company_Name);
list($ingrate,$ingprepay_chrge,$ingpro_fee)=ingIR($monthsalary,$grow["ingvyasya"]);
		?>
	<tr> <td width="11%" height="25" align="center" valign="middle"><b style="font-size:12px;"><? echo $finalBidderName[$ij]; ?></b></td>
	<td width="11%" align="center"><b style="font-size:12px;"><? echo $getloanamout; ?></b></td>
	<td width="11%" align="center"><b style="font-size:12px;"><? if(isset($interestrate)) { echo $interestrate; } else { echo $ingrate ;} ?></b></td>
	<td width="11%" align="center"><b style="font-size:12px;"><? echo $term; ?></b></td>
	<td width="11%" align="center"><b style="font-size:12px;"><? echo $getemicalc; ?></b></td>
	<td width="11%" align="center"><b style="font-size:12px;"><? echo $grow["ingvyasya"]; ?></b></td>
	<td width="11%" align="center"><b style="font-size:12px;"><? echo $ingprepay_chrge; ?></b></td>
	<td width="11%" align="center"><b style="font-size:12px;"><? echo $ingpro_fee; ?></b></td>
	</tr>	
<?
}
elseif($finalBidderName[$ij]=="ICICI" || $finalBidderName[$ij]=="ICICI Bank")
{
list($iciciinterestrate,$icicigetloanamout,$icicigetemicalc,$iciciterm,$iciciperlacemi)=icicibank($monthsalary,$Company_Name,$icici_bankcmp,$getDOB,$Company_Type,$Primary_Acc);
list($icicirate,$iciciprepay_chrge,$icicipro_fee)=iciciIR($monthsalary,$grow["icici_bank"]);
	?>
<tr> <td width="11%" height="25" align="center" valign="middle"><b style="font-size:12px;"><? echo $finalBidderName[$ij]; ?></b></td>
<td width="11%" align="center"><b style="font-size:12px;"><? echo $icicigetloanamout; ?></b></td>
<td width="11%" align="center"><b style="font-size:12px;"><? echo $iciciinterestrate; ?></b></td>
<td width="11%" align="center"><b style="font-size:12px;"><? echo $iciciterm; ?></b></td>
<td width="11%" align="center"><b style="font-size:12px;"><? echo $icicigetemicalc; ?></b></td>
<td width="11%" align="center"><b style="font-size:12px;"><? echo $grow["icici_bank"]; ?></b></td>
	<td width="11%" align="center"><b style="font-size:12px;"><? echo $iciciprepay_chrge; ?></b></td>
	<td width="11%" align="center"><b style="font-size:12px;"><? echo $icicipro_fee; ?></b></td>
</tr>	
<?
}
	elseif(($finalBidderName[$ij]=="Kotak Bank" || $finalBidderName[$ij]=="Kotak") && $grow["kotak"]!='')
	{
		list($kotakrate,$kotakprepay_chrge,$kotakpro_fee)=kotakIR($monthsalary,$grow["kotak"]);
		?>
		<tr> <td colspan="2" height="25" align="center" valign="middle"><b style="font-size:12px;">for Kotak Bank</b></td>
		<td align="center"><? echo $kotakrate; ?></td>
		<td colspan="2">&nbsp;</td>
		<td align="center"><? echo $grow["kotak"]; ?></td>
		<td align="center"><? echo $kotakprepay_chrge; ?></td>
		<td align="center"><? echo $kotakpro_fee; ?></td>
		
	</tr>
<?	}
	elseif(($finalBidderName[$ij]=="Bajaj Finserv") && $grow["bajajfinserv"]!='')
	{	 list($bajajrate,$bajajprepay_chrge,$bajajpro_fee)=bajajIR($monthsalary,$grow["bajajfinserv"]); 
	?>
<tr> <td colspan="2" height="25" align="center" valign="middle"><b style="font-size:12px;">for Bajaj Finserv</b></td>
		<td align="center"><? echo $bajajrate; ?></td>
		<td colspan="2">&nbsp;</td>
		<td align="center"><? echo $grow["bajajfinserv"]; ?></td>
		<td align="center"><? echo $bajajprepay_chrge; ?></td>
		<td align="center"><? echo $bajajpro_fee; ?></td>
		</tr>
<?	}
	elseif(($finalBidderName[$ij]=="HDBFS") && $grow["hdbfs"]!='')
	{
		list($hdbfsrate,$hdbfsprepay_chrge,$hdbfspro_fee)=hdbfsIR($monthsalary,$grow["hdbfs"]); 
	?>
<tr> <td colspan="2" height="25" align="center" valign="middle"><b style="font-size:12px;">for HDBFS</b></td>
		<td align="center"><? echo $hdbfsrate; ?></td>
		<td colspan="2">&nbsp;</td>
		<td align="center"><? echo $grow["hdbfs"]; ?></td>
		<td align="center"><? echo $hdbfsprepay_chrge; ?></td>
		<td align="center"><? echo $hdbfspro_fee; ?></td>
		</tr>

<?	}

		
} ?>
</table></td></tr>

<tr>
	<td class="fontstyle"><b>Feedback</b></td>
	<td class="fontstyle"><select name="plfeedback" id="feedback">
		<option value="No Feedback" <?if($Feedback == "") { echo "selected"; }?>>No Feedback</option>
		<option value="Other Product" <?if($Feedback == "Other Product") { echo "selected"; }?>>Other Product</option>
		<option value="Not Interested" <?if($Feedback == "Not Interested") { echo "selected"; }?>>Not Interested</option>
		<option value="Callback Later" <?if($Feedback == "Callback Later") { echo "selected"; }?>>Callback Later</option>
		<option value="Wrong Number" <?if($Feedback == "Wrong Number") { echo "selected"; }?>>Wrong Number</option>
		<option value="Send Now" <?if($Feedback == "Send Now") { echo "selected"; }?>>Send Now</option>
		<option value="Not Eligible" <?if($Feedback == "Not Eligible") { echo "selected"; }?>>Not Eligible</option>
		<option value="Duplicate" <?if($Feedback == "Duplicate") { echo "selected"; }?>>Duplicate</option>
		<option value="Not Contactable" <?if($Feedback == "Not Contactable") { echo "selected"; }?>>Not Contactable</option>
		<option value="Ringing" <?if($Feedback == "Ringing") { echo "selected"; }?>>Ringing</option>
	<option value="FollowUp" <?if($Feedback == "FollowUp") { echo "selected"; }?>>FollowUp</option>
	<option value="Not Applied" <?if($Feedback == "Not Applied") { echo "selected"; }?>>Not Applied</option>
	</select>
	</td>
</tr>

<tr><td colspan="2" align="center"><input type="submit" name="submit" value="submit"></td></tr>
</table>

<?			//}

		
}
else
{
	echo "Not eligible for any";
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

				?>