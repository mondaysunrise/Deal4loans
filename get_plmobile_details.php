<?php
	require 'scripts/db_init.php';
	

	
	$mobile = $_REQUEST['mobile'];
	
	$tomorrow  = mktime(0, 0, 0, date("m")  , date("d")-90, date("Y"));
	$days30date=date('Y-m-d',$tomorrow);
	$days30datetime = $days30date." 00:00:00";
	$currentdate=date('Y-m-d');
	$exactcurrentdate= $currentdate." 23:59:59";
	
	$CheckSql = "select Name, RequestID,Mobile_Number, Net_Salary, City, DOB, Updated_Date, Bidder_Count  from Req_Loan_Personal where (Mobile_Number='".$mobile."' and Updated_Date between '".$days30datetime."' and '".$exactcurrentdate."')";
	list($recordcount,$row)=Mainselectfunc($CheckSql,$array = array());
	if($recordcount>0)
	{
		
	echo '<table cellpadding="0" cellspacing="0" width="100%" border=1><tr>
			<td><div align="center">'.$row["RequestID"].'</div></td>
			<td><div align="center">'.$row["Name"].'</div></td>
			<td><div align="center">'.$row["Mobile_Number"].'</div></td>
			<td><div align="center">'.$row["Net_Salary"].'</div></td>
			<td><div align="center">'.$row["City"].'</div></td>
			<td><div align="center">'.$row["Bidder_Count"].'</div></td>
			<td><div align="center">'.$row["Updated_Date"].'</div></td>
		</tr></table>';
	 
	 } 
	 else
	 {
	 echo '<table cellpadding="0" cellspacing="0" width="100%"><tr>
			<td colspan="7" align="center">No result found</td></tr></table>';
	  }
	
	?>