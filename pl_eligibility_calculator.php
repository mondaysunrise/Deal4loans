<?php
require 'scripts/db_init.php';
require 'scripts/functions.php';
require 'scripts/personal_loan_eligibility_function.php';

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
	$company=$_REQUEST["company"];
	$city=$_REQUEST["city"];
	$net_salary=$_REQUEST["net_salary"];
	$salary_account=$_REQUEST["salary_account"];
	$clubbed_emi=$_REQUEST["clubbed_emi"];
	$getDOB = $_REQUEST["dob"];
	echo $DOB =DetermineAgeGETDOB($getDOB);
	
$getcompany='select hdfc_bank,fullerton,citibank from pl_company_list where company_name="'.$company.'"';
$getcompany."<br>";
list($recordcount,$grow)=MainselectfuncNew($getcompany,$array = array());
		$cntr=0;


//$getcompanyresult = ExecQuery($getcompany);
//$grow=mysql_fetch_array($getcompanyresult);
//$recordcount = mysql_num_rows($getcompanyresult);
$hdfccategory= $grow[$cntr]["hdfc_bank"];
$fullertoncategory= $grow[$cntr]["fullerton"];
$citicategory= $grow[$cntr]["citibank"];
/*if(strlen($citicategory)>0)
	{
list($citiinterestrate,$citigetloanamout,$citigetemicalc,$cititerm)=citibank($net_salary,$clubbed_emi,$company,$DOB);
	}

list($hdfcinterestrate,$hdfcgetloanamout,$hdfcgetemicalc,$hdfcterm)=hdfcbank($net_salary,$clubbed_emi,$company,$hdfccategory,$DOB);

list($fullertoninterestrate,$fullertongetloanamout,$fullertongetemicalc,$fullertonterm)=fullerton($net_salary,$clubbed_emi,$company,$citicategory,$DOB,$city);
*/


	
$msg="valid";




}
?>
<html>
<head>
 <script type="text/javascript" src="ajax.js"></script>

	<script type="text/javascript" src="ajax-dynamic-pllist.js"></script>
<style type="text/css">
	
	/* START CSS NEEDED ONLY IN DEMO */
	
	#mainContainer{
		width:660px;
		margin:0 auto;
		text-align:left;
		height:100%;
		
		border-left:3px double #000;
		border-right:3px double #000;
	}
	#formContent{
		padding:5px;
	}
	/* END CSS ONLY NEEDED IN DEMO */
	
	
	/* Big box with list of options */
	#ajax_listOfOptions{
		position:absolute;	/* Never change this one */
		width:280px;	/* Width of box */
		height:160px;	/* Height of box */
		overflow:auto;	/* Scrolling features */
		border:1px solid #317082;	/* Dark green border */
		background-color:#FFF;	/* White background color */
    color: black;
		text-align:left;
		font-size:0.9em;
		z-index:100;
	}
	#ajax_listOfOptions div{	/* General rule for both .optionDiv and .optionDivSelected */
		margin:1px;		
		padding:1px;
		cursor:pointer;
		font-size:0.9em;
	}
	#ajax_listOfOptions .optionDiv{	/* Div for each item in list */
		
	}
	#ajax_listOfOptions .optionDivSelected{ /* Selected item in the list */
		background-color:#2375CB;
		color:#FFF;
	}
	#ajax_listOfOptions_iframe{
		background-color:#F00;
		position:absolute;
		z-index:5;
	}
	
	form{
		display:inline;
	}
	</style>
	
</head>
	<body><table><tr><td>
		<form method="POST" action="<? echo $_SERVER['PHP_SELF'] ?>" name="citibank_calculator">
			<table align="center" border="1">
			<tr>
					<td>DOB</td>
					<td><input type="text" name="dob" id="dob" value="<? echo $DOB; ?>"></td>
				</tr>
				<tr>
					<td><label for="country">Company Name </label></td>

					<td><input name="company" id="company"   type="text" onKeyUp="ajax_showOptions(this,'getCountriesByLetters',event)" value="<? echo $company;?>" size=45/>                                   
					</td>
				</tr>	
				<tr>
					<td>Net Take Home (Per month)</td>
					<td><input type="text" name="net_salary" id="net_salary" value="<? echo $net_salary; ?>"></td>
				</tr>
				<tr>
					<td>Salary Account</td>
					<td><select name="salary_account" id="salary_account"><option value="Citibank" <? if($salary_account=="Citibank") { echo "selected";}?>>Citibank</option><option value="Other" <? if($salary_account=="Other") { echo "selected";}?>>Other</option></select></td>
				</tr>
				<tr>
					<td>City</td>
					<td><select name="city" id="city">
					        <?=getCityList($city)?>
					</select>
					</td>
				</tr>
				<tr>
					<td>EMI of Loan Running</td>
					<td><input type="text" name="clubbed_emi" id="clubbed_emi" value="<? echo $clubbed_emi; ?>"></td>
				</tr>


				

				<tr><td colspan="2" align="center"><input type="submit" name="submit" value="submit"></td></tr>
			</table>
			</form>


		<?	
if(isset($msg))
{
		if(isset($msg))
			{
list($citiinterestrate,$citigetloanamout,$citigetemicalc,$cititerm)=citibank($net_salary,$clubbed_emi,$company,$DOB,$citicategory);
	}

list($hdfcinterestrate,$hdfcgetloanamout,$hdfcgetemicalc,$hdfcterm)=hdfcbank($net_salary,$clubbed_emi,$company,$hdfccategory,$DOB);

list($fullertoninterestrate,$fullertongetloanamout,$fullertongetemicalc,$fullertonterm)=fullerton($net_salary,$clubbed_emi,$company,$citicategory,$DOB,$city);

			?>	<tr><td><b>HDFC details:</b></td></tr>
			<tr><td><? echo "Interest rate".$hdfcinterestrate."<br><br>";
							
				echo "eligible Loan: ".$hdfcgetloanamout."<br><br>"; 

				echo "EMI: ".$hdfcgetemicalc."<br>";
				echo "Tenure: ".$hdfcterm."<br>";
				?></td></tr>
<tr><td><b>Fullerton details:</b></td></tr>
				<tr><td><? echo "Interest rate".$fullertoninterestrate."<br><br>";
							
				echo "eligible Loan: ".$fullertongetloanamout."<br><br>"; 

				echo "EMI: ".$fullertongetemicalc."<br>";
				echo "Tenure: ".$fullertonterm."<br>";
				?></td></tr>
				<tr><td><b>Citibank details:</b></td></tr>
				<tr><td><? echo "Interest rate".$citiinterestrate."<br><br>";
							
				echo "eligible Loan: ".$citigetloanamout."<br><br>"; 

				echo "EMI: ".$citigetemicalc."<br>";
				echo "Tenure: ".$cititerm."<br>";
				?></td></tr>
			<? } ?>
			</td></tr></table>

	</body>
</html>