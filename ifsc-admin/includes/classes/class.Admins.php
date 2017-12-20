<?php
class Admins{
	var $dbObj;
	
	function Admins(){ // class constructor
		$this->dbObj = new DB();
		$this->dbObj->fun_db_connect();
	}
	
	
	function processAddBankName($testiID=0, $actionMode='ADD')
	{
		$bname=strtolower($_POST['bankName']);
		$getBankName = str_replace(' ', '', $bname);
		$cateArray = array(
						"bank_name" => $_POST['bankName'],
						"bank_url" => $getBankName,
					);
					
		if($actionMode=='EDIT'){
			$fields = "";
			$fieldsVal = "";
			foreach($cateArray as $keys => $vals){
				$fields .= $keys . "='" . fun_db_input($vals). "', ";
			}
			$fields = trim($fields);
			if($fields!=""){
				$fields = substr($fields,0,strlen($fields)-1);
			 	$sqlUpdate = "UPDATE " . TABLE_BANK . " SET " . $fields . ", flag='".$_REQUEST['flag']."'  WHERE id='".(int)$testiID."'";
				$this->dbObj->fun_db_query($sqlUpdate) or die("<font color='#ff0000' face='verdana' size='2'>Error: Unable to execute request!<br>Invalid Query On " . TABLE_BANK . " table.</font>");
				return $this->dbObj->fun_db_get_affected_rows();
			}
		}
		
		if($actionMode=='ADD'){
			$fields = "";
			$fieldsVal = "";
			foreach($cateArray as $keys => $vals){
				$fields .= $keys . ", ";
				$fieldsVal .= "'" . fun_db_input($vals). "', ";
			}
			$sqlInsert = "INSERT INTO " . TABLE_BANK . "(id, ".$fields." flag) " ;
			$sqlInsert .= " VALUES(null, ".$fieldsVal." '".$_REQUEST['flag']."')";
			$this->dbObj->fun_db_query($sqlInsert) or die("<font color='#ff0000' face='verdana' size='2'>Error: Unable to execute request!<br>Invalid Query On " . TABLE_BANK . " table.</font>");
			return $this->dbObj->fun_db_last_inserted_id();
		}
		
	}

function GetStateName($conName)
		{
		
			$selected = "";
			$sql = trim($sql);
//			$sql .= "SELECT * FROM ".TABLE_STATE_LOC." WHERE sub_id=0 AND flag=1";
			$sql .= "SELECT * FROM ".TABLE_STATE_LOC." WHERE sub_id=0";			
			
			$result = $this->dbObj->fun_db_query($sql);
			while($rowsCon = $this->dbObj->fun_db_fetch_rs_object($result))
				{
					if($rowsCon->id==$conName && $conName!="")
						{
							$selected = "selected";	
						}
					else
						{
							$selected = "";	
						}	
					echo "<option value=\"".fun_db_output($rowsCon->id)."\" ".$selected.">";
					echo fun_db_output($rowsCon->name);
					echo "</option>";
				}
			$this->dbObj->fun_db_free_resultset($result); 
		}
	
	
	function processAddCity($testiID=0, $actionMode='ADD'){
		
		$Cityname=strtolower($_POST['CityName']);
		$getCityName = str_replace(' ', '', $Cityname);
		
		$cateArray = array(
						"name" => $_POST['CityName'],
						"state_city_url"=>$getCityName,
						"city_latitude" => $_POST['CityLatitude'],
						"city_longitide	" => $_POST['CityLongitude']
					);
					
		if($actionMode=='EDIT'){
			$fields = "";
			$fieldsVal = "";
			foreach($cateArray as $keys => $vals){
				$fields .= $keys . "='" . fun_db_input($vals). "', ";
			}
			$fields = trim($fields);
			if($fields!=""){
				$fields = substr($fields,0,strlen($fields)-1);
			 	$sqlUpdate = "UPDATE " . TABLE_STATE_LOC . " SET " . $fields . ", sub_id='".$_REQUEST['stateName']."'  WHERE id='".(int)$testiID."'";
				$this->dbObj->fun_db_query($sqlUpdate) or die("<font color='#ff0000' face='verdana' size='2'>Error: Unable to execute request!<br>Invalid Query On " . TABLE_STATE_LOC . " table.</font>");
				return $this->dbObj->fun_db_get_affected_rows();
			}
		}
		
		if($actionMode=='ADD'){
			$fields = "";
			$fieldsVal = "";
			foreach($cateArray as $keys => $vals){
				$fields .= $keys . ", ";
				$fieldsVal .= "'" . fun_db_input($vals). "', ";
			}
			$sqlInsert = "INSERT INTO " . TABLE_STATE_LOC . "(id, ".$fields." sub_id) " ;
			$sqlInsert .= " VALUES(null, ".$fieldsVal." '".$_REQUEST['stateName']."')";
			$this->dbObj->fun_db_query($sqlInsert) or die("<font color='#ff0000' face='verdana' size='2'>Error: Unable to execute request!<br>Invalid Query On " . TABLE_STATE_LOC . " table.</font>");
			return $this->dbObj->fun_db_last_inserted_id();
		}
	}
	
function GetStateInfo($id)
{
	$sql = "SELECT * FROM ".TABLE_STATE_LOC. " WHERE  id='".(int)$id."'";
			$result = $this->dbObj->fun_db_query($sql);
			$rowsCon = $this->dbObj->fun_db_fetch_rs_object($result);
			$Array = array(
					"id"=>fun_db_output($rowsCon->id),
					"name"=>fun_db_output($rowsCon->name),
					"sub_id"=>fun_db_output($rowsCon->sub_id)
				);
			return $Array;	
}

function GetBankInfo($id)
{
	$sql = "SELECT * FROM ".TABLE_BANK. " WHERE  id='".(int)$id."'";
			$result = $this->dbObj->fun_db_query($sql);
			$rowsCon = $this->dbObj->fun_db_fetch_rs_object($result);
			$Array = array(
					"id"=>fun_db_output($rowsCon->id),
					"bank_name"=>fun_db_output($rowsCon->bank_name),
					"flag"=>fun_db_output($rowsCon->flag)
				);
			return $Array;	
}

function GetBankName($conName)
		{
		
			$selected = "";
			$sql = trim($sql);
			$sql .= "SELECT * FROM ".TABLE_BANK;
			
			$result = $this->dbObj->fun_db_query($sql);
			while($rowsCon = $this->dbObj->fun_db_fetch_rs_object($result))
				{
					if($rowsCon->id==$conName && $conName!="")
						{
							$selected = "selected";	
						}
					else
						{
							$selected = "";	
						}	
					echo "<option value=\"".fun_db_output($rowsCon->id)."\" ".$selected.">";
					echo fun_db_output($rowsCon->bank_name);
					echo "</option>";
				}
			$this->dbObj->fun_db_free_resultset($result); 
		}

	function GetCityName($cityId,$conName)
		{
		
			$selected = "";
			$sql = trim($sql);
			$sql .= "SELECT * FROM ".TABLE_STATE_LOC." WHERE sub_id!=0 and sub_id=".$conName;
			
			$result = $this->dbObj->fun_db_query($sql);
			while($rowsCon = $this->dbObj->fun_db_fetch_rs_object($result))
				{
					if($conName!="" && $rowsCon->id==$cityId)
						{
							$selected = "selected";	
						}
					else
						{
							$selected = "";	
						}	
					echo "<option value=\"".fun_db_output($rowsCon->id)."\" ".$selected.">";
					echo fun_db_output($rowsCon->name);
					echo "</option>";
				}
			$this->dbObj->fun_db_free_resultset($result); 
		}
	
	
	function processAddLocation($testiID=0, $actionMode='ADD'){
		$LocationName=strtolower($_POST['locationName']);
		$branchUrl = str_replace(' ', '', $LocationName);
		$newstringAdd = preg_replace("/[\n\r]/","",$_POST['Address']); 
		$cateArray = array(
						"bank_id" => $_POST['BankName'],
						"stateid" => $_POST['StateName'],
						"state_id" => $_POST['CityName'],
						"branch_url" => $branchUrl,
						"address" => $newstringAdd,
						"ifsc" => $_POST['IfscCode'],
						"swift_bic_code" => $_POST['SwiftBicCode'],
						"phone" => $_POST['Phone'],
						"branch_code" => $_POST['BranchCode'],
						"micr_code" => $_POST['MICRCode'],
						"pincode" => $_POST['Pincode'],
						"description" => $_POST['description'],
						"MetaTitle" => $_POST['MetaTitle'],
						"MetaKeyword" => $_POST['MetaKeyword'],
						"MetaDesc" => $_POST['MetaDesc'],
						"latitude" => $_POST['Latitude'],
						"longitude" => $_POST['Longitude'],
						"last_modify_date" =>  date("Y-m-d H:i:s")
					);
					
		if($actionMode=='EDIT'){
			$fields = "";
			$fieldsVal = "";
			foreach($cateArray as $keys => $vals){
				$fields .= $keys . "='" . fun_db_input($vals). "', ";
			}
			$fields = trim($fields);
			if($fields!=""){
				$fields = substr($fields,0,strlen($fields)-1);
			 	$sqlUpdate = "UPDATE " . TABLE_BRANCH . " SET " . $fields . ", branch_name='".$_REQUEST['locationName']."'  WHERE id='".(int)$testiID."'";
				$this->dbObj->fun_db_query($sqlUpdate) or die("<font color='#ff0000' face='verdana' size='2'>Error: Unable to execute request!<br>Invalid Query On " . TABLE_BRANCH . " table.</font>");
				return $this->dbObj->fun_db_get_affected_rows();
			}
		}
		
		if($actionMode=='ADD'){
			$fields = "";
			$fieldsVal = "";
			foreach($cateArray as $keys => $vals){
				$fields .= $keys . ", ";
				$fieldsVal .= "'" . fun_db_input($vals). "', ";
			}
			$sqlInsert = "INSERT INTO " . TABLE_BRANCH . "(id, ".$fields." branch_name) " ;
			$sqlInsert .= " VALUES(null, ".$fieldsVal." '".$_REQUEST['locationName']."')";
			$this->dbObj->fun_db_query($sqlInsert) or die("<font color='#ff0000' face='verdana' size='2'>Error: Unable to execute request!<br>Invalid Query On " . TABLE_BRANCH . " table.</font>");
			return $this->dbObj->fun_db_last_inserted_id();
		}
	}
	
	
	
	function fun_authenticate_admin(){
			$msg ="Your session has been expired!";
			echo "<script language=\"javascript\">parent.location.href=\"index.php?msg=".urlencode($msg)."\";</script>";die;
	}
	

//Redirect Url
function redirectURL($rurl){
	header("Location: " . $rurl);
	exit;
}

}
?>