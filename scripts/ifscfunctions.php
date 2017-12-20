<?php
function GetBankID($BankName){
		$Sqql = ExecQuery("SELECT * FROM ifsc_bank WHERE bank_url='".$BankName."'");
		$rowsqlIfsc=mysql_fetch_array($Sqql);
		return $rowsqlIfsc;
	}

function GetCityId($CityName){
		$Sqql = ExecQuery("SELECT * FROM ifsc_state_dist WHERE state_city_url='".$CityName."' and sub_id=0");
		$rowsql=mysql_fetch_array($Sqql);
		return $rowsql;
	}
function GetCityIdCity($CityName){
		$Sqql = ExecQuery("SELECT * FROM ifsc_state_dist WHERE state_city_url='".$CityName."' and sub_id!=0");
		$rowsql=mysql_fetch_array($Sqql);
		return $rowsql;
	}	

function GetBranchId($BranchName){
		$Sqql = ExecQuery("SELECT * FROM ifsc_branch WHERE branch_url='".$BranchName."'");
		return $rowsql=mysql_fetch_array($Sqql);
		 
	}

function GetCityInfo($URL){
		$Sqql = ExecQuery("SELECT * FROM ifsc_state_dist WHERE state_city_url='".$URL."' and sub_id=0");
		$rowsql=mysql_fetch_array($Sqql);
		return $rowsql;
	}
	
	function BankInfo($BankUrl){
		$Sqql = ExecQuery("SELECT * FROM ifsc_bank WHERE bank_url='".$BankUrl."'");
		$rowsqlIfsc=mysql_fetch_array($Sqql);
		return $rowsqlIfsc;
	}


function DistInfo($stateCityUrl,$SubId){
		$Sqql = ExecQuery("SELECT * FROM ifsc_state_dist WHERE state_city_url='".$stateCityUrl."' AND sub_id!=0");
		$rowsql=mysql_fetch_array($Sqql);
		return $rowsql;
	}
	
	function BankBranchCount($BankId){
		$Sqql = ExecQuery("SELECT * FROM ifsc_branch WHERE bank_id='".$BankId."'");
		$rowsqlIfsc=mysql_num_rows($Sqql);
		return $rowsqlIfsc;
	}
	function StateBranchCount($SatetId, $BankID){
		$Sqql = ExecQuery("SELECT * FROM ifsc_branch WHERE stateid='".$SatetId."' AND bank_id='".$BankID."'");
		$rowsqlIfsc=mysql_num_rows($Sqql);
		return $rowsqlIfsc;
	}
	
	function CityBranchCount($CityId, $BankID, $StateId){
		$Sqql = ExecQuery("SELECT * FROM ifsc_branch WHERE state_id='".$CityId."'  AND bank_id='".$BankID."' AND stateid='".$StateId."' ");
		$rowsqlIfsc=mysql_num_rows($Sqql);
		return $rowsqlIfsc;
	}
	

?>