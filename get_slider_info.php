<link href="icici_car/style.css" rel="stylesheet" type="text/css">
<?php
require 'scripts/db_init.php';
require 'scripts/functions.php';
function Determine_AgeFrom_DOB ($YYYYMMDD_In){  $yIn=substr($YYYYMMDD_In, 0, 4);  $mIn=substr($YYYYMMDD_In, 4, 2);  $dIn=substr($YYYYMMDD_In, 6, 2);  $ddiff = date("d") - $dIn;  $mdiff = date("m") - $mIn;  $ydiff = date("Y") - $yIn;   if ($mdiff < 0)  {    $ydiff--;  } elseif ($mdiff==0)  {    if ($ddiff < 0)    {      $ydiff--;    }  }  return $ydiff; }


$roi = $_REQUEST["get_roi"];
$tenure = $_REQUEST["get_tenure"];
$amount_invest = $_REQUEST['get_amount_invest'];

$get_day = $_REQUEST['get_day'];
$get_month = $_REQUEST['get_month'];
$get_year = $_REQUEST['get_year'];
$YYYYMMDD_In = $get_year."".$get_month."".$get_day;
//print_r($_GET);
$age = Determine_AgeFrom_DOB ($YYYYMMDD_In);

//Tenure
//0-6
//6-12
//12-24 (1-2yrs)
//24-36 (2-3yrs)
//36-48 (3-4yrs)
//48-60 (4-5yrs)
//60-120 (5-10yrs)
 
if($tenure<6)
{
	$defineTenure = "7 - 180 days";
	if($amount_invest<1500000)
	{
		$valuables = " 7_180bellow15 = '".$roi."' ";
		
		$fields = " 7_180bellow15 as rate";
		if($age>60)
		{
			$valuables = " 7_180bellow15sr = '".$roi."'";
			$fields = " 7_180bellow15sr as rate";
		}	
	}
	else if($amount_invest>=1500000 && $amount_invest<5000000)
	{
		$valuables = " 7_180bet15_50 = '".$roi."' ";
		$fields = " 7_180bet15_50 as rate";
		if($age>60)
		{
			$valuables = "7_180bet15_50sr = '".$roi."' ";
			$fields = "7_180bet15_50sr as rate";
		}	
	}
	else if($amount_invest>=5000000)
	{
		$valuables = "7_180above50 = '".$roi."' ";
		$fields =  "7_180above50 as rate";
		if($age>60)
		{
			$valuables = " 7_180above50sr = '".$roi."'";
			$fields = " 7_180above50sr as rate";
		}	
	}
}
else if($tenure>=6 && $tenure<12)
{
	$defineTenure =  '181 - 365 days';
	if($amount_invest<1500000)
	{
		$valuables = "180_364bellow15 = '".$roi."' ";
		$fields =  "180_364bellow15 as rate";
		if($age>60)
		{
			$valuables = "180_364bellow15sr = '".$roi."'";
			$fields = "180_364bellow15sr as rate";
		}	
	}
	else if($amount_invest>=1500000 && $amount_invest<5000000)
	{
		$valuables = "180_364bet15_50 = '".$roi."'";
		$fields = "180_364bet15_50 as rate"; 
		if($age>60)
		{
			$valuables = " 180_364bet15_50sr = '".$roi."'";
			$fields = "180_364bet15_50sr  as rate";
		}	
	}
	else if($amount_invest>=5000000)
	{
		$valuables = "180_364above50 = '".$roi."' ";
		$fields = "180_364above50 as rate"; 
		if($age>60)
		{
			$valuables = "180_364above50sr = '".$roi."'";
			$fields = "180_364above50sr as rate";
		}	
	}
}
else if($tenure>=12 && $tenure<24)
{
	$defineTenure =  '1 to 2 yrs';
	if($amount_invest<1500000)
	{
		$valuables = "1_2yrbellow15 = '".$roi."'";
		$fields = "1_2yrbellow15 as rate";
		if($age>60)
		{
			$valuables = " 1_2yrbellow15sr = '".$roi."' ";
			$fields = "1_2yrbellow15sr as rate";
		}
	}
	else if($amount_invest>=1500000 && $amount_invest<5000000)
	{
		$valuables = "1_2yrbet15_50 = '".$roi."'";
		$fields = "1_2yrbet15_50 as rate";
		if($age>60)
		{
			$valuables = " 1_2yrbet15_50sr = '".$roi."'";
			$fields = "1_2yrbet15_50sr as rate";
		}
	}
	else if($amount_invest>=5000000)
	{
		$valuables = "1_2yrabove50 = '".$roi."'";
		$fields = "1_2yrabove50 as rate";
		if($age>60)
		{
			$valuables = "1_2yrabove50sr = '".$roi."'";
			$fields = "1_2yrabove50sr as rate";
		}	
	}
}
else if($tenure>=24 && $tenure<36)
{	
	$defineTenure =  '2 to 3 yrs';	
	if($amount_invest<1500000)
	{
		$valuables = "2_3yrbellow15 = '".$roi."'";
		$fields = "2_3yrbellow15 as rate";
		if($age>60)
		{
			$valuables = " 2_3yrbellow15sr = '".$roi."'";
			$fields = "2_3yrbellow15sr as rate";
		}
	}
	else if($amount_invest>=1500000 && $amount_invest<5000000)
	{
		$valuables = "2_3yrbet15_50 = '".$roi."' ";
		$fields = "2_3yrbet15_50 as rate ";
		if($age>60)
		{
			$valuables = " 2_3yrbet15_50sr = '".$roi."'";
			$fields = "2_3yrbet15_50sr as rate";
		}	
	}
	else if($amount_invest>=5000000)
	{
		$valuables = "2_3yrabove50 = '".$roi."' ";
		$fields = "2_3yrabove50 as rate";
		if($age>60)
		{
			$valuables = " 2_3yrabove50sr = '".$roi."'";
			$fields = "2_3yrabove50sr as rate";
		}	
	}
}
else if($tenure>=36 && $tenure<48)
{
	$defineTenure =  '3 to 4 yrs';
	if($amount_invest<1500000)
	{
		$valuables = "3_4yrbellow15 = '".$roi."' ";
		$fields = "3_4yrbellow15 as rate";
		if($age>60)
		{
			$valuables = "3_4yrbellow15sr = '".$roi."'";
			$fields = "3_4yrbellow15sr as rate";
		}
	}
	else if($amount_invest>=1500000 && $amount_invest<5000000)
	{
		$valuables = "3_4yrbet15_50 = '".$roi."'";
		$fields = "3_4yrbet15_50 as rate";
		if($age>60)
		{
			$valuables = " 3_4yrbet15_50sr = '".$roi."'";
			$fields = "3_4yrbet15_50sr as rate";
		}	
	}
	else if($amount_invest>=5000000)
	{
		$valuables = "3_4yrabove50 = '".$roi."'";
		$fields = "3_4yrabove50 as rate";
		if($age>60)
		{
			$valuables = " 3_4yrabove50sr = '".$roi."'";
			$fields = "3_4yrabove50sr as rate";
		}
	}
}
else if($tenure>=48 && $tenure<60)
{
	$defineTenure =  '4 to 5 yrs';
	if($amount_invest<1500000)
	{
		$valuables = "4_5yrbellow15 = '".$roi."' ";
		$fields = "4_5yrbellow15 as rate";
		if($age>60)
		{
			$valuables = " 4_5yrbellow15sr = '".$roi."'";
			$fields = "4_5yrbellow15sr as rate";
		}
	}
	else if($amount_invest>=1500000 && $amount_invest<5000000)
	{
		$valuables = "4_5yrbet15_50 = '".$roi."'";
		$fields = "4_5yrbet15_50 as rate"; 
		if($age>60)
		{
			$valuables = " 4_5yrbet15_50sr = '".$roi."'";
			$fields = " 4_5yrbet15_50sr as rate";
		}
	}
	else if($amount_invest>=5000000)
	{
		$valuables = "4_5yrabove50 = '".$roi."'";
		$fields = "4_5yrabove50 as rate";
		if($age>60)
		{
			$valuables = " 4_5yrabove50sr = '".$roi."'";
			$fields = "4_5yrabove50sr as rate";
		}
	}
}
else if($tenure>=60)
{
	$defineTenure =  '5 to 10 yrs';
	if($amount_invest<1500000)
	{
		$valuables = "5_10yrbellow15 = '".$roi."'";
		$fields = "5_10yrbellow15 as rate"; 
		if($age>60)
		{
			$valuables = " 5_10yrbellow15sr = '".$roi."'";
			$fields = "5_10yrbellow15sr as rate";
		}
	}
	else if($amount_invest>=1500000 && $amount_invest<5000000)
	{
		$valuables = "5_10yrbet15_50 = '".$roi."'";
		$fields = "5_10yrbet15_50 as rate";
		if($age>60)
		{
			$valuables = "5_10yrbet15_50sr = '".$roi."'";
			$fields = "5_10yrbet15_50sr as rate";
		}
	}
	else if($amount_invest>=5000000)
	{
		$valuables = "5_10yrabove50 = '".$roi."' ";
		$fields = "5_10yrabove50 as rate";
		if($age>60)
		{
			$valuables = "5_10yrabove50sr = '".$roi."'";
			$fields = "5_10yrabove50sr as rate";
		}
		
	}
}

if($roi==5.5)
{
	$valuables = '';
}
else
{
	$valuables = ' and '.$valuables.'  '; 
}

  $sql = "select ".$fields.",fd_bankID from fd_interestrates where 1=1 ".$valuables." and status=1"; 
  list($num,$getrow)=MainselectfuncNew($sql,$array = array());
	
	//$query = ExecQuery($sql);
	//$num = mysql_num_rows($query);
	
	//$print = '<table  border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">  <tr>    <td style="border:1px solid #666666;">';
//	$print .= "<table cellpadding='0' cellspacing='0' border='0' width='100%'>";
	$print .='<table width="97%" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#d5cfb1">
	  <tr>
         <td width="430" height="25" align="center" valign="middle" bgcolor="#494949" class="tblwt_txt" style="font-size:12px;" >Company Name</td>
        <td width="162" align="center" valign="middle" bgcolor="#494949" class="tblwt_txt"  style="font-size:12px;">ROI</td>
        <td width="141" align="center" valign="middle" bgcolor="#494949" class="tblwt_txt"  style="font-size:12px;">Tenure</td>
      </tr> 

  <tr><td colspan="5" width="100%" align="center">
  <table cellpadding="3" cellspacing="3"  width="100%">';
	
while($i<count($getrow))
        {
		$rate ='';
		$fd_bankID = $getrow[$i]['fd_bankID'];
		$rate = $getrow[$i]['rate'];
//		if($age>60)
	//	{
		//	$rate = mysql_result($query,$i,'above');
		//}
		$bankNameSql = "select * from fd_interestrate_bank where fd_bankID='".$fd_bankID."'";
		list($numCount,$Arrrow)=MainselectfuncNew($bankNameSql,$array = array());
		$f = 0;
		//$bankNameQuery = ExecQuery($bankNameSql);
		$bankName = $Arrrow[$f]['fd_bank'];
		$banklogo = $Arrrow[$f]['logo'];
		
		$print .= '<tr>      <td width="430" height="30" align="left" bgcolor="#ffffff" class="tbl_txt" style="font-weight:bold; font-size:13px; color:#02358a; width:430px; ">';
		$print .= "<img src='".$banklogo."' border='0'><br>"; 
		$print .= $bankName; 
		$print .= "</td>";
		$print .= '<td width="162" height="30" align="left" bgcolor="#ffffff" class="tbl_txt" style="font-weight:bold; font-size:13px; color:#02358a; width:162px;"><span class="verdred12" style="padding:2px;">';
		$print .= $rate; 
		$print .= " %</td>";
		$print .= '<td width="141" height="30" align="center" bgcolor="#ffffff" class="tbl_txt" style="text-align:center; font-weight:bold; font-size:13px; color:#02358a;  width:141px;"><span class="verdred12" style="padding:2px;">';
		$print .= $defineTenure; 
		$print .= "</td></tr>";
	
	$i = $i +1;}
	
	$print .= "</table>";
	$print .= "</td></tr>";
	$print .= "</table>";	

	if($num>0)
	{
		echo $print;		
	}
	else
	{	
		$print = '<table width="620" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
	  <tr>
		<td style="border:1px solid #666666;">';
		$print .= "<table cellpadding='0' cellspacing='0' border='0' width='100%'>";
		$print .= "<tr>";
		$print .= "<td class='verdred12' style='padding:2px;' valign='bottom'>";
		$print .="No Data Found";
		$print .= " </td></tr>";
		$print .= "</table>";
		$print .= "</td></tr>";
		$print .= "</table>";
		echo $print;
	}

//print_r($_REQUEST);
?>
