<?php
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	$option = $_GET['option'];
	$chooseOption = "option".$option."_priority";
	$Loan_Amount = $_GET['LAmt'];
	$Net_Salary = $_GET['NSal'];
	$City = $_GET['City'];
//print_r($_GET);
	if(strlen($Loan_Amount)>5)
	{
		$loanAmtSql = " and (".$Loan_Amount." >= min_loanamt and ".$Loan_Amount." <= max_loanamt) ";
		$errMsg = "Mentioned Loan Amount is beyond the personal loan criteria.";
	}

	if(strlen($City)>1 && $City !='Please Select')
	{
		$getBiddsIDSql = "select BankID from Bidders_List where Reply_Type=1 and Restrict_Bidder=1 and City like '%".$City."%' and BankID in (4,27,24,50,13,2,17,48,8) group by BankID";
		list($getBiddsIDQuery,$getBiddsIDQuery)=MainselectfuncNew($getBiddsIDSql,$array = array());
		$BankID_arr = '';
		for($j=0;$j<$numgetBiddsID;$j++)
		{
			$BankID = $getBiddsIDQuery[$j]['BankID'];
			$BankID_arr[] = $BankID;
		}
		$BankID_str = implode(",", $BankID_arr);
		$CitySql = " and (BankID in (".$BankID_str.") )";
		$errMsg = "Mentioned City does not come in serviceable location.";
	}
		if(strlen($Net_Salary)>5)
	{
		$NSalSql = " and (minSalary <= ".$Net_Salary.") ";
//		$NSalSql = " and (".$Net_Salary." >= minSalary) ";
		$errMsg = "Mentioned Salary is below the serviceable limit.";
	}
 	$selectSql = "select * from personal_loan_updates where (".$chooseOption." >0) ";
	$selectSql .= $loanAmtSql;
	$selectSql .= $NSalSql;
	$selectSql .= $CitySql;	
	$selectSql .=  " order by ".$chooseOption." asc"; 
	list($countQuery,$selectQuery)=MainselectfuncNew($selectSql,$array = array());

	if($countQuery>0)
	{
?>
<h4 class="heading_text_b"><?php if($option==1) {?>
Top Banks offering Lowest interest rates
<?php } else if($option==2) {?>
Banks with double benefit of lowest ROI + Nil Prepayment
<?php } else if($option==3) {?>
Banks with double benefit of lowest ROI + minimum Processing fee
<?php } else if($option==4) {?>
Banks offering Fastest Loan approval facility
<?php } else if($option==5) {?>
Banks offering best of all Loan features
<?php } ?>
</h4>

              <table cellpadding="0" cellspacing="2" border="0" style="width:325px; border:1px #333333 solid;" >
              <tr><td width="94" align="center" style="color:#FFFFFF; background-color:#333333; font-family:Arial, Helvetica, sans-serif; font-size:13px; font-weight:bold;">Bank Name</td>
              <td width="110" align="center" style="color:#FFFFFF; background-color:#333333; font-family:Arial, Helvetica, sans-serif; font-size:13px; font-weight:bold; border-left:1px #fff solid;">Interest Rate</td>
              <td width="111" align="center" bgcolor="#333333" style="color:#FFFFFF; font-family:Arial, Helvetica, sans-serif; font-size:13px; font-weight:bold; border-left:1px #fff solid;">Processing Fee</td>
              </tr>
              <?php
			  for($i=0;$i<$countQuery;$i++)
			  {	  
			  		$bankid = $selectQuery[$i]['bankid'];
					$bank_name = $selectQuery[$i]['bank_name'];
					$interest_rates = $selectQuery[$i]['interest_rates'];
					$processing_fee = $selectQuery[$i]['processing_fee'];
					if($bank_name=="Axis Bank")
					{ $class = 'class="axis-bank"';	}
					else if($bank_name=="ICICI Bank")
					{ $class = 'class="icici-bank"'; }
					else if($bank_name=="Bajaj Finserv")
					{ $class = 'class="bajaj-finserv"'; }
					else if($bank_name=="Ing Vysya")
					{ $class = 'class="ing-vysya"'; }
					else if($bank_name=="Kotak")
					{ $class = 'class="kotak"'; }
					else if($bank_name=="HDFC Bank")
					{ $class = 'class="hdfc-bank"'; }
					else if($bank_name=="Standard Chartered")
					{ $class = 'class="Standard-Chart"'; }
					else if($bank_name=="HDBFS")
					{ $class = 'class="hdfc-bank"'; }
					else if($bank_name=="Fullerton")
					{ $class = 'class="fullerton"'; }
			  ?>
              <tr><td <?php echo $class; ?>><?php echo $bank_name; ?></td><td align="center" <?php echo $class; ?>><?php echo $interest_rates; ?></td><td  <?php echo $class; ?> align="center"><?php echo $processing_fee; ?></td></tr>
              <?php 
			  }
			  ?>
              </table>
<?php } else { ?>             
<h4 class="heading_text_b" style="color:#FF0000; font-size:13px;"><?php echo $errMsg; ?></h4>
<?php } ?>
